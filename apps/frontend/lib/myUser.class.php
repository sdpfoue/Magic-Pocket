<?php

class myUser extends sfBasicSecurityUser
{
  static function cutword($word,$num)
  {
    if(strlen($word)>$num) 
      $word=mb_substr($word,0,$num,'utf-8').'...';
    return $word;
  }
  static function validateEmail($email)
  { 
    return eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$", $email);
  }

}


?>
