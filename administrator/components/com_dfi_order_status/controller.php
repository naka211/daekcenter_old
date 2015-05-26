<?php
/**
 * @version		$Id: controller.php 13589 2009-12-31 13:42:24 ngo.bieu@mwc.vn $
 * @package		Joomla
 * @subpackage	Dfi_order_status
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

jimport( 'joomla.application.component.controller' );

/**
 * Dfi_order_statuss Dfi_order_status Controller
 *
 * @package		Joomla
 * @subpackage	Dfi_order_statuss
 * @since 1.5
 */
class Dfi_order_statussController extends JController
{
	function __construct($config = array())
	{
		parent::__construct($config);

		// Register Extra tasks
		$this->registerTask( 'add',  'display' );
		$this->registerTask( 'edit', 'display' );
	}

	function display( )
	{
		switch($this->getTask())
		{
			case 'add'     :
			{
				JRequest::setVar( 'hidemainmenu', 1 );
				JRequest::setVar( 'layout', 'form'  );
				JRequest::setVar( 'view'  , 'dfi_order_status');
				JRequest::setVar( 'edit', false );
			} break;
			case 'edit'    :
			{
				JRequest::setVar( 'hidemainmenu', 1 );
				JRequest::setVar( 'layout', 'form'  );
				JRequest::setVar( 'view'  , 'dfi_order_status');
				JRequest::setVar( 'edit', true );
			} break;
		}

		parent::display();
	}
	
	function assign()
	{
		global $mainframe, $option;
		
		$mainframe->getUserStateFromRequest( $option.'selection', 'selection', '{}', 'string'  );
		echo '<script>window.parent.document.getElementById(\'sbox-window\').close();</script>';
	}

	function save()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );
		
		$post	= JRequest::get('post');
		
		$model = $this->getModel('dfi_order_status');
		
		/*$params = JRequest::getVar( 'params', null, 'post', 'array' );		
		// Build parameter INI string
		if (is_array($params))
		{
			$txt = array ();
			foreach ($params as $k => $v) {
				$post[$k] = $v;
			}
		}*/
		
		// editor text
		
				
		// key
		$cid	= JRequest::getVar( 'cid', array(0), 'post', 'array' );
		$post[$model->_prefix.'dfi_order_status_id'] = (int) $cid[0];

		if ($model->store($post)) {
			$msg = JText::_( strtoupper('Dfi_order_status Saved') );
			
			
			
			//global $mainframe;
			//require_once "components/com_dfi_order_status_dfi_order_status/helpers/dfi_order_status_dfi_order_status.php";
			//Dfi_order_status_dfi_order_statusHelper::storeSelection('com_dfi_order_status', $model->_id);
		} else {
			$msg = JText::_( strtoupper('Error Saving Dfi_order_status') );
		}

		// Check the table in so it can be edited.... we are done with it anyway
		$link = 'index.php?option=com_dfi_order_status';
		$this->setRedirect($link, $msg);
	}

	function remove()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
		JArrayHelper::toInteger($cid);

		if (count( $cid ) < 1) {
			JError::raiseError(500, JText::_( 'Select an item to delete' ) );
		}

		$model = $this->getModel('dfi_order_status');
		if(!$model->delete($cid)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}

		$this->setRedirect( 'index.php?option=com_dfi_order_status' );
	}
	
	/*function publish()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
		JArrayHelper::toInteger($cid);

		if (count( $cid ) < 1) {
			JError::raiseError(500, JText::_( 'Select an item to publish' ) );
		}

		$model = $this->getModel('dfi_order_status');
		if(!$model->publish($cid, 1)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}

		$this->setRedirect( 'index.php?option=com_dfi_order_status' );
	}

	function unpublish()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
		JArrayHelper::toInteger($cid);

		if (count( $cid ) < 1) {
			JError::raiseError(500, JText::_( 'Select an item to unpublish' ) );
		}

		$model = $this->getModel('dfi_order_status');
		if(!$model->publish($cid, 0)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}

		$this->setRedirect( 'index.php?option=com_dfi_order_status' );
	}*/
	
	function orderup()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$model = $this->getModel('dfi_order_status');
		$model->move(-1);

		$this->setRedirect( 'index.php?option=com_dfi_order_status');
	}

	function orderdown()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$model = $this->getModel('dfi_order_status');
		$model->move(1);

		$this->setRedirect( 'index.php?option=com_dfi_order_status');
	}

	function saveorder()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$cid 	= JRequest::getVar( 'cid', array(), 'post', 'array' );
		$order 	= JRequest::getVar( 'order', array(), 'post', 'array' );
		JArrayHelper::toInteger($cid);
		JArrayHelper::toInteger($order);

		$model = $this->getModel('dfi_order_status');
		$model->saveorder($cid, $order);

		$msg = JText::_( 'New ordering saved' );
		$this->setRedirect( 'index.php?option=com_dfi_order_status', $msg );
	}

	function cancel()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$this->setRedirect( 'index.php?option=com_dfi_order_status' );
	}
}