<?php
defined('InUk86') or exit('Access Invalid!');

/**
 * 连续操作验证
 * 默认如果两次操作间隔小于10分钟，系统会记录操作次数，超过N次将被锁定，10分钟以后才能提交表单
 * 超过10分钟提交表单，以前记录的数据将被清空，重新从1开始计数
 */

class Uk86process{

	const MAX_LOGIN = 6;	//密码连续输入多少次被暂时锁定
	const MAX_COMMIT = 3;	//连续评论多少次被暂时锁定
	const MAX_REG = 3;		//连续注册多少个账号被暂时锁定
	const MAX_FORGET = 6;	//找回密码输入多少次被暂时锁定
	const MAX_ADMIN = 8;	//后台管理员输入多少次被暂时锁定

	/**
	 * 是否启用验证
	 *
	 * @var unknown_type
	 */
	private static $ifopen = true;

	/**
	 * 锁表对象
	 *
	 * @var unknown_type
	 */
	private static $lock;

	/**
	 * 记录ID
	 *
	 * @var unknown_type
	 */
	private static $processid = array();

	/**
	 * 锁ID
	 *
	 * @var unknown_type
	 */
	private static $lockid = array();

	/**
	 * 初始化，未启用内存保存时默认使用lock表存储
	 *
	 * @param unknown_type $type
	 */
	private static function uk86_init($type){
		if (C('cache_open')){
			self::$lock = Cache::getInstance('cacheredis');
		}else{
			self::$lock = new Uk86lock();
		}
		if (!isset(self::$processid[$type])){
			$ip = sprintf('%u',ip2long(uk86_getIp()));
			self::$processid[$type] = str_pad($ip,10,'0').self::uk86_parsekey($type);;
			self::$lockid[$type] = str_pad($ip,11,'0').self::uk86_parsekey($type);;
		}
	}

	/**
	 * 判断是否已锁
	 *
	 * @param unknown_type $type
	 * @return unknown
	 */
	public static function uk86_islock($type = null){
		if (!self::$ifopen) return;
		self::uk86_init($type);
		return self::$lock->get(self::$lockid[$type]);
	}

	/**
	 * 添加锁
	 *
	 * @param unknown_type $type
	 * @param unknown_type $ttl
	 */
	private static function uk86_addlock($type = null,$ttl = 600){
		if (!self::$ifopen) return;
		self::uk86_init($type);
		self::$lock->set(self::$lockid[$type],1,'',$ttl);
	}

	/**
	 * 删除锁
	 *
	 * @param unknown_type $type
	 */
	public static function uk86_dellock($type = null){
		if (!self::$ifopen) return;
		self::$lock->rm(self::$lockid[$type]);
	}

	/**
	 * 添加记录
	 *
	 * @param unknown_type $type
	 * @param unknown_type $ttl
	 */
	public static function uk86_addprocess($type = null,$ttl = 600){
		if (!self::$ifopen) return;
		self::uk86_init($type);
		$tims = self::uk86_parsetimes($type);
		$t = self::$lock->get(self::$processid[$type]);
		if ($t >= $tims-1) {
			self::uk86_addlock($type,$ttl);
			self::$lock->rm(self::$processid[$type]);
		}else{
			if (empty($t)) $t = 0;
			self::$lock->set(self::$processid[$type],$t+1,'',$ttl);
		}
	}

	/**
	 * 删除记录
	 *
	 * @param unknown_type $type
	 */
	public static function uk86_delprocess($type = null){
		if (!self::$ifopen) return;
		self::$lock->rm(self::$processid[$type]);
	}

	/**
	 * 清空
	 *
	 */
	public static function uk86_clear($type = ''){
		if (!self::$ifopen) return;
		if (empty($type)) return ;
		self::uk86_dellock($type);
		self::uk86_delprocess($type);
	}
	public static function uk86_parsekey($type){
		return str_replace(array('login','commit','reg','forget','admin'),array(1,2,3,4,5),$type);
	}

	/**
	 * 设置最多尝试次数
	 *
	 * @param unknown_type $type
	 * @return unknown
	 */
	public static function uk86_parsetimes($type){
		return str_replace(array('login', 'commit', 'reg', 'forget', 'admin'),array(self::MAX_LOGIN, self::MAX_COMMIT, self::MAX_REG, self::MAX_FORGET, self::MAX_ADMIN),$type);
	}
}

/**
 * lock表 操作
 *
 * @package  by Uk86 商城开发
 */
defined('InUk86') or exit('Access Invalid!');

class Uk86lock {
	private $model;
	public function __construct(){
		$this->model = Model('lock');
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
		$info = $this->model->where(array('pid'=>$key))->find();
		if ($info){
			$this->model->where(array('pid'=>$key))->update(array('pvalue'=>$value,'expiretime'=>TIMESTAMP+$ttl));
		}else{
			$this->model->insert(array('pid'=>$key,'pvalue'=>$value,'expiretime'=>TIMESTAMP+$ttl));
		}
	}

	/**
	 * 取得值
	 *
	 * @param mixed $key
	 * @param mixed $type
	 * @return bool
	 */
	public function get($key, $type=''){
		$info = $this->model->where(array('pid'=>$key))->find();
		if ($info && ($info['expiretime'] < TIMESTAMP)){
			$this->rm($key);return null;
		}else{
			return $info['pvalue'];
		}
	}

	/**
	 * 删除值
	 *
	 * @param mixed $key
	 * @param mixed $type
	 * @return bool
	 */
	public function rm($key, $type=''){
		return $this->model->where(array('pid'=>$key))->delete();
	}
}
?>