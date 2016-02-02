<?php  defined('InUk86') or exit('Access Invalid!');  ?>
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
		<title>优康_退单|售后</title>
		<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL; ?>/css/wap/main.css" type="text/css" media="all">
		<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL; ?>/css/wap/base.css" type="text/css" media="all">
		<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/wap/jquery.min.js"></script>
	</head>

	<body style="background:#F5F5F5;">
		<!--顶部-->
		<header id="header">
			<div class="header_con">
			<div class="headerleft">
				<a href="index.php?act=wap_member"><i class="icon-arrow-left"></i></a>
			</div>
				<div class="top-tit-div">
					<span>退单|售后</span>
				</div>

				<div class="headerRight">
					
				</div>
			</div>
		</header>
		<!--顶部结束-->

		<div id="content" class="p_bottom_b" style="background:#F5F5F5;">
		<?php if(!empty($output['refund_list'])){?>
			<?php foreach($output['refund_list'] as $key=>$val){?>
				<div class="order_list_all">
					<ul>
						<li class="order_list_1"><dl><dt class="order_list_home"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/wap/order_home.png"></dt><dt><span><?php echo $val['store_name'];?></span></dt><dt class="order_list_right"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/wap/order_right.png"></dt>
									<?php if($val['refund_state']==1) {
										 	echo '<dt class="order_list_suc" style="margin-left: 1.7rem;">已申请退款';
			                              }else if($val['refund_state']==2){
										    if($val['seller_state']==1){
												echo '<dt class="order_list_suc" style="margin-left: 1.7rem;">审核中';
											}else if($val['seller_state']==2){
												echo '<dt class="order_list_suc" style="margin-left: 1.7rem;">店铺不同意退款';
											}else{
												echo '<dt class="order_list_suc" style="margin-left: 1.7rem;">退款处理中';
											}
									    }else{
										    echo '<dt class="order_list_send" style="color:#92C880;margin-left: 1.7rem;">退款完成';
									}
									?>
								</dt></dl></li>
						<li class="order_list_2">
							<?php if($val['goods_id']==0){?>
								<?php foreach($val['goods_list'] as $key=>$item){?>
									<a href="index.php?act=wap_goods_info&op=index&goods_id=<?php echo $item['goods_id'];?>"><dl><dt><img src="<?php echo uk86_cthumb($item['goods_image']);?>"></dt><dt class="order_list_name"><?php echo uk86_str_cut($item['goods_name'],22);?><!--<p>主要颜色：蓝色；尺码：24寸</p>--></dt><dt class="order_list_val">￥<em><?php echo $item['goods_price'];?></em><p>x<?php echo $item['goods_num'];?></p></dt></dl></a>
						        <?php }?>
					        <?php }else{?>
								<dl><dt><img src="<?php echo uk86_cthumb($val['goods_image']);?>"></dt><dt class="order_list_name"><?php echo uk86_str_cut($val['goods_name'],22);?></dt><dt class="order_list_val">￥<em><?php echo $val['goods_list']['goods_price'];?></em><p>x<?php echo $val['goods_list']['goods_num'];?></p></dt></dl>
							<?php }?>
						</li>
						<li class="order_list_3">共<em><?php if($val['goods_id']==0) echo $val['goods_num']; else echo $val['goods_list']['goods_num'];?></em>件商品，合计￥<em><?php echo $val['refund_amount'];?></em><?php if($val['goods_id']==0){?>(含运费￥<em><?php echo $val['shopping_fee'];?></em>)<?php }?></li>
						<li class="order_list_4"><dl><dt><?if($val['refund_state']!=3){?><a href="index.php?act=wap_refund_order&op=cancel_refund&order_id=<?php echo $val['order_id'];?>&order_sn=<?php echo $val['order_sn'];?>" class="order_check_1" style="width:1.5rem;">取消退款</a><?php }?></dt></dl></li>
					</ul>
				</div>
			<?php }?>
		<?php }?>
		<!--<div class="order_list_all">
			<ul>
				<li class="order_list_1"><dl><dt class="order_list_home"><img src="<?php /*echo SHOP_TEMPLATES_URL;*/?>/images/wap/order_home.png"></dt><dt><span>雕牌风扇旗舰店</span></dt><dt class="order_list_right"><img src="<?php /*echo SHOP_TEMPLATES_URL;*/?>/images/wap/order_right.png"></dt><dt class="order_list_suc" style="margin-left: 1.7rem;">已申请退款</dt></dl></li>
				<li class="order_list_2"><dl><dt><img src="<?php /*echo SHOP_TEMPLATES_URL;*/?>/images/wap/order_list.png"></dt><dt class="order_list_name">雕牌强力电风扇<p>主要颜色：蓝色；尺码：16寸</p></dt><dt class="order_list_val">￥<em>18.80</em><p>x1</p></dt></dl></li>
				<li class="order_list_3">共<em>1</em>件商品，合计￥<em>18.80</em>（含运费￥<em>0.00</em>）</li>
				<li class="order_list_4"><dl><dt><a href="" class="order_check_1" style="width:1.5rem;">取消退款</a></dt></dl></li>
			</ul>
		</div>
		<div class="order_list_all">
			<ul>
				<li class="order_list_1"><dl><dt class="order_list_home"><img src="<?php /*echo SHOP_TEMPLATES_URL;*/?>/images/wap/order_home.png"></dt><dt><span>雕牌风扇旗舰店</span></dt><dt class="order_list_right"><img src="<?php /*echo SHOP_TEMPLATES_URL;*/?>/images/wap/order_right.png"></dt><dt class="order_list_send" style="color:#92C880;">退款成功</dt></dl></li>
				<li class="order_list_2">
					<dl><dt><img src="<?php /*echo SHOP_TEMPLATES_URL;*/?>/images/wap/order_list.png"></dt><dt class="order_list_name">雕牌强力电风扇<p>主要颜色：蓝色；尺码：24寸</p></dt><dt class="order_list_val">￥<em>18.80</em><p>x1</p></dt></dl>
					<dl><dt><img src="<?php /*echo SHOP_TEMPLATES_URL;*/?>/images/wap/order_list.png"></dt><dt class="order_list_name">雕牌强力电风扇<p>主要颜色：蓝色；尺码：16寸</p></dt><dt class="order_list_val">￥<em>18.80</em><p>x1</p></dt></dl>
				</li>
				<li class="order_list_3">共<em>2</em>件商品，合计￥<em>37.60</em>（含运费￥<em>0.00</em>）</li>
				
			</ul>
		</div>
		<div class="order_list_all">
			<ul>
				<li class="order_list_1"><dl><dt class="order_list_home"><img src="<?php /*echo SHOP_TEMPLATES_URL;*/?>/images/wap/order_home.png"></dt><dt><span>雕牌风扇旗舰店</span></dt><dt class="order_list_right"><img src="<?php /*echo SHOP_TEMPLATES_URL;*/?>/images/wap/order_right.png"></dt><dt class="order_list_suc" style="margin-left: 1.7rem;">已申请退款</dt></dl></li>
				<li class="order_list_2"><dl><dt><img src="<?php /*echo SHOP_TEMPLATES_URL;*/?>/images/wap/order_list.png"></dt><dt class="order_list_name">雕牌强力电风扇<p>主要颜色：蓝色；尺码：16寸</p></dt><dt class="order_list_val">￥<em>18.80</em><p>x2</p></dt></dl></li>
				<li class="order_list_3">共<em>1</em>件商品，合计￥<em>18.80</em>（含运费￥<em>0.00</em>）</li>
				<li class="order_list_4"><dl><dt><a href="" class="order_check_1" style="width:1.5rem;">取消退款</a></dt></dl></li>
			</ul>
		</div>
		</div>-->
		<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/wap/common.js"></script>
	</body>

</html>