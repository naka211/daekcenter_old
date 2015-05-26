<?php // no direct access
defined('_JEXEC') or die('Restricted access');
$iaddress = &JRequest::getVar('firma');
$db = JFactory::getDBO();
$query = "SELECT * FROM #__dfi_shops AS shop WHERE shop.dfi_shop_id=".$iaddress;
$db->setQuery($query);
$iarray = $db->loadObject();

?>

<div class="w-bg" id="contentFrame">
    <iframe width="100%" scrolling="auto" height="1200" src="<?php echo $iarray->butiksnr ?>" style="background:#fff;">
    </iframe> 
</div>