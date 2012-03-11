<?php

/**
 * User form base class.
 *
 * @package    apus
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseUserForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'               => new sfWidgetFormInputHidden(),
      'name'             => new sfWidgetFormInput(),
      'password'         => new sfWidgetFormInput(),
      'temp_email'       => new sfWidgetFormInput(),
      'email'            => new sfWidgetFormInput(),
      'city_id'          => new sfWidgetFormPropelChoice(array('model' => 'City', 'add_empty' => true)),
      'address'          => new sfWidgetFormInput(),
      'mobile'           => new sfWidgetFormInput(),
      'qq'               => new sfWidgetFormInput(),
      'msn'              => new sfWidgetFormInput(),
      'uuid'             => new sfWidgetFormInput(),
      'pubemail'         => new sfWidgetFormInput(),
      'pubmobile'        => new sfWidgetFormInput(),
      'item_number'      => new sfWidgetFormInput(),
      'login_times'      => new sfWidgetFormInput(),
      'last_login'       => new sfWidgetFormDateTime(),
      'regip'            => new sfWidgetFormInput(),
      'lastip'           => new sfWidgetFormInput(),
      'regipaddr'        => new sfWidgetFormInput(),
      'lastipaddr'       => new sfWidgetFormInput(),
      'created_at'       => new sfWidgetFormDateTime(),
      'updated_at'       => new sfWidgetFormDateTime(),
      'approve'          => new sfWidgetFormInput(),
      'mail_message'     => new sfWidgetFormInput(),
      'mail_comment'     => new sfWidgetFormInput(),
      'mail_reply'       => new sfWidgetFormInput(),
      'item_report_list' => new sfWidgetFormPropelChoiceMany(array('model' => 'Item')),
      'recent_book_list' => new sfWidgetFormPropelChoiceMany(array('model' => 'Book')),
      'recent_item_list' => new sfWidgetFormPropelChoiceMany(array('model' => 'Item')),
      'book_report_list' => new sfWidgetFormPropelChoiceMany(array('model' => 'Book')),
    ));

    $this->setValidators(array(
      'id'               => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id', 'required' => false)),
      'name'             => new sfValidatorString(array('max_length' => 8)),
      'password'         => new sfValidatorString(array('max_length' => 32)),
      'temp_email'       => new sfValidatorString(array('max_length' => 255)),
      'email'            => new sfValidatorString(array('max_length' => 30)),
      'city_id'          => new sfValidatorPropelChoice(array('model' => 'City', 'column' => 'id', 'required' => false)),
      'address'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'mobile'           => new sfValidatorString(array('max_length' => 10)),
      'qq'               => new sfValidatorString(array('max_length' => 20)),
      'msn'              => new sfValidatorString(array('max_length' => 50)),
      'uuid'             => new sfValidatorString(array('max_length' => 32)),
      'pubemail'         => new sfValidatorInteger(),
      'pubmobile'        => new sfValidatorInteger(),
      'item_number'      => new sfValidatorInteger(),
      'login_times'      => new sfValidatorInteger(),
      'last_login'       => new sfValidatorDateTime(),
      'regip'            => new sfValidatorString(array('max_length' => 15)),
      'lastip'           => new sfValidatorString(array('max_length' => 15)),
      'regipaddr'        => new sfValidatorString(array('max_length' => 255)),
      'lastipaddr'       => new sfValidatorString(array('max_length' => 255)),
      'created_at'       => new sfValidatorDateTime(),
      'updated_at'       => new sfValidatorDateTime(),
      'approve'          => new sfValidatorInteger(),
      'mail_message'     => new sfValidatorInteger(),
      'mail_comment'     => new sfValidatorInteger(),
      'mail_reply'       => new sfValidatorInteger(),
      'item_report_list' => new sfValidatorPropelChoiceMany(array('model' => 'Item', 'required' => false)),
      'recent_book_list' => new sfValidatorPropelChoiceMany(array('model' => 'Book', 'required' => false)),
      'recent_item_list' => new sfValidatorPropelChoiceMany(array('model' => 'Item', 'required' => false)),
      'book_report_list' => new sfValidatorPropelChoiceMany(array('model' => 'Book', 'required' => false)),
    ));

    $this->validatorSchema->setPostValidator(
      new sfValidatorPropelUnique(array('model' => 'User', 'column' => array('name')))
    );

    $this->widgetSchema->setNameFormat('user[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'User';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['item_report_list']))
    {
      $values = array();
      foreach ($this->object->getItemReports() as $obj)
      {
        $values[] = $obj->getItemId();
      }

      $this->setDefault('item_report_list', $values);
    }

    if (isset($this->widgetSchema['recent_book_list']))
    {
      $values = array();
      foreach ($this->object->getRecentBooks() as $obj)
      {
        $values[] = $obj->getBookId();
      }

      $this->setDefault('recent_book_list', $values);
    }

    if (isset($this->widgetSchema['recent_item_list']))
    {
      $values = array();
      foreach ($this->object->getRecentItems() as $obj)
      {
        $values[] = $obj->getItemId();
      }

      $this->setDefault('recent_item_list', $values);
    }

    if (isset($this->widgetSchema['book_report_list']))
    {
      $values = array();
      foreach ($this->object->getBookReports() as $obj)
      {
        $values[] = $obj->getBookId();
      }

      $this->setDefault('book_report_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveItemReportList($con);
    $this->saveRecentBookList($con);
    $this->saveRecentItemList($con);
    $this->saveBookReportList($con);
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
    $c->add(ItemReportPeer::USER_ID, $this->object->getPrimaryKey());
    ItemReportPeer::doDelete($c, $con);

    $values = $this->getValue('item_report_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new ItemReport();
        $obj->setUserId($this->object->getPrimaryKey());
        $obj->setItemId($value);
        $obj->save();
      }
    }
  }

  public function saveRecentBookList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['recent_book_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(RecentBookPeer::USER_ID, $this->object->getPrimaryKey());
    RecentBookPeer::doDelete($c, $con);

    $values = $this->getValue('recent_book_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new RecentBook();
        $obj->setUserId($this->object->getPrimaryKey());
        $obj->setBookId($value);
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
    $c->add(RecentItemPeer::USER_ID, $this->object->getPrimaryKey());
    RecentItemPeer::doDelete($c, $con);

    $values = $this->getValue('recent_item_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new RecentItem();
        $obj->setUserId($this->object->getPrimaryKey());
        $obj->setItemId($value);
        $obj->save();
      }
    }
  }

  public function saveBookReportList($con = null)
  {
    if (!$this->isValid())
    {
      throw $this->getErrorSchema();
    }

    if (!isset($this->widgetSchema['book_report_list']))
    {
      // somebody has unset this widget
      return;
    }

    if (is_null($con))
    {
      $con = $this->getConnection();
    }

    $c = new Criteria();
    $c->add(BookReportPeer::USER_ID, $this->object->getPrimaryKey());
    BookReportPeer::doDelete($c, $con);

    $values = $this->getValue('book_report_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new BookReport();
        $obj->setUserId($this->object->getPrimaryKey());
        $obj->setBookId($value);
        $obj->save();
      }
    }
  }

}
