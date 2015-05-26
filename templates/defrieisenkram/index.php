<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
<head>
<?php
$pageoption = JRequest::getVar('option', '');
$pageview = JRequest::getVar('view', '');
$pageitemid = JRequest::getVar('Itemid', '');
$pageid = JRequest::getVar('id', '');
$pagetask = JRequest::getVar('task', '');
$page = JRequest::getVar('page', '');
$menu = & JSite::getMenu();
$document =& JFactory::getDocument();
$title = $document->getTitle();
$layout = JRequest::getVar('layout', '');
#echo $pageoption;
?>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta content="dfi.dk" name="description"/>
    <meta content="" name="keywords"/>
    <title><?php echo $title;?></title>
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo $this->baseurl ?>/templates/defrieisenkram/favicon.ico" />
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo $this->baseurl ?>/templates/defrieisenkram/css/reset.css" />
	<link rel="stylesheet" type="text/css" media="print" href="<?php echo $this->baseurl ?>/templates/defrieisenkram/css/print.css" />
	<link rel="stylesheet" type="text/css" media="screen" href="<?php echo $this->baseurl ?>/templates/defrieisenkram/css/typography.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo $this->baseurl ?>/templates/defrieisenkram/css/styles.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo $this->baseurl ?>/templates/defrieisenkram/css/reveal.css" />
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo $this->baseurl ?>/templates/defrieisenkram/css/2103.css" />
    <!-- js files -->
	<script src="<?php echo $this->baseurl ?>/templates/defrieisenkram/js/jquery-1.4.4.min.js" type="text/javascript"></script>
    <script src="<?php echo $this->baseurl ?>/templates/defrieisenkram/js/jquery.thickbox.compressed.js" type="text/javascript"></script>
    <script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/defrieisenkram/js/jquery.watermark.js"></script>
    <script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/defrieisenkram/js/tooltip.js"></script>
    <script type="text/javascript">
        jQuery(function () {
            jQuery.updnWatermark.attachAll();  
        });
    </script>
    <script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/defrieisenkram/js/jquery.reveal.js"></script>
    <!-- js files -->
    <style>
        img{border: none;}
        .bg_alert{ width:270px; height:115px; background:url(<?php echo $this->baseurl ?>/templates/defrieisenkram/img/bg_alert.png) no-repeat top left; margin:0px auto; padding:15px 0px 0px 83px; color:#000;}
        .updnWatermark{padding: 6px 0 0 10px;}
    </style>
    <script src="<?php echo $this->baseurl ?>/templates/defrieisenkram/js/jquery.validate.js" type="text/javascript"></script>
    <script src="<?php echo $this->baseurl ?>/templates/defrieisenkram/js/jquery.updnWatermark.js" type="text/javascript"></script>

</head>
<body>
<!--Popup-->
<div class="bg_alert" id="show_popup" style="display:none; position: fixed; top: 35%; left: 50%; z-index:10001; margin-left:-140px;">
	<span id="f_focus" style="display:none;"></span>
	<div style="margin:0; padding-top:10px; min-height:60px;" id="alert"></div>
	<div style="padding-left: 40px;"><a href="javascript:void(0);" onclick="close_popup();"><img src="<?php echo $this->baseurl ?>/templates/defrieisenkram/img/bt_luk1.png" alt="" /></a></div>
</div>
<!--End Popup-->
<!--Need-->
<div style="display: none;position: fixed; top: 0;left: 0;width: 100%;height: 100%;background-color: #000000;z-index:10000;-moz-opacity: 0.8;opacity:.80;filter: alpha(opacity=80);" id="backoverlay"></div>
<!--End-->
    <!--[if gt IE 7]><div class="ie ie8"><![endif]-->
    <!--[if IE 7]><div class="ie ie7"><![endif]-->
    <!--[if IE 6]><div class="ie ie6"><![endif]-->
    <!--[if lt IE 6]><div class="ie ie5"><![endif]-->
    <!--[if !IE]>--><div class="ie0"><!--<![endif]-->
	<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/defrieisenkram/js/get_nav.js"></script>
        <!-- page content -->
        <div class="wrapper">
            <div id="page">
            	<!--Begin Container-->
            	<div id="container">
                    <!-- Begin Header-->
                    <div id="header">
                    	<div class="header-ctn w950">
                            <h1 id="logo"><a href="<?php echo $this->baseurl ?>" class="logo" title="Din Isenkræmmer"><img src="<?php echo $this->baseurl ?>/templates/defrieisenkram/img/dfi-logo.jpg" alt="Din Isenkræmmer" /></a></h1>
                            <div id="menu">
                                <jdoc:include type="modules" name="menutop" />
                                
                            </div>
                    	</div>
                        <div class="decor-line"></div>
                        
                    </div>
                    <!-- / Header-->
                    <!-- Begin main content -->
                    <div id="main" class="home">
                    	<div id="content" class="w950">

                            <jdoc:include type="component" />

                    	</div> 
                    </div>
                    <!-- / end main content -->
				</div>
                <!--/Container-->
                <!--footer-->
                <div id="footer">
                	<div class="footer-inner">
                        <p>Copyright © 2009 -2011 Din Isenkræmmer -  Axelhøj 65, 2610 Rødovre - Tlf: 86 61 43 00 Fax:8661 1920 - CVR: 32 65 92 09 - Email : <a href="mailto:kontakt@dinisenkraemmer.dk">kontakt@dinisenkraemmer.dk</a><br/> Design af <a class="power" href="http://www.mywebcreations.dk" target="_blank">MyWebCreations</a></p>
                    </div>
                </div>
                <!--/footer-->
            </div>
        </div>
		<!--/ page content -->
       
	</div>

	<div id="myModal" class="reveal-modal">
		<div class="pop-top"><img src="<?php echo $this->baseurl ?>/templates/defrieisenkram/img/logo_title.png" alt=""/></div>
		<a class="close-reveal-modal"><img src="<?php echo $this->baseurl ?>/templates/defrieisenkram/img/pop-close.jpg" alt=""/></a>
		<div class="clear"></div>
		<p class="pitalic">Er din avisen udeblevet? Udfyld formularen nedenfor og send os dine oplysninger.</p>
		<form action="<?php echo JRoute::_( 'index.php' );?>" method="post" name="contactForm" id="contactForm">
			<fieldset>
				<div class="w300 fl-left mr30">
					 <p class="p14 p-up p-bold">PERSONLIG INFORMATION</p>
					<input class="txt-pop" name="name" id="name" type="text" value="" title="Navn" />
					<input class="txt-pop" name="email" id="email" type="text" value="" title="Email" />
					<input class="txt-pop" name="vname" id="vname" type="text" value="" title="Vejnavn" />
					<input class="txt-pop w126 mr10" name="house" id="house" type="text" value="" title="Hus nr." />
					<input class="txt-pop w126" type="text" name="vhouse" id="vhouse"  value="" title="Hus bogst."/>
					<input class="txt-pop w126 mr10" type="text" name="floor" id="floor" value="" title="Etage"/>
					<input class="txt-pop w126" type="text" name="page" id="page" value="" title="Side"/>
					<input class="txt-pop" type="text" name="post" maxlength="4" id="post" value="" title="Postnr."/>
					<input class="txt-pop" type="text" name="phone" id="phone" value="" title="Telefonnr."/>
				</div>
				<div class="w300 fl-left">
					 <p class="p14 p-up p-bold">Reklamationsvalg</p>
					<input class="txt-pop" type="text" name="case1" id="case1" value="" title="Sag" />
					<input class="txt-pop" type="text" name="cause" id="cause" value="" title="Årsag" />
					<textarea class="txa-pop" name="text" id="text" title="Kommentar"></textarea>
				</div>
				<div class="clear"></div>
				<div class="btn-pop">
                
                <img style="cursor: pointer;" onclick="click_send1();" src="<?php echo $this->baseurl ?>/templates/defrieisenkram/img/btn_send.jpg"/>
                <img style="cursor: pointer;" onclick="reset_form1();" src="<?php echo $this->baseurl ?>/templates/defrieisenkram/img/btn_cancle.jpg"/>
				
                </div>
			</fieldset>
            <input type="submit" name="send1" id="send1" value="Send" style="display: none;" />
            
            <input type="hidden" name="option" value="com_kontakt" />
            <input type="hidden" name="view" value="" />
            
            <input type="hidden" name="task" value="submit" />
            <?php echo JHTML::_( 'form.token' ); ?>
		</form>
	</div>
    <script language="javascript">
    	jQuery(document).ready(function() {	
            //jQuery.updnWatermark.attachAll();
    		jQuery("#contactForm").validate({
    			errorPlacement: function(error, element) {			
    			},
    			invalidHandler: function(form, validator) {
    			  var errors = validator.numberOfInvalids();
    			  if (errors) {
                    jQuery('#alert').html(validator['errorList'][0]['message']);
        			jQuery('#backoverlay').show();
        			jQuery('#show_popup').show();
                    jQuery('#f_focus').html(validator['errorList'][0]['element'].name);
    				validator['errorList'][0]['element'].focus();
    			  } else {
    			  }
    			},
    			rules: {
                    name : "required",
                    email: {
    					required: true,
    					email: true
    				},
                    vname: "required",
                    house: "required",
                    vhouse: "required",
                    floor: "required",
                    page: "required",
                    post: {
                        required: true,
				        number: true,
				        minlength:4
                    },
                    phone: "required",
                    case1: "required",
    				cause: "required"
    			},
    			messages: {
                    name: "<?php echo JText::_( 'Udfyld venligst navn' ); ?>",
                    email: "<?php echo JText::_( 'Udfyld venligst email' ); ?>",
                    vname: "<?php echo JText::_( 'Udfyld venligst vejnavn' ); ?>",
                    house: "<?php echo JText::_( 'Udfyld venligst hus nr' ); ?>",
                    vhouse: "<?php echo JText::_( 'Udfyld venligst hus bogst' ); ?>",
                    floor: "<?php echo JText::_( 'Udfyld venligst etage' ); ?>",
                    page: "<?php echo JText::_( 'Udfyld venligst side' ); ?>",
                    post: "<?php echo JText::_( 'Udfyld venligst postnr' ); ?>",
                    phone: "<?php echo JText::_( 'Udfyld venligst telefonnr' ); ?>",
                    case1: "<?php echo JText::_( 'Udfyld venligst sag' ); ?>",
    				cause: "<?php echo JText::_( 'Udfyld venligst Årsag' ); ?>"
    			}
    		});
            close_popup=function(){		
        		var fel=jQuery('#f_focus').html();
                jQuery('#backoverlay').hide();
        		jQuery('#show_popup').hide();
        		jQuery('#' + fel ).focus();
          };
          reset_form1=function(){
                //document.forms[0].reset();
                document.getElementById("contactForm").reset();
          };
          click_send1=function(){
                document.getElementById('send1').click();
          }
    	});
    </script>
    
	<div class="btn-right">
		<a class="btn big-link" href="#"  data-reveal-id="myModal" ><img src="<?php echo $this->baseurl ?>/templates/defrieisenkram/img/btn_right.png" alt="" /></a>
	</div> 
</body>
</html>