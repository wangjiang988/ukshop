<?php defined('InUk86') or exit('Access Invalid!');?>
<script src="<?php echo SHOP_RESOURCE_SITE_URL.'/js/search_goods.js';?>"></script>
<!--<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/layout.css" rel="stylesheet" type="text/css">
<style type="text/css">
body {
_behavior: url(<?php echo SHOP_TEMPLATES_URL;
?>/css/csshover.htc);
}
</style>-->
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/pointprod/layout.css" rel="stylesheet" type="text/css">
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/pointprod/point.css" rel="stylesheet" type="text/css">
	
	<div class="container">
		<div class="nch-container">
			<div class="left">
				<?php if(!isset($output['goods_class_array']['child']) && empty($output['goods_class_array']['child']) && !empty($output['goods_class_array'])){?>
					<?php $dl=1;  //dl标记?>
					<?php if((!empty($output['brand_array']) && is_array($output['brand_array'])) || (!empty($output['attr_array']) && is_array($output['attr_array']))){?>
						<div class="nch-module nch-module-style01">
							<div class="title">
								<h3>
									<?php if (!empty($output['show_keyword'])) {?>
										<em><?php echo $output['show_keyword'];?></em> -
									<?php }?>
									商品筛选</h3>
							</div>
							<div class="content">
								<div class="nch-module-filter">
									<?php if((isset($output['checked_brand']) && is_array($output['checked_brand'])) || (isset($output['checked_attr']) && is_array($output['checked_attr']))){?>
										<dl nc_type="ul_filter">
											<dt><?php echo $lang['goods_class_index_selected'].$lang['nc_colon'];?></dt>
											<dd class="list">
												<?php if(isset($output['checked_brand']) && is_array($output['checked_brand'])){?>
													<?php foreach ($output['checked_brand'] as $key=>$val){?>
														<span class="selected" nctype="span_filter"><?php echo $lang['goods_class_index_brand'];?>:<em><?php echo $val['brand_name']?></em><i data-uri="<?php echo removeParam(array('b_id' => $key));?>">X</i></span>
													<?php }?>
												<?php }?>
												<?php if(isset($output['checked_attr']) && is_array($output['checked_attr'])){?>
													<?php foreach ($output['checked_attr'] as $val){?>
														<span class="selected" nctype="span_filter"><?php echo $val['attr_name'].':<em>'.$val['attr_value_name'].'</em>'?><i data-uri="<?php echo removeParam(array('a_id' => $val['attr_value_id']));?>">X</i></span>
													<?php }?>
												<?php }?>
											</dd>
										</dl>
									<?php }?>
									<?php if (!isset($output['checked_brand']) || empty($output['checked_brand'])){?>
										<?php if(!empty($output['brand_array']) && is_array($output['brand_array'])){?>
											<dl <?php if($dl>3){?>class="dl_hide"<?php }?>>
												<dt><?php echo $lang['goods_class_index_brand'].$lang['nc_colon'];?></dt>
												<dd class="list">
													<ul>
														<?php $i = 0;foreach ($output['brand_array'] as $k=>$v){$i++;?>
															<li <?php if ($i>10){?>style="display:none" nc_type="none"<?php }?>><a href="<?php $b_id = (($_GET['b_id'] != '' && intval($_GET['b_id']) != 0)?$_GET['b_id'].'_'.$k:$k); echo replaceParam(array('b_id' => $b_id));?>"><?php echo $v['brand_name'];?></a></li>
														<?php }?>
													</ul>
												</dd>
												<?php if (count($output['brand_array']) > 10){?>
													<dd class="all"><span nc_type="show"><i class="icon-angle-down"></i><?php echo $lang['goods_class_index_more'];?></span></dd>
												<?php }?>
											</dl>
											<?php $dl++;}?>
									<?php }?>
									<?php if(!empty($output['attr_array']) && is_array($output['attr_array'])){?>
										<?php $j = 0;foreach ($output['attr_array'] as $key=>$val){$j++;?>
											<?php if(!isset($output['checked_attr'][$key]) && !empty($val['value']) && is_array($val['value'])){?>
												<dl>
													<dt><?php echo $val['name'].$lang['nc_colon'];?></dt>
													<dd class="list">
														<ul>
															<?php $i = 0;foreach ($val['value'] as $k=>$v){$i++;?>
																<li <?php if ($i>10){?>style="display:none" nc_type="none"<?php }?>><a href="<?php $a_id = (($_GET['a_id'] != '' && $_GET['a_id'] != 0)?$_GET['a_id'].'_'.$k:$k); echo replaceParam(array('a_id' => $a_id));?>"><?php echo $v['attr_value_name'];?></a></li>
															<?php }?>
														</ul>
													</dd>
													<?php if (count($val['value']) > 10){?>
														<dd class="all"><span nc_type="show"><i class="icon-angle-down"></i><?php echo $lang['goods_class_index_more'];?></span></dd>
													<?php }?>
												</dl>
											<?php }?>
											<?php $dl++;} ?>
									<?php }?>
								</div>
							</div>
						</div>
					<?php }?>
				<?php }?>
				<div class="select-box">
					<div class="pt">
						<a  class="in-pt <?php if(!$_GET['key']) echo 'in-pt-active'; ?>"   href="<?php echo dropParam(array('order', 'key'));?>">综合</a>
						<a  class="in-pt <?php if($_GET['key'] == '1') echo 'in-pt-active'; ?>" href="<?php echo ($_GET['order'] == '2' && $_GET['key'] == '1') ? replaceParam(array('key' => '1', 'order' => '1')):replaceParam(array('key' => '1', 'order' => '2')); ?>">销量<em class="<?php echo $_GET['key'] == 1 ? 'up' : 'down';?>"></em></a>
						<a  class="in-pt <?php if($_GET['key'] == '2') echo 'in-pt-active'; ?>" href="<?php echo ($_GET['order'] == '2' && $_GET['key'] == '2') ? replaceParam(array('key' => '2', 'order' => '1')):replaceParam(array('key' => '2', 'order' => '2')); ?>">人气<em class="<?php echo $_GET['key'] == 2 ? 'up' : 'down';?>"></em></a>
						<a  class="in-pt <?php if($_GET['key'] == '3') echo 'in-pt-active'; ?>" href="<?php echo ($_GET['order'] == '2' && $_GET['key'] == '3') ? replaceParam(array('key' => '3', 'order' => '1')):replaceParam(array('key' => '3', 'order' => '2')); ?>">价格<em class="<?php echo $_GET['key'] == 3 ? 'up' : 'down';?>"></em></a>
					</div>
					<div class="pt" style="padding-right:15px; ">
						<!--<div class="nch-sortbar-owner"><span><a href="<?php if ($_GET['type'] == 1) { echo dropParam(array('type'));} else { echo replaceParam(array('type' => '1'));}?>" <?php if ($_GET['type'] == 1) {?>class="selected"<?php }?>><i></i>平台自营</a></span></div>
						<div class="nch-sortbar-owner"><span><a href="<?php if ($_GET['gift'] == 1) { echo dropParam(array('gift'));} else { echo replaceParam(array('gift' => '1'));}?>" <?php if ($_GET['gift'] == 1) {?>class="selected"<?php }?>><i></i>赠品</a></span></div>-->
						<!--<input class="checkbox-01" name="" type="checkbox" value="" />
						<label class="lable-01">今日上新</label>-->
						<!--<input class="checkbox-01" name="" type="checkbox" value="" />
						<label class="lable-01">抢购</label>
						<input class="checkbox-01" name="" type="checkbox" value="" />
						<label class="lable-01">拼团</label>-->
					</div>
					<dl>
					<dt>商品所在地：</dt>
					<dd>
						<div class="select-layer">
				            <div class="holder"><em nc_type="area_name"><?php echo $lang['goods_class_index_area']; ?><!-- 所在地 --></em></div>
				            <div class="selected"><a nc_type="area_name"><?php echo $lang['goods_class_index_area']; ?><!-- 所在地 --></a></div>
				            <i class="direction"></i>
				            <ul class="options">
				              <?php require(BASE_TPL_PATH.'/home/goods_class_area.php');?>
				            </ul>
				         </div>
						<!--<select name="" class="select-01"><option>不限地区</option></select>-->
					</dd>
				</dl>
					<!--<div class="pt-right">
						<span class="num"><em>1</em>/12</span>
						<a class="prev" href="#"></a>
						<a class="next" href="#"></a>
						<?php //echo $output['show_page1']; ?>
					</div>-->
				</div>
				<div class="squares">
					<?php if(!empty($output['goods_list']) && is_array($output['goods_list'])){?>
						<ul class="list_pic">
						 <?php foreach($output['goods_list'] as $value){?>
						 <li class="item">
						  <div nctype_store="1" nctype_goods=" 285" class="goods-content">
							<div class="goods-pic"><a title="<?php echo $value['goods_name'];?>" target="_blank" href="<?php echo uk86_urlShop('goods','index',array('goods_id'=>$value['goods_id']));?>"><img alt="<?php echo $value['goods_name'];?>" title="<?php echo $value['goods_name'];?>" src="<?php echo uk86_thumb($value, 240);?>"></a></div>
							<div class="goods-info" style="top: 230px;">
							  <div class="goods-pic-scroll-show">
								<a href="<?php echo uk86_urlShop('goods','index',array('goods_id'=>$value['goods_id']));?>"><?php echo $value['goods_name'];?></a>
							  </div>
			  
							  <div class="goods-price"> 
							  	<em class="sale-price" title="<?php echo $lang['goods_class_index_store_goods_price'].$lang['nc_colon'].$lang['currency'].$value['goods_promotion_price'];?>"><?php echo uk86_ncPriceFormatForList($value['goods_price']);?>	</em> 
				          	    <em class="market-price" title="市场价：<?php echo $lang['currency'].$value['goods_marketprice'];?>"><?php echo uk86_ncPriceFormatForList($value['goods_marketprice']);?></em> 
				          	     </div>
							  <div class="goods-sub">
							  	<span class="raty" data-score="<?php echo $value['evaluation_good_star'];?>"></span>
								<span class="goods-compare" nc_type="compare_<?php echo $value['goods_id'];?>" data-param='{"gid":"<?php echo $value['goods_id'];?>"}'><i></i>加入对比</span>
								<!--<span data-param="{&quot;gid&quot;:&quot;285&quot;}" nc_type="compare_285" class="goods-compare"><i></i>加入对比</span>-->
								</div>
							  <div class="sell-stat">
					            <ul>
					              <li><a href="<?php echo uk86_urlShop('goods', 'index', array('goods_id' => $value['goods_id']));?>#ncGoodsRate" target="_blank" class="status"><?php echo $value['goods_salenum'];?></a>
					                <p>商品销量</p>
					              </li>
					              <li><a href="<?php echo uk86_urlShop('goods', 'comments_list', array('goods_id' => $value['goods_id']));?>" target="_blank"><?php echo $value['evaluation_count'];?></a>
					                <p>用户评论</p>
					              </li>
					              <li><em member_id="<?php echo $value['member_id'];?>">&nbsp;</em></li>
					            </ul>
					          </div>
					          <div class="store"><a href="<?php echo uk86_urlShop('show_store','index',array('store_id'=>$value['store_id']), $value['store_domain']);?>" title="<?php echo $value['store_name'];?>" class="name"><?php echo $value['store_name'];?></a></div>
							  <div class="add-cart">
					            <?php if ($value['goods_storage'] == 0) {?>
					            <?php if ($value['is_appoint'] == 1) {?>
					            <a href="javascript:void(0);" onclick="<?php if ($_SESSION['is_login'] !== '1'){?>login_dialog();<?php }else{?>ajax_form('arrival_notice', '立即预约', '<?php echo uk86_urlShop('goods', 'arrival_notice', array('goods_id' => $value['goods_id'], 'type' => 2));?>', 350);<?php }?>"><i class="icon-bullhorn"></i>立即预约</a>
					            <?php } else {?>
					            <a href="javascript:void(0);" onclick="<?php if ($_SESSION['is_login'] !== '1'){?>login_dialog();<?php }else{?>ajax_form('arrival_notice', '到货通知', '<?php echo uk86_urlShop('goods', 'arrival_notice', array('goods_id' => $value['goods_id'], 'type' => 2));?>', 350);<?php }?>"><i class="icon-bullhorn"></i>到货通知</a>
					            <?php }?>
					            <?php } else {?>
					            <?php if ($value['is_virtual'] == 1 || $value['is_fcode'] == 1 || $value['is_presell'] == 1) {?>
					            <a href="javascript:void(0);" nctype="buy_now" data-param="{goods_id:<?php echo $value['goods_id'];?>}"><i class="icon-shopping-cart"></i>
					            <?php if ($value['is_fcode'] == 1) {?>
					            F码购买
					            <?php } else if ($value['is_presell'] == 1) {echo '预售购买';} else {?>
					            立即购买
					            <?php }?>
					            </a>
					            <?php } else {?>
					            <a href="javascript:void(0);" nctype="add_cart" data-param="{goods_id:<?php echo $value['goods_id'];?>}"><i class="icon-shopping-cart"></i>加入购物车</a>
					            <?php }?>
					            <?php }?>
					          </div>
							</div>
		 				 </div>
						</li>
						<?php }?>
		              <li class="selected"><a href="javascript:void(0);"><img src="<?php echo uk86_thumb($value, 60);?>" /></a></li>
		           	 <div class="clear"></div>
						
					</ul>
					<?php }else{?>
					  	<div id="no_results" class="no-results"><i></i><?php echo $lang['index_no_record'];?></div>
					<?php }?>
						
				</div>
				<?php if(!empty($output['goods_list']) && is_array($output['goods_list'])){?>
				<div class="pagination-out">
				<div class="pagination"> 
					<?php echo $output['show_page']; ?>
				</div>
				<?php }?>
			</div>
			</div>
			<div class="right">
				<!--
                	作者：wangjiang988@163.com
                	时间：2016-02-01
                	描述：广告位
                -->
				<!--<div class="ad">
					<a href="#"><img src="<?php echo uk86_thumb($value, 60);?>" /></a>
				</div>-->
				<!-- S 推荐展位 -->
				<div nctype="booth_goods" class="nch-module" > </div>
				<!-- E 推荐展位 -->
				<!--<div class="nch-module"><?php echo uk86_loadadv(37,'html');?></div>-->
			</div>
			
			
			<div class="like-box">
				<!-- 猜你喜欢 -->
			<div id="guesslike_div" style="width:100%;"></div>
			</div>	
		</div>	
	</div>


<script src="<?php echo RESOURCE_SITE_URL;?>/js/waypoints.js"></script>
<script src="<?php echo SHOP_RESOURCE_SITE_URL;?>/js/search_category_menu.js"></script>
<script type="text/javascript">
var defaultSmallGoodsImage = '<?php echo uk86_defaultGoodsImage(240);?>';
var defaultTinyGoodsImage = '<?php echo uk86_defaultGoodsImage(60);?>';

$(function(){
    $('#files').tree({
        expanded: 'li:lt(2)'
    });

    //浮动导航  waypoints.js
    $('#main-nav-holder').waypoint(function(event, direction) {
        $(this).parent().toggleClass('sticky', direction === "down");
        event.stopPropagation();
    });
	// 单行显示更多
	$('span[nc_type="show"]').click(function(){
		s = $(this).parents('dd').prev().find('li[nc_type="none"]');
		if(s.css('display') == 'none'){
			s.show();
			$(this).html('<i class="icon-angle-up"></i><?php echo $lang['goods_class_index_retract'];?>');
		}else{
			s.hide();
			$(this).html('<i class="icon-angle-down"></i><?php echo $lang['goods_class_index_more'];?>');
		}
	});

	<?php if(isset($_GET['area_id']) && intval($_GET['area_id']) > 0){?>
  // 选择地区后的地区显示
  $('[nc_type="area_name"]').html('<?php echo $output['province_array'][intval($_GET['area_id'])]; ?>');
	<?php }?>

	<?php if(isset($_GET['cate_id']) && intval($_GET['cate_id']) > 0){?>
	// 推荐商品异步显示
    $('div[nctype="booth_goods"]').load('<?php echo uk86_urlShop('search', 'get_booth_goods', array('cate_id' => $_GET['cate_id']))?>', function(){
        $(this).show();
    });
	<?php }?>
	//浏览历史处滚条
	$('#nchSidebarViewed').perfectScrollbar();

	//猜你喜欢
	$('#guesslike_div').load('<?php echo uk86_urlShop('search', 'get_guesslike', array()); ?>', function(){
        $(this).show();
    });
});
</script>
