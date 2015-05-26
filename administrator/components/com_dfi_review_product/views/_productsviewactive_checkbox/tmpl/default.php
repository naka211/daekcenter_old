<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php JHTML::_('behavior.tooltip'); ?>
<?php
	$ordering = ($this->lists['order'] == 'a.ordering');
?>
<script language="javascript" src="<?php echo $this->lists['comdir']; ?>dfi_review_product.js"></script>
<form action="<?php echo $this->action; ?>" method="post" name="adminForm">
  <table>
    <tr>
      <td align="left" width="100%"><?php echo JText::_( 'Filter' ); ?>:
        <input type="text" name="search" id="search" value="<?php echo $this->lists['search'];?>" class="text_area" onchange="document.adminForm.submit();" />
        <button onclick="this.form.submit();"><?php echo JText::_( 'Go' ); ?></button>
        <button onclick="document.getElementById('search').value='';this.form.getElementById('filter_catid').value='0';this.form.getElementById('filter_state').value='';this.form.submit();"><?php echo JText::_( 'Reset' ); ?></button>
		<button onclick="document.getElementById('task').value='active_checkbox';this.form.submit();"><?php echo JText::_( strtoupper('Assign selection') ); ?></button></td>
      <td nowrap="nowrap"><?php
	  		echo $this->lists['dfi_supplier_id'];
			//echo $this->lists['catid'];
			echo $this->lists['state'];
		?>
      </td>
    </tr>
  </table>
  <div id="editcell">
    <table class="adminlist">
      <thead>
        <tr>
          <th width="5"> <?php echo JText::_( 'NUM' ); ?> </th>
          <th width="20"> <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->items ); ?>); stick_all(<?php echo count( $this->items ); ?>);" />
          </th>
		  
		  <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Dfi_supplier_id') ), 'b.dfi_supplier_id', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>

		  <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Ean_kode') ), 'b.ean_kode', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>

		  <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Serial_number') ), 'b.serial_number', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>

		  <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Product_name') ), 'b.product_name', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>

		  <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Package_quantity') ), 'b.package_quantity', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>
		  
		  <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Quantity') ), 'b.quantity', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>
		  
		  <th class="title" width="50"> <?php echo JHTML::_('grid.sort',  JText::_( 'Sortimentsvare' ), 'b.sortimentsvare', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>

		  <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Hvidpris') ), 'b.hvidpris', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>

		  <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Rodpris') ), 'b.rodpris', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>

		  <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Nettopris') ), 'b.nettopris', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>
		  
		  <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Nupris') ), 'b.nupris', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>
          
		  <th width="1%" nowrap="nowrap"> <?php echo JHTML::_('grid.sort',  'ID', 'a.dfi_review_product_id', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <td colspan="20"><?php echo $this->pagination->getListFooter(); ?> </td>
        </tr>
      </tfoot>
      <tbody>
        <?php
	$k = 0;
	for ($i=0, $n=count( $this->items ); $i < $n; $i++)
	{
		$row = &$this->items[$i];
		
		$ckey = Dfi_review_product_active_checkboxHelper::checkbox_key();
		
		//$published 	= JHTML::_('grid.published', $row, $i );	
		?>
        <tr class="<?php echo $selected?"row3":"row$k"; ?>">
          <td><?php echo $this->pagination->getRowOffset( $i ); ?> </td>
          <td>
		  <input type="checkbox" onclick="isChecked(this.checked);" value="<?php echo $row->$ckey; ?>" name="cid[]" id="cb<?php echo $i; ?>"<?php echo $row->checkbox_state?' checked':'' ?> />
		  
		  <input name="checkbox_states[]" type="hidden" value="<?php echo $row->$ckey; ?>" />
          </td>
		  
		  <td><?php
				echo $this->escape($row->supplier);
				?> </td>

		  <td>
            <?php
				echo $this->escape($row->ean_kode);
				?> </td>

		  <td>
            <?php
				echo $this->escape($row->serial_number);
				?> </td>

		  <td>
            <?php
				echo $this->escape($row->product_name);
				?> </td>

		  <td>
            <?php
				echo $this->escape($row->package_quantity);
				?> </td>
				
		  <td>
            <?php
				echo $this->escape($row->quantity);
				?> </td>
				
		  <td align="center">
            <?php
				echo $row->range?'Yes':'No';
				?> </td>

		  <td>DKK 
            <?php
				echo ws_price_format($row->hvidpris);
				?></td>

		  <td>DKK 
            <?php
				echo ws_price_format($row->rodpris);
				?></td>

		  <td>DKK 
            <?php
				echo ws_price_format($row->nettopris);
				?></td>
				
		  <td>DKK 
            <?php
				echo ws_price_format($row->nupris);
				?></td>
			
          <td align="center"><?php echo $row->dfi_review_product_id; ?> 
		  <!--<input name="dfi_review_product_id_<?php echo $row->$ckey; ?>" type="hidden" value="<?php echo $row->dfi_review_product_id; ?>" />-->
		  </td>
        </tr>
        <?php
		$k = 1 - $k;
	}
	?>
      </tbody>
    </table>
  </div>
  <input type="hidden" name="option" value="com_dfi_review_product" />
  <input type="hidden" name="task" id="task" value="" />
  <input type="hidden" name="boxchecked" value="0" />
  <input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
  <input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
  <input type="hidden" name="checkbox_id" id="checkbox_id" value='<?php echo $this->checkbox_id; ?>' />
  <?php echo JHTML::_( 'form.token' ); ?>
</form>
