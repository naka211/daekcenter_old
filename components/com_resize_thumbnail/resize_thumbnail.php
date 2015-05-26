<?php
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

jimport( '3rdparty.SimpleImage' );

$file = JRequest::getVar( 'file' );
$width = JRequest::getVar( 'width' );
$height = JRequest::getVar( 'height' );

header('Content-Type: image/jpeg');

$image = new SimpleImage();
$image->load( $file );
if ($width && $height)
	$image->real_scale($width, $height);
else if ($width)
	$image->resizeToWidth($width);
else if ($height)
	$image->resizeToHeight($height);
	
$image->output();

exit;

?>