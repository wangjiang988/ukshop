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
<title>优康_我的圈子</title>
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/main.css" type="text/css" media="all">
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/base.css" type="text/css" media="all">
<style type="text/css">
.weiquan_list_top_tit ul li{width:2.4rem;}
</style>
</head>
<body>
<!--顶部-->
<header id="header">
	<div class="header_con">
	<div class="headerleft">
		<a href="index.php?act=wap_member"><i class="icon-arrow-left"></i></a>
	</div>
		<div class="top-tit-div">
			我的圈子
		</div>

		<div class="headerRight">
		</div>
	</div>
</header>
<!--顶部结束-->

<div id="content" class="" style="background:#F5F5F5;">
<!--搜索标题-->
	<div class="weiquan_list_top_tit clearfixd">		
    	<ul>
        	<li nctype="0" class="hovered <?php if($_GET['type'] == 0 || empty($_GET['type'])){echo 'l_top_c'; } ?>">我创建的圈子</li>
			<li nctype="1" class="hovered <?php if($_GET['type'] == 1){echo 'l_top_c'; } ?>">我加入的圈子</li>
    	</ul>
	</div>
	<!--搜索标题结束-->
	
<!--默认列表-->
	<div class="list_main_all">
	  <?php if(!empty($output['circle_list']) && is_array($output['circle_list'])){ ?>
		<div class="list_weiquan_box">
		  <?php foreach ($output['circle_list'] as $val){ ?>
			<ul enctype="<?php echo $val['circle_id']; ?>">
				<li class="weiquan_png">
					<a href="javascript:void(0);"><img src="<?php echo uk86_circleLogo($val['circle_id']); ?>" /></a>
				</li>
				<li class="weiquan_ti">
					<span><?php echo $val['circle_name']; ?></span>
					<dl><dt><em><?php echo $val['circle_thcount']; ?></em>个话题</dt><dt>人气<em><?php echo $val['circle_mcount']; ?></em></dt></dl>
				</li>
				<li class="weiquan_right"><a href="javascript:void(0);"><img src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/weiquan_right.png"></a></li>
				<span><?php echo $val['circle_desc']; ?></span>
			</ul>
		  <?php } ?>
	    </div>
	  <?php }else{ ?>
	    <div style="color:#999; width:100%; height:83%; text-align:center; background:#FFF;"><span style="margin-top:2.9rem; display:inline-block;"><?php echo $output['no_circle']; ?><span></span><br /></div>
  	  <?php } ?>
	</div>
	<!--默认结束-->
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/zepto.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/carousel-image.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/common.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.all_foot').hide();
	$('.weiquan_list_top_tit ul li').click(function(){
		if($(this).hasClass('l_top_c')){return false;}
		var type = $(this).attr('nctype');
		window.location.href="index.php?act=wap_member_fcode&op=memberCircle&type="+type;
	});
	$('.list_weiquan_box ul').click(function(){
		var c_id = $(this).attr('enctype');
		window.location.href="index.php?act=wap_circle&op=circle_info&c_id="+c_id;
	});
});
</script>
</body>
</html>