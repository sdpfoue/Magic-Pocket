<?php use_stylesheet('post'); ?>
<?php use_helper('Form') ?>
<?php slot('title'); //for title ?>
    <?php echo '地址管理 - '; ?>
<?php end_slot(); ?>

<?php slot('nav1'); ?>
    <?php echo link_to('个人中心','setting/index').' >> 地址管理'; ?>
<?php end_slot(); ?>


<?php if($sf_user->isAuthenticated()): ?>
  <?php slot('rightbar'); ?>
    <div>
      <?php include_partial('rightbar') ?>      
    </div>
  <?php end_slot(); ?>
  
  <?php echo form_tag('post/address?url='.$url,'method=post'); ?>
  <table>
    <?php echo $form ?>
    <tr>
      <td colspan="2" align="center">
        <?php echo button_to('取消','post/'.$url); ?> &nbsp;&nbsp;&nbsp;
        <?php echo submit_tag('提交');?>
      </td>
  </table>
  
  
  
  
  


<?php else: ?>
您还没有登陆，请登陆之后再进行个人设置
<?php endif; ?>
