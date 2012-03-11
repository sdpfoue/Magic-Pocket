<?php use_helper('Javascript') ?>
<?php use_helper('Form')?>



<div id="notification"></div>
<?php echo periodically_call_remote(array(
    'frequency' => 5,
    'update'    => 'notification',
    'url'       => 'main/test',
    //'with'      => "'param=' + \$F('mycontent')",
)) ?>

<?php include_partial('dk');?>


