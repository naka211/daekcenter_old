<?php

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die();

jimport( 'joomla.application.component.view' );

class DateViewDate extends JView
{
	function display($tpl = null)
	{
		global $mainframe, $option;

		$db		=& JFactory::getDBO();
		$uri	=& JFactory::getURI();

		$filter_state		= $mainframe->getUserStateFromRequest( $option.'filter_state',		'filter_state',		'',				'word' );
		$filter_order		= $mainframe->getUserStateFromRequest( $option.'filter_order',		'filter_order',		'a.order',	'cmd' );
		$filter_order_Dir	= $mainframe->getUserStateFromRequest( $option.'filter_order_Dir',	'filter_order_Dir',	'',				'word' );
		$search				= $mainframe->getUserStateFromRequest( $option.'search',			'search',			'',				'string' );
		if (strpos($search, '"') !== false) {
			$search = str_replace(array('=', '<'), '', $search);
		}
		$search = JString::strtolower($search);

		// sanitize $filter_order
		if (!in_array($filter_order, array('a.name', 'a.order', 'a.id'))) {
			$filter_order = 'a.order';
		}

		if (!in_array(strtoupper($filter_order_Dir), array('ASC', 'DESC'))) {
			$filter_order_Dir = '';
		}

		// Get data from the model
		$items		= & $this->get( 'Data');
		$total		= & $this->get( 'Total');
		$pagination = & $this->get( 'Pagination' );

		// build list of categories
		$javascript 	= 'onchange="document.adminForm.submit();"';
		
		// state filter
		$lists['state']	= JHTML::_('grid.state',  $filter_state );

		// table ordering
		$lists['order_Dir'] = $filter_order_Dir;
		$lists['order'] = $filter_order;

		// search filter
		$lists['search']= $search;

		$this->assignRef('user',		JFactory::getUser());
		$this->assignRef('lists',		$lists);
		$this->assignRef('items',		$items);
		$this->assignRef('pagination',	$pagination);

		parent::display($tpl);
	}
}
