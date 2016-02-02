<?php
/**
 * U币管理
 * 
 * 
 *by Uk86 商城开发
 */
defined('InUk86') or exit('Access Invalid!');

class member_pointsControl extends BaseMemberControl {
	public function indexOp(){
		$this->points_logOp();
		exit;
	}
	public function __construct() {
		parent::__construct();
		/**
		 * 读取语言包
		 */
		Uk86Language::uk86_read('member_member_points,member_pointorder');
		/**
		 * 判断系统是否开启U币功能
		 */
		if (C('points_isuse') != 1){
			uk86_showMessage(Uk86Language::uk86_get('points_unavailable'),uk86_urlShop('member', 'home'),'html','error');
		}
	}
	/**
	 * U币日志列表
	 */
	public function points_logOp(){
		$condition_arr = array();
		$condition_arr['pl_memberid'] = $_SESSION['member_id'];
		if ($_GET['stage']){
			$condition_arr['pl_stage'] = $_GET['stage'];
		}
		$condition_arr['saddtime'] = strtotime($_GET['stime']);
		$condition_arr['eaddtime'] = strtotime($_GET['etime']);
        if($condition_arr['eaddtime'] > 0) {
            $condition_arr['eaddtime'] += 86400;
        }
		$condition_arr['pl_desc_like'] = $_GET['description'];
		//分页
		$page	= new Uk86Page();
		$page->uk86_setEachNum(10);
		$page->uk86_setStyle('admin');
		//查询U币日志列表
		$points_model = Model('points');
		$list_log = $points_model->getPointsLogList($condition_arr,$page,'*','');
		//信息输出
		self::profile_menu('points');
		Tpl::output('show_page',$page->uk86_show());
		Tpl::output('list_log',$list_log);
		Tpl::showpage('member_points');
	}
	/**
	 * 用户中心右边，小导航
	 *
	 * @param string	$menu_type	导航类型
	 * @param string 	$menu_key	当前导航的menu_key
	 * @param array 	$array		附加菜单
	 * @return
	 */
	private function profile_menu($menu_key='',$array=array()) {
		Uk86Language::uk86_read('member_layout');
		$lang	= Uk86Language::uk86_getLangContent();
		$menu_array		= array();
		$menu_array = array(
			1=>array('menu_key'=>'points',	'menu_name'=>$lang['nc_member_path_points'],	'menu_url'=>'index.php?act=member_points'),
			2=>array('menu_key'=>'orderlist','menu_name'=>Uk86Language::uk86_get('member_pointorder_list_title'),	'menu_url'=>'index.php?act=member_pointorder&op=orderlist')
		);
		if(!empty($array)) {
			$menu_array[] = $array;
		}
		Tpl::output('member_menu',$menu_array);
		Tpl::output('menu_key',$menu_key);
	}
}
