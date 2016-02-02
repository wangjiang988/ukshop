<?php
/**
 * 虚拟商品购买行为
 *
 * by Uk86 商城开发
 */
defined('InUk86') or exit('Access Invalid!');
class buy_promotionLogic {

    /**
     * 虚拟商品购买第一步，得到购买数据(商品、店铺、会员)
     * @param int $goods_id 商品ID
     * @param int $quantity 购买数量
     * @param int $member_id 会员ID
     * @return array
     */
    public function getBuyStep1Data($goods_id, $quantity, $member_id) {
        return $this->getBuyStepData($goods_id, $quantity, $member_id);
    }

    /**
     * 虚拟商品购买第二步，得到购买数据(商品、店铺、会员)
     * @param int $goods_id 商品ID
     * @param int $quantity 购买数量
     * @param int $member_id 会员ID
     * @return array
     */
    public function getBuyStep2Data($goods_id, $quantity, $member_id) {
        return $this->getBuyStepData($goods_id, $quantity, $member_id);
    }

    /**
     * 得到虚拟商品购买数据(商品、店铺、会员)
     * @param int $goods_id 商品ID
     * @param int $quantity 购买数量
     * @param int $member_id 会员ID
     * @return array
     */
    public function getBuyStepData($goods_id, $quantity, $member_id) {
        $goods_info = Model('goods')->getVirtualGoodsOnlineInfoByID($goods_id);
        if (empty($goods_info)) {
            return uk86_callback(false, '该商品不符合购买条件，可能的原因有：下架、不存在、过期等');
        }

        if ($goods_info['virtual_limit'] > $goods_info['goods_storage']) {
            $goods_info['virtual_limit'] = $goods_info['goods_storage'];
        }

        //取得抢购信息
        $goods_info = $this->_getGroupbuyInfo($goods_info);

        $quantity = abs(intval($quantity));
        $quantity = $quantity == 0 ? 1 : $quantity;
        $quantity = $quantity > $goods_info['virtual_limit'] ? $goods_info['virtual_limit'] : $quantity;
        if ($quantity > $goods_info['goods_storage']) {
            return uk86_callback(false, '该商品库存不足');
        }
        $goods_info['quantity'] = $quantity;
        $goods_info['goods_total'] = uk86_ncPriceFormat($goods_info['goods_price'] * $goods_info['quantity']);
        $goods_info['goods_image_url'] = uk86_cthumb($goods_info['goods_image'], 240, $goods_info['store_id']);

        $return = array();
        $return['goods_info'] = $goods_info;
        $return['store_info'] = Model('store')->getStoreOnlineInfoByID($goods_info['store_id'],'store_name,store_id,member_id');
        $return['member_info'] = Model('member')->getMemberInfoByID($member_id);

//        $model_payment = Model('payment');
//        $pd_payment_info = Model('payment')->getPaymentOpenInfo(array('payment_code'=>'predeposit'));
//        if (empty($pd_payment_info)) {
//            $return['member_info']['available_predeposit'] = 0;
//            $return['member_info']['available_rc_balance'] = 0;
//        }
        return uk86_callback(true,'',$return);
    }

    /**
     * 虚拟商品购买第三步
     * @param array $post 接收POST数据，必须传入goods_id:商品ID，quantity:购买数量,buyer_phone:接收手机,buyer_msg:买家留言
     * @param int $member_id
     * @return array
     */
    public function buyStep3($post, $member_id) {

        $result = $this->getBuyStepData($post['goods_id'], $post['quantity'], $member_id);
        if (!$result['state']) return $result;
        
        $goods_info = $result['data']['goods_info'];
        $member_info = $result['data']['member_info'];

        //应付总金额计算
        $pay_total = $goods_info['goods_price'] * $goods_info['quantity'];
        $store_id = $goods_info['store_id'];
        $store_goods_total_list = array($store_id => $pay_total);
        $pay_total = $store_goods_total_list[$store_id];

        //整理数据
        $input = array();
        $input['quantity'] = $goods_info['quantity'];
        $input['buyer_phone'] = $post['buyer_phone'];
        $input['buyer_msg'] = $post['buyer_msg'];
        $input['pay_total'] = $pay_total;
        $input['order_from'] = $post['order_from'];
        try {

            $model_goods = Model('goods');
            //开始事务
            $model_goods->beginTransaction();

            //生成订单
            $order_info = $this->_createOrder($input,$goods_info,$member_info);

            if (!empty($post['password'])) {
                if ($member_info['member_paypwd'] != '' && $member_info['member_paypwd'] == md5($post['password'])) {
                    //充值卡支付
                    if (!empty($post['rcb_pay'])) {
                        $order_info = $this->_rcbPay($order_info, $post, $member_info);
                    }
                    //预存款支付
                    if (!empty($post['pd_pay'])) {
                        $this->_pdPay($order_info, $post, $member_info);
                    }                    
                }
            }

            //提交事务
            $model_goods->commit();

        }catch (Exception $e){

            //回滚事务
            $model_goods->rollback();
            return uk86_callback(false, $e->getMessage());
        }

        //变更库存和销量
        Uk86QueueClient::push('createOrderUpdateStorage', array($goods_info['goods_id'] => $goods_info['quantity']));

        //更新抢购信息
        $this->_updateGroupBuy($goods_info);

        //发送兑换码到手机
        $param = array('order_id'=>$order_info['order_id'],'buyer_id'=>$member_id,'buyer_phone'=>$order_info['buyer_phone']);
        Uk86QueueClient::push('sendVrCode', $param);

        return uk86_callback(true,'',array('order_id' => $order_info['order_id']));
    }


    /**
     * 创建促销的虚拟订单
     * @author bzhang,wangjiang
	 * $type 虚拟订单类型
	 * $return_type  info  返回order_info.
     */
    public function createPromotionVrOrder($post,$type = '1',$member_id,$return_type='default'){
        //会员数据
        $member_info = Model('member')->getMemberInfoByID($member_id);
        //整理数据
        $input = array();
        $input['quantity'] = isset($post['quantity'])?$post['quantity']:$post['quota_quantity'];
        $input['buyer_msg'] = isset($post['buyer_msg'])?$post['buyer_msg']:'';
        $input['pay_total'] = $post['price'];
		$input['goods_price'] = $post['unit_price'];
        try {

            $model_goods = Model('goods');
            //开始事务
            $model_goods->beginTransaction();

            //生成订单
            $order_info = $this->_createOrder($input,$member_info,$type);

            if (!empty($post['password'])) {
                if ($member_info['member_paypwd'] != '' && $member_info['member_paypwd'] == md5($post['password'])) {
                    //充值卡支付
                    if (!empty($post['rcb_pay'])) {
                        $order_info = $this->_rcbPay($order_info, $post, $member_info);
                    }
                    //预存款支付
                    if (!empty($post['pd_pay'])) {
                        $this->_pdPay($order_info, $post, $member_info);
                    }
                }
            }

            //提交事务
            $model_goods->commit();

        }catch (Exception $e){

            //回滚事务
            $model_goods->rollback();
            return uk86_callback(false, $e->getMessage());
        }
		if($return_type == 'default')
        	return uk86_callback(true,'',array('order_id' => $order_info['order_id']));
		elseif($return_type == 'info')
			return $order_info;
		else
			return uk86_callback(true,'',array('order_id' => $order_info['order_id']));
    }


    /**
     * 生成订单
     * @param array $input 表单数据
     * @param unknown $member_info 会员数据
     * @throws Exception
     * @return array
     */
    private function _createOrder($input, $member_info,$type) {
        extract($input);
        $model_vr_order = Model('pm_order');
			
        //存储生成的订单,函数会返回该数组
        $order = array();
        $order['order_sn'] = $this->_makeOrderSn($member_info['member_id']);
        $order['store_name'] = '系统平台';
        $order['buyer_id'] = $member_info['member_id'];
        $order['buyer_name'] = $member_info['member_name'];
        $order['buyer_msg'] = $input['buyer_msg'];
        $order['add_time'] = TIMESTAMP;
        $order['order_state'] = ORDER_STATE_NEW;
        $order['order_amount'] = $input['pay_total'];
		$order['goods_type'] = $type;
        $order['goods_name'] = $this->_getTypeName($type);
        $order['goods_price'] = $input['goods_price'];
        $order['goods_num'] = $input['quantity'];

        $order_id = $model_vr_order->addOrder($order);

        if (!$order_id) {
            throw new Exception('订单保存失败');
        }
        $order['order_id'] = $order_id;

        return $order;
    }
	
	/**
	 * 根据订单类型，得到订单类型名称
	 * 1抢购2.限时，3满送，4优惠套餐，5推荐站位，6卡卷包
	 * @author wangjiang
	 */
	 private function _getTypeName($type){
	 	$type_arr = array(
			'1' => '抢购',
			'2' => '限时折扣',
			'3' => '满即送',
			'4' => '优惠套装',
			'5' => '推荐展位',
			'6' => '卡券包',
			'7' => '品牌申请'
		);
		return isset($type_arr[$type])?$type_arr[$type]:false;
	 }

    /**
     * 生成支付单编号(两位随机 + 从2000-01-01 00:00:00 到现在的秒数+微秒+会员ID%1000)，该值会传给第三方支付接口
     * 长度 =2位 + 10位 + 3位 + 3位  = 18位
     * 1000个会员同一微秒提订单，重复机率为1/100
     * @return string
     */
    private function _makeOrderSn($member_id) {
        return mt_rand(10,99)
        . sprintf('%010d',time() - 946656000)
        . sprintf('%03d', (float) microtime() * 1000)
        . sprintf('%03d', (int) $member_id % 1000);
    }

    /**
     * 更新抢购购买人数和数量
     */
    private function _updateGroupBuy($goods_info) {
        if ($goods_info['ifgroupbuy'] && $goods_info['groupbuy_id']) {
            $groupbuy_info = array();
            $groupbuy_info['groupbuy_id'] = $goods_info['groupbuy_id'];
            $groupbuy_info['quantity'] = $goods_info['quantity'];
            Uk86QueueClient::push('editGroupbuySaleCount', $groupbuy_info);
        }
    }

    /**
     * 充值卡支付
     * 如果充值卡足够就单独支付了该订单，如果不足就暂时冻结，等API支付成功了再彻底扣除
     */
    private function _rcbPay($order_info, $input, $buyer_info) {
        $available_rcb_amount = floatval($buyer_info['available_rc_balance']);

        if ($available_rcb_amount <= 0) return;
        $model_vr_order = Model('vr_order');
        $model_pd = Model('predeposit');

        $order_amount = floatval($order_info['order_amount']);
        $data_pd = array();
        $data_pd['member_id'] = $buyer_info['member_id'];
        $data_pd['member_name'] = $buyer_info['member_name'];
        $data_pd['amount'] = $order_amount;
        $data_pd['order_sn'] = $order_info['order_sn'];

        if ($available_rcb_amount >= $order_amount) {
    
            // 预存款立即支付，订单支付完成
            $model_pd->changeRcb('order_pay',$data_pd);
            $available_rcb_amount -= $order_amount;
    
            // 订单状态 置为已支付
            $data_order = array();
            $order_info['order_state'] = $data_order['order_state'] = ORDER_STATE_PAY;
            $data_order['payment_time'] = TIMESTAMP;
            $data_order['payment_code'] = 'predeposit';
            $data_order['rcb_amount'] = $order_info['order_amount'];
            $result = $model_vr_order->editOrder($data_order,array('order_id'=>$order_info['order_id']));
            if (!$result) {
                throw new Exception('订单更新失败');
            }

            //发放兑换码
            $insert = $model_vr_order->addOrderCode($order_info);
            if (!$insert) {
                throw new Exception('兑换码发送失败');
            }

        } else {

            //暂冻结预存款,后面还需要 API彻底完成支付
            $data_pd['amount'] = $available_rcb_amount;
            $model_pd->changeRcb('order_freeze',$data_pd);
            //预存款支付金额保存到订单
            $data_order = array();
            $order_info['rcb_amount'] = $data_order['rcb_amount'] = $available_rcb_amount;
            $result = $model_vr_order->editOrder($data_order,array('order_id'=>$order_info['order_id']));
            if (!$result) {
                throw new Exception('订单更新失败');
            }
        }
        return $order_info;
    }

    /**
     * 预存款支付
     * 如果预存款足够就单独支付了该订单，如果不足就暂时冻结，等API支付成功了再彻底扣除
     */
    private function _pdPay($order_info, $input, $buyer_info) {
        if ($order_info['order_state'] == ORDER_STATE_PAY) return;

        $available_pd_amount = floatval($buyer_info['available_predeposit']);
        if ($available_pd_amount <= 0) return;

        $model_vr_order = Model('vr_order');
        $model_pd = Model('predeposit');

        $order_amount = floatval($order_info['order_amount'])-floatval($order_info['rcb_amount']);
        $data_pd = array();
        $data_pd['member_id'] = $buyer_info['member_id'];
        $data_pd['member_name'] = $buyer_info['member_name'];
        $data_pd['amount'] = $order_amount;
        $data_pd['order_sn'] = $order_info['order_sn'];

        if ($available_pd_amount >= $order_amount) {

            //预存款立即支付，订单支付完成
            $model_pd->changePd('order_pay',$data_pd);
            $available_pd_amount -= $order_amount;

            //下单，支付被冻结的充值卡
            $pd_amount = floatval($order_info['rcb_amount']);
            if ($pd_amount > 0) {
                $data_pd = array();
                $data_pd['member_id'] = $buyer_info['member_id'];
                $data_pd['member_name'] = $buyer_info['member_name'];
                $data_pd['amount'] = $pd_amount;
                $data_pd['order_sn'] = $order_info['order_sn'];
                $model_pd->changeRcb('order_comb_pay',$data_pd);
            }

            // 订单状态 置为已支付
            $data_order = array();
            $data_order['order_state'] = ORDER_STATE_PAY;
            $data_order['payment_time'] = TIMESTAMP;
            $data_order['payment_code'] = 'predeposit';
            $data_order['pd_amount'] = $order_amount;
            $result = $model_vr_order->editOrder($data_order,array('order_id'=>$order_info['order_id']));
            if (!$result) {
                throw new Exception('订单更新失败');
            }

            //发放兑换码
            $model_vr_order->addOrderCode($order_info);

        } else {

            //暂冻结预存款,后面还需要 API彻底完成支付
            $data_pd['amount'] = $available_pd_amount;
            $model_pd->changePd('order_freeze',$data_pd);
            //预存款支付金额保存到订单
            $data_order = array();
            $data_order['pd_amount'] = $available_pd_amount;
            $result = $model_vr_order->editOrder($data_order,array('order_id'=>$order_info['order_id']));
            if (!$result) {
                throw new Exception('订单更新失败');
            }
        }
    }

    /**
     * 取得抢购信息
     * @param array $goods_info
     * @return array
     */
    private function _getGroupbuyInfo($goods_info = array()) {
        if (!C('groupbuy_allow') || empty($goods_info) || !is_array($goods_info)) return $goods_info;
    
        $groupbuy_info = Model('groupbuy')->getGroupbuyInfoByGoodsCommonID($goods_info['goods_commonid']);
        if (empty($groupbuy_info)) return $goods_info;
        // 虚拟抢购数量限制
        if ($groupbuy_info['upper_limit'] > 0 && $groupbuy_info['upper_limit'] < $goods_info['virtual_limit']) {
            $goods_info['virtual_limit'] = $groupbuy_info['upper_limit'];
        }
        $goods_info['goods_price'] = $groupbuy_info['groupbuy_price'];
        $goods_info['groupbuy_id'] = $groupbuy_info['groupbuy_id'];
        $goods_info['ifgroupbuy'] = true;
    
        return $goods_info;
    }
}
