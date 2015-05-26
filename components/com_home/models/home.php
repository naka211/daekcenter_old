<?php
defined('_JEXEC') or die('Restrict Access');

jimport('joomla.application.component.model');

class HomeModelHome extends JModel
{
	function getShop()
	{
		$xid = JRequest::getString( 'id' );
		$id = str_replace('shop_', '', $xid);
		
		$query = ' SELECT a.*'
			. ' FROM #__dfi_shops AS a '
			. ' WHERE a.dfi_shop_id='.$id
		;
		$this->_db->setQuery($query);
		return $this->_db->loadObject();
	}

	function getShops()
	{
		$query = ' SELECT a.*,cc.*'
			. ' FROM #__dfi_maps AS a '
			. ' LEFT JOIN #__dfi_shops AS cc ON cc.dfi_shop_id = a.dfi_shop_id '
			. ' WHERE cc.published=1'
			. ' ORDER BY cc.ordering'
		;
		$this->_db->setQuery($query);
		return $this->_db->loadObjectList();
	}
    /*
    function getShops()
	{
		$query = ' SELECT a.*,cc.company_name,cc.butiksnr'
			. ' FROM #__dfi_maps AS a '
			. ' LEFT JOIN #__dfi_shops AS cc ON cc.dfi_shop_id = a.dfi_shop_id '
			. ' WHERE cc.published=1'
			. ' ORDER BY cc.ordering'
		;
		$this->_db->setQuery($query);
		return $this->_db->loadObjectList();
	} 
	*/
	
	function getContent()
	{
		$query = ' SELECT a.*'
			. ' FROM #__content AS a '
			. ' WHERE a.id=1'
		;
		$this->_db->setQuery($query);
		return $this->_db->loadObject();
	}
} 

?>