<?php
/**
 * Main Plugin File
 * Does all the magic!
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

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

// Import library dependencies
jimport( 'joomla.event.plugin' );

/**
* Button Plugin that places Editor Buttons
*/
class plgButtonModulesAnywhere extends JPlugin
{
	/**
	* Constructor
	*
	* For php4 compatability we must not use the __constructor as a constructor for
	* plugins because func_get_args ( void ) returns a copy of all passed arguments
	* NOT references. This causes problems with cross-referencing necessary for the
	* observer design pattern.
	*/
	function plgButtonModulesAnywhere( &$subject, $config )
	{
		parent::__construct( $subject, $config );

		// Load plugin parameters
		$this->_params = new JParameter( $config['params'] );

		// Load plugin language
		$lang =& JFactory::getLanguage();
		$lang->load( 'plg_'.$config['type'].'_'.$config['name'], JPATH_ADMINISTRATOR );
	}

	/**
	* Display the button
	*
	* @return array A two element array of ( imageName, textToInsert )
	*/
	function onDisplay( $name )
	{
		global $mainframe;

		$button = new JObject();
		$document =& JFactory::getDocument();

		$enable_frontend = $this->_params->get( 'enable_frontend', 1 );

		if ( !$mainframe->isAdmin() && !$enable_frontend ) {
			return $button;
		}

		JHTML::_( 'behavior.modal' );

		$css = '
			.button2-left .modulesanywhere {
				background: transparent url('.JURI::root( true ).'/plugins/editors-xtd/modulesanywhere/images/button_right.png) no-repeat 100% 0px;
			}
			';
		$document->addStyleDeclaration( $css );

		$link = 'index.php?option=com_nn_page';
		if ( $mainframe->isAdmin() ) {
			$link = '../'.$link;
		}
		$link .= '&folder=plugins.editors-xtd.modulesanywhere';
		$link .= '&file=modulesanywhere.php';
		$link .= '&name='.$name;


		$button->set( 'modal', true );
		$button->set( 'link', $link );
		$button->set( 'text', JText::_( 'Module' ) );
		$button->set( 'name', 'modulesanywhere' );
		$button->set( 'options', "{handler: 'iframe', size: {x: 700, y: 420}}" );

		return $button;
	}
}