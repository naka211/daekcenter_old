<?php
/**
* @version		$Id: view.html.php 12717 2010-03-28 11:24:25 ngo.bieu@mwc.vn $
* @package		Joomla
* @subpackage	Components
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
 * HTML View class for the Components component
 *
 * @static
 * @package		Joomla
 * @subpackage	Components
 * @since 1.0
 */
class ComponentsViewComponent extends JView
{
	function display($tpl = null)
	{
		global $mainframe;

		if($this->getLayout() == 'form') {
			$this->_displayForm($tpl);
			return;
		}

		//get the component
		$component =& $this->get('data');

		if ($component->url) {
			// redirects to url if matching id found
			$mainframe->redirect($component->url);
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
		
		//JHTML::stylesheet( 'component.css', 'administrator/components/com_component/assets/' );
		
		JHTML::_('behavior.calendar');
		JHTML::_('behavior.modal', 'a.modal-button');
		$button = new JObject();
		$button->set('modal', true);
		$button->set('modalname', 'modal-button');
		$button->set('options', "{handler: 'iframe', size: {x: 760, y: 520}}");

		$lists = array();

		//get the component
		$component	=& $this->get('data');
		$isNew		= ($component->id < 1);

		// Edit or Create?
		if ($isNew) {
			// initialise new record
			$component->parent = $mainframe->getUserStateFromRequest( $option.'filter_parent',		'filter_parent',		0,				'int' );
		}
		
		// build list of categories
		$lists['catid'] 			= JHTML::_('list.category',  'catid', $option, intval( @$component->catid ) );
		
		// helper
		require_once "components/com_component/helpers/component.php"; 
		$lists['parent'] = ComponentHelper::dropdown('parent', $component->parent, array(array('value'=>0, 'text'=>'Root')), false);;
		
		$lists['enabled'] 		= JHTML::_('select.booleanlist',  $model->_prefix.'enabled', 'class="inputbox"', $component->enabled );
		
		$lists['iscore'] 		= JHTML::_('select.booleanlist',  $model->_prefix.'iscore', 'class="inputbox"', $component->iscore );
		
		// active checkbox
		//require_once "components/com_component/helpers/active_checkbox.php";
		
		// build the html select list for ordering
		$query = 'SELECT ordering AS value, name AS text'
			. ' FROM #__components'
			. ' ORDER BY ordering,parent';
		$lists['ordering'] 			= JHTML::_('list.specificordering',  $component, $component->id, $query );

		//clean component data
		JFilterOutput::objectHTMLSafe( $component, ENT_QUOTES, 'params' );
		
		$lists['comdir'] = JURI::root(true).'administrator/components/com_component/assets/';
		
		$lists['gallerydir'] = JURI::root(true).'images/rokquickcart';
		
		$this->assignRef('lists', $lists);
		$this->assignRef('component', $component);
		$this->assignRef('button', $button);
		$this->assignRef('editor', $editor);
		$this->assignRef('prefix', $model->_prefix);
		$this->assign('action', $uri->toString());
		
		$component_params = &JComponentHelper::getParams($option);
		$configfile = $component_params->get($component->option);
		if ($configfile)
			$paramfile = JPath::clean(JPATH_COMPONENT.'/../'.$component->option.'/'.$configfile);
		else
			$paramfile = '';
		if ($option == $component->option && !$paramfile)
			$paramfile 	= JPath::clean(JPATH_COMPONENT.'/component_config.xml');

		//$paramfile 	= JPath::clean(JPATH_COMPONENT.'/views/component/params.xml');
		$params = new JParameter(@$component->params, $paramfile);
		//$params->set('<attr>', '<val>');
		$sliders = JPane::getInstance('sliders');
		$this->assignRef('pane', $sliders);
		$this->assignRef('params', $params);

		parent::display($tpl);
	}
}
