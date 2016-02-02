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
<title>优康_U币兑换</title>
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/main.css" type="text/css" media="all">
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/list.css" type="text/css" media="all">
</head>
<body>

<header id="header">
<div class="header_con">
	<div class="headerleft">
		<a href="index.php?act=wap_index"><i class="icon-arrow-left"></i></a>
	</div>
	<div class="top-hk-div">
		<span><span>热门卡卷包</span><img style="width:0.2rem; height:0.2rem; position:relative; top:0.03rem; left:0.02rem;" src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/icon_2x.png"/></span>

	</div>
	<div class="headerRight">
		<i class="icon-class-right"></i>
	</div>
</div>
</header>
<!-- <div class="selected_header"> -->
<!--     <div class="selected_none"> -->
<!--         <a><div class="selected_font">热门卡券包</div></a> -->
<!--         <a href="index.php?act=wap_UCoin&type=2"><div class="selected_font">热门礼品</div></a> -->
<!--     </div> -->
<!-- </div> -->
<div id="content" class="p_bottom" style="background: #fff;">
	<div class="list_top_tit clearfixd">		
		<ul>
			<li nctype="1" class="top_c_three <?php if($_GET['order_type'] == 1 || empty($_GET['order_type'])){echo 'l_top_c'; } ?>">默认排序</li>
			<li nctype="2" class="top_c_three <?php if($_GET['order_type'] == 2){echo 'l_top_c';} ?>">兑换量</li>
			<li nctype="3" class="top_c_three <?php if($_GET['order_type'] == 3){echo 'l_top_c';} ?>">U币值<i class="<?php if($_GET['order'] == 'asc'){echo 'top_i_change';} ?>"></i><i class="<?php if($_GET['order'] == 'desc'){echo 'bot_i_change';} ?>"></i></li>
		</ul>
	</div>
	<div class="list_main_all">
		<div class="list_box">
		  <?php if(!empty($output['list']) && is_array($output['list'])){ ?>
		   <?php foreach ($output['list'] as $key => $val){ ?>
		  	<ul class="red_border">
				<dl><a href="javascript:void(0);"><img src="<?php echo UPLOAD_SITE_URL.DS.'shop/voucher/1/'.$val['voucher_t_customimg']; ?> " onerror="this.src='<?php echo UPLOAD_SITE_URL.DS.uk86_defaultGoodsImage(240);?>'"/></a></dl>
				<dl>
					<dt class="goods_name"><a href="javascript:void(0);"><?php echo $val['voucher_t_title']; ?></a></dt>
					<dt class="can_use">(购物满<?php echo floatval($val['voucher_t_limit']); ?>元可用)</dt>
					<dt class="need_u">需要<?php echo $val['voucher_t_points']; ?>U币</dt>
					<dt class="last_time">有效期至<?php echo date('Y-m-d', $val['voucher_t_end_date']); ?></dt>
				</dl>
				<dl>
					<dd>￥<?php echo $val['voucher_t_price']; ?></dd>
					<dd><a class="voucher_now" nctype="<?php echo $val['voucher_t_id']; ?>" href="javascript:void(0);">立即兑换</a></dd>
				</dl>
			</ul>
		   <?php } ?>
		  <?php } ?>
		</div>
	</div>
	<!-- 积分兑换卡卷包dialog -->
	<div class="dialog_html" style="display: none;">
	 	<form id="canacel_form" method="post">
	   <div class="dialogBody" style="top:2.5rem;">
	   <i class="close" onClick="dialog_hide();"></i>
	   <div class="dialogHead"><i class="icon-confirm"></i><p>您要兑换的店铺卡卷包</p></div>
	   <div class="dialogMsg" style="border-bottom: 0.02rem solid #ccc; padding-bottom:0.2rem;">
	     <table style="color:#454545; font-size:0.25rem; line-height:0.35rem;">
	       <tr>
	         <td><img style="width:1rem; height:1rem;" class="voucher_image" src=""></td>
	         <td style="color:#D93600; padding-left:0.1rem;">您正在使用 <em class="need_voucher"></em> U币 兑换 1 张<br/><em class="store"></em><em class="jian"></em>元店铺卡券包<br/>(满<em class="man"></em>减<em class="jian"></em>)</td>
	       </tr>
	       <tr>
	         <td></td><td style="font-size:0.22rem; padding-left:0.1rem;">卡券包有效期至：<em class="date"></em><br/>每个用户<em class="limit"></em></td>
	       </tr>
	     </table>
	   </div>
	   <div class="closeTime"><a class="form_submit" style="background:#5BB75B;">&nbsp;&nbsp;兑换&nbsp;&nbsp;</a>&nbsp;&nbsp;&nbsp;&nbsp;<a class="hovered" onClick="dialog_hide();">&nbsp;&nbsp;取消&nbsp;&nbsp;</a></div>
	   </div>
	   </form>
	 </div>
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/zepto.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/carousel-image.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/common.js"></script>
<script type="text/javascript">
var DEFAULT = true;
$(document).ready(function(e) {
	dialog_hide();
//     $('.top-hk-div span').click(function(){
// 		$('.selected_none').addClass('selected');
// 		return false;
// 	});
// 	$('.selected_font').click(function(){
// 		if($(this).hasClass('selected')){return false;}
// 		var html = $(this).html();
// 		$('.selected_none').removeClass('selected');
// 		$('.top-hk-div span span').html(html);
// 		return false;
// 	});
	$('body,header').click(function(){
		if($('.selected_none').hasClass('selected')){
			$('.selected_none').removeClass('selected');
		}
	});
	//排序
	$('.top_c_three:last-child').click(function(){
		if($(this).children('i:last-child').hasClass('bot_i_change')){
			var order = 'asc';
		}else{
			var order = 'desc';
		}
		window.location.href = 'index.php?act=wap_UCoin&type=1&order_type=3&order='+order;
		DEFAULT = false;
	});
	$('.top_c_three').click(function(){
		if(DEFAULT){
			if($(this).hasClass('l_top_c')){return false;}
			var order_type = $(this).attr('nctype');
			window.location.href = 'index.php?act=wap_UCoin&type=1&order_type='+order_type;
		}
	});
	//兑换卡券包
	$('.voucher_now').click(function(){
		dialog_load();
		var voucher_id = $(this).attr('nctype');
		$.getJSON('index.php?act=wap_UCoin&op=getVoucherById', {voucher_id:voucher_id}, function(data){
			$('.need_voucher').html(data.voucher_t_points);
			$('.store').html(data.voucher_t_storename);
			$('.jian').html(data.voucher_t_price);
			$('.voucher_image').attr('src', data.voucher_t_customimg);
			$('.man').html(data.voucher_t_limit);
			$('.date').html(data.end_time);
			$('.limit').html(data.eachlimit);
			$('.form_submit').attr('nctype', data.voucher_t_id);
			dialogRemove();
			$('.dialog_html').show();
		});
	});
	$('.form_submit').click(function(){
		var voucher_id = $(this).attr('nctype');
		$.getJSON('index.php?act=wap_UCoin&op=getVoucherForMember', {voucher_id:voucher_id}, function(data){
			 dialog_hide();
			if(data.state){
				showDialog('兑换成功，请在个人中心确认查看');
			}else{
				showError(data.msg);
			}
		});
	});
});
function dialog_hide(){
	$('.dialog_html').hide();
}
</script>
</body>
</html>