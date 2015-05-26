<?php
defined('_JEXEC') or die('Restrict Access');

jimport('joomla.application.component.model');

class NyhederModelNyheder extends JModel
{
	function getRow()
	{
		$id = JRequest::getVar('id', 0, '', 'int');
		
		$query = "SELECT * FROM #__content WHERE state=1 AND catid=2 AND id=".$id;
		$this->_db->setQuery( $query );
		return $this->_db->loadObject();
	} 
	
	function getRows()
	{
		$query = "SELECT * FROM #__content WHERE state=1 AND catid=2 ORDER BY ordering";
		$this->_db->setQuery( $query );
		return $this->_db->loadObjectList();
	} 
} 

?>