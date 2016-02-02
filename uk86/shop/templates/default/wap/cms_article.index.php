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
<title>优康_资讯</title>
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/main.css" type="text/css" media="all">
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/base.css" type="text/css" media="all">
</head>

<body style="background:#F5F5F5;">
<!--顶部-->
<header id="header">
	<div class="header_con">
	<div class="headerleft">
		<a href="index.php?act=wap_index"><i class="icon-arrow-left"></i></a>
	</div>
		<div class="top-tit-div">
			资讯
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

<div id="content" class="p_bottom_b" style="background:#F5F5F5;">
<!--搜索标题-->
	<div class="info_list_top_tit clearfixd">
		<a href="index.php?act=wap_index"><i class="icon-left-overflow"></i></a>		
		<ul>
        	<li nctype="all" class="l_top_c">全部</li>
        	<?php if(!empty($output['article_class']) && is_array($output['article_class'])){ ?>
			<?php $i = 1; foreach ($output['article_class'] as $c_val){ $i++; ?>
			 <li nctype="<?php echo $c_val['class_id']; ?>" class=""><?php echo $c_val['class_name']; ?></li>
			<?php } ?>
			<?php } ?>
		</ul>
		<i class="icon-right-overflow"></i>	
	</div>
	<!--搜索标题结束-->
	
	<a id="maodian" class="hovered" href="#li_mao"></a>
	<!--默认列表开始-->
	<div class="info_list_all" nctype="all">
		<ul>
		  <?php if(!empty($output['all_article']) && is_array($output['all_article'])){ ?>
		  <?php foreach ($output['all_article'] as $v){ ?>
	    <li nctype="<?php echo $v['article_id']; ?>"><a class="li_mao"></a><dl><dt class="info_list_dt1"><a class="images" href="index.php?act=wap_cms&op=article_info&article_id=<?php echo $v['article_id'] ?>"><img src="<?php echo uk86_getCMSArticleImageUrl($v['article_attachment_path'], $v['article_image']); ?>"></a></dt><a href="index.php?act=wap_cms&op=article_info&article_id=<?php echo $v['article_id']; ?>"><dt class="info_list_dt2"><span><?php echo $v['article_title'] ?></span><p><?php echo $v['article_abstract']; ?></p><em><i class="icon-share-cms"></i>&nbsp;<?php echo $v['article_share_count'] ?></em></dt></a></dl></li>
		  <?php } ?>
		  <?php }else{ ?>
		  	<div style="color:#999; width:100%; height:73%; text-align:center; background:#FFF;"><span style="margin-top:2.9rem; display:inline-block;">还没有符合条件的咨询文章<span></span><br /></div>
		  <?php } ?>
		</ul>
	</div>
	<!--默认列表结束-->
	<?php if(!empty($output['article_other']) && is_array($output['article_other'])){ ?>
	<?php foreach ($output['article_other'] as $o_key => $o_val){ ?>
	<div class="info_list_all hidden" nctype="<?php echo $o_key ?>">
	  <?php if(!empty($o_val) && is_array($o_val)){ ?>
	   <ul>
	  <?php foreach ($o_val as $v){ ?>
	    <li nctype="<?php echo $v['article_id']; ?>"><a class="li_mao"></a><dl><dt class="info_list_dt1"><a class="images" href="index.php?act=wap_cms&op=article_info&article_id=<?php echo $v['article_id'] ?>"><img src="<?php echo uk86_getCMSArticleImageUrl($v['article_attachment_path'], $v['article_image']); ?>"></a></dt><a href="index.php?act=wap_cms&op=article_info&article_id=<?php echo $v['article_id']; ?>"><dt class="info_list_dt2"><span><?php echo $v['article_title'] ?></span><p><?php echo $v['article_abstract']; ?></p><em><i class="icon-share-cms"></i>&nbsp;<?php echo $v['article_share_count'] ?></em></dt></a></dl></li>
	  <?php } ?>
	   </ul>
	  <?php }else{ ?>
	    <div style="color:#999; width:100%; height:73%; text-align:center; background:#FFF;"><span style="margin-top:2.9rem; display:inline-block;">还没有符合条件的咨询文章<span></span><br /></div>
	  <?php } ?>
	</div>
	<?php } ?>
	<?php } ?>
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/zepto.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/carousel-image.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/common.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	//$('info_list_top_tit ul').css('left', '1.272rem');
	var session_nctype = window.sessionStorage.getItem('nctype');
	var session_ecntype = window.sessionStorage.getItem('enctype');
	if(session_nctype != '' && session_nctype != 'undefined' && session_nctype != undefined){
		$('.info_list_top_tit ul li').removeClass('l_top_c');
		$('.info_list_top_tit ul li[nctype="'+session_nctype+'"]').addClass('l_top_c');
		//$('.info_list_top_tit ul li[nctype="'+session_nctype+'"]').attr({name:'l_top_c', id:'l_top_c'});
		$('.info_list_all').addClass('hidden');
		$('.info_list_all[nctype="'+session_nctype+'"]').removeClass('hidden');
		if(session_ecntype != '' && session_ecntype != 'undefined' && session_ecntype != undefined){
			$('.info_list_all[nctype="'+session_nctype+'"]').find('li[nctype="'+session_ecntype+'"]').find('a.li_mao').attr({name:'li_mao', id:'li_mao'});
		}
	}
	$('.info_list_top_tit ul').css('width', '<?php echo $i * 1.272; ?>rem');
	$('.info_list_top_tit ul li').click(function(){
		if($(this).hasClass('l_top_c')){return;}
		$(this).siblings().removeClass('l_top_c');
		$(this).addClass('l_top_c');
		//加锚点
// 		$(this).attr({name:'l_top_c', id:'l_top_c'});
// 		$(this).siblings().removeAttr('name').removeAttr('id');
		var nctype = $(this).attr('nctype');
		$('.info_list_all').addClass('hidden');
		$('.info_list_all[nctype="'+nctype+'"]').removeClass('hidden');
		window.sessionStorage.setItem('nctype',nctype);
	});

	$('.info_list_all ul li').click(function(){
		var enctype = $(this).attr('nctype');
		window.sessionStorage.setItem('enctype',enctype);
	});
	$('#maodian').click();
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