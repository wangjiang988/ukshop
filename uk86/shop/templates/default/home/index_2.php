12<?php defined('InUk86') or exit('Access Invalid!');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>
<link href="<?php echo SHOP_TEMPLATES_URL ;?>/css/base_1.css" rel="stylesheet" type="text/css" />
<link href="<?php echo SHOP_TEMPLATES_URL ;?>/css/layout_index.css" rel="stylesheet" type="text/css" />
<link href="<?php echo SHOP_TEMPLATES_URL ;?>/css/home_index.css" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-1.8.3.js"/></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.luara.0.0.1.min.js"/></script>
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


</head>

<body>
	<div class="top-hd">
		<div class="right-box nc-appbar">
			<div class="back-top">
				<a href="#"></a>
			</div>
			<div class="be-center">
				<div class="user-tx">
					<a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/wico_12.gif" /></a>
				</div>
				<div class="nc-appbar-tabs">
					<div class="user-login-box" nctype="barLoginBox" style="display: none;">
						<i class="arrow"></i>
						<a href="javascript:void(0);" class="close" nctype="close-barLoginBox" title="关闭">X</a>
					  <form id="login_form" method="post" action="index.php?act=login&amp;op=login" onsubmit="ajaxpost('login_form', '', '', 'onerror')">
						<input type="hidden" name="formhash" value="VLDqTaJ7RoQv1D5vzSHHnVLz1ooTqlC">        <input type="hidden" name="form_submit" value="ok">
						<input name="nchash" type="hidden" value="8a233a02">
						<dl>
						  <dt><strong>登录名</strong></dt>
						  <dd>
							<input type="text" class="text" tabindex="1" autocomplete="off" name="user_name" autofocus="">
							<label></label>
						  </dd>
						</dl>
						<dl>
						  <dt><strong>登录密码</strong><a href="index.php?act=login&amp;op=forget_password" target="_blank">忘记登录密码？</a></dt>
						  <dd>
							<input tabindex="2" type="password" class="text" name="password" autocomplete="off">
							<label></label>
						  </dd>
						</dl>
								<dl>
						  <dt><strong>验证码</strong><a href="javascript:void(0)" class="ml5" onclick="javascript:document.getElementById('codeimage').src='http://uk86.webonn.com/uk86/shop/index.php?act=seccode&amp;op=makecode&amp;nchash=8a233a02&amp;t=' + Math.random();">更换验证码</a></dt>
						  <dd>
							<input tabindex="3" type="text" name="captcha" autocomplete="off" class="text w130" id="captcha2" maxlength="4" size="10">
							<img src="http://uk86.webonn.com/uk86/shop/index.php?act=seccode&amp;op=makecode&amp;nchash=8a233a02&amp;t=0.145025041885674" name="codeimage" border="0" id="codeimage" class="vt">
							<label></label>
						  </dd>
						</dl>
								<div class="bottom">
						  <input type="submit" class="submit" value="确认">
						  <input type="hidden" value="" name="ref_url">
						  <a href="index.php?act=login&amp;op=register" target="_blank">注册新用户</a> </div>
					  </form>
					</div>
				</div>
		
				<div id="ncToolbar" class="shop-box">
					<a href="#">购物车</a>
					<div id="content-cart" class="content-box">
      <div class="top">
        <h3>我的购物车</h3>
        <a title="隐藏" class="close" href="javascript:void(0);"></a></div>
      <div id="rtoolbar_cartlist">
<ul class="cart-list">
        <li nctpye="cart_item_238">
    <div class="goods-pic"><a ;="" target="_blank" title="" href="#"><img alt="春装 披肩式 超短款 针织 衫开衫 女装 青鸟" src="http://uk86.webonn.com/uk86/data/upload/shop/store/goods/1/1_04418239521122578_60.jpg"></a></div>
    <dl>
      <dt class="goods-name"><a ;="" target="_blank" title="春装 披肩式 超短款 针织 衫开衫 女装 青鸟" href="#">春装 披肩式 超短款 针织 衫开衫 女装 青鸟</a></dt>
      <dd><em class="goods-price">¥88.00</em>×1</dd>
    </dl>
    <a title="删除" class="del" href="javascript:drop_topcart_item(238);">X</a>
  </li>
  		<li nctpye="cart_item_238">
    <div class="goods-pic"><a ;="" target="_blank" title="" href="#"><img alt="春装 披肩式 超短款 针织 衫开衫 女装 青鸟" src="http://uk86.webonn.com/uk86/data/upload/shop/store/goods/1/1_04418239521122578_60.jpg"></a></div>
    <dl>
      <dt class="goods-name"><a ;="" target="_blank" title="春装 披肩式 超短款 针织 衫开衫 女装 青鸟" href="#">春装 披肩式 超短款 针织 衫开衫 女装 青鸟</a></dt>
      <dd><em class="goods-price">¥88.00</em>×1</dd>
    </dl>
    <a title="删除" class="del" href="javascript:drop_topcart_item(238);">X</a>
  </li>
  		<li nctpye="cart_item_238">
    <div class="goods-pic"><a ;="" target="_blank" title="" href="#"><img alt="春装 披肩式 超短款 针织 衫开衫 女装 青鸟" src="http://uk86.webonn.com/uk86/data/upload/shop/store/goods/1/1_04418239521122578_60.jpg"></a></div>
    <dl>
      <dt class="goods-name"><a ;="" target="_blank" title="春装 披肩式 超短款 针织 衫开衫 女装 青鸟" href="#">春装 披肩式 超短款 针织 衫开衫 女装 青鸟</a></dt>
      <dd><em class="goods-price">¥88.00</em>×1</dd>
    </dl>
    <a title="删除" class="del" href="javascript:drop_topcart_item(238);">X</a>
  </li>
  		<li nctpye="cart_item_238">
    <div class="goods-pic"><a ;="" target="_blank" title="" href="#"><img alt="春装 披肩式 超短款 针织 衫开衫 女装 青鸟" src="http://uk86.webonn.com/uk86/data/upload/shop/store/goods/1/1_04418239521122578_60.jpg"></a></div>
    <dl>
      <dt class="goods-name"><a ;="" target="_blank" title="春装 披肩式 超短款 针织 衫开衫 女装 青鸟" href="#">春装 披肩式 超短款 针织 衫开衫 女装 青鸟</a></dt>
      <dd><em class="goods-price">¥88.00</em>×1</dd>
    </dl>
    <a title="删除" class="del" href="javascript:drop_topcart_item(238);">X</a>
  </li>
  		
  		
		
  		
  		
  		
  		
  		
  
  </ul>
<div class="btn-box">
<div class="total-price" nctype="rtoolbar_total_price">共计金额：<em class="goods-price">¥88.00</em></div>
<a onclick="javascript:window.location.href='index.php?act=cart'" href="javascript:void(0);">结算购物车中的商品</a>
</div></div>
    </div>
				</div>
				<div class="ly-box">
					<a href="#"></a>
				</div>
				<div class="sc-box">
					<a href="#" class="a-sc"></a>
					<a href="#" class="wdsc">我的收藏<i></i></a>
				</div>
				<div class="clock-box">
					<a href="#"></a>
				</div>
			</div>					
		</div>
		<div class="top-nav">
			<div class="container">
				<!--<div class="sign-in"><span class="sp-01">您好，欢迎光临优康中国!</span><a href="#">登录</a><a href="#">免费注册</a></div>-->
				<div class="welcome"><span class="sp-01">您好，<?php if(isset($_SESSION['is_login'])&&$_SESSION['is_login']=="1"){?><a href="<?php echo uk86_urlShop('member', 'home');?>"><?php echo $_SESSION['member_name'];?></a><a style="cursor:pointer;" class="nc-grade-mini">V0</a>&nbsp;<?php }?>欢迎光临优康中国!</span>&nbsp;<?php if(isset($_SESSION['is_login'])&&$_SESSION['is_login']=="1"){?><a class="quit" href="index.php?act=login&op=logout">退出</a><?php }else{?>
				  <a href="index.php?act=login&op=index">登录&nbsp;</a><a href="index.php?act=login&op=register">注册</a><?php }?>
				</div>
				<ul class="right">
					<li><a href="<?php echo uk86_urlShop('member', 'home');?>">买家中心</a></li>
					<li><a href="<?php echo SHOP_SITE_URL;?>/index.php?act=member_favorites&op=fglist">我的收藏</a></li>
					<li><a href="#">卖家中心</a></li>
					<!--<li><a href="#">客户服务</a></li>-->
					<li><a href="index.php?act=article&op=article&ac_id=6">客户服务</a></li>
					<li><a href="index.php?act=article&op=article&ac_id=2">帮助中心</a></li>
					<li><a href="shop/index.php?act=article&op=article&ac_id=5">售后服务</a></li>
					<li><a href="shop/index.php?act=article&op=article&ac_id=2">在线客服</a></li>
					<li style="background:none"><a href="shop/index.php?act=article&op=article&ac_id=2">投诉中心</a></li>
				</ul>
			</div>
		</div>
		<div class="news-nav">
			<span class="ico"></span>
			<div class="scrollNews">
				<ul class="gg_ul">
					<li>优康中国新版全新上线，超多实惠等你来享！更有福哥亲自带你买房买车，引爆苏城high购狂潮！</li>
				</ul>
			</div>
			<span class="close"></span>
		</div>
		<div class="head-box clearfix">
			<div class="container">
				<a class="logo" href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/logo.gif" /></a>
				
				<div class="select-mid">
					<div class="m-input-out">
						<input type="text" placeholder="请输入关键词" name="word" class="m-input">
					</div>
					<input type="submit" value="搜&nbsp;索" class="r-input">
	
					<ul class="ul-select">
						<li><a href="#">苏州本地特色</a></li>
						<li><a href="#">年货</a></li>
						<li><a href="#">手机充值</a></li>
						<li><a href="#">瓷器</a></li>
						<li><a href="#">房产</a></li>
						<li><a href="#">汽车</a></li>
						<li><a href="#">免费试用</a></li>
					</ul>
			</div>
				
				<div class="settleup">
					<div class="cw-icon">
						<a href="#" class="buy-a"><em>去购物车</em></a>
						<em class="ci-count">0</em>
					</div>
					<div class="gwc-box">
						<h2>最新加入的商品</h2>
						<div class="gwc-box-main">
							<div class="no-shopping">您的购物车中暂无商品，赶快选择心爱的商品吧！</div>
							<ul class="list">
							<li>
						<span class="img-sp"><a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img01.gif" /></a></span>
						<p class="title"><a href="#">ADIBO艾迪宝男款羽毛球比赛套装A523-04+A390）赠艾迪宝HA-03专业羽毛球袜一双</a></p>
						<p class="operate">
							<span><em>￥98.00</em>x1</span>
							<br>
							<span class="del"><a href="#">删除</a></span>
						</p>
					</li>
							<li>
						<span class="img-sp"><a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img01.gif" /></a></span>
						<p class="title"><a href="#">ADIBO艾迪宝男款羽毛球比赛套装A523-04+A390）赠艾迪宝HA-03专业羽毛球袜一双</a></p>
						<p class="operate">
							<span><em>￥98.00</em>x1</span>
							<br>
							<span class="del"><a href="#">删除</a></span>
						</p>
					</li>
							<li>
						<span class="img-sp"><a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img01.gif" /></a></span>
						<p class="title"><a href="#">ADIBO艾迪宝男款羽毛球比赛套装A523-04+A390）赠艾迪宝HA-03专业羽毛球袜一双</a></p>
						<p class="operate">
							<span><em>￥98.00</em>x1</span>
							<br>
							<span class="del"><a href="#">删除</a></span>
						</p>
					</li>
							<li>
						<span class="img-sp"><a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img01.gif" /></a></span>
						<p class="title"><a href="#">ADIBO艾迪宝男款羽毛球比赛套装A523-04+A390）赠艾迪宝HA-03专业羽毛球袜一双</a></p>
						<p class="operate">
							<span><em>￥98.00</em>x1</span>
							<br>
							<span class="del"><a href="#">删除</a></span>
						</p>
					</li>
							<li>
						<span class="img-sp"><a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img01.gif" /></a></span>
						<p class="title"><a href="#">ADIBO艾迪宝男款羽毛球比赛套装A523-04+A390）赠艾迪宝HA-03专业羽毛球袜一双</a></p>
						<p class="operate">
							<span><em>￥98.00</em>x1</span>
							<br>
							<span class="del"><a href="#">删除</a></span>
						</p>
					</li>
							</ul>
						</div>
						<div class="gwc-box-js">
							<p>共&nbsp;<em class="em-01">4</em>&nbsp;件商品 共计<em class="em-02">￥243.00</em></p>
							<a href="#" class="buy-js">结算购物车中的商品</a>
						</div>
					</div>
				</div>
				
				<div class="mylife">
					<div class="cw-icon">
						<a href="#" class="buy-a"><em>我的享生活</em></a>
					</div>
					<div class="life-box">
							<div class="sub-title">
								<div class="vip-box">bzhang&nbsp;<a href="#" class="nc-grade-mini">V0</a></div>
								<a class="arrow" href="#">我的用户中心&nbsp;&gt;</a>
							</div>
							<div class="user-centent-menu">
							<ul>
							  <li><a href="#">站内消息(<span>1</span>)</a></li>
							  <li><a class="arrow" href="#">我的订单&nbsp;&gt;</a></li>
							  <li><a href="#">咨询回复(<span id="member_consult">0</span>)</a></li>
							  <li><a class="arrow" href="#">我的收藏&nbsp;&gt;</a></li>
							  <li><a href="#">卡券包(<span id="member_voucher">0</span>)</a></li>
							  <li><a class="arrow" href="#">我的U币&nbsp;&gt;</a></li>
							</ul>
			  </div>
			  				<div class="browse-history">
								<div class="part-title">
							 	 <h4>最近浏览的商品</h4>
								  <span style="float:right;"><a href="#">全部浏览历史</a></span>
								</div>
								<ul>
									<li class="goods-thumb"><a target="_blank" href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img02.gif" /></a></li>
									<li class="goods-thumb"><a target="_blank" href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img02.gif" /></a></li>
									<li class="goods-thumb"><a target="_blank" href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img02.gif" /></a></li>
									<li class="goods-thumb"><a target="_blank" href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img02.gif" /></a></li>
									<li class="goods-thumb"><a target="_blank" href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img02.gif" /></a></li>
								</ul>
								<p class="no-info">暂无商品</p>
          					</div>
					</div>
				</div>
			</div>
		</div>
		<div class="container-top">
			<div class="container">
				<div class="all-goods">
					<a href="#" class="link-all">所有商品分类<i></i></a>
					<div class="left-nav">
					<div class="box-1">
						<div class="dl-out">
							<dl class="dl-1 dl-box-all">
								<dt><a href="#">本地生活</a></dt>
								<dd>
									<a href="#">餐饮美食</a>
									<a href="#">小吃零食</a>
									<a href="#">美容美发</a>
									<a href="#">美妆个护</a>
									<a href="#">家居日用</a>
									<a href="#">母婴玩具</a>
									<a href="#">旅游酒店</a>
									<a href="#">电影</a>
									<a href="#">教育培训</a>
									<i></i>
								</dd>
							</dl>		
							<div class="box-1-nav_main">
								<div class="left_shop">
									<dl class="cyms">
										<dt><a href="#">餐饮美食</a></dt>
										<dd>
											<div class="dd-in">
											<a href="#">肉松饼</a>
											<a href="#">巧克力</a>
											<a href="#">麦片</a>
											<a href="#" class="hot-s">车厘子</a>
											<a href="#">酸梅糖</a>
											<a href="#">鸡尾酒</a>
											<a href="#">蜂蜜</a>
											<a href="#" class="hot-s">咖啡</a>
											<a href="#">红酒</a>
											<a href="#">橄榄油</a>
											<a href="#">小龙虾</a>
											<a href="#">薯片</a>
											<a href="#">火腿</a>
											<a href="#" class="hot-s">红枣</a>
											<a href="#">话梅</a>
											<a href="#">松子</a>
											</div>
										</dd>
									</dl>
									<dl class="xcls">
										<dt><a href="#">小吃零食</a></dt>
										<dd>
										<div class="dd-in">
											<a href="#">肉松饼</a>
											<a href="#">巧克力</a>
											<a href="#">麦片</a>
											<a href="#" class="hot-s">车厘子</a>
											<a href="#">酸梅糖</a>
											<a href="#">鸡尾酒</a>
											<a href="#">蜂蜜</a>
											<a href="#" class="hot-s">咖啡</a>
											<a href="#">红酒</a>
											<a href="#">橄榄油</a>
											<a href="#">小龙虾</a>
											<a href="#">薯片</a>
											<a href="#">火腿</a>
											<a href="#" class="hot-s">红枣</a>
											<a href="#">话梅</a>
											<a href="#">松子</a>
											</div>
										</dd>
									</dl>
									<dl class="mrmf">
										<dt><a href="#">美容美发</a></dt>
										<dd>
											<div class="dd-in">
											<a href="#">肉松饼</a>
											<a href="#">巧克力</a>
											<a href="#">麦片</a>
											<a href="#" class="hot-s">车厘子</a>
											<a href="#">酸梅糖</a>
											<a href="#">鸡尾酒</a>
											<a href="#">蜂蜜</a>
											<a href="#" class="hot-s">咖啡</a>
											<a href="#">红酒</a>
											<a href="#">橄榄油</a>
											<a href="#">小龙虾</a>
											<a href="#">薯片</a>
											<a href="#">火腿</a>
											<a href="#" class="hot-s">红枣</a>
											<a href="#">话梅</a>
											<a href="#">松子</a>
											</div>
										</dd>
									</dl>
									<dl class="mzgh">
										<dt><a href="#">美妆个护</a></dt>
										<dd>
										<div class="dd-in">
											<a href="#" class="hot-s">面膜</a>
											<a href="#">洁面</a>
											<a href="#">防晒</a>
											<a href="#">BB霜</a>
											<a href="#">控油</a>
											<a href="#">面霜</a>
											<a href="#">卸妆</a>
											<a href="#">爽肤水</a>
											<a href="#" class="hot-s">眼霜</a>
											<a href="#">乳液</a>
											<a href="#">眼线</a>
											<a href="#">彩妆盘</a>
											<a href="#">身体护理</a>
											<a href="#">粉底液</a>
											<a href="#" class="hot-s">唇膏</a>
											<a href="#">隔离</a>
											</div>
										</dd>
									</dl>
									<dl class="jjry">
										<dt><a href="#">家具日用</a></dt>
										<dd>
											<div class="dd-in">
											<a href="#">肉松饼</a>
											<a href="#">巧克力</a>
											<a href="#">麦片</a>
											<a href="#" class="hot-s">车厘子</a>
											<a href="#">酸梅糖</a>
											<a href="#">鸡尾酒</a>
											<a href="#">蜂蜜</a>
											<a href="#" class="hot-s">咖啡</a>
											<a href="#">红酒</a>
											<a href="#">橄榄油</a>
											<a href="#">小龙虾</a>
											<a href="#">薯片</a>
											<a href="#">火腿</a>
											<a href="#" class="hot-s">红枣</a>
											<a href="#">话梅</a>
											<a href="#">松子</a>
											</div>
										</dd>
									</dl>
									<dl class="mywj">
										<dt><a href="#">母婴玩具</a></dt>
										<dd>
											<div class="dd-in">
											<a href="#">肉松饼</a>
											<a href="#">巧克力</a>
											<a href="#">麦片</a>
											<a href="#" class="hot-s">车厘子</a>
											<a href="#">酸梅糖</a>
											<a href="#">鸡尾酒</a>
											<a href="#">蜂蜜</a>
											<a href="#" class="hot-s">咖啡</a>
											<a href="#">红酒</a>
											<a href="#">橄榄油</a>
											<a href="#">小龙虾</a>
											<a href="#">薯片</a>
											<a href="#">火腿</a>
											<a href="#" class="hot-s">红枣</a>
											<a href="#">话梅</a>
											<a href="#">松子</a>
											</div>
										</dd>
									</dl>
									<dl class="lyjd">
										<dt><a href="#">旅游酒店</a></dt>
										<dd>
											<div class="dd-in">
											<a href="#">面膜</a>
											<a href="#" class="hot-s">洁面</a>
											<a href="#">防晒</a>
											<a href="#">BB霜</a>
											<a href="#">控油</a>
											<a href="#">面霜</a>
											<a href="#">卸妆</a>
											<a href="#">爽肤水</a>
											<a href="#">眼霜</a>
											<a href="#">乳液</a>
											<a href="#">眼线</a>
											<a href="#">彩妆盘</a>
											<a href="#">身体护理</a>
											<a href="#">粉底液</a>
											<a href="#" class="hot-s">唇膏</a>
											<a href="#">隔离</a>
											</div>
										</dd>
									</dl>
									<dl class="dy">
										<dt><a href="#">电影</a></dt>
										<dd>
											<div class="dd-in">
											<a href="#">肉松饼</a>
											<a href="#">巧克力</a>
											<a href="#">麦片</a>
											<a href="#" class="hot-s">车厘子</a>
											<a href="#">酸梅糖</a>
											<a href="#">鸡尾酒</a>
											<a href="#">蜂蜜</a>
											<a href="#" class="hot-s">咖啡</a>
											<a href="#">红酒</a>
											<a href="#">橄榄油</a>
											<a href="#">小龙虾</a>
											<a href="#">薯片</a>
											<a href="#">火腿</a>
											<a href="#" class="hot-s">红枣</a>
											<a href="#">话梅</a>
											<a href="#">松子</a>
											</div>
										</dd>
									</dl>
									<dl class="jypx">
										<dt><a href="#">教育培训</a></dt>
										<dd>
											<div class="dd-in">
											<a href="#">肉松饼</a>
											<a href="#">巧克力</a>
											<a href="#">麦片</a>
											<a href="#" class="hot-s">车厘子</a>
											<a href="#">酸梅糖</a>
											<a href="#">鸡尾酒</a>
											<a href="#">蜂蜜</a>
											<a href="#" class="hot-s">咖啡</a>
											<a href="#">红酒</a>
											<a href="#">橄榄油</a>
											<a href="#">小龙虾</a>
											<a href="#">薯片</a>
											<a href="#">火腿</a>
											<a href="#" class="hot-s">红枣</a>
											<a href="#">话梅</a>
											<a href="#">松子</a>
											</div>
										</dd>
									</dl>
								</div>
								<div class="right-gg">
									<a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img_03.gif" /></a>
									<a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img_04.gif" /></a>
									<a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img_05.gif" /></a>
									<a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img_06.gif" /></a>
								</div>
							</div>
						</div>
						<div class="dl-out-second">
							<div class="dl-out">
								<dl class="dl-2 dl-box-all">
									<dt><a href="#">特色购物</a></dt>
									<dd>
										<a href="#">餐饮美食</a>
										<a href="#">小吃零食</a>
										<a href="#">美容美发</a>
										<a href="#">美妆个护</a>
										<a href="#">家居日用</a>
										<a href="#">母婴玩具</a>
										<a href="#">旅游酒店</a>
										<a href="#">电影</a>
										<a href="#">教育培训</a>
										<i></i>
									</dd>
								</dl>
								<div class="box-1-nav_main">
									<div class="left_shop">
										<dl class="cyms">
											<dt><a href="#">餐饮美食</a></dt>
											<dd>
												<div class="dd-in">
												<a href="#">肉松饼</a>
												<a href="#">巧克力</a>
												<a href="#">麦片</a>
												<a href="#" class="hot-s">车厘子</a>
												<a href="#">酸梅糖</a>
												<a href="#">鸡尾酒</a>
												<a href="#">蜂蜜</a>
												<a href="#" class="hot-s">咖啡</a>
												<a href="#">红酒</a>
												<a href="#">橄榄油</a>
												<a href="#">小龙虾</a>
												<a href="#">薯片</a>
												<a href="#">火腿</a>
												<a href="#" class="hot-s">红枣</a>
												<a href="#">话梅</a>
												<a href="#">松子</a>
												</div>
											</dd>
										</dl>
										<dl class="xcls">
											<dt><a href="#">小吃零食</a></dt>
											<dd>
											<div class="dd-in">
												<a href="#">肉松饼</a>
												<a href="#">巧克力</a>
												<a href="#">麦片</a>
												<a href="#" class="hot-s">车厘子</a>
												<a href="#">酸梅糖</a>
												<a href="#">鸡尾酒</a>
												<a href="#">蜂蜜</a>
												<a href="#" class="hot-s">咖啡</a>
												<a href="#">红酒</a>
												<a href="#">橄榄油</a>
												<a href="#">小龙虾</a>
												<a href="#">薯片</a>
												<a href="#">火腿</a>
												<a href="#" class="hot-s">红枣</a>
												<a href="#">话梅</a>
												<a href="#">松子</a>
												</div>
											</dd>
										</dl>
										<dl class="mrmf">
											<dt><a href="#">美容美发</a></dt>
											<dd>
												<div class="dd-in">
												<a href="#">肉松饼</a>
												<a href="#">巧克力</a>
												<a href="#">麦片</a>
												<a href="#" class="hot-s">车厘子</a>
												<a href="#">酸梅糖</a>
												<a href="#">鸡尾酒</a>
												<a href="#">蜂蜜</a>
												<a href="#" class="hot-s">咖啡</a>
												<a href="#">红酒</a>
												<a href="#">橄榄油</a>
												<a href="#">小龙虾</a>
												<a href="#">薯片</a>
												<a href="#">火腿</a>
												<a href="#" class="hot-s">红枣</a>
												<a href="#">话梅</a>
												<a href="#">松子</a>
												</div>
											</dd>
										</dl>
										<dl class="mzgh">
											<dt><a href="#">美妆个护</a></dt>
											<dd>
											<div class="dd-in">
												<a href="#" class="hot-s">面膜</a>
												<a href="#">洁面</a>
												<a href="#">防晒</a>
												<a href="#">BB霜</a>
												<a href="#">控油</a>
												<a href="#">面霜</a>
												<a href="#">卸妆</a>
												<a href="#">爽肤水</a>
												<a href="#" class="hot-s">眼霜</a>
												<a href="#">乳液</a>
												<a href="#">眼线</a>
												<a href="#">彩妆盘</a>
												<a href="#">身体护理</a>
												<a href="#">粉底液</a>
												<a href="#" class="hot-s">唇膏</a>
												<a href="#">隔离</a>
												</div>
											</dd>
										</dl>
										<dl class="jjry">
											<dt><a href="#">家具日用</a></dt>
											<dd>
												<div class="dd-in">
												<a href="#">肉松饼</a>
												<a href="#">巧克力</a>
												<a href="#">麦片</a>
												<a href="#" class="hot-s">车厘子</a>
												<a href="#">酸梅糖</a>
												<a href="#">鸡尾酒</a>
												<a href="#">蜂蜜</a>
												<a href="#" class="hot-s">咖啡</a>
												<a href="#">红酒</a>
												<a href="#">橄榄油</a>
												<a href="#">小龙虾</a>
												<a href="#">薯片</a>
												<a href="#">火腿</a>
												<a href="#" class="hot-s">红枣</a>
												<a href="#">话梅</a>
												<a href="#">松子</a>
												</div>
											</dd>
										</dl>
										<dl class="mywj">
											<dt><a href="#">母婴玩具</a></dt>
											<dd>
												<div class="dd-in">
												<a href="#">肉松饼</a>
												<a href="#">巧克力</a>
												<a href="#">麦片</a>
												<a href="#" class="hot-s">车厘子</a>
												<a href="#">酸梅糖</a>
												<a href="#">鸡尾酒</a>
												<a href="#">蜂蜜</a>
												<a href="#" class="hot-s">咖啡</a>
												<a href="#">红酒</a>
												<a href="#">橄榄油</a>
												<a href="#">小龙虾</a>
												<a href="#">薯片</a>
												<a href="#">火腿</a>
												<a href="#" class="hot-s">红枣</a>
												<a href="#">话梅</a>
												<a href="#">松子</a>
												</div>
											</dd>
										</dl>
									</div>
									<div class="right-gg">
										<a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img_03.gif" /></a>
										<a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img_04.gif" /></a>
										<a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img_05.gif" /></a>
										<a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img_06.gif" /></a>
									</div>
								</div>
							</div>
							<div class="dl-out dl-out-none">
								<dl class="dl-1 dl-box-all">
									<dt><a href="#">本地生活</a></dt>
									<dd>
										<a href="#">餐饮美食</a>
										<a href="#">小吃零食</a>
										<a href="#">美容美发</a>
										<a href="#">美妆个护</a>
										<a href="#">家居日用</a>
										<a href="#">母婴玩具</a>
										<a href="#">旅游酒店</a>
										<a href="#">电影</a>
										<a href="#">教育培训</a>
										<i></i>
									</dd>
								</dl>		
								<div class="box-1-nav_main">
									<div class="left_shop">
										<dl class="cyms">
											<dt><a href="#">餐饮美食</a></dt>
											<dd>
												<div class="dd-in">
												<a href="#">肉松饼</a>
												<a href="#">巧克力</a>
												<a href="#">麦片</a>
												<a href="#" class="hot-s">车厘子</a>
												<a href="#">酸梅糖</a>
												<a href="#">鸡尾酒</a>
												<a href="#">蜂蜜</a>
												<a href="#" class="hot-s">咖啡</a>
												<a href="#">红酒</a>
												<a href="#">橄榄油</a>
												<a href="#">小龙虾</a>
												<a href="#">薯片</a>
												<a href="#">火腿</a>
												<a href="#" class="hot-s">红枣</a>
												<a href="#">话梅</a>
												<a href="#">松子</a>
												</div>
											</dd>
										</dl>
										<dl class="xcls">
											<dt><a href="#">小吃零食</a></dt>
											<dd>
											<div class="dd-in">
												<a href="#">肉松饼</a>
												<a href="#">巧克力</a>
												<a href="#">麦片</a>
												<a href="#" class="hot-s">车厘子</a>
												<a href="#">酸梅糖</a>
												<a href="#">鸡尾酒</a>
												<a href="#">蜂蜜</a>
												<a href="#" class="hot-s">咖啡</a>
												<a href="#">红酒</a>
												<a href="#">橄榄油</a>
												<a href="#">小龙虾</a>
												<a href="#">薯片</a>
												<a href="#">火腿</a>
												<a href="#" class="hot-s">红枣</a>
												<a href="#">话梅</a>
												<a href="#">松子</a>
												</div>
											</dd>
										</dl>
										<dl class="mrmf">
											<dt><a href="#">美容美发</a></dt>
											<dd>
												<div class="dd-in">
												<a href="#">肉松饼</a>
												<a href="#">巧克力</a>
												<a href="#">麦片</a>
												<a href="#" class="hot-s">车厘子</a>
												<a href="#">酸梅糖</a>
												<a href="#">鸡尾酒</a>
												<a href="#">蜂蜜</a>
												<a href="#" class="hot-s">咖啡</a>
												<a href="#">红酒</a>
												<a href="#">橄榄油</a>
												<a href="#">小龙虾</a>
												<a href="#">薯片</a>
												<a href="#">火腿</a>
												<a href="#" class="hot-s">红枣</a>
												<a href="#">话梅</a>
												<a href="#">松子</a>
												</div>
											</dd>
										</dl>
										<dl class="mzgh">
											<dt><a href="#">美妆个护</a></dt>
											<dd>
											<div class="dd-in">
												<a href="#" class="hot-s">面膜</a>
												<a href="#">洁面</a>
												<a href="#">防晒</a>
												<a href="#">BB霜</a>
												<a href="#">控油</a>
												<a href="#">面霜</a>
												<a href="#">卸妆</a>
												<a href="#">爽肤水</a>
												<a href="#" class="hot-s">眼霜</a>
												<a href="#">乳液</a>
												<a href="#">眼线</a>
												<a href="#">彩妆盘</a>
												<a href="#">身体护理</a>
												<a href="#">粉底液</a>
												<a href="#" class="hot-s">唇膏</a>
												<a href="#">隔离</a>
												</div>
											</dd>
										</dl>
										<dl class="jjry">
											<dt><a href="#">家具日用</a></dt>
											<dd>
												<div class="dd-in">
												<a href="#">肉松饼</a>
												<a href="#">巧克力</a>
												<a href="#">麦片</a>
												<a href="#" class="hot-s">车厘子</a>
												<a href="#">酸梅糖</a>
												<a href="#">鸡尾酒</a>
												<a href="#">蜂蜜</a>
												<a href="#" class="hot-s">咖啡</a>
												<a href="#">红酒</a>
												<a href="#">橄榄油</a>
												<a href="#">小龙虾</a>
												<a href="#">薯片</a>
												<a href="#">火腿</a>
												<a href="#" class="hot-s">红枣</a>
												<a href="#">话梅</a>
												<a href="#">松子</a>
												</div>
											</dd>
										</dl>
										<dl class="mywj">
											<dt><a href="#">母婴玩具</a></dt>
											<dd>
												<div class="dd-in">
												<a href="#">肉松饼</a>
												<a href="#">巧克力</a>
												<a href="#">麦片</a>
												<a href="#" class="hot-s">车厘子</a>
												<a href="#">酸梅糖</a>
												<a href="#">鸡尾酒</a>
												<a href="#">蜂蜜</a>
												<a href="#" class="hot-s">咖啡</a>
												<a href="#">红酒</a>
												<a href="#">橄榄油</a>
												<a href="#">小龙虾</a>
												<a href="#">薯片</a>
												<a href="#">火腿</a>
												<a href="#" class="hot-s">红枣</a>
												<a href="#">话梅</a>
												<a href="#">松子</a>
												</div>
											</dd>
										</dl>
										<dl class="lyjd">
											<dt><a href="#">旅游酒店</a></dt>
											<dd>
												<div class="dd-in">
												<a href="#">面膜</a>
												<a href="#" class="hot-s">洁面</a>
												<a href="#">防晒</a>
												<a href="#">BB霜</a>
												<a href="#">控油</a>
												<a href="#">面霜</a>
												<a href="#">卸妆</a>
												<a href="#">爽肤水</a>
												<a href="#">眼霜</a>
												<a href="#">乳液</a>
												<a href="#">眼线</a>
												<a href="#">彩妆盘</a>
												<a href="#">身体护理</a>
												<a href="#">粉底液</a>
												<a href="#" class="hot-s">唇膏</a>
												<a href="#">隔离</a>
												</div>
											</dd>
										</dl>
										<dl class="dy">
											<dt><a href="#">电影</a></dt>
											<dd>
												<div class="dd-in">
												<a href="#">肉松饼</a>
												<a href="#">巧克力</a>
												<a href="#">麦片</a>
												<a href="#" class="hot-s">车厘子</a>
												<a href="#">酸梅糖</a>
												<a href="#">鸡尾酒</a>
												<a href="#">蜂蜜</a>
												<a href="#" class="hot-s">咖啡</a>
												<a href="#">红酒</a>
												<a href="#">橄榄油</a>
												<a href="#">小龙虾</a>
												<a href="#">薯片</a>
												<a href="#">火腿</a>
												<a href="#" class="hot-s">红枣</a>
												<a href="#">话梅</a>
												<a href="#">松子</a>
												</div>
											</dd>
										</dl>
										<dl class="jypx">
											<dt><a href="#">教育培训</a></dt>
											<dd>
												<div class="dd-in">
												<a href="#">肉松饼</a>
												<a href="#">巧克力</a>
												<a href="#">麦片</a>
												<a href="#" class="hot-s">车厘子</a>
												<a href="#">酸梅糖</a>
												<a href="#">鸡尾酒</a>
												<a href="#">蜂蜜</a>
												<a href="#" class="hot-s">咖啡</a>
												<a href="#">红酒</a>
												<a href="#">橄榄油</a>
												<a href="#">小龙虾</a>
												<a href="#">薯片</a>
												<a href="#">火腿</a>
												<a href="#" class="hot-s">红枣</a>
												<a href="#">话梅</a>
												<a href="#">松子</a>
												</div>
											</dd>
										</dl>
									</div>
									<div class="right-gg">
										<a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img_03.gif" /></a>
										<a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img_04.gif" /></a>
										<a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img_05.gif" /></a>
										<a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img_06.gif" /></a>
									</div>
								</div>
							</div>
							<div class="dl-out dl-out-none">
								<dl class="dl-1 dl-box-all">
									<dt><a href="#">本地生活</a></dt>
									<dd>
										<a href="#">餐饮美食</a>
										<a href="#">小吃零食</a>
										<a href="#">美容美发</a>
										<a href="#">美妆个护</a>
										<a href="#">家居日用</a>
										<a href="#">母婴玩具</a>
										<a href="#">旅游酒店</a>
										<a href="#">电影</a>
										<a href="#">教育培训</a>
										<i></i>
									</dd>
								</dl>		
								<div class="box-1-nav_main">
									<div class="left_shop">
										<dl class="cyms">
											<dt><a href="#">餐饮美食</a></dt>
											<dd>
												<div class="dd-in">
												<a href="#">肉松饼</a>
												<a href="#">巧克力</a>
												<a href="#">麦片</a>
												<a href="#" class="hot-s">车厘子</a>
												<a href="#">酸梅糖</a>
												<a href="#">鸡尾酒</a>
												<a href="#">蜂蜜</a>
												<a href="#" class="hot-s">咖啡</a>
												<a href="#">红酒</a>
												<a href="#">橄榄油</a>
												<a href="#">小龙虾</a>
												<a href="#">薯片</a>
												<a href="#">火腿</a>
												<a href="#" class="hot-s">红枣</a>
												<a href="#">话梅</a>
												<a href="#">松子</a>
												</div>
											</dd>
										</dl>
										<dl class="xcls">
											<dt><a href="#">小吃零食</a></dt>
											<dd>
											<div class="dd-in">
												<a href="#">肉松饼</a>
												<a href="#">巧克力</a>
												<a href="#">麦片</a>
												<a href="#" class="hot-s">车厘子</a>
												<a href="#">酸梅糖</a>
												<a href="#">鸡尾酒</a>
												<a href="#">蜂蜜</a>
												<a href="#" class="hot-s">咖啡</a>
												<a href="#">红酒</a>
												<a href="#">橄榄油</a>
												<a href="#">小龙虾</a>
												<a href="#">薯片</a>
												<a href="#">火腿</a>
												<a href="#" class="hot-s">红枣</a>
												<a href="#">话梅</a>
												<a href="#">松子</a>
												</div>
											</dd>
										</dl>
										<dl class="mrmf">
											<dt><a href="#">美容美发</a></dt>
											<dd>
												<div class="dd-in">
												<a href="#">肉松饼</a>
												<a href="#">巧克力</a>
												<a href="#">麦片</a>
												<a href="#" class="hot-s">车厘子</a>
												<a href="#">酸梅糖</a>
												<a href="#">鸡尾酒</a>
												<a href="#">蜂蜜</a>
												<a href="#" class="hot-s">咖啡</a>
												<a href="#">红酒</a>
												<a href="#">橄榄油</a>
												<a href="#">小龙虾</a>
												<a href="#">薯片</a>
												<a href="#">火腿</a>
												<a href="#" class="hot-s">红枣</a>
												<a href="#">话梅</a>
												<a href="#">松子</a>
												</div>
											</dd>
										</dl>
										<dl class="mzgh">
											<dt><a href="#">美妆个护</a></dt>
											<dd>
											<div class="dd-in">
												<a href="#" class="hot-s">面膜</a>
												<a href="#">洁面</a>
												<a href="#">防晒</a>
												<a href="#">BB霜</a>
												<a href="#">控油</a>
												<a href="#">面霜</a>
												<a href="#">卸妆</a>
												<a href="#">爽肤水</a>
												<a href="#" class="hot-s">眼霜</a>
												<a href="#">乳液</a>
												<a href="#">眼线</a>
												<a href="#">彩妆盘</a>
												<a href="#">身体护理</a>
												<a href="#">粉底液</a>
												<a href="#" class="hot-s">唇膏</a>
												<a href="#">隔离</a>
												</div>
											</dd>
										</dl>
										<dl class="jjry">
											<dt><a href="#">家具日用</a></dt>
											<dd>
												<div class="dd-in">
												<a href="#">肉松饼</a>
												<a href="#">巧克力</a>
												<a href="#">麦片</a>
												<a href="#" class="hot-s">车厘子</a>
												<a href="#">酸梅糖</a>
												<a href="#">鸡尾酒</a>
												<a href="#">蜂蜜</a>
												<a href="#" class="hot-s">咖啡</a>
												<a href="#">红酒</a>
												<a href="#">橄榄油</a>
												<a href="#">小龙虾</a>
												<a href="#">薯片</a>
												<a href="#">火腿</a>
												<a href="#" class="hot-s">红枣</a>
												<a href="#">话梅</a>
												<a href="#">松子</a>
												</div>
											</dd>
										</dl>
										<dl class="mywj">
											<dt><a href="#">母婴玩具</a></dt>
											<dd>
												<div class="dd-in">
												<a href="#">肉松饼</a>
												<a href="#">巧克力</a>
												<a href="#">麦片</a>
												<a href="#" class="hot-s">车厘子</a>
												<a href="#">酸梅糖</a>
												<a href="#">鸡尾酒</a>
												<a href="#">蜂蜜</a>
												<a href="#" class="hot-s">咖啡</a>
												<a href="#">红酒</a>
												<a href="#">橄榄油</a>
												<a href="#">小龙虾</a>
												<a href="#">薯片</a>
												<a href="#">火腿</a>
												<a href="#" class="hot-s">红枣</a>
												<a href="#">话梅</a>
												<a href="#">松子</a>
												</div>
											</dd>
										</dl>
										<dl class="lyjd">
											<dt><a href="#">旅游酒店</a></dt>
											<dd>
												<div class="dd-in">
												<a href="#">面膜</a>
												<a href="#" class="hot-s">洁面</a>
												<a href="#">防晒</a>
												<a href="#">BB霜</a>
												<a href="#">控油</a>
												<a href="#">面霜</a>
												<a href="#">卸妆</a>
												<a href="#">爽肤水</a>
												<a href="#">眼霜</a>
												<a href="#">乳液</a>
												<a href="#">眼线</a>
												<a href="#">彩妆盘</a>
												<a href="#">身体护理</a>
												<a href="#">粉底液</a>
												<a href="#" class="hot-s">唇膏</a>
												<a href="#">隔离</a>
												</div>
											</dd>
										</dl>
										<dl class="dy">
											<dt><a href="#">电影</a></dt>
											<dd>
												<div class="dd-in">
												<a href="#">肉松饼</a>
												<a href="#">巧克力</a>
												<a href="#">麦片</a>
												<a href="#" class="hot-s">车厘子</a>
												<a href="#">酸梅糖</a>
												<a href="#">鸡尾酒</a>
												<a href="#">蜂蜜</a>
												<a href="#" class="hot-s">咖啡</a>
												<a href="#">红酒</a>
												<a href="#">橄榄油</a>
												<a href="#">小龙虾</a>
												<a href="#">薯片</a>
												<a href="#">火腿</a>
												<a href="#" class="hot-s">红枣</a>
												<a href="#">话梅</a>
												<a href="#">松子</a>
												</div>
											</dd>
										</dl>
										<dl class="jypx">
											<dt><a href="#">教育培训</a></dt>
											<dd>
												<div class="dd-in">
												<a href="#">肉松饼</a>
												<a href="#">巧克力</a>
												<a href="#">麦片</a>
												<a href="#" class="hot-s">车厘子</a>
												<a href="#">酸梅糖</a>
												<a href="#">鸡尾酒</a>
												<a href="#">蜂蜜</a>
												<a href="#" class="hot-s">咖啡</a>
												<a href="#">红酒</a>
												<a href="#">橄榄油</a>
												<a href="#">小龙虾</a>
												<a href="#">薯片</a>
												<a href="#">火腿</a>
												<a href="#" class="hot-s">红枣</a>
												<a href="#">话梅</a>
												<a href="#">松子</a>
												</div>
											</dd>
										</dl>
									</div>
									<div class="right-gg">
										<a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img_03.gif" /></a>
										<a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img_04.gif" /></a>
										<a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img_05.gif" /></a>
										<a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img_06.gif" /></a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<a href="#" class="box-2">
						<b>360°全景展示</b>
						<span>开启体验之旅>></span>
					</a>
				</div>
				</div>
				<div class="goods-nav">
					<ul>
						<li><a class="hot-a" href="#">首页</a></li>
						<li><a class="hot-a" href="#">抢购</a></li>
						<li><a class="hot-a" href="#">微圈</a></li>
						<li><a href="#">品牌</a></li>
						<li><a href="#">店铺</a></li>
						<li><a href="#">专题</a></li>
						<li><a href="#">咨询</a></li>
						<li><a href="#">F码</a></li>
					</ul>
					<div class="wx">
						<img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/mall-41.gif" />
						<p class="p-01">关注微信优点微福公众账号</p>
						<p class="p-02">有惊喜哦！</p>
						<span class="close"></span>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="container">
	
		<div class="part-nav">
			
			<div class="center">
				 <div class="example">
					<ul>
						<li><a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img_01.jpg" alt="1"/></a></li>
						<li><a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img_01.jpg" alt="1"/></a></li>
						<li><a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img_01.jpg" alt="1"/></a></li>
						<li><a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img_01.jpg" alt="1"/></a></li>
					</ul>
					<ol>
						<li></li>
						<li></li>
						<li></li>
						<li></li>
					</ol>
				</div>
				<script>
				$(function(){
					<!--调用Luara示例-->
					$(".example").luara({width:"750",height:"400",interval:4000,selected:"seleted"});
			
				});
				</script>

			</div>
			<div class="right">
				<div class="box-3">
					<dl>
						<dt>福友专享</dt>
						<dd>
							<a href="<?php echo uk86_urlCircle();?>" class="a1"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/ico_wq.png" /></a>
							<a href="<?php echo uk86_urlCircle();?>" class="a2">微&nbsp;圈</a>
						</dd>
						<dd>
							<a href="<?php echo uk86_urlShop('pointshop',"index");?>" class="a1"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/ico_ub.png" /></a>
							<a href="<?php echo uk86_urlShop('pointshop',"index");?>" class="a2">U币中心</a>
						</dd>
						<dd>
							<a href="<?php echo uk86_urlShop('show_joinin', 'index');?>" class="a1"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/ico_sjrz.png" /></a>
							<a href="<?php echo uk86_urlShop('show_joinin', 'index');?>" class="a2">商家入驻</a>
						</dd>
					</dl>
				</div>
				<div class="box-4">
					<h2>最新资讯</h2>
					<div class="div-link">
						<a href="#" class="link-img_02"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img_02.jpg" /></a>
					</div>
					<ul class="news-list">
					<?php if(!empty($output['cms_list']) && is_array($output['cms_list'])) { ?>
					  <?php foreach($output['cms_list'] as $val) { ?>
					    <li class="text-ellipsis"><a target="_blank" href="<?php echo  uk86_urlCMS('article', 'article_detail',array('article_id'=> $val['article_id'])) ;?>" title="<?php echo $val['article_title']; ?>"><?php echo uk86_str_cut($val['article_title'],36);?> </a>
					    </li>
					  <?php } ?>
					<?php } ?>
					</ul>
				</div>
			</div>
		</div>
		
		<div class="part-01">
			<div class="left-ad"><a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/mall-10.gif" /></a></div>
			<ul class="mid-list">
				<li>
					<a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img01.gif" /></a>
					<span class="name text-ellipsis"><a href="#">我爱豆米浆手提礼盒装</a></span>
					<span class="price">
						<em>￥118</em>
						<del>￥128</del>
					</span>
				</li>
				<li>
					<a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img01.gif" /></a>
					<span class="name text-ellipsis"><a href="#">楼兰丝路新疆红枣若羌灰枣</a></span>
					<span class="price">
						<em>￥118</em>
						<del>￥128</del>
					</span>
				</li>
				<li>
					<a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img01.gif" /></a>
					<span class="name text-ellipsis"><a href="#">楼兰丝路新疆红枣若羌灰枣楼兰丝路新疆红枣若羌灰枣</a></span>
					<span class="price">
						<em>￥118</em>
						<del>￥128</del>
					</span>
				</li>
				<li>
					<a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img01.gif" /></a>
					<span class="name text-ellipsis"><a href="#">我爱豆米浆手提礼盒装</a></span>
					<span class="price">
						<em>￥118</em>
						<del>￥128</del>
					</span>
				</li>
				<li>
					<a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img01.gif" /></a>
					<span class="name text-ellipsis"><a href="#">我爱豆米浆手提礼盒装</a></span>
					<span class="price">
						<em>￥118</em>
						<del>￥128</del>
					</span>
				</li>
				<li>
					<a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img01.gif" /></a>
					<span class="name text-ellipsis"><a href="#">我爱豆米浆手提礼盒装</a></span>
					<span class="price">
						<em>￥118</em>
						<del>￥128</del>
					</span>
				</li>
				<li>
					<a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img01.gif" /></a>
					<span class="name text-ellipsis"><a href="#">我爱豆米浆手提礼盒装</a></span>
					<span class="price">
						<em>￥118</em>
						<del>￥128</del>
					</span>
				</li>
				<li>
					<a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img01.gif" /></a>
					<span class="name text-ellipsis"><a href="#">我爱豆米浆手提礼盒装</a></span>
					<span class="price">
						<em>￥118</em>
						<del>￥128</del>
					</span>
				</li>
			</ul>
			<ul class="right-go">
				<li><a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/mall-11.gif" /></a></li>
				<li><a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/mall-12.gif" /></a></li>
				<li><a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/mall-13.gif" /></a></li>
			</ul>
		</div>	
		<div class="hot-ad"><a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/mall-14.gif" /></a></div>	
		<div class="part-02">
			<div class="theme-title">
				<div class="theme-main-title">本地生活</div>
				<div class="text">
					<h5 class="theme-sub-title">Local Life</h5>
					<span class="ico"></span>
				</div>
			</div>
			
			<div class="out-pt">
				<div class="left-list">
					<dl>
						<dt>餐饮美食</dt>
						<dd><a href="#">中餐</a><a href="#">西餐</a><a href="#">自助餐</a><a href="#">火锅</a><a href="#">面包甜点</a><a href="#">特色小吃</a><a href="#">韩国料理</a></dd>
					</dl>
					<dl>
						<dt>生活百货</dt>
						<dd><a href="#">母婴玩具</a><a href="#">服饰鞋包</a><a href="#">美妆个护</a><a href="#">家居日用</a></dd>
					</dl>
					<dl>
						<dt>娱乐服务</dt>
						<dd><a href="#">美发</a><a href="#">美容/SPA</a><a href="#">KTV</a><a href="#">酒店</a><a href="#">看电影</a><a href="#">景点/郊游</a><a href="#">教育培训</a></dd>
					</dl>
					<a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/mall-16.gif" /></a>
				</div>
				
				
				<div class="mid-ad">
					<div class="example2">
						<ul>
							<li><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/mall-17.gif" alt="1"/></li>
							<li><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/mall-17.gif" alt="2"/></li>
							<li><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/mall-17.gif" alt="3"/></li>
							<li><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/mall-17.gif" alt="4"/></li>
						</ul>
						<ol>
							<li></li>
							<li></li>
							<li></li>
							<li></li>
						</ol>
					</div>
					<script>
						$(function(){
							<!--调用Luara示例-->
							$(".example2").luara({width:"312",height:"360",interval:4000,selected:"seleted",deriction:"left"});
				
						});
					</script>
				</div>
				
				<div class="right-list">
					<div class="l-p">
						<div class="pt">
							<a href="#">
								<h4>自营五月花</h4>
								<p>制品第二件五折</p>
								<img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/mall-18.gif" />
							</a>
						</div>
						<div class="pt">
							<a href="#">
								<h4>自营五月花</h4>
								<p>32.9元包邮 前140明返20</p>
								<img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/mall-19.gif" />
							</a>
						</div>
					</div>
					<div class="m-p">
						<div class="pt">
							<a href="#">
								<h4>通车通床</h4>
								<p>质量可靠 妈妈放心</p>
								<img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/mall-20.gif" />
							</a>
						</div>
					</div>
					<div class="l-p">
						<div class="pt">
							<a href="#">
								<h4>自营五月花</h4>
								<p>制品第二件五折</p>
								<img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/mall-18.gif" />
							</a>
						</div>
						<div class="pt">
							<a href="#">
								<h4>自营五月花</h4>
								<p>32.9元包邮 前140明返20</p>
								<img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/mall-19.gif" />
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>		
				
		<div class="part-03">
			<div class="theme-title">
				<div class="theme-main-title">特色购物</div>
				<div class="text">
					<h5 class="theme-sub-title">Characteristic Shopping</h5>
					<span class="ico"></span>
				</div>
			</div>
			<div class="out-pt">
				<div class="left-list">
					<ul class="list-01">
						<li><a href="#">食品饮料</a></li>
						<li><a href="#">美容洗护</a></li>
						<li><a href="#">服饰鞋包</a></li>
						<li><a href="#">母婴玩具</a></li>
						<li><a href="#">数码家电</a></li>
						<li><a href="#">家居百货</a></li>
					</ul>
					<div class="pt">
							<a href="#">
								<h4>自营五月花大冲锋</h4>
								<p>制品第二件五折</p>
								<img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/mall-22.gif">
							</a>
						</div>
					<h5>热门品牌</h5>	
					<ul class="list-02">
						<li><a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/mall-23.gif" /></a></li>
						<li><a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/mall-23.gif" /></a></li>
						<li><a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/mall-23.gif" /></a></li>
						<li><a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/mall-23.gif" /></a></li>
						<li><a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/mall-23.gif" /></a></li>
						<li><a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/mall-23.gif" /></a></li>
					</ul>
				</div>
				<div class="right-list">
					<ul>
						<li>
							<a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/mall-24.gif" /></a>
							<span class="name text-ellipsis"><a href="#">2015春茶一级碧螺春 绿茶</a></span>
						</li>
						<li>
							<a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/mall-24.gif" /></a>
							<span class="name text-ellipsis"><a href="#">2015春茶一级碧螺春 绿茶</a></span>
						</li>
						<li>
							<a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/mall-24.gif" /></a>
							<span class="name text-ellipsis"><a href="#">2015春茶一级碧螺春 绿茶</a></span>
						</li>
						<li>
							<a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/mall-24.gif" /></a>
							<span class="name text-ellipsis"><a href="#">2015春茶一级碧螺春 绿茶</a></span>
						</li>
						<li>
							<a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/mall-24.gif" /></a>
							<span class="name text-ellipsis"><a href="#">2015春茶一级碧螺春 绿茶</a></span>
						</li>
						<li>
							<a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/mall-24.gif" /></a>
							<span class="name text-ellipsis"><a href="#">2015春茶一级碧螺春 绿茶</a></span>
						</li>
						<li>
							<a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/mall-24.gif" /></a>
							<span class="name text-ellipsis"><a href="#">2015春茶一级碧螺春 绿茶</a></span>
						</li>
						<li>
							<a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/mall-24.gif" /></a>
							<span class="name text-ellipsis"><a href="#">2015春茶一级碧螺春 绿茶</a></span>
						</li>
						<li>
							<a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/mall-24.gif" /></a>
							<span class="name text-ellipsis"><a href="#">2015春茶一级碧螺春 绿茶</a></span>
						</li>
						<li>
							<a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/mall-24.gif" /></a>
							<span class="name text-ellipsis"><a href="#">2015春茶一级碧螺春 绿茶</a></span>
						</li>
					</ul>
				
				</div>
			</div>
			
			
			
		</div>	
		
		
		<div class="part-04">
			<div class="theme-title">
				<div class="theme-main-title">特色购物</div>
				<div class="text">
					<h5 class="theme-sub-title">Characteristic Shopping</h5>
					<span class="ico"></span>
				</div>
			</div>
			<div class="out-pt">
				<div class="left-list">
					<span class="ad"><a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/mall-27.gif" /></a></span>
					<ul class="ul-01">
						<li><a href="#">食品饮料</a></li>
						<li><a href="#">美容洗护</a></li>
						<li><a href="#">服饰鞋包</a></li>
						<li><a href="#">母婴玩具</a></li>
						<li><a href="#">数码家电</a></li>
						<li><a href="#">家居百货</a></li>
					</ul>
				</div>
				<div class="right-list">
					<ul>
						<li>
							<a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img02.gif" /></a>
							<span class="name text-ellipsis"><a href="#">2015春茶一级碧螺春春茶一级碧螺春茶</a></span>
							<div class="text-left">
										<del class="bef-price">￥128.00</del>
										<span class="discount-price"><em>￥</em>29.90</span>
								</div>
							<a class="buy" href="#"></a>	
						</li>
						<li>
							<a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img02.gif" /></a>
							<span class="name text-ellipsis"><a href="#">2015春茶一级碧螺春春茶一级碧螺春茶</a></span>
							<div class="text-left">
										<del class="bef-price">￥128.00</del>
										<span class="discount-price"><em>￥</em>29.90</span>
								</div>
							<a class="buy" href="#"></a>	
						</li>
						<li>
							<a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img02.gif" /></a>
							<span class="name text-ellipsis"><a href="#">2015春茶一级碧螺春春茶一级碧螺春茶</a></span>
							<div class="text-left">
										<del class="bef-price">￥128.00</del>
										<span class="discount-price"><em>￥</em>29.90</span>
								</div>
							<a class="buy" href="#"></a>	
						</li>
						<li>
							<a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img02.gif" /></a>
							<span class="name text-ellipsis"><a href="#">2015春茶一级碧螺春春茶一级碧螺春茶</a></span>
							<div class="text-left">
										<del class="bef-price">￥128.00</del>
										<span class="discount-price"><em>￥</em>29.90</span>
								</div>
							<a class="buy" href="#"></a>	
						</li>
						<li>
							<a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img02.gif" /></a>
							<span class="name text-ellipsis"><a href="#">2015春茶一级碧螺春春茶一级碧螺春茶</a></span>
							<div class="text-left">
										<del class="bef-price">￥128.00</del>
										<span class="discount-price"><em>￥</em>29.90</span>
								</div>
							<a class="buy" href="#"></a>	
						</li>
						<li>
							<a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img02.gif" /></a>
							<span class="name text-ellipsis"><a href="#">2015春茶一级碧螺春春茶一级碧螺春茶</a></span>
							<div class="text-left">
										<del class="bef-price">￥128.00</del>
										<span class="discount-price"><em>￥</em>29.90</span>
								</div>
							<a class="buy" href="#"></a>	
						</li>
						<li>
							<a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img02.gif" /></a>
							<span class="name text-ellipsis"><a href="#">2015春茶一级碧螺春春茶一级碧螺春茶</a></span>
							<div class="text-left">
										<del class="bef-price">￥128.00</del>
										<span class="discount-price"><em>￥</em>29.90</span>
								</div>
							<a class="buy" href="#"></a>	
						</li>
						<li>
							<a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img02.gif" /></a>
							<span class="name text-ellipsis"><a href="#">2015春茶一级碧螺春春茶一级碧螺春茶</a></span>
							<div class="text-left">
										<del class="bef-price">￥128.00</del>
										<span class="discount-price"><em>￥</em>29.90</span>
								</div>
							<a class="buy" href="#"></a>	
						</li>
						<li>
							<a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img02.gif" /></a>
							<span class="name text-ellipsis"><a href="#">2015春茶一级碧螺春春茶一级碧螺春茶</a></span>
							<div class="text-left">
										<del class="bef-price">￥128.00</del>
										<span class="discount-price"><em>￥</em>29.90</span>
								</div>
							<a class="buy" href="#"></a>	
						</li>
						<li>
							<a href="#"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img02.gif" /></a>
							<span class="name text-ellipsis"><a href="#">2015春茶一级碧螺春春茶一级碧螺春茶</a></span>
							<div class="text-left">
										<del class="bef-price">￥128.00</del>
										<span class="discount-price"><em>￥</em>29.90</span>
								</div>
							<a class="buy" href="#"></a>	
						</li>
					</ul>
				</div>
			</div>
			
			
			
		</div>	
		
		<div class="part-05">
			<div class="bd-01">
				<div class="bt">
					<h3>进入微圈</h3>
					<a class="more" href="<?php echo BASE_SITE_URL.DS.'circle/';?>">&gt;&gt;</a>
				</div>
				<ul class="ico-ul">
					<li class="li-01">
						<a href="#">全部版块</a>
					</li>
					<li class="li-02">
						<a href="#">全部版块</a>
					</li>
					<li class="li-03">
						<a href="#">全部版块</a>
					</li>
					<li class="li-04">
						<a href="#">全部版块</a>
					</li>
				</ul>
				<h4>热门活动</h4>
				<ul class="news-ul">
					<li class="text-ellipsis"><a href="#"><span>[免费试用]</span>安吉宝贝--全世界温柔的拥全世界温柔的拥抱你抱你</a></li>
					<li class="text-ellipsis"><a href="#"><span>[免费试用]</span>安吉宝贝--全世界温柔的拥抱你</a></li>
					<li class="text-ellipsis"><a href="#"><span>[免费试用]</span>安吉宝贝--全世界温柔的拥抱你</a></li>
					<li class="text-ellipsis"><a href="#"><span>[免费试用]</span>安吉宝贝--全世界温柔的拥抱你</a></li>
					<li class="text-ellipsis"><a href="#"><span>[免费试用]</span>安吉宝贝--全世界温柔的拥抱你</a></li>
				</ul>
			</div>
			<div class="bd-02"><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img03.gif" /></div>
			<div class="bd-03">
				<h4>最热帖</h4>
				<ul class="news-ul">
					<li class="text-ellipsis"><a href="#"><span>[馋]</span>一夜之间在吃货界火了的吃法</a></li>
					<li class="text-ellipsis"><a href="#"><span>[免费试用]</span>安吉宝贝--全世界温柔的拥抱你</a></li>
					<li class="text-ellipsis"><a href="#"><span>[免费试用]</span>安吉宝贝--全世界温柔的拥抱你</a></li>
					<li class="text-ellipsis"><a href="#"><span>[免费试用]</span>安吉宝贝--全世界温柔的拥抱你</a></li>
					<li class="text-ellipsis"><a href="#"><span>[免费试用]</span>安吉宝贝--全世界温柔的拥抱你</a></li>
					<li class="text-ellipsis"><a href="#"><span>[馋]</span>一夜之间在吃货界火了的吃法</a></li>
					<li class="text-ellipsis"><a href="#"><span>[馋]</span>一夜之间在吃货界火了的吃法</a></li>
					<li class="text-ellipsis"><a href="#"><span>[馋]</span>一夜之间在吃货界火了的吃法</a></li>
					<li class="text-ellipsis"><a href="#"><span>[馋]</span>一夜之间在吃货界火了的吃法</a></li>
				</ul>
			</div>
			<div class="bd-04">
				<h3>晒闲置</h3>
				<ul>
					<li><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img04.gif" /><a class="text" href="#">闲置自行车8成新白色200元出售</a></li>
					<li><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img04.gif" /><a class="text" href="#">闲置自行车8成新白色200元出售</a></li>
					<li><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img04.gif" /><a class="text" href="#">闲置自行车8成新白色200元出售</a></li>
					<li><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img04.gif" /><a class="text" href="#">闲置自行车8成新白色200元出售</a></li>
					<li><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img04.gif" /><a class="text" href="#">闲置自行车8成新白色200元出售</a></li>
					<li><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img04.gif" /><a class="text" href="#">闲置自行车8成新白色200元出售</a></li>
					<li><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img04.gif" /><a class="text" href="#">闲置自行车8成新白色200元出售</a></li>
					<li><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img04.gif" /><a class="text" href="#">闲置自行车8成新白色200元出售</a></li>
					<li><img src="<?php echo SHOP_TEMPLATES_URL;?>/images/index/img04.gif" /><a class="text" href="#">闲置自行车8成新白色200元出售</a></li>
				</ul>
			</div>
		</div>
	</div>

	

	<div class="faq">
		<div class="container">
			<div class="dl-out-box">
				<dl class="dl-01">
					<dt class="ico-01">特色服务</dt>
					<dd><a href="#">礼物赠品</a></dd>
					<dd><a href="#">延保服务</a></dd>
					<dd><a href="#">延保服务</a></dd>
					<dd><a href="#">延保服务</a></dd>
				</dl>
				
				<dl class="dl-01">
					<dt class="ico-02">售后服务</dt>
					<dd><a href="#">礼物赠品</a></dd>
					<dd><a href="#">延保服务</a></dd>
					<dd><a href="#">延保服务</a></dd>
					<dd><a href="#">延保服务</a></dd>
				</dl>	
				<dl class="dl-01">
					<dt class="ico-03">支付方式</dt>
					<dd><a href="#">礼物赠品</a></dd>
					<dd><a href="#">延保服务</a></dd>
					<dd><a href="#">延保服务</a></dd>
					<dd><a href="#">延保服务</a></dd>
				</dl>	
				<dl class="dl-01">
					<dt class="ico-04">配送方式</dt>
					<dd><a href="#">礼物赠品</a></dd>
					<dd><a href="#">延保服务</a></dd>
					<dd><a href="#">延保服务</a></dd>
					<dd><a href="#">延保服务</a></dd>
				</dl>
				<dl class="dl-01">
					<dt class="ico-05">购物指南</dt>
					<dd><a href="#">礼物赠品</a></dd>
					<dd><a href="#">延保服务</a></dd>
					<dd><a href="#">延保服务</a></dd>
					<dd><a href="#">延保服务</a></dd>
				</dl>
				<dl class="dl-01">
					<dt class="ico-06">关于我们</dt>
					<dd><a href="#">礼物赠品</a></dd>
					<dd><a href="#">延保服务</a></dd>
					<dd><a href="#">延保服务</a></dd>
					<dd><a href="#">延保服务</a></dd>
				</dl>	
			</div>	
			
		</div>			
	</div>

	<div class="footer">
		<div class="container">
			<p class="links">	
				<a href="">优康集团</a>|<a href="">人力资源</a>|<a href="">优康通信</a>|<a href="">联系我们</a>|<a href="">投诉建议</a>|<a href="">优康科技园</a></p>	
				<p class="copyright">地址：苏州大撒达达路洒大地<br>推荐使用IE8.0浏览器（兼容所有浏览器）Copyright © 2005-2015</p>
				</div>
			</div>



</body>
</html>
