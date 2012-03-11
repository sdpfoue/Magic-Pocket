<?php $url=$sf_request->getParameter('module').'/'.$sf_request->getParameter('action');?>
<div style="width=100; text-align:center; margin-top:10px;"> 
  <?php if ($pager->haveToPaginate()): ?>
    <div class="pagination">
      <a href="<?php echo url_for($url).$sf_data->getRaw('query');?>">
        <?php echo image_tag('first.png', 'alt=第一页 title=第一页') ?>
      </a>
   
      <a href="<?php echo url_for($url.'?page='.$pager->getPreviousPage()).$sf_data->getRaw('query') ?>">
        <?php echo image_tag('previous.png', 'alt=上一页 title=上一页') ?>
      </a>
     &nbsp;
      <?php foreach ($pager->getLinks() as $page): ?>
        <?php if ($page == $pager->getPage()): ?>
          <?php echo $page ?>
        <?php else: ?>
          <a href="<?php echo url_for($url.'?page='.$page).$sf_data->getRaw('query') ?>"><?php echo $page ?></a>
        <?php endif; ?>&nbsp;
      <?php endforeach; ?>
     
          
  
      <a href="<?php echo url_for($url.'?page='.$pager->getNextPage()).$sf_data->getRaw('query') ?>">
        <?php echo image_tag('next.png', 'alt=下一页 title=下一页') ?>
      </a>
     
      <a href="<?php echo url_for($url.'?page='.$pager->getLastPage()).$sf_data->getRaw('query')?>">
        <?php echo image_tag('last.png', 'alt=最后一页 title=最后一页') ?>
      </a>
    </div>
  <?php endif;?>
</div>
