<?php
/**
* @version		$Id: view.html.php 13121 2009-12-30 15:43:55 ngo.bieu@mwc.vn $
* @package		Joomla
* @subpackage	Dfi_shops
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
 * HTML View class for the Dfi_shops component
 *
 * @static
 * @package		Joomla
 * @subpackage	Dfi_shops
 * @since 1.0
 */
class Dfi_shopsViewDfi_shop extends JView
{
	function display($tpl = null)
	{
		global $mainframe;

		if($this->getLayout() == 'form') {
			$this->_displayForm($tpl);
			return;
		}

		//get the dfi_shop
		$dfi_shop =& $this->get('data');
	

		if ($dfi_shop->url) {
			// redirects to url if matching id found
			$mainframe->redirect($dfi_shop->url);
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
		
		//JHTML::stylesheet( 'dfi_shop.css', 'administrator/components/com_dfi_shop/assets/' );
		
		JHTML::_('behavior.calendar');
		JHTML::_('behavior.modal', 'a.modal-button');
		$button = new JObject();
		$button->set('modal', true);
		$button->set('modalname', 'modal-button');
		$button->set('options', "{handler: 'iframe', size: {x: 760, y: 520}}");

		$lists = array();

		//get the dfi_shop
		$dfi_shop	=& $this->get('data');
		$isNew		= ($dfi_shop->dfi_shop_id < 1);
	//print_r($dfi_shop);die;
		// Edit or Create?
		if ($isNew) {
			// initialise new record
			$dfi_shop->published = 1;
		}
		
		// build list of categories
		$lists['catid'] = JHTML::_('list.category',  'catid', $option, intval( @$dfi_shop->dfi_shops_catid) );
		//print_r($lists['catid'] );die;
		
		// helper
		require_once "components/com_dfi_shop/helpers/dfi_shop.php"; 
		
		// active checkbox
		require_once "components/com_dfi_member/helpers/dfi_member_active_checkbox.php";
		Dfi_member_active_checkboxHelper::load($dfi_shop->dfi_shop_id);
		
		require_once "components/com_dfi_distribution_rate/helpers/dfi_distribution_rate_active_checkbox.php";
		Dfi_distribution_rate_active_checkboxHelper::load($dfi_shop->dfi_shop_id);
		
		// build the html select list
		$lists['published'] 		= JHTML::_('select.booleanlist',  $model->_prefix.'published', 'class="inputbox"', $dfi_shop->published );

		$lists['filename_src'] 		 	= JURI::root().$dfi_shop->filename;		

		// build the html select list for ordering
		$query = 'SELECT ordering AS value, company_name AS text'
			. ' FROM #__dfi_shops'
			. ' ORDER BY ordering';
		$lists['ordering'] 			= JHTML::_('list.specificordering',  $dfi_shop, $dfi_shop->dfi_shop_id, $query );

		//clean dfi_shop data
		//JFilterOutput::objectHTMLSafe( $dfi_shop, ENT_QUOTES, 'description' );

		//clean dfi_shop data
		JFilterOutput::objectHTMLSafe( $dfi_shop, ENT_QUOTES, 'open_hour' );
		
		$lists['comdir'] = JURI::root().'administrator/components/com_dfi_shop/assets/';
		
		$lists['gallerydir'] = JURI::root().'images/rokquickcart';
		
		$this->assignRef('lists', $lists);
		$this->assignRef('dfi_shop', $dfi_shop);
		$this->assignRef('button', $button);
		$this->assignRef('editor', $editor);
		$this->assignRef('prefix', $model->_prefix);
		
		$component_params = &JComponentHelper::getParams($option);
		$paramfile 	= JPath::clean(JPATH_COMPONENT.'/views/dfi_shop/params.xml');
		$params = new JParameter(@$dfi_shop->params, $paramfile);
		$sliders = JPane::getInstance('sliders');
		$this->assignRef('pane', $sliders);
		$this->assignRef('params', $params);

		parent::display($tpl);
	}
}
