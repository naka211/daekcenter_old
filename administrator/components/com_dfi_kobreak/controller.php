<?php
/**
 * @version		$Id: controller.php 3997 2010-04-19 10:27:45 ngo.bieu@mwc.vn $
 * @package		Joomla
 * @subpackage	Dfi_kobreak
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
 * Dfi_kobreaks Dfi_kobreak Controller
 *
 * @package		Joomla
 * @subpackage	Dfi_kobreaks
 * @since 1.5
 */
class Dfi_kobreaksController extends JController
{
	function __construct($config = array())
	{
		parent::__construct($config);

		// Register Extra tasks
		$this->registerTask( 'add',  'display' );
		$this->registerTask( 'edit', 'display' );
		
		//$this->active_checkbox_update();
	}

	function display( )
	{
		switch($this->getTask())
		{
			case 'add'     :
			{
				JRequest::setVar( 'hidemainmenu', 1 );
				JRequest::setVar( 'layout', 'form'  );
				JRequest::setVar( 'view'  , 'dfi_kobreak');
				JRequest::setVar( 'edit', false );
			} break;
			case 'edit'    :
			{
				JRequest::setVar( 'hidemainmenu', 1 );
				JRequest::setVar( 'layout', 'form'  );
				JRequest::setVar( 'view'  , 'dfi_kobreak');
				JRequest::setVar( 'edit', true );
			} break;
		}

		parent::display();
	}
	
	/*function active_checkbox()
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
	*/
	
	function sendkobreak()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

        $cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
		JArrayHelper::toInteger($cid);

        //LDC 20111128 check kobeark has export excel and send email
        $check = $this->check_kobeark($cid[0]);
        
        if(count($check)){
            $msg = JText::_('Please export excel file and send email for Leverandør');
            $link = 'index.php?option=com_dfi_kobreak&view=dfi_kobreak&task=edit&cid[]='.$cid[0];
            $this->setRedirect($link, $msg);
        }
        else{
            if (count( $cid ) < 1) {
			     JError::raiseError(500, JText::_( 'Select an item to send' ) );
    		}	
            
            //LDC Update status
            $model = $this->getModel('dfi_kobreak');
            $model->update_status($cid, 3);
    
    		// Build e-mail message format
    		global $mainframe;
    		$mailer =& JFactory::getMailer();
    		$mailer->IsHTML(true);
    		$mailer->setSender(array($mainframe->getCfg('mailfrom'), $mainframe->getCfg('fromname')));
           
    		// Add recipients
    		$db = &JFactory::getDBO();
    		include_once 'components/com_dfi_kobreak/tables/dfi_kobreak.php';
    		$k = new TableDfi_kobreak($db);
    		$k->load($cid[0]);
    		include_once 'components/com_dfi_supplier/tables/dfi_supplier.php';
    		$s = new TableDfi_supplier($db);
    		$s->load($k->dfi_supplier_id);
    		$mailer->addRecipient($s->email);
    		
    		$kobeark_email =& $this->getModel('kobeark_email');

    		$mailer->setSubject( $kobeark_email->subject($cid[0]) );
    		
    		$header_message = '<table border="0" cellspacing="0" cellpadding="0" width="100%">
              <tr>
                <td><p>Der er en ny ordre. Detaljerne i rækkefølge nedenfor. </p></td>
              </tr>
              <tr>
                <td><h3>Ordrebekræftelse</h3></td>
              </tr>
            </table>';
    		$message_body = $kobeark_email->body($cid[0]);	

    		$mailer->setBody($header_message.$message_body);
    	
    		// Send the Mail
    		$rs	= $mailer->Send();
    		
    		// Check for an error
    		if ( JError::isError($rs) ) {
    			$msg	= $rs->getError();
    		} else {
    			$kobeark_email->updateStatus($cid[0]);
    			$msg = $rs ? JText::_('E-mail sent to supplier') : JText::_('The mail could not be sent');
    		}
            
    		// Check the table in so it can be edited.... we are done with it anyway
    		$link = 'index.php?option=com_dfi_kobreak';
    		$this->setRedirect($link, $msg);
        }
        
        //LDC End check kobeark

	}

    function check_kobeark($id=null){
        $db =& JFactory::getDBO();
        $query = "SELECT * FROM #__dfi_kobreaks WHERE dfi_kobreak_id='".$id."' AND check_ok = '0'";
		$db->setQuery($query);
		return $db->loadObjectList();
    }
    
	function change_campaign()
	{
		global $mainframe;
		$option = 'com_dfi_kobreak_product';
		$mainframe->setUserState( $option.'dfi_campaign_id', $_REQUEST['dfi_campaign_id']);
		exit;
	}
	
	function change_supplier()
	{
		global $mainframe;
		
		require_once "components/com_dfi_supplier/helpers/dfi_supplier.php";
		echo strip_tags(Dfi_supplierHelper::first_supplier($_REQUEST['dfi_supplier_id']));
		exit;
	}

	function save()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );
		
		$post	= JRequest::get('post');
		
		$model = $this->getModel('dfi_kobreak');
		
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
        #$post[$model->_prefix.'status'] = 2-$post[$model->_prefix.'status'];
		$post[$model->_prefix.'status'] = $post[$model->_prefix.'status'];
		$post[$model->_prefix.'description'] = JRequest::getVar( $model->_prefix.'description', '', 'post', 'string', JREQUEST_ALLOWRAW );
				
		// key
		$cid	= JRequest::getVar( 'cid', array(0), 'post', 'array' );
		$post[$model->_prefix.'dfi_kobreak_id'] = (int) $cid[0];

		if ($model->store($post)) {
			$msg = JText::_( strtoupper('Dfi_kobreak Saved') );
			
						
			require_once "components/com_dfi_kobreak_product/helpers/dfi_kobreak_product_active_checkbox.php";
			Dfi_kobreak_product_active_checkboxHelper::store($model->_id);
		} else {
			$msg = JText::_( strtoupper('Error Saving Dfi_kobreak') );
		}

		// Check the table in so it can be edited.... we are done with it anyway
		$link = 'index.php?option=com_dfi_kobreak';
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

		$model = $this->getModel('dfi_kobreak');
		if(!$model->delete($cid)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}

		$this->setRedirect( 'index.php?option=com_dfi_kobreak' );
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

		$model = $this->getModel('dfi_kobreak');
		if(!$model->duplicate($cid)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}

		$this->setRedirect( 'index.php?option=com_dfi_kobreak' );
	}
	
	function publish()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
		JArrayHelper::toInteger($cid);

		if (count( $cid ) < 1) {
			JError::raiseError(500, JText::_( 'Select an item to publish' ) );
		}

		$model = $this->getModel('dfi_kobreak');
		if(!$model->publish($cid, 1)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}

		$this->setRedirect( 'index.php?option=com_dfi_kobreak' );
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

		$model = $this->getModel('dfi_kobreak');
		if(!$model->publish($cid, 0)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}

		$this->setRedirect( 'index.php?option=com_dfi_kobreak' );
	}
	
	function orderup()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$model = $this->getModel('dfi_kobreak');
		$model->move(-1);

		$this->setRedirect( 'index.php?option=com_dfi_kobreak');
	}

	function orderdown()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$model = $this->getModel('dfi_kobreak');
		$model->move(1);

		$this->setRedirect( 'index.php?option=com_dfi_kobreak');
	}

	function saveorder()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$cid 	= JRequest::getVar( 'cid', array(), 'post', 'array' );
		$order 	= JRequest::getVar( 'order', array(), 'post', 'array' );
		JArrayHelper::toInteger($cid);
		JArrayHelper::toInteger($order);

		$model = $this->getModel('dfi_kobreak');
		$model->saveorder($cid, $order);

		$msg = JText::_( 'New ordering saved' );
		$this->setRedirect( 'index.php?option=com_dfi_kobreak', $msg );
	}

	function cancel()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$this->setRedirect( 'index.php?option=com_dfi_kobreak' );
	}
}