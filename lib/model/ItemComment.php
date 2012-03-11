<?php

class ItemComment extends BaseItemComment
{
  public function save(PropelPDO $con = null)
  {
    if($this->isNew())
    {
      $this->getItem()->setCommentNumber($this->getItem()->getCommentNumber()+1);
      $this->getItem()->setNewCommentNumber($this->getItem()->getNewCommentNumber()+1);
      $this->getItem()->save();
    }
    parent::save($con);
  }
  
  public function delete(PropelPDO $con = null)
  {  
    $this->getItem()->setCommentNumber($this->getItem()->getCommentNumber()-1);
    $this->getItem()->setNewCommentNumber($this->getItem()->getNewCommentNumber()-1);
    $this->getItem()->save();    
    parent::delete($con);
  }
}
