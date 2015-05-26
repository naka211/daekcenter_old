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
jimport('joomla.html.pane');

/**
 * HTML View class for the Dfi_orders component
 *
 * @static
 * @package		Joomla
 * @subpackage	Dfi_orders
 * @since 1.0
 */
class Dfi_ordersViewDfi_order extends JView
{
	function display($tpl = null)
	{
		global $mainframe;

		if($this->getLayout() == 'form') {
			$this->_displayForm($tpl);
			return;
		}

		//get the dfi_order
		$dfi_order =& $this->get('data');

		if ($dfi_order->url) {
			// redirects to url if matching id found
			$mainframe->redirect($dfi_order->url);
		}

		parent::display($tpl);
	}

	function _displayForm($tpl)
	{
		global $mainframe, $option;

		$db		=& JFactory::getDBO();
		$uri 	=& JFactory::getURI();
		$user 	=& JFactory::getUser();
		$model	=& $this->getModel();
		
		$editor =& JFactory::getEditor();
		
		//JHTML::stylesheet( 'dfi_order.css', 'administrator/components/com_dfi_order/assets/' );
		
		JHTML::_('behavior.calendar');
		JHTML::_('behavior.modal', 'a.modal-button');
		$button = new JObject();
		$button->set('modal', true);
		$button->set('modalname', 'modal-button');
		$button->set('options', "{handler: 'iframe', size: {x: 760, y: 520}}");

		$lists = array();

		//get the dfi_order
		$dfi_order	=& $this->get('data');
		$isNew		= ($dfi_order->dfi_order_id < 1);

		// Edit or Create?
		if ($isNew) {
			// initialise new record
			
		}
		
		// build list of categories
		$lists['catid'] 			= JHTML::_('list.category',  'catid', $option, intval( @$dfi_order->catid ) );
		
		// helper
		require_once "components/com_dfi_order/helpers/dfi_order.php";
		require_once "components/com_dfi_shop/helpers/dfi_shop.php";
		$lists['dfi_shop_id'] = Dfi_shopHelper::dropdown($model->_prefix.'dfi_shop_id', $dfi_order->dfi_shop_id, NULL, FALSE);
		
		require_once "components/com_dfi_kobreak/helpers/dfi_kobreak.php";
		$lists['dfi_kobreak_id'] = Dfi_kobreakHelper::dropdown($model->_prefix.'dfi_kobreak_id', $dfi_order->dfi_kobreak_id, array(array('value'=>0, 'text'=>'Select Kobreak')), FALSE);
		
		require_once "components/com_dfi_order_status/helpers/dfi_order_status.php";
		$lists['dfi_order_status_id'] = Dfi_order_statusHelper::dropdown($model->_prefix.'dfi_order_status_id', $dfi_order->dfi_order_status_id, NULL, FALSE);
		
		require_once "components/com_dfi_order_product/helpers/dfi_order_product_active_checkbox.php";
		Dfi_order_product_active_checkboxHelper::load($dfi_order->dfi_order_id);
		
		//clean dfi_order data
		//JFilterOutput::objectHTMLSafe( $dfi_order, ENT_QUOTES, 'note' );

		$lists['created'] 		 	= $dfi_order->created?JHTML::_('date', $dfi_order->created, '%Y-%m-%d'):'';

		$lists['received'] 		 	= $dfi_order->received?JHTML::_('date', $dfi_order->received, '%Y-%m-%d %H:%M'):'';
		$lists['modified'] 		 	= $dfi_order->modified?JHTML::_('date', $dfi_order->modified, '%Y-%m-%d'):'';

		$lists['sent'] 		 		= $dfi_order->sent?JHTML::_('date', $dfi_order->sent, '%Y-%m-%d'):'';
		
		$lists['comdir'] = JURI::root(false).'administrator/components/com_dfi_order/assets/';
		
		$lists['gallerydir'] = JURI::root(false).'images/rokquickcart';
		
		$this->assignRef('lists', $lists);
		$this->assignRef('dfi_order', $dfi_order);
		$this->assignRef('button', $button);
		$this->assignRef('editor', $editor);
		$this->assignRef('prefix', $model->_prefix);
		$this->assign('action', $uri->toString());
		
		$paramfile 	= JPath::clean(JPATH_COMPONENT.'/views/dfi_order/params.xml');
		$params = new JParameter(@$dfi_order->params, $paramfile);
		//$params->loadINI(@$dfi_order->params);
		//$params->set('<attr>', '<val>');
		$sliders = JPane::getInstance('sliders');
		$this->assignRef('pane', $sliders);
		$this->assignRef('params', $params);

		parent::display($tpl);
	}
}
