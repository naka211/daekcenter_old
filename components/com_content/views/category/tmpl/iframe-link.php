<?php // no direct access
defined('_JEXEC') or die('Restricted access');
$iaddress = &JRequest::getVar('firma');
$db = JFactory::getDBO();
$query = "SELECT * FROM #__dfi_shops AS shop WHERE shop.dfi_shop_id=".$iaddress;
$db->setQuery($query);
$iarray = $db->loadObject();
?>





<?php
function is_chrome()
{
return(eregi("chrome", $_SERVER['HTTP_USER_AGENT']));
}

if(is_chrome())
{
// code for Chrome Browser here
?>
	<div class="w-bg" id="contentFrame" style="overflow: hidden;-webkit-overflow-scrolling:touch;">
    <iframe width="100%" scrolling="auto" height="900" src="<?php echo $iarray->fax ?>" style="background:#fff;">
    </iframe> 
</div>
<?php 
} else{
?>
<div class="w-bg" id="contentFrame" style="overflow: scroll;-webkit-overflow-scrolling:touch;">
    <iframe width="100%" scrolling="auto" height="900" src="<?php echo $iarray->fax ?>" style="background:#fff;">
    </iframe> 
</div>
<?php
}
?>

