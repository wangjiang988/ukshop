<?php
/**
 * 前台分类
 *
 *
 *
 **by Uk86 商城开发*/


defined('InUk86') or exit('Access Invalid!');

class categoryControl extends BaseHomeControl {
	/**
	 * 分类列表
	 */
	public function indexOp(){
		Uk86Language::uk86_read('home_category_index');
		$lang	= Uk86Language::uk86_getLangContent();
		//导航
		$nav_link = array(
			'0'=>array('title'=>$lang['homepage'],'link'=>SHOP_SITE_URL),
			'1'=>array('title'=>$lang['category_index_goods_class'])
		);
		Tpl::output('nav_link_list',$nav_link);

		Tpl::output('html_title',C('site_name').' - '.Uk86Language::uk86_get('category_index_goods_class'));
		Tpl::showpage('category');
	}
}
