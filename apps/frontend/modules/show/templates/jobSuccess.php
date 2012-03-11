<?php use_helper('Javascript') ?>
<?php use_helper('Form');?>
<?php slot('title');?>
  <?php echo $title.' - ';?>
<?php end_slot(); ?>
<?php slot('nav'); ?>
  <?php echo ' ';?>
<?php end_slot(); ?>


<?php
   $types = array('均可', '全职', '兼职');
   $gender = array('均可', '男', '女');
   $experience = array('不需要', '需要');
?>

<h1><?php echo $item->getTitle(); ?></h1>
<div>
  <span class="mn"><?php echo $item->getCreatedAt();?></span>
  <span class="pl2">来自：
    <?php echo link_to($item->getUser(),'user/job?id='.$item->getUserId());?>
  </span>
  <span class="pl2">
    时薪：<?php echo $item->getWage();?>
  </span>
  <span class="pl2">
    城市：<?php echo $item->getCity();?>
  </span>
  
  <?php if($item->getIsfind()):?>
    <span class="pl2" style="color:red;">
      已聘到
    </span>
  <?php endif;?>
  
  <br/>
  
  <div style="width:100%;text-align:left;" class="display">

    
      <table>
        <tr>
          <td>经验： </td>
          <td><?php echo $experience[$item->getExperience()];?></td>
        </tr>
        <tr>
          <td>工作类型：</td>
          <td><?php echo $types[$item->getType()];?></td>
        </tr>
        
        <tr>
          <td>要求性别：</td>
          <td><?php echo $gender[$item->getGender()];?></td>
        </tr>
       
        
        <tr>
          <td>每周最少时间：</td>
          <td><?php echo $item->getLeasttime()?></td>
        </tr>
        
       
        <tr>
          <td>详细地址：</td>
          <td><?php echo $item->getAddress().' '.$item->getPostcode();?></td>
        </tr>
       
      </table>
    
  </div>
  <div style="clear:both;"></div>
  <div style="padding:15px 10px;">
    <?php if($item->getLink()):?>
    <span style="font-weight:bold;"> 
        参考链接：<a href="<?php echo $item->getLink();?>" target="_blank">
          <?php echo myUser::cutword($item->getLink(),50); ?>
        </a>
    </span><br/><br/>
    <?php endif;?>
    <?php echo nl2br($item->getDetail());?>
  </div>
  <div style="text-align:right; font-size:14px;">
    留言：<?php echo $item->getCommentNumber();?>&nbsp;&nbsp;&nbsp;
    <?php if($owner):?>
      
      浏览：<?php echo $item->getViewed();?>&nbsp;&nbsp;&nbsp;
      <?php echo link_to(image_tag('edit.png').'编辑此页面','post/editjob?job[id]='.$item->getId());?>
      
    <?php endif;?>
  </div>
  <hr/>
  <table style="width:100%;" id="comment">
  <?php foreach ($comments as $comment):?>
    <?php $commentowner=($comment->getUserId()==$sf_user->getAttribute('id'));?>
    <tr>
      <td class="comment_title" id="<?php echo $comment->getId();?>">
        <span style="float:left; width:400px;">
        <?php echo $comment->getCreatedAt();?>&nbsp;&nbsp;&nbsp;
        <?php echo $comment->getUser();?>
        </span>
        <span style="float:right; width:200px;text-align:right;">
        <?php if($commentowner||$owner) echo 
          '&nbsp;&nbsp;&nbsp;'.link_to(image_tag('delete.png').'删除',
          'show/delcomment?id='.$comment->getId(),
          array('confirm'=>'确定删除吗?'));?>
        <?php if($owner):?>&nbsp;&nbsp;&nbsp;
          <?php echo link_to_remote((image_tag('new.png')).'回复/'.
              image_tag('edit.png').'修改回复',
               array(
              'update'    => 'r'.$comment->getId(),
              'url'       => 'show/replycomment?id='.$comment->getId(),
              'loading' => visual_effect('appear', 't'.$comment->getId()),
          )) ;?>
        <?php endif;?>
        </span>
      </td>      
    </tr>
    <tr>
      <td class="comment_body" >
      <div id="<?php echo 'b'.$comment->getId();?>">
        <?php echo nl2br($comment->getBody());?>
      </div>
      <div id="<?php echo 'r'.$comment->getId();?>" class="reply">
        <div id="<?php echo 't'.$comment->getId();?>"  
          style="display: none;text-align:center;">
              加载中...
           <?php echo image_tag('loading.gif');?>
        </div>
        <?php if($comment->getOwnerReply()):?>
          <?php echo $comment->getReplyTime().' 主人回复：<br/>';?>
          <div class="replybody" id="<?php echo 'rct'.$comment->getId();?>">
            <?php echo nl2br($comment->getOwnerReply());?>
          </div>
        <?php endif;?>
        </div> 
        </td>
        <?php if($commentowner):?>
          <?php echo input_in_place_editor_tag('b'.$comment->getId(), 
            'show/editcomment?id='.$comment->getId(), array(
            'cols'        => 80,
            'rows'        => 10,
            'save_text'=>'保存修改',
            'cancel_text'=>'放弃修改'
          )) ?>
        
      <?php endif;?>
    </tr>
  <?php endforeach;?>
  </table>
  <?php if($sf_user->getAttribute('id')):?>
    <?php echo form_tag('show/addcomment?category=1','method=post')?>
    <table id="last">
      <?php echo $commentForm?>
      <tr><td colspan="2">
        <input type="hidden" name="id" value="<?php echo $jobid;?>" />
        <?php echo submit_tag('提交');?>
      </td></tr>
    </table>
  <?php else:?>
    请先<a href="#signup">登陆</a>才可以留言
  <?php endif;?>
</form>
</div>
