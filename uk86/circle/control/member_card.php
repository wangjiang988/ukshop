<?php
/**
 * ajax 提交成员信息
 *
 *by Uk86 商城开发
 */

class member_cardControl extends BaseCircleControl{
	public function mcard_infoOp(){
		$uid	= intval($_GET['uid']);
		$member_list = Model()->table('circle_member')->field('member_id,circle_id,circle_name,cm_level,cm_exp')->where(array('member_id'=>$uid,'cm_state'=>1))->select();
		if(empty($member_list)){
			echo 'false';exit;
		}
		echo json_encode($member_list);exit;
	}
}