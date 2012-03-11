<?php

/**
 * signup actions.
 *
 * @package    apus
 * @subpackage signup
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class signupActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->form=new SignupForm();
    
    if ($request->isMethod('post'))
    {
      //echo 'abc';
      $this->form->bind($request->getParameter('signup'));
      if ($this->form->isValid())
      {
        $ip=$_SERVER['REMOTE_ADDR'];
        $ipaddr=Ip::getip($ip);
        $signup=$this->form->getValues();
        $newuser=new User();
        $newuser->setName($signup['name']);
        $newuser->setPassword(md5($signup['password']));
        //$newuser->setTempEmail($signup['email']);
        $newuser->setUuid(md5(uniqid(rand(), true)));
        //$newuser->setPubemail($signup['pubemail']);
        $time=date("Y-m-d H:i:s");
        $newuser->setLastLogin($time);
        $newuser->setRegip($ip);
        $newuser->setRegipaddr($ipaddr);        
        try{
          $newuser->save();
        }
        catch(Exception $e){
          $this->redirect('signup/error?msg='.'注册发生错误'.$e->getMessage());
        }
        $id=$newuser->getId();
        $this->getUser()->setAttribute('id',$id);
        $this->getUser()->setAttribute('name',$signup['name']);
        //$this->getUser()->setAttribute('pwd',$newuser->getPassword());
        $this->getUser()->setAuthenticated(true);
        
        
        $this->redirect('setting/address');//?'.http_build_query($this->form->getValues()));
      }
    }

    
  }
  
  public function executeDone(sfWebRequest $request)
  {
    $this->user=$this->getUser()->getAttribute('name');
  }
  
  public function executeError(sfWebRequest $request)
  {
    $this->message=$request->getParameter('msg');
  }
  
  public function executeUsers(sfWebRequest $request)
  {
    $this->setLayout('user');
    $name=$request->getParameter('signup[name]');
    $c=new Criteria();
    $c->add(UserPeer::NAME,$name);
    if(UserPeer::doCount($c))
      $this->valid='false';
    else
      $this->valid='true';
  }
  
  
  
  public function executeResetemail(sfWebRequest $request){
    $email=$request->getParameter('email');
    $userid=$this->getUser()->getAttribute('id');
    $this->forward404Unless($user=UserPeer::reteriveByPk($userid));
    $user->setEmail('');
    $user->setTempEmail($email);
    $user->setUuid(md5(uniqid(rand(), true)));
    $user->save();
    //以下发邮件给用户等待验证
    $this->redirect($request->getReferer());
  }
  
  
}
