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
<title>优康_店铺列表</title>
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/main.css" type="text/css" media="all">
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/base.css" type="text/css" media="all">
</head>

<body style="background:#F5F5F5">
<!--顶部-->
<header id="header">
	<div class="header_con">
		<div class="headerleft">
			<a href="index.php?act=wap_index"><i class="icon-arrow-left"></i></a>
		</div>
		<div class="top-tit-div">
			店铺列表
		</div>
		<div class="top-hk-div hidden">
			<i class="icon-share-top"></i>
			<input class="ui-input-top" type="search" name="keyword" value="<?php echo $_GET['keyword'] ?>" placeholder="搜索店铺">
		</div>
		<div class="headerRight">
			<i class="icon-search-right"></i>
			<i class="icon-more-right"></i>
		</div>
	</div>
</header>
<!--顶部结束-->
<div id="content" class="p_bottom_b" style="background:#F5F5F5">
  <?php if(!empty($output['store_list']) && is_array($output['store_list'])){ ?>
    <?php foreach ($output['store_list'] as $key => $store_info){ ?>
	<div class="shop_def_list">
      <a href="index.php?act=wap_store&op=store_info&store_id=<?php echo $store_info['store_id']; ?>">
		<ul>
			<li>
				<img src="<?php echo $store_info['store_logo']; ?>">
			</li>
			<li>
				<dl>
					<dt>
						<em><?php echo $store_info['store_name']; ?></em>
					</dt>
					<dt>
						<span>信用度：</span>
						<?php for($i = 0; $i < $store_info['store_credit_average']; $i++){ ?>
						<img src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/xy_xin.png">
						<?php } ?>
					</dt>
					<dt>
						<span>好评率：<em><?php echo $store_info['store_credit_percent'] ?>%</em></span>
					</dt>
					<dt>
						<span>商品数：<em><?php echo $store_info['goods_count'] ?></em>件</span>&nbsp;&nbsp;&nbsp;&nbsp;
						<span>最近成交量：<em><?php echo $store_info['num_sales_jq']; ?></em>笔</span>
					</dt>
				</dl>
			</li>
		</ul>
	  </a>
	</div>
	<?php } ?>
  <?php }else{ ?>
    <div style="color:#999; width:100%; height:70%; text-align:center; background:#FFF;"><span style="margin-top:2.9rem; display:inline-block;">没有符合条件的数据记录<span></span><br /></div>
  <?php } ?>
</div>
<!-- 店铺分类 -->
 <i class="icon_store_class"></i>
<div class="store_class no-click">
  <ul>
  	  <li <?php if(empty($_GET['sc_id'])){echo 'class="is_select"';} ?> nctype="0">所有店铺</li>
    <?php foreach ($output['store_sc'] as $sc_key => $sc_val){ ?>
      <li <?php if($sc_val['sc_id'] == $_GET['sc_id']){echo 'class="is_select"';} ?> nctype="<?php echo $sc_val['sc_id']; ?>"><?php echo $sc_val['sc_name']; ?></li>
    <?php } ?>
  </ul>
</div>
<!-- 店铺分类  结束 -->
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/zepto.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/carousel-image.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/common.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.store_class').hide();
	$('.icon_store_class').hide();
	$('.icon-search-right').click(function(){
		$(this).addClass('hidden');
		$('.top-tit-div').addClass('hidden');
		$('.top-hk-div').removeClass('hidden');
		$('.ui-input-top').focus();
	});
	$('.ui-input-top').blur(function(){
		$('.top-tit-div').removeClass('hidden');
		$('.top-hk-div').addClass('hidden');
		$('.icon-search-right').removeClass('hidden');
	});
	//店铺分类显示
	$('.icon-more-right').click(function(){
		if($('.store_class').hasClass('no-click')){
			$('.store_class').show(200);
			$('.icon_store_class').show(200);
			$('.store_class').removeClass('no-click');
			return false;
		}else{
			$('.store_class').hide(100);
			$('.icon_store_class').hide(100);
			$('.store_class').addClass('no-click');
			return false;
		}
	});
	$('#content,header').click(function(){
		$('.store_class').hide(100);
		$('.icon_store_class').hide(100);
		$('.store_class').addClass('no-click');
	});
	//店铺搜索
	$('.ui-input-top').focus(function(event){
		window.document.onkeydown = function(event){
			if(window.event.keyCode == 13){
				var keyword = $('.ui-input-top').val();
				if(keyword != ''){
					window.location.href='index.php?act=wap_store&op=index&keyword='+keyword;
				}
				return false;
			}
		}
	});
	//店铺分类查询
	$('.store_class ul li').click(function(){
		var sc_id = $(this).attr('nctype');
		if(sc_id == <?php echo $_GET['sc_id']?$_GET['sc_id']:0; ?>){
			return;
		}
		var keyword = $(this).html();
		window.location.href = 'index.php?act=wap_store&op=index&sc_id='+sc_id;
	});
});
</script>
</body>
</html>