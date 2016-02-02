<?php
/**
 * 手机短信类
 *
 *
 *
 * @package    library* Uk86商城开发
 */
defined('InUk86') or exit('Access Invalid!');

class Uk86Sms {
    /**
     * 发送手机短信
     * @param unknown $mobile 手机号
     * @param unknown $content 短信内容
     */
    public function uk86_send($mobile,$content) {
    header("Content-type: text/html; charset=utf-8");
	$plugin = str_replace('\\', '', str_replace('/', '', str_replace('.', '', C('sms_plugin'))));
        if (!empty($plugin)) {
//        		return 'http://210.5.158.31/hy?uid=50067&auth=7272fe16d4e71a6cb04bac5dd9fbbff6&mobile='. $mobile .'&msg='. $content .'&expid=0';
//              define('PLUGIN_ROOT', BASE_DATA_PATH . DS .'api/smsapi');
//              require_once(PLUGIN_ROOT . DS . $plugin . DS . 'Send.php');
//              return send_sms($content, $mobile);
        	   
	       	$url = C('params_url');
			$params = "uid=". C('params_uid') ."&auth=". C('params_auth') ."&mobile=". $mobile ."&msg=". $content ."&expid=0";
			$this_header = array("content-type: application/x-www-form-urlencoded;charset=UTF-8");
			//初始化
			$ch = curl_init();
			curl_setopt($ch,CURLOPT_URL,$url);
			curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
			curl_setopt($ch,CURLOPT_POST,1);
			curl_setopt($ch,CURLOPT_POSTFIELDS,$params);
			curl_setopt($ch,CURLOPT_HTTPHEADER,$this_header);
	 
			$output = curl_exec($ch);
			curl_close($ch);
			return $output;
        }
        return $this->_uk86_sendEmay($mobile,$content);
    }

    /**
     * 亿美短信发送接口
     * @param unknown $mobile 手机号
     * @param unknown $content 短信内容
     */
    private function _uk86_sendEmay($mobile,$content) {
        set_time_limit(0);
        define('SCRIPT_ROOT',  BASE_DATA_PATH.'/api/emay/');
        require_once SCRIPT_ROOT.'include/Client.php';
        /**
         * 网关地址
         */
        $gwUrl = C('sms_url');
        /**
         * 序列号,请通过亿美销售人员获取
         */
        $serialNumber = C('sms_serial_number');
        /**
         * 密码,请通过亿美销售人员获取
         */
        $password = C('sms_password');
        /**
         * 登录后所持有的SESSION KEY，即可通过login方法时创建
         */
        $sessionKey = C('sms_sessionKey');
        /**
         * 连接超时时间，单位为秒
         */
        $connectTimeOut = 2;
        /**
         * 远程信息读取超时时间，单位为秒
         */
        $readTimeOut = 10;
        /**
         $proxyhost		可选，代理服务器地址，默认为 false ,则不使用代理服务器
         $proxyport		可选，代理服务器端口，默认为 false
         $proxyusername	可选，代理服务器用户名，默认为 false
         $proxypassword	可选，代理服务器密码，默认为 false
         */
        $proxyhost = false;
        $proxyport = false;
        $proxyusername = false;
        $proxypassword = false;

        $client = new Client($gwUrl,$serialNumber,$password,$sessionKey,$proxyhost,$proxyport,$proxyusername,$proxypassword,$connectTimeOut,$readTimeOut);
        /**
         * 发送向服务端的编码，如果本页面的编码为GBK，请使用GBK
        */
        $client->setOutgoingEncoding("UTF-8");
        $statusCode = $client->login();
        if ($statusCode!=null && $statusCode=="0") {
        } else {
            //登录失败处理
        //    echo "登录失败,返回:".$statusCode;exit;
        }
        $statusCode = $client->sendSMS(array($mobile),$content);
        if ($statusCode!=null && $statusCode=="0") {
            return true;
        } else {
            return false;
             print_R($statusCode);
             echo "处理状态码:".$statusCode;
        }
    }
}
