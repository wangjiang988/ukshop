<?php
/**
 * 缓存文件 
 *
 * @package    by Uk86 商城开发
 */
defined('InUk86') or exit('Access Invalid!');

class Uk86NcFtp{
	const FTP_ERR_SERVER_DISABLED = -100;
	const FTP_ERR_CONFIG_OFF = -101;
	const FTP_ERR_CONNECT_TO_SERVER = -102;
	const FTP_ERR_USER_NO_LOGGIN = -103;
	const FTP_ERR_CHDIR = -104;
	const FTP_ERR_MKDIR = -105;
	const FTP_ERR_SOURCE_READ = -106;
	const FTP_ERR_TARGET_WRITE = -107;

	public $enabled = false;
	public $config = array();

	public $func;
	public $connectid;
	public $_error;

	public static function &uk86_instance($config = array()) {
		static $object;
		if(empty($object)) {
			$object = new Uk86NcFtp($config);
		}
		return $object;
	}

	public function __construct($config = array()) {
		$this->uk86_set_error(0);
		if (!($this->config = $config)){
			$this->config['on'] = C('ftp_open');
			$this->config['host'] = C('ftp_server');
			$this->config['ssl'] = C('ftp_ssl_state');
			$this->config['port'] = C('ftp_port');
			$this->config['username'] = C('ftp_username');
			$this->config['password'] = C('ftp_password');
			$this->config['pasv'] = C('ftp_pasv');
			$this->config['attachdir'] = C('ftp_attach_dir');
			$this->config['attachurl'] = C('ftp_access_url');
			$this->config['timeout'] = C('ftp_timeout');			
		}
		$this->enabled = false;
		if(empty($this->config['on']) || empty($this->config['host'])) {
			$this->uk86_set_error(self::FTP_ERR_CONFIG_OFF);
		} else {
			$this->func = $this->config['ssl'] && function_exists('ftp_ssl_connect') ? 'ftp_ssl_connect' : 'uk86_ftp_connect';
			if($this->func == 'uk86_ftp_connect' && !function_exists('uk86_ftp_connect')) {
				$this->uk86_set_error(self::FTP_ERR_SERVER_DISABLED);
			} else {
				$this->config['host'] = Uk86NcFtp::uk86_clear($this->config['host']);
				$this->config['port'] = intval($this->config['port']);
				$this->config['ssl'] = intval($this->config['ssl']);
				$this->config['host'] = Uk86NcFtp::uk86_clear($this->config['host']);
				$this->config['password'] = $this->config['password'];
				$this->config['timeout'] = intval($this->config['timeout']);
				$this->enabled = true;
			}
		}
	}

	public function uk86_upload($source, $target) {
		if($this->error()) {
			return 0;
		}

		$old_dir = $this->uk86_ftp_pwd();
		$dirname = dirname($target);
		$filename = basename($target);
		if(!$this->uk86_ftp_chdir($dirname)) {
			if($this->uk86_ftp_mkdir($dirname)) {
				$this->uk86_ftp_chmod($dirname);
				if(!$this->uk86_ftp_chdir($dirname)) {
					$this->uk86_set_error(self::FTP_ERR_CHDIR);
				}
				$this->uk86_ftp_put('index.html', BASE_PATH.'/upload/index.html', FTP_BINARY);
			} else {
				$this->uk86_set_error(self::FTP_ERR_MKDIR);
			}
		}

		$res = 0;
		if(!$this->uk86_error()) {
			if($fp = @fopen($source, 'rb')) {
				$res = $this->uk86_ftp_fput($filename, $fp, FTP_BINARY);
				@fclose($fp);
				!$res && $this->uk86_set_error(self::FTP_ERR_TARGET_WRITE);
			} else {
				$this->uk86_set_error(self::FTP_ERR_SOURCE_READ);
			}
		}

		$this->uk86_ftp_chdir($old_dir);

		return $res ? 1 : 0;
	}

	public function uk86_connect() {
		if(!$this->enabled || empty($this->config)) {
			return 0;
		} else {
			return $this->uk86_ftp_connect(
				$this->config['host'],
				$this->config['username'],
				$this->config['password'],
				$this->config['attachdir'],
				$this->config['port'],
				$this->config['timeout'],
				$this->config['ssl'],
				$this->config['pasv']
				);
		}

	}

	public function uk86_ftp_connect($ftphost, $username, $password, $ftppath, $ftpport = 21, $timeout = 30, $ftpssl = 0, $ftppasv = 0) {
		$res = 0;
		$fun = $this->func;
		if($this->connectid = $fun($ftphost, $ftpport, 20)) {

			$timeout && $this->uk86_set_option(FTP_TIMEOUT_SEC, $timeout);
			if($this->uk86_ftp_login($username, $password)) {
				$this->uk86_ftp_pasv($ftppasv);
				if($this->uk86_ftp_chdir($ftppath)) {
					$res =  $this->connectid;
				} else {
					$this->uk86_set_error(self::FTP_ERR_CHDIR);
				}
			} else {
				$this->uk86_set_error(self::FTP_ERR_USER_NO_LOGGIN);
			}

		} else {
			$this->uk86_set_error(self::FTP_ERR_CONNECT_TO_SERVER);
		}

		if($res > 0) {
			$this->uk86_set_error();
			$this->enabled = 1;
		} else {
			$this->enabled = 0;
			$this->uk86_ftp_close();
		}

		return $res;

	}

	public function uk86_set_error($code = 0) {
		$this->_error = $code;
	}

	public function uk86_error() {
		return $this->_error;
	}

	public function uk86_clear($str) {
		return str_replace(array( "\n", "\r", '..'), '', $str);
	}


	public function uk86_set_option($cmd, $value) {
		if(function_exists('ftp_set_option')) {
			return @ftp_set_option($this->connectid, $cmd, $value);
		}
	}

	public function uk86_ftp_mkdir($directory) {
		$directory = Uk86NcFtp::uk86_clear($directory);
		$epath = explode('/', $directory);
		$dir = '';$comma = '';
		foreach($epath as $path) {
			$dir .= $comma.$path;
			$comma = '/';
			$return = @ftp_mkdir($this->connectid, $dir);
			$this->uk86_ftp_chmod($dir);
		}
		return $return;
	}

	public function uk86_ftp_rmdir($directory) {
		$directory = Uk86NcFtp::uk86_clear($directory);
		return @ftp_rmdir($this->connectid, $directory);
	}

	public function uk86_ftp_put($remote_file, $local_file, $mode = FTP_BINARY) {
		$remote_file = Uk86NcFtp::uk86_clear($remote_file);
		$local_file = Uk86NcFtp::uk86_clear($local_file);
		$mode = intval($mode);
		return @ftp_put($this->connectid, $remote_file, $local_file, $mode);
	}

	public function uk86_ftp_fput($remote_file, $sourcefp, $mode = FTP_BINARY) {
		$remote_file = Uk86NcFtp::uk86_clear($remote_file);
		$mode = intval($mode);
		return @ftp_fput($this->connectid, $remote_file, $sourcefp, $mode);
	}

	public function uk86_ftp_size($remote_file) {
		$remote_file = Uk86NcFtp::uk86_clear($remote_file);
		return @ftp_size($this->connectid, $remote_file);
	}

	public function uk86_ftp_close() {
		return @ftp_close($this->connectid);
	}

	public function uk86_ftp_delete($path) {
		$path = Uk86NcFtp::uk86_clear($path);
		return @ftp_delete($this->connectid, $path);
	}

	public function uk86_ftp_get($local_file, $remote_file, $mode, $resumepos = 0) {
		$remote_file = Uk86NcFtp::uk86_clear($remote_file);
		$local_file = Uk86NcFtp::uk86_clear($local_file);
		$mode = intval($mode);
		$resumepos = intval($resumepos);
		return @ftp_get($this->connectid, $local_file, $remote_file, $mode, $resumepos);
	}

	public function uk86_ftp_login($username, $password) {
		$username = $this->uk86_clear($username);
		$password = str_replace(array("\n", "\r"), array('', ''), $password);
		return @ftp_login($this->connectid, $username, $password);
	}

	public function uk86_ftp_pasv($pasv) {
		return @ftp_pasv($this->connectid, $pasv ? true : false);
	}

	public function uk86_ftp_chdir($directory) {
		$directory = Uk86NcFtp::uk86_clear($directory);
		return @ftp_chdir($this->connectid, $directory);
	}

	public function uk86_ftp_site($cmd) {
		$cmd = Uk86NcFtp::uk86_clear($cmd);
		return @ftp_site($this->connectid, $cmd);
	}

	public function uk86_ftp_chmod($filename, $mod = 0777) {
		$filename = Uk86NcFtp::uk86_clear($filename);
		if(function_exists('ftp_chmod')) {
			return @ftp_chmod($this->connectid, $mod, $filename);
		} else {
			return @ftp_site($this->connectid, 'CHMOD '.$mod.' '.$filename);
		}
	}

	public function uk86_ftp_pwd() {
		return @ftp_pwd($this->connectid);
	}

}
?>