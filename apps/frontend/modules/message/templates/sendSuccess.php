<?php use_helper('Form');?>
<?php slot('title'); //for title ?>
    <?php echo '个人设置 - '; ?>
<?php end_slot(); ?>

<?php slot('nav1'); //for title ?>
    <?php echo '个人设置中心'; ?>
<?php end_slot(); ?>


<?php if($sf_user->isAuthenticated()): ?>
  <?php slot('rightbar'); ?>
    
  <?php end_slot(); ?>
  
  <?php echo form_tag('message/send?id='.$to,'method=post')?>
    <table class="inf">
      <tr>
        <th>寄给</th><td><?php echo $rec;?></td>
      </tr>
        <?php echo $form ?>
      <tr>
        <td></td>
        <td align="center">
          <?php echo submit_tag('发送').' '.button_to('取消','message/index');?>
        </td>
      </tr>     
    </table>
  </form>
  
<?php else: ?>
您还没有登陆，请登陆之后再进行个人设置
<?php endif; ?>
