
<?php use_helper('Form') ?>
<?php use_stylesheet('post'); ?>
<?php slot('title'); //for title ?>
    <?php echo '发布管理 - '; ?>
<?php end_slot(); ?>

<?php slot('nav1'); ?>
    <?php echo '信息发布管理'; ?>
<?php end_slot(); ?>



<?php if($sf_user->isAuthenticated()): ?>
  <?php slot('rightbar'); ?>
    <div>
      <?php include_partial('rightbar') ?>      
    </div>
  <?php end_slot(); ?>
  <?php $navclass2='';$navclass3='';$navclass4='';$navclass5='';
      if($sf_request->getParameter('action')=='posteditem') $navclass2='now';
      if($sf_request->getParameter('action')=='postedbook') $navclass3='now';
      if($sf_request->getParameter('action')=='postedwanted') $navclass4='now';
      if($sf_request->getParameter('action')=='postedjob') $navclass5='now';
  ?>
      

  <div id="nav">
    
    <?php echo link_to('<span>物品信息</span>','post/posteditem',array('class'=>$navclass2)); ?>
    <?php echo link_to('<span>书籍信息</span>','post/postedbook',array('class'=>$navclass3)); ?>
    <?php echo link_to('<span>求购信息</span>','post/postedwanted',array('class'=>$navclass4)); ?>
    <?php echo link_to('<span>招聘信息</span>','post/postedjob',array('class'=>$navclass5)); ?>
  </div>
  <?php if($navclass2=="now") include_partial('item',array('iList'=>$iList,'titLen'=>20,
    'pager'=>$pager)); ?>
  <?php if($navclass3=="now") include_partial('book',array('iList'=>$iList,'titLen'=>20,
    'pager'=>$pager)); ?>
  <?php if($navclass4=="now") include_partial('wanted',array('iList'=>$iList,'titLen'=>20,
    'pager'=>$pager)); ?>
  <?php if($navclass5=="now") include_partial('job',array('iList'=>$iList,'titLen'=>20,
    'pager'=>$pager)); ?>


<?php else: ?>
  您还没有登陆，请登陆之后再进行信息发布管理
<?php endif; ?>



