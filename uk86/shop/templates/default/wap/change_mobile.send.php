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
<title>优康_<?php if(empty($_GET['type'])){ ?>安全校验<?php }else{ ?>绑定手机号<?php } ?></title>
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/base.css" type="text/css" media="all">
<style type="text/css">
input[type="number"]{ line-height:0.6rem; height:0.6rem;border:0.02rem solid #ccc; }
.bd_div_input{padding-left:0.3rem;}
.bd_div_input p{color:#686868; font-size:0.3rem; line-height:0.6rem;}
#mobile{width:3.5rem;}
.bd_div_input a{display:inline-block; width:2.2rem; line-height:0.56rem; position:relative; top:0.04rem; text-align:center; font-size:0.3rem; border:0.02rem solid #BFDAEE; border-bottom-color:#71ACDA; color:#71ACDA}
#verify_code{width:5.84rem; margin-top:0.2rem;}
.bd_div_input a.not_click{background-color:#dedede; border-color:#CCC; color:#585858;}
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
		<span><?php if(empty($_GET['type'])){ ?>安全校验<?php }else{ ?>绑定手机号<?php } ?></span>
	</div>
	<div class="headerRight">
		
	</div>
</div>
</header>
<div id="content" class="p_bottom_b" style="background:#F5F5F5;">
  <div class="bd_div_input">
    <p>绑定<?php if(empty($_GET['type'])){ ?>新<?php } ?>手机：</p>
    <input type="number" id="mobile" placeholder="请输入新手机号码"/>
    <a href="javascript:void(0);">发送校验码</a>
    <input type="number" id="verify_code" placeholder="输入校验码">
  </div>
  <input type="button" class="bd_submit" value="完   成" />
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/zepto.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/carousel-image.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/common.js"></script>
<script type="text/javascript">
$(function(){
	$('.all_foot').hide();
	$('.bd_div_input a').click(function(){
		if($(this).hasClass('not_click')){return false;}
		var mobile = $('#mobile').val();
		if (mobile == '' || mobile.length < 11 || mobile.length > 11){
			showError('请输入正确的手机号码。');
			return false;
		}
		$('.bd_div_input a').html('正在发送校验码');
		$.getJSON('index.php?act=wap_member_change&op=send_sms', {mobile:mobile}, function(data){
			if(data.state){
				showDialog(data.msg);
				$('.bd_div_input a').addClass('not_click');
				var t = 60;
				var x = setInterval(function(){
					$('.bd_div_input a').html(t+'秒后重新发送');
					if(t <= 0){
						clearInterval(x);
						$('.bd_div_input a').html('发送校验码');
						$('.bd_div_input a').removeClass('not_click');
					}
					t--;
				}, 1000);
			}else{
				showError(data.msg);
				$('.bd_div_input a').html('发送校验码');
			}
		});
	});
	$('.bd_submit').click(function(){
		var mobile = $('#mobile').val();
		var code = $('#verify_code').val();
		if(code == ''){
			showError('请输入校验码');
			return false;
		}
		$.getJSON('index.php?act=wap_member_change&op=getSmsCode', {mobile:mobile, code:code}, function(data){
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