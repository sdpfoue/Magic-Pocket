<?php

/**
 * ItemRank form base class.
 *
 * @package    apus
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseItemRankForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'       => new sfWidgetFormInputHidden(),
      'keywords' => new sfWidgetFormInput(),
      'times'    => new sfWidgetFormInput(),
    ));

    $this->setValidators(array(
      'id'       => new sfValidatorPropelChoice(array('model' => 'ItemRank', 'column' => 'id', 'required' => false)),
      'keywords' => new sfValidatorString(array('max_length' => 500)),
      'times'    => new sfValidatorInteger(),
    ));

    $this->widgetSchema->setNameFormat('item_rank[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ItemRank';
  }


}
