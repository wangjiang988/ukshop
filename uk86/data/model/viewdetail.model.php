<?php
/**
 * 系统文章
 *
 * 
 *
 *
 * @copyright  Copyright (c) 2007-2013 ShopNC Inc. (http://www.shopnc.net)
 * @license    http://www.shopnc.net
 * @link       http://www.shopnc.net
 * @since      File available since Release v1.1
 */
defined('InUk86') or exit('Access Invalid!');

class viewdetailModel{
	/**
	 * 查询所有系统文章
	 */
	public function getListByViewId($view_id){
		$condition_str = $this->_condition($view_id);
		$param = array();
		$param['table'] = 'view_detail';
		$param['where'] = $condition_str;
		$param['limit'] = $condition['limit'];
		$param['order']	= (empty($condition['order'])?'view_detail_sort asc':$condition['order']);
		$result = Db::select($param,$page);
		return $result;
	}
	public function update($param){
		if (empty($param)){
			return false;
		}
		if (is_array($param)){
			$tmp = array();
			foreach ($param as $k => $v){
				$tmp[$k] = $v;
			}
			$where = " view_detail_id = '". $param['view_detail_id'] ."'";
			$result = Db::update('view_detail',$tmp,$where);
			return $result;
		}else {
			return false;
		}
	}
	/**
	 * 根据编号查询一条
	 * 
	 * @param unknown_type $id
	 */
	public function getOneById($id){
		$param	= array(
			'table'	=> 'view_detail',
			'field'	=> 'view_detail_id',
			'value'	=> $id
		);
		return Db::getRow($param);
	}
	public function getArrayById($id)
	{
	$result = $this->getOneById($id);
	$array = $result['view_detail_node'];
	return $array;
	}
	public function getListByNorId($id,$detail_id)
	{
		$condition['view_id'] = $id;
		$result = $this->getListByViewId($condition);
		$data = array();
		foreach($result as $k => $v)
		{
			if($v['view_detail_id']!=$detail_id)
			$data[]=$v;
		}
		return $data;
	}
	/**
	 * 根据标识码查询一条
	 * 
	 * @param unknown_type $id
	 */
	
	/**
	 * 更新
	 * 
	 * @param unknown_type $param
	 */
	
	public function getOneByName($name){
		$condition_str = $this->_condition($name);
		$param = array();
		$param['table'] = 'view_detail';
		$param['where'] = $condition_str;
		$param['order']	= empty($condition['order'])?'view_id asc':$condition['order'];
		$result = Db::select($param);
		return $result;
	}
	public function add($param)
	{
	if (empty($param)){
			return false;
		}
		if (is_array($param)){
			$tmp = array();
			foreach ($param as $k => $v){
				$tmp[$k] = $v;
			}
			$result = Db::insert('view_detail',$tmp);
			return $result;
		}else {
			return false;
		}
	}
	private function _condition($condition){
		$condition_str = '';

		if ($condition['ac_id'] != ''){
			if($condition['ac_id']==1)
			{
				$condition_str .= " and view.view_class = 'platform'";
			}
			else
			{
				$condition_str .= " and view.view_class = 'shop'";
			}
		}
		
		if ($condition['like_title'] != ''){
			$condition_str .= " and view_detail.view_title like '%". $condition['like_title'] ."%'";
		}
		if ($condition['view_title'] != ''){
			$condition_str .= " and view_detail.view_detail_title = '". $condition['view_title']."'";
		}
		if ($condition['view_id'] != ''){
			$condition_str .= " and view_detail.view_id = '". $condition['view_id']."'";
		}
		if ($condition['view_sort'] != ''){
			$condition_str .= " and view_detail.view_detail_sort = '". $condition['view_sort']."'";
		}
		return $condition_str;
	}
	public function del($id,$view_id){
	    if (intval($id) > 0){
	        $where = " view_detail_id = '". intval($id) ."'"."and view_id = '".intval($view_id)."'";
	        $result = Db::delete('view_detail',$where);
	        return $result;
	    }else {
	        return false;
	    }
	}
}