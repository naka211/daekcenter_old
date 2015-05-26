<?php
/**
 * $Id: default.php 11917 2009-05-29 19:37:05Z ian $
 */
defined( '_JEXEC' ) or die( 'Restricted access' );
?>
<!-- Begin  Stores location banner -->
<div class="left-content">
	<div class="boder-left-menu">
		<div class="left-menu">
			<h3>DIN FREMTID HOS</h3>
			<h3>DIN ISENKRÆMMER</h3>
			<div class="menuleft">
                {module Menu Left}
            </div>
		</div>
	</div>
	<a href="#"><img src="<?php echo $this->baseurl ?>/templates/defrieisenkram/img/ledige-stillinger_06.jpg" alt=""/></a>

</div>
<div class="boder-right-content">
    <div class="right-content">
        
        <?php //echo $this->loadTemplate('form'); 
            $layout = $_GET['layout']?$_GET['layout']:"";
            if ($layout!="success"){
                echo $this->loadTemplate('form');
            }else if($layout=="success"){
                echo $this->loadTemplate('success');
            }
        
        ?>
    	
    </div>
</div>