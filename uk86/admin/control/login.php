<?php
/**
 * 登录
 *
 * 包括 登录 验证 退出 操作
 *
 **by Uk86 商城开发*/

defined('InUk86') or exit('Access Invalid!');
class LoginControl extends SystemControl {

	/**
	 * 不进行父类的登录验证，所以增加构造方法重写了父类的构造方法
	 */
	public function __construct(){
		Uk86Language::uk86_read('common,layout,login');
	    $result = uk86_chksubmit(true,true,'num');
		if ($result){
		    if ($result === -11){
		        uk86_showMessage('非法请求');
		    }elseif ($result === -12){
		        uk86_showMessage(L('login_index_checkcode_wrong'));
		    }
		    if (Uk86process::uk86_islock('admin')) {
		        uk86_showMessage('您的操作过于频繁，请稍后再试');
		    }
			$obj_validate = new Uk86Validate();
			$obj_validate->validateparam = array(
			array("input"=>$_POST["user_name"],		"require"=>"true", "message"=>L('login_index_username_null')),
			array("input"=>$_POST["password"],		"require"=>"true", "message"=>L('login_index_password_null')),
			array("input"=>$_POST["captcha"],		"require"=>"true", "message"=>L('login_index_checkcode_null')),
			);
			$error = $obj_validate->uk86_validate();
			if ($error != ''){
				uk86_showMessage(L('error').$error);
			}else {

				$model_admin = Model('admin');
				$array	= array();
				$array['admin_name']	= $_POST['user_name'];
				$array['admin_password']= md5(trim($_POST['password']));
				$admin_info = $model_admin->infoAdmin($array);
				if(is_array($admin_info) and !empty($admin_info)) {

					$this->systemSetKey(array('name'=>$admin_info['admin_name'], 'id'=>$admin_info['admin_id'],'gid'=>$admin_info['admin_gid'],'sp'=>$admin_info['admin_is_super']));
					$update_info	= array(
					'admin_id'=>$admin_info['admin_id'],
					'admin_login_num'=>($admin_info['admin_login_num']+1),
					'admin_login_time'=>TIMESTAMP
					);
					$model_admin->updateAdmin($update_info);
					$this->log(L('nc_login'),1);
					Uk86process::uk86_clear('admin');
					@header('Location: index.php');exit;
				}else {
				    Uk86process::uk86_addprocess('admin');
					uk86_showMessage(L('login_index_username_password_wrong'),'index.php?act=login&op=login');
				}
			}
		}
		Tpl::output('html_title',L('login_index_need_login'));
		Tpl::showpage('login','login_layout');
	}
	public function loginOp(){}
	public function indexOp(){}
}
