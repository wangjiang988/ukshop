<?php
/* *
 * 功能：支付宝服务器异步通知页面
 * 版本：3.3
 * 日期：2012-07-23
 * 说明：
 * 以下代码只是为了方便商户测试而提供的样例代码，商户可以根据自己网站的需要，按照技术文档编写,并非一定要使用该代码。
 * 该代码仅供学习和研究支付宝接口使用，只是提供一个参考。

 *************************页面功能说明*************************
 * 创建该页面文件时，请留心该页面文件中无任何HTML代码及空格。
 * 该页面不能在本机电脑测试，请到服务器上做测试。请确保外部可以访问该页面。
 * 该页面调试工具请使用写文本函数logResult，该函数已被默认关闭，见alipay_notify_class.php中的函数verifyNotify
 * 如果没有收到该页面返回的 success 信息，支付宝会在24小时内按一定的时间策略重发通知
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

$conn = new mysqli($dbserver,  $dbuser, $dbpasswd,  $dbname, $dbserver_port);
if (mysqli_connect_errno()) {
	file_put_contents($path.'data/cache/notify', print_r(mysqli_connect_errno(), 1).PHP_EOL, FILE_APPEND);
    exit();
}

$sql = "SELECT * FROM `{$tablepre}mb_payment` WHERE `payment_code` = 'alipay'";
$rs = $conn->query($sql);
$row = $rs->fetch_assoc();
if($row){
	$redirect = $shop_site_url.'/index.php?act=wap_member_order';
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
	$verify_result = $alipayNotify->verifyNotify();
	if($verify_result) {//验证成功
		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//商户订单号
		$out_trade_no = $_POST['out_trade_no'];
		//支付宝交易号
		$trade_no = $_POST['trade_no'];
		//交易状态
		$trade_status = $_POST['trade_status'];
		$payment_time = $_POST['notify_time'] ? strtotime( $_POST['notify_time']) : '';
	    if($_POST['trade_status'] == 'TRADE_FINISHED') {
			//判断该笔订单是否在商户网站中已经做过处理
				//如果没有做过处理，根据订单号（out_trade_no）在商户网站的订单系统中查到该笔订单的详细，并执行商户的业务程序
				//请务必判断请求时的total_fee、seller_id与通知时获取的total_fee、seller_id为一致的
				//如果有做过处理，不执行商户的业务程序
			//注意：
			//退款日期超过可退款期限后（如三个月可退款），支付宝系统发送该交易状态通知
	        //调试用，写文本函数记录程序运行情况是否正常
	        //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
	    }
	    else if ($_POST['trade_status'] == 'TRADE_SUCCESS') {
	    	$order_state = ORDER_STATE_PAY;
	    	$sql = "SELECT * FROM `{$tablepre}order` WHERE `order_state` = '$order_state'  AND `order_sn` = '$out_trade_no'";
	    	$rs = $conn->query($sql);
	    	if (!$rs->num_rows) {
				$sql = "UPDATE `{$tablepre}order` SET `payment_time` = '$payment_time', `order_state` = '$order_state'  WHERE `order_sn` = '$out_trade_no'";
				$conn->query($sql);
	    	}
	    }
		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
	}
	else {
	    //验证失败
	    //调试用，写文本函数记录程序运行情况是否正常
	    //logResult("这里写入想要调试的代码变量值，或其他运行的结果记录");
	    file_put_contents($path.'data/cache/notify', print_r($_POST, 1).PHP_EOL, FILE_APPEND);
	}
}
?>