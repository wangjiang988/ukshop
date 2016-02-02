<?php
/**
 * 记录日志 
 *
 *by Uk86 商城开发
 */
defined('InUk86') or exit('Access Invalid!');
class Uk86Log{

    const SQL       = 'SQL';
    const ERR       = 'ERR';
    private static $log =   array();

    public static function uk86_record($message,$level=self::ERR) {
        $now = @date('Y-m-d H:i:s',time());
        switch ($level) {
            case self::SQL:
               self::$log[] = "[{$now}] {$level}: {$message}\r\n";
               break;
            case self::ERR:
                $log_file = BASE_DATA_PATH.'/log/'.date('Ymd',TIMESTAMP).'.log';
                $url = $_SERVER['REQUEST_URI'] ? $_SERVER['REQUEST_URI'] : $_SERVER['PHP_SELF'];
                $url .= " ( act={$_GET['act']}&op={$_GET['op']} ) ";
                $content = "[{$now}] {$url}\r\n{$level}: {$message}\r\n";
                file_put_contents($log_file,$content, FILE_APPEND);
                break;
        }
    }

    public static function uk86_read(){
    	return self::$log;
    }
}