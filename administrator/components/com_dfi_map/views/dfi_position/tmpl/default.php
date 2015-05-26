<?php defined('_JEXEC') or die('Restricted access'); ?>

<form action="index.php?option=com_dfi_map" method="post" name="adminForm" id="adminForm">

  <table class="admintable" width="100%">
	<tr>
      <td align="center"><input type="image" src="<?php echo $this->lists['gallerydir']; ?>/dfi-maps.png" width="881" height="659" />
      </td>
    </tr>
	
  </table>
  
  <input type="hidden" name="option" value="com_dfi_map" />
  <input type="hidden" name="task" value="move" />
  <?php echo JHTML::_( 'form.token' ); ?>
</form>
