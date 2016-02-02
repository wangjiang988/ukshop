<?php defined('InUk86') or exit('Access Invalid!');?>

<!--<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/home_point.css" rel="stylesheet" type="text/css">
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/home_login.css" rel="stylesheet" type="text/css">-->

<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/pointprod/layout.css" rel="stylesheet" type="text/css">
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/pointprod/point.css" rel="stylesheet" type="text/css">



<div class="container">
		<div class="ad-ul-out">
			<div class="member-top">
				<div class="head-bd">
						<img src="<?php if ($output['member_info']['member_avatar']!='') { echo UPLOAD_SITE_URL.'/'.ATTACH_AVATAR.DS.$output['member_info']['member_avatar']; } else { echo UPLOAD_SITE_URL.'/'.ATTACH_COMMON. DS.C('default_user_portrait'); } ?>">
						<div class="text">
							<p class="p-01">hi，<?php echo $_SESSION['member_name'];?></p>
							<p class="p-02">当前等级：<strong><?php echo $output['member_info']['level_name'];?></strong></p>
							<p class="p-02">当前经验值：<strong><?php echo $output['member_info']['member_exppoints'];?></strong></p>
						</div>
					</div>
					
				<div class="progress-box">
					<?php if ($output['member_info']['level'] !== -1){ ?>
					<div class="progress-bar-out">
						<span class="sp-01"><?php echo $output['member_info']['level_name']; ?></span>
						<div class="progress-bar">
							<span style="width:<?php echo $output['member_info']['exppoints_rate'];?>%"></span>
						</div>
						<span class="sp-01"><?php echo $output['member_info']['upgrade_name']; ?></span>
						<?php if ($output['member_info']['less_exppoints'] > 0){?>
						<p class="p-01">还差<em><?php echo $output['member_info']['less_exppoints'];?></em>经验值即可升级成为<?php echo $output['member_info']['upgrade_name'];?>等级会员</p>
						<?php } else {?>
					    已达到最高会员级别，继续加油保持这份荣誉哦！
					    <?php }?>	
					    <?php } else { ?>
						  暂无等级
						  <?php } ?>	
					</div>
					<div class="zt">
						<a href="<?php echo uk86_urlShop('pointgrade', 'index');?>"><?php echo $lang['p_my_pointgrade']; ?></a>
						<a href="<?php echo uk86_urlShop('pointgrade', 'exppointlog');?>"><?php echo $lang['p_my_exppointlog']; ?></a>
					</div>	
				</div>
				
				<div class="dl-out">
					<dl>
						<dt><a href="index.php?act=member_points"><?php echo $output['member_info']['member_points']; ?><em><?php echo $lang['p_ubi']; ?></em></a></dt>
						<dd><a href="index.php?act=member_points"><?php echo $lang['p_my_ubi']; ?></a></dd>
					</dl>
					<dl>
						<dt><a href="index.php?act=member_voucher&op=index" target="_blank"><?php echo $output['vouchercount']; ?><em>张</em></a></dt>
						<dd><a href="index.php?act=member_voucher&op=index" target="_blank">可用卡券包</a></dd>
					</dl>
					<dl>
						<dt><a href="index.php?act=member_pointorder&op=orderlist"><?php echo $output['pointordercount']; ?><em>个</em></a></dt>
						<dd><a href="index.php?act=member_pointorder&op=orderlist">已兑换礼品</a></dd>
					</dl>
					</div>
				<a href="index.php?act=pointcart" class="go-a">礼品兑换购物车<em><?php echo $output['pointcart_count']; ?></em></a>
			</div>
			
			
			<ul class="sort-list">
				<input type="hidden" id="sc_id" value="<?php echo intval($_GET['sc_id'])>0?intval($_GET['sc_id']):'';?>"/>
				<li class="<?php echo intval($_GET['sc_id']) <= 0?'active':'';?>"><a  href="javascript:void(0);" nc_type="search_cate" data-param='{"sc_id":""}'>所有分类</a></li>
				<!--<li class="active"><a href="#">所有分类 </a></li>-->
				<?php foreach ($output['store_class'] as $k=>$v){?>
            <li class="<?php echo intval($_GET['sc_id']) == $v['sc_id']?'active':'';?>"><a  href="javascript:void(0);" nc_type="search_cate" data-param='{"sc_id":"<?php echo $v['sc_id'];?>"}'><?php echo $v['sc_name'];?></a></li>
        <?php } ?>
			</ul>
			
			<div class="select-box select-box-02">
				<input type="hidden" id="orderby" name="orderby" value="<?php echo $_GET['orderby']?$_GET['orderby']:'default';?>"/>
				<div class="pt" style="border-right:none;">
					 <!-- 默认排序s -->
            <?php if (!$_GET['orderby'] || $_GET['orderby'] == 'default'){ ?>
            <a href="#" class="in-pt in-pt-active">默认</a>
            <?php } else { ?>
            <a nc_type="search_orderby" data-param='{"orderval":"default"}'  class="in-pt">默认</a>
            <!--<li nc_type="search_orderby" data-param='{"orderval":"default"}'>默认排序</li>-->
            <?php }?>
            <!-- 默认排序e -->
					
					<!-- U币值s -->
            <?php if ($_GET['orderby'] == 'pointsdesc'){//降序选中 ?>
            <a nc_type="search_orderby" data-param='{"orderval":"pointsasc"}'  class="in-pt in-pt-active" style="width:100px;">U币值</a>
            <!--<li class="selected" nc_type="search_orderby" data-param='{"orderval":"pointsasc"}'>U币值<em class="desc"></em></li>-->
            <?php } elseif ($_GET['orderby'] == 'pointsasc') {//升序选中 ?>
            <a nc_type="search_orderby" data-param='{"orderval":"pointsdesc"}'  class="in-pt in-pt-active" style="width:100px;">U币值</a>
            <!--<li class="selected" nc_type="search_orderby" data-param='{"orderval":"pointsdesc"}'>U币值<em class="asc"></em></li>-->
            <?php } else {//未选中?>
            <a nc_type="search_orderby" data-param='{"orderval":"pointsdesc"}'  class="in-pt" style="width:100px;">U币值</a>
            <!--<li nc_type="search_orderby" data-param='{"orderval":"pointsdesc"}'>U币值<em class="desc"></em></li>-->
            <?php } ?>
            <!-- U币值e -->
					
					<!--<a href="#" class="in-pt in-pt-active">默认</a>-->
					<!--<a href="#" class="in-pt" style="width:100px;">U币值</a>-->
					<!--<a href="#" class="in-pt" style="width:100px;">上架时间</a>-->
				</div>
				<dl>
					<dt>优惠券面额：</dt>
					<dd><select id="price" onchange="javascript:searchvoucher();">
                <option value='' selected >-请选择-</option>
                <?php if (!empty($output['pricelist'])){ ?>
                <?php foreach ($output['pricelist'] as $k=>$v){ ?>
                <option value="<?php echo $v['voucher_price'];?>" <?php echo intval($_GET['price']) == $v['voucher_price']?'selected':'';?>><?php echo $v['voucher_price'];?><?php echo $lang['currency_zh'];?>卡券包</option>
                <?php } ?>
                <?php } ?>
              </select></dd>
				</dl>
				<dl>
					<dt>所需U币：</dt>
					<dd>
						 <input type="text" id="points_min" class="text w50" value="<?php echo $_GET['points_min'];?>"/>
              ~
              <input type="text" id="points_max" class="text w50" value="<?php echo $_GET['points_max'];?>" />
              <a href="javascript:searchvoucher();" class="ncp-btn">搜索</a> </li>
					</dd>
				</dl>
				<div class="checkbox-out">
					<label for="isable"><input type="checkbox" id="isable" <?php echo intval($_GET['isable'])==1?'checked="checked"':'';?> onclick="javascript:searchvoucher();">
              &nbsp;只看我能兑换 </label>
					<!--<input class="checkbox-01" name="" type="checkbox" value="" />
					<label>只看我能兑换</label>-->
				</div>
			</div>
			
			
			<div class="ul-01-out">
				 <?php if (!empty($output['voucherlist'])){?>
			<ul>
				 <?php foreach ($output['voucherlist'] as $k=>$v){?>
				<li>
					<div class="left">
						<span class="name text-ellipsis"><a href="<?php echo uk86_urlShop('show_store', 'index', array('store_id'=>$v['voucher_t_store_id']));?>"><?php echo $v['voucher_t_storename'];?></a></span>
						<a href="<?php echo uk86_urlShop('show_store', 'index', array('store_id'=>$v['voucher_t_store_id']));?>"><img src="<?php echo $v['voucher_t_customimg'];?>" onerror="this.src='<?php echo UPLOAD_SITE_URL.DS.uk86_defaultGoodsImage(240);?>'"/></a>
					</div>
					<div class="right">
						<span class="sp-01" style="line-height: 64px;"><em style="padding: 4px;"><?php echo $lang['currency'];?></em><?php echo $v['voucher_t_price'];?></span>
						<span class="sp-02">（购物满<?php echo $v['voucher_t_limit'];?>元可用）</span>
						<span class="sp-03">需<em><?php echo $v['voucher_t_points'];?></em>U币</span>
						<span class="sp-04">有效期至<?php echo @date('Y-m-d',$v['voucher_t_end_date']);?></span>
						<a target="_blank" href="###" nc_type="exchangebtn" data-param='{"vid":"<?php echo $v['voucher_t_id'];?>"}' class="receive">立即领取</a>
						<!--<a class="receive" href="#">立即领取</a>-->
					</div>
				</li>
				 <?php }?>
				
				 <?php }else{?>
		    <div class="norecord"><?php echo $lang['home_voucher_list_null'];?></div>
		    <?php }?>
			</ul>
			
		</div>
		  <?php if (!empty($output['voucherlist'])){?>
		  <div class="pagination-out">
				<div class="pagination"> 
				<?php echo $output['show_page']; ?>
				</div>
			</div>
			 <?php }?>
		</div>
		
	</div>

	


<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/home.js" id="dialog_js" charset="utf-8"></script>
<script>
$(function () {
	$("[nc_type='search_orderby']").click(function(){
		var data_str = $(this).attr('data-param');
	    eval( "data_str = "+data_str);
	    $("#orderby").val(data_str.orderval);
	    searchvoucher();
	});
	$("[nc_type='search_cate']").click(function(){
		var data_str = $(this).attr('data-param');
	    eval( "data_str = "+data_str);
	    $("#sc_id").val(data_str.sc_id);
	    searchvoucher();
	});
});
function searchvoucher(){
	var url = 'index.php?act=pointvoucher&op=index';
	var sc_id = $("#sc_id").val();
	if(sc_id){
		url += ('&sc_id='+sc_id);
	}
	var orderby = $("#orderby").val();
	if(orderby){
		url += ('&orderby='+orderby);
	}
	var price = $("#price").val();
	if(price){
		url += ('&price='+price);
	}
	var points_min = $("#points_min").val();
	if(points_min){
		url += ('&points_min='+points_min);
	}
	var points_max = $("#points_max").val();
	if(points_max){
		url += ('&points_max='+points_max);
	}
	if($("#isable").attr("checked") == 'checked'){
		url += '&isable=1';
	}
	go(url);
}
</script>
