<?php
/**
* @version		$Id: view.html.php 11400 2010-01-05 08:23:14 ngo.bieu@mwc.vn $
* @package		Joomla
* @subpackage	Dfi_reports
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
 * HTML View class for the Dfi_reports component
 *
 * @static
 * @package		Joomla
 * @subpackage	Dfi_reports
 * @since 1.0
 */
class Dfi_reportsViewDfi_report extends JView
{
	function display($tpl = null)
	{
		global $mainframe;

		if($this->getLayout() == 'form') {
			$this->_displayForm($tpl);
			return;
		}

		//get the dfi_report
		$dfi_report =& $this->get('data');

		if ($dfi_report->url) {
			// redirects to url if matching id found
			$mainframe->redirect($dfi_report->url);
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
		
		//JHTML::stylesheet( 'dfi_report.css', 'administrator/components/com_dfi_report/assets/' );
		
		JHTML::_('behavior.calendar');
		JHTML::_('behavior.modal', 'a.modal-button');
		$button = new JObject();
		$button->set('modal', true);
		$button->set('modalname', 'modal-button');
		$button->set('options', "{handler: 'iframe', size: {x: 760, y: 520}}");

		$lists = array();

		//get the dfi_report
		$dfi_report	=& $this->get('data');
		$isNew		= ($dfi_report->dfi_report_id < 1);

		// Edit or Create?
		if ($isNew) {
			// initialise new record
			
		}
		
		// build list of categories
		$lists['catid'] 			= JHTML::_('list.category',  'catid', $option, intval( @$dfi_report->catid ) );
		
		// helper
		require_once "components/com_dfi_report/helpers/dfi_report.php"; 
		$lists['month'] = Dfi_reportHelper::month_dropdown($model->_prefix.'month', $dfi_report->month, NULL, FALSE);
		$lists['year'] = Dfi_reportHelper::year_dropdown($model->_prefix.'year', $dfi_report->year, NULL, FALSE);
		
		// active checkbox
		//require_once "components/com_dfi_report_dfi_report/helpers/dfi_report_dfi_report.php";
		//$json = Dfi_report_dfi_reportHelper::selection($dfi_report->dfi_report_id);
		//$mainframe->setUserState( 'com_dfi_reportselection', $json );
		//$mainframe->setUserState( 'com_dfi_reportfilter_selection_id', $dfi_report->dfi_report_id );
		//if (!$isNew)
		//	$mainframe->setUserState( 'com_dfi_reportfilter_selection', 'S' );
		//else
		//	$mainframe->setUserState( 'com_dfi_reportfilter_selection', '' );
		
		require_once "components/com_dfi_shop/helpers/dfi_shop.php"; 
		$lists['dfi_shop_id'] = Dfi_shopHelper::dropdown($model->_prefix.'dfi_shop_id', $dfi_report->dfi_shop_id, NULL, FALSE);
		
		require_once "components/com_dfi_product/helpers/dfi_product.php"; 
		$lists['dfi_product_id'] = Dfi_productHelper::dropdown($model->_prefix.'dfi_product_id', $dfi_report->dfi_product_id, NULL, FALSE);
		
		$lists['comdir'] = JURI::root().'administrator/components/com_dfi_report/assets/';
		
		$lists['gallerydir'] = JURI::root().'images/rokquickcart';
		
		$this->assignRef('lists', $lists);
		$this->assignRef('dfi_report', $dfi_report);
		$this->assignRef('button', $button);
		$this->assignRef('editor', $editor);
		$this->assignRef('prefix', $model->_prefix);
		
		$component_params = &JComponentHelper::getParams($option);
		$paramfile 	= JPath::clean(JPATH_COMPONENT.'/views/dfi_report/params.xml');
		$params = new JParameter(@$dfi_report->params, $paramfile);
		$sliders = JPane::getInstance('sliders');
		$this->assignRef('pane', $sliders);
		$this->assignRef('params', $params);

		parent::display($tpl);
	}
}
