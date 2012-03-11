<?php

class settingComponents extends sfComponents
{
  public function executeAddress(sfWebRequest $request)
  {
    $userid=$this->getUser()->getAttribute('id');
    $c=new Criteria();
    $c->add(UserPeer::ID,$userid);
    $user=UserPeer::doSelectOne($c);
    if ($request->isMethod('post'))
    {
      $user->setCityId($request->getParameter('address[city_id]'));
      $user->setAddress($request->getParameter('address[address]'));
      $user->save();
      $this->sfuser->setAttribute('cityid',$request->getParameter('address[city_id]'));
      //$action->redirec('setting/index');
    }
    $this->form=new DefaultAddressForm();
    $this->form->setDefault('city_id',$user->getCityId());
    $this->form->setDefault('address',$user->getAddress());
  }
  
  public function executeInfo(sfWebRequest $request)
  {    
    $userid=$this->getUser()->getAttribute('id');
    $c=new Criteria();
    $c->add(UserPeer::ID,$userid);
    $user=UserPeer::doSelectOne($c);
    
    $this->form=new UserForm($user);
    
    
    $form=new UserForm($user);
    
    $form->bind($request->getParameter($form->getName()));
    if($request->isMethod('post')){
      if($form->isValid())
      {
        $form->save();
        
        //$this->uid=$user->getId();
        $this->form=$form;
      }
      else
        $this->form=$form;
    }
    
    
  }
  
}


?>
