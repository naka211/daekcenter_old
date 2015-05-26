<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php JHTML::_('behavior.tooltip'); ?>
<?php
	// Set toolbar items for the page
	$edit		= JRequest::getVar('edit',true);
	$text = !$edit ? JText::_( 'New' ) : JText::_( 'Edit' );
	JToolBarHelper::title(   JText::_( strtoupper('Dfi_supplier') ).': <small><small>[ ' . $text.' ]</small></small>' );
	JToolBarHelper::save();
	if (!$edit)  {
		JToolBarHelper::cancel();
	} else {
		// for existing items the button is renamed `close`
		JToolBarHelper::cancel( 'cancel', 'Close' );
	}
?>
<script language="javascript" src="<?php echo $this->lists['comdir']; ?>dfi_supplier.js"></script>
<script language="javascript" type="text/javascript">
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		if (pressbutton == 'cancel') {
			submitform( pressbutton );
			return;
		}
		
		/*if (form.catid.value == 0)
		{
			alert('<?php echo JText::_( 'Please select a category' ); ?>');
			return;
		}*/

		// do field validation
		submitform( pressbutton );
	}
	
	function jSelectItem(id, title, object) {
		document.getElementById(object).value = id;
		document.getElementById(object + '_name').value = title;
		document.getElementById('sbox-window').close();
	}
</script>
<form action="index.php?option=com_dfi_supplier" method="post" name="adminForm" id="adminForm">
<!--<div class="col width-70">
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'Details' ); ?></legend>-->
  <table class="admintable">
    <tr>
      <td width="100" align="right" class="key"><label for="<? echo $this->prefix; ?>name"> <?php echo JText::_( strtoupper('Name') ); ?>: </label>
      </td>
      <td><input class="text_area" type="text" name="<? echo $this->prefix; ?>name" id="<? echo $this->prefix; ?>name" size="32" maxlength="250" value="<?php echo $this->dfi_supplier->name;?>" />
      </td>
    </tr>

	<tr>
      <td width="100" align="right" class="key"><label for="<? echo $this->prefix; ?>address"> <?php echo JText::_( strtoupper('Address') ); ?>: </label>
      </td>
      <td><input class="text_area" type="text" name="<? echo $this->prefix; ?>address" id="<? echo $this->prefix; ?>address" size="32" maxlength="250" value="<?php echo $this->dfi_supplier->address;?>" />
      </td>
    </tr>

	<tr>
      <td width="100" align="right" class="key"><label for="<? echo $this->prefix; ?>postalcode"> <?php echo JText::_( strtoupper('Postalcode') ); ?>: </label>
      </td>
      <td><input class="text_area" type="text" name="<? echo $this->prefix; ?>postalcode" id="<? echo $this->prefix; ?>postalcode" size="32" maxlength="250" value="<?php echo $this->dfi_supplier->postalcode;?>" />
      </td>
    </tr>

	<tr>
      <td width="100" align="right" class="key"><label for="<? echo $this->prefix; ?>city"> <?php echo JText::_( strtoupper('City') ); ?>: </label>
      </td>
      <td><input class="text_area" type="text" name="<? echo $this->prefix; ?>city" id="<? echo $this->prefix; ?>city" size="32" maxlength="250" value="<?php echo $this->dfi_supplier->city;?>" />
      </td>
    </tr>

	<tr>
      <td width="100" align="right" class="key"><label for="<? echo $this->prefix; ?>telephone"> <?php echo JText::_( strtoupper('Telephone') ); ?>: </label>
      </td>
      <td><input class="text_area" type="text" name="<? echo $this->prefix; ?>telephone" id="<? echo $this->prefix; ?>telephone" size="32" maxlength="250" value="<?php echo $this->dfi_supplier->telephone;?>" />
      </td>
    </tr>

	<tr>
      <td width="100" align="right" class="key"><label for="<? echo $this->prefix; ?>fax"> <?php echo JText::_( strtoupper('Fax') ); ?>: </label>
      </td>
      <td><input class="text_area" type="text" name="<? echo $this->prefix; ?>fax" id="<? echo $this->prefix; ?>fax" size="32" maxlength="250" value="<?php echo $this->dfi_supplier->fax;?>" />
      </td>
    </tr>

	<tr>
      <td width="100" align="right" class="key"><label for="<? echo $this->prefix; ?>email"> <?php echo JText::_( strtoupper('Email') ); ?>: </label>
      </td>
      <td><input class="text_area" type="text" name="<? echo $this->prefix; ?>email" id="<? echo $this->prefix; ?>email" size="32" maxlength="250" value="<?php echo $this->dfi_supplier->email;?>" />
      </td>
    </tr>

	<tr>
      <td width="100" align="right" class="key"><label for="<? echo $this->prefix; ?>contact_1"> <?php echo JText::_( strtoupper('Contact_1') ); ?>: </label>
      </td>	  
      <td><input class="text_area" type="text" name="<? echo $this->prefix; ?>contact_1" id="<? echo $this->prefix; ?>contact_1" size="32" maxlength="250" value="<?php echo $this->dfi_supplier->contact_1;?>" /></a>
      </td>
    </tr>
	
	<tr>
      <td width="100" align="right" class="key"><label for="<? echo $this->prefix; ?>contact_2"> <?php echo JText::_( strtoupper('Contact_2') ); ?>: </label>
      </td>	  
      <td><input class="text_area" type="text" name="<? echo $this->prefix; ?>contact_2" id="<? echo $this->prefix; ?>contact_2" size="32" maxlength="250" value="<?php echo $this->dfi_supplier->contact_2;?>" /></a>
      </td>
    </tr>
	
	<tr>
      <td width="100" align="right" class="key"><label for="<? echo $this->prefix; ?>contact_3"> <?php echo JText::_( strtoupper('Contact_3') ); ?>: </label>
      </td>	  
      <td><input class="text_area" type="text" name="<? echo $this->prefix; ?>contact_3" id="<? echo $this->prefix; ?>contact_3" size="32" maxlength="250" value="<?php echo $this->dfi_supplier->contact_3;?>" /></a>
      </td>
    </tr>

	<tr>
      <td valign="top" align="right" class="key"><label for="<? echo $this->prefix; ?>payment_terms"> <?php echo JText::_( strtoupper('Payment_terms') ); ?>: </label>
      </td>
      <td><?php
							// parameters : areaname, content, width, height, cols, rows, show xtd buttons
							echo $this->editor->display( $this->prefix.'payment_terms',  $this->dfi_supplier->payment_terms, '500', '300', '60', '20', array('pagebreak', 'readmore') ) ;
							?>
      </td>
    </tr>

	<tr>
      <td valign="top" align="right" class="key"><label for="<? echo $this->prefix; ?>kampagnevalutering"> <?php echo JText::_( strtoupper('Kampagnevalutering') ); ?>: </label>
      </td>
      <td><?php
							// parameters : areaname, content, width, height, cols, rows, show xtd buttons
							echo $this->editor->display( $this->prefix.'kampagnevalutering',  $this->dfi_supplier->kampagnevalutering, '500', '300', '60', '20', array('pagebreak', 'readmore') ) ;
							?>
      </td>
    </tr>

	<tr>
      <td valign="top" align="right" class="key"><label for="<? echo $this->prefix; ?>julevalutering"> <?php echo JText::_( strtoupper('Julevalutering') ); ?>: </label>
      </td>
      <td><?php
							// parameters : areaname, content, width, height, cols, rows, show xtd buttons
							echo $this->editor->display( $this->prefix.'julevalutering',  $this->dfi_supplier->julevalutering, '500', '300', '60', '20', array('pagebreak', 'readmore') ) ;
							?>
      </td>
    </tr>

	<tr>
      <td valign="top" align="right" class="key"><label for="<? echo $this->prefix; ?>delivery_terms"> <?php echo JText::_( strtoupper('Delivery_terms') ); ?>: </label>
      </td>
      <td><?php
							// parameters : areaname, content, width, height, cols, rows, show xtd buttons
							echo $this->editor->display( $this->prefix.'delivery_terms',  $this->dfi_supplier->delivery_terms, '500', '300', '60', '20', array('pagebreak', 'readmore') ) ;
							?>
      </td>
    </tr> 
  </table>
<!--</fieldset>
</div>
<div class="col width-30">
	<?php
			echo $this->pane->startPane("params-pane");
			$title = JText::_( strtoupper('Parameters') );
			//echo $this->pane->startPanel( $title, "detail-page" );
			//echo $this->params->render('params');
			//echo $this->pane->endPanel();
			
			echo $this->pane->startPanel( $title, "detail-page" );
		?>
		<table class="admintable">
		<tr>
			<td colspan="2">
				<a class="<?php echo $this->button->modalname; ?>" title="" href="<?php echo 'index.php?option=com_dfi_supplier&amp;view=active_checkbox&amp;tmpl=component'; ?>" rel="<?php echo $this->button->options; ?>" ><?php echo JText::_( strtoupper('Assign Value') ); ?></a>
			</td>
		</tr>
		</table>
	<?
				echo $this->pane->endPanel();
				echo $this->pane->endPane();
		?>	
</div>   -->
  <div class="clr"></div>
  <input type="hidden" name="option" value="com_dfi_supplier" />
  <input type="hidden" name="cid[]" value="<?php echo $this->dfi_supplier->dfi_supplier_id; ?>" />
  <input type="hidden" name="task" value="" />
  <?php echo JHTML::_( 'form.token' ); ?>
</form>
