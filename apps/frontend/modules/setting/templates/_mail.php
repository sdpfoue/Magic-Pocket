<?php use_helper('Javascript') ?>
<?php use_helper('Form') ?>
<form class="inf" method="post">
  <table>
    <?php echo $form;?>
    <tr>
      <td colspan="2" style="text-align:center;"><input type="submit" value="提交"></td>
    </tr>
  </table>
</form>

<br/><br/>
<div style="float:left;">当前邮箱：</div>
  <div id="mail" style="float:left;"><?php if($user->getEmail()) echo $user->getEmail().' (已验证)';
    if($user->getEmail()==null&&$user->getTempEmail()==null) echo '<span style="color:red;">未设置</span>';
    if($user->getTempEmail()) echo $user->getTempEmail().' <span style="color:red;">等待验证</span>';?></div>
    <div class="clear"></div>
  <?php echo form_remote_tag(array(
    'update'   => 'mail',
    'url'      => 'setting/setmail',
  )) ?>
    <?php echo input_tag('email') ?>
    <?php echo submit_tag('设置Email') ?>
  </form>
  <div id="msg">
<?php if($user->getTempEmail())
   echo link_to_remote('点击重新发送验证信', array(
      'update' => 'msg',
      'url'    => 'setting/resend',
      'complete' => visual_effect('Grow', 'msg'),
  ), array(
      'class' => 'ajax_link',
  )); ?>
</div>
  



