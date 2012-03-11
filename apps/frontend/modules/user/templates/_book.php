<?php use_helper('Form')?>

<table style="width:100%; background:#EEF9EB;" class="display" >
  <?php foreach ($iList as $item): ?>
    
      <tr>
        <?php if($item->getCover()):?>
          <td rowspan="2" >
            <?php echo image_tag('../uploads/cover/'.$item->getCover()); ?>
          </td>
        <?php endif;?>
        <?php if($item->getCover()):?>
          <td style="height:5px;" colspan="2" class="title">
        <?php else:?>
          <td style="height:5px;" colspan="3 " class="title">
        <?php endif;?>
          <?php if(strlen($item->getTitle())>10) 
            $title=mb_substr($item->getTitle(),0,10,'utf-8').'...';
            else $title=$item->getTitle(); ?>
          <?php echo link_to($title,'show/book?id='.$item->getId(),
            array('title'=>$item->getTitle()))?>   &nbsp;&nbsp;&nbsp;&nbsp;
          <?php echo '价格：$'.$item->getPrice();?>&nbsp; &nbsp;&nbsp; &nbsp;
          <?php if($item->getAuthor()) echo '作者：'.myUser::cutword($item->getAuthor(),10).'&nbsp; &nbsp;&nbsp; &nbsp;';?>
          <?php echo '城市：'.$item->getCity();?>
        </td>
        
      </tr>
      <tr>
        <?php if($item->getCover()):?>
          <td class="detail" colspan="2">
        <?php else:?>
          <td class="detail" colspan="3" style="height:80px;">
        <?php endif; ?>
          <?php $ldetail=$item->getDescription();?>
          <?php if(strlen($ldetail)>$desLen) 
            $sdetail=mb_substr($ldetail,0,$desLen,'utf-8').'...';
            else $sdetail=$ldetail; ?>
          <?php echo nl2br($sdetail); ?>
          <?php if($item->getLink()):?>
            <br/><br/>
            <b>参考链接：<a href="<?php echo $item->getLink();?>" target="_blank">
              <?php echo myUser::cutword($item->getLink(),45);?>
             </a></b>
           <?php endif;?>
        </td>
      </tr>
      <tr>
        <td class="bottomdash" style="width:120px;"><?php echo $item->getCreatedAt();?></td>
        <td class="bottomdash">       
            
        </td>
        <td class="bottomdash" style="width:150px;">
         <span style="margin-right:0;">留言：<?php echo $item->getCommentNumber();?></span>
        </td>
      </tr>   
  <?php endforeach; ?>
</table>
<?php if(!$iList->count()):?>
  <?php include_partial('global/noitem');?>
<?php endif;?>

<?php  include_partial('global/page',array('pager'=>$pager)); ?> 

<?php slot('rightbar');?>
  <?php include_component('user','info');?>
<?php end_slot();?>
