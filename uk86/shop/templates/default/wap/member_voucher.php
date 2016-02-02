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
<title>优康_卡券包</title>
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/main.css" type="text/css" media="all">
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/base.css" type="text/css" media="all">
</head>
<body style="background:#F5F5F5;">
<!--顶部-->
<header id="header">
	<div class="header_con">
	<div class="headerleft">
		<i onClick="javascript:history.back();" class="icon-arrow-left"></i>
	</div>
	<div class="top-tit-div">我的卡券包</div>
	<div class="headerRight"></div>
	</div>
</header>
<!--顶部结束-->

<div id="content" class="p_bottom_b" style="background:#F5F5F5;">
  <?php if(!empty($output['voucher_list']) && is_array($output['voucher_list'])){ ?>
	<?php foreach ($output['voucher_list'] as $k => $v){ ?>
	<div class="card_list">
		<span>代金券编码：<em><?php echo $v['voucher_code']; ?></em></span>
		<div class="card_list_bg">
			<ul>
				<li class="card_list_name"><dl><dt><img src="<?php echo $v['voucher_t_img']; ?>" onerror="this.src='<?php echo UPLOAD_SITE_URL.DS.uk86_defaultGoodsImage(240);?>'"><span><?php echo $v['voucher_title']; ?></span><dt>订单满<em><?php echo $v['voucher_limit']; ?></em>元使用</dt><dt>有效期：<?php echo date('Y.m.d', $v['voucher_start_date']); ?>-<?php echo date('Y.m.d', $v['voucher_end_date']); ?></dt></dt></dl></li>
				<a href="<?php if($v['voucher_state'] == 1){echo 'index.php?act=wap_store&op=store_info&store_id='.$v['voucher_store_id'];}else{echo 'javascript:void(0);';} ?>"><li class="<?php if($v['voucher_state'] == 1){echo 'card_list_new';}elseif ($v['voucher_state'] == 2){echo 'card_list_old';}else{echo 'card_list_pass';} ?>"><dl class="card_new_1"><dt>￥<em><?php echo $v['voucher_t_price']; ?></em></dt><dt>立即使用</dt><dt><?php if($v['voucher_state'] != 1){ ?><img src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/card_no.png"><?php } ?></dt></dl></li></a>
			</ul>
			
		</div>
	</div>
	<?php } ?>
  <?php }else{ ?>
    <div style="color:#999; width:100%; height:71%; text-align:center; background:#FFF;"><span style="margin-top:2.9rem; display:inline-block;">您还没有卡卷包<span></span><br /><a href="index.php?act=wap_UCoin" style="display:inline-block; width:1.8rem; height:0.5rem; border:0.02rem solid #999; line-height:0.5rem; border-radius:0.05rem; margin-top:0.2rem; color:#555;">去兑换</a></div>
  <?php } ?>
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