<?php
/**
 * @version		$Id: controller.php 25002 2010-09-18 07:07:43 ngo.bieu@mwc.vn $
 * @package		Joomla
 * @subpackage	Dfi_review_product
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
jimport( '3rdparty.json.helper' );

/**
 * Dfi_review_products Dfi_review_product Controller
 *
 * @package		Joomla
 * @subpackage	Dfi_review_products
 * @since 1.5
 */
class Dfi_review_productsController extends JController
{
	function __construct($config = array())
	{
		parent::__construct($config);

		// Register Extra tasks
		$this->registerTask( 'add',  'display' );
		$this->registerTask( 'edit', 'display' );
		
		$this->active_checkbox_update();
	}

	function display( )
	{
		switch($this->getTask())
		{
			case 'add'     :
			{
				JRequest::setVar( 'hidemainmenu', 1 );
				JRequest::setVar( 'layout', 'form'  );
				JRequest::setVar( 'view'  , 'dfi_review_product');
				JRequest::setVar( 'edit', false );
			} break;
			case 'edit'    :
			{
				JRequest::setVar( 'hidemainmenu', 1 );
				JRequest::setVar( 'layout', 'form'  );
				JRequest::setVar( 'view'  , 'dfi_review_product');
				JRequest::setVar( 'edit', true );
			} break;
		}

		parent::display();
	}
	
	function active_checkbox()
	{
		global $mainframe, $option;
		
		echo '<script>window.parent.document.getElementById(\'sbox-window\').close();</script>';
	}
	
	function active_checkbox_update()
	{
		$post = JRequest::get('post');

		$cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
		JArrayHelper::toInteger($cid);
		
		$checkbox_states = JRequest::getVar( 'checkbox_states', array(), 'post', 'array' );
		JArrayHelper::toInteger($checkbox_states);
		
		global $mainframe, $option;
		
		$checkbox_id = $mainframe->getUserStateFromRequest( $option.'checkbox_id',		'checkbox_id',		0,				'int' );		
		$checkbox_values = $mainframe->getUserState( $option.$checkbox_id.'checkbox_values', array());
				
		foreach ($checkbox_states as $id)
		{
			$checkbox_values[$id]['checkbox_state'] = in_array($id, $cid);
		}
		
		$mainframe->setUserState( $option.$checkbox_id.'checkbox_values', $checkbox_values);
	}

	function save()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );
		
		$post	= JRequest::get('post');
		
		$model = $this->getModel('dfi_review_product');
		
		/*$params = JRequest::getVar( 'params', null, 'post', 'array' );		
		// Build parameter INI string
		if (is_array($params))
		{
			$txt = array ();
			foreach ($params as $k => $v) {
				$txt[] = "$k=$v";
			}
			$post[$model->_prefix.'params'] = implode("\n", $txt);
		}*/
		
		// editor text
		
				
		// key
		$cid	= JRequest::getVar( 'cid', array(0), 'post', 'array' );
		$post[$model->_prefix.'dfi_review_product_id'] = (int) $cid[0];

		if ($model->store($post)) {
			$msg = JText::_( strtoupper('Dfi_review_product Saved') );
			
						
			//require_once "components/com_dfi_review_product_/helpers/dfi_review_product__active_checkbox.php";
			//Dfi_review_product__active_checkboxHelper::store($model->_id);
		} else {
			$msg = JText::_( strtoupper('Error Saving Dfi_review_product') );
		}

		// Check the table in so it can be edited.... we are done with it anyway
		$link = 'index.php?option=com_dfi_review_product';
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

		$model = $this->getModel('dfi_review_product');
		if(!$model->delete($cid)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}

		$this->setRedirect( 'index.php?option=com_dfi_review_product' );
	}
	
	function duplicate()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
		JArrayHelper::toInteger($cid);

		if (count( $cid ) < 1) {
			JError::raiseError(500, JText::_( 'Select an item to duplicate' ) );
		}

		$model = $this->getModel('dfi_review_product');
		if(!$model->duplicate($cid)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}

		$this->setRedirect( 'index.php?option=com_dfi_review_product' );
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

		$model = $this->getModel('dfi_review_product');
		if(!$model->publish($cid, 1)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}

		$this->setRedirect( 'index.php?option=com_dfi_review_product' );
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

		$model = $this->getModel('dfi_review_product');
		if(!$model->publish($cid, 0)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}

		$this->setRedirect( 'index.php?option=com_dfi_review_product' );
	}
	
	function orderup()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$model = $this->getModel('dfi_review_product');
		$model->move(-1);

		$this->setRedirect( 'index.php?option=com_dfi_review_product');
	}

	function orderdown()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$model = $this->getModel('dfi_review_product');
		$model->move(1);

		$this->setRedirect( 'index.php?option=com_dfi_review_product');
	}

	function saveorder()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$cid 	= JRequest::getVar( 'cid', array(), 'post', 'array' );
		$order 	= JRequest::getVar( 'order', array(), 'post', 'array' );
		JArrayHelper::toInteger($cid);
		JArrayHelper::toInteger($order);

		$model = $this->getModel('dfi_review_product');
		$model->saveorder($cid, $order);

		$msg = JText::_( 'New ordering saved' );
		$this->setRedirect( 'index.php?option=com_dfi_review_product', $msg );
	}*/

	function cancel()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$this->setRedirect( 'index.php?option=com_dfi_review_product' );
	}
}