<?php
/**
 * 会员中心
 * @author ZHUXUESONG
 *
 */
defined('InUk86') or exit('Access Invalid!');

class wap_memberControl extends BaseWapControl{
	public function __construct(){
		parent::__construct();
		//验证是否登录
		if(!$_SESSION['is_login']){
			header('Location:index.php?act=wap_login&op=login');
		}
	}
	
	/**
	 * 会员信息
	 */
	public function indexOp(){
		//输出会员信息
		$this->_get_member_info();
		//可用F码数量
		$fcode_sum = Model('free')->where(array('free_owner_id' => intval($_SESSION['member_id']), 'free_state' => 0))->count();
		Tpl::output('fcode_num', intval($fcode_sum));
		//我的订单信息
		$this->_order_info();
		//收藏信息
		$this->_goods_info('all');
		//我的足迹
		$this->_sns_info();
		Tpl::showpage('member_index');
	}
	
	/**
	 * 我的足迹列表
	 */
	public function member_sns_infoOp(){
		$view_goods = $this->_sns_info();
		$view1 = array();
		$view2 = array();
		$view3 = array();
		foreach ($view_goods as $goods_id => $goods_info){
			if(time() - intval($goods_info['browsetime']) <= 2592000){
				$view1[$goods_id] = $goods_info;
			}elseif((time()-intval($goods_info['browsetime']) > 2592000) && (time()-intval($goods_info['browsetime']) <= 7776000)){
				$view2[$goods_id] = $goods_info;
			}else{
				$view3[$goods_id] = $goods_info;
			}
		}
		Tpl::output('view1', $view1);
		Tpl::output('view2', $view2);
		Tpl::output('view3', $view3);
		Tpl::output('sns_type', '浏览记录');
		Tpl::output('sns_type_1', '浏览');
		Tpl::showpage('member_sns');
	}
	/**
	 * 收藏商品列表
	 */
	public function favorites_goodsOp(){
		$view_goods = $this->_goods_info('goods');
		$view1 = array();
		$view2 = array();
		$view3 = array();
		foreach ($view_goods as $goods_info){
			$goods_info['goods']['goods_promotion_price'] = $goods_info['goods']['goods_price'];
			if(time() - intval($goods_info['fav_time']) <= 2592000){
				$view1[$goods_info['goods']['goods_id']] = $goods_info['goods'];
				$view1[$goods_info['goods']['goods_id']]['goods_image'] = uk86_thumb($goods_info['goods'], 240);
			}elseif((time()-intval($goods_info['fav_time']) > 2592000) && (time()-intval($goods_info['fav_time']) <= 7776000)){
				$view2[$goods_info['goods']['goods_id']] = $goods_info['goods'];
				$view2[$goods_info['goods']['goods_id']]['goods_image'] = uk86_thumb($goods_info['goods'], 240);
			}else{
				$view3[$goods_info['goods']['goods_id']] = $goods_info['goods'];
				$view3[$goods_info['goods']['goods_id']]['goods_image'] = uk86_thumb($goods_info['goods'], 240);
			}
		}
		Tpl::output('view1', $view1);
		Tpl::output('view2', $view2);
		Tpl::output('view3', $view3);
		Tpl::output('is_fav', 1);
		Tpl::output('sns_type', '收藏宝贝');
		Tpl::output('sns_type_1', '收藏');
		Tpl::showpage('member_sns');
	}
	/**
	 * 收藏店铺列表
	 */
	public function favorites_storeOp(){
		$fav_store = $this->_goods_info('store');
		foreach ($fav_store as $k=>$v){
			unset($fav_store[$k]['store']['member_id']);
			$fav_store[$k] = array_merge($fav_store[$k], $fav_store[$k]['store']);
			unset($fav_store[$k]['store']);
		}
		$fav_store = Model('store')->getStoreInfoBasic($fav_store);
		//p($fav_store);die();
		Tpl::output('fav_store', $fav_store);
		Tpl::showpage('member_sns_favstore');
		
	}
	
	/**
	 * 删除收藏
	 */
	public function del_favOp(){
		$fav_id = intval($_GET['fav_id']);
		$condition = array();
		$condition['fav_id'] = $fav_id;
		$condition['member_id'] = $_SESSION['member_id'];
		$condition['fav_type'] = $_GET['type'];
		$result = Model()->table('favorites')->where($condition)->delete();
		if($result){
			exit('1');
		}
		exit('0');
	}
	
	private function _order_info(){
		$model_order = Model('order');
		
		$where = array();
		$where['voucher_state'] = 1;
		$where['voucher_owner_id'] = intval($_SESSION['member_id']);
		$where['voucher_end_date'] = array('gt', time());
		//交易提醒 - 显示数量
		$member_info['order_nopay_count'] = $model_order->getOrderCountByID('buyer',$_SESSION['member_id'],'NewCount');
		$member_info['order_pay_count'] = $model_order->where(array('buyer_id' => $_SESSION['member_id'], 'order_state' => 20))->count();
		$member_info['order_noreceipt_count'] = $model_order->getOrderCountByID('buyer',$_SESSION['member_id'],'SendCount');
		$member_info['order_noeval_count'] = $model_order->getOrderCountByID('buyer',$_SESSION['member_id'],'EvalCount');
		$member_info['order_refund_num'] = $this->_order_refund_num();
		$member_info['voucher_count'] = Model()->table('voucher')->where($where)->count();
		Tpl::output('home_member_info',$member_info);
		
		//交易提醒 - 显示订单列表
		$condition = array();
		$condition['buyer_id'] = $_SESSION['member_id'];
		$condition['order_state'] = array('in',array(ORDER_STATE_NEW,ORDER_STATE_PAY,ORDER_STATE_SEND,ORDER_STATE_SUCCESS));
		$order_list = $model_order->getNormalOrderList($condition,'','*','order_id desc',3,array('order_goods'));
		
		foreach ($order_list as $order_id => $order) {
			//显示物流跟踪
			$order_list[$order_id]['if_deliver'] = $model_order->getOrderOperateState('deliver',$order);
			//显示评价
			$order_list[$order_id]['if_evaluation'] = $model_order->getOrderOperateState('evaluation',$order);
			//显示支付
			$order_list[$order_id]['if_payment'] = $model_order->getOrderOperateState('payment',$order);
			//显示收货
			$order_list[$order_id]['if_receive'] = $model_order->getOrderOperateState('receive',$order);
		}
		
		Tpl::output('order_list',$order_list);
		
		//取出购物车信息
		$model_cart = Model('cart');
		$cart_list	= $model_cart->listCart('db',array('buyer_id'=>$_SESSION['member_id']),3);
		Tpl::output('cart_list',$cart_list);
	}
	/**
	 * 收藏商品，收藏店铺
	 */
	private function _goods_info($type){
		$favorites_model = Model('favorites');
		if($type == 'all' || $type == 'goods'){
			//商品收藏
			$favorites_list = $favorites_model->getGoodsFavoritesList(array('member_id'=>$_SESSION['member_id']), '*');
			if (!empty($favorites_list) && is_array($favorites_list)){
				$favorites_id = array();//收藏的商品编号
				foreach ($favorites_list as $key=>$favorites){
					$fav_id = $favorites['fav_id'];
					$favorites_id[] = $favorites['fav_id'];
					$favorites_key[$fav_id] = $key;
				}
				$goods_model = Model('goods');
				$field = 'goods.goods_id,goods.goods_name,goods.store_id,goods.goods_image,goods.goods_price,goods.evaluation_count,goods.goods_salenum,goods.goods_collect,store.store_name,store.member_id,store.member_name,store.store_qq,store.store_ww,store.store_domain';
				$goods_list = $goods_model->getGoodsStoreList(array('goods_id' => array('in', $favorites_id)), $field);
				$store_array = array();//店铺编号
				if (!empty($goods_list) && is_array($goods_list)){
					$store_goods_list = array();//店铺为分组的商品
					foreach ($goods_list as $key=>$fav){
						$fav_id = $fav['goods_id'];
						$fav['goods_member_id'] = $fav['member_id'];
						$key = $favorites_key[$fav_id];
						$favorites_list[$key]['goods'] = $fav;
					}
				}
			}
			Tpl::output('favorites_list',$favorites_list);
		}
		if($type == 'all' || $type == 'store'){
			//店铺收藏
			$favorites_list = $favorites_model->getStoreFavoritesList(array('member_id'=>$_SESSION['member_id']), '*');
			if (!empty($favorites_list) && is_array($favorites_list)){
				$favorites_id = array();//收藏的店铺编号
				foreach ($favorites_list as $key=>$favorites){
					$fav_id = $favorites['fav_id'];
					$favorites_id[] = $favorites['fav_id'];
					$favorites_key[$fav_id] = $key;
				}
				$store_model = Model('store');
				$store_list = $store_model->getStoreList(array('store_id'=>array('in', $favorites_id)));
				if (!empty($store_list) && is_array($store_list)){
					foreach ($store_list as $key=>$fav){
						$fav_id = $fav['store_id'];
						$key = $favorites_key[$fav_id];
						$favorites_list[$key]['store'] = $fav;
					}
				}
			}
 			Tpl::output('favorites_store_list',$favorites_list);
		}
		if($type != 'all'){
			return $favorites_list;
		}
	}
	/**
	 * 我的足迹
	 */
	private function _sns_info(){
		$goods_list = Model('goods_browse')->getViewedGoodsList($_SESSION['member_id']);
		$viewed_goods = array();
		if(is_array($goods_list) && !empty($goods_list)) {
			foreach ($goods_list as $key => $val) {
				$goods_id = $val['goods_id'];
				$val['url'] = uk86_urlShop('goods', 'index', array('goods_id' => $goods_id));
				$val['goods_image'] = uk86_thumb($val, 240);
				$viewed_goods[$goods_id] = $val;
			}
		}
		Tpl::output('viewed_goods',$viewed_goods);
		
		//我的圈子
		$model = Model();
		$circlemember_array = $model->table('circle_member')->where(array('member_id'=>$_SESSION['member_id']))->select();
		if(!empty($circlemember_array)) {
			$circlemember_array = uk86_array_under_reset($circlemember_array, 'circle_id');
			$circleid_array = array_keys($circlemember_array);
			$circle_list = $model->table('circle')->where(array('circle_id'=>array('in', $circleid_array)))->limit(6)->select();
			Tpl::output('circle_list', $circle_list);
		}
		return $viewed_goods;
	}
	
	/**
	 * 退款、退货订单数量
	 */
	private function _order_refund_num(){
		$condition = 'buyer_id = '.$_SESSION['member_id'].' and refund_state in (1,2)';
		return Model()->table('refund_return')->where($condition)->count();
	}
}
?>