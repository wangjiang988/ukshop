<?php
/**
 * 会员登录
 * @author ZHUXUESONG
 *
 */
defined('InUk86') or exit('Access Invalid!');

class wap_loginControl extends BaseWapControl{
	//如果已登录跳转至首页
	public function __construct(){
		parent::__construct();
		if($_SESSION['is_login'] == '1'){
			header('Location:index.php?act=wap_index');
		}
	}
	/**
	 * 跳转登录页面
	 */
	public function loginOp(){
		$user_agent = $_SERVER['HTTP_USER_AGENT'];
		if (strpos($user_agent, 'MicroMessenger') !== false) {
			header('Location:index.php?act=wxuser&op=index');
		}
		Tpl::showpage('login');
	}
	
	/**
	 * 登录操作
	 */
	public function login_actionOp(){
		$model_member = Model('member');
		$array	= array();
		$array['member_name']	= $_POST['member_name'];
		$array['member_passwd']	= md5($_POST['member_password']);
		$member_info = $model_member->getMemberInfo($array);
		$return_data = array();
 		if(!empty($member_info) && is_array($member_info)){
 			//会员信息写入session
			$model_member->createSession($member_info);
			$return_data['success'] = '1';	
 		}else{
 			$return_data['success'] = '0';
 		}
 		echo json_encode($return_data);
	}
	
	/**
	 * 注册页面
	 */
	public function registerOp(){
		$url = $_GET['url'];
		Tpl::output('url', $url);
		Tpl::showpage('register');
	}
	
	/**
	 * 注册操作
	 */
	public function register_actionOp(){
		$insert_array = array();
		$insert_array['member_name'] = $_POST['member_name'];
		$insert_array['member_passwd'] = md5($_POST['password']);
		$insert_array['member_email'] = $_POST['email'];
		$insert_array['member_email_bind'] = 1;
		$insert_array['member_time'] = time();
		$insert_array['member_login_time'] = $insert_array['member_time'];
		$insert_array['member_points'] = 20;
		$insert_array['member_login_ip'] = uk86_getIp();
		$result = Model('member')->insert($insert_array);
		if(!empty($result)){
			$_SESSION['is_login'] = 1;
			$_SESSION['member_id'] = intval($result);
			$_SESSION['member_name'] = $insert_array['member_name'];
			$_SESSION['member_email'] = $insert_array['member_email'];
			$_SESSION['is_buy'] = 1;
			//添加积分记录
			$pl_array = array();
			$pl_array['pl_memberid'] = intval($result);
			$pl_array['pl_membername'] = $insert_array['member_name'];
			$pl_array['pl_points'] = 20;
			$pl_array['pl_addtime'] = $insert_array['member_time'];
			$pl_array['pl_desc'] = '会员注册';
			$pl_array['pl_stage'] = 'regist';
			Model('points_log')->insert($pl_array);
			//添加经验值
			$exp_array = array();
			$exp_array['exp_memberid'] = intval($result);
			$exp_array['exp_membername'] = $insert_array['member_name'];
			$exp_array['exp_points'] = 5;
			$exp_array['exp_addtime'] = $insert_array['member_time'];
			$exp_array['exp_desc'] = '会员登录';
			$exp_array['exp_stage'] = 'login';
			Model('exppoints_log')->insert($exp_array);
			echo 11;
		}else{
			echo 10;
		}
	}
	
	/**
	 * 找回密码
	 */
	public function find_passwordOp(){
		Tpl::showpage('find_password');
	}
	
	/**
	 * 修改密码
	 */
	public function edit_passwordOp(){
		if(!empty($_POST['member_id'])){
			$update['member_passwd'] = md5($_POST['password']);
			$result = Model('member')->where(array('member_id' => intval($_POST['member_id'])))->update($update);
			if($result){
				exit('true');
			}else{
				exit('false');
			}
		}else{
			Tpl::showpage('find_password.edit');
		}
	}
	
	/**
	 * 验证用户名是否已存在
	 */
	public function check_memberOp(){
		$member_name = $_POST['member_name'];
		$result = Model()->table('member')->where(array('member_name' => $member_name))->field('member_id')->find();
		if(intval($result['member_id']) > 0){
			echo '用户名已存在';
		}
	}
	
	/**
	 * 注册时验证电子邮箱是否已被注册
	 */
	public function checkEmailOp(){
		$result = Model('member')->where(array('member_email' => $_GET['email']))->field('member_id, member_name')->find();
		if(!empty($result['member_id'])){
			exit(true);
		}
		exit(false);
	}
	
	/**
	 * 退出登录操作
	 */
	public function login_outOp(){
		uk86_setNcCookie('msgnewnum'.$_SESSION['member_id'],'',-3600);
		session_unset();
		session_destroy();
		uk86_setNcCookie('cart_goods_num','',-3600);
		$url = uk86_getReferer();
		uk86_redirect('index.php?act=wap_login&op=login&url='.$url);
	}
}