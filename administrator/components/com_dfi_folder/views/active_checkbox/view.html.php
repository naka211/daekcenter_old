<?php
/**
* @version		$Id: view.html.php 28643 2010-04-19 10:37:17 ngo.bieu@mwc.vn $
* @package		Joomla
* @subpackage	Dfi_folders
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
class Dfi_foldersViewActive_checkbox extends JView
{
	function display($tpl = null)
	{
		global $mainframe, $option;

		$db		=& JFactory::getDBO();
		$uri	=& JFactory::getURI();
		
		JHTML::_('behavior.modal', 'a.modal-button');
		
		//JHTML::stylesheet( 'dfi_folder.css', 'administrator/components/com_dfi_folder/assets/' );

		$filter_state		= $mainframe->getUserStateFromRequest( $option.'filter_state',		'filter_state',		'',				'word' );
		$filter_catid		= $mainframe->getUserStateFromRequest( $option.'filter_catid',		'filter_catid',		0,				'int' );
		$filter_order		= $mainframe->getUserStateFromRequest( $option.'filter_order',		'filter_order',		'a.ordering',	'cmd' );
		$filter_order_Dir	= $mainframe->getUserStateFromRequest( $option.'filter_order_Dir',	'filter_order_Dir',	'',				'word' );
		$search				= $mainframe->getUserStateFromRequest( $option.'search',			'search',			'',				'string' );
		$search				= JString::strtolower( $search );
		
		$filter_dfi_shop_id		= $mainframe->getUserStateFromRequest( $option.'filter_dfi_shop_id',		'filter_dfi_shop_id',		0,				'int' );
		$filter_dfi_campaign_id		= $mainframe->getUserStateFromRequest( $option.'filter_dfi_campaign_id',		'filter_dfi_campaign_id',		0,				'int' );
		
		// helper		 
		require_once "components/com_dfi_folder/helpers/dfi_folder_active_checkbox.php";
		require_once "components/com_dfi_shop/helpers/dfi_shop.php"; 
		$lists['dfi_shop_id'] = Dfi_shopHelper::dropdown('filter_dfi_shop_id', $filter_dfi_shop_id, array(array('value'=>0, 'text'=>'Select Shop')));
		require_once "components/com_dfi_campaign/helpers/dfi_campaign.php"; 
		$lists['dfi_campaign_id'] = Dfi_campaignHelper::dropdown('filter_dfi_campaign_id', $filter_dfi_campaign_id, array(array('value'=>0, 'text'=>'Select Campaign')));

		// Get data from the model
		$items		= & $this->get( 'Data');
		$total		= & $this->get( 'Total');
		$pagination = & $this->get( 'Pagination' );
		$checkbox_id	= & $this->get( 'Checkbox_id');

		// build list of categories
		$javascript 	= 'onchange="document.adminForm.submit();"';
		$lists['catid'] = JHTML::_('list.category',  'filter_catid', $option, intval( $filter_catid ), $javascript );

		// state filter
		$lists['state']	= JHTML::_('grid.state',  $filter_state );

		// table ordering
		$lists['order_Dir'] = $filter_order_Dir;
		$lists['order'] = $filter_order;
		
		$lists['comdir'] = JURI::root(false).'administrator/components/com_dfi_folder/assets/';
		$lists['gallerydir'] = JURI::root(false).'images/rokquickcart/';

		// search filter
		$lists['search']= $search;

		$this->assignRef('user',		JFactory::getUser());
		$this->assignRef('lists',		$lists);
		$this->assignRef('items',		$items);
		$this->assignRef('pagination',	$pagination);
		$this->assignRef('checkbox_id',	$checkbox_id);
		$this->assign('action', $uri->toString());

		parent::display($tpl);
	}
}