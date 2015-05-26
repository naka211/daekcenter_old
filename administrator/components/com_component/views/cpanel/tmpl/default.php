<?php defined('_JEXEC') or die('Restricted access'); ?>

<div id="cpanel">
  <?php
  	for($i=0; $i<count($this->data); $i++)
	{
		$row = $this->data[$i];

		$link = 'index.php?'.$row->admin_menu_link;
		$icon = 'icon-48-extension.png';
		$this->_quickiconButton( $link, $icon, JText::_($row->name) );
	}
			?>
</div>
