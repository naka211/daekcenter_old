<?php // no direct access
defined('_JEXEC') or die('Restricted access');
$cparams =& JComponentHelper::getParams('com_media');
?>
<?php
	$this->items =& $this->getItems();
	echo $this->loadTemplate('items');
?>
