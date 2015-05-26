<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php JHTML::_('behavior.tooltip'); ?>
<?php
	// Set toolbar items for the page
	$edit		= JRequest::getVar('edit',true);
	$text = !$edit ? JText::_( 'New' ) : JText::_( 'Edit' );
	JToolBarHelper::title(   JText::_( strtoupper('Component') ).': <small><small>[ ' . $text.' ]</small></small>' );
	JToolBarHelper::save();
	if (!$edit)  {
		JToolBarHelper::cancel();
	} else {
		// for existing items the button is renamed `close`
		JToolBarHelper::cancel( 'cancel', 'Close' );
	}
?>
<script language="javascript" src="<?php echo $this->lists['comdir']; ?>component.js"></script>
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
      <td width="100" align="right" class="key"><label for="<?php echo $this->prefix; ?>parent"> <?php echo JText::_( strtoupper('Parent') ); ?>: </label>
      </td>
      <td><?php echo $this->lists['parent'];?>
      </td>
    </tr>
	  
    <tr>
      <td width="100" align="right" class="key"><label for="<?php echo $this->prefix; ?>name"> <?php echo JText::_( strtoupper('Name') ); ?>: </label>
      </td>
      <td><input class="text_area" type="text" name="<?php echo $this->prefix; ?>name" id="<?php echo $this->prefix; ?>name" size="32" maxlength="250" value="<?php echo $this->component->name;?>" />
      </td>
    </tr>

	<tr>
      <td width="100" align="right" class="key"><label for="<?php echo $this->prefix; ?>link"> <?php echo JText::_( strtoupper('Link') ); ?>: </label>
      </td>
      <td><input class="text_area" type="text" name="<?php echo $this->prefix; ?>link" id="<?php echo $this->prefix; ?>link" size="32" maxlength="250" value="<?php echo $this->component->link;?>" />
      </td>
    </tr>

	<tr>
      <td width="100" align="right" class="key"><label for="<?php echo $this->prefix; ?>admin_menu_link"> <?php echo JText::_( strtoupper('Admin_menu_link') ); ?>: </label>
      </td>
      <td><input class="text_area" type="text" name="<?php echo $this->prefix; ?>admin_menu_link" id="<?php echo $this->prefix; ?>admin_menu_link" size="32" maxlength="250" value="<?php echo $this->component->admin_menu_link;?>" />
      </td>
    </tr>

	<tr>
      <td width="100" align="right" class="key"><label for="<?php echo $this->prefix; ?>admin_menu_alt"> <?php echo JText::_( strtoupper('Admin_menu_alt') ); ?>: </label>
      </td>
      <td><input class="text_area" type="text" name="<?php echo $this->prefix; ?>admin_menu_alt" id="<?php echo $this->prefix; ?>admin_menu_alt" size="32" maxlength="250" value="<?php echo $this->component->admin_menu_alt;?>" />
      </td>
    </tr>

	<tr>
      <td width="100" align="right" class="key"><label for="<?php echo $this->prefix; ?>option"> <?php echo JText::_( strtoupper('Option') ); ?>: </label>
      </td>
      <td><input class="text_area" type="text" name="<?php echo $this->prefix; ?>option" id="<?php echo $this->prefix; ?>option" size="32" maxlength="250" value="<?php echo $this->component->option;?>" />
      </td>
    </tr>

	<tr>
      <td width="100" align="right" class="key"><label for="<?php echo $this->prefix; ?>admin_menu_img"> <?php echo JText::_( strtoupper('Admin_menu_img') ); ?>: </label><br />
	  (<a class="modal-button" rel="{handler: 'iframe', size: {x: 570, y: 400}}" href="index.php?option=com_rokquickcart&amp;view=images&amp;tmpl=component&amp;e_name=<?php echo $this->prefix; ?>admin_menu_img">Click here to upload</a>)
      </td>
      <td>
	  <a href="<?php echo $this->component->admin_menu_img; ?>" title="Image" class="modal-button"><img name="<?php echo $this->prefix; ?>admin_menu_img_src" id="<?php echo $this->prefix; ?>admin_menu_img_src" src="<?php echo $this->component->admin_menu_img ?>" width="20" /></a>
	  
	  <input class="text_area" type="hidden" name="<?php echo $this->prefix; ?>admin_menu_img" id="<?php echo $this->prefix; ?>admin_menu_img" size="32" maxlength="250" value="<?php echo $this->component->admin_menu_img;?>" onchange="javascript:
						if (document.forms.adminForm.<?php echo $this->prefix; ?>admin_menu_img.value!='') {
							document.forms.adminForm.<?php echo $this->prefix; ?>admin_menu_img.value = document.<?php echo $this->prefix; ?>admin_menu_img_src.src='../'+document.forms.adminForm.<?php echo $this->prefix; ?>admin_menu_img.value;
						}" />
						
      </td>
    </tr>
	
	<tr>
      <td width="100" align="right" class="key"><label for="<?php echo $this->prefix; ?>menuid"> <?php echo JText::_( strtoupper('Menuid') ); ?>: </label>
      </td>
      <td><input class="text_area" type="text" name="<?php echo $this->prefix; ?>menuid" id="<?php echo $this->prefix; ?>menuid" size="32" maxlength="250" value="<?php echo $this->component->menuid;?>" />
      </td>
    </tr>

	<tr>
      <td width="100" align="right" class="key"><label for="<?php echo $this->prefix; ?>iscore"> <?php echo JText::_( strtoupper('Iscore') ); ?>: </label>
      </td>
      <td><?php echo $this->lists['iscore']; ?>
      </td>
    </tr>	

	<tr>
      <td width="100" align="right" class="key"><label for="<?php echo $this->prefix; ?>enabled"> <?php echo JText::_( strtoupper('Enabled') ); ?>: </label>
      </td>
      <td><?php echo $this->lists['enabled']; ?>
      </td>
    </tr> 

	<tr>
      <td valign="top" align="right" class="key"><label for="ordering"> <?php echo JText::_( strtoupper('Ordering') ); ?>: </label>
      </td>
      <td><?php echo $this->lists['ordering']; ?> </td>
    </tr>
  </table>
</fieldset>
</div>
<div class="col width-30">
	<?php
			echo $this->pane->startPane("params-pane");
			$title = JText::_( strtoupper('Parameters') );
			echo $this->pane->startPanel( $title, "detail-page" );
			echo $params = $this->params->render('params');
			//echo $this->pane->endPanel();
			
			if (!$params)
			{
	?>
		<table class="admintable">
<tr>
      <td valign="top" align="right" class="key"><label for="<?php echo $this->prefix; ?>params"> <?php echo JText::_( 'Params' ); ?>: </label>
      </td>
      <td>
	  	<textarea class="text_area" cols="25" rows="9" name="<?php echo $this->prefix; ?>params" id="<?php echo $this->prefix; ?>params"><?php echo $this->component->params; ?></textarea>
      </td>
    </tr>
		</table>	
	<?php
			}
			echo $this->pane->endPanel();
			echo $this->pane->endPane();
		?>	
</div>   
  <div class="clr"></div>
  <input type="hidden" name="option" value="com_component" />
  <input type="hidden" name="cid[]" value="<?php echo $this->component->id; ?>" />
  <input type="hidden" name="task" value="" />
  <?php echo JHTML::_( 'form.token' ); ?>
</form>
