<?php
/**
 * 店铺列表
 * @author ZHUXUESONG
 *
 */
defined('InUk86') or exit('Access Invalid!');

class wap_storeControl extends BaseWapControl{
	public function __construct(){
		parent::__construct();
	}
	/**
	 * 查询店铺列表
	 */
	public function indexOp(){
		$store_model = Model('store');
		$condition = array();
		$keyword = trim($_GET['keyword']);
		$condition['store_state'] = 1;
		if($keyword != ''){
			$condition['store_name'] = array('like', '%'.$keyword.'%');
		}
		if(!empty($_GET['sc_id'])){
			$condition['sc_id'] = intval($_GET['sc_id']);
		}
		//店铺分类
		$store_sc = Model('store_class')->field('sc_id, sc_name')->order('sc_sort asc')->select();
		Tpl::output('store_sc', $store_sc);
		$store_list = $store_model->where($condition)->order('store_sort asc')->select();
		//获取店铺商品数，推荐商品列表等信息
		$store_list = $store_model->getStoreSearchList($store_list);
		Tpl::output('store_list', $store_list);
		Tpl::showpage('store_list.index');
	}
	
	/**
	 * 店铺详情
	 */
	public function store_infoOp(){
		$store_id = intval($_GET['store_id']);
		$condition = array();
		$condition['store_id'] = $store_id;
		$condition['goods_state'] = 1;
		//店铺商品搜索
		if(!empty($_GET['stc_id'])){
			$condition['goods_stcids'] = array('like', '%,'.intval($_GET['stc_id']).',%');
			Tpl::output('stc_name', $_GET['stc_name']);
			Tpl::output('search_type', 'stc');
		}
		$pwd = trim($_GET['keyword']);
		if(!empty($pwd)){
			$condition['goods_name'] = array('like', '%'.trim($_GET['keyword']).'%');
			Tpl::output('search_type', 'keyword');
		}
		if(empty($store_id)){
			$this->wap_showDialog('页面不存在');
		}
		$store_model = Model('store');
		$store_info[0] = $store_model->field('*')->where(array('store_id' => $store_id))->find();
		//获取店铺商品数，推荐商品列表等信息
		$store_list = $store_model->getStoreSearchList($store_info);
		//店铺评分
		$store_list[0]['avg_credit'] = $this->get_avg_credit($store_list[0]);
		//p($store_list[0]);die;
		Tpl::output('store_info', $store_list[0]);
		//是否已收藏本店铺
		$is_fav = $this->checkFavorites($store_id, 'store', $_SESSION['member_id']);
		Tpl::output('is_fav', $is_fav);
		//店铺全部商品
		$field = 'goods_id, goods_commonid, goods_name, goods_image, goods_price, goods_salenum';
		$goods_list = Model('goods')->where($condition)->group('goods_id')->order('goods_id desc')->field($field)->select();
		Tpl::output('goods_list', $goods_list);
		//获取店铺自定义分类
		$sgc = Model('store_goods_class')->where(array('store_id' => $store_id, 'stc_state' => 1))->field('*')->order('stc_sort asc')->select();
		$sgc = $this->get_sgc_orer($sgc);
		Tpl::output('sgc', $sgc);
		Tpl::showpage('store_info');
	}
	
	/**
	 * 收藏店铺
	 */
	public function fav_storeOp(){
		$store_id = intval($_POST['store_id']);
		$member_id = intval($_SESSION['member_id']);
		if($this->checkFavorites($store_id, 'store', $member_id)){
			echo 0;
		}else{
			$insert_array = array();
			$insert_array['member_id'] = $member_id;
			$insert_array['fav_id'] = $store_id;
			$insert_array['fav_type'] = 'store';
			$insert_array['fav_time'] = time();
			Model('favorites')->insert($insert_array);
			Model('store')->where(array('store_id' => $store_id))->setInc('store_collect', 1);
			echo 1;
		}
	}
	
	/**
	 * 分享店铺
	 */
	public function share_storeOp(){
		$insert_array = array();
		$insert_array['share_storeid'] = intval($_POST['store_id']);
		$insert_array['share_storename'] = $_POST['store_name'];
		$insert_array['share_memberid'] = $_SESSION['member_id'];
		$insert_array['share_membername'] = $_SESSION['member_name'];
		$insert_array['share_content'] = !empty($_POST['share_content'])?$_POST['share_content']:'这家店很不错哦!';
		$insert_array['share_addtime'] = time();
		$insert_array['share_privacy'] = intval($_POST['share_privacy'])?1:0;
		//验证会员是否已分享过次店铺
		$is_share = $this->chk_share_formember($insert_array['share_storeid'], $insert_array['share_memberid']);
		if($is_share){
			exit('10');
		}
		$insert_result = Model()->table('sns_sharestore')->insert($insert_array);
		if($insert_result){
			exit('11');
		}else{
			exit('0');
		}
	}
	
	/**
	 * 计算店铺平均评分
	 * @param array $store_list
	 * @return number
	 */
	private function get_avg_credit($store_list){
		if(empty($store_list['store_credit'])){
			return 0;
		}
		$avg = 0;
		$num = 0;
		foreach ($store_list['store_credit'] as $val){
			$avg += intval($val['credit']);
			++$num;
		}
		if($num == 0){
			return 0;
		}else{
			return round($avg/$num, 2);
		}
	}
	/**
	 * 验证是否已收藏
	 * @param int $fav_id
	 * @param string $fav_type
	 * @param int $member_id
	 * @return boolean
	 */
	private function checkFavorites($fav_id, $fav_type, $member_id){
		if (intval($fav_id) == 0 || empty($fav_type) || intval($member_id) == 0){
			return true;
		}
		$result = Model('favorites')->where(array('fav_id' => $fav_id, 'fav_type' => $fav_type, 'member_id' => $member_id))->find();
		if (!empty($result)){
			return true;
		}else {
			return false;
		}
	}
	
	/**
	 * 店铺内商品分类数组重新组合
	 * @param array $array
	 * @return array|Ambigous <unknown, multitype:unknown >
	 */
	private function get_sgc_orer($array){
		if(!is_array($array)){return $array;}
		$sgc = array();
		$i = 0;
		foreach ($array as $k1 => $v1){
			if($v1['stc_parent_id'] == 0){
				$i++;
				$sgc[$i] = $v1;
				$j = 0;
				foreach ($array as $k2 => $v2){
					if($v2['stc_parent_id'] == $v1['stc_id']){
						$j++;
						$sgc[$i]['childred'][$j] = $v2;
					}
				}
			}
		}
		return $sgc;
	}
	
	/**
	 * 验证会员是否分享过某个店铺
	 * @param int $store_id
	 * @param int $member_id
	 * @return boolean
	 */
	private function chk_share_formember($store_id, $member_id){
		$condition = array();
		$condition['share_storeid'] = $store_id;
		$condition['share_memberid'] = $member_id;
		$is_share = Model()->table('sns_sharestore')->where($condition)->field('share_id')->find();
		if($is_share['share_id'] > 0){
			return true;
		}
		return false;
	}
}
?>