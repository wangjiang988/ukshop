<?php
/**
 * 裁剪
 *
 *by Uk86 商城开发
 */
defined('InUk86') or exit('Access Invalid!');

class cutControl extends BaseCircleControl {
	public function __construct(){
		Uk86Language::uk86_read('cut');
		parent::__construct();
	}
	/**
	 * 图片上传
	 *
	 */
	public function pic_uploadOp(){
		if (uk86_chksubmit()){
			//上传图片
			$upload = new Uk86UploadFile();
			$upload->uk86_set('thumb_width',	500);
			$upload->uk86_set('thumb_height',499);
			$upload->uk86_set('thumb_ext','_small');
			$upload->uk86_set('max_size',C('image_max_filesize')?C('image_max_filesize'):1024);
			$upload->uk86_set('ifremove',true);
			$upload->uk86_set('default_dir',$_GET['uploadpath']);

			if (!empty($_FILES['c_img']['tmp_name'])){
				$result = $upload->uk86_upfile('c_img');
				if ($result){
					exit(json_encode(array('status'=>1,'url'=>UPLOAD_SITE_URL.'/'.$_GET['uploadpath'].'/'.$upload->thumb_image)));
				}else {
					exit(json_encode(array('status'=>0,'msg'=>$upload->error)));
				}
			}
		}
	}

	/**
	 * 图片裁剪
	 *
	 */
	public function pic_cutOp(){
		uk86_import('function.thumb');
		if (uk86_chksubmit()){
			$thumb_width = $_POST['x'];
			$x1 = $_POST["x1"];
			$y1 = $_POST["y1"];
			$x2 = $_POST["x2"];
			$y2 = $_POST["y2"];
			$w = $_POST["w"];
			$h = $_POST["h"];
			$scale = $thumb_width/$w;
			$src = str_ireplace(UPLOAD_SITE_URL,BASE_UPLOAD_PATH,$_POST['url']);
			if (strpos($src, '..') !== false || strpos($src, BASE_UPLOAD_PATH) !== 0) {
			    exit();
			}
			if (!empty($_POST['filename'])){
				$save_file2 = BASE_UPLOAD_PATH.'/'.$_POST['filename'];
			}else{
				$save_file2 = str_replace('_small.','_sm.',$src);
			}
			$cropped = uk86_resize_thumb($save_file2, $src,$w,$h,$x1,$y1,$scale);
			@unlink($src);
			$pathinfo = pathinfo($save_file2);
			exit($pathinfo['basename']);
		}
		$save_file = str_ireplace(UPLOAD_SITE_URL,BASE_UPLOAD_PATH,$_GET['url']);
		$_GET['x'] = (intval($_GET['x'])>50 && $_GET['x']<400) ? $_GET['x'] : 200;
		$_GET['y'] = (intval($_GET['y'])>50 && $_GET['y']<400) ? $_GET['y'] : 200;
		$_GET['resize'] = $_GET['resize'] == '0' ? '0' : '1';
		Tpl::output('height',uk86_get_height($save_file));
		Tpl::output('width',uk86_get_width($save_file));
		Tpl::showpage('cut','null_layout');
	}

//	public function pic_viewOp(){
//		header('Cache-Control:no-cache,must-revalidate');
//		header('Pragma:no-cache');
//		header('Content-type: image/jpeg');
//		echo file_get_contents($_GET['url']);
//	}
}
