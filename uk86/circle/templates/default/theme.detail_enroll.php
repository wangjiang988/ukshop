<?php defined('InUk86') or exit('Access Invalid!');?>
<style type="text/css">
.none_enroll{width:82px; display:block; line-height:30px; background:#dddddd; margin:10px 0 0 43px;  text-align:center; font-size:14px; font-weight:600; border-radius:5px;}
.none_enroll:hover{ text-decoration:none;}
.theme_enroll{line-height:30px; background:#3ba65a; color:#FFF; float:left;}
.theme_enroll:hover{color:#FFF; text-decoration:none; background:#279a52}
.txt_red{color:red; line-height:50px; margin-left:10px;}
.color_red{color:red; font-size:16px; font-weight:600;}
.not_login{color:#999999; font-size:14px; text-align:center; margin-left:200px; line-height:70px;}
.not_login a{color:#2d917a; text-decoration:underline;}
</style>
<div class="theme-detail-poll-content">
  <div class="poll-option-info">
    <h4>报名</h4>
          共有<em><?php echo $output['member_num']; ?></em>人报名
  </div>
  <?php if($_SESSION['is_login'] == 0){ ?>
    <span class="not_login">您目前还没有登录，请先 <a href="javascript:void(0);" nctype="login">登录</a> 后再报名</span>
  <?php }elseif(in_array($output['identity'], array(0,5))){ ?>
    <span class="not_login">请您先 <a href="javascript:void(0);" nctype="apply">加入本圈</a> 后再报名</span>
  <?php }else{ ?>
  <form id="enroll_submit_form">
    <table>
      <tr>
        <td style="text-align:right; width:70px;">姓名：</td>
        <td><input type="text" id="truename" class="text" name="truename" value="<?php echo $output['enroll_member']['member_truename'] ?>" maxLength="20" placeholder="请输入真实姓名"/><span class="color_red"> *</span></td>
        <td style="text-align:right; width:70px;">手机：</td>
        <td><input type="text" id="phone" class="text" name="phone" maxLength="11" value="<?php echo $output['enroll_member']['member_mobile'] ?>"/><span class="color_red"> *</span></td>
      <tr>
      <tr>
        <td style="text-align:right; width:70px;">邮箱：</td>
        <td><input type="email" id="email" class="text" name="email" value="<?php echo $output['enroll_member']['member_email'] ?>"/></td>
        <td style="text-align:right; width:70px;">Q Q：</td>
        <td><input type="text" id="tx_qq" class="text" name="tx_qq" value="<?php echo $output['enroll_member']['member_qq'] ?>"/></td>
      <tr>
    </table>
  </form>
  <a class="theme_enroll none_enroll" href="javascript:void(0);">立即报名</a>
  <span class="txt_red phone_error"></span><span class="txt_red name_error"></span>
  <?php } ?>
  <div style="clear: both;"></div>
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/ajax.form.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("input[name='truename']").focus(function(){ $('.name_error').html(''); });
	$("input[name='phone']").focus(function(){ $('.phone_error').html(''); });
	$('.theme_enroll').click(function(){
		$('.phone_error').html('');
		$('.name_error').html('');
		if($("input[name='truename']").val() == ''){$('.name_error').html('* 请输入真实姓名'); return; }
		if($("input[name='phone']").val().length < 11){$('.phone_error').html('* 请输入正确的手机号');return;}
		$('#enroll_submit_form').ajaxSubmit({
			type : 'post',
			url : 'index.php?act=theme_inform&op=enroll_ajax',
			data : {t_id:<?php echo $output['t_id'] ?>},
			success : function(enroll){
				var data = enroll.substr(-2,2);
				if(data == '10'){
					alert('您填写的手机号已参与了报名');
				}else if(data == '11'){
					alert('系统错误，请联系客服')
				}else{
					alert('报名成功！');
					setTimeout(shuaxin, 2000);
				}
			}
		});
	});
});
function shuaxin(){
	window.location.reload(true);
}
</script>