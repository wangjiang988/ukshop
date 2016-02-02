<?php
/**
 * 所有商品分类
 * @author ZHUXUESONG
 *
 */
defined('InUk86') or exit('Access Invalid!');

class wap_goods_classControl extends BaseWapControl{
	public function __construct(){
		parent::__construct();
	}
	
	/**
	 * 商品分类列表
	 */	
	public function indexOp(){
		header('Content-type:text/html; charset=utf-8');
		$model_class = Model('goods_class');
		$goods_class = $model_class->get_all_category();
		$brand_info = $this->list_l_brand();
		Tpl::output('goods_class', $goods_class);
		Tpl::output('brand_list', $brand_info);
		Tpl::showpage('goods_class.index');
	}
}
?>