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

jimport( 'joomla.application.component.view');

/**
 * HTML View class for the Dfi_maps component
 *
 * @static
 * @package		Joomla
 * @subpackage	Dfi_maps
 * @since 1.0
 */
class Dfi_mapsViewDfi_position extends JView
{
	function display($tpl = null)
	{
		//JHTML::stylesheet( 'dfi_map.css', 'administrator/components/com_dfi_map/assets/' );
		
		JHTML::_('behavior.calendar');
		JHTML::_('behavior.modal', 'a.modal-button');
		$button = new JObject();
		$button->set('modal', true);
		$button->set('modalname', 'modal-button');
		$button->set('options', "{handler: 'iframe', size: {x: 760, y: 520}}");

		$lists = array();
			
		$lists['comdir'] = JURI::root().'administrator/components/com_dfi_map/assets/';
		
		$lists['gallerydir'] = JURI::root().'images/rokquickcart';
		
		$this->assignRef('lists', $lists);
		$this->assignRef('button', $button);
		
		parent::display($tpl);
	}
}
