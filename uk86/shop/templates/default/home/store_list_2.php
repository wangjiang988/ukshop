
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/pointprod/layout.css" rel="stylesheet" type="text/css">
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/pointprod/point.css" rel="stylesheet" type="text/css">
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/pointprod/shop.css" rel="stylesheet" type="text/css">

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

        $('.store-list .left .text-box .p-04').hover(
            function(){
                $(this).addClass("p-active");
            },
            function () {
                $(this).removeClass("p-active");
            }
        );
    });


</script>
<div class="container">
    <dl class="sel-dl" style="display: none">
        <dt>店铺类目</dt>
        <dd class="dd-01 dd-down">
            <span class="sp text-ellipsis active"><a href="#">全部</a></span>
            <span class="sp text-ellipsis"><a href="#"> 服装鞋包</a></span>
            <span class="sp text-ellipsis"><a href="#"> 服装鞋包</a></span>
            <span class="sp text-ellipsis"><a href="#"> 服装鞋包</a></span>
            <span class="sp text-ellipsis"><a href="#"> 服装鞋包</a></span>
            <span class="sp text-ellipsis"><a href="#"> 服装鞋包</a></span>
            <span class="sp text-ellipsis"><a href="#"> 服装鞋包</a></span>
            <span class="sp text-ellipsis"><a href="#"> 服装鞋包</a></span>
            <span class="sp text-ellipsis"><a href="#"> 服装鞋包</a></span>
            <span class="sp text-ellipsis"><a href="#"> 服装鞋包</a></span>
            <span class="sp text-ellipsis"><a href="#"> 服装鞋包</a></span>
        </dd>
        <dd class="dd-02">
            <span class="up">展开</span>
        </dd>
    </dl>
    <dl class="sel-dl">
        <dt>店铺类目</dt>
        <dd class="dd-01">

            <?php foreach($output['class_list'] as $k=>$v){?>
                <?php if ($_GET['cate_id'] == $v['sc_parent_id']){?>
                    <span class="sp text-ellipsis">
                        <a href="<?php echo uk86_urlShop('store_list','index',array('cate_id'=>$k));?>"><?php echo $v['sc_name'];?></a>
                    </span>
                <?php }elseif (!isset($v['child']) && $output['class_list'][$_GET['cate_id']]['sc_parent_id'] == $v['sc_parent_id']){?>
                    <span class="sp text-ellipsis">
                        <a href="<?php echo uk86_urlShop('store_list','index',array('cate_id'=>$k));?>"><?php echo $v['sc_name'];?></a>
                    </span>
                <?php }?>
            <?php }?>

        </dd>
        <dd class="dd-02" style="display: none">
            <span class="down">收起</span>
        </dd>
    </dl>


    <form id="store_list" method="GET" action="index.php">
        <input type="hidden" name="order" value="<?php echo $_GET['order'];?>"/>
        <input type="hidden" name="act" value="store_list"/>
        <input type="hidden" name="cate_id" value="<?php echo $_GET['cate_id'];?>"/>

        <div class="select-bd">
            <ul class="ul-01">
                <li><a href="javascript:void(0)" class="nobg" onclick="javascript:ss_dropParam('key','order');"><span class="mr_red">默认</span></a></li>
                <li><a href="javascript:void(0)" <?php if($_get['key'] == 'store_sales'){?>class="<?php echo $_GET['order'];?>"<?php }?> onclick="javascript:ss_replaceParam('store_sales','<?php echo ($_GET['order'] == 'desc' && $_GET['key'] == 'store_sales')?'asc':'desc' ?>');"><span>销量</span><i class="cp_ti01"></i></a></li>
                <li><a href="javascript:void(0)" <?php if($_get['key'] == 'store_credit'){?>class="<?php echo $_GET['order'];?>"<?php }?> onclick="javascript:ss_replaceParam('store_credit','<?php echo ($_GET['order'] == 'desc' && $_GET['key'] == 'store_credit')?'asc':'desc' ?>');"><span>信用</span><i class="cp_ti02"></i></a></li>
               <!-- <li><a class="active" href="#">默认</a></li>
                <li><a href="#">销量<em class="up"></em></a></li>
                <li><a href="#">信用<em class="down"></em></a></li>-->
            </ul>
            <dl class="dl-01">
                <dt>店铺名称：</dt>
                <dd><input class="ui_input" type="text" name="keyword" value="<?php echo $_GET['keyword'];?>" placeholder="" /></dd>
            </dl>
            <dl class="dl-02">
                <dt>所在地：</dt>
                <dd>
                    <div class="selectbox">
                        <input id="area_info" name="area_info" type="hidden" value=""/>
                    </div>
                </dd>
            </dl>
            <a class="search-a" href="#"><input type="submit" value="搜索"></a>
        </div>

    </form>

    <?php if(!empty($output['store_list']) && is_array($output['store_list'])){?>
        <?php foreach($output['store_list'] as $skey => $store){?>

            <div class="store-list">
                <div class="left">
                    <span class="img-box"><a href="<?php echo uk86_urlShop('show_store','', array('store_id'=>$store['store_id']),$store['store_domain']);?>" title="" target="_blank"><span class="size72"><img src="<?php echo uk86_getStoreLogo($store['store_avatar']);?>"  alt="<?php echo $store['store_name'];?>" title="<?php echo $store['store_name'];?>" class="size72" /></span></a></span>
                    <div class="text-box">
                        <p class="p-01"><a href="#"><a href="<?php echo uk86_urlShop('show_store','', array('store_id'=>$store['store_id']),$store['store_domain']);?>" target="_blank"><?php echo $store['store_name'];?></a></a></p>
                        <p class="p-02">店主：<?php echo $store['member_name'];?></p>
                        <a  class="collect" href="javascript:collect_store('<?php echo $store['store_id'];?>','count','store_collect')" >收藏店铺</a>
                        <p class="p-03">信用度：
                            <?php
                            for($i=0;$i<$store['store_credit_average'];$i++){
                                echo '<img src="'.SHOP_TEMPLATES_URL.'/images/mall-130.gif" />';
                            }
                            ?>
                        </p>
                        <p>好评率：
                            <?php if (empty($store['store_credit_percent'])){?>
                                <?php echo $lang['nc_common_rate_null'];?>
                            <?php }else{?>
                                <?php echo $lang['store_class_index_praise_rate'].$lang['nc_colon'].$store['store_credit_percent'];?>%
                            <?php }?>
                        </p>
                        <p><?php echo ($tmp = $store['goods_count']) ? $lang['store_class_index_goods_amount'].$tmp.$lang['piece'] : $lang['nc_common_goods_null'];?> / <?php echo ($tmp = $store['num_sales_jq']) ? $lang['store_class_index_deal'].$tmp.$lang['store_class_index_jian'] : $lang['nc_common_sell_null'];?></p>
                        <div class="p-04">
                            店铺动态评分
                            <div class="star-box">
                                <?php  foreach ($store['store_credit'] as $key=>$value) {?>
                                    <dl>
                                        <dt><?php echo $value['text'];?>：</dt>
                                        <dd class="dd-01">
                                            <?php for($i=0;$i<$value['credit'];$i++){ ?>
                                                <img src="<?php echo SHOP_TEMPLATES_URL;?>/images/mall-132.gif" />
                                            <?php }?>
                                        </dd>
                                        <dd><?php echo $value['credit'];?>分</dd>
                                    </dl>
                                <?php } ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="right">
                    <div class="brand-out scrolllist">
                        <a class="abtn aleft btnPrev" href="#left" title="左移"></a>
                        <div class="ul-out imglist_w">
                            <ul style="width:10000px;">
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
            </div>

        <?php }?>
    <?php }?>

    <div class="pagination-out">
        <div class="pagination"> <?php echo $output['show_page'];?> </div>
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
