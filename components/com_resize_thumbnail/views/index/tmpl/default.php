<?php defined('_JEXEC') or die('Restricted access'); ?>
<form action="<?php echo $this->action ?>" method="post" name="resize_thumbnailForm" id="resize_thumbnailForm">
<input type="hidden" name="option" value="com_resize_thumbnail" />
<input type="hidden" name="controller" value="" />
<input type="hidden" name="task" value="" />
<?php echo JHTML::_( 'form.token' ); ?>
</form>