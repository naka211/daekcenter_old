<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php JHTML::_('behavior.tooltip'); ?>
<?php
	// Set toolbar items for the page
	$edit		= JRequest::getVar('edit',true);
	$text = !$edit ? JText::_( 'New' ) : JText::_( 'Edit' );
	JToolBarHelper::title(   JText::_( strtoupper('Dfi_order') ).': <small><small>[ ' . $text.' ]</small></small>' );
	JToolBarHelper::save();
	if (!$edit)  {
		JToolBarHelper::cancel();
	} else {
		// for existing items the button is renamed `close`
		JToolBarHelper::cancel( 'cancel', 'Close' );
	}
?>
<script language="javascript" src="<?php echo $this->lists['comdir']; ?>dfi_order.js"></script>
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
</script>
<form action="<?php echo $this->action; ?>" method="post" name="adminForm" id="adminForm">
<div class="col width-70">
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'Details' ); ?></legend>
  <table class="admintable">
    <tr>
      <td width="100" align="right" class="key"><label for="<?php echo $this->prefix; ?>dfi_shop_id"> <?php echo JText::_( strtoupper('Dfi_shop_id') ); ?>: </label>
      </td>
      <td><?php echo $this->lists['dfi_shop_id'];?>
      </td>
    </tr>

	<tr>
      <td width="100" align="right" class="key"><label for="<?php echo $this->prefix; ?>dfi_kobreak_id"> <?php echo JText::_( strtoupper('Dfi_kobreak_id') ); ?>: </label>
      </td>
      <td><?php echo $this->lists['dfi_kobreak_id'];?>
      </td>
    </tr>

	<tr>
      <td width="100" align="right" class="key"><label for="<?php echo $this->prefix; ?>dfi_order_status_id"> <?php echo JText::_( strtoupper('Dfi_order_status_id') ); ?>: </label>
      </td>
      <td><?php echo $this->lists['dfi_order_status_id'];?>
      </td>
    </tr> 

	<tr>
      <td valign="top" align="right" class="key"><label for="<?php echo $this->prefix; ?>note"> <?php echo JText::_( strtoupper('Note') ); ?>: </label>
      </td>
      <td><?php
				// parameters : areaname, content, width, height, cols, rows, show xtd buttons
				echo $this->editor->display( $this->prefix.'note',  $this->dfi_order->note, '500', '300', '60', '20', array('pagebreak', 'readmore') ) ;
							?>
      </td>
    </tr>
  </table>
</fieldset>
</div>
<div class="col width-30">
	<?php
			echo $this->pane->startPane("params-pane");
			$title = JText::_( strtoupper('Parameters') );			
			echo $this->pane->startPanel( $title, "detail-page" );
		?>
		<table class="admintable">
	
	<tr>
      <td width="100" align="right" class="key"><label for=""> <?php echo JText::_( 'Products' ); ?>: </label>
      </td>
      <td>
	  <a class="<?php echo $this->button->modalname; ?>" title="" href="<?php echo 'index.php?option=com_dfi_order_product&amp;view=active_checkbox&amp;tmpl=component&amp;checkbox_id='.$this->dfi_order->dfi_order_id; ?>" rel="<?php echo $this->button->options; ?>" ><?php echo JText::_( 'Assign Products To This Order' ); ?></a>
      </td>
    </tr>
	
	<tr>
      <td valign="top" align="right" class="key"><label for="<?php echo $this->prefix; ?>received"> <?php echo JText::_( 'Received' ); ?>: </label>
      </td>
      <td colspan="2" valign="middle"><?php echo JHTML::_('calendar', $this->dfi_order->received?$this->lists['received']:'', $this->prefix.'received', $this->prefix.'received', "%Y-%m-%d %H:%M", array('class'=>'inputbox', 'size'=>'25',  'maxlength'=>'45')); ?> </td>
    </tr>

	<tr>
      <td valign="top" align="right" class="key"><label for="<?php echo $this->prefix; ?>created"> <?php echo JText::_( strtoupper('Created') ); ?>: </label>
      </td>
      <td colspan="2" valign="middle"><?php echo JHTML::_('calendar', $this->dfi_order->created?$this->lists['created']:'', $this->prefix.'created', $this->prefix.'created', "%Y-%m-%d", array('class'=>'inputbox', 'size'=>'25',  'maxlength'=>'45')); ?> </td>
    </tr>

	<tr>
      <td valign="top" align="right" class="key"><label for="<?php echo $this->prefix; ?>modified"> <?php echo JText::_( strtoupper('Sent to administrator') ); ?>: </label>
      </td>
      <td colspan="2" valign="middle"><?php echo JHTML::_('calendar', $this->dfi_order->modified?$this->lists['modified']:'', $this->prefix.'modified', $this->prefix.'modified', "%Y-%m-%d", array('class'=>'inputbox', 'size'=>'25',  'maxlength'=>'45')); ?> </td>
    </tr>

	<tr>
      <td valign="top" align="right" class="key"><label for="<?php echo $this->prefix; ?>sent"> <?php echo JText::_( strtoupper('Sent to supplier') ); ?>: </label>
      </td>
      <td colspan="2" valign="middle"><?php echo JHTML::_('calendar', $this->dfi_order->sent?$this->lists['sent']:'', $this->prefix.'sent', $this->prefix.'sent', "%Y-%m-%d", array('class'=>'inputbox', 'size'=>'25',  'maxlength'=>'45')); ?> </td>
    </tr>
				
		</table>
	<?php
				echo $this->pane->endPanel();
			//	$title = JText::_( strtoupper('Parameters (Advanced)') );
			//echo $this->pane->startPanel( $title, "detail-page" );
			//echo $this->params->render('params');
			//echo $this->pane->endPanel();
				echo $this->pane->endPane();
		?>	
</div>   
  <div class="clr"></div>
  <input type="hidden" name="option" value="com_dfi_order" />
  <input type="hidden" name="cid[]" value="<?php echo $this->dfi_order->dfi_order_id; ?>" />
  <input type="hidden" name="task" value="" />
  <?php echo JHTML::_( 'form.token' ); ?>
</form>
