<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Item filter form base class.
 *
 * @package    apus
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseItemFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'category_id'      => new sfWidgetFormPropelChoice(array('model' => 'Category', 'add_empty' => true)),
      'item_name'        => new sfWidgetFormFilterInput(),
      'item_detail'      => new sfWidgetFormFilterInput(),
      'item_price'       => new sfWidgetFormFilterInput(),
      'pic1'             => new sfWidgetFormFilterInput(),
      'pic2'             => new sfWidgetFormFilterInput(),
      'pic3'             => new sfWidgetFormFilterInput(),
      'pic4'             => new sfWidgetFormFilterInput(),
      'created_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'updated_at'       => new sfWidgetFormFilterDate(array('from_date' => new sfWidgetFormDate(), 'to_date' => new sfWidgetFormDate(), 'with_empty' => false)),
      'viewed'           => new sfWidgetFormFilterInput(),
      'issold'           => new sfWidgetFormFilterInput(),
      'address_id'       => new sfWidgetFormPropelChoice(array('model' => 'Address', 'add_empty' => true)),
      'ip'               => new sfWidgetFormFilterInput(),
      'ip_address'       => new sfWidgetFormFilterInput(),
      'recent_item_list' => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => true)),
    ));

    $this->setValidators(array(
      'category_id'      => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Category', 'column' => 'id')),
      'item_name'        => new sfValidatorPass(array('required' => false)),
      'item_detail'      => new sfValidatorPass(array('required' => false)),
      'item_price'       => new sfValidatorSchemaFilter('text', new sfValidatorNumber(array('required' => false))),
      'pic1'             => new sfValidatorPass(array('required' => false)),
      'pic2'             => new sfValidatorPass(array('required' => false)),
      'pic3'             => new sfValidatorPass(array('required' => false)),
      'pic4'             => new sfValidatorPass(array('required' => false)),
      'created_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'updated_at'       => new sfValidatorDateRange(array('required' => false, 'from_date' => new sfValidatorDate(array('required' => false)), 'to_date' => new sfValidatorDate(array('required' => false)))),
      'viewed'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'issold'           => new sfValidatorSchemaFilter('text', new sfValidatorInteger(array('required' => false))),
      'address_id'       => new sfValidatorPropelChoice(array('required' => false, 'model' => 'Address', 'column' => 'id')),
      'ip'               => new sfValidatorPass(array('required' => false)),
      'ip_address'       => new sfValidatorPass(array('required' => false)),
      'recent_item_list' => new sfValidatorPropelChoice(array('model' => 'User', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('item_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
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

    $criteria->addJoin(RecentItemPeer::ITEM_ID, ItemPeer::ID);

    $value = array_pop($values);
    $criterion = $criteria->getNewCriterion(RecentItemPeer::USER_ID, $value);

    foreach ($values as $value)
    {
      $criterion->addOr($criteria->getNewCriterion(RecentItemPeer::USER_ID, $value));
    }

    $criteria->add($criterion);
  }

  public function getModelName()
  {
    return 'Item';
  }

  public function getFields()
  {
    return array(
      'id'               => 'Number',
      'category_id'      => 'ForeignKey',
      'item_name'        => 'Text',
      'item_detail'      => 'Text',
      'item_price'       => 'Number',
      'pic1'             => 'Text',
      'pic2'             => 'Text',
      'pic3'             => 'Text',
      'pic4'             => 'Text',
      'created_at'       => 'Date',
      'updated_at'       => 'Date',
      'viewed'           => 'Number',
      'issold'           => 'Number',
      'address_id'       => 'ForeignKey',
      'ip'               => 'Text',
      'ip_address'       => 'Text',
      'recent_item_list' => 'ManyKey',
    );
  }
}
