<?php
defined('_JEXEC') or die('Direct Access to this location is not allowed.');
 
class ModDfi_navigatorHelper
{
	function getMenu()
	{
		$db =& JFactory::getDBO();
		$query = "SELECT * FROM #__menu WHERE menutype='mainmenu'".
                         " AND published=1".                         
                         " ORDER BY ordering"
                         ;
		$db->setQuery( $query );
		return $db->loadObjectList();
	}
	
	function selected($link, $action)
	{
		return str_replace('&view=index', '', $link)==$action;
	} 
} //end ModDfi_navigatorHelper

?>