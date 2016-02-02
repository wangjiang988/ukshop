<?php
/**
 * 后台大转盘设置
 * 
 * by UK86 商城开发
 */
defined('InUk86') or exit('Access Invalid!');

class wheelControl extends SystemControl{
	public function __construct(){
		parent::__construct();
		Uk86Language::uk86_read('wheel');
	}
	/**
	 * 活动列表
	 */
	public function wheelListOp(){
		//条件
		$where = '';
		if(!empty($_GET['searchtitle'])){
			$where .= "wheel_title like '%".$_GET['searchtitle']."%'";
		}
		if(intval($_GET['searchstate']) > -1 && $_GET['searchstate'] != ''){
			if(!empty($where)){
				$where .= ' and ';
			}
			$where .= 'wheel_isuse = '.intval($_GET['searchstate']);
		}
 		$model_list = Model('wheel');
		$list = $model_list->where($where)->order('sort asc')->page(10)->select();
		Tpl::output('show_page',$model_list->showpage(1));
		Tpl::output('list', $list);
		Tpl::showpage('wheel_list');
	}
	/**
	 * 大转盘基本设置
	 */
	public function indexOp(){
		$model_wheel = Model('wheel');
		if(uk86_chksubmit()){
			if(strtotime($_POST['wheel_start_time']) >= strtotime($_POST['wheel_end_time'])){
				uk86_showMessage('活动开始时间不能大于结束时间，请重新设置');
			}
			$obj_validate = new Uk86Validate();
			$obj_validate->validateparam = array();
			$error = $obj_validate->uk86_validate();
			if ($error != ''){
				uk86_showMessage($error);
			}else {
				$prize_array = array();
				$sum = 0;
				for($i = 0; $i < intval($_POST['lottery_length']); $i++){
					$prize_array[$i]['name'] = $_POST['wheel_prize_name_'.($i+1)];
					$prize_array[$i]['chance'] = floatval($_POST['wheel_prize_'.($i+1)]);
					$prize_array[$i]['num'] = $_POST['wheel_prize_num_'.($i+1)];
					$prize_array[$i]['give'] = intval($_POST['wheel_prize_give_'.($i+1)]);
					$sum += $prize_array[$i]['chance'];
				}
				if($sum > 100){
					uk86_showMessage('奖品概率不能大于100%');
				}else{
					$wheel_array = array();
					$wheel_array['wheel_start_time'] = strtotime($_POST['wheel_start_time']);
					$wheel_array['wheel_end_time'] = strtotime($_POST['wheel_end_time']);
					$wheel_array['wheel_isuse'] = intval($_POST['wheel_isuse']);
					$wheel_array['wheel_prizes'] = serialize($prize_array);
					$wheel_array['wheel_title'] = $_POST['wheel_title'];
					if(intval($_POST['wheel_id']) > 0){
						$wheel_array['last_updata_time'] = time();
						$result = $model_wheel->where('wheel_id = '.$_POST['wheel_id'])->update($wheel_array);
					}else{
						$wheel_array['wheel_add_time'] = time();
						$result = $model_wheel->insert($wheel_array);
					}
					if ($result){
						//$this->log(L('nc_edit,nc_operation,nc_operation_set'),1);
						uk86_showMessage('操作成功','index.php?act=wheel&op=wheelList');
					}else {
						uk86_showMessage('操作失败');
					}
				}
			}
		}
		if(intval($_GET['id']) > 0){
			$wheel_info = $model_wheel->where('wheel_id = '.intval($_GET['id']))->find();
			$prize_info = unserialize($wheel_info['wheel_prizes']);
			Tpl::output('setting', 1);
			Tpl::output('wheel_info', $wheel_info);
			Tpl::output('prize_info', $prize_info);
			Tpl::output('wheel_setting', $wheel_info['wheel_isuse']);
		}
		$num_ch = array('一', '二', '三', '四', '五', '六', '七', '八', '九', '十', '十一', '十二', '十三', '十四', '十五', '十六', '十七', '十八', '十九', '二十');
		Tpl::output('num_ch', $num_ch);
		Tpl::showpage("wheel");
	}
	/**
	 * 中奖者名单
	 */
	public function lottery_listOp(){
		$where = '';
		if(!empty($_GET['searchtitle'])){
			$where .= 'member_name like "%'.$_GET['searchtitle'].'%" and ';
		}
		$where .= 'wheel_id = '.intval($_GET['id']);
		$model_lottery = Model('wheel_lottery');
		$lottery_list = $model_lottery->where($where)->order('lottery_time desc')->page(10)->select();
		Tpl::output('show_page', $model_lottery->showpage(2));
		Tpl::output('lottery_list', $lottery_list);
		Tpl::showpage('wheel_lottery');
	}
	/**
	 * 快捷排序
	 */
	public function set_sortOp(){
		$id = intval($_POST['wheel_id']);
		$sort = intval($_POST['sort']);
		$result = Model('wheel')->where('wheel_id = '.$id)->update(array('sort' => $sort));
		echo $result;
	}
	/**
	 * 删除活动
	 */
	public function wheel_delOp(){
		if(!empty($_POST['wheel_id']) && is_array($_POST['wheel_id'])){
			$model_lottery = Model('wheel_lottery');
			$id_arr = $_POST['wheel_id'][0];
			foreach ($_POST['wheel_id'] as $k=>$v){
				$result_1 = $model_lottery->where('wheel_id = '.intval($v))->delete();
				if($k > 0){
					$id_arr .= ', '.$_POST['wheel_id'][$k];
				}
			}
			if($result_1){
				$result = Model('wheel')->where('wheel_id in ('.$id_arr.')')->delete();
			}
			if($result){
				uk86_showMessage('删除成功');
			}
		}else{
			uk86_showMessage('请选择要删除的活动');
		}
	}
	/**
	 * 发放奖品操作
	 */
	public function lottery_statusOp(){
		$lottery_id = intval($_GET['id']);
		$result = Model('wheel_lottery')->where('lottery_id = '.$lottery_id)->update(array('status' => 1));
		//如果为实物奖品，生成订单
		if($result){
			uk86_showMessage('操作成功');
		}
	}
}