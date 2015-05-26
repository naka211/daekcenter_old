<?php
defined('_JEXEC') or die('Restrict Access');

jimport('joomla.application.component.model');

class Dfi_kobreaksModelKobeark_email extends JModel
{	
	function subject($id)
	{
		return JText::_('DFI Ordrebekræftelse - '.$id);
	}
	
	function getOrder_items($id)
	{
		$sql = 'SELECT b.*,c.company_name,c.butiksnr'
				. ' FROM #__dfi_orders b' // editable
				. ' LEFT JOIN #__dfi_shops c ON c.dfi_shop_id=b.dfi_shop_id'
				. ' WHERE b.dfi_kobreak_id='.$id." AND b.dfi_order_status_id=2"
		;
		$this->_db->setQuery($sql);
		$data = $this->_db->loadObjectList();

		if ($data)
		{
			foreach ($data as $i=>$row)
			{
				$sql = "SELECT b.*,a.quantity product_quantity,c.hvidpris product_hvidpris,c.nettopris product_nettopris FROM #__dfi_order_products AS a"
								. " LEFT JOIN #__dfi_kobreak_products AS c ON c.dfi_product_id=a.dfi_product_id"
								. " LEFT JOIN #__dfi_products AS b ON a.dfi_product_id=b.dfi_product_id"
								. " WHERE c.dfi_kobreak_id=".$row->dfi_kobreak_id." AND a.dfi_order_id=".$row->dfi_order_id;			
				$this->_db->setQuery($sql);
				$data[$i]->products = $this->_db->loadObjectList();	
			}
		}
		return $data;	
	}
	
	function updateStatus($id)
	{
		$datenow =& JFactory::getDate();
		
		$sql = 'UPDATE #__dfi_orders' // editable
				. ' SET dfi_order_status_id=3,`sent`="'.$datenow->toMySQL().'"'
				. ' WHERE dfi_kobreak_id='.$id." AND dfi_order_status_id=2"
		;
		$this->_db->Execute($sql);
		
		$sql = 'UPDATE #__dfi_kobreaks' // editable
				. ' SET `status`=1'
				. ' WHERE dfi_kobreak_id='.$id
		;
		$this->_db->Execute($sql);
		
		return true;	
	}
	
	function body($id)
	{
		require_once "components/com_dfi_kobreak/tables/dfi_kobreak.php";	
		$kobreak = new TableDfi_kobreak( $this->_db );
		$kobreak->load($id);

		require_once "components/com_dfi_campaign/tables/dfi_campaign.php";	
		$campaign = new TableDfi_campaign( $this->_db );
		$campaign->load($kobreak->dfi_campaign_id);
		
		require_once "components/com_dfi_order/tables/dfi_order.php";
		$order = new TableDfi_order( $this->_db );
		
		$items = "";
		$data = $this->getOrder_items($id);
		if ($data)
			foreach ($data as $i=>$row)
			{
				$p = "";
				if($row->products)
				{
					foreach ($row->products as $i=>$product)
					{
						if (!$product->product_quantity) continue;
						$p .= ($i+1).". ".$product->product_name;
						$p .= '<ul>';
						$p .= '<li>Quantity: '.$product->product_quantity.'</li>';
						$p .= '<li>Nettopris: DKK '.ws_price_format($product->product_nettopris).'</li>';
						$p .= '<li>WEEE: '.$product->wee."</li>";
						//$p .= '<li>Vejl. Pris: DKK '.ws_price_format($product->product_hvidpris).'</li>';
						$p .= '</ul>';
					}
				}		
				$items .= "      <tr>
			<td><p>".$row->company_name.' (Butiksnr. '.$row->butiksnr.')'."</p></td>
			<td><p>".$p."</p></td>
			<td><p>".$row->dfi_order_id."</p></td>
		  </tr>";
			}

		$body =<<< EMAILBODY
<table border="1" cellspacing="0" cellpadding="0" width="100%">
  <tr>
    <td colspan="2"><p><strong>Ordreinformation</strong> </p></td>
  </tr>
  <tr>
    <td><p>Campaign name:</p></td>
    <td><p>{$campaign->name}</p></td>
  </tr>
  <tr>
    <td colspan="2"><p>&nbsp;</p></td>
  </tr>
  <tr>
    <td colspan="2"><p><strong>Kobearkinformation</strong> </p></td>
  </tr>
  <tr>
    <td width="50%" valign="top" colspan="2"><table border="0" cellspacing="0" cellpadding="0" width="100%">
  <tr>
    <td><p>&nbsp;</p></td>
    <td><p><strong>{$kobreak->name}</strong></p></td>
  </tr>
  <tr>
    <td><p>Lev. uge:</p></td>
    <td><p><strong>{$kobreak->lev_uge}</strong></p></td>
  </tr>
  <tr>
    <td><p>Val. uge:</p></td>
    <td><p><strong>{$kobreak->val_uge}</strong></p></td>
  </tr>
  <tr>
    <td><p>Lev. Betingelse:</p></td>
    <td><p><strong>{$kobreak->lev_betingelse}</strong></p></td>
  </tr>
  <tr>
    <td><p>Ann. Tilskud:</p></td>
    <td><p><strong>{$kobreak->ann_tilskud}</strong></p></td>
  </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2"><p>&nbsp;</p></td>
  </tr>
  <tr>
    <td colspan="2"><table border="0" cellspacing="0" cellpadding="0" width="100%">
      <tr>
        <td></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2"><p>&nbsp;</p></td>
  </tr>
  <tr>
    <td colspan="2"><p><strong>Ordrelinier</strong> </p></td>
  </tr>
  
  <tr>
  	<td colspan="2"><p><strong>Received:</strong> {$order->received}</p></td>
  </tr>
  
  <tr>
    <td colspan="2"><table border="1" cellspacing="0" cellpadding="5" width="100%">
      <tr>
        <td><p align="center"><strong>Shop</strong></p></td>
        <td><p align="center"><strong>Products</strong></p></td>
		<td><p align="center"><strong>Order ID</strong></p></td>
      </tr>
      {$items}
    </table></td>
  </tr>
</table>
<div align="center">
  <table border="0" cellspacing="0" cellpadding="0" width="100%">
    <tr>
      <td valign="top">DIN ISENKRÆMMER • Stationsparken 24, 2. sal • 2600 Glostrup Kundeservice • Telefon: 70 22 71 83 • CVR-nr. 31 42 49 09 • E-mail: <a href="mailto:info@dfi.dk">info@dfi.dk</a></td>
    </tr>
  </table>
</div>		
EMAILBODY;
		return $body;		
	}
}

?>