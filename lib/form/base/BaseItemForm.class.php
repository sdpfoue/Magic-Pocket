<?php

/**
 * Item form base class.
 *
 * @package    apus
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseItemForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'user_id'            => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => false)),
      'category_id'        => new sfWidgetFormPropelChoice(array('model' => 'Category', 'add_empty' => false)),
      'item_name'          => new sfWidgetFormInput(),
      'item_detail'        => new sfWidgetFormTextarea(),
      'item_price'         => new sfWidgetFormInput(),
      'pic1'               => new sfWidgetFormInput(),
      'pic2'               => new sfWidgetFormInput(),
      'pic3'               => new sfWidgetFormInput(),
      'pic4'               => new sfWidgetFormInput(),
      'link'               => new sfWidgetFormInput(),
      'created_at'         => new sfWidgetFormDateTime(),
      'updated_at'         => new sfWidgetFormDateTime(),
      'lastprompt'         => new sfWidgetFormDateTime(),
      'viewed'             => new sfWidgetFormInput(),
      'issold'             => new sfWidgetFormInput(),
      'city_id'            => new sfWidgetFormPropelChoice(array('model' => 'City', 'add_empty' => false)),
      'address'            => new sfWidgetFormInput(),
      'ip'                 => new sfWidgetFormInput(),
      'ip_address'         => new sfWidgetFormInput(),
      'comment_number'     => new sfWidgetFormInput(),
      'reply_number'       => new sfWidgetFormInput(),
      'new_comment_number' => new sfWidgetFormInput(),
      'item_report_list'   => new sfWidgetFormPropelChoiceMany(array('model' => 'User')),
      'recent_item_list'   => new sfWidgetFormPropelChoiceMany(array('model' => 'User')),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorPropelChoice(array('model' => 'Item', 'column' => 'id', 'required' => false)),
      'user_id'            => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id')),
      'category_id'        => new sfValidatorPropelChoice(array('model' => 'Category', 'column' => 'id')),
      'item_name'          => new sfValidatorString(array('max_length' => 100)),
      'item_detail'        => new sfValidatorString(),
      'item_price'         => new sfValidatorNumber(),
      'pic1'               => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'pic2'               => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'pic3'               => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'pic4'               => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'link'               => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'created_at'         => new sfValidatorDateTime(),
      'updated_at'         => new sfValidatorDateTime(),
      'lastprompt'         => new sfValidatorDateTime(),
      'viewed'             => new sfValidatorInteger(),
      'issold'             => new sfValidatorInteger(),
      'city_id'            => new sfValidatorPropelChoice(array('model' => 'City', 'column' => 'id')),
      'address'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'ip'                 => new sfValidatorString(array('max_length' => 15)),
      'ip_address'         => new sfValidatorString(array('max_length' => 255)),
      'comment_number'     => new sfValidatorInteger(),
      'reply_number'       => new sfValidatorInteger(),
      'new_comment_number' => new sfValidatorInteger(),
      'item_report_list'   => new sfValidatorPropelChoiceMany(array('model' => 'User', 'required' => false)),
      'recent_item_list'   => new sfValidatorPropelChoiceMany(array('model' => 'User', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('item[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Item';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['item_report_list']))
    {
      $values = array();
      foreach ($this->object->getItemReports() as $obj)
      {
        $values[] = $obj->getUserId();
      }

      $this->setDefault('item_report_list', $values);
    }

    if (isset($this->widgetSchema['recent_item_list']))
    {
      $values = array();
      foreach ($this->object->getRecentItems() as $obj)
      {
        $values[] = $obj->getUserId();
      }

      $this->setDefault('recent_item_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveItemReportList($con);
    $this->saveRecentItemList($con);
  }

  public function saveItemReportList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['item_report_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(ItemReportPeer::ITEM_ID, $this->object->getPrimaryKey());
    ItemReportPeer::doDelete($c, $con);

    $values = $this->getValue('item_report_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new ItemReport();
        $obj->setItemId($this->object->getPrimaryKey());
        $obj->setUserId($value);
        $obj->save();
      }
    }
  }

  public function saveRecentItemList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['recent_item_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(RecentItemPeer::ITEM_ID, $this->object->getPrimaryKey());
    RecentItemPeer::doDelete($c, $con);

    $values = $this->getValue('recent_item_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new RecentItem();
        $obj->setItemId($this->object->getPrimaryKey());
        $obj->setUserId($value);
        $obj->save();
      }
    }
  }

}
