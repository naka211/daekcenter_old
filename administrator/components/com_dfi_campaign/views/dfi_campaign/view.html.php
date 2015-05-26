<?php
/**
* @version		$Id: view.html.php 2848 2010-04-19 10:07:14 ngo.bieu@mwc.vn $
* @package		Joomla
* @subpackage	Dfi_campaigns
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
 * HTML View class for the Dfi_campaigns component
 *
 * @static
 * @package		Joomla
 * @subpackage	Dfi_campaigns
 * @since 1.0
 */
class Dfi_campaignsViewDfi_campaign extends JView
{
	function display($tpl = null)
	{
		global $mainframe;

		if($this->getLayout() == 'form') {
			$this->_displayForm($tpl);
			return;
		}

		//get the dfi_campaign
		$dfi_campaign =& $this->get('data');

		if ($dfi_campaign->url) {
			// redirects to url if matching id found
			$mainframe->redirect($dfi_campaign->url);
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
		
		//JHTML::stylesheet( 'dfi_campaign.css', 'administrator/components/com_dfi_campaign/assets/' );
		
		JHTML::_('behavior.calendar');
		JHTML::_('behavior.modal', 'a.modal-button');
		$button = new JObject();
		$button->set('modal', true);
		$button->set('modalname', 'modal-button');
		$button->set('options', "{handler: 'iframe', size: {x: 1100, y: 520}}");

		$lists = array();

		//get the dfi_campaign
		$dfi_campaign	=& $this->get('data');
		$isNew		= ($dfi_campaign->dfi_campaign_id < 1);

		// Edit or Create?
		if ($isNew) {
			// initialise new record
			$dfi_campaign->published = 1;
		}
		
		// build list of categories
		$lists['catid'] 			= JHTML::_('list.category',  'catid', $option, intval( @$dfi_campaign->catid ) );
		
		// helper
		require_once "components/com_dfi_campaign/helpers/dfi_campaign.php";
		
		require_once "components/com_dfi_folder/helpers/dfi_folder_active_checkbox.php";
		Dfi_folder_active_checkboxHelper::load($dfi_campaign->dfi_campaign_id);
		
		require_once "components/com_dfi_review_product/helpers/dfi_review_product_active_checkbox.php";
		Dfi_review_product_active_checkboxHelper::load($dfi_campaign->dfi_campaign_id);
		
		$lists['created'] 		 	= $dfi_campaign->created?JHTML::_('date', $dfi_campaign->created, '%Y-%m-%d %H:%M:%S'):'';

		$lists['modified'] 		 	= $dfi_campaign->modified?JHTML::_('date', $dfi_campaign->modified, '%Y-%m-%d %H:%M:%S'):'';
		
		$lists['published_date'] 		 	= $dfi_campaign->published_date?JHTML::_('date', $dfi_campaign->published_date, '%Y-%m-%d'):'';
		$lists['unpublished_date'] 		 	= $dfi_campaign->unpublished_date?JHTML::_('date', $dfi_campaign->unpublished_date, '%Y-%m-%d'):'';

		// build the html select list
		$lists['published'] 		= JHTML::_('select.booleanlist',  $model->_prefix.'published', 'class="inputbox"', $dfi_campaign->published );

		// build the html select list for ordering
		$query = 'SELECT ordering AS value, name AS text'
			. ' FROM #__dfi_campaigns'
			. ' ORDER BY ordering';
		$lists['ordering'] 			= JHTML::_('list.specificordering',  $dfi_campaign, $dfi_campaign->dfi_campaign_id, $query );

		//clean dfi_campaign data
		//JFilterOutput::objectHTMLSafe( $dfi_campaign, ENT_QUOTES, 'description' );
		
		$lists['comdir'] = JURI::root(false).'administrator/components/com_dfi_campaign/assets/';
		
		$lists['gallerydir'] = JURI::root(false).'images/rokquickcart';
		
		$this->assignRef('lists', $lists);
		$this->assignRef('dfi_campaign', $dfi_campaign);
		$this->assignRef('button', $button);
		$this->assignRef('editor', $editor);
		$this->assignRef('prefix', $model->_prefix);
		$this->assign('action', $uri->toString());
		
		$paramfile 	= JPath::clean(JPATH_COMPONENT.'/views/dfi_campaign/params.xml');
		$params = new JParameter(@$dfi_campaign->params, $paramfile);
		//$params->loadINI(@$dfi_campaign->params);
		//$params->set('<attr>', '<val>');
		$sliders = JPane::getInstance('sliders');
		$this->assignRef('pane', $sliders);
		$this->assignRef('params', $params);

		parent::display($tpl);
	}
}
