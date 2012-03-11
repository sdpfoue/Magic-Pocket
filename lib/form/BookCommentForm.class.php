<?php

/**
 * BookComment form.
 *
 * @package    apus
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class BookCommentForm extends BaseBookCommentForm
{
  public function configure()
  {
    unset($this['book_id'],$this['user_id'],$this['created_at'],$this['updated_at'],
      $this['ip'],$this['ip_address'],$this['owner_reply'],$this['reply_time'],
      $this['new_reply']);
    $this->widgetSchema['body']=new sfWidgetFormTextarea(array(),array('cols'=>60,
      'rows'=>6));
    $this->widgetSchema->setLabels(array('body'=>'留言'));
  }
}
