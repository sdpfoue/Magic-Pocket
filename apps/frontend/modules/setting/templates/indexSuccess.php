<?php slot('title'); //for title ?>
    <?php echo '个人设置 - '; ?>
<?php end_slot(); ?>

<?php slot('nav1'); //for title ?>
    <?php echo '个人设置中心'; ?>
<?php end_slot(); ?>

<?php $nav1=false;$nav2=false;$nav3=false;
  if($sf_request->getParameter('action')=='mail') $nav3=true;
  if($sf_request->getParameter('action')=='address') $nav2=true;
  if($sf_request->getParameter('action')=='index') $nav1=true;
?>


<?php if($sf_user->isAuthenticated()): ?>
  <?php slot('rightbar'); ?>
    <div>
      <?php include_partial('rightbar') ?>      
    </div>
  <?php end_slot(); ?>
  <div style="width:631px;">
    <div class="xbar">
      <div>
      
        
        
        <?php if($nav3):?>
        <span class="now">
          <span>邮件提醒</span>
        </span>
        <?php else:?>
          <?php echo link_to('邮件提醒','setting/mail');?>
        <?php endif;?>
       
        
        <?php if($nav2):?>
        <span class="now">
          <span>默认地址</span>
        </span>
        <?php else:?>
          <?php echo link_to('默认地址','setting/address');?>
        <?php endif;?>
        <?php if($nav1):?>
        <span class="now">
          <span>个人信息</span>
        </span>
        <?php else:?>
          <?php echo link_to('个人信息','setting/index');?>
        <?php endif;?>
      </div>
    </div>
    <div class="clear"></div>
    <?php if($nav1):?><?php include_component('setting','info');?>  <?php endif;?>
    <?php if($nav2):?><?php include_partial('address',array('form'=>$form));?><?php endif;?>
    <?php if($nav3):?><?php include_partial('mail',array('form'=>$form,'user'=>$user));?><?php endif;?>
  </div>

<?php else: ?>
您还没有登陆，请登陆之后再进行个人设置
<?php endif; ?>
