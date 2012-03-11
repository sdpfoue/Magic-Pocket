<?php

/**
 * content actions.
 *
 * @package    apus
 * @subpackage content
 * @author     Your name here
 * @version    SVN: $Id: actions.class.php 12479 2008-10-31 10:54:40Z fabien $
 */
 class myClass
{
  public function testSpecialChars($value = '')
  {
    return '<'.$value.'>';
  }
}

class contentActions extends sfActions
{
 /**
  * Executes index action
  *
  * @param sfRequest $request A request object
  */
  public function executeIndex(sfWebRequest $request)
  {
    //$this->getResponse()->setTitle($this->getResponse()->getTitle()." abd");
    //$this->forward('default', 'module');
    $this->title=Ip::getip("65.55.110.136");
    //echo $this->getResponse()->getTitle();
    //echo "dfj";
    //$this->title="abc";
    
  }
  
  public function executeShow()
  {
    $today=getdate();
    $this->hour=$today['hours'];
  }
  
  public function executeUpdate($request)
  {
    
    $this->name = $request->getParameter('name');
    $this->test_array = array('&', '<', '>');
    $this->test_array_of_arrays = array(array('&'));
    $this->test_object = new myClass();
  }



}
