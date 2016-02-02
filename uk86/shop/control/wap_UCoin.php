<?php
/**
 * U币中心
 * @author ZHUXUESONG
 *
 */
defined('InUk86') or exit('Access Invalid!');

class wap_UCoinControl extends BaseWapControl{
	public function __construct(){
		parent::__construct();
		//验证是否登录
		if(!$_SESSION['is_login']){
			header('Location:index.php?act=wap_login&op=login');
		}
	}
	
	/**
	 * U币中心首页
	 */
	public function indexOp(){
		if($_GET['type'] == 1 || empty($_GET['type'])){
			$this->pointvoucherOp();
		}else{
			$this->pointlipingOp();
		}
	}
	
	/**
	 * 所有卡卷包
	 */
	public function pointvoucherOp(){
		$model = Model('voucher_template');
		//查询条件
		$condition = array();
		$condition['voucher_t_start_date'] = array('lt', time());
		$condition['voucher_t_end_date'] = array('gt', time());
		$condition['voucher_t_state'] = 1;
		$condition['voucher_t_total'] = array('gt', 'voucher_t_giveout');
		//排序
		if($_GET['order_type'] == 1 || empty($_GET['order_type'])){
			$order = 'voucher_t_recommend desc, voucher_t_start_date desc';
		}elseif($_GET['order_type'] == 2){
			$order = 'voucher_t_giveout desc';
		}else{
			if($_GET['order'] == 'asc'){
				$order = 'voucher_t_points asc';
			}else{
				$order = 'voucher_t_points desc';
			}
		}
		$field = 'voucher_t_id, voucher_t_end_date, voucher_t_price, voucher_t_points, voucher_t_limit, voucher_t_title, voucher_t_customimg';
		$voucher_list = $model->where($condition)->field($field)->order($order)->select();
		Tpl::output('list', $voucher_list);
		Tpl::showpage('ucoin.index');
	}
	
	/**
	 * 异步加载卡券包信息
	 */
	public function getVoucherByIdOp(){
		$field = 'voucher_t_id, voucher_t_end_date, voucher_t_price, voucher_t_limit, voucher_t_points, voucher_t_customimg, voucher_t_storename, voucher_t_eachlimit';
		$voucher = Model()->table('voucher_template')->where(array('voucher_t_id' => intval($_GET['voucher_id'])))->field($field)->find();
		$voucher['end_time'] = date('Y-m-d');
		$voucher['voucher_t_customimg'] = UPLOAD_SITE_URL.DS.'shop/voucher/1/'.$voucher['voucher_t_customimg'];
		if(intval($voucher['voucher_t_eachlimit'] <= 0)){
			$voucher['eachlimit'] = '领取不限量';
		}else{
			$voucher['eachlimit'] = '限领'.$voucher['voucher_t_eachlimit'].'张';
		}
		exit(json_encode($voucher));
	}
	
	/**
	 * 所有礼品
	 */
	public function pointlipingOp(){
	//	Tpl::showpage('ucoin.lipin');
	}
	
	/**
	 * U币兑换卡券包
	 */
	public function getVoucherForMemberOp(){
		$voucher_id = intval($_GET['voucher_id']);
		$model_voucher = Model('voucher');
		//验证会员是否能兑换
		$data = $model_voucher->getCanChangeTemplateInfo($voucher_id, intval($_SESSION['member_id']), intval($_SESSION['store_id']));
		if ($data['state'] == false){
			exit(json_encode($data));
		}
		//添加卡券包信息
		$data = $model_voucher->exchangeVoucher($data['info'],$_SESSION['member_id'],$_SESSION['member_name']);
		if ($data['state'] == true){
			exit(json_encode($data));
		} else {
			exit(json_encode($data));
		}
	}
}
?>