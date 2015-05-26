<?php // no direct access
defined('_JEXEC') or die('Restricted access');
$iaddress2 = &JRequest::getVar('firmainfo_kort');
$db2 = JFactory::getDBO();
$query2 = "SELECT * FROM #__dfi_shops AS shop WHERE shop.dfi_shop_id=".$iaddress2;
$db2->setQuery($query2);
$iarray2 = $db2->loadObject();

?>

<div id="contentFrame" class="w-bg" style="width: 986px; margin: 0 auto; ">
                        		<iframe width="100%" style="background:#fff;" height="775" scrolling="auto" src="<?php echo $iarray2->email?>"></iframe>
                            </div>