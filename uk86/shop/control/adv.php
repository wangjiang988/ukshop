<?php
/**
 * 广告展示
 *
 *
 *
 **by  Uk86 商城开发*/


defined('InUk86') or exit('Access Invalid!');
class advControl {
    /**
	 *
	 * 广告展示
	 */
	public function advshowOp(){
		uk86_import('function.adv');
		$ap_id = intval($_GET['ap_id']);
		echo uk86_advshow($ap_id,'js');
	}
	/**
	 * 异步调用广告
	 *
	 */
	public function get_adv_listOp(){
	    $ap_ids = $_GET['ap_ids'];
	    $list = array();
	    if (!empty($ap_ids) && is_array($ap_ids)) {
	        uk86_import('function.adv');
    	    foreach ($ap_ids as $key => $value) {
    	        $ap_id = intval($value);//广告位编号
    	        $adv_info = uk86_advshow($ap_id,'array');
    	        if (!empty($adv_info) && is_array($adv_info)) {
    	            $list[$ap_id] = $adv_info;
    	        }
    	    }
	    }
		echo $_GET['callback'].'('.json_encode($list).')';
		exit;
	}
}
