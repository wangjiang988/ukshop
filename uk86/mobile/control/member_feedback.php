<?php
/**
 * 我的反馈
 *
 *
 *
 *
 * by Uk86 商城开发
 */

//use Shopnc\Tpl;

defined('InUk86') or exit('Access Invalid!');

class member_feedbackControl extends mobileMemberControl {

	public function __construct() {
		parent::__construct();
	}

    /**
     * 添加反馈
     */
    public function feedback_addOp() {
        $model_mb_feedback = Model('mb_feedback');

        $param = array();
        $param['content'] = $_POST['feedback'];
        $param['type'] = $this->member_info['client_type'];
        $param['ftime'] = TIMESTAMP;
        $param['member_id'] = $this->member_info['member_id'];
        $param['member_name'] = $this->member_info['member_name'];

        $result = $model_mb_feedback->addMbFeedback($param);

        if($result) {
            output_data('1');
        } else {
            output_error('保存失败');
        }
    }
}
