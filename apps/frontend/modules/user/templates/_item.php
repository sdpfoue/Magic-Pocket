<?php use_helper('Form');?>


<table style="width:100%; background:#EEF9EB;" class="display" >
  <?php foreach ($iList as $item): ?>
    
      <tr>
        <?php if($item->getPicNumber()):?>
          <td rowspan="2" style="width:150px;height:80px;">
            <?php echo image_tag('../uploads/item/'.$item->getFirstPic()); ?>
          </td>
        <?php endif;?>
        <?php if($item->getPicNumber()):?>
          <td style="height:5px;" colspan="2" class="title">
        <?php else:?>
          <td style="height:5px;" colspan="3" class="title">
        <?php endif;?>
          <?php echo $item->getCategory().'：'; ?>
          <?php if(strlen($item->getItemName())>$titleLen) 
            $title=mb_substr($item->getItemName(),0,$titleLen,'utf-8').'...';
            else $title=$item->getItemName(); ?>
          <?php echo link_to($title,'show/item?id='.$item->getId(),
            array('title'=>$item->getItemName()))?>   &nbsp;&nbsp;&nbsp;&nbsp;
          <?php echo '价格：$'.$item->getItemPrice();?>&nbsp; &nbsp;&nbsp; &nbsp;
          <?php echo '城市：'.$item->getCity();?>

        </td>
        
      </tr>
      <tr>
        <?php if($item->getPicNumber()):?>
          <td class="detail" colspan="2">
        <?php else:?>
          <td class="detail" colspan="3" style="height:80px;">
        <?php endif; ?>
          <?php $ldetail=$item->getItemDetail();?>
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
        <td class="bottomdash"><?php echo $item->getCreatedAt();?></td>
        <td class="bottomdash">
         
          <?php if($item->getIssold()):?>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <span style="color:red;">已售出</span>
          <?php endif;?>
        </td>
        <td class="bottomdash" style="width:50px;">
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
