<?php
//for job search

class Search4Form extends sfForm
{
  protected static $types = array('均可', '全职', '兼职');
  protected static $gender = array('男', '女');
  protected static $experience = array('均可','不需要');
  
  public function configure()
  {
    $this->setWidgets(array(
      'city'  => new sfWidgetFormPropelChoice(array('model' => 'City', 'add_empty' => '所有地区')),
      'gender'   => new sfWidgetFormSelect(array('choices' => self::$gender)),
      'experience' => new sfWidgetFormSelect(array('choices' => self::$experience)),
      'type'=> new sfWidgetFormSelect(array('choices' => self::$types)),
      'postcode'=>  new sfWidgetFormInput(),
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
