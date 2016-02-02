<?php
/**
 * 默认展示页面
 *
 *
 *
 *by Uk86 商城 开发
 */
defined('InUk86') or exit('Access Invalid!');
class albumControl extends MircroShopControl{

	public function __construct() {
		parent::__construct();
        Tpl::output('index_sign','album');
    }

	//首页
	public function indexOp(){
		Tpl::showpage('album');
	}
}
