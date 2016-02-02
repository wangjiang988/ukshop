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
<title>优康_<?php echo $output['info']['article_title_short']; ?></title>
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/base.css" type="text/css" media="all">
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/main.css" type="text/css" media="all">
<style type="text/css">
#content{background:#FFF;}
.main{width:6rem; margin:0 auto;}
.article_title{color:#454545; line-height:0.9rem; font-size:0.35rem;}
.top-tit-div{white-space:nowrap; text-overflow:ellipsis; overflow:hidden; font-size:0.32rem !important;}
.article_nav em{font-size:0.22rem;}
.article_nav em:first-child{color:#56AEDE;}
.article_nav em.modify_time{color:#AAA; margin-left:0.4rem;}
.article_nav span{display:inline-block; float:right; color:#AAA; font-size:0.22rem;}
.article_content{margin-top:0.2rem;}
.article_content span{font-size:0.25rem !important; line-height:0.4rem !important; font-family:"微软雅黑" !important; color:#454545 !important;}
.article_content a{color:#454545;}
.article_content p{color:#454545; font-size:0.25rem; line-height:0.4rem;}
.article_content p img{margin-left:-0.4rem;}
.article_content img{width:6rem; margin:0.2rem auto; height:auto !important;}
.omment_list_content h2{display:inline-block; float:right; font-size:0.22rem; color:#71acda; margin-right:0.1rem;}
</style>
</head>

<body style="background:#FFF;">
<!--顶部-->
<header id="header">
	<div class="header_con">
	<div class="headerleft">
		<a href="index.php?act=wap_cms#li_mao"><i class="icon-arrow-left"></i></a>
	</div>
		<div class="top-tit-div">
			<?php echo $output['info']['article_title_short']; ?>
		</div>
		<div class="headerRight-b" style="right:0.2rem;">
			<i class="icon-arrow-right-b"></i>
		</div>
	</div>
</header>
<!--顶部结束-->
<div id="content" class="p_bottom_b">
  <div class="main">
  	<div class="article_title"><?php echo $output['info']['article_title']; ?></div>
  	<div class="article_nav"><em><?php echo $output['info']['article_author']; ?></em><em class="modify_time"><?php echo date('Y-m-d H:i', $output['info']['article_modify_time']); ?></em><span>浏览：<?php echo $output['info']['article_click']; ?></span></div>
  	<div class="article_content">
  		<?php if(!empty($output['info']['article_abstract'])){ ?><p style="text-indent:0.5rem;"><?php echo $output['info']['article_abstract']; ?></p><?php } ?>
  		<?php echo $output['info']['article_content']; ?>
  	</div>
  	<hr style="border:0.02rem dashed #FFF; margin:0.15rem 0 0.22rem -0.05rem; border-top-color:#CCC;" />
  	<div class="comment_act">
  	  <h3></h3>
  	  <span>已有 <em class="num" style="color:#CC0000;"><?php echo count($output['comment']); ?></em> 人评论</span>
  	  <textarea class="comment_content" maxlength="250" placeholder="最多可输入250个字"></textarea>
  	  <a class="comment_submit hovered" href="javascript:void(0);">发表</a>
  	</div>
  	<div class="comment_list <?php if(empty($output['comment'])){echo 'hidden';} ?>">
  		<div class="comment_list_title">最新评论</div>
  		<?php if(!empty($output['comment']) && is_array($output['comment'])){ ?>
  		 <?php foreach ($output['comment'] as $val){ ?>
  		   <ul>
	  		  <li class="comment_member_avatar"><span><img src="<?php echo uk86_getMemberAvatarForID($val['comment_member_id']); ?>"/></span></li>
	  		  <li class="omment_list_content">
	  		  	<em><?php echo uk86_getMemberNameForId($val['comment_member_id']); ?></em><span>发表于<?php echo date('Y-m-d H:i:s', $val['comment_time']); ?></span>
	  		  	<div><?php echo $val['comment_message']; ?></div>
	  		  	<a class="hovered" cntype="<?php echo $val['comment_id']; ?>" href="javascript:void(0);">顶[<b style="font-weight:100;"><?php echo $val['comment_up']?$val['comment_up']:0; ?></b>]</a>
	  		  	<?php if($output['info']['article_publisher_id'] == $_SESSION['member_id']){ ?><h2 nctype="<?php echo $val['comment_id']; ?>">删除</h2><?php } ?>
	  		  </li>
	  		</ul>
  		 <?php } ?>
  		<?php } ?>
  	</div>
  </div>
</div>
<!-- 分享文章dialog -->
<div class="dialog_html hidden share_article">
 <form id="share_form" method="post" action="index.php">
   <div class="dialogBody" style="top:2.5rem;">
   <i class="close" onClick="dialog_hide();"></i>
   <div class="dialogHead"><i class="icon-confirm"></i><p>分享</p></div>
   <div class="dialogMsg" style="border-bottom: 0.02rem solid #ccc;">
     <div class="article_img"><img src="<?php echo uk86_getCMSArticleImageUrl($output['info']['article_attachment_path'], $output['info']['article_image']); ?>"></div>
     <div class="article_msg">
     	<h1><?php echo $output['info']['article_title']; ?></h1>
     	<em>作者：<?php echo $output['info']['article_author']; ?></em>
     </div>
     <font><?php echo $output['info']['article_abstract']; ?></font>
     <textarea class="article-share-content"></textarea>
   </div>
   <div class="closeTime"><a class="form_submit hovered" style="background:#42B2E6">&nbsp;&nbsp;分享&nbsp;&nbsp;</a>&nbsp;&nbsp;&nbsp;&nbsp;<a class="hovered" onClick="dialog_hide();">&nbsp;&nbsp;取消&nbsp;&nbsp;</a></div>
   </div>
  </form>
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/zepto.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/carousel-image.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/common.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	var article_id = parseInt(<?php echo $_GET['article_id']?$_GET['article_id']:'0'; ?>);
	$('.all_foot').hide();
	$('.article_content a').removeAttr('href');
	if(window.sessionStorage.getItem('comment_message') != ''){
		$('.comment_content').val(window.sessionStorage.getItem('comment_message'));
		window.sessionStorage.setItem('comment_message', '');
	}
	if(window.sessionStorage.getItem('share_message') != ''){
		$('.article-share-content').val(window.sessionStorage.getItem('share_message'));
		window.sessionStorage.setItem('share_message', '')
	}
	//顶
	$('.omment_list_content a').click(function(){
		var comment_id = $(this).attr('cntype');
		if(comment_id == '' || comment_id == undefined){return;}
		var up_obj = $(this).children('b');
		var up_num = parseInt(up_obj.html());
		$.getJSON('index.php?act=wap_cms&op=comment_up', {comment_id:comment_id}, function(data){
			if(data.state){
				up_obj.html(up_num+1);
			}else if(data.url){
				if(confirm('您还未登录，是否前去登录？')){
					window.location.href="index.php?act=wap_login&op=login";
				}
			}
		});
	});
	//评论
	$('.comment_submit').click(function(){
		var comment_content = $('.comment_content').val();
		if(article_id <= 0){return;}
		if(comment_content == ''){return;}
		$.getJSON('index.php?act=wap_cms&op=get_comment', {article_id:article_id, comment_content:comment_content}, function(data){
			if(data.state){
				location.reload(true);
			}else if(data.url){
				if(confirm('您还未登录，是否前去登录？')){
					window.sessionStorage.setItem('comment_message', comment_content);
					window.location.href="index.php?act=wap_login&op=login";
				}
			}
		});
	});
	//分享
	$('.headerRight-b').click(function(){
		$('.dialog_html').removeClass('hidden');
	});
	$('.share_article .form_submit').click(function(){
		var content = $('.article-share-content').val();
		if(content == ''){return false;}
		dialog_hide();
		$.post('index.php?act=wap_cms&op=share_article', {article_id:<?php echo $_GET['article_id']; ?>, content:content}, function(data){
			if(data > 0){
				showDialog('分享成功！');
			}else if(data < 0){
				if(confirm('您还未登录，是否去登录？')){
					window.sessionStorage.setItem('share_message', content);
					window.location.href="index.php?act=wap_login&op=login";
				}
			}else{
				showError('分享失败！');
			}
		});
	});
	<?php if($output['info']['article_publisher_id'] == $_SESSION['member_id']){ ?>
	//文章发布者删除评论
	$('.omment_list_content h2').click(function(){
		var obj = $(this).parent('li').parent('ul');
		var comment_id = $(this).attr('nctype');
		if(comment_id == ''){return;}
		$.getJSON('index.php?act=wap_cms&op=del_comment', {comment_id:comment_id, article_id:article_id}, function(data){
			if(data.state){
				obj.remove();
				$('em.num').html(parseInt($('em.num').html())-1);
				var i = 0;
				$('.comment_list ul').each(function(){
					i++;
				});
				if(i == 0){
					$('.comment_list').addClass('hidden');
				}
			}else{
				 showError('删除失败，请联系管理员！');
			}
		});
	});
	<?php } ?>
});

</script>
</body>
</html>