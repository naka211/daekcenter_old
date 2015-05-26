<?php
/**
* @version		$Id: view.html.php 13589 2009-12-31 13:42:24 ngo.bieu@mwc.vn $
* @package		Joomla
* @subpackage	Dfi_order_statuss
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
 * HTML View class for the Dfi_order_statuss component
 *
 * @static
 * @package		Joomla
 * @subpackage	Dfi_order_statuss
 * @since 1.0
 */
class Dfi_order_statussViewDfi_order_status extends JView
{
	function display($tpl = null)
	{
		global $mainframe;

		if($this->getLayout() == 'form') {
			$this->_displayForm($tpl);
			return;
		}

		//get the dfi_order_status
		$dfi_order_status =& $this->get('data');

		if ($dfi_order_status->url) {
			// redirects to url if matching id found
			$mainframe->redirect($dfi_order_status->url);
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
		
		//JHTML::stylesheet( 'dfi_order_status.css', 'administrator/components/com_dfi_order_status/assets/' );
		
		JHTML::_('behavior.calendar');
		JHTML::_('behavior.modal', 'a.modal-button');
		$button = new JObject();
		$button->set('modal', true);
		$button->set('modalname', 'modal-button');
		$button->set('options', "{handler: 'iframe', size: {x: 760, y: 520}}");

		$lists = array();

		//get the dfi_order_status
		$dfi_order_status	=& $this->get('data');
		$isNew		= ($dfi_order_status->dfi_order_status_id < 1);

		// Edit or Create?
		if ($isNew) {
			// initialise new record
			
		}
		
		// build list of categories
		$lists['catid'] 			= JHTML::_('list.category',  'catid', $option, intval( @$dfi_order_status->catid ) );
		
		// helper
		require_once "components/com_dfi_order_status/helpers/dfi_order_status.php"; 
		
		// active checkbox
		//require_once "components/com_dfi_order_status_dfi_order_status/helpers/dfi_order_status_dfi_order_status.php";
		//$json = Dfi_order_status_dfi_order_statusHelper::selection($dfi_order_status->dfi_order_status_id);
		//$mainframe->setUserState( 'com_dfi_order_statusselection', $json );
		//if (!$isNew)
		//	$mainframe->setUserState( 'com_dfi_order_statusfilter_selection', 'S' );
		//else
		//	$mainframe->setUserState( 'com_dfi_order_statusfilter_selection', '' );
		
		// build the html select list for ordering
		$query = 'SELECT ordering AS value, name AS text'
			. ' FROM #__dfi_order_statuses'
			. ' ORDER BY ordering';
		$lists['ordering'] 			= JHTML::_('list.specificordering',  $dfi_order_status, $dfi_order_status->dfi_order_status_id, $query );
		
		$lists['comdir'] = JURI::root().'administrator/components/com_dfi_order_status/assets/';
		
		$lists['gallerydir'] = JURI::root().'images/rokquickcart';
		
		$this->assignRef('lists', $lists);
		$this->assignRef('dfi_order_status', $dfi_order_status);
		$this->assignRef('button', $button);
		$this->assignRef('editor', $editor);
		$this->assignRef('prefix', $model->_prefix);
		
		$component_params = &JComponentHelper::getParams($option);
		$paramfile 	= JPath::clean(JPATH_COMPONENT.'/views/dfi_order_status/params.xml');
		$params = new JParameter(@$dfi_order_status->params, $paramfile);
		$sliders = JPane::getInstance('sliders');
		$this->assignRef('pane', $sliders);
		$this->assignRef('params', $params);

		parent::display($tpl);
	}
}
