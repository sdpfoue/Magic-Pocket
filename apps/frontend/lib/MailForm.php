<?php
//for job search

class MailForm extends sfForm
{
  protected static $chos = array('不接受', '接受');
  
  public function configure()
  {
    $this->setWidgets(array(     
      'message'   => new sfWidgetFormSelect(array('choices' => self::$chos)),
      'comment' => new sfWidgetFormSelect(array('choices' => self::$chos)),
      'reply'=> new sfWidgetFormSelect(array('choices' => self::$chos))      
    ));
    
    $this->widgetSchema->setNameFormat('mail[%s]');
    
    $this->widgetSchema->setLabels(array('message'=>'短消息','comment'=>'所发布信息有留言',
      'reply'=>'留言有主人回复'));
    
    $this->validatorSchema['message']=new sfValidatorChoice(array('choices' => array_keys(self::$chos)));
    $this->validatorSchema['reply']=new sfValidatorChoice(array('choices' => array_keys(self::$chos)));
    $this->validatorSchema['comment']=new sfValidatorChoice(array('choices' => array_keys(self::$chos)));
    
  }
}
