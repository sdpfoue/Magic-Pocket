<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * ItemReport filter form base class.
 *
 * @package    apus
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseItemReportFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'reason'     => new sfWidgetFormFilterInput(),
      'created_at' => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'ip'         => new sfWidgetFormFilterInput(),
      'ip_address' => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'reason'     => new sfValidatorPass(array('required' => false)),
      'created_at' => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'ip'         => new sfValidatorPass(array('required' => false)),
      'ip_address' => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('item_report_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'ItemReport';
  }

  public function getFields()
  {
    return array(
      'user_id'    => 'ForeignKey',
      'book_id'    => 'ForeignKey',
      'reason'     => 'Text',
      'created_at' => 'Date',
      'ip'         => 'Text',
      'ip_address' => 'Text',
    );
  }
}
