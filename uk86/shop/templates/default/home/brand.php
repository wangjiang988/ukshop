<?php defined('InUk86') or exit('Access Invalid!');?>
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/pointprod/layout.css" rel="stylesheet" type="text/css">
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/pointprod/point.css" rel="stylesheet" type="text/css">

<div class="container">
	<div class="ad-ul-out">
		<ul class="ad-ul-01">
			<li>
				<?php echo uk86_loadadv(1046,'html');?>
				<p><?php echo uk86_loadadv(1047,'html');?></p>
			</li>
			<li>
				<?php echo uk86_loadadv(1048,'html');?>
				<p><?php echo uk86_loadadv(1049,'html');?></p>
			</li>
		</ul>

		<?php if(!empty($output['brand_r'])){?>
			<ul class="ad-ul-02">
				<?php foreach($output['brand_r'] as $key=>$brand_r){?>
				<li>
					<a href="<?php echo uk86_urlShop('brand', 'list', array('brand'=>$brand_r['brand_id']));?>"><img src="<?php echo uk86_brandImage($brand_r['brand_pic']);?>" alt="<?php echo $brand_r['brand_name'];?>" /></a>
					<p class="title">
						<a href="<?php echo uk86_urlShop('brand', 'list', array('brand'=>$brand_r['brand_id']));?>"><?php echo $brand_r['brand_name'];?></a>
					</p>
				</li>
				<?php }?>
			</ul>
		<?php }?>

		<div class="ad-bt-box">热门品牌</div>
		<div class="ad-more"><a href="<?php echo uk86_urlShop('store_list', 'brand_all');?>">更多&nbsp;<em>&lt;&lt;</em></a></div>
		<div class="ad-ul-03">
			<div class="left-ad"><?php echo uk86_loadadv(1050,'html');?></div>
			<ul>

				<li>
					<div class="text">
						<a href="#"><img src="img/mall-52.gif" /></a>
						<p><a href="#">百思图</a></p>
					</div>
					<a href="#">
						<img class="big-img" src="img/img02.gif" />
					</a>
				</li>
				<li>
					<div class="text">
						<a href="#"><img src="img/mall-52.gif" /></a>
						<p><a href="#">百思图</a></p>
					</div>
					<a href="#">
						<img class="big-img" src="img/img02.gif" />
					</a>
				</li>
				<li>
					<div class="text">
						<a href="#"><img src="img/mall-52.gif" /></a>
						<p><a href="#">百思图</a></p>
					</div>
					<a href="#">
						<img class="big-img" src="img/img02.gif" />
					</a>
				</li>
				<li>
					<div class="text">
						<a href="#"><img src="img/mall-52.gif" /></a>
						<p><a href="#">百思图</a></p>
					</div>
					<a href="#">
						<img class="big-img" src="img/img02.gif" />
					</a>
				</li>
			</ul>
		</div>

		<div class="ad-bt-box">今日上新</div>
		<div class="ad-more"><a href="<?php echo uk86_urlShop('store_list', 'brand_all');?>">更多&nbsp;<em>&lt;&lt;</em></a></div>
		<ul class="ad-ul-04">
			<li><?php echo uk86_loadadv(1051,'html');?></li>
			<li><?php echo uk86_loadadv(1052,'html');?></li>
			<li><?php echo uk86_loadadv(1053,'html');?></li>
			<li><?php echo uk86_loadadv(1054,'html');?></li>
			<li><?php echo uk86_loadadv(1055,'html');?></li>
		</ul>

		<div class="ad-bt-box">商城推荐</div>
		<div class="ad-more"><a href="<?php echo uk86_urlShop('store_list', 'brand_all');?>">更多&nbsp;<em>&lt;&lt;</em></a></div>
		<ul class="ad-ul-05">
			<li><?php echo uk86_loadadv(1056,'html');?></li>
			<li><?php echo uk86_loadadv(1057,'html');?></li>
			<li><?php echo uk86_loadadv(1058,'html');?></li>
		</ul>

		<?php if(!empty($output['brand_class'])){?>
			<ul class="nav-fixed">
				<?php $i = 0;foreach($output['brand_class'] as $key=>$brand){$i++;?>
					<li class="<?php if ($i == 1) { echo 'tabs-selected';} ?>"><a href="javascript:void(0);"><?php echo $brand['brand_class'];?></a></li>
				<?php }?>
			</ul>
		<?php }?>
	</div>

</div>
