<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php JHTML::_('behavior.tooltip'); ?>
<?php
	$ordering = ($this->lists['order'] == 'a.ordering');
?>
<script language="javascript" src="<?php echo $this->lists['comdir']; ?>dfi_order.js"></script>
<form action="<?php echo $this->action; ?>" method="post" name="adminForm">
  <div id="editcell">
    <table class="adminlist">
      <thead>
        <tr>
          <th width="5"> <?php echo JText::_( 'NUM' ); ?> </th>
		  
		  <th class="title"> <?php echo JText::_( 'Shops / Products' ) ?> </th>
		  
		   <?php
	
	$products = array();
	$k = 0;
	for ($i=0, $n=count( $this->items ); $i < $n; $i++)
	{
		$row = &$this->items[$i];
		if($row->products)
		{
			foreach ($row->products as $j=>$x)
			{	
				if ($x->product_name && !in_array($x->product_name, $products))
				{
					$products[] = $x->product_name; 
				}
			}				
		}
	}

	foreach ($products as $product_name)
	{
		?>
		  <th class="title"> <?php echo JText::_( $product_name ) ?> </th>
<?php } ?>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <td colspan="<?php echo count($products)+4; ?>"><?php echo $this->pagination->getListFooter(); ?> </td>
        </tr>
      </tfoot>
      <tbody>
        <?php
	$k = 0;
	for ($i=0, $n=count( $this->items ); $i < $n; $i++)
	{
		$row = &$this->items[$i];
		
		$ckey = Dfi_order_active_checkboxHelper::checkbox_key();
		
		//$link = 'index.php?option=com_dfi_order&view=dfi_order&task=edit&cid[]='.$row->dfi_order_id;
		//$published 	= JHTML::_('grid.published', $row, $i );	
		?>
        <tr class="<?php echo $selected?"row3":"row$k"; ?>">
          <td><?php echo $this->pagination->getRowOffset( $i ); ?> </td>
		  
		  <td>
            <?php
				echo $this->escape($row->company_name.' - '.$row->butiksnr);
				?>
             </td>

            <?php
			foreach ($products as $product_name)
			{
				echo '<td>';
				if($row->products)
				{
					foreach ($row->products as $j=>$product)
					{
						if ($product->product_name == $product_name)
						{
							echo $product->product_quantity;
							break;
						}
					}				
				}
				echo '</td>';
			}
				?>

        </tr>
        <?php
		$k = 1 - $k;
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
