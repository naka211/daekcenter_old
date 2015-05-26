<?php
/**
* @version		$Id: view.html.php 12717 2010-03-28 11:24:25 ngo.bieu@mwc.vn $
* @package		Joomla
* @subpackage	Components
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
 * HTML View class for the Components component
 *
 * @static
 * @package		Joomla
 * @subpackage	Components
 * @since 1.0
 */
class ComponentsViewComponents extends JView
{
	function display($tpl = null)
	{
		global $mainframe, $option;

		$db		=& JFactory::getDBO();
		$uri	=& JFactory::getURI();
		
		JHTML::_('behavior.modal', 'a.modal-button');
		
		//JHTML::stylesheet( 'component.css', 'administrator/components/com_component/assets/' );

		$filter_state		= $mainframe->getUserStateFromRequest( $option.'filter_state',		'filter_state',		'',				'word' );
		$filter_catid		= $mainframe->getUserStateFromRequest( $option.'filter_catid',		'filter_catid',		0,				'int' );
		$filter_order		= $mainframe->getUserStateFromRequest( $option.'filter_order',		'filter_order',		'a.ordering',	'cmd' );
		$filter_order_Dir	= $mainframe->getUserStateFromRequest( $option.'filter_order_Dir',	'filter_order_Dir',	'',				'word' );
		$search				= $mainframe->getUserStateFromRequest( $option.'search',			'search',			'',				'string' );
		$search				= JString::strtolower( $search );
		
		$filter_parent		= $mainframe->getUserStateFromRequest( $option.'filter_parent',		'filter_parent',		0,				'int' );

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
		
		// helper
		require_once "components/com_component/helpers/component.php"; 
		$lists['parent'] = ComponentHelper::dropdown('filter_parent', $filter_parent, array(array('value'=>0, 'text'=>'Root')), TRUE);
		
		$lists['comdir'] = JURI::root(true).'administrator/components/com_component/assets/';
		$lists['gallerydir'] = JURI::root(true).'images/rokquickcart/';

		// search filter
		$lists['search']= $search;

		$this->assignRef('user',		JFactory::getUser());
		$this->assignRef('lists',		$lists);
		$this->assignRef('items',		$items);
		$this->assignRef('pagination',	$pagination);
		$this->assign('action', $uri->toString());
		
		$paramfile 	= JPath::clean(JPATH_COMPONENT.'/views/component/params.xml');
		$params = new JParameter(NULL, $paramfile);
		$this->assignRef('params', $params);

		parent::display($tpl);
	}
}