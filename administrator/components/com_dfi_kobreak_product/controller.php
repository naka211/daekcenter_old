<?php
/**
 * @version		$Id: controller.php 11282 2010-04-19 10:27:58 ngo.bieu@mwc.vn $
 * @package		Joomla
 * @subpackage	Dfi_kobreak_product
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
 * Dfi_kobreak_products Dfi_kobreak_product Controller
 *
 * @package		Joomla
 * @subpackage	Dfi_kobreak_products
 * @since 1.5
 */
class Dfi_kobreak_productsController extends JController
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
				JRequest::setVar( 'view'  , 'dfi_kobreak_product');
				JRequest::setVar( 'edit', false );
			} break;
			case 'edit'    :
			{
				JRequest::setVar( 'hidemainmenu', 1 );
				JRequest::setVar( 'layout', 'form'  );
				JRequest::setVar( 'view'  , 'dfi_kobreak_product');
				JRequest::setVar( 'edit', true );
			} break;
		}

		parent::display();
	}
	
	function active_checkbox()
	{
		global $mainframe, $option;
        
        $this->active_checkbox_update();
       
		echo '<script>window.parent.document.getElementById(\'sbox-window\').close();</script>';
	}
	
	function create_product()
	{
		$msg = '';
		$dfi_supplier_id = JRequest::getVar( 'dfi_supplier_id','','post' );
       
		// Check the table in so it can be edited.... we are done with it anyway
		$link = 'index3.php?option=com_dfi_product&view=dfi_product&dfi_supplier_id='.$dfi_supplier_id;
		$this->setRedirect($link, $msg);
	}
    
    /** //LDC Add product to Kobreak*/
    function add_product(){
      
        global $mainframe, $option;
        $data = array();
        $cid = JRequest::getVar( 'cid1', array(), 'post', 'array' );
        $checkbox_id = $mainframe->getUserStateFromRequest( $option.'checkbox_id','checkbox_id',0,'int' );

        $dfi_campaign_id = $mainframe->getUserStateFromRequest( $option.'dfi_campaign_id','dfi_campaign_id',0,'int' );
        
        #print_r($checkbox_id);die;
        $data['dfi_kobreak_id'] = $checkbox_id;
        
        for($i=0;$i<count($cid);$i++){
            $check_pro = $this->check_product($cid[$i],$dfi_campaign_id);
            $data['dfi_product_id'] = $cid[$i];
            
            if(count($check_pro)){
                //Nothing to do, produc have campaign
            }
            else{
                $data['dfi_campaign_id'] = $dfi_campaign_id;
                $temp = $this->inset_campaign_to_products($data);  
            }
            
            $check_pro_1 = $this->check_product_1($cid[$i],$checkbox_id);
           
            if(count($check_pro_1)){
                //Nothing to do, product have kobreak
            }
            else{
                
                $info_pro = $this->get_product($cid[$i]);

                foreach($info_pro as $row){
                    $data['quantity'] = $row->quantity;
                    $data['hvidpris'] = $row->hvidpris;
                    $data['nettopris'] = $row->nettopris;
                    $data['rodpris'] = $row->rodpris;
                    $data['nupris'] = $row->nupris;
                }
                
                $temp = $this->inset_product_kobreak($data); 
                
            }
            
        }
        
        echo '<script>window.parent.document.getElementById(\'sbox-window\').close();</script>';
    }
    
    function inset_campaign_to_products($data){
        $db =& JFactory::getDBO();
        $query = "INSERT INTO #__dfi_campaign_to_products SET ";
        $query .= "dfi_product_id = '" . $data['dfi_product_id'] . "', dfi_campaign_id = '" . $data['dfi_campaign_id'] . "'";
        
    				
        $db->setQuery($query);		
        $db->query();
        
        return true;
    }
    
    function check_product($dfi_product_id,$dfi_campaign_id){
        $db =& JFactory::getDBO();
        $query = "SELECT * FROM #__dfi_campaign_to_products WHERE dfi_product_id='".$dfi_product_id."' AND dfi_campaign_id = '".$dfi_campaign_id."'";
		$db->setQuery($query);
		return $db->loadObjectList();  
    }
    
    function check_product_1($dfi_product_id,$dfi_kobreak_id){
        $db =& JFactory::getDBO();
        $query = "SELECT * FROM #__dfi_kobreak_products WHERE dfi_product_id='".$dfi_product_id."' AND dfi_kobreak_id = '".$dfi_kobreak_id."'";
		$db->setQuery($query);
		return $db->loadObjectList();  
    }
    
    function get_product($dfi_product_id){
        $db =& JFactory::getDBO();
        $query = "SELECT * FROM #__dfi_products WHERE dfi_product_id='".$dfi_product_id."'";
		$db->setQuery($query);
		return $db->loadObjectList();  
    }
    function inset_product_kobreak($data){
        $db =& JFactory::getDBO();
        $query = "INSERT INTO #__dfi_kobreak_products SET ";
        $query .= "dfi_product_id = '" . $data['dfi_product_id'] . "', dfi_kobreak_id = '" . $data['dfi_kobreak_id'] . "', 
        quantity = '" . $data['quantity'] . "',hvidpris = '" . $data['hvidpris'] . "', 
        nettopris = '" . $data['nettopris'] . "', rodpris = '" . $data['rodpris'] . "',
        nupris = '" . $data['nupris'] . "'";
        
    				
        $db->setQuery($query);		
        $db->query();
        
        return true;
    }
    
    /** END LDC Add product to Kobreak*/
    function add_kampagne()
	{
		$msg = '';
		$dfi_product_id = JRequest::getVar( 'dfi_product_id','','post' );
		// Check the table in so it can be edited.... we are done with it anyway
		//$link = 'index3.php?option=com_dfi_product&view=dfi_add_kampagne&dfi_product_id='.$dfi_product_id;
        $link = 'index3.php?option=com_dfi_product&view=dfi_product&task=edit&cid[]='.$dfi_product_id.'&add=1';
        
        
		$this->setRedirect($link, $msg);
	}
	
	function active_checkbox_update()
	{
		$post = JRequest::get('post');
        /*
        echo "<pre>";
        print_r($post);die;
        */
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
            
            $this->update_package($post['id_'.$id],$post['package_'.$id]);
           
			$checkbox_values[$id]['quantity'] = intval($post['quantity_'.$id]);
			$checkbox_values[$id]['hvidpris'] = ws_comma_to_dot($post['hvidpris_'.$id]);
			$checkbox_values[$id]['nettopris'] = ws_comma_to_dot($post['nettopris_'.$id]);
			$checkbox_values[$id]['rodpris'] = ws_comma_to_dot($post['rodpris_'.$id]);
			$checkbox_values[$id]['nupris'] = ws_comma_to_dot($post['nupris_'.$id]);
		}
		
        //LDC Update dfi_kobreak_products 20111125
        foreach ($checkbox_values as $row){
            
            $this->update_jos_dfi_kobreak_products($row);
        }
        
		$mainframe->setUserState( $option.$checkbox_id.'checkbox_values', $checkbox_values);
        
        /** LDC Xoa**/
        $db_1		=& JFactory::getDBO();
        $temp = $post['dfi_campaign_to_product_id'];
        
        for($i=0; $i<count($temp);$i++){        
            $query_1 = 'DELETE FROM #__dfi_campaign_to_products'
    				. ' WHERE dfi_campaign_to_product_id = '.$temp[$i] ; 
            $db_1->setQuery($query_1);		
            $db_1->query();
        }
        /** LDC Xoa**/
        
	}
    //LDC Update dfi_kobreak_products 20111125
    function update_jos_dfi_kobreak_products($row){
        $db =& JFactory::getDBO();
        $query = "UPDATE #__dfi_kobreak_products SET quantity='".$row['quantity']."', 
                hvidpris='".$row['hvidpris']."', 
                nettopris='".$row['nettopris']."', 
                rodpris='".$row['rodpris']."', 
                nupris='".$row['nupris']."' 
                WHERE dfi_kobreak_product_id='".$row['dfi_kobreak_product_id']."'";
		$db->setQuery($query);
		$db->query();
    }
	//LDC End Update dfi_kobreak_products 20111125
    function update_package($id, $package){
        $db =& JFactory::getDBO();
        $query = "UPDATE #__dfi_products SET package_quantity='".$package."' WHERE dfi_product_id='".$id."'";
		$db->setQuery($query);
		$db->query();
    }

	function save()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );
        
		$post	= JRequest::get('post');
		
		$model = $this->getModel('dfi_kobreak_product');
		
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
		$post[$model->_prefix.'dfi_kobreak_product_id'] = (int) $cid[0];

		if ($model->store($post)) {
			$msg = JText::_( strtoupper('Dfi_kobreak_product Saved') );
			
						
			//require_once "components/com_dfi_kobreak_product_/helpers/dfi_kobreak_product__active_checkbox.php";
			//Dfi_kobreak_product__active_checkboxHelper::store($model->_id);
		} else {
			$msg = JText::_( strtoupper('Error Saving Dfi_kobreak_product') );
		}

		// Check the table in so it can be edited.... we are done with it anyway
		$link = 'index.php?option=com_dfi_kobreak_product';
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

		$model = $this->getModel('dfi_kobreak_product');
		if(!$model->delete($cid)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}

		$this->setRedirect( 'index.php?option=com_dfi_kobreak_product' );
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

		$model = $this->getModel('dfi_kobreak_product');
		if(!$model->duplicate($cid)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}

		$this->setRedirect( 'index.php?option=com_dfi_kobreak_product' );
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

		$model = $this->getModel('dfi_kobreak_product');
		if(!$model->publish($cid, 1)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}

		$this->setRedirect( 'index.php?option=com_dfi_kobreak_product' );
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

		$model = $this->getModel('dfi_kobreak_product');
		if(!$model->publish($cid, 0)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}

		$this->setRedirect( 'index.php?option=com_dfi_kobreak_product' );
	}
	
	function orderup()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$model = $this->getModel('dfi_kobreak_product');
		$model->move(-1);

		$this->setRedirect( 'index.php?option=com_dfi_kobreak_product');
	}

	function orderdown()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$model = $this->getModel('dfi_kobreak_product');
		$model->move(1);

		$this->setRedirect( 'index.php?option=com_dfi_kobreak_product');
	}

	function saveorder()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$cid 	= JRequest::getVar( 'cid', array(), 'post', 'array' );
		$order 	= JRequest::getVar( 'order', array(), 'post', 'array' );
		JArrayHelper::toInteger($cid);
		JArrayHelper::toInteger($order);

		$model = $this->getModel('dfi_kobreak_product');
		$model->saveorder($cid, $order);

		$msg = JText::_( 'New ordering saved' );
		$this->setRedirect( 'index.php?option=com_dfi_kobreak_product', $msg );
	}*/

	function cancel()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$this->setRedirect( 'index.php?option=com_dfi_kobreak_product' );
	}
}