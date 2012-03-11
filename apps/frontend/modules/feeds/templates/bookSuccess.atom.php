<?php $img='http://localhost/apus/web/uploads/cover/'; //布置后需要更改 ?>
<?php echo '<?xml version="1.0" encoding="utf-8"?>';?>
<feed xmlns="http://www.w3.org/2005/Atom">
  <title>Books from MagicPocket</title>
  <subtitle></subtitle>
  <link href="<?php echo url_for('feeds/book',array('absolute'=>true));?>" rel="self"/>
  <link href="<?php echo url_for('feeds/book',array('absolute'=>true));?>"/>
  <updated><?php echo $lastUpdated;?></updated>
  <author><name></name></author>
  <id><?php echo url_for('feeds/book',array('absolute'=>true));?></id>
  <?php $table = array('&#160;'=>'&#160;','&hellip;'=>'&#8230;');
    foreach($items as $item):?>
  <entry>
    <title><?php echo strtr($item->getTitle(),$table);?></title>
    <link href="<?php echo url_for('show/book?id='.$item->getId())?>" />
    <id><?php echo url_for('show/item?id='.$item->getId(),array('absolute'=>true))?></id>
    <updated><?php echo date('c',strtotime($item->getCreatedAt()))?></updated>
    <summary type="xhtml">
      <div xmlns="http://www.w3.org/1999/xhtml">
        <span class="pl2">来自：
          <?php echo link_to($item->getUser(),'user/book?id='.$item->getUserId());?>
        </span>
        <span class="pl2">
          价格：<?php echo $item->getPrice();?>
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
       
  
    <table>
    <tr>
      <?php 
        if($item->getCover())
        echo '<td>'.link_to(image_tag('../uploads/cover/'.$item->getCover()),$img.$item->getCover(),array('popup'=>array('popWindow','width=300,height=300,left=320,top=0'))).'</td>';
        ?>
    <td>
      <table>
        <tr>
          <td>ISBN: </td>
          <td><?php echo $item->getIsbn();?></td>
        </tr>
        <tr>
          <td>作者：</td>
          <td><?php echo $item->getAuthor();?></td>
        </tr>
        <?php if($item->getEdition()):?> 
        <tr>
          <td>版本：</td>
          <td><?php echo $item->getEdition();?></td>
        </tr>
        <?php endif;?>
        <?php if($item->getPublishDate()):?>
        <tr>
          <td>出版时间：</td>
          <td><?php echo $item->getPublishDate()?></td>
        </tr>
        <?php endif;?>
        <?php if($item->getPublisher()):?>
        <tr>
          <td>出版社：</td>
          <td><?php echo $item->getPublisher()?></td>
        </tr>
        <?php endif;?>
      </table>
      </td>
      </tr>
      </table>
    
        <?php if($item->getLink()):?>
    <span style="font-weight:bold;"> 
        参考链接：<a href="<?php echo $item->getLink();?>" target="_blank">
          <?php echo myUser::cutword($item->getLink(),50); ?>
        </a>
    </span><br/><br/>
    <?php endif;?>
    <?php echo nl2br($item->getDescription());?>
  
  
  
      </div>
    </summary>
    <author><name><?php echo $item->getUser();?></name></author>
  </entry>
  <?php endforeach;?>
</feed>


