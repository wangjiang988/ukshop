123<?php defined('InUk86') or exit('Access Invalid!');?>
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/index.css" rel="stylesheet" type="text/css">
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/common.css" rel="stylesheet" type="text/css">
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/index_style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo SHOP_RESOURCE_SITE_URL;?>/js/home_index.js" charset="utf-8"></script>
<!--[if IE 6]>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/ie6.js" charset="utf-8"></script>
<![endif]-->
<script type="text/javascript">
var uid = window.location.href.split("#V3");
var  fragment = uid[1];
if(fragment){
	if (fragment.indexOf("V3") == 0) {document.cookie='uid=0';}
else {document.cookie='uid='+uid[1];}
	}
</script>
<style type="text/css">
/* .category { display: block !important; } */
#title_index{position:absolute; z-index:100; background:rgba(0,0,0,0.5); color:#FFF;}
#view{width:100%; height:120px; background:#EEE;}
#view img{width:100%; height:100%; border:0px;}
.jfocus-trigeminy{display:none;}
.right-sidebar{display:none;}
.full-screen-slides-pagination{margin-top:180px; background:transparent;}
</style>
<div class="clear"></div>

<!-- HomeFocusLayout Begin-->
<div class="home-focus-layout"> <?php echo $output['web_html']['index_pic'];?>
  <div class="right-sidebar">
    <div class="proclamation"  style="height:180px;">
      <ul class="tabs-nav">
        <li class="tabs-selected">
          <h3><?php echo $output['show_article']['notice']['ac_name'];?></h3>
        </li>
        <li>
          <h3>招商入驻</h3>
        </li>
      </ul>
      <div class="tabs-panel">
        <ul class="mall-news">
          <?php if(!empty($output['show_article']['notice']['list']) && is_array($output['show_article']['notice']['list'])) { ?>
          <?php foreach($output['show_article']['notice']['list'] as $val) { ?>
          <li><i></i><a target="_blank" href="<?php echo empty($val['article_url']) ? uk86_urlShop('article', 'show',array('article_id'=> $val['article_id'])):$val['article_url'] ;?>" title="<?php echo $val['article_title']; ?>"><?php echo uk86_str_cut($val['article_title'],24);?> </a>
            <time>(<?php echo date('Y-m-d',$val['article_time']);?>)</time>
          </li>
          <?php } ?>
          <?php } ?>
        </ul>
      </div>
      <div class="tabs-panel tabs-hide"> <a href="<?php echo uk86_urlShop('show_joinin', 'index');?>" title="申请商家入驻；已提交申请，可查看当前审核状态。" class="store-join-btn" target="_blank">&nbsp;</a> <a href="<?php echo uk86_urlShop('seller_login','show_login');?>" target="_blank" class="store-join-help"><i class="icon-cog"></i>登录商家管理中心</a> </div>

    </div>
     <div id="view">
    	<a href="javascript:void(0);"><img title="逛观前" src="<?php echo SHOP_SITE_URL.'/templates/default/images/index_view.png' ?>"/></a>
    </div>
    <?php if(!empty($output['group_list']) && is_array($output['group_list'])) { ?>
    <div class="groupbuy" style="position: relative; height:180px;">
      <ul>
        <?php foreach($output['group_list'] as $val) { ?>
        <li id="index_right_title" style="z-index:10;">
    	  <div class="title" id="title_index"><i>抢</i><span class="time-remain" count_down="<?php echo $val['end_time']-TIMESTAMP; ?>"> <em time_id="d">0</em><?php echo $lang['text_tian'];?><em time_id="h">0</em><?php echo $lang['text_hour'];?> <em time_id="m">0</em><?php echo $lang['text_minute'];?><em time_id="s">0</em><?php echo $lang['text_second'];?> </span></div>
          <dl style=" background-image:url(<?php echo uk86_gthumb($val['groupbuy_image1'], 'small');?>)">
            <dt><?php echo $val['groupbuy_name']; ?></dt>
            <dd class="price"><span class="groupbuy-price"><?php echo uk86_ncPriceFormatForList($val['groupbuy_price']); ?></span><span class="buy-button"><a href="<?php echo uk86_urlShop('show_groupbuy','groupbuy_detail',array('group_id'=> $val['groupbuy_id']));?>" style="border-radius:4px;">立即抢</a></span></dd>

            </dl>
        </li>
        <?php }  ?>
      </ul>
    </div>
    <?php } ?>
  </div>
</div>
<!--HomeFocusLayout End-->
<div class="home-sale-layout wrapper">  <!-- 顶部模板-->
  <div class="left-layout"> <?php echo $output['web_html']['index_sale'];?> </div>
  <?php if(!empty($output['xianshi_item']) && is_array($output['xianshi_item'])) { ?>
  <div class="right-sidebar">
    <div class="title">
      <h3 style="font-family:'幼圆'; font-size:18px;">限时抢购</h3>
    </div>
    <div id="saleDiscount" class="sale-discount">
      <ul>
        <?php foreach($output['xianshi_item'] as $val) { ?>
        <li>
          <dl>
            <dt class="goods-name"><?php echo $val['goods_name']; ?></dt>
            <dd class="goods-thumb"><a href="<?php echo uk86_urlShop('goods','index',array('goods_id'=> $val['goods_id']));?>"> <img src="<?php echo uk86_thumb($val, 240);?>"></a></dd>
            <dd class="goods-price"><?php echo uk86_ncPriceFormatForList($val['xianshi_price']); ?> <span class="original"><?php echo uk86_ncPriceFormatForList($val['goods_price']);?></span></dd>
            <dd class="goods-price-discount"><em><?php echo $val['xianshi_discount']; ?></em></dd>
            <dd class="time-remain" count_down="<?php echo $val['end_time']-TIMESTAMP;?>"><i></i><em time_id="d">0</em><?php echo $lang['text_tian'];?><em time_id="h">0</em><?php echo $lang['text_hour'];?> <em time_id="m">0</em><?php echo $lang['text_minute'];?><em time_id="s">0</em><?php echo $lang['text_second'];?> </dd>
            <dd class="goods-buy-btn"></dd>
          </dl>
        </li>
        <?php } ?>
      </ul>
    </div>
  </div>
  <?php } ?>
</div>
<div class="wrapper">
  <div class="mt10">
    <div class="mt10"><?php echo uk86_loadadv(11,'html');?></div>
  </div>
</div>
<!--StandardLayout Begin-->
<?php echo $output['web_html']['index'];?>   <!--楼层模板，注意：：：-->
<!--StandardLayout End -->
<div></div>
<div class="wrapper">
  <div class="mt10"><?php echo uk86_loadadv(9,'html');?></div>   <!--广告位-->
</div>
<!--link Begin-->
<!--<div class="full_module wrapper">
  <h2><b><?php echo $lang['index_index_link'];?></b></h2>
  <div class="piclink">
    <?php if(is_array($output['$link_list']) && !empty($output['$link_list'])) {
		  	foreach($output['$link_list'] as $val) {
		  		if($val['link_pic'] != ''){
		  ?>
    <span><a href="<?php echo $val['link_url']; ?>" target="_blank"><img src="<?php echo $val['link_pic']; ?>" title="<?php echo $val['link_title']; ?>" alt="<?php echo $val['link_title']; ?>" width="88" height="31" ></a></span>
    <?php
		  		}
		 	}
		 }
		 ?>
    <div class="clear"></div>
  </div>
  <div class="textlink">
    <?php
		  if(is_array($output['$link_list']) && !empty($output['$link_list'])) {
		  	foreach($output['$link_list'] as $val) {
		  		if($val['link_pic'] == ''){
		  ?>
    <span><a href="<?php echo $val['link_url']; ?>" target="_blank" title="<?php echo $val['link_title']; ?>"><?php echo uk86_str_cut($val['link_title'],16);?></a></span>
    <?php
		  		}
		 	}
		 }
		 ?>
    <div class="clear"></div>
  </div>
</div>-->
<!--link end-->
<div class="footer-line"></div>
<!--首页底部保障开始-->
<?php require_once uk86_template('layout/index_ensure');?>
<!--首页底部保障结束-->
<!--StandardLayout Begin-->
<div class="nav_Sidebar">
<a class="nav_Sidebar_1" href="javascript:;" ></a>
<a class="nav_Sidebar_2" href="javascript:;" ></a>
<a class="nav_Sidebar_3" href="javascript:;" ></a>
<a class="nav_Sidebar_4" href="javascript:;" ></a>
<a class="nav_Sidebar_5" href="javascript:;" ></a>
<a class="nav_Sidebar_6" href="javascript:;" ></a>
<a class="nav_Sidebar_7" href="javascript:;" ></a>
<a class="nav_Sidebar_8" href="javascript:;" ></a>
</div>
<!--StandardLayout End-->