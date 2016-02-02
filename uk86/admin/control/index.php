<?php
/**
 * 默认展示页面
 *
 * 默认展示页面
 *
 **by Uk86 商城开发*/

defined('InUk86') or exit('Access Invalid!');

class indexControl extends SystemControl{
	public function __construct(){
		parent::__construct();
		Uk86Language::uk86_read('index');
	}

	/**
	 * 后台首页
	 * @author bzhang
	 */
	public function indexOp(){
		//输出管理员信息
		Tpl::output('admin_info',$this->getAdminInfo());
		//输出菜单
		$this->getNav('',$top_nav,$left_nav,$map_nav);
		Tpl::output('top_nav',$top_nav);
		Tpl::output('left_nav',$left_nav);
		Tpl::output('map_nav',$map_nav);

		Tpl::showpage('index','index_layout');
	}

	/**
	 * 退出
	 */
	public function logoutOp(){
		uk86_setNcCookie('sys_key','',-1,'',null);
		@header("Location: index.php");
		exit;
	}
	/**
	 * 修改密码
	 */
	public function modifypwOp(){
		if (uk86_chksubmit()){
			if (trim($_POST['new_pw']) !== trim($_POST['new_pw2'])){
				//uk86_showMessage('两次输入的密码不一致，请重新输入');
				uk86_showMessage(Uk86Language::uk86_get('index_modifypw_repeat_error'));
			}
			$admininfo = $this->getAdminInfo();
			//查询管理员信息
			$admin_model = Model('admin');
			$admininfo = $admin_model->getOneAdmin($admininfo['id']);
			if (!is_array($admininfo) || count($admininfo)<= 0){
				uk86_showMessage(Uk86Language::uk86_get('index_modifypw_admin_error'));
			}
			//旧密码是否正确
			if ($admininfo['admin_password'] != md5(trim($_POST['old_pw']))){
				uk86_showMessage(Uk86Language::uk86_get('index_modifypw_oldpw_error'));
			}
			$new_pw = md5(trim($_POST['new_pw']));
			$result = $admin_model->updateAdmin(array('admin_password'=>$new_pw,'admin_id'=>$admininfo['admin_id']));
			if ($result){
				uk86_showMessage(Uk86Language::uk86_get('index_modifypw_success'));
			}else{
				uk86_showMessage(Uk86Language::uk86_get('index_modifypw_fail'));
			}
		}else{
			Uk86Language::uk86_read('admin');
			Tpl::showpage('admin.modifypw');
		}
	}
}