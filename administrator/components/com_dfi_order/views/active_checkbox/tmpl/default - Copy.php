<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php JHTML::_('behavior.tooltip'); ?>
<?php
	// Set toolbar items for the page
	JToolBarHelper::title(   JText::_( strtoupper('Ajourmaster') ), 'generic.png' );
	JToolBarHelper::cancel();
?>
<?php
$ordering = ($this->lists['order'] == 'a.ordering');
?>
<script language="javascript" src="<?php echo $this->lists['comdir']; ?>dfi_order.js"></script>
	<form action="<?php echo $this->action; ?>" method="post" name="adminForm">
	<table>
		<tr>
			<td align="left" width="100%"></td>
			<td nowrap="nowrap"><?php echo $this->lists['filter_kamp'];?></td>
		</tr>
	</table>
	<div id="editcell">
	<table class="adminlist">
	<thead>
	<tr>
		<th width="5"> <?php echo JText::_( 'NUM' ); ?> </th>
		<th class="title"> Leverandør </th>
		<th class="title"> Vare nr. </th>
		<th class="title"> Varenavn </th>
		<th class="title"> Kollistr </th>
		<th class="title"> Nettopris </th>
		<th class="title"> Hvidpris</th>
		<th class="title"> FÃ¸r/efter </th>
		<th class="title"> Nu pris </th>

		<?php
		$products = $details = array();
		for ($i=0, $n=count( $this->items ); $i < $n; $i++){
			$row = &$this->items[$i]; ?>
			<th class="title"> <?php echo $row->company_name; ?> </th>
			<?php
			if($row->products)
			{
				foreach ($row->products as $j=>$product)
				{
					if (!$product->product_quantity) continue;
					$products[$product->dfi_product_id] = $product;
					$details[$product->dfi_product_id][$i] = $product;
				}
			}
		}
		?>
	</tr>
	</thead>
	<tfoot>
		<tr>
			<td colspan="<?php echo 9+count($this->items); ?>"><?php //echo $this->pagination->getListFooter(); ?> </td>
		</tr>
	</tfoot>
	<tbody>
	<?php
	$j = 0;
	foreach ($products as $k=>$v)
	{
		//$ckey = Dfi_order_active_checkboxHelper::checkbox_key();

		//$link = 'index.php?option=com_dfi_order&view=dfi_order&task=edit&cid[]='.$row->dfi_order_id;

		//$published 	= JHTML::_('grid.published', $row, $i );
		?>
		<tr class="<?php echo "row$j"; ?>">
		<td>
		<?php echo $k;?>
		</td>

		<td>
			<?php echo $this->escape($v->supplier); ?>
		</td>

		<td>
			<?php echo $this->escape($v->serial_number); ?>
		</td>

		<td>
			<?php echo $this->escape($v->product_name);?>
		</td>

		<td>
			<?php echo $this->escape($v->package_quantity); ?>
		</td>

		<td>
			<?php echo $this->escape($v->nettopris); ?>
		</td>

		<td>
			<?php echo $this->escape($v->hvidpris);?>
		</td>

		<td>
			<?php echo $this->escape($v->rodpris);?>
		</td>

		<td>
			<?php echo $this->escape($v->nupris);?>
		</td>

		<?php
		for ($i=0, $n=count( $this->items ); $i < $n; $i++)
		{
			echo '<td>';
			if(isset($details[$k][$i]))
			{
				$product = $details[$k][$i];
				//if (!$product->product_quantity) continue;
				echo intval($product->product_quantity);
			} else
			echo '0';
			echo '</td>';
		}
		?>

		</tr>
		<?php
		$j = 1 - $j;
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
	<?php echo JHTML::_( 'form.token' ); ?>
	</form>
