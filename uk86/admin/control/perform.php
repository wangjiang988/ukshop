<?php
/**
 * 网站设置
 *
 *  by 33 hao .com v3
 */
defined('InUk86') or exit('Access Invalid!');
class performControl extends SystemControl{
	public function __construct(){
		parent::__construct();
		Uk86Language::uk86_read('setting');
	}

	/**
	 * 性能优化
	 */
	public function performOp(){
		if ($_GET['type'] == 'clear'){
			$lang	= Uk86Language::uk86_getLangContent();
			$cache = Cache::getInstance(C('cache.type'));
			$cache->clear();
			uk86_showMessage($lang['nc_common_op_succ']);
		}
		Tpl::showpage('setting.perform_opt');
	}

}
