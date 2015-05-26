<?php
/**
* @version		$Id: view.html.php 11400 2010-01-05 08:23:14 ngo.bieu@mwc.vn $
* @package		Joomla
* @subpackage	Dfi_reports
* @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
* @license		GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

jimport( 'joomla.application.component.view');

/**
 * HTML View class for the Dfi_reports component
 *
 * @static
 * @package		Joomla
 * @subpackage	Dfi_reports
 * @since 1.0
 */
class Dfi_reportsViewDfi_reports extends JView
{
	function display($tpl = null)
	{
		global $mainframe, $option;

		$db		=& JFactory::getDBO();
		$uri	=& JFactory::getURI();
		
		JHTML::_('behavior.modal', 'a.modal-button');
		
		//JHTML::stylesheet( 'dfi_report.css', 'administrator/components/com_dfi_report/assets/' );

		$filter_state		= $mainframe->getUserStateFromRequest( $option.'filter_state',		'filter_state',		'',				'word' );
		$filter_catid		= $mainframe->getUserStateFromRequest( $option.'filter_catid',		'filter_catid',		0,				'int' );
		$dfi_shop_id		= $mainframe->getUserStateFromRequest( $option.'dfi_shop_id',		'dfi_shop_id',		0,				'int' );
		$filter_order		= $mainframe->getUserStateFromRequest( $option.'filter_order',		'filter_order',		'a.ordering',	'cmd' );
		$filter_order_Dir	= $mainframe->getUserStateFromRequest( $option.'filter_order_Dir',	'filter_order_Dir',	'',				'word' );
		$month				= $mainframe->getUserStateFromRequest( $option.'month',			'month',			'',				'string' );
		$year				= $mainframe->getUserStateFromRequest( $option.'year',			'year',			'',				'string' );
		$search				= $mainframe->getUserStateFromRequest( $option.'search',			'search',			'',				'string' );
		$search				= JString::strtolower( $search );

		// Get data from the model
		$items		= & $this->get( 'Data');
		$total		= & $this->get( 'Total');
		$pagination = & $this->get( 'Pagination' );

		// build list of categories
		$javascript 	= 'onchange="document.adminForm.submit();"';
		$lists['catid'] = JHTML::_('list.category',  'filter_catid', $option, intval( $filter_catid ), $javascript );
		
		// helper
		require_once "components/com_dfi_report/helpers/dfi_report.php"; 
		$lists['month'] = Dfi_reportHelper::month_dropdown('month', $month, array(array('value'=>'', 'text'=>JText::_( 'Select a Month' ))));
		$lists['year'] = Dfi_reportHelper::year_dropdown('year', $year, array(array('value'=>'', 'text'=>JText::_( 'Select a Year' ))));
		
		require_once "components/com_dfi_shop/helpers/dfi_shop.php"; 
		$lists['dfi_shop_id'] = Dfi_shopHelper::dropdown('dfi_shop_id', $dfi_shop_id, array(array('value'=>'', 'text'=>JText::_( 'Select a Shop' ))));

		// state filter
		$lists['state']	= JHTML::_('grid.state',  $filter_state );

		// table ordering
		$lists['order_Dir'] = $filter_order_Dir;
		$lists['order'] = $filter_order;
		
		$lists['comdir'] = JURI::root().'administrator/components/com_dfi_report/assets/';
		$lists['gallerydir'] = JURI::root().'images/rokquickcart/';

		// search filter
		$lists['search']= $search;

		$this->assignRef('user',		JFactory::getUser());
		$this->assignRef('lists',		$lists);
		$this->assignRef('items',		$items);
		$this->assignRef('pagination',	$pagination);

		parent::display($tpl);
	}
}