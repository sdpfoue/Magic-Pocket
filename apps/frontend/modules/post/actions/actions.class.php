<?php

/**
 * post actions.
 *
 * @package    apus
 * @subpackage post
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class postActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  private $max_per_page=8;
  public function executeIndex(sfWebRequest $request)
  {
    $this->redirect('post/posteditem');
  }
  public function executePosteditem(sfWebRequest $request)
  {    
    $this->setTemplate('index');
    $userid=$this->getUser()->getAttribute('id');
    $c=new Criteria();
    $c->add(ItemPeer::USER_ID,$userid);
    $c->addDescendingOrderByColumn(ItemPeer::LASTPROMPT);
    //$this->iList = ItemPeer::doSelect($c);
    $this->pager = new sfPropelPager(
      'Item',
      $this->max_per_page
    );
    $this->pager->setCriteria($c);
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->init();
    $this->iList=$this->pager->getResults();

  }
  public function executePostedbook(sfWebRequest $request)
  {
    $this->setTemplate('index');
    $userid=$this->getUser()->getAttribute('id');
    $c=new Criteria();
    $c->add(BookPeer::USER_ID,$userid);
    $c->addDescendingOrderByColumn(BookPeer::LASTPROMPT);
    $this->pager = new sfPropelPager(
      'Book',
      $this->max_per_page
    );
    $this->pager->setCriteria($c);
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->init();
    $this->iList=$this->pager->getResults();
  }
  
  //显示用户已经发布过的物品消息
  public function executePostedwanted(sfWebRequest $request)
  {
    $this->setTemplate('index');
    
    
    
    
    $userid=$this->getUser()->getAttribute('id');
    $c=new Criteria();
    $c->add(WantedPeer::USER_ID,$userid);
    $c->addDescendingOrderByColumn(WantedPeer::ID);
    $this->pager = new sfPropelPager(
      'Wanted',
      $this->max_per_page
    );
    $this->pager->setCriteria($c);
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->init();
    $this->iList=$this->pager->getResults();
  }
  
  public function executePostedjob(sfWebRequest $request)
  {
    $this->setTemplate('index');
    $userid=$this->getUser()->getAttribute('id');
    $c=new Criteria();
    $c->add(JobPeer::USER_ID,$userid);
    $c->addDescendingOrderByColumn(JobPeer::PROMPTED_AT);
    $this->pager = new sfPropelPager(
      'Job',
      $this->max_per_page
    );
    $this->pager->setCriteria($c);
    $this->pager->setPage($request->getParameter('page', 1));
    $this->pager->init();
    $this->iList=$this->pager->getResults();
  }
  
  public function executeEditjob(sfWebRequest $request)
  {
    $this->setTemplate('item');
    $userid=$this->getUser()->getAttribute('id');
    $this->navname='编辑招聘信息';
    $c=new Criteria();
    $c->add(JobPeer::USER_ID,$userid);
    $c->add(JobPeer::ID,$request->getParameter('job[id]'));
    $ip=$_SERVER['REMOTE_ADDR'];
    $ipaddr=Ip::getip($ip);
    $this->forward404Unless($item=JobPeer::doSelectOne($c));
    //$item->setUserId($userid);
    $item->setIp($ip);
    $item->setIpaddr($ipaddr);
    $this->form = new JobForm($item);
    $this->action='editjob';
    $this->cancel='postedjob';
    if($request->isMethod('post')){
      $form=new JobForm($item);
      $form->bind($request->getParameter('job'));
      if($form->isValid())
      {
        $form->save();
        $this->redirect($request->getReferer());
      }
      else
        $this->form=$form();
    }
    
  }
  
  public function executeItem(sfWebRequest $request)
  {
    $item=new Item();
    
    $this->navname='物品信息发布';
    $this->action='additem';
    $this->cancel='posteditem';
    $this->userid=$this->getUser()->getAttribute('id');
    $c=new Criteria();
    $c->add(UserPeer::ID,$this->userid);
    $this->forward404Unless($user=UserPeer::doSelectOne($c)); //应该先登陆
    
    $item->setUserId($this->userid);
    $item->setAddress($user->getAddress());
    $item->setCityId($user->getCityId());
    $this->userid=$this->getUser()->getAttribute('id');
    $this->form=new ItemForm($item);
    
  }
  public function executeAdditem(sfWebRequest $request)
  {
    $this->navname='编辑物品信息';
    $this->forward404Unless($this->getUser()->isAuthenticated());
    $this->userid=$this->getUser()->getAttribute('id');
    $this->action='additem';
    $this->cancel='posteditem';
    $ip=$_SERVER['REMOTE_ADDR'];
    $ipaddr=Ip::getip($ip);
    $now=date("Y-m-d H:i:s");
    $c=new Criteria();
    $c->add(ItemPeer::USER_ID,$this->userid);
    $c->add(ItemPeer::ID,$request->getParameter('item[id]'));
    if(!$item=ItemPeer::doSelectone($c))
    {
      $item=new Item();
      $item->setIssold(0);
      $item->setLastprompt($now);
      $this->navname='物品信息发布';
    }
    $item->setUserId($this->userid);
    $item->setIp($ip);
    $item->setIpaddress($ipaddr);
    $this->form = new ItemForm($item);
    $this->processForm($request, $this->form,$this->cancel);
    $this->setTemplate('item');
    
  }
  public function executeEdititem(sfWebRequest $request)
  {
    $userid=$this->getUser()->getAttribute('id');
    $this->navname='编辑物品信息';
    $c=new Criteria();
    $c->add(ItemPeer::USER_ID,$userid);
    $c->add(ItemPeer::ID,$request->getParameter('id'));
    $ip=$_SERVER['REMOTE_ADDR'];
    $ipaddr=Ip::getip($ip);
    $this->forward404Unless($item=ItemPeer::doSelectOne($c));
    //$item->setUserId($userid);
    $item->setIp($ip);
    $item->setIpaddress($ipaddr);
    $this->form = new ItemForm($item);
    $this->action='additem';
    $this->cancel='posteditem';
    
    $this->setTemplate('item');
  }
  public function executeEditbook(sfWebRequest $request)
  {
    $userid=$this->getUser()->getAttribute('id');
    $this->navname='编辑书籍信息';
    $c=new Criteria();
    $c->add(BookPeer::USER_ID,$userid);
    $c->add(BookPeer::ID,$request->getParameter('id'));
    $ip=$_SERVER['REMOTE_ADDR'];
    $ipaddr=Ip::getip($ip);
    $this->forward404Unless($item=BookPeer::doSelectOne($c));
    $item->setUserId($userid);
    $item->setIp($ip);
    $item->setIpaddress($ipaddr);
    $this->form = new BookForm($item);
    $this->cancel='postedbook';
    $this->action='addbook';
    $this->setTemplate('item');
  }
  public function executeEditwanted(sfWebRequest $request)
  {
    $userid=$this->getUser()->getAttribute('id');
    $this->navname='编辑求购信息';
    $c=new Criteria();
    $c->add(WantedPeer::USER_ID,$userid);
    $c->add(WantedPeer::ID,$request->getParameter('id'));
    $ip=$_SERVER['REMOTE_ADDR'];
    $ipaddr=Ip::getip($ip);
    $this->forward404Unless($item=WantedPeer::doSelectOne($c));
    $item->setUserId($userid);
    $item->setIp($ip);
    $item->setIpaddress($ipaddr);
    $this->form = new WantedForm($item);
    $this->cancel='postedwanted';
    $this->action='addwanted';
    $this->setTemplate('item');
  }
  public function executeDelitem(sfWebRequest $request)
  {
    $userid=$this->getUser()->getAttribute('id');
    $id=$request->getParameter('id');
    $c=new Criteria();
    $c->add(ItemPeer::USER_ID,$userid);
    $c->add(ItemPeer::ID,$id);
    $this->forward404Unless($item=ItemPeer::doSelectOne($c));
    $item->delete();
    $this->redirect($request->getReferer());
  }
  public function executeDelbook(sfWebRequest $request)
  {
    $userid=$this->getUser()->getAttribute('id');
    $id=$request->getParameter('id');
    $c=new Criteria();
    $c->add(BookPeer::USER_ID,$userid);
    $c->add(BookPeer::ID,$id);
    $this->forward404Unless($item=BookPeer::doSelectOne($c));
    $item->delete();
    $this->redirect($request->getReferer());
  }
  
  public function executeDeljob(sfWebRequest $request)
  {
    $userid=$this->getUser()->getAttribute('id');
    $id=$request->getParameter('id');
    $c=new Criteria();
    $c->add(JobPeer::USER_ID,$userid);
    $c->add(JobPeer::ID,$id);
    $this->forward404Unless($item=JobPeer::doSelectOne($c));
    $item->delete();
    $this->redirect($request->getReferer());
  }
  
  public function executeDelwanted(sfWebRequest $request)
  {
    $userid=$this->getUser()->getAttribute('id');
    $id=$request->getParameter('id');
    $c=new Criteria();
    $c->add(WantedPeer::USER_ID,$userid);
    $c->add(WantedPeer::ID,$id);
    $this->forward404Unless($item=WantedPeer::doSelectOne($c));
    $item->delete();
    $this->redirect($request->getReferer());
  }
  //change the status of item:sold or not
  public function executeChangest(sfWebRequest $request)
  {
    $userid=$this->getUser()->getAttribute('id');
    $id=$request->getParameter('id');
    $c=new Criteria();
    $c->add(ItemPeer::USER_ID,$userid);
    $c->add(ItemPeer::ID,$id);
    $this->forward404Unless($item=ItemPeer::doSelectOne($c));
    if($item->getIssold()==1) $item->setIssold(0);
    else $item->setIssold(1);
    $item->save();
    $this->redirect($request->getReferer());
  }
  public function executePrompt(sfWebRequest $request)
  {
    $now=date("Y-m-d H:i:s");
    $userid=$this->getUser()->getAttribute('id');
    $id=$request->getParameter('id');
    $c=new Criteria();
    $c->add(ItemPeer::USER_ID,$userid);
    $c->add(ItemPeer::ID,$id);
    $c->add(ItemPeer::LASTPROMPT,time()-72000,Criteria::LESS_THAN);
    $this->forward404Unless($item=ItemPeer::doSelectOne($c));
    $item->setLastprompt($now);
    $item->save();
    $this->redirect($request->getReferer());    
  }
  
  public function executePromptbook(sfWebRequest $request)
  {
    $now=date("Y-m-d H:i:s");
    $userid=$this->getUser()->getAttribute('id');
    $id=$request->getParameter('id');
    $c=new Criteria();
    $c->add(BookPeer::USER_ID,$userid);
    $c->add(BookPeer::ID,$id);
    $c->add(BookPeer::LASTPROMPT,time()-72000,Criteria::LESS_THAN);
    $this->forward404Unless($item=BookPeer::doSelectOne($c));
    $item->setLastprompt($now);
    $item->save();
    $this->redirect($request->getReferer());    
  }
  public function executePromptjob(sfWebRequest $request)
  {
    $now=date("Y-m-d H:i:s");
    $userid=$this->getUser()->getAttribute('id');
    $id=$request->getParameter('id');
    $c=new Criteria();
    $c->add(JobPeer::USER_ID,$userid);
    $c->add(JobPeer::ID,$id);
    $c->add(JobPeer::PROMPTED_AT,time()-72000,Criteria::LESS_THAN);
    $this->forward404Unless($item=JobPeer::doSelectOne($c));
    $item->setPromptedAt($now);
    $item->save();
    $this->redirect($request->getReferer());    
  }
  
  public function executeBook(sfWebRequest $request)
  {
    $this->cancel='postedbook';
    $this->navname='书籍信息发布';
    $this->action='addbook';
    $item=new Book();
    $this->userid=$this->getUser()->getAttribute('id');
    $c=new Criteria();
    $c->add(UserPeer::ID,$this->userid);
    $user=UserPeer::doSelectOne($c);
    $item->setUserId($this->userid);
    $item->setAddress($user->getAddress());
    $item->setCityId($user->getCityId());
    $item->setUserId($this->getUser()->getAttribute('id'));
    $this->userid=$this->getUser()->getAttribute('id');
    $this->form=new BookForm($item);
    $this->setTemplate('item');
  }
  public function executeWanted(sfWebRequest $request)
  {
    
    $this->cancel='postedwanted';
    $this->navname='求购信息发布';
    $this->action='addwanted';
    $item=new Wanted();
    $this->userid=$this->getUser()->getAttribute('id');
    $c=new Criteria();
    $c->add(UserPeer::ID,$this->userid);
    $user=UserPeer::doSelectOne($c);
    $item->setUserId($this->userid);
    $item->setAddress($user->getAddress());
    $item->setCityId($user->getCityId());
    $item->setUserId($this->getUser()->getAttribute('id'));
    $this->userid=$this->getUser()->getAttribute('id');
    $this->form=new WantedForm($item);
    $this->setTemplate('item');
  }
  
  public function executeJob(sfWebRequest $request)
  {
    $this->setTemplate('item');
    $this->cancel='postedjob';
    $this->navname='招聘信息发布';
    $this->action='job';
    $item=new Job();
    $this->form=new JobForm($item);
    $this->userid=$this->getUser()->getAttribute('id');
    $c=new Criteria();
    $c->add(UserPeer::ID,$this->userid);
    $user=UserPeer::doSelectOne($c);
    if(!$user) return;
    $item->setUserId($this->userid);
    $item->setAddress($user->getAddress());
    $item->setCityId($user->getCityId());
    $item->setUserId($this->getUser()->getAttribute('id'));
    $this->userid=$this->getUser()->getAttribute('id');
    if($request->isMethod('post')){
      $form=new JobForm();
      $form->bind($request->getParameter('job'));
      if($form->isValid())
      {
        $now=date("Y-m-d H:i:s");
        $ip=$request->getRemoteAddress();
        $ipaddr=Ip::getip($ip);
        $form->getObject()->setUserId($this->userid);
        $form->getObject()->setIp($ip);
        $form->getObject()->setIpaddr($ipaddr);
        $form->getObject()->setPromptedAt($now);
        $form->save();
        $this->redirect('post/postedjob');
      }
      else
        $this->form=$form;
    }
    else{
      $this->form=new JobForm($item);      
    }
  }
  
  
  public function executeAddbook(sfWebRequest $request)
  {
    $this->action='addbook';
    $this->cancel='postedbook';
    $this->navname='编辑书籍信息';
    $this->forward404Unless($this->getUser()->isAuthenticated());
    $this->userid=$this->getUser()->getAttribute('id');   
    $ip=$_SERVER['REMOTE_ADDR'];
    $ipaddr=Ip::getip($ip);
    $now=date("Y-m-d H:i:s");
    $c=new Criteria();
    $c->add(BookPeer::USER_ID,$this->userid);
    $c->add(BookPeer::ID,$request->getParameter('book[id]'));
    if(!$item=BookPeer::doSelectone($c))
    {
      $item=new Book();
      $item->setIssold(0);
      $item->setLastprompt($now);
      $this->navname='书籍信息发布';
    }
    $item->setUserId($this->userid);
    $item->setIp($ip);
    $item->setIpaddress($ipaddr);
    $this->form = new BookForm($item);
    $this->processForm($request, $this->form,$this->cancel);
    $this->setTemplate('item');
  }
  public function executeAddwanted(sfWebRequest $request)
  {
    $this->action='addwanted';
    $this->cancel='postedwanted';
    $this->navname='编辑求购信息';
    $this->forward404Unless($this->getUser()->isAuthenticated());
    $this->userid=$this->getUser()->getAttribute('id');   
    $ip=$_SERVER['REMOTE_ADDR'];
    $ipaddr=Ip::getip($ip);
    //$now=date("Y-m-d H:i:s");
    $c=new Criteria();
    $c->add(WantedPeer::USER_ID,$this->userid);
    $c->add(WantedPeer::ID,$request->getParameter('wanted[id]'));
    if(!$item=WantedPeer::doSelectone($c))
    {
      $item=new Wanted();
      $item->setIssold(0);
      //$item->setLastprompt($now);
      $this->navname='求购信息发布';
    }
    $item->setUserId($this->userid);
    $item->setIp($ip);
    $item->setIpaddress($ipaddr);
    $this->form = new WantedForm($item);
    $this->processForm($request, $this->form,$this->cancel);
    $this->setTemplate('item');
  }
  public function executeChangestbook(sfWebRequest $request)
  {
    $userid=$this->getUser()->getAttribute('id');
    $id=$request->getParameter('id');
    $c=new Criteria();
    $c->add(BookPeer::USER_ID,$userid);
    $c->add(BookPeer::ID,$id);
    $this->forward404Unless($item=BookPeer::doSelectOne($c));
    if($item->getIssold()==1) $item->setIssold(0);
    else $item->setIssold(1);
    $item->save();
    $this->redirect($request->getReferer());
  }
  public function executeChangejobst(sfWebRequest $request)
  {
    $userid=$this->getUser()->getAttribute('id');
    $id=$request->getParameter('id');
    $c=new Criteria();
    $c->add(JobPeer::USER_ID,$userid);
    $c->add(JobPeer::ID,$id);
    $this->forward404Unless($item=JobPeer::doSelectOne($c));
    if($item->getIsfind()==1) $item->setIsfind(0);
    else $item->setIsfind(1);
    $item->save();
    $this->redirect($request->getReferer());
  }
  public function executeChangestwanted(sfWebRequest $request)
  {
    $userid=$this->getUser()->getAttribute('id');
    $id=$request->getParameter('id');
    $c=new Criteria();
    $c->add(WantedPeer::USER_ID,$userid);
    $c->add(WantedPeer::ID,$id);
    $this->forward404Unless($item=WantedPeer::doSelectOne($c));
    if($item->getIssold()==1) $item->setIssold(0);
    else $item->setIssold(1);
    $item->save();
    $this->redirect($request->getReferer());
  }
  public function executeAddress(sfWebRequest $request)
  {
    $userid=$this->getUser()->getAttribute('id');
    $this->url=$request->getParameter('url');
    $c=new Criteria();
    $c->add(UserPeer::ID,$userid);
    $user=UserPeer::doSelectOne($c);
    if ($request->isMethod('post'))
    {
      $user->setCityId($request->getParameter('address[city_id]'));
      $user->setAddress($request->getParameter('address[address]'));
      $user->save();
      $this->redirect('post/'.$this->url);
    }
    $this->form=new DefaultAddressForm();
    $this->form->setDefault('city_id',$user->getCityId());
    $this->form->setDefault('address',$user->getAddress());
  }
  
  
  protected function processForm(sfWebRequest $request, sfForm $form,$url)
  {
    $form->bind(
      $request->getParameter($form->getName()),
      $request->getFiles($form->getName())
    );
   
    if ($form->isValid())
    {
      //$form->object->setPic1('hhhh');
      $item = $form->save();
      //$file = $this->form->getValue('file'); 
      //$file->save(sfConfig::get('sf_upload_dir').'/item');
   
      $this->redirect('post/'.$url);
    }
  }

  
}
