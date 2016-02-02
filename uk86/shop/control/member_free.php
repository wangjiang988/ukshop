<?php
/**
 * 会员中心 -- 我的F码
 * 
 * by Uk86 商城开发
 */
defined('InUk86') or exit('Access Invalid!');

class member_freeControl extends BaseMemberControl{
	public function __construct(){
		parent::__construct();
		Uk86Language::uk86_read('member_layout');
	}
	
	/**
	 * 我的F码列表
	 */
	public function indexOp(){
		$model = Model('free');
		$where = array();
		$where['free_owner_id'] = intval($_SESSION['member_id']);
		if($_GET['select_detail_state'] != ''){
			$value = intval($_GET['select_detail_state']);
			if($value == 0 || $value == 1){
				$where['free_state'] = $value;
			}
		}
		$list = $model->where($where)->page(10)->order('free_state asc')->select();
		$this->profile_menu('free_list');
		Tpl::output('list', $list);
		Tpl::output('show_page', $model->showpage(2));
		Tpl::showpage('member_free.index');
	}
	
	/**
	 * 用户中心右边，小导航
	 * @param string $menu_key
	 */
	private function profile_menu($menu_key='') {
		$menu_array = array(
				1=>array('menu_key'=>'free_list','menu_name'=>'我的F码','menu_url'=>'index.php?act=member_free&op=index'),
		);
		Tpl::output('member_menu',$menu_array);
		Tpl::output('menu_key',$menu_key);
	}
}