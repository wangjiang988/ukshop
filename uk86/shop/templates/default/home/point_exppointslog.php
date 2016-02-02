<?php defined('InUk86') or exit('Access Invalid!');?>
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
				<a class="go-a" href="index.php?act=pointcart">礼品兑换购物车<em><?php echo $output['pointcart_count']; ?></em></a>
			</div>
			
			<div class="mx-box">
				<table border="0">
				  <tr>
					<th width="262">添加时间 </th>
					<th width="196">获得经验</th>
					<th width="286">操作阶段</th>
					<th>描述</th>
				  </tr>
				   <?php  if (count($output['list_log'])>0) { ?>
          <?php foreach($output['list_log'] as $val) { ?>
				  <tr>
					<td><?php echo @date('Y-m-d',$val['exp_addtime']);?></td>
					<td><?php echo ($val['exp_points'] > 0 ? '' : '-').$val['exp_points']; ?></td>
					<td><?php 
        	              	switch ($val['exp_stage']){
        	              		case 'login':
        	              			echo '会员登录';
        	              			break;
        	              		case 'comments':
        	              			echo '商品评论';
        	              			break;
        	              		case 'order':
        	              			echo '订单消费';
        	              			break;
        	              	}
        	              ?> </td>
					<td><?php echo $val['exp_desc'];?></td>
				  </tr>
				  <?php } ?>
          <?php } else { ?>
				  <tr>
						<td colspan="20" class="norecord"><div class="warning-option"><i>&nbsp;</i><span><?php echo $lang['no_record']; ?></span></div></td>
				  </tr>
				  <?php } ?>
				  <tfoot>
          <?php  if (count($output['list_log'])>0) { ?>
          <tr>
            <td colspan="20"><div class="pagination"><?php echo $output['show_page']; ?></div></td>
          </tr>
          <?php } ?>
        </tfoot> 
				</table>

			</div>
			
		  
		</div>
</div>



