<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php JHTML::_('behavior.tooltip'); ?>
<?php
	$ordering = ($this->lists['order'] == 'a.ordering');
?>
<script language="javascript" src="<?php echo $this->lists['comdir']; ?>dfi_product.js"></script>
<form action="index.php?option=com_dfi_product&view=active_checkbox&tmpl=component" method="post" name="adminForm">
  <table>
    <tr>
      <td align="left" width="100%"><?php echo JText::_( 'Filter' ); ?>:
        <input type="text" name="search" id="search" value="<?php echo $this->lists['search'];?>" class="text_area" onchange="document.adminForm.submit();" />
        <button onclick="this.form.submit();"><?php echo JText::_( 'Go' ); ?></button>
        <button onclick="document.getElementById('search').value='';this.form.getElementById('filter_catid').value='0';this.form.getElementById('filter_state').value='';this.form.submit();"><?php echo JText::_( 'Reset' ); ?></button>
		<button onclick="this.form.getElementById('task').value='assign';this.form.submit();"><?php echo JText::_( strtoupper('Assign selection') ); ?></button></td>
      <td nowrap="nowrap"><?php
			//echo $this->lists['catid'];
			//echo $this->lists['state'];
			echo $this->lists['dfi_supplier_id'];
			echo $this->lists['selection'];
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
		  
		  <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Dfi_supplier_id') ), 'a.dfi_supplier_id', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>

		  <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Ean_kode') ), 'a.ean_kode', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>

		  <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Serial_number') ), 'a.serial_number', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>

		  <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Product_name') ), 'a.product_name', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>

		  <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Package_quantity') ), 'a.package_quantity', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>

		  <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Quantity') ), 'a.quantity', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>

		  <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Hvidpris') ), 'a.hvidpris', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>

		  <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Rodpris') ), 'a.rodpris', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>

		  <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Nettopris') ), 'a.nettopris', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>
		  
		  <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Nupris') ), 'a.nupris', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>
          
		  <th width="1%" nowrap="nowrap"> <?php echo JHTML::_('grid.sort',  'ID', 'a.dfi_product_id', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <td colspan="12"><?php echo $this->pagination->getListFooter(); ?> </td>
        </tr>
      </tfoot>
      <tbody>
        <?php
	$k = 0;
	for ($i=0, $n=count( $this->items ); $i < $n; $i++)
	{
		$row = &$this->items[$i];

		$selected 	= in_array($row->dfi_product_id, $this->cid);		
		?>
        <tr class="<?php echo $selected?"row3":"row$k"; ?>">
          <td><?php echo $this->pagination->getRowOffset( $i ); ?> </td>
          <td><input type="checkbox" onclick="isChecked(this.checked); stick_one(this);" value="<? echo $row->dfi_product_id; ?>" name="cid[]" id="cb<? echo $i; ?>"<?php echo $selected?' checked':'' ?> />
          </td>
		  
		  <td>
            <?php
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

		  <td>
            <?php
				echo $this->escape($row->hvidpris);
				?> DKK</td>

		  <td>
            <?php
				echo $this->escape($row->rodpris);
				?> DKK</td>

		  <td>
            <?php
				echo $this->escape($row->nettopris);
				?> DKK</td>
				
		  <td>
            <?php
				echo $this->escape($row->nupris);
				?> DKK</td>
			
          <td align="center"><?php echo $row->dfi_product_id; ?> </td>
        </tr>
        <?php
		$k = 1 - $k;
	}
	?>
      </tbody>
    </table>
  </div>
  <input type="hidden" name="option" value="com_dfi_product" />
  <input type="hidden" name="task" id="task" value="" />
  <input type="hidden" name="boxchecked" value="0" />
  <input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
  <input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
  <input type="hidden" name="selection" id="selection" value='<?php echo $this->selection; ?>' />
  <?php echo JHTML::_( 'form.token' ); ?>
</form>
