<?php defined('_JEXEC') or die('Restricted access'); 
//print_r($lists['catid'] );?>
<?php JHTML::_('behavior.tooltip'); ?>
<?php
	// Set toolbar items for the page
	$edit		= JRequest::getVar('edit',true);
	$text = !$edit ? JText::_( 'New' ) : JText::_( 'Edit' );
	JToolBarHelper::title(   JText::_( strtoupper('Dfi_catalog') ).': <small><small>[ ' . $text.' ]</small></small>' );
	JToolBarHelper::save();
	if (!$edit)  {
		JToolBarHelper::cancel();
	} else {
		// for existing items the button is renamed `close`
		JToolBarHelper::cancel( 'cancel', 'Close' );
	}
?>
<script language="javascript" src="<?php echo $this->lists['comdir']; ?>dfi_catalog.js"></script>
<script language="javascript" type="text/javascript">
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		if (pressbutton == 'cancel') {
			submitform( pressbutton );
			return;
		}
		
		var catid = form.<? echo $this->prefix; ?>catid.value;
		if (catid < 1)
		{
			alert('Please select category!');
			return;
		}

		// do field validation
		submitform( pressbutton );
	}
</script>
<form action="index.php?option=com_dfi_catalog" method="post" name="adminForm" id="adminForm">
<!--<div class="col width-70">
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'Details' ); ?></legend>-->
  <table class="admintable">
    <tr>
      <td width="100" align="right" class="key"><label for="<?php echo $this->prefix; ?>catid"> <?php echo JText::_( strtoupper('Catid') ); ?>: </label>
      </td>
      <td><?php echo $this->lists['catid']; ?>
      </td>
    </tr>

	<tr>
      <td width="100" align="right" class="key"><label for="<?php echo $this->prefix; ?>title"> <?php echo JText::_( strtoupper('Title') ); ?>: </label>
      </td>
      <td><input class="text_area" type="text" name="<?php echo $this->prefix; ?>title" id="<? echo $this->prefix; ?>title" size="32" maxlength="250" value="<?php echo $this->dfi_catalog->title;?>" />
      </td>
    </tr>

	<tr>
      <td valign="middle" align="right" class="key"><label for="<?php echo $this->prefix; ?>filename"> <?php echo JText::_( strtoupper('Filename') ); ?>: </label>
      </td>
      <td valign="middle">
		
		<input class="inputbox" type="hidden" name="<?php echo $this->prefix; ?>filename" id="<?php echo $this->prefix; ?>filename" readonly="true" size="50" maxlength="255" value="<?php echo $this->dfi_catalog->filename; ?>" onchange="javascript:
						if (document.forms.adminForm.<?php echo $this->prefix; ?>filename.value!='') {
							document.<?php echo $this->prefix; ?>filename_src.src='../'+document.forms.adminForm.<? echo $this->prefix; ?>filename.value;
						} 
						else {
							document.<?php echo $this->prefix; ?>filename_src.src='../images/blank.png';
						}" />
		
        <a href="<?php echo $this->lists['filename_src']; ?>" title="Image" class="modal-button">
		<img name="<?php echo $this->prefix; ?>filename_src" id="<?php echo $this->prefix; ?>filename_src" src="<?php echo $this->lists['filename_src']; ?>" width="100" /></a>
			<a class="modal-button" rel="{handler: 'iframe', size: {x: 570, y: 400}}" href="index.php?option=com_rokquickcart&amp;view=images&amp;tmpl=component&amp;e_name=<? echo $this->prefix; ?>filename"> Upload </a>
			 </td>
    </tr>

	<tr>
      <td valign="top" align="right" class="key"><label for="<?php echo $this->prefix; ?>description"> <?php echo JText::_( strtoupper('Description') ); ?>: </label>
      </td>
      <td><?php
							// parameters : areaname, content, width, height, cols, rows, show xtd buttons
							echo $this->editor->display( $this->prefix.'description',  $this->dfi_catalog->description, '500', '300', '60', '20', array('pagebreak', 'readmore') ) ;
							?>
      </td>
    </tr>

	<tr>
      <td valign="top" align="right" class="key"><?php echo JText::_( strtoupper('Published') ); ?>: </td>
      <td><?php echo $this->lists['published']; ?> </td>
    </tr>

	<tr>
      <td valign="top" align="right" class="key"><label for="ordering"> <?php echo JText::_( strtoupper('Ordering') ); ?>: </label>
      </td>
      <td><?php echo $this->lists['ordering']; ?> </td>
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
				<a class="<?php echo $this->button->modalname; ?>" title="" href="<?php echo 'index.php?option=com_dfi_catalog&amp;view=active_checkbox&amp;tmpl=component'; ?>" rel="<?php echo $this->button->options; ?>" ><?php echo JText::_( strtoupper('Assign Value') ); ?></a>
			</td>
		</tr>
		</table>
	<?
				echo $this->pane->endPanel();
				echo $this->pane->endPane();
		?>	
</div>   -->
  <div class="clr"></div>
  <input type="hidden" name="option" value="com_dfi_catalog" />
  <input type="hidden" name="cid[]" value="<?php echo $this->dfi_catalog->dfi_catalog_id; ?>" />
  <input type="hidden" name="task" value="" />
  <?php echo JHTML::_( 'form.token' ); ?>
</form>
