<?php
/**
* @version		$Id: dfi_catalogs.php 11397 2009-12-31 15:29:10 ngo.bieu@mwc.vn $
* @package		Joomla
* @subpackage	Dfi_catalogs
* @copyright	Copyright (C) 2008 - 2009 Open Source Matters. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

/*
 * Make sure the user is authorized to view this page
 */
/*$user = & JFactory::getUser();
if (!$user->authorize( 'com_dfi_catalog', 'manage' )) {
	$mainframe->redirect( 'index.php', JText::_('ALERTNOTAUTH') );
}*/

// Require the base controller
require_once (JPATH_COMPONENT.DS.'controller.php');

$controller	= new Dfi_catalogsController( );

// Perform the Request task
$controller->execute( JRequest::getCmd('task'));
$controller->redirect();