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
 * HTML View class for the Dfi_products component
 *
 * @static
 * @package		Joomla
 * @subpackage	Dfi_products
 * @since 1.0
 */
class Dfi_productsViewDfi_products extends JView
{
	function display($tpl = null)
	{
		global $mainframe, $option;

		$db		=& JFactory::getDBO();
		$uri	=& JFactory::getURI();
		
		JHTML::_('behavior.modal', 'a.modal-button');
		
		//JHTML::stylesheet( 'dfi_product.css', 'administrator/components/com_dfi_product/assets/' );

		$filter_state		= $mainframe->getUserStateFromRequest( $option.'filter_state',		'filter_state',		'',				'word' );
		$filter_catid		= $mainframe->getUserStateFromRequest( $option.'filter_catid',		'filter_catid',		0,				'int' );
		$filter_dfi_supplier_id		= $mainframe->getUserStateFromRequest( $option.'filter_dfi_supplier_id',		'filter_dfi_supplier_id',		0,				'int' );
		$filter_range		= $mainframe->getUserStateFromRequest( $option.'filter_range',		'filter_range',		0,				'int' );
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
		
		require_once "components/com_dfi_campaign/helpers/dfi_campaign.php";
		$_options=array( 
			array('value'=> '0' , 'text'=>'Select Sortiment'),
			array('value' => '1',  'text' => 'Yes' ),
			array('value' => '2' , 'text' => 'No' ) 
		);
		$lists['filter_range'] = Dfi_campaignHelper::tuyen_fix_dropdown('filter_range', intval( $filter_range ), $_options);

		// build list of categories
		$javascript 	= 'onchange="document.adminForm.submit();"';
		$lists['catid'] = JHTML::_('list.category',  'filter_catid', $option, intval( $filter_catid ), $javascript );

		// state filter
		$lists['state']	= JHTML::_('grid.state',  $filter_state );

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

		parent::display($tpl);
	}
}