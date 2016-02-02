<?php
/**
 * 会员修改个人账户信息
 * @author ZHUXUESONG
 *
 */
defined('InUk86') or exit('Access Invalid!');

class wap_member_changeControl extends BaseWapControl{
	private $condition = array();
	public function __construct(){
		parent::__construct();
		//验证是否登录
		if(!$_SESSION['is_login']){
			header('Location:index.php?act=wap_login&op=login');
		}
		$this->condition['member_id'] = intval($_SESSION['member_id']);
	}
	
	/**
	 * 修改绑定手机
	 */
	public function change_mobileOp(){
		$member_info = Model('member')->where($this->condition)->field('member_mobile,  member_email')->find();
		if($_GET['type'] == 1){
			//发送校验码给用户
			$email = new Uk86Email();
			$verify_code = rand(100,999).rand(100,999);
			//校验码存入kookie
			uk86_setNcCookie('email_code_'.$_SESSION['member_id'], $verify_code, '1800');
			$subject = C('site_name').'安全校验码';
			$message = '【'.C('site_name').'】您与'.date('Y-m-d H:i').'更改绑定手机的校验码为：'.$verify_code.'，请在30分钟内完成验证。';
			$result = $email->uk86_send_sys_email(trim($member_info['member_email']), $subject, $message);
			if(!$result){
				$this->wap_showDialog('邮件发送失败，请与管理员联系！', '', 'index.php?act=wap_member_setting&op=memberAccountNumber');
			}
		}
		foreach ($member_info as $k => $v){
			if($v == ''){
				unset($member_info[$k]);
				continue;
			}
			$member_info[$k] = $this->get_md6($member_info[$k]);
		}
		Tpl::output('member_info', $member_info);
		Tpl::showpage('change_mobile');
	}
	
	/**
	 * 绑定新手机
	 */
	public function send_mobileOp(){
		Tpl::showpage('change_mobile.send');
	}
	
	/**
	 * 验证邮箱校验码
	 */
	public function getVerifyCodeOp(){
		$code = strtolower(trim($_GET['code']));
		$verify = strtolower(uk86_cookie('email_code_'.$_SESSION['member_id']));
		if($verify == ''){
			exit(json_encode(array('state' => false, 'msg' => '操作超时或校验码已被使用，我们将给您重新发送校验码', 'url' => 'index.php?act=wap_member_change&op=change_mobile&type=1')));
		}
		if($verify == $code){
			uk86_setNcCookie('email_code_'.$_SESSION['member_id'], '', '1800');
			exit(json_encode(array('state' => true, 'msg' => '校验成功，可进行下一步操作', 'url' => 'index.php?act=wap_member_change&op=send_mobile')));
		}
		exit(json_encode(array('state' => false, 'msg' => '校验码错误，我们将给您重新发送校验码', 'url' => 'index.php?act=wap_member_change&op=change_mobile&type=1')));
	}
	
	/**
	 * 绑定手机发送校验码
	 */
	public function send_smsOp(){
		$mobile = trim($_GET['mobile']);
		if($mobile == ''){
			exit(json_encode(array('state' => false, 'msg' => '请输入接收短信的手机号')));
		}
		$sms = new Uk86Sms();
		$verify_code = rand(100,999).rand(100,999);
		//校验码存入kookie
		uk86_setNcCookie('mobile_code_'.$_SESSION['member_id'], $verify_code, '1800');
		//手机号码存入kookie
		uk86_setNcCookie('mobile_'.$_SESSION['member_id'], $mobile, '2000');
		$content = '【'.C('site_name').'】您与'.date('Y-m-d H:i').'绑定手机校验码为：'.$verify_code.',30分钟有效。';
		$relust = $sms->uk86_send($mobile, $content);
		if($relust){
			exit(json_encode(array('state' => true, 'msg' => '校验码发送成功，请在30分钟内完成验证。')));
		}else{
			exit(json_encode(array('state' => false, 'msg' => '请输入正确的手机号码。')));
		}
	}
	
	/**
	 * 验证手机校验码并绑定手机
	 */
	public function getSmsCodeOp(){
		$code = strtolower(trim($_GET['code']));
		$mobile = uk86_cookie('mobile_'.$_SESSION['member_id']);
		$verify = strtolower(uk86_cookie('mobile_code_'.$_SESSION['member_id']));
		if($verify == ''){
			exit(json_encode(array('state' => false, 'msg' => '操作超时或校验码已被使用，请重新获取校验码')));
		}
		if($verify == $code){
			//绑定手机
			$update = array();
			$update['member_mobile'] = $mobile;
			$update['member_mobile_bind'] = 1;
			$result = Model('member')->where($this->condition)->update($update);
			uk86_setNcCookie('mobile_code_'.$_SESSION['member_id'], '', '1800');
			if($result){
				exit(json_encode(array('state' => true, 'msg' => '手机绑定成功', 'url' => 'index.php?act=wap_member_setting&op=memberAccountNumber')));
			}else{
				exit(json_encode(array('state' => false, 'msg' => '系统错误，请与管理员联系')));
			}
		}
		exit(json_encode(array('state' => false, 'msg' => '校验码错误，请重新验证')));
	}
	
	/**
	 * 修改邮箱,发送手机校验码
	 */
	public function change_emailOp(){
		$member_info = Model('member')->where($this->condition)->field('member_mobile,  member_email')->find();
		if($_GET['type'] == 1){
			//发送手机校验码
			$sms = new Uk86Sms();
			$verify_code = rand(100,999).rand(100,999);
			//校验码存入kookie
			uk86_setNcCookie('mobile_code_'.$_SESSION['member_id'], $verify_code, '1800');
			$content = '【'.C('site_name').'】您与'.date('Y-m-d H:i').'修改绑定邮箱校验码为：'.$verify_code.',30分钟有效。';
			$sms->uk86_send(trim($member_info['member_mobile']), $content);
		}
		foreach ($member_info as $k => $v){
			if($v == ''){
				unset($member_info[$k]);
				continue;
			}
			$member_info[$k] = $this->get_md6($member_info[$k]);
		}
		Tpl::output('member_info', $member_info);
		Tpl::showpage('change_email');
	}
	
	/**
	 * 修改邮箱时验证校验码
	 */
	public function getSmsCodebyOp(){
		$code = strtolower(trim($_GET['code']));
		$verify = strtolower(uk86_cookie('mobile_code_'.$_SESSION['member_id']));
		if($verify == ''){
			exit(json_encode(array('state' => false, 'msg' => '操作超时或校验码已被使用，请重新获取校验码')));
		}
		if($verify == $code){
			uk86_setNcCookie('mobile_code_'.$_SESSION['member_id'], '', '1800');
			exit(json_encode(array('state' => true, 'msg' => '校验成功，可进行下一步操作', 'url' => 'index.php?act=wap_member_change&op=send_email')));
		}
		exit(json_encode(array('state' => false, 'msg' => '校验码错误，请重新验证')));
	}
	
	/**
	 * 绑定新邮箱
	 */
	public function send_emailOp(){
		Tpl::showpage('change_email.send');
	}
	
	/**
	 * 绑定邮箱发送邮箱校验码
	 */
	public function get_email_codeOp(){
		$email = trim($_GET['email']);
		if(empty($email)){
			exit(json_encode(array('state' => false, 'msg' => '请输入接收校验码的邮箱地址')));
		}
		//邮箱不能重复
		$relult1 = Model()->table('member')->where(array('member_email' => $email))->field('member_id')->find();
		if(!empty($relult1['member_id'])){
			exit(json_encode(array('state' => false, 'msg' => '该邮箱已被其他会员使用，请使用其他邮箱地址')));
		}
		$email_class = new Uk86Email();
		$verify_code = rand(100,999).rand(100,999);
		//校验码存入kookie
		uk86_setNcCookie('email_code_'.$_SESSION['member_id'], $verify_code, '1800');
		//邮箱存入kookie
		uk86_setNcCookie('email_'.$_SESSION['member_id'], $email, '2000');
		$subject = C('site_name').'安全校验码';
		$message = '【'.C('site_name').'】您与'.date('Y-m-d H:i').'绑定邮箱校验码为：'.$verify_code.',请在30分钟内完成验证。';
		$relult = $email_class->uk86_send_sys_email($email, $subject, $message);
		if($relult){
			exit(json_encode(array('state' => true, 'msg' => '校验码已发送至您的邮箱，请尽快完成验证')));
		}
		exit(json_encode(array('state' => false, 'msg' => '邮件发送失败，请与管理员联系')));
	}
	
	/**
	 * 验证邮箱校验码并绑定邮箱
	 */
	public function getEmailCodeOp(){
		$code = strtolower(trim($_GET['code']));
		$_code = strtolower(uk86_cookie('email_code_'.$_SESSION['member_id']));
		$email = uk86_cookie('email_'.$_SESSION['member_id']);
		if(empty($_code)){
			exit(json_encode(array('state' => false, 'msg' => '操作超时或校验码已被使用，请重新发送校验码')));
		}
		if($code == $_code){
			//绑定邮箱
			$update = array();
			$update['member_email'] = $email;
			$update['member_email_bind'] = 1;
			$result = Model()->table('member')->where($this->condition)->update($update);
			uk86_setNcCookie('email_code_'.$_SESSION['member_id'], '', '1800');
			if($result){
				exit(json_encode(array('state' => true, 'msg' => '邮箱绑定成功', 'url' => 'index.php?act=wap_member_setting&op=memberAccountNumber')));
			}else{
				exit(json_encode(array('state' => false, 'msg' => '邮箱绑定失败，请重试')));
			}
		}
		exit(json_encode(array('state' => false, 'msg' => '校验码错误，请重新验证')));
		
	}
	
	/**
	 * 修改支付密码安全校验
	 */
	public function changePayPwdOp(){
		$member_info = Model()->table('member')->where($this->condition)->field('member_mobile, member_mobile_bind, member_email, member_email_bind')->find();
		$member_info_new = array();
		if($member_info['member_email_bind'] == 1){
			$member_info_new[0]['type'] = $this->get_md6($member_info['member_email']);
			$member_info_new[0]['value'] = 'email';
		}
		if($member_info['member_mobile_bind'] == 1){
			$member_info_new[1]['type'] = $this->get_md6($member_info['member_mobile']);
			$member_info_new[1]['value'] = 'mobile';
		}
		Tpl::output('member_info', $member_info_new);
		Tpl::showpage('change_paypwd');
	}
	
	/**
	 * 修改支付密码时发送校验码
	 */
	public function getCodeByPaypwdOp(){
		$value = $_GET['value'];
		if($value == ''){
			exit(json_encode(array('state' => false, 'msg' => '请选择校验码接收方式')));
		}
		$member_info = Model()->table('member')->where($this->condition)->field('member_mobile, member_email')->find();
		$verify_code = rand(100,999).rand(100,999);
		//校验码存入kookie
		uk86_setNcCookie('pay_code_'.$_SESSION['member_id'], $verify_code, '1800');
		if($value == 'mobile'){
			$sms = new Uk86Sms();
			$content = '【'.C('site_name').'】您与'.date('Y-m-d H:i').'设置支付密码校验码为：'.$verify_code.',30分钟有效。';
			$result = $sms->uk86_send(trim($member_info['member_mobile']), $content);
			$msg = '校验码已成功发送至您的手机，请在30分钟内完成验证';
		}elseif($value == 'email'){
			$email = new Uk86Email();
			$subject = C('site_name').'安全校验码';
			$message = '【'.C('site_name').'】您与'.date('Y-m-d H:i').'设置支付密码校验码为：'.$verify_code.',请在30分钟内完成验证。';
			$result = $email->uk86_send_sys_email(trim($member_info['member_email']), $subject, $message);
			$msg = '校验码已成功发送至您的邮箱，请在30分钟内完成验证';
		}
		if($result){
			exit(json_encode(array('state' => true, 'msg' => $msg)));
		}else{
			exit(json_encode(array('state' => false, 'msg' => '校验码发送失败，请联系管理员')));
		}
	}
	
	/**
	 * 验证修改支付密码时的安全校验码
	 */
	public function sendCodeByPaypwdOp(){
		$code = trim($_GET['code']);
		$verify_code = uk86_cookie('pay_code_'.$_SESSION['member_id']);
		if(empty($verify_code)){
			exit(json_encode(array('state' => false, 'msg' => '操作超时或校验码已被使用，请重新获取校验码')));
		}
		if($code == $verify_code){
			uk86_setNcCookie('pay_code_'.$_SESSION['member_id'], '');
			exit(json_encode(array('state' => true, 'msg' => '校验码验证成功，可进行下一步操作', 'url' => 'index.php?act=wap_member_change&op=changePaypwdIndex')));
		}else{
			exit(json_encode(array('state' => false, 'msg' => '校验码错误，请重新获取校验码')));
		}
	}
	
	/**
	 * 修改支付密码
	 */
	public function changePaypwdIndexOp(){
		if($_POST['is_post'] == 'ok'){
			$result = Model()->table('member')->where($this->condition)->update(array('member_paypwd' => md5($_POST['paypwd'])));
			if($result){
				exit('10');
			}
			exit('0');
		}
		Tpl::showpage('change_paypwd.index');
	}
	
	/**
	 * 修改登录密码
	 */
	public function changLoginPwdOp(){
		if($_POST['sumbmit'] == 'ok'){
			$member_model = Model('member');
			$member_info = $member_model->where($this->condition)->field('member_passwd')->find();
			if($member_info['member_passwd'] === md5($_POST['old_pwd'])){
				$update['member_passwd'] = md5($_POST['new_pwd']);
				$result = $member_model->where($this->condition)->update($update);
				if($result){
					exit('1');
				}else{
					exit('-1');
				}
			}else{
				exit('0');
			}
		}else{
			Tpl::showpage('change_loginpwd.index');
		}
	}
	
	/**
	 * 使用*加密某些信息
	 * @param string $string
	 * @param number $num1 起始位置（从0开始）
	 * @param number $num2 加密位数
	 * @return string|string 返回加密后的字符串
	 */
	private function get_md6($string, $num1 = 2, $num2 = 4){
		if(strlen($string) <= $num1){
			return $string;
		}
		$array = array();
		for ($i = 0; $i < strlen($string); $i++){
			$array[] = substr($string, $i, 1);
		}
		$j = 0;
		foreach ($array as $k => $v){
			if($k > $num1){
				if($j >= $num2){
					break;
				}
				$array[$k] = '*';
				$j++;
			}
		}
		return implode('', $array);
	}
}
?>