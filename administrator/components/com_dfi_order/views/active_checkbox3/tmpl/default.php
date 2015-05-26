<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php JHTML::_('behavior.tooltip'); ?>
<?php
$ordering = ($this->lists['order'] == 'a.ordering');

?>
<script language="javascript" src="<?php echo $this->lists['comdir']; ?>dfi_order.js"></script>
	<form action="<?php echo $this->action; ?>" method="post" name="adminForm">
    <table>
    <tr>
      <td align="left" width="100%"><?php echo JText::_( 'Filter' ); ?>:
        <input type="text" name="search" id="search" value="<?php echo $this->lists['search'];?>" class="text_area" onchange="document.adminForm.submit();" />
        <button onclick="this.form.submit();"><?php echo JText::_( 'Go' ); ?></button>
        <button onclick="document.getElementById('search').value='';this.form.getElementById('filter_catid').value='0';this.form.getElementById('filter_state').value='';this.form.submit();"><?php echo JText::_( 'Reset' ); ?></button>
		<button onclick="document.getElementById('task').value='save_edit';this.form.submit();"><?php echo JText::_( strtoupper('Assign selection') ); ?></button>
        
       	<button <?php if($this->check_ok){ echo 'disabled="disabled"';}?>  onclick="document.getElementById('task').value='export';this.form.submit();"><?php echo JText::_('Export and Send'); ?></button>
	
        </td>
      <td nowrap="nowrap"><?php
			//echo $this->lists['catid'];
			echo $this->lists['state'];
		?>
      </td>
    </tr>
    </table>
    
	<div id="editcell">
	<table class="adminlist" style="width:700%;">
	<thead>
	<tr>
	<th width="5"> <?php echo JText::_( 'NUM' ); ?> </th>
	<th class="title" width="100"> EAN-Kode</th>
	<th class="title" width="100"> Vare nr.</th>
	<th class="title" width="200"> Varenavn</th>
	<th class="title" width="100"> Kampagnenettopris</th>
	<th class="title" width="100"> WEEE</th>
    
    
	<!--th class="title" width="100"> Vejl. Pris</th>
	<th class="title" width="100"> Før/efter</th>
	<th class="title" width="100"> Nu pris</th-->
	<?php
	$products = $details = array();
	for ($i=0, $n=count( $this->items ); $i < $n; $i++)
	{
		$row = &$this->items[$i]; ?>
		<th class="title" style="text-align:left;"><?php echo $row->company_name; ?> <br /> 
			Group Nordic:  <span style="color:blue;"><?php echo $row->butiksnr;?></span> <br />
			<?php echo $row->telephone;?> 
		</th>
		<?php
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
	?>
    
    <th class="title"> Total bestilt </th>
    <th class="title"> Total kostpris </th>
    <th class="title"> Total BA% </th>
    
	</tr>
	</thead>
	<tfoot>
		<tr>
			<td colspan="<?php echo 9+count($this->items); ?>"><?php //echo $this->pagination->getListFooter(); ?> </td>
		</tr>
	</tfoot>
	<tbody>
	<?php
	$j = 0;$l = 0;$Total_kostpris = 0; $SP_ = ''; $BA_ = ''; $BA1_ = '';
	foreach ($products as $k=>$v)
	{
		//$ckey = Dfi_order_active_checkboxHelper::checkbox_key();

		//$link = 'index.php?option=com_dfi_order&view=dfi_order&task=edit&cid[]='.$row->dfi_order_id;

		//$published 	= JHTML::_('grid.published', $row, $i );
		?>
		<tr class="<?php echo "row$j"; ?>">
		<td>
		<?php
		echo $k;
		?>
		</td>

		<td align="right"><?php echo $v['ean_kode'];?></td>
		<td align="right"><?php echo $v['serial_number'];?></td>
		<td align="right"><?php echo $this->escape($v['name']); ?></td>
		<td align="right"><?php echo ws_price_format($v['nettopris']);?></td>
		<td align="right"><?php echo ws_price_format($v['wee']);?></td>
        
		<!--td align="right"><?php echo ws_price_format($v['hvidpris']);?></td>
		<td align="right"><?php echo ws_price_format($v['rodpris']);?></td>
		<td align="right"><?php echo ws_price_format($v['nupris']);?></td-->
        
		<?php
        $pro_id = $v['dfi_product_id'];
        $total_ordered = 0;
		for ($i=0, $n=count( $this->items ); $i < $n; $i++){
            
            $row_order = &$this->items[$i];

			echo '<td align="left">';
			if(isset($details[$k][$i])){
			 
				$product = $details[$k][$i];
                ?>
                <input type="hidden" name="pro_id[<?php echo $i;?>][]" value="<?php echo $pro_id;?>" />
                <input type="hidden" name="order_id[<?php echo $i;?>][]" value="<?php echo $row_order->dfi_order_id;?>" />
                <input type="hidden" name="max" value="<?php echo $i;?>" />
                
                <input <?php if($this->check_ok){ echo 'readonly="true"';}?> style="margin-bottom: 3px;" type="text" name="product_quantity[<?php echo $i;?>][]" id="product_quantity_<?php echo $l;?>" value="<?php echo intval($product->product_quantity); ?>" /><br />
                <?php $total_ordered += $product->product_quantity;?>
                <label><?php echo ws_price_format(((float)$product->nettopris + (float)$product->wee ) * (float) $product->product_quantity);?></label>
                <?php
				//if (!$product->product_quantity) continue;
				//echo " <font color='red'><b>".intval($product->product_quantity)."</b></font><br />";
				//echo " ".ws_price_format(((float)$product->nettopris + (float)$product->wee ) * (float) $product->product_quantity). " <br />";
			}
            else{
		         echo '0';
            }
            
			echo '</td>';

		}
		?>
        
        
        <td align="right"><?php echo $total_ordered;?></td>
        <td align="right">
            <?php
            
                echo $this->escape(ws_price_format($v['nettopris']*$total_ordered));
                $Total_kostpris += ($v['nettopris']*$total_ordered);
            ?>
        </td>
        <td align="right">
        
            <?php 
                $SP = $v['nupris']*0.8*$total_ordered?$v['nupris']*0.8*$total_ordered:1;
                $SP_ += $SP;
                $BA = $SP - ($v['nettopris']*$total_ordered);
                
                $BA_ += $BA;
                
                $BA1 = $BA/$SP*100;
                echo $this->escape(ws_price_format($BA1));
            ?> 
        </td>
        
        
        
		</tr>
		<?php
		$j = 1 - $j;$l++;
	}
	?>
	</tbody>
	</table>
	</div>
	<input type="hidden" name="option" value="com_dfi_order" />
	<input type="hidden" name="task" id="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
	<input type="hidden" name="checkbox_id" id="checkbox_id" value='<?php echo $this->checkbox_id; ?>' />
	<input type="hidden" name="supplier_id" id="supplier_id" value='<?php echo $this->supplier_id; ?>' />
	<input type="hidden" name="campaign_id" id="campaign_id" value='<?php echo $this->campaign_id; ?>' />
	
    <?php echo JHTML::_( 'form.token' ); ?>
	</form>
