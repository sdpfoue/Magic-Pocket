<?php

class BookComment extends BaseBookComment
{
  public function save(PropelPDO $con = null)
  {
    if($this->isNew())
    {
      $this->getBook()->setCommentNumber($this->getBook()->getCommentNumber()+1);
      $this->getBook()->setNewCommentNumber($this->getBook()->getNewCommentNumber()+1);
      $this->getBook()->save();
    }
    parent::save($con);
  }
  
  public function delete(PropelPDO $con = null)
  {  
    $this->getBook()->setCommentNumber($this->getBook()->getCommentNumber()-1);
    $this->getBook()->setNewCommentNumber($this->getBook()->getNewCommentNumber()-1);
    $this->getBook()->save();    
    parent::delete($con);
  }
}
