<tr>
  <td class="comment_title">
    <span style="float:left; width:500px;">
    <?php echo $comment->getCreatedAt();?>&nbsp;&nbsp;&nbsp;
    <?php echo $comment->getUser();?>&nbsp;&nbsp;&nbsp;
    </span>
    <span style="float:right; width:200px;text-align:right;">
    <?php if($commentowner) echo link_to(image_tag('edit.png').'编辑',
      'show/edititemcomment');?>&nbsp;&nbsp;&nbsp;
    <?php if($commentowner||$owner) echo link_to(image_tag('delete.png').'删除',
      'show/delitemcomment?id='.$comment->getId(),
      array('confirm'=>'确定删除吗?'));?>&nbsp;&nbsp;&nbsp;
    <?php if($owner) echo link_to(image_tag('new.png').'回复',
      'show/replyitemcomment');?>
    </span>
  </td>      
</tr>
<tr>
  <td class="comment_body">
    <?php echo nl2br($comment->getBody());?>
  </td>
</tr>
