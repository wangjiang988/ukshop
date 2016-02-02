<?php

defined('InUk86') or exit('Access Invalid!');
require(dirname(BASE_PATH)."/shop/api/payment/alipay/refund/lib/alipay_submit.class.php");

class refund_to_payModel extends refund_returnModel{
	/**
	 * 平台确认退款处理
	 *
	 * @param
	 * @return bool
	 */
	public function editOrderRefundExtension($refund) {
		$refund_id = intval($refund['refund_id']);
		if ($refund_id > 0) {
			Uk86Language::uk86_read('model_lang_index');
			$order_id = $refund['order_id'];//订单编号
			$field = 'trade_no,order_id,buyer_id,buyer_name,store_id,order_sn,order_amount,payment_code,order_state,refund_amount';
			$model_order = Model('order');
			$order = $model_order->getOrderInfo(array('order_id'=> $order_id),array(),$field);
	
			try {
				$this->beginTransaction();
				$order_amount = $order['order_amount'];//订单金额
				//$predeposit_amount = $order_amount-$order['refund_amount'];//可退金额
				//if ($predeposit_amount) {
					$log_array = array();
					$log_array['member_id'] = $order['buyer_id'];
					$log_array['member_name'] = $order['buyer_name'];
					$log_array['order_sn'] = $order['order_sn'];
					$log_array['amount'] = $refund['refund_amount'];
					$refund['trade_no'] = $order['trade_no'];
					if ($predeposit_amount > 0) {
						$log_array['amount'] = $refund['refund_amount']-$predeposit_amount;
					}
					$state = $this->changePa("refund",$log_array,$refund);//增加买家支付账户金额
				//}
				
	
				$order_state = $order['order_state'];
				$model_trade = Model('trade');
				$order_paid = $model_trade->getOrderState('order_paid');//订单状态20:已付款
				if ($state && $order_state == $order_paid) {
					uk86_Logic('order')->changeOrderStateCancel($order, 'system', '系统', '商品全部退款完成取消订单',false);
				}
				if ($state) {
					$order_array = array();
					$order_amount = $order['order_amount'];//订单金额
					$refund_amount = $order['refund_amount']+$refund['refund_amount'];//退款金额
					$order_array['refund_state'] = ($order_amount-$refund_amount) > 0 ? 1:2;
					$order_array['refund_amount'] = uk86_ncPriceFormat($refund_amount);
					$order_array['delay_time'] = time();
					$state = $model_order->editOrder($order_array,array('order_id'=> $order_id));//更新订单退款
				}
				if ($state && $refund['order_lock'] == '2') {
					$state = $this->editOrderUnlock($order_id);//订单解锁
				}
				$this->commit();
				return $state;
			} catch (Exception $e) {
				$this->rollback();
				return false;
			}
		}
		return false;
	}

	/**
	 * 变更预存款
	 * @param unknown $change_type
	 * @param unknown $data
	 * @throws Exception
	 * @return unknown
	 */
	public function changePa($change_type,$data = array(),$refund=array()) {
		$data_log = array();
		$data_pd = array();
		$data_msg = array();
		$data_log['lg_member_id'] = $data['member_id'];
		$data_log['lg_member_name'] = $data['member_name'];
		$data_log['lg_add_time'] = TIMESTAMP;
		$data_log['lg_type'] = $change_type;
	
		$data_msg['time'] = date('Y-m-d H:i:s');
		$data_msg['pd_url'] = uk86_urlShop('predeposit', 'pd_log_list');
		switch ($change_type){

			case 'refund':
				$data_log['lg_av_amount'] = $data['amount'];
				$data_log['lg_desc'] = '确认退款，订单号: '.$data['order_sn'];
				$data_pd['available_predeposit'] = array('exp','available_predeposit+'.$data['amount']);
	
				$data_msg['av_amount'] = $data['amount'];
				$data_msg['freeze_amount'] = 0;
				$data_msg['desc'] = $data_log['lg_desc'];
				break;
			case 'vr_refund':
				$data_log['lg_av_amount'] = $data['amount'];
				$data_log['lg_desc'] = '虚拟兑码退款成功，订单号: '.$data['order_sn'];
				$data_pd['available_predeposit'] = array('exp','available_predeposit+'.$data['amount']);
	
				$data_msg['av_amount'] = $data['amount'];
				$data_msg['freeze_amount'] = 0;
				$data_msg['desc'] = $data_log['lg_desc'];
				break;
			
			default:
				throw new Exception('参数错误');
				break;
		}
	//转到第三方退款api
		$update = $this->_api_refund($data['payment_code'],$refund);
	
		if (!$update) {
			throw new Exception('操作失败');
		}
		$insert = $this->table('pd_log')->insert($data_log);
		if (!$insert) {
			throw new Exception('操作失败');
		}
	
	
		$param = array();
		$param['code'] = 'predeposit_change';
		$param['member_id'] = $data['member_id'];
		$data_msg['av_amount'] = uk86_ncPriceFormat($data_msg['av_amount']);
		$data_msg['freeze_amount'] = uk86_ncPriceFormat($data_msg['freeze_amount']);
		$param['param'] = $data_msg;
		Uk86QueueClient::push('sendMemberMsg', $param);
		return $insert;
	}
	/**
	 * 第三方退款接口
	 * @data Array
	 * @return mix
	 */
	private function _api_refund($api,$refund_info=array()) {
		require_once(dirname(BASE_PATH)."/shop/api/payment/alipay/refund/alipay.config.php");
		$payment_api = new AlipaySubmit($alipay_config,$refund_info);
		if($refund_info['payment_code'] == 'chinabank') {
			//银行退款
		} else {
			$result = $payment_api->buildRequestForm();
			echo $result;
		}
		exit();
	}
	
} 
?>