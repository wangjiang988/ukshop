<?php defined('InUk86') or exit('Access Invalid!'); ?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta id="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
<meta name="apple-themes-web-app-capable" content="yes">
<meta content="yes" name="apple-mobile-web-app-capable">
<meta content="black" name="apple-mobile-web-app-status-bar-style">
<meta content="telephone=no" name="format-detection">
<meta content="email=no" name="format-detection">
<meta name="format-detection" content="telephone=no">
<title>优康_店铺详情</title>
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/base.css" type="text/css" media="all">
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/main.css" type="text/css" media="all">
<style type="text/css">
input[type=radio]{width:0.25rem; height:0.25rem;}
</style>
</head>
<body style="background:#F5F5F5;">
<!--顶部-->
<header id="header">
<div class="header_con">
	<div class="headerleft">
		<i onClick="javascript:history.go(-1);" class="icon-arrow-left"></i>
	</div>
	<div class="top-hk-div">
		<i class="icon-share-top"></i>
		<input class="ui-input-top" type="search" value="<?php echo $_GET['keyword'] ?>" placeholder="搜索店铺内商品">
	</div>
	<div class="headerRight">
		<i class="icon-more-right"></i>
	</div>
</div>
</header>
<!--顶部结束-->
<div id="content" class="p_bottom" style="background:#F5F5F5;">
	<div class="spxq_bg">
		<ul>
			<li class="spxq_bg_1"><img src="<?php echo $output['store_info']['store_logo']; ?>"></li>
			<li class="spxq_bg_2"><dl><dt><em><?php echo $output['store_info']['store_name'] ?></em></dt><dt><span><em><?php echo $output['store_info']['store_credit_average'] ?></em>分</span><img id="share" src="<?php echo SHOP_TEMPLATES_URL ?>/images/wap/spxq_fx.png"></dt></dl></li>
			<li class="spxq_bg_3"><dl><dt><div id="<?php echo $output['is_fav']?'spxq_ygz':'spxq_gz'; ?>"></div></dt><dt><span>查看店铺全景</span></dt></dl></li>
		</ul>
	</div>
	<?php if(!empty($output['search_type'])){ ?>
	  <?php if($output['search_type'] == 'stc'){ ?>
	  	<div class="spxq_span"><span><?php echo $output['stc_name'] ?></span></div>
	  	<?php if(!empty($output['goods_list'])){ ?>
		<div class="spxq_list_all">
			<ul>
			  <?php foreach ($output['goods_list'] as $goods_val){ ?>
			    <a href="<?php echo uk86_urlShop('wap_goods_info', 'index', array('goods_id' => $goods_val['goods_id'])); ?>">
				<li>
				  <dl>
				    <dt><img src="<?php echo uk86_thumb($goods_val, 240); ?>"></dt>
				    <dt><span><?php echo $goods_val['goods_name']; ?> </span></dt>
				    <dt><em>￥<?php echo $goods_val['goods_price'] ?></em></dt>
				  </dl>
				</li>
				</a>
			  <?php } ?>
			</ul>
		</div>
		<?php }else{ ?>
		<div style="color:#999; width:100%; height:60%; text-align:center; background:#FFF;"><span style="margin-top:2.9rem; display:inline-block;">没有符合条件的数据记录<span></span><br /></div>
		<?php } ?>
	  <?php }else{ ?>
	   <?php if(!empty($output['goods_list'])){ ?>
		<div class="spxq_list_all">
			<ul>
			  <?php foreach ($output['goods_list'] as $goods_val){ ?>
			    <a href="<?php echo uk86_urlShop('wap_goods_info', 'index', array('goods_id' => $goods_val['goods_id'])); ?>">
				<li>
				  <dl>
				    <dt><img src="<?php echo uk86_thumb($goods_val, 240); ?>"></dt>
				    <dt><span><?php echo $goods_val['goods_name']; ?> </span></dt>
				    <dt><em>￥<?php echo $goods_val['goods_price'] ?></em></dt>
				  </dl>
				</li>
				</a>
			  <?php } ?>
			</ul>
		</div>
		<?php }else{ ?>
		<div style="color:#999; width:100%; height:60%; text-align:center; background:#FFF;"><span style="margin-top:2.9rem; display:inline-block;">没有符合条件的数据记录<span></span><br /></div>
		<?php } ?>
	  <?php } ?>
	<?php }else{ ?>
	<div class="spxq_span"><span>推荐商品</span></div>
	<div class="spxq_list_all">
		<ul>
		  <?php foreach ($output['store_info']['search_list_goods'] as $goods_val){ ?>
		    <a href="<?php echo uk86_urlShop('wap_goods_info', 'index', array('goods_id' => $goods_val['goods_id'])); ?>">
			<li>
			  <dl>
			    <dt><img src="<?php echo uk86_thumb($goods_val, 240); ?>"></dt>
			    <dt><span><?php echo $goods_val['goods_name']; ?> </span></dt>
			    <dt><em>￥<?php echo $goods_val['goods_price'] ?></em></dt>
			  </dl>
			</li>
			</a>
		  <?php } ?>
		</ul>
	</div>
	<div class="spxq_span"><span>全部商品</span></div>
	<div class="spxq_list_all">
		<ul>
			<?php foreach ($output['goods_list'] as $goods_val){ ?>
			<a href="<?php echo uk86_urlShop('wap_goods_info', 'index', array('goods_id' => $goods_val['goods_id'])); ?>">
			<li>
			  <dl>
			    <dt><img src="<?php echo uk86_thumb($goods_val, 240); ?>"></dt>
			    <dt><span><?php echo $goods_val['goods_name']; ?> </span></dt>
			    <dt><em>￥<?php echo $goods_val['goods_price'] ?></em></dt>
			  </dl>
			</li>
			</a>
		  <?php } ?>
		</ul>
	</div>
	<?php } ?>
 </div>
	<!-- 店铺分享dialog -->
  <div class="dialog_html" style="display: none;">
 	<form id="share_form" method="post" action="index.php">
   	 <input type="hidden" name="store_id" value="<?php echo $_GET['store_id']; ?>"/>
   	 <input type="hidden" name="store_name" value="<?php echo $output['store_info']['store_name']; ?>"/>
   <div class="dialogBody" style="top:2.5rem;">
   <i class="close" onClick="dialog_hide();"></i>
   <div class="dialogHead"><i class="icon-confirm"></i><p>分享店铺</p></div>
   <div class="dialogMsg" style="border-bottom: 0.02rem solid #ccc;">
     <table style="color:#454545; font-size:0.25rem; line-height:0.35rem;">
       <tr>
         <td align="right">店铺：</td><td class="order_sn"><?php echo $output['store_info']['store_name']; ?></td>
       </tr>
       <tr>
         <td align="right" valign="top">可见范围：</td>
         <td>
           <input type="radio" id="all" value="0" checked="checked" name="share_privacy"/><label for="all">所有人可见</label><br/>
           <input type="radio" id="friend" value="1" name="share_privacy"/><label for="friend">仅好友可见</label><br/>
           <input type="radio" id="self" value="2" name="share_privacy"/><label for="self">仅自己可见</label>
         </td>
       </tr>
       <tr>
         <td align="right" valign="top">描述：</td>
         <td><textarea id="d5" name="share_content" style="height:1.2rem; width:3.8rem; resize: none; border-radius:0.1rem; border:0.02rem solid #999; padding:0.1rem; margin-bottom:0.2rem; margin-top:0.1rem;" maxlength="140" placeholder="这家店铺很不错的哦~"></textarea></td>
       </tr>
     </table>
   </div>
   <div class="closeTime"><a class="form_submit hovered" style="background:#5BB75B">&nbsp;&nbsp;分享&nbsp;&nbsp;</a>&nbsp;&nbsp;&nbsp;&nbsp;<a class="hovered" onClick="dialog_hide();">&nbsp;&nbsp;取消&nbsp;&nbsp;</a></div>
   </div>
   </form>
 </div>
<?php if(!empty($output['sgc']) && is_array($output['sgc'])){ ?>
 <i class="icon_store_class"></i>
<div class="store_class no-click" style="display: none;">
  <ul>
    <li <?php if(empty($_GET['stc_id'])){echo 'class="is_select"';} ?> nctype="0"><span>全部商品</span></li>
  	<?php foreach ($output['sgc'] as $sgc_val){ ?>
  	  <li nctype="<?php echo $sgc_val['stc_id']; ?>">
  	    <span <?php if($_GET['stc_id'] == $sgc_val['stc_id']){echo 'class="is_select"';} ?>><?php echo $sgc_val['stc_name']; ?></span>
  	    <?php if(!empty($sgc_val['childred']) && is_array($sgc_val['childred'])){ ?>
  	    <dl>
  	      <?php foreach ($sgc_val['childred'] as $val){ ?>
  	      <dt nctype="<?php echo $val['stc_id']; ?>" <?php if($_GET['stc_id'] == $val['stc_id']){echo 'class="is_select"';} ?>><?php echo $val['stc_name']; ?></dt>
  	      <?php } ?>
  	    </dl>
  	    <i class="icon_store_right"></i>
  	    <?php } ?>
  	  </li>
  	<?php } ?>
  </ul>
</div>
<?php } ?>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/ajax.form.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/zepto.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/carousel-image.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/common.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.store_class ul li dl').hide();
	//显示二级分类
	$('.store_class ul li').toggle(function(){
		$(this).children('i').addClass('rotate');
		$(this).children('dl').show(200);
	},function(){
		$(this).children('i').removeClass('rotate');
		$(this).children('dl').hide(100);
	});
	//收藏店铺
	$('#spxq_gz').click(function(){
		if(<?php echo $_SESSION['is_login']?0:1; ?>){
			window.location.href="index.php?act=wap_login&op=login";
		}
		var store_id = <?php echo $_GET['store_id']?$_GET['store_id']:0; ?>;
		if(store_id == 0)return;
		$.post('index.php?act=wap_store&op=fav_store', {store_id:store_id}, function(msg){
			if(msg){
				showDialog('关注店铺成功', '', '<?php echo $_SERVER['REQUEST_URI']; ?>');
			}else{
				showDialog('您已关注过此店铺');
			}
		});
	});
	$('.store_class').hide();
	$('.icon_store_class').hide();
	//店铺分类显示
	$('.icon-more-right').click(function(){
		if($('.store_class').hasClass('no-click')){
			$('.store_class').show(200);
			$('.icon_store_class').show(200);
			$('.store_class').removeClass('no-click');
			return false;
		}else{
			$('.store_class').hide(100);
			$('.icon_store_class').hide(100);
			$('.store_class').addClass('no-click');
			return false;
		}
	});
	$('#content,header').click(function(){
		$('.store_class').hide(100);
		$('.icon_store_class').hide(100);
		$('.store_class').addClass('no-click');
	});
	//搜索
	//店铺搜索
	$('.ui-input-top').focus(function(event){
		window.document.onkeydown = function(event){
			if(window.event.keyCode == 13){
				var keyword = $('.ui-input-top').val();
				if(keyword != ''){
					window.location.href='index.php?act=wap_store&op=store_info&store_id=<?php echo $_GET['store_id']; ?>&keyword='+keyword;
				}
				return false;
			}
		}
	});
	$('.store_class ul li span').click(function(){
		var sgc_id=$(this).parent('li').attr('nctype');
		var stc_name=$(this).html();
		if(<?php echo $_GET['stc_id']?$_GET['stc_id']:0; ?> == sgc_id){
			return false;
		}
		window.location.href = "index.php?act=wap_store&op=store_info&store_id=<?php echo $_GET['store_id']; ?>&stc_id="+sgc_id+'&stc_name='+stc_name;
		return false;
	});
	$('.store_class ul li dl dt').click(function(){
		var sgc_id = $(this).attr('nctype');
		var stc_name=$(this).html();
		if(<?php echo $_GET['stc_id']?$_GET['stc_id']:0; ?> == sgc_id){
			return false;
		}
		window.location.href = "index.php?act=wap_store&op=store_info&store_id=<?php echo $_GET['store_id']; ?>&stc_id="+sgc_id+'&stc_name='+stc_name;
		return false;
	});
	//分享店铺
	$('.dialog_html').hide();
	$('#share').click(function(){
		if(<?php echo $_SESSION['is_login']?0:1; ?>){
			window.location.href="index.php?act=wap_login&op=login";
		}else{
			$('.dialog_html').show();
		}
	});
	$('.form_submit').click(function(){
		var share_content = $('#d5').val();
		if(share_content == ''){
			$('#d5').addClass('border-color-red').focus();
			return false;
		}
		$('#share_form').ajaxSubmit({
			type : 'post',
			 url : 'index.php?act=wap_goods_info&op=share_goods',
		 success : function(msg){
			 	dialog_hide();
				if(msg > 0){
					if(msg == 11){
						showDialog('分享成功');
					}else if(msg == 10){
						showDialog('您已分享过此店铺');
					}
				}else{
					showError('分享失败');
				}
		    }
			 
		});
	})
});

function dialog_hide(){
	$('.dialog_html').hide(); 
	$('#d5').removeClass('border-color-red');	
}
</script>
</body>
</html>