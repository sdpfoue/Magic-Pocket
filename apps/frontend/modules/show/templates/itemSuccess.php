<?php use_helper('Javascript') ?>
<?php use_helper('Form');?>
<?php slot('title');?>
  <?php echo $title.' - ';?>
<?php end_slot(); ?>
<?php slot('nav'); ?>
  <?php echo ' ';?>
<?php end_slot(); ?>
<?php $img='http://localhost/apus/web/uploads/item/'; //布置后需要更改 ?>
<h1><?php echo $item->getItemName(); ?></h1>
<div>
  <span class="mn"><?php echo $item->getCreatedAt();?></span>
  <span class="pl2">来自：
    <?php echo link_to($item->getUser(),'user/item?id='.$item->getUserId());?>
  </span>
  <span class="pl2">
    分类：<?php echo $item->getCategory();?>
  </span>
  <span class="pl2">
    价格：<?php echo $item->getItemPrice();?>
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
  <?php if($item->getPicNumber()):?>
  <div style="width:100%;text-align:center;" class="display">
    <?php 
      if($item->getPic1())
      echo link_to(image_tag('../uploads/item/'.$item->getPic1()),$img.$item->getPic1(),array('popup'=>array('popWindow','width=300,height=300,left=320,top=0')));
      echo '&nbsp;&nbsp;&nbsp;';
      
      if($item->getPic2())
      echo link_to(image_tag('../uploads/item/'.$item->getPic2()),$img.$item->getPic2(),array('popup'=>array('popWindow','width=300,height=300,left=320,top=0')));
      echo '&nbsp;&nbsp;&nbsp;';
      
      if($item->getPic3())
      echo link_to(image_tag('../uploads/item/'.$item->getPic3()),$img.$item->getPic3(),array('popup'=>array('popWindow','width=300,height=300,left=320,top=0')));
      echo '&nbsp;&nbsp;&nbsp;';
      
      if($item->getPic4())
      echo link_to(image_tag('../uploads/item/'.$item->getPic4()),$img.$item->getPic4(),array('popup'=>array('popWindow','width=300,height=300,left=320,top=0')));
      
      ?>
      
  </div>
  <?php endif?>
  <div style="margin:15px 10px;">
    <?php if($item->getLink()):?>
    <span style="font-weight:bold;"> 
        参考链接：<a href="<?php echo $item->getLink();?>" target="_blank">
          <?php echo myUser::cutword($item->getLink(),50); ?>
        </a>
    </span><br/><br/>
    <?php endif;?>
    <?php echo nl2br($item->getItemDetail());?>
  </div>
  <div style="text-align:right; font-size:14px;">
    留言：<?php echo $item->getCommentNumber();?>&nbsp;&nbsp;&nbsp;
    <?php if($owner):?>
      
      浏览：<?php echo $item->getViewed();?>&nbsp;&nbsp;&nbsp;
      <?php echo link_to(image_tag('edit.png').'编辑此页面','post/edititem?id='.$item->getId());?>
      
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
          'show/delitemcomment?id='.$comment->getId(),
          array('confirm'=>'确定删除吗?'));?>
        <?php if($owner):?>&nbsp;&nbsp;&nbsp;
          <?php echo link_to_remote((image_tag('new.png')).'回复/'.
              image_tag('edit.png').'修改回复',
               array(
              'update'    => 'r'.$comment->getId(),
              'url'       => 'show/replyitemcomment?id='.$comment->getId(),
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
            'show/edititemcomment?id='.$comment->getId(), array(
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
    <?php echo form_tag('show/additemcomment','method=post')?>
    <table id="last">
      <?php echo $commentForm?>
      <tr><td colspan="2">
        <input type="hidden" name="itemid" value="<?php echo $itemid;?>" />
        <?php echo submit_tag('提交');?>
      </td></tr>
    </table>
  <?php else:?>
    请先<a href="#signup">登陆</a>才可以留言
  <?php endif;?>
</form>
</div>
