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
<title>优康_首页</title>
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/main.css" type="text/css" media="all">
</head>
<body>
<!--顶部-->
<header id="header">
<div class="header_con">
	<div class="headerleft">
		<i class="icon-arrow-left-b"></i>
	</div>
	<div class="top-hk-div">
		<i class="icon-share-top"></i>
		<input class="ui-input-top" type="search" name="keyword" placeholder="搜索你想要的宝贝">
	</div>
	<div class="headerRight">
		<i class="icon-arrow-right"><?php if(!empty($output['message_num'])) {?><em><span><?php echo $output['message_num']?></span></em><?php } ?></i>
	</div>
</div>
</header>
<!--顶部结束-->
<div id="content" class="p_bottom">

  <?php if(!empty($output['data']) && is_array($output['data'])){ ?>
  <?php foreach ($output['data'] as $key => $value){ ?>
     <?php if(!empty($value['nav_list']) || !empty($value['class_list'])){ ?>
	    <div class="home_link_m clearfixd">
	    <?php if(!empty($value['nav_list']) && is_array($value['nav_list'])){ ?>
	      <div class="home_link_box clearfixd">
	    <?php foreach ($value['nav_list'] as $nav_key => $nav_val){ ?>
	      <?php if($nav_key != 'item'){ ?>
	          <a href="<?php echo $nav_val['mb_nav_url'] ?>">
	            <i class="icon-home-i01"><img src="<?php echo uk86_getMbSpecialImageUrl($nav_val['mb_nav_img']); ?>"></i>
	            <p><?php echo $nav_val['mb_nav_name'] ?></p>
	          </a>
	      <?php } ?>
	    <?php } ?>
	      </div>
	    <?php continue; } ?>
	    <?php if(!empty($value['class_list']) && is_array($value['class_list'])){ ?>
	      <div class="home_link_xz clearfixd">
	    <?php foreach ($value['class_list'] as $class_key => $class_val){ ?>
	      <?php if($class_key != 'item'){ ?>
	    	 <a href="javascript:void(0);" onClick="goods_class_search('<?php echo $class_val['mb_gc_name']; ?>');"><i class="icon-link-i01"><img src="<?php echo uk86_getMbSpecialImageUrl($class_val['mb_gc_img']) ?>"></i><span><?php echo $class_val['mb_gc_name'] ?></span></a>
	      <?php } ?>
	    <?php } ?>
	      </div>
	    <?php continue; } ?>
	    </div>
	  <?php continue; } ?>
	  <?php if(!empty($value['goods']) && is_array($value['goods'])){ ?>
	  <div class="home_mian_tit">
        <ul class="clearfixd"><li></li><li><h2><?php echo $value['goods']['title'] ?></h2></li></ul>
	  </div>
	  <div class="home_mian_box clearfixd">
	  <?php foreach ($output['goods_info'][$key] as $goods_key => $goods_val){ ?>
	    <a href="index.php?act=wap_goods_info&op=index&goods_id=<?php echo $goods_val['goods_id']; ?>">
	    <ul>
			<img src="<?php echo uk86_thumb($goods_val); ?>"/>
			<li>
			<h2><?php echo $goods_val['goods_name'] ?></h2>
			<dl>
				<dt><em>￥</em><?php echo $goods_val['goods_price'] ?></dt>
				<dd>￥<?php echo $goods_val['goods_marketprice']; ?></dd>
				<span><i class="<?php echo $goods_val['is_fcode']?'icon-cx-fm':'' ?>"></i><i class="<?php if($goods_val['goods_promotion_type'] == 1){echo 'icon-cx-xs';}elseif ($goods_val['goods_promotion_type'] == 2){echo 'icon-cx-yy';} ?>"></i></span>
			</dl>
			</li>
		</ul>
		</a>
	  <?php } ?>
	  </div>
	  <?php continue; } ?>
	  <?php if(!empty($value['home1']) && is_array($value['home1'])){ ?>
	    <div class="home_mian_tit">
		 <ul class="clearfixd"><li></li><li><h2><?php echo $value['home1']['title'] ?></h2></li></ul>
		</div>
		<div class="top_pic">
		  <div class="carousel-image">
		    <a href="<?php if($value['home1']['type'] == 'url'){echo $value['home1']['data'];}elseif($value['home1']['type'] == 'goods'){echo 'index.php?act=wap_goods_info&op=index&goods_id='.$value['home1']['data'];}elseif($value['home1']['type'] == 'keyword'){echo 'index.php?act=wap_search&keyword='.$value['home1']['data'];}else{echo 'javascript:void(0);';} ?>">
		      <img class="home1-image" src="<?php echo $value['home1']['image'] ?>">
		    </a>
		  </div>
		</div>
	  <?php continue; } ?>
	  <?php if(!empty($value['home2']) && is_array($value['home2'])){ ?>
	    <div class="home_mian_tit">
		 <ul class="clearfixd"><li></li><li><h2><?php echo $value['home2']['title'] ?></h2></li></ul>
		</div>
		<div class="home_mian_love">
			<div class="love_left">
				<a href="<?php if($value['home2']['square_type']=='url'){echo $value['home2']['square_data'];}elseif($value['home2']['square_type']=='keyword'){echo 'index.php?act=wap_search&keyword='.$value['home2']['square_data'];}elseif($value['home2']['square_type']=='goods'){echo 'index.php?act=wap_goods_info&op=index&goods_id='.$value['home2']['square_data'];} ?>"><img src="<?php echo $value['home2']['square_image'] ?>"></a>
			</div>
			<div class="love_right">
				<ul>
					<a href="<?php if($value['home2']['rectangle1_type']=='url'){echo $value['home2']['rectangle1_data'];}elseif($value['home2']['rectangle1_type']=='keyword'){echo 'index.php?act=wap_search&keyword='.$value['home2']['rectangle1_data'];}elseif($value['home2']['rectangle1_type']=='goods'){echo 'index.php?act=wap_goods_info&op=index&goods_id='.$value['home2']['rectangle1_data'];} ?>"><img src="<?php echo $value['home2']['rectangle1_image'] ?>"></a>
				</ul>
				<ul>
					<a href="<?php if($value['home2']['rectangle2_type']=='url'){echo $value['home2']['rectangle2_data'];}elseif($value['home2']['rectangle2_data']=='keyword'){echo 'index.php?act=wap_search&keyword='.$value['home2']['rectangle2_data'];}elseif($value['home2']['rectangle2_type']=='goods'){echo 'index.php?act=wap_goods_info&op=index&goods_id='.$value['home2']['rectangle2_data'];} ?>"><img src="<?php echo $value['home2']['rectangle2_image'] ?>"></a>
				</ul>
			</div>
		</div>
	  <?php continue; } ?>
	  <?php if(!empty($value['home3']) && is_array($value['home3'])){ ?>
	    <div class="home_mian_tit">
            <ul class="clearfixd"><li></li><li><h2><?php echo $value['home3']['title'] ?></h2></li></ul>
		</div>
		<div class="home_mian_box_c clearfixd">
		  <ul>
		    <?php foreach ($value['home3']['item'] as $h3_key => $h3_val){ ?>
		      <li><a  href="<?php if($h3_val['type']=='url'){echo $h3_val['data'];}elseif($h3_val['type']=='goods'){echo 'index.php?act=wap_goods_info&op=index&goods_id='.$h3_val['data'];}elseif($h3_val['type'] == 'keyword'){echo 'index.php?act=wap_search&keyword='.$h3_val['data'];} ?>"><img src="<?php echo $h3_val['image'] ?>"></a></li>
		    <?php } ?>
		  </ul>
	    </div>
	  <?php continue; } ?>
	  <?php if(!empty($value['home4']) && is_array($value['home4'])){ ?>
	    <div class="home_mian_tit">
		 <ul class="clearfixd"><li></li><li><h2><?php echo $value['home4']['title'] ?></h2></li></ul>
		</div>
		<div class="home_mian_love">
			<div class="love_right_x">
				<ul>
				  <a href="<?php if($value['home4']['rectangle1_type'] == 'url'){echo $value['home4']['rectangle1_data'];}elseif($value['home4']['rectangle1_type']=='keyword'){echo 'index.php?act=wap_search&keyword='.$value['home4']['rectangle1_data'];}elseif($value['home4']['rectangle1_type'] == 'goods'){echo 'index.php?act=wap_goods_info&op=index&goods_id='.$value['home4']['rectangle1_data'];} ?>">
					<img src="<?php echo $value['home4']['rectangle1_image'] ?>">
				  </a>
				</ul>
				<ul>
				  <a href="<?php if($value['home4']['rectangle2_type'] == 'url'){echo $value['home4']['rectangle2_data'];}elseif($value['home4']['rectangle1_type']=='keyword'){echo 'index.php?act=wap_search&keyword='.$value['home4']['rectangle2_data'];}elseif($value['home4']['rectangle2_type'] == 'goods'){echo 'index.php?act=wap_goods_info&op=index&goods_id='.$value['home4']['rectangle2_data'];} ?> ">
					<img src="<?php echo $value['home4']['rectangle2_image'] ?>">
				  </a>
				</ul>
			</div>
			<div class="love_left">
			  <a href="<?php if($value['home4']['square_type'] == 'url'){echo $value['home4']['square_data'];}elseif($value['home4']['square_type']=='goods'){echo 'index.php?act=wap_goods_info&op=index&goods_id='.$value['home4']['square_data'];} ?>">
				<img src="<?php echo $value['home4']['square_image'] ?>">
		      </a>
			</div>
		</div>
	  <?php continue; } ?>
	  <?php if(!empty($value['adv_list']) && is_array($value['adv_list'])){ ?>
	    <div class="top_pic">
			<div class="carousel-image carousel-image<?php echo $key ?>" id="scroll_img">
				<div>
				  <?php foreach ($value['adv_list']['item'] as $adv_key => $adv_val){ ?>
					  <a href="<?php if($adv_val['type'] == 'url'){echo $adv_val['data'];}elseif($adv_val['type'] == 'keyword'){echo 'index.php?act=wap_search&keyword='.$adv_val['data'];}elseif($adv_val['type'] == 'goods'){echo 'index.php?act=wap_goods_info&goods_id='.$adv_val['data'];} ?>">
					  	<img src="<?php echo $adv_val['image'] ?>"/>
					  </a>
				  <?php } ?>
				</div>
				<span class="carousel-num">
				</span>
			</div>
		</div>
	  <?php continue; } ?>
  <?php } ?>
  <?php if(!empty($output['member_like']) && is_array($output['member_like'])){ ?>
    <div class="home_mian_tit">
        <ul class="clearfixd"><li></li><li><h2>猜您喜欢</h2></li></ul>
	</div>
	<div class="home_mian_box clearfixd">
	  <?php foreach ($output['member_like'] as $like_key => $like_val){ ?>
	    <a href="index.php?act=wap_goods_info&op=index&goods_id=<?php echo $like_val['goods_id'] ?>">
	    <ul>
	      <img title="<?php echo $like_val['goods_name']; ?>" src="<?php echo uk86_thumb($like_val); ?>"/>
	      <li>
	        <h2><?php echo $like_val['goods_name']; ?></h2>
	        <dl>
	          <dt><em>￥</em><?php echo $like_val['goods_price']; ?></dt>
	          <dd>￥<?php echo $like_val['goods_marketprice']; ?></dd>
	          <span><i class="<?php echo $like_val['is_fcode']?'icon-cx-fm':'' ?>"></i><i class="<?php if($like_val['goods_promotion_type'] == 1){echo 'icon-cx-xs';}elseif ($like_val['goods_promotion_type'] == 2){echo 'icon-cx-yy';} ?>"></i></span>
	        </dl>
	      </li>
	    </ul>
	    </a>
	  <?php } ?>
	</div>
  <?php } ?>
  <?php } ?>
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/zepto.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/carousel-image.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/common.js"></script>
<script>
$(function(){
	for(var i = 0; i <= <?php echo empty($output['data'])?0:count($output['data']) ?>; i++){
		$('.carousel-image'+i).CarouselImage({
			num: $('.carousel-image'+i+' .carousel-num'),
			repeat: true
		});
	}
	$('.all_foot .home_foot a').eq(0).addClass('icon-bot-c');

	//商品搜索
	$('.ui-input-top').focus(function(event){
		window.document.onkeydown = function(event){
			if(window.event.keyCode == 13){
				var keyword = $('.ui-input-top').val();
				if(keyword != ''){
					window.location.href='index.php?act=wap_search&op=index&keyword='+keyword;
				}
				return false;
			}
		}
	});
});
//点击商品分类进行搜索商品
function goods_class_search(gc_name){
	window.location.href = "index.php?act=wap_search&op=index&keyword="+gc_name;
}
</script>