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
<title>优康_购物车</title>
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/base.css" type="text/css" media="all">
</head>
<body style="background:#EFF3F4;">
<!--顶部开始-->
<header id="header">
<div class="header_con">
	<div class="headerleft">
		<i class="icon-arrow-left" onClick="javascript:history.go(-1);"></i>
	</div>
	<div class="top-hk-div">
		<span>购物车<?php if(!empty($output['cart_goods_num'])){ ?>（<em><?php echo $output['cart_goods_num']; ?></em>）<?php } ?></span>
	</div>
	<div class="headerRight">
	</div>
</div>
</header>
<!--顶部结束-->
<div id="content" class="p_bottom" style="background:#EFF3F4;">
  <?php if(!empty($output['store_cart_list']) && is_array($output['store_cart_list'])){ ?>
  <form id="cart_form" action="index.php" method="post">
    <input type="hidden" name="act" value="wap_buy"/>
    <input type="hidden" name="op" value="buy_step1"/>
    <input type="hidden" name="ifcart" value="1"/>
    <input type="hidden" name="step1_url" value="<?php echo $_SERVER['REQUEST_URI']; ?>"/>
    <input id="store_men" type="hidden" name="store_mention" value="0" />
  <?php foreach ($output['store_cart_list'] as $store_id => $cart_list){ ?>
    <div class="shopping_list_concnet">
		<ul>
			<li class="shopping_list_li1">
			  <dl>
			    <dt>
			      <input class="checkbox shopall" type="checkbox" />
			    </dt>
			    <dt class="shopping_list_home" style="width:5.7rem;">
			      <img src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/order_home.png">
			      <?php echo $cart_list[0]['store_name']; ?>
			    </dt>
			    <dt class="shopping_list_right">
			      <img src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/order_right.png">
			    </dt>
			  </dl>
			</li>
			<?php foreach ($cart_list as $cart_info){ ?>
			<li class="shopping_list_li2">
			  <dl>
			    <dt class="shopping_list_input">
			      <input nctype="<?php echo $cart_info['goods_price']; ?>" enctype="<?php echo $cart_info['cart_id']; ?>" class="checkbox newslist" type="checkbox" name="cart_id[]" value="<?php echo $cart_info['cart_id'].'|'.$cart_info['goods_num'];?>"/>
			    </dt>
			    <dt>
			      <img style="width:1rem; height:1rem;" src="<?php echo uk86_thumb($cart_info,60);?>">
			    </dt>
			    <dt class="shopping_dt">
			      <span><a style="display:inline-block; color: #8b8b8b; width:2.75rem; overflow:hidden; height:0.7rem;"><?php echo $cart_info['goods_name'] ?></a><em class="get_goods_price" <?php if(!empty($cart_info['xianshi_info'])){echo 'nctype="'.$cart_info['xianshi_info']['xianshi_price'].'" ctype="'.$cart_info['goods_price'].'" enctype="'.$cart_info['xianshi_info']['lower_limit'].'"';}; ?>> ￥<?php if(!empty($cart_info['xianshi_info']) && ($cart_info['goods_num'] >= $cart_info['xianshi_info']['lower_limit'])){echo $cart_info['xianshi_info']['xianshi_price'];}else{ echo $cart_info['goods_price'];} ?></em><span style="max-width:2.75rem; min-width:2rem; height：0.3rem; background:<?php if(!empty($cart_info['xianshi_info'])){ echo '#fd6760'; }else{echo '#FFF';} ?>; color:#FFF; height:0.32rem; display:inline-block;"><?php if(!empty($cart_info['xianshi_info'])){ ?>满<strong><?php echo $cart_info['xianshi_info']['lower_limit'] ?></strong>件，单价立降<font style="color:#FFFF00;"><?php echo floatval($cart_info['xianshi_info']['down_price']); ?></font>元<?php } ?></span></span>
			      <p style="position:absolute; top:0.6rem; right:0.3rem;"><s style="color:#8A8A8A;font-size:0.27rem;float: right;">￥<?php echo $cart_info['goods_marketprice'] ?></s></p><br>
			      <input class="shop_del" type="button" value="-" />
			      <input class="shop_num" type="text" readonly="readonly" value="<?php echo $cart_info['goods_num'] ?>" />
			      <input class="shop_add" type="button" value="+" />
			      <img class="shop_del_img" onClick="del_cartGoods(<?php echo $cart_info['cart_id']; ?>)" src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/shop_del.png">
			    </dt>
			  </dl>
			</li>
			<?php } ?>
		</ul>
	</div>
  <?php } ?>
  </form>
  <?php }else{ ?>
  	<div style="color:#999; width:100%; height:83%; text-align:center; background:#FFF;"><span style="margin-top:2.9rem; display:inline-block;">购物车空空如也<span></span><br /><a href="index.php?act=wap_index" style="display:inline-block; width:1.8rem; height:0.5rem; border:0.02rem solid #999; line-height:0.5rem; border-radius:0.05rem; margin-top:0.2rem; color:#555;">随便逛逛</a></div>
  <?php } ?>
</div>
<?php if(!empty($output['store_cart_list']) && is_array($output['store_cart_list'])){ ?>
<div class="shopping_div"></div>
<!--结算-->
<div class="shopping_jiesuan">
	<ul>
		<li><input class="checkbox" type="checkbox" id="allselect" style="margin-top:0.2rem" /></li>
		<li><span>全选</span></li>
		<li class="shopping_list_one"><span>合计：</span>￥<em style="color:#f37978" id="total">0.00</em><p>不含运费</p></li>
		<li class="shopping_list_two"><span class="shopping_jiesuan_span">结算（<em id="shop_all" style="color:#FFF;"></em>）</span></li>
	</ul>
</div>
<?php } ?>
<!--结算结束-->
<!---商品加减算总数---->
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/zepto.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/carousel-image.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/common.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('input[type="checkbox"]').attr('checked', true).addClass("checked").removeClass('checkbox');
	$('.all_foot .home_foot a').eq(2).addClass('icon-bot-c');
	setTotal();
	//选择商品购买数量并计算价格
	$(".shop_add").click(function () {
		$(this).siblings('.shop_num').val(parseInt($(this).siblings('.shop_num').val()) + 1)
		var xianshi_num = $(this).parents('.shopping_dt').find('.get_goods_price').attr('enctype');
		var xianshi_price = $(this).parents('.shopping_dt').find('.get_goods_price').attr('nctype');
		var no_xianshi_price = $(this).parents('.shopping_dt').find('.get_goods_price').attr('ctype');
		var shop_input = $(this).parents('.shopping_dt').siblings('.shopping_list_input').find('input');
		if(xianshi_num > 0){
			if(xianshi_num <= $(this).siblings('.shop_num').val()){
				$(this).parents('.shopping_dt').find('.get_goods_price').html('￥'+xianshi_price);
				shop_input.attr('nctype', xianshi_price);
			}else{
				$(this).parents('.shopping_dt').find('.get_goods_price').html('￥'+no_xianshi_price);
				shop_input.attr('nctype', no_xianshi_price);
			}
		}
		ajax_getCartNum(shop_input.attr('enctype'), $(this).siblings('.shop_num').val());
		setTotal();
	});
	$(".shop_del").click(function () {
		if($(this).siblings('.shop_num').val()>1){
			$(this).siblings('.shop_num').val(parseInt($(this).siblings('.shop_num').val()) - 1)
			var xianshi_num = $(this).parents('.shopping_dt').find('.get_goods_price').attr('enctype');
			var xianshi_price = $(this).parents('.shopping_dt').find('.get_goods_price').attr('nctype');
			var no_xianshi_price = $(this).parents('.shopping_dt').find('.get_goods_price').attr('ctype');
			var shop_input = $(this).parents('.shopping_dt').siblings('.shopping_list_input').find('input');
			if(xianshi_num > 0){
				if(xianshi_num <= $(this).siblings('.shop_num').val()){
					$(this).parents('.shopping_dt').find('.get_goods_price').html('￥'+xianshi_price);
					shop_input.attr('nctype', xianshi_price);
				}else{
					$(this).parents('.shopping_dt').find('.get_goods_price').html('￥'+no_xianshi_price);
					shop_input.attr('nctype', no_xianshi_price);
				}
			}
			ajax_getCartNum(shop_input.attr('enctype'), $(this).siblings('.shop_num').val());
			setTotal();
		}
	});
	
	$(".newslist").on('click', function(){
		if ($(this).attr("checked")) {
			$(this).attr("checked", false);
			$(this).removeClass("checked").addClass('checkbox');
			$(this).parents('li').siblings('.shopping_list_li1').find('.shopall').removeClass("checked").addClass('checkbox').attr('checked', false);
			$("#allselect").removeClass("checked").addClass('checkbox').attr('checked', false);
		} else {
			$(this).attr("checked", true);
			$(this).addClass("checked").removeClass('checkbox');
		}
		setTotal();
	});
	// 全选        
	$("#allselect").click(function () {
		if($(this).attr("checked")){
			$(this).attr("checked", false);
			$(this).removeClass("checked").addClass("checkbox");
			$("input[type=checkbox]").each(function () {
				$(this).attr("checked", false);
				$(this).removeClass("checked").addClass("checkbox");
			});
		}else{
			$(this).attr("checked", true);
			$(this).removeClass("checkbox").addClass("checked");
			$("input[type=checkbox]").each(function () {
				$(this).attr("checked", true);
				$(this).removeClass("checkbox").addClass("checked");
			});
		}
		setTotal();
	});
	//	店铺全选      
	$(".shopall").click(function () {
		if($(this).attr("checked")){
			$(this).attr("checked", false);
			$(this).removeClass("checked").addClass("checkbox");
			$(this).parents('.shopping_list_concnet').find(".newslist").each(function () {
				$(this).attr("checked", false);
				$(this).removeClass("checked").addClass("checkbox");
			});
			$('#allselect').removeClass("checked").addClass('checkbox').attr('checked', false);
		}else{
			$(this).attr("checked", true);
			$(this).removeClass("checkbox").addClass("checked");
			$(this).parents('.shopping_list_concnet').find(".newslist").each(function(){
				$(this).attr("checked", true);
				$(this).removeClass("checkbox").addClass("checked");
			});
		}
		setTotal();
	});
	//结算购物车
	$('.shopping_jiesuan_span').click(function(){
		var shop_num = parseInt($('#shop_all').html());
		if(shop_num > 0){
			$('#cart_form').submit();
		}else{
			showError('请选择要结算的商品');
		}
	});
});
//计算总价钱,总数量
function setTotal() {
	var all_price = 0;
	var all_num = 0;
	$('.shopping_list_li2').each(function(){
		$(this).find('.newslist').val($(this).find('.newslist').attr('enctype')+'|'+$(this).find('.shop_num').val());
		if($(this).find('.newslist').attr('checked')){
			var num = $(this).find('.shop_num').val();
			var price = $(this).find('.newslist').attr('nctype');
			var price_cart = parseInt(num)*parseFloat(price);
		}else{
			var num = 0;
			var price_cart = 0;
		}
		all_price += price_cart;
		all_num += parseInt(num);
	});
	all_price = get_price(all_price);
	$('#total').html(all_price);
	$('#shop_all').html(all_num);
}
//价格格式化
function get_price(price){
	if(parseInt(price) == price){
		price = price + '.00';
	}else if(parseInt(price/0.1) == (price/0.1)){
		price = price + '0';
	}
	return price;
}
//异步更改购物车数量
function ajax_getCartNum(cart_id, goods_num){
	$.get('index.php?act=wap_cart&op=add_cart_num', {cart_id:cart_id, goods_num:goods_num}, function(msg){
		if(msg){
			showError('系统错误，请联系客服');
			return false;
		}
	});
}
//删除购物车商品
function del_cartGoods(cart_id){
	if(confirm('确认删除？')){
		$.get('index.php?act=cart&op=del', {cart_id:cart_id}, function(date){
			var dataJson = eval('(' + date + ')');
			if(dataJson.state){
				showDialog('删除成功！', 2, 'index.php?act=wap_cart');
			}else{
				showError(dataJson.msg);
			}
		});
	}else{
		return false;
	}
}
</script>
</body>
</html>
