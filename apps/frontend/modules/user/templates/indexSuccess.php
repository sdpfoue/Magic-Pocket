<?php slot('nav'); ?>
  <?php echo ' ';?>
<?php end_slot(); ?>

<?php slot('title');?>
  <?php echo $username;?>的用户页- 
<?php end_slot();?>

<?php
  $navclass2='';
  $navclass3='';
  $navclass4='';
  $navclass5='';
  $action=$sf_request->getParameter('action');
  if($action=='item') $navclass2='now';
  if($action=='book') $navclass3='now';
  if($action=='wanted') $navclass4='now';
  if($action=='job') $navclass5='now';
?>
<div id="nav">
    <?php echo link_to('<span>物品信息</span>','user/item?id='.$id,array('class'=>$navclass2)); ?>
    <?php echo link_to('<span>书籍信息</span>','user/book?id='.$id,array('class'=>$navclass3)); ?>
    <?php echo link_to('<span>招聘信息</span>','user/job?id='.$id,array('class'=>$navclass5)); ?>
    <?php echo link_to('<span>求购信息</span>','user/wanted?id='.$id,array('class'=>$navclass4)); ?>
</div>

<?php if($navclass2=="now") include_partial('item',array('iList'=>$iList,'titleLen'=>$titleLen,
  'pager'=>$pager,'desLen'=>$desLen,'form'=>$form)); ?>
<?php if($navclass3=="now") include_partial('book',array('iList'=>$iList,'titleLen'=>$titleLen,
  'pager'=>$pager,'desLen'=>$desLen,'form'=>$form)); ?>
<?php if($navclass4=="now") include_partial('wanted',array('iList'=>$iList,'titleLen'=>$titleLen,
  'pager'=>$pager,'desLen'=>$desLen,'form'=>$form));?>
<?php if($navclass5=="now") include_partial('job',array('iList'=>$iList,'titleLen'=>$titleLen,
  'pager'=>$pager,'desLen'=>$desLen,'form'=>$form));?>
  
