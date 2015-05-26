<?php defined('_JEXEC') or die('Restricted access'); ?>
<?php JHTML::_('behavior.tooltip'); ?>
<?php
	// Set toolbar items for the page
	JToolBarHelper::title(   JText::_( strtoupper('Component Manager') ), 'generic.png' );
	JToolBarHelper::customX('duplicate', 'preview', '', 'Duplicate');
	JToolBarHelper::publishList();
	JToolBarHelper::unpublishList();
	JToolBarHelper::deleteList();
	JToolBarHelper::editListX();
	JToolBarHelper::addNewX();
	JToolBarHelper::preferences('com_component', '550','570','Preferences','/administrator/components/com_component/component_config.xml');
	$ordering = ($this->lists['order'] == 'a.ordering');
?>
<script language="javascript" src="<?php echo $this->lists['comdir']; ?>component.js"></script>
<form action="<?php echo $this->action; ?>" method="post" name="adminForm">
  <table>
    <tr>
      <td align="left" width="100%"><?php echo JText::_( 'Filter' ); ?>:
        <input type="text" name="search" id="search" value="<?php echo $this->lists['search'];?>" class="text_area" onchange="document.adminForm.submit();" />
        <button onclick="this.form.submit();"><?php echo JText::_( 'Go' ); ?></button>
        <button onclick="document.getElementById('search').value='';this.form.getElementById('filter_catid').value='0';this.form.getElementById('filter_state').value='';this.form.submit();"><?php echo JText::_( 'Reset' ); ?></button></td>
      <td nowrap="nowrap"><?php
			//echo $this->lists['catid'];
			echo $this->lists['parent'];
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

		  <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Link') ), 'a.link', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>

		  <!--<th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Menuid') ), 'a.menuid', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>-->

		  <!--<th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Parent') ), 'a.parent', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>-->

		  <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Admin_menu_link') ), 'a.admin_menu_link', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>

		  <!--<th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Admin_menu_alt') ), 'a.admin_menu_alt', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>-->

		  <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Option') ), 'a.option', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>

		  <th width="8%" nowrap="nowrap"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Ordering') ), 'a.ordering', $this->lists['order_Dir'], $this->lists['order'] ); ?> <?php if ($ordering) echo JHTML::_('grid.order',  $this->items ); ?></th>

		  <!--<th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Admin_menu_img') ), 'a.admin_menu_img', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>-->

		  <!--<th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Iscore') ), 'a.iscore', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>-->

		  <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Params') ), 'a.params', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>

		  <th class="title"> <?php echo JHTML::_('grid.sort',  JText::_( strtoupper('Enabled') ), 'a.enabled', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>
          
		  <th width="1%" nowrap="nowrap"> <?php echo JHTML::_('grid.sort',  'ID', 'a.id', $this->lists['order_Dir'], $this->lists['order'] ); ?> </th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <td colspan="15"><?php echo $this->pagination->getListFooter(); ?> </td>
        </tr>
      </tfoot>
      <tbody>
        <?php
	$k = 0;
	for ($i=0, $n=count( $this->items ); $i < $n; $i++)
	{
		$row = &$this->items[$i];

		$link 	= JRoute::_( 'index.php?option=com_component&view=component&task=edit&cid[]='. $row->id );
		
		$published = ComponentHelper::active_button($row->enabled, "cb".$i);
		//$published 	= JHTML::_('grid.published', $row, $i );		
		?>
        <tr class="<?php echo "row$k"; ?>">
          <td><?php echo $this->pagination->getRowOffset( $i ); ?> </td>
          <td><input type="checkbox" onclick="isChecked(this.checked);" value="<?php echo $row->id; ?>" name="cid[]" id="cb<?php echo $i; ?>" />
          </td>
		  
		  <td><span class="editlinktip hasTip" title="<?php echo JText::_( strtoupper('Edit Component') );?>::<?php echo $this->escape($row->name); ?>"><a href="<?php echo $link; ?>">
            <?php
				echo $this->escape($row->name);
				?>
            </a></span> </td>

		  <td>
            <?php
				echo $this->escape($row->link);
				?> </td>

		  <!--<td>
            <?php
				echo $this->escape($row->menuid);
				?> </td>-->

		  <!--<td>
            <?php
				echo $this->escape($row->parent);
				?> </td>-->

		  <td>
            <?php
				echo $this->escape($row->admin_menu_link);
				?> </td>

		  <!--<td>
            <?php
				echo $this->escape($row->admin_menu_alt);
				?> </td>-->

		  <td>
            <?php
				echo $this->escape($row->option);
				?> </td>

		  <td class="order">
				<span><?php echo $this->pagination->orderUpIcon( $i, TRUE,'orderup', 'Move Up', $ordering ); ?></span>
				<span><?php echo $this->pagination->orderDownIcon( $i, $n, TRUE, 'orderdown', 'Move Down', $ordering ); ?></span>
				<?php $disabled = $ordering ?  '' : 'disabled="disabled"'; ?>
				<input type="text" name="order[]" size="5" value="<?php echo $row->ordering;?>" <?php echo $disabled ?> class="text_area" style="text-align: center" />
			</td>

		  <!--<td align="center" ><img src="../<?php
				echo $this->escape($row->admin_menu_img);
				?>" width="10" /> </td>-->

		  <!--<td>
            <?php
				echo $this->escape($row->iscore);
				?> </td>-->

		  <td>
            <?php
				echo ComponentHelper::print_params($this->params, $row->params);
				?> </td>

		  <td align="center">
            <?php
				echo $published;
				?> </td>
			
          <td align="center"><?php echo $row->id; ?> </td>
        </tr>
        <?php
		$k = 1 - $k;
	}
	?>
      </tbody>
    </table>
  </div>
  <input type="hidden" name="option" value="com_component" />
  <input type="hidden" name="task" value="" />
  <input type="hidden" name="boxchecked" value="0" />
  <input type="hidden" name="filter_order" value="<?php echo $this->lists['order']; ?>" />
  <input type="hidden" name="filter_order_Dir" value="<?php echo $this->lists['order_Dir']; ?>" />
  <?php echo JHTML::_( 'form.token' ); ?>
</form>
