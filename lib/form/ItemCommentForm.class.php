<?php

/**
 * ItemComment form.
 *
 * @package    apus
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class ItemCommentForm extends BaseItemCommentForm
{
  public function configure()
  {
    unset($this['created_at'],$this['updated_at'],$this['reply'],$this['user_id'],
      $this['item_id'],$this['owner_reply'],$this['reply_time'],$this['new_reply'],
      $this['ip'],$this['ip_address']);
    
    $this->widgetSchema['body']=new sfWidgetFormTextarea(array(),array('cols'=>60,
      'rows'=>6));
    $this->widgetSchema->setLabels(array('body'=>'留言'));
    
  }
}
