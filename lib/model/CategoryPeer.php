<?php

class CategoryPeer extends BaseCategoryPeer
{
  public static function doSelect(Criteria $criteria, PropelPDO $con = null)
  {
    if(count($criteria->getOrderByColumns()) == 0)
    {
      $criteria->addAscendingOrderByColumn(self::RANK);
    }

    return parent::doSelect($criteria, $con);
  } 
}
