<?php
// no direct access
defined( '_JEXEC' ) or die( 'Restricted access' );

header('text/xml');

$db =& JFactory::getDBO();
$catid = JRequest::getVar('catid', 1, '', 'int');
$sql = "SELECT * FROM #__dfi_catalogs AS a WHERE catid=".$catid." AND published=1 ORDER BY ordering";
$db->setQuery($sql);
$rows = $db->loadObjectList();
$xml = "";
for($i=0; $i<count($rows); $i++)
{
	$xml .= '<page>'.$rows[$i]->filename.'?printURL='.$rows[$i]->filename.'</page>';
}
		
echo '<FlippingBook>
		<width>910</width>
		<height>544</height>
		<scaleContent>true</scaleContent>
		<firstPage>0</firstPage>
		<alwaysOpened>false</alwaysOpened>
		<autoFlip>50</autoFlip>
		<flipOnClick>true</flipOnClick>
		<staticShadowsDepth>6</staticShadowsDepth>
		<dynamicShadowsDepth>1</dynamicShadowsDepth>
		<moveSpeed>5</moveSpeed>
		<closeSpeed>6</closeSpeed>
		<gotoSpeed>6</gotoSpeed>
		<flipSound>01.mp3</flipSound>
		<pageBack>0x656565</pageBack>
		<loadOnDemand>true</loadOnDemand>
		<cachePages>true</cachePages>
		<cacheSize>5</cacheSize>
		<preloaderType>Round</preloaderType>
		<pages>'.$xml.'</pages></FlippingBook>';
exit;
		
/*// Require the base controller
require_once( JPATH_COMPONENT.DS.'controller.php' );

// Require specific controller if requested
if($controller = JRequest::getWord('controller')) {
    $path = JPATH_COMPONENT.DS.'controllers'.DS.$controller.'.php';
    if (file_exists($path)) {
        require_once $path;
    } else {
        $controller = '';
    }
}

// Create the controller
$classname    = 'CatalogController'.$controller;
$controller   = new $classname( );

// Perform the Request task
$controller->execute( JRequest::getVar( 'task' ) );

// Redirect if set by the controller
$controller->redirect();*/
?>