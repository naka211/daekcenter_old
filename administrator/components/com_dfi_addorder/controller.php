<?php
/**
 * @version		$Id: controller.php 31085 2010-06-15 17:00:45 ngo.bieu@mwc.vn $
 * @package		Joomla
 * @subpackage	Dfi_distribution_rate
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
 * Dfi_distribution_rates Dfi_distribution_rate Controller
 *
 * @package		Joomla
 * @subpackage	Dfi_distribution_rates
 * @since 1.5
 */
class Dfi_addorderController extends JController
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
				JRequest::setVar( 'view'  , 'dfi_addorder');
				JRequest::setVar( 'edit', false );
			} break;
			case 'edit'    :
			{
				JRequest::setVar( 'hidemainmenu', 1 );
				JRequest::setVar( 'layout', 'form'  );
				JRequest::setVar( 'view'  , 'dfi_addorder');
				JRequest::setVar( 'edit', true );
			} break;
		}

		parent::display();
	}
	
	function active_checkbox()
	{
		global $mainframe, $option;
        
        $data = array();

        $cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
        $quantity = JRequest::getVar( 'quantity', array(), 'post', 'array' );
        $checkbox_states = JRequest::getVar( 'checkbox_states', array(), 'post', 'array' );
        
        $filter_dfi_kobreak_id = $mainframe->getUserStateFromRequest( $option.'filter_dfi_kobreak_id','filter_dfi_kobreak_id',0,'int' );
        $shop_id = $mainframe->getUserStateFromRequest( $option.'checkbox_id','checkbox_id',0,'int' );
        
        $data['dfi_shop_id'] = $shop_id;
        $data['dfi_kobreak_id'] = $filter_dfi_kobreak_id;
        $data['note'] = "";
        $data['dfi_order_status_id'] = 1;
        
        $orderid = $this->save_order($data);
        //Create and save order
        $data['dfi_order_id'] = $orderid;
        
        for($i=0;$i<count($cid);$i++){
            
            $data['dfi_product_id'] = $cid[$i];
            
            for($j=0;$j<count($checkbox_states);$j++){
                if($cid[$i] == $checkbox_states[$j]){
                    $data['quantity'] = $quantity[$j];
                }
            }
                        
            //Save order product           
            $this->save_order_products($data);        
        }
      
		echo '<script>window.parent.document.getElementById(\'sbox-window\').close();</script>';
	}
    function save_order($data=null){
        $db =& JFactory::getDBO();
        $query = "INSERT INTO #__dfi_orders SET ";
        $query .= "dfi_shop_id = '" . $data['dfi_shop_id'] . "', dfi_kobreak_id = '" . $data['dfi_kobreak_id'] . "',
        note = '" . $data['note'] . "', dfi_order_status_id = '" . $data['dfi_order_status_id'] . "'";
		
        $db->setQuery($query);		
        $db->query();
        
        return $db->insertid();
    }
    function save_order_products($data=null){
        $db =& JFactory::getDBO();
        $query = "INSERT INTO #__dfi_order_products SET ";
        $query .= "dfi_order_id = '" . $data['dfi_order_id'] . "', dfi_product_id = '" . $data['dfi_product_id'] . "',
        quantity = '" . $data['quantity'] . "'";
		
        $db->setQuery($query);		
        $db->query();
        
        return true;
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
			$checkbox_values[$id]['rate'] = doubleval($post['rate_kobeark']);//doubleval($post['rate_'.$id]);
		}
		
		$mainframe->setUserState( $option.$checkbox_id.'checkbox_values', $checkbox_values);
	}	



	function cancel()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$this->setRedirect( 'index.php?option=com_dfi_addorder' );
	}
}