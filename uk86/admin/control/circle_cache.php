<?php
/*******
 * 圈子话题管理 
 *
 * by Uk86 商城开发
 */
defined('InUk86') or exit('Access Invalid!');
class circle_cacheControl extends SystemControl{
	public function __construct(){
		parent::__construct();
	}
	public function indexOp(){
		uk86_rcache('circle_level',true);
		uk86_showMessage(L('nc_common_op_succ'), 'index.php?act=circle_setting');
	}
}






