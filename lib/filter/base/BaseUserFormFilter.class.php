<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * User filter form base class.
 *
 * @package    apus
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseUserFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'name'             => new sfWidgetFormFilterInput(),
      'password'         => new sfWidgetFormFilterInput(),
      'temp_email'       => new sfWidgetFormFilterInput(),
      'email'            => new sfWidgetFormFilterInput(),
      'address_id'       => new sfWidgetFormFilterInput(),
      'mobile'           => new sfWidgetFormFilterInput(),
      'qq'               => new sfWidgetFormFilterInput(),
      'msn'              => new sfWidgetFormFilterInput(),
      'uuid'             => new sfWidgetFormFilterInput(),
      'pubemail'         => new sfWidgetFormFilterInput(),
      'pubmobile'        => new sfWidgetFormFilterInput(),
      'item_number'      => new sfWidgetFormFilterInput(),
      'login_times'      => new sfWidgetFormFilterInput(),
      'last_login'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'regip'            => new sfWidgetFormFilterInput(),
      'lastip'           => new sfWidgetFormFilterInput(),
      'regipaddr'        => new sfWidgetFormFilterInput(),
      'lastipaddr'       => new sfWidgetFormFilterInput(),
      'created_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'approve'          => new sfWidgetFormFilterInput(),
      'item_report_list' => new sfWidgetFormPropelChoice(array('model' => 'Book', 'add_empty' => true)),
      'recent_book_list' => new sfWidgetFormPropelChoice(array('model' => 'Book', 'add_empty' => true)),
      'recent_item_list' => new sfWidgetFormPropelChoice(array('model' => 'Item', 'add_empty' => true)),
      'book_report_list' => new sfWidgetFormPropelChoice(array('model' => 'Book', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'name'             => new sfValidatorPass(array('required' => false)),
      'password'         => new sfValidatorPass(array('required' => false)),
      'temp_email'       => new sfValidatorPass(array('required' => false)),
      'email'            => new sfValidatorPass(array('required' => false)),
      'address_id'       => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'mobile'           => new sfValidatorPass(array('required' => false)),
      'qq'               => new sfValidatorPass(array('required' => false)),
      'msn'              => new sfValidatorPass(array('required' => false)),
      'uuid'             => new sfValidatorPass(array('required' => false)),
      'pubemail'         => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'pubmobile'        => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'item_number'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'login_times'      => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'last_login'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'regip'            => new sfValidatorPass(array('required' => false)),
      'lastip'           => new sfValidatorPass(array('required' => false)),
      'regipaddr'        => new sfValidatorPass(array('required' => false)),
      'lastipaddr'       => new sfValidatorPass(array('required' => false)),
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'approve'          => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'item_report_list' => new sfValidatorPropelChoice(array('model' => 'Book', 'required' => false)),
      'recent_book_list' => new sfValidatorPropelChoice(array('model' => 'Book', 'required' => false)),
      'recent_item_list' => new sfValidatorPropelChoice(array('model' => 'Item', 'required' => false)),
      'book_report_list' => new sfValidatorPropelChoice(array('model' => 'Book', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('user_filters[%s]');

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

    $criteria->addJoin(ItemReportPeer::USER_ID, UserPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(ItemReportPeer::BOOK_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(ItemReportPeer::BOOK_ID, $value));
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

    $criteria->addJoin(RecentBookPeer::USER_ID, UserPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(RecentBookPeer::BOOK_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(RecentBookPeer::BOOK_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function addRecentItemListColumnCriteria(Criteria $criteria, $field, $values)
  {
    if (!is_array($values))
    {
      $values = array($values);
    }

    if (!count($values))
    {
      return;
    }

    $criteria->addJoin(RecentItemPeer::USER_ID, UserPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(RecentItemPeer::ITEM_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(RecentItemPeer::ITEM_ID, $value));
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

    $criteria->addJoin(BookReportPeer::USER_ID, UserPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(BookReportPeer::BOOK_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(BookReportPeer::BOOK_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'User';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'name'             => 'Text',
      'password'         => 'Text',
      'temp_email'       => 'Text',
      'email'            => 'Text',
      'address_id'       => 'Number',
      'mobile'           => 'Text',
      'qq'               => 'Text',
      'msn'              => 'Text',
      'uuid'             => 'Text',
      'pubemail'         => 'Number',
      'pubmobile'        => 'Number',
      'item_number'      => 'Number',
      'login_times'      => 'Number',
      'last_login'       => 'Date',
      'regip'            => 'Text',
      'lastip'           => 'Text',
      'regipaddr'        => 'Text',
      'lastipaddr'       => 'Text',
      'created_at'       => 'Date',
      'updated_at'       => 'Date',
      'approve'          => 'Number',
      'item_report_list' => 'ManyKey',
      'recent_book_list' => 'ManyKey',
      'recent_item_list' => 'ManyKey',
      'book_report_list' => 'ManyKey',
    );
  }
}
