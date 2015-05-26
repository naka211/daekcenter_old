<?php // no direct access
defined('_JEXEC') or die('Restricted access'); ?>



<div class="boder-right-content">
    <div class="right-content">

        <?php foreach ($this->items as $item) : ?>
    	<div class="post-news">
            
            <?php if($item->article_image){?>
            
    		<a class="img-cnt-left" href="<?php echo $item->metadesc; ?>" target="_blank">
            <span></span>
            <img style="width: 200px; max-height:200px;" src="<?php echo $item->article_image; ?>" alt=""/></a>
    		<?php }?>
            
            <div class="txt-cnt">
    		<div>
                <?php echo $item->introtext;?>
            </div>
            

    		</div>
    	</div>
        <?php endforeach; ?>
    

    		
	</div>
</div>