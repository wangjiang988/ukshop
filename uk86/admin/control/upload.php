<?php
/**
 * 上传设置
 *
 *
 *
 **by Uk86 商城开发*/

defined('InUk86') or exit('Access Invalid!');
class uploadControl extends SystemControl{
	private $links = array(
		array('url'=>'act=upload&op=param','lang'=>'upload_param'),
		array('url'=>'act=upload&op=default_thumb','lang'=>'default_thumb'),
		array('url'=>'act=upload&op=login','lang'=>'loginSettings'),
		array('url'=>'act=upload&op=tool','lang'=>'image_thumb_tool'),
		array('url'=>'act=upload&op=font','lang'=>'font_set')
	);
	public function __construct(){
		parent::__construct();
		Uk86Language::uk86_read('setting');
	}

	/**
	 * 上传参数设置
	 *
	 */
	public function paramOp(){
		if (uk86_chksubmit()){
			$obj_validate = new Uk86Validate();
			$obj_validate->validateparam = array(
				array("input"=>$_POST["image_max_filesize"], "require"=>"true", "validator"=>"Number", "message"=>L('upload_image_filesize_is_number')),
				array("input"=>trim($_POST["image_allow_ext"]), "require"=>"true", "message"=>L('image_allow_ext_not_null'))
			);
			$error = $obj_validate->uk86_validate();
			if ($error != ''){
				uk86_showMessage($error);
			}else {
				$model_setting = Model('setting');
				$result = $model_setting->updateSetting(array(
					'image_dir_type'=>intval($_POST['image_dir_type']),
					'image_max_filesize'=>intval($_POST['image_max_filesize']),
					'image_allow_ext'=>$_POST['image_allow_ext'])
				);
				if ($result){
					$this->log(L('nc_edit,upload_param'),1);
					uk86_showMessage(L('nc_common_save_succ'));
				}else {
					$this->log(L('nc_edit,upload_param'),0);
					uk86_showMessage(L('nc_common_save_fail'));
				}
			}
		}

		//获取默认图片设置属性
		$model_setting = Model('setting');
		$list_setting = $model_setting->getListSetting();
		Tpl::output('list_setting',$list_setting);

		//输出子菜单
		Tpl::output('top_link',$this->sublink($this->links,'param'));

		Tpl::showpage('upload.param');
	}

	/**
	 * 默认图设置
	 */
	public function default_thumbOp(){
		$model_setting = Model('setting');
		if (uk86_chksubmit()){
			//上传图片
			$upload = new Uk86UploadFile();
			$upload->uk86_set('default_dir',ATTACH_COMMON);
			//默认商品图片
			if (!empty($_FILES['default_goods_image']['tmp_name'])){
                $upload->uk86_set('thumb_width', GOODS_IMAGES_WIDTH);
                $upload->uk86_set('thumb_height', GOODS_IMAGES_HEIGHT);
                $upload->uk86_set('thumb_ext', GOODS_IMAGES_EXT);
				$upload->uk86_set('filling',false);
				$result = $upload->uk86_upfile('default_goods_image');
				if ($result){
					$_POST['default_goods_image'] = $upload->file_name;
				}else {
					uk86_showMessage($upload->error,'','','error');
				}
			}
			//默认店铺标志
			if (!empty($_FILES['default_store_logo']['tmp_name'])){
				$upload->uk86_set('file_name', '');
				$upload->uk86_set('thumb_width',	0);
				$upload->uk86_set('thumb_height',0);
				$upload->uk86_set('thumb_ext',	false);
				$result = $upload->uk86_upfile('default_store_logo');
				if ($result){
					$_POST['default_store_logo'] = $upload->file_name;
				}else {
					uk86_showMessage($upload->error,'','','error');
				}
			}
			//默认店铺头像
			if (!empty($_FILES['default_store_avatar']['tmp_name'])){
			    $upload->uk86_set('file_name', '');
			    $upload->uk86_set('thumb_width',	0);
			    $upload->uk86_set('thumb_height',0);
			    $upload->uk86_set('thumb_ext',	false);
			    $result = $upload->uk86_upfile('default_store_avatar');
			    if ($result){
			        $_POST['default_store_avatar'] = $upload->file_name;
			    }else {
			        uk86_showMessage($upload->error,'','','error');
			    }
			}
			//默认会员头像
			if (!empty($_FILES['default_user_portrait']['tmp_name'])){
				$thumb_width	= '32';
				$thumb_height	= '32';

				$upload->uk86_set('thumb_width',	$thumb_width);
				$upload->uk86_set('thumb_height',$thumb_height);
				$upload->uk86_set('thumb_ext',	'_small');
				$upload->uk86_set('file_name', '');
				$result = $upload->uk86_upfile('default_user_portrait');
				if ($result){
					$_POST['default_user_portrait'] = $upload->file_name;
				}else {
					uk86_showMessage($upload->error,'','','error');
				}
			}
			$list_setting = $model_setting->getListSetting();
			$update_array = array();
			if (!empty($_POST['default_goods_image'])){
				$update_array['default_goods_image'] = $_POST['default_goods_image'];
			}
			if (!empty($_POST['default_store_logo'])){
				$update_array['default_store_logo'] = $_POST['default_store_logo'];
			}
			if (!empty($_POST['default_store_avatar'])){
			    $update_array['default_store_avatar'] = $_POST['default_store_avatar'];
			}
			if (!empty($_POST['default_user_portrait'])){
				$update_array['default_user_portrait'] = $_POST['default_user_portrait'];
			}
			if (!empty($update_array)){
				$result = $model_setting->updateSetting($update_array);
			}else{
				$result = true;
			}
			if ($result === true){
				//判断有没有之前的图片，如果有则删除
				if (!empty($list_setting['default_goods_image']) && !empty($_POST['default_goods_image'])){
					@unlink(BASE_UPLOAD_PATH.DS.ATTACH_COMMON.DS.$list_setting['default_goods_image']);
					$img_ext = explode(',', GOODS_IMAGES_EXT);
					foreach ($img_ext as $val) {
					    @unlink(BASE_UPLOAD_PATH.DS.ATTACH_COMMON.DS.str_ireplace('.', $val . '.', $list_setting['default_goods_image']));
					}
				}
				if (!empty($list_setting['default_store_logo']) && !empty($_POST['default_store_logo'])){
					@unlink(BASE_UPLOAD_PATH.DS.ATTACH_COMMON.DS.$list_setting['default_store_logo']);
				}
				if (!empty($list_setting['default_user_portrait']) && !empty($_POST['default_user_portrait'])){
					@unlink(BASE_UPLOAD_PATH.DS.ATTACH_COMMON.DS.$list_setting['default_user_portrait']);
					@unlink(BASE_UPLOAD_PATH.DS.ATTACH_COMMON.DS.str_ireplace(',', '_small.', $list_setting['default_user_portrait']));
				}
				$this->log(L('nc_edit,default_thumb'),1);
				uk86_showMessage(L('nc_common_save_succ'));
			}else {
				$this->log(L('nc_edit,default_thumb'),0);
				uk86_showMessage(L('nc_common_save_fail'));
			}
		}

		$list_setting = $model_setting->getListSetting();

		//模板输出
		Tpl::output('list_setting',$list_setting);

		//输出子菜单
		Tpl::output('top_link',$this->sublink($this->links,'default_thumb'));

		Tpl::showpage('upload.thumb');
	}

	/**
	 * 登录主题图片
	 */
	public function loginOp(){
		$model_setting = Model('setting');
		if (uk86_chksubmit()){
			$input = array();
			//上传图片
			$upload = new Uk86UploadFile();
			$upload->uk86_set('default_dir',ATTACH_PATH.'/login');
			$upload->uk86_set('thumb_ext',	'');
			$upload->uk86_set('file_name','1.jpg');
			$upload->uk86_set('ifremove',false);
			if (!empty($_FILES['login_pic1']['name'])){
				$result = $upload->uk86_upfile('login_pic1');
				if (!$result){
					uk86_showMessage($upload->error,'','','error');
				}else{
					$input[] = $upload->file_name;
				}
			}elseif ($_POST['old_login_pic1'] != ''){
				$input[] = '1.jpg';
			}

			$upload->uk86_set('default_dir',ATTACH_PATH.'/login');
			$upload->uk86_set('thumb_ext',	'');
			$upload->uk86_set('file_name','2.jpg');
			$upload->uk86_set('ifremove',false);
			if (!empty($_FILES['login_pic2']['name'])){
				$result = $upload->uk86_upfile('login_pic2');
				if (!$result){
					uk86_showMessage($upload->error,'','','error');
				}else{
					$input[] = $upload->file_name;
				}
			}elseif ($_POST['old_login_pic2'] != ''){
				$input[] = '2.jpg';
			}

			$upload->uk86_set('default_dir',ATTACH_PATH.'/login');
			$upload->uk86_set('thumb_ext',	'');
			$upload->uk86_set('file_name','3.jpg');
			$upload->uk86_set('ifremove',false);
			if (!empty($_FILES['login_pic3']['name'])){
				$result = $upload->uk86_upfile('login_pic3');
				if (!$result){
					uk86_showMessage($upload->error,'','','error');
				}else{
					$input[] = $upload->file_name;
				}
			}elseif ($_POST['old_login_pic3'] != ''){
				$input[] = '3.jpg';
			}

			$upload->uk86_set('default_dir',ATTACH_PATH.'/login');
			$upload->uk86_set('thumb_ext',	'');
			$upload->uk86_set('file_name','4.jpg');
			$upload->uk86_set('ifremove',false);
			if (!empty($_FILES['login_pic4']['name'])){
				$result = $upload->uk86_upfile('login_pic4');
				if (!$result){
					uk86_showMessage($upload->error,'','','error');
				}else{
					$input[] = $upload->file_name;
				}
			}elseif ($_POST['old_login_pic4'] != ''){
				$input[] = '4.jpg';
			}

			$update_array = array();
			if (count($input) > 0){
				$update_array['login_pic'] = serialize($input);
			}

			$result = $model_setting->updateSetting($update_array);
			if ($result === true){
				$this->log(L('nc_edit,loginSettings'),1);
				uk86_showMessage(L('nc_common_save_succ'));
			}else {
				$this->log(L('nc_edit,loginSettings'),0);
				uk86_showMessage(L('nc_common_save_fail'));
			}
		}
		$list_setting = $model_setting->getListSetting();
		if ($list_setting['login_pic'] != ''){
			$list = unserialize($list_setting['login_pic']);
		}
		Tpl::output('list',$list);
		Tpl::output('top_link',$this->sublink($this->links,'login'));

		Tpl::showpage('upload.login');
	}

	/**
	 * 水印字体
	 *
	 * @param
	 * @return
	 */
	public function fontOp(){
		//获取水印字体
		$dir_list = array();
		uk86_readFileList(BASE_RESOURCE_PATH.DS.'font',$dir_list);
		if (!empty($dir_list) && is_array($dir_list)){
			$fontInfo = array();
			include BASE_RESOURCE_PATH.DS.'font'.DS.'font.info.php';
			foreach ($dir_list as $value){
                $file_ext_array = explode('.',$value);
				if (strtolower(end($file_ext_array)) == 'ttf' && file_exists($value)){
                    $file_path_array = explode('/', $value);
					$value = array_pop($file_path_array);
					$tmp = explode('.',$value);
					$file_list[$value] = $fontInfo[$tmp[0]];
				}
			}
			//转码
			if (strtoupper(CHARSET) == 'GBK'){
				$file_list = Uk86Language::uk86_getGBK($file_list);
			}
			Tpl::output('file_list',$file_list);
		}
		Tpl::output('top_link',$this->sublink($this->links,'font'));

		Tpl::showpage('upload.font');
	}

	/**
	 * 压缩工具
	 *
	 * @param
	 * @return
	 */
	public function toolOp(){
		Tpl::output('top_link',$this->sublink($this->links,'tool'));
		Tpl::showpage('upload.tool');
	}
}
