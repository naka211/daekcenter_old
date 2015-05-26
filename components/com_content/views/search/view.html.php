<?php
/**
 * @version		$Id: view.html.php 11398 2009-01-05 20:03:27Z kdevine $
 * @package		Joomla
 * @subpackage	Content
 * @copyright	Copyright (C) 2005 - 2008 Open Source Matters. All rights reserved.
 * @license		GNU/GPL, see LICENSE.php
 * Joomla! is free software. This version may have been modified pursuant to the
 * GNU General Public License, and as distributed it includes or is derivative
 * of works licensed under the GNU General Public License or other free or open
 * source software licenses. See COPYRIGHT.php for copyright notices and
 * details.
 */

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die( 'Restricted access' );

require_once (JPATH_COMPONENT.DS.'view.php');

/**
 * HTML View class for the Content component
 *
 * @package		Joomla
 * @subpackage	Content
 * @since 1.5
 */
class ContentViewSearch extends ContentView
{
	function display($tpl = null)
	{
		$model = $this->getModel();
		$data = $model->getData(JRequest::getVar('keyword'));
		$this->assignRef('data',$data);

		parent::display($tpl);
	}
}
?>
