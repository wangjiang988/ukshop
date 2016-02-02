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
<title>优康_话题详情</title>
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL; ?>/css/wap/base.css" type="text/css" media="all">
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL; ?>/css/wap/refund.css" type="text/css" media="all">
</head>
<body>
<!--顶部-->
<header id="header">
<div class="header_con">
	<div class="headerleft">
		<i class="icon-arrow-left"></i>
	</div>
	<div class="top-hk-div">
		<span>退款</span>
	</div>
	<div class="headerRight">
		
	</div>
</div>
</header>
<!--顶部结束-->
<div id="content" class="p_bottom" style="background:#fff;">
<div class="refund_title_div">
	<ul class="refund_title_ul">
		<li class="refund_title_li01">买家申请退款</li>
		<li class="refund_title_li02 refund_select">卖家处理退款申请</li>
		<li class="refund_title_li03">退款完成</li>
	</ul>
</div>
<div class="refund_two_title">
	<span class="refund_two_title_span">您已成功申请退款，等待卖家处理退款申请。</span>
</div>
<div class="refund_two_xg">
	<span class="refund_two_xg_span"><?php echo $output['refund_info']['store_name'];?>还有<span id="timer"><em>02</em>天<em>23</em>时<em>58</em>分<em>48</em>秒</span>来处理您的申请，逾期未处理则自动退款给您。</span>
	<a href="index.php?act=wap_refund_order&op=refund&order_id=<?php echo $output['refund_info']['order_id'];?>"><div class="refund_two_fdiv"><input type="submit" value="修改退款申请" class="refund_two_submit"></div></a>
</div>
<div class="refund_two_foot">
	<div class="refund_two_list">
		<ul class="refund_two_ul">
			<li class="refund_two_li01">退款编号：</li>
			<li class="refund_two_li02"><?php echo $output['refund_info']['order_sn'];?></li>
		</ul>
		<ul class="refund_two_ul">
			<li class="refund_two_li01">申请时间：</li>
			<li class="refund_two_li02"><?php echo date('Y-m-d',$output['refund_info']['add_time']);?></li>
		</ul>
		<!--<ul class="refund_two_ul">
			<li class="refund_two_li01">退款类型：</li>
			<li class="refund_two_li02"></li>
		</ul>-->
		<ul class="refund_two_ul">
			<li class="refund_two_li01">退款状态：</li>
			<li class="refund_two_li02">退款申请等待卖家确认</li>
		</ul>
		<ul class="refund_two_ul">
			<li class="refund_two_li01">退款金额：</li>
			<li class="refund_two_li02"><?php echo $output['refund_info']['refund_amount'];?></li>
		</ul>
		<ul class="refund_two_ul">
			<li class="refund_two_li01">退款原因：</li>
			<li class="refund_two_li02"><?php echo $output['refund_info']['refund_reason'];?></li>
		</ul>
		<ul class="refund_two_ul">
			<li class="refund_two_li01">退款说明：</li>
			<li class="refund_two_li02"><?php echo $output['refund_info']['buyer_message'];?></li>
		</ul>
	</div>
</div>
	
</div>

<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/wap/common.js"></script>
<script type="text/javascript">
	function timer(){


		var $starttime = <?php echo intval($output['refund_info']['add_time']);?>;
		var $endtime =  $starttime+3600*24*3;;
		var $nowtime=Math.floor(new Date().getTime()/1000);
		var lefttime=$endtime-$nowtime;//实际剩下的时间（秒）
		var day=0;
		var hour=0;
		var minute=0;
		var mis=0;
		if(lefttime>0){
			day=Math.floor(lefttime/(3600*24));
			hour=Math.floor((lefttime-day*3600*24)/3600);
			minute=Math.floor((lefttime-day*3600*24-hour*3600)/60);
			mis=Math.floor(lefttime-day*3600*24-hour*3600-minute*60);
		}

		console.log('<em>'+day+'</em>天<em>'+hour+'</em>时<em>'+minute+'</em>分<em>'+mis+'</em>秒');
        document.getElementById('timer').innerHTML='<em>'+day+'</em>天<em>'+hour+'</em>时<em>'+minute+'</em>分<em>'+mis+'</em>秒';
	}

	//timer();


    $(function(){
		setInterval(timer,1000);
	});

</script>
</body>
</html>