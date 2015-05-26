<?php
/**
 * @version		$Id: controller.php 9110 2009-12-31 09:09:04 ngo.bieu@mwc.vn $
 * @package		Joomla
 * @subpackage	Dfi_product
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
 * Dfi_products Dfi_product Controller
 *
 * @package		Joomla
 * @subpackage	Dfi_products
 * @since 1.5
 */
class Dfi_productsController extends JController
{
	
    var $_dfi_supplier_id = "";
    
    function __construct($config = array())
	{
		parent::__construct($config);
        global $mainframe, $option;
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
				JRequest::setVar( 'view'  , 'dfi_product');
				JRequest::setVar( 'edit', false );
			} break;
			case 'edit'    :
			{
				JRequest::setVar( 'hidemainmenu', 1 );
				JRequest::setVar( 'layout', 'form'  );
				JRequest::setVar( 'view'  , 'dfi_product');
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
	
	function active_save()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );
		
		$post	= JRequest::get('post');
		
		$model = $this->getModel('dfi_product');
		
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
		$post[$model->_prefix.'dfi_product_id'] = (int) $cid[0];

		if ($model->store($post)) {
			$msg = JText::_( strtoupper('Dfi_product Saved') );

			require_once "components/com_dfi_kobreak_product/helpers/dfi_kobreak_product_active_checkbox.php";
			Dfi_kobreak_product_active_checkboxHelper::add($model->_id, @$post[$model->_prefix.'campaigns']);

			require_once "components/com_dfi_campaign_to_product/helpers/dfi_campaign_to_product.php";
			Dfi_campaign_to_productHelper::save_campaigns($model->_id, @$post[$model->_prefix.'campaigns']);
		} else {
			$msg = JText::_( strtoupper('Error Saving Dfi_product') );
		}
		
		/*global $mainframe;
		$checkbox_id = $mainframe->getUserStateFromRequest( 'com_dfi_kobreak_productcheckbox_id',		'checkbox_id',		0,				'int' );
		$link = 'index.php?option=com_dfi_kobreak_product&amp;view=active_checkbox&amp;tmpl=component&amp;checkbox_id='.$checkbox_id;
		$this->setRedirect($link);*/
		
		echo '<script>alert(\''.$msg.'\');window.history.go(-2);//window.parent.document.getElementById(\'sbox-window\').close();</script>';
		exit;
	}

	function save()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );
		
		$post	= JRequest::get('post');
        
        //Check trung ean_kode va serial_number
        
        $db2 =& JFactory::getDBO();
        $query2="SELECT * FROM #__dfi_products WHERE ean_kode='".$post['dfi_product_ean_kode']."' OR serial_number = '".$post['dfi_product_serial_number']."'";			
		$db2->setQuery($query2);
		$result = $db2->loadObject();
        
        #print_r($result);die;
        
        if($result && !$post['cid'][0]){
            
            $msg = JText::_( strtoupper("Can't save product. Ean Kode or Vare nummer have used") );
            $link = 'index.php?option=com_dfi_product';
            $this->setRedirect($link, $msg, 'error');
           
        }
        else{
            /** LDC Xoa all**/
            $db_1		=& JFactory::getDBO();
            
            $query_1 = 'DELETE FROM #__dfi_campaign_to_products'
    				. ' WHERE dfi_product_id = '.$post['cid'][0] ;
                    
            $db_1->setQuery($query_1);		
            $db_1->query();
    
            /** LDC Xoa all**/
            
            /*echo '<pre>';
            print_r($post);die;*/
    		
    		$model = $this->getModel('dfi_product');
    		
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
    		$post[$model->_prefix.'dfi_product_id'] = (int) $cid[0];
    
    		if ($model->store($post)) {
    			$msg = JText::_( strtoupper('Dfi_product Saved') );
    			
    			//global $mainframe;
    			require_once "components/com_dfi_campaign_to_product/helpers/dfi_campaign_to_product.php";
    			Dfi_campaign_to_productHelper::save_campaigns($model->_id, @$post[$model->_prefix.'campaigns']);
    		} else {
    			$msg = JText::_( strtoupper('Error Saving Dfi_product') );
    		}
            
            
            $add= JRequest::getVar( 'add','','post' );
            if($add){
           	    echo '<script>alert(\''.$msg.'\');window.history.go(-2);//window.parent.document.getElementById(\'sbox-window\').close();</script>';
                exit;
            }
            
    		// Check the table in so it can be edited.... we are done with it anyway
    		$link = 'index.php?option=com_dfi_product';
    		$this->setRedirect($link, $msg);
        }
        
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

		$model = $this->getModel('dfi_product');
		if(!$model->delete($cid)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}

		$this->setRedirect( 'index.php?option=com_dfi_product' );
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

		$model = $this->getModel('dfi_product');
		if(!$model->publish($cid, 1)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}

		$this->setRedirect( 'index.php?option=com_dfi_product' );
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

		$model = $this->getModel('dfi_product');
		if(!$model->publish($cid, 0)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}

		$this->setRedirect( 'index.php?option=com_dfi_product' );
	}
	
	function orderup()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$model = $this->getModel('dfi_product');
		$model->move(-1);

		$this->setRedirect( 'index.php?option=com_dfi_product');
	}

	function orderdown()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$model = $this->getModel('dfi_product');
		$model->move(1);

		$this->setRedirect( 'index.php?option=com_dfi_product');
	}

	function saveorder()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$cid 	= JRequest::getVar( 'cid', array(), 'post', 'array' );
		$order 	= JRequest::getVar( 'order', array(), 'post', 'array' );
		JArrayHelper::toInteger($cid);
		JArrayHelper::toInteger($order);

		$model = $this->getModel('dfi_product');
		$model->saveorder($cid, $order);

		$msg = JText::_( 'New ordering saved' );
		$this->setRedirect( 'index.php?option=com_dfi_product', $msg );
	}*/

	function cancel()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$this->setRedirect( 'index.php?option=com_dfi_product' );
	}
}