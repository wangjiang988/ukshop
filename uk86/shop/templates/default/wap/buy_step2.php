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
<title>定单支付</title>
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/main.css" type="text/css" media="all">
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/add.css" type="text/css" media="all">
<script src="<?php echo RESOURCE_SITE_URL ?>/js/wap/jquery.min.js" type="text/javascript"></script>
</head>
<body>
<!--顶部开始-->
<header id="header">
<div class="header_con">
	<div class="headerleft">
		<i class="icon-arrow-left"></i>
	</div>
	<div class="top-hk-div">
		<span>定单支付</span>
	</div>
	<div class="headerRight">
		<i class="icon-search-right"></i>
	</div>
</div>
</header>
<!--顶部结束-->
<div id="content" class="p_bottom">
	<div class="list_main_all">
		<div class="list_main_box_pay">
			<div class="pay_input_div">
				<ul class="pay_list_ul">
					<?php if ($output['goods']) : ?>
					<?php foreach ($output['goods'] as $row) : ?>
					<span class="pay_pinpai"><?php echo $row['goods_name']?></span>
					<li class="pay_list_li">
						<dl>
							<dt class="pay_list_width01"><span class="pay_list_span01">&nbsp;&nbsp;</span></dt>
							<dt class="pay_list_width02"><span class="pay_list_num">X<?php echo $row['goods_num']?></span></dt>
						</dl>
					</li>
					<?php endforeach;;?>
					<?php endif;?>
					<li class="pay_list_li">
						<dl>
							<dt class="pay_list_width01"><span class="pay_list_span02">运费：</span></dt>
							<dt class="pay_list_width02"><span class="pay_list_num">￥<?php echo $output['order_list'][0]['shipping_fee']?></span></dt>
						</dl>
					</li>
					<li class="pay_list_li" style="border:none;">
						<dl>
							<dt class="pay_list_width01"><span class="pay_list_span02">应支付：</span></dt>
							<dt class="pay_list_width02"><span class="pay_list_num_red">￥<?php echo $output['order_list'][0]['order_amount']?></span></dt>
						</dl>
					</li>
				</ul>
			</div>
			<div class="pay_select_title"><span class="pay_select_span">选择支付方式</span></div>
			<div class="pay_list_div">
				<?php
					if ($output['payment_list'])  : 
						$user_agent = $_SERVER['HTTP_USER_AGENT'];
						if (strpos($user_agent, 'MicroMessenger') !== false) :
							 foreach ($output['payment_list'] as $pay_code => $pay) :
							 	if ($pay_code != 'wxpay') continue;
								$img = 'wx_pay.png';
							?>
						<ul class="pay_list_all">
								<li class="pay_all_li01"><img src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/<?php echo $img;?>"></li>
								<li class="pay_all_li02"><dl><dt><span class="pay_class"><?php echo $pay['payment_name']; ?></span></dt><dt><span class="pay_ms"><?php echo $pay['payment_name']; ?></span></dt></dl></li>
							<li class="pay_all_li03">
								<input type="radio" class="checkbox" name="paylist"  value="<?php echo $pay['payment_id'];?>">
							</li>
						</ul>
						<?php endforeach;?>
						<?php else :
							 foreach ($output['payment_list'] as $pay_code => $pay) :
								 	if ($pay_code == 'wxpay') continue;
									 switch ($pay_code) {
										case 'alipay':
											$img = 'alipay.png';
											break;
										case 'tenpay':
											$img = 'cft.png';
											break;
										case 'unionpay':
											$img = 'yl_pay.png';
											break;
										case 'wxpay':
										default:
											$img = 'wx_pay.png';
											break;
									}
								?>
							<ul class="pay_list_all">
									<li class="pay_all_li01"><img src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/<?php echo $img;?>"></li>
									<li class="pay_all_li02"><dl><dt><span class="pay_class"><?php echo $pay['payment_name']; ?></span></dt><dt><span class="pay_ms"><?php echo $pay['payment_name']; ?></span></dt></dl></li>
								<li class="pay_all_li03">
									<input type="radio" class="checkbox" name="paylist"  value="<?php echo $pay['payment_id'];?>">
								</li>
							</ul>
							<?php endforeach;?>
					<?php endif;?>
				<?php endif;?>
			</div>		
			<div class="pay_foot_submit"><input type="button"  class="pay_btn"  value="立即支付"></div>
		</div>
	</div>
</div>
 <script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/zepto.js"></script>
 <script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/carousel-image.js"></script>
 <script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/common.js"></script>
 <script type="text/javascript">
	$(document).ready(function(){
		$('.all_foot').hide();
		$('.pay_btn').attr('disabled', false); 
		
		$("input[name=paylist]").click(function(){
				if ($(this).attr("checked")) {
					$(this).attr("checked", false);
					$(this).removeClass("checked").addClass("checkbox");
				} else {
					$(this).parents('div').children().find('input[name=paylist]').removeClass('checked').addClass('checkbox');
					$(this).parents('div').children().find('input[name=paylist]').attr("checked", false);
					$(this).attr("checked", true);
					$(this).removeClass("checkbox").addClass("checked");
				}
			});


		$('.pay_btn').click(function(){
				var pay_id = $('.checked').val();
				if(!pay_id){
					showDialog('请选择支付方式', 1);
					return ;
				}
				$.get('index.php?act=mb_payment', {pay_id : pay_id, pay_sn : "<?php echo $_GET['pay_sn']; ?>"}, function(data){
					var rs = data ?  eval('(' + data + ')') : ''; 
					if(rs.status == 1){
						showDialog(rs.msg, 1);
					}else{
						$('.pay_btn').attr('disabled', true); 
						$('.pay_btn').val('Load...');
						window.location.href = rs.msg;
					}
				});
		});
	});
</script>