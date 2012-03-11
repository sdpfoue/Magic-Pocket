<?php

/**
 * Message form.
 *
 * @package    apus
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class MessageForm extends BaseMessageForm
{
  public function configure()
  {
    unset($this['from_id'],$this['receive_id'],$this['time'],
      $this['ip'],$this['isread'],$this['ipaddr'],$this['delbysender'],
      $this['delbyreceiver']);
    $this->widgetSchema['body']=new sfWidgetFormTextarea(array(),array('cols'=>60,
      'rows'=>20));
    $this->widgetSchema['title']=new sfWidgetFormInput(array(),array('size'=>50));
      
    $this->widgetSchema->setLabels(array('body'=>'内容','title'=>'标题'));
    
    

  }
}
