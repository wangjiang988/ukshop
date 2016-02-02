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
<title>优康_详情</title>
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/base.css" type="text/css" media="all">
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/main.css" type="text/css" media="all">
<style type="text/css">
input[type=radio]{width:0.25rem; height:0.25rem;}
.goods_price_old{float:right; color:#999; font-size:0.22rem;}
</style>
</head>
<body>
	<!--顶部-->
	<header id="header">
		<div class="header_con">
			<div class="headerleft">
				<i onClick="javascript:history.back(-1);" class="icon-arrow-left"></i>
			</div>
			<div class="top-tit-div">
				商品详情
			</div>
			<div class="headerRight-b">
				<i class="icon-arrow-right-b"></i>
			</div>
			<div class="headerRight">
				<i class="icon-rxin-b"></i>
			</div>
		</div>
	</header>
	<!--顶部结束-->
	<div id="content" class="p_bottom_b">
		<!--顶部大图-->
		<div class="details_top_pic carousel-image carousel-image1" id="goods_info_images">
		  <div>
		  <?php foreach ($output['goods_image'] as $img_v){ ?>
			<a href="javascript:void(0);"><img style="float:left" src="<?php echo $img_v; ?>" /></a>
	      <?php } ?>
	      </div>
	      <span class="carousel-num"></span>
		</div>
		<!--大图结束-->

		<!--产品内容-->
		<div class="details_top_box">
			<ul>
				<li>
					<h2><?php echo $output['goods']['goods_name']; ?></h2>
					<dl>
						<dt><label><em style="color:#F26261;">￥</em><?php if(!empty($output['goods']['promotion_price']) && isset($output['goods']['promotion_price'])){
									echo $output['goods']['promotion_price'].'<h1 class="goods_price_old">（原售价：￥'.$output['goods']['goods_price'].'）</h1>'; }
								else {echo $output['goods']['goods_price'];} ?></label> <span>
								<?php $goods_freight =intval($output['goods']['goods_freight']); echo empty($goods_freight)?'包邮':'运费：'
									.$output['goods']['goods_freight'] ?>
							</span>
						</dt>
					</dl>
            		<dl>
						<dd><label>￥<?php echo $output['goods']['goods_marketprice'] ?></label>  <span><?php echo $output['goods']['goods_salenum'] ?>人付款</span></dd>		
					</dl> 
            	</li>            
            </ul>
        	<p>好评<?php echo intval($output['goods_evaluate_info']['all'])*(intval($output['goods_evaluate_info']['good_percent'])/100); ?>&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $output['goods']['goods_jingle'] ?></p>
		</div>

	<!--结束-->
    <!--内容列表-->
    <div class="details_main_list">
    <?php if($output['goods']['promotion_type'] != ''){ ?> 
    <ul class="clearfixd">
    <li>
      <label>促销</label>
      <div>
        <?php if ($output['goods']['promotion_type'] == 'xianshi'){ ?>
          <span class="select_hide">限时折扣</span><br />
      </div>
      <div class="select_show hidden">
        <span>限时折扣</span>
        <p><?php echo '直降：￥'.$output['goods']['down_price'];?>
           <?php if($output['goods']['lower_limit']) {?>
             <?php echo sprintf('&nbsp;&nbsp;最低%s件起',$output['goods']['lower_limit']);?>
           <?php } ?>
           <?php echo '&nbsp;&nbsp;'.$output['goods']['explain'];?>
        </p>
      </div>
        <?php } ?>
        <?php if ($output['goods']['promotion_type'] == 'groupbuy'){?>
          <span class="select_hide">抢购</span>
      </div>
      <div class="select_show hidden">
        <span>抢购</span>
        <p><?php if ($output['goods']['upper_limit']) {?>
           <?php echo sprintf('最多限购%s件',$output['goods']['upper_limit']);?>
        <?php } ?>
          <em class="time_set"></em>
        </p>
      </div>
        <?php } ?>
      <i class="icon-d-right"></i>
    </li>
    </ul>
    <?php } ?>
    <?php if ($output['goods']['have_gift'] == 'gift' && !empty($output['gift_array'])){ ?>
     <ul class="clearfixd">
       <li>
         <label>赠品</label>
         <div><h2>赠下方热卖商品，赠完为止</h2></div>
         <div class="select_show hidden">
         <?php foreach ($output['gift_array'] as $val){ ?>
           <dl style="display:inline-block; width:6rem;">
             <dt>
             	<img style="border:0.02rem solid #ccc; margin-bottom:0.1rem; float:left; width:0.6rem; height:0.6rem;" src="<?php echo uk86_cthumb($val['gift_goodsimage'], '60', $output['goods']['store_id']);?>">
             	<em style="float:left; margin-left:0.3rem;"><a style="color:#0080c2; font-size:0.25rem; line-height:0.6rem;" href="<?php echo uk86_urlShop('wap_goods_info', 'index', array('goods_id' => $val['gift_goodsid']));?>"><?php echo $val['gift_goodsname'] ?></a><font style="color:#fcb44e; margin-left:0.3rem; font-size:0.2rem;">X<?php echo $val['gift_amount'];?></font></em>
             </dt>
           </dl>
           <?php } ?>
         </div>
         <i class="icon-d-right"></i>
       </li>
     </ul>
    <?php } ?>
    <?php if(!empty($output['goods']['spec_name'])){ ?>
     <ul class="clearfixd">
	    <li>
	      <label>规格</label>
	      <div>
	        <h2><?php echo implode('，', $output['goods']['goods_spec']); ?></h2>
	      </div>
	      <div class="select_show hidden" id="goods_spec">
	        <?php foreach ($output['goods']['spec_name'] as $k => $v){ ?>
	          <dl class="goods_spec_1">
	            <dt><?php echo $v; ?>&nbsp;&nbsp;</dt>
	            <dd style="min-width:4rem;">
	            <?php if(!empty($output['goods']['spec_value'][$k]) && is_array($output['goods']['spec_value'][$k])){ ?>
	              <?php foreach ($output['goods']['spec_value'][$k] as $key => $val){ ?>
	                <?php if($k == 1){ ?>
		                <h3 class="sp-img spec_item"><a href="javascript:void(0);" class="<?php if (isset($output['goods']['goods_spec'][$key])) {echo 'is_selectd';}?>" data-param="{valid:<?php echo $key;?>}" title="<?php echo $val;?>"><img src="<?php echo $output['spec_image'][$key];?>"/>&nbsp;<?php echo $val;?>&nbsp;<i></i></a></h3>
	                <?php }else{ ?>
	                    <h3 class="sp-txt spec_item"><a href="javascript:void(0);" class="<?php if (isset($output['goods']['goods_spec'][$key])) { echo 'is_selectd';} ?>" data-param="{valid:<?php echo $key;?>}">&nbsp;<?php echo $val;?>&nbsp;<i></i></a></h3>
	                <?php } ?>
	              <?php } ?>
	            <?php } ?>
	            </dd>
	          </dl>
	        <?php } ?>
	        </div>
	      <i class="icon-d-right"></i>
	    </li>
    </ul> 
    <?php } ?>
    <ul class="clearfixd">
    	<li>
    	  <label>购买数量</label>
    	  <div class="chiose_num"><i>-</i><input type="text" class="buy_num" value="1"/><i>+</i></div>
    	  <div class="select_show hidden"><em class="goods_storage">库存 <?php echo $output['goods']['goods_storage'] ?> 件<em><?php if($output['goods']['virtual_limit'] > 0){echo '每人限购'.$output['goods']['virtual_limit'].'件';} ?></em></em></div>
    	  <i class="icon-d-right"></i>
    	</li>
    </ul>
    <?php if($output['goods']['is_virtual'] == 1 || $output['goods']['store_mentioning'] == 1){ ?>
    <ul class="clearfixd">
      <li>
        <label>提货方式</label>
        <div id="memtion">
        	<?php if($output['goods']['is_virtual'] == 1){ ?>
        	  <h3><a href="javascript:void(0);" nctype="1" class="is_selectd">&nbsp;&nbsp;虚拟兑换码&nbsp;&nbsp;<i></i></a></h3>
        	<?php }else{ ?>
        	  <h3><a href="javascript:void(0);" nctype="0">&nbsp;&nbsp;物流&nbsp;&nbsp;<i></i></a></h3>
        	  <h3><a href="javascript:void(0);" nctype="2" class="is_selectd">&nbsp;&nbsp;门店自提&nbsp;&nbsp;<i></i></a></h3>
        	<?php } ?>
        </div>
      </li>
    </ul>
    <?php } ?>
    <?php if($output['goods']['is_virtual'] == 1){ ?>
    <ul class="clearfixd">
      <li>
        <label>有效期：<em><?php if(intval($output['goods']['virtual_indate']) <= time()){echo '已过期';}else{ ?>即日起 至 <?php echo date('Y-m-d H:i:s', $output['goods']['virtual_indate']); ?><?php } ?></em></label>
      </li>
    </ul>
    <?php } ?>
    <?php if(!empty($output['goods']['mobile_body']) && stripos($output['goods']['mobile_body'], '{') === false){ ?>
      <ul class="clearfixd">
	    <li>
	      <label>详情</label>
	      <div class="select_show hidden" id="mobile_body">
	        <?php echo $output['goods']['mobile_body']; ?>
	      </div>
	      <i class="icon-d-right"></i>
	    </li>
      </ul>
    <?php }elseif(!empty($output['goods']['goods_body'])){ ?>
      <ul class="clearfixd">
	    <li>
	      <label>详情</label>
	      <div class="select_show hidden" id="mobile_body">
	        <?php echo $output['goods']['goods_body']; ?>
	      </div>
	      <i class="icon-d-right"></i>
	    </li>
      </ul>
    <?php } ?>
   
     <ul class="clearfixd">
	     <li>
	      <label>评价</label>
	      <em><?php echo $output['goods_evaluate_info']['all'];?>人评价</em>
	      <div class="select_show hidden" id="mobile_body">
	        <div id="content" class="p_bottom_b" style="background:#F5F5F5">
				<table class="sppj_title">
					<tr>
						<td class="select_color" nctype="all"><em>全部评价</em></td>
						<td nctype="1"><span title="好评" class="pointer_imga"></span></td>
						<td nctype="2"><span title="中评" class="pointer_imgb"></span></td>
						<td nctype="3"><span title="差评" class="pointer_imgc"></span></td>
					</tr>
					<tr>
						<td class="select_color" nctype="all"><em><?php echo $output['goods_evaluate_info']['all']; ?></em></td>
						<td nctype="1"><em><?php echo $output['goods_evaluate_info']['good']; ?></em></td>
						<td nctype="2"><em><?php echo $output['goods_evaluate_info']['normal']; ?></em></td>
						<td nctype="3"><em><?php echo $output['goods_evaluate_info']['bad']; ?></em></td>
					</tr>
				</table>
				<?php if(!empty($output['all_comments']) && is_array($output['all_comments'])){ ?>
				<?php foreach ($output['all_comments'] as $all_k => $all_v){ ?>
				<div class="sppj_list" nctype="all">
					<div class="sppj_list_title"><img class="sppj_tx_img" src="<?php echo uk86_getMemberAvatarForID($all_v['geval_frommemberid']); ?>"><span><?php echo $all_v['geval_frommembername']; ?></span><em><?php echo date('Y-m-d H:m:s', $all_v['geval_addtime']); ?></em></div>
					<div class="sppj_nr">
						<ul>
							<li><?php for($j = 0; $j < $all_v['geval_scores']; $j++){ echo '<img src="'.SHOP_TEMPLATES_URL.DS.'images/wap/sppj_xin.png" />'; } ?></li>
							<li><span><?php echo $all_v['geval_content'] ?></span></li>
							<li><em>购买日期：</em><em><?php echo date('Y-m-d H:m:s', uk86_getOrderTimeById($all_v['geval_orderid'])) ?></em></li>
						</ul>
					</div>
				</div>
				<?php } ?>
				<?php }else{ ?>
				<div class="sppj_list" nctype="all">
					<div class="geval_null">暂无符合条件的数据记录</div>
			    </div>
				<?php } ?>
				
				<?php if(!empty($output['good_comments']) && is_array($output['good_comments'])){ ?>
				<?php foreach ($output['good_comments'] as $good_k => $good_v){ ?>
				<div class="sppj_list hidden" nctype="good">
					<div class="sppj_list_title"><img class="sppj_tx_img" src="<?php echo uk86_getMemberAvatarForID($good_v['geval_frommemberid']); ?>"><span><?php echo $good_v['geval_frommembername']; ?></span><em><?php echo date('Y-m-d H:m:s', $good_v['geval_addtime']); ?></em></div>
					<div class="sppj_nr">
						<ul>
							<li><?php for($j = 0; $j < $good_v['geval_scores']; $j++){ echo '<img src="'.SHOP_TEMPLATES_URL.DS.'images/wap/sppj_xin.png" />'; } ?></li>
							<li><span><?php echo $good_v['geval_content'] ?></span></li>
							<li><em>购买日期：</em><em><?php echo date('Y-m-d H:m:s', uk86_getOrderTimeById($good_v['geval_orderid'])) ?></em></li>
						</ul>
					</div>
				</div>
				<?php } ?>
				<?php }else{ ?>
				<div class="sppj_list hidden" nctype="good">
					<div class="geval_null">暂无符合条件的数据记录</div>
			    </div>
				<?php } ?>
				
				<?php if(!empty($output['normal_comments']) && is_array($output['normal_comments'])){ ?>
				<?php foreach ($output['normal_comments'] as $normal_k => $normal_v){ ?>
				<div class="sppj_list hidden" nctype="normal">
					<div class="sppj_list_title"><img class="sppj_tx_img" src="<?php echo uk86_getMemberAvatarForID($normal_v['geval_frommemberid']); ?>"><span><?php echo $normal_v['geval_frommembername']; ?></span><em><?php echo date('Y-m-d H:m:s', $normal_v['geval_addtime']); ?></em></div>
					<div class="sppj_nr">
						<ul>
							<li><?php for($j = 0; $j < $normal_v['geval_scores']; $j++){ echo '<img src="'.SHOP_TEMPLATES_URL.DS.'images/wap/sppj_xin.png" />'; } ?></li>
							<li><span><?php echo $normal_v['geval_content'] ?></span></li>
							<li><em>购买日期：</em><em><?php echo date('Y-m-d H:m:s', uk86_getOrderTimeById($normal_v['geval_orderid'])) ?></em></li>
						</ul>
					</div>
				</div>
				<?php } ?>
				<?php }else{ ?>
				<div class="sppj_list hidden" nctype="normal">
					<div class="geval_null">暂无符合条件的数据记录</div>
			    </div>
				<?php } ?>
				
				<?php if(!empty($output['bad_comments']) && is_array($output['bad_comments'])){ ?>
				<?php foreach ($output['bad_comments'] as $bad_k => $bad_v){ ?>
				<div class="sppj_list hidden" nctype="bad">
					<div class="sppj_list_title"><img class="sppj_tx_img" src="<?php echo uk86_getMemberAvatarForID($bad_v['geval_frommemberid']); ?>"><span><?php echo $bad_v['geval_frommembername']; ?></span><em><?php echo date('Y-m-d H:m:s', $bad_v['geval_addtime']); ?></em></div>
					<div class="sppj_nr">
						<ul>
							<li><?php for($j = 0; $j < $bad_v['geval_scores']; $j++){ echo '<img src="'.SHOP_TEMPLATES_URL.DS.'images/wap/sppj_xin.png" />'; } ?></li>
							<li><span><?php echo $bad_v['geval_content'] ?></span></li>
							<li><em>购买日期：</em><em><?php echo date('Y-m-d H:m:s', uk86_getOrderTimeById($bad_v['geval_orderid'])) ?></em></li>
						</ul>
					</div>
				</div>
				<?php } ?>
				<?php }else{ ?>
				<div class="sppj_list hidden" nctype="bad">
					<div class="geval_null">暂无符合条件的数据记录</div>
			    </div>
				<?php } ?>
			</div>
	      </div>
	      <i class="icon-d-right"></i>
	    </li>
    </ul> 
    </div>
    
    <div class="details_main_list"> 
    <ul class="clearfixd">
	    <li>
			<a style="display: inline-block;width: 100%;" href="<?php echo SHOP_SITE_URL;?>/index.php?act=wap_store&op=store_info&store_id=<?php echo $output['goods']['store_id'] ?>">
	      <span class="icon-del-left"></span><label class="det_to_left"><?php echo $output['goods']['store_name'] ?></label> 
	    <!--  <div class="select_show hidden" id="hot_sales">
	        <?php /*if(!empty($output['hot_sales'])){ */?>
	        <div class="hot_sales_title clearfixed"><i></i>推荐商品</div>
	        <div class="home_mian_box hot_sales">
	          <?php /*$i = 0; */?>
			  <?php /*foreach ($output['hot_sales'] as $like_key => $like_val){$i++; */?>
			    <a onclick="gotourl('index.php?act=wap_goods_info&op=index&goods_id=<?php /*echo $like_val['goods_id'] */?>')" href="javascript:void(0);">
			    <ul class="clearfixd" style="display:block !important;">
			      <img title="<?php /*echo $like_val['goods_name']; */?>" src="<?php /*echo uk86_thumb($like_val); */?>"/>
			      <li>
			        <h2><?php /*echo $like_val['goods_name']; */?></h2>
			        <dl>
			          <dt>￥<?php /*echo $like_val['goods_promotion_price']; */?></dt>
			          <dd>￥<?php /*echo $like_val['goods_marketprice']; */?></dd>
			          <i class="<?php /*echo $like_val['is_fcode']?'icon-cx-fm':'' */?>"></i><i class="<?php /*if($like_val['goods_promotion_type'] == 1){echo 'icon-cx-xs';}elseif ($like_val['goods_promotion_type'] == 2){echo 'icon-cx-yy';} */?>"></i>
			        </dl>
			      </li>
			    </ul>
			    </a>
			  <?php /*if($i >= 4)break; } */?>
			</div>
			<?php /*} */?>
	      </div>-->
	      <i class="icon-d-right"></i></a>
	    </li>
    </ul>
      <ul>
    <li>
     <span class="icon-del-bot"></span><label class="det_to_leftb">咨询卖家</label>
    </li>
    </ul>
    </div>
    <!--内容结束-->
</div>
<!-- 商品分享dialog -->
  <div class="dialog_html" style="display: none;">
 	<form id="share_form" method="post" action="index.php">
   <div class="dialogBody" style="top:2.5rem;">
   <i class="close" onClick="dialog_hide();"></i>
   <div class="dialogHead"><i class="icon-confirm"></i><p>分享商品</p></div>
   <div class="dialogMsg" style="border-bottom: 0.02rem solid #ccc;">
     <table style="color:#454545; font-size:0.25rem; line-height:0.35rem;">
       <tr>
         <td align="right" valign="top">商品：</td><td class="order_sn"><?php echo $output['goods']['goods_name']; ?></td>
       </tr>
       <tr>
         <td align="right" valign="top" style="width:1.5rem;">可见范围：</td>
         <td>
           <input type="radio" id="all" value="0" checked="checked" name="share_privacy"/><label for="all">所有人可见</label><br/>
           <input type="radio" id="friend" value="1" name="share_privacy"/><label for="friend">仅好友可见</label><br/>
           <input type="radio" id="self" value="2" name="share_privacy"/><label for="self">仅自己可见</label>
         </td>
       </tr>
       <tr>
         <td align="right" valign="top">描述：</td>
         <td><textarea id="d5" name="share_content" style="height:1.2rem; width:3.8rem; resize: none; border-radius:0.1rem; border:0.02rem solid #999; padding:0.1rem; margin-bottom:0.2rem; margin-top:0.1rem;" maxlength="140" placeholder="我蛮喜欢这件商品的哦~"></textarea></td>
       </tr>
     </table>
   </div>
   <div class="closeTime"><a class="form_submit hovered" style="background:#5BB75B">&nbsp;&nbsp;分享&nbsp;&nbsp;</a>&nbsp;&nbsp;&nbsp;&nbsp;<a class="hovered" onClick="dialog_hide();">&nbsp;&nbsp;取消&nbsp;&nbsp;</a></div>
   </div>
   </form>
 </div>
<form id="buy_now_form" action="<?php echo SHOP_SITE_URL;?>/index.php?act=wap_buy&op=buy_step1" method="post">
  <input id="act" name="act" type="hidden" value="wap_buy" />
  <input id="op" name="op" type="hidden" value="buy_step1" />
  <input type="hidden" name="step1_url" value="<?php echo $_SERVER['REQUEST_URI']; ?>"/>
  <input id="cart_id" name="cart_id[]" type="hidden"/>
  <input id="store_men" type="hidden" name="store_mention" value="<?php if($output['goods']['is_virtual'] == 1){echo '1';}elseif($output['goods']['store_mentioning'] == 1){echo '2';}else{echo '0';} ?>" />
</form>
<!--底部-->
<div class="all_foot">
	<div class="details_foot">
		<a href="javascript:void(0);" class="hovered buy_now <?php if($output['goods']['goods_storage'] <= 0){echo 'not_click';} if(intval($output['goods']['virtual_indate']) <= time() && !empty($output['goods']['virtual_indate'])){echo 'not_click';} ?>"><?php echo $output['goods']['buynow_text'] ; ?></a>
		<?php if($output['goods']['is_fcode'] != 1 && $output['goods']['is_virtual'] != 1){ ?>
		<a class="hovered add_cart <?php if($output['goods']['goods_storage'] <= 0){echo 'not_click';} ?>">加入购物车</a>
	    <?php } ?>
		<div class="botRight">
		<i onClick="javascript:window.location.href='index.php?act=wap_cart';" class="icon-arrow-bot"><?php if(!empty($output['cart_goods_num'])){ ?><em><span><?php echo $output['cart_goods_num']; ?></span></em><?php } ?></i>
	   </div>
	</div>
</div>
<!--底部结束-->
	<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/zepto.js"></script>
	<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/carousel-image.js"></script>
	<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/common.js"></script>
<script type="text/javascript">
var is_login = <?php echo $_SESSION['is_login']?'1':'0'; ?>;
var goods_num = <?php echo $output['goods']['goods_storage'] ?>;
var goods_id = <?php echo $_GET['goods_id'] ?>;
var limit = <?php echo $output['goods']['virtual_limit']?$output['goods']['virtual_limit']:0; ?>;
$(document).ready(function(){
	if(<?php echo count($output['goods_image']); ?> >=2){
		var t = 3000;
	}else{
		var t = 999999999;
	}
	$('.carousel-image1').CarouselImage({
		timer: t,
		num: $('.carousel-image1 .carousel-num'),
		repeat: true
	});
	$('.all_foot:last').hide();
	$('.details_main_list ul li').on('click', function(){
		if($(this).find('.icon-d-right').hasClass('rotate')){
			$(this).find('.select_hide').removeClass('hidden');
			$(this).find('.select_show').addClass('hidden');
			$(this).find('.icon-d-right').removeClass('rotate');
		}else{
			$(this).find('.select_hide').addClass('hidden');
			$(this).find('.select_show').removeClass('hidden');
			$(this).find('.icon-d-right').addClass('rotate');
		}
	});
<?php if ($output['goods']['promotion_type'] == 'groupbuy'){?>
	var start_time = <?php echo $output['goods']['groupbuy_start_time']; ?>;
	var end_time = <?php echo $output['goods']['groupbuy_end_time']; ?>;
	var now_time = 0;
	
	var groupbuy_time = setInterval(function(){
		now_time = Date.parse(new Date())/1000 ;
		var d_time = 0;
		var h_time = 0;
		var m_time = 0;
		var s_time = 0;
		if(start_time > now_time){
			var x_time = now_time - start_time;
			d_time = x_time / (3600*24);
			h_time = (x_time % (3600*24)) / 3600;
			m_time = (x_time % 3600)/60;
			s_time = x_time % 60;
			var html = '&nbsp;&nbsp;距开始还有'+ parseInt(d_time) +'天'+ parseInt(h_time) +'小时'+ parseInt(m_time) +'分'+ s_time +'秒';
		} else if(end_time < now_time){
			var html = '&nbsp;&nbsp;抢购已结束';
			clearInterval(groupbuy_time);
		} else{
			var x_time = end_time - now_time;
			d_time = x_time / (3600*24);
			h_time = (x_time % (3600*24)) / 3600;
			m_time = (x_time % 3600)/60;
			s_time = x_time % 60;
			var html = '&nbsp;&nbsp;剩余时间 : '+ parseInt(d_time) +'天'+ parseInt(h_time) +'小时'+ parseInt(m_time) +'分'+ s_time +'秒';
		}
		$('.select_show em.time_set').html(html);
	},1000);
<?php } ?>
	$('.is_selectd').parent('h3').css('border-color', '#d93600');

	// 规格选择
    $('.goods_spec_1').find('a').each(function(){
        $(this).click(function(){
        	if ($(this).hasClass('is_selectd')) {
                return false;
            }
        	$(this).parent().siblings().css('border-color', '#999');
        	$(this).parent().css('border-color', '#d93600');
            $(this).parent().siblings().find('a').removeClass('is_selectd');
            $(this).addClass('is_selectd');
            checkSpec();
            return false;
        });
    });
    //物流方式选择
    $('#memtion h3 a').click(function(){
        if($(this).hasClass('is_selectd')){return false;}
        $(this).parent().siblings().css('border-color', '#999');
    	$(this).parent().css('border-color', '#d93600');
    	$(this).parent().siblings().find('a').removeClass('is_selectd');
        $(this).addClass('is_selectd');
        var memtion_type = $(this).attr('nctype');
        $('#store_men').val(memtion_type);
        if(memtion_type != 0){
            $('.add_cart').show();
        }else{
            $('.add_cart').show();
        }
        return false;
    });
	//商品评价切换
    $('.sppj_title tr td').click(function(){
        if($(this).hasClass('select_color')){return false;}
        var eq_index = $(this).index();
        $(this).siblings().removeClass('select_color');
        $(this).parents('tr').siblings().children('td').removeClass('select_color');
        $(this).addClass('select_color');
        $(this).parents('tr').siblings().children('td').eq(eq_index).addClass('select_color');
        var type_this = $(this).attr('nctype');
        $('.sppj_list').addClass('hidden');
        switch(type_this){
        case 'all': 
            $('.sppj_list[nctype="all"]').removeClass('hidden');break;
        case '1': 
            $('.sppj_list[nctype="good"]').removeClass('hidden');break;
        case '2': 
            $('.sppj_list[nctype="normal"]').removeClass('hidden');break;
        case '3': 
            $('.sppj_list[nctype="bad"]').removeClass('hidden');break;
        }
        return false;
    });

    //商品数量
    $('.chiose_num i:first').click(function(){
        var num = $('.chiose_num .buy_num').val();
        if(goods_num <= num || num <= 1){return false;}
        $('.chiose_num .buy_num').val(--num);
        return false;
    });
    $('.chiose_num .buy_num').click(function(){return false});
    $('.chiose_num .buy_num').change(function(){
    	var num = $('.chiose_num .buy_num').val();
    	if(num > goods_num){
        	showError('库存不足', 2);
        	$('.chiose_num .buy_num').val(goods_num);
        }
        if(num <= 0){
            showError('购买数量不能小于1', 2);
            $('.chiose_num .buy_num').val('1');
        }
        if(limit > 0 && num > limit){
            showError('该商品最多限购'+limit+'件');
            $('.chiose_num .buy_num').val(limit);
        }
    });
    $('.chiose_num i:last').click(function(){
        var num = $('.chiose_num .buy_num').val();
        if(goods_num <= num){return false;}
        if(limit > 0 && num >= limit){return false;}
        $('.chiose_num .buy_num').val(++num);
        return false;
    });

    //立即购买
    $('.buy_now').click(function(){
    	if(is_login == '0'){window.location.href="index.php?act=wap_login&op=login"; return;}
    	if($(this).hasClass('not_click')){showError('商品库存不足，无法购买', 2); return;};
    	var num = $('.chiose_num .buy_num').val();
    	<?php if ($_SESSION['store_id'] == $output['goods']['store_id']) { ?>
        	showError('不能购买自己店铺的商品', 2);return;
        <?php } ?>
        //验证抢购购买数量
        checkQuantity(num);
        $("#cart_id").val(goods_id+'|'+num);
        $('#buy_now_form').submit();
    });

    //加入购物车
    $('.add_cart').click(function(){
    	var num = $('.chiose_num .buy_num').val();
    	if(is_login == '0'){window.location.href="index.php?act=wap_login&op=login"; return;}
    	$.get('index.php?act=cart&op=add', {goods_id:<?php echo $_GET['goods_id'] ?>, quantity:num}, function(data){
    		var Json_data = eval('('+ data +')');
    		if(Json_data.msg != undefined && Json_data.msg != ''){
    			showError(Json_data.msg, 2);
    		}else if(Json_data.state){
    			showDialog('加入购物车成功', 1);
    			$('.icon-arrow-bot').html('<em><span>'+Json_data.num+'</span></em>');
    		}else if(!Json_data.state){
    			shwoError('加入购物车失败', 2);
    		}
    	});
    	return false;
    });

    //自提商品影藏购物车按钮
    <?php if($output['goods']['store_mentioning'] == 1){ ?>
	$('.add_cart').show();
    <?php } ?>

    //收藏商品
    $('.icon-rxin-b').click(function(){
    	if(<?php echo $_SESSION['is_login']?0:1; ?>){
			window.location.href="index.php?act=wap_login&op=login";
		}
        $.post('index.php?act=wap_goods_info&op=fav_goods', {goods_id:<?php echo $_GET['goods_id']; ?>}, function(msg){
            if(msg > 0){
				showDialog('收藏成功');
            }else{
                showDialog('您已收藏过此商品');
            }
        });
    });
    //分享商品
    $('.dialog_html').hide();
    $('.icon-arrow-right-b').click(function(){
		if(<?php echo $_SESSION['is_login']?0:1; ?>){
			window.location.href="index.php?act=wap_login&op=login";
		}else{
			$('.dialog_html').show();
		}
	});
    $('.form_submit').click(function(){
		var share_content = $('#d5').val();
		if(share_content == ''){
			$('#d5').addClass('border-color-red').focus();
			return false;
		}
		var share_privacy = $('.dialog_html input[checked="checked"]').val();
		var share_content = $('#d5').val();
		$.ajax({
			type : 'post',
			 url : 'index.php?act=wap_goods_info&op=share_goods',
			data : {goods_id:<?php echo $_GET['goods_id']; ?>, share_privacy:share_privacy, share_content:share_content},
		 success : function(msg){
			 	dialog_hide();
				if(msg > 0){
					if(msg == 11){
						showDialog('分享成功');
					}else if(msg == 10){
						showDialog('您已分享过此商品');
					}
				}else{
					showError('分享失败');
				}
		    }
			 
		});
    });
});

//抢购验证购买数量
function checkQuantity(num){
    <?php if ($output['goods']['is_virtual'] == 1 && $output['goods']['virtual_limit'] > 0) {?>
    max = <?php echo $output['goods']['virtual_limit'];?>;
    if(num > max){
        showError('最多限购'+max+'件', 2);
        return false;
    }
    <?php } ?>
    <?php if (!empty($output['goods']['upper_limit'])) {?>
    max = <?php echo $output['goods']['upper_limit'];?>;
    if(num > max){
    	showError('最多限购'+max+'件', 2);
        return false;
    }
    <?php } ?>
    return num;
}

function checkSpec() {
    var spec_param = <?php echo $output['spec_list'];?>;
    var spec = new Array();
    $('.goods_spec_1').find('.is_selectd').each(function(){
        var data_str = ''; eval('data_str =' + $(this).attr('data-param'));
        spec.push(data_str.valid);
    });
    spec1 = spec.sort(function(a,b){
        return a-b;
    });
    var spec_sign = spec1.join('|');
    $.each(spec_param, function(i, n){
        if (n.sign == spec_sign) {
            var url_arr = n.url.split('&');
            window.location.href = '<?php echo SHOP_SITE_URL.DS; ?>index.php?act=wap_goods_info&op=index&'+url_arr[2];
        }
    });
}
function gotourl(url){
	window.location.href = url;
}

function dialog_hide(){
	$('.dialog_html').hide();
	$('#d5').removeClass('border-color-red');
}
</script>
</body>



