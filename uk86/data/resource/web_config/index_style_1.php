<div class="wrapper">
     <div id="day-hot-sale" class="wrapper clearfix">
         <div class="fl part1">
<!--             <img src="images/hotsale.png" alt="">-->
             <?php if(!empty($output['code_act']['code_info']['pic'])) { ?>
                 <a href="<?php echo $output['code_act']['code_info']['url'];?>" title="<?php echo $output['code_act']['code_info']['title'];?>" target="_blank">
                     <img src="<?php  echo UPLOAD_SITE_URL.'/'.$output['code_act']['code_info']['pic'];?>" alt="<?php echo $output['code_act']['code_info']['title']; ?>">
                 </a>
             <?php } ?>
         </div>
         <div class="fl part2">

             <?php if(!empty($output['code_recommend_list']['code_info'])){?>
                 <?php foreach ($output['code_recommend_list']['code_info'] as $key => $v){ ?>
                     <?php if(!empty($v['goods_list']) && is_array($v['goods_list'])) { ?>
                         <?php foreach ($v['goods_list'] as $key => $val){ ?>
                         <a href="">
                             <div class="hot-sale">
                                 <dl>
                                     <dt><a target="_blank" href="<?php echo uk86_urlShop('goods','index',array('goods_id'=> $val['goods_id'])); ?>"><img src="<?php echo strpos($val['goods_pic'],'http')===0 ? $val['goods_pic']:UPLOAD_SITE_URL."/".$val['goods_pic'];?>" alt=""></a></dt>
                                     <dd>
                                         <h3><a target="_blank" href="<?php echo uk86_urlShop('goods','index',array('goods_id'=> $val['goods_id'])); ?>"><?php echo $val['goods_name'];?></a></h3>
                                         <div class="fl text-left">
                                             <span class="discount-price"><?php echo uk86_ncPriceFormatForList($val['goods_price']); ?></span>
                                             <span class="bef-price"><?php echo uk86_ncPriceFormatForList($val['market_price']); ?></span>
                                         </div>

                                     </dd>
                                 </dl>
                             </div>
                         </a>
                     <?php };?>
                     <?php break;}?>
                 <?php }?>
             <?php }?>
         </div>
         <div id="host-sale-side-ad" class="fl">
             <?php if (is_array($output['code_adv']['code_info']) && !empty($output['code_adv']['code_info'])) { ?>
                 <?php foreach ($output['code_adv']['code_info'] as $key => $val) { ?>
                     <?php if (is_array($val) && !empty($val)) { ?>
                         <div><a href="<?php echo $val['pic_url'];?>" title="<?php echo $val['pic_name'];?>" target="_blank">
                                 <img src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_img'];?>" alt="<?php echo $val['pic_name'];?>"/></a></div>
                     <?php } ?>
                 <?php } ?>
             <?php } ?>

           <!--  <div><a href=""><img src="images/hostsalead.png" alt=""></a></div>
             <div><a href=""><img src="images/hostsalead.png" alt=""></a></div>-->
         </div>
     </div>
 </div>