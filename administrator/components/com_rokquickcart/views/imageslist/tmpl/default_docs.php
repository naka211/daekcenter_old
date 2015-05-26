<?php defined('_JEXEC') or die('Restricted access'); ?>
		<div class="item">
			<a href="javascript:ImageManager.populateFields('<?php echo $this->_tmp_docs->path_relative; ?>')">
				<img src="<?php echo JURI::base() ?>components/com_media/images/noimages.gif" width="80" height="80" alt="<?php echo $this->_tmp_docs->name; ?>" />
				<span><?php echo $this->_tmp_docs->name; ?></span></a>
		</div>
