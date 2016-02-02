<?php
/**
 *
 *
 *
 * @package    library* Uk86商城开发
 */
class Uk86SendStoreMsg {
    private $code = '';
    private $store_id = 0;

    /**
     * 设置
     *
     * @param mixed $key
     * @param mixed $value
     */
    public function uk86_set($key,$value){
        $this->$key = $value;
    }

    public function uk86_send($param = array()) {
        $msg_tpl = uk86_rkcache('store_msg_tpl', true);
        if (!isset($msg_tpl[$this->code]) || $this->store_id <= 0) {
            return false;
        }

        $tpl_info = $msg_tpl[$this->code];

        $setting_info = Model('store_msg_setting')->getStoreMsgSettingInfo(array('smt_code' => $this->code, 'store_id' => $this->store_id));
        // 发送站内信
        if ($tpl_info['smt_message_switch'] && ($tpl_info['smt_message_forced'] || $setting_info['sms_message_switch'])) {
            $message = uk86_ncReplaceText($tpl_info['smt_message_content'],$param);
            $this->uk86_sendMessage($message);
        }
        // 发送短消息
        if ($tpl_info['smt_short_switch'] && $setting_info['sms_short_number'] != '' && ($tpl_info['smt_short_forced'] || $setting_info['sms_short_switch'])) {
            $param['site_name'] = C('site_name');
            $message = uk86_ncReplaceText($tpl_info['smt_short_content'],$param);
            $this->uk86_sendShort($setting_info['sms_short_number'], $message);
        }
        // 发送邮件
        if ($tpl_info['smt_mail_switch'] && $setting_info['sms_mail_number'] != '' && ($tpl_info['smt_mail_forced'] || $setting_info['sms_mail_switch'])) {
            $param['site_name'] = C('site_name');
            $param['mail_send_time'] = date('Y-m-d H:i:s');
            $subject = uk86_ncReplaceText($tpl_info['smt_mail_subject'],$param);
            $message = uk86_ncReplaceText($tpl_info['smt_mail_content'],$param);
            $this->uk86_sendMail($setting_info['sms_mail_number'], $subject, $message);
        }
    }

    /**
     * 发送站内信
     * @param unknown $message
     */
    private function uk86_sendMessage($message) {
        $insert = array();
        $insert['smt_code'] = $this->code;
        $insert['store_id'] = $this->store_id;
        $insert['sm_content'] = $message;
        Model('store_msg')->addStoreMsg($insert);
    }

    /**
     * 发送短消息
     * @param unknown $number
     * @param unknown $message
     */
    private function uk86_sendShort($number, $message) {
        $sms = new Uk86Sms();
        $sms->uk86_send($number, $message);
    }

    /**
     * 发送邮件
     * @param unknown $number
     * @param unknown $subject
     * @param unknown $message
     */
    private function uk86_sendMail($number, $subject, $message) {
        // 即时发动代码
        // $email = new Email();
        // $email->send_sys_email($this->store_number['store_msg_mail'],$subject,$message);

        // 计划任务代码
        $insert = array();
        $insert['mail'] = $number;
        $insert['subject'] = $subject;
        $insert['contnet'] = $message;
        Model('mail_cron')->addMailCron($insert);
    }
}
