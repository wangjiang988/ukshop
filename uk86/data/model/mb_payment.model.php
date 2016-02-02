<?php
/**
 * 手机支付方式
 *
 *
 *
 *
 * by Uk86 商城开发
 */
defined('InUk86') or exit('Access Invalid!');
class mb_paymentModel extends Model {

    //开启状态标识
    const STATE_OPEN = 1;

    public function __construct() {
        parent::__construct('mb_payment');
    }

	/**
	 * 读取单行信息
	 *
	 * @param
	 * @return array 数组格式的返回结果
	 */
	public function getMbPaymentInfo($condition = array()) {
		$payment_info = $this->where($condition)->find();
        if (!empty($payment_info['payment_config'])) {
            $payment_info['payment_config'] = unserialize($payment_info['payment_config']);
        }

        if (isset($payment_info['payment_config']) && !is_array($payment_info['payment_config'])) {
            $payment_info['payment_config'] = array();
        }

        return $payment_info;
	}

	/**
	 * 读开启中的取单行信息
	 *
	 * @param
	 * @return array 数组格式的返回结果
	 */
	public function getMbPaymentOpenInfo($condition = array()) {
	    $condition['payment_state'] = self::STATE_OPEN;
        return $this->getMbPaymentInfo($condition);
	}

	/**
	 * 读取多行
	 *
	 * @param
	 * @return array 数组格式的返回结果
	 */
	public function getMbPaymentList($condition = array()){
        $payment_list = $this->where($condition)->select();
        foreach ($payment_list as $key => $value) {
            if($value['payment_state'] == self::STATE_OPEN) {
                $payment_list[$key]['payment_state_text'] = '开启中';
            } else {
                $payment_list[$key]['payment_state_text'] = '关闭中';
            }
        }
        return $payment_list;
	}

	/**
	 * 读取开启中的支付方式
	 *
	 * @param
	 * @return array 数组格式的返回结果
	 */
	public function getMbPaymentOpenList($condition = array()){
	    $condition['payment_state'] = self::STATE_OPEN;
	    return $this->getMbPaymentList($condition);
	}

	/**
	 * 更新信息
	 *
	 * @param array $param 更新数据
	 * @return bool 布尔类型的返回结果
	 */
	public function editMbPayment($data, $condition){
        if(isset($data['payment_config'])) {
            $data['payment_config'] = serialize($data['payment_config']);
        }
		return $this->where($condition)->update($data);
	}
	
	/**
	 * 读取开启中的支付方式
	 * @param
	 * @return array 数组格式的返回结果
	 * 
	 * @author jason
	 * @since 2015-12-18
	 */
	public function getPaymentOpenList($condition = array()){
	    $condition['payment_state'] = self::STATE_OPEN;
	    return $this->where($condition)->key('payment_code')->select();
	}
	
	
	/**
	 * @return array 数组格式的返回结果
	 * 
	 * @author jason
	 * @since 2015-12-18
	 */
	public function get_payment_info($condition = array()){
	    $condition['payment_state'] = self::STATE_OPEN;
	    return $this->where($condition)->find();
	}
	
	/**
	 * @return array 数组格式的返回结果
	 * 
	 * @author jason
	 * @since 2015-12-18
	 */
	public function get_order_detail($condition = array()){
	    $sql = "SELECT orders.order_sn, orders.order_amount, shipping_fee, goods.`goods_name` FROM `".C('tablepre')."order` orders 
			INNER JOIN `".C('tablepre')."order_goods` goods 
			ON orders.order_id = goods.order_id
			WHERE `pay_sn` = '{$condition['pay_sn']}' AND orders.order_state = '{$condition['order_state']}'";
	    return  $this->query($sql);
	}
	
	
	
	
}
