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
jimport('joomla.html.pane');

/**
 * HTML View class for the Dfi_kobreaks component
 *
 * @static
 * @package		Joomla
 * @subpackage	Dfi_kobreaks
 * @since 1.0
 */
class Dfi_kobreaksViewDfi_kobreak extends JView
{
	function display($tpl = null)
	{
		global $mainframe;

		if($this->getLayout() == 'form') {
			$this->_displayForm($tpl);
			return;
		}

		//get the dfi_kobreak
		$dfi_kobreak =& $this->get('data');

		if ($dfi_kobreak->url) {
			// redirects to url if matching id found
			$mainframe->redirect($dfi_kobreak->url);
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
		
		//JHTML::stylesheet( 'dfi_kobreak.css', 'administrator/components/com_dfi_kobreak/assets/' );
		
		JHTML::_('behavior.calendar');
		JHTML::_('behavior.modal', 'a.modal-button');
		$button = new JObject();
		$button->set('modal', true);
		$button->set('modalname', 'modal-button');
		$button->set('options', "{handler: 'iframe', size: {x: 1100, y: 520}}");

		$lists = array();

		//get the dfi_kobreak
		$dfi_kobreak	=& $this->get('data');
		$isNew		= ($dfi_kobreak->dfi_kobreak_id < 1);
		
		require_once "components/com_dfi_campaign/helpers/dfi_campaign.php";
		require_once "components/com_dfi_supplier/helpers/dfi_supplier.php";

		// Edit or Create?
		if ($isNew) {
			// initialise new record
			$dfi_kobreak->published = 0;
			$dfi_kobreak->dfi_campaign_id = 1000000000000;
            #$dfi_kobreak->dfi_campaign_id = Dfi_campaignHelper::first_campaign();
			$dfi_kobreak->lev_betingelse = Dfi_supplierHelper::first_supplier();
          
		}
		
		// build list of categories
		$lists['catid'] 			= JHTML::_('list.category',  'catid', $option, intval( @$dfi_kobreak->catid ) );
		
		// helper
		require_once "components/com_dfi_kobreak/helpers/dfi_kobreak.php";

		$mainframe->setUserState( 'com_dfi_kobreak_productdfi_campaign_id', $dfi_kobreak->dfi_campaign_id);
		$lists['dfi_campaign_id'] = Dfi_campaignHelper::dropdown($model->_prefix.'dfi_campaign_id', $dfi_kobreak->dfi_campaign_id, array(array('value'=>1000000000000, 'text'=>'Select Kampagne')), FALSE, 1, ' onchange="campaign_ajax(this.value)"');

        require_once "components/com_dfi_supplier/helpers/dfi_supplier.php";
		$lists['dfi_supplier_id'] = Dfi_supplierHelper::dropdown($model->_prefix.'dfi_supplier_id', $dfi_kobreak->dfi_supplier_id, array(array('value'=>1000000000000, 'text'=>'Select Leverandør')), FALSE, 1, ' onchange="supplier_ajax(this.value)"');
        
        //LDC 20110802
        
        $this->assignRef('dfi_campaign_id', $dfi_kobreak->dfi_campaign_id);
        $this->assignRef('dfi_supplier_id', $dfi_kobreak->dfi_supplier_id);
        //
        
        $lists['status'] = Dfi_kobreakHelper::status_dropdown($model->_prefix.'status', $dfi_kobreak->status, NULL, FALSE);
		
		require_once "components/com_dfi_kobreak_product/helpers/dfi_kobreak_product_active_checkbox.php";
		Dfi_kobreak_product_active_checkboxHelper::load($dfi_kobreak->dfi_kobreak_id);
		
		require_once "components/com_dfi_order/helpers/dfi_order_active_checkbox.php";
		Dfi_order_active_checkboxHelper::load($dfi_kobreak->dfi_kobreak_id);
		
		$lists['created'] 		 	= $dfi_kobreak->created?JHTML::_('date', $dfi_kobreak->created, '%Y-%m-%d %H:%M:%S'):'';

		//clean dfi_kobreak data
		//JFilterOutput::objectHTMLSafe( $dfi_kobreak, ENT_QUOTES, 'description' );

		// build the html select list
		$lists['published'] 		= JHTML::_('select.booleanlist',  $model->_prefix.'published', 'class="inputbox"', $dfi_kobreak->published );

		$lists['modified'] 		 	= $dfi_kobreak->modified?JHTML::_('date', $dfi_kobreak->modified, '%Y-%m-%d %H:%M:%S'):'';
        
        $lists['svarfrist'] 		 	= $dfi_kobreak->svarfrist?JHTML::_('date', $dfi_kobreak->svarfrist, '%Y-%m-%d %H:%M:%S'):'';

		// build the html select list for ordering
		$query = 'SELECT ordering AS value, name AS text'
			. ' FROM #__dfi_kobreaks'
			. ' ORDER BY dfi_campaign_id,dfi_supplier_id,ordering';
		$lists['ordering'] 			= JHTML::_('list.specificordering',  $dfi_kobreak, $dfi_kobreak->dfi_kobreak_id, $query );
		
		$lists['comdir'] = JURI::root(false).'administrator/components/com_dfi_kobreak/assets/';
		
		$lists['gallerydir'] = JURI::root(false).'images/rokquickcart';
		
        
		$this->assignRef('lists', $lists);
		$this->assignRef('dfi_kobreak', $dfi_kobreak);
		$this->assignRef('button', $button);
		$this->assignRef('editor', $editor);
		$this->assignRef('prefix', $model->_prefix);
		$this->assign('action', $uri->toString());
		
		$paramfile 	= JPath::clean(JPATH_COMPONENT.'/views/dfi_kobreak/params.xml');
		$params = new JParameter(@$dfi_kobreak->params, $paramfile);
		//$params->loadINI(@$dfi_kobreak->params);
		//$params->set('<attr>', '<val>');
		$sliders = JPane::getInstance('sliders');
		$this->assignRef('pane', $sliders);
		$this->assignRef('params', $params);

		parent::display($tpl);
	}
}
