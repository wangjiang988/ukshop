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
<title>优康_话题详情</title>
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/main.css" type="text/css" media="all">
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/base.css" type="text/css" media="all">
<style type="text/css">
.article-share-content{font-size:0.22rem;}
.color-red{color:#F00 !important;}
</style>
</head>
<body>
<!--顶部-->
<header id="header">
	<div class="header_con">
	<div class="headerleft">
		<i onClick="javascript:history.go(-1);" class="icon-arrow-left"></i>
	</div>
		<div class="top-tit-div">
			话题详情
		</div>

		<div class="headerRight">
		</div>
	</div>
</header>
<div id="content" class="p_bottom" style="background:#FFF;">
  <div class="theme-info-top"><img src="<?php echo uk86_getMemberAvatarForID($output['theme_info']['member_id']);?>"><?php echo $output['theme_info']['member_name']; ?></div>
  <div class="theme-info-content">
    <div class="theme-title"><?php echo $output['theme_info']['theme_name']; ?></div>
    <div class="theme-bind-time">创建于<?php echo date('Y-m-d', $output['theme_info']['theme_addtime']); ?></div>
    <div class="theme-message">
    	<?php echo uk86_ubb($output['theme_info']['theme_content']); ?>
    </div>
  </div>
  <?php if($output['theme_info']['theme_special'] == 1){ ?>
  <!-- 投票开始 -->
  <form id="poll_form" method="post" action="index.php">
  <input type="hidden" name="t_id" value="<?php echo $_GET['theme_id']; ?>"/>
  <div class="theme-poll">
  	<h1><em style="font-weight:600; color:#000;"><?php if($output['poll_info']['poll_multiple'] == 1){echo '多选';}else{echo '单选';} ?>投票</em>&nbsp;&nbsp;<span style="font-size:0.23rem; color:#777;">共有<em style="color:#2b9d55; font-weight:600;"><?php echo $output['poll_info']['poll_voters']; ?></em>人参与投票<?php if(!empty($output['is_polled'])){echo '（已参与）';} ?></span></h1>
    <ul>
      <?php foreach ($output['poll_option'] as $option){ ?>
      <li>
        <dl>
          <dt><input class="poll_option" type="<?php echo $output['poll_info']['poll_input_type']; ?>" name="poll_option[]" <?php if(!empty($output['is_disabled'])){echo 'disabled="disabled"';} ?> value="<?php echo $option['pollop_id']; ?>"/></dt>
          <dd>
            <h2><?php echo $option['pollop_option']; ?></h2>
            <div class="back_width_option"><p class="index_width_option" style="width:<?php echo $option['option_x'].'%'; ?>"></p><em><?php echo $option['option_x']; ?>%</em></div>
            <em><?php echo $option['pollop_votes']; ?>人投票</em>
          </dd>
        </dl>
      </li>
      <?php } ?>
    </ul>
    <?php if(empty($output['poll_end'])){ ?>
      <?php if(empty($output['is_disabled'])){ ?>
    	<div class="theme-poll-foot"><a class="hovered poll-submit">提交</a></div>
      <?php } ?>
    <?php }else{ ?>
    	<div class="theme-poll-foot">投票已结束</div>
    <?php } ?>
  </div>
  </form>
  <!-- 投票结束 -->
  <?php } ?>
  
  <?php if($output['theme_info']['theme_special'] == 2){ ?>
  <!-- 报名开始 -->
  <form id="enroll_form" method="post" action="index.php">
    <input type="hidden" name="t_id" value="<?php echo $_GET['theme_id']; ?>"/>
    <div class="theme-poll">
      <h1><em style="font-weight:600; color:#000">报名</em>&nbsp;&nbsp;<span style="font-size:0.23rem; color:#777;">共有<em style="color:#2b9d55; font-weight:600;"><?php echo $output['enroll_num']; ?></em>人报名</span></h1>
      <table class="enroll_table">
      	<tr>
      	  <td>姓名：</td>
      	  <td><input type="text" name="truename" maxlength="20" value="<?php echo $output['member_info']['member_truename']; ?>" placeholder="真实姓名"/><em> *</em></td>
      	</tr>
      	<tr>
      	  <td>手机：</td>
      	  <td><input type="number" name="mobile" maxlength="11" value="<?php echo $output['member_info']['member_mobile']; ?>" placeholder="手机号码"/><em> *</em></td>
      	</tr>
      	<tr>
      	  <td>邮箱：</td>
      	  <td><input type="email" name="email" value="<?php echo $output['member_info']['member_email']; ?>" maxlength="40"/></td>
      	</tr>
      	<tr>
      	  <td>Q Q：</td>
      	  <td><input type="number" maxlength="15"  value="<?php echo $output['member_info']['member_qq']; ?>" name="tx_qq"/></td>
      	</tr>
      </table>
      <div class="theme-poll-foot"><a class="hovered enoll-submit">提交</a><span class="validate-error"></span></div>
    </div>
  </form>
  <!-- 报名结束 -->
  <?php } ?>
  
  <?php if(!empty($output['reply_list']) && is_array($output['reply_list'])){ ?>
  <div class="theme-apply-top"><i class="icon-angle-up"></i>评论<?php echo $output['theme_info']['theme_commentcount']; ?></div>
  <ul class="theme-apply-list">
    <?php foreach($output['reply_list'] as $reply_info){ ?>
  	<li>
  	  <dl>
  	    <dt><img src="<?php echo uk86_getMemberAvatarForID($reply_info['member_id']); ?>"></dt>
  	    <dd>
  	    	<h1><?php echo $reply_info['member_name']; ?></h1><em><?php echo date('Y-m-d H:i', $reply_info['reply_addtime']); ?></em>
  	    	<font><?php echo $reply_info['reply_content']; ?></font>
  	    </dd>
  	  </dl>
  	  <div style="clear:both;"></div>
  	</li>
  	<?php } ?>
  </ul>
  <?php } ?>
</div>
<div class="bottom-reply-foot">
	<i class="icon-reply-bottom"></i>
	<input type="text" maxlength="255" class="reply-foot-text" value="" placeholder="我也想说一句…"/>
	<a class="reply-foot-submit hovered">发送</a>
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/ajax.form.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/zepto.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/carousel-image.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/common.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.all_foot').hide();
	var c_id = <?php echo $_GET['c_id']; ?>;
	var t_id = <?php echo $_GET['theme_id']; ?>;
	//评论话题
	$('.reply-foot-submit').click(function(){
		var reply_contet = $('.reply-foot-text').val();
		if(reply_contet == ''){return false;}
		$.getJSON('index.php?act=wap_circle&op=addReply', {c_id:c_id, t_id:t_id, message:reply_contet}, function(data){
			if(data.state){
				location.reload(true);
			}else{
				showError(data.msg);
			}
		});
	});
	<?php if($output['theme_info']['theme_special'] == 1){ ?>
	 //投票
	$('.enoll-submit').click(function(){
		$('#poll_form').ajaxSubmit({
			type:'post',
			url:'index.php?act=wap_circle&op=themePoll',
			success:function(data){
				if(data > 0){
					location.reload(true);
				}else{
					showError('请选择投票选项。');
				}
			}
		});
	});
	<?php } ?>
	<?php if($output['theme_info']['theme_special'] == 2){ ?>
	$('input[name="truename"]').focus(function(){
		if($('.validate-error').hasClass('truename-error')){
			$('.validate-error').removeClass('truename-error').html('');
		}
	});
	$('input[name="mobile"]').focus(function(){
		if($('.validate-error').hasClass('mobile-error')){
			$('.validate-error').removeClass('mobile-error').html('');
		}
	});
	//报名
	$('.enoll-submit').click(function(){
		//表单验证
		if($('input[name="truename"]').val() == ''){
			$('.validate-error').removeClass('mobile-error').addClass('truename-error').html('*请输入真事姓名');
			return;
		}
		if($('input[name="mobile"]').val() == '' || $('input[name="mobile"]').val().length < 11){
			$('.validate-error').removeClass('truename-error').addClass('mobile-error').html('*请输入正确的手机号码');
			return;
		}
		$('#enroll_form').ajaxSubmit({
			type:'post',
			url:'index.php?act=wap_circle&op=themeEnroll',
			success:function(data){
				dataJson = eval('('+data+')');
				if(dataJson.state){
					showDialog(dataJson.msg, '', '<?php echo "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']; ?>');
				}else{
					showError(dataJson.msg);
				}
			}
		});
	});
	<?php } ?>
});
</script>
</body>
</html>