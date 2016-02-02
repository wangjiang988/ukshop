<?php
/**
 * 手机端首页控制器
 * @author ZHUXUESONG
 *
 */
defined('InUk86') or exit('Access Invalid!');

class wap_indexControl extends BaseWapControl{
	public function __construct(){
		parent::__construct();
	}
	
	public function indexOp(){
		header("Content-type: text/html; charset=utf-8");
		$model_mb_special = Model('mb_special');
		$data = $model_mb_special->getMbSpecialIndex();
		foreach ($data as $k => $v) {
			if(!empty($v['goods']) && is_array($v['goods'])){
				$goods_ids = array();
				foreach ($v['goods']['item'] as $key => $val){
					$goods_ids[$key] = $val['goods_id'];
				}
				$goods_id_str[$k] = implode($goods_ids, ',');
				$goods_info[$k] = Model('goods')->field('goods_id,goods_name,goods_price,goods_marketprice,is_fcode,goods_promotion_type,goods_image')->where('goods_id in ('. $goods_id_str[$k] .')')->select();
			}
		}
		Tpl::output('goods_info', $goods_info);
		//猜你喜欢
		$member_like = Model('goods')->field('goods_id,goods_name,goods_price,goods_marketprice,is_fcode,goods_promotion_type,goods_image')->order('goods_salenum desc')->limit(4)->select();
		Tpl::output('member_like', $member_like);
		//p($data);die;
		//输出首页配置信息
		Tpl::output('data', $data);
		Tpl::showpage('index');
	}
}
?>