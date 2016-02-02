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
<title>优康_管理收货地址</title>
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
		<div class="top-tit-div">管理收货地址</div>
		<div class="headerRight" style="font-size:0.25rem; line-height:0.9rem; padding-left:0.3rem; padding-right:0.3rem;">设为默认</div>
	</div>
</header>
<!--顶部结束-->

<div id="content" class="p_bottom_b" style="background: #F5F5F5;">
  <form id="select_addr">
	<?php if(!empty($output['address_list']) && is_array($output['address_list'])){ ?>
	  <?php foreach($output['address_list'] as $addr_key => $addr_val){ ?>
	    <div class="manage_add_list" style="background:<?php echo $addr_val['is_default']?'#FFFBF2':'#FFF'; ?>">
	      <input type="radio" name="addr_id" class="addr_id hidden" <?php if($addr_val['is_default']){echo 'checked="checked"';} ?> value="<?php echo $addr_val['address_id']; ?>"/>
	      <ul>
	        <li><label class="manage_name"><?php echo $addr_val['true_name']; ?></label><label class="manage_num"><?php echo $addr_val['mob_phone']?$addr_val['mob_phone']:$addr_val['tel_phone']; ?></label></li>
	        <li class="manage_list_2"><p><em><?php if($addr_val['is_default']){echo '【默认】';} ?></em><span><?php echo $addr_val['area_info'].'&nbsp;&nbsp;'.$addr_val['address']; ?></span></p><img class="<?php echo $addr_val['is_default']?'':'hidden' ?>" src="<?php echo SHOP_TEMPLATES_URL; ?>/images/wap/add_dui.png"></li>
	        <li class="manage_list_3"><dl class="manage_list_3_1"><a enctype="<?php echo $addr_val['address_id']; ?>" href="javascript:void(0);">编辑</a></dl><dl class="manage_list_3_2"><a nctype="<?php echo $addr_val['address_id']; ?>" href="javascript:void(0);">删除</a></dl></li>
	      </ul>
	    </div>
	  <?php } ?>
	<?php } ?>
  </form>
  <div class="manage_new_add"><a href="index.php?act=wap_member_address&op=add_addr">+添加新地址</a></div>
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/ajax.form.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/zepto.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/carousel-image.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/common.js"></script>
<script type="text/javascript">
$(function(){
	$('.all_foot').hide();
	//选择收货地址
	$('.manage_add_list').click(function(){
		$(this).siblings().css('background','#FFF');
		$(this).siblings().find('img').addClass('hidden');
		$(this).siblings().children('input').removeAttr('checked');
		$(this).css('background','#FFFBF2');
		$(this).find('img').removeClass('hidden');
		$(this).children('input').attr('checked','checked');
	});
	$('.headerRight').on('click', function(){
		$('#select_addr').ajaxSubmit({
			type : 'get',
			url : 'index.php?act=wap_member_address&op=set_default',
			success : function(msg){
				if(msg > 0){
					if(msg == 11){
						showDialog('编辑成功', '', 'index.php?act=wap_member_address&op=address_list');
					}else{
						showDialog('请勿重复设置默认收货地址');
					}
				}else{
					showError('请选择要设为默认的收货地址');
				}
			}
		});
	});
	$('.manage_list_3_1 a').click(function(){
		var id=$(this).attr('enctype');
		window.location.href="index.php?act=wap_member_address&op=edit_addr&id="+id;
		return false;
	});
	$('.manage_list_3_2 a').click(function(){
		if(confirm('确认删除？')){
			var id=$(this).attr('nctype');
			window.location.href="index.php?act=wap_member_address&op=address_list&id="+id;
		}
		return false;
	});
});
</script>
</body>
</html>