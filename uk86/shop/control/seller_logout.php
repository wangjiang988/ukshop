<?php
/**
 * 店铺卖家注销
 *
 *by Uk86 商城开发
 */
defined('InUk86') or exit('Access Invalid!');

class seller_logoutControl extends BaseSellerControl {

	public function __construct() {
		parent::__construct();
	}

    public function indexOp() {
        $this->logoutOp();
    }

    public function logoutOp() {
        $this->recordSellerLog('注销成功');
        // 清除店铺消息数量缓存
        uk86_setNcCookie('storemsgnewnum'.$_SESSION['seller_id'],0,-3600);
        session_destroy();
        uk86_redirect('index.php?act=seller_login');
    }

}
