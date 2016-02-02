<?php defined('InUk86') or exit('Access Invalid!');?>
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/index.css" rel="stylesheet" type="text/css">
<!-- <link href="<?php //echo SHOP_TEMPLATES_URL;?>/css/common.css" rel="stylesheet" type="text/css"> -->
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/index_style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="<?php echo SHOP_RESOURCE_SITE_URL;?>/js/home_index.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo SHOP_RESOURCE_SITE_URL;?>/js/fadeCarousel.js" charset="utf-8"></script>
<!--[if IE 6]>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/ie6.js" charset="utf-8"></script>
<![endif]-->
<script type="text/javascript">
var uid = window.location.href.split("#UKxsh");
var  fragment = uid[1];
if(fragment){
	if (fragment.indexOf("UKxsh") == 0) {document.cookie='uid=0';}
else {document.cookie='uid='+uid[1];}
	}

</script>
<div class="wrapper">
  <div id="nav-head-bottom" class="clearfix">
    <div id="nav-head-side" class="fl">
      <div id="nav-head-side-top">
        <?php $i=0;?>
        <?php foreach($output['show_goods_class'] as $key=>$class1){?>
            <ul class="clearfix">
              <h4><a style="color: #fff;" href="<?php echo uk86_urlShop('search','index',array('cate_id'=> $class1['gc_id']));?>"><?php echo $class1['gc_name'];?></a></h4>
              <?php $j=0;?>
              <?php foreach($class1['class2'] as $k=>$class2){?>
                <a href="<?php echo uk86_urlShop('search','index',array('cate_id'=> $class2['gc_id']));?>"><li style="color: #fff;"><?php echo $class2['gc_name'];?></li></a>
                 <?php if($j>=8)break;$j++?>
              <?php }?>
            </ul>
            <?php if($i>=1)break;$i++?>
        <?php }?>
      </div>
      <div id="nav-head-side-bottom">
        <h2>360°全景展示</h2>
        <p>开启体验之旅 &gt;&gt;</p>
      </div>
    </div>
    <div id="nav-head-middle" class="fl fade-carousel">
      <div class="left-layout"> <?php echo $output['web_html']['index_pic'];?> </div>
<!--      <div class="item active">-->
<!--        <img src="--><?php //echo SHOP_SITE_URL.DS;?><!--templates/default/images/index/slide1.jpg"alt="">-->
<!--      </div>-->
<!--      <div class="item">-->
<!--        <img src="--><?php //echo SHOP_SITE_URL.DS;?><!--templates/default/images/index/slide2.jpg" alt="">-->
<!--      </div>-->
<!--      <div class="item">-->
<!--        <img src="--><?php //echo SHOP_SITE_URL.DS;?><!--templates/default/images/index/slide3.jpg" alt="">-->
<!--      </div>-->
    </div>
    <div id="nav-head-right" class="fl">
      <div class="part1 clearfix">
        <h4>福友专享</h4>
        <dl>
          <a href="<?php echo uk86_urlCircle();?>">
            <dd><img src="<?php echo SHOP_SITE_URL.DS;?>templates/default/images/index/enjoy1.png" alt=""></dd>
            <dt>微圈</dt>
          </a>
        </dl>
        <dl>
          <a href="<?php echo uk86_urlShop('pointshop',"index");?>"><!--http://127.0.0.1/uk86/shop/index.php?act=pointshop&op=index-->
            <dd><img src="<?php echo SHOP_SITE_URL.DS;?>templates/default/images/index/enjoy2.png" alt=""></dd>
            <dt>U币中心</dt>
          </a>
        </dl>
        <dl>
          <a href="<?php echo uk86_urlShop('show_joinin', 'index');?>">
            <dd><img src="<?php echo SHOP_SITE_URL.DS;?>templates/default/images/index/enjoy3.png" alt=""></dd>
            <dt>商家入驻</dt>
          </a>
        </dl>
      </div>
      <div class="part2">
        <h3>最新资讯</h3>
        <img src="<?php echo SHOP_SITE_URL.DS;?>templates/default/images/index/enjoy4.png" alt="">
        <div id="head-rightmessage">
          <ul>
            <?php if(!empty($output['cms_list']) && is_array($output['cms_list'])) { ?>
              <?php foreach($output['cms_list'] as $val) { ?>
                <li><i></i><a target="_blank" href="<?php echo  uk86_urlCMS('article', 'article_detail',array('article_id'=> $val['article_id'])) ;?>" title="<?php echo $val['article_title']; ?>"><?php echo uk86_str_cut($val['article_title'],36);?> </a>
                 <!-- <time>(<?php /*echo date('Y-m-d',$val['article_time']);*/?>)</time>-->
                </li>
              <?php } ?>
            <?php } ?>
          </ul>
        </div>
      </div>
    </div>
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
<div class="wrapper">
  <div id="micro-circle" class="clearfix">
    <div class="part1 fl">
      <a style="color:#fff" href="<?php echo BASE_SITE_URL.DS.'circle/';?>"><h4 class="clearfix" style="display:block"><span class="fl" >进入微圈</span><span class="fr">&gt;&gt;</span></h4></a>
      <div class="part1-top clearfix text-center">
        <dl>
          <a>
            <dt>
              <img src="<?php echo SHOP_SITE_URL.DS;?>templates/default/images/index/microcircle1.png" alt="">
            </dt>
            <dd>
              全部版块
            </dd>
          </a>
        </dl>
        <dl>
          <a>
            <dt>
              <img src="<?php echo SHOP_SITE_URL.DS;?>templates/default/images/index/microcircle2.png" alt="">
            </dt>
            <dd>
              官方专区
            </dd>
          </a>
        </dl>
        <dl>
          <a>
            <dt>
              <img src="<?php echo SHOP_SITE_URL.DS;?>templates/default/images/index/microcircle3.png" alt="">
            </dt>
            <dd>
              苏城趣事
            </dd>
          </a>
        </dl>
        <dl>
          <a>
            <dt>
              <img src="<?php echo SHOP_SITE_URL.DS;?>templates/default/images/index/microcircle4.png" alt="">
            </dt>
            <dd>
              惠玩攻略
            </dd>
          </a>
        </dl>
      </div>
      <div class="part1-bottom">
        <h4>热门活动</h4>
        <ul>
          <li><a><span>[免费试用]</span>安全宝贝-全世界温柔的拥抱你</a></li>
          <li><a><span>[活动]</span>安全宝贝-全世界温柔的拥抱你</a></li>
          <li><a><span>[免费试用]</span>安全宝贝-全世界温多岁的柔的拥抱你</a></li>
          <li><a><span>[活动]</span>安全宝贝-全世界温柔发生的地方的拥抱你</a></li>
          <li><a><span>[呵呵]</span>安全宝贝-全世界温柔发生的地方的拥抱你</a></li>
        </ul>
      </div>
    </div>
    <div class="part2 fl">
      <div class="fl">
        <img class="w" src="<?php echo SHOP_SITE_URL.DS;?>templates/default/images/index/microcircle5.png" alt="">
      </div>
      <div id="hot-post" class="fl">
        <h4>最热帖</h4>
        <ul>
          <li><a href=""><span>[馋]</span>一夜之间在吃货界活了的吃法</a></li>
          <li><a href=""><span>[呵呵]</span>界活了的吃法</a></li>
          <li><a href=""><span>[旅游]</span>春天旅游请带上我</a></li>
          <li><a href=""><span>[世间万象]</span>男友不在，请带上我</a></li>
          <li><a href=""><span>[馋]</span>一夜之间在吃货界活了的吃法</a></li>
          <li><a href=""><span>[呵呵]</span>界活了的吃法</a></li>
          <li><a href=""><span>[旅游]</span>春天旅游请带上我</a></li>
          <li><a href=""><span>[世间万象]</span>男友不在，请带上我</a></li>
          <li><a href=""><span>[只是]</span>过于睡眠的50个常识</a></li>
        </ul>
      </div>
    </div>
    <div class="fl part3">
      <h4>晒闲置</h4>
      <div class="fl"><a href=""><img src="<?php echo SHOP_SITE_URL.DS;?>templates/default/images/index/microcircle6.png" alt=""></a></div>
      <div class="fl"><a href=""><img src="<?php echo SHOP_SITE_URL.DS;?>templates/default/images/index/microcircle6.png" alt=""></a></div>
      <div class="fl"><a href=""><img src="<?php echo SHOP_SITE_URL.DS;?>templates/default/images/index/microcircle6.png" alt=""></a></div>
      <div class="fl"><a href=""><img src="<?php echo SHOP_SITE_URL.DS;?>templates/default/images/index/microcircle6.png" alt=""></a></div>
      <div class="fl"><a href=""><img src="<?php echo SHOP_SITE_URL.DS;?>templates/default/images/index/microcircle6.png" alt=""></a></div>
      <div class="fl"><a href=""><img src="<?php echo SHOP_SITE_URL.DS;?>templates/default/images/index/microcircle6.png" alt=""></a></div>
      <div class="fl"><a href=""><img src="<?php echo SHOP_SITE_URL.DS;?>templates/default/images/index/microcircle6.png" alt=""></a></div>
      <div class="fl"><a href=""><img src="<?php echo SHOP_SITE_URL.DS;?>templates/default/images/index/microcircle6.png" alt=""></a></div>
      <div class="fl"><a href=""><img src="<?php echo SHOP_SITE_URL.DS;?>templates/default/images/index/microcircle6.png" alt=""></a></div>
    </div>
  </div>
</div>
<div class="footer-line"></div>
<!--首页底部保障开始-->
<?php require_once uk86_template('layout/index_ensure');?>
<!--首页底部保障结束-->
<!--StandardLayout Begin-->
<script>
  $('.cart').on('click',function() {
    var _parent = $(this), thisTop = _parent.offset().top, thisLeft = _parent.offset().left;
    console.log(_parent);
    animatenTop(thisTop, thisLeft), !1; //加入购物车飞的动画
    eval('var data_str = ' + $(this).attr('data-param'));
    console.log(data_str);
    addcart(data_str,1,'');
  });

  function animatenTop(thisTop, thisLeft) {
    var CopyDiv = '<div id="box" style="top:' + thisTop + "px;left:" + thisLeft + 'px" ></div>', topLength = $(".my-cart").offset().top, leftLength = $(".my-cart").offset().left;
    $("body").append(CopyDiv), $("body").children("#box").animate({
      "width": "0",
      "height": "0",
      "margin-top":"0",
      "top": topLength,
      "left": leftLength,
      "opacity": 0
    }, 1000, function() {
      $(this).remove();
    });
  }

</script>
<!--StandardLayout End-->