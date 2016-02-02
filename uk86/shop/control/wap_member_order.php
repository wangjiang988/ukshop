<?php
/**
 * 
 * 会员订单
 * @author ZHUXUESONG
 */
defined('InUk86') or exit('Access Invalid!');

class wap_member_orderControl extends BaseWapControl{
	public function __construct(){
		parent::__construct();
		//验证是否登录
		if(!$_SESSION['is_login']){
			header('Location:index.php?act=wap_login&op=login');
		}
	}
	
	/**
	 * 按照条件查询订单订单
	 */
	public function indexOp(){
		$model_order = Model('order');
		
		//搜索
		$condition = array();
		$condition['buyer_id'] = $_SESSION['member_id'];
		if ($_GET['order_sn'] != '') {
			$condition['order_sn'] = $_GET['order_sn'];
		}
// 		$if_start_date = preg_match('/^20\d{2}-\d{2}-\d{2}$/',$_GET['query_start_date']);
// 		$if_end_date = preg_match('/^20\d{2}-\d{2}-\d{2}$/',$_GET['query_end_date']);
// 		$start_unixtime = $if_start_date ? strtotime($_GET['query_start_date']) : null;
// 		$end_unixtime = $if_end_date ? strtotime($_GET['query_end_date']): null;
// 		if ($start_unixtime || $end_unixtime) {
// 			$condition['add_time'] = array('time',array($start_unixtime,$end_unixtime));
// 		}
		if ($_GET['state_type'] != '') {
			$condition['order_state'] = str_replace(
					array('state_new','state_pay','state_send','state_success','state_noeval','state_cancel'),
					array(ORDER_STATE_NEW,ORDER_STATE_PAY,ORDER_STATE_SEND,ORDER_STATE_SUCCESS,ORDER_STATE_SUCCESS,ORDER_STATE_CANCEL), $_GET['state_type']);
		}
		if ($_GET['state_type'] == 'state_noeval') {
			$condition['evaluation_state'] = 0;
			$condition['order_state'] = ORDER_STATE_SUCCESS;
		}
		
		//回收站
		if ($_GET['recycle']) {
			$condition['delete_state'] = 1;
		} else {
			$condition['delete_state'] = 0;
		}
		$order_list = $model_order->getOrderList($condition, '', '*', 'order_id desc','', array('order_common','order_goods','store'));
		
		$model_refund_return = Model('refund_return');
		$order_list = $model_refund_return->getGoodsRefundList($order_list);
		
		//订单列表以支付单pay_sn分组显示
		$order_group_list = array();
		$order_pay_sn_array = array();
		foreach ($order_list as $order_id => $order) {
		
			//显示取消订单
			$order['if_cancel'] = $model_order->getOrderOperateState('buyer_cancel',$order);
		
			//显示退款取消订单
			$order['if_refund_cancel'] = $model_order->getOrderOperateState('refund_cancel',$order);
		
			//显示投诉
			$order['if_complain'] = $model_order->getOrderOperateState('complain',$order);
		
			//显示收货
			$order['if_receive'] = $model_order->getOrderOperateState('receive',$order);
		
			//显示锁定中
			$order['if_lock'] = $model_order->getOrderOperateState('lock',$order);
		
			//显示物流跟踪
			$order['if_deliver'] = $model_order->getOrderOperateState('deliver',$order);
		
			//显示评价
			$order['if_evaluation'] = $model_order->getOrderOperateState('evaluation',$order);
		
			//显示删除订单(放入回收站)
			$order['if_delete'] = $model_order->getOrderOperateState('delete',$order);
		
			//显示永久删除
			$order['if_drop'] = $model_order->getOrderOperateState('drop',$order);
		
			//显示还原订单
			$order['if_restore'] = $model_order->getOrderOperateState('restore',$order);
		
			foreach ($order['extend_order_goods'] as $value) {
				$value['image_60_url'] = uk86_cthumb($value['goods_image'], 60, $value['store_id']);
				$value['image_240_url'] = uk86_cthumb($value['goods_image'], 240, $value['store_id']);
				$value['goods_type_cn'] = uk86_orderGoodsType($value['goods_type']);
				$value['goods_url'] = uk86_urlShop('goods','index',array('goods_id'=>$value['goods_id']));
				if ($value['goods_type'] == 5) {
					$order['zengpin_list'][] = $value;
				} else {
					$order['goods_list'][] = $value;
				}
			}
		
			if (empty($order['zengpin_list'])) {
				$order['goods_count'] = count($order['goods_list']);
			} else {
				$order['goods_count'] = count($order['goods_list']) + 1;
			}
			$order_group_list[$order['pay_sn']]['order_list'][] = $order;
		
			//如果有在线支付且未付款的订单则显示合并付款链接
			if ($order['order_state'] == ORDER_STATE_NEW) {
				$order_group_list[$order['pay_sn']]['pay_amount'] += $order['order_amount']-$order['pd_amount']-$order['rcb_amount'];
			}
			$order_group_list[$order['pay_sn']]['add_time'] = $order['add_time'];
		
			//记录一下pay_sn，后面需要查询支付单表
			$order_pay_sn_array[] = $order['pay_sn'];
		}
		
		//取得这些订单下的支付单列表
		$condition = array('pay_sn'=>array('in',array_unique($order_pay_sn_array)));
		$order_pay_list = $model_order->getOrderPayList($condition,'','*','','pay_sn');
		foreach ($order_group_list as $pay_sn => $pay_info) {
			$order_group_list[$pay_sn]['pay_info'] = $order_pay_list[$pay_sn];
		}
		//var_dump($order_group_list);
		Tpl::output('order_group_list',$order_group_list);
		Tpl::output('order_pay_list',$order_pay_list);
		Tpl::showpage('member_order.index');
	}
	
	/**
	 * 订单详细
	 *
	 */
	public function show_orderOp() {
		$order_id = intval($_GET['order_id']);
		if ($order_id <= 0) {
			uk86_showMessage(Uk86Language::uk86_get('member_order_none_exist'),'','html','error');
		}
		$model_order = Model('order');
		$condition = array();
		$condition['order_id'] = $order_id;
		$condition['buyer_id'] = $_SESSION['member_id'];
		$order_info = $model_order->getOrderInfo($condition,array('order_goods','order_common','store'));
		if (empty($order_info) || $order_info['delete_state'] == ORDER_DEL_STATE_DROP) {
			uk86_showMessage(Uk86Language::uk86_get('member_order_none_exist'),'','html','error');
		}
	
		$model_refund_return = Model('refund_return');
		$order_list = array();
		$order_list[$order_id] = $order_info;
		$order_list = $model_refund_return->getGoodsRefundList($order_list,1);//订单商品的退款退货显示
		$order_info = $order_list[$order_id];
		$refund_all = $order_info['refund_list'][0];
		if (!empty($refund_all) && $refund_all['seller_state'] < 3) {//订单全部退款商家审核状态:1为待审核,2为同意,3为不同意
			Tpl::output('refund_all',$refund_all);
		}
	
		//显示锁定中
		$order_info['if_lock'] = $model_order->getOrderOperateState('lock',$order_info);
	
		//显示取消订单
		$order_info['if_cancel'] = $model_order->getOrderOperateState('buyer_cancel',$order_info);
	
		//显示退款取消订单
		$order_info['if_refund_cancel'] = $model_order->getOrderOperateState('refund_cancel',$order_info);
	
		//显示投诉
		$order_info['if_complain'] = $model_order->getOrderOperateState('complain',$order_info);
	
		//显示收货
		$order_info['if_receive'] = $model_order->getOrderOperateState('receive',$order_info);
	
		//显示物流跟踪
		$order_info['if_deliver'] = $model_order->getOrderOperateState('deliver',$order_info);
	
		//显示评价
		$order_info['if_evaluation'] = $model_order->getOrderOperateState('evaluation',$order_info);
	
		//显示分享
		$order_info['if_share'] = $model_order->getOrderOperateState('share',$order_info);
	
		//显示系统自动取消订单日期
		if ($order_info['order_state'] == ORDER_STATE_NEW) {
			//$order_info['order_cancel_day'] = $order_info['add_time'] + ORDER_AUTO_CANCEL_DAY * 24 * 3600;
			// by ukshop.com
			$order_info['order_cancel_day'] = $order_info['add_time'] + ORDER_AUTO_CANCEL_DAY + 3 * 24 * 3600;
		}
	
		//显示快递信息
		if ($order_info['shipping_code'] != '') {
			$express = uk86_rkcache('express',true);
			$order_info['express_info']['e_code'] = $express[$order_info['extend_order_common']['shipping_express_id']]['e_code'];
			$order_info['express_info']['e_name'] = $express[$order_info['extend_order_common']['shipping_express_id']]['e_name'];
			$order_info['express_info']['e_url'] = $express[$order_info['extend_order_common']['shipping_express_id']]['e_url'];
		}
	
		//显示系统自动收获时间
		if ($order_info['order_state'] == ORDER_STATE_SEND) {
			//$order_info['order_confirm_day'] = $order_info['delay_time'] + ORDER_AUTO_RECEIVE_DAY * 24 * 3600;
			//by ukshop.com
			$order_info['order_confirm_day'] = $order_info['delay_time'] + ORDER_AUTO_RECEIVE_DAY + 15 * 24 * 3600;
		}
	
		//如果订单已取消，取得取消原因、时间，操作人
		if ($order_info['order_state'] == ORDER_STATE_CANCEL) {
			$order_info['close_info'] = $model_order->getOrderLogInfo(array('order_id'=>$order_info['order_id']),'log_id desc');
		}
	
		foreach ($order_info['extend_order_goods'] as $value) {
			$value['image_60_url'] = uk86_cthumb($value['goods_image'], 60, $value['store_id']);
			$value['image_240_url'] = uk86_cthumb($value['goods_image'], 240, $value['store_id']);
			$value['goods_type_cn'] = uk86_orderGoodsType($value['goods_type']);
			$value['goods_url'] = uk86_urlShop('goods','index',array('goods_id'=>$value['goods_id']));
			if ($value['goods_type'] == 5) {
				$order_info['zengpin_list'][] = $value;
			} else {
				$order_info['goods_list'][] = $value;
			}
		}
	
		if (empty($order_info['zengpin_list'])) {
			$order_info['goods_count'] = count($order_info['goods_list']);
		} else {
			$order_info['goods_count'] = count($order_info['goods_list']) + 1;
		}
	
		Tpl::output('order_info',$order_info);
	
		//卖家发货信息
		if (!empty($order_info['extend_order_common']['daddress_id'])) {
			$daddress_info = Model('daddress')->getAddressInfo(array('address_id'=>$order_info['extend_order_common']['daddress_id']));
			Tpl::output('daddress_info',$daddress_info);
		}
		Tpl::showpage('member_order.show');
	}
	
	/**
	 * 修改买家订单状态
	 */
	public function change_stateOp() {
		$state_type	= $_GET['state_type'];
		$order_id	= intval($_GET['order_id']);
	
		$model_order = Model('order');
	
		$condition = array();
		$condition['order_id'] = $order_id;
		$condition['buyer_id'] = $_SESSION['member_id'];
		$order_info	= $model_order->getOrderInfo($condition);
	
		if($state_type == 'order_cancel' || $_POST['state_type'] == 'order_cancel') {
			$result = $this->_order_cancel($order_info, $_POST);
		} else if ($state_type == 'order_receive') {
			$result = $this->_order_receive($order_info, $_POST);
		} else if (in_array($state_type, array('order_delete','order_drop','order_restore'))){
			$result = $this->_order_recycle($order_info, $_GET);
		} else {
			exit();
		}
	
		if(!$result['state']) {
			$this->wap_showDialog($result['msg']);
		} else {
			$this->wap_showDialog($result['msg'], 'succ');
		}
	}
	
	/**
	 * 取消订单
	 */
	private function _order_cancel($order_info, $post) {
		$model_order = Model('order');
		$logic_order = uk86_Logic('order');
		$if_allow = $model_order->getOrderOperateState('buyer_cancel',$order_info);
		if (!$if_allow) {
			return uk86_callback(false,'无权操作');
		}

		$msg = $post['state_info1'] != '' ? $post['state_info1'] : $post['state_info'];
		return $logic_order->changeOrderStateCancel($order_info,'buyer', $_SESSION['member_name'], $msg);
	}
	
	/**
	 * 收货
	 */
	private function _order_receive($order_info, $post) {
		$model_order = Model('order');
		$logic_order = uk86_Logic('order');
		$if_allow = $model_order->getOrderOperateState('receive',$order_info);
		if (!$if_allow) {
			return uk86_callback(false,'无权操作');
		}
		return $logic_order->changeOrderStateReceive($order_info,'buyer',$_SESSION['member_name']);
	}
	
	/**
	 * 删除订单
	 */
	private function _order_recycle($order_info, $get) {
		$model_order = Model('order');
		$logic_order = uk86_Logic('order');
		$state_type = str_replace(array('order_delete','order_drop','order_restore'), array('delete','drop','restore'), $_GET['state_type']);
		$if_allow = $model_order->getOrderOperateState($state_type,$order_info);
		if (!$if_allow) {
			return uk86_callback(false,'无权操作');
		}
	
		return $logic_order->changeOrderStateRecycle($order_info,'buyer',$state_type);
	}
}