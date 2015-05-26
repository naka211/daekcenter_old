<?php
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');
jimport('joomla.html.pagination');

/**
 * HTML View class for the Search_result Component
 *
 * @package    Search_result
 */
class Search_resultViewIndex extends JView
{
	function display($tpl = null)
	{
		global $mainframe;
		
		$document =& JFactory::getDocument();
		$uri =& JFactory::getURI();
		$params = &$mainframe->getParams();
		
		$document->setTitle( JText::_('Search_result') );
		
		// Get data from the model
		$items		= & $this->get( 'Data');
		//$total		= & $this->get( 'Total');
		$pagination = & $this->get( 'Pagination' );
		
		$searchword = $this->get('searchword');
		$this->assignRef('searchword', $searchword);
		$this->assignRef('items', $items);
		$this->assignRef('pagination', $pagination);

		$this->assign('template_dir', JURI::root().'templates/'.$mainframe->getTemplate().'/assets/');		
		$this->assign('action', $uri->toString());
		$this->assignRef('params', $params);
		
		parent::display($tpl);
	}
}
?> 