<?php
defined( '_JEXEC' ) or die( 'Restricted access' );

function com_uninstall(){
	//$path=dirname(JPATH_COMPONENT).DS."com_dfi_distribution_rate";
	$mosConfig_absolute_path = dirname(JPATH_COMPONENT);
	
	if (is_dir($mosConfig_absolute_path.DS.'com_joomfish'))
	{
		@unlink("$mosConfig_absolute_path".DS."com_joomfish".DS."contentelements".DS."dfi_distribution_rates.xml");
	}  
}
?>