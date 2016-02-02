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
<title>优康_F码商品</title>
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/main.css" type="text/css" media="all">
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/list.css" type="text/css" media="all">
<style type="text/css">
#content{background:#FFF;}
</style>
</head>
<body>
<!--顶部开始-->
<header id="header">
<div class="header_con">
	<div class="headerleft">
		<a><i onClick="javascript:history.go(-1);" class="icon-arrow-left"></i></a>
	</div>
	<div class="top-hk-div">
		<span>F码商品</span>
	</div>
	<div class="headerRight">
		<i class="icon-search-right"></i>
	</div>
</div>
</header>
<!--顶部结束-->
<div id="content" class="p_bottom">
  <?php if(!empty($output['goods_list']) && is_array($output['goods_list'])){ ?>
	<div class="list_main_all">
		<div class="list_main_box">
		  <?php foreach ($output['goods_list'] as $goods_info){ ?>
			<a href="index.php?act=wap_goods_info&op=index&goods_id=<?php echo $goods_info['goods_id']; ?>"><ul class="clearfixd">
				<li><img src="<?php echo uk86_thumb($goods_info, 240);	 ?>"></li>
				<li><h2><?php echo $goods_info['goods_name'] ?></h2>
					<dl class="clearfixd">
					<dt><label><em>￥</em><?php echo $goods_info['goods_promotion_price']; ?></label> </dt>  
					<dt><?php if($goods_info['goods_freight'] == 0)echo '包邮'; ?></dt></dl>
					<dl>
					<dd><label>￥<?php echo $goods_info['goods_marketprice']; ?></label>  <span class="buyer"><?php echo $goods_info['goods_salenum'] ?>人付款</span>  <span class="rebate"><?php echo round(($goods_info['goods_promotion_price']/$goods_info['goods_marketprice'])*10, 2); ?>折</span></dd>		
				</dl> 
				</li>            
            </ul></a>
			<?php } ?>
		</div>
	</div>
	<?php }else{ ?>
  	<div style="color:#999; width:100%; height:83%; text-align:center; background:#FFF;"><span style="margin-top:2.9rem; display:inline-block;">暂无F码商品<span></span><br /></div>
	<?php } ?>
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/zepto.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/carousel-image.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/common.js"></script>
</body>
</html>