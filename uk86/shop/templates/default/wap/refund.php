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
<title>退款</title>
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL; ?>/css/wap/base.css" type="text/css" media="all">
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL; ?>/css/wap/refund.css" type="text/css" media="all">
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/wap/jquery.min.js"></script>
</head>
<body>
<!--顶部-->
<header id="header">
<div class="header_con">
	<div class="headerleft">
		<a href="/index.php?act=wap_member_order&op=index&state_type=state_pay"><i class="icon-arrow-left"></i></a>
	</div>
	<div class="top-hk-div">
		<span>退款</span>
	</div>
	<div class="headerRight">
		
	</div>
</div>
</header>
<!--顶部结束-->
<form action="/index.php?act=wap_refund_order&op=seller_refund" method="post">
	<input type="hidden" name="act" value="wap_refund_order"/>
	<input type="hidden" name="op" value="seller_refund"/>
	<input type="hidden" name="order_id" value="<?php echo $output['refund_order']['order_id'];?>"/>
	<input type="hidden" name="order_amount" value="<?php echo $output['refund_order']['order_amount'];?>"/>
	<div id="content" class="p_bottom" style="background:#fff;">
		<div class="refund_title_div">
			<ul class="refund_title_ul">
				<li class="refund_title_li01 refund_select">买家申请退款</li>
				<li class="refund_title_li02">卖家处理退款申请</li>
				<li class="refund_title_li03">退款完成</li>
			</ul>
		</div>
		<div class="refund_content_div">
			<ul class="refund_one_ul">
				<li class="refund_one_li01"><span class="refund_one_span">申请退款：</span></li>
				<li class="refund_one_li02">
					<select class="refund_one_select01">
						<option>仅退款</option>
						<option>退款退货</option>
						<!--<option >其他</option>-->
					</select>
				</li>
			</ul>
			<ul class="refund_one_ul">
				<li class="refund_one_li01"><span class="refund_one_span">退款原因：</span></li>
				<li class="refund_one_li02">
					<i style="color:#F15555">*</i>
					<select class="refund_one_select02" name="reason_id">
						<?php foreach($output['reason_info'] as $item){?>
							<option value="<?php echo $item['reason_id'];?>"><?php echo $item['reason_info'];?></option>
						<?php }?>

						<option value="其他">其他</option>
					</select>
				</li>
			</ul>
			<ul class="refund_one_ul">
				<li class="refund_one_li01"><span class="refund_one_span">需要退款金额：</span></li>
				<li class="refund_one_li02">
					<i style="color:#F15555">*</i>
					<span class="refund_num"><?php echo $output['refund_order']['order_amount'];?></span><em class="refund_yuan">元</em>
				</li>
			</ul>
			<ul class="refund_one_ul">
				<li class="refund_one_li01"><span class="refund_one_span">退款说明：<br><span class="refund_one_span01">（0/200字）</span></span></li>
				<li class="refund_one_li02">
					<textarea rows="3" cols="20" name="buyer_message" class="refund_one_text"></textarea>
				</li>
			</ul>
			<ul class="refund_one_ul" style="margin-top:1rem;">
				<li class="refund_one_li01"><span class="refund_one_span">上传凭证：</span></li>
				<li class="refund_one_li02">
					<div class="refund_one_img"><input type="file" accept="image/*" class="refund_one_file"></div>

				</li>
			</ul>

			<div class="refund_one_submit"><input type="submit" value="提交申请"></div>
		</div>
</form>


	
</div>

<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/wap/common.js"></script>
</body>
</html>