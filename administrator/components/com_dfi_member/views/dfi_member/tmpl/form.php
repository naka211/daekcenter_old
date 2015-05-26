<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php JHTML::_('behavior.tooltip'); ?>
<?php
	// Set toolbar items for the page
	$edit		= JRequest::getVar('edit',true);
	$text = !$edit ? JText::_( 'New' ) : JText::_( 'Edit' );
	JToolBarHelper::title(   JText::_( strtoupper('Dfi_member') ).': <small><small>[ ' . $text.' ]</small></small>' );
	JToolBarHelper::save();
	if (!$edit)  {
		JToolBarHelper::cancel();
	} else {
		// for existing items the button is renamed `close`
		JToolBarHelper::cancel( 'cancel', 'Close' );
	}
?>
<script language="javascript" src="<?php echo $this->lists['comdir']; ?>dfi_member.js"></script>
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
<!--<div class="col width-70">
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'Details' ); ?></legend>-->
  <table class="admintable">
    <tr>
      <td width="100" align="right" class="key"><label for="<?php echo $this->prefix; ?>user_id"> <?php echo JText::_( strtoupper('User_id') ); ?>: </label>
      </td>
      <td><input class="text_area" type="text" name="<?php echo $this->prefix; ?>user_id" id="<?php echo $this->prefix; ?>user_id" size="32" maxlength="250" value="<?php echo $this->dfi_member->user_id;?>" />
      </td>
    </tr>

	<tr>
      <td width="100" align="right" class="key"><label for="<?php echo $this->prefix; ?>dfi_shop_id"> <?php echo JText::_( strtoupper('Dfi_shop_id') ); ?>: </label>
      </td>
      <td><input class="text_area" type="text" name="<?php echo $this->prefix; ?>dfi_shop_id" id="<?php echo $this->prefix; ?>dfi_shop_id" size="32" maxlength="250" value="<?php echo $this->dfi_member->dfi_shop_id;?>" />
      </td>
    </tr>

	<tr>
      <td width="100" align="right" class="key"><label for="<?php echo $this->prefix; ?>role"> <?php echo JText::_( strtoupper('Role') ); ?>: </label>
      </td>
      <td><input class="text_area" type="text" name="<?php echo $this->prefix; ?>role" id="<?php echo $this->prefix; ?>role" size="32" maxlength="250" value="<?php echo $this->dfi_member->role;?>" />
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
		?>
		<table class="admintable">
		<tr>
			<td colspan="2">
				<a class="<?php echo $this->button->modalname; ?>" title="" href="<?php echo 'index.php?option=com_dfi_member&amp;view=active_checkbox&amp;tmpl=component&amp;checkbox_id='.$this->dfi_member->dfi_member_id; ?>" rel="<?php echo $this->button->options; ?>" ><?php echo JText::_( strtoupper('Assign Value') ); ?></a>
			</td>
		</tr>
		
		<tr>
			<td colspan="2">
		<a class="<?php echo $this->button->modalname; ?>" title="" href="<?php echo 'index.php?option=com_dfi_member&amp;view=active_radio&amp;tmpl=component&amp;object='.$this->prefix; ?>dfi_member_id" rel="<?php echo $this->button->options; ?>" ><?php echo JText::_( strtoupper('Select Value') ); ?></a>
			</td>
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
</div>   -->
  <div class="clr"></div>
  <input type="hidden" name="option" value="com_dfi_member" />
  <input type="hidden" name="cid[]" value="<?php echo $this->dfi_member->dfi_member_id; ?>" />
  <input type="hidden" name="task" value="" />
  <?php echo JHTML::_( 'form.token' ); ?>
</form>
