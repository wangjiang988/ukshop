<?php
/**
 * desc : get wechat user info
 * 
 * @author jason
 * @since 2015-12-29
 */
defined('InUk86') or exit('Access Invalid!');
require_once BASE_DATA_PATH.'/../'.DIR_SHOP. '/api/weixin/wechat.php';
class wxuserControl  extends BaseWapControl {
	
	function indexOp() {
		$model_member = Model('member');
		$wxinfo = $model_member->get_wx_config();
		if (empty($wxinfo)) {
			showDialog('您还没有配置微信基本参数appid，appsecret！');
		}
		$wechat = new Wechat($wxinfo['appid'], $wxinfo['appsecret'], 'snsapi_base');
		if (!isset($_GET['code']))  {
			$redirect_uri = SHOP_SITE_URL.'/index.php?act=wxuser';
			$url = $wechat->get_code_url($redirect_uri);
			header("Location: $url");  	
		}else {
			$code = $_GET['code'];
		}
		if (empty($code)) {
			showDialog('授权获取code失败');
		}
		$oauth  =  json_decode($wechat->get_oauth_token($code));
		$return_url = SHOP_SITE_URL . '/index.php?act=wap_index';
		if (isset($oauth->access_token) && isset($oauth->openid)) {
			$user  = json_decode($wechat->get_user_info($oauth->openid, $oauth->access_token));
			try {
				if ( !$user->openid) {
					throw new Exception('未获取到微信用户的基本信息');
				}
				$openid = $user->openid;
				$wxusers = $model_member->get_wx_user($openid);
				if ($wxusers && $wxusers[0]) {
					$model_member->createSession($wxusers[0]);
					header("Location:$return_url");
					exit;
				}
				$model_member->beginTransaction();
				$params['openid'] = $openid;
				$params['nickname'] = $user->nickname;
				$params['sex'] = $user->sex;
				$params['headimgurl'] = $user->headimgurl;
				$params['city'] = $user->city;
				$params['province'] = $user->province;
				$params['country'] = $user->country;
				$params['userinfo'] = json_encode($user);
				$params['create_time'] = date('Y-m-d H:i:s');
				$params['update_time'] = date('Y-m-d H:i:s');
				$wx_users_id = $model_member->addWxUser($params);
				if ($wx_users_id) {
							$count = $model_member->get_member_count();
							$insert_array = array();
							$insert_array['member_name'] = 'uk_wx_'.$count;
							$insert_array['member_passwd'] = md5('123456');
							$insert_array['member_email'] = $insert_array['member_name'].'@xx.xx';
							$insert_array['member_email_bind'] = 1;
							$insert_array['member_time'] = time();
							$insert_array['member_login_time'] = $insert_array['member_time'];
							$insert_array['member_points'] = 20;
							$insert_array['member_login_ip'] = uk86_getIp();
							$insert_array['member_sex'] = $params['sex'];
							$insert_array['wx_users_id'] = $wx_users_id;
							$result = Model('member')->insert($insert_array);
							if (empty($result)) {
								throw new Exception('注册用户失败');
							}
							$member_info = $model_member->getMemberInfo(array('member_name' => $insert_array['member_name'], 'member_passwd' => $insert_array['member_passwd']));
							if(!empty($member_info) && is_array($member_info)){
					 			//会员信息写入session
								$model_member->createSession($member_info);
					 		}else{
					 			throw new Exception('未获取到用户注册信息');
					 		}
				}else{
					throw new Exception('微信用户信息添加失败');
				}
				$model_member->commit();
				header("Location:$return_url");
			} catch (Exception $e) {
				$model_member->rollback();
			  	showDialog($e->getMessage());
			}
		}else{
			showDialog('获取信息失败', $return_url);
		}
	}

	function wxloginOp(){
		$user_agent = $_SERVER['HTTP_USER_AGENT'];
		if (strpos($user_agent, 'MicroMessenger') !== false) {
			header('Location:index.php?act=wap_login&op=login');
		}else{
			$return_url = SHOP_SITE_URL . '/index.php?act=wap_login&op=login';
			showDialog('请在微信内打开', $return_url);
		}
	}

}
