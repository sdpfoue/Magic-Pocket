<?php

/**
 * sign actions.
 *
 * @package    apus
 * @subpackage sign
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
class signActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    
  }
  public function executeLogout(sfWebRequest $request)
  {
    $url=($request->getReferer());
    if(!$url) $url='index/index';
    $this->getUser()->setAuthenticated(false);
    $this->getUser()->getAttributeHolder()->clear();
    $this->message='您已经成功退出，页面将在5秒后自动跳转<br/>手动跳转';
    $this->getController()->redirect($url);
  }
  public function executeLogin(sfWebRequest $request)
  {
    $this->url=$url=($request->getReferer());
    if(!$url) $url='index/index';
    if($this->getUser()->isAuthenticated())
      $this->redirect('index/index');
    $name=$request->getParameter('uname');
    $pwd=md5($request->getParameter('pwd'));
    $c = new Criteria();
    $c->add(UserPeer::NAME, $name);
    $c->add(UserPeer::PASSWORD,$pwd);
    $user=UserPeer::doSelectOne($c);
    if($user==null){
      $this->message= '用户名或密码错误，页面将在5秒后自动跳转<br/>'.
        '<a href="'.$url.'">点击手动跳转</a>';
      $this->getUser()->setAuthenticated(false);
      $this->getUser()->getAttributeHolder()->clear();
      $response = $this->context->getResponse();
      $response->setContent(sprintf('<html><head><meta http-equiv="refresh" content="%d;url=%s"/></head></html>', 5, htmlspecialchars($url, ENT_QUOTES, sfConfig::get('sf_charset'))));
      $this->flag=false;
    }
    else{
      $ip=$_SERVER['REMOTE_ADDR'];
      $ipaddr=Ip::getip($ip);
      $now=date("Y-m-d H:i:s");
      $user->setlastLogin($now); //记录本次登录时间
      $user->setLastip($ip);  //记录本次登录IP
      $user->setLastipaddr($ipaddr); //记录本次登陆IP地址
      $user->setLoginTimes($user->getLoginTimes()+1); //记录登陆次数
      $user->save();
      
      $this->getUser()->setAttribute('name',$name);
      $this->getUser()->setAttribute('id',$user->getId());
      $this->getUser()->setAttribute('cityid',$user->getCityId());
      $this->getUser()->setAuthenticated(true);
      $this->message='欢迎您回来，'.$user->getName().'，页面将在5秒后自动跳转<br/>'.
        '<a href="'.$url.'">点击手动跳转</a>';
      $this->flag=true;
    }
  }
  public function executeSignin(sfWebRequest $request){
    $url=($request->getUri());
    $request->setParameter('url',$url);
  }
}
