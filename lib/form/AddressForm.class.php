<?php

/**
 * Address form.
 *
 * @package    apus
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class AddressForm extends BaseAddressForm
{
  public function configure()
  {
    unset($this['user_id'],$this['created_at'],$this['updated_at']);
    $this->widgetSchema->setLabels(array('city_id'=>'选择城市',
      'suburb'=>'地区','address'=>'地址'));
  }
}
