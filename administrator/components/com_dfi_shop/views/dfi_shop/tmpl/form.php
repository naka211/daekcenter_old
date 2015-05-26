<?php defined('_JEXEC') or die('Restricted access');
$db = &JFactory::getDBO();
$query = "SELECT * FROM #__dfi_catalogs";
$db->setQuery($query);
$row1 = $db->loadObjectList();
//print_r($row1[0]->dfi_catalog_id );die;
 ?>
<?php JHTML::_('behavior.tooltip'); ?>
<?php
	// Set toolbar items for the page
	$edit		= JRequest::getVar('edit',true);
	$text = !$edit ? JText::_( 'New' ) : JText::_( 'Edit' );
	JToolBarHelper::title(   JText::_( strtoupper('Dfi_shop') ).': <small><small>[ ' . $text.' ]</small></small>' );
	JToolBarHelper::save();
	if (!$edit)  {
		JToolBarHelper::cancel();
	} else {
		// for existing items the button is renamed `close`
		JToolBarHelper::cancel( 'cancel', 'Close' );
	}
?>
<script language="javascript" src="<?php echo $this->lists['comdir']; ?>dfi_shop.js"></script>
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
<form action="index.php?option=com_dfi_shop" method="post" name="adminForm" id="adminForm">
<div class="col width-70">
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'Details' ); ?></legend>
  <table class="admintable">
    
	 <tr>
 <td width="100" align="right" class="key"><label for="<?php echo $this->prefix; ?>catid"> <?php echo JText::_('Category'); ?>: </label>
      </td>
      <td>	
	  <select name="type" id="type">
        	<option>--Select category--</option>
			<?php for($k=0; $k<count($row1);$k++) {?>
            <option value="<?php echo $row1[$k]->dfi_catalog_id;?>" <?php if($row1[$k]->dfi_catalog_id == $this->dfi_shop->dfi_shops_catid) echo 'selected="selected"';?> ><?php echo $row1[$k]->title;?></option>
			<?php }?>
        </select>
      </td>
    </tr>
	<tr>
      <td width="100" align="right" class="key"><label for="<? echo $this->prefix; ?>company_name"> <?php echo JText::_( strtoupper('Company_name') ); ?>: </label>
      </td>
      <td><input class="text_area" type="text" name="<?php echo $this->prefix; ?>company_name" id="<?php echo $this->prefix; ?>company_name" size="32" maxlength="250" value="<?php echo $this->dfi_shop->company_name;?>" />
      </td>
    </tr>

	<!-- <tr>
      <td width="100" align="right" class="key"><label for="<?php echo $this->prefix; ?>street"> <?php echo JText::_( strtoupper('Street') ); ?>: </label>
      </td>
     <td>
		<?php
					
			//echo $this->editor->display( $this->prefix.'street',  $this->dfi_shop->street, '200', '100', '60', '20', array('pagebreak', 'readmore') ) ;
		?>
	<!-- <textarea name="<?php //echo $this->prefix; ?>street" id="<?php //echo $this->prefix; ?>street"> <?php //echo $this->dfi_shop->street;?> </textarea> 
      </td> 
    </tr> -->

	<!-- <tr>
      <td width="100" align="right" class="key"><label for="<?php //echo $this->prefix; ?>zipcode"> <?php //echo JText::_( strtoupper('Zipcode') ); ?>: </label>
      </td>
      <td><input class="text_area" type="text" name="<?php //echo $this->prefix; ?>zipcode" id="<?php //echo $this->prefix; ?>zipcode" size="32" maxlength="250" value="<?php echo $this->dfi_shop->zipcode;?>" />
      </td>
    </tr> -->

	<!-- <tr>
      <td width="100" align="right" class="key"><label for="<?php //echo $this->prefix; ?>city"> <?php //echo JText::_( strtoupper('City') ); ?>: </label>
      </td>
      <td><input class="text_area" type="text" name="<?php echo $this->prefix; ?>city" id="<?php echo $this->prefix; ?>city" size="32" maxlength="250" value="<?php echo $this->dfi_shop->city;?>" />
      </td>
    </tr> -->

	<tr>
      <td width="100" align="right" class="key"><label for="<?php echo $this->prefix; ?>telephone"> <?php echo JText::_( strtoupper('Telephone') ); ?>: </label>
      </td>
      <td><input class="text_area" type="text" name="<?php echo $this->prefix; ?>telephone" id="<?php echo $this->prefix; ?>telephone" size="32" maxlength="250" value="<?php echo $this->dfi_shop->telephone;?>" />
      </td>
    </tr>

	 <tr>
      <td width="100" align="right" class="key"><label for="<?php echo $this->prefix; ?>fax"> <?php echo JText::_('Link' ); ?>: </label>
      </td>
      <td><input class="text_area" type="text" name="<?php echo $this->prefix; ?>fax" id="<?php echo $this->prefix; ?>fax" size="32" maxlength="250" value="<?php echo $this->dfi_shop->fax;?>" />
      </td>
    </tr> 

	<tr>
      <td width="100" align="right" class="key"><label for="<?php echo $this->prefix; ?>website"> <?php echo JText::_( strtoupper('Website') ); ?>: </label>
      </td>
      <td><input class="text_area" type="text" name="<?php echo $this->prefix; ?>website" id="<?php echo $this->prefix; ?>website" size="32" maxlength="250" value="<?php echo $this->dfi_shop->website;?>" />
      </td>
    </tr>

	<tr>
      <td width="100" align="right" class="key"><label for="<?php echo $this->prefix; ?>email"> <?php echo JText::_('Din dæk pris'); ?>: </label>
      </td>
      <td><input class="text_area" type="text" name="<?php echo $this->prefix; ?>email" id="<?php echo $this->prefix; ?>email" size="32" maxlength="250" value="<?php echo $this->dfi_shop->email;?>" />
      </td>
    </tr>

	<tr>
      <td width="100" align="right" class="key"><label for="<?php echo $this->prefix; ?>butiksnr"> <?php echo JText::_('Firmainfo og kort') ; ?>: </label>
      </td>
      <td><input class="text_area" type="text" name="<?php echo $this->prefix; ?>butiksnr" id="<?php echo $this->prefix; ?>butiksnr" size="32" maxlength="250" value="<?php echo $this->dfi_shop->butiksnr;?>" />
      </td>
    </tr>
	
	<!-- <tr>
      <td width="100" align="right" class="key"><label for="<?php //echo $this->prefix; ?>rate"> <?php //echo JText::_( strtoupper('Rate %') ); ?>: </label>
      </td>
      <td><input class="text_area" type="text" name="<?php //echo $this->prefix; ?>rate" id="<?php //echo $this->prefix; ?>rate" size="32" maxlength="250" value="<?php //echo $this->dfi_shop->rate;?>" />
      </td>
    </tr> -->

	<tr>
      <td valign="top" align="right" class="key"><label for="<?php echo $this->prefix; ?>open_hour"> <?php echo JText::_( strtoupper('Open_hour') ); ?>: </label>
      </td>
      <td>
							<textarea name="<?php echo $this->prefix.'open_hour'; ?>" id="<?php echo $this->prefix.'open_hour'; ?>"><?php echo $this->dfi_shop->open_hour; ?></textarea>
      </td>
    </tr> 

	<tr>
      <td valign="top" align="right" class="key"><?php echo JText::_( strtoupper('Published') ); ?>: </td>
      <td><?php echo $this->lists['published']; ?> </td>
    </tr>

	<tr>
      <td valign="middle" align="right" class="key"><label for="<?php echo $this->prefix; ?>filename"> <?php echo JText::_( strtoupper('Filename') ); ?>: </label>
      </td>
      <td valign="middle">
		
		<input class="inputbox" type="hidden" name="<?php echo $this->prefix; ?>filename" id="<?php echo $this->prefix; ?>filename" readonly="true" size="50" maxlength="255" value="<?php echo $this->dfi_shop->filename; ?>" onchange="javascript:
						document.<?php echo $this->prefix; ?>filename_src.src='../'+this.value;" />
		
        <a href="<?php echo $this->lists['filename_src']; ?>" title="Image" class="modal-button">
		<img name="<?php echo $this->prefix; ?>filename_src" id="<?php echo $this->prefix; ?>filename_src" src="<?php echo $this->lists['filename_src']; ?>" width="100" /></a>
			<a class="modal-button" rel="{handler: 'iframe', size: {x: 570, y: 400}}" href="index.php?option=com_rokquickcart&amp;view=images&amp;tmpl=component&amp;e_name=<?php echo $this->prefix; ?>filename"> Upload </a>
			 </td>
    </tr>

	<tr>
      <td valign="top" align="right" class="key"><label for="<?php echo $this->prefix; ?>street"> <?php echo JText::_( strtoupper('Street') ); ?>: </label>
      </td>
      <td><?php
							// parameters : areaname, content, width, height, cols, rows, show xtd buttons
							echo $this->editor->display( $this->prefix.'description',  $this->dfi_shop->description, '200', '100', '60', '20', array('pagebreak', 'readmore') ) ;
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
 
 <!-- <div class="col width-30">
	<?php
			//echo $this->pane->startPane("params-pane");
			//$title = JText::_( strtoupper('Parameters') );
			//echo $this->pane->startPanel( $title, "detail-page" );
			//echo $this->params->render('params');
			//echo $this->pane->endPanel();		
			
			//echo $this->pane->startPanel( $title, "detail-page" );		
		?>
		<table class="admintable">
		<tr>
			<td colspan="2">
				<a class="<?php //echo $this->button->modalname; ?>" title="" href="<?php //echo 'index.php?option=com_dfi_member&amp;view=active_checkbox&amp;tmpl=component&amp;checkbox_id='.$this->dfi_shop->dfi_shop_id; ?>" rel="<?php //echo $this->button->options; ?>" ><?php //echo JText::_( ('Assign Users To This Shop') ); ?></a>
			</td>
		</tr>
		<!--<tr>
			<td colspan="2">
				<a class="<?php //echo $this->button->modalname; ?>" title="" href="<?php echo 'index.php?option=com_dfi_distribution_rate&amp;view=active_checkbox&amp;tmpl=component&amp;checkbox_id='.$this->dfi_shop->dfi_shop_id; ?>" rel="<?php //echo $this->button->options; ?>" ><?php //echo JText::_( ('Assign Distribution Rate To This Shop') ); ?></a>
			</td>
		</tr>
        <tr>
			<td colspan="2">
			--------------------------------------------------
            </td>
		</tr>
        <tr>
			<td colspan="2">
				<a class="<?php// echo $this->button->modalname; ?>" title="" href="<?php //echo 'index.php?option=com_dfi_addorder&amp;view=active_checkbox&amp;tmpl=component&amp;checkbox_id='.$this->dfi_shop->dfi_shop_id; ?>" rel="<?php //echo $this->button->options; ?>" ><?php //echo JText::_( ('Assign Order To This Shop') ); ?></a>
			</td>
		</tr>
		</table>
	<?php
				//echo $this->pane->endPanel();
				//echo $this->pane->endPane();
		?>
</div> -->
  <div class="clr"></div>
  <input type="hidden" name="option" value="com_dfi_shop" />
  <input type="hidden" name="cid[]" value="<?php echo $this->dfi_shop->dfi_shop_id; ?>" />
  <input type="hidden" name="task" value="" />
  <?php echo JHTML::_( 'form.token' ); ?>
</form>
