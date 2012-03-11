
  <?php if($number):?>
    <?php echo link_to('<span style="color:red">短消息('.$number.')</span>','message/index'); ?> &nbsp;&nbsp;
  <?php else:?>
    <?php echo link_to('短消息','message/index'); ?> &nbsp;&nbsp;
  <?php endif;?>
