<?php
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.plugin.plugin' );

/**
 * Example system plugin
 */
class plgSystemContentsAnywhere extends JPlugin
{
	/**
	 * Constructor
	 *
	 * For php4 compatibility we must not use the __constructor as a constructor for plugins
	 * because func_get_args ( void ) returns a copy of all passed arguments NOT references.
	 * This causes problems with cross-referencing necessary for the observer design pattern.
	 *
	 * @access	protected
	 * @param	object	$subject The object to observe
	 * @param 	array   $config  An array that holds the plugin configuration
	 * @since	1.0
	 */
	function plgSystemContentsAnywhere( &$subject, $config )
	{
		parent::__construct( $subject, $config );

		// Do some extra initialisation in this constructor if required
	}

	/**
	 * Do something onAfterInitialise 
	 */
	function onAfterInitialise()
	{
		// Perform some action
	}
	
	function onAfterRender()
	{
		global $mainframe;

		// return if current page is an administrator page
		if( $mainframe->isAdmin() ) { return; }

		$html = JResponse::getBody();
		
		$this->replaceInTheRest( $html );

		// only do the handling inside the body
		if ( !( strpos( $html, '<body' ) === false ) && !( strpos( $html, '</body>' ) === false ) ) {
			$html_split = explode( '<body', $html );
			$body_split = explode( '</body>', $html_split['1'] );

			$html_split['1'] = implode( '</body>', $body_split );
			$html = implode( '<body', $html_split );
		}

		JResponse::setBody( $html );
	}

	function replaceInTheRest( &$row ) {

		#$regex = '/\{include_content_item\s*(\d+)\}/i';

		$plugin =& JPluginHelper::getPlugin('system', 'contentsanywhere');
		$pluginParams = new JParameter( $plugin->params );

		if ( !$pluginParams->get( 'enabled', 1 ) ) {
			$row = preg_replace( $regex, '', $row );
			$row = preg_replace( $regex_title, '', $row );
			return true;
		}
		
		$regex='/\{include_content_block\s*(\d+)\s*([-]*\d*)\s*([-]*\d*)\s*.*\}/i';
		preg_match_all( $regex, $row, $matches, PREG_SET_ORDER );
		
		if (!count($matches)) return true;
		
		$count = count( $matches[0] );
		if ($count==0) return true;
		foreach($matches as $file) {
			# need to eval the code (if there is some)
			if($cond=htmlspecialchars_decode($this->get_condition($file[0]))) {
				# there is some php code to evaluate
				if(eval($cond)) {
					$this->process($row, $file);
				} //end if
			} else {
				# there isnt any to evaluate
				$this->process($row, $file);
			} //end if
		}
		
		$regex_title='/\{include_content_title\s*(\d+)\s*([-]*\d*)\s*([-]*\d*)\s*.*\}/i';
		preg_match_all( $regex_title, $row, $matches, PREG_SET_ORDER );
		
		if (!count($matches)) return true;
		
		$count = count( $matches[0] );
		if ($count==0) return true;
		foreach($matches as $file) {
			# need to eval the code (if there is some)
			if($cond=htmlspecialchars_decode($this->get_condition($file[0]))) {
				# there is some php code to evaluate
				if(eval($cond)) {
					$this->process_title($row, $file);
				} //end if
			} else {
				# there isnt any to evaluate
				$this->process_title($row, $file);
			} //end if
		}
		
		$regex_title='/\{include_content_full\s*(\d+)\s*([-]*\d*)\s*([-]*\d*)\s*.*\}/i';
		preg_match_all( $regex_title, $row, $matches, PREG_SET_ORDER );
		
		if (!count($matches)) return true;
		
		$count = count( $matches[0] );
		if ($count==0) return true;
		foreach($matches as $file) {
			# need to eval the code (if there is some)
			if($cond=htmlspecialchars_decode($this->get_condition($file[0]))) {
				# there is some php code to evaluate
				if(eval($cond)) {
					$this->process_full($row, $file);
				} //end if
			} else {
				# there isnt any to evaluate
				$this->process_full($row, $file);
			} //end if
		}
		
		# make sure the tags get removed either way
		$row = preg_replace( $regex, '', $row );
		return true;
	}	

	protected function process(&$row, $matches) {

		global $database;
		$db	=& JFactory::getDBO();
		$query = "SELECT introtext"
		. "\n FROM #__content"
		. "\n WHERE id=".$matches[1];
		$db->setQuery( $query );
		$output = $db->loadResult();
		if ($matches[2] || $matches[3])
		{
			if ($matches[3])
			{
				$output = htmlentities(substr(html_entity_decode($output), $matches[2], $matches[3]));
			} else {
				$output = htmlentities(substr(html_entity_decode($output), $matches[2]));
			}
		}
		$row = str_replace($matches[0], $output, $row);
	}
	
	protected function process_title(&$row, $matches) {

		global $database;
		$db	=& JFactory::getDBO();
		$query = "SELECT title"
		. "\n FROM #__content"
		. "\n WHERE id=".$matches[1];
		$db->setQuery( $query );
		$output = $db->loadResult();
		if ($matches[2] || $matches[3])
		{
			if ($matches[3])
			{
				$output = htmlentities(substr(html_entity_decode($output), $matches[2], $matches[3]));
			} else {
				$output = htmlentities(substr(html_entity_decode($output), $matches[2]));
			}
		}
		$row = str_replace($matches[0], $output, $row);
	}
	
	protected function process_full(&$row, $matches) {

		global $database;
		$db	=& JFactory::getDBO();
		$query = "SELECT fulltext"
		. "\n FROM #__content"
		. "\n WHERE id=".$matches[1];
		$db->setQuery( $query );
		$output = $db->loadResult();
		if ($matches[2] || $matches[3])
		{
			if ($matches[3])
			{
				$output = htmlentities(substr(html_entity_decode($output), $matches[2], $matches[3]));
			} else {
				$output = htmlentities(substr(html_entity_decode($output), $matches[2]));
			}
		}
		$row = str_replace($matches[0], $output, $row);
	}
	
	protected function get_condition($match) {
		$firstbracket=strpos($match,"(");
		if($firstbracket!==false) {
			$firstbracket++;
			$match=trim($match);
			return substr($match,$firstbracket,strlen($match)-($firstbracket+2));
		} //end if
		return false;
	} //end function
}