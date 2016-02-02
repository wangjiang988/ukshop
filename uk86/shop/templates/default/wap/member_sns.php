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
<title>优康_<?php echo $output['sns_type']; ?></title>
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/base.css" type="text/css" media="all">
</head>
<body style="background:#F5F5F5;">
<!--顶部-->
<header id="header">
<div class="header_con">
	<div class="headerleft">
		<i onClick="javascript:history.go(-1);" class="icon-arrow-left"></i>
	</div>
	<div class="top-hk-div">
		<span><?php echo $output['sns_type']; ?></span>
	</div>
	<div class="headerRight">
		
	</div>
</div>
</header>
<!--顶部结束-->
<div id="content" class="p_bottom" style="background:#F5F5F5;">
<?php if(!empty($output['view1']) || !empty($output['view2']) || !empty($output['view3'])){ ?>
 <?php if(!empty($output['view1'])){ ?>
	<div class="sc_list_all">
		<span>最近一个月<?php echo $output['sns_type_1']; ?></span>
		<ul>
		  <?php foreach ($output['view1'] as $goods_id => $goods_info){ ?>
		  <li>
			<dl>
			  <dt class="sc_list_img">
			    <a href="<?php echo uk86_urlShop('wap_goods_info', 'index', array('goods_id' => $goods_id)); ?>"><img src="<?php echo $goods_info['goods_image'] ?>"></a>
			  </dt>
			  <dt class="sc_list_mo">
			    <a href="<?php echo uk86_urlShop('wap_goods_info', 'index', array('goods_id' => $goods_id)); ?>"><span class="goods_name"><?php echo $goods_info['goods_name'] ?></span></a>
			    <img onClick="fav_goods(<?php echo $goods_id ?>);" src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/scdp_jx.png"><br>
			    <span style="color:#d93600;">￥<em style="color:#d93600;"><?php echo $goods_info['goods_promotion_price'] ?></em></span>
			    <img onClick="share_goods(<?php echo $goods_id ?>);" src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/share_fx.png">
			    <?php if(!empty($output['is_fav'])){ ?><img onClick="del_fav_goods(<?php echo $goods_id ?>);" src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/order_home.png"><?php } ?>
			  </dt>
			</dl>
		  </li>
		  <?php } ?>
		</ul>
	</div>
  <?php } ?>
  <?php if(!empty($output['view2'])){ ?>
	<div class="sc_list_all">
		<span>三个月内<?php echo $output['sns_type_1']; ?></span>
		<ul>
		  <?php foreach ($output['view2'] as $goods_id => $goods_info){ ?>
		  <li>
			<dl>
			  <dt class="sc_list_img">
			    <a href="<?php echo uk86_urlShop('wap_goods_info', 'index', array('goods_id' => $goods_id)); ?>"><img src="<?php echo $goods_info['goods_image'] ?>"></a>
			  </dt>
			  <dt class="sc_list_mo">
			    <a href="<?php echo uk86_urlShop('wap_goods_info', 'index', array('goods_id' => $goods_id)); ?>"><span class="goods_name"><?php echo $goods_info['goods_name'] ?></span></a>
			    <img onClick="fav_goods(<?php echo $goods_id ?>);" src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/scdp_jx.png"><br>
			    <span style="color:#d93600;">￥<em style="color:#d93600;"><?php echo $goods_info['goods_promotion_price'] ?></em></span>
			    <img onClick="share_goods(<?php echo $goods_id ?>);" src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/share_fx.png">
			    <?php if(!empty($output['is_fav'])){ ?><img onClick="del_fav_goods(<?php echo $goods_id ?>);" src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/order_home.png"><?php } ?>
			  </dt>
			</dl>
		  </li>
		  <?php } ?>
		</ul>
	</div>
  <?php } ?>
  <?php if(!empty($output['view3'])){ ?>
	<div class="sc_list_all">
		<span>三个月前<?php echo $output['sns_type_1']; ?></span>
		<ul>
		  <?php foreach ($output['view3'] as $goods_id => $goods_info){ ?>
		  <li>
			<dl>
			  <dt class="sc_list_img">
			    <a href="<?php echo uk86_urlShop('wap_goods_info', 'index', array('goods_id' => $goods_id)); ?>"><img src="<?php echo $goods_info['goods_image'] ?>"></a>
			  </dt>
			  <dt class="sc_list_mo">
			    <a href="<?php echo uk86_urlShop('wap_goods_info', 'index', array('goods_id' => $goods_id)); ?>"><span class="goods_name"><?php echo $goods_info['goods_name'] ?></span></a>
			    <img onClick="fav_goods(<?php echo $goods_id ?>);" src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/scdp_jx.png"><br>
			    <span style="color:#d93600;">￥<em style="color:#d93600;"><?php echo $goods_info['goods_promotion_price'] ?></em></span>
			    <img onClick="share_goods(<?php echo $goods_id ?>);" src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/share_fx.png">
			    <?php if(!empty($output['is_fav'])){ ?><img onClick="del_fav_goods(<?php echo $goods_id ?>);" src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/order_home.png"><?php } ?>
			  </dt>
			</dl>
		  </li>
		  <?php } ?>
		</ul>
	</div>
  <?php } ?>
<?php }else{ ?>
<div style="color:#999; width:100%; height:70%; text-align:center; background:#FFF;"><span style="margin-top:2.9rem; display:inline-block;">您还没有<?php echo $output['sns_type_1']; ?>过商品<span></span><br /><a href="index.php?act=wap_index" style="display:inline-block; width:1.8rem; height:0.5rem; border:0.02rem solid #999; line-height:0.5rem; border-radius:0.05rem; margin-top:0.2rem; color:#555;">随便逛逛</a></div>
<?php } ?>
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/zepto.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/carousel-image.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/common.js"></script>
<script type="text/javascript">
//分享商品
function share_goods(goods_id){
	$.post('index.php?act=wap_goods_info&op=share_goods', {goods_id:goods_id}, function(msg){
		if(msg > 0){
			if(msg == 11){
				showDialog('分享成功');
			}else{
				showDialog('您已分享过此商品');
			}
		}else{
			showError('分享失败');
		}
	});
}
//收藏商品
function fav_goods(goods_id){
	if('<?php echo $output['sns_type_1']; ?>' == '收藏'){return false;}
	$.post('index.php?act=wap_goods_info&op=fav_goods', {goods_id:goods_id}, function(msg){
		if(msg > 0){
			showDialog('收藏成功');
		}else{
			showDialog('您已收藏过此商品');
		}
	});
}
//删除
function del_fav_goods(id){
	if(confirm('确认删除？')){
		$.get('index.php?act=wap_member&op=del_fav', {fav_id:id, type:'goods'}, function(msg){
			if(msg > 0){
				showDialog('删除成功', '', 'index.php?act=wap_member&op=favorites_goods');
			}
		});
	}
}
</script>
</body>
</html>
