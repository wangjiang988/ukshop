<?php defined('InUk86') or exit('Access Invalid!');?>
<!--<link href="--><?php //echo SHOP_TEMPLATES_URL;?><!--/css/pointprod/base.css" rel="stylesheet" type="text/css">-->
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/pointprod/layout.css" rel="stylesheet" type="text/css">
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/pointprod/point.css" rel="stylesheet" type="text/css">

	
	<div class="container">
		
		<div class="top-member">
			<div class="left">
				<a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/img/mall-43.gif" /></a>
			</div>
			<div class="right">
			<?php if($_SESSION['is_login'] == '1'){?>
				<div class="login-after">
					<div class="head-bd">
						<img src="<?php if ($output['member_info']['member_avatar']!='') { echo UPLOAD_SITE_URL.'/'.ATTACH_AVATAR.DS.$output['member_info']['member_avatar']; } else { echo UPLOAD_SITE_URL.'/'.ATTACH_COMMON. DS.C('default_user_portrait'); } ?>" />
						<div class="text">
							 <p class="p-01"><?php echo $lang['p_hi'].$output['member_info']['member_name'];?></p>
		            <p class="p-02"><?php echo $lang['p_current_level'].$output['member_info']['level_name'];?></p>
		            <p class="p-02"><?php echo $lang['p_current_point'].$output['member_info']['member_exppoints'];?></p>
						</div>
					</div>
					<div class="progress-bar-out">
						<span class="sp-01"><?php echo $output['member_info']['level_name'];?></span>
	          <div class="progress-bar">
	            <span style="width:<?php echo $output['member_info']['exppoints_rate'];?>%"></span>
	          </div>
	          <span class="sp-01"><?php echo $output['member_info']['upgrade_name'];?></span>
	          <p class="p-01"><?php echo $lang['p_exppoints_explaination_1'];?><em><?php echo $output['member_info']['less_exppoints'];?></em><?php echo $lang['p_exppoints_explaination_2'].$output['member_info']['upgrade_name'];?><?php echo $lang['p_exppoints_explaination_3'];?></p>
					</div>
					<div class="zt">
						<a href="<?php echo uk86_urlShop('pointgrade', 'index');?>"><?php echo $lang['p_my_pointgrade']; ?></a>
						<a href="<?php echo uk86_urlShop('pointgrade', 'exppointlog');?>"><?php echo $lang['p_my_exppointlog']; ?></a>
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
					<a class="go-a" href="index.php?act=pointcart">礼品兑换购物车<em><?php echo $output['pointcart_count']; ?></em></a>
				
				</div>
				<?php } else { ?>
				<div class="login-box">
					<p>获知会员信息详情<br />换取店铺代金券买商品更划算</p>
					<a class="login-a" href="javascript:login_dialog();">立即登录</a>
				</div>
				 <?php }?>
			</div>
		</div>
		
		
		<div class="ad-ul-out">
			<?php if (C('voucher_allow')==1){?>
			<div class="ad-bt-box">热门代金券</div>
			<div class="ad-more"><a href="<?php echo uk86_urlShop('pointvoucher', 'index');?>">更多&nbsp;<em>&gt;&gt;</em></a></div>
			<div class="ul-01-out">
			<?php if (!empty($output['recommend_voucher'])){?>
			<ul>
				<?php foreach ($output['recommend_voucher'] as $k=>$v){?>
				<li>
					<div class="left">
						<span class="name text-ellipsis"><a href="<?php echo uk86_urlShop('show_store', 'index', array('store_id'=>$v['voucher_t_store_id']));?>"><?php echo $v['voucher_t_sc_name'];?></a></span>
						<a href="<?php echo uk86_urlShop('show_store', 'index', array('store_id'=>$v['voucher_t_store_id']));?>"><img src="<?php echo $v['voucher_t_customimg'];?>" /></a>
					</div>
					<div class="right">
						<span class="sp-01"><em>￥</em><?php echo $v['voucher_t_price'];?></span>
						<span class="sp-02">（购物满<?php echo $v['voucher_t_limit'];?>元可用）</span>
						<span class="sp-03">需<em><?php echo $v['voucher_t_points'];?></em>U币</span>
						<span class="sp-04">有效期至<?php echo @date('Y-m-d',$v['voucher_t_end_date']);?></span>
						<a href="#" class="receive">立即领取</a>
					</div>
				</li>
				<?php }?>
			</ul>
			<?php }else{?>
			<div class="norecord"><?php echo $lang['home_voucher_list_null'];?></div>	
			<?php }?>
		</div>
		<?php }?>
			
		<?php if (C('pointprod_isuse')==1){?>	
			<div class="ad-bt-box">热门礼品</div>
			<div class="ad-more"><a href="<?php echo uk86_urlShop('pointprod', 'plist');?>">更多&nbsp;<em>&gt;&gt;</em></a></div>
			 <?php if (is_array($output['recommend_pointsprod']) && count($output['recommend_pointsprod'])>0){?>			
			<ul class="ncp-exchange-list">
				<?php foreach ($output['recommend_pointsprod'] as $k=>$v){?>
         <li>
        <div class="gift-pic"><a href="<?php echo uk86_urlShop('pointprod', 'pinfo', array('id' => $v['pgoods_id']));?>"> <img alt="<?php echo $v['pgoods_name']; ?>" src="<?php echo $v['pgoods_image'] ?>"> </a></div>
        <div class="gift-name"><a title="<?php echo $v['pgoods_name']; ?>" target="_blank" href="<?php echo uk86_urlShop('pointprod', 'pinfo', array('id' => $v['pgoods_id']));?>"><?php echo $v['pgoods_name']; ?></a></div>
        <div class="exchange-rule">
              <?php if (intval($v['pgoods_limitmgrade']) > 0){ ?>
		          	<span class="pgoods-grade"><?php echo $v['pgoods_limitgradename']; ?></span>
		          <?php } ?>
               <span class="pgoods-price"><?php echo $lang['pointprod_goodsprice'].$lang['nc_colon']; ?><em><?php echo $lang['currency'].$v['pgoods_price']; ?></em></span> <span class="pgoods-points"><?php echo $lang['pointprod_pointsname'].$lang['nc_colon'];?><strong><?php echo $v['pgoods_points']; ?></strong><?php echo $lang['points_unit']; ?></span>
         </li>
         <?php } ?>
			</ul>
			<?php }else{?>
				<div class="norecord"><?php echo $lang['pointprod_list_null'];?></div>
			<?php }?>
				
			<?php }?>
   </div>
</div>

	

<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.luara.0.0.1.min.js" id="dialog_js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/home.js" id="dialog_js" charset="utf-8"></script>
