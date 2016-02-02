<?php
define('BASE_PATH', str_replace('\\', '/', dirname(__FILE__)));
require_once(BASE_PATH.'/global.php');
require_once(BASE_DATA_PATH.DS.'config/config.ini.php');
$dbcharset = $config['db']['1']['dbcharset'];
$dbserver = $config['db']['1']['dbhost'];
$dbserver_port = $config['db']['1']['dbport'];
$dbname = $config['db']['1']['dbname'];
$db_pre = $config['tablepre'];
$dbuser = $config['db']['1']['dbuser'];
$dbpasswd = $config['db']['1']['dbpwd'];
$tablepre = $config['tablepre'];

$conn = new mysqli($dbserver,  $dbuser, $dbpasswd,  $dbname, $dbserver_port);
if (mysqli_connect_errno()) {
	file_put_contents(BASE_PATH.'/data/cache/notify', print_r(mysqli_connect_errno(), 1).PHP_EOL, FILE_APPEND);
    exit();
}

//存储微信的回调
$xmls= $GLOBALS['HTTP_RAW_POST_DATA'];	
if(empty($xmls)) {
	$xmls = file_get_contents("php://input"); 
}
file_put_contents(BASE_PATH.'/data/cache/notify', print_r($xmls, 1).PHP_EOL, FILE_APPEND);
if(!empty($xmls)){
	$postObj = simplexml_load_string($xmls, 'SimpleXMLElement', LIBXML_NOCDATA);
	$order_state = ORDER_STATE_PAY;
	$result_code = $postObj->result_code;
	$openid = $postObj->openid;
	$out_trade_no = $postObj->out_trade_no;
	$payment_time = $postObj->time_end;
	if($result_code == "SUCCESS") {	
		$sql = "UPDATE `{$tablepre}order` SET `payment_time` = '$payment_time', `order_state` = '$order_state' WHERE `order_sn` = '$out_trade_no'";
		$conn->query($sql);
	}
}
mysqli_close($conn);