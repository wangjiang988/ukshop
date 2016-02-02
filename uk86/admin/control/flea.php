<?php
/**
 * 
 * by Uk86 商城开发
 */
defined('InUk86') or exit('Access Invalid!');
class fleaControl extends SystemControl{
	public function __construct(){
		parent::__construct();
		Uk86Language::uk86_read('flea_index,goods');
		/**
		 * 判断系统是否开启闲置市场
		 */
		if ($GLOBALS['setting_config']['flea_isuse'] != 1 ){
			uk86_showMessage(Uk86Language::uk86_get('flea_index_unable'),'index.php?act=dashboard&op=welcome');
			// uk86_showMessage(Uk86Language::uk86_get('admin_ztc_unavailable'),'index.php?act=dashboard&op=welcome');
		}
	}
	/**
	 * 商品管理
	 */
	public function fleaOp(){
		$lang	= Uk86Language::uk86_getLangContent();
		$model_goods = Model('flea');
		/**
		 * 推荐，编辑，删除
		 */
		if ($_POST['form_submit'] == 'ok'){
			if (!empty($_POST['del_id'])){
				$model_goods->dropGoods(implode(',',$_POST['del_id']));
				uk86_showMessage($lang['goods_index_del_succ']);
			}else {
				uk86_showMessage($lang['goods_index_choose_del']);
			}
			uk86_showMessage($lang['goods_index_argument_invalid']);
		}
		
		/**
		 * 排序
		 */
		$condition['keyword'] = trim($_GET['search_goods_name']);
		$condition['like_member_name'] = trim($_GET['search_store_name']); //店铺名称
		$condition['brand_id'] = intval($_GET['search_brand_id']);
		$condition['gc_id'] = intval($_GET['cate_id']);
		
		/**
		 * 分页
		 */
		$page	= new Uk86Page();
		$page->uk86_setEachNum(10);
		$page->uk86_setStyle('admin');
		$goods_list = $model_goods->listGoods($condition,$page);
		/**
		 * 商品类别
		 */
		/**
		 * 商品分类
		 */
		$model_class = Model('flea_class');
		$goods_class = $model_class->getTreeClassList(1);
		
		Tpl::output('search',$_GET);
		Tpl::output('goods_class',$goods_class);
		Tpl::output('goods_list',$goods_list);
		Tpl::output('page',$page->uk86_show());
	
		Tpl::showpage('flea.index');
	}
	/**
	 * ajax操作
	 */
	public function ajaxOp(){
		switch ($_GET['branch']){
			/**
			 * 商品名称
			 */
			case 'goods_name':
				$model_goods = Model('flea');
				$update_array = array();
				$update_array[$_GET['column']] = $_GET['value'];
				$model_goods->updateGoods($update_array,$_GET['id']);
				echo 'true';exit;
				break;
		}
	}
	
}
