<table style="width:70%; background:#EEF9EB;" class="olt">
    <thead style=" ">
      <tr>
        <th style="text-align:left;">物品名称</th>
        
        <th >是否购得</th>
        <th>浏览</th>
        
        <th>&nbsp;</th>
        <th>&nbsp;</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($iList as $item): ?>
      <tr>
        <td style="text-align:left;">
          <?php if(strlen($item->getName())>$titLen) 
            $title=mb_substr($item->getName(),0,$titLen,'utf-8').'...';
            else $title=$item->getName(); ?>
          <?php echo link_to($title,'show/wanted?id='.$item->getId(),
            array('title'=>$item->getName()))?>          
        </td>

       
        
        <td style="width:53px;">
          <?php if($item->getIssold()==1) echo link_to('已购得','post/changestwanted?id='.$item->getId());
            else echo link_to('未购得','post/changestwanted?id='.$item->getId()); ?>
        </td>
        <td style="width:30px;">
          <?php echo $item->getViewed();?>
        </td>
        <td style="width:15px;">
          <?php echo link_to(image_tag('edit.png',array('alt'=>'编辑','title'=>'编辑')),
            'post/editwanted?id='.$item->getId()); ?>
        </td>
        <td style="width:15px;"><?php echo link_to(image_tag('delete.png',array('alt'=>'删除','title'=>'删除')),'post/delwanted?id='.$item->getId(),
          array('confirm'=>'确定删除此信息吗？您可以选择已售，信息仍然保留')); ?></td>
      </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
  <?php  include_partial('global/page',array('pager'=>$pager)); ?> 
