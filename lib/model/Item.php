<?php

class Item extends BaseItem
{
  public function __toString(){
    return $this->getItemName();
  }
  
  public function getContent()
  {
    return $this->getItemName().' '.$this->getItemDetail().' '.
      $this->getItemPrice();
  }
  public function getUserItems($userid)
  {
    $c=new Criteria();
    $c->add(ItemPeer::USER_ID,$userid);
    $c->addDescendingOrderByColumn(ItemPeer::LASTPROMPT);   
    return ItemPeer::addUserItemsCriteria($c);
  }
  
  public function getPicNumber()
  {
    $num=0;
    if($this->getPic1())$num++;
    if($this->getPic2())$num++;
    if($this->getPic3())$num++;
    if($this->getPic4())$num++;
    return $num;    
  }
  public function getFirstPic()
  {
    if($this->getPic1()) return $this->getPic1();
    if($this->getPic2()) return $this->getPic2();
    if($this->getPic3()) return $this->getPic3();
    if($this->getPic4()) return $this->getPic4();
  }
    
  
  
  
}
