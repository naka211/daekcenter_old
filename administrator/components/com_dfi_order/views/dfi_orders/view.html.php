<?php
/**
* @version		$Id: view.html.php 30037 2010-04-20 17:32:38 ngo.bieu@mwc.vn $
* @package		Joomla
* @subpackage	Dfi_orders
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
 * HTML View class for the Dfi_orders component
 *
 * @static
 * @package		Joomla
 * @subpackage	Dfi_orders
 * @since 1.0
 */
class Dfi_ordersViewDfi_orders extends JView
{
	function display($tpl = null)
	{
		global $mainframe, $option;

		$db		=& JFactory::getDBO();
		$uri	=& JFactory::getURI();
		
		JHTML::_('behavior.modal', 'a.modal-button');
		
		//JHTML::stylesheet( 'dfi_order.css', 'administrator/components/com_dfi_order/assets/' );

		$filter_state		= $mainframe->getUserStateFromRequest( $option.'filter_state',		'filter_state',		'',				'word' );
		$filter_catid		= $mainframe->getUserStateFromRequest( $option.'filter_catid',		'filter_catid',		0,				'int' );
		$filter_order		= $mainframe->getUserStateFromRequest( $option.'filter_order',		'filter_order',		'a.ordering',	'cmd' );
		$filter_order_Dir	= $mainframe->getUserStateFromRequest( $option.'filter_order_Dir',	'filter_order_Dir',	'',				'word' );
		$search				= $mainframe->getUserStateFromRequest( $option.'search',			'search',			'',				'string' );
		$search				= JString::strtolower( $search );
		
		$filter_dfi_shop_id		= $mainframe->getUserStateFromRequest( $option.'filter_dfi_shop_id',		'filter_dfi_shop_id',		0,				'int' );
		$filter_dfi_kobreak_id		= $mainframe->getUserStateFromRequest( $option.'filter_dfi_kobreak_id',		'filter_dfi_kobreak_id',		0,				'int' );
		$filter_dfi_order_status_id		= $mainframe->getUserStateFromRequest( $option.'filter_dfi_order_status_id',		'filter_dfi_order_status_id',		0,				'int' );
		
		// helper
		require_once "components/com_dfi_order/helpers/dfi_order.php";
		require_once "components/com_dfi_shop/helpers/dfi_shop.php";
		$lists['dfi_shop_id'] = Dfi_shopHelper::dropdown('filter_dfi_shop_id', $filter_dfi_shop_id, array(array('value'=>0, 'text'=>'Select Shop')));
		
		require_once "components/com_dfi_kobreak/helpers/dfi_kobreak.php";
		$lists['dfi_kobreak_id'] = Dfi_kobreakHelper::dropdown('filter_dfi_kobreak_id', $filter_dfi_kobreak_id, array(array('value'=>0, 'text'=>'Select Kobreak')));
		
		require_once "components/com_dfi_order_status/helpers/dfi_order_status.php";
		$lists['dfi_order_status_id'] = Dfi_order_statusHelper::dropdown('filter_dfi_order_status_id', $filter_dfi_order_status_id, array(array('value'=>0, 'text'=>'Select Status')));

		// Get data from the model
		$items		= & $this->get( 'Data');
	
		$total		= & $this->get( 'Total');
		$pagination = & $this->get( 'Pagination' );

		// build list of categories
		$javascript 	= 'onchange="document.adminForm.submit();"';
		$lists['catid'] = JHTML::_('list.category',  'filter_catid', $option, intval( $filter_catid ), $javascript );

		// state filter
		$lists['state']	= JHTML::_('grid.state',  $filter_state );

		// table ordering
		$lists['order_Dir'] = $filter_order_Dir;
		$lists['order'] = $filter_order;
		
		$lists['comdir'] = JURI::root(false).'administrator/components/com_dfi_order/assets/';
		$lists['gallerydir'] = JURI::root(false).'images/rokquickcart/';
		
		// search filter
		$lists['search']= $search;

		$this->assignRef('user',		JFactory::getUser());
		$this->assignRef('lists',		$lists);
		$this->assignRef('items',		$items);
		$this->assignRef('pagination',	$pagination);
		$this->assign('action', $uri->toString());
		
		$paramfile 	= JPath::clean(JPATH_COMPONENT.'/views/dfi_order/params.xml');
		$params = new JParameter(NULL, $paramfile);
		$this->assignRef('params', $params);

		parent::display($tpl);
	}
}