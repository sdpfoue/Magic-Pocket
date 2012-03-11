<?php

/**
 * index actions.
 *
 * @package    apus
 * @subpackage index
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class userActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  private $max_per_page=6;
  private $tl=15;  //标题最大长度
  private $dl=500; //详细内容最大长度
  public function executeItem(sfWebRequest $request)
  {
    //$this->getUser()->setAttribute('url','index/index');
    
    $this->setTemplate('index');
    
    $id=$request->getParameter('id');
    $cityid=$this->getUser()->getAttribute('cityid');
    $this->form=new Search1Form();
    $this->form->setDefault('city',$cityid);
   
    $c=new Criteria();
    $c->addDescendingOrderByColumn(ItemPeer::LASTPROMPT);
    //$c->add(ItemPeer::ISSOLD,0); //只显示未出售的结果
    $c->add(ItemPeer::USER_ID,$id);
    
    
    
    $this->pager = new sfPropelPager(
      'Item',
      $this->max_per_page
    );
    $this->pager->setCriteria($c);
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->setPeerMethod('doSelectJoinAll');
    $this->pager->init();
    $this->iList=$this->pager->getResults();
    $this->titleLen=$this->tl;
    $this->desLen=$this->dl;
    
    $c=new Criteria();
    $c->add(UserPeer::ID,$id);
    $this->user=UserPeer::doSelectOne($c);
    $this->username=$this->user->getName();
     $this->id=$id;
  }
  public function executeBook(sfWebRequest $request)
  {
    $request->setParameter('url','index/book');
    $cityid=$this->getUser()->getAttribute('cityid');
    
    $this->setTemplate('index');
    $id=$request->getParameter('id');
    
    
    $c=new Criteria();
    $c->addDescendingOrderByColumn(BookPeer::LASTPROMPT);
    //$c->add(BookPeer::ISSOLD,0); //只显示未出售的结果
    $c->add(BookPeer::USER_ID,$id);
    
    $this->form=new Search2Form();
    $this->form->setDefault('city',$cityid);
    
    
        
    $this->pager = new sfPropelPager(
      'Book',
      $this->max_per_page
    );
    $this->pager->setPeerMethod('doSelectJoinAll');
    $this->pager->setCriteria($c);
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->init();
    $this->iList=$this->pager->getResults();
    $this->titleLen=$this->tl;
    $this->desLen=$this->dl;
    
    $c=new Criteria();
    $c->add(UserPeer::ID,$id);
    $this->user=UserPeer::doSelectOne($c);
    $this->username=$this->user->getName();
    $this->id=$id;
    
  }
  public function executeWanted(sfWebRequest $request)
  {
        
    $this->setTemplate('index');
    $id=$request->getParameter('id');
    
    $cityid=$this->getUser()->getAttribute('cityid');
    $this->form=new Search3Form();
    $this->form->setDefault('city',$cityid);
    $c=new Criteria();
    $c->addDescendingOrderByColumn(WantedPeer::CREATED_AT);
    $c->add(WantedPeer::USER_ID,$id);
        
    $this->pager = new sfPropelPager(
      'Wanted',
      $this->max_per_page
    );
    $this->pager->setPeerMethod('doSelectJoinAll');
    $this->pager->setCriteria($c);
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->init();
    $this->iList=$this->pager->getResults();
    $this->titleLen=$this->tl;
    $this->desLen=$this->dl;
    
    $c=new Criteria();
    $c->add(UserPeer::ID,$id);
    $this->user=UserPeer::doSelectOne($c);
    $this->username=$this->user->getName();
    $this->id=$id;
      
  }
  public function executeJob(sfWebRequest $request)
  {
    $this->setTemplate('index');
    $id=$request->getParameter('id');
    
    $cityid=$this->getUser()->getAttribute('cityid');
    $this->form=new Search3Form();
    $this->form->setDefault('city',$cityid);
    $c=new Criteria();
    $c->addDescendingOrderByColumn(JobPeer::CREATED_AT);
    $c->add(JobPeer::USER_ID,$id);
        
    $this->pager = new sfPropelPager(
      'Job',
      $this->max_per_page
    );
    $this->pager->setPeerMethod('doSelectJoinAll');
    $this->pager->setCriteria($c);
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->init();
    $this->iList=$this->pager->getResults();
    $this->titleLen=$this->tl;
    $this->desLen=$this->dl;
    
    $c=new Criteria();
    $c->add(UserPeer::ID,$id);
    $this->user=UserPeer::doSelectOne($c);
    $this->username=$this->user->getName();
    $this->id=$id;
      
  }

}
