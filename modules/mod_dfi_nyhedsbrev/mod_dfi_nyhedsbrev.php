<?php
//no direct access
defined('_JEXEC') or die('Direct Access to this location is not allowed.');

$template_dir = JURI::root().'templates/'.$mainframe->getTemplate().'/assets/';

// include the helper file
require_once(dirname(__FILE__).DS.'helper.php');
 
// get a parameter from the module's configuration
$moduleclass_sfx = $params->get('moduleclass_sfx');
 
// include the template for display
require(JModuleHelper::getLayoutPath('mod_dfi_nyhedsbrev'));

?>