<?php
/**
* @version		$Id: view.html.php 3997 2010-04-19 10:27:45 ngo.bieu@mwc.vn $
* @package		Joomla
* @subpackage	Dfi_kobreaks
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
 * HTML View class for the Dfi_kobreaks component
 *
 * @static
 * @package		Joomla
 * @subpackage	Dfi_kobreaks
 * @since 1.0
 */
class Dfi_kobreaksViewDfi_kobreaks extends JView
{
	function display($tpl = null)
	{
		global $mainframe, $option;

		$db		=& JFactory::getDBO();
		$uri	=& JFactory::getURI();
		
		JHTML::_('behavior.modal', 'a.modal-button');
		
		//JHTML::stylesheet( 'dfi_kobreak.css', 'administrator/components/com_dfi_kobreak/assets/' );

		$filter_state		= $mainframe->getUserStateFromRequest( $option.'filter_state',		'filter_state',		'',				'word' );
		$filter_catid		= $mainframe->getUserStateFromRequest( $option.'filter_catid',		'filter_catid',		0,				'int' );
		$filter_order		= $mainframe->getUserStateFromRequest( $option.'filter_order',		'filter_order',		'a.ordering',	'cmd' );
		$filter_order_Dir	= $mainframe->getUserStateFromRequest( $option.'filter_order_Dir',	'filter_order_Dir',	'',				'word' );
		$search				= $mainframe->getUserStateFromRequest( $option.'search',			'search',			'',				'string' );
		$search				= JString::strtolower( $search );
		
		$dfi_supplier_id = $mainframe->getUserStateFromRequest( $option.'dfi_supplier_id',		'dfi_supplier_id',		0,				'int' );
		
		$dfi_campaign_id = $mainframe->getUserStateFromRequest( $option.'dfi_campaign_id',		'dfi_campaign_id',		0,				'int' );
		$status = $mainframe->getUserStateFromRequest( $option.'status',		'status',		0,				'int' );
		
		// helper
		require_once "components/com_dfi_kobreak/helpers/dfi_kobreak.php";
		require_once "components/com_dfi_supplier/helpers/dfi_supplier.php";
		require_once "components/com_dfi_campaign/helpers/dfi_campaign.php";
		
		$lists['status'] = Dfi_kobreakHelper::status_dropdown('status', $status, array(array('value'=>0, 'text'=>'Select Status')));
		
		$lists['dfi_campaign_id'] = Dfi_campaignHelper::dropdown('dfi_campaign_id', $dfi_campaign_id, array(array('value'=>0, 'text'=>'Select Campaign')));
		
		$lists['dfi_supplier_id'] = Dfi_supplierHelper::dropdown('dfi_supplier_id', $dfi_supplier_id, array(array('value'=>0, 'text'=>'Select Supplier')));

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
		
		$lists['comdir'] = JURI::root(false).'administrator/components/com_dfi_kobreak/assets/';
		$lists['gallerydir'] = JURI::root(false).'images/rokquickcart/';
		
		// search filter
		$lists['search']= $search;

		$this->assignRef('user',		JFactory::getUser());
		$this->assignRef('lists',		$lists);
		$this->assignRef('items',		$items);
		$this->assignRef('pagination',	$pagination);
		$this->assign('action', $uri->toString());
		
		$paramfile 	= JPath::clean(JPATH_COMPONENT.'/views/dfi_kobreak/params.xml');
		$params = new JParameter(NULL, $paramfile);
		$this->assignRef('params', $params);

		parent::display($tpl);
	}
}