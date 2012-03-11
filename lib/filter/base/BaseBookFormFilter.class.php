<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Book filter form base class.
 *
 * @package    apus
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseBookFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'user_id'          => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'isbn'             => new sfWidgetFormFilterInput(),
      'title'            => new sfWidgetFormFilterInput(),
      'edition'          => new sfWidgetFormFilterInput(),
      'author'           => new sfWidgetFormFilterInput(),
      'price'            => new sfWidgetFormFilterInput(),
      'university'       => new sfWidgetFormFilterInput(),
      'description'      => new sfWidgetFormFilterInput(),
      'viewed'           => new sfWidgetFormFilterInput(),
      'issold'           => new sfWidgetFormFilterInput(),
      'created_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'address_id'       => new sfWidgetFormPropelChoice(array('model' => 'Address', 'add_empty' => true)),
      'ip'               => new sfWidgetFormFilterInput(),
      'ip_address'       => new sfWidgetFormFilterInput(),
      'item_report_list' => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'recent_book_list' => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
      'book_report_list' => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'user_id'          => new sfValidatorPropelChoice(array('required' => false, 'model' => 'User', 'column' => 'id')),
      'isbn'             => new sfValidatorPass(array('required' => false)),
      'title'            => new sfValidatorPass(array('required' => false)),
      'edition'          => new sfValidatorPass(array('required' => false)),
      'author'           => new sfValidatorPass(array('required' => false)),
      'price'            => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'university'       => new sfValidatorPass(array('required' => false)),
      'description'      => new sfValidatorPass(array('required' => false)),
      'viewed'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'issold'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'address_id'       => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Address', 'column' => 'id')),
      'ip'               => new sfValidatorPass(array('required' => false)),
      'ip_address'       => new sfValidatorPass(array('required' => false)),
      'item_report_list' => new sfValidatorPropelChoice(array('model' => 'User', 'required' => false)),
      'recent_book_list' => new sfValidatorPropelChoice(array('model' => 'User', 'required' => false)),
      'book_report_list' => new sfValidatorPropelChoice(array('model' => 'User', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('book_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function addItemReportListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(ItemReportPeer::BOOK_ID, BookPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(ItemReportPeer::USER_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(ItemReportPeer::USER_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function addRecentBookListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(RecentBookPeer::BOOK_ID, BookPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(RecentBookPeer::USER_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(RecentBookPeer::USER_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function addBookReportListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(BookReportPeer::BOOK_ID, BookPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(BookReportPeer::USER_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(BookReportPeer::USER_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'Book';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'user_id'          => 'ForeignKey',
      'isbn'             => 'Text',
      'title'            => 'Text',
      'edition'          => 'Text',
      'author'           => 'Text',
      'price'            => 'Number',
      'university'       => 'Text',
      'description'      => 'Text',
      'viewed'           => 'Number',
      'issold'           => 'Number',
      'created_at'       => 'Date',
      'updated_at'       => 'Date',
      'address_id'       => 'ForeignKey',
      'ip'               => 'Text',
      'ip_address'       => 'Text',
      'item_report_list' => 'ManyKey',
      'recent_book_list' => 'ManyKey',
      'book_report_list' => 'ManyKey',
    );
  }
}
