<?php slot('title'); //for title ?>
    <?php echo '收件箱 - '; ?>
<?php end_slot(); ?>

<?php slot('nav1'); //for title ?>
    <?php echo link_to('收件箱','message/index'); ?>
<?php end_slot(); ?>


<?php if($sf_user->isAuthenticated()): ?>
  <?php slot('rightbar'); ?>
 
      <?php end_slot(); ?>
   <div style="margin:10px 20px;">  
      来自： <?php echo link_to($message->getUserRelatedByFromId(),
          'user/index?id='.$message->getUserRelatedByFromId()->getId());?><br/>
      时间：<?php echo $message->getTime();?><br/><br/>
      标题：<?php echo $message->getTitle();?><br/>
     <br/>
      <?php echo nl2br($message->getBody());?>
  </div>
  

<?php else: ?>
您还没有登陆，请登陆之后再进行个人设置
<?php endif; ?>
