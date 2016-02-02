<?php
/**
 * 语言调用类
 *
 * 语言调用类，为静态使用
 *
 *
 * @package   by Uk86 商城开发
 */
defined('InUk86') or exit('Access Invalid!');
final class Uk86Language{
	private static $language_content = array();
	
	/**
	 * 得到数组变量的GBK编码
	 *
	 * @param array $key 数组
	 * @return array 数组类型的返回结果
	 */
	public static function uk86_getGBK($key){
		/**
		 * 转码
		 */
		if (strtoupper(CHARSET) == 'GBK' && !empty($key)){
			if (is_array($key)){
				$result = var_export($key, true);//变为字符串
				$result = iconv('UTF-8','GBK',$result);
				eval("\$result = $result;");//转换回数组
			}else {
				$result = iconv('UTF-8','GBK',$key);
			}
		}
		return $result;
	}
	/**
	 * 得到数组变量的UTF-8编码
	 *
	 * @param array $key GBK编码数组
	 * @return array 数组类型的返回结果
	 */
	public static function uk86_getUTF8($key){
		/**
		 * 转码
		 */
		if (!empty($key)){
			if (is_array($key)){
				$result = var_export($key, true);//变为字符串
				$result = iconv('GBK','UTF-8',$result);
				eval("\$result = $result;");//转换回数组
			}else {
				$result = iconv('GBK','UTF-8',$key);
			}
		}
		return $result;
	}
	/**
	 * 取指定下标的数组内容
	 *
	 * @param string $key 数组下标
	 * @return string 字符串形式的返回结果
	 */
	public static function uk86_get($key,$charset = ''){
		$result = self::$language_content[$key] ? self::$language_content[$key] : '';
		if (strtoupper(CHARSET) == 'UTF-8' || strtoupper($charset) == 'UTF-8') return $result;//json格式时不转换
		/**
		 * 转码
		 */
		if (strtoupper(CHARSET) == 'GBK' && !empty($result)){
			$result = iconv('UTF-8','GBK',$result);
		}
		return $result;
	}
	/**
	 * 设置指定下标的数组内容
	 *
	 * @param string $key 数组下标
	 * @param string $value 值
	 * @return bool 字符串形式的返回结果
	 */
	public static function uk86_set($key,$value){
		self::$language_content[$key] = $value;
		return true;
	}
	/**
	 * 通过语言包文件设置语言内容
	 *
	 * @param string $file 语言包文件，可以按照逗号(,)分隔
	 * @return bool 布尔类型的返回结果
	 */
	public static function uk86_read($file){
		str_replace('，',',',$file);
		$tmp = explode(',',$file);
		foreach ($tmp as $v){
			$tmp_file = BASE_PATH.'/language/'.LANG_TYPE.DS.$v.'.php';
			if (file_exists($tmp_file)){
				require($tmp_file);
				if (!empty($lang) && is_array($lang)){
					self::$language_content = array_merge(self::$language_content,$lang);
				}
				unset($lang);
			}
		}
		return true;
	}
	/**
	 * 取语言包全部内容
	 *
	 * @return array 数组类型的返回结果
	 */
	public static function uk86_getLangContent($charset = ''){
		$result = self::$language_content;
		if (strtoupper(CHARSET) == 'UTF-8' || strtoupper($charset) == 'UTF-8') return $result;//json格式时不转换
		/**
		 * 转码
		 */
		if (strtoupper(CHARSET) == 'GBK' && !empty($result)){
			if (is_array($result)){
				foreach ($result as $k => $v){
					$result[$k] = iconv('UTF-8','GBK',$v);
				}
			}
		}
		return $result;
	}

	public static function uk86_appendLanguage($lang){
		if (!empty($lang) && is_array($lang)){
			self::$language_content = array_merge(self::$language_content,$lang);
		}
	}
}