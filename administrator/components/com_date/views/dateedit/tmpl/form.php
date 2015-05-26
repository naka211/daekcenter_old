<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php JHTML::_('behavior.tooltip'); ?>
<?php
	// Set toolbar items for the page
	$edit		= JRequest::getVar('edit',true);
	$text = !$edit ? JText::_( 'New' ) : JText::_( 'Edit' );
	JToolBarHelper::title(   JText::_( 'Application' ).': <small><small>[ ' . $text.' ]</small></small>' );
	JToolBarHelper::save();
	if (!$edit)  {
		JToolBarHelper::cancel();
	} else {
		// for existing items the button is renamed `close`
		JToolBarHelper::cancel( 'cancel', 'Close' );
	}
	JToolBarHelper::help( 'screen.date.edit' );
?>
<script language="javascript" type="text/javascript">
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		if (pressbutton == 'cancel') {
			submitform( pressbutton );
			return;
		}
		// do field validation
		if (form.name.value == ""){
			alert( "<?php echo JText::_( 'Book item must have a name', true ); ?>" );
		} else {
			submitform( pressbutton );
		}
	}
</script>
<style type="text/css">
	table.paramlist td.paramlist_key {
		width: 92px;
		text-align: left;
		height: 30px;
	}
</style>

<form action="index.php" method="post" name="adminForm" id="adminForm">
<div class="col width-50">
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'Details' ); ?></legend>

		<table class="admintable">
		<tr>
			<td width="100" align="right" class="key">
				<label for="title">
					<?php echo JText::_( 'Navn' ); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="name" id="name" size="80" maxlength="250" value="<?php echo $this->data->name;?>" />
			</td>
		</tr>
        <tr>
			<td width="100" align="right" class="key">
				<label for="title">
					<?php echo JText::_( 'Adresse' ); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="price" id="price" size="80" maxlength="250" value="<?php echo $this->data->address;?>" />
			</td>
		</tr>
        <tr>
			<td width="100" align="right" class="key">
				<label for="title">
					<?php echo JText::_( 'CPR-nr.' ); ?>:
				</label>
			</td>
			<td>
				<input class="text_area" type="text" name="charac" id="charac" size="80" maxlength="250" value="<?php echo $this->data->cpr;?>" />
			</td>
		</tr>
		<tr>
			<td valign="top" align="right" class="key">
				<label for="ordering">
					<?php echo JText::_( 'Mobil' ); ?>:
				</label>
			</td>
			<td>
                <input class="text_area" type="text" name="ordering" id="ordering" size="80" maxlength="250" value="<?php echo $this->data->phone; ?>" />
			</td>
		</tr>
        
        
        <tr>
			<td valign="top" align="right" class="key">
				<label for="ordering">
					<?php echo JText::_( 'E-mail' ); ?>:
				</label>
			</td>
			<td>
                <input class="text_area" type="text" name="ordering" id="ordering" size="80" maxlength="250" value="<?php echo $this->data->email; ?>" />
			</td>
		</tr>
        <tr>
			<td valign="top" align="right" class="key">
				<label for="ordering">
					<?php echo JText::_( 'Er du gift/samlevende?' ); ?>:
				</label>
			</td>
			<td>
                <input class="text_area" type="text" name="ordering" id="ordering" size="80" maxlength="250" value="<?php echo $this->data->marriage; ?>" />
			</td>
		</tr>
        <tr>
			<td valign="top" align="right" class="key">
				<label for="ordering">
					<?php echo JText::_( 'Har du børn?' ); ?>:
				</label>
			</td>
			<td>
                <input class="text_area" type="text" name="ordering" id="ordering" size="80" maxlength="250" value="<?php echo $this->data->children; ?>" />
			</td>
		</tr>
        <tr>
			<td valign="top" align="right" class="key">
				<label for="ordering">
					<?php echo JText::_( 'Hvor mange' ); ?>:
				</label>
			</td>
			<td>
                <input class="text_area" type="text" name="ordering" id="ordering" size="80" maxlength="250" value="<?php echo $this->data->numberchildren; ?>" />
			</td>
		</tr>
        <tr>
			<td valign="top" align="right" class="key">
				<label for="ordering">
					<?php echo JText::_( 'Ansættelsesform' ); ?>:
				</label>
			</td>
			<td>
                <input class="text_area" type="text" name="ordering" id="ordering" size="80" maxlength="250" value="<?php echo $this->data->contact; ?>" />
			</td>
		</tr>
        <tr>
			<td valign="top" align="right" class="key">
				<label for="ordering">
					<?php echo JText::_( 'Nuværende beskæftigelse' ); ?>:
				</label>
			</td>
			<td>
                <input class="text_area" type="text" name="ordering" id="ordering" size="80" maxlength="250" value="<?php echo $this->data->works; ?>" />
			</td>
		</tr>
        <tr>
			<td valign="top" align="right" class="key">
				<label for="ordering">
					<?php echo JText::_( 'Tidligere ansat i butik?' ); ?>:
				</label>
			</td>
			<td>
                <input class="text_area" type="text" name="ordering" id="ordering" size="80" maxlength="250" value="<?php echo $this->data->former; ?>" />
			</td>
		</tr>
        
        <tr>
			<td valign="top" colspan="2">
            
            <table>
                <tr>
                    <td colspan="4" class="key" style="text-align: left;">
                        Tidligere erhvervsmæssig beskæftigelse
                    </td>
                </tr>
                <tr >
                    <td class="key" style="text-align: center;">Sted</td>
                    <td class="key" style="text-align: center;">Jobfunktion</td>
                    <td class="key" style="text-align: center;">Fra</td>
                    <td class="key" style="text-align: center;">Til</td>
                </tr>
                
                <?php foreach($this->dataf as $row){ ?>
                
                    <tr >
                        <td class="key" style="text-align: center;"><?php echo $row->location;?></td>
                        <td class="key" style="text-align: center;"><?php echo $row->job;?></td>
                        <td class="key" style="text-align: center;"><?php echo $row->appfrom;?></td>
                        <td class="key" style="text-align: center;"><?php echo $row->appto;?></td>
                    </tr>
                <?php }?>
                
                
            </table>
            
				
            </td>
		</tr>

        <tr>
			<td valign="top" colspan="2">
            
            <table>
                <tr>
                    <td colspan="4" class="key" style="text-align: left;">
                        Uddannelse
                    </td>
                </tr>
                <tr >
                    <td class="key" style="text-align: center;">Sted</td>
                    <td class="key" style="text-align: center;">Uddannelse</td>
                    <td class="key" style="text-align: center;">Fra</td>
                    <td class="key" style="text-align: center;">Til</td>
                </tr>
                
                <?php foreach($this->datad as $row){ ?>
                
                    <tr >
                        <td class="key" style="text-align: center;"><?php echo $row->location;?></td>
                        <td class="key" style="text-align: center;"><?php echo $row->education;?></td>
                        <td class="key" style="text-align: center;"><?php echo $row->appfrom;?></td>
                        <td class="key" style="text-align: center;"><?php echo $row->appto;?></td>
                    </tr>
                <?php }?>
                
                
            </table>
            
				
            </td>
		</tr>

        
        <tr>
			<td valign="top" align="right" class="key">
				<label for="ordering">
					<?php echo JText::_( 'Har du kørekort' ); ?>:
				</label>
			</td>
			<td>
                <input class="text_area" type="text" name="ordering" id="ordering" size="80" maxlength="250" value="<?php echo $this->data->license; ?>" />
			</td>
		</tr>
        <tr>
			<td valign="top" align="right" class="key">
				<label for="ordering">
					<?php echo JText::_( 'Ekstra bilag vedhæftet' ); ?>:
				</label>
			</td>
			<td>
                <input class="text_area" type="text" name="ordering" id="ordering" size="80" maxlength="250" value="<?php echo $this->data->attached; ?>" />
			</td>
		</tr>
        <tr>
			<td valign="top" align="right" class="key">
				<label for="ordering">
					<?php echo JText::_( 'Bemærkninger' ); ?>:
				</label>
			</td>
			<td>
                <textarea style="width:336px; height:80px;"><?php echo $this->data->comments; ?></textarea>
               
            </td>
		</tr>
        <tr>
			<td valign="top" align="right" class="key">
				<label for="ordering">
					<?php echo JText::_( 'Modtaget af' ); ?>:
				</label>
			</td>
			<td>
                <input class="text_area" type="text" name="ordering" id="ordering" size="80" maxlength="250" value="<?php echo $this->data->received; ?>" />
			</td>
		</tr>
        <tr>
			<td valign="top" align="right" class="key">
				<label for="ordering">
					<?php echo JText::_( 'Dato' ); ?>:
				</label>
			</td>
			<td>
                <input class="text_area" type="text" name="ordering" id="ordering" size="80" maxlength="250" value="<?php echo $this->data->dato; ?>" />
			</td>
		</tr>
        
        
        
        
	</table>
	</fieldset>
</div>



<div class="col width-50">
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'Parameters' ); ?></legend>

		<table class="admintable">
		<tr>
			<td colspan="2">
				<?php echo $this->params->render();?>
			</td>
		</tr>
		</table>
	</fieldset>
</div>

<div class="col width-50">
	<fieldset class="adminform">
		<legend><?php echo JText::_( 'Description' ); ?></legend>

		<table class="admintable">
		<tr>
			<td>
				<textarea class="text_area" cols="44" rows="9" name="description" id="description"><?php echo $this->book->description; ?></textarea>
			</td>
		</tr>
		</table>
	</fieldset>
</div>
<div class="clr"></div>

	<input type="hidden" name="option" value="com_date" />
	<input type="hidden" name="cid[]" value="<?php echo $this->data->id; ?>" />
	<input type="hidden" name="task" value="" />
	<?php echo JHTML::_( 'form.token' ); ?>
</form>