<?php

/**
 * Wanted form.
 *
 * @package    apus
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class WantedForm extends BaseWantedForm
{
  public function configure()
  {
    unset($this['created_at'], $this['updated_at'],$this['lastsignin'],
      $this['recent_item_list'],$this['ip'],$this['ip_address']
      ,$this['viewed'],$this['user_id'],$this['issold'],$this['lastprompt'],
      $this['item_report_list']);
    
    $criteria = new Criteria();
    $criteria->add(AddressPeer::USER_ID, $this->object->getUserId());
    $this->widgetSchema->setLabels(array('description'=>'详细信息 *','name'=>'物品名称 *',
      'item_detail'=>'物品描述 *','item_price'=>'价格 *','issold'=>'是否已出售',
      'address'=>'详细地址','link'=>'参考链接','city_id'=>'选择城市'));
    $this->validatorSchema['link']=new sfValidatorUrl(array('required'=>false));   
  }
}
