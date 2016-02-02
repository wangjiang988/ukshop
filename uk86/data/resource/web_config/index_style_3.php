 <div class="wrapper">
    <div id="charracter-shopping">
        <div class="theme-title clearfix">
            <div class="theme-main-title fl">特色购物</div>
            <div class="fl">
                <h5 class="theme-sub-title">Characteristic Shopping</h5>
                <img class="w" src="<?php echo SHOP_SITE_URL.'/templates/default';?>/images/index/themeline2.png" alt="">
            </div>
        </div>
        <div class="theme-main clearfix">
            <div class="part1 fl">
                <ul class="clearfix">
                    <?php $i=0;?>
                    <?php if(!empty($output['code_category_list']['code_info']['goods_class'])){?>
                      <?php foreach($output['code_category_list']['code_info']['goods_class'] as $k =>$v){?>
                         <li><a href="<?php echo uk86_urlShop('search','index',array('cate_id'=> $v['gc_id']));?>"><?php echo $v['gc_name'];?></a></li>
                         <?php if($i==5)break;$i++;?>
                       <?php }?>
                    <?php }?>
                </ul>
                <div class="adver">      <!-- 活动广告图片-->
                    <a href="<?php echo $output['code_act']['code_info']['url'];?>title="<?php echo $output['code_act']['code_in*/fo']['title'];?>"><img src="<?php  echo UPLOAD_SITE_URL.'/'.$output['code_act']['code_info']['pic'];?>" alt=""></a>
                </div>
                <div class="ader-logo">
                    <h3>热门品牌</h3> <!--模块品牌列表-->
                    <?php if(!empty($output['code_brand_list']['code_info'])){?>
                        <?php $i=0;?>
                        <?php foreach($output['code_brand_list']['code_info'] as $key => $val){?>
                            <?php if($i==4){?>
                                <a href="<?php echo uk86_urlShop('brand', 'list', array('brand'=> $val['brand_id'])); ?>" title="<?php echo $val['brand_name']; ?>" target="_blank">
                                    <img class="old last" src="<?php echo UPLOAD_SITE_URL.'/'.$val['brand_pic'];?>" alt="<?php echo $val['brand_name']; ?>"></a>

                              <!--  <a><img class="old last" src="<?php /*echo UPLOAD_SITE_URL.'/'.$v['brand_pic'];*/?>" alt=""></a>-->
                            <?php }else if($i==5){?>
                                <a href="<?php echo uk86_urlShop('brand', 'list', array('brand'=> $val['brand_id'])); ?>" title="<?php echo $val['brand_name']; ?>" target="_blank">
                                    <img class="even last" src="<?php echo UPLOAD_SITE_URL.'/'.$val['brand_pic'];?>" alt="<?php echo $val['brand_name']; ?>"></a>
                               <!-- <a><img class="even last" src="<?php /*echo UPLOAD_SITE_URL.'/'.$v['brand_pic'];*/?>" alt=""></a>-->
                                <?php break;?>
                            <?php }else if($i%2==0){?>
                               <!-- <a><img class="odd" src="<?php /*echo UPLOAD_SITE_URL.'/'.$v['brand_pic'];*/?>" alt=""></a>-->
                                <a href="<?php echo uk86_urlShop('brand', 'list', array('brand'=> $val['brand_id'])); ?>" title="<?php echo $val['brand_name']; ?>" target="_blank">
                                    <img class="odd" src="<?php echo UPLOAD_SITE_URL.'/'.$val['brand_pic'];?>" alt="<?php echo $val['brand_name']; ?>"></a>
                            <?php }else{?>  <a href="<?php echo uk86_urlShop('brand', 'list', array('brand'=> $val['brand_id'])); ?>" title="<?php echo $val['brand_name']; ?>" target="_blank">
                                <img class="even" src="<?php echo UPLOAD_SITE_URL.'/'.$val['brand_pic'];?>" alt="<?php echo $val['brand_name']; ?>"></a>
                            <?php }?>
                            <?php $i++;}?>
                    <?php }?>
                </div>
            </div>
            <div class="part2 text-center fl">
                <?php if(!empty($output['code_recommend_list']['code_info'])){?>
                <?php foreach($output['code_recommend_list']['code_info'] as $key => $val){?>
                    <?php if(!empty($val['goods_list']) && is_array($val['goods_list'])) { ?>
                    <?php foreach ($val['goods_list'] as $key => $v){ ?>
                    <div class="fl">
                        <dl>
                            <dt><a target="_blank" href="<?php echo uk86_urlShop('goods','index',array('goods_id'=> $v['goods_id'])); ?>"><img src="<?php echo strpos($v['goods_pic'],'http')===0 ? $v['goods_pic']:UPLOAD_SITE_URL."/".$v['goods_pic'];?>" alt=""></a></dt>
                            <dd><a target="_blank" href="<?php echo uk86_urlShop('goods','index',array('goods_id'=> $v['goods_id'])); ?>"><?php echo $v['goods_name'];?></a></dd>
                        </dl>
                    </div>
                    <?php }?>
                    <?php break;}?>
                <?php }?>
                <?php }?>
            </div>
        </div>
    </div>
 </div>