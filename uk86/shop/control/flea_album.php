<?php
/**
 * 闲置图片上传操作
 * by Uk86 商城开发
 */
defined('InUk86') or exit('Access Invalid!');
class flea_albumControl extends BaseFleaMemberControl {
	/**
	 *	验证是否开启闲置功能
	 */
	public function __construct() {
		parent::__construct();
		/**
		 * 读取语言包
		 */
		Uk86Language::uk86_read('member_store_album');
	}
	/**
	 * 闲置图片列表，发布闲置调用
	 */
	public function pic_listOp(){
		/**
		 * 分页类
		 */
		$page	= new Uk86Page();
		$page->uk86_setEachNum(12);
		$page->uk86_setStyle('admin');
		/**
		 * 实例化相册类
		 */
		$model_upload = Model('flea_upload');
		/**
		 * 图片列表
		 */
		$param = array();
		$param['store_id']	= $_SESSION['member_id'];
		$param['item_id']	= $_GET['goods_id'] ? $_GET['goods_id'] : '0';
		$pic_list = $model_upload->getUploadList($param,$page);
		Tpl::output('pic_list',$pic_list);
		Tpl::output('show_page',$page->uk86_show());

		if($_GET['item'] == 'goods'){
			Tpl::showpage('store_flea_sample','null_layout');
		}elseif ($_GET['item'] == 'des'){
			Tpl::showpage('store_flea_sample_des','null_layout');
		}
	}
}
