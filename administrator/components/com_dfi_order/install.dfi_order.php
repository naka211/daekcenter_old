<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

function com_install(){
	//$path=dirname(JPATH_COMPONENT).DS."com_dfi_order";
	$mosConfig_absolute_path = dirname(JPATH_COMPONENT);
	
	if (is_dir($mosConfig_absolute_path.DS.'com_joomfish'))
	{
		@file_put_contents( "$mosConfig_absolute_path".DS."com_joomfish".DS."contentelements".DS."dfi_orders.xml", 
		@file_get_contents("$mosConfig_absolute_path".DS."com_dfi_order".DS."contentelements".DS."dfi_orders.xml")); 
	}  
}
?>