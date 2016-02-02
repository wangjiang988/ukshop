<?php
/**
 * 用户中心收货地址管理
 * @author ZHUXUESONG
 *
 */
defined('InUk86') or exit('Access Invalid!');

class wap_member_addressControl extends BaseWapControl{
	public function __construct(){
		parent::__construct();
		if(!$_SESSION['is_login']){
			header('Location:index.php?act=wap_login&op=login');
		}
	}
	
	/**
	 * 用户地址列表
	 */
	public function address_listOp(){
		$model_addr = Model('address');
		//如果传入ID，先删除再查询
		if (!empty($_GET['id']) && intval($_GET['id']) > 0) {
			$model_addr->delAddress(array('address_id'=>intval($_GET['id']),'member_id'=>$_SESSION['member_id']));
		}
		$condition = array();
		$condition['member_id'] = $_SESSION['member_id'];
		if (!C('delivery_isuse')) {
			$condition['dlyp_id'] = 0;
			$order = 'dlyp_id asc,address_id desc';
		}
		$list = $model_addr->getAddressList($condition,$order);
		Tpl::output('address_list',$list);
		Tpl::showpage('member_address.list');
	}
	
	/**
	 * 编辑收货地址
	 */
	public function edit_addrOp(){
		$model_addr = Model('address');
		if (!empty($_POST) && is_array($_POST)){
			//验证表单信息
			$obj_validate = new Uk86Validate();
			$obj_validate->validateparam = array(
					array("input"=>$_POST["true_name"],"require"=>"true","message"=>Uk86Language::uk86_get('cart_step1_input_receiver')),
					array("input"=>$_POST["area_id"],"require"=>"true","validator"=>"Number","message"=>Uk86Language::uk86_get('cart_step1_choose_area')),
					array("input"=>$_POST["address"],"require"=>"true","message"=>Uk86Language::uk86_get('cart_step1_input_address'))
			);
			$error = $obj_validate->uk86_validate();
			if ($error != ''){
				$error = strtoupper(CHARSET) == 'GBK' ? Uk86Language::uk86_getUTF8($error) : $error;
				exit(json_encode(array('state'=>false,'msg'=>$error)));
			}
			$data = array();
			$data['member_id'] = $_SESSION['member_id'];
			$data['true_name'] = $_POST['true_name'];
			$data['area_id'] = intval($_POST['area_id']);
			$data['city_id'] = intval($_POST['city_id']);
			$data['area_info'] = $_POST['area_info'];
			$data['address'] = $_POST['address'];
			$data['tel_phone'] = $_POST['tel_phone'];
			$data['mob_phone'] = $_POST['mob_phone'];
			//转码
			$data = strtoupper(CHARSET) == 'GBK' ? Uk86Language::uk86_getGBK($data) : $data;
			$result = $model_addr->where(array('address_id' => $_POST['address_id']))->update($data);
			if ($result){
				exit(json_encode(array('state'=>true,'addr_id'=>$_POST['address_id'])));
			}else {
				exit(json_encode(array('state'=>false,'msg'=>'编辑地址失败')));
			}
		}else{
			$address_id = intval($_GET['id']);
			$address_info = $model_addr->field('*')->where(array('address_id' => $address_id))->find();
			Tpl::output('address_info', $address_info);
			//区别编辑和新增
			Tpl::output('isedit', true);
			Tpl::showpage('member_address.add');
		}
	}
	
	/**
	 * 添加新的收货地址
	 *
	 */
	public function add_addrOp(){
		$model_addr = Model('address');
		if (!empty($_POST) && is_array($_POST)){
			//验证表单信息
			$obj_validate = new Uk86Validate();
			$obj_validate->validateparam = array(
					array("input"=>$_POST["true_name"],"require"=>"true","message"=>Uk86Language::uk86_get('cart_step1_input_receiver')),
					array("input"=>$_POST["area_id"],"require"=>"true","validator"=>"Number","message"=>Uk86Language::uk86_get('cart_step1_choose_area')),
					array("input"=>$_POST["address"],"require"=>"true","message"=>Uk86Language::uk86_get('cart_step1_input_address'))
			);
			$error = $obj_validate->uk86_validate();
			if ($error != ''){
				$error = strtoupper(CHARSET) == 'GBK' ? Uk86Language::uk86_getUTF8($error) : $error;
				exit(json_encode(array('state'=>false,'msg'=>$error)));
			}
			$data = array();
			$data['member_id'] = $_SESSION['member_id'];
			$data['true_name'] = $_POST['true_name'];
			$data['area_id'] = intval($_POST['area_id']);
			$data['city_id'] = intval($_POST['city_id']);
			$data['area_info'] = $_POST['area_info'];
			$data['address'] = $_POST['address'];
			$data['tel_phone'] = $_POST['tel_phone'];
			$data['mob_phone'] = $_POST['mob_phone'];
			//转码
			$data = strtoupper(CHARSET) == 'GBK' ? Uk86Language::uk86_getGBK($data) : $data;
			$insert_id = $model_addr->addAddress($data);
			if ($insert_id){
				exit(json_encode(array('state'=>true,'addr_id'=>$insert_id)));
			}else {
				exit(json_encode(array('state'=>false,'msg'=>Uk86Language::uk86_get('cart_step1_addaddress_fail','UTF-8'))));
			}
		} else {
			Tpl::showpage('member_address.add');
		}
	}
	
	/**
	 * 设为默认收货地址
	 */
	public function set_defaultOp(){
		$addr_id = intval($_GET['addr_id']);
		if(empty($addr_id)){
			exit('0');
		}
		$model_address = Model('address');
		$condition = array();
		$condition['address_id'] = $addr_id;
		$condition['member_id'] = intval($_SESSION['member_id']);
		$condition['is_default'] = 1;
		//检查该收货地址是否为默认收货地址
		$result1 = $model_address->where($condition)->find();
		if(!empty($result1)){
			exit('10');
		}
		$update = array();
		//修改其他的收货地址为非默认地址
		$update['is_default'] = 0;
		unset($condition['is_default']);
		$result2 = $model_address->where(array('member_id' => intval($_SESSION['member_id']), 'is_default' => 1))->update($update);
		$update['is_default'] = 1;
		$result = $model_address->where($condition)->update($update);
		if($result){
			exit('11');
		}
		exit('0');
	}
}
?>