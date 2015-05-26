<?php
defined('_JEXEC') or die('Restrict Access');

jimport('joomla.application.component.model');

class KontaktModelKontakt extends JModel
{
	function getMsg()
	{
		global $mainframe;
		$msg = $mainframe->getUserState( 'com_kontaktmsg' );
		if ($msg) 
		{
			$mainframe->setUserState( 'com_kontaktmsg', '' );
			return JText::_($msg);
		}
		else
			return JText::_('Invalid');
	} 
} 

?>