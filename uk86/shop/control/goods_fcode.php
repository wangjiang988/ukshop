<?php
/**
 * F码商品
 * 
 * By Uk86 商城开发
 */
defined('InUk86') or exit('Access Invalid!');

class goods_fcodeControl extends BaseHomeControl{
	public function __construct() {
		parent::__construct();
	}
	
	public function indexOp(){
		$model_goods = Model('goods');
		// 字段
		$fields = "goods_id,goods_commonid,goods_name,goods_jingle,gc_id,store_id,store_name,goods_price,goods_promotion_price,goods_promotion_type,goods_marketprice,goods_storage,goods_image,goods_freight,goods_salenum,color_id,evaluation_good_star,evaluation_count,is_virtual,is_fcode,is_appoint,is_presell,have_gift";
		$condition = array('is_fcode' => 1, 'goods_state' => 1);
		$goods_list = $model_goods->getGoodsOnlineList($condition, $fields);
		
		// 商品多图
		if (!empty($goods_list)) {
			$commonid_array = array(); // 商品公共id数组
			$storeid_array = array();       // 店铺id数组
			foreach ($goods_list as $value) {
				$commonid_array[] = $value['goods_commonid'];
				$storeid_array[] = $value['store_id'];
			}
			$commonid_array = array_unique($commonid_array);
			$storeid_array = array_unique($storeid_array);
		
			// 商品多图
			$goodsimage_more = Model('goods')->getGoodsImageList(array('goods_commonid' => array('in', $commonid_array)));
		
			// 店铺
			$store_list = Model('store')->getStoreMemberIDList($storeid_array);
			//搜索的关键字
			$search_keyword = trim($_GET['keyword']);
			foreach ($goods_list as $key => $value) {
				switch ($value['evaluation_good_star']){
					case 0:
						$goods_list[$key]['good_star_name'] = '还没有评价'; break;
					case 1:
						$goods_list[$key]['good_star_name'] = '很不满意'; break;
					case 2:
						$goods_list[$key]['good_star_name'] = '不满意'; break;
					case 3:
						$goods_list[$key]['good_star_name'] = '一般'; break;
					case 4:
						$goods_list[$key]['good_star_name'] = '满意'; break;
					case 5:
						$goods_list[$key]['good_star_name'] = '很满意'; break;
				}
				// 商品多图
				foreach ($goodsimage_more as $v) {
					if ($value['goods_commonid'] == $v['goods_commonid'] && $value['store_id'] == $v['store_id'] && $value['color_id'] == $v['color_id']) {
						$goods_list[$key]['image'][] = $v;
					}
				}
				// 店铺的开店会员编号
				$store_id = $value['store_id'];
				$goods_list[$key]['member_id'] = $store_list[$store_id]['member_id'];
				$goods_list[$key]['store_domain'] = $store_list[$store_id]['store_domain'];
				//将关键字置红
				if ($search_keyword){
					$goods_list[$key]['goods_name_highlight'] = str_replace($search_keyword,'<font style="color:#f00;">'.$search_keyword.'</font>',$value['goods_name']);
				} else {
					$goods_list[$key]['goods_name_highlight'] = $value['goods_name'];
				}
			}
		}
		Tpl::output('goods_list', $goods_list);
		
// 		$fcode_goods_list = Model()->table('goods')->where(array('is_fcode' => 1, 'goods_state' => 1))->select();
// 		Tpl::output('goods_list', $fcode_goods_list);
		Tpl::showpage('goods_fcode.index');
	}
}
?>