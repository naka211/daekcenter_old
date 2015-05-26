<?php defined('_JEXEC') or die('Restricted access'); // no direct access ?>

<ul>
  <? for($i=0; $i<count($items); $i++){ ?>
  <li
      <? if(ModDfi_navigatorHelper::selected($items[$i]->link, $action)) echo ' class="current"'; ?>>
      <a href="<? echo $items[$i]->link; ?>"><span><? echo $items[$i]->name; ?></span></a>
  </li>
  <? } ?>
</ul>
