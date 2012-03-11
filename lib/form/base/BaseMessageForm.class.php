<?php

/**
 * Message form base class.
 *
 * @package    apus
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseMessageForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'            => new sfWidgetFormInputHidden(),
      'from_id'       => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => false)),
      'receive_id'    => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => false)),
      'title'         => new sfWidgetFormInput(),
      'body'          => new sfWidgetFormTextarea(),
      'time'          => new sfWidgetFormDateTime(),
      'isread'        => new sfWidgetFormInput(),
      'ip'            => new sfWidgetFormInput(),
      'ipaddr'        => new sfWidgetFormInput(),
      'delbysender'   => new sfWidgetFormInput(),
      'delbyreceiver' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'            => new sfValidatorPropelChoice(array('model' => 'Message', 'column' => 'id', 'required' => false)),
      'from_id'       => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id')),
      'receive_id'    => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id')),
      'title'         => new sfValidatorString(array('max_length' => 50)),
      'body'          => new sfValidatorString(),
      'time'          => new sfValidatorDateTime(),
      'isread'        => new sfValidatorInteger(),
      'ip'            => new sfValidatorString(array('max_length' => 16)),
      'ipaddr'        => new sfValidatorString(array('max_length' => 50)),
      'delbysender'   => new sfValidatorInteger(),
      'delbyreceiver' => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('message[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Message';
  }


}
