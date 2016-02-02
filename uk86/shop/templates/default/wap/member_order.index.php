<?php defined('InUk86') or exit('Access Invalid!'); ?>
<?php //p($output);die(); ?>
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
<title>优康_我的订单</title>
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL; ?>/css/wap/main.css" type="text/css" media="all">
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL; ?>/css/wap/base.css" type="text/css" media="all">
<style type="text/css">
input[type=radio]{width:0.2rem; height:0.2rem;}
</style>
</head>
<body style="background:#F5F5F5;">
<!--顶部-->
<header id="header">
	<div class="header_con">
		<div class="headerleft">
			<a href="index.php?act=wap_member"><i class="icon-arrow-left"></i></a>
		</div>
		<div class="top-tit-div">我的订单</div>
		<div class="headerRight">
		</div>
	</div>
</header>
<!--顶部结束-->

<div id="content" class="p_bottom_b" style="background:#F5F5F5;">
	<form id="state_type_form" method="get">
	  <input type="hidden" name="act" value="wap_member_order"/>
	  <input type="hidden" name="op" value="index"/>
	  <input type="hidden" id="order_type" name="state_type" value=""/>
	</form>
	<!--搜索标题-->
	<div class="list_order_tit clearfixd">		
    	<ul>
        	<li nctype="" <?php if($_GET['state_type'] == ''){echo 'class="l_top_c"';} ?>>全部</li>
			<li nctype="state_new" <?php if($_GET['state_type'] == 'state_new'){echo 'class="l_top_c"';} ?>>待付款</li>
			<li nctype="state_pay" <?php if($_GET['state_type'] == 'state_pay'){echo 'class="l_top_c"';} ?>>待发货</li>
            <li nctype="state_send" <?php if($_GET['state_type'] == 'state_send'){echo 'class="l_top_c"';} ?>>待收货</li>
            <li nctype="state_noeval" <?php if($_GET['state_type'] == 'state_noeval'){echo 'class="l_top_c"';} ?>>待评价</li>
        </ul>
	</div>
	<!--搜索标题结束-->
	<?php if(!empty($output['order_group_list']) && is_array($output['order_group_list'])){ ?>
	<?php foreach ($output['order_group_list'] as $order_pay_sn => $group_info){ $p = 0; ?>
	  <?php foreach ($group_info['order_list'] as $order_id => $order_info){ ?>
	    <div class="order_list_all">
		  <ul>
			<li class="order_list_1"><dl><dt class="order_list_home"><img src="<?php echo SHOP_TEMPLATES_URL; ?>/images/wap/order_home.png"></dt><dt><span><?php echo $order_info['store_name']; ?></span></dt><dt class="order_list_right"><img src="<?php echo SHOP_TEMPLATES_URL; ?>/images/wap/order_right.png"></dt><dt class="order_list_suc" style="float:right; margin-right:0.3rem;"><?php echo $order_info['state_desc'] ?></dt></dl></li>
			<li class="order_list_2">
			 <?php $i = 0; ?>
			 <?php foreach ($order_info['goods_list'] as $goods_info){ ?>  
			  <dl>
			    <dt><a href="<?php echo uk86_urlShop('wap_goods_info', 'index', array('goods_id'=>$goods_info['goods_id'])); ?>"><img style="width:1rem; height:1rem;" src="<?php echo $goods_info['image_240_url']; ?>"></a></dt>
			    <dt class="order_list_name"><a href="<?php echo uk86_urlShop('wap_goods_info', 'index', array('goods_id'=>$goods_info['goods_id'])); ?>"><span style="overflow:hidden; color:#424242; width:3.4rem; display:inline-block; height:0.8rem;"><?php echo $goods_info['goods_name'] ?></span></a></dt>
			    <dt class="order_list_val">￥<em><?php echo $goods_info['goods_price']; ?></em><p>x<?php echo $goods_info['goods_num']; $i += intval($goods_info['goods_num']); ?></p></dt>
			  </dl>
			 <?php } ?>
			</li>
			<li class="order_list_3">共<em><?php echo $i ?></em>件商品，合计￥<em><?php echo $order_info['order_amount']; ?></em><?php if($order_info['store_mentioning'] == 1){ echo '（门店自提商品）'; }else{?>（含运费￥<em><?php echo $order_info['shipping_fee']; ?></em>）<?php } ?></li>
			<li class="order_list_4"><dl> 
			    <a href="index.php?act=wap_member_order&op=show_order&order_id=<?php echo $order_info['order_id']; ?>" style="line-height:0.7rem; color:0279b9; font-size:0.25rem;">&nbsp;&nbsp;订单详情</a>
				<?php if ($order_info['if_receive']) { ?><dt><a onClick="order_manage('receive', <?php echo $order_info['order_id']; ?>);" class="order_check_2 hovered" style="padding:0 0.3rem 0 0.3rem;">确认收货</a></dt><?php } ?>
				<?php if (!empty($group_info['pay_amount']) && $p == 0) {?><dt><a onClick="order_manage('order_pay', <?php echo $order_info['order_id']; ?>);" class="order_check_4 hovered">支付订单</a></dt><?php } ?>
				<?php if ($order_info['if_evaluation']) { ?><dt><a onClick="order_manage('pin_jia', <?php echo $order_info['order_id']; ?>);" class="order_check_1 hovered">评价</a></dt><?php } ?>
				<?php if ($order_info['if_refund_cancel']){ ?><dt><a onClick="order_manage('order_refund', <?php echo $order_info['order_id']; ?>,<?php echo $order_info['order_sn']; ?>);" class="order_check_2 hovered">退款</a></dt><?php } ?>
				<?php if ($order_info['if_delete']) { ?><dt><a onClick="order_manage('delete', <?php echo $order_info['order_id'] ?>);" class="order_check_3 hovered">删除订单</a></dt><?php } ?>
				<?php if ($order_info['if_cancel']) { ?><dt><a onClick="order_manage('cancel', <?php echo $order_info['order_id'] ?>, <?php echo $order_info['order_sn']; ?>);" class="order_check_5 hovered">取消订单</a></dt><?php } ?>
			</dl></li>
		  </ul>
	    </div>
	  <?php } ?>
	  <?php $p++; ?>
	<?php } ?>
	<?php }else{ ?>
	 <div style="color:#999; width:100%; height:70%; text-align:center; background:#FFF;"><span style="margin-top:2.9rem; display:inline-block;">您还没有相关订单<span></span><br /><a href="index.php?act=wap_index" style="display:inline-block; width:1.8rem; height:0.5rem; border:0.02rem solid #999; line-height:0.5rem; border-radius:0.05rem; margin-top:0.2rem; color:#555;">随便逛逛</a></div>
	<?php } ?>
	<!-- 取消订单dialog -->
	 <div class="dialog_html">
	 	<form id="canacel_form" method="post">
	   	 <input type="hidden" name="act" value="wap_member_order"/>
	   	 <input type="hidden" name="op" value="change_state"/>
	     <input type="hidden" name="state_type" value="order_cancel"/>
	   <div class="dialogBody" style="top:2.5rem;">
	   <i class="close" onClick="dialog_hide();"></i>
	   <div class="dialogHead"><i class="icon-confirm"></i><p>取消订单</p></div>
	   <div class="dialogMsg" style="border-bottom: 0.02rem solid #ccc;">
	     <table style="color:#454545; font-size:0.25rem; line-height:0.35rem;">
	       <tr>
	         <td align="right">订单号：</td><td class="order_sn"></td>
	       </tr>
	       <tr>
	         <td align="right" valign="top">取消原因：</td>
	         <td>
	           <input type="radio" value="改买其他商品" name="state_info" checked="checked" id="d1"/><label for="d1">改买其他商品</label><br/>
	           <input type="radio" value="改用其他配送方式" name="state_info" id="d2"/><label for="d2">改用其他配送方式</label><br/>
	           <input type="radio" value="从其他店铺购买" name="state_info" id="d3"/><label for="d3">从其他店铺购买</label><br/>
	           <input type="radio" name="state_info" id="d4"/><label for="d4">其他原因</label><br/>
	           <textarea class="hidden" id="d5" name="state_info1" style="height:0.8rem; width:3.5rem; resize: none; border-radius:0.1rem; border:0.02rem solid #999; padding:0.1rem;"></textarea>
	         </td>
	       </tr>
	     </table>
	   </div>
	   <div class="closeTime"><a class="form_submit" style="background:#5BB75B">&nbsp;&nbsp;确定提交&nbsp;&nbsp;</a>&nbsp;&nbsp;&nbsp;&nbsp;<a class="hovered" onClick="dialog_hide();">&nbsp;&nbsp;取消&nbsp;&nbsp;</a></div>
	   </div>
	   </form>
	 </div>
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/zepto.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/carousel-image.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/common.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#d4').click(function(){
		$('#d5').removeClass('hidden');
	});
	$('#d4').siblings('input[type=radio]').click(function(){
		$('#d5').addClass('hidden').removeClass('border-color-red');
		$('#d5').val('');
	});
	$('#d5').focus(function(){$('#d5').removeClass('border-color-red');return;});
	$('.form_submit').click(function(){
		if(($('#d4').attr('checked') == 'checked' || $('#d4').attr('checked') == true) && $('#d5').val() == ''){
			$('#d5').addClass('border-color-red');
			return false;
		}
		$('#canacel_form').submit();
	});
	$('#content .dialog_html').hide();
	//订单分类
	$('.list_order_tit ul li').on('click', function(){
		if($(this).hasClass('l_top_c'))return;
		$('#order_type').val($(this).attr('nctype'));
		$('#state_type_form').submit();
	});
});

//订单处理
function order_manage(msg, order_id, order_sn){
	var order_type = '';
	var confirm_msg = '';
	if(msg == 'delete'){confirm_msg = '订单删除后不能恢复，确认删除订单？'; order_type = 'order_delete';
	}else if(msg == 'receive'){confirm_msg = '您确认已收到该订的单货品？'; order_type = 'order_receive';
	}else if(msg == 'cancel'){
		$('#canacel_form').attr('action', 'index.php?order_id='+order_id);
	 	$('.dialog_html').show();
	 	$('.order_sn').html(order_sn);
	 	return false;
	}else if(msg == 'pin_jia'){
		window.location.href="index.php?act=wap_goods_assess&order_id="+order_id;
		return false;
	}else if(msg=="order_refund"){
		window.location.href='index.php?act=wap_refund_order&op=refund&order_id='+order_id;
		return false;
	}
	if(confirm(confirm_msg)){
		window.location.href="index.php?act=wap_member_order&op=change_state&state_type="+ order_type +"&order_id="+order_id;
	}
}

function dialog_hide(){
	$('.dialog_html').hide(); 
	$('#d5').removeClass('border-color-red');	
}
</script>
</body>
</html>
