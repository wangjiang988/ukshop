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
<title>优康_我收藏的店铺</title>
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/main.css" type="text/css" media="all">
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/base.css" type="text/css" media="all">
</head>
<body style="background:#F5F5F5">
<!--顶部-->
<header id="header">
<div class="header_con">
	<div class="headerleft">
		<i onClick="javascript:history.go(-1);" class="icon-arrow-left"></i>
	</div>
	<div class="top-tit-div">
		我收藏的店铺
	</div>
	<div class="headerRight">
	</div>
</div>
</header>
<!--顶部结束-->

<div id="content" class="p_bottom_b" style="background:#F5F5F5">
  <?php if(!empty($output['fav_store']) && is_array($output['fav_store'])){ ?>
	<div class="scdp_all">
	  <?php foreach ($output['fav_store'] as $store){ ?>
		<ul class="scdp_list">
			<li><img class="scdp_dpimg" src="<?php echo $store['store_logo']; ?>"></li>
			<li><dl><dt><span style="width:4rem; display:block; overflow:hidden; text-overflow:ellipsis; white-space:nowrap;"><?php echo $store['store_name']; ?></span></dt><dt><?php for($i = 0; $i < $store['store_credit_average']; $i++){ ?><img src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/xy_xin.png"><?php } ?></dt><dt><em>好评率：</em><em><?php echo $store['store_credit_percent'] ?>%</em></dt></dl></li>
			<li style="width:0.8rem;"><div class="scdp_gz" onClick="share_store(<?php echo $store['store_id']; ?>);"></div><div onClick='del_fav_store(<?php echo $store['fav_id']; ?>);' class="scdp_gz"></div></li>
		</ul>
	  <?php } ?>
	</div>
  <?php }else{ ?>
    <div style="color:#999; width:100%; height:70%; text-align:center; background:#FFF;"><span style="margin-top:2.9rem; display:inline-block;">您还没有收藏过店铺<span></span><br /><a href="index.php?act=wap_store" style="display:inline-block; width:1.8rem; height:0.5rem; border:0.02rem solid #999; line-height:0.5rem; border-radius:0.05rem; margin-top:0.2rem; color:#555;">随便逛逛</a></div>
  <?php } ?>
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/zepto.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/carousel-image.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/common.js"></script>
<script type="text/javascript">
//删除
function del_fav_store(id){
	if(confirm('确认删除？')){
		$.get('index.php?act=wap_member&op=del_fav', {fav_id:id, type:'store'}, function(msg){
			if(msg > 0){
				showDialog('删除成功', '', 'index.php?act=wap_member&op=favorites_store');
			}
		});
	}
}
//分享店铺
function share_store(store_id){
	$.post('index.php?act=wap_store&op=share_store', {store_id:store_id}, function(msg){
		if(msg > 0){
			if(msg == 10){
				showDialog('您已分享过次店铺。');
			}else{
				showDialog('分享成功');
			}
		}else{
			showError('分享失败！');
		}
	});
}
</script>
</body>
</html>