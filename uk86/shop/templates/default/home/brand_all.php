<?php defined('InUk86') or exit('Access Invalid!');?>

<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/cp_style.css" rel="stylesheet" type="text/css">
<script src="<?php echo RESOURCE_SITE_URL;?>/js/css3-mediaqueries.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/html5_tag.js"></script>
<script type="text/javascript" src="<?php echo SHOP_RESOURCE_SITE_URL.'/js/Jquery.Query.js';?>" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/waypoints.js"></script>


<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/pointprod/layout.css" rel="stylesheet" type="text/css">
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/pointprod/point.css" rel="stylesheet" type="text/css">

<div class="container">
    <div class="ad-ul-out">

        <?php if(!empty($output['store_list']) && is_array($output['store_list'])){?>
            <?php foreach($output['store_list'] as $skey => $store){?>
                <div class="brand-list">
            <div class="left">
                <a href="<?php echo uk86_urlShop('show_store','', array('store_id'=>$store['store_id']),$store['store_domain']);?>" title="" target="_blank"><span class="size72"><img src="<?php echo uk86_getStoreLogo($store['store_avatar']);?>"  alt="<?php echo $store['store_name'];?>" title="<?php echo $store['store_name'];?>" class="size72" /></span></a>
                <div class="text">
                    <p class="p-01"><?php echo $store['store_name'];?></p>
                    <!--<p class="p-02">主营商品：服装</p>-->
                    <p class="p-02">商品件数：
                        <?php echo ($tmp = $store['goods_count']) ? $tmp.$lang['piece'] : ' 暂无';?>
                    </p>
                    <p class="p-02">最近成交：
                        <?php echo ($tmp = $store['num_sales_jq']) ? $tmp.$lang['store_class_index_jian'] : ' 暂无';?>
                    </p>
                    <p class="p-02">信用度：
                        <?php
                        $num_star = $store['store_credit_average'];
                        for($i=0;$i<3;$i++){
                            if($i < $num_star){
                                echo '<em class="star-active"></em>';
                            }else{
                                echo '<em></em>';
                            }
                        }
                        ?>
                    </p>
                    <p class="p-02">好评率：
                        <?php if (empty($store['store_credit_percent'])){?>
                            <?php echo ' 暂无';?>
                        <?php }else{?>
                            <?php echo $store['store_credit_percent'];?>%
                        <?php }?>
                    </p>
                    <a class="collect-a"  href="javascript:collect_store('<?php echo $store['store_id'];?>','count',
                    'store_collect')" >收藏</a>
                </div>
            </div>
            <div class="scrolllist brand-out">
                    <a class="btnPrev abtn aleft" href="#left" title="左移"></a>
                    <div class="ul-out imglist_w">
                        <ul style="width: 20000px;">
                            <?php foreach($store['search_list_goods'] as $k=>$v){?>
                                <li>
                                    <a target="_blank" href="index.php?act=goods&goods_id=<?php echo $v['goods_id'];?>"><img width="163" height="163" src="<?php echo uk86_thumb($v,'small');?>" /></a>
                                    <p class="text-ellipsis"><a href="#"><?php echo $v['goods_name'];?></a></p>
                                    <div class="price">
                                        <span class="sp-01">￥<em><?php echo $v['goods_price'];?></em></span>
                                        <span class="sp-02">最近成交<?php echo $v['goods_salenum'];?>笔</span>
                                    </div>
                                </li>
                            <?php }?>

                        </ul>
                    </div>
                    <a class="abtn aright btnNext" href="#right" title="右移"></a>
            </div>
        </div>
            <?php }?>
        <?php }?>

        <div class="pagination-out">
            <div class="pagination"> <?php echo $output['show_page'];?> </div>
        </div>
<!--        <div class="pagination-out">-->
<!--            <div class="pagination">-->
<!--                <ul>-->
<!--                    <li><span><a href="#">首页</a></span></li>-->
<!--                    <li><span><a href="#">上一页</a></span></li>-->
<!--                    <li><span class="currentpage">1</span></li>-->
<!--                    <li><span><a href="#">下一页</a></span></li>-->
<!--                    <li><span><a href="#">末页</a></span></li>-->
<!--                </ul>-->
<!--            </div>-->
<!--        </div>-->

    </div>


</div>

<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/slider.js"></script>
<script type="text/javascript">
    $(".scrolllist").xslider({
        unitdisplayed: 4,
        movelength: 2,
        unitlen: 211, //移动的单位宽或高度     默认查找li的尺寸;
        autoscroll: null //自动移动间隔时间     默认null不自动移动;
    });
</script>
<script>
    $('.cp_pj').hover(function() {
        $(this).find('.cp_xx').toggle();
    })
</script>
<!--底部结束-->