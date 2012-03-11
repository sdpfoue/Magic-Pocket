<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * ItemComment filter form base class.
 *
 * @package    apus
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseItemCommentFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'book_id'    => new sfWidgetFormPropelChoice(array('model' => 'Book', 'add_empty' => true)),
      'user_id'    => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'body'       => new sfWidgetFormFilterInput(),
      'created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'ip'         => new sfWidgetFormFilterInput(),
      'ip_address' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'book_id'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Book', 'column' => 'id')),
      'user_id'    => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
      'body'       => new sfValidatorPass(array('required' => false)),
      'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'ip'         => new sfValidatorPass(array('required' => false)),
      'ip_address' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('item_comment_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ItemComment';
  }

  public function getFields()
  {
    return array(
      'id'         => 'Number',
      'book_id'    => 'ForeignKey',
      'user_id'    => 'ForeignKey',
      'body'       => 'Text',
      'created_at' => 'Date',
      'updated_at' => 'Date',
      'ip'         => 'Text',
      'ip_address' => 'Text',
    );
  }
}
