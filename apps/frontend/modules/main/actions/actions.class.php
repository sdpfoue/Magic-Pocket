<?php

/**
 * main actions.
 *
 * @package    sf_sandbox
 * @subpackage main
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class mainActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
 public function executeIndex($request)
  {
    $this->form = new ContactForm();
 
    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter('contact'), $request->getFiles('contact'));
      if ($this->form->isValid())
      {
        $values = $this->form->getValues();
        // do something with the values
        $file = $this->form->getValue('file');
 
        $filename = 'uploaded_'.md5($file->getOriginalName());
        $extension = $file->getExtension($file->getOriginalExtension());
        $file->save(sfConfig::get('sf_upload_dir').'/'.$filename.$extension);

 
        // ...
      }
    }
  }
  
  public function executeTest($request)
  {
    //return "asdfaf";
    $this->a=date("H:i:s");
  }
}

class ContactForm extends sfForm
{
  protected static $subjects = array('Subject A', 'Subject B', 'Subject C');
 
  public function configure()
  {
    $this->setWidgets(array(
      'name'    => new sfWidgetFormInput(),
      'email'   => new sfWidgetFormInput(),
      'subject' => new sfWidgetFormSelect(array('choices' => self::$subjects)),
      'message' => new sfWidgetFormTextarea(),
      'file'    => new sfWidgetFormInputFile(),
    ));
    $this->widgetSchema->setNameFormat('contact[%s]');
 
    $this->setValidators(array(
      'name'    => new sfValidatorString(array('required' => false)),
      'email'   => new sfValidatorEmail(),
      'subject' => new sfValidatorChoice(array('choices' => array_keys(self::$subjects))),
      'message' => new sfValidatorString(array('min_length' => 4)),
      
    ));
    $this->validatorSchema['file'] = new sfValidatorFile(array(
      'required'   => false,
      'path'       => sfConfig::get('sf_upload_dir').'/item',
      'mime_types' => 'web_images',
    ));    
  }
}
