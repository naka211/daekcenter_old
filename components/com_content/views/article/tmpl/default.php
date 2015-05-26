<?php // no direct access
defined('_JEXEC') or die('Restricted access');
/*$db = JFactory::getDBO();
$query = "SELECt * FROM #__content WHERE catid=2";
$db->setQuery($query);
$iarray = $db->loadObjectList();*/
?>
<div class="w950" id="contentFrame">
     <div class="article">
                                	   <?php echo $this->article->introtext; ?>
     </div>
                                <a href="javascript:history.back();" class="back">Tilbage</a>
</div>