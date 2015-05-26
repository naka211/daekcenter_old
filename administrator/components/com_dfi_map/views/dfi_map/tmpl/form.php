<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php JHTML::_('behavior.tooltip'); 

$db = &JFactory::getDBO();
$query = "SELECT * FROM #__dfi_shops";
$db->setQuery($query);
$row1 = $db->loadObjectList();
?>
<?php
	// Set toolbar items for the page
	$edit		= JRequest::getVar('edit',true);
	$text = !$edit ? JText::_( 'New' ) : JText::_( 'Edit' );
	JToolBarHelper::title(   JText::_( strtoupper('Dfi_map') ).': <small><small>[ ' . $text.' ]</small></small>' );
	JToolBarHelper::save();
	if (!$edit)  {
		JToolBarHelper::cancel();
	} else {
		// for existing items the button is renamed `close`
		JToolBarHelper::cancel( 'cancel', 'Close' );
	}
?>
<script language="javascript" src="<?php echo $this->lists['comdir']; ?>dfi_map.js"></script>
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
<form action="index.php?option=com_dfi_map" method="post" name="adminForm" id="adminForm">
<div class="col width-70">
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'Details' ); ?></legend>
  <table class="admintable">
    <tr>
      <td width="100" align="right" class="key"><label for="<?php echo $this->prefix; ?>dfi_shop_id"> <?php echo JText::_( strtoupper('Dfi_shop_id') ); ?>: </label>
      </td>
      <td>
	   <select name="type" id="type">
        	<option>--Select Shop--</option>
			<?php for($k=0; $k<count($row1);$k++) {?>
            <option value="<?php echo $row1[$k]->dfi_shop_id;?>" <?php if($row1[$k]->dfi_shop_id == $this->dfi_map->dfi_shop_id) echo 'selected="selected"';?> ><?php echo $row1[$k]->company_name;?></option>
			<?php }?>
        </select>
	  <?php //echo $this->lists['dfi_shop_id']; ?>
      </td>
    </tr>

	<tr>
      <td width="100" align="right" class="key"><label for="<?php echo $this->prefix; ?>x_value"> <?php echo JText::_( strtoupper('X_value') ); ?>: </label>
      </td>
      <td><input class="text_area" type="text" name="<?php echo $this->prefix; ?>x_value" id="<?php echo $this->prefix; ?>x_value" size="10" maxlength="250" value="<?php echo $this->dfi_map->x_value;?>" />
      </td>
    </tr>

	<tr>
      <td width="100" align="right" class="key"><label for="<?php echo $this->prefix; ?>y_value"> <?php echo JText::_( strtoupper('Y_value') ); ?>: </label>
      </td>
      <td><input class="text_area" type="text" name="<?php echo $this->prefix; ?>y_value" id="<?php echo $this->prefix; ?>y_value" size="10" maxlength="250" value="<?php echo $this->dfi_map->y_value;?>" />
      </td>
    </tr> 
  </table>
</fieldset>
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
				<a class="<?php echo $this->button->modalname; ?>" title="" href="<?php echo 'index.php?option=com_dfi_map&amp;view=dfi_position&amp;tmpl=component'; ?>" rel="<?php echo $this->button->options; ?>" ><?php echo JText::_( strtoupper('View Map') ); ?></a>
			</td>
		</tr>
		</table>
	<?php
				echo $this->pane->endPanel();
				echo $this->pane->endPane();
		?>	
</div>   
  <div class="clr"></div>
  <input type="hidden" name="option" value="com_dfi_map" />
  <input type="hidden" name="cid[]" value="<?php echo $this->dfi_map->dfi_map_id; ?>" />
  <input type="hidden" name="task" value="" />
  <?php echo JHTML::_( 'form.token' ); ?>
</form>
