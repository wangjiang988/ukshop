<?php
class Wechat {
	
	private  $scope = 'snsapi_base';
	private  $appid = '';
	private  $appsecret = '';
	private  $code_url = 'https://open.weixin.qq.com/connect/oauth2/authorize?appid=%s&redirect_uri=%s&response_type=code&scope=%s&state=uk86#wechat_redirect';
	private  $token_url = 'https://api.weixin.qq.com/sns/oauth2/access_token?appid=%s&secret=%s&code=%s&grant_type=authorization_code';
	private  $user_url = 'https://api.weixin.qq.com/sns/userinfo?access_token=%s&openid=%s&lang=zh_CN';
	
	function __construct($appid, $appsecret, $scope='snsapi_base') {
		$this->appid = $appid;
		$this->appsecret = $appsecret;
		$this->scope = $scope;
	}
	
	function get_code_url($redirect_uri = '') {
		return sprintf($this->code_url, $this->appid, urlencode($redirect_uri), $this->scope);
	}
	
	
	function get_oauth_token($code) {
		$token_url  = sprintf($this->token_url, $this->appid, $this->appsecret, $code);
		return $this->http_request($token_url);
	}
	
	function get_user_info($openid, $access_token) {
		$user_url = sprintf($this->user_url, $access_token, $openid);
		return $this->http_request($user_url);
	}
	
	
	function http_request($url, $param = array()) {
    	$curl = curl_init();
		if(stripos($url,"https://")!==FALSE){
			curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, FALSE);
			curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, FALSE);
			curl_setopt($curl, CURLOPT_SSLVERSION, 1);
		}
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1 );
		if ($param) {
			curl_setopt($curl, CURLOPT_POST, true);
			curl_setopt($curl, CURLOPT_POSTFIELDS, $param);
		}
		$result = curl_exec($curl);
		curl_close($curl);
		return $result;
    }
	
}