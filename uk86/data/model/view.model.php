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

class viewModel{
	/**
	 * 查询所有系统文章
	 */
	public function getList(){
		$param	= array(
			'table'	=> 'view'
		);
		return Db::select($param);
	}
	/**
	 * 根据编号查询一条
	 * 
	 * @param unknown_type $id
	 */
	public function getOneById($id){
		$param	= array(
			'table'	=> 'view',
			'field'	=> 'view_id',
			'value'	=> $id
		);
		return Db::getRow($param);
	}
	/**
	 * 根据标识码查询一条
	 * 
	 * @param unknown_type $id
	 */
	public function getOneByName($name){
		$condition_str = $this->_condition($name);
		$param = array();
		$param['table'] = 'view';
		$param['where'] = $condition_str;
		$param['order']	= empty($condition['order'])?'view_id asc':$condition['order'];
		$result = Db::select($param);
		return $result;
	}
	/**
	 * 更新
	 * 
	 * @param unknown_type $param
	 */
	
	public function del($id){
		if (intval($id) > 0){
			$where = " view_id = '". intval($id) ."'";
			$result = Db::delete('view',$where);
			return $result;
		}else {
			return false;
		}
	}
	public function getViewList($condition,$page=''){
		$condition_str = $this->_condition($condition);
		$param = array();
		$param['table'] = 'view';
		$param['where'] = $condition_str;
		$param['limit'] = $condition['limit'];
		$param['order']	= (empty($condition['order'])?'view_sort asc':$condition['order']);
		$result = Db::select($param,$page);
		return $result;
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
			$condition_str .= " and view.view_title like '%". $condition['like_title'] ."%'";
		}
		if ($condition['view_title'] != ''){
			$condition_str .= " and view.view_title = '". $condition['view_title']."'";
		}

		return $condition_str;
	}
	public function add($param){
		if (empty($param)){
			return false;
		}
		if (is_array($param)){
			$tmp = array();
			foreach ($param as $k => $v){
				$tmp[$k] = $v;
			}
			$result = Db::insert('view',$tmp);
			return $result;
		}else {
			return false;
		}
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
			$where = " view_id = '". $param['view_id'] ."'";
			$result = Db::update('view',$tmp,$where);
			return $result;
		}else {
			return false;
		}
	}
}