<?php
defined('_JEXEC') or die('Restrict Access');

jimport('joomla.application.component.model');

class OmosModelOmos extends JModel
{
	function getContent()
	{
		$query = ' SELECT a.*'
			. ' FROM #__content AS a '
			. ' WHERE a.id=2'
		;
		$this->_db->setQuery($query);
		return $this->_db->loadObject();
	} 
} 

?>