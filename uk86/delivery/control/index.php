<?php
/**
 * 物流自提服务站首页
 *
 **by Uk86 商城开发*/

defined('InUk86') or exit('Access Invalid!');

class indexControl extends BaseDeliveryControl{
    public function __construct(){
        parent::__construct();
        @header('location: index.php?act=login');die;
    }
}

