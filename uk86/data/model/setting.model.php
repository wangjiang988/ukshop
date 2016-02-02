<?php
/**
 * 系统设置内容
 *
 *
 *
 *
 * by Uk86 商城开发
 */
defined('InUk86') or exit('Access Invalid!');
class settingModel extends Model{
	public function __construct(){
		parent::__construct('setting');
	}
	/**
	 * 读取系统设置信息
	 *
	 * @param string $name 系统设置信息名称
	 * @return array 数组格式的返回结果
	 */
	public function getRowSetting($name){
		$param	= array();
		$param['table']	= 'setting';
		$param['where']	= "name='".$name."'";
		$result	= Db::select($param);
		if(is_array($result) and is_array($result[0])){
			return $result[0];
		}
		return false;
	}
	
	/**
	 * 向配置表中添加新配置，并跟新缓存
	 * @author wangjiang
	 */
	public function insertSetting($data){
		$r = Model()->table('setting')->insert($data);
		//清空缓存，便于系统重新读取
		uk86_dkcache('setting');
		return $r;
	}
	
	
	/**
	 * 读取系统设置列表
	 *
	 * @param
	 * @return array 数组格式的返回结果
	 */
	public function getListSetting(){
		$param = array();
		$param['table'] = 'setting';
		$result = Db::select($param);
		/**
		 * 整理
		 */
		if (is_array($result)){
			$list_setting = array();
			foreach ($result as $k => $v){
				$list_setting[$v['name']] = $v['value'];
			}
		}
		return $list_setting;
	}

	/**
	 * 更新信息
	 *
	 * @param array $param 更新数据
	 * @return bool 布尔类型的返回结果
	 */
	public function updateSetting($param){
		if (empty($param)){
			return false;
		}

		if (is_array($param)){
			foreach ($param as $k => $v){
				$tmp = array();
				$specialkeys_arr = array('statistics_code');
				$tmp['value'] = (in_array($k,$specialkeys_arr) ? htmlentities($v,ENT_QUOTES) : $v);
				$where = " name = '". $k ."'";
				$result = Db::update('setting',$tmp,$where);
				if ($result !== true){
					return $result;
				}
			}
			uk86_dkcache('setting');
			// @unlink(BASE_DATA_PATH.DS.'cache'.DS.'setting.php');
			return true;
		}else {
			return false;
		}
	}

}
