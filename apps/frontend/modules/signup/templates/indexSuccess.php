<?php slot('header');?>
  <?php echo javascript_include_tag('jquery'); ?>
  <?php echo javascript_include_tag('jquery.validate') ;?>
  <?php use_stylesheet('validate'); ?>
  
<?php end_slot();?>

<?php use_helper('Form') ?>

<?php slot('search'); ?>
  <?php echo ' ';?>
<?php end_slot(); ?>

<?php slot('nav1'); ?>
  <?php echo '新用户快速注册';?>
<?php end_slot(); ?>


<?php slot('signup'); ?>
  <div>
    <?php echo link_to('返回首页','index/index'); ?>
  </div>
<?php end_slot(); ?>

<?php slot('head'); //for head ?>
  <?php echo javascript_include_tag('jquery','jquery.validate.js') ?>
<?php end_slot(); ?>

<?php slot('title'); //for title ?>
    <?php echo '快速注册 - '; ?>
<?php end_slot(); ?>

<script type="text/javascript">
$(document).ready(function() {
	// validate signup form on keyup and submit
	var validator = $("#signupform").validate({
		rules: {
			"signup[name]": {
				required: true,
				minlength: 4,
				remote: "<?php echo url_for('signup/users',true);?>"
			},
			"signup[password]": {
				required: true,
				minlength: 6
			},
			"signup[conpwd]": {
				required: true,
				minlength: 6 ,
				equalTo: "#signup_password"
			}
		},
		messages: {
			"signup[name]": {
				required: "请输入用户名",
				minlength: jQuery.format("用户名最少要{0}位"),
				remote: jQuery.format("用户名已经被注册")
			},
			"signup[password]": {
				required: "请输入密码",
				minlength: jQuery.format("密码至少要{0}位")
			},
			"signup[conpwd]": {
				required: "请重复密码",
				minlength: jQuery.format("密码至少要{0}位"),
				equalTo: "两次密码不一致，请检查"
			}
		},
		// the errorPlacement has to take the table layout into account
		errorPlacement: function(error, element) {
			
				error.appendTo( element.parent() );
		},
		// specifying a submitHandler prevents the default submit, good for the demo
		
		// set this class to error-labels to indicate valid fields
		success: function(label) {
			// set &nbsp; as text for IE
			label.html("&nbsp;").addClass("checked");
		}
	});
});
</script>
<?php echo form_tag('signup/index','method=post class=Signup align=center id=signupform')?> 

  <table align="center" class="sinf">

    <?php echo $form ?>
    <tr>
      <td colspan="2" align="center" style="text-align:center;">
        <span style="font-size:15px;"><?php echo link_to('使用协议','index/agreement',array('target'=>'_blank'));?></span><br/><br/>
        <input type="submit" value="我已经仔细阅读并同意使用协议，提交"  />
      </td>
    </tr>

  </table>
</form>

