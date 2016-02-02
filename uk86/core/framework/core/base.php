<?php
/**
 * 核心文件
 *
 * 核心初始化类，不允许继承
 *
 */
defined('InUk86') or exit('Access Invalid!');
final class Uk86Base{

	const CPURL = '';

	/**
	 * uk86_init
	 */
	public static function uk86_init() {
	    // config info
	    global $setting_config;
	    self::uk86_parse_conf($setting_config);
	    define('MD5_KEY',md5($setting_config['md5_key']));

	    if(function_exists('date_default_timezone_set')){
	        if (is_numeric($setting_config['time_zone'])){
	            @date_default_timezone_set('Asia/Shanghai');
	        }else{
	            @date_default_timezone_set($setting_config['time_zone']);
	        }
	    }

	    //session start
	    self::uk86_start_session();
	    
	    //output to the template
	    Tpl::output('setting_config',$setting_config);
	    
	    //read language
	    Uk86Language::uk86_read('core_lang_index');
	}

	/**
	 * uk86_run
	 */
	public static function uk86_run(){
	    self::uk86_cp();
	    self::uk86_init();
		self::uk86_control();
	}

	/**
	 * get setting
	 */
	private static function uk86_parse_conf(&$setting_config){
		$nc_config = $GLOBALS['config'];
		if(is_array($nc_config['db']['slave']) && !empty($nc_config['db']['slave'])){
			$dbslave = $nc_config['db']['slave'];
			$sid     = array_rand($dbslave);
			$nc_config['db']['slave'] = $dbslave[$sid];
		}else{
			$nc_config['db']['slave'] = $nc_config['db'][1];
		}
		$nc_config['db']['master'] = $nc_config['db'][1];
		$setting_config = $nc_config;
		$setting = ($setting = uk86_rkcache('setting')) ? $setting : uk86_rkcache('setting',true);
		$setting['uk86_version'] = 'Copyright 2015 优康商城版权所有';
		$setting_config = array_merge_recursive($setting,$nc_config);
	}

	/**
	 * 控制器调度
	 *
	 */
	private static function uk86_control(){
		//二级域名
		if ($GLOBALS['setting_config']['enabled_subdomain'] == '1' && $_GET['act'] == 'index' && $_GET['op'] == 'index'){
			$store_id = uk86_subdomain();
			if ($store_id > 0) $_GET['act'] = 'show_store';
		}
		$act_file = realpath(BASE_PATH.'/control/'.$_GET['act'].'.php');
		$class_name = $_GET['act'].'Control';
		if (!@include($act_file)){
 		    if (C('debug')) {
 		        uk86_throw_exception("Uk86Base Error: access file isn't exists!");
 		    } else {
  		        uk86_showMessage('抱歉！您访问的页面不存在','','html','error');
 		    }
 		}
		if (class_exists($class_name)){
			$main = new $class_name();
			$function = $_GET['op'].'Op';
 			if (method_exists($main,$function)){
				$main->$function();
 			}elseif (method_exists($main,'indexOp')){
 				$main->indexOp();
 			}else {
 				$error = "Uk86Base Error: function $function not in $class_name!";
 				uk86_throw_exception($error);
 			}
		}else {
			$error = "Uk86Base Error: class $class_name isn't exists!";
			uk86_throw_exception($error);
		}
	}

	/**
	 * 开启session
	 *
	 */
	private static function uk86_start_session(){
		if (SUBDOMAIN_SUFFIX){
			$subdomain_suffix = SUBDOMAIN_SUFFIX;
		}else{
			if (preg_match("/^[0-9.]+$/",$_SERVER['HTTP_HOST'])){
				$subdomain_suffix = $_SERVER['HTTP_HOST'];
			}else{
				$split_url = explode('.',$_SERVER['HTTP_HOST']);
				if($split_url[2] != '') unset($split_url[0]);
				$subdomain_suffix = implode('.',$split_url);
			}
		}
		//session.name强制定制成PHPSESSID,不请允许更改
		@ini_set('session.name','PHPSESSID');
		$subdomain_suffix = str_replace('http://','',$subdomain_suffix);
		if ($subdomain_suffix !== 'localhost') {
		    @ini_set('session.cookie_domain', $subdomain_suffix);
		}

		//开启以下配置支持session信息存信memcache
		//@ini_set("session.save_handler", "memcache");
		//@ini_set("session.save_path", C('memcache.1.host').':'.C('memcache.1.port'));

		//默认以文件形式存储session信息
		session_save_path(BASE_DATA_PATH.'/session');
		session_start();
	}

	public static function uk86_autoload($class){
		$class = strtolower($class);
		if (ucwords(substr($class,-5)) == 'Class' ){
			if (!@include_once(BASE_PATH.'/framework/libraries/'.substr($class,0,-5).'.class.php')){
				exit("Class Error: {$class}.isn't exists!1");
			}
		}elseif (ucwords(substr($class,0,5)) == 'Cache' && $class != 'cache'){
			if (!@include_once(BASE_CORE_PATH.'/framework/cache/'.substr($class,0,5).'.'.substr($class,5).'.php')){
				exit("Class Error: {$class}.isn't exists!2");
			}
		}elseif ($class == 'db'){
			if (!@include_once(BASE_CORE_PATH.'/framework/db/'.strtolower(DBDRIVER).'.php')){
				exit("Class Error: {$class}.isn't exists!3");
			}
		}else{
			if (!@include_once(BASE_CORE_PATH.'/framework/libraries/'.$class.'.php')){
				echo BASE_CORE_PATH.'/framework/libraries/'.$class.'.php <br/>';
				exit("Class Error: {$class}.isn't exists!4");
			}
		}
	}

	/**
	 * 合法性验证
	 *
	 */
	private static function uk86_cp(){
		if (self::CPURL == '') return;
		if ($_SERVER['HTTP_HOST'] == 'localhost') return;
		if ($_SERVER['HTTP_HOST'] == '127.0.0.1') return;
		if (strpos(self::CPURL,'||') !== false){
			$a = explode('||',self::CPURL);
			foreach ($a as $v) {
				$d = strtolower(stristr($_SERVER['HTTP_HOST'],$v));
				if ($d == strtolower($v)){
					return;
				}else{
					continue;
				}
			}
			header('location: http://bbs.ukshop.com');exit();
		}else{
			$d = strtolower(stristr($_SERVER['HTTP_HOST'],self::CPURL));
			if ($d != strtolower(self::CPURL)){
				header('location: http://bbs.ukshop.com');exit();
			}
		}
	}
}