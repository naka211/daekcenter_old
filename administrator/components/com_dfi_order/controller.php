<?php
/**
 * @version		$Id: controller.php 7753 2010-01-04 11:15:08 ngo.bieu@mwc.vn $
 * @package		Joomla
 * @subpackage	Dfi_order
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
 * Dfi_orders Dfi_order Controller
 *
 * @package		Joomla
 * @subpackage	Dfi_orders
 * @since 1.5
 */
class Dfi_ordersController extends JController
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
				JRequest::setVar( 'view'  , 'dfi_order');
				JRequest::setVar( 'edit', false );
			} break;
			case 'edit'    :
			{
				JRequest::setVar( 'hidemainmenu', 1 );
				JRequest::setVar( 'layout', 'form'  );
				JRequest::setVar( 'view'  , 'dfi_order');
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
		
		$model = $this->getModel('dfi_order');
		
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
		$post[$model->_prefix.'note'] = JRequest::getVar( $model->_prefix.'note', '', 'post', 'string', JREQUEST_ALLOWRAW );
				
		// key
		$cid	= JRequest::getVar( 'cid', array(0), 'post', 'array' );
		$post[$model->_prefix.'dfi_order_id'] = (int) $cid[0];

		if ($model->store($post)) {
			$msg = JText::_( strtoupper('Dfi_order Saved') );
			
			
			
			//global $mainframe;
			require_once "components/com_dfi_order_product/helpers/dfi_order_product_active_checkbox.php";
			Dfi_order_product_active_checkboxHelper::store($model->_id);
		} else {
			$msg = JText::_( strtoupper('Error Saving Dfi_order') );
		}

		// Check the table in so it can be edited.... we are done with it anyway
		$link = 'index.php?option=com_dfi_order';
		$this->setRedirect($link, $msg);
	}
    
    function save_edit(){

        $max = JRequest::getVar( 'max','','post' );
        $pro_id = JRequest::getVar( 'pro_id','','post' );
        $order_id = JRequest::getVar( 'order_id','','post' );
        $product_quantity = JRequest::getVar( 'product_quantity','','post' );
        $check_id = JRequest::getVar( 'checkbox_id','','post' );

        
        $db =& JFactory::getDBO();
        
        $query="SELECT * FROM #__dfi_orders WHERE dfi_kobreak_id='".$check_id."'";			
		$db->setQuery($query);
		$result = $db->loadObject();
        
        for($i=0;$i<=$max;$i++){
            for($j=0;$j<count($pro_id[$i]);$j++){
                if($product_quantity[$i][$j]){
                    $query="UPDATE #__dfi_order_products SET quantity ='".$product_quantity[$i][$j]."' WHERE dfi_order_id='".$order_id[$i][$j]."' AND dfi_product_id='".$pro_id[$i][$j]."'";			
            		$db->setQuery($query);		
                    $db->query();
                }
            }
        }
        
       	echo '<script>window.parent.document.getElementById(\'sbox-window\').close();</script>';
        
    }
    /** //LDC Function export and send EXCEL **/
    
    function info_supplier($supplier_id=null){
        $db = &JFactory::getDBO(); 
        $query = "SELECT * FROM #__dfi_suppliers WHERE dfi_supplier_id = ".$supplier_id;

        $db->setQuery($query);
		$info =  $db->loadObjectList();
        return $info;
    }
    function info_kobreaks($checkbox_id=null){
        $db = &JFactory::getDBO(); 
        $query = "SELECT * FROM #__dfi_kobreaks WHERE dfi_kobreak_id = ".$checkbox_id;

        $db->setQuery($query);
		$info =  $db->loadObjectList();
        return $info;
    }
    
    function export(){

        $checkbox_id = JRequest::getVar( 'checkbox_id','','post' );
        $supplier_id = JRequest::getVar( 'supplier_id','','post' );
        $campaign_id = JRequest::getVar( 'campaign_id','','post' );

        $data = $this->getData_excel_send($checkbox_id);
        $info_supplier = $this->info_supplier($supplier_id);
        $info_kobreaks = $this->info_kobreaks($checkbox_id);
      
        if(sizeof($data)>0){
            
            $html = '<table border="1" style="height:auto;">' ;

            $html .= '<tr>' ;
            $html .= '<td colspan="10" style="width:400px; height:40px; vertical-align:middle; text-align:left;text-transform: uppercase;font-size:25px;font-weight:bold;">' ;
        	$html .= 'DIN ISENKRÆMMER' ;
        	$html .= '</td>' ;
            $html .= '</tr>' ;
            
            $html .= '<tr>' ;
            $html .= '<td colspan="5" style="width:400px; height:40px; vertical-align:middle; text-align:left;font-size:20px;">' ;
        	$html .= 'KAMPAGNE NR.' ;
        	$html .= '</td>' ;
            $html .= '<td colspan="5" style="width:400px; height:40px; vertical-align:middle; text-align:left;font-size:20px;">' ;
        	$html .= $checkbox_id ;
        	$html .= '</td>' ;
            $html .= '</tr>' ;
            
            $html .= '<tr>' ;
            $html .= '<td colspan="5" style="vertical-align:middle; text-align:left;font-size:14px;">' ;
        	$html .= 'LEVERANDØR: '.$info_supplier[0]->name;
        	$html .= '</td>' ;
            $html .= '<td colspan="5" style="vertical-align:middle; text-align:left;font-size:14px;">' ;
        	$html .= 'KONTAKT VEDR. DENNE ORDRE: Jesper Christoffersen';
        	$html .= '</td>' ;
            $html .= '</tr>' ;
            
            $html .= '<tr>' ;
            $html .= '<td colspan="5" style="vertical-align:middle; text-align:left;font-size:14px;">' ;
        	$html .= 'TELEFON: '.$info_supplier[0]->telephone;
        	$html .= '</td>' ;
            $html .= '<td colspan="5" style="vertical-align:middle; text-align:left;font-size:14px;">' ;
        	$html .= 'TELEFON: 28 88 08 08';
        	$html .= '</td>' ;
            $html .= '</tr>' ;
            
            $html .= '<tr>' ;
            $html .= '<td colspan="5" style="vertical-align:middle; text-align:left;font-size:14px;">' ;
        	$html .= 'FAX: '.$info_supplier[0]->fax;
        	$html .= '</td>' ;        
            $html .= '<td colspan="5" style="vertical-align:middle; text-align:left;font-size:14px;">' ;
        	$html .= 'FAX: ';
        	$html .= '</td>' ;
            $html .= '</tr>' ;
            
            $html .= '<tr>' ;
            $html .= '<td colspan="5" style="vertical-align:middle; text-align:left;font-size:14px;">' ;
        	$html .= 'KONTAKT: '.$info_supplier[0]->contact_1;
        	$html .= '</td>' ;        
            $html .= '<td colspan="5" style="vertical-align:middle; text-align:left;font-size:14px;">' ;
        	$html .= 'MAIL: jesper@dinisenkraemmer.dk';
        	$html .= '</td>' ;
            $html .= '</tr>' ;
            
            $html .= '<tr>' ;
            $html .= '<td colspan="5" style="vertical-align:middle; text-align:left;font-size:14px;">' ;
        	$html .= 'MAIL: '.$info_supplier[0]->email;
        	$html .= '</td>' ;        
            $html .= '<td colspan="5" style="vertical-align:middle; text-align:left;font-size:14px;">' ;
        	$html .= '&nbsp;';
        	$html .= '</td>' ;
            $html .= '</tr>' ;
            
            $html .= '<tr>' ;
            $html .= '<td colspan="2" style="vertical-align:middle; text-align:left;font-size:14px;">' ;
        	$html .= 'LEV UGE:' ;
        	$html .= '</td>' ;
            $html .= '<td colspan="3" style="vertical-align:middle; text-align:left;font-size:14px;">' ;
        	$html .= $info_kobreaks[0]->lev_uge;
        	$html .= '</td>' ;        
            $html .= '<td colspan="3" style="vertical-align:middle; text-align:left;font-size:14px;">' ;
        	$html .= 'BET. BETINGELSE: '.$info_kobreaks[0]->lev_betingelse;
        	$html .= '</td>' ;
            $html .= '<td colspan="2" rowspan="2" style="vertical-align:middle; text-align:center;font-size:14px;">' ;
        	$html .= 'LEVERINGSBETINGELSER' ;
        	$html .= '</td>' ;
            $html .= '</tr>' ;
            
            $html .= '<tr>' ;
            $html .= '<td colspan="2" style="vertical-align:middle; text-align:left;font-size:14px;">' ;
        	$html .= 'VAL. UGE:' ;
        	$html .= '</td>' ;
            $html .= '<td colspan="3" style="vertical-align:middle; text-align:left;font-size:14px;">' ;
        	$html .= $info_kobreaks[0]->val_uge;
        	$html .= '</td>' ;        
            $html .= '<td colspan="3" style="vertical-align:middle; text-align:left;font-size:14px;">' ;
        	$html .= 'ANN. TILSKUD: '.$info_kobreaks[0]->ann_tilskud;
        	$html .= '</td>' ;
            $html .= '</tr>' ;
            
            $html .= '<tr>' ;
            $html .= '<td colspan="10" style="height:20px; vertical-align:middle; text-align:left;font-size:14px;">' ;
        	$html .= 'VAREN MÅ IKKE LEVERES SENERE END DEN AFTELTER UGE UDEN FORUDGAENDE ALTALE MED BUTIKKEN' ;
        	$html .= '</td>' ;
            $html .= '</tr>' ;
            $html .= '<tr>' ;
            $html .= '<td colspan="10" style="height:20px; vertical-align:middle; text-align:left;font-size:14px;">' ;
        	$html .= '&nbsp;' ;
        	$html .= '</td>' ;
            $html .= '</tr>' ;
            
            $html .= "</table>" ;
            //LDC End table info
            $html .= '<table border="1" style="height:auto;">' ;
            $html .= '<tr>' ;
            
        	$html .= '<td style="background:#00CCFF; height:40px; vertical-align:middle; text-align:center">' ;
        	$html .= 'ID' ;
        	$html .= '</td>' ;
            
        	$html .= '<td style="background:#00CCFF; height:40px; vertical-align:middle; text-align:center">' ;
        	$html .= 'EAN-Kode' ;
        	$html .= '</td>' ;
            $html .= '<td style="background:#00CCFF; height:40px; vertical-align:middle; text-align:center">' ;
        	$html .= 'Vare nr.' ;
        	$html .= '</td>' ;
            $html .= '<td style="background:#00CCFF; height:40px; vertical-align:middle; text-align:center">' ;
        	$html .= 'Varenavn' ;
        	$html .= '</td>' ;
            $html .= '<td style="background:#00CCFF; height:40px; vertical-align:middle; text-align:center">' ;
        	$html .= 'Kampagnenettopris' ;
        	$html .= '</td>' ;
            $html .= '<td style="background:#00CCFF; height:40px; vertical-align:middle; text-align:center">' ;
        	$html .= 'WEEE' ;
        	$html .= '</td>' ;
            
            /*
            $html .= '<td style="background:#00CCFF; height:40px; vertical-align:middle; text-align:center">' ;
        	$html .= 'Vejl. Pris' ;
        	$html .= '</td>' ;
            $html .= '<td style="background:#00CCFF; height:40px; vertical-align:middle; text-align:center">' ;
        	$html .= 'Før/efter' ;
        	$html .= '</td>' ;
            $html .= '<td style="background:#00CCFF; height:40px; vertical-align:middle; text-align:center">' ;
        	$html .= 'Nu pris' ;
        	$html .= '</td>' ;
            */
            $products = $details = array();
        	for ($i=0, $n=count( $data ); $i < $n; $i++)
        	{
        		$row   = &$data[$i];
        		$html .= '<td style="background:#00CCFF; height:40px; vertical-align:middle; text-align:center">';
                $html .= $row->company_name.'<br />'; 
        		$html .= 'Group Nordic:  <span style="color:blue;">'.$row->butiksnr.'</span><br />';
        		$html .= $row->telephone;
        		$html .= '</td>';
        		
        		if($row->products)
        		{
        			foreach ($row->products as $j=>$product)
        			{
        				if (!$product->product_quantity) continue;
                        $products[$product->dfi_product_id] = array('name' => $product->product_name,																										
        											'hvidpris' => $product->hvidpris,
                                                    'rodpris' => $product->rodpris,
                                                    'nettopris' => $product->nettopris,
                                                    'nupris' => $product->nupris,
                                                    'wee' => $product->wee,
                                                    'kolli' => $product->package_quantity,
                                                    'ean_kode' => $product->ean_kode,
                                                    'serial_number' => $product->serial_number,
                                                    'dfi_product_id' =>$product->dfi_product_id
        											);
        				$details[$product->dfi_product_id][$i] = $product;
        			}
        		}
        	}
 
            $html .= '<td style="background:#00CCFF; height:40px; vertical-align:middle; text-align:center">' ;
        	$html .= 'Total' ;
        	$html .= '</td>' ;

            $html .= '</tr>' ;

           	$j = 0;$l = 0;$total = 0;$total_price = 0;
        	foreach ($products as $k=>$v){

                $html .= '<tr>' ;
                $html .= '<td>' ;
                $html .= $k ;
                $html .= '</td>' ;
                $html .= '<td>' ;
                $html .= $v['ean_kode'] ;
                $html .= '</td>' ;
                $html .= '<td>' ;
                $html .= $v['serial_number'] ;
                $html .= '</td>' ;
                $html .= '<td>' ;
                $html .= $v['name'] ;
                $html .= '</td>' ;
                $html .= '<td>' ;
                $html .= ws_price_format($v['nettopris']) ;
                $html .= '</td>' ;
                $html .= '<td>' ;
                $html .= ws_price_format($v['wee']) ;
                $html .= '</td>' ;
                /*
                $html .= '<td>' ;
                $html .= ws_price_format($v['hvidpris']) ;
                $html .= '</td>' ;
                $html .= '<td>' ;
                $html .= ws_price_format($v['rodpris']);
                $html .= '</td>' ;
                $html .= '<td>' ;
                $html .= ws_price_format($v['nupris']);
                $html .= '</td>' ;
                */
                $total1 = 0;
                $total_price1 = 0;
                for ($i=0, $n=count( $data ); $i < $n; $i++){
            
                    $row_order = &$this->items[$i];
        
        			$html .= '<td align="left">';
        			if(isset($details[$k][$i])){
        			 
        				$product = $details[$k][$i];
                        
                        $total += $product->product_quantity;
                        $total1 += $product->product_quantity;
                        $total_price += ((float)$product->nettopris + (float)$product->wee ) * (float) $product->product_quantity;
                        $total_price1 += ((float)$product->nettopris + (float)$product->wee ) * (float) $product->product_quantity;
                        
                        $html .= intval($product->product_quantity)."<br />";
                        $html .= ws_price_format(((float)$product->nettopris + (float)$product->wee ) * (float) $product->product_quantity);

                    }
                    else{
        		         $html .= '0';
                    }
                    
        			$html .= '</td>'; 
        		}
                
                $html .= '<td>' ;
                $html .= "Antal: ".$total1."<br />"."Pris: ".ws_price_format($total_price1);
                $html .= '</td>' ;
                
                $html .= '</tr>' ;
            }
            
            $t1 = count( $data );
            $t3 = 6+$t1;
            
            $html .= '<tr>' ;
            $html .= '<td colspan="'.$t3.'">' ;
            $html .= "&nbsp;";
            $html .= '</td>' ;
            
            $html .= '<td>' ;
            $html .= "Antal: ".$total."<br />"."Pris: ".ws_price_format($total_price);
            $html .= '</td>' ;
            
            $html .= '</tr>' ;

            $html .= "</table>" ;
        }    
        
        $filename = 'Order_Confirmation_KobearkID_'.$checkbox_id.'_Date_'.date('d_m_Y',time());
        
        $file_1 = '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        </head>';

        $file_1 .= '<body>'; 
        
        $file_1 .= $html ;
        
        $file_1 .= '</body>'; 
        $file_1 .= '</html>';

        #print_r($file_1);die;
        
        $fp = fopen(JPATH_ROOT.DS."images".DS."excel".DS.$filename.'.xls', 'a+');
        fwrite($fp, $file_1);
        
        fclose($fp);
        
        /** Get info for send email*/
            $db = &JFactory::getDBO();
            //Get email 
            $query = "SELECT * FROM #__dfi_suppliers WHERE dfi_supplier_id = ".$supplier_id;

            $db->setQuery($query);
    		$data_email =  $db->loadObjectList();
        
            //Get Kampagne
            $query = "SELECT * FROM #__dfi_campaigns WHERE dfi_campaign_id = ".$campaign_id;

            $db->setQuery($query);
    		$data_campaign =  $db->loadObjectList();
            
        /** Send email*/
        // Build e-mail message format
            #$email_get = "nguyen.cuong@mwc.vn";
            $email_get = $data_email[0]->email;
            
            $name_kampagne = $data_campaign[0]->name;
            
    		global $mainframe;
    		$mailer =& JFactory::getMailer();
    		$mailer->IsHTML(true);
    		$mailer->setSender(array($mainframe->getCfg('mailfrom'), $mainframe->getCfg('fromname')));
            $mailer->addRecipient($email_get);
    		$mailer->addAttachment(JPATH_ROOT.DS."images".DS."excel".DS.$filename.'.xls');
            
    		$kobeark_email = "Vedhæftet en Ordrebekræftelse";

    		$mailer->setSubject( $kobeark_email );
    		
    		$message_body = '<table border="0" cellspacing="0" cellpadding="0" width="100%">
              <tr>
                <td>
                    <p>
                    Dette er en ordre fra Din Isenkræmmer,<br />
                    Vedrørende Kampagne "'.$name_kampagne.'"
                    </p>
                </td>
              </tr>
              <tr>
                <td><h3>Venlig hilsen <br />
                    Din Isenkræmmer
                    </h3>
                </td>
              </tr>
            </table>';
    		
    		$mailer->setBody($message_body);
    		$rs	= $mailer->Send();
        
        /** End send email*/
        
        /** Update check OK for Kobeark*/
            
            $query="UPDATE #__dfi_kobreaks SET check_ok = 1 WHERE dfi_kobreak_id='".$checkbox_id."'";			
    		$db->setQuery($query);		
            $db->query();
            
        /** Update check OK for Kobeark*/

        echo '<script>window.parent.document.getElementById(\'sbox-window\').close();</script>';

    }
    
    function getData_excel_send($checkbox_id){
        $db =& JFactory::getDBO();
        
        $db1 =& JFactory::getDBO();
        
        $where = 'b.dfi_kobreak_id = '.(int) $checkbox_id;
        
        $query="SELECT b.*,a.name status_name, c.company_name,c.butiksnr ,c.telephone
				FROM #__dfi_shops c
				LEFT JOIN #__dfi_orders b ON c.dfi_shop_id=b.dfi_shop_id AND ".preg_replace('/WHERE/','',$where)."
				LEFT JOIN #__dfi_order_statuses a ON a.dfi_order_status_id=b.dfi_order_status_id ORDER BY c.company_name ASC";

        $db->setQuery($query);
		$data =  $db->loadObjectList();
	
		if ($data)
		{
			foreach ($data as $i=>$row)
			{
				$sql = "SELECT b.*,a.dfi_order_id,a.quantity product_quantity,c.hvidpris product_hvidpris,c.nettopris product_nettopris,c.rodpris product_rodpris,c.nupris product_nupris"
						. " FROM #__dfi_order_products AS a"
						. " LEFT JOIN #__dfi_kobreak_products AS c ON c.dfi_product_id=a.dfi_product_id"
						. " LEFT JOIN #__dfi_products AS b ON a.dfi_product_id=b.dfi_product_id"
						. " WHERE c.dfi_kobreak_id=".$row->dfi_kobreak_id." AND a.dfi_order_id=".$row->dfi_order_id;
				
                $db1->setQuery($sql);
				$data_ = $db1->loadObjectList();

				$row->products = $data_;
				
				$data[$i] = $row;
			}
		}
        
        return $data;
    }
    
    /** Function EXCEL **/
    
    function send_excel(){
        
        $filter_kamp = JRequest::getVar( 'filter_kamp','','post' );
        
        $data = $this->getData_excel($filter_kamp);

        $company_name = array();
        if(count($data) > 0){
			foreach($data[0]->products as $row){
				$company_name[]=array('name' => $row->company_name , 'num' =>$row->butiksnr, 'fax' => $row->fax);
			}
		}

        if(sizeof($data)>0)
        {
            $html = '<table border="1" style="height:auto;">' ;
            $html .= '<tr>' ;
        	$html .= '<td style="background:#00CCFF; height:40px; vertical-align:middle; text-align:center">' ;
        	$html .= 'ID' ;
        	$html .= '</td>' ;
        	$html .= '<td style="background:#00CCFF; height:40px; vertical-align:middle; text-align:center">' ;
        	$html .= 'Købeark' ;
        	$html .= '</td>' ;
        	$html .= '<td style="background:#00CCFF; height:40px; vertical-align:middle; text-align:center">' ;
        	$html .= 'Ean Kode' ;
        	$html .= '</td>' ;
        	$html .= '<td style="background:#00CCFF; height:40px; vertical-align:middle; text-align:center">' ;
        	$html .= 'Vare nr.' ;
        	$html .= '</td>' ;		
        	$html .= '<td style="background:#00CCFF; height:40px; vertical-align:middle; text-align:center">' ;
        	$html .= 'Varenavn' ;
        	$html .= '</td>' ;
        	$html .= '<td style="background:#00CCFF; height:40px; vertical-align:middle; text-align:center">' ;
        	$html .= 'Kollistr' ;
        	$html .= '</td>' ;
        	$html .= '<td style="background:#00CCFF; height:40px; vertical-align:middle; text-align:center">' ;
        	$html .= 'Kampagnenetto pris' ;
        	$html .= '</td>' ;
        	$html .= '<td style="background:#00CCFF; height:40px; vertical-align:middle; text-align:center">' ;
        	$html .= 'Vejl pris' ;
        	$html .= '</td>' ;
        	$html .= '<td style="background:#00CCFF; height:40px; vertical-align:middle; text-align:center">' ;
        	$html .= 'Før/efter' ;
        	$html .= '</td>' ;		
        	$html .= '<td style="background:#00CCFF; height:40px; vertical-align:middle; text-align:center">' ;
        	$html .= 'Nu pris' ;
        	$html .= '</td>' ;

            /** Shop*/
            
            if(count($company_name)>0){
                foreach($company_name as $com){
                    $html .= '<td style="background:#00CCFF; height:40px; vertical-align:middle; text-align:center">' ;
                	$html .= $com['name']." fax: ".$com['fax'];
                	$html .= '</td>' ;
                }
            }	

            /** End Shop */

            $html .= '<td style="background:#00CCFF; height:40px; vertical-align:middle; text-align:center">' ;
        	$html .= 'Total bestilt' ;
        	$html .= '</td>' ;	
        	$html .= '<td style="background:#00CCFF; height:40px; vertical-align:middle; text-align:center">' ;
        	$html .= 'Total kostpris' ;
        	$html .= '</td>' ;
        	$html .= '<td style="background:#00CCFF; height:40px; vertical-align:middle; text-align:center">' ;
        	$html .= 'Total BA%' ;
        	$html .= '</td>' ;

            $html .= '</tr>' ;	

            $i=0;
            
            $Total_kostpris = 0; $SP_ = ''; $BA_ = ''; $BA1_ = '';

            foreach($data as $v) {

            	$html .= '<tr>' ;

            	$html .= '<td style="vertical-align:middle; text-align:left">' ;
            	$html .= $i++ ;
            	$html .= '</td>';
                $html .= '<td style="vertical-align:middle; text-align:left">' ;
            	$html .= $v->k_name ;
            	$html .= '</td>';
                $html .= '<td style="vertical-align:middle; text-align:left">' ;
            	$html .= $v->ean_kode ;
            	$html .= '</td>';
                $html .= '<td style="vertical-align:middle; text-align:left">' ;
            	$html .= $v->serial_number ;
            	$html .= '</td>';
                $html .= '<td style="vertical-align:middle; text-align:left">' ;
            	$html .= $v->product_name ;
            	$html .= '</td>';
                $html .= '<td style="vertical-align:middle; text-align:left">' ;
            	$html .= $v->package_quantity ;
            	$html .= '</td>';
                $html .= '<td style="vertical-align:middle; text-align:left">' ;
            	$html .= ws_price_format($v->nettopris) ;
            	$html .= '</td>';
                $html .= '<td style="vertical-align:middle; text-align:left">' ;
            	$html .= ws_price_format($v->hvidpris) ;
            	$html .= '</td>';
                $html .= '<td style="vertical-align:middle; text-align:left">' ;
            	$html .= ws_price_format($v->rodpris) ;
            	$html .= '</td>';
                $html .= '<td style="vertical-align:middle; text-align:left">' ;
            	$html .= ws_price_format($v->nupris) ;
            	$html .= '</td>';
                
                $total_ordered=0;
                
                foreach($v->products as $r1){
                    
                    $total_ordered += $r1->quantity;
                    
                    $html .= '<td style="vertical-align:middle; text-align:left">' ;
                	$html .= $r1->quantity > 0 ? $r1->quantity : 0 ;
                	$html .= '</td>';

                }
                 
                $html .= '<td style="vertical-align:middle; text-align:left">' ;
            	$html .= $total_ordered ;
            	$html .= '</td>';
                $html .= '<td style="vertical-align:middle; text-align:left">' ;
            	$html .= ws_price_format($v->nettopris*$total_ordered) ;
            	$html .= '</td>';  
                
                $Total_kostpris += ($v->nettopris*$total_ordered);
                $SP = $v->nupris*0.8*$total_ordered?$v->nupris*0.8*$total_ordered:1;
                $SP_ += $SP;
                $BA = $SP - ($v->nettopris*$total_ordered);
                
                $BA_ += $BA;
                
                $BA1 = $BA/$SP*100;
                
                $html .= '<td style="vertical-align:middle; text-align:left">' ;
            	$html .= $BA1 ;
            	$html .= '</td>';  

            	$html .= '</tr>' ;	
             	
            }

            //LDC Dong cuoi
            
        	$html .= '<tr>' ;
        	$html .= '<td></td>' ;
            $html .= '<td></td>' ;
            $html .= '<td></td>' ;
            $html .= '<td></td>' ;
            $html .= '<td></td>' ;
            $html .= '<td></td>' ;
            $html .= '<td></td>' ;
            $html .= '<td></td>' ;
            $html .= '<td></td>' ;
            $html .= '<td></td>' ;
            
            /** Number Shop */
             if(count($company_name)>0){
                foreach($company_name as $com1){
                    $html .= '<td></td>' ;
                }
            }	
        	
            /** End Number Shop*/

        	$html .= '<td style="vertical-align:middle; text-align:left">' ;
        	$html .= '';
        	$html .= '</td>' ;
            
            $html .= '<td style="vertical-align:middle; text-align:left">' ;
            $html .= ws_price_format($Total_kostpris);
            $html .= '</td>' ;
         
            $html .= '<td style="vertical-align:middle; text-align:left">' ;
                if(!$SP_){
                    $SP_ = 1;
                }
                 $BA1_ = $BA_/$SP_*100;
            $html .= ws_price_format($BA1_);
            $html .= '</td>' ;
            
            $html .= '</tr>' ;

            $html .= "</table>" ;  	
        }

        ## Push the report now!
        $filename = 'AJOURMASTER_'.date('d/m/Y',time());
        /*
        header("Content-Disposition: attachment; filename=".$filename.".xls");
        header("Content-Type: application/vnd.ms-excel;");
        */
        
        #header("Content-type: application/octet-stream ; charset=utf-8");
        header("Content-Type: application/vnd.ms-excel;");
        header("Content-Disposition: attachment; filename=".$filename.".xls");

        header("Pragma: no-cache");
        header("Expires: 0");
        header("Lacation: excel.htm?id=yes");
        
        echo '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
        <html xmlns="http://www.w3.org/1999/xhtml">
        <head>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        </head>';

        echo '<body>'; 
       
        echo $html ;
        
        echo '</body>'; 
        echo '</html>'; 

        die;
       	$link = 'index.php?option=com_dfi_order&view=active_checkbox';
		$this->setRedirect($link, $msg);
    }

    function getData_excel($filter_kamp)
	{
		// Lets load the content if it doesn't already exist
		$db =& JFactory::getDBO();
        
        $db1 =& JFactory::getDBO();
        
        $query= 'SELECT s.name as s_name,k.*,p.*,ko.name as k_name FROM #__dfi_products p
				 INNER JOIN #__dfi_kobreak_products k ON k.dfi_product_id = p.dfi_product_id
                 INNER JOIN #__dfi_campaign_to_products ck ON k.dfi_product_id = ck.dfi_product_id
				 INNER JOIN #__dfi_suppliers s ON s.dfi_supplier_id = p.dfi_supplier_id
				 INNER JOIN #__dfi_kobreaks ko ON ko.dfi_kobreak_id = k.dfi_kobreak_id
				 WHERE ck.dfi_campaign_id = '.$filter_kamp.'
                 ORDER BY ko.name
                 ';
		$db->setQuery($query);
		$data =  $db->loadObjectList();

		if ($data)
		{
			foreach ($data as $i => $row)
			{
				$sql = 	'SELECT od.quantity,c.company_name,c.butiksnr,c.fax'
								. ' FROM  #__dfi_shops c ' // editable
								. ' LEFT JOIN #__dfi_orders b ON c.dfi_shop_id=b.dfi_shop_id AND b.dfi_order_status_id > 1 AND b.dfi_kobreak_id ='.$row->dfi_kobreak_id
								. ' LEFT JOIN #__dfi_order_products od ON b.dfi_order_id = od.dfi_order_id'
								. ' AND od.dfi_product_id ='.$row->dfi_product_id ;
						
				$db1->setQuery($sql);
				$data_ = $db1->loadObjectList();
				
				$row->products = $data_;
				
				$data[$i] = $row;
			
			}
		}
	   
		return $data;
        
	}
    
    /** End Function EXCEL **/
    
	function remove()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$cid = JRequest::getVar( 'cid', array(), 'post', 'array' );
		JArrayHelper::toInteger($cid);

		if (count( $cid ) < 1) {
			JError::raiseError(500, JText::_( 'Select an item to delete' ) );
		}

		$model = $this->getModel('dfi_order');
		if(!$model->delete($cid)) {
			echo "<script> alert('".$model->getError(true)."'); window.history.go(-1); </script>\n";
		}

		$this->setRedirect( 'index.php?option=com_dfi_order' );
	}
	


	function cancel()
	{
		// Check for request forgeries
		JRequest::checkToken() or jexit( 'Invalid Token' );

		$this->setRedirect( 'index.php?option=com_dfi_order' );
	}
}