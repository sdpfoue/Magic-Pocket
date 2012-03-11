<?php

require_once(sfConfig::get('sf_lib_dir').'/filter/base/BaseFormFilterPropel.class.php');

/**
 * Website filter form base class.
 *
 * @package    apus
 * @subpackage filter
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormFilterGeneratedTemplate.php 15484 2009-02-13 13:13:51Z fabien $
 */
class BaseWebsiteFormFilter extends BaseFormFilterPropel
{
  public function setup()
  {
    $this->setWidgets(array(
      'title'       => new sfWidgetFormFilterInput(),
      'eng_title'   => new sfWidgetFormFilterInput(),
      'email'       => new sfWidgetFormFilterInput(),
      'descryption' => new sfWidgetFormFilterInput(),
      'agreement'   => new sfWidgetFormFilterInput(),
      'key_word'    => new sfWidgetFormFilterInput(),
      'footer'      => new sfWidgetFormFilterInput(),
    ));

    $this->setValidators(array(
      'title'       => new sfValidatorPass(array('required' => false)),
      'eng_title'   => new sfValidatorPass(array('required' => false)),
      'email'       => new sfValidatorPass(array('required' => false)),
      'descryption' => new sfValidatorPass(array('required' => false)),
      'agreement'   => new sfValidatorPass(array('required' => false)),
      'key_word'    => new sfValidatorPass(array('required' => false)),
      'footer'      => new sfValidatorPass(array('required' => false)),
    ));

    $this->widgetSchema->setNameFormat('website_filters[%s]');

    $this->errorSchema = new sfValidatorErrorSchema($this->validatorSchema);

    parent::setup();
  }

  public function getModelName()
  {
    return 'Website';
  }

  public function getFields()
  {
    return array(
      'id'          => 'Number',
      'title'       => 'Text',
      'eng_title'   => 'Text',
      'email'       => 'Text',
      'descryption' => 'Text',
      'agreement'   => 'Text',
      'key_word'    => 'Text',
      'footer'      => 'Text',
    );
  }
}
