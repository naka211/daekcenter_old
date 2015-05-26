<?php
/**
 * RokQuickCartController
 *
 * @package		Joomla
 * @subpackage	RokQuickCart
 * @copyright Copyright (C) 2009 RocketTheme. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * @author RocketTheme, LLC
 */
// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

jimport( 'joomla.application.component.controller' );

/**
 * RokCandy Macros RokCandy Macro Controller
 *
 * @package		Joomla
 * @subpackage	RokQuickCart
 * @since 1.5
 */
class RokQuickCartController extends JController
{
	function __construct($config = array())
	{
		parent::__construct($config);

		// Register Extra tasks
		$this->registerTask( 'add',  'display' );
		$this->registerTask( 'edit', 'display' );
		$this->registerTask( 'list', 'display' );
	}

	function display( )
	{
		parent::display();
	}
}