<?php slot('nav'); ?>
  <?php echo ' ';?>
<?php end_slot(); ?>

<?php
  $navclass2='';
  $navclass3='';
  $navclass4='';
  $navclass5='';
  $page=$sf_request->getParameter('action');
  if($page=='item') $navclass2='now';
  if($page=='book') $navclass3='now';
  if($page=='wanted') $navclass4='now';
  if($page=='job') $navclass5='now';

?>



<div id="nav">
    <?php echo link_to('<span>物品信息</span>','index/item',array('class'=>$navclass2)); ?>
    <?php echo link_to('<span>书籍信息</span>','index/book',array('class'=>$navclass3)); ?>
    <?php echo link_to('<span>招聘信息</span>','index/job',array('class'=>$navclass5)); ?>
    <?php echo link_to('<span>求购信息</span>','index/wanted',array('class'=>$navclass4)); ?>
</div>



<?php if($navclass2=="now") include_partial('item',array('iList'=>$iList,'titleLen'=>$titleLen,
  'pager'=>$pager,'desLen'=>$desLen,'form'=>$form,'query'=>$sf_data->getRaw('query'))); ?>
<?php if($navclass3=="now") include_partial('book',array('iList'=>$iList,'titleLen'=>$titleLen,
  'pager'=>$pager,'desLen'=>$desLen,'form'=>$form,'query'=>$sf_data->getRaw('query'))); ?>
<?php if($navclass4=="now") include_partial('wanted',array('iList'=>$iList,'titleLen'=>50,
  'pager'=>$pager,'desLen'=>$desLen,'form'=>$form,'query'=>$sf_data->getRaw('query')));?>
<?php if($navclass5=="now") include_partial('job',array('iList'=>$iList,'titleLen'=>50,
  'pager'=>$pager,'desLen'=>$desLen,'form'=>$form,'query'=>$sf_data->getRaw('query')));?>
  
