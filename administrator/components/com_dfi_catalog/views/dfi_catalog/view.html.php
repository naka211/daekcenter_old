<?php
/**
* @version		$Id: view.html.php 11397 2009-12-31 15:29:10 ngo.bieu@mwc.vn $
* @package		Joomla
* @subpackage	Dfi_catalogs
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
 * HTML View class for the Dfi_catalogs component
 *
 * @static
 * @package		Joomla
 * @subpackage	Dfi_catalogs
 * @since 1.0
 */
class Dfi_catalogsViewDfi_catalog extends JView
{
	function display($tpl = null)
	{
		global $mainframe;

		if($this->getLayout() == 'form') {
			$this->_displayForm($tpl);
			return;
		}

		//get the dfi_catalog
		$dfi_catalog =& $this->get('data');

		if ($dfi_catalog->url) {
			// redirects to url if matching id found
			$mainframe->redirect($dfi_catalog->url);
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
		
		//JHTML::stylesheet( 'dfi_catalog.css', 'administrator/components/com_dfi_catalog/assets/' );
		
		JHTML::_('behavior.calendar');
		JHTML::_('behavior.modal', 'a.modal-button');
		$button = new JObject();
		$button->set('modal', true);
		$button->set('modalname', 'modal-button');
		$button->set('options', "{handler: 'iframe', size: {x: 760, y: 520}}");

		$lists = array();

		//get the dfi_catalog
		$dfi_catalog	=& $this->get('data');
		$isNew		= ($dfi_catalog->dfi_catalog_id < 1);

		// Edit or Create?
		if ($isNew) {
			// initialise new record
			$dfi_catalog->published = 1;
		}
		
		// build list of categories
		$lists['catid'] 			= JHTML::_('list.category',  $model->_prefix.'catid', $option, intval( @$dfi_catalog->catid ) );
		//print_r($lists['catid'] );die;
		
		// helper
		require_once "components/com_dfi_catalog/helpers/dfi_catalog.php"; 
		
		// active checkbox
		//require_once "components/com_dfi_catalog_dfi_catalog/helpers/dfi_catalog_dfi_catalog.php";
		//$json = Dfi_catalog_dfi_catalogHelper::selection($dfi_catalog->dfi_catalog_id);
		//$mainframe->setUserState( 'com_dfi_catalogselection', $json );
		//if (!$isNew)
		//	$mainframe->setUserState( 'com_dfi_catalogfilter_selection', 'S' );
		//else
		//	$mainframe->setUserState( 'com_dfi_catalogfilter_selection', '' );
		
		$lists['filename_src'] 		 	= JURI::root().$dfi_catalog->filename;

		

		//clean dfi_catalog data
		JFilterOutput::objectHTMLSafe( $dfi_catalog, ENT_QUOTES, 'description' );

		// build the html select list
		$lists['published'] 		= JHTML::_('select.booleanlist',  $model->_prefix.'published', 'class="inputbox"', $dfi_catalog->published );

		// build the html select list for ordering
		$query = 'SELECT ordering AS value, title AS text'
			. ' FROM #__dfi_catalogs'
			. ' ORDER BY ordering';
		$lists['ordering'] 			= JHTML::_('list.specificordering',  $dfi_catalog, $dfi_catalog->dfi_catalog_id, $query );
		
		$lists['comdir'] = JURI::root().'administrator/components/com_dfi_catalog/assets/';
		
		$lists['gallerydir'] = JURI::root().'images/rokquickcart';
		
		$this->assignRef('lists', $lists);
		$this->assignRef('dfi_catalog', $dfi_catalog);
		$this->assignRef('button', $button);
		$this->assignRef('editor', $editor);
		$this->assignRef('prefix', $model->_prefix);
		
		$component_params = &JComponentHelper::getParams($option);
		$paramfile 	= JPath::clean(JPATH_COMPONENT.'/views/dfi_catalog/params.xml');
		$params = new JParameter(@$dfi_catalog->params, $paramfile);
		$sliders = JPane::getInstance('sliders');
		$this->assignRef('pane', $sliders);
		$this->assignRef('params', $params);

		parent::display($tpl);
	}
}
