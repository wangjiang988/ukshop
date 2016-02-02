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
<title>优康_圈子详情</title>
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/main.css" type="text/css" media="all">
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/base.css" type="text/css" media="all">
<style type="text/css">
.article-share-content{font-size:0.22rem;}
.color-red{color:#F00 !important;}
</style>
</head>
<body>
<!--顶部-->
<header id="header">
	<div class="header_con">
	<div class="headerleft">
		<i onClick="javascript:history.go(-1);" class="icon-arrow-left"></i>
	</div>
		<div class="top-tit-div">
			<?php echo $output['circle_info']['circle_name']; ?>
		</div>

		<div class="headerRight">
		</div>
	</div>
</header>
<div id="content" class="" style="background:#F5F5F5;">
	<div class="circle-info-top">
	  <div class="circle-image"><img src="<?php echo uk86_circleLogo($_GET['c_id']); ?>"/></div>
	  <div class="circle-info-right">
	    <h1><em><?php echo $output['circle_info']['circle_name']; ?></em><?php if(empty($output['is_master'])){ ?><?php if(empty($output['is_this_user'])){ ?><a class="hovered circle-apply"><i class="circle-right-apply"></i>申请加入</a><?php }else{ ?><a class="hovered circle-exit"><i class="circle-right-exit"></i>退出</a><?php } ?><?php } ?></h1>
	    <h2><?php echo $output['circle_info']['circle_desc']; ?></h2>
	    <h3><em>人气  <?php echo $output['circle_info']['circle_mcount']; ?></em>&nbsp;&nbsp;&nbsp;&nbsp;<font>话题 <?php echo $output['circle_info']['circle_thcount']; ?></font></h3>
	    <h4>圈主：<em><?php echo $output['circle_info']['circle_mastername']; ?></em><br />管理：<?php if(empty($output['admin_list'])){ ?>暂无管理员<?php }else{echo '<a class="hovered">'.$output['admin_list'][0]['member_name'].'</a>&nbsp;&nbsp;&nbsp;&nbsp;<a class="hovered">'.$output['admin_list'][1]['member_name'].'</a>';} ?></h4>
	  </div>
	</div>
	<div class="circle-all-theme"><i class="icon-angle-up"></i>最新话题</div>
	<?php if(!empty($output['theme_list']) && is_array($output['theme_list'])){ ?>
	  <?php foreach ($output['theme_list'] as $t_v){ ?>
	   <a href="index.php?act=wap_circle&op=circleTheme&c_id=<?php echo $_GET['c_id']; ?>&theme_id=<?php echo $t_v['theme_id']; ?>">
		<div class="circle-theme-list">
		  <div class="circle-theme-top">
		    <img src="<?php echo uk86_getMemberAvatarForID($t_v['member_id']); ?>">
		    <em><?php echo $t_v['member_name']; ?></em>
		  </div>
		  <div class="circle-theme-title"><?php echo $t_v['theme_name']; ?></div>
		  <div class="circle-theme-content <?php if(!empty($t_v['affix']) && is_array($t_v['affix'])){echo 'circle-overflow-hidden';}else{echo 'circle-text-indent';} ?>">
		    <?php if(!empty($t_v['affix']) && is_array($t_v['affix'])){ ?>
		      <?php foreach ($t_v['affix'] as $x_v){ ?>
		        <img src="<?php echo uk86_themeImageUrl($x_v['affix_filethumb']); ?>">
		      <?php } ?>
		    <?php }else{echo uk86_replaceUBBTag($t_v['theme_content']); /* uk86_ubb */} ?>
		  </div>
		  <div class="circle-theme-foot">
		    <em>浏览<?php echo $t_v['theme_browsecount']; ?>次</em>
		    <em><?php echo $t_v['theme_commentcount']; ?>人评论</em>
		    <em><?php echo date('Y-m-d H:i', $t_v['theme_addtime']); ?></em>
		  </div>
		</div>
	   </a>
	  <?php } ?>
	<?php }else{ ?>
		<div style="color:#999; width:100%; height:53%; text-align:center; background:#FFF;"><span style="margin-top:2.9rem; display:inline-block;">还没有圈友发表话题<span></span><br /></div>	  
	<?php } ?>
</div>
<!-- 申请加入圈子dialog -->
<div class="dialog_html hidden share_article">
 <form id="apply_form" method="post">
   <input type="hidden" name="c_id" id="c_id" value="<?php echo $_GET['c_id']; ?>"/>
   <div class="dialogBody" style="top:2.5rem;">
   <i class="close" onClick="dialog_hide();"></i>
   <div class="dialogHead"><i class="icon-confirm"></i><p>申请加入</p></div>
   <div class="dialogMsg" style="border-bottom: 0.02rem solid #ccc;">
   	 <div class="article_msg">
     	<h1 style="font-size:0.28rem;">申请加入圈子的原因</h1><em class="color-red hidden applycontent-error">*请填写申请原因</em>
     </div>
     <hr style="border:0.02rem solid #FFF; border-bottom-color:#EFEFEF; display:inline-block; width:100%;"/>
     <em style="color:#666; font-size:0.22rem; font-weight:600;">希望您能告诉我们是什么原因使您加入到本圈？</em>
     <textarea class="article-share-content applycontent" maxlength="140" placeholder="例如：本人乃购物达人，大家志同道合，有好多购物经验要和圈友分享哦！" name="cm_applycontent"></textarea>
     <div class="article_msg">
     	<h1 style="font-size:0.28rem;">新人自我介绍</h1><em class="color-red hidden intro-error">*请填写自我介绍</em>
     </div>
     <hr style="border:0.02rem solid #FFF; border-bottom-color:#EFEFEF; display:inline-block; width:100%;"/>
     <em style="color:#666; font-size:0.22rem; font-weight:600;">写下你的个性介绍，让别的圈友了解并熟悉你。</em>
     <textarea class="article-share-content intro" maxlength="140" placeholder="例如：大家好，我是咪咪，女，90后，天秤座，来自北京，爱好：买衣服，挑首饰，自拍，交朋友..." name="cm_intro"></textarea>
   </div>
   <div class="closeTime"><a class="form_submit hovered" style="background:#42B2E6;">&nbsp;&nbsp;提交申请&nbsp;&nbsp;</a>&nbsp;&nbsp;&nbsp;&nbsp;<a class="hovered" onClick="dialog_hide();">&nbsp;&nbsp;取消&nbsp;&nbsp;</a></div>
   </div>
  </form>
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/ajax.form.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/zepto.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/carousel-image.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/common.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.all_foot').hide();
	$('.applycontent').change(function(){
		$('.applycontent-error').addClass('hidden');
	});
	$('.intro').change(function(){
		$('.intro-error').addClass('hidden');
	});
	//申请加入圈子
	$('.circle-apply').click(function(){
		$('.dialog_html').removeClass('hidden');
	});
	//提交申请
	$('.form_submit').click(function(){
		//验证表单
		var validate = validate_form();
		if(validate){
			$('#apply_form').ajaxSubmit({
				type : 'post',
				url : 'index.php?act=wap_circle&op=circleMemberApply',
				success : function(data){
					var dataJson = eval('('+data+')');
					if(dataJson.state){
						showDialog(dataJson.msg, '', '<?php echo "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>');
					}else{
						showError(dataJson.msg);
					}
				}
			});
		}
	});

	//退出圈子
	$('.circle-right-exit').click(function(){
		$.post('index.php?act=wap_circle&op=circleMemberExit', {c_id : $('#c_id').val()}, function(data){
			if(data > 0){
				showDialog('操作成功。', '', '<?php echo "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>');
			}else{
				showError('操作失败。');
			}
		});
	});
});
//表单验证
function validate_form(){
	var applycontent_error = true;
	var intro_error = true;
	if($('.applycontent').val() == ''){
		applycontent_error = false;
		$('.applycontent-error').removeClass('hidden');
	}
	if($('.intro').val() == ''){
		intro_error = false;
		$('.intro-error').removeClass('hidden');
	}
	if(intro_error && applycontent_error){
		return true;
	}
	return false;
}
function dialog_hide(){
	$('.dialog_html').addClass('hidden');
	$('.applycontent-error,.intro-error').addClass('hidden');
}
</script>
</body>
</html>