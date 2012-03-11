<?php

/**
 * BookReport form base class.
 *
 * @package    apus
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseBookReportForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'    => new sfWidgetFormInputHidden(),
      'book_id'    => new sfWidgetFormInputHidden(),
      'reason'     => new sfWidgetFormTextarea(),
      'created_at' => new sfWidgetFormDateTime(),
      'ip'         => new sfWidgetFormInput(),
      'ip_address' => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'user_id'    => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
      'book_id'    => new sfValidatorPropelChoice(array('model' => 'Book', 'column' => 'id', 'required' => false)),
      'reason'     => new sfValidatorString(),
      'created_at' => new sfValidatorDateTime(),
      'ip'         => new sfValidatorString(array('max_length' => 15)),
      'ip_address' => new sfValidatorString(array('max_length' => 255)),
    ));

    $this->widgetSchema->setNameFormat('book_report[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'BookReport';
  }


}
