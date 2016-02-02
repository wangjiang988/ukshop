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
<title>品牌街</title>
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/main.css" type="text/css" media="all">
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/base.css" type="text/css" media="all">
</head>
<body>
<!--顶部-->
<header id="header">
<div class="header_con">
	<div class="headerleft">
		<a href="index.php?act=wap_index"><i class="icon-arrow-left"></i></a>
	</div>
	<div class="top-hk-div top_title">
		品牌街
	</div>
	<div class="top-hk-div hidden top_search">
			<i class="icon-share-top"></i>
			<input class="ui-input-top" type="search" name="keyword" value="<?php echo $_GET['keyword'] ?>" placeholder="请输入品牌名称或首字母">
		</div>
	<div class="headerRight">
		<i class="icon-search-right"></i>
	</div>
</div>
</header>
<!--顶部结束-->
<div id="content" class="p_bottom">
<?php if(empty($_GET['keyword'])){ ?>
<?php if(!empty($output['brand_recommend']) && is_array($output['brand_recommend'])){ ?>
<div class="p_fir"><span>推荐品牌</span></div>
<div class="fir_brand">
	<div class="list_fir_brand">
		<ul>
		<?php foreach ($output['brand_recommend'] as $val){ ?>
			<a href="index.php?act=wap_search&brand_id=<?php echo $val['brand_id']; ?>&keyword=<?php echo $val['brand_name'] ?>"><li><dl><dt><img class="brand_image" src="<?php echo uk86_brandImage($val['brand_pic']); ?>"></dt><dt class="brand_name"><?php echo $val['brand_name'] ?></dt></dl></li></a>
		<?php } ?>
		</ul>
	</div>
</div>
<?php } ?>
<!--搜索标题-->
<div style="height:0.5rem; width:100%;">
<div class="list_top_brand clearfixd">		
	<ul>
    	<li class="l_top_c" nctype="xuni">虚拟充值</li>
		<li nctype="muying">母婴用品</li>
		<li nctype="yundong">运动健康</li>
        <li nctype="baihuo">日用百货</li>
    </ul>
</div>
</div>
<!--搜索标题结束-->
<div class="sec_brand">
	<!-- 虚拟充值 -->
	<div class="list_fir_brand brand_class" nctype="xuni">
		<ul>
			<?php foreach ($output['brand_xuni'] as $val){ ?>
			<a href="index.php?act=wap_search&brand_id=<?php echo $val['brand_id']; ?>&keyword=<?php echo $val['brand_name'] ?>"><li><dl><dt><img class="brand_image" src="<?php echo uk86_brandImage($val['brand_pic']); ?>"></dt><dt class="brand_name"><?php echo $val['brand_name'] ?></dt></dl></li></a>
			<?php } ?>
		</ul>
	</div>
	<!-- 母婴用品 -->
	<div class="list_fir_brand brand_class hidden" nctype="muying">
		<ul>
			<?php foreach ($output['brand_muying'] as $val){ ?>
			<a href="index.php?act=wap_search&brand_id=<?php echo $val['brand_id']; ?>&keyword=<?php echo $val['brand_name'] ?>"><li><dl><dt><img class="brand_image" src="<?php echo uk86_brandImage($val['brand_pic']); ?>"></dt><dt class="brand_name"><?php echo $val['brand_name'] ?></dt></dl></li></a>
			<?php } ?>
		</ul>
	</div>
	<!-- 运动健康 -->
	<div class="list_fir_brand brand_class hidden" nctype="yundong">
		<ul>
			<?php foreach ($output['brand_yundong'] as $val){ ?>
			<a href="index.php?act=wap_search&brand_id=<?php echo $val['brand_id']; ?>&keyword=<?php echo $val['brand_name'] ?>"><li><dl><dt><img class="brand_image" src="<?php echo uk86_brandImage($val['brand_pic']); ?>"></dt><dt class="brand_name"><?php echo $val['brand_name'] ?></dt></dl></li></a>
			<?php } ?>
		</ul>
	</div>
	<!-- 日常百货 -->
	<div class="list_fir_brand brand_class hidden" nctype="baihuo">
		<ul>
			<?php foreach ($output['brand_richang'] as $val){ ?>
			<a href="index.php?act=wap_search&brand_id=<?php echo $val['brand_id']; ?>&keyword=<?php echo $val['brand_name'] ?>"><li><dl><dt><img class="brand_image" src="<?php echo uk86_brandImage($val['brand_pic']); ?>"></dt><dt class="brand_name"><?php echo $val['brand_name'] ?></dt></dl></li></a>
			<?php } ?>
		</ul>
	</div>
</div>
<?php }else{ ?>
	<?php if(!empty($output['brand_search']) && is_array($output['brand_search'])){ ?>
	<div class="p_fir"><span>搜索结果</span></div>
	<div class="fir_brand">
		<div class="list_fir_brand">
			<ul>
			<?php foreach ($output['brand_search'] as $val){ ?>
				<a href="index.php?act=wap_search&brand_id=<?php echo $val['brand_id']; ?>"><li><dl><dt><img class="brand_image" src="<?php echo uk86_brandImage($val['brand_pic']); ?>"></dt><dt class="brand_name"><?php echo $val['brand_name'] ?></dt></dl></li></a>
			<?php } ?>
			</ul>
		</div>
	</div>
	<?php }else{ ?>
	<div style="color:#999; width:100%; height:83%; text-align:center; background:#FFF;"><span style="margin-top:2.9rem; display:inline-block;">没有相关品牌<span></span><br /></div>
	 <?php } ?>
<?php } ?>
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/zepto.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/carousel-image.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/common.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.icon-search-right').click(function(){
		$(this).addClass('hidden');
		$('.top_title').addClass('hidden');
		$('.top_search').removeClass('hidden');
		$('.ui-input-top').focus();
	});
	$('.ui-input-top').blur(function(){
		$('.top_title').removeClass('hidden');
		$('.top_search').addClass('hidden');
		$('.icon-search-right').removeClass('hidden');
	});

	//导航浮动效果
	$(window).scroll(function(){
		var headH = $('#header').height();
		var navH = $('.list_top_brand').height();
		var secH = $('.sec_brand').offset().top;
		var scorH = $(window).scrollTop();
		//$('#content').attr('entype', navH);
		if(secH-scorH <= headH+navH){
			$('.list_top_brand').css({'position':'fixed', 'top':'0.9rem'});
		}else if(secH-scorH > headH+navH){
			$('.list_top_brand').css('position', 'static');
		}
		
	});

	//品牌分类切换
	$('.list_top_brand ul li').click(function(){
		if($(this).hasClass('l_top_c')) return;
		$(this).siblings().removeClass('l_top_c');
		$(this).addClass('l_top_c');
		var nctype = $(this).attr('nctype');
		$('.brand_class').addClass('hidden');
		$('div[nctype="'+nctype+'"]').removeClass('hidden');
	});

	//搜索
	$('.ui-input-top').focus(function(event){
		window.document.onkeydown = function(event){
			if(window.event.keyCode == 13){
				var keyword = $('.ui-input-top').val();
				if(keyword != ''){
					window.location.href='index.php?act=wap_brand&op=index&keyword='+keyword;
				}
				return false;
			}
		}
	});
});
</script>
</body>
</html>