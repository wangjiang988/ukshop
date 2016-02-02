<?php
/**
 * F码商品
 * @author ZHUXUESONG
 *
 */
defined('InUk86') or exit('Access Invalid!');

class wap_fcodeGoodsControl extends BaseWapControl{
	public function __construct(){
		parent::__construct();
	}
	
	/**
	 * F码商品列表
	 */
	public function indexOp(){
		$goods_model = Model('goods');
		$condition = array();
		$condition['is_fcode'] = 1;
		$condition['goods_state'] = 1;
		$condition['goods_verify'] = 1;
		$goods_list = $goods_model->where($condition)->field('*')->group('goods_commonid')->select();
		//p($goods_list);die;
		Tpl::output('goods_list', $goods_list);
		Tpl::showpage('fcode_goods_list');
	}
}
?>