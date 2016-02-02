<?php
/**
 * 通用页面
 *
 *
 **by Uk86 商城开发*/

defined('InUk86') or exit('Access Invalid!');

class commonControl extends SystemControl{
	public function __construct(){
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

			if (!empty($_FILES['_pic']['tmp_name'])){
				$result = $upload->uk86_upfile('_pic');
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
		Uk86Language::uk86_read('admin_common');
		$lang = Uk86Language::uk86_getLangContent();
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
// 				$save_file2 = BASE_UPLOAD_PATH.'/'.$_POST['filename'];
				$save_file2 = str_ireplace(UPLOAD_SITE_URL,BASE_UPLOAD_PATH,$_POST['filename']);
			}else{
				$save_file2 = str_replace('_small.','_sm.',$src);
			}
			$cropped = uk86_resize_thumb($save_file2, $src,$w,$h,$x1,$y1,$scale);
			@unlink($src);
			$pathinfo = pathinfo($save_file2);
			exit($pathinfo['basename']);
		}
		$save_file = str_ireplace(UPLOAD_SITE_URL,BASE_UPLOAD_PATH,$_GET['url']);
		$_GET['resize'] = $_GET['resize'] == '0' ? '0' : '1';
		Tpl::output('height',uk86_get_height($save_file));
		Tpl::output('width',uk86_get_width($save_file));
		Tpl::showpage('common.pic_cut','null_layout');
	}

	/**
	 * 查询每月的周数组
	 */
	public function getweekofmonthOp(){
	    uk86_import('function.datehelper');
	    $year = $_GET['y'];
	    $month = $_GET['m'];
	    $week_arr = uk86_getMonthWeekArr($year, $month);
	    echo json_encode($week_arr);
	    die;
	}
	/**
     * AJAX查询品牌
     */
    public function ajax_get_brandOp() {
        $initial = trim($_GET['letter']);
        $keyword = trim($_GET['keyword']);
        $type = trim($_GET['type']);
        if (!in_array($type, array('letter', 'keyword')) || ($type == 'letter' && empty($initial)) || ($type == 'keyword' && empty($keyword))) {
            echo json_encode(array());die();
        }

        // 实例化模型
        $model_type = Model('type');
        $where = array();
        // 验证类型是否关联品牌
        if ($type == 'letter') {
            switch ($initial) {
            	case 'all':
            	    break;
            	case '0-9':
            	    $where['brand_initial'] = array('in', array(0,1,2,3,4,5,6,7,8,9));
            	    break;
            	default:
            	    $where['brand_initial'] = $initial;
            	    break;
            }
        } else {
            $where['brand_name|brand_initial'] = array('like', '%' . $keyword . '%');
        }
        $brand_array = Model('brand')->getBrandPassedList($where, 'brand_id,brand_name,brand_initial', 0, 'brand_initial asc, brand_sort asc');
        echo json_encode($brand_array);die();
    }
}
