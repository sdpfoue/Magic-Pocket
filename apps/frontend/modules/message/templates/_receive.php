
<?php use_helper('Form');?>
<?php echo form_tag('message/delrec','method=post');?>
<table class="ols" style="width:100%">
  <tr>
    <td style="width:100px;">来自</td>
    <td>标题</td>
    <td style="width:140px;">时间</td>
    <td style="width:40px;">选择</td>    
  </tr>
  <?php foreach ($messages as $message): ?>
  <?php $i++;?>
  <tr>
    <td><?php echo link_to($message->getUserRelatedByFromId(),
      'user/index?id='.$message->getUserRelatedByFromId()->getId());?></td>
    <td>
       <?php if(!$message->getIsread()):?>
          <b> > 
       <?php endif;?>
       <?php echo link_to(myUser::cutword($message->getTitle(),20),
          'message/show?id='.$message->getId());?>
       <?php if(!$message->getIsread()):?>
        </b>
       <?php endif;?>
    </td>
    <td><?php echo $message->getTime();?></td>
    <td><?php echo checkbox_tag("mc[$i]",$message->getId());?></td>
  
  </tr>
  <?php endforeach;?>
  <tr>
    <td colspan="4" style="text-align:right">
      <input name="b" type="button" value="全选" onClick="CheckAll(true);"/> &nbsp; <input name="c" type="button" value="全清" onClick="CheckAll(false);"/>&nbsp;
      <?php echo submit_tag('删除所选的邮件');?>
    </td>
  </tr>
  
</table>
<div><?php include_partial('page',array('pager'=>$pager));?>
</form>

<script type="text/javascript">/*<![CDATA[*/
    function CheckAll(value)
    {
        var boxes=document.getElementsByTagName("input");
        for(var i=0; i<boxes.length; i++) {
            if (boxes[i].type=='checkbox') {
                boxes[i].checked=value;
            }
        }
    }
    /*]]>*/</script>
    
