<?php defined('InUk86') or exit('Access Invalid!');?>
<?php /*var_dump($output['code_recommend_list']['code_info'][2]['goods_list']);*/?>

<div class="wrapper">
	<div id="charracter-shopping2">
	<div class="theme-title clearfix">
		<div class="theme-main-title fl">特色购物</div>
		<div class="fl">
			<h5 class="theme-sub-title">Characteristic Shopping</h5>
			<img class="w" src="<?php echo SHOP_SITE_URL.DS.'/templates/default';?>/images/index/themeline3.png" alt="">
		</div>
	</div>
	<div class="theme-main clearfix">
		<div class="part1 fl">
<!--			<a><img src="--><?php //echo SHOP_SITE_URL.DS.'/templates/default';?><!--/images/index/chashopad2.jpg"/></a>-->
			<?php if(!empty($output['code_act']['code_info']['pic'])) { ?>
				<a href="<?php echo $output['code_act']['code_info']['url'];?>" title="<?php echo $output['code_act']['code_info']['title'];?>" target="_blank">
					<img src="<?php  echo UPLOAD_SITE_URL.'/'.$output['code_act']['code_info']['pic'];?>" alt="<?php echo $output['code_act']['code_info']['title']; ?>">
				</a>
			<?php } ?>
			<div style="background-color: <?php echo $style_name;?>"
				<ul>
					<?php $i=0;?>
					<?php if(!empty($output['code_category_list']['code_info']['goods_class'])){?>
						<?php foreach($output['code_category_list']['code_info']['goods_class'] as $k =>$v){?>
							<li><a href="<?php echo uk86_urlShop('search','index',array('cate_id'=> $v['gc_id']));?>"><?php echo $v['gc_name'];?></a></li>
							<?php if($i==5)break;$i++;?>
						<?php }?>
					<?php }?>
				</ul>
			</div>
		</div>
		<div class="part2 text-center fl">   <!--商品列表-->
			<?php if(!empty($output['code_recommend_list']['code_info'])){?>
				<?php foreach ($output['code_recommend_list']['code_info'] as $key => $v){ ?>
					<?php if(!empty($v['goods_list']) && is_array($v['goods_list'])) { ?>
					<?php foreach ($v['goods_list'] as $key => $val){ ?>
						<a href="">
						<div class="fl goods-info">
							<dl>
								<dt><a target="_blank" href="<?php echo uk86_urlShop('goods','index',array('goods_id'=> $val['goods_id'])); ?>"><img src="<?php echo strpos($val['goods_pic'],'http')===0 ? $val['goods_pic']:UPLOAD_SITE_URL."/".$val['goods_pic'];?>" alt=""></a></dt>
								<dd>
									<h3><a target="_blank" href="<?php echo uk86_urlShop('goods','index',array('goods_id'=> $val['goods_id'])); ?>"><?php echo $val['goods_name'];?></a></h3>
									<div class="fl text-left">
										<p class="bef-price"><?php echo uk86_ncPriceFormatForList($val['market_price']); ?></p>
										<h4 class="discount-price"><?php echo uk86_ncPriceFormatForList($val['goods_price']); ?></h4>
									</div>
									<div class="fr">
										<img class="cart" src="<?php echo SHOP_SITE_URL.DS.'/templates/default';?>/images/index/shoppingcart.png" alt="" data-param="<?php echo $val['goods_id'];?>">
									</div>
								</dd>
							</dl>
						</div>
					</a>
					<?php }?>
				  <?php break;}?>
				<?php }?>
			<?php }?>
			</div>
		</div>
</div>
</div>

