<?php

class UserPeer extends BaseUserPeer
{
  public static function isMailExist($mail)
  {
    $c=new Criteria();
    $c->add(self::EMAIL,$mail);
    if(self::doSelectOne($c))
      return true;
    else return false;
  }
}
