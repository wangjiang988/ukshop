<?php
/**
 * Created by PhpStorm.
 * User: dianxia
 * Date: 2015-11-02
 * Time: 14:22
 */
defined('InUk86') or exit('Access Invalid!');

class servicegoods_areaControl extends SystemControl {
    protected $area_model;
    public function __construct(){
        parent::__construct();
        $this->area_model=Model("area");
    }

    public function indexOp() {

        $model_area = Model('area');
        $province_array=$model_area->getProvinceAndCity();
        $city_array=$model_area->getServiceGoodsCity();

        Tpl::output('province_array',$province_array);
        Tpl::output('service_city_array',$city_array);
        Tpl::showpage('servicegoods_area.index');
    }

   public function update_goods_areaOp(){
       $cityId=$_POST['city'];
       if($this->area_model->update_goods_service_area($cityId)){
           uk86_showMessage("提交成功");
       }else{
           uk86_showMessage("提交失败");
       }
   }
}
