<table style="width:100%; background:#EEF9EB;" class="olt">
    <thead style=" ">
      <tr>
        <th style="text-align:left;">书名</th>
        
        <th>价格</th>
        <th>上次提升时间</th>
        <th>是否可以提升</th>
        <th>当前状态</th>
        <th>浏览</th>
        <td>留言(新)</th>
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($iList as $item): ?>
      <tr >
        <td style="text-align:left;">
          <?php if(strlen($item->getTitle())>$titLen) 
            $title=mb_substr($item->getTitle(),0,$titLen,'utf-8').'...';
            else $title=$item->getTitle(); ?>
          <?php echo link_to($title,'show/book?id='.$item->getId(),
            array('title'=>$item->getTitle()))?>          
        </td>
        
        <td ><?php echo $item->getPrice(); ?></td>
        <td style="width:115px;" ><?php echo $item->getLastprompt(); ?></td>
        <td td style="width:100px;" >
          <?php 
            $differ=(time()-strtotime($item->getLastprompt())); //距上次提升的时间
            if($differ>72000) //超过20小时
              echo link_to('提升','post/promptbook?id='.$item->getId()); 
            else
            {
              $remain=72000-$differ;
              echo '还有'.(int)($remain/3600).'小时'.
                (int)((($remain/3600)-(int)($remain/3600))*60).
                '分钟';
            }
            
          ?>
        </td>
        <td style="width:53px;" >
          <?php if($item->getIssold()==1) echo link_to('已售出','post/changestbook?id='.$item->getId());
            else echo link_to('未出售','post/changestbook?id='.$item->getId()); ?>
        </td>
        <td>
          <?php echo $item->getViewed();?>
        </td>
        <td>
          <?php echo $item->getCommentNumber();?>
          <?php if($item->getNewCommentNumber()) echo '('.$item->getNewCommentNumber().')';?>
        </td>
        <td style="width:10px;" >
          <?php echo link_to(image_tag('edit.png',array('alt'=>'编辑','title'=>'编辑')),'post/editbook?id='.$item->getId()); ?>
        </td>
        <td style="width:10px;" >
          <?php echo link_to(image_tag('delete.png',array('alt'=>'删除','title'=>'删除')),'post/delbook?id='.$item->getId(),
            array('confirm'=>'确定删除此信息吗？您可以选择已售，信息仍然保留')); ?>
        </td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php  include_partial('global/page',array('pager'=>$pager)); ?> 
