<?php
/**
 * 商品评价控制器
 * @author ZHUXUESONG
 *
 */
defined('InUk86') or exit('Access Invalid!');

class wap_goods_assessControl extends BaseWapControl{
	public function __construct(){
		parent::__construct();
		Uk86Language::uk86_read('member_layout,member_evaluate');
	}
	
	public function indexOp(){
		header("Content-type:text/html; charset=utf-8");
		$order_id = intval($_GET['order_id']);
		if(!$order_id){
			$this->wap_showDialog(Uk86Language::uk86_get('wrong_argument'), 'error', 'index.php?act=wap_member_order');
		}
		$model_order = Model('order');
		$model_store = Model('store');
		$model_evaluate_goods = Model('evaluate_goods');
		$model_evaluate_store = Model('evaluate_store');
		
		//获取订单信息
		$order_info = $model_order->getOrderInfo(array('order_id' => $order_id));
		//判断订单身份
		if($order_info['buyer_id'] != $_SESSION['member_id']) {
			$this->wap_showDialog(Uk86Language::uk86_get('wrong_argument'),'error','index.php?act=member_order');
		}
		//订单为'已收货'状态，并且未评论
		$order_info['evaluate_able'] = $model_order->getOrderOperateState('evaluation',$order_info);
		if (empty($order_info) || !$order_info['evaluate_able']){
			$this->wap_showDialog(Uk86Language::uk86_get('member_evaluation_order_notexists'),'error','index.php?act=member_order');
		}
		
		//查询店铺信息
		$store_info = $model_store->getStoreInfoByID($order_info['store_id']);
		if(empty($store_info)){
			$this->wap_showDialog(Uk86Language::uk86_get('member_evaluation_store_notexists'),'error','index.php?act=member_order');
		}
		
		//获取订单商品
		$order_goods = $model_order->getOrderGoodsList(array('order_id'=>$order_id));
		if(empty($order_goods)){
			$this->wap_showDialog(Uk86Language::uk86_get('member_evaluation_order_notexists'),'error','index.php?act=member_order');
		}
		//判断是否为页面
		if (!$_POST){
			$order_goods[0]['goods_image_url'] = uk86_cthumb($order_info['goods_image'], 60, $order_info['store_id']);
		
			//处理U币、经验值计算说明文字
// 			$ruleexplain = '';
// 			$exppoints_rule = C("exppoints_rule")?unserialize(C("exppoints_rule")):array();
// 			$exppoints_rule['exp_comments'] = intval($exppoints_rule['exp_comments']);
// 			$points_comments = intval(C('points_comments'));
// 			if ($exppoints_rule['exp_comments'] > 0 || $points_comments > 0){
// 				$ruleexplain .= '评价完成将获得';
// 				if ($exppoints_rule['exp_comments'] > 0){
// 					$ruleexplain .= (' “'.$exppoints_rule['exp_comments'].'经验值”');
// 				}
// 				if ($points_comments > 0){
// 					$ruleexplain .= (' “'.$points_comments.'U币”');
// 				}
// 				$ruleexplain .= '。';
// 			}
// 			Tpl::output('ruleexplain', $ruleexplain);
		
			//不显示左菜单
			Tpl::output('order_info',$order_info);
			Tpl::output('order_goods',$order_goods);
			Tpl::output('store_info',$store_info);
			//p($order_goods);die();
			Tpl::showpage('assess.index');
		}else {
			$evaluate_goods_array = array();
			$goodsid_array = array();
			foreach ($order_goods as $value){
				//如果未评分，默认为5分
				$evaluate_score = intval($_POST['goods'][$value['goods_id']]['score']);
				if($evaluate_score <= 0 || $evaluate_score > 5) {
					$evaluate_score = 5;
				}
				//默认评语
				$evaluate_comment = $_POST['goods'][$value['goods_id']]['comment'];
				if(empty($evaluate_comment)) {
					$evaluate_comment = '不错哦';
				}
		
				$evaluate_goods_info = array();
				$evaluate_goods_info['geval_orderid'] = $order_id;
				$evaluate_goods_info['geval_orderno'] = $order_info['order_sn'];
				$evaluate_goods_info['geval_ordergoodsid'] = $order_id;
				$evaluate_goods_info['geval_goodsid'] = $value['goods_id'];
				$evaluate_goods_info['geval_goodsname'] = $value['goods_name'];
				$evaluate_goods_info['geval_goodsprice'] = $value['goods_price'];
				$evaluate_goods_info['geval_goodsimage'] = $value['goods_image'];
				$evaluate_goods_info['geval_scores'] = $evaluate_score;
				$evaluate_goods_info['geval_content'] = $evaluate_comment;
				$evaluate_goods_info['geval_isanonymous'] = $_POST['anony']?1:0;
				$evaluate_goods_info['geval_addtime'] = TIMESTAMP;
				$evaluate_goods_info['geval_storeid'] = $store_info['store_id'];
				$evaluate_goods_info['geval_storename'] = $store_info['store_name'];
				$evaluate_goods_info['geval_frommemberid'] = $_SESSION['member_id'];
				$evaluate_goods_info['geval_frommembername'] = $_SESSION['member_name'];
		
				$evaluate_goods_array[] = $evaluate_goods_info;
		
				$goodsid_array[] = $value['goods_id'];
			}
			$model_evaluate_goods->addEvaluateGoodsArray($evaluate_goods_array, $goodsid_array);
		
			$store_desccredit = intval($_POST['store_desccredit']);
			if($store_desccredit <= 0 || $store_desccredit > 5) {
				$store_desccredit= 5;
			}
			$store_servicecredit = intval($_POST['store_servicecredit']);
			if($store_servicecredit <= 0 || $store_servicecredit > 5) {
				$store_servicecredit = 5;
			}
			$store_deliverycredit = intval($_POST['store_deliverycredit']);
			if($store_deliverycredit <= 0 || $store_deliverycredit > 5) {
				$store_deliverycredit = 5;
			}
			//添加店铺评价
			if (!$store_info['is_own_shop']) {
				$evaluate_store_info = array();
				$evaluate_store_info['seval_orderid'] = $order_id;
				$evaluate_store_info['seval_orderno'] = $order_info['order_sn'];
				$evaluate_store_info['seval_addtime'] = time();
				$evaluate_store_info['seval_storeid'] = $store_info['store_id'];
				$evaluate_store_info['seval_storename'] = $store_info['store_name'];
				$evaluate_store_info['seval_memberid'] = $_SESSION['member_id'];
				$evaluate_store_info['seval_membername'] = $_SESSION['member_name'];
				$evaluate_store_info['seval_desccredit'] = $store_desccredit;
				$evaluate_store_info['seval_servicecredit'] = $store_servicecredit;
				$evaluate_store_info['seval_deliverycredit'] = $store_deliverycredit;
				$model_evaluate_store->addEvaluateStore($evaluate_store_info);
			}
		
			//更新订单信息并记录订单日志
			$state = $model_order->editOrder(array('evaluation_state'=>1), array('order_id' => $order_id));
		    //$state = $model_order->where(array('order_id' => $order_id))->update(array('evaluation_state'=>1, 'evaluation_time'=>TIMESTAMP));
			//添加会员U币
			if (C('points_isuse') == 1){
				$points_model = Model('points');
				$points_model->savePointsLog('comments',array('pl_memberid'=>$_SESSION['member_id'],'pl_membername'=>$_SESSION['member_name']));
			}
			//添加会员经验值
			Model('exppoints')->saveExppointsLog('comments',array('exp_memberid'=>$_SESSION['member_id'],'exp_membername'=>$_SESSION['member_name']));;
		
			$this->wap_showDialog(Uk86Language::uk86_get('member_evaluation_evaluat_success'), 'succ','index.php?act=wap_member_order');
		}
	}
}
?>