<?php

/**
 * Job form base class.
 *
 * @package    apus
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseJobForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'user_id'            => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => false)),
      'title'              => new sfWidgetFormInput(),
      'city_id'            => new sfWidgetFormPropelChoice(array('model' => 'City', 'add_empty' => false)),
      'experience'         => new sfWidgetFormInput(),
      'type'               => new sfWidgetFormInput(),
      'wage'               => new sfWidgetFormInput(),
      'gender'             => new sfWidgetFormInput(),
      'leasttime'          => new sfWidgetFormInput(),
      'address'            => new sfWidgetFormInput(),
      'postcode'           => new sfWidgetFormInput(),
      'link'               => new sfWidgetFormInput(),
      'detail'             => new sfWidgetFormTextarea(),
      'isfind'             => new sfWidgetFormInput(),
      'ip'                 => new sfWidgetFormInput(),
      'ipaddr'             => new sfWidgetFormInput(),
      'created_at'         => new sfWidgetFormDateTime(),
      'updated_at'         => new sfWidgetFormDateTime(),
      'prompted_at'        => new sfWidgetFormDateTime(),
      'viewed'             => new sfWidgetFormInput(),
      'comment_number'     => new sfWidgetFormInput(),
      'new_comment_number' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorPropelChoice(array('model' => 'Job', 'column' => 'id', 'required' => false)),
      'user_id'            => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id')),
      'title'              => new sfValidatorString(array('max_length' => 100)),
      'city_id'            => new sfValidatorPropelChoice(array('model' => 'City', 'column' => 'id')),
      'experience'         => new sfValidatorInteger(),
      'type'               => new sfValidatorInteger(),
      'wage'               => new sfValidatorInteger(),
      'gender'             => new sfValidatorString(array('max_length' => 5)),
      'leasttime'          => new sfValidatorInteger(),
      'address'            => new sfValidatorString(array('max_length' => 200)),
      'postcode'           => new sfValidatorInteger(),
      'link'               => new sfValidatorString(array('max_length' => 500)),
      'detail'             => new sfValidatorString(),
      'isfind'             => new sfValidatorInteger(),
      'ip'                 => new sfValidatorString(array('max_length' => 15)),
      'ipaddr'             => new sfValidatorString(array('max_length' => 50)),
      'created_at'         => new sfValidatorDateTime(),
      'updated_at'         => new sfValidatorDateTime(),
      'prompted_at'        => new sfValidatorDateTime(),
      'viewed'             => new sfValidatorInteger(),
      'comment_number'     => new sfValidatorInteger(),
      'new_comment_number' => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('job[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Job';
  }


}
