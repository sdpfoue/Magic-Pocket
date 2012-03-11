<?php header("refresh:5;url=".$url);?>
<div style="margin:100px;background:#EEF9EB; text-align:center;padding:10px;border:1px solid #CAD9EA; line-height:30px;">
<?php if(!$flag)echo image_tag('error.gif');?><? echo $sf_data->getRaw('message'); ?>

</div>
