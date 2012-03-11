<?php use_helper('Javascript') ?>
<?php use_helper('Form');?>
<?php slot('title');?>
  <?php echo $title.' - ';?>
<?php end_slot(); ?>
<?php slot('nav'); ?>
  <?php echo ' ';?>
<?php end_slot(); ?>
<?php $img='http://localhost/apus/web/uploads/cover/'; //布置后需要更改 ?>
<h1><?php echo $item->getName(); ?></h1>
<div>
  <span class="mn"><?php echo $item->getCreatedAt();?></span>
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
  <div style="text-align:right; font-size:14px;">
    <?php if($owner):?>
      
      浏览：<?php echo $item->getViewed();?>&nbsp;&nbsp;&nbsp;
      <?php echo link_to(image_tag('edit.png').'编辑此页面','post/editwanted?id='.$item->getId());?>
      
    <?php endif;?>
  </div>
  
</div>
