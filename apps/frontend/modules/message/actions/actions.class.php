<?php

/**
 * message actions.
 *
 * @package    apus
 * @subpackage message
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class messageActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    $this->nav1='now';
    $this->nav2='';
  }
  
  public function executeSendbox(sfWebRequest $request)
  {
    $this->setTemplate('index');
    $this->nav1='';
    $this->nav2='now';
  }
  
  public function executeSend(sfWebRequest $request)
  {
    $senderid=$this->getUser()->getAttribute('id');
    $receiverid=$request->getParameter('id');
    $this->forward404Unless($senderid!=$receiverid);
    $c=new Criteria();
    $c->add(UserPeer::ID,$receiverid);
    $this->forward404Unless($rec=UserPeer::doSelectOne($c));//收信人不存在
    //$message=new Message();
    $this->form=new MessageForm();
    $this->rec=$rec->getName();
    $this->to=$receiverid;
    $form=new MessageForm();
    $form->bind($request->getParameter('message'));
    if($request->isMethod('post')){
      if($form->isValid())
      {        
        $form->getObject()->setFromId($senderid);
        $form->getObject()->setReceiveId($receiverid);
        $form->getObject()->setTime(date("Y-m-d H:i:s"));
        $form->getObject()->setIp($_SERVER['REMOTE_ADDR']);
        $form->getObject()->setIpaddr(Ip::getip($_SERVER['REMOTE_ADDR']));
        $form->save();
        $this->redirect('message/sendbox');
      }
      else
        $this->form=$form;
    }
  }
  public function executeShow(sfWebRequest $request)
  {
    $messageid=$request->getParameter('id');
    $userid=$this->getUser()->getAttribute('id');
    $c=new Criteria();
    $c->add(MessagePeer::RECEIVE_ID,$userid);
    $c->add(MessagePeer::ID,$messageid);
    $this->forward404Unless($this->message=MessagePeer::doSelectOne($c));
    $this->message->setIsread(1);
    $this->message->save();
  }
  public function executeShows(sfWebRequest $request)
  {
    $messageid=$request->getParameter('id');
    $userid=$this->getUser()->getAttribute('id');
    $c=new Criteria();
    $c->add(MessagePeer::FROM_ID,$userid);
    $c->add(MessagePeer::ID,$messageid);
    $this->forward404Unless($this->message=MessagePeer::doSelectOne($c));
  }
  
  public function executeDelrec(sfWebRequest $request)
  {
    $c=new Criteria();
    //$rc=array();
    $userid=$this->getUser()->getAttribute('id');
    $rc=$request->getParameter('mc');
    //$this->test=$rc;
    if(!$rc)
      $this->redirect('message/index');
    /*foreach($rc as $del)
    {
      $c->add(MessagePeer::ID,$del);
      $c->add(MessagePeer::RECEIVE_ID,$userid);
      $this->forward404Unless($message=MessagePeer::doSelectOne($c));
      $message->setDelbyreceiver(1);
      $message->save();
    }*/
    
    $c->add(MessagePeer::ID,$rc,Criteria::IN);
    $c->add(MessagePeer::RECEIVE_ID,$userid);
    $this->forward404Unless($messages=MessagePeer::doSelect($c));
    foreach($messages as $message){
      $message->setDelbyreceiver(1);
      $message->save();
    }
    
    $this->redirect('message/index');
  }
  public function executeDelsendbox(sfWebRequest $request)
  {
    $c=new Criteria();
    //$rc=array();
    $userid=$this->getUser()->getAttribute('id');
    $rc=$request->getParameter('mc');
    if(!$rc)
      $this->redirect('message/sendbox');
      
    /*
    foreach($rc as $del)
    {
      $c->add(MessagePeer::ID,$del);
      $c->add(MessagePeer::FROM_ID,$userid);
      $this->forward404Unless($message=MessagePeer::doSelectOne($c));
      $message->setDelbysender(1);
      $message->save();
    }*/
    $c->add(MessagePeer::ID,$rc,Criteria::IN);
    $c->add(MessagePeer::FROM_ID,$userid);
    $this->forward404Unless($messages=MessagePeer::doSelect($c));
    foreach($messages as $message){
      $message->setDelbysender(1);
      $message->save();
    }
    $this->redirect('message/sendbox');
  }
  
}
