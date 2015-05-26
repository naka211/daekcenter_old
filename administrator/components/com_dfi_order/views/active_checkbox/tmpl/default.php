<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php JHTML::_('behavior.tooltip'); ?>
<?php
	// Set toolbar items for the page
	JToolBarHelper::title(   JText::_( strtoupper('Ajourmaster') ), 'generic.png' );
    
    JToolBarHelper::custom('send_excel','forward.png','forward_f2.png', 'Export Excel', false);
    
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
	<table class="adminlist" style="width:600%;">
	<thead>
	<tr>
		<th width="5"> <?php echo JText::_( 'NUM' ); ?> </th>
		<?php /*<th class="title" width="200"> Leverandør </th>*/ ?>
		<th class="title" width="200">Købeark</th>
		<th class="title">Ean Kode</th>
		<th class="title"> Vare nr. </th>
		<th class="title"> Varenavn </th>
		<th class="title"> Kollistr </th>
		<th class="title" width="100"> Kampagnenetto pris </th>
		<th class="title"> Vejl pris</th>
		<th class="title"> Før/efter </th>
		<th class="title"> Nu pris </th>
	  <?php if(count($this->company_name) > 0):?>
		  <?php foreach($this->company_name as $r):?>
		  <th class="title">
		  	<?php echo $r['name'];?> <br />
		  	<span style="color: #00f;"><?php echo $r['num'];?></span> <br />
            <?php echo $r['fax'];?> <br />
		  </th>
		  <?php endforeach;?>
	  <?php endif;?>
      
	  <th class="title"> Total bestilt </th>
      <th class="title"> Total kostpris </th>
      <th class="title"> Total BA% </th>
      
      
	</tr>
	</thead>
	<tfoot>
		<tr>
			<td colspan="<?php echo 9+count($this->items); ?>"><?php //echo $this->pagination->getListFooter(); ?> </td>
		</tr>
	</tfoot>
	<tbody>
	<?php $j = 0; $Total_kostpris = 0; $SP_ = ''; $BA_ = ''; $BA1_ = '';?>
	<?php foreach($this->items as $v):?>
	
		<tr>
		<td><?php echo $j++;?></td>
		<td><a href="index.php?option=com_dfi_kobreak&view=dfi_kobreak&task=edit&cid[]=<?php echo $v->dfi_kobreak_id;?>"><?php echo $this->escape($v->k_name); ?></a></td>
		<td>	<?php echo $this->escape($v->ean_kode); ?></td>
		<td>	<?php echo $this->escape($v->serial_number); ?></td>
		<td><?php echo $this->escape($v->product_name);?></td>
		<td align="right"><?php echo $this->escape($v->package_quantity); ?></td>
		<td align="right"><?php echo $this->escape(ws_price_format($v->nettopris)); ?></td>
		<td align="right"><?php echo $this->escape(ws_price_format($v->hvidpris));?></td>
		<td align="right"><?php echo $this->escape(ws_price_format($v->rodpris));?></td>
		<td align="right">	<?php echo $this->escape(ws_price_format($v->nupris));?></td>
		<?php $total_ordered=0;?>
		<?php foreach($v->products as $r1):?>
		<?php $total_ordered+=$r1->quantity;?>
		<td align="right"><?php echo $r1->quantity > 0 ? "<font color='red'><b>".$r1->quantity."</b></font>": 0 ;?></td>
		<?php endforeach;?>

        <td align="right"><?php echo $total_ordered;?></td>
        <td align="right">
        <?php
            
            echo $this->escape(ws_price_format($v->nettopris*$total_ordered));
            $Total_kostpris += ($v->nettopris*$total_ordered);
        ?>
        </td>
        
        <td align="right">
   
            <?php 
                $SP = $v->nupris*0.8*$total_ordered?$v->nupris*0.8*$total_ordered:1;
                $SP_ += $SP;
                $BA = $SP - ($v->nettopris*$total_ordered);
                
                $BA_ += $BA;
                
                $BA1 = $BA/$SP*100;
                echo $this->escape(ws_price_format($BA1));
            ?> 
               
		</td>

		</tr>
	<?php endforeach;?>
    
        <tr>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		<td></td>
		
		<?php if($v->products){ foreach($v->products as $r1):?>
		
		<td></td>
		<?php endforeach; };?>

        <td></td>
        <td align="right">
            <?php
            echo $this->escape(ws_price_format($Total_kostpris));
            ?>
        </td>
        
        <td align="right">
            <?php 
                if(!$SP_){
                    $SP_ = 1;
                }
                 $BA1_ = $BA_/$SP_*100;
                echo $this->escape(ws_price_format($BA1_));
            ?>
		</td>

		</tr>
    
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
