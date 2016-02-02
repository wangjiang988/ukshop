<?php
/**
 * 手机端品牌街
 * @author ZHUXUESONG
 *
 */
defined('InUk86') or exit('Access Invalid!');

class wap_brandControl extends BaseWapControl{
	
	public function __construct(){
		parent::__construct();
	}
	
	public function indexOp(){
		$model_brand = Model('brand');
		$sort = 'brand_sort desc, brand_id asc';
		$kwd = trim($_GET['keyword']);
		if(empty($kwd)){
			//检索所有品牌信息
			$brand_all = $model_brand->where(array('brand_apply' => 1))->order($sort)->select();
			$brand_recommend = array();		//推荐品牌
			$brand_xuni = array();			//虚拟充值
			$brand_muying = array(); 		//母婴用品
			$brand_yundong = array();		//运动健康
			//对品牌分类处理
			foreach ($brand_all as $key => $val){
				if($val['brand_recommend'] == 1){
					$brand_recommend[] = $val;
				}
				if($val['class_id'] == 662 || $val['class_id'] == 7){
					$brand_yundong[] = $val;
					unset($brand_all[$key]);
				}
				if($val['class_id'] == 959){
					$brand_muying[] = $val;
					unset($brand_all[$key]);
				}
				if($val['class_id'] == 1037){
					$brand_xuni[] = $val;
				}
			}
			Tpl::output('brand_recommend', $brand_recommend);
			Tpl::output('brand_yundong', $brand_yundong);
			Tpl::output('brand_muying', $brand_muying);
			Tpl::output('brand_xuni', $brand_xuni);
			Tpl::output('brand_richang', $brand_all);
		}else{
			$keyword = trim($_GET['keyword']);
			$condition = 'brand_name like "%'.$keyword.'%" or brand_initial like "%'.strtoupper($keyword).'%"';
			$brand_search = $model_brand->where($condition)->order($sort)->select();
			Tpl::output('brand_search', $brand_search);
		}
		Tpl::showpage('brand.index');
	}
}
?>