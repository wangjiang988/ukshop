<?php
/**
 * 下载设置
 *
 *
 *
 **by Uk86 商城开发*/

defined('InUk86') or exit('Access Invalid!');
class mb_appControl extends SystemControl{
	public function __construct(){
		parent::__construct();
	}

	/**
	 * 设置下载地址
	 *
	 */
	public function mb_appOp() {
	    $model_setting = Model('setting');
		$mobile_apk = $model_setting->getRowSetting('mobile_apk');
		$mobile_apk_version = $model_setting->getRowSetting('mobile_apk_version');
		$mobile_ios = $model_setting->getRowSetting('mobile_ios');
		if (uk86_chksubmit()) {
			$update_array = array();
			$update_array['mobile_apk'] = $_POST['mobile_apk'];
			$update_array['mobile_apk_version'] = $_POST['mobile_apk_version'];
			$update_array['mobile_ios'] = $_POST['mobile_ios'];
			$state = $model_setting->updateSetting($update_array);
			if ($state) {
			    $this->log('设置手机端下载地址');
				uk86_showMessage(Uk86Language::uk86_get('nc_common_save_succ'),'index.php?act=mb_app&op=mb_app');
			} else {
				uk86_showMessage(Uk86Language::uk86_get('nc_common_save_fail'));
			}
		}
		Tpl::output('mobile_apk',$mobile_apk);
		Tpl::output('mobile_version',$mobile_apk_version);
		Tpl::output('mobile_ios',$mobile_ios);
		Tpl::showpage('mb_app.edit');
	}

	/**
	 * 生成二维码
	 */
	 public function mb_qrOp() {
		$url = uk86_urlShop('mb_app', 'index');
		$mobile_app = 'mb_app.png';
		require_once(BASE_RESOURCE_PATH.DS.'phpqrcode'.DS.'index.php');
		$PhpQRCode = new PhpQRCode();
		$PhpQRCode->set('pngTempDir',BASE_UPLOAD_PATH.DS.ATTACH_COMMON.DS);
		$PhpQRCode->set('date',$url);
		$PhpQRCode->set('pngTempName', $mobile_app);
		$PhpQRCode->init();

		$this->log('生成手机端二维码');
		uk86_showMessage('生成二维码成功','index.php?act=mb_app&op=mb_app');
	} 
// 	public function mb_qrOp(){
// 		$code_name = md5(time()).'.png';
// 		require_once(BASE_RESOURCE_PATH.DS.'phpqrcode'.DS.'index.php');
// 		$PhpQRCode = new PhpQRCode();
// 		$PhpQRCode->set('pngTempDir',BASE_UPLOAD_PATH.DS.'shop/mention_code/');
// 		$PhpQRCode->set('date', '手机号:13855347423'. Chr(10) .'订单编号:7000000000000101');
// 		$PhpQRCode->set('pngTempName', $code_name);
// 		$PhpQRCode->init();
		
// 		uk86_showMessage('二维码生成成功');
// 	}
}
