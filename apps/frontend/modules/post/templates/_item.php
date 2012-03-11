<table style="width:100%; background:#EEF9EB; padding:0px;" class="olt">
    <thead style=" ">
      <tr>
        <th style="text-align:left;">名称</th>
        
        <th>价格</th>
        <th>图片数</th>
        <th>是否可以提升</th>
        <th>当前状态</th>
        <th>浏览</th>
        <th>留言(新)</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($iList as $item): ?>
      <tr>
        <td style="text-align:left;">
          <?php if(strlen($item->getItemName())>$titLen) 
            $title=mb_substr($item->getItemName(),0,$titLen,'utf-8').'...';
            else $title=$item->getItemName(); ?>
          <?php echo link_to($title,'show/item?id='.$item->getId(),
            array('title'=>$item->getItemName()))?>          
        </td>
        
        <td><?php echo $item->getItemPrice(); ?></td>
        <td style="width:40px; text-align:center;"><?php echo $item->getPicNumber();?></td>
        
        <td td style="width:100px;">
          <?php 
            $differ=(time()-strtotime($item->getLastprompt())); //距上次提升的时间
            if($differ>72000) //超过20小时
              echo link_to('提升','post/prompt?id='.$item->getId()); 
            else
            {
              $remain=72000-$differ;
              echo '还有'.(int)($remain/3600).'小时'.
                (int)((($remain/3600)-(int)($remain/3600))*60).
                '分钟';
            }
            
          ?>
        </td>
        <td style="width:53px;text-align:center;">
          <?php if($item->getIssold()==1) echo link_to('已售出','post/changest?id='.$item->getId());
            else echo link_to('未出售','post/changest?id='.$item->getId()); ?>
        </td>
        <td style="width:30px;text-align:center;"><?php echo $item->getViewed() ?></td>
        <td style="width:50px;text-align:center;">
          <?php echo $item->getCommentNumber() ?>
          <?php if($item->getNewCommentNumber()) echo '('.$item->getNewCommentNumber().')'?>
        </td>
        <td style="width:15px;"><?php echo link_to(image_tag('edit.png',array('alt'=>'编辑','title'=>'编辑')),'post/edititem?id='.$item->getId()); ?></td>
        <td style="width:15px;"><?php echo link_to(image_tag('delete.png',array('alt'=>'删除','title'=>'删除')),'post/delitem?id='.$item->getId(),
          array('confirm'=>'确定删除此信息吗？您可以选择已售，信息仍然保留')); ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>


<?php  include_partial('global/page',array('pager'=>$pager)); ?> 
  

