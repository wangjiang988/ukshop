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
<title>找回密码</title>
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
			<i onClick="javascript:history.go(-1);" class="icon-arrow-left"></i>
		</div>
		<div class="top-hk-div">
			找回密码
		</div>
		<div class="headerRight">
			
		</div>
	</div>
</header>
<div id="content" class="p_bottom">
	<form action="" id="login_check" method="get">
		<div class="check_login">
			<input type="email" id="member_email" name="member_eamil" value="" placeholder="请输入注册时绑定的邮箱"/>
		</div>
			<input type="password" id="email_code" name="email_code" value="" maxlength="4" placeholder="验证码"/>
			<a href="javascript:void(0);" class="get-code">获取验证码</a>
		<div class="check_submit">
			<input class="check_submit_1 not_click" type="button" value="下一步" />
		</div>
	</form>
	<input name="nchash" id="nchash" type="hidden" value="" />
	<input type="hidden" name="member_id" id="member_id" value=""/>
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/zepto.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/carousel-image.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/common.js"></script>
<script type="text/javascript">
$(function(){
	$('.all_foot').hide();
	//发送验证码
	$('.get-code').click(function(){
		if($(this).hasClass('no-get-code')){return;}
		var email = $('#member_email').val();
		if(email == ''){
			showError('请输入绑定的邮箱');
		}
		$.getJSON('index.php?act=seccode&op=wap_makecode', {email:email}, function (data){
			if(data.state){
				showDialog('验证码已成功发送至您的邮箱，请在三十分钟内完成验证。');
				$('.check_submit_1').removeClass('not_click');
				$('#nchash').val(data.msg);
				$('#member_id').val(data.member_id);
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
				showError(data.msg)
			}
		});
	});
	//下一步并验证验证码
	$('.check_submit_1').click(function(){
		if($(this).hasClass('not_click')){return;}
		var captcha = $("#email_code").val();
		if(captcha == ''){showError('请输入验证码');return;}
		if(captcha.length < 4){showError('验证码不正确，请重新验证');return;}
		$.getJSON('index.php?act=seccode&op=wap_check', {captcha:captcha, nchash:$('#nchash').val()}, function(data){
			if(data.state){
				window.location.href = data.msg+'&member_id='+$('#member_id').val();
			}else{
				showError(data.msg);
			}
		});
	});
});
</script>
</body>
</html>