<?php

/**
 * show actions.
 *
 * @package    apus
 * @subpackage show
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class showActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    //$this->forward('default', 'module');
  }
  public function executeItem(sfWebRequest $request)
  {
    //$this->setTemplate('index');
    $id=$request->getParameter('id');
    $userid=$this->getUser()->getAttribute('id');
    $c=new Criteria();
    $c->add(ItemPeer::ID,$id);
    if(!$this->item=ItemPeer::doSelectJoinAll($c))
      $this->redirect('index/index');
    $this->item=$this->item[0];
    $this->owner=($userid==$this->item->getUserId());
    if(!$this->owner) //如果不是发帖人，浏览数+1
      $this->item->setViewed($this->item->getViewed()+1);
    else //如果是发帖人，清空未读留言数量
      $this->item->setNewCommentNumber(0);
    $this->item->save();    
    $c=new Criteria();
    $c->add(ItemCommentPeer::ITEM_ID,$id);
    $this->comments=ItemCommentPeer::doSelectJoinAll($c);
    
    $comment=new ItemComment();
    $comment->setUserId($userid);
    $comment->setItemId($id);
    $this->commentForm=new ItemCommentForm($comment);
    $this->itemid=$id;
    $this->title=$this->item->getItemName();
    $request->setParameter('url','show/item?id='.$id);
  }
  public function executeBook(sfWebRequest $request)
  {
    //$this->setTemplate('index');
    $id=$request->getParameter('id');
    $userid=$this->getUser()->getAttribute('id');
    $c=new Criteria();
    $c->add(BookPeer::ID,$id);
    if(!$this->item=BookPeer::doSelectOne($c))
      $this->redirect('index/index');
    $this->owner=($userid==$this->item->getUserId());
    if(!$this->owner) //如果不是发帖人，浏览数+1
      $this->item->setViewed($this->item->getViewed()+1);
    else //如果是发帖人，清空未读留言数量
      $this->item->setNewCommentNumber(0);
    $this->item->save();    
    $c=new Criteria();
    $c->add(BookCommentPeer::BOOK_ID,$id);
    $this->comments=BookCommentPeer::doSelect($c);
    
    $comment=new BookComment();
    $comment->setUserId($userid);
    //$comment->setId($id);
    $this->commentForm=new BookCommentForm();
    $this->bookid=$id;
    $this->title=$this->item->getTitle();
    $request->setParameter('url','show/book?id='.$id);
  }
  public function executeJob(sfWebRequest $request)
  {
    //$this->setTemplate('index');
    $id=$request->getParameter('id');
    $userid=$this->getUser()->getAttribute('id');
    $c=new Criteria();
    $c->add(JobPeer::ID,$id);
    if(!$this->item=JobPeer::doSelectOne($c))
      $this->redirect('index/job');
    $this->owner=($userid==$this->item->getUserId());
    if(!$this->owner) //如果不是发帖人，浏览数+1
      $this->item->setViewed($this->item->getViewed()+1);
    else //如果是发帖人，清空未读留言数量
      $this->item->setNewCommentNumber(0);
    $this->item->save();    
    $c=new Criteria();
    $c->add(CommentsPeer::ITEM_ID,$id);
    $c->add(CommentsPeer::CATEGORY,1); //类别1为job的评论
    $this->comments=CommentsPeer::doSelect($c);
    
    $comment=new Comments();
    $comment->setUserId($userid);
    //$comment->setId($id);
    $this->commentForm=new CommentsForm();
    $this->jobid=$id;
    $this->title=$this->item->getTitle();
    $request->setParameter('url','show/job?id='.$id);
  }
  public function executeWanted(sfWebRequest $request)
  {
    //$this->setTemplate('index');
    $id=$request->getParameter('id');
    $userid=$this->getUser()->getAttribute('id');
    $c=new Criteria();
    $c->add(WantedPeer::ID,$id);
    if(!$this->item=WantedPeer::doSelectOne($c))
      $this->redirect('index/index'); //物品不存在
    $this->owner=($userid==$this->item->getUserId());
    if(!$this->owner) //如果不是发帖人，浏览数+1
      $this->item->setViewed($this->item->getViewed()+1);
    $this->item->save();    
    $this->id=$id;
    $this->title=$this->item->getName();
    $request->setParameter('url','show/wanted?id='.$id);
        
  }
  
  public function executeAdditemcomment(sfWebRequest $request)
  {
    if(!trim($request->getParameter('item_comment[body]'))) //if submit null, do nothing
      $this->redirect($request->getReferer());
    $form=new ItemCommentForm();
    $userid=$this->getUser()->getAttribute('id');
    $itemid=$request->getParameter('itemid');
    $form->bind(
      $request->getParameter($form->getName()));
    $form->getObject()->setUserId($userid);
    $form->getObject()->setItemId($itemid);
    $form->getObject()->setIp($_SERVER['REMOTE_ADDR']);
    $form->getObject()->setIpAddress(Ip::getip($_SERVER['REMOTE_ADDR']));
    if($form->isValid())
      $form->save();
    //else $this->form=$form;
    $this->redirect('show/item?id='.$itemid.'#'.$form->getObject()->getId());    
    $this->comment=$form->getObject();
    $this->owner=($userid==$form->getObject()->getItem()->getUserId());
    $this->commentowner=true;
    $this->id=$itemid;
  }
  public function executeAddbookcomment(sfWebRequest $request)
  {
    if(!trim($request->getParameter('book_comment[body]'))) //if submit null, do nothing
      $this->redirect($request->getReferer());
    $form=new BookCommentForm();
    $userid=$this->getUser()->getAttribute('id');
    $bookid=$request->getParameter('bookid');
    $form->bind(
      $request->getParameter($form->getName()));
    $form->getObject()->setUserId($userid);
    $form->getObject()->setBookId($bookid);
    $form->getObject()->setIp($_SERVER['REMOTE_ADDR']);
    $form->getObject()->setIpAddress(Ip::getip($_SERVER['REMOTE_ADDR']));
    if($form->isValid())
      $form->save();
    $this->redirect('show/book?id='.$bookid.'#'.$form->getObject()->getId());
    $this->comment=$form->getObject();
    $this->owner=($userid==$form->getObject()->getBook()->getUserId());
    $this->commentowner=true;
    $this->id=$bookid;
    $this->setTemplate('index');
  }
  public function executeAddcomment(sfWebRequest $request)
  {
    $form=new CommentsForm();
    //if submit null, do nothing
    if(!trim($request->getParameter('comments[body]')))
      $this->redirect($request->getReferer());
    $category=$request->getParameter('category');
    $userid=$this->getUser()->getAttribute('id');
    $id=$request->getParameter('id');
    $form->bind(
      $request->getParameter($form->getName()));
    $form->getObject()->setUserId($userid);
    $form->getObject()->setItemId($id);
    $form->getObject()->setCategory($category);
    $form->getObject()->setIp($_SERVER['REMOTE_ADDR']);
    $form->getObject()->setIpAddress(Ip::getip($_SERVER['REMOTE_ADDR']));
    //if($form->isValid())
      $form->save();
    $this->redirect($request->getReferer().'#'.$form->getObject()->getId());
    $this->comment=$form->getObject();
    //$this->owner=($userid==$form->getObject()->getBook()->getUserId());
    $this->commentowner=true;
    $this->id=$id;
    $this->setTemplate('index');
  }
  public function executeDelitemcomment(sfWebRequest $request)
  {
    $commentId=$request->getParameter('id');
    $userId=$this->getUser()->getAttribute('id');
    $c=new Criteria();
    $c->add(ItemCommentPeer::ID,$commentId);
    $comment=ItemCommentPeer::doSelectOne($c);
    if($comment->getUserId()!=$userId //此留言不是当前用户发布
      &&$comment->getItem()->getUserId()!=$userId) //此留言所对应的信息不是当前用户发布
      $this->forward404();
    $itemId=$comment->getItemId();
    $comment->delete();
    $this->redirect('show/item?id='.$itemId.'#comment');
  }
  public function executeDelbookcomment(sfWebRequest $request)
  {
    $commentId=$request->getParameter('id');
    $userId=$this->getUser()->getAttribute('id');
    $c=new Criteria();
    $c->add(BookCommentPeer::ID,$commentId);
    $comment=BookCommentPeer::doSelectOne($c);
    if($comment->getUserId()!=$userId //此留言不是当前用户发布
      &&$comment->getBook()->getUserId()!=$userId) //此留言所对应的信息不是当前用户发布
      $this->forward404();
    $itemId=$comment->getBookId();
    $comment->delete();
    $this->redirect('show/book?id='.$itemId.'#comment');
  }
  public function executeDelcomment(sfWebRequest $request)
  {
    $commentId=$request->getParameter('id');
    $userId=$this->getUser()->getAttribute('id');
    $c=new Criteria();
    $c->add(CommentsPeer::ID,$commentId);
    $comment=CommentsPeer::doSelectOne($c);
    if($comment->getUserId()!=$userId //此留言不是当前用户发布
      &&$comment->getOwnerId()!=$userId) //此留言所对应的信息不是当前用户发布
      $this->forward404();
    
    $comment->delete();
    $this->redirect($request->getReferer().'#comment');
  }
  public function executeEdititemcomment(sfWebRequest $request)
  {
    $commentid=$request->getParameter('id');
    $userid=$this->getUser()->getAttribute('id');
    $value=$request->getParameter('value');
    $c=new Criteria();
    $c->add(ItemCommentPeer::ID,$commentid);
    $c->add(ItemCommentPeer::USER_ID,$userid);
    $this->forward404Unless($comment=ItemCommentPeer::doSelectOne($c));
    if($value=trim($value))
      $comment->setBody($value);
    $comment->save();
    $this->v=$comment->getBody();
    
  }
    public function executeEditbookcomment(sfWebRequest $request)
    {
      $commentid=$request->getParameter('id');
      $userid=$this->getUser()->getAttribute('id');
      $value=$request->getParameter('value');
      $c=new Criteria();
      $c->add(BookCommentPeer::ID,$commentid);
      $c->add(BookCommentPeer::USER_ID,$userid);
      $this->forward404Unless($comment=BookCommentPeer::doSelectOne($c));
      if($value=trim($value))
        $comment->setBody($value);
      $comment->save();
      $this->v=$comment->getBody();
      
    }
    
    public function executeEditcomment(sfWebRequest $request)
    {
      $commentid=$request->getParameter('id');
      $userid=$this->getUser()->getAttribute('id');
      $value=$request->getParameter('value');
      $c=new Criteria();
      $c->add(CommentsPeer::ID,$commentid);
      $c->add(CommentsPeer::USER_ID,$userid);
      $this->forward404Unless($comment=CommentsPeer::doSelectOne($c));
      if($value=trim($value))
        $comment->setBody($value);
      $comment->save();
      $this->v=$comment->getBody();
      
    }
  public function executeReplyitemcomment(sfWebRequest $request)
  {
    $this->id=$request->getParameter('id');
    $userid=$this->getUser()->getAttribute('id');
    $id=$request->getParameter('id');
    $this->element='r'.$this->id;
    $c=new Criteria();
    $c->add(ItemCommentPeer::ID,$id);  //此处有安全漏洞！！！！！
    $comment=ItemCommentPeer::doSelectOne($c);
    $this->body=$comment->getOwnerReply();
  }
  public function executeReplybookcomment(sfWebRequest $request)
  {
    $this->id=$request->getParameter('id');
    $userid=$this->getUser()->getAttribute('id');
    $id=$request->getParameter('id');
    $this->element='r'.$this->id;
    $c=new Criteria();
    $c->add(BookCommentPeer::ID,$id);  //此处有安全漏洞！！！！！
    $comment=BookCommentPeer::doSelectOne($c);
    $this->body=$comment->getOwnerReply();
  }
  public function executeReplycomment(sfWebRequest $request)
  {
    $this->id=$request->getParameter('id');
    $userid=$this->getUser()->getAttribute('id');
    $id=$request->getParameter('id');
    $this->element='r'.$this->id;
    $c=new Criteria();
    //$c->add(CommentsPeer::USER_ID,$userid);  //此处有安全漏洞！！！！！
    $c->add(CommentsPeer::ID,$id);
    $comment=CommentsPeer::doSelectOne($c);
    $this->body=$comment->getOwnerReply();
  }
  public function executeAdditemreply(sfWebRequest $request)
  {
    $userid=$this->getUser()->getAttribute('id');
    $commentid=trim($request->getParameter('id'));
    $reply=$request->getParameter('reply');
    $time=date("Y-m-d H:i:s");
    $c=new Criteria();
    $c->add(ItemCommentPeer::ID,$commentid);
    $this->forward404Unless($comment=ItemCommentPeer::doSelectOne($c));
    $this->forward404Unless($userid==$comment->getItem()->getUserId());
    $comment->setOwnerReply($reply);
    $comment->setReplyTime($time);
    if($reply){ //有回复
      $comment->setNewReply(1);
      //$comment->Item()->setReplyNumber($comment->Item()->getReplyNumber+1);
      //$comment->Item()->save();
    }
    else{ //无回复
      $comment->setNewReply(0);
      //$comment->Item()->setReplyNumber($comment->Item()->getReplyNumber-1);
      //$comment->Item()->save();
    }
    $comment->save(); 
    $this->comment=$comment;
  }
  public function executeAddbookreply(sfWebRequest $request)
  {
    $userid=$this->getUser()->getAttribute('id');
    $commentid=trim($request->getParameter('id'));
    $reply=$request->getParameter('reply');
    $time=date("Y-m-d H:i:s");
    $c=new Criteria();
    $c->add(BookCommentPeer::ID,$commentid);
    $this->forward404Unless($comment=BookCommentPeer::doSelectOne($c));
    $this->forward404Unless($userid==$comment->getBook()->getUserId());
    $comment->setOwnerReply($reply);
    $comment->setReplyTime($time);
    if($reply){ //有回复
      $comment->setNewReply(1);
    }
    else{ //无回复
      $comment->setNewReply(0);     
    }
    $comment->save(); 
    $this->comment=$comment;
  }
  public function executeAddreply(sfWebRequest $request)
  {
    $userid=$this->getUser()->getAttribute('id');
    $commentid=trim($request->getParameter('id'));
    $reply=$request->getParameter('reply');
    $time=date("Y-m-d H:i:s");
    $c=new Criteria();
    $c->add(CommentsPeer::ID,$commentid);
    $this->forward404Unless($comment=CommentsPeer::doSelectOne($c));
    $this->forward404Unless($userid==$comment->getOwnerId());
    $comment->setOwnerReply($reply);
    $comment->setReplyTime($time);
    if($reply){ //有回复
      $comment->setNewReply(1);
    }
    else{ //无回复
      $comment->setNewReply(0);     
    }
    $comment->save(); 
    $this->comment=$comment;
  }
  
  public function executeBlank(sfWebRequest $request)
  {
  }
  
}
