<?php defined('_JEXEC') or die('Restricted access'); 
//print_r($this->items);die;
//print_r($row->description);die;
?>

<?php JHTML::_('behavior.tooltip'); ?>
<?php
	// Set toolbar items for the page
	JToolBarHelper::title(   JText::_( strtoupper('Dfi_shop Manager') ), 'generic.png' );
	JToolBarHelper::publishList();
	JToolBarHelper::unpublishList();
	JToolBarHelper::deleteList();
	JToolBarHelper::editListX();
	JToolBarHelper::addNewX();
	JToolBarHelper::preferences('com_dfi_shop', '550','570','Preferences','/administrator/components/com_dfi_shop/component_config.xml');
	$ordering = ($this->lists['order'] == 'a.ordering');
?>
<script language="javascript" src="<?php echo $this->lists['comdir']; ?>dfi_shop.js"></script>
<form action="index.php?option=com_dfi_shop" method="post" name="adminForm">
  <table>
    <tr>
      <td align="left" width="100%"><?php echo JText::_( 'Filter' ); ?>:
        <input type="text" name="search" id="search" value="<?php echo $this->lists['search'];?>" class="text_area" onchange="document.adminForm.submit();" />
        <button onclick="this.form.submit();"><?php echo JText::_( 'Go' ); ?></button>
        <button onclick="document.getElementById('search').value='';this.form.getElementById('filter_catid').value='0';this.form.getElementById('filter_state').value='';this.form.submit();"><?php echo JText::_( 'Reset' ); ?></button></td>
     <!-- <td nowrap="nowrap"><?php
	  		//echo $this->lists['butiksnr'];
			//echo $this->lists['catid'];
			//echo $this->lists['state'];
		?> -->
      </td>
    </tr>
  </table>
  <div id="editcell">
    <table class="adminlist">
      <thead>
        <tr>
          <th width="5"> <?php echo JText::_( 'NUM' ); ?> </th>
          <th width="25"> <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->items ); ?>);" />
          </th>
		  
		  <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Company_name') ), 'a.company_name', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>
		  <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Category') ), 'cc.title', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>

		  <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Street') ), 'a.street', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>

		 <!-- <th class="title"> <?php //echo JHTML::_('grid.sort',  JText::_( strtoupper('Zipcode') ), 'a.zipcode', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>

		  <th class="title"> <?php //echo JHTML::_('grid.sort',  JText::_( strtoupper('City') ), 'a.city', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>

		  <th class="title"> <?php //echo JHTML::_('grid.sort',  JText::_( strtoupper('Butiksnr') ), 'a.butiksnr', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th> -->

		  <th width="5%" nowrap="nowrap"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Published') ), 'a.published', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>

		  <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Filename') ), 'a.filename', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th> 

		  <th width="10%" nowrap="nowrap"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Ordering') ), 'a.ordering', $this->lists['order_Dir'], $this->lists['order'] ); ?> <?php if ($ordering) echo JHTML::_('grid.order',  $this->items ); ?></th>

		<!--  <th class="title"> <?php //echo JHTML::_('grid.sort',  JText::_( strtoupper('Rate %') ), 'a.rate', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>  -->
		  
		  <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Open_hour') ), 'a.open_hour', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>
          
		  <th width="1%" nowrap="nowrap"> <?php echo JHTML::_('grid.sort',  'ID', 'a.dfi_shop_id', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <td colspan="18"><?php echo $this->pagination->getListFooter(); ?> </td>
        </tr>
      </tfoot>
      <tbody>
        <?php
		
	$k = 0;
	for ($i=0, $n=count( $this->items ); $i < $n; $i++)
	{
		$row = &$this->items[$i];

		$link 	= JRoute::_( 'index.php?option=com_dfi_shop&view=dfi_shop&task=edit&cid[]='. $row->dfi_shop_id );

		$published 	= JHTML::_('grid.published', $row, $i );
		
		?>
        <tr class="<?php echo "row$k"; ?>">
          <td><?php echo $this->pagination->getRowOffset( $i ); ?> </td>
          <td><input type="checkbox" onclick="isChecked(this.checked);" value="<?php echo $row->dfi_shop_id; ?>" name="cid[]" id="cb<?php echo $i; ?>" />
          </td>
		  
		  <td><span class="editlinktip hasTip" title="<?php echo JText::_( strtoupper('Edit Dfi_shop') );?>::<?php echo $this->escape($row->company_name); ?>"><a href="<?php echo $link; ?>">
            <?php
				echo $this->escape($row->company_name);
				?>
            </a></span> </td>
			<td>
            <?php
				echo $this->escape($row->title);
				?> </td>
		  <td>
            <?php
			
				echo strip_tags($row->description);
				?> </td>

	<!-- 	  <td>
            <?php
				//echo $this->escape($row->zipcode);
				?> </td>

		  <td>
            <?php
				//echo $this->escape($row->city);
				?> </td>

		  <td>
            <?php
			//	echo $this->escape($row->butiksnr);
				?> </td> -->

		  <td align="center"><?php echo $published;?> </td>

		  <td align="center"><a href="<?php echo JURI::root().$row->filename; ?>" title="Image" class="modal-button"><img width="50" src="<?php echo JURI::root().$row->filename; ?>" /></a> </td>

		  <td class="order">
				<span><?php echo $this->pagination->orderUpIcon( $i, TRUE,'orderup', 'Move Up', $ordering ); ?></span>
				<span><?php echo $this->pagination->orderDownIcon( $i, $n, TRUE, 'orderdown', 'Move Down', $ordering ); ?></span>
				<?php $disabled = $ordering ?  '' : 'disabled="disabled"'; ?>
				<input type="text" name="order[]" size="5" value="<?php echo $row->ordering;?>" <?php echo $disabled ?> class="text_area" style="text-align: center" />
			</td>

		<!--   <td>
            <?php
				echo intval($row->rate);
				?> %</td> -->
				
		  <td>
            <?php
				echo $this->escape($row->open_hour);
				?> </td>
			
          <td align="center"><?php echo $row->dfi_shop_id; ?> </td>
        </tr>
        <?php
		$k = 1 - $k;
	}
	?>
      </tbody>
    </table>
  </div>
  <input type="hidden" name="option" value="com_dfi_shop" />
  <input type="hidden" name="task" value="" />
  <input type="hidden" name="boxchecked" value="0" />
  <input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
  <input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
  <?php echo JHTML::_( 'form.token' ); ?>
</form>
