<?php

class AddressPeer extends BaseAddressPeer
{
  static public function test(){
    
    return parent::doSelect($criteria);
  }
}
