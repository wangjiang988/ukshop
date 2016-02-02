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
	<title>优康_账户与安全</title>
	<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/main.css" type="text/css" media="all">
	<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/account.css" type="text/css" media="all">
</head>

<body style="background:#F5F5F5;">
	<!--顶部-->
<header id="header">
	<div class="header_con">
	<div class="headerleft">
		<a href="index.php?act=wap_member_setting"><i class="icon-arrow-left"></i></a>
	</div>
		<div class="top-tit-div">
			账户与安全
		</div>

		<div class="headerRight">
			
		</div>
	</div>
</header>
<!--顶部结束-->
<div id="hidebg" onClick="hide();"></div>
<div id="content" class="p_bottom_b" style="background:#F5F5F5;">
	<div class="account_list_1">
		<ul>
			<li onClick="dialog_show('name_dialog');"><span>会员名</span><img src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/order_right.png"><em><?php echo $output['member_info']['member_name'] ?></em></li>
			<?php if($output['setting_config']['sina_isuse'] == 1){ ?><li onClick="dialog_show('sina_dialog');"><span>我的新浪微博</span><img src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/order_right.png"><em><?php echo $output['member_info']['member_sinaopenid']?'已绑定':'未绑定'; ?></em></li><?php } ?>
			<?php if($output['setting_config']['qq_isuse'] == 1){?><li onClick="dialog_show('qq_dialog');"><span>我的QQ</span><img src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/order_right.png"><em><?php echo $output['member_info']['member_sinaopenid']?'已绑定':'未绑定'; ?></em></li><?php } ?>
			<!-- <li><span>我的微信</span><img src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/order_right.png"><em>jim</em></li> -->
			<li class="email-send"><span>修改绑定邮箱</span><img src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/order_right.png"><em><?php echo !empty($output['member_info']['member_email_bind'])?$output['member_info']['member_email']:'未绑定'; ?></em></li>
			<a href="<?php if(!empty($output['member_info']['member_mobile_bind'])){echo 'index.php?act=wap_member_change&op=change_mobile';}else{echo 'index.php?act=wap_member_change&op=send_mobile&type=1';} ?>">
			  <li><span>修改手机号</span><img src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/order_right.png"><em><?php echo !empty($output['member_info']['member_mobile_bind'])?$output['member_info']['member_mobile']:'未绑定'; ?></em></li>
			</a>
			<a href="index.php?act=wap_member_change&op=changLoginPwd"><li><span>修改登录密码</span><img src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/order_right.png"><em>修改</em></li></a>
			<a href="index.php?act=wap_member_change&op=changePayPwd"><li><span>支付密码</span><img src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/order_right.png"><em><?php if(empty($output['member_info']['member_paypwd'])){echo '未设置';}else{echo '修改';} ?></em></li></a>
		</ul>
	</div>
</div>
<!-- 修改用户名弹出框 -->
<div class="dialog_html name_dialog hidden">
   <div class="dialogBody" style="top:2.5rem;">
	   <i class="close" onClick="dialog_hide();"></i>
	   <div class="dialogHead"><i class="icon-confirm"></i><p>用户名</p></div>
	   <div class="dialogMsg" style="border-bottom: 0.02rem solid #ccc;">
	     <em>用户名：</em><input type="text" id="member_name" value="<?php echo $_SESSION['member_name']; ?>"/>
	   </div>
	   <div class="closeTime"><a class="form_submit" style="background:#5BB75B">&nbsp;&nbsp;确定&nbsp;&nbsp;</a>&nbsp;&nbsp;&nbsp;&nbsp;<a class="hovered" onClick="dialog_hide();">&nbsp;&nbsp;取消&nbsp;&nbsp;</a></div>
   </div>
 </div>
  <!-- 绑定QQ弹出框 -->
 <div class="dialog_html qq_dialog hidden">
   <div class="dialogBody" style="top:2.5rem;">
	   <i class="close" onClick="dialog_hide();"></i>
	   <div class="dialogHead"><i class="icon-confirm"></i><p><?php if (!empty($output['member_info']['member_qqopenid'])){echo '解除QQ绑定';}else{echo '绑定QQ';} ?></p></div>
	   <div class="dialogMsg" style="border-bottom: 0.02rem solid #ccc;">
	   <form method="post" id="editbind_form" name="editbind_form" action="index.php?act=wap_member_setting&op=qqunbind">
        <input type='hidden' id="is_editpw" name="is_editpw" value='no'/>
	     <?php if(empty($output['member_info']['member_qqopenid'])){?>
	       <a class="bind_qq" href="<?php echo SHOP_SITE_URL;?>/api.php?act=toqq"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/qq_bind_small.gif"></a>
	       <p>绑定QQ号后您可以使用QQ帐号轻松登录本网站，无需记住本站账号和密码</p>
	     <?php }else{ ?>
	       <a class="unbind_qq" href="javascript:void(0);"><img src="<?php echo $output['member_qqinfo']['figureurl_qq_2']; ?>"/></a><br /><span class="nickname"><?php echo $output['member_qqinfo']['nickname']; ?></span>
	       <p>您已绑定QQ账号，点击确定解除绑定</p>
	     <?php } ?>
	   </form>
	   </div>
	   <div class="closeTime"><?php if (!empty($output['member_info']['member_qqopenid'])){?> <a class="form_submit" style="background:#5BB75B">&nbsp;&nbsp;确&nbsp;&nbsp;定&nbsp;&nbsp;</a>&nbsp;&nbsp;&nbsp;&nbsp; <?php }?><a class="hovered" onClick="dialog_hide();">&nbsp;&nbsp;取&nbsp;&nbsp;消&nbsp;&nbsp;</a></div>
   </div>
 </div>
   <!-- 绑定新浪微博弹出框 -->
 <div class="dialog_html sina_dialog hidden">
   <div class="dialogBody" style="top:2.5rem;">
	   <i class="close" onClick="dialog_hide();"></i>
	   <div class="dialogHead"><i class="icon-confirm"></i><p><?php if (!empty($output['member_info']['member_sinaopenid'])){echo '解除微博绑定';}else{echo '绑定新浪微博';} ?></p></div>
	   <div class="dialogMsg" style="border-bottom: 0.02rem solid #ccc;">
	   <form method="post" id="editbind_form" name="editbind_form" action="index.php?act=wap_member_setting&op=sinaunbind">
        <input type='hidden' id="is_editpw" name="is_editpw" value='no'/>
	     <?php if(empty($output['member_info']['member_sinaopenid'])){?>
	       <a class="bind_qq" href="<?php echo SHOP_SITE_URL;?>/api.php?act=tosina"><img style="margin-left:1.25rem; width:2.43rem;" src="<?php echo SHOP_TEMPLATES_URL;?>/images/sina_bind_small.gif"></a>
	       <p>绑定微博后您可以使用微博账号轻松登录本网站，无需记住本站账号和密码</p>
	     <?php }else{ ?>
	       <a class="unbind_qq" href="javascript:void(0);"><img style="width:1.5rem; margin-left:1.85rem;" src="<?php echo SHOP_TEMPLATES_URL ?>/images/member/shareicon/bind_sina.png"/></a><br />
	       <p>您已绑定微博账号，点击确定解除绑定</p>
	     <?php } ?>
	   </form>
	   </div>
	   <div class="closeTime"><?php if (!empty($output['member_info']['member_sinaopenid'])){?> <a class="form_submit" style="background:#5BB75B">&nbsp;&nbsp;确&nbsp;&nbsp;定&nbsp;&nbsp;</a>&nbsp;&nbsp;&nbsp;&nbsp; <?php }?><a class="hovered" onClick="dialog_hide();">&nbsp;&nbsp;取&nbsp;&nbsp;消&nbsp;&nbsp;</a></div>
   </div>
 </div>
	<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/zepto.js"></script>
	<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/carousel-image.js"></script>
	<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/common.js"></script>
<script type="text/javascript">
$(function(){
	$('.all_foot').hide();
	//修改用户名
	$('.name_dialog .form_submit').click(function(){
		if($('#member_name').val() == "<?php echo $_SESSION['member_name']; ?>" || $('#member_name').val() == ''){
			$('.dialog_html').hide();
			return false;
		}else{
			$.getJSON('index.php?act=wap_member_setting&op=changeMemberName', {member_name:$('#member_name').val()}, function(data){
				show_message(data);
			});
		}
	});
	//qq解绑
	$('.qq_dialog .form_submit').click(function(){
		$('.qq_dialog #editbind_form').submit();
	});
	$('.sina_dialog .form_submit').click(function(){
		$('.sina_dialog #editbind_form').submit();
	});
	//邮箱绑定
	$('.email-send').click(function(){
		<?php if(empty($output['member_info']['member_mobile_bind']) && !empty($output['member_info']['member_email_bind'])){ ?>
		showDialog('更改绑定的邮箱需要先绑定手机，您还没有绑定手机，先去绑定手机吧', '', 'index.php?act=wap_member_change&op=send_mobile&type=1');
		return;
		<?php }elseif(empty($output['member_info']['member_email_bind'])){ ?>
		window.location.href="index.php?act=wap_member_change&op=send_email&type=1";
		<?php }else{ ?>
		window.location.href="index.php?act=wap_member_change&op=change_email";
		<?php } ?>
	});
});
function dialog_hide(){
	$('.dialog_html').addClass('hidden');
}
function dialog_show(dialog_class){
	$('.'+dialog_class).removeClass('hidden');
}
function show_message(data){
	dialog_hide();
	if(data.state){
		showDialog(data.msg, '', 'index.php?act=wap_member_setting&op=account');
	}else{
		showError(data.msg);
	}
}
</script>
</body>
</html>