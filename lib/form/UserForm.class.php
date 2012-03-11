<?php

/**
 * User form.
 *
 * @package    apus
 * @subpackage form
 * @author     Your name here
 * @version    SVN: $Id: sfPropelFormTemplate.php 10377 2008-07-21 07:10:32Z dwhittle $
 */
class UserForm extends BaseUserForm
{
  public function configure()
  {
    unset($this['item_report_list'],$this['book_report_list'],$this['recent_item_list'],
      $this['recent_book_list'],$this['approve'],$this['updated_at'],
      $this['created_at'],$this['regipaddr'],$this['lastipaddr'],$this['regip'],
      $this['lastip'],$this['city_id'],$this['address'],$this['uuid'],
      $this['pubemail'],$this['pubmobile'],$this['last_login'],$this['item_number'],
      $this['login_times'],$this['name'],$this['temp_email'],$this['password']);
    $this->widgetSchema->setLabels(array('mobile'=>'手机','qq'=>'QQ','msn'=>'MSN'));
    
    $this->validatorSchema['email']=new sfValidatorEmail(array('required'=>false)); 
    $this->validatorSchema['msn']=new sfValidatorEmail(array('required'=>false)); 
    $this->validatorSchema['qq']=new sfValidatorNumber(array('required'=>false));
    $this->validatorSchema['mobile']=new sfValidatorNumber(array('required'=>false));
    
  }
}
