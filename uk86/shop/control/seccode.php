<?php
/**
 * 验证码
 * 
 *by Uk86 商城开发
 */
defined('InUk86') or exit('Access Invalid!');

class seccodeControl{
	public function __construct(){
	}

	/**
	 * 产生验证码
	 *
	 */
	public function makecodeOp(){
		$refererhost = parse_url($_SERVER['HTTP_REFERER']);
		$refererhost['host'] .= !empty($refererhost['port']) ? (':'.$refererhost['port']) : '';

		$seccode = uk86_makeSeccode($_GET['nchash']);

		@header("Expires: -1");
		@header("Cache-Control: no-store, private, post-check=0, pre-check=0, max-age=0", FALSE);
		@header("Pragma: no-cache");

		$code = new Uk86seccode();
		$code->code = $seccode;
		$code->width = 90;
		$code->height = 26;
		$code->background = 1;
		$code->adulterate = 1;
		$code->scatter = '';
		$code->color = 1;
		$code->size = 0;
		$code->shadow = 1;
		$code->animator = 0;
		$code->datapath =  BASE_DATA_PATH.'/resource/seccode/';
		$code->display();
	}
	
	/**
	 * 邮件发送验证码
	 */
	public function makecode_emailOp(){
		$code = uk86_getNchash();
		$seccode = uk86_makeSeccode($code);
		
		$email = new Uk86Email();
		$subject = C('site_name').'注册验证';
		$message = '您在'.C('site_name').'注册的验证码是'.$seccode.'，请在30分钟内完成验证。';
		$result = $email->uk86_send_sys_email($_GET['email'], $subject, $message);
		if($result){
			exit($code);
		}
		exit();
	}

	/**
	 * AJAX验证
	 *
	 */
	public function checkOp(){
		if (uk86_checkSeccode($_GET['nchash'],$_GET['captcha'])){
			exit('true');
		}else{
			exit('false');
		}
	}
	
	/**
	 * 手机端找回密码发送验证码
	 */
	public function wap_makecodeOp(){		
		$email_to = $_GET['email'];
		//验证邮箱
		$email_result = Model()->table('member')->where(array('member_email' => $email_to))->field('member_id')->find();
		if(empty($email_result['member_id'])){
			exit(json_encode(array('state' => false, 'msg' => '邮箱地址不正确，请核对邮箱')));
		}
		
		$code = uk86_getNchash();
		$seccode = uk86_makeSeccode($code);
		
		$email = new Uk86Email();
		$subject = C('site_name').'找回密码验证';
		$message = '您在'.C('site_name').'找回密码使用的验证码是'.$seccode.'，请在30分钟内完成验证。';
		$result = $email->uk86_send_sys_email($email_to, $subject, $message);
		if($result){
			exit(json_encode(array('state' => true, 'msg' => $code, 'member_id' => $email_result['member_id'])));
		}
		exit(json_encode(array('state' => false, 'msg' => '邮件发送失败')));
	}
	
	/**
	 * 验证验证码
	 */
	public function wap_checkOp(){
		if (uk86_checkSeccode($_GET['nchash'],$_GET['captcha'])){
			exit(json_encode(array('state' => true, 'msg' => 'index.php?act=wap_login&op=edit_password')));
		}else{
			exit(json_encode(array('state' => false, 'msg' => '验证码不正确,请重新验证')));
		}
	}
}

?>
