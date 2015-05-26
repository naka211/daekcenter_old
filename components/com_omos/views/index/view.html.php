<?php
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

/**
 * HTML View class for the Omos Component
 *
 * @package    Omos
 */
class OmosViewIndex extends JView
{
	function display($tpl = null)
	{
		global $mainframe;
		
		$document =& JFactory::getDocument();
		$uri =& JFactory::getURI();
		$params = &$mainframe->getParams();
		
		$document->setTitle( JText::_('Omos') );
		
		$c = $this->get('content');
		$this->assignRef('c', $c);

		$this->assign('template_dir', JURI::root().'templates/'.$mainframe->getTemplate().'/assets/');		
		$this->assign('action', $uri->toString());
		$this->assignRef('params', $params);
		
		parent::display($tpl);
	}
}
?> 