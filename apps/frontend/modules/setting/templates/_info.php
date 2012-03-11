<?php use_helper('Form');?>
<?php echo form_tag('setting/index','method=post');?>

  <table class="inf">
    <?php echo $form?>  
    <!--
    <tr>
      <th>修改Email</th><td><?php echo link_to('修改','setting/email');?></td>
    </tr>
    -->
    <tr>
      <th>修改密码</th><td><?php echo link_to('修改','setting/pwd');?></td>
    </tr>
    <tr>
      <td colspan="2" style="text-align:center;"><?php echo submit_tag('提交');?>
      <?php //echo $uid;?>
      </td>
    </tr>
  </table>
</form>
