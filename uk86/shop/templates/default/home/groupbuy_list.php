<?php defined('InUk86') or exit('Access Invalid!');?>
<!--<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/home_group.css" rel="stylesheet" type="text/css">
<style type="text/css">
.nch-breadcrumb-layout {display: none; }
</style>-->
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/pointprod/layout.css" rel="stylesheet" type="text/css">
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/pointprod/point.css" rel="stylesheet" type="text/css">
<!--<div class="nch-breadcrumb-layout" style="display: block;">
  <div class="nch-breadcrumb wrapper"> <i class="icon-home"></i> <span> <a href="<?php echo uk86_urlShop(); ?>">首页</a> </span> <span class="arrow">></span> <span>商城抢购</span></div>
</div>-->
<script type="text/javascript">
$(function(){
		$('.part-05 .bd-04 ul li').hover(
			function(){
				  $(this).addClass("active");
			},
			function () {
				  $(this).removeClass("active");
			} 
			
	);
	
		$('.dl-out').hover(
			function(){
				  $(this).addClass("active");
			},
			function () {
				  $(this).removeClass("active");
			} 				
		);
		$('.dl-out-second').hover(
			function(){
				  $(this).addClass("active");
			},
			function () {
				  $(this).removeClass("active");
			} 				
		);
		
		$('.sc-box').hover(
			function(){
				  $(this).addClass("active");
			},
			function () {
				  $(this).removeClass("active");
			} 				
		);
		
		$('.settleup').hover(
			function(){
				  $(this).addClass("settleup-active");
			},
			function () {
				  $(this).removeClass("settleup-active");
			} 				
		);
		$('.mylife').hover(
			function(){
				  $(this).addClass("mylife-active");
			},
			function () {
				  $(this).removeClass("mylife-active");
			} 				
		);
		
		$('.user-tx').click(function(){
			$('.user-login-box').show();
		})
		$('.close').click(function(){
			$('.user-login-box').hide();
		})
		
		$('.buying-list li').hover(
			function(){
				  $(this).addClass("active");
			},
			function () {
				  $(this).removeClass("active");
			} 				
		);
		
	});
	
	
</script>

<div class="container">
		<div class="ad-ul-out">
			<div class="select-box">
				<div class="pt">
					<a  class="in-pt <?php echo empty($_GET['groupbuy_order_key'])?'in-pt-active':''?>" href="<?php echo dropParam(array('groupbuy_order_key', 'groupbuy_order'))?>">综合</a>
					<a  class="in-pt <?php echo $_GET['groupbuy_order_key'] == '3'?'in-pt-active':'';?>" <?php echo $_GET['groupbuy_order_key'] == '3'?"class='". ($_GET['groupbuy_order'] == 1 ? 'asc' : 'desc') ."'":'';?> href="<?php echo ($_GET['groupbuy_order_key'] == '3' && $_GET['groupbuy_order'] == '2' ? replaceParam(array('groupbuy_order_key' => '3', 'groupbuy_order' => '1')) : replaceParam(array('groupbuy_order_key' => '3', 'groupbuy_order' => '2')));?>">销量<em class="<?php echo $_GET['groupbuy_order_key'] == '3'?'up':'down';?>"></em></a>
					<a  class="in-pt <?php echo $_GET['groupbuy_order_key'] == '2'?'in-pt-active':'';?>" <?php echo $_GET['groupbuy_order_key'] == '2'?"class='". ($_GET['groupbuy_order'] == 1 ? 'asc' : 'desc') ."'":'';?> href="<?php echo ($_GET['groupbuy_order_key'] == '2' && $_GET['groupbuy_order'] == '2' ? replaceParam(array('groupbuy_order_key' => '2', 'groupbuy_order' => '1')) : replaceParam(array('groupbuy_order_key' => '2', 'groupbuy_order' => '2')));?>">折扣<em class="<?php echo $_GET['groupbuy_order_key'] == '2'?'up':'down';?>"></em></a>
					<a  class="in-pt <?php echo $_GET['groupbuy_order_key'] == '1'?'in-pt-active':'';?>" <?php echo $_GET['groupbuy_order_key'] == '1'?"class='". ($_GET['groupbuy_order'] == 1 ? 'asc' : 'desc') ."'":'';?> href="<?php echo ($_GET['groupbuy_order_key'] == '1' && $_GET['groupbuy_order'] == '2' ? replaceParam(array('groupbuy_order_key' => '1', 'groupbuy_order' => '1')) : replaceParam(array('groupbuy_order_key' => '1', 'groupbuy_order' => '2')));?>">价格<em class="<?php echo $_GET['groupbuy_order_key'] == '1'?'up':'down';?>"></em></a>
				</div>
				
				<!--// TODO   抢购列表 今日上新-->
				<!--<div class="pt" style="border-right:none;">
					<a class="today-a" href="#">今日上新</a>
					<a class="choice-a" href="#">精选品牌</a>
				</div>-->
				<!--<div class="pt-right">
					<span class="num"><em>1</em>/12</span>
					<a class="prev" href="#"></a>
					<a class="next" href="#"></a>
				</div>-->
			</div>
			 <?php if (!empty($output['groupbuy_list']) && is_array($output['groupbuy_list'])) { ?>
			<ul class="buying-list">
				<?php foreach ($output['groupbuy_list'] as $groupbuy) { ?>
				<li>
					<img src="<?php echo uk86_gthumb($groupbuy['groupbuy_image'],'mid');?>" />
					<div class="bd">
						<p class="text"><a href="<?php echo $groupbuy['groupbuy_url'];?>"><?php echo $groupbuy['groupbuy_name'];?></a></p>
						<span class="price"><em class="em-01">￥</em><em class="em-02"><?php echo $groupbuy['groupbuy_price']; ?></em><del class="em-03"><?php echo $lang['currency'].$groupbuy['goods_price'];?></del></span>
					</div>
					<a class="now-buy" href="<?php echo $groupbuy['groupbuy_url'];?>"></a>
				</li>
				<?php } ?>
			
				<?php } else { ?>
   					<div class="no-content"><?php echo $lang['no_groupbuy_info'];?></div>
    		    <?php } ?>
			</ul>
			
			
			<div class="pagination-out">
				<div class="pagination"> 
					<?php echo $output['show_page']; ?>
				</div>
			</div>
			
			
			
			
			
			
			
			<?php if(!empty($output['brand_class'])){?>
			<ul class="nav-fixed">
				<?php foreach($output['brand_class'] as $key=>$bc){?>
				<li><a href="#"><?php echo $bc['brand_class']; ?></a></li>
				  <?php }?>
			</ul>
			 <?php }?>
		</div>
		
		
			
				
				
			
		
		
			
		
		
	</div>
	<!--<a class="return-top" href="#"></a>-->
	

