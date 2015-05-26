<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php JHTML::_('behavior.tooltip'); ?>
<?php
	$ordering = ($this->lists['order'] == 'a.ordering');
?>
<script language="javascript" src="<?php echo $this->lists['comdir']; ?>dfi_kobreak_product.js"></script>
<form action="<?php echo $this->action; ?>" method="post" name="adminForm">
  <table>
    <tr>
      <td align="left" width="100%"><?php echo JText::_( 'Filter' ); ?>:
        <input type="text" name="search" id="search" value="<?php echo $this->lists['search'];?>" class="text_area" onchange="document.adminForm.submit();" />
        <button onclick="this.form.submit();"><?php echo JText::_( 'Go' ); ?></button>
        <button onclick="document.getElementById('search').value='';this.form.getElementById('filter_catid').value='0';this.form.getElementById('filter_state').value='';this.form.submit();"><?php echo JText::_( 'Reset' ); ?></button>
		<button onclick="document.getElementById('task').value='active_checkbox';this.form.submit();"><?php echo JText::_( strtoupper('Assign selection') ); ?></button>
		
		<button onclick="document.getElementById('task').value='create_product';this.form.submit();"><?php echo JText::_( 'Create new product' ); ?></button>
		
        </td>
      <td nowrap="nowrap"><?php
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
		  
		  <th class="title" width="10%"> <?php echo JHTML::_('grid.sort',  JText::_( 'EAN-Kode' ), 'b.ean_kode', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>
		  
		  <th class="title" width="10%"> <?php echo JHTML::_('grid.sort',  JText::_( 'Vare Nr.' ), 'b.serial_number', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>
		  
		  <th class="title" width="15%"> <?php echo JHTML::_('grid.sort',  JText::_( 'Vare tekst' ), 'b.product_name', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>

		  <th class="title" width="6%"> <?php echo JHTML::_('grid.sort',  JText::_( 'Kolli str.' ), 'a.quantity', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>

		  <th class="title"  style="width:50px;"> <?php echo JHTML::_('grid.sort',  JText::_( 'Mængde' ), 'a.quantity', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>
		  <th class="title"  style="width:50px;"> <?php echo JText::_( 'Tvangsfordeling' ); ?> </th>
		  
		  <th class="title" style="width:50px;"> <?php echo JHTML::_('grid.sort',  JText::_( 'Kampagnenetto' ), 'a.nettopris', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>
		   <th class="title" style="width:50px;"> <?php echo JHTML::_('grid.sort',  JText::_( 'WEEE' ), 'a.wee', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>
		 
		  <th class="title" style="width:50px;"> <?php echo JHTML::_('grid.sort',  JText::_( 'Vejl. Pris' ), 'a.hvidpris', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>
		  
		  <th class="title" style="width:50px;"> <?php echo JHTML::_('grid.sort',  JText::_( 'Før/efter' ), 'a.rodpris', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>
		  
		  <th class="title" style="width:50px;"> <?php echo JHTML::_('grid.sort',  JText::_( 'Nu pris' ), 'a.nupris', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>
       <th class="title" width="15%">(Delete) - Kampagne</th>
       <th class="title" width="9%">Add Kampagne</th>
         
		   <?php /*<th width="1%" nowrap="nowrap"> <?php echo JHTML::_('grid.sort',  'ID', 'a.dfi_kobreak_product_id', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>
       */ ?>
       </tr>
      </thead>
      <tfoot>
        <tr>
          <td colspan="15"><?php echo $this->pagination->getListFooter(); ?> </td>
        </tr>
      </tfoot>
      <tbody>
        <?php
	$k = 0;
    if( $this->items){
	for ($i=0, $n=count( $this->items ); $i < $n; $i++)
	{
		$row = &$this->items[$i];
       
		$ckey = Dfi_kobreak_product_active_checkboxHelper::checkbox_key();
		
		//$published 	= JHTML::_('grid.published', $row, $i );	
		?>
        <tr class="<?php echo $selected?"row3":"row$k"; ?>">
          <td><?php echo $this->pagination->getRowOffset( $i ); ?> </td>
          <td>
		  <input type="checkbox" onclick="isChecked(this.checked);" value="<?php echo $row->$ckey; ?>" name="cid[]" id="cb<?php echo $i; ?>"<?php echo $row->checkbox_state?' checked':'' ?> />
		  
		  <input name="checkbox_states[]" type="hidden" value="<?php echo $row->$ckey; ?>" />
          <input name="id_<?php echo $row->$ckey; ?>" type="hidden" value="<?php echo $row->dfi_product_id; ?>" />
          </td>
			 
		  <td>
            <?php
				echo $this->escape($row->ean_kode);
				?>
             </td>
			 
		  <td>
            <?php
				echo $this->escape($row->serial_number);
				?>
             </td>
		  
		  <td>
            <?php
				echo $this->escape($row->product_name);
				?>
             </td>
			 
		  <td>
            <?php
				//echo $this->escape($row->package_quantity);
				?>
        <input style="width:40px;" name="package_<?php echo $row->$ckey; ?>" type="text" value="<?php echo $row->package_quantity; ?>" />
             </td>

		  <td>
		  <input style="width:40px;" name="quantity_<?php echo $row->$ckey; ?>" type="text" value="<?php echo $row->quantity; ?>" /> </td>
		  <td align="center">
		  <?php if($row->forced_distribution){echo "J";} else{echo "N";} ?> 
          
          </td>
		  
		  <td>
		  <input style="width:40px;"  name="nettopris_<?php echo $row->$ckey; ?>" type="text" value="<?php echo ws_price_format($row->nettopris); ?>" /> </td>
		  
		   <td>
		  <input  style="width:40px;" name="wee_<?php echo $row->$ckey; ?>" type="text" value="<?php echo ws_price_format($row->wee); ?>" /> </td>
		  
		  <td>
		  <input  style="width:40px;" name="hvidpris_<?php echo $row->$ckey; ?>" type="text" value="<?php echo ws_price_format($row->hvidpris); ?>" /> </td>
		  
		  <td>
		  <input   style="width:40px;" name="rodpris_<?php echo $row->$ckey; ?>" type="text" value="<?php echo ws_price_format($row->rodpris); ?>" />
             </td>
			 
		  <td>
		  <input  style="width:40px;" name="nupris_<?php echo $row->$ckey; ?>" type="text" value="<?php echo ws_price_format($row->nupris); ?>" /> 
             </td>
			<td>
			<?php
				foreach ($row->list_kampagne as $j=>$x)
				{
					//echo ($j?'<br>':'').$x->name;
                    if($x->dfi_campaign_id == $this->lists['dfi_campaign_id']){
                        echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;"
                            .$x->name."<br />";
                    }else{
                    
                    ?>
                        <input type="checkbox" name="dfi_campaign_to_product_id[]" value="<?php echo $x->dfi_campaign_to_product_id;?>" /><span>&nbsp;<?php echo $x->name;?></span><br />
                 <?php   
                    }
                }
				?>
			</td>
            
            <td>
                <button onclick="document.getElementById('task').value='add_kampagne';document.getElementById('dfi_product_id').value='<?php echo $row->dfi_product_id; ?>';this.form.submit();">
                    <?php echo JText::_( 'Add Kampagne' ); ?>
                </button>
		
            
            </td>
          <?php /* ?>
          
          
          <td align="center"><?php echo $row->dfi_kobreak_product_id; ?> 
		  <input name="dfi_kobreak_product_id_<?php echo $row->$ckey; ?>" type="hidden" value="<?php echo $row->dfi_kobreak_product_id; ?>" />
		  </td> 
          
          <?php */?>
         
        </tr>
        <?php
		$k = 1 - $k;
	} }
	?>
      </tbody>
    </table>
    
    <div>
    
    <table>
        <tr>
            <td align="left" width="100%">
            
                <button onclick="document.getElementById('task').value='add_product';this.form.submit();"><?php echo JText::_( 'Add product' ); ?></button>
            
            </td>
         
        </tr>
    </table>
    
    <table class="adminlist">
      <thead>
        <tr>
            <th width="5"> <?php echo JText::_( 'NUM' ); ?> </th>
            <th width="20"> 
              &nbsp;
            </th>
            
            <th class="title">Leverandør</th>
            <th class="title">Ean Kode</th>
            <th class="title">Vare nummer</th>
            <th class="title">Produkt navn</th>
            <th class="title">Kolli str.</th>
            <th class="title">Sortimentsvare</th>
            <th class="title">Kampagnenetto</th>
            <th class="title">Weee</th>
            <th class="title">Vejl. pris</th>
            <th class="title">Før/efter</th>
            <th class="title">Nu pris</th>
            <th class="title">Campaigns </th>
            <th class="title">ID</th>
        </tr>
      </thead>
      <tbody>
        <?php
	$k = 0;
    if( $this->items_pro){
	for ($i=0, $n=count( $this->items_pro ); $i < $n; $i++)
	{
		$row = &$this->items_pro[$i];
        $ckey = Dfi_kobreak_product_active_checkboxHelper::checkbox_key();
		
		?>
        <tr class="<?php echo "row$k"; ?>">
          
          <td><?php echo $this->pagination->getRowOffset( $i ); ?> </td>
          
          <td>
		  <input type="checkbox" onclick="isChecked(this.checked);" value="<?php echo $row->$ckey; ?>" name="cid1[]" id="cb1<?php echo $i; ?>" />
		  
          </td>
          
		  <td>
            <?php
				echo $this->escape($row->supplier);
				?>
           </td>

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
	} }
	?>
      </tbody>
    </table>
    </div>
    
    
  </div>
  <input type="hidden" name="option" value="com_dfi_kobreak_product" />
  <input type="hidden" name="task" id="task" value="" />
  <input type="hidden" name="boxchecked" value="0" />
  <input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
  <input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
  <input type="hidden" name="checkbox_id" id="checkbox_id" value='<?php echo $this->checkbox_id; ?>' />
  <input type="hidden" name="dfi_product_id" id="dfi_product_id" value='' />
  <input type="hidden" name="dfi_campaign_id" id="dfi_campaign_id" value='<?php echo $this->dfi_campaign_id; ?>' />
  <input type="hidden" name="dfi_supplier_id" id="dfi_supplier_id" value='<?php echo $this->dfi_supplier_id; ?>' />
  
  <?php echo JHTML::_( 'form.token' ); ?>
</form>
