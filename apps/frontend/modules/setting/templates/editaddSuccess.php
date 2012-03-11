<?php use_stylesheet('post'); ?>
<?php use_helper('Form')?>
<?php slot('title'); //for title ?>
    <?php echo '地址管理 - '; ?>
<?php end_slot(); ?>

<?php slot('nav1'); ?>
    <?php echo link_to('个人中心','setting/index').' >> '.link_to('地址管理','setting/address').
      ' >> 更新地址'; ?>
<?php end_slot(); ?>

<?php if($sf_user->isAuthenticated()): ?>
  <?php slot('rightbar'); ?>
    <div>
      <?php include_partial('rightbar') ?>      
    </div>
  <?php end_slot(); ?>

  <?php echo form_tag('setting/editadd','method=post') ?>
    <table>
      <?php echo $form ?>
      <tr align="center"><td colspan="2">
        <input type="hidden" value="<?php echo $add?>" name="add" />
        <?php echo button_to('取消','setting/address'); ?>&nbsp;&nbsp;&nbsp;
        <?php echo submit_tag('提交更改'); ?>
      </td></tr>
    </table>
  </form>
<?php endif;?>
