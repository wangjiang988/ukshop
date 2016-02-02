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
<title>优康_搜索结果</title>
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/main.css" type="text/css" media="all">
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/base.css" type="text/css" media="all">
</head>

<body style="background:#F5F5F5;">
<!--顶部-->
<header id="header">
	<div class="header_con">
	<div class="headerleft">
		<a href="index.php?act=wap_cms&op=index#li_mao"><i class="icon-arrow-left"></i></a>
	</div>
		<div class="top-tit-div">
			搜索结果
		</div>
		<div class="top-hk-div hidden">
			<i class="icon-share-top"></i>
			<input class="ui-input-top" type="search" name="keyword" value="<?php echo $_GET['keyword'] ?>" placeholder="请输入关键字">
		</div>
		<div class="headerRight">
			<i class="icon-search-right"></i>
		</div>
	</div>
</header>
<!--顶部结束-->

<div id="content" class="p_bottom_b" style="background:#F5F5F5; margin-top:0.2rem;">
	<div class="info_list_all" nctype="all">
		<ul>
		  <?php if(!empty($output['all_article']) && is_array($output['all_article'])){ ?>
		  <?php foreach ($output['all_article'] as $v){ ?>
	    <li nctype="<?php echo $v['article_id']; ?>"><a class="li_mao"></a><dl><dt class="info_list_dt1"><a class="images" href="index.php?act=wap_cms&op=article_info&search=search&article_id=<?php echo $v['article_id'] ?>"><img src="<?php echo uk86_getCMSArticleImageUrl($v['article_attachment_path'], $v['article_image']); ?>"></a></dt><a href="index.php?act=wap_cms&op=article_info&search=search&article_id=<?php echo $v['article_id']; ?>"><dt class="info_list_dt2"><span><?php echo $v['article_title'] ?></span><p><?php echo uk86_getNumText($v['article_abstract'], 98); ?></p><em><i class="icon-share-cms"></i>&nbsp;<?php echo $v['article_share_count'] ?></em></dt></a></dl></li>
		  <?php } ?>
		  <?php }else{ ?>
		  	<div style="color:#999; width:100%; height:73%; text-align:center; background:#FFF;"><span style="margin-top:2.9rem; display:inline-block;">还没有符合条件的咨询文章<span></span><br /></div>
		  <?php } ?>
		</ul>
	</div>
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/zepto.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/carousel-image.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/common.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.all_foot').hide();
	var session_ecntype = window.sessionStorage.getItem('enctype');
	if(session_ecntype != '' && session_ecntype != 'undefined' && session_ecntype != undefined){
		$('.info_list_all').find('li[nctype="'+session_ecntype+'"]').find('a.li_mao').attr({name:'li_mao', id:'li_mao'});
	}
	$('.info_list_all ul li').click(function(){
		var enctype = $(this).attr('nctype');
		window.sessionStorage.setItem('enctype',enctype);
	});
	$('.headerRight').click(function(){
		$('.top-tit-div').addClass('hidden');
		$('.top-hk-div').removeClass('hidden');
		$('.ui-input-top').focus();
	});
	$('.ui-input-top').blur(function(){
		$('.top-tit-div').removeClass('hidden');
		$('.top-hk-div').addClass('hidden');
	});

	//搜索
	$('.ui-input-top').focus(function(event){
		window.document.onkeydown = function(event){
			if(window.event.keyCode == 13){
				var keyword = $('.ui-input-top').val();
				if(keyword != ''){
					window.location.href='index.php?act=wap_cms&op=search&keyword='+keyword;
				}
				return false;
			}
		}
	});
});
</script>
</body>
</html>