<?php

class Comments extends BaseComments
{
  //get the comment's post's user id
  public function getOwnerId()
  {
    //$c=new Criteria();
    if($this->getCategory()==1)
    {
      $post=JobPeer::retrieveByPk($this->getItemId());
      return $post->getUserId();
    }
  }
  public function save(PropelPDO $con = null)
  {    
    if($this->isNew()){
      if($this->category==1)
        $item=JobPeer::retrieveByPk($this->getItemId());
      $item->setCommentNumber($item->getCommentNumber()+1);
      $item->setNewCommentNumber($item->getNewCommentNumber()+1);
      $item->save();
    }
    parent::save($con);
  }
  public function delete(PropelPDO $con = null)
  {
    parent::delete($con);
    if($this->category==1)
    {
      $job=JobPeer::retrieveByPk($this->getItemId());
      $job->setCommentNumber($job->getCommentNumber()-1);
      $job->setNewCommentNumber($job->getNewCommentNumber()-1);
      $job->save();
    }
  }
}
