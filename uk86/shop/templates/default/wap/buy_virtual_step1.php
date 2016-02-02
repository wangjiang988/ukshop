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
<title>优康_核对购物信息</title>
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/base.css" type="text/css" media="all">
<style type="text/css">
#mr5{width:0.25rem; height:0.25rem;}
.pay_amount{color:#454545; background:#FFF; font-size:0.25rem; line-height:0.4rem; text-align:right; width:5.45rem; padding:0.2rem 0.4rem; margin-left:-0.1rem; border:solid 0.04rem #FFAA01}
.pay_amount label em{font-family: Verdana, Arial; color:#000; font-weight:600;}
.pay_amount label input{margin-top:-0.08rem;}
#pay_password{width:2.5rem; height:0.45rem; border:0.02rem solid #AAA; line-height:0.4rem;}
.pay_use{width:1rem; line-height:0.4rem; height:0.45rem; padding:0; background:#FAA732; border:0.02rem solid #E1962D; color:#FFF; border-color:#E1962D #E1962D #BB7D25 #E1962D; font-size:0.25rem; font-weight:100;}
.pay_pwd a{color:#747ad9; text-decoration:underline;}
#buyer_phone{border:0.02rem solid #CCC; width:4rem; line-height:0.4rem; height:0.5rem;}
.info{margin-top:0.1rem; font-size:0.2rem; width:6rem;}
.info i{display:inline-block; width:0.2rem; height:0.2rem; background:url(<?php echo SHOP_TEMPLATES_URL ?>/images/wap/info.gif) no-repeat; background-size:0.2rem 0.2rem;position:relative; top:0.02rem;}
</style>
</head>
<body style="background:#F5F5F5;">
<!--顶部-->
<header id="header">
<div class="header_con">
	<div class="headerleft">
		<i onClick="javascript:history.back(-1);" class="icon-arrow-left"></i>
	</div>
	<div class="top-hk-div">
		<span>核对购物信息</span>
	</div>
	<div class="headerRight">
		
	</div>
</div>
</header>

<div id="content" class="p_bottom" style="background:#F5F5F5;">
<form method="post" id="order_form" action="index.php?act=wap_buy_virtual&op=buy_step2">
<input type="hidden" name="goods_id" value="<?php echo $output['goods_info']['goods_id'];?>">
<input type="hidden" name="quantity" value="<?php echo $output['goods_info']['quantity'];?>">
<div class="fmjs_addr">
  <ul>
    <li style="font-size: 0.3rem;">电子兑换码接收方式</li><br />
    <hr style="margin-top:0.1rem; width:6rem; border:0; border-top:0.02rem dashed #CCC;" />
    <li style="line-height:0.5rem; margin-top:0.1rem;">手机号码：<input type="text" name="buyer_phone" maxlength="11" autocomplete = "off" id="buyer_phone"/></li>
    <li class="info"><i></i>&nbsp;您本次购买的商品不需要收货地址，请正确输入接收手机号码，确保及时获得“电子兑换码”。可使用您已经绑定的手机或重新输入其它手机号码。</li>
  </ul>
</div>
<div class="fmjs_list">
	  <ul>
	    <li class="fmjs_list_1"><img src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/order_home.png"><span><?php echo $output['store_info']['store_name']; ?></span></li>
	    <li class="fmjs_list_2">
	      <dl>
	        <dt style="width:25%;">
	    	  <img title="<?php echo $output['goods_info']['goods_name']; ?>" src="<?php echo uk86_thumb($output['goods_info'], 240);?>">
	        </dt>
	        <dt style="width:70%;">
	          <span><em title="<?php echo $output['goods_info']['goods_name']; ?>"><?php echo $output['goods_info']['goods_name']; ?></em><em>￥<?php echo $output['goods_info']['goods_price']; ?></em></span>
	          <span style="color:#C5C5C5;font-size:0.23rem;"><em>购买数量:</em><em>x&nbsp;<?php echo $output['goods_info']['quantity'] ?></em></span>
	          <span><em>&nbsp;</em><em>&nbsp;</em></span>
	          <span><em>小计：</em><em>￥<?php echo $output['goods_info']['goods_total']; ?></em></span>
	        </dt>
	      </dl>
	    </li>
	  </ul>
	  <div class="fmjs_list_foot">
		<div class="fmjs_list_foot_2"><em style="font-size:0.25rem;">￥<?php echo $output['goods_info']['goods_total']; ?></em><span>商品总价：</span></div>
		<textarea rows="4" style="width:6.1rem; font-size:0.25rem;" class="fmjs_ly" name="buyer_msg" placeholder="给卖家留言"></textarea>
	</div>
	<?php if($output['member_info']['available_predeposit'] > 0){ ?>
	 <div class="pay_amount">
	  <label><input type="checkbox" name="pd_pay" value="1" id="mr5"/>&nbsp;使用预存款（可用金额：<em><?php echo $output['member_info']['available_predeposit']; ?></em>元）</label>
	  <?php if($output['member_info']['member_paypwd'] == ''){ ?>
	  <div class="pay_pwd">您还没有设置支付密码，去&nbsp;<a href="javascript:void(0);">设置</a></div>
	  <?php }else{ ?>
	  <input type="hidden" name="password_callback" id="password_callback"/>
	  <div class="pay_pwd">支付密码：<input type="password" name="password" maxlength="35" id="pay_password" autocomplete="off"/> <input type="button" value="使用" class="pay_use"/></div>
	  <?php } ?>
	 </div>
	<?php } ?>
	<div class="fmjs_foot submit_order">
		<input type="button" class="submit_order" value="提交订单" /><span>应付款：<em>￥<?php echo $output['goods_info']['goods_total']; ?></em></span>
	</div>
</div>
</form>
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/zepto.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/carousel-image.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/common.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	//余额支付
	$('.pay_pwd').hide();
	$('#mr5').click(function(){
		if($(this).attr('checked')){
			$('.pay_pwd').show();
		}else{
			$('.pay_pwd').hide();
			$('#password_callback').val('');
			$('#pay_password').val('')
		}
	});
	$('.pay_use').click(function(){
		if($('#pay_password').val() == ''){return false;}
		$.get('index.php?act=wap_buy&op=check_pd_pwd', {password:$('#pay_password').val()}, function(msg){
			if(msg > 0){
				$('#password_callback').val('1');
				$('.pay_pwd').hide();
			}else{
				showError('支付密码不正确');
			}
		});
	});
	$('.submit_order').click(function(){
		if (($('input[name="pd_pay"]').attr('checked') || $('input[name="rcb_pay"]').attr('checked')) && $('#password_callback').val() != '1') {
			showError('预存款支付，需输入支付密码并使用 ');
			return;
		}
		if($('input[name=buyer_phone]').val() == '' || $('input[name=buyer_phone]').val().length < 11){
			showError('请输入正确的手机号码，以便及时获得“电子兑换码”');
		}
		//$('#order_form').submit();
	});
});
//价格格式化
function get_price(price){
	if(parseInt(price) == price){
		price = price + '.00';
	}else if(parseInt(price/0.1) == (price/0.1)){
		price = price + '0';
	}
	return price;
}
</script>
</body>
</html>
