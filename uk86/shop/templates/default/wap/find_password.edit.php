<?php defined('InUk86') or exit('Access Invalid!');?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta id="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
<meta name="apple-themes-web-app-capable" content="yes">
<meta content="yes" name="apple-mobile-web-app-capable">
<meta content="black" name="apple-mobile-web-app-status-bar-style">
<meta content="telephone=no" name="format-detection">
<meta content="email=no" name="format-detection">
<meta name="format-detection" content="telephone=no">
<title>修改密码</title>
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/base.css" type="text/css" media="all">
</head>
<body>
<!--顶部-->
<header id="header">
	<div class="header_con">
		<div class="headerleft">
			<a href="index.php?act=wap_login&op=login"><i class="icon-arrow-left"></i></a>
		</div>
		<div class="top-hk-div">
			修改密码
		</div>
		<div class="headerRight">
			
		</div>
	</div>
</header>
<!--顶部结束-->
<div id="content" class="p_bottom">
	<form action="" id="login_check" method="get">
		<div class="check_login">
			<div class="check_login_1"><input type="password" id="new_password" name="new_password" value="" placeholder="请输入新密码"/></div>
			<div><input type="password" id="member_password" name="member_password" value="" placeholder="确认新密码"/></div>
		</div>
		<div class="check_submit">
			<input class="check_submit_1" type="button" value="提交" />
			<input type="hidden" id="member_id" value="<?php echo $_GET['member_id']; ?>">
		</div>
	</form>
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/zepto.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/carousel-image.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/common.js"></script>
<script type="text/javascript">
$(function(){
	$('.all_foot').hide();
	$('.check_submit_1').click(function(){
		var new_password = $('#new_password').val();
		var password_again = $('#member_password').val();
		//验证
		if(new_password == ''){
			showError('请输入新密码。');
			$('#new_password').fucus();
			return;
		}
		if(new_password.length < 6){
			showError('密码长度至少为6位。');
			return;
		}
		if(password_again != new_password){
			showError('两次密码输入不一致，请重新输入。');
			return ;
		}
		$.post('index.php?act=wap_login&op=edit_password', {member_id:$('#member_id').val(), password:new_password}, function(msg){
			if(msg){
				showDialog('密码修改成功！', 2, 'index.php?act=wap_login&op=login');
			}else{
				showError('修改密码失败！');
			}
		});
	});
});
</script>
</body>
</html>
		
		
		
		
		