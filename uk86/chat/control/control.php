<?php
/**
 * 前台control父类
 *
 */

defined('InUk86') or exit('Access Invalid!');

/********************************** 前台control父类 **********************************************/

class BaseControl {
	public function __construct(){
		Uk86Language::uk86_read('common');
	}
}
