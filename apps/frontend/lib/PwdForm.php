<?php
class PwdForm extends sfForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'oldp'   => new sfWidgetFormInputPassword(),      
      'pwd'   => new sfWidgetFormInputPassword(), 
      'conpwd'   => new sfWidgetFormInputPassword(), 
    ));
    $this->widgetSchema->setNameFormat('pwd[%s]');

    $this->widgetSchema->setLabels(array('name'=>'用户名 *',
        'oldp'=>'请输入当前密码 *',
        'pwd'=>'请输入新密码 *',
        'conpwd'=>'请再次输入新密码 *'
        ));
    
    $this->setValidators(array(
      'oldp'    => new sfValidatorString(array('required' => true,'min_length' => 6,'trim'=>true),
                        array('required'=>'请输入当前密码','min_length'=>'密码至少要%min_length%位')),
      'pwd'    => new sfValidatorString(array('required' => true,'min_length' => 6,'trim'=>true),
                          array('required'=>'请输入密码','min_length'=>'密码至少要%min_length%位')),
        'conpwd'    => new sfValidatorString(array('required' => true),array('required'=>'请再次输入密码')),
    ));
    
    $this->validatorSchema->setPostValidator(new sfValidatorSchemaCompare('pwd', sfValidatorSchemaCompare::EQUAL, 'conpwd',
      array(),
      array('invalid' => '两次密码不一致，请检查')
    ));
  }
}
?>
