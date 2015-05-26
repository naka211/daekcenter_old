<?php defined('_JEXEC') or die('Restricted access'); ?>
Adresse: <? echo $this->shop->street; ?><br />
Postnr.: <? echo $this->shop->zipcode; ?><br />
By: <? echo $this->shop->city; ?><br />
Tlf: <? echo $this->shop->telephone; ?><br />
Fax: <? echo $this->shop->fax; ?><br />
Website: <? echo $this->shop->website; ?><br />
Mail: <a href="mailto:<? echo $this->shop->email; ?>"><? echo $this->shop->email; ?></a><br />
butiksnr: <? echo $this->shop->butiksnr; ?>
<? exit; ?>