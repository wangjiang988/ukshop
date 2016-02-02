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
<title>优康_促销抢购</title>
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/main.css" type="text/css" media="all">
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/list.css" type="text/css" media="all">
<style type="text/css">
.list_main_box ul li:first-child{overflow:hidden;}
.list_main_box ul li:first-child img{max-width:none; margin-left:-0.3rem; width:auto !important;}

</style>
</head>
<body>
<!--顶部开始-->
<header id="header">
<div class="header_con">
	<div class="headerleft">
		<a href="index.php?act=wap_index"><i class="icon-arrow-left"></i></a>
	</div>
	<div class="top-hk-div">
		<span>促销抢购</span>
	</div>
	<div class="headerRight">
		<i class="icon-search-right"></i>
    	<i class="icon-class-right"></i>
	</div>
</div>
</header>
<!--顶部结束-->
<div id="content">
	<div class="list_main_all">
	  <?php if(!empty($output['groupbuy_list']) && is_array($output['groupbuy_list'])){ ?>
		<div class="list_main_box">
		  <?php foreach ($output['groupbuy_list'] as $val){ ?>
			<ul class="clearfixd">
            <li><img src="<?php echo uk86_gthumb($val['groupbuy_image'], 'mid'); ?>"/></li>
			<li><h2><?php echo $val['groupbuy_name']; ?></h2>
				<dl class="clearfixd width-50">
                    <dt><label><em>￥</em><?php echo $val['groupbuy_price']; ?></label> </dt> 
                </dl>
                <a href="<?php echo uk86_urlShop('wap_goods_info', 'index', array('goods_id'=>$val['goods_id'])); ?>" class="knock_now">马上抢</a>
				<dl class="width-50">
					<dd><label>￥<?php echo $val['goods_price']; ?></label><span class="rebate"><?php echo $val['groupbuy_rebate']; ?>折</span></dd>		
				</dl>  
			</li>      
            </ul>
		  <?php } ?>
		</div>
	  <?php }else{ ?>
	  	<div style="color:#999; width:100%; height:83%; text-align:center; background:#FFF;"><span style="margin-top:2.9rem; display:inline-block;">还没有促销商品<span></span><br /><a href="index.php?act=wap_index" style="display:inline-block; width:1.8rem; height:0.5rem; border:0.02rem solid #999; line-height:0.5rem; border-radius:0.05rem; margin-top:0.2rem; color:#555;">随便逛逛</a></div>
  	  <?php } ?>
	</div>
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/zepto.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/carousel-image.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/common.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.all_foot').hide();
});
</script>
</body>
</html>