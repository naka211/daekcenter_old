<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php JHTML::_('behavior.tooltip'); ?>
<?php
	// Set toolbar items for the page
	$edit		= JRequest::getVar('edit',true);
	$text = !$edit ? JText::_( 'New' ) : JText::_( 'Edit' );
	JToolBarHelper::title(   JText::_( strtoupper('Dfi_campaign') ).': <small><small>[ ' . $text.' ]</small></small>' );
	JToolBarHelper::save();
	if (!$edit)  {
		JToolBarHelper::cancel();
	} else {
		// for existing items the button is renamed `close`
		JToolBarHelper::cancel( 'cancel', 'Close' );
	}
?>
<script language="javascript" src="<?php echo $this->lists['comdir']; ?>dfi_campaign.js"></script>
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
      <td width="100" align="right" class="key"><label for="<?php echo $this->prefix; ?>name"> <?php echo JText::_( strtoupper('Name') ); ?>: </label>
      </td>
      <td><input class="text_area" type="text" name="<?php echo $this->prefix; ?>name" id="<?php echo $this->prefix; ?>name" size="32" maxlength="250" value="<?php echo $this->dfi_campaign->name;?>" />
      </td>
    </tr>
	
	<tr>
      <td valign="top" align="right" class="key"><?php echo JText::_( strtoupper('Published') ); ?>: </td>
      <td><?php echo $this->lists['published']; ?> </td>
    </tr>
	<tr>
      <td valign="top" align="right" class="key"><label for="<?php echo $this->prefix; ?>description"> <?php echo JText::_( strtoupper('Description') ); ?>: </label>
      </td>
      <td><?php
							// parameters : areaname, content, width, height, cols, rows, show xtd buttons
							echo $this->editor->display( $this->prefix.'description',  $this->dfi_campaign->description, '500', '300', '60', '20', array('pagebreak', 'readmore') ) ;
							?>
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
		?>
		<table class="admintable">	
		
	<!--tr>
      <td width="100" align="right" class="key"><label for=""> <?php echo JText::_( 'Folder' ); ?>: </label>
      </td>
      <td>
	  <a class="<?php echo $this->button->modalname; ?>" title="" href="<?php echo 'index.php?option=com_dfi_folder&amp;view=active_checkbox&amp;tmpl=component&amp;checkbox_id='.$this->dfi_campaign->dfi_campaign_id; ?>" rel="<?php echo $this->button->options; ?>" ><?php echo JText::_( 'Assign Products To Folder of This Campaign' ); ?></a>
      </td>
    </tr>
	
	<tr>
      <td width="100" align="right" class="key"><label for=""> <?php echo JText::_( 'Review' ); ?>: </label>
      </td>
      <td>
	  <a class="<?php echo $this->button->modalname; ?>" title="" href="<?php echo 'index.php?option=com_dfi_review_product&amp;view=active_checkbox&amp;tmpl=component&amp;checkbox_id='.$this->dfi_campaign->dfi_campaign_id; ?>" rel="<?php echo $this->button->options; ?>" ><?php echo JText::_( 'Assign Products To This Campaign To Review' ); ?></a>
      </td>
    </tr-->
			
	<tr>
      <td width="100" align="right" class="key"><label for="<?php echo $this->prefix; ?>published_date"> <?php echo JText::_( strtoupper('Published_date') ); ?>: </label>
      </td>
      <td>
	  <?php echo JHTML::_('calendar', $this->lists['published_date'], $this->prefix.'published_date', $this->prefix.'published_date', "%Y-%m-%d", array('class'=>'inputbox', 'size'=>'25',  'maxlength'=>'45')); ?>
      </td>
    </tr>

	<tr>
      <td width="100" align="right" class="key"><label for="<?php echo $this->prefix; ?>unpublished_date"> <?php echo JText::_( strtoupper('Unpublished_date') ); ?>: </label>
      </td>
      <td>
	  <?php echo JHTML::_('calendar', $this->lists['unpublished_date'], $this->prefix.'unpublished_date', $this->prefix.'unpublished_date', "%Y-%m-%d", array('class'=>'inputbox', 'size'=>'25',  'maxlength'=>'45')); ?>
      </td>
    </tr> 
	
	<tr>
      <td valign="top" align="right" class="key"><label for="<?php echo $this->prefix; ?>created"> <?php echo JText::_( strtoupper('Created') ); ?>: </label>
      </td>
      <td colspan="2" valign="middle"><?php echo JHTML::_('calendar', $this->lists['created'], $this->prefix.'created', $this->prefix.'created', "%Y-%m-%d %H:%M:%S", array('class'=>'inputbox', 'size'=>'25',  'maxlength'=>'45')); ?> </td>
    </tr>

	<tr>
      <td valign="top" align="right" class="key"><label for="<?php echo $this->prefix; ?>modified"> <?php echo JText::_( strtoupper('Modified') ); ?>: </label>
      </td>
      <td colspan="2" valign="middle"><?php echo JHTML::_('calendar', $this->lists['modified'], $this->prefix.'modified', $this->prefix.'modified', "%Y-%m-%d %H:%M:%S", array('class'=>'inputbox', 'size'=>'25',  'maxlength'=>'45')); ?> </td>
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
  <input type="hidden" name="option" value="com_dfi_campaign" />
  <input type="hidden" name="cid[]" value="<?php echo $this->dfi_campaign->dfi_campaign_id; ?>" />
  <input type="hidden" name="task" value="" />
  <?php echo JHTML::_( 'form.token' ); ?>
</form>
