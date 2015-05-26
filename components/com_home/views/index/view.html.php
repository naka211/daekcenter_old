<?php
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view' );

/**
 * HTML View class for the Home Component
 *
 * @package    Home
 */
class HomeViewIndex extends JView
{
	function display($tpl = null)
	{
		global $mainframe;
		
		$document =& JFactory::getDocument();
		$uri =& JFactory::getURI();
		$params = &$mainframe->getParams();
		
		$document->setTitle( JText::_('Home') );
		
		$shops = $this->get('shops');
		$this->assignRef('shops', $shops);
		
		$c = $this->get('content');
		$this->assignRef('c', $c);

		$this->assign('template_dir', JURI::root().'templates/'.$mainframe->getTemplate().'/assets/');		
		$this->assign('action', $uri->toString());
		$this->assignRef('params', $params);
		
		parent::display($tpl);
	}
}
?> 