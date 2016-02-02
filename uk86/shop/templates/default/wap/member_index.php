<?php defined('InUk86') or exit('Access Invalid!'); ?>
<?php //p($output['member_info']);die(); ?>
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
		<title>优康_我的</title>
		<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/main.css" type="text/css" media="all">
	</head>

	<body>
		<!--顶部-->
		<header id="header">
			<div class="header_con">
				<div class="top-tit-div">
					我的
				</div>

				<div class="headerRight">
					<a href="index.php?act=wap_member_setting"><i class="icon-arrow-mine"></i></a>
				</div>
			</div>
		</header>
		<!--顶部结束-->

		<div id="content" class="p_bottom_b">
			<!--最上部-->
			<div class="my_top_div">
				<img class="bg_img" src="<?php echo SHOP_TEMPLATES_URL.DS ?>/images/wap/d1.jpg" />
				<div class="my_top_main">
					<div class="my_top_a">
						<ul class="clearfixd">
							<li><img src="<?php echo uk86_getMemberAvatar($output['member_info']['member_avatar']);?>" /></li>
							<li><?php echo $output['member_info']['member_name'] ?></li>
							<li><em><span><?php echo $output['member_info']['level_name'] ?></span></em></li>
						</ul>
					</div>
					<div class="my_top_b">
						<ul class="clearfixd">
							<a href="index.php?act=wap_member&op=favorites_goods"><li>
								<p><?php echo count($output['favorites_list']); ?></p>
								<h2>收藏商品</h2></li></a>
							<a href="index.php?act=wap_member&op=favorites_store"><li>
								<p><?php echo count($output['favorites_store_list']) ?></p>
								<h2>收藏店铺</h2></li></a>
							<a href="index.php?act=wap_member&op=member_sns_info"><li>
								<p><?php echo count($output['viewed_goods']); ?></p>
								<h2>浏览记录</h2></li></a>
						</ul>
					</div>
				</div>
			</div>
			<!--最上部结束-->

			<!--内容部分-->
			<div class="my_main_list">
				<ul>
				  <a href="index.php?act=wap_member_order">
					<li>
						<span class="icon-my-left01"></span>
						<label>全部订单</label>
						<i class="icon-d-right"></i>
					</li>
				  </a>
				</ul>
			</div>
			<div class="my_main_box">
				<a href="index.php?act=wap_member_order&op=index&state_type=state_new"><i class="icon-my-i01"><?php echo $output['home_member_info']['order_nopay_count']?'<em><span>'.$output['home_member_info']['order_nopay_count'].'</span></em>':''; ?></i><p>待付款</p></a>
				<a href="index.php?act=wap_member_order&op=index&state_type=state_pay"><i class="icon-my-i02"><?php echo $output['home_member_info']['order_pay_count']?'<em><span>'.$output['home_member_info']['order_pay_count'].'</span></em>':''; ?></i><p>待发货</p></a>
				<a href="index.php?act=wap_member_order&op=index&state_type=state_send"><i class="icon-my-i03"><?php echo $output['home_member_info']['order_noreceipt_count']?'<em><span>'.$output['home_member_info']['order_noreceipt_count'].'</span></em>':''; ?></i><p>待收货</p></a>
				<a href="index.php?act=wap_member_order&op=index&state_type=state_noeval"><i class="icon-my-i04"><?php echo $output['home_member_info']['order_noeval_count']?'<em><span>'.$output['home_member_info']['order_noeval_count'].'</span></em>':''; ?></i><p>待评价</p></a>
				<a href="<?php echo SHOP_SITE_URL;?>/index.php?act=wap_refund_order&op=index"><i class="icon-my-i05"><?php echo $output['home_member_info']['order_refund_num']?'<em><span>'.$output['home_member_info']['order_refund_num'].'</span></em>':''; ?></i><p>退款/退货</p></a>
			</div>

			<div class="my_main_list">
				<ul>
					<li>
						<span class="icon-my-left02"></span>
						<label>我的钱包</label>
					</li>
				</ul>
			</div>
			<div class="my_main_bao">
				<a class="hovered">
					<p><?php echo $output['member_info']['available_predeposit'] ?></p>
					<h2>可用余额</h2></a>
				<a href="index.php?act=wap_member_fcode&op=voucher_list">
					<p><?php echo $output['home_member_info']['voucher_count']?$output['home_member_info']['voucher_count']:0;?></p>
					<h2>卡券包</h2></a>
				<a class="hovered">
					<p><?php echo $output['member_info']['member_points']; ?></p>
					<h2>我的U币</h2></a>
			</div>

			<div class="my_main_list">
				<a href="index.php?act=wap_member_fcode"><ul>
					<li>
					  <span class="icon-my-left07"></span>
					  <label>我的F码</label>
					  <i class="icon-d-right"></i>
					</li>
				</ul></a>
				<ul>
					<a href="index.php?act=wap_member_fcode&op=rec_code"><li>
						<span class="icon-my-left03"></span>
						<label>我的兑换码</label>
						<i class="icon-d-right"></i>
					</li></a>
				</ul>
				<ul>
					<a href="index.php?act=wap_member_fcode&op=memberCircle"><li>
						<span class="icon-my-left04"></span>
						<label>我的圈子</label>
						<i class="icon-d-right"></i>
					</li></a>
				</ul>
			</div>

			<div class="my_main_list">
				<ul>
					<li>
						<span class="icon-my-left05"></span>
						<label>大转盘抽奖</label>
						<i class="icon-d-right"></i>
					</li>
				</ul>
				<ul>
					<li>
						<span class="icon-my-left06"></span>
						<label>摇一摇抽奖</label>
						<i class="icon-d-right"></i>
					</li>
				</ul>
			</div>

			<!--内容结束-->

		</div>
		<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/zepto.js"></script>
		<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/carousel-image.js"></script>
		<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/common.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.all_foot .home_foot a').eq(3).addClass('icon-bot-c');
});
</script>