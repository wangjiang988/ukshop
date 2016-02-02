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
<title>我的兑换码</title>
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/main.css" type="text/css" media="all">
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
		我的兑换码
	</div>
	<div class="headerRight">
		
	</div>
</div>
</header>
<!--顶部结束-->
<div id="content" class="p_bottom" style="background:#F5F5F5">
<!--搜索标题-->
<div class="list_code_tit clearfixd">		
	<ul>
		<li nctype="all" class="l_top_c head_title"><span>全部</span></li>
		<li style="width:0.1rem; margin-left:0; margin-right:0;"><img src="<?php echo SHOP_TEMPLATES_URL; ?>/images/wap/order_link.png"></li>
		<li nctype="is_used" class="head_title"><span>已兑换</span><em class="exc_code_em1"><span><?php echo count($output['recode_is_use']); ?></span></em></li>
		<li style="width:0.1rem; margin-left:0; margin-right:0;"><img src="<?php echo SHOP_TEMPLATES_URL; ?>/images/wap/order_link.png"></li>
		<li nctype="not_used" class="head_title"><span>未兑换</span><em class="exc_code_em2" style="color:#83C36C;border:0.03rem solid #83C36C;"><span><?php echo count($output['recode_not_use']); ?></span></em></li>
		<li style="width:0.1rem; margin-left:0; margin-right:0;"><img src="<?php echo SHOP_TEMPLATES_URL; ?>/images/wap/order_link.png"></li>
		<li nctype="pass" class="head_title"><span>已过期</span><em class="exc_code_em3" style="color:#F25654;border:0.03rem solid #F25654;"><span><?php echo count($output['recode_pass']); ?></span></em></li>
	</ul>
</div>
<div class="exc_code_list_ul all_recode_list">
  <?php if(!empty($output['code_list']) && is_array($output['code_list'])){ ?>
    <?php foreach ($output['code_list'] as $fcode_info){ ?>
	<ul>
		<li class="code_ul_dt_1"><dl><dt>兑换码：<em><?php echo $fcode_info['vr_code']; ?></em></dt><dt><?php if($fcode_info['free_state'] != 1){ ?><a href="javascript:void(0);"><img title="使用" src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/order_right.png"></a><?php } ?></dt></dl></li>
		<li class="code_ul_dt_2"><dl><dt><a href="index.php?act=wap_goods_info&op=index&goods_id=<?php echo $fcode_info['goods']['goods_id'] ?>"><img src="<?php echo uk86_thumb($fcode_info['goods'], 240); ?>"></a></dt><dt><a href="index.php?act=wap_goods_info&op=index&goods_id=<?php echo $fcode_info['goods']['goods_id'] ?>"><span><?php echo $fcode_info['goods']['goods_name']; ?></span></a><p><?php if(!empty($fcode_info['vr_usetime'])){ ?>使用时间：<em style="display:inline-block; width:2.5rem;"><?php echo date('Y-m-d H:i',$fcode_info['vr_usetime']); ?></em><?php }else{?>过期时间：<em style="display:inline-block; width:2.5rem;"><?php echo date('Y-m-d H:i', $fcode_info['vr_indate']) ?></em><?php } ?>
		<?php if($fcode_info['vr_state'] == 1){ ?><em class="code_em_name" style="color:#AAA;">已使用</em><?php }elseif($fcode_info['vr_state'] == 2){?><em class="code_em_name" style="color:#F25257;">已过期</em><?php }else{ ?><em class="code_em_name">未使用</em><?php } ?></p></dt></dl></li>
	</ul>
	<?php } ?>
  <?php }else{ ?>
    <div style="color:#999; width:100%; height:71%; text-align:center; background:#FFF;"><span style="margin-top:2.9rem; display:inline-block;">您还没有兑换码<span></span><br /></div>
  <?php } ?>
</div>

<div class="exc_code_list_ul is_use_recode hidden">
  <?php if(!empty($output['recode_is_use']) && is_array($output['recode_is_use'])){ ?>
    <?php foreach ($output['recode_is_use'] as $fcode_info){ ?>
	<ul>
		<li class="code_ul_dt_1"><dl><dt>F码：<em><?php echo $fcode_info['vr_code']; ?></em></dt><dt><?php if($fcode_info['free_state'] != 1){ ?><a href="index.php?act=wap_goods_info&op=index&goods_id=<?php echo $fcode_info['goods']['goods_id'] ?>"><img title="使用" src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/order_right.png"></a><?php } ?></dt></dl></li>
		<li class="code_ul_dt_2"><dl><dt><img src="<?php echo uk86_thumb($fcode_info['goods'], 240); ?>"></dt><dt><span><?php echo $fcode_info['goods']['goods_name']; ?></span><p><?php if(!empty($fcode_info['vr_usetime'])){ ?>使用时间：<em style="display:inline-block; width:2.5rem;"><?php echo date('Y-m-d H:i',$fcode_info['vr_usetime']); ?></em><?php }else{?>过期时间：<em style="display:inline-block; width:2.5rem;"><?php echo date('Y-m-d H:i', $fcode_info['vr_indate']) ?></em><?php } ?>
		<?php if($fcode_info['vr_state'] == 1){ ?><em class="code_em_name" style="color:#AAA;">已使用</em><?php }elseif($fcode_info['vr_state'] == 2){?><em class="code_em_name" style="color:#F25257;">已过期</em><?php }else{ ?><em class="code_em_name">未使用</em><?php } ?></p></dt></dl></li>
	</ul>
	<?php } ?>
  <?php }else{ ?>
    <div style="color:#999; width:100%; height:71%; text-align:center; background:#FFF;"><span style="margin-top:2.9rem; display:inline-block;">您还没有未使用的兑换码<span></span><br /></div>
  <?php } ?>
</div>

<div class="exc_code_list_ul not_use_recode hidden">
  <?php if(!empty($output['recode_not_use']) && is_array($output['recode_not_use'])){ ?>
    <?php foreach ($output['recode_not_use'] as $fcode_info){ ?>
	<ul>
		<li class="code_ul_dt_1"><dl><dt>F码：<em><?php echo $fcode_info['vr_code']; ?></em></dt><dt><?php if($fcode_info['free_state'] != 1){ ?><a href="index.php?act=wap_goods_info&op=index&goods_id=<?php echo $fcode_info['goods']['goods_id'] ?>"><img title="使用" src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/order_right.png"></a><?php } ?></dt></dl></li>
		<li class="code_ul_dt_2"><dl><dt><img src="<?php echo uk86_thumb($fcode_info['goods'], 240); ?>"></dt><dt><span><?php echo $fcode_info['goods']['goods_name']; ?></span><p><?php if(!empty($fcode_info['vr_usetime'])){ ?>使用时间：<em style="display:inline-block; width:2.5rem;"><?php echo date('Y-m-d H:i',$fcode_info['vr_usetime']); ?></em><?php }else{?>过期时间：<em style="display:inline-block; width:2.5rem;"><?php echo date('Y-m-d H:i', $fcode_info['vr_indate']) ?></em><?php } ?>
		<?php if($fcode_info['vr_state'] == 1){ ?><em class="code_em_name" style="color:#AAA;">已使用</em><?php }elseif($fcode_info['vr_state'] == 2){?><em class="code_em_name" style="color:#F25257;">已过期</em><?php }else{ ?><em class="code_em_name">未使用</em><?php } ?></p></dt></dl></li>
	</ul>
	<?php } ?>
  <?php }else{ ?>
    <div style="color:#999; width:100%; height:71%; text-align:center; background:#FFF;"><span style="margin-top:2.9rem; display:inline-block;">您还没有使用过兑换码<span></span><br /></div>
  <?php } ?>
</div>

<div class="exc_code_list_ul is_pass hidden">
  <?php if(!empty($output['recode_pass']) && is_array($output['recode_pass'])){ ?>
    <?php foreach ($output['recode_pass'] as $fcode_info){ ?>
	<ul>
		<li class="code_ul_dt_1"><dl><dt>F码：<em><?php echo $fcode_info['vr_code']; ?></em></dt><dt><?php if($fcode_info['free_state'] != 1){ ?><a href="index.php?act=wap_goods_info&op=index&goods_id=<?php echo $fcode_info['goods']['goods_id'] ?>"><img title="使用" src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/order_right.png"></a><?php } ?></dt></dl></li>
		<li class="code_ul_dt_2"><dl><dt><img src="<?php echo uk86_thumb($fcode_info['goods'], 240); ?>"></dt><dt><span><?php echo $fcode_info['goods']['goods_name']; ?></span><p><?php if(!empty($fcode_info['vr_usetime'])){ ?>使用时间：<em style="display:inline-block; width:2.5rem;"><?php echo date('Y-m-d H:i',$fcode_info['vr_usetime']); ?></em><?php }else{?>过期时间：<em style="display:inline-block; width:2.5rem;"><?php echo date('Y-m-d H:i', $fcode_info['vr_indate']) ?></em><?php } ?>
		<?php if($fcode_info['vr_state'] == 1){ ?><em class="code_em_name" style="color:#AAA;">已使用</em><?php }elseif($fcode_info['vr_state'] == 2){?><em class="code_em_name" style="color:#F25257;">已过期</em><?php }else{ ?><em class="code_em_name">未使用</em><?php } ?></p></dt></dl></li>
	</ul>
	<?php } ?>
  <?php }else{ ?>
    <div style="color:#999; width:100%; height:71%; text-align:center; background:#FFF;"><span style="margin-top:2.9rem; display:inline-block;">您还没有已过期的兑换码<span></span><br /></div>
  <?php } ?>
</div>
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/zepto.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/carousel-image.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/common.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.head_title').click(function(){
		if($(this).hasClass('l_top_c')){
			return false;
		}
		$(this).siblings('.head_title').removeClass('l_top_c');
		$(this).addClass('l_top_c');
		var type = $(this).attr('nctype');
		$('.exc_code_list_ul').addClass('hidden');
		if(type == 'is_used'){
			$('.is_use_recode').removeClass('hidden');
		}else if(type == 'not_used'){
			$('.not_use_recode').removeClass('hidden');
		}else if(type == 'pass'){
			$('.is_pass').removeClass('hidden');
		}else{
			$('.all_recode_list').removeClass('hidden');
		}
	});
});
</script>