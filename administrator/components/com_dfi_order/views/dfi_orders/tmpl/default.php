<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php JHTML::_('behavior.tooltip'); ?>
<?php
	// Set toolbar items for the page
	JToolBarHelper::title(   JText::_( strtoupper('Dfi_order Manager') ), 'generic.png' );
	JToolBarHelper::customX('duplicate', 'preview', '', 'Duplicate');
	JToolBarHelper::publishList();
	JToolBarHelper::unpublishList();
	JToolBarHelper::deleteList();
	JToolBarHelper::editListX();
	JToolBarHelper::addNewX();
	JToolBarHelper::preferences('com_dfi_order', '550','570','Preferences','/administrator/components/com_dfi_order/component_config.xml');
	$ordering = ($this->lists['order'] == 'a.ordering');
?>
<script language="javascript" src="<?php echo $this->lists['comdir']; ?>dfi_order.js"></script>
<form action="<?php echo $this->action; ?>" method="post" name="adminForm">
  <table>
    <tr>
      <td align="left" width="100%"><?php echo JText::_( 'Filter' ); ?>:
        <input type="text" name="search" id="search" value="<?php echo $this->lists['search'];?>" class="text_area" onchange="document.adminForm.submit();" />
        <button onclick="this.form.submit();"><?php echo JText::_( 'Go' ); ?></button>
        <button onclick="document.getElementById('search').value='';this.form.getElementById('filter_catid').value='0';this.form.getElementById('filter_state').value='';this.form.submit();"><?php echo JText::_( 'Reset' ); ?></button></td>
      <td nowrap="nowrap"><?php
			//echo $this->lists['catid'];
			//echo $this->lists['state'];
			echo $this->lists['dfi_shop_id'];
			echo $this->lists['dfi_kobreak_id'];
			echo $this->lists['dfi_order_status_id'];
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
		  
		  <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Dfi_shop_id') ), 'a.dfi_shop_id', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>
      <th class="title"> <?php echo JText::_( strtoupper('Kampagne '));?> </th>
		  <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Dfi_kobreak_id') ), 'a.dfi_kobreak_id', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>

		  <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( 'Received' ), 'a.received', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>
		  
		  <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Created') ), 'a.created', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>

		  <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Sent to administrator') ), 'a.modified', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>

		  <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Sent to Supplier') ), 'a.sent', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>

		  <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Dfi_order_status_id') ), 'a.dfi_order_status_id', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>
          
		  <th width="1%" nowrap="nowrap"> <?php echo JHTML::_('grid.sort',  'ID', 'a.dfi_order_id', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <td colspan="11"><?php echo $this->pagination->getListFooter(); ?> </td>
        </tr>
      </tfoot>
      <tbody>
        <?php
	$k = 0;
	for ($i=0, $n=count( $this->items ); $i < $n; $i++)
	{
		$row = &$this->items[$i];

		$link 	= JRoute::_( 'index.php?option=com_dfi_order&view=dfi_order&task=edit&cid[]='. $row->dfi_order_id );

		//$published 	= JHTML::_('grid.published', $row, $i );		
		?>
        <tr class="<?php echo "row$k"; ?>">
          <td><?php echo $this->pagination->getRowOffset( $i ); ?> </td>
          <td><input type="checkbox" onclick="isChecked(this.checked);" value="<?php echo $row->dfi_order_id; ?>" name="cid[]" id="cb<?php echo $i; ?>" />
          </td>
		  
		  <td><span class="editlinktip hasTip" title="<?php echo JText::_( strtoupper('Edit Dfi_order') );?>::<?php echo $this->escape($row->dfi_shop_id); ?>"><a href="<?php echo $link; ?>">
            <?php
				echo $this->escape($row->shop_name.' (Butiksnr. '.$row->butiksnr.')');
				?>
            </a></span> </td>
			
			<td>
				<?php echo $this->escape($row->campaign_name);?>
			</td>
			
		  <td>
            <?php
				echo $this->escape($row->kobreak_name);
				?> </td>

		  <td>
				<?php
					echo $row->received?JHTML::_('date',  $row->received, JText::_('%Y-%m-%d %H:%M') ):'';
					?> </td>
		  
		  <td>
				<?php
					echo JHTML::_('date',  $row->created, JText::_('%Y-%m-%d') );
					?> </td>
					
		  <td>
				<?php
					echo $row->modified?JHTML::_('date',  $row->modified, JText::_('%Y-%m-%d') ):'';
					?> </td>

		  <td>
            <?php
				echo $row->sent?JHTML::_('date',  $row->sent, JText::_('%Y-%m-%d') ):'';
				?> </td>

		  <td>
            <?php
				echo $this->escape($row->status_name);
				?> </td>
			
          <td align="center"><?php echo $row->dfi_order_id; ?> </td>
        </tr>
        <?php
		$k = 1 - $k;
	}
	?>
      </tbody>
    </table>
  </div>
  <input type="hidden" name="option" value="com_dfi_order" />
  <input type="hidden" name="task" value="" />
  <input type="hidden" name="boxchecked" value="0" />
  <input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
  <input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
  <?php echo JHTML::_( 'form.token' ); ?>
</form>
