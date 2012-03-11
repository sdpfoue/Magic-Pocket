<?php

/**
 * Book form base class.
 *
 * @package    apus
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseBookForm extends BaseFormPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'id'                 => new sfWidgetFormInputHidden(),
      'user_id'            => new sfWidgetFormPropelChoice(array('model' => 'User', 'add_empty' => false)),
      'isbn'               => new sfWidgetFormInput(),
      'title'              => new sfWidgetFormInput(),
      'edition'            => new sfWidgetFormInput(),
      'author'             => new sfWidgetFormInput(),
      'price'              => new sfWidgetFormInput(),
      'publisher'          => new sfWidgetFormInput(),
      'publish_date'       => new sfWidgetFormInput(),
      'cover'              => new sfWidgetFormInput(),
      'university'         => new sfWidgetFormInput(),
      'description'        => new sfWidgetFormTextarea(),
      'viewed'             => new sfWidgetFormInput(),
      'issold'             => new sfWidgetFormInput(),
      'created_at'         => new sfWidgetFormDateTime(),
      'updated_at'         => new sfWidgetFormDateTime(),
      'city_id'            => new sfWidgetFormPropelChoice(array('model' => 'City', 'add_empty' => false)),
      'address'            => new sfWidgetFormInput(),
      'link'               => new sfWidgetFormInput(),
      'lastprompt'         => new sfWidgetFormDateTime(),
      'ip'                 => new sfWidgetFormInput(),
      'ip_address'         => new sfWidgetFormInput(),
      'comment_number'     => new sfWidgetFormInput(),
      'new_comment_number' => new sfWidgetFormInput(),
      'reply_number'       => new sfWidgetFormInput(),
      'recent_book_list'   => new sfWidgetFormPropelChoiceMany(array('model' => 'User')),
      'book_report_list'   => new sfWidgetFormPropelChoiceMany(array('model' => 'User')),
    ));

    $this->setValidators(array(
      'id'                 => new sfValidatorPropelChoice(array('model' => 'Book', 'column' => 'id', 'required' => false)),
      'user_id'            => new sfValidatorPropelChoice(array('model' => 'User', 'column' => 'id')),
      'isbn'               => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'title'              => new sfValidatorString(array('max_length' => 150)),
      'edition'            => new sfValidatorString(array('max_length' => 20, 'required' => false)),
      'author'             => new sfValidatorString(array('max_length' => 300, 'required' => false)),
      'price'              => new sfValidatorNumber(),
      'publisher'          => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'publish_date'       => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'cover'              => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'university'         => new sfValidatorString(array('max_length' => 50, 'required' => false)),
      'description'        => new sfValidatorString(array('required' => false)),
      'viewed'             => new sfValidatorInteger(),
      'issold'             => new sfValidatorInteger(),
      'created_at'         => new sfValidatorDateTime(),
      'updated_at'         => new sfValidatorDateTime(),
      'city_id'            => new sfValidatorPropelChoice(array('model' => 'City', 'column' => 'id')),
      'address'            => new sfValidatorString(array('max_length' => 255, 'required' => false)),
      'link'               => new sfValidatorString(array('max_length' => 500, 'required' => false)),
      'lastprompt'         => new sfValidatorDateTime(),
      'ip'                 => new sfValidatorString(array('max_length' => 15)),
      'ip_address'         => new sfValidatorString(array('max_length' => 255)),
      'comment_number'     => new sfValidatorInteger(),
      'new_comment_number' => new sfValidatorInteger(),
      'reply_number'       => new sfValidatorInteger(),
      'recent_book_list'   => new sfValidatorPropelChoiceMany(array('model' => 'User', 'required' => false)),
      'book_report_list'   => new sfValidatorPropelChoiceMany(array('model' => 'User', 'required' => false)),
    ));

    $this->widgetSchema->setNameFormat('book[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Book';
  }


  public function updateDefaultsFromObject()
  {
    parent::updateDefaultsFromObject();

    if (isset($this->widgetSchema['recent_book_list']))
    {
      $values = array();
      foreach ($this->object->getRecentBooks() as $obj)
      {
        $values[] = $obj->getUserId();
      }

      $this->setDefault('recent_book_list', $values);
    }

    if (isset($this->widgetSchema['book_report_list']))
    {
      $values = array();
      foreach ($this->object->getBookReports() as $obj)
      {
        $values[] = $obj->getUserId();
      }

      $this->setDefault('book_report_list', $values);
    }

  }

  protected function doSave($con = null)
  {
    parent::doSave($con);

    $this->saveRecentBookList($con);
    $this->saveBookReportList($con);
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
    $c->add(RecentBookPeer::BOOK_ID, $this->object->getPrimaryKey());
    RecentBookPeer::doDelete($c, $con);

    $values = $this->getValue('recent_book_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new RecentBook();
        $obj->setBookId($this->object->getPrimaryKey());
        $obj->setUserId($value);
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
    $c->add(BookReportPeer::BOOK_ID, $this->object->getPrimaryKey());
    BookReportPeer::doDelete($c, $con);

    $values = $this->getValue('book_report_list');
    if (is_array($values))
    {
      foreach ($values as $value)
      {
        $obj = new BookReport();
        $obj->setBookId($this->object->getPrimaryKey());
        $obj->setUserId($value);
        $obj->save();
      }
    }
  }

}
