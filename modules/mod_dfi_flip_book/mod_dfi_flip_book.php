<?php
//no direct access
defined('_JEXEC') or die('Direct Access to this location is not allowed.');

$template_dir = JURI::root().'templates/'.$mainframe->getTemplate().'/assets/';

// include the helper file
require_once(dirname(__FILE__).DS.'helper.php');

$catid = JRequest::getVar('catid', 1, '', 'int');
$config_xml = 'index2.php?option=com_catalog&catid='.$catid;
 
// get a parameter from the module's configuration
$moduleclass_sfx = $params->get('moduleclass_sfx');
 
// include the template for display
require(JModuleHelper::getLayoutPath('mod_dfi_flip_book'));

?>