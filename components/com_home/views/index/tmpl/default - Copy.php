<?php defined('_JEXEC') or die('Restricted access'); ?>
<link rel="stylesheet" href="<? echo $this->template_dir; ?>jquery/tooltip/jquery.tooltip.css" />
<script src="<? echo $this->template_dir; ?>jquery/tooltip/jquery.tooltip.js" type="text/javascript"></script>

<link rel="stylesheet" type="text/css" href="<? echo $this->template_dir; ?>jquery/ui-1.7.2.custom/css/flick/jquery-ui-1.7.2.custom.css">
<script type="text/javascript" src="<? echo $this->template_dir; ?>jquery/ui-1.7.2.custom/js/jquery-ui-1.7.2.custom.min.js"></script>

<script src="<? echo $this->template_dir; ?>jquery/watermark/jquery.updnWatermark.js" language="javascript"></script>
<style type="text/css">
	/*.ui-watermark-container {
	}*/
	
	/*.ui-watermark-label {
	}*/ 
</style>
<script language="javascript">
$(function() {	
	$.updnWatermark.attachAll();  
	
	var dialog = $('<div></div>');
		
	$('#dfi_map a').tooltip({
		track: true,
		delay: 0,
		showURL: false,
		fade: 250
	});
		
	$('#dfi_map a').click(function() {
		var o = this;
		
		dialog
		.html('')
		.load('index2.php?option=com_home&view=shop&id='+o.id)	
		.dialog({
			closeText: 'Close',
			autoOpen: false,
			title: o.tooltipText,
			modal: true,
			height: 180,
			width:400
		})
		.dialog('open')
		.dialog('option', 'title', o.tooltipText);
	});
});
</script>
<form action="<?php echo $this->action ?>" method="post" name="homeForm" id="homeForm">
  <div class="flash"><img src="<? echo $this->template_dir; ?>img/flash.jpg" alt="" /></div>
  <div class="bgr_1">
    <div id="dfi_map" class="w325 float_left" style="background:url(images/rokquickcart/dfi_map.jpg) no-repeat 13px 2px; height:244px; position:relative; z-index:1002">
      <p class="title_2 float_left p10l">Søg Regions</p>
      <p class="float_left p10t p5l"><img src="<? echo $this->template_dir; ?>img/icon.jpg" alt="" /></p>
      <br class="clear_left" />
	  <!-- //-->
	  <? for($i=0; $i<count($this->shops); $i++) { 
	  		$row = $this->shops[$i];
			$title = $row->company_name.', No. '.$row->butiksnr;
	  ?>
      <a id="shop_<? echo $row->dfi_shop_id; ?>" href="javascript:;" title="<? echo $title; ?>" alt="<? echo $title; ?>"><img src="<? echo $this->template_dir; ?>img/icon_dfi.png" style="position:absolute;top:<? echo $row->y_value; ?>px;left:<? echo $row->x_value; ?>px;z-index:<? echo ($i+1); ?>" alt=""/> </a> 
	  <? } ?>	  
	  </div>
    <div class="w400 float_left m20l p10t">
      <p class="title_2">Søg Firma</p>
      <p class="p5t">Indtast dit postnr. eller by, og få vist de restauranter der tilbyder leve eller afhentning i dit område.når man betragter dens layout. Meningen med at bruge:</p>
      <div class="input_form p15t">
        <input type="text" name="firma" id="firma" title="Firma" class="w200 fs11" style="position:relative; z-index:0px" />
        <br />
        <input type="text" name="postnumber" id="postnumber" title="Postnr." class="w200 fs11" style="position:relative; z-index:0px" />
        <br />
        <input type="text" name="searchword" id="searchword" title="Indtast søgeord" class="w200 fs11" style="position:relative; z-index:0px" />
        <br />
        <input type="image" style="width:67px; height:25px; border:0px;" src="<? echo $this->template_dir; ?>img/bt_sogning.png" alt="" class="p5t" /> </div>
    </div>
    <div class="clear_left"></div>
  </div>
  <div class="bgr_2">
    <div class="bg_icon"><a href="#"><img src="<? echo $this->template_dir; ?>img/icon_pre.jpg" alt="" /></a></div>
    <div class="w679 float_left m20l p15t">
      <div class="w269 float_left bs1"><img src="<? echo $this->template_dir; ?>img/img_bot.jpg" alt="" /></div>
      <div class="w380 float_left m20l">
        <p class="title_3"><? echo $this->c?$this->c->title:''; ?></p>
        <p class="p5t color_1"><? echo $this->c?substr($this->c->created, 0, 10):''; ?></p>
        <p class="p5t"><? echo $this->c?$this->c->introtext:''; ?></p>
        <p class="p10t"><a href="index.php?option=com_flip_book&catid=1"><img src="<? echo $this->template_dir; ?>img/bt_trykher.jpg" alt="" /></a></p>
      </div>
      <br class="clear_left" />
    </div>
    <div class="bg_icon"><a href="#"><img src="<? echo $this->template_dir; ?>img/icon_next.jpg" alt="" /></a></div>
    <div class="clear_left"></div>
  </div>
  <input type="hidden" name="option" value="com_home" />
  <input type="hidden" name="controller" value="" />
  <input type="hidden" name="task" value="save" />
  <?php echo JHTML::_( 'form.token' ); ?>
</form>
