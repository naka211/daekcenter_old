<?php
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

/**
 * HTML View class for the Catalog Component
 *
 * @package    Catalog
 */
class CatalogViewIndex extends JView
{
	function display($tpl = null)
	{
		global $mainframe, $option;
		
		$document =& JFactory::getDocument();
		$uri =& JFactory::getURI();
		$params = &$mainframe->getParams();
		
		$document->setTitle( JText::_('Catalog') );
		
		$msg = $mainframe->getUserState( $option.'msg' );
		$mainframe->setUserState( $option.'msg', '' );
		$this->assign('msg', $msg);
		
		$searchword = $this->get('searchword');
		$this->assignRef('searchword', $searchword);		
		
		// Get data from the model
		$items		= & $this->get( 'Data');
		//$total		= & $this->get( 'Total');
		$pagination = & $this->get( 'Pagination' );
		$this->assignRef('items', $items);
		$this->assignRef('pagination', $pagination);

		$this->assign('template_dir', JURI::root().'templates/'.$mainframe->getTemplate().'/assets/');		
		$this->assign('action', $uri->toString());
		$this->assignRef('params', $params);
		
		parent::display($tpl);
	}
}
?> 