<?php

class messageComponents extends sfComponents
{
  private $max_per_page=15;
  public function executeReceive(sfWebRequest $request)
  {
    $userid=$this->getUser()->getAttribute('id');
    $c=new Criteria();
    $c->add(MessagePeer::RECEIVE_ID,$userid);
    $c->add(MessagePeer::DELBYRECEIVER,0);
    $c->addDescendingOrderByColumn(MessagePeer::TIME);
     $this->pager = new sfPropelPager(
      'Message',
      $this->max_per_page
    );
    $this->pager->setCriteria($c);
    $this->pager->setPeerMethod('doSelectJoinUserRelatedByFromId');
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->init();
    $this->messages=$this->pager->getResults();
    $this->i=0;
  }
  
  public function executeSend(sfWebRequest $request)
  {    
    $userid=$this->getUser()->getAttribute('id');
    $c=new Criteria();
    $c->add(MessagePeer::FROM_ID,$userid);
    $c->addDescendingOrderByColumn(MessagePeer::TIME);
    $c->add(MessagePeer::DELBYSENDER,0);
    $this->pager = new sfPropelPager(
      'Message',
      $this->max_per_page
    );
    $this->pager->setCriteria($c);
    $this->pager->setPeerMethod('doSelectJoinUserRelatedByReceiveId');
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->init();
    $this->messages=$this->pager->getResults();
    $this->i=0;
  }
  public function executeNewmessage()
  {
    if($userid=$this->user->getAttribute('id')){
      $c=new Criteria(); 
      $c->add(MessagePeer::ISREAD,0);
      $c->add(MessagePeer::DELBYRECEIVER,0);
      $c->add(MessagePeer::RECEIVE_ID,$userid);
      $this->number=MessagePeer::doCount($c);
    }
  }
    
    
  
  
}


?>
