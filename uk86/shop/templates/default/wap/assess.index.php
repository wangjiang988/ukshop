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
<title>优康_发表评价</title>
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/base.css" type="text/css" media="all">
</head>
<body>
<!--顶部-->
<header id="header">
<div class="header_con">
	<div class="headerleft">
		<i onClick="javascript:history.go(-1);" class="icon-arrow-left"></i>
	</div>
	<div class="top-hk-div">
		<span>发表评价</span>
	</div>
	<div class="headerRight">
		
	</div>
</div>
</header>
<!--顶部结束-->
<div id="content" class="p_bottom">
<form id="assess_form" method="post" action="index.php?order_id=<?php echo $_GET['order_id'] ?>">
<input type="hidden" name="act" value="wap_goods_assess"/>
<input type="hidden" name="op" value="index"/>
<?php foreach ($output['order_goods'] as $goods_info){ ?>
<div class="pj_list">
	<ul>
		<li class="pj_list_1"><a href="<?php echo uk86_urlShop('wap_goods_info', 'index', array('goods_id' => $goods_info['goods_id'])); ?>"><img src="<?php echo uk86_thumb($goods_info, 240); ?>"></a></li>
		<li class="pj_list_2">
		  <dl>
		    <dt>
		      <a href="<?php echo uk86_urlShop('wap_goods_info', 'index', array('goods_id' => $goods_info['goods_id'])); ?>"><span><?php echo $goods_info['goods_name'] ?></span></a>
		    </dt>
		    <dt>
		      <em>￥<?php echo $goods_info['goods_pay_price'] ?></em><br>
		      <em style="color:#C6C6C6;font-size:0.24rem;">X<?php echo $goods_info['goods_num'] ?>件</em>
		    </dt>
		  </dl>
		</li>
	</ul>
</div>
<div class="pj_write">
 	<span style="color:#999;">商品评分：
		<ul id="goods_<?php echo $goods_info['goods_id']; ?>" class="pingStar" style="float:right; margin-right:2.5rem; margin-top:0.1rem;">
		  <li rel="1"></li>
		  <li rel="2"></li>
		  <li rel="3"></li>
		  <li rel="4"></li>
		  <li rel="5"></li>
		  <input type="hidden" name="goods[<?php echo $goods_info['goods_id']; ?>][score]"/>
 		</ul>
 	</span>
	<textarea cols="38" rows="4" name="goods[<?php echo $goods_info['goods_id'] ?>][comment]" style="border:0.02rem solid #EEEEEE; padding:0.05rem 0.1rem; border-radius:0.1rem; float:left; resize:none;" placeholder="请写下对宝贝的感受吧，对他人帮助很大哦~"></textarea>
</div>
<hr style="margin-top:0.2rem; border:0; border-top:0.02rem solid #dedede;"/>
<?php } ?>

<div class="pj_all">
	<span>给店铺<a style="color:red;" href="index.php?act=wap_store&op=store_info&store_id=<?php echo $output['store_info']['store_id']; ?>"><?php echo $output['store_info']['store_name']; ?></a>评分</span><br>
	<div>
		<span>描述相符：</span>
		<ul id="store_1" class="pingStar">
		  <li rel="1"></li>
		  <li rel="2"></li>
		  <li rel="3"></li>
		  <li rel="4"></li>
		  <li rel="5"></li>
		  <input type="hidden" name="store_desccredit"/>
	 	</ul>
	 	</div>
	 	<div>
		<span>发货速度：</span>
		<ul id="store_2" class="pingStar">
		  <li rel="1"></li>
		  <li rel="2"></li>
		  <li rel="3"></li>
		  <li rel="4"></li>
		  <li rel="5"></li>
		  <input type="hidden" name="store_servicecredit"/>
	 	</ul>
	 	</div>
	 	<div>
		<span>服务态度：</span>
		<ul  id="store_3" class="pingStar">
		  <li rel="1"></li>
		  <li rel="2"></li>
		  <li rel="3"></li>
		  <li rel="4"></li>
		  <li rel="5"></li>
		  <input type="hidden" name="store_deliverycredit"/>
	 	</ul>
 	</div>
</div>
</form>
<div class="all_foot"><input class="pj_submit" type="button" value="提交"/></div>
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/zepto.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/carousel-image.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/common.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.all_foot:eq(1)').remove();
	//评分
	$('.pingStar li').click(function(){
		var rel = $(this).attr('rel');
		var ul_id = $(this).parent('ul').attr('id');
		switch(rel){
		case '1':
			get_bg_img(ul_id, 1, 0);break;
		case '2':
			get_bg_img(ul_id, 2, 1);break;
		case '3':
			get_bg_img(ul_id, 3, 2);break;
		case '4':
			get_bg_img(ul_id, 4, 3);break;
		case '5':
			get_bg_img(ul_id, 5, 4);break;
		}
	});
	$('.pj_submit').click(function(){
		$("#assess_form").submit();
	});
});
function get_bg_img(ul_id, lt, gt){
	$('#'+ul_id+' li:lt('+lt+')').addClass('bg_img');
	$('#'+ul_id+' li:gt('+gt+')').removeClass('bg_img');
	$('#'+ul_id+' input').val(lt);
}
</script>
</body>
</html>
