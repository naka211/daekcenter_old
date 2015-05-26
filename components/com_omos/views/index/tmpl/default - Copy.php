<?php defined('_JEXEC') or die('Restricted access'); ?>
<script type="text/javascript" src="<? echo $this->template_dir; ?>jquery/lightbox/js/jquery.lightbox-0.5.js"></script>
<link rel="stylesheet" type="text/css" href="<? echo $this->template_dir; ?>jquery/lightbox/css/jquery.lightbox-0.5.css" media="screen" />
<form action="<?php echo $this->action ?>" method="post" name="omosForm" id="omosForm">  
  <div class="bg_tr"><p class="title_2 m20l p30t">Om Os</p></div>
                <div class="bg_cr h515">
                	<div class="m20l m20r">
                        <div class="p10t float_left m10r">
                       	  <img src="<? echo $this->c->article_image; ?>" alt="" style="float:none"/>
                          <p class="color_1" id="gallery" style="padding-top:5px"><img src="<? echo $this->template_dir; ?>img/icon_3.jpg" alt="" /><a href="#" class="p5l">Større</a><img src="<? echo $this->template_dir; ?>img/icon_4.jpg" alt="" class="m10l" /></p>
                        </div>
                        <p class="p10t">
                        	<? echo $this->c->introtext; ?>
                        </p>
                    </div>
              </div>
                <div class="bg_br"></div>
  
  <input type="hidden" name="option" value="com_omos" />
  <input type="hidden" name="controller" value="" />
  <input type="hidden" name="task" value="" />
  <?php echo JHTML::_( 'form.token' ); ?>
</form>
<script language="javascript">
$(function() {
		$('#gallery a').attr('href', '<? echo $this->c->article_image; ?>');
        $('#gallery a').lightBox({});
    });
</script>