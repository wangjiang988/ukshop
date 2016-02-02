<?php
/**
 * cms首页
 *
 *
 **by Uk86 商城开发*/

defined('InUk86') or exit('Access Invalid!');
class indexControl extends CMSHomeControl{

	public function __construct() {
		parent::__construct();
        Tpl::output('index_sign','index');
    }
	public function indexOp(){
        Tpl::showpage('index');
	}
}
