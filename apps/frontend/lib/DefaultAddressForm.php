<?php
class DefaultAddressForm extends sfForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'city_id'  => new sfWidgetFormPropelChoice(array('model' => 'City', 'add_empty' => false)),
      'address'   => new sfWidgetFormInput(),      
    ));
    $this->widgetSchema->setNameFormat('address[%s]');

    $this->widgetSchema->setLabels(array('name'=>'用户名 *',
        'city_id'=>'选择城市',
        'address'=>'详细地址',
        ));
    
    $this->setValidators(array(
      'address'             => new sfValidatorString(array('max_length' => 500)),      
      'city_id'          => new sfValidatorInteger(),))    ;
  }
}
?>
