<?php

/**
 * Website form base class.
 *
 * @package    apus
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseWebsiteForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'          => new sfWidgetFormInputHidden(),
      'title'       => new sfWidgetFormInput(),
      'eng_title'   => new sfWidgetFormInput(),
      'email'       => new sfWidgetFormInput(),
      'descryption' => new sfWidgetFormTextarea(),
      'agreement'   => new sfWidgetFormTextarea(),
      'key_word'    => new sfWidgetFormInput(),
      'footer'      => new sfWidgetFormTextarea(),
    ));

    $this->setValidators(array(
      'id'          => new sfValidatorPropelChoice(array('model' => 'Website', 'column' => 'id', 'required' => false)),
      'title'       => new sfValidatorString(array('max_length' => 255)),
      'eng_title'   => new sfValidatorString(array('max_length' => 255)),
      'email'       => new sfValidatorString(array('max_length' => 255)),
      'descryption' => new sfValidatorString(),
      'agreement'   => new sfValidatorString(),
      'key_word'    => new sfValidatorString(array('max_length' => 100)),
      'footer'      => new sfValidatorString(),
    ));

    $this->widgetSchema->setNameFormat('website[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Website';
  }


}
