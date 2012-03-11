<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * ItemRank filter form base class.
 *
 * @package    apus
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseItemRankFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'keywords' => new sfWidgetFormFilterInput(),
      'times'    => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'keywords' => new sfValidatorPass(array('required' => false)),
      'times'    => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
    ));

    $this->widgetSchema->setNameFormat('item_rank_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ItemRank';
  }

  public function getFields()
  {
    return array(
      'id'       => 'Number',
      'keywords' => 'Text',
      'times'    => 'Number',
    );
  }
}
