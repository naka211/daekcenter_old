<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="en" xml:lang="en">
	<head>
<link rel="image_src" href="http://daekcenter.nu/tilbud.jpg" / >
	<jdoc:include type="head" />
<?php
$this->setTitle( 'Dækcenter.nu @ Hele Danmarks dækcenter - Sommerdæk, Vinterdæk, Helårsdæk' ); 
  unset($this->_scripts[$this->baseurl.'/media/system/js/mootools.js']);
  unset($this->_scripts[$this->baseurl.'/media/system/js/caption.js']);


?>
    	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta content="" name="description"/>
        <meta content="" name="keywords"/>    



<link rel="shortcut icon" type="image/x-icon" href="favicon.ico" />
        <link rel="stylesheet" type="text/css" media="screen" href="templates/daecenter/css/reset.css" />
		<link rel="stylesheet" type="text/css" media="print" href="templates/daecenter/css/print.css" />
		<link rel="stylesheet" type="text/css" media="screen" href="templates/daecenter/css/typography.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="templates/daecenter/css/styles.css" />
        <link rel="stylesheet" type="text/css" media="screen" href="templates/daecenter/css/reveal.css" />
        <!-- js files -->
		<script src="templates/daecenter/js/jquery-1.7.1.min.js" type="text/javascript"></script>
		 <script src="js/menu.js" type="text/javascript"></script>
        <script src="templates/daecenter/js/tooltip.js" type="text/javascript"></script>
		  <script>
			function goToByScroll(id){
     			$('html,body').animate({scrollTop: $("#"+id).offset().top},'slow');
			}
		</script>
        <!-- js files -->
	</head>
	<body>
        <!--[if gt IE 7]><div class="ie ie8"><![endif]-->
        <!--[if IE 7]><div class="ie ie7"><![endif]-->
        <!--[if IE 6]><div class="ie ie6"><![endif]-->
        <!--[if lt IE 6]><div class="ie ie5"><![endif]-->
        <!--[if !IE]>--><div class="ie0"><!--<![endif]-->
		<script type="text/javascript" src="templates/daecenter/js/get_nav.js"></script>
            <div id="top"></div>
            <!-- page content -->
            <div class="wrapper">
                <div id="page">
                	<!--Begin Container-->
                	<div id="container">
                    	<div class="top-decor"></div>
						
                        <!-- Begin left sidebar-->
						<?php if(JRequest::getVar('view')!='search' and JRequest::getVar('layout')!='facebookapp' and JRequest::getVar('layout')!='defaultfbapp' and JRequest::getVar('layout')!='iframeapp' and JRequest::getVar('layout')!='iframeapp-link' and JRequest::getVar('layout')!='firmainfoapp-kort-iframe-sample'){?>
                        <div id="sidebar">
                        	<div class="sidebar-inner">
                                <h1 id="logo"><a href="index.php" class="logo" title="DÆKCENTER.NU"><img src="templates/daecenter/img/logo.png" alt="DÆKCENTER" /></a></h1>
                                <div id="menu">
                                   
											<jdoc:include type="modules" name="menutop" />  
									
                                </div>
                                
                                <div id="ads">
                                	<div class="ads-inner">
                                    {module banner_left}
                                    </div>
                                </div>
                        	</div>
                        </div>
						<?php }?>
                        <!-- / Left sidebar-->
                        <!-- Begin main content -->
                       <?php if(JRequest::getVar('view')!='search' and JRequest::getVar('layout')!='facebookapp' and JRequest::getVar('layout')!='defaultfbapp' and JRequest::getVar('layout')!='iframeapp' and JRequest::getVar('layout')!='iframeapp-link' and JRequest::getVar('layout')!='firmainfoapp-kort-iframe-sample'){?> <div id="main"><?php }?>
                          <jdoc:include type="component" />
                         <?php if(JRequest::getVar('view')!='search' and JRequest::getVar('layout')!='facebookapp' and JRequest::getVar('layout')!='defaultfbapp' and JRequest::getVar('layout')!='iframeapp' and JRequest::getVar('layout')!='iframeapp-link' and JRequest::getVar('layout')!='firmainfoapp-kort-iframe-sample'){?></div><?php }?>
				
						
                        <!-- / end main content -->
					</div>
                    <!--/Container-->
                    <!--footer-->
                       <div class="<?php if(JRequest::getVar('view')!='search' and JRequest::getVar('layout')!='facebookapp' and JRequest::getVar('layout')!='defaultfbapp' and JRequest::getVar('layout')!='iframeapp' and JRequest::getVar('layout')!='iframeapp-link' and JRequest::getVar('layout')!='firmainfoapp-kort-iframe-sample'){?>w950<?php } else echo footer2 ?>" id="<?php if(JRequest::getVar('view')!='search' and JRequest::getVar('layout')!='facebookapp' and JRequest::getVar('layout')!='iframeapp' and JRequest::getVar('layout')!='defaultfbapp' and JRequest::getVar('layout')!='iframeapp-link' and JRequest::getVar('layout')!='firmainfoapp-kort-iframe-sample'){?>footer<?php } else echo footer2 ?>">
<p>Dækcenter.nu&nbsp;- Hele Danmarks dækcenter, alle dækmærker et sted&nbsp;-&nbsp;vælg din forhandler og se din pris - <a href="mailto:info@daekcenter.nu">info@daekcenter.nu</a></p>
</div>
                    <!--/footer-->
         
                </div>
            </div>
			<!--/ page content -->
           
    	</div>
<script src="http://ibuildapp.com/DM_redirect.js" type="text/javascript"></script>
<script type="text/javascript">
    DM_redirect('https://ibuildapp.com/app-504157-Daekcenter');
</script>
        <script type="text/javascript">
			$(function () {
				var scroll_timer;
				var displayed = false;
				var $message = $('#toTop a');
				var $window = $(window);
				var top = $(document.body).children(0).position().top;
				$window.scroll(function () {
					window.clearTimeout(scroll_timer);
					scroll_timer = window.setTimeout(function () {
						if($window.scrollTop() <= top)
						{
							displayed = false;
							$message.fadeOut(500);
						}
						else if(displayed == false)
						{
							displayed = true;
							$message.stop(true, true).show().click(function () { $message.fadeOut(500); });
						}
					}, 100);
				});
			});	
</script>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/da_DK/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'scr