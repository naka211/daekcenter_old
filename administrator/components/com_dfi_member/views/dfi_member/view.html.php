<?php
/**
* @version		$Id: view.html.php 5370 2010-04-22 17:46:06 ngo.bieu@mwc.vn $
* @package		Joomla
* @subpackage	Dfi_members
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
 * HTML View class for the Dfi_members component
 *
 * @static
 * @package		Joomla
 * @subpackage	Dfi_members
 * @since 1.0
 */
class Dfi_membersViewDfi_member extends JView
{
	function display($tpl = null)
	{
		global $mainframe;

		if($this->getLayout() == 'form') {
			$this->_displayForm($tpl);
			return;
		}

		//get the dfi_member
		$dfi_member =& $this->get('data');

		if ($dfi_member->url) {
			// redirects to url if matching id found
			$mainframe->redirect($dfi_member->url);
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
		
		//JHTML::stylesheet( 'dfi_member.css', 'administrator/components/com_dfi_member/assets/' );
		
		JHTML::_('behavior.calendar');
		JHTML::_('behavior.modal', 'a.modal-button');
		$button = new JObject();
		$button->set('modal', true);
		$button->set('modalname', 'modal-button');
		$button->set('options', "{handler: 'iframe', size: {x: 760, y: 520}}");

		$lists = array();

		//get the dfi_member
		$dfi_member	=& $this->get('data');
		$isNew		= ($dfi_member->dfi_member_id < 1);

		// Edit or Create?
		if ($isNew) {
			// initialise new record
			
		}
		
		// build list of categories
		$lists['catid'] 			= JHTML::_('list.category',  'catid', $option, intval( @$dfi_member->catid ) );
		
		// helper
		require_once "components/com_dfi_member/helpers/dfi_member.php";
		
		//require_once "components/com_dfi_member_/helpers/dfi_member__active_checkbox.php";
		//Dfi_member__active_checkboxHelper::load($dfi_member->dfi_member_id);
		
		
		
		$lists['comdir'] = JURI::root(false).'administrator/components/com_dfi_member/assets/';
		
		$lists['gallerydir'] = JURI::root(false).'images/rokquickcart';
		
		$this->assignRef('lists', $lists);
		$this->assignRef('dfi_member', $dfi_member);
		$this->assignRef('button', $button);
		$this->assignRef('editor', $editor);
		$this->assignRef('prefix', $model->_prefix);
		$this->assign('action', $uri->toString());
		
		$paramfile 	= JPath::clean(JPATH_COMPONENT.'/views/dfi_member/params.xml');
		$params = new JParameter(@$dfi_member->params, $paramfile);
		//$params->loadINI(@$dfi_member->params);
		//$params->set('<attr>', '<val>');
		$sliders = JPane::getInstance('sliders');
		$this->assignRef('pane', $sliders);
		$this->assignRef('params', $params);

		parent::display($tpl);
	}
}
