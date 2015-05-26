<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php JHTML::_('behavior.tooltip'); ?>

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
                
				v_rodpris= ((rodpris * 0.8) - (netpris) ) / (rodpris * 0.8);
				v_nuspris= ((nuspris * 0.8) - (netpris) ) / (nuspris * 0.8);
                v_hvidpris= ((hvidpris * 0.8) - (netpris) ) / (hvidpris * 0.8);


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
				v_rodpris= ((rodpris * 0.8) - (netpris) ) / (rodpris * 0.8);
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
				v_nuspris= ((nuspris * 0.8) - (netpris) ) / (nuspris * 0.8);
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
				v_hvidpris= ((nuspris * 0.8) - (netpris) ) / (nuspris * 0.8);
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

  <table>
  	<tr>
      <td colspan="2" align="center">
	  <h2>Add New Product</h2>
      </td>
    </tr>
	
    <tr>
      <td width="200" align="right" class="key"><label for="<?php echo $this->prefix; ?>dfi_supplier_id"> <?php echo JText::_( strtoupper('Dfi_supplier_id') ); ?>: </label>
      </td>
      <td><?php echo $this->lists['dfi_supplier_id']; ?>
      </td>
    </tr>
	
	<tr>
      <td width="200" align="right" class="key"><label for="<?php echo $this->prefix; ?>campaigns"> <?php echo JText::_( 'Campaigns' ); ?>: </label>
      </td>
      <td><?php echo $this->lists['campaigns']; ?>
      </td>
    </tr>

	<tr>
      <td width="100" align="right" class="key"><label for="<?php echo $this->prefix; ?>ean_kode"> <?php echo JText::_( strtoupper('Ean_kode') ); ?>: </label>
      </td>
      <td><input class="text_area" type="text" name="<?php echo $this->prefix; ?>ean_kode" id="<?php echo $this->prefix; ?>ean_kode" size="32" maxlength="250" value="<?php echo $this->dfi_product->ean_kode;?>" />
      </td>
    </tr>

	<tr>
      <td width="100" align="right" class="key"><label for="<?php echo $this->prefix; ?>serial_number"> <?php echo JText::_( strtoupper('Serial_number') ); ?>: </label>
      </td>
      <td><input class="text_area" type="text" name="<?php echo $this->prefix; ?>serial_number" id="<?php echo $this->prefix; ?>serial_number" size="32" maxlength="250" value="<?php echo $this->dfi_product->serial_number;?>" />
      </td>
    </tr>

	<tr>
      <td width="100" align="right" class="key"><label for="<?php echo $this->prefix; ?>product_name"> <?php echo JText::_( strtoupper('Product_name') ); ?>: </label>
      </td>
      <td><input class="text_area" type="text" name="<?php echo $this->prefix; ?>product_name" id="<?php echo $this->prefix; ?>product_name" size="32" maxlength="250" value="<?php echo $this->dfi_product->product_name;?>" />
      </td>
    </tr>

	<tr>
      <td width="100" align="right" class="key"><label for="<?php echo $this->prefix; ?>package_quantity"> <?php echo JText::_( strtoupper('Package_quantity') ); ?>: </label>
      </td>
      <td><input class="text_area" type="text" name="<?php echo $this->prefix; ?>package_quantity" id="<?php echo $this->prefix; ?>package_quantity" size="32" maxlength="250" value="<?php echo $this->dfi_product->package_quantity;?>" />
      </td>
    </tr>
	
	<tr>
      <td width="100" align="right" class="key"><label for="<?php echo $this->prefix; ?>quantity"> <?php echo JText::_( strtoupper('Quantity') ); ?>: </label>
      </td>
      <td><input class="text_area" type="text" name="<?php echo $this->prefix; ?>quantity" id="<?php echo $this->prefix; ?>quantity" size="32" maxlength="250" value="<?php echo $this->dfi_product->quantity;?>" />
      </td>
   </tr>
   
	<tr>
			<td width="100" align="right" class="key"><label for="<?php echo $this->prefix; ?>forced_distribution"> <?php echo JText::_( 'Tvangsfordeling' ); ?>: </label>
			</td>
			<td><?php echo $this->lists['forced_distribution']; ?>
			</td>
	</tr>
	
	<tr>
      <td width="100" align="right" class="key"><label for="<?php echo $this->prefix; ?>quantity"> <?php echo JText::_( 'Sortimentsvare' ); ?>: </label>
      </td>
      <td><?php echo $this->lists['sortimentsvare']; ?>
      </td>
    </tr>
 	<tr>
			<td width="100" align="right" class="key"><label for="<?php echo $this->prefix; ?>wee"> <?php echo JText::_( strtoupper('Weee') ); ?>: </label>
			</td>
			<td><input class="text_area" type="text" name="<?php echo $this->prefix; ?>wee" id="<? echo $this->prefix; ?>wee" size="10" maxlength="250" value="<?php echo ws_dot_to_comma($this->dfi_product->wee);?>" />&nbsp;
			</td>
		</tr>
        
        
         
        <tr>
			<td width="100" align="right" class="key"><label for="<?php echo $this->prefix; ?>sortimentsnetto"> <?php echo JText::_( 'Sortimentsnetto' ); ?>: </label>
			</td>
			<td><input class="text_area" type="text" name="<?php echo $this->prefix; ?>sortimentsnetto" id="<?php echo $this->prefix; ?>sortimentsnetto" size="10" maxlength="250" value="<?php echo ws_dot_to_comma($this->dfi_product->sortimentsnetto);?>" />&nbsp;
			</td>
		</tr>

        
        
        <tr>
			<td width="100" align="right" class="key"><label for="<?php echo $this->prefix; ?>kampagnenetto"> <?php echo JText::_( 'Kampagnenetto' ); ?>: </label>
			</td>
			<td><input class="text_area" type="text" name="<?php echo $this->prefix; ?>nettopris" id="<?php echo $this->prefix; ?>nettopris" size="10" maxlength="250" value="<?php echo ws_dot_to_comma($this->dfi_product->nettopris);?>" />&nbsp;
			</td>
		</tr>


	<tr>
      <td width="100" align="right" class="key"><label for="<?php echo $this->prefix; ?>hvidpris"> <?php echo JText::_( strtoupper('Hvidpris') ); ?>: </label>
      </td>
      <td><input class="text_area" type="text" name="<?php echo $this->prefix; ?>hvidpris" id="<?php echo $this->prefix; ?>hvidpris" size="10" maxlength="250" value="<?php echo ws_dot_to_comma($this->dfi_product->hvidpris);?>" />&nbsp;<span id="s_hvidpris"></span>
      </td>
    </tr>

	<tr>
      <td width="100" align="right" class="key"><label for="<?php echo $this->prefix; ?>rodpris"> <?php echo JText::_( 'Før/efter' ); ?>: </label>
      </td>
      <td><input class="text_area" type="text" name="<?php echo $this->prefix; ?>rodpris" id="<?php echo $this->prefix; ?>rodpris" size="10" maxlength="250" value="<?php echo ws_dot_to_comma($this->dfi_product->rodpris);?>" />&nbsp;<span id="s_rodpris"></span>
      </td>
    </tr>
	
	<tr>
      <td width="100" align="right" class="key"><label for="<?php echo $this->prefix; ?>nupris"> <?php echo JText::_( 'Nu pris' ); ?>: </label>
      </td>
      <td><input class="text_area" type="text" name="<?php echo $this->prefix; ?>nupris" id="<?php echo $this->prefix; ?>nupris" size="10" maxlength="250" value="<?php echo ws_dot_to_comma($this->dfi_product->nupris);?>" />&nbsp;<span id="s_nuspris"></span>
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

  <div class="clr"></div>
  <input type="hidden" name="option" value="com_dfi_product" />
  <input type="hidden" name="cid[]" value="<?php echo $this->dfi_product->dfi_product_id; ?>" />
  <input type="hidden" name="task" value="active_save" />
  <?php echo JHTML::_( 'form.token' ); ?>
</form>
