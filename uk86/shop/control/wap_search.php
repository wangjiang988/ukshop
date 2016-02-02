<?php 
/**
 * 商品搜索
 * @author ZHUXUESONG
 *
 */
defined('InUk86') or exit('Access Invalid!');

class wap_searchControl extends BaseWapControl{
	public function __construct(){
		parent::__construct();
	}
	/**
	 * 搜索列表
	 */
	public function indexOp(){
		//header("Content-type: text/html; charset=utf-8");
		$keyword = $_GET['keyword'];
		//关键字搜索商品分类
		if(!empty($_GET['gc_id'])){
			$gc_id_str = $_GET['gc_id'];
		}elseif($keyword != ''){
			$gc_model = Model('goods_class');
			$gc_id_arr = $gc_model->where('(gc_name like "%'.$keyword.'%" or gc_keywords like "%'.$keyword.'%") and gc_show=1')->field('gc_id')->select();
			$gc_id_str = $this->arr_to_str($gc_id_arr);
		}
		//关键字搜索商品品牌
		if(!empty($_GET['brand_id'])){
			$br_id_str = '"'.$_GET['brand_id'].'"';
		}elseif($keyword != ''){
			$brand_model = Model('brand');
			$br_id_arr = $brand_model->where('brand_name like "%'.$keyword.'%" and brand_apply=1')->field('brand_id')->select();
			$br_id_str = $this->arr_to_str($br_id_arr);
		}
		$goods_model = Model('goods');
		//排序
		$order = array();
		if($_GET['type'] == '' || $_GET['type'] == 'auto'){
			$order['goods_id'] = 'desc';
			Tpl::output('order', 'auto');
		}elseif($_GET['type'] == 'goods_salenum'){
			$order['goods_salenum'] = 'desc';
			Tpl::output('order', 'goods_salenum');
		}elseif ($_GET['type'] == 'click_num'){
			$order['goods_click'] = 'desc';
			Tpl::output('order', 'click_num');
		}elseif($_GET['type'] == 'goods_price'){
			if($_GET['nctype'] == 'up' || $_GET['nctype'] == ''){
				$desc = 'asc';
				Tpl::output('desc', 'up');
			}elseif($_GET['nctype'] == 'down'){
				$desc = 'desc';
				Tpl::output('desc', 'down');
			}
			$order['goods_promotion_price'] = $desc;
			Tpl::output('order', 'goods_price');
		}
		$where = 'goods_verify = 1 and goods_state = 1 and (';
		if($keyword != ''){
			$where .= 'goods_name like "%'.$keyword.'%" or goods_jingle like "%'.$keyword.'%" or store_name like "%'.$keyword.'%" ';
		}
		if($gc_id_str != ''){
			$where .= ' or gc_id in ('.$gc_id_str.') or gc_id_1 in ('.$gc_id_str.') or gc_id_2 in ('.$gc_id_str.') or gc_id_3 in ('.$gc_id_str.')';
		}
		if(!empty($br_id_str)){
			$where .= ' or brand_id in ('.$br_id_str.')';
		}
		$where .= ')';
		//echo $where;die;
		$field = '*';
		$goods_list = $goods_model->where($where)->field($field)->order($order)->select();
		foreach ($goods_list as $k => $v){
			foreach ($goods_list as $key => $val){
				if($val['goods_commonid'] == $v['goods_commonid'] && $val['goods_id'] != $v['goods_id']){
					unset($goods_list[$k]);
					continue;
				}
			}
		}
		//获取抢购商品信息
		$groupbuy_list = Model('groupbuy')->where(array('state' => 20))->field('groupbuy_id, goods_id')->select();
		//获取显示折扣信息
		$xianshi_list = Model('p_xianshi_goods')->where(array('state' => 1))->field('xianshi_goods_id, goods_id')->select();
		foreach ($goods_list as $goods_key => $goods_val){
			foreach ($groupbuy_list as $group_key => $group_val){
				if($goods_val['goods_id'] == $group_val['goods_id']){
					$goods_list[$goods_key]['is_groupbuy'] = 1;
					continue;
				}
			}
			foreach ($xianshi_list as $xianshi_key => $xianshi_val){
				if($goods_val['goods_id'] == $xianshi_val['goods_id']){
					$goods_list[$goods_key]['is_xianshi'] = 1;
					continue;
				}
			}
			$goods_list[$goods_key]['goods_new_name'] = $goods_val['goods_name'].' <span style="color:#F00;">'.$goods_val['goods_jingle'].'</span>';
		}
		Tpl::output('goods_list', $goods_list);
		Tpl::showpage('search.index');
	}
	
	/**
	 * 数组拼接成字符串
	 * @param unknown $arr
	 * @param string $glue
	 * @return Ambigous <string, unknown>
	 */
	private function arr_to_str($arr, $glue = ','){
		$str = '';
		foreach ($arr as $k => $v){
			foreach ($v as $val){
				$str .= $val;
				if($arr[$k + 1] != ''){
					$str .= $glue;
				}
			}
		}
		return $str;
	}
}