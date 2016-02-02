<?php defined('InUk86') or exit('Access Invalid!');?>
<?php include uk86_template('layout/common_layout');?>
<?php include uk86_template('layout/cur_local');?>
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/member.css" rel="stylesheet" type="text/css">
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/pointprod/layout.css" rel="stylesheet" type="text/css">
<link href="<?php echo SHOP_TEMPLATES_URL;?>/css/pointprod/point.css" rel="stylesheet" type="text/css">


<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/member.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/ToolTip.js"></script>
<script>
//sidebar-menu
$(document).ready(function() {
    $.each($(".side-menu > a"), function() {
        $(this).click(function() {
            var ulNode = $(this).next("ul");
            if (ulNode.css('display') == 'block') {
            	$.cookie(COOKIE_PRE+'Mmenu_'+$(this).attr('key'),1);
            } else {
            	$.cookie(COOKIE_PRE+'Mmenu_'+$(this).attr('key'),null);
            }
			ulNode.slideToggle();
				if ($(this).hasClass('shrink')) {
					$(this).removeClass('shrink');
				} else {
					$(this).addClass('shrink');
				}
        });
    });
	$.each($(".side-menu-quick > a"), function() {
        $(this).click(function() {
            var ulNode = $(this).next("ul");
			ulNode.slideToggle();
				if ($(this).hasClass('shrink')) {
					$(this).removeClass('shrink');
				} else {
					$(this).addClass('shrink');
				}
        });
    });
});
$(function() {
	//展开关闭常用菜单设置
	$('.set-btn').bind("click",
	function() {
		$(".set-container-arrow").show("fast");
		$(".set-container").show("fast");
	});
	$('[nctype="closeCommonOperations"]').bind("click",
	function() {
		$(".set-container-arrow").hide("fast");
		$(".set-container").hide("fast");
	});

    $('dl[nctype="checkcCommonOperations"]').find('input').click(function(){
        var _this = $(this);
        var _dd = _this.parents('dd:first');
        var _type = _this.is(':checked') ? 'add' : 'del';
        var _value = _this.attr('name');
        var _operations = $('[nctype="commonOperations"]');

        // 最多添加5个
        if (_operations.find('li').length >= 5 && _type == 'add') {
            showError('最多只能添加5个常用选项。');
            return false;
        }
        $.getJSON('<?php echo uk86_urlShop('member', 'common_operations')?>', {type : _type, value : _value}, function(data){
            if (data) {
                if (_type == 'add') {
                    _dd.addClass('checked');
                    if (_operations.find('li').length == 0) {
                        _operations.fadeIn('slow');
                    }
                    _operations.find('ul').append('<li style="display : none;" nctype="' + _value + '"><a href="' + _this.attr('data-value') + '">' + _this.attr('data-name') + '</a></li>');
                    _operations.find('li[style]').fadeIn('slow');
                } else {
                    _dd.removeClass('checked');
                    _operations.find('li[nctype="' + _value + '"]').fadeOut('slow', function(){
                        $(this).remove();
                        if (_operations.find('li').length == 0) {
                            _operations.fadeOut('slow');
                        }
                    });
                }
            }
        });
    });
});

</script>


<div class="container">
	<div class="ad-ul-out">
		<div class="member-top">
			<div class="head-bd">
					<img src="<?php if ($output['member_info']['member_avatar']!='') { echo UPLOAD_SITE_URL.'/'.ATTACH_AVATAR.DS.$output['member_info']['member_avatar']; } else { echo UPLOAD_SITE_URL.'/'.ATTACH_COMMON. DS.C('default_user_portrait'); } ?>">
					<div class="text">
						<p class="p-01">hi，<?php echo $_SESSION['member_name'];?></p>
						<p class="p-02">当前等级：<strong><?php echo $output['member_info']['level_name'];?></strong></p>
						<p class="p-02">当前经验值：<strong><?php echo $output['member_info']['member_exppoints'];?></strong></p>
					</div>
				</div>
				
			<div class="progress-box">
				<?php if ($output['member_info']['level'] !== -1){ ?>
				<div class="progress-bar-out">
					<span class="sp-01"><?php echo $output['member_info']['level_name']; ?></span>
					<div class="progress-bar">
						<span style="width:<?php echo $output['member_info']['exppoints_rate'];?>%"></span>
					</div>
					<span class="sp-01"><?php echo $output['member_info']['upgrade_name']; ?></span>
					<?php if ($output['member_info']['less_exppoints'] > 0){?>
					<p class="p-01">还差<em><?php echo $output['member_info']['less_exppoints'];?></em>经验值即可升级成为<?php echo $output['member_info']['upgrade_name'];?>等级会员</p>
					<?php } else {?>
				    已达到最高会员级别，继续加油保持这份荣誉哦！
				    <?php }?>	
				    <?php } else { ?>
					  暂无等级
					  <?php } ?>	
				</div>
				<div class="zt">
					<a href="<?php echo uk86_urlShop('pointgrade', 'index');?>"><?php echo $lang['p_my_pointgrade']; ?></a>
					<a href="<?php echo uk86_urlShop('pointgrade', 'exppointlog');?>"><?php echo $lang['p_my_exppointlog']; ?></a>
				</div>	
			</div>
			
			<div class="dl-out">
				<dl>
					<dt><a href="index.php?act=member_points"><?php echo $output['member_info']['member_points']; ?><em><?php echo $lang['p_ubi']; ?></em></a></dt>
					<dd><a href="index.php?act=member_points"><?php echo $lang['p_my_ubi']; ?></a></dd>
				</dl>
				<dl>
					<dt><a href="index.php?act=member_voucher&op=index" target="_blank"><?php echo $output['vouchercount']; ?><em>张</em></a></dt>
					<dd><a href="index.php?act=member_voucher&op=index" target="_blank">可用卡券包</a></dd>
				</dl>
				<dl>
					<dt><a href="index.php?act=member_pointorder&op=orderlist"><?php echo $output['pointordercount']; ?><em>个</em></a></dt>
					<dd><a href="index.php?act=member_pointorder&op=orderlist">已兑换礼品</a></dd>
				</dl>
				</div>
			<a href="index.php?act=pointcart" class="go-a">礼品兑换购物车<em><?php echo $output['pointcart_count']; ?></em></a>
		</div>
	  	<?php require_once($tpl_file);?>
	</div>

</div>


<!--<div class="ncm-container">
  <div class="left-layout">
    <div class="ncm-l-top">
      <h2><a href="index.php?act=member&op=home" title="我的商城">我的商城</a></h2>
      <a href="javascript:void(0)" title="常用菜单设置" class="set-btn"></a>
      <div class="set-container-arrow"></div>
      <div class="set-container">
        <div class="title">
          <h3>常用菜单设置</h3>
          <a href="javascript:void(0)" title="关闭" class="close-btn close-container" nctype="closeCommonOperations"></a></div>
        <div class="tip">勾选您经常使用的菜单，最多可选5个。 </div>
        <div class="menu-list">
          <?php if (!empty($output['menu_list'])) {?>
          <?php foreach ($output['menu_list'] as $value) {?>
          <dl class="collapsed" nctype="checkcCommonOperations">
            <dt><?php echo $value['name'];?></dt>
            <?php if (is_array($value['child'])) {?>
            <?php foreach ($value['child'] as $key => $val) {?>
            <dd <?php if ($val['selected']) {?>class="checked"<?php }?>>
              <label>
                <input name="<?php echo $key?>" data-value="<?php echo $val['url'];?>" data-name="<?php echo $val['name'];?>" type="checkbox" class="checkbox" <?php if ($val['selected']) {?>checked="checked"<?php }?> />
                <?php echo $val['name'];?></label>
            </dd>
            <?php }?>
            <?php }?>
          </dl>
          <?php }?>
          <?php }?>
        </div>
        <div class="bottom">
          <input type="submit" value="确定" class="setting" nctype="closeCommonOperations">
        </div>
      </div>
    </div>
    <div class="ncm-user-info">
      <div class="avatar"><img src="<?php echo uk86_getMemberAvatar($output['member_info']['member_avatar']);?>">
        <div class="frame"></div>
        <?php if (intval($output['message_num']) > 0){ ?>
        <a href="index.php?act=member_message&op=message" class="new-message" title="新消息"><?php echo intval($output['message_num']); ?></a>
        <?php }?>
      </div>
      <div class="handle"><a href="index.php?act=member_information&op=avatar" title="修改头像"><i class="icon-camera"></i>修改头像</a><a href="index.php?act=member_information&op=member" title="修改资料"><i class="icon-pencil"></i>修改资料</a><a href="index.php?act=login&op=logout" title="安全退出"><i class="icon-off"></i>安全退出</a></div>
      <div class="name"><?php echo $output['member_info']['member_name'];?>&nbsp;
        <?php if ($output['member_info']['level_name']){ ?>
        <div class="nc-grade-mini" style="cursor:pointer;" onclick="javascript:go('<?php echo uk86_urlShop('pointgrade','index');?>');"><?php echo $output['member_info']['level_name'];?></div>
        <?php } ?>
      </div>
    </div>
    <ul class="ncm-sidebar ncm-quick-menu">
      <li class="side-menu-quick" nctype="commonOperations" <?php if (empty($output['common_menu_list'])) {?>style="display: none;"<?php }?>> <a href="javascript:void(0)">
        <h3>常用操作</h3>
        </a>
        <ul>
          <?php if (!empty($output['common_menu_list'])) {?>
          <?php foreach ($output['common_menu_list'] as $key=>$value) {?>
          <li nctype="<?php echo $value['key'];?>"> <a href="<?php echo $value['url'];?>"><?php echo $value['name'];?></a></li>
          <?php }?>
          <?php }?>
        </ul>
      </li>
    </ul>
    <ul id="sidebarMenu" class="ncm-sidebar">
      <?php if (!empty($output['menu_list'])) {?>
      <?php foreach ($output['menu_list'] as $key => $value) {?>
      <li class="side-menu"><a href="javascript:void(0)" key="<?php echo $key;?>" <?php if (uk86_cookie('Mmenu_'.$key) == 1) echo 'class="shrink"';?>>
        <h3><?php echo $value['name'];?></h3>
        </a>
        <?php if (!empty($value['child'])) {?>
        <ul <?php if (uk86_cookie('Mmenu_'.$key) == 1) echo 'style="display:none"';?>>
          <?php foreach ($value['child'] as $key => $val) {?>
          <li <?php if ($key == $output['menu_highlight']) {?>class="selected"<?php }?>><a href="<?php echo $val['url'];?>"><?php echo $val['name'];?></a></li>
          <?php }?>
        </ul>
        <?php }?>
      </li>
      <?php }?>
      <?php }?>
    </ul>
  </div>
  <div class="right-layout">
    <?php require_once($tpl_file);?>
  </div>
  <div class="clear"></div>
</div>-->
<?php require_once uk86_template('footer');?>
</body></html>