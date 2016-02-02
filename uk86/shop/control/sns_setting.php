<?php
/**
 * 图片空间操作
 * 
 *by Uk86 商城开发
 */
defined('InUk86') or exit('Access Invalid!');

class sns_settingControl extends BaseSNSControl {
	public function __construct() {
		parent::__construct();
		/**
		 * 读取语言包
		 */
		Uk86Language::uk86_read('sns_setting');
	}
	public function change_skinOp(){
		Tpl::showpage('sns_changeskin', 'null_layout');
	}
	public function skin_saveOp(){
		$insert = array();
		$insert['member_id']	= $_SESSION['member_id'];
		$insert['setting_skin']	= $_GET['skin'];

		Model()->table('sns_setting')->insert($insert,true);
	}
}
?>
