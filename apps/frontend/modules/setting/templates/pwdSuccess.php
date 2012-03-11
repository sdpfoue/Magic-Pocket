<span style="color:red;padding-left:150px;"><?php echo $errmsg;?></span>
<?php use_helper('Form');?>
<?php echo form_tag('setting/pwd','method=post name=pwd ');?>
  <table class="inf">
    <?php echo $form ?>

    <tr>
      <td colspan="2" style="text-align:center;">
        <?php echo submit_tag('提交')?> <?php echo button_to('取消','setting/index');?><td>
    </tr>
  </table>
</form>
