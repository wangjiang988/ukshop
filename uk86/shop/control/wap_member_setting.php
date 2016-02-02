<?php
/**
 * 
 * 会员中心 设置
 * @author ZHUXUESONG
 */
defined('InUk86') or exit('Access Invalid!');

class wap_member_settingControl extends BaseWapControl{
	public function __construct(){
		parent::__construct();
		//验证是否登录
		if(!$_SESSION['is_login']){
			header('Location:index.php?act=wap_login&op=login');
		}
	}
	
	/**
	 * 个人设置首页
	 */
	public function indexOp(){
		Tpl::showpage('setting.index');
	}
	/**
	 * 会员账户信息
	 */
	public function accountOp(){
		header('Content-type:text/html; charset=utf-8');
		$model = Model();
		//会员信息
		$field = 'member_id, member_name, member_truename, member_avatar, member_sex, member_birthday, member_email, member_email_bind, member_mobile, member_mobile_bind, member_qqopenid, member_qqinfo, member_ww, member_areainfo';
		$member_info = $model->table('member')->where(array('member_id' => $_SESSION['member_id']))->field($field)->find();
		Tpl::output('member_info', $member_info);
		Tpl::output('member_qqinfo', unserialize($member_info['member_qqinfo']));
		//p(unserialize($member_info['member_qqinfo']));die();
		Tpl::showpage('setting.account');
	}
	
	/**
	 * 更换用户头像
	 */
	public function change_avatarOp(){
		$member_info = Model('member')->getMemberInfoByID($_SESSION['member_id'],'member_avatar');
		Tpl::output('member_info', $member_info);
		Tpl::showpage('setting.account_avatar');
	}
	
	/**
	 * 上传图片
	 */
	public function uploadOp() {
		if (!uk86_chksubmit()){
			uk86_redirect('index.php?act=wap_member_setting&op=change_avatar');
		}
		uk86_import('function.thumb');
		$member_id = $_SESSION['member_id'];
	
		//上传图片
		$upload = new Uk86UploadFile();
		$upload->uk86_set('thumb_width',500);
		$upload->uk86_set('thumb_height',499);
		$ext = strtolower(pathinfo($_FILES['pic']['name'], PATHINFO_EXTENSION));
		$upload->uk86_set('file_name',"avatar_$member_id.$ext");
		$upload->uk86_set('thumb_ext','_new');
		$upload->uk86_set('ifremove',true);
		$upload->uk86_set('default_dir',ATTACH_AVATAR);
		if (!empty($_FILES['pic']['tmp_name'])){
			$result = $upload->uk86_upfile('pic');
			if (!$result){
				$this->wap_showDialog($upload->error);
			}
		}else{
			$this->wap_showDialog('上传失败，请尝试更换图片格式或小图片');
		}
		Tpl::output('menu_sign','profile');
		Tpl::output('menu_sign_url','index.php?act=member_information&op=member');
		Tpl::output('menu_sign1','avatar');
		Tpl::output('newfile',$upload->thumb_image);
		Tpl::output('height',uk86_get_height(BASE_UPLOAD_PATH.'/'.ATTACH_AVATAR.'/'.$upload->thumb_image));
		Tpl::output('width',uk86_get_width(BASE_UPLOAD_PATH.'/'.ATTACH_AVATAR.'/'.$upload->thumb_image));
		Tpl::showpage('setting.account_avatar');
	}
	
	/**
	 * 裁剪
	 *
	 */
	public function cutOp(){
		if (uk86_chksubmit()){
			$thumb_width = 120;
			$x1 = $_POST["x1"];
			$y1 = $_POST["y1"];
			$x2 = $_POST["x2"];
			$y2 = $_POST["y2"];
			$w = $_POST["w"];
			$h = $_POST["h"];
			$scale = $thumb_width/$w;
			$_POST['newfile'] = str_replace('..', '', $_POST['newfile']);
			if (strpos($_POST['newfile'],"avatar_{$_SESSION['member_id']}_new.") !== 0) {
				uk86_redirect('index.php?act=wap_member_setting&op=change_avatar');
			}
			$src = BASE_UPLOAD_PATH.DS.ATTACH_AVATAR.DS.$_POST['newfile'];
			$avatarfile = BASE_UPLOAD_PATH.DS.ATTACH_AVATAR.DS."avatar_{$_SESSION['member_id']}.jpg";
			uk86_import('function.thumb');
			$cropped = uk86_resize_thumb($avatarfile, $src,$w,$h,$x1,$y1,$scale);
			@unlink($src);
			Model('member')->editMember(array('member_id'=>$_SESSION['member_id']),array('member_avatar'=>'avatar_'.$_SESSION['member_id'].'.jpg'));
			$_SESSION['avatar'] = 'avatar_'.$_SESSION['member_id'].'.jpg';
			uk86_redirect('index.php?act=wap_member_setting&op=change_avatar');
		}
	}
	
	/**
	 * 更改用户名
	 */
	public function changeMemberNameOp(){
		$member_model = Model('member');
		$result = $member_model->where('member_name = "'.$_GET['member_name'].'" and member_id != '.intval($_SESSION['member_id']))->field('member_id')->find();
		if(intval($result['member_id']) > 0){
			exit(json_encode(array('state' => false, 'msg' => '该用户名已被其他会员使用')));
		}
		$result = $member_model->where(array('member_id' => intval($_SESSION['member_id'])))->update(array('member_name' => trim($_GET['member_name'])));
		if($result){
			$_SESSION['member_name'] = $_GET['member_name'];
			exit(json_encode(array('state' => true, 'msg' => '用户名修改成功')));
		}
		exit(json_encode(array('state' => false, 'msg' => '操作失败')));
	}
	/**
	 * 修改真实姓名
	 */
	public function changeMemberTrueNameOp(){
		$result = Model('member')->where(array('member_id' => intval($_SESSION['member_id'])))->update(array('member_truename' => $_GET['true_name']));
		if($result){
			exit(json_encode(array('state' => true, 'msg' => '真实名修改成功')));
		}
		exit(json_encode(array('state' => false, 'msg' => '操作失败')));
	}
	
	/**
	 * 修改用户性别
	 */
	public function changeMemberSexOp(){
		$result = Model('member')->where(array('member_id' => intval($_SESSION['member_id'])))->update(array('member_sex' => intval($_GET['sex'])));
		if($result){
			exit(json_encode(array('state' => true, 'msg' => '操作成功')));
		}
		exit(json_encode(array('state' => false, 'msg' => '操作失败')));
	}
	
	/**
	 * 账户安全首页
	 */
	public function memberAccountNumberOp(){
		$model = Model();
		//会员信息
		$field = 'member_id, member_name, member_paypwd, member_email, member_email_bind, member_mobile, member_mobile_bind, member_qqopenid, member_qqinfo, member_sinaopenid, member_sinainfo';
		$member_info = $model->table('member')->where(array('member_id' => $_SESSION['member_id']))->field($field)->find();
		$member_info['member_mobile'] = $this->get_md6($member_info['member_mobile']);
		$member_info['member_email'] = $this->get_md6($member_info['member_email'], 2, 5);
		Tpl::output('member_info', $member_info);
		Tpl::output('member_qqinfo', unserialize($member_info['member_qqinfo']));
		Tpl::output('member_sinainfo', unserialize($member_info['member_sinainfo']));
		Tpl::showpage('setting.account_number');
	}
	
	/**
	 * 修改用户所在地区
	 */
	public function memberAddressOp(){
		$model_member = Model('member');
		$condition['member_id'] = intval($_SESSION['member_id']);
		if(!empty($_POST['area_id'])){
			$update = array();
			$update['member_areaid'] = intval($_POST['area_id']);
			$update['member_areainfo'] = $_POST['area_info'];
			$result = $model_member->where($condition)->update($update);
			if($result){
				exit(true);
			}
			exit(false);
		}else{
			$member_info = $model_member->where($condition)->field('member_areainfo, member_areaid')->find();
			Tpl::output('area_info', $member_info['member_areainfo']);
			Tpl::output('area_id', $member_info['member_areaid']);
			Tpl::showpage('setting.areainfo');
		}
	}
	
	/**
	 * QQ解绑
	 */
	public function qqunbindOp(){
		//修改密码
		$model_member	= Model('member');
		if(!empty($_POST['is_editpw'])){
			$update_arr['member_qqopenid'] = '';
			$update_arr['member_qqinfo'] = '';
			$edit_state	= $model_member->editMember(array('member_id'=>$_SESSION['member_id']),$update_arr);
			if(!$edit_state) {
				$this->wap_showDialog('操作失败','error');
			}
			session_unset();
			session_destroy();
			$this->wap_showDialog('QQ解除绑定成功，您需要重新登录', 'succ', 'index.php?act=wap_login&op=login');
		}
	}
	
	/**
	 * sina解绑
	 */
	public function sinaunbindOp(){
		//修改密码
		$model_member	= Model('member');
		if(!empty($_POST['is_editpw'])){
			$update_arr['member_sinaopenid'] = '';
			$update_arr['member_sinainfo'] = '';
			$edit_state = $model_member->editMember(array('member_id'=>$_SESSION['member_id']),$update_arr);
			if(!$edit_state) {
				$this->wap_showDialog('操作失败','error');
			}
			session_unset();
			session_destroy();
			$this->wap_showDialog('微博解除绑定成功，您需要重新登录', 'succ', 'index.php?act=wap_login&op=login');
		}
	}
	
	public function setting_brithdayOp(){
		$member_model = Model('member');
		if(!empty($_POST['birthday'])){
			$date = $_POST['birthday'];
			$result = $member_model->where(array('member_id'=>$_SESSION['member_id']))->update(array('member_birthday' => $date));
			if($result){
				exit('10');
			}
			exit('0');
		}else{
			$birthday = $member_model->where(array('member_id'=>$_SESSION['member_id']))->field('member_birthday')->find();
			Tpl::output('birthday', $birthday['member_birthday']);
			if(empty($birthday['member_birthday'])){
				Tpl::output('date', '');
			}else{
				$array = explode('-', $birthday['member_birthday']);
				$array[1] = intval($array[1]) -1;
				$str = implode(', ', $array);
				Tpl::output('date', $str);
			}
			Tpl::showpage('setting.birthday');
		}
	}
	
	/**
	 * 使用*加密某些信息
	 * @param string $string
	 * @param number $num1
	 * @param number $num2
	 * @return string|string
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