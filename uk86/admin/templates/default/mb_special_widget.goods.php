<?php defined('InUk86') or exit('Access Invalid!');?>
<?php if(!empty($output['goods_list']) && is_array($output['goods_list'])){ ?>

<ul class="search-goods-list">
  <?php foreach($output['goods_list'] as $key => $value){ ?>
  <li>
    <div class="goods-name"><?php echo $value['goods_name'];?></div>
    <div class="goods-price">￥<?php echo $value['goods_promotion_price'];?>&nbsp;&nbsp;<s style="color:#999;"><?php echo $value['goods_marketprice']; ?></s></div>
    <div class="goods-pic"><img title="<?php echo $value['goods_name'];?>" src="<?php echo uk86_thumb($value, 60);?>" /></div>
    <a nctype="btn_add_goods" data-goods-id="<?php echo $value['goods_id'];?>" data-goods-name="<?php echo $value['goods_name'];?>" data-goods-price="<?php echo $value['goods_promotion_price'];?>" data-goods-marketprice="<?php echo $value['goods_marketprice']; ?>" data-goods-image="<?php echo uk86_thumb($value, 240);?>" data-goods-fcode="<?php echo $value['is_fcode'] ?>" data-goods-promotion="<?php echo $value['goods_promotion_type'] ?>" href="javascript:void(0);;">添加</a> </li>
  <?php } ?>
</ul>
<div id="goods_pagination" class="pagination"> <?php echo $output['show_page'];?> </div>
<?php }else { ?>
<p class="no-record"><?php echo $lang['nc_no_record'];?></p>
<?php } ?>
<script type="text/javascript">
    $(document).ready(function(){
        $('#goods_pagination').find('.demo').ajaxContent({
            event:'click', 
            loaderType:"img",
            loadingMsg:"<?php echo ADMIN_TEMPLATES_URL;?>/images/transparent.gif",
            target:'#mb_special_goods_list'
        });
    });
</script> 
