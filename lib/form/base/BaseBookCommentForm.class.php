<?php

/**
 * BookComment form base class.
 *
 * @package    apus
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseBookCommentForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'book_id'     => new sfWidgetFormPropelChoice(array('model' => 'Book', 'add_empty' => false)),
      'user_id'     => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => false)),
      'body'        => new sfWidgetFormTextarea(),
      'created_at'  => new sfWidgetFormDateTime(),
      'updated_at'  => new sfWidgetFormDateTime(),
      'ip'          => new sfWidgetFormInput(),
      'ip_address'  => new sfWidgetFormInput(),
      'owner_reply' => new sfWidgetFormTextarea(),
      'reply_time'  => new sfWidgetFormDateTime(),
      'new_reply'   => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'BookComment', 'column' => 'id', 'required' => false)),
      'book_id'     => new sfValidatorPropelChoice(array('model' => 'Book', 'column' => 'id')),
      'user_id'     => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id')),
      'body'        => new sfValidatorString(),
      'created_at'  => new sfValidatorDateTime(),
      'updated_at'  => new sfValidatorDateTime(),
      'ip'          => new sfValidatorString(array('max_length' => 15)),
      'ip_address'  => new sfValidatorString(array('max_length' => 255)),
      'owner_reply' => new sfValidatorString(),
      'reply_time'  => new sfValidatorDateTime(),
      'new_reply'   => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('book_comment[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'BookComment';
  }


}
