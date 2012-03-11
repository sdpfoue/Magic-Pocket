<?php
class SignupForm extends sfForm
{
  public function configure()
  {
    $this->setWidgets(array(
      'name'    => new sfWidgetFormInput(),
      'password'   => new sfWidgetFormInputPassword(),
      'conpwd'   => new sfWidgetFormInputPassword(),
      /*'email'   => new sfWidgetFormInput(),
      'pubemail' => new sfWidgetFormChoice(array(
        'expanded' => false,
        'choices'  => array('不公开', '公开'),
        //'label_separator'=>' ',
      )),
      'agreement'=>new sfWidgetFormInputCheckbox(),*/
    ));
    $this->widgetSchema->setNameFormat('signup[%s]');

    $this->widgetSchema->setLabels(array('name'=>'用户名 *',
        'password'=>'密码 *',
        'conpwd'=>'再次输入密码 *',
       /* 'email'=>'Email *',
        'pubemail'=>'是否公开Email',
        'agreement'=>'我已经认真阅读并同意《使用协议》'*/
        ));
    
    $this->setValidators(array(
      'name'    => new sfValidatorString(array('required' => true,'min_length' => 4,'trim'=>true),
                        array('required'=>'请输入用户名','min_length'=>'用户名至少要%min_length%个字符或汉字')),
      //'email'   => new sfValidatorEmail(array(),array('required'=>'请输入Email')),
      'password'    => new sfValidatorString(array('required' => true,'min_length' => 6,'trim'=>true),
                        array('required'=>'请输入密码','min_length'=>'密码至少要%min_length%位')),
      'conpwd'    => new sfValidatorString(array('required' => true),array('required'=>'请再次输入密码')),
      /*'pubemail'    => new sfValidatorChoice(array('choices' => array(1,0))),
      'agreement'    => new sfValidatorChoice(array('choices' => array('on')),array('required'=>'请认真阅读并同意《使用协议》后方可注册')),*/
      //'name' => new sfValidatorPropelUnique(array('model'=>'User','column'=>array('Name','Id'),'field'=>'name')),
    ));
    
    
   
      
    
    $this->validatorSchema->setPostValidator(new sfValidatorSchemaCompare('password', sfValidatorSchemaCompare::EQUAL, 'conpwd',
      array(),
      array('invalid' => '两次密码不一致，请检查')
    ));
    
    $this->validatorSchema->setPostValidator(new sfValidatorPropelUnique(array('model' => 'User', 'column' => array('name')),array('invalid'=>"用户名已存在.")));

    //$this->widgetSchema->setNameFormat('user[%s]');
    
  }
}
?>
