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
<title>优康_我的生日</title>
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/main.css" type="text/css" media="all">
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/account.css" type="text/css" media="all">
<link type="text/css" rel="stylesheet" href="<?php echo RESOURCE_SITE_URL."/js/jquery-ui/themes/ui-lightness/jquery.ui.css";?>"/>
<style type="text/css">
.date{width:5rem; margin-left:0.6rem; border:0.02rem solid #CCC; line-height:0.5rem; border-radius:0.1rem;
	background : url(./admin/templates/default/images/input_date.gif) no-repeat; background-size:0.48rem 0.48rem;
	padding-left:0.5rem; margin-top:0.2rem;
}
.ui-datepicker{width:4.8rem; margin-left:0.6rem;}
thead tr th span{color:#333;}
.ui-datepicker-title select{color:#333;}
.headerRight span{display:inline-block; font-size:0.3rem; line-height:0.9rem; margin-right:0.2rem;}
.top-tit-div{font-size:0.34rem !important;}
</style>
</head>
<body style="background:#FFF;">
<!--顶部-->
<header id="header">
	<div class="header_con">
	<div class="headerleft">
		<a href="index.php?act=wap_member_setting&op=account"><i class="icon-arrow-left"></i></a>
	</div>
		<div class="top-tit-div">
			我的生日
		</div>
		<div class="headerRight">
		 <span>保存</span>
		</div>
	</div>
</header>
<div id="content" style="background:#FFF;">
  	<div style="height: 0.2rem; width:100%;"></div>
	<span style="color:#333333; font-size:0.35rem; line:height:0.6rem;">&nbsp;&nbsp;&nbsp;出生日期：</span><br />
	<input type="text" id="birthday_date" class="txt date hasDatepicker" value="<?php echo $output['birthday']; ?>" readonly="readonly"/>
</div>
<div type="text" id="datepicker"></div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/zepto.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/carousel-image.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/common.js"></script>
<script src="<?php echo RESOURCE_SITE_URL."/js/jquery-ui/jquery.ui.js";?>"></script> 
<script src="<?php echo RESOURCE_SITE_URL."/js/jquery-ui/i18n/zh-CN.js";?>" charset="utf-8"></script> 
<script type="text/javascript">
$(function(){
	$('.all_foot').hide();
	//选择日期
	$( "#datepicker" ).datepicker({
		defaultDate: new Date(<?php echo $output['date']; ?>),
		altField: "#birthday_date",
	    altFormat: "yy-mm-dd"
	});
	//保存
	$('.headerRight span').click(function(){
		$.post('index.php?act=wap_member_setting&op=setting_brithday', {birthday:$('#birthday_date').val()}, function(msg){
			if(msg > 0){
				showDialog('保存成功！', '', 'index.php?act=wap_member_setting&op=account');
			}else{
				showError('保存失败！');
			}
		});
	});
});
</script>
</body>
</html>