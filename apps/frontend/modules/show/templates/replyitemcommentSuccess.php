<?php use_helper('Form')?>
<?php use_helper('Javascript')?>

<?php echo form_remote_tag(array(
    'update'   => $element,
    'url'      => 'show/additemreply?id='.$id,
)) ?>
<table>
  <tr>
    <td>
      <?php echo textarea_tag('reply',$body,array('rows' => 5, 'cols' => 70)) ?><br/>
    </td>
  </tr>
  <tr>
    <td style="text-align:center;">
      <?php echo submit_tag('提交/取消') ?>
    </td>
  </tr>
</table>
<?php  //echo $id;?>
</form>
