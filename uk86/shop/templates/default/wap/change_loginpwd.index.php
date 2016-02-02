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
<title>优康_修改登录密码</title>
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/base.css" type="text/css" media="all">
<style type="text/css">
.content{width:5.4rem; margin:0.8rem auto; color:#454545; line-height:0.6rem; font-size:0.3rem;}
.content dl dt{width:1.4rem; float:left;}
.content dl:last-child dt{width:1.8rem;}
.content dl dd{height:0.6rem;}
.pay_pwd{width:3.9rem; height:0.5rem; line-height:0.4rem; margin-left:0rem; border-bottom:0.02rem solid #DEDEDE;}
#pwd2{width:3.5rem;}
.submit_pwd{display:inline-block; width:4.6rem; border-radius:0.1rem; text-align:center; line-height:0.6rem; background:#Ef5557; font-size:0.32rem; margin-left:0.9rem;}
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
		<span>修改登录密码</span>
	</div>
	<div class="headerRight">
	</div>
</div>
</header>
<div id="content" class="p_bottom" style="background: #FFF">
  <div class="content">
    <dl>
      <dt>原密码：</dt><dd><input type="password" class="pay_pwd" id="old_pwd"/></dd>
    </dl>
    <dl>
      <dt>新密码：</dt><dd><input type="password" class="pay_pwd" id="pwd1" maxlength="18"/></dd>
    </dl>
    <dl>
      <dt>确认新密码：</dt><dd><input type="password" class="pay_pwd" id="pwd2" maxlength="18"/></dd>
    </dl>
  </div>
  <a class="submit_pwd hovered" href="javascript:void(0);">提&nbsp;&nbsp;交</a>
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/zepto.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/carousel-image.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/common.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.all_foot').hide();
	$('.submit_pwd').on('click', function(){
		var old_pwd = $('#old_pwd').val();
		var new_pwd = $('#pwd1').val();
		var new_pwd1 = $('#pwd2').val();
		//表单验证
		if(old_pwd == ''){showError('请输入原密码，否则不能修改密码。');return;}
		if(new_pwd.length < 6){	showError('密码长度不得小于6');return;}
		if(new_pwd != new_pwd1){showError('两次密码输入不一致');return;}
		$.post('index.php?act=wap_member_change&op=changLoginPwd', {old_pwd:old_pwd, new_pwd:new_pwd, sumbmit:'ok'}, function(msg){
			if(msg > 0){
				showDialog('登录密码修改成功', '', 'index.php?act=wap_member_setting&op=memberAccountNumber');
			}else if(msg == 0){
				showError('原密码输入错误，请重新输入');
			}else{
				showError('密码修改失败，请联系管理员');
			}
		});
	});
});
</script>
</body>
</html>