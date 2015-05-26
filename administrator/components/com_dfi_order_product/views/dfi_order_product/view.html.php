<?php
/**
* @version		$Id: view.html.php 29593 2010-01-04 14:16:21 ngo.bieu@mwc.vn $
* @package		Joomla
* @subpackage	Dfi_order_products
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
 * HTML View class for the Dfi_order_products component
 *
 * @static
 * @package		Joomla
 * @subpackage	Dfi_order_products
 * @since 1.0
 */
class Dfi_order_productsViewDfi_order_product extends JView
{
	function display($tpl = null)
	{
		global $mainframe;

		if($this->getLayout() == 'form') {
			$this->_displayForm($tpl);
			return;
		}

		//get the dfi_order_product
		$dfi_order_product =& $this->get('data');

		if ($dfi_order_product->url) {
			// redirects to url if matching id found
			$mainframe->redirect($dfi_order_product->url);
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
		
		//JHTML::stylesheet( 'dfi_order_product.css', 'administrator/components/com_dfi_order_product/assets/' );
		
		JHTML::_('behavior.calendar');
		JHTML::_('behavior.modal', 'a.modal-button');
		$button = new JObject();
		$button->set('modal', true);
		$button->set('modalname', 'modal-button');
		$button->set('options', "{handler: 'iframe', size: {x: 760, y: 520}}");

		$lists = array();

		//get the dfi_order_product
		$dfi_order_product	=& $this->get('data');
		$isNew		= ($dfi_order_product->dfi_order_product_id < 1);

		// Edit or Create?
		if ($isNew) {
			// initialise new record
			
		}
		
		// build list of categories
		$lists['catid'] 			= JHTML::_('list.category',  'catid', $option, intval( @$dfi_order_product->catid ) );
		
		// helper
		require_once "components/com_dfi_order_product/helpers/dfi_order_product.php"; 
		
		// active checkbox
		//require_once "components/com_dfi_order_product_dfi_order_product/helpers/dfi_order_product_dfi_order_product.php";
		//$json = Dfi_order_product_dfi_order_productHelper::selection($dfi_order_product->dfi_order_product_id);
		//$mainframe->setUserState( 'com_dfi_order_productselection', $json );
		//if (!$isNew)
		//	$mainframe->setUserState( 'com_dfi_order_productfilter_selection', 'S' );
		//else
		//	$mainframe->setUserState( 'com_dfi_order_productfilter_selection', '' );
		
		
		
		$lists['comdir'] = JURI::root().'administrator/components/com_dfi_order_product/assets/';
		
		$lists['gallerydir'] = JURI::root().'images/rokquickcart';
		
		$this->assignRef('lists', $lists);
		$this->assignRef('dfi_order_product', $dfi_order_product);
		$this->assignRef('button', $button);
		$this->assignRef('editor', $editor);
		$this->assignRef('prefix', $model->_prefix);
		
		$component_params = &JComponentHelper::getParams($option);
		$paramfile 	= JPath::clean(JPATH_COMPONENT.'/views/dfi_order_product/params.xml');
		$params = new JParameter(@$dfi_order_product->params, $paramfile);
		$sliders = JPane::getInstance('sliders');
		$this->assignRef('pane', $sliders);
		$this->assignRef('params', $params);

		parent::display($tpl);
	}
}
