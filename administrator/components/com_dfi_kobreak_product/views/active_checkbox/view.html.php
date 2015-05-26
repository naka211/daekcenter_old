<?php
/**
* @version		$Id: view.html.php 11282 2010-04-19 10:27:58 ngo.bieu@mwc.vn $
* @package		Joomla
* @subpackage	Dfi_kobreak_products
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
class Dfi_kobreak_productsViewActive_checkbox extends JView
{
	function display($tpl = null)
	{
		global $mainframe, $option;

		$db		=& JFactory::getDBO();
		$uri	=& JFactory::getURI();
		
		JHTML::_('behavior.modal', 'a.modal-button');
		
		//JHTML::stylesheet( 'dfi_kobreak_product.css', 'administrator/components/com_dfi_kobreak_product/assets/' );

		$filter_state		= $mainframe->getUserStateFromRequest( $option.'filter_state',		'filter_state',		'',				'word' );
		$filter_catid		= $mainframe->getUserStateFromRequest( $option.'filter_catid',		'filter_catid',		0,				'int' );
		$filter_order		= $mainframe->getUserStateFromRequest( $option.'filter_order',		'filter_order',		'a.ordering',	'cmd' );
		$filter_order_Dir	= $mainframe->getUserStateFromRequest( $option.'filter_order_Dir',	'filter_order_Dir',	'',				'word' );
		$search				= $mainframe->getUserStateFromRequest( $option.'search',			'search',			'',				'string' );
		$search				= JString::strtolower( $search );

		// helper		 
		require_once "components/com_dfi_kobreak_product/helpers/dfi_kobreak_product_active_checkbox.php";

		// Get data from the model
		$items		= & $this->get( 'Data');

        //print_r($items);die;
        
		$total		= & $this->get( 'Total');
		$pagination = & $this->get( 'Pagination' );
		$checkbox_id	= & $this->get( 'Checkbox_id');
        $dfi_supplier_id	= & $this->get( 'Dfi_supplier_id');

		// build list of categories
		$javascript 	= 'onchange="document.adminForm.submit();"';
		$lists['catid'] = JHTML::_('list.category',  'filter_catid', $option, intval( $filter_catid ), $javascript );

		// state filter
		$lists['state']	= JHTML::_('grid.state',  $filter_state );

		// table ordering
		$lists['order_Dir'] = $filter_order_Dir;
		$lists['order'] = $filter_order;
		
		$lists['comdir'] = JURI::root(false).'administrator/components/com_dfi_kobreak_product/assets/';
		$lists['gallerydir'] = JURI::root(false).'images/rokquickcart/';

		// search filter
		$lists['search']= $search;

        $lists['dfi_campaign_id'] = $mainframe->getUserState( $option.'dfi_campaign_id', 0);
        
        #print_r($lists['dfi_campaign_id']);die;
	    
        
        $items_pro		= & $this->get( 'Data_pro');
        $this->assignRef('items_pro',		$items_pro);
    		
		$this->assignRef('user',		JFactory::getUser());
		$this->assignRef('lists',		$lists);
		$this->assignRef('items',		$items);
		$this->assignRef('pagination',	$pagination);
		$this->assignRef('checkbox_id',	$checkbox_id);
        $this->assignRef('dfi_supplier_id',	$dfi_supplier_id);
        $this->assignRef('dfi_campaign_id',	$lists['dfi_campaign_id']);
		$this->assign('action', $uri->toString());
        

		parent::display($tpl);
	}
}