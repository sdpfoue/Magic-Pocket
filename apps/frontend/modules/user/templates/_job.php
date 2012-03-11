<?php use_helper('Form')?>
<?php slot('title');?>
  招聘信息- 
<?php end_slot();?>
<table style="width:100%; background:#EEF9EB;" class="display" >
  <?php foreach ($iList as $item): ?>    
      <tr>
        
          <td style="height:5px;" colspan="3 " class="title">
        
          <?php if(strlen($item->getTitle())>10) 
            $title=mb_substr($item->getTitle(),0,10,'utf-8').'...';
            else $title=$item->getTitle(); ?>
          <?php echo link_to($title,'show/job?id='.$item->getId(),
            array('title'=>$item->getTitle()))?>   &nbsp;&nbsp;&nbsp;&nbsp;
          <?php echo '时薪：$'.$item->getWage();?>&nbsp; &nbsp;&nbsp; &nbsp;
          
           <?php if($item->getType()==1)echo '全职&nbsp; &nbsp;&nbsp; &nbsp;';
              else echo '兼职&nbsp; &nbsp;&nbsp; &nbsp;';?>
          
          <?php if($item->getExperience()) echo '需要经验'; else echo '不需要经验';?>&nbsp; &nbsp;&nbsp; &nbsp;
          <?php echo '城市：'.$item->getCity();?>
        </td>
        
      </tr>
      <tr>
        
          <td class="detail" colspan="3" style="height:80px;">
        
          <?php $ldetail=$item->getDetail();?>
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
            发布人：<?php echo link_to($item->getUser(),'user/job?id='.$item->getUserId());?>
          <?php if($sf_user->getAttribute('id')!=$item->getUserId()&&
              $sf_user->isAuthenticated()):?>
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <span class='ico'><?php echo image_tag('envelope.gif');?><?php echo link_to('发送消息',
              'message/send?id='.$item->getUserId());?></span>
          <?php endif; ?>
          <?php if(!$sf_user->getAttribute('id')):?>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <span class='ico'><?php echo image_tag('envelope.gif');?>
            <a href="#signup" onclick="return confirm('请您先登陆，才可以发送站内信');">发送消息</a></span>
          <?php endif;?>
        </td>
        <td class="bottomdash" style="width:150px;">
         <span style="margin-right:0;">留言：<?php echo $item->getCommentNumber();?></span>
        </td>
      </tr>   
  <?php endforeach; ?>
</table>
<?php if(!$iList->count()):?>
  <?php include_partial('noitem');?>
<?php endif;?>

<?php  include_partial('global/page',array('pager'=>$pager)); ?> 

<?php slot('rightbar');?>
  <?php include_component('user','info');?>
<?php end_slot();?>
