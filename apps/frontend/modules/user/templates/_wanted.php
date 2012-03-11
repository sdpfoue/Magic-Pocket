<?php use_helper('Form');?>

<table style="width:100%; background:#EEF9EB;" class="display" >
  <?php foreach ($iList as $item): ?>
    
      <tr>
        
        
          <td style="height:5px;" colspan="3 " class="title">
        
          <?php if(strlen($item->getName())>$titleLen) 
            $title=mb_substr($item->getName(),0,$titleLen,'utf-8').'...';
            else $title=$item->getName(); ?>
          <?php echo link_to($title,'show/wanted?id='.$item->getId(),
            array('title'=>$item->getName()))?>   &nbsp;&nbsp;&nbsp;&nbsp;
          <?php echo '城市：'.$item->getCity();?>
          <?php if($item->getIssold()):?>
             &nbsp;&nbsp;&nbsp;&nbsp;
            <span style="color:red;">已购得</span>
          <?php endif;?>
        </td>
        
      </tr>
      <tr>
        
          <td class="detail" colspan="3" style="height:80px;">
        
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
        <td class="bottomdash" style="width:140px;">
         &nbsp;
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
