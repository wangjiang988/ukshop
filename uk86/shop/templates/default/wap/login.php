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
<title>登录</title>
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/base.css" type="text/css" media="all">
</head>
<body>
<!--顶部-->
<header id="header">
	<div class="header_con">
		<div class="headerleft">
			
		</div>
		<div class="top-hk-div">
			登录
		</div>
		<div class="headerRight">
			
		</div>
	</div>
</header>
<!--顶部结束-->
<div id="content" class="p_bottom">
	<form action="" id="login_check" method="get">
		<div class="check_login">
			<div class="check_login_1"><input type="text" id="member_name" name="member_name" value="" placeholder="用户名"/></div>
			<div><input type="password" id="member_password" name="member_password" value="" placeholder="请输入密码"/></div>
		</div>
		<div class="login_link"><a href="index.php?act=wap_login&op=find_password">忘记密码？</a><a class="login_link_right" href="#">我是商家</a></div>
		<div class="check_submit">
			<input class="check_submit_1" type="button" value="登录" />
			<a href="index.php?act=wap_login&op=register"><input class="check_submit_2" type="button" value="注册" /></a>
			<input type="hidden" id="server_url" value="<?php echo $_GET['url']?$_GET['url']:uk86_getReferer(); ?>" />
		</div>
	</form>
	<div class="login_line"><div>第三方账号快速登录</div></div>
	<div class="ort_login">
		<div class="list_ort_login">
			<ul>
				<li><dl><dt><a href="#"><img src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/weibo_login.png"></a></dt><dt class="login_name">微博</dt></dl></li>
				<li><dl><dt><a href="<?php echo SHOP_SITE_URL;?>/api.php?act=toqq"><img src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/qq_login.png"></a></dt><dt class="login_name">QQ</dt></dl></li>
				<li><dl><dt><a href="<?php echo SHOP_SITE_URL . '/index.php?act=wxuser&op=wxlogin'; ?>"><img src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/weixin_login.png"></a></dt><dt class="login_name">微信</dt></dl></li>		
			</ul>
		</div>
	</div>
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/zepto.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/carousel-image.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/common.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.all_foot .home_foot a').removeClass('icon-bot-c');
	$('#member_name').focus(function(){
		$('#member_name').attr('placeholder', '用户名');
		$('#member_name').css('color', '#AAA');
	});
	$('#member_password').focus(function(){
		$('#member_password').attr('placeholder', '请输入密码');
		$('#member_password').css('color', '#AAA');
	});
	
	$('.check_submit_1').click(function(){
		if($('#member_name').val() == ''){
			$('#member_name').attr('placeholder', '请输入用户名');
			$('#member_name').css('color', 'red');return;
		}
		if($('#member_password').val() == ''){
			$('#member_password').css('color', 'red');return;
		}
		$.post('index.php?act=wap_login&op=login_action', {member_name:$('#member_name').val(), member_password:$('#member_password').val()}, function(data){
			var dataJson = eval('(' + data + ')');
			if(dataJson.success == '1'){
				showDialog('登录成功', 2, $('#server_url').val());
			}else{
				showError('用户名或密码错误', 2);
			}
		});
	});
	window.sessionStorage.setItem('ref_url', $('#server_url').val());
});
</script>
