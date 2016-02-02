<?php
/**
 * redis 操作
 * Uk86商城开发
 */

defined('InUk86') or exit('Access Invalid!');

class CacheRedis extends Cache {
	private $config;
	private $connected;
	private $type;
	private $prefix;
    public function __construct() {
    	$this->config = C('redis');
    	if (empty($this->config['slave'])) $this->config['slave'] = $this->config['master'];
    	$this->prefix = $this->config['prefix'] ? $this->config['prefix'] : substr(md5($_SERVER['HTTP_HOST']), 0, 6).'_';
        if ( !extension_loaded('redis') ) {
            uk86_throw_exception('redis failed to load');
        }
    }

    private function uk86_init_master(){
    	static $_cache;
    	if (isset($_cache)){
    		$this->handler = $_cache;
    	}else{
	        $func = $this->config['pconnect'] ? 'pconnect' : 'connect';
	        $this->handler  = new Redis;
	        $this->enable = $this->handler->$func($this->config['master']['host'], $this->config['master']['port']);
	        $_cache = $this->handler;
            //$_cache->setOption(Redis::OPT_SERIALIZER, Redis::SERIALIZER_PHP);
    	}
    }

    private function uk86_init_slave(){
    	static $_cache;
    	if (isset($_cache)){
    		$this->handler = $_cache;
    	}else{
	        $func = $this->config['pconnect'] ? 'pconnect' : 'connect';
	        $this->handler = new Redis;
	        $this->enable = $this->handler->$func($this->config['slave']['host'], $this->config['slave']['port']);
	        $_cache = $this->handler;
            //$_cache->setOption(Redis::OPT_SERIALIZER, Redis::SERIALIZER_PHP);
    	}
    }

    private function uk86_isConnected() {
    	$this->uk86_init_master();
        return $this->enable;
    }

	public function get($key, $type = ''){
		$this->uk86_init_slave();
		if (!$this->enable) return false;
		$this->type = $type;
		$value = $this->handler->uk86_get($this->_uk86_key($key));

        return unserialize($value);
	}

    public function set($key, $value, $prefix = '', $expire = null) {
    	$this->uk86_init_master();
    	if (!$this->enable) return false;
    	$this->type = $prefix;

        $value = serialize($value);

        if(is_int($expire)) {
            $result = $this->handler->setex($this->_uk86_key($key), $expire, $value);
        }else{
            $result = $this->handler->uk86_set($this->_uk86_key($key), $value);
        }
        return $result;
    }

    public function uk86_hset($name, $prefix, $data) {
        $this->uk86_init_master();
        if (!$this->enable || !is_array($data) || empty($data)) return false;
        $this->type = $prefix;
        foreach ($data as $key => $value) {
            if ($value[0] == 'exp') {
                $value[1] = str_replace(' ', '', $value[1]);
                preg_match('/^[A-Za-z_]+([+-]\d+(\.\d+)?)$/',$value[1],$matches);
                if (is_numeric($matches[1])) {
                    $this->uk86_hIncrBy($name, $prefix, $key, $matches[1]);
                }
                unset($data[$key]);
            }
        }
        if (count($data) == 1) {
            $this->handler->uk86_hset($this->_uk86_key($name), key($data),current($data));
        } elseif (count($data) > 1) {
            $this->handler->hMset($this->_uk86_key($name), $data);
        }
    }

    public function uk86_hget($name, $prefix, $key = null) {
        $this->uk86_init_slave();
        if (!$this->enable) return false;
        $this->type = $prefix;
        if ($key == '*' || is_null($key)) {
            return $this->handler->hGetAll($this->_uk86_key($name));
        } elseif (strpos($key,',') != false) {
            return $this->handler->hmGet($this->_uk86_key($name), explode(',',$key));
        } else {
            return $this->handler->uk86_hget($this->_uk86_key($name), $key);
        }
    }

    public function uk86_hdel($name, $prefix, $key = null) {
        $this->uk86_init_master();
        if (!$this->enable) return false;
        $this->type = $prefix;
        if (is_null($key)) {
            if (is_array($name)) {
                return $this->handler->delete(array_walk($array,array(self,'_uk86_key')));
            } else {
                return $this->handler->delete($this->_uk86_key($name));
            }
        } else {
            if (is_array($name)) {
                foreach ($name as $key => $value) {
                    $this->handler->uk86_hdel($this->_uk86_key($name), $key);
                }
                return true;
            } else {
                return $this->handler->uk86_hdel($this->_uk86_key($name), $key);
            }
        }
    }

    public function uk86_hIncrBy($name, $prefix, $key, $num = 1) {
        if ($this->uk86_hget($name, $prefix,$key) !== false) {
            $this->handler->hIncrByFloat($this->_uk86_key($name), $key, floatval($num));
        }
    }

    public function rm($key, $type = '') {
    	$this->uk86_init_master();
    	if (!$this->enable) return false;
    	$this->type = $type;
        return $this->handler->delete($this->_uk86_key($key));
    }

    public function uk86_clear() {
    	$this->uk86_init_master();
    	if (!$this->enable) return false;
        return $this->handler->flushDB();
    }

	private function _uk86_key($str) {
		return $this->prefix.$this->type.$str;
	}
}