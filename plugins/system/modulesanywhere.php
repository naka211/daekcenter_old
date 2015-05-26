<?php
/**
 * Main File
 *
 * @package    Modules Anywhere
 * @version    1.2.0
 * @since      File available since Release v1.0.0
 *
 * @author     Peter van Westen <peter@nonumber.nl>
 * @link       http://www.nonumber.nl/modulesanywhere
 * @copyright  Copyright (C) 2009 NoNumber! All Rights Reserved
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

// Ensure this file is being included by a parent file
defined( '_JEXEC' ) or die( 'Restricted access' );

// Import library dependencies
jimport( 'joomla.event.plugin' );

/**
* Plugin that loads modules
*/
class plgSystemModulesAnywhere extends JPlugin
{
	/**
	* Constructor
	*
	* For php4 compatability we must not use the __constructor as a constructor for
	* plugins because func_get_args ( void ) returns a copy of all passed arguments
	* NOT references.  This causes problems with cross-referencing necessary for the
	* observer design pattern.
	*/
	function plgSystemModulesAnywhere( &$subject )
	{
		global $mainframe;

		if ( $mainframe->isAdmin() ) { return; }

		parent::__construct( $subject );

		// load plugin parameters
		$this->_MA_plugin = JPluginHelper::getPlugin( 'system', 'modulesanywhere' );
		$this->_MA_params = new JParameter( $this->_MA_plugin->params );
		$this->_MA_syntax = '{module';

		$lang = & JFactory::getLanguage();
		// load plugin language file
		$lang->load( 'plg_system_modulesanywhere', JPATH_ADMINISTRATOR );
	}

////////////////////////////////////////////////////////////////////
// ARTICLES
////////////////////////////////////////////////////////////////////

	function onPrepareContent( &$article )
	{
		global $mainframe;

		// return if current page is an administrator page
		if( $mainframe->isAdmin() ) { return; }

		$this->replaceInArticles( $article );
	}

////////////////////////////////////////////////////////////////////
// COMPONENTS
////////////////////////////////////////////////////////////////////

	function onAfterDispatch()
	{
		global $mainframe, $option;

		// return if current page is an administrator page
		if( $mainframe->isAdmin() ) { return; }

		$document	=& JFactory::getDocument();
		$docType = $document->getType();

		if ( $docType == 'feed' && isset( $document->items ) ) {
			for ( $i = 0; $i < count( $document->items ); $i++ ) {
				$this->replaceInArticles( $document->items[$i] );
			}
		}

		if ( isset( $document->_buffer ) ) {
			$document->_buffer = $this->tagArea( $document->_buffer, 'component' );
		}

		// PDF
		if ( $docType == 'pdf' ) {
			if ( isset( $document->_header ) ) {
				$this->replaceInTheRest( $document->_header );
				$this->cleanLeftoverJunk( $document->_header );
			}
			if ( isset( $document->title ) ) {
				$this->replaceInTheRest( $document->title );
				$this->cleanLeftoverJunk( $document->title );
			}
			if ( isset( $document->_buffer ) ) {
				$this->replaceInTheRest( $document->_buffer );
				$this->cleanLeftoverJunk( $document->_buffer );
			}
		}
	}

////////////////////////////////////////////////////////////////////
// OTHER AREAS
////////////////////////////////////////////////////////////////////
	function onAfterRender()
	{
		global $mainframe;

		// return if current page is an administrator page
		if( $mainframe->isAdmin() ) { return; }

		$document	=& JFactory::getDocument();
		$docType = $document->getType();

		// not in pdf's
		if ( $docType == 'pdf' ) { return; }

		$html = JResponse::getBody();

		$this->protect( $html );
		$this->replaceInTheRest( $html );
		$this->unprotect( $html );

		// only do the handling inside the body
		if ( !( strpos( $html, '<body' ) === false ) && !( strpos( $html, '</body>' ) === false ) ) {
			$html_split = explode( '<body', $html );
			$body_split = explode( '</body>', $html_split['1'] );

			// remove generated modules outside the body
			$this->removeGeneratedModules( $html_split['0'] );
			$this->removeGeneratedModules( $body_split['1'] );

			$html_split['1'] = implode( '</body>', $body_split );
			$html = implode( '<body', $html_split );
		}

		$this->cleanLeftoverJunk( $html );

		JResponse::setBody( $html );
	}

////////////////////////////////////////////////////////////////////
// FUNCTIONS
////////////////////////////////////////////////////////////////////
	function replaceInArticles ( &$article ) {
		$message = '';

		if ( isset( $article->created_by ) ) {
			// Lookup group level of creator
			$acl =& JFactory::getACL();
			$article_group	= $acl->getAroGroup( $article->created_by );

			if( !isset( $article_group->lft ) ) {
				$article_group->lft = 0;
			}

			$security_group		= $acl->get_group_data( $this->_MA_params->get( 'articles_security_level', 23 ) );

			// Set if security is passed
			// passed = creator is equal or higher than security group level
			if ( $security_group['4'] > $article_group->lft ) {
				$message = JText::_( 'REMOVED, SECURITY' );
			}
		}

		if ( isset( $article->text ) ) {
			$this->processModules( $article->text, 'articles', $message );
		}
		if ( isset( $article->description ) ) {
			$this->processModules( $article->description, 'articles', $message );
		}
		if ( isset( $article->title ) ) {
			$this->processModules( $article->title, 'articles', $message );
		}
		if ( isset( $article->author ) ) {
			if ( isset( $article->author->name ) ) {
				$this->processModules( $article->author->name, 'articles', $message );
			} else {
				$this->processModules( $article->author, 'articles', $message );
			}
		}
	}

	function replaceInTheRest( &$str, $docType = 'html' )
	{
		global $option;

		if ( $str == '' ) { return; }

		$document	=& JFactory::getDocument();
		$docType = $document->getType();

		// COMPONENT
		if ( $docType == 'feed' ) {
			$search_regex = '#(<item[^>]*>.*</item>)#si';
			$str = preg_replace( $search_regex, '<!-- START: MODA_COMPONENT -->\1<!-- END: MODA_COMPONENT -->', $str );
		}
		if ( strpos( $str, '<!-- START: MODA_COMPONENT -->' ) === false ) {
			$str = $this->tagArea( $str, 'component' );
		}

		$components = $this->_MA_params->get( 'components', '' );
		if ( !is_array( $components ) ) {
			$components = explode( ',', $components );
		}

		$message = '';
		if ( in_array( $option, $components ) ) {
			// For all components that are selected, set the meassage
			$message = JText::_( 'REMOVED, NOT ENABLED' );
		}

		$components = $this->getTagArea( $str, 'component' );

		foreach ( $components as $component ) {
			$this->processModules( $component[1], 'components', $message );
			$str = str_replace( $component[0], $component[1], $str );
		}

		// EVERYWHERE
		$this->processModules( $str, 'other' );
	}

	function tagArea( $str, $area = '' )
	{
		if ( $area ) {
			if ( is_array( $str ) ) {
				foreach ( $str as $key => $val ) {
					$str[ $key ] = $this->tagArea( $val, $area );
				}
			} else if ( $str ) {
				$str = '<!-- START: MODA_'.strtoupper( $area ).' -->'.$str.'<!-- END: MODA_'.strtoupper( $area ).' -->';
			}
		}

		return $str;
	}
	function getTagArea( $str, $area = '' )
	{
		$matches = array( '', '' );

		if ( $str && $area ) {
			preg_match_all( '#<\!-- START: MODA_'.strtoupper( $area ).' -->(.*?)<\!-- END: MODA_'.strtoupper( $area ).' -->#s', $str, $matches, PREG_SET_ORDER );
		}

		return $matches;
	}

	function processModules( &$string, $area = 'articles', $message = '' )
	{
		jimport('joomla.application.module.helper');

		$module_tag = $this->_MA_params->get( 'module_tag', 'module' );
		$modulepos_tag = $this->_MA_params->get( 'modulepos_tag', 'modulepos' );
		$tags = $module_tag.'|'.$modulepos_tag;
		if ( $this->_MA_params->get( 'handle_loadposition', 0 ) ) { $tags .= '|loadposition'; }
		$regex = '#\{\s*('.$tags.')\s+([^\}]+?)((?:\|[^\}]+)?)\}#';
		if ( preg_match_all( $regex, $string, $matches, PREG_SET_ORDER ) > 0 ) {
			JPluginHelper::importPlugin( 'content' );

			$params_style = $this->_MA_params->get( 'style', 'none' );
			$params_override_style = $this->_MA_params->get( 'override_style', 1 );

			if (
				$area == 'articles' && !$this->_MA_params->get( 'articles_enable', 1 ) ||
				$area == 'components' && !$this->_MA_params->get( 'components_enable', 1 ) ||
				$area == 'other' && !$this->_MA_params->get( 'other_enable', 1 )
			) {
				$message = JText::_( 'REMOVED, NOT ENABLED' );
			}

			foreach ( $matches as $match ) {
				$module_html = $match['0'];
				$type = trim( $match['1'] );
				$module = trim( $match['2'] );
				$style = trim( $match['3'] );

				if ( $message != '' ) {
					$module_html = '<!-- '.JText::_( 'Comment - Modules Anywhere' ).': '.$message.' -->';
				} else {

					if ( $params_override_style && $style ) {
						$style = substr( $style, 1 );
					} else {
						$style = $params_style;
					}

					if ( $type == $module_tag ) {
						// module
						$module_html	= $this->processModule( $module, $style );
					} else {
						// module position
						$module_html	= $this->processPosition( $module, $style );
					}
				}
				$string = str_replace( $match['0'], '<!-- >>> Modules Anywhere >>> -->'.$module_html.'<!-- <<< Modules Anywhere <<< -->', $string );
			}
		}
	}
	function processPosition( $position, $style = 'none' )
	{
		$document	= &JFactory::getDocument();
		$renderer	= $document->loadRenderer( 'module' );
		$params	= array( 'style'=>$style );

		$html = '';
		foreach ( JModuleHelper::getModules( $position ) as $mod ) {
			$html .= $renderer->render( $mod, $params );
		}
		return $html;
	}

	function processModule( $module, $style = 'none' )
	{
		global $mainframe;

		$db		=& JFactory::getDBO();
		$user		=& JFactory::getUser();
		$aid		= $user->get( 'aid', 0 );

		$where = ' AND ( m.title="'.$module.'"';
		if ( is_numeric( $module ) ) {
			$where .= ' OR m.id='.$module;
		}
		$where .=  ' ) ';

		$query = 'SELECT *'.
			' FROM #__modules AS m'.
			' WHERE m.access <= '.(int) $aid.
			' AND m.client_id = '.(int) $mainframe->getClientId().
			$where.
			' ORDER BY ordering'.
			' LIMIT 1';

		$db->setQuery( $query );
		$row = $db->loadObject();

		$html = '';
		if ( $row ) {
			//determine if this is a custom module
			$row->user = ( substr( $row->module, 0, 4 ) == 'mod_' ) ? 0 : 1;
			$row->style = $style;

			$attribs = array();
			$attribs['style'] = $style;

			$html = JModuleHelper::renderModule( $row, $attribs );
		}
		return $html;
	}

		/*
	 * Protect input and text area's
	 */
	function protect( &$string )
	{
		global $mainframe, $option;
		$task = JRequest::getCmd( 'task' );

		// Protect complete adminForm (to prevent Sourcerer messing stuff up when editing articles and such)
		$regex = '#<form [^>]*name="adminForm".*?>.*?<div id="editor-xtd-buttons".*?</form>#si';
		if ( preg_match_all( $regex, $string, $matches, PREG_SET_ORDER ) > 0 ) {
			$protected_syntax = $this->protectStr( $this->_MA_syntax );
			foreach ( $matches as $match ) {
				if ( !( strpos( $match[0], $this->_MA_syntax ) === false ) ) {
					$form_string = str_replace( $this->_MA_syntax, $protected_syntax, $match[0] );
					$string = str_replace( $match[0], $form_string, $string );
				}
			}
		}
	}

	function unprotect( &$string )
	{
		$protected_start = $this->protectStr( $this->_MA_syntax );
		$string = str_replace( $protected_start, $this->_MA_syntax, $string );
	}

	function protectStr( $string )
	{
		$string = base64_encode( $string );
		return $string;
	}

	function cleanLeftoverJunk( &$str )
	{
		$module_tag = $this->_MA_params->get( 'module_tag', 'module' );
		$modulepos_tag = $this->_MA_params->get( 'modulepos_tag', 'modulepos' );
		$tags = $module_tag.'|'.$modulepos_tag;

		$regex = '#\{\s*('.$tags.')\s+([^\}]+?)((?:\|[^\}]+)?)\}#';
		$str = preg_replace( $regex, '', $str );

		$str = preg_replace( '#<\!-- (START|END): MODA_[^>]* -->#', '', $str );
	}

	function removeGeneratedModules( &$str )
	{
		$start_comment = '<!-- >>> Modules Anywhere >>> -->';
		$end_comment = '<!-- <<< Modules Anywhere <<< -->';
		$str = preg_replace( '#'.preg_quote( $start_comment, '#' ).'.*?'.preg_quote( $end_comment, '#' ).'\s*#', '', $str );
		$str = preg_replace( '#'.preg_quote( htmlentities( $start_comment ), '#' ).'.*?'.preg_quote( htmlentities( $end_comment ), '#' ).'\s*#', '', $str );
	}
}