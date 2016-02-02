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
<title>优康_<?php echo $output['isedit']?'编辑':'新增'; ?>收货人信息</title>
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/main.css" type="text/css" media="all">
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/base.css" type="text/css" media="all">
</head>
<body style="background: #F5F5F5;">
<!--顶部-->
<header id="header">
	<div class="header_con">
	<div class="headerleft">
		<i onClick="javascript:history.back(-1);" class="icon-arrow-left"></i>
	</div>
		<div class="top-tit-div"><?php echo $output['isedit']?'编辑':'新增'; ?>收货人信息</div>
		<div class="headerRight"></div>
	</div>
</header>
<!--顶部结束-->

<div id="content" class="p_bottom_b" style="background: #F5F5F5;">
  <form id="edit_form">
	<div class="edit_con_info_list">
		<ul>
			<li><input type="text" value="<?php echo $output['address_info']['true_name']; ?>" id="true_name" name="true_name" placeholder="请输入收货人姓名"/></li>
			<li><input type="text" value="<?php echo $output['address_info']['mob_phone']; ?>" id="mob_phone" name="mob_phone"  placeholder="请输入收货人联系电话"/></li>
			<li><input type="text" name=""  placeholder="请输入邮编"/></li>
		</ul>
	</div>
	<div class="edit_con_info_addname"><span>收货地址</span></div>
	<div class="edit_con_info_add" id="region">
		<?php if($output['isedit']){ ?>
		  <input type="hidden" value="<?php echo $_GET['id']; ?>" name="address_id"/>
		<?php } ?>
		<input type="hidden" value="<?php echo $output['address_info']['city_id']; ?>" name="city_id" id="city_id"/>
		<input type="hidden" value="<?php echo $output['address_info']['area_id']; ?>" name="area_id" id="area_id" class="area_ids"/>
		<input type="hidden" value="<?php echo $output['address_info']['area_info']; ?>" name="area_info" id="area_info" class="area_names"/>
		<select class="cmbProvince <?php echo $output['isedit']?'hidden':''; ?>"></select>
		<input class="click_hide <?php echo $output['isedit']?'':'hidden'; ?>" type="text" value="<?php echo $output['address_info']['area_info'] ?>"/>
	</div>
	<input type="text" value="<?php echo $output['address_info']['address'] ?>" name="address" id="add_more" placeholder="请输入详细地址"/>
	<div class="manage_new_add"><a class="hovered" href=javascript:void(0);>保存</a></div>
  </form>
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/zepto.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/carousel-image.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/common.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/jquery.validation.min.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/common_select.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/ajax.form.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	var is_edit = <?php echo $output['isedit']?'false':'true'; ?>;
	var submit_url = <?php echo $output['isedit']?"'index.php?act=wap_buy&op=edit_addr'":"'index.php?act=wap_buy&op=add_addr'"; ?>;
	var succ_msg = <?php echo $output['isedit']?"'地址编辑成功'":"'新增地址成功'"; ?>;
	$('.all_foot').remove();
	$('select, input').change(function(){$(this).css('background', '#FFF')});
	$('.click_hide').click(function(){
		is_edit = true;
		$(this).addClass('hidden');
		$('.cmbProvince').removeClass('hidden');
	});
	$('.manage_new_add a').click(function(){
		//表单验证
		if($('#true_name').val() == ''){validate($('#true_name'), '请输入收货人姓名');return;}
		if($('#mob_phone').val() == ''){validate($('#mob_phone'), '请输入联系方式');return;}
		if(is_edit == true){
			$('#city_id').val($('#region').children('select').eq(1).val());
			if($('#city_id').val() == '' || $('#city_id').val() == '-请选择-'){validate($('#region select:eq(1)'), '请选择城市'); return;}
			if($('#region select:eq(2)').val() == '' || $('#region select:eq(2)').val() == '-请选择-'){validate($('#region select:eq(2)'), '请选择地区'); return;}
		}
		if($('#add_more').val() == ''){validate($('#add_more'), '请输入详细地址'); return;}
		$('#edit_form').ajaxSubmit({
			type:'post',
			 url:submit_url,
			success:function(data){
				if(data != ''){
					var dataJson = eval('('+ data +')');
					if(dataJson.state){
						showDialog(succ_msg, 2, 'index.php?act=wap_buy&op=buy_step1&addr_id='+dataJson.addr_id);
					}else{
						showError(dataJson.msg);
					}
				}else{
					showDialog('系统错误，请联系客服');
				}
			}
		});
	});
	regionInit("region");
});
function validate(obj, msg){
	showError(msg);
	obj.focus();
	obj.css('background-color','#FFFDF3');
	return;
}
</script>
</body>

</html>
