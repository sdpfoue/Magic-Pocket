<?php use_helper('Form');?>
<?php slot('title');?>
  物品信息- 
<?php end_slot();?>

<table style="width:100%; background:#EEF9EB;" class="display" >
  <?php foreach ($iList as $item): ?>
    
      <tr>
        <?php if($item->getPicNumber()):?>
          <td rowspan="2" >
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
        <td class="bottomdash" style="width:150px;"><?php echo $item->getCreatedAt();?></td>
        <td class="bottomdash">
          发布人：<?php echo link_to($item->getUser(),'user/item?id='.$item->getUserId());?>
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
        <td class="bottomdash" style="width:50px;">
         <span style="margin-right:0;">留言：<?php echo $item->getCommentNumber();?></span>
        </td>
      </tr>   
  <?php endforeach; ?>
</table>


<?php if(!$iList->count()):?>
  <?php include_partial('noitem');?>
<?php endif;?>

<?php  include_partial('page',array('pager'=>$pager,'query'=>$query)); ?> 

<?php slot('rightbar');?>
<?php echo image_tag('rss.gif');?>
<a href="<?php echo url_for('feeds/item')?><?echo $query?>">订阅当前结果</a>
<div class="search">
  <?php echo form_tag('index/item','method=get id=search1 name=search1');?>
    当前城市<br/>    
    <?php echo $form['city']->render();?>  <br/>
    选择分类<br/>
    <?php echo $form['category']->render();?><br/>
    关键字<br/>
    <?php echo $form['keyword']->render();?><br/>
    价格<br/>
    <?php echo $form['pic1']->render();?> ～ 
    <?php echo $form['pic2']->render();?><br/><br/>
    <div style="text-align:center;"><?php echo submit_tag('重置结果');?></div>

  </form>
</div>
<?php end_slot();?>
