<?php echo form_tag('show/'.$url,'method=post')?>
  <table>
    <?php echo $commentForm?>
    <tr><td colspan="2">
      <?php echo submit_tag('提交');?>
    </td></tr>
  </table>
</form>
