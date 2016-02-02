<?php defined('InUk86') or exit('Access Invalid!');?>

<div class="all_foot">
	<div class="home_foot">
		<a href="index.php?act=wap_index"><i class="icon-bot-i01"></i>
		<p>首页</p>
		</a>
		<a href="index.php?act=wap_goods_class"><i class="icon-bot-i02"></i>
		<p>分类</p>
		</a>
		<a href="index.php?act=wap_cart"><i class="icon-bot-i03"><?php if(!empty($output['cart_goods_num'])){ ?><em><?php echo $output['cart_goods_num']; ?></em><?php } ?></i>
		<p>购物车</p>
		</a>
		<a href="index.php?act=wap_member"><i class="icon-bot-i04"></i>
		<p>我的</p>
		</a>
	</div>
</div>
</body>
</html>