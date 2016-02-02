<?php defined('InUk86') or exit('Access Invalid!'); ?>
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
<title>优康_修改邮箱</title>
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/base.css" type="text/css" media="all">
<style type="text/css">
.icon-line-height{display:inline-block; height:0.4rem; margin-bottom:0rem; width:0rem; border:0.02rem solid #FFF; border-right-color:#CCC; position:relative; top:0.1rem;}
.bd_div_input{padding:0.12rem 0.25rem;}
.get_code{color:#71ACDA !important; font-size:0.3rem !important;}
a:link, a:visited, a:active, a:hover{color:#AAA; font-size:0.25rem;}
.set-time{display:inline-block; width:2rem; text-align:center;}
</style>
</head>
<body style="background:#F5F5F5;">
<!--顶部-->
<header id="header">
<div class="header_con">
	<div class="headerleft">
		<a href="index.php?act=wap_member_setting&op=memberAccountNumber"><i class="icon-arrow-left"></i></a>
	</div>
	<div class="top-hk-div">
		<span>修改邮箱</span>
	</div>
	<div class="headerRight">
		
	</div>
</div>
</header>
<!--顶部结束-->
<div id="content" class="p_bottom" style="background: #F5F5F5">
<?php if($_GET['type'] == 1){ ?>
<div style="width: 100%; height:0.3rem;"></div>
    <span style="font-size:0.25rem; line-height:0.6rem; color:#686868;">&nbsp;&nbsp;&nbsp;&nbsp;我们已经发送了校验码到您的手机：</span>
    <p style="font-size:0.4rem; color:#686868; line-height:0.6rem; text-align:center;"><?php echo $output['member_info']['member_mobile'] ?></p>
    <div class="bd_div_input">
    	<span style="font-size:0.32rem;">校验码</span>&nbsp;&nbsp;<input style="width:2.5rem; height:0.6rem; line-height:0.6rem;" type="text" placeholder="校验码" class="number"/>
    	<i class="icon-line-height"></i>
    	<a href="javascript:void(0);" class="set-time">60秒后重新发送</a>
    </div>
    <input type="button" class="bd_submit next_submit" value="下一步" />
<?php }else{ ?>
	<div class="bd_div_input" style="padding:0.25rem 0.5rem;">
		<span>当前绑定邮箱：</span><br>
		<input type="text" class="bd_num_input" value="<?php echo $output['member_info']['member_email'] ?>" readonly placeholder="还没有绑定邮箱" />
	</div>
	<a href="index.php?act=wap_member_change&op=change_email&type=1"><input type="button" class="bd_submit" value="更改绑定邮箱" /></a>
<?php } ?>
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/zepto.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/carousel-image.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/common.js"></script>
<script type="text/javascript">
$(function(){
$('.all_foot').hide();
var s = 59;
var x = setInterval(function(){
	$('.set-time').html(s+'秒后重新发送');
	if(s <= 0){
		clearInterval(x);
		$('.set-time').html('点击发送');
		$('.set-time').addClass('get_code');
	}
	s--;
}, 1000);
$('.set-time').click(function(){
	if($(this).hasClass('get_code')){
		window.location.href="index.php?act=wap_member_change&op=change_email&type=1";
	}
});
//验证验证码，下一步
$('.next_submit').click(function(){
	if($('.number').val() == ''){
		showError('请输入验证码');
		return false;
	}
	var code = $('.number').val();
	$.getJSON('index.php?act=wap_member_change&op=getSmsCodeby', {code:code}, function(data){
		if(data.state){
			showDialog(data.msg, '', data.url);
		}else{
			showError(data.msg);
		}
	});
});
});
</script>
</body>
</html>