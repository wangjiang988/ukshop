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
<title>我的F码</title>
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
		我的F码
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
		<li class="l_top_c fcode_width" nctype="all"><span>全部</span></li>
		<li style="width:0.1rem; margin-left:0; margin-right:0;"><img src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/order_link.png"></li>
		<li class="fcode_width" nctype="is_use"><span>已使用</span><em class="exc_code_em1"><span><?php echo count($output['fcode_is_use']); ?></span></em></li>
		<li style="width:0.1rem; margin-left:0; margin-right:0;"><img src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/order_link.png"></li>
		<li class="fcode_width" nctype="not_use"><span>未使用</span><em class="exc_code_em2" style="color:#83C36C;border:0.03rem solid #83C36C;"><span><?php echo count($output['fcode_not_use']); ?></span></em></li>
	</ul>
</div>
<!--搜索标题结束-->
<div class="exc_code_list_ul all_fcode_list">
  <?php if(!empty($output['fcode_list']) && is_array($output['fcode_list'])){ ?>
    <?php foreach ($output['fcode_list'] as $fcode_info){ ?>
	<ul>
		<li class="code_ul_dt_1"><dl><dt>F码：<em><?php echo $fcode_info['free_code']; ?></em></dt><dt><?php if($fcode_info['free_state'] != 1){ ?><a href="index.php?act=wap_goods_info&op=index&goods_id=<?php echo $fcode_info['goods']['goods_id'] ?>"><img title="使用" src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/order_right.png"></a><?php } ?></dt></dl></li>
		<li class="code_ul_dt_2"><dl><dt><img src="<?php echo uk86_thumb($fcode_info['goods'], 240); ?>"></dt><dt><span><?php echo $fcode_info['goods']['goods_name']; ?></span><p>获取方式：<em style="display:inline-block; width:2.5rem;"><?php echo $fcode_info['get_type']; ?></em><?php if($fcode_info['free_state'] == 1){ ?><em class="code_em_name" style="color:#AAA;">已使用</em><?php }else{ ?><em class="code_em_name">未使用</em><?php } ?></p></dt></dl></li>
	</ul>
	<?php } ?>
  <?php }else{ ?>
    <div style="color:#999; width:100%; height:71%; text-align:center; background:#FFF;"><span style="margin-top:2.9rem; display:inline-block;">您还没有F码<span></span><br /><a href="javascript:void(0);" style="display:inline-block; width:1.8rem; height:0.5rem; border:0.02rem solid #999; line-height:0.5rem; border-radius:0.05rem; margin-top:0.2rem; color:#555;">试试手气</a></div>
  <?php } ?>
</div>

<div class="exc_code_list_ul is_use_list hidden">
  <?php if(!empty($output['fcode_is_use']) && is_array($output['fcode_is_use'])){ ?>
    <?php foreach ($output['fcode_is_use'] as $fcode_info){ ?>
	<ul>
		<li class="code_ul_dt_1"><dl><dt>F码：<em><?php echo $fcode_info['free_code']; ?></em></dt><dt><?php if($fcode_info['free_state'] != 1){ ?><a href="index.php?act=wap_goods_info&op=index&goods_id=<?php echo $fcode_info['goods']['goods_id'] ?>"><img title="使用" src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/order_right.png"></a><?php } ?></dt></dl></li>
		<li class="code_ul_dt_2"><dl><dt><img src="<?php echo uk86_thumb($fcode_info['goods'], 240); ?>"></dt><dt><span><?php echo $fcode_info['goods']['goods_name']; ?></span><p>获取方式：<em style="display:inline-block; width:2.5rem;"><?php echo $fcode_info['get_type']; ?></em><?php if($fcode_info['free_state'] == 1){ ?><em class="code_em_name" style="color:#AAA;">已使用</em><?php }else{ ?><em class="code_em_name">未使用</em><?php } ?></p></dt></dl></li>
	</ul>
	<?php } ?>
  <?php }else{ ?>
    <div style="color:#999; width:100%; height:71%; text-align:center; background:#FFF;"><span style="margin-top:2.9rem; display:inline-block;">您还没有使用过码<span></span><br /></div>
  <?php } ?>
</div>
<div class="exc_code_list_ul not_use_list hidden">
  <?php if(!empty($output['fcode_not_use']) && is_array($output['fcode_not_use'])){ ?>
    <?php foreach ($output['fcode_not_use'] as $fcode_info){ ?>
	<ul>
		<li class="code_ul_dt_1"><dl><dt>F码：<em><?php echo $fcode_info['free_code']; ?></em></dt><dt><?php if($fcode_info['free_state'] != 1){ ?><a href="index.php?act=wap_goods_info&op=index&goods_id=<?php echo $fcode_info['goods']['goods_id'] ?>"><img title="使用" src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/order_right.png"></a><?php } ?></dt></dl></li>
		<li class="code_ul_dt_2"><dl><dt><img src="<?php echo uk86_thumb($fcode_info['goods'], 240); ?>"></dt><dt><span><?php echo $fcode_info['goods']['goods_name']; ?></span><p>获取方式：<em style="display:inline-block; width:2.5rem;"><?php echo $fcode_info['get_type']; ?></em><?php if($fcode_info['free_state'] == 1){ ?><em class="code_em_name" style="color:#AAA;">已使用</em><?php }else{ ?><em class="code_em_name">未使用</em><?php } ?></p></dt></dl></li>
	</ul>
	<?php } ?>
  <?php }else{ ?>
    <div style="color:#999; width:100%; height:71%; text-align:center; background:#FFF;"><span style="margin-top:2.9rem; display:inline-block;">您的F码已经用完了<span></span><br /><a href="javascript:void(0);" style="display:inline-block; width:1.8rem; height:0.5rem; border:0.02rem solid #999; line-height:0.5rem; border-radius:0.05rem; margin-top:0.2rem; color:#555;">试试手气</a></div>
  <?php } ?>
</div>

</div>
<!--底部结束-->
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/zepto.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/carousel-image.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/common.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.fcode_width').click(function(){
		if($(this).hasClass('l_top_c')){
			return false;
		}
		$(this).siblings('.fcode_width').removeClass('l_top_c');
		$(this).addClass('l_top_c');
		var type = $(this).attr('nctype');
		$('.exc_code_list_ul').addClass('hidden');
		if(type == 'is_use'){
			$('.is_use_list').removeClass('hidden');
		}else if(type == 'not_use'){
			$('.not_use_list').removeClass('hidden');
		}else{
			$('.all_fcode_list').removeClass('hidden');
		}
	});
});
</script>
</body>
</html>
