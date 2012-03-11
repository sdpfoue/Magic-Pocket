<?php

/**
 * setting actions.
 *
 * @package    apus
 * @subpackage setting
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class settingActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    
    
    
  }
  public function executeAddress(sfWebRequest $request)
  {    
    $this->setTemplate('index');    
    $userid=$this->getUser()->getAttribute('id');
    $c=new Criteria();
    $c->add(UserPeer::ID,$userid);
    if(!$user=UserPeer::doSelectOne($c)) return;
    if ($request->isMethod('post'))
    {
      $user->setCityId($request->getParameter('address[city_id]'));
      $user->setAddress($request->getParameter('address[address]'));
      $user->save();
      $this->getUser()->setAttribute('cityid',$request->getParameter('address[city_id]'));
      $this->redirect('index/index');
    }
    $this->form=new DefaultAddressForm();
    $this->form->setDefault('city_id',$user->getCityId());
    $this->form->setDefault('address',$user->getAddress());    
  }
  public function executeMail(sfWebRequest $request)
  {     
    $this->setTemplate('index');
    $userid=$this->userid=$this->getUser()->getAttribute('id');
    $mail=$request->getParameter('mail');
    if(!$this->user=$user=UserPeer::retrieveByPk($userid)) return;    
    $this->form=new MailForm();
    $this->form->setDefault('message',$user->getMailMessage());
    $this->form->setDefault('comment',$user->getMailComment());
    $this->form->setDefault('reply',$user->getMailReply());
    if($request->isMethod('post'))
    {
      $form=new MailForm();
      $form->bind($request->getParameter('mail'));
      if($form->isValid())
      {
        $user->setMailMessage($mail['message']);
        $user->setMailReply($mail['reply']);
        $user->setMailComment($mail['comment']);
        $user->save();
      }
     // else
        $this->form=$form;
    }
    
   
  }
  public function executeSetmail(sfWebRequest $request)
  {
    $email=$request->getParameter('email');
    if(!myUser::validateEmail($email))
    {
      $this->message='<span class="error">邮箱格式不正确，设置失败</span>';
      return;
    }
    $userid=$this->getUser()->getAttribute('id');
    $this->forward404Unless($user=UserPeer::retrieveByPk($userid));
    if(UserPeer::isMailExist($email)){
      $this->message='<span class="error">此邮件已被人占用，设置失败</span>';
      return;
    }
    $user->setTempEmail($email);
    $user->setEmail('');
    $user->setUuid(md5(uniqid(rand(), true)));
    $user->save();
    $this->message=$email.' 验证信已发，请去邮箱验证邮件地址';
    //以下发邮件给用户等待验证
  }
  public function executeResend(sfWebRequest $request)
  {
    $this->message='已经重新发送验证邮件';
    
    //重新发送邮件
    
  }
  public function executeAddadd(sfWebRequest $request)
  {
    $this->userid=$this->getUser()->getAttribute('id');
    $id=$this->getUser()->getAttribute('id');
    $this->form=new AddressForm();
    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter('address'));
      if ($this->form->isValid())
      {
        $address=$this->form->getValues();
        $add=new Address();
        $add->setUserId($id);
        $add->setCityId($address['city_id']);
        $add->setSuburb($address['suburb']);
        $add->setAddress($address['address']);
        $add->save();
        $this->redirect('setting/address');
      }
    }
  }
  public function executeDeladd(sfWebRequest $request)
  {
    $addid=$request->getParameter('id');
    $userid=$this->getUser()->getAttribute('id');
    $c=new Criteria();
    $c->add(AddressPeer::USER_ID,$userid);
    $c->add(AddressPeer::ID,$addid);
    $this->forward404Unless($address=AddressPeer::doSelectOne($c));
    $address->delete();
    $this->redirect('setting/address');
  }
  public function executeEditadd(sfWebRequest $request)
  {
    //$this->userid=$this->getUser()->getAttribute('id');
    $addid=$request->getParameter('add');
    $this->add=$addid;
    $userid=$this->getUser()->getAttribute('id');
    $c=new Criteria();
    $c->add(AddressPeer::USER_ID,$userid);
    $c->add(AddressPeer::ID,$addid);
    $this->forward404Unless($add=$address=AddressPeer::doSelectOne($c));
    $this->form=new AddressForm($address);
    if ($request->isMethod('post'))
    {
      $this->form->bind($request->getParameter('address'));
      if ($this->form->isValid())
      {
        $address=$this->form->getValues();
        $add->setUserId($userid);
        $add->setCityId($address['city_id']);
        $add->setSuburb($address['suburb']);
        $add->setAddress($address['address']);
        $add->save();
        $this->redirect('setting/address');
      }
    }
  }
  public function executePwd(sfWebRequest $request)
  {
    $this->errmsg='';
    $this->form=new PwdForm();
    $form=new PwdForm();
    $form->bind($request->getParameter('pwd'));
    if($request->isMethod('post'))
    {
      if($form->isValid())
      {
        $userid=$this->getUser()->getAttribute('id');
        $pwd=md5($form->getValue('oldp'));
        
        $c=new Criteria();
        $c->add(UserPeer::ID,$userid);
        $user=UserPeer::doSelectOne($c);
        if($pwd==$user->getPassword()){
          $pwd=md5($form->getValue('pwd'));
          $user->setPassword($pwd);
          $user->save();
          $this->redirect('setting/index');
        }
        else
          $this->errmsg='原密码错误';
      }
      else
        $this->form=$form;
    }
    //$this->form=$form;
  }
  
  public function executeValidateemail(sfWebRequest $request){
    $this->message='';
    $uuid=$request->getParameter('u');
    $c = new Criteria();
    $c->add(UserPeer::UUID, $uuid);
    $user= UserPeer::doSelectOne($c);
    if($user==null){
      $this->message='请提供正确的数据进行验证';
      //exit(0);
    } else if($user->getEmail()!=''){
      $this->message='邮箱已经成功验证';
    }
    else{
      $user->setEmail($user->getTempEmail());
      $user->setTempEmail('');
      $user->setUuid='';
      $user->save();
      $this->message='邮箱验证成功';
    }
  }
  
}
