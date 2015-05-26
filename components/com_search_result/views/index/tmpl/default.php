<?php defined('_JEXEC') or die('Restricted access'); ?>

<form action="<?php echo $this->action ?>" method="post" name="search_resultForm" id="search_resultForm">
  <div class="bg_tr">
    <div class="p25l p20r p15t">
      <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
          <td width="55%"><p class="title_2 p15t">Søgning</p></td>
          <td width="20%"></td>
          <td width="22%"><input type="text" class="box_search1" name="searchword" id="searchword" value="<? echo $this->searchword; ?>" onblur="if(this.value=='') this.value='<? echo $this->searchword; ?>';" onfocus="this.value=''" />
            <input name="input" type="image" src="<? echo $this->template_dir; ?>img/bt_search.jpg" />
            <br class="clear" />
          </td>
        </tr>
      </table>
    </div>
  </div>
  <div class="bg_cr h515">
    <div class="p20t">
	
	<? for($i=0; $i<count($this->items); $i++) { 
		$row = $this->items[$i];
	?>
      <div class="detail_search"> <b><? echo $row->company_name; ?></b><br />
        <? echo $row->street; ?><br />
        <? echo $row->zipcode; ?> <? echo $row->city; ?><br />
        Tlf: <? echo $row->telephone; ?><br />
        Fax: <? echo $row->fax; ?><br />
        Website: <? echo $row->website; ?><br />
        E-mail: <a href='mailto:<? echo $row->email; ?>'><? echo $row->email; ?></a><br />
        Butiksnr.: <? echo $row->butiksnr; ?><br />
      </div><? } ?>
      <div class="clear_left	"></div>
	  
	  <div class="box_pt" align="center"> <? echo $this->pagination->getPagesLinks(); ?> </div>
    </div>
  </div>
  <div class="bg_br"></div>
  <input type="hidden" name="option" value="com_search_result" />
  <input type="hidden" name="controller" value="" />
  <input type="hidden" name="task" value="save" />
  <?php echo JHTML::_( 'form.token' ); ?>
</form>
