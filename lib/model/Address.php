<?php

class Address extends BaseAddress
{
  public function __toString(){
    if($this->getAddress()) $add=', ';
      else $add='';
    if($this->getSuburb()) $su=', ';
      else $su='';
    return $this->getAddress().$add.$this->getSuburb().$su.$this->getCity();
  }
}
