<?php
/**
 * 地区模型
 *
 * by Uk86 商城开发
 */
defined('InUk86') or exit('Access Invalid!');

class areaModel extends Model {

    public function __construct() {
        parent::__construct('area');
    }

    /**
     * 获取地址列表
     *
     * @return mixed
     */
    public function getAreaList($condition = array(), $fields = '*', $group = '') {
        return $this->where($condition)->field($fields)->limit(false)->group($group)->select();
    }

    /**
     * 获取地址详情
     *
     * @return mixed
     */
    public function getAreaInfo($condition = array(), $fileds = '*') {
        return $this->where($condition)->field($fileds)->find();
    }

    /**
     * 获取一级地址（省级）名称数组
     *
     * @return array 键为id 值为名称字符串
     */
    public function getTopLevelAreas() {
        $data = $this->getCache();

        $arr = array();
        foreach ($data['children'][0] as $i) {
            $arr[$i] = $data['name'][$i];
        }

        return $arr;
    }

    /**
     * 获取获取市级id对应省级id的数组
     *
     * @return array 键为市级id 值为省级id
     */
    public function getCityProvince() {
        $data = $this->getCache();

        $arr = array();
        foreach ($data['parent'] as $k => $v) {
            if ($v && $data['parent'][$v] == 0) {
                $arr[$k] = $v;
            }
        }

        return $arr;
    }

    /**
     * 获取地区缓存
     *
     * @return array
     */
    public function getAreas() {
        return $this->getCache();
    }

    /**
     * 获取全部地区名称数组
     *
     * @return array 键为id 值为名称字符串
     */
    public function getAreaNames() {
        $data = $this->getCache();

        return $data['name'];
    }

    /**
     * 获取用于前端js使用的全部地址数组
     *
     * @return array
     */
    public function getAreaArrayForJson() {
        $data = $this->getCache();

        $arr = array();
        foreach ($data['children'] as $k => $v) {
            foreach ($v as $vv) {
                $arr[$k][] = array($vv, $data['name'][$vv]);
            }
        }

        return $arr;
    }

    /**
     * 获取地区数组 格式如下
     * array(
     *   'name' => array(
     *     '地区id' => '地区名称',
     *     // ..
     *   ),
     *   'parent' => array(
     *     '子地区id' => '父地区id',
     *     // ..
     *   ),
     *   'children' => array(
     *     '父地区id' => array(
     *       '子地区id 1',
     *       '子地区id 2',
     *       // ..
     *     ),
     *     // ..
     *   ),
     *   'region' => array(array(
     *     '华北区' => array(
     *       '省级id 1',
     *       '省级id 2',
     *       // ..
     *     ),
     *     // ..
     *   ),
     * )
     *
     * @return array
     */
    protected function getCache() {
        // 对象属性中有数据则返回
        if ($this->cachedData !== null)
            return $this->cachedData;

        // 缓存中有数据则返回
        if ($data = uk86_rkcache('area')) {
            $this->cachedData = $data;
            return $data;
        }

        // 查库
        $data = array();
        $area_all_array = $this->limit(false)->select();
        foreach ((array) $area_all_array as $a) {
            $data['name'][$a['area_id']] = $a['area_name'];
            $data['parent'][$a['area_id']] = $a['area_parent_id'];
            $data['children'][$a['area_parent_id']][] = $a['area_id'];

            if ($a['area_deep'] == 1 && $a['area_region'])
                $data['region'][$a['area_region']][] = $a['area_id'];
        }

        uk86_wkcache('area', $data);
        $this->cachedData = $data;

        return $data;
    }

    /**
     * @return mixe获取城市列表
     */
    public function getAllCity(){
        $cities=$this->where("area_deep = 2")->field("area_id,area_name")->select();
        return $cities;
    }

    //获取全部的省份
    public function getAllProvice(){
        $province=$this->where("area_deep = 1")->field("area_id,area_name")->select();
        return $province;
    }

    //获取某父级地域下的所有子地域
    public function getAllChildArea($parent_id=""){
        $condition['area_parent_id']=$parent_id;
        $childArea=$this->where($condition)->select();
        return $childArea;
    }

    public function getProvinceAndCity(){
        $data=$this->getAllProvice();
        foreach($data as $k => $v){
            $data[$k]['child']=$this->getAllChildArea($v['area_id']);
        }
        return $data;
    }

    public function update_goods_service_area($cityId){
        $data['area_service']=1;
        $condition['area_id']=array("in",$cityId);
        $flag=$this->where($condition)->update($data);     //为选中的城市更新为提供服务类商品城市
        $data['area_service']=0;
        $condition['area_id']=array("not in",$cityId);
        $flag=$this->where($condition)->update($data);                                  //更新不选中的城市
        return $flag;
    }

    public function getServiceGoodsCity(){
        $condition['area_service']=1;
        return $this->field("area_id,area_name")->where($condition)->select();
    }
    protected $cachedData;
}
