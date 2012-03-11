<?php echo image_tag('arrow.gif');?> 
  <span style="font-size:16px;color:green;">用户 <?php echo $user->getName();?> 的历史发布</span>
<br/><br/>
<div class="search">
  用户资料：<br/>
  Email：<?php echo $user->getEmail();?><br/>
  手机：<?php echo $user->getMobile();?><br/>
  QQ：<?php echo $user->getQq();?><br/>
  MSN：<?php echo $user->getMsn();?><br/>
  注册日期：<?php echo $user->getCreatedAt();?><br/><br/>
  <?php if($sf_user->getAttribute('id')!=$user->getId()&&
              $sf_user->isAuthenticated()):?>
            
            <span class='ico'><?php echo image_tag('envelope.gif');?><?php echo link_to('发送消息',
              'message/send?id='.$user->getId());?></span>
          <?php endif; ?>
          <?php if(!$sf_user->getAttribute('id')):?>
          
            <span class='ico'><?php echo image_tag('envelope.gif');?>
            <a href="#signup" onclick="return confirm('请您先登陆，才可以发送站内信');">发送消息</a></span>
          <?php endif;?>
</div>
<br/>
<?php echo link_to('返回首页','index/index');?>

<?php if($user->getId()==22):?>
<span style="fond-weight:bold;">
<br/><br/>
说明：<br/>
  　　该账号所发布信息大部分从网络收集，网站初期充实内容之用，若侵犯了你的权利，请发邮件到xxxx@xxx.xxx通知，我将第一日间将信息删除。
</span>
<?php endif;?>
