<?php
   $types = array('均可', '全职', '兼职');
   $gender = array('均可', '男', '女');
   $experience = array('不需要', '需要');
?>
<?php $img='http://localhost/apus/web/uploads/cover/'; //布置后需要更改 ?>
<?php echo '<?xml version="1.0" encoding="utf-8"?>';?>
<feed xmlns="http://www.w3.org/2005/Atom">
  <title>Wanted from MagicPocket</title>
  <subtitle></subtitle>
  <link href="<?php echo url_for('feeds/wanted',array('absolute'=>true));?>" rel="self"/>
  <link href="<?php echo url_for('feeds/wanted',array('absolute'=>true));?>"/>
  <updated><?php echo $lastUpdated;?></updated>
  <author><name></name></author>
  <id><?php echo url_for('feeds/book',array('absolute'=>true));?></id>
  <?php $table = array('&#160;'=>'&#160;','&hellip;'=>'&#8230;');
    foreach($items as $item):?>
  <entry>
    <title><?php echo strtr($item->getName(),$table);?></title>
    <link href="<?php echo url_for('show/wanted?id='.$item->getId())?>" />
    <id><?php echo url_for('show/item?id='.$item->getId(),array('absolute'=>true))?></id>
    <updated><?php echo date('c',strtotime($item->getCreatedAt()))?></updated>
    <summary type="xhtml"><div xmlns="http://www.w3.org/1999/xhtml">
      <span class="pl2">来自：
        <?php echo link_to($item->getUser(),'user/wanted?id='.$item->getUserId());?>
      </span>
      <span class="pl2">
        城市：<?php echo $item->getCity();?>
      </span>
      
      <?php if($item->getIssold()):?>
        <span class="pl2" style="color:red;">
          已售出
        </span>
     <?php endif;?>
  
  <br/>
    <div style="padding:15px 10px;">
      <?php if($item->getLink()):?>
      <span style="font-weight:bold;"> 
          参考链接：<a href="<?php echo $item->getLink();?>" target="_blank">
            <?php echo myUser::cutword($item->getLink(),50); ?>
          </a>
      </span><br/><br/>
      <?php endif;?>
      <?php echo nl2br($item->getDescription());?>
    </div>
    </div>
      
    </summary>
    <author><name><?php echo $item->getUser();?></name></author>
  </entry>
  <?php endforeach;?>
</feed>


