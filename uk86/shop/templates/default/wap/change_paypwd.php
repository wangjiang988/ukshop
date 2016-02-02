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
<title>优康_安全校验</title>
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/base.css" type="text/css" media="all">
<style type="text/css">
.icon-line-height{display:inline-block; height:0.4rem; margin-bottom:0rem; width:0rem; border:0.02rem solid #FFF; border-right-color:#CCC; position:relative; top:0.1rem;}
.bd_div_input{padding:0.12rem 0.25rem;}
.get_code{color:#71ACDA !important; font-size:0.3rem !important;}
a:link, a:visited, a:active, a:hover{color:#AAA; font-size:0.25rem;}
.set-time{display:inline-block; width:2rem; text-align:center;}
.select{margin-left:0.4rem; min-width:4rem; color:#999; font-size:0.3rem; height:0.5rem;}
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
		<span>安全校验</span>
	</div>
	<div class="headerRight">
		
	</div>
</div>
</header>
<!--顶部结束-->
<div id="content" class="p_bottom" style="background: #F5F5F5">
	<div style="width: 100%; height:0.2rem;"></div>
	<span style="font-size:0.3rem; line-height:0.6rem; color:#686868;">&nbsp;&nbsp;&nbsp;&nbsp;请选择校验码接收方式：</span><br>
	<select class="select">
		<option value="">--请选择--</option>
		<?php foreach ($output['member_info'] as $k => $v){ ?>
		<option value="<?php echo $v['value']; ?>"><?php echo $v['type']; ?></option>
		<?php } ?>
	</select>
	<div class="bd_div_input">
	 <span style="font-size:0.32rem;">校验码</span>&nbsp;&nbsp;<input style="width:2.5rem; marign-top:-0.1rem; height:0.6rem; line-height:0.6rem;" type="number" placeholder="校验码" class="number"/>
    	<i class="icon-line-height"></i>
    	<a href="javascript:void(0);" class="set-time get_code">发送校验码</a>
	</div>
	<input type="button" class="bd_submit" value="下一步" />
</div>
</body>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/zepto.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/carousel-image.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/common.js"></script>
<script type="text/javascript">
$(function(){
	$('.all_foot').hide();
	//发送验证码
	$('.set-time').click(function(){
		if($(this).hasClass('get_code')){
			var value = $('.select').val();
			if(value == ''){
				showError('请选择校验码接收方式');
				return false;
			}
			$(this).removeClass('get_code');
			$(this).html('正在获取校验码');
			$.getJSON('index.php?act=wap_member_change&op=getCodeByPaypwd', {value:value}, function(data){
				if(data.state){
					showDialog(data.msg);
					var s = 60;
					var x = setInterval(function(){
						if(s <= 0){
							clearInterval(x);
							$('.set-time').addClass('get_code');
							$('.set-time').html('发送校验码');
						}else{
							$('.set-time').html(s+'秒后重新获取');
						}
						s--;
					}, 1000);
				}else{
					showError(data.msg);
					$('.set-time').addClass('get_code');
					$('.set-time').html('发送校验码');
				}
			});
		}
	});
	//下一步并验证验证码
	$('.bd_submit').click(function(){
		var code = $('.number').val();
		if(code == ''){
			showError('请输入校验码');
			return false;
		}
		$.getJSON('index.php?act=wap_member_change&op=sendCodeByPaypwd', {code:code}, function(data){
			if(data.state){
				showDialog(data.msg, '', data.url);
			}else{
				showError(data.msg);
			}
		});
	});
})
</script>
</html>