<?php
/**
 * 我的购物车
 * @author ZHUXUESONG
 *
 */
defined('InUk86') or exit('Access Invalid!');

class wap_cartControl extends BaseWapControl{
	public function __construct(){
		parent::__construct();
		//验证是否登录
		if(!$_SESSION['is_login']){
			header('Location:index.php?act=wap_login&op=login');
		}
	}
	//购物车列表
	public function indexOp(){
		$model_cart	= Model('cart');
		$logic_buy_1 = uk86_logic('buy_1');
		
		//购物车列表
		$cart_list	= $model_cart->listCart('db',array('buyer_id'=>$_SESSION['member_id']));
		
		//购物车列表 [得到最新商品属性及促销信息]
		$cart_list = $logic_buy_1->getGoodsCartList($cart_list);
		
		//购物车商品以店铺ID分组显示,并计算商品小计,店铺小计与总价由JS计算得出
		$store_cart_list = array();
		foreach ($cart_list as $cart) {
			$cart['goods_total'] = uk86_ncPriceFormat($cart['goods_price'] * $cart['goods_num']);
			$store_cart_list[$cart['store_id']][] = $cart;
		}
		Tpl::output('store_cart_list',$store_cart_list);
		
		//店铺信息
		$store_list = Model('store')->getStoreMemberIDList(array_keys($store_cart_list));
		Tpl::output('store_list',$store_list);
		
		//取得店铺级活动 - 可用的满即送活动
		$mansong_rule_list = $logic_buy_1->getMansongRuleList(array_keys($store_cart_list));
		Tpl::output('mansong_rule_list',$mansong_rule_list);
		
		//取得哪些店铺有满免运费活动
		$free_freight_list = $logic_buy_1->getFreeFreightActiveList(array_keys($store_cart_list));
		Tpl::output('free_freight_list',$free_freight_list);
		
		Tpl::showpage('cart.index');
	}
	
	/**
	 * 异步修改购物车商品数量
	 */
	public function add_cart_numOp(){
		$where = array();
		$where['cart_id'] = $_GET['cart_id'];
		$where['buyer_id'] = $_SESSION['member_id'];
		$update = array();
		$update['goods_num'] = $_GET['goods_num'];
		$result = Model()->table('cart')->where($where)->update($update);
		if(!$result){
			echo true;
		}
		
	}
}

?>