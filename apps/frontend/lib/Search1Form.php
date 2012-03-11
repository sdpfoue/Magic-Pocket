<?php
class Search1Form extends sfForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'city'  => new sfWidgetFormPropelChoice(array('model' => 'City', 'add_empty' => '所有地区')),
      'category'   => new sfWidgetFormPropelChoice(array('model' => 'Category', 'add_empty' => '所有'),array('style'=>'width:150px;'))   ,
      'keyword'=>  new sfWidgetFormInput(),
      'pic1'=>  new sfWidgetFormInput(array(),array('style'=>'width:50px;')),
      'pic2'=>  new sfWidgetFormInput(array(),array('style'=>'width:50px;'))
    ));
    
    $this->widgetSchema->setNameFormat('search[%s]');

    $this->setValidators(array(
      'address'             => new sfValidatorString(array('max_length' => 500)),      
      'city'          => new sfValidatorInteger(),))    ;
      
    //$this->widgetSchema['city']->addOption('dfj','dfkjd');
  }
}
