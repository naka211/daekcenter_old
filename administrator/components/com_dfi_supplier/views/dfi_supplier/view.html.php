<?php
/**
* @version		$Id: view.html.php 26210 2010-03-13 09:09:10 ngo.bieu@mwc.vn $
* @package		Joomla
* @subpackage	Dfi_suppliers
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
 * HTML View class for the Dfi_suppliers component
 *
 * @static
 * @package		Joomla
 * @subpackage	Dfi_suppliers
 * @since 1.0
 */
class Dfi_suppliersViewDfi_supplier extends JView
{
	function display($tpl = null)
	{
		global $mainframe;

		if($this->getLayout() == 'form') {
			$this->_displayForm($tpl);
			return;
		}

		//get the dfi_supplier
		$dfi_supplier =& $this->get('data');

		if ($dfi_supplier->url) {
			// redirects to url if matching id found
			$mainframe->redirect($dfi_supplier->url);
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
		
		//JHTML::stylesheet( 'dfi_supplier.css', 'administrator/components/com_dfi_supplier/assets/' );
		
		JHTML::_('behavior.calendar');
		JHTML::_('behavior.modal', 'a.modal-button');
		$button = new JObject();
		$button->set('modal', true);
		$button->set('modalname', 'modal-button');
		$button->set('options', "{handler: 'iframe', size: {x: 760, y: 520}}");

		$lists = array();

		//get the dfi_supplier
		$dfi_supplier	=& $this->get('data');
		$isNew		= ($dfi_supplier->dfi_supplier_id < 1);

		// Edit or Create?
		if ($isNew) {
			// initialise new record
			
		}
		
		// build list of categories
		$lists['catid'] 			= JHTML::_('list.category',  'catid', $option, intval( @$dfi_supplier->catid ) );
		
		// helper
		require_once "components/com_dfi_supplier/helpers/dfi_supplier.php";
		
		$lists['contact_1_name'] = Dfi_supplierHelper::getContact_name($dfi_supplier->contact_1); 
		$lists['contact_2_name'] = Dfi_supplierHelper::getContact_name($dfi_supplier->contact_2);
		
		// active checkbox
		//require_once "components/com_dfi_supplier_dfi_supplier/helpers/dfi_supplier_dfi_supplier.php";
		//$json = Dfi_supplier_dfi_supplierHelper::selection($dfi_supplier->dfi_supplier_id);
		//$mainframe->setUserState( 'com_dfi_supplierselection', $json );
		//$mainframe->setUserState( 'com_dfi_supplierfilter_selection_id', $dfi_supplier->dfi_supplier_id );
		//if (!$isNew)
		//	$mainframe->setUserState( 'com_dfi_supplierfilter_selection', 'S' );
		//else
		//	$mainframe->setUserState( 'com_dfi_supplierfilter_selection', '' );
		
		//clean dfi_supplier data
		//JFilterOutput::objectHTMLSafe( $dfi_supplier, ENT_QUOTES, 'payment_terms' );

		//clean dfi_supplier data
		//JFilterOutput::objectHTMLSafe( $dfi_supplier, ENT_QUOTES, 'kampagnevalutering' );

		//clean dfi_supplier data
		//JFilterOutput::objectHTMLSafe( $dfi_supplier, ENT_QUOTES, 'julevalutering' );

		//clean dfi_supplier data
		//JFilterOutput::objectHTMLSafe( $dfi_supplier, ENT_QUOTES, 'delivery_terms' );
		
		$lists['comdir'] = JURI::root(false).'administrator/components/com_dfi_supplier/assets/';
		
		$lists['gallerydir'] = JURI::root(false).'images/rokquickcart';
		
		$this->assignRef('lists', $lists);
		$this->assignRef('dfi_supplier', $dfi_supplier);
		$this->assignRef('button', $button);
		$this->assignRef('editor', $editor);
		$this->assignRef('prefix', $model->_prefix);
		
		$component_params = &JComponentHelper::getParams($option);
		$paramfile 	= JPath::clean(JPATH_COMPONENT.'/views/dfi_supplier/params.xml');
		$params = new JParameter(@$dfi_supplier->params, $paramfile);
		//$params->loadINI($component_params);
		//$params->set('<attr>', '<val>');
		$sliders = JPane::getInstance('sliders');
		$this->assignRef('pane', $sliders);
		$this->assignRef('params', $params);

		parent::display($tpl);
	}
}
