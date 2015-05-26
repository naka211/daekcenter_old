<?php defined('_JEXEC') or die('Restricted access'); ?>
<form action="<?php echo $this->action ?>" method="post" name="catalogForm" id="catalogForm">
<input type="hidden" name="option" value="com_catalog" />
<input type="hidden" name="controller" value="" />
<input type="hidden" name="task" value="" />
<?php echo JHTML::_( 'form.token' ); ?>
</form>