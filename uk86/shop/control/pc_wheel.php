<?php
/**
 * 大转盘
 * 
 * by UK86 商城开发
 */
defined('InUk86') or exit('Access Invalid!');

class pc_wheelControl extends BaseHomeControl{
	/**
	 * 活动验证
	 */
	public function __construct(){
		parent::__construct();
		$model_wheel = Model('wheel');
		$wheel_info = $model_wheel->field('wheel_start_time, wheel_end_time')->where('wheel_isuse = 1')->find();
		if($wheel_info == false){
			uk86_showMessage('活动不存在','index.php');
		}
		if($wheel_info['wheel_start_time'] > time()){
			uk86_showMessage('活动未开始','index.php');
		}elseif($wheel_info['wheel_end_time'] < time()){
			uk86_showMessage('活动已结束','index.php');
		}
	}
	/**
	 * 活动页面
	 */
	public function indexOp(){
		if($_SESSION['is_login'] != 1){
			uk86_showMessage('请登录后再参加活动','index.php?act=login&Op=index');
		}
 		$model_wheel = Model('wheel');
 		$wheel_info = $model_wheel->field('wheel_id, wheel_title, wheel_prizes, wheel_start_time, wheel_end_time')->where('wheel_isuse = 1')->order('sort asc')->find();
		Tpl::output('html_title',C('site_name').' - 大转盘');
		$prizes = unserialize($wheel_info['wheel_prizes']);
		Tpl::output('wheel_id', $wheel_info['wheel_id']);
		Tpl::output('wheel_title', $wheel_info['wheel_title']);
		Tpl::output('prizes', $prizes);
		Tpl::showpage('wheel');
	}
	/**
	 * 根据奖品数量以及概率产生中奖随机数
	 */
	public function randomOp(){
		$model_wheel = Model('wheel');
		$wheel_id = intval($_POST['wheel_id']);
		$prizes_info = $model_wheel->field('wheel_prizes')->where('wheel_id = '.$wheel_id)->find();
		$prizes = unserialize($prizes_info['wheel_prizes']);
		$length = count($prizes);
		$random = $this->set_random($prizes, $length, $wheel_id);
		echo $random;
	}
	/**
	 * 产生随机数并判断奖品剩余个数
	 * @param array $prizes
	 * @param int 	$length
	 * @param int 	$wheel_id
	 * @return number
	 */
	public function set_random($prizes, $length, $wheel_id){
		$model = Model('wheel_lottery');
		$big_num = 10000000;
		$num = intval(rand(0,999999999));
		$chance = 0;
		$prizes_all = 0;
		$add_true = false;
		$lottery_arr = array();
		$lottery_arr['member_name'] = $_SESSION['member_name']?$_SESSION['member_name']:'未知';
		$lottery_arr['wheel_id'] = $wheel_id;
		$lottery_arr['lottery_time'] = time();
		foreach ($prizes as $k => $v) {
			$last_chance = $chance;
			$chance += $v['chance'];
			$size = $model->where(array('wheel_id' => $wheel_id, 'prize_name' => $v['name']))->count();
			if($size <= $v['num'] && $v['num'] > 0 || $v['num'] == 0){
				if($k == 0){
					if($num >= 0 && $num < $v['chance'] * $big_num ){
						$lottery_arr['prize_name'] = $v['name'];
						$lottery_arr['lottery_type'] = $v['give'];
						if($v['give'] > 0){
							$add_true = true;
						}
						$random = 1;
					}
				}elseif($k == $length-1){
					if($num < $big_num*100 && $num >= ($last_chance*$big_num)){
						$lottery_arr['prize_name'] = $v['name'];
						$lottery_arr['lottery_type'] = $v['give'];
						if($v['give'] > 0){
							$add_true = true;
						}
						$random = $length;
					}
				}else{
					if($num < ($chance*$big_num) && $num >= ($last_chance*$big_num)){
						$lottery_arr['prize_name'] = $v['name'];
						$lottery_arr['lottery_type'] = $v['give'];
						if($v['give'] > 0){
							$add_true = true;
						}
						$random = $k+1;
					}
				}
			}else{
				$random = $length;
			}
		}
		if($add_true){
			uk86_setNcCookie('lottery_type', $lottery_arr['lottery_type'],100);
			//添加到奖品列表
			$model->insert($lottery_arr);
		}
		return $random;
	}
}