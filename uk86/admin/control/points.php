<?php
/**
 * 积分管理
 *
 **by Uk86 商城开发*/

defined('InUk86') or exit('Access Invalid!');
class pointsControl extends SystemControl{
	const EXPORT_SIZE = 5000;
	public function __construct(){
		parent::__construct();
		Uk86Language::uk86_read('points');
		//判断系统是否开启积分功能
		if (C('points_isuse') != 1){
			uk86_showMessage(Uk86Language::uk86_get('admin_points_unavailable'),'index.php?act=dashboard&op=welcome','','error');
		}
	}

	/**
	 * 积分添加
	 */
	public function addpointsOp(){
		if (uk86_chksubmit()){

			$obj_validate = new Uk86Validate();
			$obj_validate->validateparam = array(
				array("input"=>$_POST["member_id"], "require"=>"true", "message"=>Uk86Language::uk86_get('admin_points_member_error_again')),
				array("input"=>$_POST["pointsnum"], "require"=>"true",'validator'=>'Compare','operator'=>' >= ','to'=>1,"message"=>Uk86Language::uk86_get('admin_points_points_min_error'))
			);
			$error = $obj_validate->uk86_validate();
			if ($error != ''){
				uk86_showMessage($error,'','','error');
			}
			//查询会员信息
			$obj_member = Model('member');
			$member_id = intval($_POST['member_id']);
			$member_info = $obj_member->getMemberInfo(array('member_id'=>$member_id));

			if (!is_array($member_info) || count($member_info)<=0){
				uk86_showMessage(Uk86Language::uk86_get('admin_points_userrecord_error'),'index.php?act=points&op=addpoints','','error');
			}

			$pointsnum = intval($_POST['pointsnum']);
			if ($_POST['operatetype'] == 2 && $pointsnum > intval($member_info['member_points'])){
				uk86_showMessage(Uk86Language::uk86_get('admin_points_points_short_error').$member_info['member_points'],'index.php?act=points&op=addpoints','','error');
			}

			$obj_points = Model('points');
			$insert_arr['pl_memberid'] = $member_info['member_id'];
			$insert_arr['pl_membername'] = $member_info['member_name'];
			$admininfo = $this->getAdminInfo();
			$insert_arr['pl_adminid'] = $admininfo['id'];
			$insert_arr['pl_adminname'] = $admininfo['name'];
			if ($_POST['operatetype'] == 2){
				$insert_arr['pl_points'] = -$_POST['pointsnum'];
			}else {
				$insert_arr['pl_points'] = $_POST['pointsnum'];
			}
			if ($_POST['pointsdesc']){
				$insert_arr['pl_desc'] = trim($_POST['pointsdesc']);
			} else {
				$insert_arr['pl_desc'] = Uk86Language::uk86_get('admin_points_system_desc');
			}
			$result = $obj_points->savePointsLog('system',$insert_arr,true);
			if ($result){
				$this->log(L('admin_points_mod_tip').$member_info['member_name'].'['.(($_POST['operatetype'] == 2)?'':'+').strval($insert_arr['pl_points']).']',null);
				uk86_showMessage(Uk86Language::uk86_get('nc_common_save_succ'),'index.php?act=points&op=addpoints');
			}else {
				uk86_showMessage(Uk86Language::uk86_get('nc_common_save_fail'),'index.php?act=points&op=addpoints','','error');
			}
		}else {
			Tpl::showpage('points.add');
		}
	}
	public function checkmemberOp(){
		$name = trim($_GET['name']);
		if (!$name){
			echo ''; die;
		}
		/**
		 * 转码
		 */
		if(strtoupper(CHARSET) == 'GBK'){
			$name = Uk86Language::uk86_getGBK($name);
		}
		$obj_member = Model('member');
		$member_info = $obj_member->getMemberInfo(array('member_name'=>$name));
		if (is_array($member_info) && count($member_info)>0){
			if(strtoupper(CHARSET) == 'GBK'){
				$member_info['member_name'] = Uk86Language::uk86_getUTF8($member_info['member_name']);
			}
			echo json_encode(array('id'=>$member_info['member_id'],'name'=>$member_info['member_name'],'points'=>$member_info['member_points']));
		}else {
			echo ''; die;
		}
	}
	/**
	 * 积分日志列表
	 */
	public function pointslogOp(){
		$condition_arr = array();
		$condition_arr['pl_membername_like'] = trim($_GET['mname']);
		$condition_arr['pl_adminname_like'] = trim($_GET['aname']);
		if ($_GET['stage']){
			$condition_arr['pl_stage'] = trim($_GET['stage']);
		}
		$condition_arr['saddtime'] = strtotime($_GET['stime']);
		$condition_arr['eaddtime'] = strtotime($_GET['etime']);
        if($condition_arr['eaddtime'] > 0) {
            $condition_arr['eaddtime'] += 86400;
        }
		$condition_arr['pl_desc_like'] = trim($_GET['description']);
		//分页
		$page	= new Uk86Page();
		$page->uk86_setEachNum(10);
		$page->uk86_setStyle('admin');
		//查询积分日志列表
		$points_model = Model('points');
		$list_log = $points_model->getPointsLogList($condition_arr,$page,'*','');
		//信息输出
		Tpl::output('show_page',$page->uk86_show());
		Tpl::output('list_log',$list_log);
		Tpl::showpage('pointslog');
	}

	/**
	 * 积分日志列表导出
	 */
	public function export_step1Op(){
		$condition_arr = array();
		$condition_arr['pl_membername_like'] = trim($_GET['mname']);
		$condition_arr['pl_adminname_like'] = trim($_GET['aname']);
		if ($_GET['stage']){
			$condition_arr['pl_stage'] = trim($_GET['stage']);
		}
		$condition_arr['saddtime'] = strtotime($_GET['stime']);
		$condition_arr['eaddtime'] = strtotime($_GET['etime']);
        if($condition_arr['eaddtime'] > 0) {
            $condition_arr['eaddtime'] += 86400;
        }
		$condition_arr['pl_desc_like'] = trim($_GET['description']);
		$page	= new Uk86Page();
		$page->uk86_setEachNum(self::EXPORT_SIZE);
		$points_model = Model('points');
		$list_log = $points_model->getPointsLogList($condition_arr,$page,'*','');
		if (!is_numeric($_GET['curpage'])){
			$count = $page->uk86_getTotalNum();
			$array = array();
			if ($count > self::EXPORT_SIZE ){	//显示下载链接
				$page = ceil($count/self::EXPORT_SIZE);
				for ($i=1;$i<=$page;$i++){
					$limit1 = ($i-1)*self::EXPORT_SIZE + 1;
					$limit2 = $i*self::EXPORT_SIZE > $count ? $count : $i*self::EXPORT_SIZE;
					$array[$i] = $limit1.' ~ '.$limit2 ;
				}
				Tpl::output('list',$array);
				Tpl::output('murl','index.php?act=pointslog&op=pointslog');
				Tpl::showpage('export.excel');
			}else{	//如果数量小，直接下载
				$this->createExcel($list_log);
			}
		}else{	//下载
			$this->createExcel($list_log);
		}
	}

	/**
	 * 生成excel
	 *
	 * @param array $data
	 */
	private function createExcel($data = array()){
		Uk86Language::uk86_read('export');
		uk86_import('libraries.uk86excel');
		$excel_obj = new Uk86Excel();
		$excel_data = array();
		//设置样式
		$excel_obj->uk86_setStyle(array('id'=>'s_title','Font'=>array('FontName'=>'宋体','Size'=>'12','Bold'=>'1')));
		//header
		$excel_data[0][] = array('styleid'=>'s_title','data'=>L('exp_pi_member'));
		$excel_data[0][] = array('styleid'=>'s_title','data'=>L('exp_pi_system'));
		$excel_data[0][] = array('styleid'=>'s_title','data'=>L('exp_pi_point'));
		$excel_data[0][] = array('styleid'=>'s_title','data'=>L('exp_pi_time'));
		$excel_data[0][] = array('styleid'=>'s_title','data'=>L('exp_pi_jd'));
		$excel_data[0][] = array('styleid'=>'s_title','data'=>L('exp_pi_ms'));
		$state_cn = array(Uk86Language::uk86_get('admin_points_stage_regist'),Uk86Language::uk86_get('admin_points_stage_login'),Uk86Language::uk86_get('admin_points_stage_comments'),Uk86Language::uk86_get('admin_points_stage_order'),Uk86Language::uk86_get('admin_points_stage_system'),Uk86Language::uk86_get('admin_points_stage_pointorder'),Uk86Language::uk86_get('admin_points_stage_app'));
		foreach ((array)$data as $k=>$v){
			$tmp = array();
			$tmp[] = array('data'=>$v['pl_membername']);
			$tmp[] = array('data'=>$v['pl_adminname']);
			$tmp[] = array('format'=>'Number','data'=>uk86_ncPriceFormat($v['pl_points']));
			$tmp[] = array('data'=>date('Y-m-d H:i:s',$v['pl_addtime']));
			$tmp[] = array('data'=>str_replace(array('regist','login','comments','order','system','pointorder','app'),$state_cn,$v['pl_stage']));
			$tmp[] = array('data'=>$v['pl_desc']);

			$excel_data[] = $tmp;
		}
		$excel_data = $excel_obj->uk86_charset($excel_data,CHARSET);
		$excel_obj->uk86_addArray($excel_data);
		$excel_obj->uk86_addWorksheet($excel_obj->uk86_charset(L('exp_pi_jfmx'),CHARSET));
		$excel_obj->uk86_generateXML($excel_obj->uk86_charset(L('exp_pi_jfmx'),CHARSET).$_GET['curpage'].'-'.date('Y-m-d-H',time()));
	}
}
