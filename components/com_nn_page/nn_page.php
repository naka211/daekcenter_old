<?php
/**
 * NoNumber Page
 * Loads a page via the Joomla index.php (used for popups)
 *
 * @package    NoNumber! Elements
 * @version    v1.0.5
 *
 * @author     Peter van Westen <peter@nonumber.nl>
 * @link       http://www.nonumber.nl
 * @copyright  Copyright (C) 2009 NoNumber! All Rights Reserved
 * @license    http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

// No direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.filesystem.file' );

global $mainframe;

$file = JRequest::getCmd( 'file' );
$folder = JRequest::getCmd( 'folder' );

$pass = 0;

if ( $file ) {
	// only allow files that have any of these parts in the file name
	// best is to use .inc.php
	$pass_checks = array(
		'.inc.php',
		// support for older extensions that use the nn_page without having .inc.php
		'sourcerer',
		'modulesanywhere',
		'addtomenu'
	);

	foreach( $pass_checks as $pass_check ) {
		if ( !( strpos( $file, $pass_check ) === false ) ) {
			$pass = 1;
			break;
		}
	}
}

if ( !$pass ) {
	echo JText::_( 'Access Denied' );
	exit;
}

if ( !$mainframe->isAdmin() && !JRequest::getCmd( 'usetemplate' ) ) {
	$mainframe->setTemplate( 'system' );
}
$_REQUEST['tmpl'] = 'component';

$mainframe->_messageQueue = array();

$html = '';

$path = JPATH_SITE;
if ( $folder ) {
	$path .= DS.implode( DS, explode( '.', $folder ) );
}
$file = $path.DS.$file;
if ( JFile::exists( $file ) ) {
	ob_start();
		include $file;
		$html = ob_get_contents();
	ob_end_clean();
}

$document = & JFactory::getDocument();
$document->setBuffer( $html, 'component' );
$document->addStyleSheet( JURI::root( true ).'/components/com_nn_page/css/default.css' );

$mainframe->render();

echo JResponse::toString( $mainframe->getCfg( 'gzip' ) );

exit;