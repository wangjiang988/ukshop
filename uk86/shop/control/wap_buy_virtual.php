<?php
/**
 * 手机端虚拟商品购买
 * @author ZHUXUESONG
 *
 */
defined('InUk86') or exit('Access Invalid!');

class wap_buy_virtualControl extends BaseWapControl{
	
	public function __construct(){
		parent::__construct();
		Uk86Language::uk86_read('home_cart_index');
		//输出会员信息
        $this->member_info = $this->getMemberAndGradeInfo(true);
        Tpl::output('member_info', $this->member_info);
		if (!$_SESSION['member_id']){
			uk86_redirect('index.php?act=wap_login&op=login');
		}
		//验证该会员是否禁止购买
		if(!$_SESSION['is_buy']){
			$this->wap_showDialog(Uk86Language::uk86_get('cart_buy_noallow'));
		}
	}
	
	/**
	 * 虚拟商品购买第一步
	 */
	public function buy_step1Op() {
		$logic_buy_virtual = uk86_Logic('buy_virtual');
		$result = $logic_buy_virtual->getBuyStep2Data($_GET['goods_id'], $_GET['quantity'], $_SESSION['member_id']);
		if (!$result['state']) {
			$this->wap_showDialog($result['msg'],'error','index.php?act=wap_goods_info&goods_id='.$_GET['goods_id']);
		}
	
		//处理会员信息
		$member_info = array_merge($this->member_info,$result['data']['member_info']);
	
		Tpl::output('goods_info',$result['data']['goods_info']);
		Tpl::output('store_info',$result['data']['store_info']);
		Tpl::output('member_info',$member_info);
		Tpl::showpage('buy_virtual_step1');
	}
	
	/**
	 * 虚拟商品购买第二步
	 */
	public function buy_step2Op() {
		$logic_buy_virtual = uk86_Logic('buy_virtual');
		$_POST['order_from'] = 1;
		$result = $logic_buy_virtual->buyStep3($_POST,$_SESSION['member_id']);
		if (!$result['state']) {
			$this->wap_showDialog($result['msg'], 'error', uk86_getReferer());
		}
		//转向到商城支付页面
		uk86_redirect('index.php?act=wap_buy_virtual&op=pay&order_id='.$result['data']['order_id']);
	}
	
	/**
	 * 下单时支付页面
	 */
	public function payOp() {
		$order_id	= intval($_GET['order_id']);
		if ($order_id <= 0){
			$this->wap_showDialog('该订单不存在','error','index.php?act=wap_member_fcode&op=rec_code');
		}
	
		$model_vr_order = Model('vr_order');
		//取订单信息
		$condition = array();
		$condition['order_id'] = $order_id;
		$order_info = $model_vr_order->getOrderInfo($condition,'*',true);
		if (empty($order_info) || !in_array($order_info['order_state'],array(ORDER_STATE_NEW,ORDER_STATE_PAY))) {
			$this->wap_showDialog('未找到需要支付的订单','error','index.php?act=wap_member_fcode&op=rec_code');
		}
	
		//重新计算在线支付金额
		$pay_amount_online = 0;
		//订单总支付金额
		$pay_amount = 0;
	
		$payed_amount = floatval($order_info['rcb_amount']) + floatval($order_info['pd_amount']);
	
		//计算所需要支付金额
		$diff_pay_amount = uk86_ncPriceFormat(floatval($order_info['order_amount'])-$payed_amount);
	
		//显示支付方式与支付结果
		if ($payed_amount > 0) {
			$payed_tips = '';
			if (floatval($order_info['rcb_amount']) > 0) {
				$payed_tips = '充值卡已支付：￥'.$order_info['rcb_amount'];
			}
			if (floatval($order_info['pd_amount']) > 0) {
				$payed_tips .= ' 预存款已支付：￥'.$order_info['pd_amount'];
			}
			$order_info['goods_price'] .= " ( {$payed_tips} )";
		}
		Tpl::output('order_info',$order_info);
	
		//如果所需支付金额为0，转到支付成功页
		if ($diff_pay_amount == 0) {
			uk86_redirect('index.php?act=wap_buy_virtual&op=pay_ok&order_sn='.$order_info['order_sn'].'&order_id='.$order_info['order_id'].'&order_amount='.uk86_ncPriceFormat($order_info['order_amount']));
		}
	
		Tpl::output('diff_pay_amount',uk86_ncPriceFormat($diff_pay_amount));
	
		//显示支付接口列表
		$model_payment = Model('payment');
		$condition = array();
		$payment_list = $model_payment->getPaymentOpenList($condition);
		if (!empty($payment_list)) {
			unset($payment_list['predeposit']);
			unset($payment_list['offline']);
		}
		if (empty($payment_list)) {
			$this->wap_showDialog('暂未找到合适的支付方式','error','index.php?act=wap_member_fcode&op=rec_code');
		}
		Tpl::output('payment_list',$payment_list);
	
		Tpl::showpage('buy_virtual_step2');
	}
	
	/**
	 * 支付成功页面
	 */
	public function pay_okOp() {
		$order_sn	= $_GET['order_sn'];
		if (!preg_match('/^\d{18}$/',$order_sn)){
			$this->wap_showDialog('该订单不存在','error','index.php?act=wap_member_fcode&op=rec_code');
		}
		Tpl::showpage('buy_virtual_step3');
	}
}
?>