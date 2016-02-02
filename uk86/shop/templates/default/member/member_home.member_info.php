<?php defined('InUk86') or exit('Access Invalid!');?>

  <div id="account" class="double">
    <div class="outline">
      <div class="user-account">
        <ul>
      <li id="points"><a href="index.php?act=member_free&op=index" title="查看我的F码">
            <h5>可用F码</h5>
            <span class="icon"></span> <span class="value"><em><?php echo $output['fcode_num'];?></em>个</span></a> </li>   
          <li id="voucher"><a href="index.php?act=member_voucher&op=index" title="查看我的卡券包">
            <h5>卡券包</h5>
            <span class="icon"></span> <span class="value"><em><?php echo $output['home_member_info']['voucher_count']?$output['home_member_info']['voucher_count']:0;?></em>张</span></a> </li>
          <li id="pre-deposit" style="text-align:center"><a href="index.php?act=member_points&op=index" title="查看我的U币">
            <h5><?php echo $lang['nc_pointsnum'];?></h5>
            <span class="icon"></span> <span class="value"><em><?php echo $output['member_info']['member_points'];?></em>U币</span></a> </li>
        </ul>
      </div>
    </div>
  </div>
  <div id="security" class="normal">
    <div class="outline">
      <div class="SAM">
        <h5>账户安全</h5>
        <?php if ($output['home_member_info']['security_level'] <= 1) { ?>
        <div id="low" class="SAM-info"><strong>低</strong><span><em></em></span>
        <?php } elseif ($output['home_member_info']['security_level'] == 2) {?>
        <div id="normal" class="SAM-info"><strong>中</strong><span><em></em></span>
        <?php }else {?>
        <div id="high" class="SAM-info"><strong>高</strong><span><em></em></span>
        <?php } ?>
        <?php if ($output['home_member_info']['security_level'] < 3) {?>
        <a href="<?php echo uk86_urlShop('member_security','index');?>" title="安全设置">提升></a>
        <?php } ?>
        </div>
        <div class="SAM-handle"><span><i class="mobile"></i>手机：
        <?php if ($output['home_member_info']['member_mobile_bind'] == 1) {?>
        <em>已绑定</em>
        <?php  } else {?>
        <a href="<?php echo uk86_urlShop('member_security','auth',array('type'=>'modify_mobile'));?>" title="绑定手机">未绑定</a>
        <?php }?></span>
        <span><i class="mail"></i>邮箱：
        <?php if ($output['home_member_info']['member_email_bind'] == 1) {?>
        <em>已绑定</em>
        <?php  } else {?>
        <a href="<?php echo uk86_urlShop('member_security','auth',array('type'=>'modify_email'));?>" title="绑定邮箱">未绑定</a>
        <?php }?></span>
        </div>
      </div>
    </div>
  </div>