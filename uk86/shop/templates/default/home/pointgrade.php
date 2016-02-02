<?php defined('InUk86') or exit('Access Invalid!');?>
<!--<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/home_point.css" rel="stylesheet" type="text/css">-->
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
		  
		</div>
		
		<div class="schedule-bt">
			<h3>我的升级进度</h3>
		</div>
		<div class="schedule-bar">
			<span class="v0-sp"></span>
			<?php if ($output['membergrade_arr']){ ?>
			<div class="schedule-bg">
				 <?php foreach ($output['membergrade_arr'] as $k=>$v){ ?>
				<span class="piece piece-0<?php echo $v['level'];?>"></span>
				<?php } ?>
				<span class="v1"></span>
				<span class="v2"></span>
				<span class="v3"></span>
				 
				<div class="in-schedule" style="width:<?php echo $output['member_info']['exppoints_rate'];?>%"></div>
				<p class="experience-p" style="left:295px;">当前经验值：<?php echo $output['member_info']['member_exppoints'];?></p>
				
	         	 <?php } else { ?>
		         	 暂无等级
		          <?php }?>
			</div>
			<span class="v1-sp"></span>
			<span class="v2-sp"></span>
			<span class="v3-sp"></span>
			<p class="ps-01" style="margin-top:40px;">我的当前等级：<em><?php echo $output['member_info']['level_name'];?></em>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;当前经验值：<em><?php echo $output['member_info']['member_exppoints'];?></em></p>
			<p class="ps-01">在有效期前再累积&nbsp;<em><?php echo $output['member_info']['less_exppoints'];?></em>&nbsp;经验值即可升级&nbsp;<em><?php echo $output['member_info']['upgrade_name']; ?></em></p>
		</div>
		
		
		<div class="schedule-bt">
			<h3>经验值结构</h3>
		</div>
		
		
		
		<div class="ncp-grade-layout">
			<dl>
				  <dt><i class="icon-01"></i>
					<p>如何计算经验值</p>
				  </dt>
				  <dd>
					<?php if ($output['ruleexplain_arr']){ ?>
			        <ul>
			          <?php foreach ($output['ruleexplain_arr'] as $v){ ?>
			          <li><?php echo $v; ?></li>
			          <?php } ?>
			        </ul>
			        <?php } ?>
				 </dd>
				</dl>
  		</div>	
		<div class="schedule-bt">
			<h3>有效购物金额</h3>
		</div>
		
		<div class="ncp-grade-layout">
    		<dl>
				  <dt><i class="icon-02"></i>
					<p>有效范围</p>
				  </dt>
				  <dd>
						<?php if ($output['ruleexplain_arr']['exp_order']){ ?>
				        <ul>
				          <li>实物交易订单的在<strong>【确认完成】</strong>后，该笔订单金额计入有效购物金额；在您收货后，请到<strong>【实物交易订单】</strong>中，点击<strong>【确认收货】</strong>，经验值会更快地发放；</li>
				          <li>虚拟兑换订单的在<strong>【已完成】</strong>后，该笔订单金额计入有效购物金额；</li>
				        </ul>
       				 <?php } ?>
				 </dd>
				</dl>
  		</div>	
	</div>

<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/home.js" id="dialog_js" charset="utf-8"></script> 
