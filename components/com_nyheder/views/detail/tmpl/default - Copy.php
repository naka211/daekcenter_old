<?php defined('_JEXEC') or die('Restricted access'); ?>
<script type="text/javascript" src="<? echo $this->template_dir; ?>Scripts/mootools1.2b.js"></script>
<form action="<?php echo $this->action ?>" method="post" name="nyhederForm" id="nyhederForm">
<div class="bg_tr">
    <p class="title_2 m20l p30t"><? echo $this->row->title; ?></p>
  </div>
  <div class="bg_cr h515">
    <div class="m20l m20r" id="gallery">
      <? echo $this->row->fulltext?$this->row->fulltext:$this->row->introtext; ?>
    </div>
  </div>
  <div class="bg_br"></div>

  <input type="hidden" name="option" value="com_nyheder" />
  <input type="hidden" name="controller" value="" />
  <input type="hidden" name="task" value="" />
  <?php echo JHTML::_( 'form.token' ); ?>
</form>
