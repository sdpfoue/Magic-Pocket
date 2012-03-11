<?php

/**
 * Comments form base class.
 *
 * @package    apus
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseCommentsForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'category'    => new sfWidgetFormInputHidden(),
      'item_id'     => new sfWidgetFormInput(),
      'user_id'     => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => false)),
      'body'        => new sfWidgetFormTextarea(),
      'owner_reply' => new sfWidgetFormTextarea(),
      'reply_time'  => new sfWidgetFormDateTime(),
      'new_reply'   => new sfWidgetFormInput(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
      'ip'          => new sfWidgetFormInput(),
      'ip_address'  => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'Comments', 'column' => 'id', 'required' => false)),
      'category'    => new sfValidatorPropelChoice(array('model' => 'Comments', 'column' => 'category', 'required' => false)),
      'item_id'     => new sfValidatorInteger(),
      'user_id'     => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id')),
      'body'        => new sfValidatorString(),
      'owner_reply' => new sfValidatorString(array('required' => false)),
      'reply_time'  => new sfValidatorDateTime(array('required' => false)),
      'new_reply'   => new sfValidatorInteger(array('required' => false)),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
      'ip'          => new sfValidatorString(array('max_length' => 15)),
      'ip_address'  => new sfValidatorString(array('max_length' => 255)),
    ));

    $this->widgetSchema->setNameFormat('comments[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Comments';
  }


}
