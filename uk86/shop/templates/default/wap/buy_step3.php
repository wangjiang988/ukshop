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
<title>优康_支付成功</title>
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/base.css" type="text/css" media="all">
</head>
<body>
<header id="header">
<div class="header_con">
	<div class="headerleft">
		<i></i>
	</div>
	<div class="top-hk-div">
		<span>支付成功</span>
	</div>
	<div class="headerRight">
	</div>
</div>
</header>
<div id="content" class="p_bottom" style="background:#F5F5F5;">
 <div style="color:#999; width:100%; height:83%; font-size:0.3rem; text-align:center; background:#FFF;"><span style="margin-top:2.9rem; width:100%; text-align:left; padding:0 0 0 0.3rem; display:inline-block;">订单支付成功<br>您已成功支付订单金额：<em style="color:#FF3300;">￥<?php echo $_GET['pay_amount']; ?></em></span><br />
 <a href="index.php?act=wap_index" style="display:inline-block; width:1.8rem; background:#51A351; height:0.5rem; border:0.02rem solid #3D7A3D; line-height:0.5rem; border-radius:0.05rem; margin-top:0.1rem; color:#FFF;">继续购物</a>
 <a href="javascript:void(0);" style="display:inline-block; width:1.8rem; background:#49AFCD; height:0.5rem; border:0.02rem solid #37839A; line-height:0.5rem; border-radius:0.1rem; color:#FFF;">查看订单</a>
 </div>
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/zepto.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/carousel-image.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/common.js"></script>
</body>