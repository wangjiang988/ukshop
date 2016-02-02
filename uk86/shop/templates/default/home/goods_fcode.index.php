<?php defined('InUk86') or exit('Access Invalid!');?>
<script src="<?php echo SHOP_RESOURCE_SITE_URL.'/js/search_goods.js';?>"></script>
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/layout.css" rel="stylesheet" type="text/css">
<style type="text/css">
body {
_behavior: url(<?php echo SHOP_TEMPLATES_URL;
?>/css/csshover.htc);
}
.fcode_goods{width:536px; height:530px; border:2px solid #EEE; float:left; margin:0 20px 40px 20px; }
.goods_list_fcode{ width:1160px; margin:0 auto; }
.goods_img{ width:496px; height:360px; margin:20px auto;}
.goods_big_img{ width:360px; height:360px; float:left; border:1px solid #FFF; border-right:1px solid #EEE;}
.goods_big_img img{ display:block; width:360px; height:360px;}
.goods_min_img {float:left; width:108px; height:108px; margin:0 0 16px 22px; border:1px solid #DDD; cursor:pointer;}
.goods_min_img img{width:108px; height:108px;}
.min_img_0{border-color:#D93600}
.goods_name{height:65px; width:100%; background:#F5F5F5; line-height:65px; font-size:16px; overflow:hidden;}
.goods_name .goods_name_p{width:496px; margin:0 auto;}
.line_height{line-height:32px;}
.goods_foot{height:65px; width:100%; line-height:65px; font-size:16px; overflow:hidden;}
.goods_price{width:111px; line-height:65px; float:left; margin-left:18px; color:#CD1106; font-size:26px; font-weight:600;}
.goods_marketprice{font-size:20px; color:#AAA; text-decoration:line-through; font-weight:100; width:94px; overflow:hidden; text-voerflow:ellipsis; float:left;}
.goods_kongge{ width:15px; height:65px; float:left;}
.start-x2{float:left;}
.buy_now{display:block; color:#FAD2CA; font-weight:600; background:#D93600; width:118px; height:32px; float:left; line-height:32px; border-radius:7px; text-align:center; font-size:14px; margin-top:18px; margin-left:5px;}

.buy_now:hover{color:#fff; text-decoration:none;}
</style>
<div class="nch-container wrapper" style="line-height:40px;" >
  <i class="icon-home"></i>
  <span><a href="<?php echo SHOP_SITE_URL ?>">首页</a></span>
  <span class="arrow">></span>
  <span>F码</span>
</div>
<div class="goods_list_fcode">
	<?php if(!empty($output['goods_list']) && is_array($output['goods_list'])){ ?>
	  <?php foreach ($output['goods_list'] as $k => $v){$i = 0; ?>
	  	<div class="fcode_goods">
	  	  <div class="goods_img">
	  	    <?php if(!empty($v['image']) && is_array($v['image'])){ ?>
	  	      <div class="goods_big_img">
	  	        <a href="<?php echo uk86_urlShop('goods', 'index', array('goods_id' => $v['goods_id'])); ?>"><img src="<?php echo uk86_thumb($v['image']['0'], 360); ?>" /></a>
	  	      </div>
	  	      <?php foreach ($v['image'] as $key=>$val){$i++; ?>
	  	      	<div class="goods_min_img min_img_<?php echo $key; ?>">
	  	      	  <img alt="<?php echo uk86_thumb($v['image'][$key], 360); ?>" src="<?php echo uk86_thumb($v['image'][$key], 240); ?>"/>
	  	        </div>
	  	        <?php if($i > 2){ break;} ?>
	  	      <?php } ?>
	  	    <?php }else{ ?>
	  	      <div class="goods_big_img">
	  	  	    <a href="<?php echo uk86_urlShop('goods', 'index', array('goods_id' => $v['goods_id'])); ?>"><img src="<?php echo uk86_thumb($v, 360); ?> "/></a>
	  	  	  </div>
	  	  	  <div class="goods_min_img" style="border-color:#D93600;">
	  	        <img src="<?php echo uk86_thumb($v, 240); ?>" />
	  	      </div>
	  	  	<?php } ?>
	  	  </div>
	  	  <div class="goods_name">
	  	  	<div class="goods_name_p <?php if(strlen($v['goods_name']) + strlen($v['goods_jingle']) > 90){ echo line_height; } ?>"><a href="<?php echo uk86_urlShop('goods', 'index', array('goods_id' => $v['goods_id'])); ?>"><?php echo $v['goods_name'] ?><span style="color:#D93600;"><?php echo $v['goods_jingle'] ?></span></a></div>
	  	  </div>
	  	  <div class="goods_foot">
	  	  	<div class="goods_price">￥<?php echo $v['goods_promotion_price'] ?></div>
	  	  	<div class="goods_kongge"></div>
	  	  	<div class="goods_marketprice">￥<?php echo $v['goods_marketprice'] ?></div>
	  	  	<div class="goods_kongge"></div>
	  	    <?php for($j = 0; $j < 5; $j++){ ?>
	  	      <?php if($j < intval($v['evaluation_good_star'])){ ?>
	  	        <div class="start-x2"><img title="<?php echo $v['good_star_name']; ?>" src="<?php echo RESOURCE_SITE_URL.DS.'js/jquery.raty/img/star-on-x2.png'; ?>"/></div>
	  	      <?php }else{ ?>
	  	      	<div class="start-x2"><img title="<?php echo $v['good_star_name']; ?>" src="<?php echo RESOURCE_SITE_URL.DS.'js/jquery.raty/img/star-off-x2.png'; ?>"/></div>
	  	      <?php } ?>
	  	    <?php } ?>
	  	    <div class="goods_kongge"></div>
	  	    <a class="buy_now" nctype="buy_now" data-param="{goods_id:<?php echo $v['goods_id'];?>}" href="javascript:void(0);"><i class="icon-shopping-cart"></i>&nbsp;&nbsp;F码购买</a>
	  	  </div>
		</div>
	  <?php } ?>
	<?php }else{ ?>
		<div style="color:#999; text-align:center; font-size:24px; line-height:300px;">暂无F码商品</div>
	<?php } ?>
</div>
<form id="buynow_form" method="post" action="<?php echo SHOP_SITE_URL;?>/index.php" target="_blank">
  <input id="act" name="act" type="hidden" value="buy" />
  <input id="op" name="op" type="hidden" value="buy_step1" />
  <input id="goods_id" name="cart_id[]" type="hidden"/>
</form>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/waypoints.js"></script>
<script src="<?php echo SHOP_RESOURCE_SITE_URL;?>/js/search_category_menu.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.goods_min_img').hover(function(){
		var image_path = $(this).children('img').attr('alt');
		$(this).siblings('.goods_big_img').children('a').children('img').attr('src', image_path);
		$(this).addClass('min_img_0');
		$(this).siblings('.goods_min_img').removeClass('min_img_0');
	});
});
</script>