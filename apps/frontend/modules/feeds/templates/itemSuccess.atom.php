<?php echo '<?xml version="1.0" encoding="utf-8"?>';?>
<feed xmlns="http://www.w3.org/2005/Atom">
  <title>Items from MagicPocket</title>
  <subtitle></subtitle>
  <link href="<?php echo url_for('feeds/item',array('absolute'=>true));?>" rel="self"/>
  <link href="<?php echo url_for('feeds/item',array('absolute'=>true));?>"/>
  <updated><?php echo $lastUpdated;?></updated>
  <author><name></name></author>
  <id><?php echo url_for('feeds/item',array('absolute'=>true));?></id>
  <?php $table = array('&nasp;'=>'&#160;','&hellip;'=>'&#8230;');
    foreach($items as $item):?>
  <entry>
    <title><?php echo strtr($item->getItemName(),$table);?></title>
    <link href="<?php echo url_for('show/item?id='.$item->getId())?>" />
    <id><?php echo url_for('show/item?id='.$item->getId(),array('absolute'=>true))?></id>
    <updated><?php echo date('c',strtotime($item->getCreatedAt()))?></updated>
    <summary type="xhtml"><div xmlns="http://www.w3.org/1999/xhtml">
      <strong>类别：<?php echo $item->getCategory(); ?>
          
          <?php echo '价格：$'.$item->getItemPrice();?>&#160; &#160;&#160; &#160;
          <?php echo '城市：'.$item->getCity();?><br/></strong>
      <?php
        
        echo nl2br(strtr($item->getItemDetail(),$table));
      ?>
    </div></summary>
    <author><name><?php $item->getUser();?></name></author>
  </entry>
  <?php endforeach;?>
</feed>


