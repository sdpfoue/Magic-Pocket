<?php
class Search3Form extends sfForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'city'  => new sfWidgetFormPropelChoice(array('model' => 'City', 'add_empty' => '所有地区')),
      'keyword'=>  new sfWidgetFormInput(),
    ));
    
    $this->widgetSchema->setNameFormat('search[%s]');
  }
}
