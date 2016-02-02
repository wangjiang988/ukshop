<?php
/**
 * 促销抢购列表
 * @author ZHUXUESONG
 *
 */
defined('InUk86') or exit('Access Invalid!');

class wap_promotionControl extends BaseWapControl{
	
	/**
	 * 抢购列表
	 */
	public function indexOp(){
		$model_groupbuy = Model('groupbuy');
		$condition = array('is_vr' => 0);
		$order = 'recommended desc, groupbuy_rebate desc';
		$groupbuy_list = $model_groupbuy->getGroupbuyOnlineList($condition, null, $order);
		Tpl::output('groupbuy_list', $groupbuy_list);
		Tpl::showpage('groupbuy_list');
	}
}
?>