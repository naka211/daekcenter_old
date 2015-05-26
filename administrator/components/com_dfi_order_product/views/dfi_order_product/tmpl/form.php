<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php JHTML::_('behavior.tooltip'); ?>
<?php
	// Set toolbar items for the page
	$edit		= JRequest::getVar('edit',true);
	$text = !$edit ? JText::_( 'New' ) : JText::_( 'Edit' );
	JToolBarHelper::title(   JText::_( strtoupper('Dfi_order_product') ).': <small><small>[ ' . $text.' ]</small></small>' );
	JToolBarHelper::save();
	if (!$edit)  {
		JToolBarHelper::cancel();
	} else {
		// for existing items the button is renamed `close`
		JToolBarHelper::cancel( 'cancel', 'Close' );
	}
?>
<script language="javascript" src="<?php echo $this->lists['comdir']; ?>dfi_order_product.js"></script>
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
<form action="index.php?option=com_dfi_order_product" method="post" name="adminForm" id="adminForm">
<!--<div class="col width-70">
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'Details' ); ?></legend>-->
  <table class="admintable">
    <tr>
      <td width="100" align="right" class="key"><label for="<? echo $this->prefix; ?>dfi_order_id"> <?php echo JText::_( strtoupper('Dfi_order_id') ); ?>: </label>
      </td>
      <td><input class="text_area" type="text" name="<? echo $this->prefix; ?>dfi_order_id" id="<? echo $this->prefix; ?>dfi_order_id" size="32" maxlength="250" value="<?php echo $this->dfi_order_product->dfi_order_id;?>" />
      </td>
    </tr>

	<tr>
      <td width="100" align="right" class="key"><label for="<? echo $this->prefix; ?>dfi_product_id"> <?php echo JText::_( strtoupper('Dfi_product_id') ); ?>: </label>
      </td>
      <td><input class="text_area" type="text" name="<? echo $this->prefix; ?>dfi_product_id" id="<? echo $this->prefix; ?>dfi_product_id" size="32" maxlength="250" value="<?php echo $this->dfi_order_product->dfi_product_id;?>" />
      </td>
    </tr>

	<tr>
      <td width="100" align="right" class="key"><label for="<? echo $this->prefix; ?>quantity"> <?php echo JText::_( strtoupper('Quantity') ); ?>: </label>
      </td>
      <td><input class="text_area" type="text" name="<? echo $this->prefix; ?>quantity" id="<? echo $this->prefix; ?>quantity" size="32" maxlength="250" value="<?php echo $this->dfi_order_product->quantity;?>" />
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
				<a class="<?php echo $this->button->modalname; ?>" title="" href="<?php echo 'index.php?option=com_dfi_order_product&amp;view=active_checkbox&amp;tmpl=component'; ?>" rel="<?php echo $this->button->options; ?>" ><?php echo JText::_( strtoupper('Assign Value') ); ?></a>
			</td>
		</tr>
		</table>
	<?
				echo $this->pane->endPanel();
				echo $this->pane->endPane();
		?>	
</div>   -->
  <div class="clr"></div>
  <input type="hidden" name="option" value="com_dfi_order_product" />
  <input type="hidden" name="cid[]" value="<?php echo $this->dfi_order_product->dfi_order_product_id; ?>" />
  <input type="hidden" name="task" value="" />
  <?php echo JHTML::_( 'form.token' ); ?>
</form>
