<?php
/**
 * 前台登录 退出操作
 *
 *
 *
 *by Uk86 商城开发
 */
defined('InUk86') or exit('Access Invalid!');

class loginControl extends BaseHomeControl {

	public function __construct(){
		parent::__construct();
		Tpl::output('hidden_nctoolbar', 1);
	}

	/**
	 * 登录操作
	 *
	 */
	public function indexOp(){
		Uk86Language::uk86_read('common,home_layout_new');
		Tpl::setLayout('home_layout_new');

		Uk86Language::uk86_read("home_login_index");
		$lang	= Uk86Language::uk86_getLangContent();
		$model_member	= Model('member');
		//检查登录状态
		$model_member->checkloginMember();
		if ($_GET['inajax'] == 1 && C('captcha_status_login') == '1'){
		    $script = "document.getElementById('codeimage').src='".APP_SITE_URL."/index.php?act=seccode&op=makecode&nchash=".uk86_getNchash()."&t=' + Math.random();";
		}
		$result = uk86_chksubmit(true,C('captcha_status_login'),'num');
		if ($result !== false){
			if ($result === -11){
				showDialog($lang['login_index_login_illegal'],'','error',$script);
			}elseif ($result === -12){
				showDialog($lang['login_index_wrong_checkcode'],'','error',$script);
			}
			if (Uk86process::uk86_islock('login')) {
				showDialog($lang['nc_common_op_repeat'],SHOP_SITE_URL,'','error',$script);
			}
			$obj_validate = new Uk86Validate();
			$obj_validate->validateparam = array(
				array("input"=>$_POST["user_name"],		"require"=>"true", "message"=>$lang['login_index_username_isnull']),
				array("input"=>$_POST["password"],		"require"=>"true", "message"=>$lang['login_index_password_isnull']),
			);
			$error = $obj_validate->uk86_validate();
			if ($error != ''){
			   showDialog($error,SHOP_SITE_URL,'error',$script);
			}
			$array	= array();
			$array['member_name']	= $_POST['user_name'];
			$array['member_passwd']	= md5($_POST['password']);
			$check_member_username	= $model_member->getMemberInfo(array('member_name'=>$_POST['user_name']));
			$member_info = $model_member->getMemberInfo($array);
			if(is_array($check_member_username) and count($check_member_username)>0){
				if(is_array($member_info) and !empty($member_info)) {
					if(!$member_info['member_state']){
						showDialog($lang['login_index_account_stop'],''.'error',$script);
					}
				}else{
					Uk86process::uk86_addprocess('login');
					showDialog($lang['login_index_login_fail'],'','error',$script);
				}
			}else{
				Uk86process::uk86_addprocess('login');
				showDialog($lang['login_index_login_fail_username'],'','error',$script);
			}


    		$model_member->createSession($member_info);
			Uk86process::uk86_clear('login');
			
			//$model_member->editMember(array('member_id' => $member_info['member_id']), array('member_email_bind' => 1));

			// cookie中的cart存入数据库
			Model('cart')->mergecart($member_info,$_SESSION['store_id']);

			// cookie中的浏览记录存入数据库
			Model('goods_browse')->mergebrowse($_SESSION['member_id'],$_SESSION['store_id']);

			if ($_GET['inajax'] == 1){
			   showDialog('',$_POST['ref_url'] == '' ? 'reload' : $_POST['ref_url'],'js');
			} else {
			    uk86_redirect($_POST['ref_url']);
			}
		}else{

			//登录表单页面
			$_pic = @unserialize(C('login_pic'));
			if ($_pic[0] != ''){
				Tpl::output('lpic',UPLOAD_SITE_URL.'/'.ATTACH_LOGIN.'/'.$_pic[array_rand($_pic)]);
			}else{
				Tpl::output('lpic',UPLOAD_SITE_URL.'/'.ATTACH_LOGIN.'/'.rand(1,4).'.jpg');
			}

			if(empty($_GET['ref_url'])) {
			    $ref_url = uk86_getReferer();
			    if (!preg_match('/act=login&op=logout/', $ref_url)) {
			     $_GET['ref_url'] = $ref_url;
			    }
			}
			Tpl::output('html_title',C('site_name').' - '.$lang['login_index_login']);
			if ($_GET['inajax'] == 1){
				Tpl::showpage('login_inajax','null_layout');
			}else{
				Tpl::showpage('login');
			}
		}
	}

	/**
	 * 退出操作
	 *
	 * @param int $id 记录ID
	 * @return array $rs_row 返回数组形式的查询结果
	 */
	public function logoutOp(){
		Uk86Language::uk86_read("home_login_index");
		$lang	= Uk86Language::uk86_getLangContent();
		// 清理消息COOKIE
		uk86_setNcCookie('msgnewnum'.$_SESSION['member_id'],'',-3600);
		session_unset();
		session_destroy();
		uk86_setNcCookie('cart_goods_num','',-3600);
		if(empty($_GET['ref_url'])){
			$ref_url = uk86_getReferer();
		}else {
			$ref_url = $_GET['ref_url'];
		}
		uk86_redirect('index.php?act=login&ref_url='.urlencode($ref_url));
	}

	/**
	 * 会员注册页面
	 *
	 * @param
	 * @return
	 */
	public function registerOp() {
		Uk86Language::uk86_read('common,home_layout_new');
		Tpl::setLayout('home_layout_new');
		Uk86Language::uk86_read("home_login_register");
		$lang	= Uk86Language::uk86_getLangContent();
		$model_member	= Model('member');
		$model_member->checkloginMember();
		Tpl::output('html_title',C('site_name').' - '.$lang['login_register_join_us']);
		Tpl::showpage('register');
	}

	/**
	 * 会员添加操作
	 *
	 * @param
	 * @return
	 */
	public function usersaveOp() {
		//重复注册验证
		if (Uk86process::uk86_islock('reg')){
			showDialog(Uk86Language::uk86_get('nc_common_op_repeat'));
		}
		Uk86Language::uk86_read("home_login_register");
		$lang	= Uk86Language::uk86_getLangContent();
		$model_member	= Model('member');
		$model_member->checkloginMember();
		$result = uk86_chksubmit(true,C('captcha_status_register'),'num');
		if ($result){
			if ($result === -11){
				showDialog($lang['invalid_request'],'','error');
			}elseif ($result === -12){
				showDialog($lang['login_usersave_wrong_code'],'','error');
			}
		} else {
		   showDialog($lang['invalid_request'],'','error');
		}
        $register_info = array();
        $register_info['username'] = $_POST['user_name'];
        $register_info['password'] = $_POST['password'];
        $register_info['password_confirm'] = $_POST['password_confirm'];
        $register_info['email'] = $_POST['email'];
		//添加奖励U币ID 
		//$register_info['inviter_id'] = intval($_COOKIE['uid'])/1;
		$register_info['inviter_id'] = intval(base64_decode($_COOKIE['uid']))/1;
        $member_info = $model_member->register($register_info);
        if(!isset($member_info['error'])) {
            $model_member->createSession($member_info,true);
			Uk86process::uk86_addprocess('reg');
			// cookie中的cart存入数据库
			Model('cart')->mergecart($member_info,$_SESSION['store_id']);

			// cookie中的浏览记录存入数据库
			Model('goods_browse')->mergebrowse($_SESSION['member_id'],$_SESSION['store_id']);

			$_POST['ref_url']	= (strstr($_POST['ref_url'],'logout')=== false && !empty($_POST['ref_url']) ? $_POST['ref_url'] : 'index.php?act=member_information&op=member');
			uk86_redirect($_POST['ref_url']);
        } else {
			showDialog($member_info['error']);
        }
	}
	/**
	 * 会员名称检测
	 *
	 * @param
	 * @return
	 */
	public function check_memberOp() {
			/**
		 	* 实例化模型
		 	*/
			$model_member	= Model('member');

			$check_member_name	= $model_member->getMemberInfo(array('member_name'=>$_GET['user_name']));
			if(is_array($check_member_name) and count($check_member_name)>0) {
				echo 'false';
			} else {
				echo 'true';
			}
	}

	/**
	 * 电子邮箱检测
	 *
	 * @param
	 * @return
	 */
	public function check_emailOp() {
		$model_member = Model('member');
		$check_member_email	= $model_member->getMemberInfo(array('member_email'=>$_GET['email']));
		if(is_array($check_member_email) and count($check_member_email)>0) {
			echo 'false';
		} else {
			echo 'true';
		}
	}

	/**
	 * 忘记密码页面
	 */
	public function forget_passwordOp(){
		/**
		 * 读取语言包
		 */
		Uk86Language::uk86_read('home_login_register');
		$_pic = @unserialize(C('login_pic'));
		if ($_pic[0] != ''){
			Tpl::output('lpic',UPLOAD_SITE_URL.'/'.ATTACH_LOGIN.'/'.$_pic[array_rand($_pic)]);
		}else{
			Tpl::output('lpic',UPLOAD_SITE_URL.'/'.ATTACH_LOGIN.'/'.rand(1,4).'.jpg');
		}
		Tpl::output('html_title',C('site_name').' - '.Uk86Language::uk86_get('login_index_find_password'));
		Tpl::showpage('find_password');
	}

	/**
	 * 找回密码的发邮件处理
	 */
	public function find_passwordOp(){
		Uk86Language::uk86_read('home_login_register');
		$lang	= Uk86Language::uk86_getLangContent();

		$result = uk86_chksubmit(true,true,'num');
		if ($result !== false){
		    if ($result === -11){
		       showDialog('非法提交');
		    }elseif ($result === -12){
		       showDialog('验证码错误');
		    }
		}

		if(empty($_POST['email'])){
			showDialog($lang['login_password_input_email']);
		}

		if (Uk86process::uk86_islock('forget')) {
		   showDialog($lang['nc_common_op_repeat'],'reload');
		}

		$member_model	= Model('member');
		$member	= $member_model->getMemberInfo(array('member_email'=>$_POST['email']));
		if(empty($member) or !is_array($member)){
		    Uk86process::uk86_addprocess('forget');
			showDialog($lang['login_password_email_not_exists'],'reload');
		}

// 		if(empty($_POST['email'])){
// 			showDialog($lang['login_password_input_email'],'reload');
// 		}
// 		if(strtoupper($_POST['email'])!=strtoupper($member['member_email'])){
// 		    Uk86process::uk86_addprocess('forget');
// 			showDialog($lang['login_password_email_not_exists'],'reload');
// 		}
		Uk86process::uk86_clear('forget');
		//产生密码
 	// 	$new_password	= uk86_random(15);
		// if(!($member_model->editMember(array('member_id'=>$member['member_id']),array('member_passwd'=>md5($new_password))))){
		// 	showDialog($lang['login_password_email_fail'],'reload');
		// }
		$temp = uk86_random(14);
		$_SESSION['temp_identifying_code'] = $temp;
		$_SESSION['temp_identifying_time'] = time();
		//	当然这种机制是有缺陷的，可以扩展uuid等构建缓存等。
		$_SESSION['temp_user_id'] = $member['member_id'];

		$model_tpl = Model('mail_templates');
		$tpl_info = $model_tpl->getTplInfo(array('code'=>'reset_pwd'));
		$param = array();
		$param['site_name']	= C('site_name');
		$param['user_name'] = $member['member_name'];
		$param['site_url'] = SHOP_SITE_URL.'/index.php?act=login&op=forget_password_identify&identity_code='.$temp;
		$subject	= uk86_ncReplaceText($tpl_info['title'],$param);
		$message	= uk86_ncReplaceText($tpl_info['content'],$param);
		$email	= new Uk86Email();
		$result	= $email->uk86_send_sys_email($_POST["email"],$subject,$message);
		showDialog('修改密码链接已经发送至您的邮箱，请在三十分钟内尽快更改密码！','','succ','',5);
	}

	/**
	 * 重置密码界面
	 */
	public function forget_password_identifyOp() {
		if (!($_SESSION['temp_identifying_time'] && $_SESSION['temp_identifying_code'])) {
			showDialog("参数不正确");
		}
		if (time() > $_SESSION['temp_identifying_time'] + 1800) {
			showDialog("时间已过期。");
		}

		if ($_SESSION['temp_identifying_code'] != $_GET['identity_code']) {
			showDialog("参数不正确");
		}

		if (Uk86process::uk86_islock('forget')) {
		   showDialog($lang['nc_common_op_repeat'],'reload');
		}

		$_pic = @unserialize(C('login_pic'));
		if ($_pic[0] != ''){
			Tpl::output('lpic',UPLOAD_SITE_URL.'/'.ATTACH_LOGIN.'/'.$_pic[array_rand($_pic)]);
		}else{
			Tpl::output('lpic',UPLOAD_SITE_URL.'/'.ATTACH_LOGIN.'/'.rand(1,4).'.jpg');
		}

		Tpl::output('html_title',C('site_name').' - 重设密码');
		Tpl::showpage('find_password_identify');
	}

	public function forget_password_identify_postOp(){
		Uk86Language::uk86_read('home_login_register');
		$lang	= Uk86Language::uk86_getLangContent();

		$result = uk86_chksubmit(true,true,'num');
		if ($result !== false){
		    if ($result === -11){
		       showDialog('非法提交');
		    }elseif ($result === -12){
		       showDialog('验证码错误');
		    }
		}

		if(empty($_POST['password'])){
			showDialog($lang['login_password_input_email']);
		}

		if (Uk86process::uk86_islock('forget')) {
		   showDialog($lang['nc_common_op_repeat'],'reload');
		}

		if (!$_SESSION['temp_user_id']) {
			showDialog("参数不正确");
		}

		echo $_SESSION['temp_user_id'];

		$member_model = Model('member');

		//	可能有注入问题
		if(!($member_model->editMember(array('member_id'=>$_SESSION['temp_user_id']),array('member_passwd'=>md5($_POST['password']))))){
			showDialog($lang['login_password_email_fail'],'reload');
		}

		$_SESSION['temp_identifying_time'] = $_SESSION['temp_identifying_time'] - 1800;
		showDialog("修改成功", 'index.php');

	}

	/**
	 * 邮箱绑定验证
	 */
	public function bind_emailOp() {
	   $model_member = Model('member');
	   $uid = @base64_decode($_GET['uid']);
	   $uid = uk86_decrypt($uid,'');
	   list($member_id,$member_email) = explode(' ', $uid);

	   if (!is_numeric($member_id)) {
	       uk86_showMessage('验证失败',SHOP_SITE_URL,'html','error');
	   }

	   $member_info = $model_member->getMemberInfo(array('member_id'=>$member_id),'member_email');
	   if ($member_info['member_email'] != $member_email) {
	       uk86_showMessage('验证失败',SHOP_SITE_URL,'html','error');
	   }

	   $member_common_info = $model_member->getMemberCommonInfo(array('member_id'=>$member_id));
	   if (empty($member_common_info) || !is_array($member_common_info)) {
	       uk86_showMessage('验证失败',SHOP_SITE_URL,'html','error');
	   }
	   if (md5($member_common_info['auth_code']) != $_GET['hash'] || TIMESTAMP - $member_common_info['send_acode_time'] > 24*3600) {
	       uk86_showMessage('验证失败',SHOP_SITE_URL,'html','error');
	   }

	   $update = $model_member->editMember(array('member_id'=>$member_id),array('member_email_bind'=>1));
	   if (!$update) {
	       uk86_showMessage('系统发生错误，如有疑问请与管理员联系',SHOP_SITE_URL,'html','error');
	   }

	   $data = array();
	   $data['auth_code'] = '';
	   $data['send_acode_time'] = 0;
	   $update = $model_member->editMemberCommon($data,array('member_id'=>$_SESSION['member_id']));
	   if (!$update) {
	      showDialog('系统发生错误，如有疑问请与管理员联系');
	   }
	   uk86_showMessage('邮箱设置成功','index.php?act=member_security&op=index');

	}
}
