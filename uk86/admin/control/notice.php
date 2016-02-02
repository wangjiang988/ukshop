<?php
/**
 * 会员通知管理
 **by Uk86 商城开发*/

defined('InUk86') or exit('Access Invalid!');
class noticeControl extends SystemControl{
	public function __construct(){
		parent::__construct();
		Uk86Language::uk86_read('notice');
	}
	/**
	 * 会员通知
	 */
	public function noticeOp(){
		//提交
		if (uk86_chksubmit()){
			$content = trim($_POST['content1']);//信息内容
			$send_type = intval($_POST['send_type']);
			//验证
			$obj_validate = new Uk86Validate();
			switch ($send_type){
				//指定会员
				case 1:
					$obj_validate->uk86_setValidate(array("input"=>$_POST["user_name"], "require"=>"true", "message"=>Uk86Language::uk86_get('notice_index_member_list_null')));
					break;
				//全部会员
				case 2:
					break;
			}
			$obj_validate->uk86_setValidate(array("input"=>$content, "require"=>"true", "message"=>Uk86Language::uk86_get('notice_index_content_null')));
			$error = $obj_validate->uk86_validate();
			if ($error != ''){
				uk86_showMessage($error);
			}else {
				//发送会员ID 数组
				$memberid_list = array();
				//整理发送列表
				//指定会员
				if ($send_type == 1){
					$model_member = Model('member');
					$tmp = explode("\n",$_POST['user_name']);
					if (!empty($tmp)){
						foreach ($tmp as $k=>$v){
							$tmp[$k] = trim($v);
						}
						//查询会员列表
						$member_list = $model_member->getMemberList(array('member_name'=>array('in', $tmp)));
						unset($membername_str);
						if (!empty($member_list)){
							foreach ($member_list as $k => $v){
								$memberid_list[] = $v['member_id'];
							}
						}
						unset($member_list);
					}
					unset($tmp);
				}
				if (empty($memberid_list) && $send_type != 2){
					uk86_showMessage(Uk86Language::uk86_get('notice_index_member_error'),'','html','error');
				}
				//接收内容
				$array = array();
				$array['send_mode'] = 1;
				$array['user_name'] = $memberid_list;
				$array['content'] = $content;
				//添加短消息
				$model_message = Model('message');
				$insert_arr = array();
				$insert_arr['from_member_id'] = 0;
				if ($send_type == 2){
					$insert_arr['member_id'] = 'all';
				} else {
					$insert_arr['member_id'] = ",".implode(',',$memberid_list).",";
				}
				$insert_arr['msg_content'] = $content;
				$insert_arr['message_type'] = 1;
				$insert_arr['message_ismore'] = 1;
				$model_message->saveMessage($insert_arr);
				//跳转
				$this->log(L('notice_index_send'),1);
				uk86_showMessage(Uk86Language::uk86_get('notice_index_send_succ'),'index.php?act=notice&op=notice');
			}
		}
		Tpl::showpage('notice.add');
	}
	/**
	 * 通知列表
	 */
	public function notice_listOp(){
		$model = Model();
		$where="to_member_id like '%,%' or to_member_id like 'all'";
		$message = $model->table("message")->where($where)->field("message_id, to_member_id,message_body,message_time,message_state")->page(10)->order('message_time desc')->select();
		$member = $model->table('member')->field('member_id, member_name')->select();
		foreach($message as $k => $v){
			if($v['to_member_id'] == 'all'){
				$message[$k]['member_names'] = '所有会员';
				continue;
			}
			$member_ids = explode(',', $v['to_member_id']);
			if(is_array($member_ids)){
				foreach ($member_ids as $member_id){
					if(intval($member_id) > 0){
						foreach ($member as $key => $member_info){
							if($member_info['member_id'] == $member_id){
								$member_names[$key] = $member_info['member_name'];
							}
						}
					}
				}
				$message[$k]['member_names'] = implode(', ', $member_names);
			}
		}
		Tpl::output('message', $message);
		Tpl::output('page', $model->showpage(2));
		Tpl::showpage("notice.list");
	}
	
	/**
	 * 修改发送状态
	 */
	public function change_stateOp(){
		$state = intval($_POST['state']);
		$id = intval($_POST['id']);
		$update = array();
		$update['message_state'] = $state;
		$result = Model()->table('message')->where(array('message_id' => $id))->update($update);
		if($result){
			exit('1');
		}else{
			exit('0');
		}
	}
	
	/**
	 * 删除消息
	 */
	public function del_messageOp(){
		$id = intval($_GET['id']);
		$result = Model()->table('message')->where(array('message_id' => $id))->delete();
		if($result){
			uk86_showMessage('删除成功');
		}else{
			uk86_showMessage('删除失败');
		}
	} 
}
