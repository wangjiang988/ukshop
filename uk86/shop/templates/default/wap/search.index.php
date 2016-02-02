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
<title>优康_搜索</title>
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/main.css" type="text/css" media="all">
<style type="text/css">
#content{background:#FFF;}
</style>
</head>
<body>
<!--顶部-->
<header id="header">
<div class="header_con">
	<div class="headerleft">
		<i onClick="javascript:history.go(-1);" class="icon-arrow-left"></i>
	</div>
	<div class="top-hk-div">
		<i class="icon-share-top"></i>
		<input class="ui-input-top" type="search" name="keyword" value="<?php echo $_GET['keyword'] ?>" placeholder="搜索你想要的宝贝">
	</div>
	<div class="headerRight">
		<i class="icon-arrow-right"><?php if(!empty($output['message_num'])) {?><em><span><?php echo $output['message_num']?></span></em><?php } ?></i>
	</div>
</div>
</header>
<!--顶部结束-->
<div id="content" class="p_bottom">
	<!--搜索标题-->
	<div class="list_top_tit clearfixd" style="position:fixed; top:0.9rem;">		
    	<ul>
        	<li nctype="auto" class="<?php if($output['order'] == 'auto'){echo 'l_top_c';} ?>">默认</li>
			<li nctype="goods_salenum" class="<?php if($output['order'] == 'goods_salenum'){echo 'l_top_c';} ?>">销量</li>
			<li nctype="click_num" class="<?php if($output['order'] == 'click_num'){echo 'l_top_c';} ?>">人气</li>
            <li nctype="goods_price" class="<?php if($output['order'] == 'goods_price'){echo 'l_top_c';} ?>">价格<i nctype="up" class="<?php if($output['desc'] == 'down'){echo 'top_i_change';} ?>"></i><i nctype="down" class="<?php if($output['desc'] == 'up'){echo 'bot_i_change';} ?>"></i></li>
        </ul>
	</div>
	<!--搜索标题结束-->
	<!--默认列表-->
	<div class="list_main_all" style="margin-top:0.76rem;">
		<div class="list_main_box">
            <?php if(!empty($output['goods_list']) && is_array($output['goods_list'])){ ?>
              <?php foreach ($output['goods_list'] as $k => $v){ ?>
               <a href="index.php?act=wap_goods_info&goods_id=<?php echo $v['goods_id']; ?>">
              	<ul class="clearfixd">
		            <li><img src="<?php echo uk86_thumb($v, 240); ?>"/></li>
		            <li><h2><?php echo $v['goods_new_name']; ?></h2>
		            	<dl class="clearfixd">
							<dt><label><em>￥</em><?php echo $v['goods_promotion_price'] ?></label> </dt> 
			                <dt><span>
			                  <?php if(!empty($v['is_groupbuy'])){echo '<i class="icon-list-q"></i>';} ?>
			                  <?php if(!empty($v['is_presell'])){echo '<i class="icon-list-y"></i>';} ?>
			                  <?php if(!empty($v['is_xianshi'])){echo '<i class="icon-list-z"></i>';} ?>
			                  <?php if(!empty($v['is_fcode'])){echo '<i class="icon-list-f"></i>';} ?>
			                </span> </dt>  
			                <dt><?php if($v['goods_freight'] == 0){echo '包邮';} ?></dt>
			            </dl>
			            <dl>
							<dd><label>￥<?php echo $v['goods_marketprice'] ?></label>  <span><?php echo $v['goods_salenum'] ?>人付款</span></dd>		
						</dl> 
		            </li>            
	            </ul>
	           </a>
              <?php } ?>
            <?php }else{ ?>
            	<div class="no_list">没有找到符合条件的商品</div>
            <?php } ?>
		</div>
	</div>
	<!--默认结束-->
    <!--销量列表-->
    <!--销量结束-->
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/zepto.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/carousel-image.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/common.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	//商品排序
	$('.list_top_tit ul li:not(li:last)').click(function(){
		if($(this).hasClass('l_top_c')){return;}
		var type = $(this).attr('nctype');
		window.location.href='index.php?act=wap_search&keyword=<?php echo $_GET['keyword']; ?>&type='+type;
	});
	$('.list_top_tit ul li:last').click(function(){
		if($(this).children('i:first').hasClass('top_i_change')){
			var nctype = 'up';
		}else if($(this).children('i:last').hasClass('bot_i_change')){
			var nctype = 'down'
		}else{
			var nctype = 'up';
		}
		window.location.href='index.php?act=wap_search&keyword=<?php echo $_GET['keyword']; ?>&nctype='+nctype+'&type=goods_price';
	});
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
</script>
