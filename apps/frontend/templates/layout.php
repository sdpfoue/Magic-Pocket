<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head> 
	  <script type="text/javascript">

  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-8816834-2']);
  _gaq.push(['_setDomainName', '.tjsweb.info']);
  _gaq.push(['_trackPageview']);

  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();

</script>

    <?php include_http_metas() ?>
    <?php include_metas() ?>
    <?php use_helper('Form') ?>
    <?php //include_title() ?>
    <link rel="shortcut icon" href="/favicon.ico" />
    <title><?php include_slot('title') ?>神奇口袋</title>
    <?php include_slot('head') ?>
  </head>
  <body align="">
  <div style="width:960px;; margin:auto;">
        
    <div id="banner" align="center">
      <?php
        echo link_to(image_tag('banner.jpg'),'index/index');
      ?>
    </div>
    <div class="clear"></div>
    <div style="font-size:12px; font-weight:bold; margin-left:20px; width:100% " >
     <div style="float:left; width:40%;">     
        
       <?php if (!include_slot('signup')): ?>
        <?php if($sf_user->isAuthenticated()): ?>
          <?php echo '欢迎 '.$sf_user->getAttribute('name'); ?>
          <?php echo '  '.link_to('退出','sign/logout'); ?>
        <?php else: ?>
          <?php echo form_tag('sign/login','method=post id=signup'); ?>
                用户名: <input type="text" maxlength="20" id="uname" name="uname" style="background-color:#EFEFEF;"/>
                密码: <input type="password" maxlength="15" id="pwd" name="pwd" style="background-color:#EFEFEF;"/> 
                <input type="hidden" name="url" value="<?php echo $sf_request->getParameter('url')?>"/>
            <?php echo submit_tag('登陆') ?>
            <?php echo button_to('快速注册','signup/index'); ?> 
          </form>
        <?php endif; ?>
       <?php endif; ?>
      </div>
      <?php if (!include_slot('search')): ?>
        <div style="float:left;width:50%;text-align:right;padding-right:10px;">
         <?php if($sf_user->isAuthenticated()): ?>
            <?php include_component('message','newmessage',array('user'=>$sf_user));?> 
            <?php echo link_to('个人中心','setting/index'); ?> &nbsp;&nbsp;
            <?php echo link_to('发布管理','post/index'); ?>
          <?php else:?>  
            <a href="#signup" onclick="return confirm('请您先登陆，再进行发布信息管理');">发布管理</a>
          <?php endif; ?>
          
        </div>
      <?php endif; ?>
      <div style="float:left; width:100%;">
        <?php if (!include_slot('nav')): ?>当前位置 >><?php endif; ?>
        <?php include_slot('nav1') ?>
      </div>
    </div>
    <div style="clear:both;" ></div>
     <div id="mainBody" >
        <div id="content">
          <?php echo $sf_data->getRaw('sf_content'); ?>
        </div>
        <div id="rightbar">
          <?php if (!include_slot('rightbar')): ?>
           <!-- RIGHT BAR -->
           
           
          <?php endif; ?>
        </div>
     </div>
            

<div style="clear:both;" ></div>
    <div id="footer">
      <a href="<?php echo url_for('index/about');?>">关于口袋</a> | 
      <a href="#">bug报告</a> | 
      <a href="#">我的建议</a> | 
      <a href="<?php echo url_for('index/agreement');?>">使用协议</a> |
      <a href="#">网站地图</a> | 
      <a href="#">官方博客</a><br/>
      magicpocket.info  All rights reserved. 2009 
    </div>

  </div>
  </body>
</html>
