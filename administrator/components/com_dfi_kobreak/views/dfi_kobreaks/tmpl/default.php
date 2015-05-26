<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php JHTML::_('behavior.tooltip'); ?>
<?php
	// Set toolbar items for the page
	JToolBarHelper::title(   JText::_( strtoupper('Dfi_kobreak Manager') ), 'generic.png' );
	JToolBarHelper::customX('duplicate', 'preview', '', 'Duplicate');
	JToolBarHelper::publishList();
	JToolBarHelper::unpublishList();
	JToolBarHelper::deleteList();
	JToolBarHelper::editListX();
	JToolBarHelper::addNewX();
	JToolBarHelper::preferences('com_dfi_kobreak', '550','570','Preferences','/administrator/components/com_dfi_kobreak/component_config.xml');
	$ordering = ($this->lists['order'] == 'a.ordering');
?>
<script language="javascript" src="<?php echo $this->lists['comdir']; ?>dfi_kobreak.js"></script>
<form action="<?php echo $this->action; ?>" method="post" name="adminForm">
  <table>
    <tr>
      <td align="left" width="100%"><?php echo JText::_( 'Filter' ); ?>:
        <input type="text" name="search" id="search" value="<?php echo $this->lists['search'];?>" class="text_area" onchange="document.adminForm.submit();" />
        <button onclick="this.form.submit();"><?php echo JText::_( 'Go' ); ?></button>
        <button onclick="document.getElementById('search').value='';this.form.getElementById('filter_catid').value='0';this.form.getElementById('filter_state').value='';this.form.submit();"><?php echo JText::_( 'Reset' ); ?></button></td>
      <td nowrap="nowrap"><?php
			//echo $this->lists['catid'];
			echo $this->lists['status'];
			echo $this->lists['dfi_supplier_id'];
			echo $this->lists['dfi_campaign_id'];
			echo $this->lists['state'];
		?>
      </td>
    </tr>
  </table>
  <div id="editcell">
    <table class="adminlist">
      <thead>
        <tr>
          <th width="5"> <?php echo JText::_( 'NUM' ); ?> </th>
          <th width="20"> <input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $this->items ); ?>);" />
          </th>
		  
		  <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Name') ), 'a.name', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>

		  <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Dfi_campaign_id') ), 'a.dfi_campaign_id', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>
          
		  <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Dfi_supplier_id') ), 'a.dfi_supplier_id', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>

		  <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Lev_uge') ), 'a.lev_uge', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>

		  <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Val_uge') ), 'a.val_uge', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>

		  <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Ann_tilskud') ), 'a.ann_tilskud', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>
            
            <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( ('Svarfrist') ), 'a.svarfrist', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>

		  <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Status') ), 'a.status', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>

		  <th width="5%" nowrap="nowrap"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Published') ), 'a.published', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>

		  <th width="8%" nowrap="nowrap"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Ordering') ), 'a.ordering', $this->lists['order_Dir'], $this->lists['order'] ); ?> <?php if ($ordering) echo JHTML::_('grid.order',  $this->items ); ?></th>

		  <th width="1%" nowrap="nowrap"> <?php echo JHTML::_('grid.sort',  'ID', 'a.dfi_kobreak_id', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <td colspan="16"><?php echo $this->pagination->getListFooter(); ?> </td>
        </tr>
      </tfoot>
      <tbody>
        <?php
	$k = 0;
	for ($i=0, $n=count( $this->items ); $i < $n; $i++)
	{
		$row = &$this->items[$i];

		$link 	= JRoute::_( 'index.php?option=com_dfi_kobreak&view=dfi_kobreak&task=edit&cid[]='. $row->dfi_kobreak_id );

		$published 	= JHTML::_('grid.published', $row, $i );		
		?>
        <tr class="<?php echo "row$k"; ?>">
          <td><?php echo $this->pagination->getRowOffset( $i ); ?> </td>
          <td><input type="checkbox" onclick="isChecked(this.checked);" value="<?php echo $row->dfi_kobreak_id; ?>" name="cid[]" id="cb<?php echo $i; ?>" />
          </td>
		  
		  <td>
            <span class="editlinktip hasTip" title="<?php echo JText::_( strtoupper('Edit Dfi_kobreak') );?>::<?php echo $this->escape($row->name); ?>"><a href="<?php echo $link; ?>"><?php
				echo $this->escape($row->name);
				?></a></span> </td>

		  <td>
            <?php
				echo $this->escape($row->campaign_name);
				?> </td>
			
		  <td>
            <?php
				echo $this->escape($row->supplier_name);
				?>
             </td>

		  <td>
            <?php
				echo $this->escape($row->lev_uge);
				?> </td>

		  <td>
            <?php
				echo $this->escape($row->val_uge);
				?> </td>

		  <!--<td>
            <?php
				//echo $this->escape($row->lev_betingelse);
				?> </td>-->

		  <td>
            <?php
				echo $this->escape($row->ann_tilskud);
				?> </td>
        
            <td>
            <?php
				echo $this->escape($row->svarfrist);
				?> </td>

		  <td>
            <?php
				#echo $this->escape($row->status?'Ajourføringsark':'Active');
                
                if($row->published == 0){
                    echo "Ny";
                }
                else if($row->published == 1 && $row->dfi_order_status_id != 0 && $row->dfi_order_status_id != 1){
                    echo $row->status_name;
                }
                else if($row->published == 1){
                    echo "Sendtilo Shop";
                }
                
                
                /* 
				if($row->dfi_order_status_id){
					echo $row->dfi_order_status_id;
				}else{
					echo 'Sendttil Shops';	
				}
                */
                
				?> </td>

		  <td align="center"><?php echo $published;?> </td>

		  <td class="order">
				<span><?php echo $this->pagination->orderUpIcon( $i, TRUE,'orderup', 'Move Up', $ordering ); ?></span>
				<span><?php echo $this->pagination->orderDownIcon( $i, $n, TRUE, 'orderdown', 'Move Down', $ordering ); ?></span>
				<?php $disabled = $ordering ?  '' : 'disabled="disabled"'; ?>
				<input type="text" name="order[]" size="5" value="<?php echo $row->ordering;?>" <?php echo $disabled ?> class="text_area" style="text-align: center" />
			</td>

          <td align="center"><?php echo $row->dfi_kobreak_id; ?> </td>
        </tr>
        <?php
		$k = 1 - $k;
	}
	?>
      </tbody>
    </table>
  </div>
  <input type="hidden" name="option" value="com_dfi_kobreak" />
  <input type="hidden" name="task" value="" />
  <input type="hidden" name="boxchecked" value="0" />
  <input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
  <input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
  <?php echo JHTML::_( 'form.token' ); ?>
</form>
