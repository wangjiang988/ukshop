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
	<title>优康_设置</title>
	<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/main.css" type="text/css" media="all">
	<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/per_center.css" type="text/css" media="all">
</head>

<body style="background:#F5F5F5;">
	<!--顶部-->
	<header id="header">
		<div class="header_con">
		<div class="headerleft">
			<a href="index.php?act=wap_member"><i class="icon-arrow-left"></i></a>
		</div>
			<div class="top-tit-div">
				设置
			</div>

			<div class="headerRight">
				
			</div>
		</div>
	</header>
	<!--顶部结束-->

	<div id="content" class="p_bottom_b" style="background:#F5F5F5;">
		<div class="per_center_list_1">
			<ul>
				<a href="index.php?act=wap_member_setting&op=account"><li><span>个人资料</span><img src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/order_right.png"></li></a>
				<a href="index.php?act=wap_member_setting&op=memberAccountNumber"><li><span>账号与安全</span><img src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/order_right.png"></li></a>
				<a href="index.php?act=wap_member_address&op=address_list"><li><span>地址管理</span><img src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/order_right.png"></li></a>
			</ul>
		</div>
		<div class="per_center_list_2">
			<ul>
				<li><span>帮助与反馈</span><img src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/order_right.png"></li>
			</ul>
		</div>
		<div class="manage_new_add"><a href="index.php?act=wap_login&op=login_out">退出当前帐号</a></div>
	</div>
	<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/zepto.js"></script>
	<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/carousel-image.js"></script>
	<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/common.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.all_foot').hide();
});
</script>
