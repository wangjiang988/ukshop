<?php
/**
 * APP会员
 *
 *
 **by Uk86 商城开发*/

defined('InUk86') or exit('Access Invalid!');

class memberControl{

	public function __construct(){
		require_once(BASE_PATH.'/framework/function/client.php');
	}

	public function infoOp(){
		if (!empty($_GET['uid'])){
			$member_info = nc_member_info($_GET['uid'],'uid');
		}elseif(!empty($_GET['user_name'])){
			$member_info = nc_member_info($_GET['user_name'],'user_name');
		}
		return $member_info;
	}
}
