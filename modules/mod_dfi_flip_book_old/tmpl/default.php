<?php defined('_JEXEC') or die('Restricted access'); // no direct access ?>

<script language="javascript">AC_FL_RunContent = 0;</script>
<script src="<? echo $template_dir; ?>AC_RunActiveContent.js" language="javascript"></script>

<div style="position:absolute; right:37px;top:52px"> <a href="index.php" style="background:none"><img src="<? echo $template_dir; ?>img/tilbage.png" alt=""/></a> </div>
<div style="position:absolute;top:17px;left:0px;z-index:100;">
<script language="javascript">
	if (AC_FL_RunContent == 0) {
		alert("This page requires AC_RunActiveContent.js.");
	} else {
		AC_FL_RunContent(
			'codebase', 'http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0',
			'width', '950',
			'height', '700',
			'src', '<? echo $template_dir; ?>swf/easyviewECCO',
			'quality', 'high',
			'pluginspage', 'http://www.macromedia.com/go/getflashplayer',
			'align', 'middle',
			'play', 'true',
			'loop', 'true',
			'scale', 'showall',
			'wmode', 'transparent',
			'devicefont', 'false',
			'id', 'easyviewECCO',
			'bgcolor', '#ffffff',
			'name', 'easyviewECCO',
			'menu', 'true',
			'allowFullScreen', 'false',
			'allowScriptAccess','sameDomain',
			'movie', '<? echo $template_dir; ?>swf/easyviewECCO',
			'salign', ''
			); //end AC code
	}
</script>
<noscript>
<object classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000" codebase="http://download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=8,0,0,0" width="950" height="700" id="easyviewECCO" align="middle">
  <param name="allowScriptAccess" value="sameDomain" />
  <param name="allowFullScreen" value="false" />
  <param name="movie" value="<? echo $template_dir; ?>swf/easyviewECCO.swf" />
  <param name="quality" value="high" />
  <param name="wmode" value="transparent" />
  <param name="bgcolor" value="#ffffff" />
  <embed src="<? echo $template_dir; ?>swf/easyviewECCO.swf" quality="high" wmode="transparent" bgcolor="#ffffff" width="950" height="700" name="easyviewECCO" align="middle" allowScriptAccess="sameDomain" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" />
</object>
</noscript>
</div>