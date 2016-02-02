<?php
// defined('InUk86') or exit('Access Invalid!');

$config = array();
$config['base_site_url'] 		= 'http://'.$_SERVER['SERVER_NAME'].'';
$config['shop_site_url'] 		= $config['base_site_url'].'/shop';
$config['cms_site_url'] 		= $config['base_site_url'].'/cms';
$config['microshop_site_url'] 	= $config['base_site_url'].'/microshop';
$config['circle_site_url'] 		= $config['base_site_url'].'/circle';
$config['admin_site_url'] 		= $config['base_site_url'].'/admin';
$config['mobile_site_url'] 		= $config['base_site_url'].'/mobile';
$config['wap_site_url'] 		= $config['base_site_url'].'/wap';
$config['chat_site_url'] 		= $config['base_site_url'].'/chat';
//$config['node_site_url'] 		= $config['base_site_url'].'http://127.0.0.1:8090';
$config['upload_site_url']		= $config['base_site_url'].'/data/upload';
$config['resource_site_url']	= $config['base_site_url'].'/data/resource';
$config['version'] 		= '201505251201';
$config['setup_date'] 	= '2015-08-24 08:42:05';
$config['gip'] 			= 0;
$config['dbdriver'] 	= 'mysqli';
$config['tablepre']		= 'ukshop_';
$config['db']['1']['dbhost']       = '127.0.0.1';
$config['db']['1']['dbport']       = '3306';
$config['db']['1']['dbuser']       = 'root';
$config['db']['1']['dbpwd']        = '';
$config['db']['1']['dbname']       = 'uk86';
$config['db']['1']['dbcharset']    = 'UTF-8';
$config['db']['slave']             = $config['db']['master'];
$config['session_expire'] 	= 3600;
$config['lang_type'] 		= 'zh_cn';
$config['cookie_pre'] 		= '8FD0_';
$config['thumb']['cut_type'] = 'gd';
$config['thumb']['impath'] = '';
$config['cache']['type'] 			= 'file';
//$config['redis']['prefix']      	= 'nc_';
//$config['redis']['master']['port']     	= 6379;
//$config['redis']['master']['host']     	= '127.0.0.1';
//$config['redis']['master']['pconnect'] 	= 0;
//$config['redis']['slave']      	    = array();
//$config['fullindexer']['open']      = false;
//$config['fullindexer']['appname']   = 'ukshop';
$config['debug'] = true;
$config['default_store_id'] = '1';
$config['url_model'] = false;
$config['subdomain_suffix'] = '';
//$config['session_type'] = 'redis';
//$config['session_save_path'] = 'tcp://127.0.0.1:6379';
$config['node_chat'] = true;
//流量记录表数量，为1~10之间的数字，默认为3，数字设置完成后请不要轻易修改，否则可能造成流量统计功能数据错误
$config['flowstat_tablenum'] = 3;
//使用亿美短信发送接口需配置下面四项
$config['sms']['gwUrl'] = 'http://sdkhttp.eucp.b2m.cn/sdk/SDKService';
$config['sms']['serialNumber'] = '';
$config['sms']['password'] = '';
$config['sms']['sessionKey'] = '';
$config['sms']['plugin'] = true;  //使用亿美短信发送时为false
//普通短信发送接口配置项
$config['params']['url'] = 'http://210.5.158.31/hy/';
$config['params']['uid'] = '50067';
$config['params']['auth'] = '7272fe16d4e71a6cb04bac5dd9fbbff6';
$config['queue']['open'] = false;
$config['queue']['host'] = '127.0.0.1';
$config['queue']['port'] = 6379;
$config['cache_open'] = false;
$config['delivery_site_url']    = $config['base_site_url'].'/delivery';
return $config;
