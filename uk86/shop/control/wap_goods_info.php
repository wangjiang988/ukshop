<?php
/**
 * 
 * 商品详情页
 * @author ZHUXUESONG
 */
defined('InUk86') or exit('Access Invalid!');

class wap_goods_infoControl extends BaseWapControl{
	public function __construct(){
		parent::__construct();
	}
	
	public function indexOp(){
		header("Content-type:text/html; charset=utf-8");
		$goods_id = intval($_GET['goods_id']);
		//添加浏览记录
		$this->addbrowse($goods_id);
		$model_goods = Model('goods');
		$goods_detail = $model_goods->getGoodsDetail($goods_id);
		$goods_info = $goods_detail['goods_info'];
		if (empty($goods_info)) {
			$this->wap_showDialog('商品已下架或不存在', 'error', uk86_getReferer());
		}
		
		$rs = $model_goods->getGoodsList(array('goods_commonid'=>$goods_info['goods_commonid']));
		$count = 0;
		foreach($rs as $v){
			$count += $v['goods_salenum'];
		}
		$goods_info['goods_salenum'] = $count;
		//  添加 end
		$this->getStoreInfo($goods_info['store_id']);
		
		Tpl::output('spec_list', $goods_detail['spec_list']);
		Tpl::output('spec_image', $goods_detail['spec_image']);
		Tpl::output('goods_image', $goods_detail['goods_image_mobile']);
		Tpl::output('mansong_info', $goods_detail['mansong_info']);
		Tpl::output('gift_array', $goods_detail['gift_array']);
		
		// 生成缓存的键值
		$hash_key = $goods_info['goods_id'];
		$_cache = uk86_rcache($hash_key, 'product');
		if (empty($_cache)) {
			// 查询SNS中该商品的信息
			$snsgoodsinfo = Model('sns_goods')->getSNSGoodsInfo(array('snsgoods_goodsid' => $goods_info['goods_id']), 'snsgoods_likenum,snsgoods_sharenum');
			$data = array();
			$data['likenum'] = $snsgoodsinfo['snsgoods_likenum'];
			$data['sharenum'] = $snsgoodsinfo['snsgoods_sharenum'];
			// 缓存商品信息
			uk86_wcache($hash_key, $data, 'product');
		}
		$goods_info = array_merge($goods_info, $_cache);
		
		$inform_switch = true;
		// 检测商品是否下架,检查是否为店主本人
		if ($goods_info['goods_state'] != 1 || $goods_info['goods_verify'] != 1 || $goods_info['store_id'] == $_SESSION['store_id']) {
			$inform_switch = false;
		}
		Tpl::output('inform_switch',$inform_switch );
		
		// 如果使用运费模板
		if ($goods_info['transport_id'] > 0) {
			// 取得三种运送方式默认运费
			$model_transport = Model('transport');
			$transport = $model_transport->getExtendList(array('transport_id' => $goods_info['transport_id'], 'is_default' => 1));
			if (!empty($transport) && is_array($transport)) {
				foreach ($transport as $v) {
					$goods_info[$v['type'] . "_price"] = $v['sprice'];
				}
			}
		}
		Tpl::output('goods', $goods_info);

		$model_plate = Model('store_plate');
		// 顶部关联版式
		if ($goods_info['plateid_top'] > 0) {
			$plate_top = $model_plate->getStorePlateInfoByID($goods_info['plateid_top']);
			Tpl::output('plate_top', $plate_top);
		}
		// 底部关联版式
		if ($goods_info['plateid_bottom'] > 0) {
			$plate_bottom = $model_plate->getStorePlateInfoByID($goods_info['plateid_bottom']);
			Tpl::output('plate_bottom', $plate_bottom);
		}
		
		Tpl::output('store_id', $goods_info ['store_id']);
		
		// 输出一级地区
		$area_list = Model('area')->getTopLevelAreas();
		
		if (strtoupper(CHARSET) == 'GBK') {
			$area_list = Uk86Language::uk86_getGBK($area_list);
		}
		Tpl::output('area_list', $area_list);
		
		//优先得到推荐商品
		$goods_commend_list = $model_goods->getGoodsOnlineList(array('store_id' => $goods_info['store_id'], 'goods_commend' => 1), 'goods_id,goods_name,goods_jingle,goods_image,store_id,goods_price', 0, 'rand()', 5, 'goods_commonid');
		Tpl::output('goods_commend',$goods_commend_list);
		
		
		// 当前位置导航
		$nav_link_list = Model('goods_class')->getGoodsClassNav($goods_info['gc_id'], 0);
		$nav_link_list[] = array('title' => $goods_info['goods_name']);
		Tpl::output('nav_link_list', $nav_link_list);
		
		//评价信息
		$goods_evaluate_info = Model('evaluate_goods')->getEvaluateGoodsInfoByGoodsID($goods_id);
		Tpl::output('goods_evaluate_info', $goods_evaluate_info);
		
		//所有评价
		Tpl::output('all_comments', $this->_get_comments($goods_info['goods_id'], 'all'));
		//好评
		Tpl::output('good_comments', $this->_get_comments($goods_info['goods_id'], '1'));
		//中评
		Tpl::output('normal_comments', $this->_get_comments($goods_info['goods_id'], '2'));
		//差评
		Tpl::output('bad_comments', $this->_get_comments($goods_info['goods_id'], '3'));
		
		$seo_param = array();
		$seo_param['name'] = $goods_info['goods_name'];
		$seo_param['key'] = $goods_info['goods_keywords'];
		$seo_param['description'] = $goods_info['goods_description'];
		Model('seo')->type('product')->param($seo_param)->show();
		
		Tpl::showpage('goods_info');
	}
	
	/**
	 * 收藏商品
	 */
	public function fav_goodsOp(){
		$goods_id = intval($_POST['goods_id']);
		$member_id = intval($_SESSION['member_id']);
		if($this->checkFavorites($goods_id, 'goods', $member_id)){
			exit('0');
		}else{
			$insert_array = array();
			$insert_array['member_id'] = $member_id;
			$insert_array['fav_id'] = $goods_id;
			$insert_array['fav_type'] = 'goods';
			$insert_array['fav_time'] = time();
			Model('favorites')->insert($insert_array);
			Model('goods')->where(array('goods_id' => $goods_id))->setInc('goods_collect', 1);
			exit('1');
		}
	}
	
	/**
	 * 分享商品
	 */
	public function share_goodsOp(){
		$insert_array = array();
		$insert_array['share_goodsid'] = intval($_POST['goods_id']);
		$insert_array['share_memberid'] = $_SESSION['member_id'];
		$insert_array['share_membername'] = $_SESSION['member_name'];
		$insert_array['share_content'] = $_POST['share_content'];
		$insert_array['share_addtime'] = time();
		$insert_array['share_privacy'] = $_POST['share_privacy']?1:0;
		$insert_array['share_isshare'] = 1;
		//验证会员是否已分享过次店铺
		$is_share = $this->chk_share_formember($insert_array['share_goodsid'], $insert_array['share_memberid']);
		if($is_share){
			exit('10');
		}
		$insert_result = Model()->table('sns_sharegoods')->insert($insert_array);
		if($insert_result){
			exit('11');
		}else{
			exit('0');
		}
	}
	
	/**
	 * 评价信息
	 * @param unknown $goods_id
	 * @param unknown $type
	 * @return unknown
	 */
	private function _get_comments($goods_id, $type){
		$condition = array();
		$condition['geval_goodsid'] = $goods_id;
		switch ($type) {
			case '1':
				$condition['geval_scores'] = array('in', '5,4');
				break;
			case '2':
				$condition['geval_scores'] = array('in', '3,2');
				break;
			case '3':
				$condition['geval_scores'] = array('in', '1');
				break;
		}
		//查询商品评分信息
		$model_evaluate_goods = Model("evaluate_goods");
		$goodsevallist = $model_evaluate_goods->getEvaluateGoodsList($condition);
		return $goodsevallist;
	}
	/**
	 * 添加浏览记录
	 */
	private function addbrowse($goods_id){
		$goods_id = intval($goods_id);
		Model('goods_browse')->addViewedGoods($goods_id,$_SESSION['member_id'],$_SESSION['store_id']);
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
	 * 验证会员是否分享过某个商品
	 * @param int $store_id
	 * @param int $member_id
	 * @return boolean
	 */
	private function chk_share_formember($goods_id, $member_id){
		$condition = array();
		$condition['share_goodsid'] = $goods_id;
		$condition['share_memberid'] = $member_id;
		$is_share = Model()->table('sns_sharegoods')->where($condition)->field('share_id')->find();
		if($is_share['share_id'] > 0){
			return true;
		}
		return false;
	}
}

?>