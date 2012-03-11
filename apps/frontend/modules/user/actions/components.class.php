<?php

class userComponents extends sfComponents
{
  
  public function executeInfo(sfWebRequest $request)
  {
    $id=$request->getParameter('id');
    $c=new Criteria();
    $c->add(UserPeer::ID,$id);
    $this->user=UserPeer::doSelectOne($c);
  }
  
  
  
}


?>
