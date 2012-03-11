<?php include_stylesheets_for_form($form) ?>
<?php include_javascripts_for_form($form) ?>

<?php use_helper('Form') ?>
<?php slot('title'); //for title ?>
    <?php echo $navname.' - '; ?>
<?php end_slot(); ?>

<?php slot('nav1'); ?>
    <?php echo link_to('信息发布管理','post/'.$cancel).' >> '.$navname; ?>
<?php end_slot(); ?>



<?php if($sf_user->isAuthenticated()): ?>
  <?php slot('rightbar'); ?>
    <div>
      <?php include_partial('rightbar') ?>      
    </div>
  <?php end_slot(); ?>
  
  
  <?php echo form_tag('post/'.$action,'method=post enctype=multipart/form-data class=addform'); ?>
    <table style="width:60%; float:left;background-color:#EEF9EB;">
      <?php echo $form ?>
      <td colspan="2" style="text-align:center;">
          <?php echo button_to('取消','post/'.$cancel); ?>&nbsp;&nbsp;
          <?php echo submit_tag('提交');?>
      </td>
    </table>
    <?php //echo input_hidden_tag("item[user_id]",$userid); ?>
  </form>
  
  <div style="width:20%; float:left;background-color:inherit; margin-top:100px;">
    提示:<br />
    
    您可以到“个人中心”设置和修改默认地址<br/><br/>
    <?php if($cancel!='postedbook'):?>
     
    <?php endif;?>
    
    <?php if($cancel!='postedwanted'):?>
      上传图片大小上限为<b><u>500K</u></b>。接受.jpg .jpeg .gif .png格式文件
    <?php endif; ?>
  </div>
 

  

<?php else: ?>
  您还没有登陆，请登陆之后再进行信息发布管理
<?php endif; ?>

