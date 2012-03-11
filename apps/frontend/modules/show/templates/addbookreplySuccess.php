<?php use_helper('Javascript')?>

<?php if($comment->getOwnerReply()):?>
  <?php echo $comment->getReplyTime().' 主人回复：<br/>';?>
  <div class="replybody" id="<?php echo 'rct'.$comment->getId();?>">
    <?php echo nl2br($comment->getOwnerReply());?>
  </div>
<?php endif;?>
