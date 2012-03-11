<?php

/**
 * feeds actions.
 *
 * @package    apus
 * @subpackage feeds
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class feedsActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  
  protected $tables=array('&nbsp;'=>'&#160;','&hellip;'=>'&#8230;');
  public function executeItem(sfWebRequest $request)
  {        
      $this->table=$this->tables;
      $request->setRequestFormat('atom');
      $cityid=$request->getParameter('cityid');
      $c=new Criteria();
      $c->addDescendingOrderByColumn(ItemPeer::LASTPROMPT);
      $c->add(ItemPeer::ISSOLD,0); //只显示未出售的结果
      
      //搜索，精确结果
      $this->query='';
      $search=$request->getParameter('search');
      if($search){
        $search=$request->getParameter('search');
        $this->query=$this->processquery($search);
        if($search['pic1'])
          $c->add(ItemPeer::ITEM_PRICE,$search['pic1'],Criteria::GREATER_EQUAL);
        else
          $c->add(ItemPeer::ITEM_PRICE,0,Criteria::GREATER_EQUAL);
        if($search['pic2'])
          $c->addAnd(ItemPeer::ITEM_PRICE,$search['pic2'],Criteria::LESS_EQUAL);
        if($search['city'])
          $c->add(ItemPeer::CITY_ID,$search['city']);
        if($search['keyword']){
          $keywords=split(' ',$search['keyword']);
          foreach($keywords as $k){
            $c1=$c->getNewCriterion(ItemPeer::ITEM_NAME,'%'.$k.'%',Criteria::LIKE);
            $c2=$c->getNewCriterion(ItemPeer::ITEM_DETAIL,'%'.$k.'%',Criteria::LIKE);
            $c1->addOr($c2);
            $c->addAnd($c1);
          }
        }
        if($search['category'])
          $c->add(ItemPeer::CATEGORY_ID,$search['category']);
      }
      //搜索部分结束
      else
        if($cityid)
          $c->add(ItemPeer::CITY_ID,$cityid);
      $c->setLimit(20);      
      $this->items=ItemPeer::doSelect($c);
      
    }
    
  public function executeBook(sfWebRequest $request)
  {
    $this->table=$this->tables;
    $request->setRequestFormat('atom');
    $cityid=$request->getParameter('cityid');
    
    $c=new Criteria();
    $c->addDescendingOrderByColumn(BookPeer::LASTPROMPT);
    $c->add(BookPeer::ISSOLD,0); //只显示未出售的结果
    
    //搜索，精确结果
    $this->query='';
    $search=$request->getParameter('search');
    if($search){
      $search=$request->getParameter('search');
      $this->query=$this->processquery($search);
      if($search['pic1'])
        $c->add(BookPeer::PRICE,$search['pic1'],Criteria::GREATER_EQUAL);
      else
        $c->add(BookPeer::PRICE,0,Criteria::GREATER_EQUAL);
      if($search['pic2'])
        $c->addAnd(BookPeer::PRICE,$search['pic2'],Criteria::LESS_EQUAL);
      if($search['city'])
        $c->add(BookPeer::CITY_ID,$search['city']);
      if($search['keyword']){
        $keywords=split(' ',$search['keyword']);
        foreach($keywords as $k){
          $c1=$c->getNewCriterion(BookPeer::TITLE,'%'.$k.'%',Criteria::LIKE);
          $c2=$c->getNewCriterion(BookPeer::DESCRIPTION,'%'.$k.'%',Criteria::LIKE);
          $c1->addOr($c2);
          $c->addAnd($c1);
        }
      }
      //$this->form->bind($request->getParameter('search'));
    }
    //搜索部分结束
    else
      if($cityid)
      {
        $c->add(BookPeer::CITY_ID,$cityid);
        //$query='&cityid='.$cityid; 
      }
        
    $c->setLimit(20);      
      $this->items=BookPeer::doSelect($c);    
    //if($request->isMethod('post'))
      
  }
   public function executeJob(sfWebRequest $request)
   {
     $this->table=$this->tables;
     $request->setRequestFormat('atom');
     $cityid=$request->getParameter('cityid');
     $c=new Criteria();
    $c->addDescendingOrderByColumn(JobPeer::PROMPTED_AT);
    $c->add(JobPeer::ISFIND,0); //只显示未出售的结果    
    $this->form=new Search4Form();
    $this->form->setDefault('city',$cityid);    
    //搜索，精确结果
    $this->query='';
    $search=$request->getParameter('search');
    if($search){
      $search=$request->getParameter('search');
      $this->query=$this->processquery($search);
      if($search['pic1'])
        $c->add(JobPeer::WAGE,$search['pic1'],Criteria::GREATER_EQUAL);
      else
        $c->add(JobPeer::WAGE,0,Criteria::GREATER_EQUAL);
      if($search['pic2'])
        $c->addAnd(JobPeer::WAGE,$search['pic2'],Criteria::LESS_EQUAL);
      if($search['city'])
        $c->add(JobPeer::CITY_ID,$search['city']);
      if($search['postcode'])
        $c->add(JobPeer::POSTCODE,$search['postcode']);

      if($search['gender']==0)
        $c1=$c->getNewCriterion(JobPeer::GENDER,1);
      else
        $c1=$c->getNewCriterion(JobPeer::GENDER,2);
      $c2=$c->getNewCriterion(JobPeer::GENDER,0);
      $c1->addOr($c2);
      $c->addAnd($c1);
      
      if($search['type'])//工作类型
      {
        $c1=$c->getNewCriterion(JobPeer::TYPE,0);
        $c2=$c->getNewCriterion(JobPeer::TYPE,$search['type']);
        $c1->addOr($c2);
        $c->addAnd($c1);
      }
      
      if($search['experience']==1)
      {
        $c1=$c->getNewCriterion(JobPeer::EXPERIENCE,0);
        $c2=$c->getNewCriterion(JobPeer::EXPERIENCE,1);
        $c1->addOr($c2);
        $c->addAnd($c1);
      }
           
            
      if($search['keyword']){
        $keywords=split(' ',$search['keyword']);
        foreach($keywords as $k){
          $c1=$c->getNewCriterion(JobPeer::TITLE,'%'.$k.'%',Criteria::LIKE);
          $c2=$c->getNewCriterion(JobPeer::DETAIL,'%'.$k.'%',Criteria::LIKE);
          $c1->addOr($c2);
          $c->addAnd($c1);
        }
      }
    }
    //搜索部分结束
    else
      if($cityid)
        $c->add(JobPeer::CITY_ID,$cityid);
     $c->setLimit(20);
     $this->items=JobPeer::doSelect($c);
   }
   public function executeWanted(sfWebRequest $request)
   {
     $this->table=$this->tables;
     $request->setRequestFormat('atom');
     $cityid=$request->getParameter('cityid');
     
     $c=new Criteria();
    $c->addDescendingOrderByColumn(WantedPeer::CREATED_AT);
    
    //搜索，精确结果
    $this->query='';
    $search=$request->getParameter('search');
    if($search){
      $search=$request->getParameter('search');
      $this->query=$this->processquery($search);
      if($search['city'])
        $c->add(WantedPeer::CITY_ID,$search['city']);
      if($search['keyword']){
        $keywords=split(' ',$search['keyword']);
        foreach($keywords as $k){
          $c1=$c->getNewCriterion(WantedPeer::NAME,'%'.$k.'%',Criteria::LIKE);
          $c2=$c->getNewCriterion(WantedPeer::DESCRIPTION,'%'.$k.'%',Criteria::LIKE);
          $c1->addOr($c2);
          $c->addAnd($c1);
        }
      }
      //$this->form->bind($request->getParameter('search'));
    }
    //搜索部分结束
    else
      if($cityid)
        $c->add(WantedPeer::CITY_ID,$cityid);
    $c->setLimit(20);
    $this->items=WantedPeer::doSelect($c);
   
   }
    
    
    protected function processquery($array)
    {
      $query='&';
      foreach($array as $name => $value)
      {
        $query=$query.'search['.$name.']='.$value.'&';
      }
      return $query;
    }
  
}
