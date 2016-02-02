<?php
/**
 * memcache 操作
 * Uk86商城开发
 */
defined('InUk86') or exit('Access Invalid!');

class CacheMemcache extends Cache {
	/**
	 * 配置信息
	 *
	 * @var unknown_type
	 */
	private $config;
	
	/**
	 * 键值前缀（区分各业务层）
	 *
	 * @var string
	 */
	private $type;
	
	/**
	 * 键值前缀(系统级别)
	 *
	 * @var string
	 */
	private $prefix;

	public function __construct(){
		$this->config = C('memcache');
		if (!extension_loaded('memcache') || !is_array($this->config[1])) {
			uk86_throw_exception('memcache failed to load');
		}
		$this->uk86_init();
	}

	/**
	 * 初始化
	 * @return void
	 */
	private function uk86_init(){
		$this->prefix= $this->config['prefix'] ? $this->config['prefix'] : substr(md5($_SERVER['HTTP_HOST']), 0, 6).'_';
		$this->handler = new Memcache;
		if (function_exists('memcache_add_server')){	//版本 > 2.0.0
			foreach ($this->config as $key=>$conf) {
				if (is_numeric($key)){
					$this->enable = $this->handler->addServer($conf['host'], $conf['port'], $conf['pconnect']?true:false);
				}
			}
		}else{
			$func = $this->config[1]['pconnect'] ? 'pconnect' : 'connect';
			$this->enable = @$this->handler->$func($this->config[1]['host'], $this->config[1]['port']);
		}
	}

	/**
	 * 判断是否有效
	 *
	 * @return bool
	 */
	public function uk86_isConnected(){
		return $this->enable;
	}

	/**
	 * 设置值
	 *
	 * @param mixed $key
	 * @param mixed $value
	 * @param string $type
	 * @param int $ttl
	 * @return bool
	 */
	public function set($key, $value, $type='', $ttl = SESSION_EXPIRE){
		if (!$this->enable) return false;
		$this->type = $type;
		return $this->handler->uk86_set($this->_uk86_key($key), $value, MEMCACHE_COMPRESSED, $ttl);
	}

	/**
	 * 取得值
	 *
	 * @param mixed $key
	 * @param mixed $type
	 * @return bool
	 */
	public function get($key, $type=''){
		if (!$this->enable) return false;
		$this->type = $type;
		return $this->handler->uk86_get($this->_uk86_key($key));
	}

	/**
	 * 删除值
	 *
	 * @param mixed $key
	 * @param mixed $type
	 * @return bool
	 */
	public function rm($key, $type=''){
		$this->type = $type;
		return $this->handler->delete($this->_uk86_key($key));
	}

	/**
	 * 清空值
	 *
	 * @return bool
	 */
	public function uk86_clear(){
		return $this->handler->flush();
	}

	/**
	 * 加前缀
	 *
	 * @param string $str
	 * @return string
	 */
	private function _uk86_key($str) {
		return $this->prefix.$this->type.$str;
	}

	/**
	 * 递增
	 *
	 * @param string $key
	 * @param int $step
	 * @return int/false
	 */
	public function uk86_inc($key, $step = 1) {
		return $this->handler->increment($this->_uk86_key($key), $step);
	}

	/**
	 * 递减
	 *
	 * @param string $key
	 * @param int $step
	 * @return int/false
	 */
	public function uk86_dec($key, $step = 1) {
		return $this->handler->decrement($this->_uk86_key($key), $step);
	}
}