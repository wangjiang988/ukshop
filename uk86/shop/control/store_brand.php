<?php
/**
 * 品牌管理
 *
 *by Uk86 商城开发
 */
defined('InUk86') or exit('Access Invalid!');

class store_brandControl extends BaseSellerControl {
	public function __construct() {
		parent::__construct();
		Uk86Language::uk86_read('member_store_brand');
	}

	public function indexOp(){
		$this->brand_listOp();
	}

	/**
	 * 品牌列表
	 */
	public function brand_listOp() {
		$model_brand = Model('brand');
		$condition = array();
		$condition['store_id'] = $_SESSION['store_id'];
		if (!empty($_GET['brand_name'])) {
		    $condition['brand_name'] = array('like', '%' .$_GET['brand_name'] . '%');
		}
		//add wangjiang  一个商家只允许添加一个商品品牌

		$brand_list = $model_brand->getBrandList($condition, '*', 10);
		foreach ($brand_list as &$brand) {
			if(!empty($brand['order_id']))
				$brand['order_info'] = Model('pm_order')->getOrderInfo(array('order_id'=>$brand['order_id']));
		}
		if(count($brand_list) > 0){
			Tpl::output('cant_apply',TRUE);
		}else{
			Tpl::output('cant_apply',false);
		}
		//end  wangjiang
		
		Tpl::output('brand_list',$brand_list);
		Tpl::output('show_page',$model_brand->showpage());

		self::profile_menu('brand_list','brand_list');
		Tpl::showpage('store_brand.list');
	}

	/**
	 * 品牌添加页面
	 */
	public function brand_addOp() {
		$lang	= Uk86Language::uk86_getLangContent();
		$model_brand = Model('brand');
		if($_GET['brand_id'] != '') {
			$brand_array = $model_brand->getBrandInfo(array('brand_id' => $_GET['brand_id'], 'store_id' => $_SESSION['store_id']));
			if (empty($brand_array)){
				uk86_showMessage($lang['wrong_argument'],'','html','error');
			}
			Tpl::output('brand_array',$brand_array);
		}

		// 一级商品分类
		$gc_list = Model('goods_class')->getGoodsClassListByParentId(0);
		Tpl::output('gc_list', $gc_list);

		Tpl::showpage('store_brand.add','null_layout');
	}

	/**
	 * 品牌保存
	 */
	public function brand_saveOp() {
		$lang	= Uk86Language::uk86_getLangContent();
		$model_brand = Model('brand');
		if (uk86_chksubmit()) {
			
			//一个商家只能添加一个品牌。wangjiang
			$condition['store_id'] = $_SESSION['store_id'];
			$brandCount = $model_brand->getBrandCount($condition);
			if($brandCount>1){
				showDialog('一个商家只能添加一个品牌，如您旗下已有多个品牌，请删除后操作.','index.php?act=store_brand&op=brand_list','succ',empty($_GET['inajax']) ?'':'CUR_DIALOG.close();');
			}
			/**
			 * 验证
			 */
			$obj_validate = new Uk86Validate();
			$obj_validate->validateparam = array(
                array("input"=>$_POST["brand_name"], "require"=>"true", "message"=>$lang['store_goods_brand_name_null']),
				array("input"=>$_POST["brand_initial"], "require"=>"true", "message"=>'请填写首字母')
			);
			$error = $obj_validate->uk86_validate();
			if ($error != ''){
				uk86_showValidateError($error);
			}

			/**
			 * 上传图片
			 */
			if (!empty($_FILES['brand_pic']['name'])){
				$upload = new Uk86UploadFile();
				$upload->uk86_set('default_dir', ATTACH_BRAND);
				$upload->uk86_set('thumb_width', 150);
				$upload->uk86_set('thumb_height', 50);
				$upload->uk86_set('thumb_ext', '_small');
				$upload->uk86_set('ifremove', true);
				$result = $upload->uk86_upfile('brand_pic');
				if ($result){
					$_POST['brand_pic'] = $upload->thumb_image;
				}else {
					showDialog($upload->error);
				}
			}
			$insert_array = array();
			$insert_array['brand_name']      = trim($_POST['brand_name']);
			$insert_array['brand_initial']   = strtoupper($_POST['brand_initial']);
			$insert_array['class_id']        = $_POST['class_id'];
			$insert_array['brand_class']     = $_POST['brand_class'];
			$insert_array['brand_pic']       = $_POST['brand_pic'];
			$insert_array['brand_apply']     = 0;
			$insert_array['store_id']        = $_SESSION['store_id'];
			
			$result = $model_brand->addBrand($insert_array);
			if ($result){
				//自动生成订单
				$brand['brand_id'] = $result;
				$this->generateNopayPmOrder($brand);
				//修改 wangjiang 2016.1.21跳转到brand_list 不跳支付页面
//				showDialog($lang['store_goods_brand_apply_success'],'index.php?act=store_brand&op=pay&brand_id='.$result,'succ',empty($_GET['inajax']) ?'':'CUR_DIALOG.close();');
				showDialog($lang['nc_common_save_succ'],'index.php?act=store_brand&op=brand_list','succ',empty($_GET['inajax']) ?'':'CUR_DIALOG.close();');
			}else {
				showDialog($lang['nc_common_save_fail']);
			}
		}
	}

	/**
	 * 品牌修改
	 */
	public function brand_editOp() {
		$lang	= Uk86Language::uk86_getLangContent();
		$model_brand = Model('brand');
		if ($_POST['form_submit'] == 'ok' and intval($_POST['brand_id']) != 0) {
			/**
			 * 验证
			 */
			$obj_validate = new Uk86Validate();
			$obj_validate->validateparam = array(
                array("input"=>$_POST["brand_name"], "require"=>"true", "message"=>$lang['store_goods_brand_name_null']),
				array("input"=>$_POST["brand_initial"], "require"=>"true", "message"=>'请填写首字母')
			);
			$error = $obj_validate->uk86_validate();
			if ($error != ''){
				uk86_showValidateError($error);
			}else {
				/**
				 * 上传图片
				 */
				if (!empty($_FILES['brand_pic']['name'])){
					$upload = new Uk86UploadFile();
					$upload->uk86_set('default_dir',ATTACH_BRAND);
					$upload->uk86_set('thumb_width',	150);
					$upload->uk86_set('thumb_height',50);
					$upload->uk86_set('thumb_ext',	'_small');
					$upload->uk86_set('ifremove',	true);
					$result = $upload->uk86_upfile('brand_pic');

					if ($result){
						$_POST['brand_pic'] = $upload->thumb_image;
					}else {
						showDialog($upload->error);
					}
				}
                $where = array();
                $where['brand_id']       = intval($_POST['brand_id']);
                $update_array = array();
                $update_array['brand_initial']  = strtoupper($_POST['brand_initial']);
                $update_array['brand_name']     = trim($_POST['brand_name']);
                $update_array['class_id']       = $_POST['class_id'];
                $update_array['brand_class']    = $_POST['brand_class'];
				//add wangjiang修改审核状态为待审核
				$update_array['brand_apply'] = 0;
				//end wangjiang
                if (!empty($_POST['brand_pic'])){
                    $update_array['brand_pic'] = $_POST['brand_pic'];
                }
                //查出原图片路径，后面会删除图片
                $brand_info = $model_brand->getBrandInfo($where);
				$result = $model_brand->editBrand($where, $update_array);
				if ($result){
					//删除老图片
					if (!empty($brand_info['brand_pic']) && $_POST['brand_pic']){
						@unlink(BASE_UPLOAD_PATH.DS.ATTACH_BRAND.DS.$brand_info['brand_pic']);
					}
					showDialog($lang['nc_common_save_succ'],'index.php?act=store_brand&op=brand_list','succ',empty($_GET['inajax']) ?'':'CUR_DIALOG.close();');
				}else {
					showDialog($lang['nc_common_save_fail']);
				}
			}
		} else {
			showDialog($lang['nc_common_save_fail']);
		}
	}

	/**
	 * 品牌删除
	 */
	public function drop_brandOp() {
		$model_brand	= Model('brand');
		$brand_id		= intval($_GET['brand_id']);
		if ($brand_id > 0){
			$model_brand->delBrand(array('brand_id'=>$brand_id, 'brand_apply'=>0, 'store_id' => $_SESSION['store_id']));
			showDialog(Uk86Language::uk86_get('nc_common_del_succ'),'index.php?act=store_brand&op=brand_list','succ');
		}else {
			showDialog(Uk86Language::uk86_get('nc_common_del_fail'));
		}
	}
	/**
	 * 生成或者读取订单，进入到付款页面
	 * @author wangjiang
	 */
	public function payOp(){
		$brand_id = intval($_GET['brand_id']);
		$model_brand = Model('brand');
		$brand = $model_brand->getBrandInfo(array('brand_id'=>$brand_id));
		if(empty($brand)){
			$this->showDialog('没有该品牌');
		}
		$model_pm_order = Model('pm_order');
		//如果没有定单，生成订单
		if(empty($brand['order_id'])){
				$order_info = $this->generateNopayPmOrder($brand);
		}else{
			//取订单信息
	        $condition = array();
	        $condition['order_id'] = $brand['order_id'];
	        $order_info = $model_pm_order->getOrderInfo($condition,'*',true);
			if(empty($order_info)){
				//没有这个订单 生成订单
				$order_info = $this->generateNopayPmOrder($brand);
			}
			elseif(!in_array($order_info['order_state'],array(ORDER_STATE_NEW,ORDER_STATE_PAY))){
				$this->wap_showDialog('未找到需要支付的订单','error','index.php?act=wap_member_fcode&op=rec_code');
			}
//	        if (empty($order_info) || !in_array($order_info['order_state'],array(ORDER_STATE_NEW,ORDER_STATE_PAY))) {
//	            $this->wap_showDialog('未找到需要支付的订单','error','index.php?act=wap_member_fcode&op=rec_code');
//	        }
		}
		
		$_SESSION['out_act_'.$order_info['order_id']] = $_GET['act']; 

        //重新计算在线支付金额
        $pay_amount_online = 0;
        //订单总支付金额
        $pay_amount = 0;

        $payed_amount = floatval($order_info['rcb_amount']) + floatval($order_info['pd_amount']);

        //计算所需要支付金额
        $diff_pay_amount = uk86_ncPriceFormat(floatval($order_info['order_amount']) - $payed_amount);

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
		
		Tpl::showpage('store_brand.pay');
	}
	
	/**
	 * 品牌申请自动生成定单
	 * @author wangjiang 
	 */
	private  function generateNopayPmOrder($brand){
		$logic_buy = uk86_logic('buy_promotion');
		$post['quantity'] = 1; //购买数量
		$post['buyer_msg'] = '系统生成订单';
		$post['price'] =  C('default_brand_price')* $post['quantity'];
		$post['unit_price'] =  C('default_brand_price');
		//第二个参数设置为7 表示品牌申请订单
		$order_info = $logic_buy->createPromotionVrOrder($post, '7',$_SESSION['member_id'],'info');
		//没有生成成功 返回NULL
		if(empty($order_info)){
			return NULL;
		}
		//生成订单后，与品牌绑定
		$model_brand = Model('brand');
		$update['order_id'] = $order_info['order_id'];
		$update['order_sn'] = $order_info['order_sn'];
		$r = $model_brand->editBrand(array('brand_id'=>$brand['brand_id']),$update);
		if($r){
			//生成订单后  要将本次act存入session，支付后可跳转回来。
			return $order_info;
		}else{
			//没有修改成功，删除刚才生成的订单
			Model('pm_order')->delOrder($order_info['order_id']);
			return NULL;
		}
        
	}
	
	/**
	 * 付款后操作 统一调用方法
	 * @author wangjiang 
	 */
	public function quota_add_saveOp(){
		$order_sn = $_GET['order_sn'];//订单编号
		$order_amount= $_GET['order_amount']; //支付金额
		$payment_code = $_GET['payment_code'];
		if (!preg_match('/^\d{18}$/',$order_sn)){
            uk86_showMessage('该订单不存在','index.php?act=store_groupbuy&op=index','html','error');
			exit;
        }
    	//得到订单基本信息
		$order = Model('pm_order')->getOrderInfo(array('order_sn'=>$order_sn));
		//修改订单状态
		$this->_change_pm_order_afterpay($payment_code, $order_sn, $order_amount);
		//修改品牌为已支付状态
		$this->_change_brand_pay_status($order['order_id'],true);
        $quantity = 1 ; //餐套数量
        $model_brand = Model('brand');

        //获取当前价格
        $current_price = intval(C('default_brand_price'));


        //记录店铺费用
        $this->recordStoreCost($current_price * $quantity, '购买品牌');

        $this->recordSellerLog('购买'.$quantity.'份品牌，单价'.$current_price.L('nc_yuan'));

       showDialog('品牌购买成功！', uk86_urlShop('store_brand', 'brand_list'), 'succ');
	}	
	/**
	 * 修改品牌支付状态
	 * @author wangjiang
	 */
	private function _change_brand_pay_status($order_id,$status){
		if($status){
			$r = Model('brand')->editBrand(array('order_id'=>$order_id),array('is_pay'=>1));
		}else{
			$r = Model('brand')->editBrand(array('order_id'=>$order_id),array('is_pay'=>0));
		}
		return $r;
	}

	/**
	 * 用户中心右边，小导航
	 *
	 * @param string	$menu_type	导航类型
	 * @param string 	$menu_key	当前导航的menu_key
	 * @param array 	$array		附加菜单
	 * @return
	 */
	private function profile_menu($menu_type,$menu_key='',$array=array()) {
		Uk86Language::uk86_read('member_layout');
		$lang	= Uk86Language::uk86_getLangContent();
		$menu_array		= array();
		switch ($menu_type) {
			case 'brand_list':
				$menu_array = array(
				    1=>array('menu_key'=>'brand_list', 'menu_name'=>$lang['nc_member_path_brand_list'], 'menu_url'=>'index.php?act=store_brand&op=brand_list')
				);
				break;
		}
		if(!empty($array)) {
			$menu_array[] = $array;
		}
		Tpl::output('member_menu',$menu_array);
		Tpl::output('menu_key',$menu_key);
	}
}
