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
#fcode{float:left; background:#FFF; width:3.8rem; border:0.02rem solid #CCC; line-height:0.4rem; color:#AAA;}
#submit_fcode{float:left;}
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
<!--顶部结束-->
<div id="content" class="p_bottom" style="background:#F5F5F5;">
<form method="post" id="order_form" name="order_form" action="index.php">
<div class="fmjs_addr <?php if($output['store_mention'] == 2){ echo 'not_address'; }?>">
 	<?php if($output['store_mention'] == 2){ ?>
 	  <ul>
 	    <li class="fmjs_addr_1"><img src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/fmjs_dz.png"></li>
 	    <li class="fmjs_addr_2"><dl><dt>店铺：<span><?php echo $output['store_info']['live_store_name']; ?></span><em><?php echo $output['store_info']['live_store_tel'] ?></em></dt>
 	    <dt style="line-height:0.4rem;">店铺地址：<span><?php echo $output['store_info']['live_store_address']; ?></span></dt></dl></li>
 	  </ul>
 	<?php }else{ ?>
	<ul>
		<li class="fmjs_addr_1"><img src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/fmjs_dz.png"></li>
		<?php if(!empty($output['address_info']) && is_array($output['address_info'])){ ?>
		<li class="fmjs_addr_2"><dl><dt>收件人：<span><?php echo $output['address_info']['true_name']; ?></span><em><?php echo $output['address_info']['mob_phone'] ?></em></dt><dt style="line-height:0.4rem;">收货地址：<span><?php echo $output['address_info']['area_info'].'&nbsp;'.$output['address_info']['address']; ?></span></dt></dl></li>
		<?php }else{ ?>
		<li class="fmjs_addr_2"><span style="color:#666; line-height:1.3rem;">请编辑收货地址</span></li>
		<?php } ?>
		<li class="fmjs_addr_3"><img src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/order_right.png"></li>
	</ul>
	<?php } ?>
</div>
<div class="fmjs_list">
  	<?php $all_goods_price = 0; ?>
	<?php foreach($output['store_cart_list'] as $store_id => $cart_list) {?>
	  <ul>
	    <li class="fmjs_list_1"><img src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/order_home.png"><span><?php echo $cart_list[0]['store_name']; ?></span></li>
	    <?php $store_freight = 0.00; ?>
	    <?php foreach($cart_list as $cart_info) {?>
	    <?php $store_freight += floatval($cart_info['goods_freight']); ?>
	    <li class="fmjs_list_2">
	      <dl>
	        <dt style="width:25%;">
	          <?php if ($cart_info['state'] && $cart_info['storage_state']) {?><input type="hidden" value="<?php echo $cart_info['cart_id'].'|'.$cart_info['goods_num'];?>" name="cart_id[]"><?php } ?>
	    	  <img title="<?php echo $cart_info['goods_name']; ?>" src="<?php echo uk86_thumb($cart_info, 240);?>">
	        </dt>
	        <dt style="width:70%;">
	          <span><em title="<?php echo $cart_info['goods_name']; ?>"><?php echo $cart_info['goods_name']; ?></em><em>￥<?php echo $cart_info['goods_price']; ?></em></span>
	          <span style="color:#C5C5C5;font-size:0.23rem;"><em><?php if(!empty($cart_info['goods_spec'])){echo '规格：'; foreach(unserialize($cart_info['goods_spec']) as $sepc_v){echo $sepc_v.'&nbsp;&nbsp;';}}else{echo '购买数量:';} ?></em><em>X<?php echo $cart_info['goods_num'] ?></em></span>
	          <span><em>&nbsp;</em><em>&nbsp;</em></span>
	          <span><em>小计：</em><em>￥<?php echo $cart_info['goods_total']; ?></em></span>
	        </dt>
	      </dl>
	    </li>
	    <?php } ?>
	  </ul>
	  <div class="fmjs_list_foot">
		<div class="fmjs_list_foot_1"><em id="eachStoreFreight_<?php echo $store_id;?>"><?php if($output['store_mention'] == '2'){ echo '（店铺自提,无运费）'; $store_freight = 0.00;} else{ echo '￥'.$store_freight;if(intval($store_freight) == $store_freight){echo '.00';}elseif(intval($store_freight / 0.1) == ($store_freight / 0.1)){echo '0';} } ?></em><span>运费：	</span></div>
		<?php if (!empty($output['store_mansong_rule_list'][$store_id]['discount'])) { $output['store_goods_total'][$store_id] = $output['store_goods_total'][$store_id] - $output['store_mansong_rule_list'][$store_id]['discount']; ?>
		<div class="fmjs_list_foot_1"><em>-<?php echo $output['store_mansong_rule_list'][$store_id]['discount'];?></em><span>满即送-<?php echo $output['store_mansong_rule_list'][$store_id]['desc'];?>：</span></div>
		<?php } ?>
		<?php if (!empty($output['store_voucher_list'][$store_id]) && is_array($output['store_voucher_list'][$store_id])) {?>
		<div class="fmjs_list_foot_1"><em class="voucher_price_<?php echo $store_id;?>">-0.00</em><span>
			<select nctype="voucher" enctype="<?php echo $store_id;?>" name="voucher[<?php echo $store_id;?>]">
                  <option value="<?php echo $voucher['voucher_t_id'];?>|<?php echo $store_id;?>|0.00">选择卡券包</option>
                  <?php foreach ($output['store_voucher_list'][$store_id] as $voucher) {?>
                  <option value="<?php echo $voucher['voucher_t_id'];?>|<?php echo $store_id;?>|<?php echo $voucher['voucher_price'];?>"><?php echo $voucher['desc'];?></option>
                  <?php } ?>
            </select>：
		</span></div>
		<?php } ?>
		<div class="fmjs_list_foot_2"><em class=" heji_<?php echo $store_id ?>" storeprice="<?php echo floatval($output['store_goods_total'][$store_id])+$store_freight; ?>" style="font-size:0.25rem;">￥<?php echo $store_goods_total = (floatval($output['store_goods_total'][$store_id])+$store_freight);if(intval($store_goods_total) == $store_goods_total){echo '.00';}elseif(intval($store_goods_total / 0.1) == ($store_goods_total / 0.1)){echo '0';} $all_goods_price += $store_goods_total; ?></em><span>本店合计：</span></div>
		<textarea rows="4" style="width:6.1rem; font-size:0.25rem;" class="fmjs_ly" name="pay_message[<?php echo $store_id ?>]" placeholder="给卖家留言"></textarea>
	</div>
	<?php } ?>
	<?php /*if($output['available_pd_amount'] > 0){*/?><!--
	 <div class="pay_amount">
	  <label><input type="checkbox" name="pd_pay" value="1" id="mr5"/>&nbsp;使用预存款（可用金额：<em><?php /*echo $output['available_pd_amount']; */?></em>元）</label>
	  <?php /*if($output['member_paypwd'] == ''){ */?>
	  <div class="pay_pwd">您还没有设置支付密码，去&nbsp;<a href="javascript:void(0);">设置</a></div>
	  <?php /*}else{ */?>
	  <input type="hidden" name="password_callback" id="password_callback"/>
	  <div class="pay_pwd">支付密码：<input type="password" name="password" maxlength="35" id="pay_password" autocomplete="off"/> <input type="button" value="使用" class="pay_use"/></div>
	  <?php /*} */?>
	 </div>
	--><?php /*} */?>
	<div class="fmjs_foot submit_order">
		<input type="button" class="submit_order" value="提交订单" /><span>应付款：<em class="all_price">￥<?php echo $all_goods_price; if(intval($all_goods_price) == $all_goods_price){echo '.00';}elseif(intval($all_goods_price / 0.1) == ($all_goods_price / 0.1)){echo '0';} ?></em></span>
	</div>
	<!-- F码购买 -->
	<?php if($output['store_cart_list'][key($output['store_cart_list'])][0]['is_fcode'] == 1){ ?>
	  <div class="fmjs_foot submit_fcode">
	    <input type="text" name="fcode" id="fcode" autocomplete="off" placeholder="请输入F码" maxlength="20"/>
	    <input type="button" value="使用F码" id="fcode_submit"/>
	    <input value="" type="hidden" name="fcode_callback" id="fcode_callback">
      <input type="hidden" id="goods_commonid" name="goods_commonid" value="<?php echo $output['store_cart_list'][key($output['store_cart_list'])][0]['goods_commonid'];?>">
	  </div>
	<?php } ?>
	<input value="wap_buy" type="hidden" name="act">
    <input value="buy_step2" type="hidden" name="op">
    <input value="<?php echo $output['ifcart'];?>" type="hidden" name="ifcart">
    <input value="online" name="pay_name" id="pay_name" type="hidden">
    <input value="<?php echo $output['vat_hash'];?>" name="vat_hash" type="hidden">
    <input value="<?php if($output['store_mention'] == 2){echo '1';}else{ echo $output['address_info']['address_id'];}?>" name="address_id" id="address_id" type="hidden">
	<input value="<?php if($output['store_mention'] == 2){echo '1';}?>" name="buy_city_id" id="buy_city_id" type="hidden">
    <input value="" id="allow_offpay" name="allow_offpay" type="hidden">
    <input value="" id="allow_offpay_batch" name="allow_offpay_batch" type="hidden">
    <input value="" id="offpay_hash" name="offpay_hash" type="hidden">
    <input value="" id="offpay_hash_batch" name="offpay_hash_batch" type="hidden">
    <input value="<?php if($output['store_mention'] == 2){echo '1';} ?>" name="mention_radio" type="hidden">
	<input style="display:none;" type="radio" value="online" checked="checked" name="payment_type" id="payment_type_online">
    <input value="<?php echo $output['inv_info']['inv_id'];?>" name="invoice_id" id="invoice_id" type="hidden">
    <input value="<?php echo uk86_getReferer();?>" name="ref_url" type="hidden">
</div>
</form>
</div>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/common.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/zepto.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/carousel-image.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/common.js"></script>
<script type="text/javascript">
var SUBMIT_FORM = true;
$(document).ready(function(){
	$('.all_foot').hide();
	<?php if($output['store_mention'] != 2){ ?>
	  <?php if (!empty($output['address_info']['address_id'])) {?>
		uk86_showShippingPrice(<?php echo $output['address_info']['city_id'];?>,<?php echo $output['address_info']['area_id'];?>);
	  <?php } ?>
	<?php } ?>
	$('.submit_order').on('click', function(){uk86_submitNext();});
	$('.fmjs_addr').on('click', function(){
		if($(this).hasClass('not_address')){return false;}
		window.location.href="index.php?act=wap_buy&op=load_addr&address_id=<?php echo $output['address_info']['address_id'] ?>";
	});
	//选择卡券包
	$('select[nctype="voucher"]').change(function(){
		var store_id = $(this).attr('enctype');
		var val = $(this).val();
		var price = val.split("|");
		$('.voucher_price_'+store_id).html('-'+get_price(price[2]));
		var store_price = $('.heji_'+store_id).attr('storeprice');
		$('.heji_'+store_id).html('￥'+get_price(parseFloat(store_price)-price[2]));
		var all_price_new = 0;
		$('.fmjs_list_foot_2').each(function(){
			var x = $(this).children('em').html().split("￥");
			all_price_new += parseFloat(x[1]);
		});
		$('.all_price').html('￥'+get_price(all_price_new));
	});
	$('.pay_pwd').hide();
	//余额支付
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
	<?php if($output['store_cart_list'][key($output['store_cart_list'])][0]['is_fcode'] == 1){ ?>
	//F码验证
	  $('.submit_order').hide();
	  $('#fcode_submit').click(function(){
		var fcode = $('#fcode').val();
		if(fcode == ''){
			showError('请输入F码');
			$('#fcode').focus();		 
			return false;
		}
		$.get("index.php?act=wap_buy&op=check_fcode", {'fcode':fcode,'goods_commonid':$('#goods_commonid').val()}, function(data){
			if(data == 1){
				$('#fcode_callback').val('1');
				$('.submit_fcode').hide();
				$('.submit_order').show();
				showDialog(fcode+'为有效的F码，您可以继续完成下单购买');
			}else{
				showError('F码错误，请重新输入');
				$('#fcode').focus();
			}
		});
	  });
	<?php } ?>
});
function uk86_showShippingPrice(city_id,area_id) {
	$('#buy_city_id').val('');
	$.ajaxSetup({
        async : false
    });
    $.post('index.php?act=wap_buy&op=change_addr', {'freight_hash':'<?php echo $output['freight_hash'];?>',city_id:city_id,'area_id':area_id}, function(data){
    	if(data.state == 'success') {
    	    $('#buy_city_id').val(city_id);
    	    $('#allow_offpay').val(data.allow_offpay);
            if (data.allow_offpay_batch) {
                var arr = new Array();
                $.each(data.allow_offpay_batch, function(k, v) {
                    arr.push('' + k + ':' + (v ? 1 : 0));
                });
                $('#allow_offpay_batch').val(arr.join(";"));
            }
    	    $('#offpay_hash').val(data.offpay_hash);
    	    $('#offpay_hash_batch').val(data.offpay_hash_batch);
    	    var content = data.content;
    	    var amount = 0;
            for(var i in content){
            	$('#eachStoreFreight_'+i).html(number_format(content[i],2));
            	amount = amount + parseFloat(content[i]);
            }
    	}

    },'json');
}
function uk86_submitNext(){
	if (!SUBMIT_FORM) return;

	if ($('input[name="cart_id[]"]').size() == 0) {
		showError('所购商品无效');
		return;
	}
    if ($('#address_id').val() == ''){
		showError('请填写收货地址');
		return;
	}
	if ($('#buy_city_id').val() == '') {
		showDialog('正在计算运费,请稍后');
		return;
	}
	if (($('input[name="pd_pay"]').attr('checked') || $('input[name="rcb_pay"]').attr('checked')) && $('#password_callback').val() != '1') {
		showError('预存款支付，需输入支付密码并使用 ');
		return;
	}
	if ($('input[name="fcode"]').size() == 1 && $('#fcode_callback').val() != '1') {
		showError('请输入并使用F码');
		return;
	}
	SUBMIT_FORM = false;

	$('#order_form').submit();
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
</script>
