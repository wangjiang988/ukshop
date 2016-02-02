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
<title>编辑所在地区</title>
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/main.css" type="text/css" media="all">
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/base.css" type="text/css" media="all">
</head>
<body style="background: #F5F5F5;">
<!--顶部-->
<header id="header">
	<div class="header_con">
	<div class="headerleft">
			<i onClick="javascript:history.go(-1);" class="icon-arrow-left"></i>
	</div>
		<div class="top-tit-div">编辑所在地区</div>
		<div class="headerRight"><span class="edit" style="height:100%; width:0.9rem; display:inline-block; margin-top:0.04rem;">保存</span></div>
	</div>
</header>
<!--顶部结束-->

<div id="content" class="p_bottom_b" style="background: #F5F5F5;">
  <form id="member_area">
    <div style="height: 0.2rem; width:100%;"></div>
	<span style="color:#333333; font-size:0.35rem; line:height:0.6rem;">&nbsp;&nbsp;您所在的地区：</span>
	<div class="edit_con_info_add" id="region">
		<!-- <input type="hidden" value="" name="city_id" id="city_id" class="city_id"/> -->
		<input type="hidden" value="<?php echo $output['area_id']; ?>" name="area_id" id="area_id" class="area_ids"/>
		<input type="hidden" value="<?php echo $output['area_info'] ?>" name="area_info" id="area_info" class="area_names"/>
		<select class="cmbProvince hidden"></select>
		<input class="click_hide" type="text" value="<?php echo $output['area_info'] ?>"/>
	</div>
  </form>
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/zepto.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/carousel-image.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/common.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/jquery.validation.min.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/common_select.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/ajax.form.js"></script>
<script type="text/javascript">
$(function(){
	$('.all_foot').hide();
	$('.click_hide').click(function(){
		$(this).addClass('hidden');
		$('.cmbProvince').removeClass('hidden');
	});
	regionInit("region");
	$('.edit').click(function(){
		if($('#area_info').val() == '' || $('#area_id').val() == '' || $('#area_id').val() == <?php echo $output['area_id']?$output['area_id']:'a'; ?>){
			window.location.href="index.php?act=wap_member_setting&op=account";
			return false;
		}
		$('#member_area').ajaxSubmit({
			type:'post',
			url:'index.php?act=wap_member_setting&op=memberAddress',
			success:function(data){
				if(data){
					showDialog('编辑成功', '', 'index.php?act=wap_member_setting&op=account');
				}else{
					showError('编辑失败');
				}
			}
		});
	});
});
</script>
</body>
</html>