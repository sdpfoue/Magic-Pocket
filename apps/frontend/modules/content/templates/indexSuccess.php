<?php use_helper('Javascript') ?>
<div id="edit_me" style="width:300px;"><?php echo $title ?></div>
<?php echo input_in_place_editor_tag('edit_me', 'mymodule/myaction', array(
  'cols'        => 40,
  'rows'        => 10,
)) ?>

