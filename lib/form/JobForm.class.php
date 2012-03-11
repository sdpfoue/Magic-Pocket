<?php

/**
 * Job form.
 *
 * @package    apus
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class JobForm extends BaseJobForm
{
  protected static $types = array('均可', '全职', '兼职');
  protected static $gender = array('均可', '男', '女');
  protected static $experience = array('不需要', '需要');

  public function configure()
  {
    unset($this['created_at'], $this['updated_at'],$this['lastsignin'],
      $this['recent_item_list'],$this['ip'],$this['ipaddr']
      ,$this['viewed'],$this['user_id'],$this['isfind'],$this['prompted_at'],
      $this['item_report_list'],$this['comment_number'],$this['reply_number'],
      $this['new_comment_number'],$this['viewed'],$this['comment_number']);
    
    $this->widgetSchema['type']=new sfWidgetFormSelect(array('choices' => self::$types));
    $this->widgetSchema['gender']=new sfWidgetFormSelect(array('choices' => self::$gender));
    $this->widgetSchema['experience']=new sfWidgetFormSelect(array('choices' => self::$experience));
    
    $this->widgetSchema->setLabels(array('leasttime'=>'最少时间 *','gender'=>'要求性别',
      'detail'=>'详细信息 *','wage'=>'时薪 *','type'=>'工作类型','experience'=>'是否需要经验',
      'address'=>'详细地址 *','link'=>'参考链接','city_id'=>'选择城市','postcode'=>'邮编 *',
      'title'=>'标题 *'));
    
    $this->validatorSchema['link']=new sfValidatorUrl(array('required'=>false));  
    

    
  }
}
