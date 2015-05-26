<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

function com_uninstall(){
	//$path=dirname(JPATH_COMPONENT).DS."com_dfi_folder";
	$mosConfig_absolute_path = dirname(JPATH_COMPONENT);
	
	if (is_dir($mosConfig_absolute_path.DS.'com_joomfish'))
	{
		@unlink("$mosConfig_absolute_path".DS."com_joomfish".DS."contentelements".DS."dfi_order_product_folders.xml");
	}  
}
?>