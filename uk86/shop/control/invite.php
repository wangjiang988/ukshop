<?php
/**
 * 邀请返利页面
 * by Uk86 商城开发
 */
defined('InUk86') or exit('Access Invalid!');

class inviteControl extends BaseHomeControl{
	public function indexOp(){
		Tpl::showpage('invite');
	}
}
