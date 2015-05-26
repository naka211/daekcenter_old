<?php defined('_JEXEC') or die('Restricted access'); ?>

<?php JHTML::_('behavior.tooltip'); ?>

<?php
	// Set toolbar items for the page
	JToolBarHelper::title(   JText::_( 'Application Manager' ), 'generic.png' );
	JToolBarHelper::publishList();
	JToolBarHelper::unpublishList();
	JToolBarHelper::deleteList();
	JToolBarHelper::editListX();
	JToolBarHelper::addNewX();
	JToolBarHelper::preferences('com_date', '380');
	JToolBarHelper::help( 'screen.date' );
	$order= ($this->lists['order'] == 'a.order');
?>
<form action="index.php" method="post" name="adminForm">
<table>
<tr>
	<td align="left" width="100%">
		<?php echo JText::_( 'Filter' ); ?>:
		<input type="text" name="search" id="search" value="<?php echo htmlspecialchars($this->lists['search']);?>" class="text_area" onchange="document.adminForm.submit();" />
		<button onclick="this.form.submit();"><?php echo JText::_( 'Go' ); ?></button>

        <button onclick="document.getElementById('search').value='';this.form.getElementById('filter_state').value='';this.form.submit();"><?php echo JText::_( 'Reset' ); ?></button>
	</td>
	<td nowrap="nowrap">
		<?php
			echo $this->lists['state'];
		?>
	</td>
</tr>
</table>
<div id="editcell">
	<table class="adminlist">
	<thead>
		<tr>
			<th width="5">
				<?php echo JText::_( 'NUM' ); ?>
			</th>
			<th width="20">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->items ); ?>);" />
			</th>
            <th>
				<?php echo JText::_( 'Name' ); ?>
			</th>
           <th>
				<?php echo JText::_( 'Address' ); ?>
			</th>
            <th>
				<?php echo JText::_( 'Phone' ); ?>
			</th>
            <th>
				<?php echo JText::_( 'Email' ); ?>
			</th>
			<th nowrap="nowrap">
				<?php echo JHTML::_('grid.sort',  'Order', 'a.order', $this->lists['order_Dir'], $this->lists['order'] ); ?>
                <?php if ($order) echo JHTML::_('grid.order',  $this->items ); ?>
            </th>
		</tr>
	</thead>
	<tfoot>
		<tr>
			<td colspan="9">
				<?php echo $this->pagination->getListFooter(); ?>
			</td>
		</tr>
	</tfoot>
	<tbody>
	<?php
	$k = 0;
	for ($i=0, $n=count( $this->items ); $i < $n; $i++){
	   
       
		$row = &$this->items[$i];
		$link 	= JRoute::_( 'index.php?option=com_date&view=dateedit&task=edit&cid[]='. $row->id );
        $checked 	= JHTML::_('grid.checkedout',   $row, $i );
        ?>
		<tr class="<?php echo "row$k"; ?>">
			<td>
				<?php echo $this->pagination->getRowOffset( $i ); ?>
			</td>
			<td>
				<?php echo $checked; ?>
			</td>
			<td>
				<span class="editlinktip hasTip" title="<?php echo JText::_( 'Edit Application' );?>::<?php echo $this->escape($row->name); ?>">
					<a href="<?php echo $link; ?>">
						<?php echo $this->escape($row->name); ?></a>
                </span>
				
			</td>
            <td >
				<?php echo $row->address; ?>
			</td>
            <td >
				<?php echo $row->phone; ?>
			</td>
            <td >
				<?php echo $row->email; ?>
			</td>
            
            <td class="order">
				<input type="text" name="ordering[]" size="5" value="<?php echo $row->ordering;?>" class="text_area" style="text-align: center" />
			</td>
		</tr>
		<?php
		$k = 1 - $k;
	}
	?>
	</tbody>
	</table>
</div>

	<input type="hidden" name="option" value="com_date" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>
