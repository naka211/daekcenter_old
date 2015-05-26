<?php
/**
* @version		$Id: view.html.php 10970 2009-12-31 16:31:24 ngo.bieu@mwc.vn $
* @package		Joomla
* @subpackage	Dfi_maps
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
require_once "components/com_dfi_shop/helpers/dfi_shop.php"; 
jimport( 'joomla.application.component.view');
jimport('joomla.html.pane');

/**
 * HTML View class for the Dfi_maps component
 *
 * @static
 * @package		Joomla
 * @subpackage	Dfi_maps
 * @since 1.0
 */
class Dfi_mapsViewDfi_map extends JView
{
	function display($tpl = null)
	{
		global $mainframe;

		if($this->getLayout() == 'form') {
			$this->_displayForm($tpl);
			return;
		}

		//get the dfi_map
		$dfi_map =& $this->get('data');

		if ($dfi_map->url) {
			// redirects to url if matching id found
			$mainframe->redirect($dfi_map->url);
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
		
		//JHTML::stylesheet( 'dfi_map.css', 'administrator/components/com_dfi_map/assets/' );
		
		JHTML::_('behavior.calendar');
		JHTML::_('behavior.modal', 'a.modal-button');
		$button = new JObject();
		$button->set('modal', true);
		$button->set('modalname', 'modal-button');
		$button->set('options', "{handler: 'iframe', size: {x: 920, y: 550}}");

		$lists = array();

		//get the dfi_map
		$dfi_map	=& $this->get('data');
		$isNew		= ($dfi_map->dfi_map_id < 1);

		// Edit or Create?
		if ($isNew) {
			// initialise new record
			
		}
		
		// build list of categories
		$lists['catid'] 			= JHTML::_('list.category',  'catid', $option, intval( @$dfi_map->catid ) );
		
		require_once "components/com_dfi_shop/helpers/dfi_shop.php"; 
		$lists['dfi_shop_id'] = Dfi_shopHelper::dropdown($model->_prefix.'dfi_shop_id', $dfi_map->dfi_shop_id, NULL, FALSE);
		
		// helper
		require_once "components/com_dfi_map/helpers/dfi_map.php"; 
		
		// active checkbox
		//require_once "components/com_dfi_map_dfi_map/helpers/dfi_map_dfi_map.php";
		//$json = Dfi_map_dfi_mapHelper::selection($dfi_map->dfi_map_id);
		//$mainframe->setUserState( 'com_dfi_mapselection', $json );
		//if (!$isNew)
		//	$mainframe->setUserState( 'com_dfi_mapfilter_selection', 'S' );
		//else
		//	$mainframe->setUserState( 'com_dfi_mapfilter_selection', '' );
		
		
		
		$lists['comdir'] = JURI::root().'administrator/components/com_dfi_map/assets/';
		
		$lists['gallerydir'] = JURI::root().'images/rokquickcart';
		
		$this->assignRef('lists', $lists);
		$this->assignRef('dfi_map', $dfi_map);
		$this->assignRef('button', $button);
		$this->assignRef('editor', $editor);
		$this->assignRef('prefix', $model->_prefix);
		
		$component_params = &JComponentHelper::getParams($option);
		$paramfile 	= JPath::clean(JPATH_COMPONENT.'/views/dfi_map/params.xml');
		$params = new JParameter(@$dfi_map->params, $paramfile);
		$sliders = JPane::getInstance('sliders');
		$this->assignRef('pane', $sliders);
		$this->assignRef('params', $params);

		parent::display($tpl);
	}
}
