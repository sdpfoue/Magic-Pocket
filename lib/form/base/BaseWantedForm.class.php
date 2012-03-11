<?php

/**
 * Wanted form base class.
 *
 * @package    apus
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseWantedForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'user_id'     => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => false)),
      'name'        => new sfWidgetFormInput(),
      'description' => new sfWidgetFormTextarea(),
      'viewed'      => new sfWidgetFormInput(),
      'issold'      => new sfWidgetFormInput(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
      'city_id'     => new sfWidgetFormPropelChoice(array('model' => 'City', 'add_empty' => false)),
      'address'     => new sfWidgetFormInput(),
      'link'        => new sfWidgetFormInput(),
      'ip'          => new sfWidgetFormInput(),
      'ip_address'  => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'Wanted', 'column' => 'id', 'required' => false)),
      'user_id'     => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id')),
      'name'        => new sfValidatorString(array('max_length' => 150)),
      'description' => new sfValidatorString(),
      'viewed'      => new sfValidatorInteger(),
      'issold'      => new sfValidatorInteger(),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
      'city_id'     => new sfValidatorPropelChoice(array('model' => 'City', 'column' => 'id')),
      'address'     => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'link'        => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'ip'          => new sfValidatorString(array('max_length' => 15)),
      'ip_address'  => new sfValidatorString(array('max_length' => 255)),
    ));

    $this->widgetSchema->setNameFormat('wanted[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Wanted';
  }


}
