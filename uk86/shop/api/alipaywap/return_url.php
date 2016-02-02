<?php
/* * 
 * 功能：支付宝页面跳转同步通知页面
 * 版本：3.3
 * 日期：2012-07-23
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。

 *************************页面功能说明*************************
 * 该页面可在本机电脑测试
 * 可放入HTML等美化页面的代码、商户业务逻辑程序代码
 * 该页面可以使用PHP开发工具调试，也可以使用写文本函数logResult，该函数已被默认关闭，见alipay_notify_class.php中的函数verifyReturn
 */
require_once("lib/alipay_notify.class.php");
$path = getcwd().'/../../../';
require_once($path.'global.php');
require_once($path.'data/config/config.ini.php');
$dbcharset = $config['db']['1']['dbcharset'];
$dbserver = $config['db']['1']['dbhost'];
$dbserver_port = $config['db']['1']['dbport'];
$dbname = $config['db']['1']['dbname'];
$db_pre = $config['tablepre'];
$dbuser = $config['db']['1']['dbuser'];
$dbpasswd = $config['db']['1']['dbpwd'];
$tablepre = $config['tablepre'];
$shop_site_url = $config['shop_site_url'];

$redirect = $shop_site_url.'/index.php?act=wap_member_order';

$conn = new mysqli($dbserver,  $dbuser, $dbpasswd,  $dbname, $dbserver_port);
if (mysqli_connect_errno()) {
	file_put_contents($path.'data/cache/return', print_r(mysqli_connect_errno(), 1).PHP_EOL, FILE_APPEND);
    exit();
}

$sql = "SELECT * FROM `{$tablepre}mb_payment` WHERE `payment_code` = 'alipay'";
$rs = $conn->query($sql);
$row = $rs->fetch_assoc();
if($row){
	$rt = unserialize($row['payment_config']);
	$alipay_config = array(
		'partner' => $rt['alipay_account'],
		'seller_id' => $rt['alipay_account'],
		'private_key_path' => getcwd().'/key/rsa_private_key.pem',
		'ali_public_key_path' => getcwd().'/key/alipay_public_key.pem',
		'sign_type' => strtoupper('RSA'),
		'input_charset' => strtolower('utf-8'),
		'cacert' => getcwd().'/cacert.pem',
		'transport' => 'http'
	);
	//计算得出通知验证结果
	$alipayNotify = new AlipayNotify($alipay_config);
	$verify_result = $alipayNotify->verifyReturn();
	if($verify_result) {//验证成功
		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		$out_trade_no = $_GET['out_trade_no'];
		//支付宝交易号		$trade_no = $_GET['trade_no'];
		//交易状态
		$trade_status = $_GET['trade_status'];
		
		$payment_time = $_POST['notify_time'] ? strtotime( $_POST['notify_time']) : '';
	    if($trade_status== 'TRADE_FINISHED' || $trade_status == 'TRADE_SUCCESS') {
	    	$order_state = ORDER_STATE_PAY;
	    	$sql = "SELECT * FROM `{$tablepre}order` WHERE `order_state` = '$order_state'  AND `order_sn` = '$out_trade_no'";
	    	$rs = $conn->query($sql);
	    	if (!$rs->num_rows) {
				$sql = "UPDATE `{$tablepre}order` SET `payment_time` = '$payment_time', `order_state` = '$order_state'  WHERE `order_sn` = '$out_trade_no'";
				$conn->query($sql);
	    	}
	    	header('Location:'.$redirect);
	    }else {
	    	header('Location:'.$redirect);
	    }
		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	}
	else {
		header('Location:'.$redirect);
	}
}