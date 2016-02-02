<?php  defined('InUk86') or exit('Access Invalid!');  ?>
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
<title>注册</title>
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/base.css" type="text/css" media="all">
<style type="text/css">
#email_code{width:3rem; height:0.8rem; line-height:0.8rem; border:0.03rem solid #ebebeb; border-radius:0.1rem;
 margin-left:0.3rem; float:left;
}
.get-code{float:left; display:inline-block; margin-left:0.1rem; width:2.65rem; border-radius:0.1rem; background:#12b5b0; line-height:0.74rem;
 text-align:center; border:0.03rem solid #12b590;
}
.no-get-code{background:#CCC !important; border-color:#CCC;}
.check_submit_1{margin-top:1rem;}
.not_click{background-color:#CCC !important;}
</style>
</head>
<body>
<!--顶部-->
<header id="header">
<div class="header_con">
	<div class="headerleft">
		<i class="icon-arrow-left"></i>
	</div>
	<div class="top-hk-div">
		注册
	</div>
	<div class="headerRight">
		
	</div>
</div>
</header>
<!--顶部结束-->
<div id="content" class="p_bottom">
<form action="" id="reg_check" method="get">
<div class="check_login">
	<div class="check_login_1"><input type="text" name="member_name" value="" class="member_name" placeholder="用户名"/></div>
	<div class="check_login_1"><input type="password" name="password" value="" class="password" placeholder="密码"/></div>
	<div class="check_login_1"><input type="password" name="" class="password-again" value="" placeholder="确认密码"/></div>
	<div><input type="text" name="" value="" class="email" placeholder="请输入邮箱地址以获取验证码"/></div>
</div>
<input type="password" id="email_code" name="email_code" value="" maxlength="4" placeholder="验证码"/>
<a href="javascript:void(0);" class="get-code">获取验证码</a>
<div class="check_submit">
	<input class="check_submit_1 not_click" type="button" value="注册" />
</div>
</form>
<input name="nchash" id="nchash" type="hidden" value="" />
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/zepto.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/carousel-image.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/common.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	var check_submit = false;
	var pwd_isok = false;
	var email_isok = false;
	var ref_url = window.sessionStorage.getItem('ref_url');
	if(ref_url == '' || ref_url == undefined){
		ref_url = '/shop/index.php?act=wap_member_setting';
	}
	$('.all_foot .home_foot a').removeClass('icon-bot-c');
	$('.icon-arrow-left').click(function(){
		history.back(-1);
	});

	$('.member_name').focus(function(){
		$('.member_name').attr('placeholder', '用户名');
		$('.member_name').css('color', '#AAA');
	});
	$('.password').focus(function(){
		$('.password').attr('placeholder', '密码');
		$('.password').css('color', '#AAA');
	});
	$('.email').focus(function(){
		$('.email').attr('placeholder', '请输入邮箱地址以获取验证码');
		$('.email').css('color', '#AAA');
	});

	//验证用户名是否已存在
	$('.member_name').blur(function(){
		if($(this).val() == ''){
			$(this).attr('placeholder', '请输入用户名');
			$(this).css('color', 'red');
			check_submit = false;
			return;
		}
		$.post('index.php?act=wap_login&op=check_member', {member_name:$(this).val()}, function(msg){
			if(msg != '' && msg != '\r\n'){
				showError(msg, 2);
				$('.member_name').val('');
				$('.member_name').focus();
				check_submit = false;
			}else{
				check_submit = true;
			}
		});
	});

	$('.password').blur(function(){
		if($(this).val() == ''){
			pwd_isok = false;
			$(this).attr('placeholder', '请输入密码');
			$(this).css('color', 'red');
		}else if($(this).val().length < 6){
			showError('密码长度不小于6位', 2);
			$(this).val('');
			$(this).focus();
			pwd_isok = false;
		}else{
			pwd_isok = true;
		}
	});

	$('.email').blur(function(){
		var reg = /^(\w)+(\.\w+)*@(\w)+((\.\w+)+)$/;
		if($(this).val() == ''){
			email_isok = false;
			$(this).attr('placeholder', '请输入邮箱地址');
			$('.email').css('color', '#F00');
		}else if(!reg.test($(this).val())){
			showError('请输入正确的邮箱地址', 2);
			$(this).focus();
			email_isok = false;
		}else{
			$.get('index.php?act=wap_login&op=checkEmail', {email:$(this).val()}, function(data){
				if(data){
					showError('该电子邮箱已被注册，请更换电子邮箱！');
					$('.email').val('');
					email_isok = false;
				}else{
					email_isok = true;
				}
			});
		}
	});

	//发送验证码
	$('.get-code').click(function(){
		if($(this).hasClass('no-get-code')){return;}
		var email = $('.email').val();
		if(email == ''){
			showError('请输入需要绑定的邮箱');
		}
		$.get('index.php?act=seccode&op=makecode_email', {email:email}, function (data){
			if(data){
				showDialog('验证码已成功发送至您的邮箱，请在三十分钟内完成验证。');
				$('.check_submit_1').removeClass('not_click');
				$('#nchash').val(data);
				$('.get-code').addClass('no-get-code');
				var s = 60;
				var x = setInterval(function(){
					$('.get-code').html(s+'秒后重新发送');
					if(s <= 0){
						clearInterval(x);
						$('.get-code').removeClass('no-get-code').html('获取验证码');
					}
					s--;
				}, 1000);
			}else{
				showError('验证码发送失败！');
			}
		});
	});
	
	$('.check_submit_1').click(function(){
		if($(this).hasClass('not_click')){return false;}
		if(check_submit && pwd_isok && email_isok){
			if($('.password').val() != $('.password-again').val()){
				showError('两次密码输入不一致，请重新确认密码', 2);
				$('.password-again').focus();
				return;
			}
			//验证验证码
			if($(this).hasClass('not_click')){return;}
			var captcha = $("#email_code").val();
			if(captcha == ''){showError('请输入验证码');return;}
			if(captcha.length < 4){showError('验证码不正确，请重新验证');return;}
			$.getJSON('index.php?act=seccode&op=wap_check', {captcha:captcha, nchash:$('#nchash').val()}, function(data){
				if(!data.state){
					showError(data.msg);
					return false;
				}
			});
			$.post('index.php?act=wap_login&op=register_action', {member_name:$('.member_name').val(), password:$('.password').val(), email:$('.email').val()}, function(msg){
				if(msg == 11){
					showDialog('注册成功', 2, ref_url);
				}else{
					showError('系统繁忙，请稍后再试', 2);
				}
			});
		}else{
			showError('请把用户信息填写完整', 2);
		}		
	});
});
</script>
