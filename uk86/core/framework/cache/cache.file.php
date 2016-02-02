<?php
/**
 * file 缓存
 * Uk86商城开发
 */
defined('InUk86') or exit('Access Invalid!');

class CacheFile extends Cache{

	public function __construct($params = array()){
		$this->params['expire'] = C('cache.expire');
		$this->params['path'] = BASE_PATH.'/cache';
		$this->enable = true;
	}

	private function uk86_init(){
		return true;
	}

	private function uk86_isConnected(){
		return $this->enable;
	}

	public function get($key, $path=null){
		$filename = realpath($this->_uk86_path($key));
		if (is_file($filename)){
			return require($filename);
		}else{
			return false;
		}
	}

	public function set($key, $value, $path=null, $expire=null){
		$filename = $this->_uk86_path($key);
        if (false == uk86_write_file($filename,$value)){
        	return false;
        }else{
        	return true;
        }
	}

	public function rm($key, $path=null){
		$filename = realpath($this->_uk86_path($key));
		if (is_file($filename)) {
			@unlink($filename);
		}else{
			return false;
		}
		return true;
	}

	private function _uk86_path($key){
		switch (strtolower($key)) {
//			case '':
//				$path = BASE_DATA_PATH.'/cache';
//				break;
			default:
				$path = BASE_DATA_PATH.'/cache';
				break;
		}
		return $path.'/'.$key.'.php';
	}
}
?>