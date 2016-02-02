<?php
/**
 * 会员F码
 * @author ZHUXUESONG
 *
 */
defined('InUk86') or exit('Access Invalid!');

class wap_member_fcodeControl extends BaseWapControl{
	public function __construct(){
		parent::__construct();
	}
	/**
	 * 会员F码列表
	 */
	public function indexOp(){
		header('Content-type:text/html; charset=utf-8');
		$free_model = Model('free');
		$goods_model = Model('goods');
		$fcode_list = $free_model->where(array('free_owner_id' => intval($_SESSION['member_id'])))->field('*')->order('free_grand_time asc')->select();
		if(is_array($fcode_list)){
			$fcode_not_use = array();
			$fcode_is_use = array();
			$fcode_goods = $goods_model->where(array('is_fcode' => 1))->field('goods_id, goods_name, goods_image')->select();
			foreach($fcode_list as $k => $v){
				foreach ($fcode_goods as $val){
					if($val['goods_id'] == $v['free_goods_id']){
						$fcode_list[$k]['goods'] = $val;
					}
				}
				if($v['free_state'] == 1){
					$fcode_is_use[] = $fcode_list[$k];
				}else{
					$fcode_not_use[] = $fcode_list[$k];
				}
			}
			Tpl::output('fcode_is_use', $fcode_is_use);
			Tpl::output('fcode_not_use', $fcode_not_use);
		}
		Tpl::output('fcode_list', $fcode_list);
		Tpl::showpage('member_fcode');
	}
	
	/**
	 * 会员兑换码
	 */
	public function rec_codeOp(){
		header('Content-type:text/html; charset=utf-8');
		$code_model = Model('vr_order_code');
		$code_list = $code_model->where(array('buyer_id'=>$_SESSION['member_id'], 'refund_lock' => 0))->field('*')->order('rec_id desc')->select();
		$order_list = Model()->table('vr_order')->where(array('buyer_id'=>$_SESSION['member_id']))->field('order_id, goods_id, goods_name, goods_image')->select();
		if(is_array($code_list)){
			foreach ($code_list as $k => $v){
				//如果已过期，改变兑换码状态
				if($v['vr_state'] == 0 && $v['vr_indate'] <= time()){
					$code_model->where(array('rec_id' => $v['rec_id']))->update(array('vr_state' => 2));
					$code_list[$k]['vr_state'] = 1;
				}
				foreach($order_list as $order_info){
					if($order_info['order_id'] == $v['order_id']){
						$code_list[$k]['goods'] = $order_info;
					}
				}
				if($v['vr_state'] == 0){
					$recode_not_use[] = $code_list[$k];
				}elseif($v['vr_state'] == 1){
					$recode_is_use[] = $code_list[$k];
				}else{
					$recode_pass = $code_list[$k];
				}
				Tpl::output('recode_not_use', $recode_not_use);
				Tpl::output('recode_is_use', $recode_is_use);
				Tpl::output('recode_pass', $recode_pass);
			}
		}
		Tpl::output('code_list', $code_list);
		Tpl::showpage('member_recode');
	}
	
	/**
	 * 会员卡券包列表
	 */
	public function voucher_listOp(){
		$condition = array();
		$condition['voucher_owner_id'] =  intval($_SESSION['member_id']);
		$condition['voucher_state'] = array('in', '1,2,3');
		$voucher_list = Model()->table('voucher')->where($condition)->field('*')->order('voucher_active_date desc')->select();
		$voucher_template = Model()->table('voucher_template')->field('voucher_t_id, voucher_t_price, voucher_t_customimg')->select();
		foreach ($voucher_list as $k => $v){
			//获取卡卷包模板信息
			foreach ($voucher_template as $t_v){
				if($t_v['voucher_t_id'] == $v['voucher_t_id']){
					$voucher_list[$k]['voucher_t_img'] = UPLOAD_SITE_URL.DS.'shop/voucher/1/'.$t_v['voucher_t_customimg'];
					$voucher_list[$k]['voucher_t_price'] = $t_v['voucher_t_price'];
				}
			}
			//如果卡卷包已过期，改变状态
			if(intval($v['voucher_end_date']) <= time()){
				$voucher_list[$k]['voucher_state'] = 3;
				//更新数据库
				Model()->table('voucher')->where(array('voucher_id' => $v['voucher_id']))->update(array('voucher_state' => 3));
				//如果卡券包已过期一个月
				if($v['voucher_end_date'] <= (time() -3600*24*30)){
					unset($voucher_list[$k]);
				}
			}
		}
		Tpl::output('voucher_list', $voucher_list);
		Tpl::showpage('member_voucher');
	}
	
	/**
	 * 会员中心，我的圈子
	 */
	public function memberCircleOp(){
		$condition = array(
				'circle_status' => 1
		);
		$field = 'circle_id, circle_desc, circle_name, circle_masterid, circle_mastername, circle_img, circle_mcount, circle_thcount, circle_addtime';
		$model = Model();
		if(empty($_GET['type'])){
			//我创建的圈子
			$condition['circle_masterid'] = $_SESSION['member_id'];
			$circle_list = $model->table('circle')->where($condition)->field($field)->select();
			Tpl::output('no_circle', '您还没有创建的圈子');
		}else{
			$circle_ids = $model->table('circle_member')->where(array('member_id' => $_SESSION['member_id']))->field('circle_id')->select();
			if(empty($circle_ids) || !is_array($circle_ids)){
				$id_str = 0;
			}else{
				$circle_ids = $this->get_array($circle_ids);
				$id_str = implode(',', $circle_ids);
			}
			$condition['circle_id'] = array('in', $id_str);
			$circle_list = $model->table('circle')->where($condition)->field($field)->select();
			Tpl::output('no_circle', '您还没有加入的圈子');
		}
		Tpl::output('circle_list', $circle_list);
		Tpl::showpage('member_circle');
	}
	
	private function get_array($arr){
		if(empty($arr) || !is_array($arr)){
			return $arr;
		}
		$arr_new = array();
		foreach ($arr as $v){
			$arr_new[] = $v['circle_id'];
		}
		return $arr_new;
	}
}
?>


