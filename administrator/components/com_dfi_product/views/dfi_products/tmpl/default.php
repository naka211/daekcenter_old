<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php JHTML::_('behavior.tooltip'); ?>
<?php
	// Set toolbar items for the page
	JToolBarHelper::title(   JText::_( strtoupper('Dfi_product Manager') ), 'generic.png' );
	//JToolBarHelper::publishList();
	//JToolBarHelper::unpublishList();
	JToolBarHelper::deleteList();
	JToolBarHelper::editListX();
	JToolBarHelper::addNewX();
	JToolBarHelper::preferences('com_dfi_product', '550','570','Preferences','/administrator/components/com_dfi_product/component_config.xml');
	$ordering = ($this->lists['order'] == 'a.ordering');
?>
<script language="javascript" src="<?php echo $this->lists['comdir']; ?>dfi_product.js"></script>
<form action="index.php?option=com_dfi_product" method="post" name="adminForm">
  <table>
    <tr>
      <td align="left" width="100%"><?php echo JText::_( 'Filter' ); ?>:
        <input type="text" name="search" id="search" value="<?php echo $this->lists['search'];?>" class="text_area" onchange="document.adminForm.submit();" />
        <button onclick="this.form.submit();"><?php echo JText::_( 'Go' ); ?></button>
        <button onclick="document.getElementById('search').value='';this.form.getElementById('filter_catid').value='0';this.form.getElementById('filter_state').value='';this.form.submit();"><?php echo JText::_( 'Reset' ); ?></button></td>
      <td nowrap="nowrap"><?php
	  		echo $this->lists['dfi_supplier_id'];
			echo $this->lists['filter_range'];
			//echo $this->lists['state'];
		?>
      </td>
    </tr>
  </table>
  <div id="editcell">
    <table class="adminlist">
      <thead>
        <tr>
          <th width="5"> <?php echo JText::_( 'NUM' ); ?> </th>
          <th width="20"> <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->items ); ?>);" />
          </th>
		  
		  <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Dfi_supplier_id') ), 'a.dfi_supplier_id', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>

		  <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Ean_kode') ), 'a.ean_kode', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>

		  <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Serial_number') ), 'a.serial_number', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>

		  <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Product_name') ), 'a.product_name', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>

		  <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Package_quantity') ), 'a.package_quantity', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>
		  
		  <?php /* <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Quantity') ), 'a.quantity', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>
		  */ ?>
		  <th class="title" width="50"> <?php echo JHTML::_('grid.sort',  JText::_( 'Sortimentsvare' ), 'a.sortimentsvare', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>
			 <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( 'Kampagnenetto' ), 'a.nettopris', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>
		  <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Weee') ), 'a.wee', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>
		  
		  <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Hvidpris') ), 'a.hvidpris', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>

		  <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Rodpris') ), 'a.rodpris', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>

		 
		  <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Nupris') ), 'a.nupris', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>
		  
		  <th class="title"> Campaigns </th>
          
		  <th width="1%" nowrap="nowrap"> <?php echo JHTML::_('grid.sort',  'ID', 'a.dfi_product_id', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <td colspan="14"><?php echo $this->pagination->getListFooter(); ?> </td>
        </tr>
      </tfoot>
      <tbody>
        <?php
	$k = 0;
	for ($i=0, $n=count( $this->items ); $i < $n; $i++)
	{
		$row = &$this->items[$i];

		$link 	= JRoute::_( 'index.php?option=com_dfi_product&view=dfi_product&task=edit&cid[]='. $row->dfi_product_id );

		//$published 	= JHTML::_('grid.published', $row, $i );
		
		?>
        <tr class="<?php echo "row$k"; ?>">
          <td><?php echo $this->pagination->getRowOffset( $i ); ?> </td>
          <td><input type="checkbox" onclick="isChecked(this.checked);" value="<?php echo $row->dfi_product_id; ?>" name="cid[]" id="cb<?php echo $i; ?>" />
          </td>
		  
		  <td><span class="editlinktip hasTip" title="<?php echo JText::_( strtoupper('Edit Dfi_product') );?>::<?php echo $this->escape($row->supplier); ?>"><a href="<?php echo $link; ?>">
            <?php
				echo $this->escape($row->supplier);
				?>
            </a></span> </td>

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
				
		 <?php /* <td>
            <?php
				echo $this->escape($row->quantity);
				?> </td> */ ?>
				
		  <td align="center">
            <?php
				echo $row->range?'Yes':'No';
				?> </td>
			  <td align="right"> 
            <?php
				echo ws_price_format($row->nettopris);
				?></td>
				<td align="right"><?php echo ws_price_format($row->wee);?></td>
		    <td align="right"> 
            <?php
				echo ws_price_format($row->hvidpris);
				?></td>

		  <td align="right"> 
            <?php
				echo ws_price_format($row->rodpris);
				?></td>
		  <td align="right"> 
            <?php
				echo ws_price_format($row->nupris);
				?></td>
				
		  <td>
		  	<?php
				foreach ($row->active_checkbox as $j=>$x)
				{
					echo ($j?'<br>':'').$x->name;
				}
				?>
		  		</td>
			
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
  <input type="hidden" name="task" value="" />
  <input type="hidden" name="boxchecked" value="0" />
  <input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
  <input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
  <?php echo JHTML::_( 'form.token' ); ?>
</form>
