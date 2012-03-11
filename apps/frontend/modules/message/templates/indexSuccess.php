<?php slot('title'); //for title ?>
    <?php echo '收件箱 - '; ?>
<?php end_slot(); ?>

<?php slot('nav1'); //for title ?>
    <?php echo '收件箱'; ?>
<?php end_slot(); ?>


<?php if($sf_user->isAuthenticated()): ?>
  <?php slot('rightbar'); ?>
    
  <?php end_slot(); ?>
  <div style="width:631px;">
    <div class="xbar">
      <div>
      <!---
        <a href="/settings/privacy">邮件提醒</a>
        <a href="/settings/miniblog/">广播隐私</a> --->
        
        <?php if($nav2):?>
        <span class="now">
          <span>发信箱</span>
        </span>
        <?php else:?>
          <?php echo link_to('发信箱','message/sendbox');?>
        <?php endif;?>
        <?php if($nav1):?>
        <span class="now">
          <span>收信箱</span>
        </span>
        <?php else:?>
          <?php echo link_to('收信箱','message/index');?>
        <?php endif;?>
      </div>
    </div>
    <div class="clear"></div>
    <?php if($nav1):?><?php include_component('message','receive');?>  <?php endif;?>
    <?php if($nav2):?><?php include_component('message','send');?><?php endif;?>
    
  </div>

<?php else: ?>
您还没有登陆，请登陆之后再进行个人设置
<?php endif; ?>
