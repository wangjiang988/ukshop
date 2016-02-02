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
<title>优康_我的账户</title>
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/main.css" type="text/css" media="all">
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/account.css" type="text/css" media="all">
<style type="text/css">
.dialogMsg{padding-bottom:0.2rem;}
</style>
</head>
<body style="background:#F5F5F5;">
<!--顶部-->
<header id="header">
	<div class="header_con">
	<div class="headerleft">
		<a href="index.php?act=wap_member_setting"><i class="icon-arrow-left"></i></a>
	</div>
		<div class="top-tit-div">
			我的账户
		</div>
		<div class="headerRight">
		</div>
	</div>
</header>
<!--顶部结束-->
<?php $member = $output['member_info']; ?>
<div id="content" style="background:#F5F5F5;">
	<div class="account_list_1">
		<ul>
			<a href="index.php?act=wap_member_setting&op=change_avatar"><li class="avatar"><span>头像</span><img src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/order_right.png"><img class="account_img" src="<?php echo uk86_getMemberAvatar($member['member_avatar']); ?>"></li></a>
			<li class="member_name" onClick="dialog_show('name_dialog');"><span>用户名</span><img src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/order_right.png"><em><?php echo $member['member_name']; ?></em></li>
			<li class="email-send"><span>绑定邮箱</span><img src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/order_right.png"><em><?php echo $member['member_email']; ?></em></li>
			<li class="true_name" onClick="dialog_show('true_name_dialog');"><span>真实姓名</span><img src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/order_right.png"><em><?php echo $member['member_truename']?$member['member_truename']:'未填写'; ?></em></li>
			<li class="sex" onClick="dialog_show('sex_dialog');"><span>性别</span><img src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/order_right.png"><em><?php if($member['member_sex'] == 1){echo '男';}elseif($member['member_sex'] == 2){echo '女';}else{echo '保密';} ?></em></li>
			<a href="index.php?act=wap_member_setting&op=setting_brithday"><li class="birthday"><span>生日</span><img src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/order_right.png"><em><?php echo !empty($member['member_birthday'])?$member['member_birthday']:'未设置'; ?></em></li></a>
			<a href="index.php?act=wap_member_setting&op=memberAddress"><li class="address"><span>所在地区</span><img src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/order_right.png"><em><?php echo $member['member_areainfo']?$member['member_areainfo']:'去设置'; ?></em></li></a>
			<!-- <?php if ($output['setting_config']['qq_isuse'] == 1){?><li onClick="dialog_show('qq_dialog')"; class="name_qq"><span>QQ</span><img src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/order_right.png"><em><?php echo !empty($member['member_qqopenid'])?'已绑定':'未绑定'; ?></em></li><?php } ?> -->
			<!-- <li class="name_ww" onClick="dialog_show('ww_dialog');"><span>阿里旺旺</span><img src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/order_right.png"><em><?php echo $member['member_ww']?$member['member_ww']:'未绑定'; ?></em></li> -->
		</ul>
	</div>
	<!-- <input accept="image/*" type="file" class="hidden" value="" name="avatar"/> -->
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
 <!-- 修改真实姓名弹出框 -->
 <div class="dialog_html true_name_dialog hidden">
   <div class="dialogBody" style="top:2.5rem;">
	   <i class="close" onClick="dialog_hide();"></i>
	   <div class="dialogHead"><i class="icon-confirm"></i><p>真实姓名</p></div>
	   <div class="dialogMsg" style="border-bottom: 0.02rem solid #ccc;">
	     <em>真实姓名：</em><input type="text" id="member_true_name" value="<?php echo $member['member_truename']; ?>"/>
	   </div>
	   <div class="closeTime"><a class="form_submit" style="background:#5BB75B">&nbsp;&nbsp;确定&nbsp;&nbsp;</a>&nbsp;&nbsp;&nbsp;&nbsp;<a class="hovered" onClick="dialog_hide();">&nbsp;&nbsp;取消&nbsp;&nbsp;</a></div>
   </div>
 </div>
 <!-- 修改性别天出框 -->
 <div class="dialog_html sex_dialog hidden">
   <div class="dialogBody" style="top:2.5rem;">
	   <i class="close" onClick="dialog_hide();"></i>
	   <div class="dialogHead"><i class="icon-confirm"></i><p>性别/p></div>
	   <div class="dialogMsg" style="border-bottom: 0.02rem solid #ccc;">
	     <em>性别：</em><label><input type="radio" name="sex" class="sex" <?php echo $member['member_sex'] == 2?'checked="checked"':'' ?> value="2"/>女</label>&nbsp;&nbsp;<label><input type="radio" name="sex" class="sex" <?php echo $member['member_sex'] == 1?'checked="checked"':'' ?> value="1"/>男</label>&nbsp;&nbsp;<label><input type="radio" name="sex" class="sex" <?php if($member['member_sex'] == 3 || empty($member['member_sex'])){ echo 'checked="checked"';} ?> value="3"/>保密</label>
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
	   <form method="post" id="editbind_form" name="editbind_form" action="index.php?act=member_connect&op=qqunbind">
        <input type='hidden' id="is_editpw" name="is_editpw" value='no'/>
	     <?php if(empty($member['member_qqopenid'])){?>
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
  <!-- 绑定旺旺弹出框 -->
  <!-- <div class="dialog_html ww_dialog hidden">
   <div class="dialogBody" style="top:2.5rem;">
	   <i class="close" onClick="dialog_hide();"></i>
	   <div class="dialogHead"><i class="icon-confirm"></i><p>绑定旺旺账号</p></div>
	   <div class="dialogMsg" style="border-bottom: 0.02rem solid #ccc;">
	     <em>旺旺账号：</em><input type="text" id="member_ww" value="<?php echo $member['member_ww']; ?>"/>
	   </div>
	   <div class="closeTime"><a class="form_submit" style="background:#5BB75B">&nbsp;&nbsp;确定&nbsp;&nbsp;</a>&nbsp;&nbsp;&nbsp;&nbsp;<a class="hovered" onClick="dialog_hide();">&nbsp;&nbsp;取消&nbsp;&nbsp;</a></div>
   </div>
 </div> -->
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/ajax.form.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/zepto.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/carousel-image.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/common.js"></script>
<script type="text/javascript">
$(document).ready(function(){
//	$('.dialog_html').hide();
	$('.all_foot').hide();
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
	$('.true_name_dialog .form_submit').click(function(){
		var true_name = $('#member_true_name').val();
		if(true_name == "<?php echo $member['member_truename']?$member['member_truename']:''; ?>" || true_name == ''){
			dialog_hide();
			return false;
		}else{
			$.getJSON('index.php?act=wap_member_setting&op=changeMemberTrueName', {true_name:true_name}, function(data){
				show_message(data);
			});
		}
	});
	$('.sex_dialog .form_submit').click(function(){
		var sex = 0
		$('.sex').each(function(){
			if($(this).attr('checked')){
				sex = $(this).val()
			}
		});
		if(sex == '<?php echo $member['member_sex']?$member['member_sex']:0; ?>'){
			dialog_hide();
			return false;
		}
		$.getJSON('index.php?act=wap_member_setting&op=changeMemberSex', {sex:sex}, function(data){
			show_message(data);
		});
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
