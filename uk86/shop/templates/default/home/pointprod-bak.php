<?php defined('InUk86') or exit('Access Invalid!');?>
<!--<link href="--><?php //echo SHOP_TEMPLATES_URL;?><!--/css/pointprod/base.css" rel="stylesheet" type="text/css">-->
<link href="<?php echo SHOP_TEMPLATES_URL;?>/home/css/base.css" rel="stylesheet" type="text/css">
<link href="<?php echo SHOP_TEMPLATES_URL;?>/home/css/layout.css" rel="stylesheet" type="text/css">
<link href="<?php echo SHOP_TEMPLATES_URL;?>/home/css/point.css" rel="stylesheet" type="text/css">
<div class="container">
  <div class="top-member">
    <div class="left">
      <a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/img/mall-43.gif" /></a>
    </div>
    <div class="right">
      <div class="login-after">
      	<?php if($_SESSION['is_login'] == '1'){?>
        <div class="head-bd">
          <img src="<?php echo SHOP_TEMPLATES_URL;?>/home/img/mall-45.gif" />
          <div class="text">
            <p class="p-01"><?php echo $lang['p_hi'].$output['member_info']['member_name'];?></p>
            <p class="p-02"><?php echo $lang['p_current_level'].$output['member_info']['level_name'];?></p>
            <p class="p-02"><?php echo $lang['p_current_point'].$output['member_info']['member_exppoints'];?></p>
          </div>
        </div>
        <div class="progress-bar-out">
          <span class="sp-01"><?php echo $output['member_info']['level_name'];?></span>
          <div class="progress-bar">
            <span style="width:<?php echo $output['member_info']['exppoints_rate'];?>%"></span>
          </div>
          <span class="sp-01"><?php echo $output['member_info']['upgrade_name'];?></span>
          <p class="p-01"><?php echo $lang['p_exppoints_explaination_1'];?><em><?php echo $output['member_info']['less_exppoints'];?></em><?php echo $lang['p_exppoints_explaination_2'].$output['member_info']['upgrade_name'];?><?php echo $lang['p_exppoints_explaination_3'];?></p>
        </div>
        <div class="dl-out">
          <dl>
            <dt><a href="#"><?php echo $output['member_info']['member_points']; ?><em><?php echo $lang['p_ubi']; ?></em></a></dt>
            <dd><a href="#">我的U币</a></dd>
          </dl>
          <dl>
            <dt><a href="#"><?php echo $output['vouchercount']; ?><em>张</em></a></dt>
            <dd><a href="#">可用卡券包</a></dd>
          </dl>
          <dl>
            <dt><a href="#"><?php echo $output['pointordercount']; ?><em>个</em></a></dt>
            <dd><a href="#">已兑换礼品</a></dd>
          </dl>
        </div>
        <div class="ncp-memeber-pointcart"> <a href="index.php?act=pointcart" class="btn">礼品兑换购物车<em>1</em></a></div>
      </div>
      <?php } else { ?>
      <div class="login-box">
        <p>获知会员信息详情<br />换取店铺代金券买商品更划算</p>
        <a class="login-a" href="#">立即登录</a>
      </div>
        <?php }?>
    </div>
  </div>

  <div class="bt-box">
    <h3>热门代金券</h3>
    <a class="more" href="#">更多&gt;&gt;</a>
  </div>

  <div class="ul-01-out">
    <ul>
      <li>
        <div class="left">
          <a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/img/img02.gif" /></a>
          <div class="text">
            <span class="sp-01 text-ellipsis"><a href="#">德庄火锅城</a></span>
            <span class="sp-02">（购物满200元可用）</span>
            <span class="sp-03">需350U币</span>
            <span class="sp-04">有效期至2015-11-26</span>
          </div>
        </div>
        <a class="right" href="#">
          <span class="sp-01"><em>￥</em>20</span>
          <span class="sp-02">立即领取</span>
        </a>
      </li>
      <li>
        <div class="left">
          <a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/home/img/img02.gif" /></a>
          <div class="text">
            <span class="sp-01 text-ellipsis"><a href="#">德庄火锅城</a></span>
            <span class="sp-02">（购物满200元可用）</span>
            <span class="sp-03">需350U币</span>
            <span class="sp-04">有效期至2015-11-26</span>
          </div>
        </div>
        <a class="right" href="#">
          <span class="sp-01"><em>￥</em>20</span>
          <span class="sp-02">立即领取</span>
        </a>
      </li>
    </ul>
    <div class="norecord">暂无卡券包</div>
  </div>

  <div class="bt-box">
    <h3>热门礼品</h3>
  </div>


  <ul class="ncp-exchange-list">
    <li>
      <div class="gift-pic"><a href="#" target="_blank"> <img alt="进口奶粉" src="http://uk86.webonn.com/uk86/data/upload/shop/pointprod/05047890466426437_mid.jpg"> </a></div>
      <div class="gift-name"><a title="进口奶粉" target="_blank" href="#">进口奶粉</a></div>
      <div class="exchange-rule">
        <span class="pgoods-grade">V1</span>
        <span class="pgoods-price">价格：<em>¥180.00</em></span> <span class="pgoods-points">积分兑换：<strong>999</strong>积分</span> </div>
    </li>
    <li>
      <div class="gift-pic"><a href="#" target="_blank"> <img alt="八仙花" src="http://uk86.webonn.com/uk86/data/upload/shop/pointprod/04937229991527895_mid.jpg"> </a></div>
      <div class="gift-name"><a title="八仙花" target="_blank" href="#">八仙花</a></div>
      <div class="exchange-rule">
        <span class="pgoods-price">价格：<em>¥123.00</em></span> <span class="pgoods-points">U币兑换：<strong>0</strong>U币</span> </div>
    </li>

    <li>
      <div class="gift-pic"><a href="#" target="_blank"> <img alt="八仙花" src="http://uk86.webonn.com/uk86/data/upload/shop/pointprod/04937229991527895_mid.jpg"> </a></div>
      <div class="gift-name"><a title="八仙花" target="_blank" href="#">八仙花</a></div>
      <div class="exchange-rule">
        <span class="pgoods-price">价格：<em>¥123.00</em></span> <span class="pgoods-points">U币兑换：<strong>0</strong>U币</span> </div>
    </li>
    <li>
      <div class="gift-pic"><a href="#" target="_blank"> <img alt="八仙花" src="http://uk86.webonn.com/uk86/data/upload/shop/pointprod/04937229991527895_mid.jpg"> </a></div>
      <div class="gift-name"><a title="八仙花" target="_blank" href="#">八仙花</a></div>
      <div class="exchange-rule">
        <span class="pgoods-price">价格：<em>¥123.00</em></span> <span class="pgoods-points">U币兑换：<strong>0</strong>U币</span> </div>
    </li>
    <li>
      <div class="gift-pic"><a href="#" target="_blank"> <img alt="八仙花" src="http://uk86.webonn.com/uk86/data/upload/shop/pointprod/04937229991527895_mid.jpg"> </a></div>
      <div class="gift-name"><a title="八仙花" target="_blank" href="#">八仙花</a></div>
      <div class="exchange-rule">
        <span class="pgoods-price">价格：<em>¥123.00</em></span> <span class="pgoods-points">U币兑换：<strong>0</strong>U币</span> </div>
    </li>
    <li>
      <div class="gift-pic"><a href="#" target="_blank"> <img alt="八仙花" src="http://uk86.webonn.com/uk86/data/upload/shop/pointprod/04937229991527895_mid.jpg"> </a></div>
      <div class="gift-name"><a title="八仙花" target="_blank" href="#">八仙花</a></div>
      <div class="exchange-rule">
        <span class="pgoods-price">价格：<em>¥123.00</em></span> <span class="pgoods-points">U币兑换：<strong>0</strong>U币</span> </div>
    </li>
  </ul>

</div>

<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.luara.0.0.1.min.js" id="dialog_js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/home.js" id="dialog_js" charset="utf-8"></script>
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
	});
	
</script>
