<?php
/**
 * 圈子
 * @author ZHUXUESONG
 *
 */
defined('InUk86') or exit('Access Invalid!');

class wap_circleControl extends BaseWapControl{
	public function __construct(){
		parent::__construct();
	}
	
	/**
	 * 圈子列表
	 */
	public function indexOp(){
		$cicle_model = Model('circle');
		$type=intval($_GET['type']);
		$order = 'circle_addtime desc';
		//分类搜索
		$condition = array('circle_status' => 1,);
		if($type == 2){
			$condition['is_recommend'] = 1;
		}
		if($type == 1){
			$condition['is_hot'] = 1;
		}
		$field = 'circle_id, circle_name, circle_desc, circle_mcount, circle_thcount';
		$circle_list = $cicle_model->where($condition)->field($field)->order($order)->select();
		Tpl::output('list', $circle_list);
		//圈子话题数量
		Tpl::showpage('circle.list');
	}
	
	/**
	 * 圈子详情
	 */
	public function circle_infoOp(){
		$this->check_login();
		$c_id = intval($_GET['c_id']);
		$condition = array('circle_id' => $c_id,);
		//圈子信息
		$circle_info = Model('circle')->where($condition)->field('*')->find();
		Tpl::output('circle_info', $circle_info);
		$member_list = Model()->table('circle_member')->where(array('circle_id' => $c_id, 'cm_state' => 1))->field('member_id, member_name, is_identity')->select();
		//是否有管理员
		$admin_list = array();
		if(!empty($member_list) && is_array($member_list)){
			foreach ($member_list as $member_info){
				if($member_info['is_identity'] == 2){
					$admin_list[] = $member_info;
				}
				//是否已加入本圈
				if($_SESSION['member_id'] == $member_info['member_id']){
					Tpl::output('is_this_user', 'yes');
				}
			}
		}
		Tpl::output('admin_list', $admin_list);
		//判断用户是否为圈主
		if(intval($_SESSION['member_id']) == intval($circle_info['circle_masterid'])){
			Tpl::output('is_master', 'yes');
		}
		//圈子话题
		$condition['is_shut'] = 0;
		$condition['is_closed'] = 0;
		$theme_list = Model()->table('circle_theme')->where($condition)->field('*')->order('theme_addtime desc')->select();
		//如果有附件，加载附件
		foreach ($theme_list as $k => $v){
			if($v['has_affix'] == 1){
				$affix_list = Model()->table('circle_affix')->where(array('circle_id' => $c_id, 'theme_id' => intval($v['theme_id'])))->field('affix_filethumb')->select();
				if(!empty($affix_list)){
					foreach ($affix_list as $affix_key => $affix_val){
						if(empty($affix_val['affix_filethumb'])){
							unset($affix_list[$affix_key]);
						}
					}
				}
				$theme_list[$k]['affix'] = $affix_list;
			}
		}
		Tpl::output('theme_list', $theme_list);
		Tpl::showpage('circle.info');
	}
	
	/**
	 * 话题详情页
	 */
	public function circleThemeOp(){
		$this->check_login();
		$model = Model();
		$condition = array();
		$condition['circle_id'] = intval($_GET['c_id']);
		$condition['theme_id'] = intval($_GET['theme_id']);
		$condition['is_closed'] = 0;
		//评论列表
		$reply_list = $model->table('circle_threply')->where($condition)->field('member_id, member_name, reply_content, reply_addtime')->order('reply_addtime desc')->select();
		$condition['is_shut'] = 0;
		//话题内容
		$theme_info = $model->table('circle_theme')->where($condition)->field('*')->find();
		if(empty($theme_info)){
			$this->wap_showDialog('话题不存在。');
		}
		//特殊话题（投票、报名）
		if(intval($theme_info['theme_special']) == 1){
			//投票信息
			$poll_info = $model->table('circle_thpoll')->where(array('theme_id' => $condition['theme_id']))->field('*')->find();
			if(intval($poll_info['poll_endtime']) <= time() && !empty($poll_info['poll_endtime'])){
				Tpl::output('poll_end', 'is_end');
				Tpl::output('is_disabled', 'yes');
			}
			if($poll_info['poll_multiple'] == 0 || $poll_info['poll_multiple'] == '0'){
				//选项为单选
				$poll_info['poll_input_type'] = 'radio';
			}else{
				//选项为多选
				$poll_info['poll_input_type'] = 'checkbox';
			}
			Tpl::output('poll_info', $poll_info);
			//投票选项
			$poll_option = $model->table('circle_thpolloption')->where(array('theme_id' => $condition['theme_id']))->select();
			//判断会员是否已参与过投票
			$poll_member = $model->table('circle_thpollvoter')->where(array('theme_id' => $condition['theme_id'], 'member_id' => intval($_SESSION['member_id'])))->field('member_name')->find();
			if(!empty($poll_member['member_name'])){
				Tpl::output('is_disabled', 'yes');
				Tpl::output('is_polled', 'yes');
			}
			//计算每项投票比例
			foreach($poll_option as $k => $v){
				$option_x = floatval(intval($v['pollop_votes'])/intval($poll_info['poll_voters']?$poll_info['poll_voters']:1));
				$poll_option[$k]['option_x'] = round($option_x, 4) * 100;
			}
			Tpl::output('poll_option', $poll_option);
		}
		if(intval($theme_info['theme_special']) == 2){
			//报名信息/会员默认信息
			$member_info = $model->table('member')->where(array('member_id' => $_SESSION['member_id']))->field('member_truename, member_mobile, member_email, member_qq')->find();
			Tpl::output('member_info', $member_info);
			//报名人数
			$enroll_num = $model->table('circle_enroll')->where(array('t_id' => $condition['theme_id']))->count();
			Tpl::output('enroll_num', $enroll_num);
		}
		Tpl::output('theme_info', $theme_info);
		Tpl::output('reply_list', $reply_list);
		Tpl::showpage('circle.theme');
	}
	
	/**
	 * 会员申请加入圈子
	 */
	public function circleMemberApplyOp(){
		$model = Model();
		//圈子信息
		$field = 'circle_id, circle_name, circle_joinaudit';
		$condition = array('circle_id' => intval($_POST['c_id']));
		$circle_info = $model->table('circle')->where($condition)->field($field)->find();
		if(empty($circle_info)){
			exit(json_encode(array('state' => false, 'msg' => '圈子不存在。')));
		}
		//保存数据
		$time_now = time();
		$insert_array = array();
		$insert_array['member_id'] = intval($_SESSION['member_id']);
		$insert_array['circle_id'] = intval($circle_info['circle_id']);
		$insert_array['circle_name'] = $circle_info['circle_name'];
		$insert_array['member_name'] = $_SESSION['member_name'];
		$insert_array['cm_applycontent'] = $_POST['cm_applycontent'];
		$insert_array['cm_applytime'] = $time_now;
		if(intval($circle_info['circle_joinaudit']) == 0){
			$insert_array['cm_state'] = 1;
			$insert_array['cm_jointime'] = $time_now;
			$msg = '申请成功，您现在已是圈子成员。';
		}else{
			$insert_array['cm_state'] = 0;
			$msg = '申请成功，请等待圈主审核。';
		}
		$insert_array['cm_intro'] = $_POST['cm_intro'];
		$insert_array['is_identity'] = 3;
		$result = $model->table('circle_member')->insert($insert_array);
		if($result){
			//圈子成员数量+1
			$model->table('circle')->where($condition)->setInc('circle_mcount', 1);
			exit(json_encode(array('state' => true, 'msg' => $msg)));
		}
		exit(json_encode(array('state' => false, 'msg' => '申请失败，请联系管理员。')));
	}
	
	/**
	 * 会员退出圈子
	 */
	public function circleMemberExitOp(){
		$model = Model();
		$condition = array();
		$condition['circle_id'] = intval($_POST['c_id']);
		$condition['member_id'] = intval($_SESSION['member_id']);
		//删除数据
		$result = $model->table('circle_member')->where($condition)->delete();
		if($result){
			//成员数量减一
			$model->table('circle')->where(array('circle_id' => $condition['circle_id']))->setInc('circle_mcount', -1);
			exit('1');
		}
		exit('0');
	}
	
	/**
	 * 评论话题
	 */
	public function addReplyOp(){
		if(empty($_GET['c_id']) || empty($_GET['t_id']) || empty($_GET['message'])){
			exit(json_encode(array('state' => false, 'msg' => '数据错误')));
		}
		$model = Model();
		//保存数据
		$insert_array = array();
		$insert_array['theme_id'] = intval($_GET['t_id']);
		$insert_array['circle_id'] = intval($_GET['c_id']);
		$insert_array['member_id'] = intval($_SESSION['member_id']);
		$insert_array['member_name'] = $_SESSION['member_name'];
		$insert_array['reply_content'] = $_GET['message'];
		$insert_array['reply_addtime'] = time();
		$insert_result = $model->table('circle_threply')->insert($insert_array);
		if($insert_result > 0){
			//评论数量+1
			$model->table('circle_theme')->where(array('theme_id' => $insert_array['theme_id'], 'circle_id' => $insert_array['circle_id']))->setInc('theme_commentcount', 1);
			exit(json_encode(array('state' => true)));
		}
		exit(json_encode(array('state' => false, 'msg' => '系统错误，请联系管理员')));
	}
	
	/**
	 * 投票
	 */
	public function themePollOp(){
		if(empty($_POST['poll_option'])){
			exit('0');
		}
		$model = Model();
		$num = 0;
		$insert_array = array();
		$insert_array['theme_id'] = intval($_POST['t_id']);
		$insert_array['member_id'] = intval($_SESSION['member_id']);
		$insert_array['member_name'] = $_SESSION['member_name'];
		$insert_array['pollvo_time'] = time();
		foreach ($_POST['poll_option'] as $val){
			$poll_option = $model->table('circle_thpolloption')->where(array('pollop_id' => $val))->field('pollop_option, pollop_votes, pollop_votername')->find();
			$insert_array['pollvo_options'] = $poll_option['pollop_option'];
			//插入数据
			$model->table('circle_thpollvoter')->insert($insert_array);
			//更新数据
			$update_array = array();
			$update_array['pollop_votes'] = intval($poll_option['pollop_votes']) + 1;
			$update_array['pollop_votername'] = $poll_option['pollop_votername']?$poll_option['pollop_votername'].' '.$_SESSION['member_name']:$_SESSION['member_name'];
			$model->table('circle_thpolloption')->where(array('pollop_id' => $val))->update($update_array);
			$num++;
		}
		//参与投票人数+$num
		$model->table('circle_thpoll')->where(array('theme_id' => $insert_array['theme_id']))->setInc('poll_voters', $num);
		exit('1');
	}
	
	/**
	 * 报名
	 */
	public function themeEnrollOp(){
		$enroll_model = Model('circle_enroll');
		$condition = array();
		$condition['t_id'] = intval($_POST['t_id']);
		$condition['member_phone'] = trim($_POST['mobile']);
		//检查手机号是否重复
		$enroll_id = $enroll_model->where($condition)->field('theme_id')->find();
		if(!empty($enroll_id['theme_id'])){
			exit(json_encode(array('state' => false, 'msg' => '您填写的手机号已参与了报名')));
		}
		//保存数据
		$insert_array = $condition;
		$insert_array['member_id'] = intval($_SESSION['member_id']);
		$insert_array['member_name'] = $_SESSION['member_name'];
		$insert_array['enroll_time'] = time();
		$insert_array['member_truename'] = $_POST['truename'];
		$insert_array['member_email'] = $_POST['email'];
		$insert_array['member_qq'] = $_POST['tx_qq'];
		$result = $enroll_model->insert($insert_array);
		if($result){
			exit(json_encode(array('state' => true, 'msg' => '报名成功')));
		}
		exit(json_encode(array('state' => false, 'msg' => '数据保存失败，请联系管理员')));
	}
	
	/**
	 * 未登录跳转登录页面
	 */
	public function check_login(){
		if($_SESSION['is_login'] != 1){
			header('Location:index.php?act=wap_login&op=login');
		}
	}
}
?>