<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php JHTML::_('behavior.tooltip'); ?>
<?php
// Set toolbar items for the page
JToolBarHelper::title(   JText::_( strtoupper('Dfi_shop Price Monthly') ), 'generic.png' );

$ordering = ($this->lists['order'] == 'a.ordering');
?>
<script language="javascript" src="<?php echo $this->lists['comdir']; ?>dfi_shop.js"></script>
	<form action="index.php?option=com_dfi_monthly" method="post" name="adminForm">
	<table>
		<tr>
			<td align="left" width="100%"><?php echo JText::_( 'Filter' ); ?>:
			<input type="text" name="search" id="search" value="<?php echo $this->lists['search'];?>" class="text_area" onchange="document.adminForm.submit();" />
			<button onclick="this.form.submit();"><?php echo JText::_( 'Go' ); ?></button>
			<button onclick="document.getElementById('search').value='';this.form.getElementById('filter_catid').value='0';this.form.getElementById('filter_state').value='';this.form.submit();"><?php echo JText::_( 'Reset' ); ?></button></td>
			<td nowrap="nowrap"><?php echo $this->lists['butiksnr'];?></td>
		</tr>
	</table>
	<div id="editcell">
	<table class="adminlist">
	<thead>
	<tr>
	<th width="5"> <?php echo JText::_( 'NUM' ); ?> </th>
	<th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Shop') ), 's.company_name', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>
	
	<th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Jan') ), 'a.jan', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>
	
	<th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Feb') ), 'a.feb', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>

	<th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Mar') ), 'a.mar', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>

	<th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Apr') ), 'a.apr', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>

	<th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('May') ), 'a.may', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>

	<th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Jun') ), 'a.jun', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>

	<th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('July') ), 'a.july', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>

	<th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Aug') ), 'a.aug', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>

	<th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Sep') ), 'a.sep', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>

	<th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Otc') ), 'a.otc', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>
	
	<th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Nov') ), 'a.nov', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>
   
  <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Dec') ), 'a.dece', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>
	
	<th class="title"> <?php echo JText::_( strtoupper('Total')) ?> </th>

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
	?>
	<tr class="<?php echo "row$k"; ?>">
	  <td></td>
		<td>
			<b>Shop</b>: <?php echo $row->company_name;?> <br />
			<b>Butiksnr </b> :  <span style="color:blue;font-weight:bold;"><?php echo $row->butiksnr;?></span>
		</td>
		<td><?php echo ws_price_format($row->jan);?></td>
		<td><?php echo ws_price_format($row->feb);?></td>
		<td><?php echo ws_price_format($row->mar);?></td>
		<td><?php echo ws_price_format($row->apr);?></td>
		<td><?php echo ws_price_format($row->may);?></td>
		<td><?php echo ws_price_format($row->jun);?></td>
		<td><?php echo ws_price_format($row->july);?></td>
		<td><?php echo ws_price_format($row->aug);?></td>
		<td><?php echo ws_price_format($row->sep);?></td>
		<td><?php echo ws_price_format($row->otc);?></td>
		<td><?php echo ws_price_format($row->nov);?></td>
		<td><?php echo ws_price_format($row->dece);?></td>
		<td>
		<?php
			$total1_6=(float)$row->jan + (float)$row->feb + (float)$row->mar + (float)$row->apr 
								+ (float)$row->may + (float)$row->jun ;
			$total7_12=(float)$row->july + (float)$row->aug + (float)$row->sep + (float)$row->otc 
								+ (float)$row->nov + (float)$row->dece ;
		?>
		<b>From 1 to 6 </b> <span style="color:red;font-weight:bold;"><?php echo ws_price_format($total1_6);?> DDK </span> <br /><br />
		<b>Form 7 to 12 </b> <span style="color:red;font-weight:bold;">  <?php echo ws_price_format($total7_12);?> DDK </span>
		</td>
	</tr>
	<?php
		$k = 1 - $k;
	}
	?>
	</tbody>
	</table>
	</div>
	<input type="hidden" name="option" value="com_dfi_monthly" />
	<input type="hidden" name="task" value="" />
	<input type="hidden" name="boxchecked" value="0" />
	<input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
	<input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
	<?php echo JHTML::_( 'form.token' ); ?>
	</form>
