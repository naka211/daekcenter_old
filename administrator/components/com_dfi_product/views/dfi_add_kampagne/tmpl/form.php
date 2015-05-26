<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php JHTML::_('behavior.tooltip'); ?>
<?php
// Set toolbar items for the page
$edit		= JRequest::getVar('edit',true);
$text = !$edit ? JText::_( 'New' ) : JText::_( 'Edit' );
JToolBarHelper::title(   JText::_( strtoupper('Dfi_product') ).': <small><small>[ ' . $text.' ]</small></small>' );
JToolBarHelper::save();
if (!$edit)  {
	JToolBarHelper::cancel();
} else {
	// for existing items the button is renamed `close`
	JToolBarHelper::cancel( 'cancel', 'Close' );
}
?>

<script language="javascript" src="<?php echo $this->lists['comdir']; ?>jquery-1.4.4.min.js"></script>
	<script type="text/javascript">
	$.noConflict();
	jQuery(document).ready(function($) {
		var v_rodpris=0;

		$('#dfi_product_wee').keypress(function(event){
			/* •	(Før-efter x 0,8) – (nettopris + WEEE) / (Før-efter x 0,8) x 100 = Avance procent (no decimal) */
			/* •	(Nu pris x 0,8) – (nettopris + WEEE) / (Nu pris x 0,8) x 100 = Avance procent (no decimal) */
			setTimeout(function() {
				wee=parseFloat($('#dfi_product_wee').val());
				if(wee <= 0){ wee=0;}
				netpris=parseFloat($('#dfi_product_nettopris').val());
				rodpris=parseFloat($('#dfi_product_rodpris').val());
				nuspris=parseFloat($('#dfi_product_nupris').val());
                hvidpris=parseFloat($('#dfi_product_hvidpris').val());
				v_rodpris= ((rodpris * 0.8) - (netpris + wee) ) / (rodpris * 0.8);
				v_nuspris= ((nuspris * 0.8) - (netpris + wee) ) / (nuspris * 0.8);
                v_hvidpris= ((hvidpris * 0.8) - (netpris + wee) ) / (hvidpris * 0.8);

				$('#s_rodpris').html((Math.round(v_rodpris*100)) + '%');
				$('#s_nuspris').html((Math.round(v_nuspris*100)) + '%');
                $('#s_hvidpris').html((Math.round(v_hvidpris*100)) + '%');
			}, 50);

		});
		
		$('#dfi_product_rodpris').keypress(function(){
			setTimeout(function() {
				wee=parseFloat($('#dfi_product_wee').val());
				if(wee <= 0){ wee=0;}
				netpris=parseFloat($('#dfi_product_nettopris').val());
				rodpris=parseFloat($('#dfi_product_rodpris').val());	
				v_rodpris= ((rodpris * 0.8) - (netpris + wee) ) / (rodpris * 0.8);
				$('#s_rodpris').html((Math.round(v_rodpris*100)) + '%');
				
			}, 50);
		});
		
		$('#dfi_product_nupris').keypress(function(event){
			/* •	(Før-efter x 0,8) – (nettopris + WEEE) / (Før-efter x 0,8) x 100 = Avance procent (no decimal) */
			/* •	(Nu pris x 0,8) – (nettopris + WEEE) / (Nu pris x 0,8) x 100 = Avance procent (no decimal) */
			setTimeout(function() {
				wee=parseFloat($('#dfi_product_wee').val());
				if(wee <= 0){ wee=0;}
				netpris=parseFloat($('#dfi_product_nettopris').val());
				nuspris=parseFloat($('#dfi_product_nupris').val());
				v_nuspris= ((nuspris * 0.8) - (netpris + wee) ) / (nuspris * 0.8);
				$('#s_nuspris').html((Math.round(v_nuspris*100)) + '%');
			}, 50);

		});
        

        /****/
        $('#dfi_product_hvidpris').keypress(function(event){
		
            setTimeout(function() {
				wee=parseFloat($('#dfi_product_wee').val());
				if(wee <= 0){ wee=0;}
				netpris=parseFloat($('#dfi_product_nettopris').val());
				nuspris=parseFloat($('#dfi_product_hvidpris').val());
				v_hvidpris= ((nuspris * 0.8) - (netpris + wee) ) / (nuspris * 0.8);
				$('#s_hvidpris').html((Math.round(v_hvidpris*100)) + '%');
			}, 50);

		});
        
        
        /****/
	});

	</script>


<script language="javascript" src="<?php echo $this->lists['comdir']; ?>dfi_product.js"></script>
<script language="javascript" type="text/javascript">
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		if (pressbutton == 'cancel') {
			submitform( pressbutton );
			return;
		}

		// do field validation
		submitform( pressbutton );
	}
</script>
<form action="index.php?option=com_dfi_product&tmpl=component" method="post" name="adminForm" id="adminForm">
	<!--<div class="col width-70">
	<fieldset class="adminform">
	<legend><?php echo JText::_( 'Details' ); ?></legend>-->
	<table class="admintable">
		<tr>
			<td width="100" align="right" class="key"><label for="<? echo $this->prefix; ?>dfi_supplier_id"> <?php echo JText::_( strtoupper('Dfi_supplier_id') ); ?>: </label>
			</td>
			<td><? echo $this->lists['dfi_supplier_id']; ?>
			</td>
		</tr>

		<tr>
			<td width="200" align="right" class="key"><label for="<? echo $this->prefix; ?>campaigns"> <?php echo JText::_( 'Campaigns' ); ?>: </label>
			</td>
			<td><? echo $this->lists['campaigns']; ?>
			</td>
		</tr>

        
        
		<tr>
			<td width="100" align="right" class="key"><label for="<? echo $this->prefix; ?>ean_kode"> <?php echo JText::_( strtoupper('Ean_kode') ); ?>: </label>
			</td>
			<td><input class="text_area" type="text" name="<? echo $this->prefix; ?>ean_kode" id="<? echo $this->prefix; ?>ean_kode" size="32" maxlength="250" value="<?php echo $this->dfi_product->ean_kode;?>" />
			</td>
		</tr>

		<tr>
			<td width="100" align="right" class="key"><label for="<? echo $this->prefix; ?>serial_number"> <?php echo JText::_( strtoupper('Serial_number') ); ?>: </label>
			</td>
			<td><input class="text_area" type="text" name="<? echo $this->prefix; ?>serial_number" id="<? echo $this->prefix; ?>serial_number" size="32" maxlength="250" value="<?php echo $this->dfi_product->serial_number;?>" />
			</td>
		</tr>

		<tr>
			<td width="100" align="right" class="key"><label for="<? echo $this->prefix; ?>product_name"> <?php echo JText::_( strtoupper('Product_name') ); ?>: </label>
			</td>
			<td><input class="text_area" type="text" name="<? echo $this->prefix; ?>product_name" id="<? echo $this->prefix; ?>product_name" size="32" maxlength="250" value="<?php echo $this->dfi_product->product_name;?>" />
			</td>
		</tr>

		<tr>
			<td width="100" align="right" class="key"><label for="<? echo $this->prefix; ?>package_quantity"> <?php echo JText::_( strtoupper('Package_quantity') ); ?>: </label>
			</td>
			<td><input class="text_area" type="text" name="<? echo $this->prefix; ?>package_quantity" id="<? echo $this->prefix; ?>package_quantity" size="32" maxlength="250" value="<?php echo $this->dfi_product->package_quantity;?>" />
			</td>
		</tr>

		<tr>
			<td width="100" align="right" class="key"><label for="<? echo $this->prefix; ?>quantity"> <?php echo JText::_( strtoupper('Quantity') ); ?>: </label>
			</td>
			<td><input class="text_area" type="text" name="<? echo $this->prefix; ?>quantity" id="<? echo $this->prefix; ?>quantity" size="32" maxlength="250" value="<?php echo $this->dfi_product->quantity;?>" />
			</td>
		</tr>
		
		<tr>
			<td width="100" align="right" class="key"><label for="<? echo $this->prefix; ?>forced_distribution"> <?php echo JText::_( 'Tvangsfordeling' ); ?>: </label>
			</td>
			<td><?php echo $this->lists['forced_distribution']; ?>
			</td>
		</tr>
		
		<tr>
			<td width="100" align="right" class="key"><label for="<? echo $this->prefix; ?>quantity"> <?php echo JText::_( 'Sortimentsvare' ); ?>: </label>
			</td>
			<td><?php echo $this->lists['sortimentsvare']; ?>
			</td>
		</tr>
		<tr>
			<td width="100" align="right" class="key"><label for="<? echo $this->prefix; ?>wee"> <?php echo JText::_( strtoupper('Weee') ); ?>: </label>
			</td>
			<td><input class="text_area" type="text" name="<? echo $this->prefix; ?>wee" id="<? echo $this->prefix; ?>wee" size="10" maxlength="250" value="<?php echo ws_dot_to_comma($this->dfi_product->wee);?>" />&nbsp;
			</td>
		</tr>
        
        <tr>
			<td width="100" align="right" class="key"><label for="<? echo $this->prefix; ?>sortimentsnetto"> <?php echo JText::_( 'Sortimentsnetto' ); ?>: </label>
			</td>
			<td><input class="text_area" type="text" name="<? echo $this->prefix; ?>sortimentsnetto" id="<? echo $this->prefix; ?>sortimentsnetto" size="10" maxlength="250" value="<?php echo ws_dot_to_comma($this->dfi_product->sortimentsnetto);?>" />&nbsp;
			</td>
		</tr>

        
		<tr>
			<td width="100" align="right" class="key"><label for="<? echo $this->prefix; ?>kampagnenetto"> <?php echo JText::_( 'Kampagnenetto' ); ?>: </label>
			</td>
			<td><input class="text_area" type="text" name="<? echo $this->prefix; ?>nettopris" id="<? echo $this->prefix; ?>nettopris" size="10" maxlength="250" value="<?php echo ws_dot_to_comma($this->dfi_product->nettopris);?>" />&nbsp;
			</td>
		</tr>



		<tr>
			<td width="100" align="right" class="key"><label for="<? echo $this->prefix; ?>hvidpris"> <?php echo JText::_( strtoupper('Hvidpris') ); ?>: </label>
			</td>
			<td><input class="text_area" type="text" name="<? echo $this->prefix; ?>hvidpris" id="<? echo $this->prefix; ?>hvidpris" size="10" maxlength="250" value="<?php echo ws_dot_to_comma($this->dfi_product->hvidpris);?>" />&nbsp; <span id="s_hvidpris"><?php if($this->v_hvidpris > 0):?><?php echo $this->v_hvidpris .'%';?><?php endif;?></span>
			</td>
		</tr>
		
		<tr>
			<td width="100" align="right" class="key"><label for="<? echo $this->prefix; ?>rodpris"> <?php echo JText::_( strtoupper('Rodpris') ); ?>: </label>
			</td>
			<td><input class="text_area" type="text" name="<? echo $this->prefix; ?>rodpris" id="<? echo $this->prefix; ?>rodpris" size="10" maxlength="250" value="<?php echo ws_dot_to_comma($this->dfi_product->rodpris);?>" />&nbsp; <span id="s_rodpris"><?php if($this->v_rodpris > 0):?><?php echo $this->v_rodpris .'%';?><?php endif;?></span>
			</td>
		</tr>

		<tr>
			<td width="100" align="right" class="key"><label for="<? echo $this->prefix; ?>nupris"> <?php echo JText::_( strtoupper('Nupris') ); ?>: </label>
			</td>
			<td>
				<input class="text_area" type="text" name="<? echo $this->prefix; ?>nupris" id="<? echo $this->prefix; ?>nupris" size="10" maxlength="250" value="<?php echo ws_dot_to_comma($this->dfi_product->nupris);?>" />&nbsp; <span id="s_nuspris"><?php if($this->v_nuspris > 0):?><?php echo $this->v_nuspris .'%';?><?php endif;?></span>
			</td>
		</tr>
        
        <tr>
              <td width="100" align="right" class="key">&nbsp;
        	  		  	
              </td>
              <td>
        	  	<input type="submit" value="Save" name="Save" />
        		<input type="button" value="Cancel" onclick="window.history.go(-1)" />
              </td>
        </tr> 
	</table>
	<!--</fieldset>
	</div>
	<div class="col width-30">
	<?php
	echo $this->pane->startPane("params-pane");
	$title = JText::_( strtoupper('Parameters') );
	echo $this->pane->startPanel( $title, "detail-page" );
	//echo $this->params->render('params');
	//echo $this->pane->endPanel();

	echo $this->pane->startPanel( $title, "detail-page" );
	?>
	<table class="admintable">
	<tr>
	<td colspan="2">
	<a class="<?php echo $this->button->modalname; ?>" title="" href="<?php echo 'index.php?option=com_dfi_product&amp;view=active_checkbox&amp;tmpl=component'; ?>" rel="<?php echo $this->button->options; ?>" ><?php echo JText::_( strtoupper('Assign Value') ); ?></a>
	</td>
	</tr>
	</table>
	<?
	echo $this->pane->endPanel();
	echo $this->pane->endPane();
	?>
	</div>   -->
	<div class="clr"></div>
	<input type="hidden" name="option" value="com_dfi_product" />
	<input type="hidden" name="cid[]" value="<?php echo $this->dfi_product->dfi_product_id; ?>" />
	<input type="hidden" name="task" value="" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>
