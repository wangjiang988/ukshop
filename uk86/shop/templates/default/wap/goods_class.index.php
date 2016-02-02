<?php defined('InUk86') or exit('Access Invalid!');?>
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
<title>商品分类</title>
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/main.css" type="text/css" media="all">
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/goods_sort.css" type="text/css" media="all">
</head>
<body>
<!--顶部-->
<header id="header">
<div class="header_con">
	<div class="headerleft">
		<i class="icon-arrow-left" onClick="javascript:history.go(-1);"></i>
	</div>
	<div class="top-hk-div">
		<i class="icon-share-top" style="left:4.2rem;"></i>
		<input class="ui-input-top" style="padding: 0.12rem 0.05rem 0.1rem 0.2rem;" type="search" placeholder="搜索商品/店铺">
	</div>
	<div class="headerRight">
		
	</div>
</div>
</header>
<!--顶部结束-->
<div id="content" class="p_bottom" style="background: #FFFAF6;">
	<div class="goods_list">
		<ul>
			<?php foreach ($output['goods_class'] as $class_id => $calss_val){ ?>
			<li enctype="<?php echo $class_id; ?>"><dl><dt><img src="<?php echo $calss_val['pic'] ?>"></dt><dt class="goods_list_name"><?php echo $calss_val['gc_name']; ?></dt><dt><img src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/goods_right.png"/></dt></dl></li>
			<?php } ?>
		</ul>
	</div>
	<?php foreach ($output['goods_class'] as $class_id => $calss_val){ ?>
	<div class="goods_list_right show<?php echo $class_id; ?> hidden">
	  <?php $i = 0; ?>
  	  <?php foreach ($output['brand_list'] as $brand_key => $brand_val){
  	  	if($brand_val['parent_id'] == $calss_val['gc_id']){
			$i++;
		}
  	  }
  	  ?>
  	  <?php if($i > 0){ ?>
	  <div class="goods_right_name1"><span>推荐品牌</span></div>
	  <div class="goods_list_link">
	  	<ul>
	  	  <?php foreach ($output['brand_list'] as $brand_key => $brand_val){ ?>
	  	  	<?php if($brand_val['parent_id'] == $calss_val['gc_id']){ ?>
	  	  	<li><dl onClick="goods_brand_search('<?php echo $brand_val['brand_id']; ?>', '<?php echo $brand_val['brand_name']; ?>');"><dt style="height:0.6rem;"><img src=<?php echo uk86_brandImage($brand_val['brand_pic']); ?> /></dt><dt class="goods_name"><?php echo $brand_val['brand_name']; ?></dt></dl></li>
	  	  	<?php } ?>
	  	  <?php } ?>
	  	</ul>
	  </div>
	  <?php } ?>
	  <?php foreach ($calss_val['class2'] as $class2_id => $calss2_val){ ?>
		<div class="goods_right_name1"><span onClick="goods_class_search('<?php echo $class2_id ?>', '<?php echo $calss2_val['gc_name']; ?>');"><?php echo $calss2_val['gc_name']; ?></span></div>
		<div class="goods_line"></div>
		<div class="goods_list_link2">
		   <ul>
			<?php if(is_array($calss2_val['class3'])){ ?>
		     <?php foreach ($calss2_val['class3'] as $class3_id => $class3_val){ ?>
		       <li onClick="goods_class_search('<?php echo $class3_id ?>', '<?php echo $class3_val['gc_name']; ?>');"><a href="javascript:void(0);"><?php echo $class3_val['gc_name']; ?></a></li>
		     <?php } ?>
			<?php } ?>
		   </ul>
		</div>
	  <?php } ?>
	</div>
	<?php } ?>
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/zepto.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/carousel-image.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/common.js"></script>
<script>
$(document).ready(function(e){
	$('.all_foot .home_foot a').eq(1).addClass('icon-bot-c');
	var divheight = document.documentElement.clientHeight;
	var header_height = $('header').height();
	var foot_height = $('.all_foot').height();
	$('.goods_list,.goods_list_right').css('height', divheight-header_height-foot_height+'px');

	$('.goods_list_right').eq(0).removeClass('hidden');
	$('.goods_list ul li').eq(0).addClass('select_class');

	$('.goods_list ul li').on('click', function(){
		var num = $(this).attr('enctype');
		if($(this).hasClass('select_class')){
			var keyword = $(this).find('.goods_list_name').html();
			window.location.href = "index.php?act=wap_search&op=index&keyword="+keyword+"&gc_id="+num;
			return;
		}
		$(this).siblings('li').removeClass('select_class');
		$('.goods_list_right').addClass('hidden');
		$('.show'+num).removeClass('hidden');
		$(this).addClass('select_class');
	});
	//商品搜索
	$('.ui-input-top').focus(function(event){
		window.document.onkeydown = function(event){
			if(window.event.keyCode == 13){
				var keyword = $('.ui-input-top').val();
				if(keyword != ''){
					window.location.href = 'index.php?act=wap_search&op=index&keyword='+keyword;
				}
				return false;
			}
		}
	});
});

//点击商品分类进行搜索商品
function goods_class_search(gc_id, gc_name){
	window.location.href = "index.php?act=wap_search&op=index&keyword="+gc_name+"&gc_id="+gc_id;
}

//点击推荐品牌进行商品搜索
function goods_brand_search(brand_id, brand_name){
	window.location.href = 'index.php?act=wap_search&op=index&keyword='+brand_name+'&brand_id='+brand_id;
}
</script>
</body>
</html>
