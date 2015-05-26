<?php
/**
* @version		$Id: view.html.php 9110 2009-12-31 09:09:04 ngo.bieu@mwc.vn $
* @package		Joomla
* @subpackage	Dfi_products
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
 * HTML View class for the Active_checkbox component
 *
 * @static
 * @package		Joomla
 * @subpackage	Active_checkbox
 * @since 1.0
 */
class Dfi_productsViewActive_checkbox extends JView
{
	function display($tpl = null)
	{
		global $mainframe, $option;

		$db		=& JFactory::getDBO();
		$uri	=& JFactory::getURI();
		
		JHTML::_('behavior.modal', 'a.modal-button');
		
		//JHTML::stylesheet( 'dfi_product.css', 'administrator/components/com_dfi_product/assets/' );

		$filter_state		= $mainframe->getUserStateFromRequest( $option.'filter_state',		'filter_state',		'',				'word' );
		$selection			= $mainframe->getUserStateFromRequest( $option.'selection',			'selection',		'{}',				'string' );
		$filter_selection		= $mainframe->getUserStateFromRequest( $option.'filter_selection',		'filter_selection',		'',				'word' );
		$filter_catid		= $mainframe->getUserStateFromRequest( $option.'filter_catid',		'filter_catid',		0,				'int' );
		$filter_dfi_supplier_id		= $mainframe->getUserStateFromRequest( $option.'filter_dfi_supplier_id',		'filter_dfi_supplier_id',		0,				'int' );
		$filter_order		= $mainframe->getUserStateFromRequest( $option.'filter_order',		'filter_order',		'a.ordering',	'cmd' );
		$filter_order_Dir	= $mainframe->getUserStateFromRequest( $option.'filter_order_Dir',	'filter_order_Dir',	'',				'word' );
		$search				= $mainframe->getUserStateFromRequest( $option.'search',			'search',			'',				'string' );
		$search				= JString::strtolower( $search );

		// Get data from the model
		$items		= & $this->get( 'Data');
		$total		= & $this->get( 'Total');
		$pagination = & $this->get( 'Pagination' );
		
		// helper
		require_once "components/com_dfi_supplier/helpers/dfi_supplier.php";
		$lists['dfi_supplier_id'] = Dfi_supplierHelper::dropdown('filter_dfi_supplier_id', intval( $filter_dfi_supplier_id ), array( array('value'=>0, 'text'=>'Select Supplier') ));

		// build list of categories
		$javascript 	= 'onchange="document.adminForm.submit();"';
		$lists['catid'] = JHTML::_('list.category',  'filter_catid', $option, intval( $filter_catid ), $javascript );

		// state filter
		$lists['state']	= JHTML::_('grid.state',  $filter_state );
		
		// selection filter
		require_once "components/com_dfi_product/helpers/dfi_product.php";
		$lists['selection']	= Dfi_productHelper::selection_dropdown('filter_selection', $filter_selection);
		
		// selection value
		$cid = array();
		if ($selection)
		{
			$_selection = json_decode($selection);
			foreach ($_selection as $k=>$v)
			{
				if ($v)
					$cid[] = $k;
			}
		}

		// table ordering
		$lists['order_Dir'] = $filter_order_Dir;
		$lists['order'] = $filter_order;
		
		$lists['comdir'] = JURI::root().'administrator/components/com_dfi_product/assets/';
		$lists['gallerydir'] = JURI::root().'images/rokquickcart/';

		// search filter
		$lists['search']= $search;

		$this->assignRef('user',		JFactory::getUser());
		$this->assignRef('lists',		$lists);
		$this->assignRef('items',		$items);
		$this->assignRef('pagination',	$pagination);
		$this->assignRef('cid',			$cid);
		$this->assignRef('selection',	$selection);

		parent::display($tpl);
	}
}