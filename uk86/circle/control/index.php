<?php
/**
 * 圈子首页
 *
 *
 *********************************/

defined('InUk86') or exit('Access Invalid!');

class indexControl extends BaseCircleControl{
	public function __construct(){
		Uk86Language::uk86_read('circle');
		parent::__construct();
	}
	/**
	 * 首页
	 */
	public function indexOp(){
		$model = Model();

		//我的圈子，话题，和回复数
		$my_counts['circle_count']=$model->table('circle_member')->where(array('member_id'=>$_SESSION['member_id']))->count();
        $my_counts['theme_count']=$model->table('circle_theme')->where(array('member_id'=>$_SESSION['member_id']))->count();
		$my_counts['threply_count']=$model->table('circle_threply')->where(array('member_id'=>$_SESSION['member_id']))->count();
		Tpl::output('circle_counts',$my_counts);

		// 热门圈子      **显示3个圈子，按推荐随机排列，推荐不够按成员数主题数降序排列**
		$circle_list = $model->table('circle')->field('*, is_hot*rand() as rand')->where(array('circle_status'=>1, 'is_hot'=>1,'is_official'=>0))->order('rand desc')->limit(4)->select();
		if(!empty($circle_list)){
			$circle_list = uk86_array_under_reset($circle_list, 'circle_id');$circleid_array = array_keys($circle_list);
			// 查询圈子最新主题
			foreach($circle_list as $key=>$val){
				// 最新的两条数据
				$theme_list = $model->table('circle_theme')->where(array('circle_id'=>$val['circle_id'], 'is_closed'=>0))->order('theme_id desc')->find();
				$circle_list[$key]['theme_list'] = $theme_list;
			}
			Tpl::output('circle_list', $circle_list);
			//var_dump($circle_list);
			/*$now = strtotime(date('Y-m-d',time()));
			// 今天发表的主题
			$nowthemecount_array = $model->table('circle_theme')->field('count(circle_id) as count,circle_id')->group('circle_id')->where(array('theme_addtime'=>array('gt', $now), 'circle_id'=>array('in', $circleid_array), 'is_closed'=>0))->select();
			if(!empty($nowthemecount_array)){
				$nowthemecount_array = uk86_array_under_reset($nowthemecount_array, 'circle_id');
				Tpl::output('nowthemecount_array', $nowthemecount_array);
			}

			// 今天新加入的成员
			$nowjoincount_array = $model->table('circle_member')->field('count(circle_id) as count,circle_id')->group('circle_id')->where(array('cm_jointime'=>array('gt', $now), 'circle_id'=>array('in', $circleid_array)))->select();
			if(!empty($nowjoincount_array)){
				$nowjoincount_array = uk86_array_under_reset($nowjoincount_array, 'circle_id');
				Tpl::output('nowjoincount_array', $nowjoincount_array);
			}*/
		}

		//官方圈子及其活动
		$official_list=$model->table('circle')->field('circle_id')->where(array('circle_status'=>1,'is_official'=>1))->select();
		if(!empty($official_list)){
			$arr=array();
			foreach($official_list as $official){
				array_push($arr,intval($official['circle_id']));
			}

			$condition['is_closed']=0;
			$condition['has_affix']=1;
			$condition['circle_id']=array("in",$arr);
			$condition['is_shut']=0;
			$official_theme_list=$model->table('circle_theme')->where($condition)->limit(8)->order('theme_addtime desc')->select();
			if(!empty($official_theme_list)){
				foreach($official_theme_list as $key=>$official_theme){
					$affix=$model->table('circle_affix')->where(array('theme_id'=>$official_theme['theme_id'],'affix_type'=>1))->find();
					$official_theme_list[$key]['affix']=$affix;
					unset($affix);
				}
			}
			Tpl::output('official_theme_list',$official_theme_list);

		}
		// 圈子分类
		$class_list = $model->table('circle_class')->where(array('class_status'=>1, 'is_recommend'=>1))->order('class_sort asc')->select();
		Tpl::output('class_list', $class_list);

		// 推荐圈子
		$rcircle_list = $model->table('circle')->field('*, is_recommend*rand() as rand')->where(array('circle_status'=>1, 'is_recommend'=>1,'is_official'=>0))->order('rand desc')->limit('20')->select();
		Tpl::output('rcircle_list', $rcircle_list);

		// 推荐话题
		$theme_list = $model->table('circle_theme')->field('*, is_recommend*rand() as rand')->where(array('has_affix'=>1, 'is_closed'=>0, 'is_recommend'=>1,'is_official'=>0))->order('rand desc')->limit(8)->select();
		if(!empty($theme_list)){
			$theme_list = uk86_array_under_reset($theme_list, 'theme_id'); $themeid_array = array_keys($theme_list);

			// 附件
			$affix_list = $model->table('circle_affix')->where(array('theme_id'=>array('in', $themeid_array), 'affix_type'=>1))->group('theme_id')->select();
			if(!empty($affix_list)) $affix_list = uk86_array_under_reset($affix_list, 'theme_id');


			foreach ($theme_list as $key=>$val){
				if(isset($affix_list[$val['theme_id']])) $theme_list[$key]['affix'] = uk86_themeImageUrl($affix_list[$val['theme_id']]['affix_filethumb']);
			}

			Tpl::output('theme_list', $theme_list);
		}

		// 商品话题
		$gtheme_list = $model->table('circle_theme')->where(array('has_goods'=>1, 'is_closed'=>0))->order('theme_id desc')->limit(6)->select();
		//var_dump($gtheme_list);
		if(!empty($gtheme_list)){
			$gtheme_list = uk86_array_under_reset($gtheme_list, 'theme_id'); $themeid_array = array_keys($gtheme_list);

			// 圈子商品
			$thg_list = $model->table('circle_thg')->where(array('theme_id'=>array('in', $themeid_array), 'reply_id'=>0))->select();
			$thg_list = tidyThemeGoods($thg_list, 'theme_id', 2);
			Tpl::output('thg_list', $thg_list);
			//var_dump($thg_list);
			Tpl::output('gtheme_list', $gtheme_list);
		}

		// 优秀成员
		$member_list = $model->table('circle_member')->field('*, is_recommend*rand() as rand')->where(array('is_recommend'=>1))->order('rand desc')->limit(5)->select();

		if(!empty($member_list)){
			$member_list = array_reverse($member_list);
			$one_member  = array_pop($member_list);
			$where = array();
			$where['member_id']	= $one_member['member_id'];
			$where['circle_id']	= $one_member['circle_id'];
			$one_membertheme = $model->table('circle_theme')->where($where)->order('theme_id desc')->limit(4)->select();
			Tpl::output('one_member', $one_member);
			Tpl::output('one_membertheme', $one_membertheme);

			if(!empty($member_list)){
				$where = '';
				foreach ($member_list as $val){
					$where .= '( circle_member.member_id = '.$val['member_id'].' and circle_member.circle_id = '.$val['circle_id'].') or ';
				}
				$where = rtrim($where, 'or ');
				$more_membertheme = $model->table('circle_member,circle_theme')->join('inner')->on('circle_member.member_id = circle_theme.member_id and circle_member.circle_id = circle_theme.circle_id')
						->where($where)->group('circle_member.member_id,circle_member.circle_id')->select();
				Tpl::output('more_membertheme', $more_membertheme);
			}
		}

		// 最新话题/热门话题/人气回复
		$this->themeTop();

		//有附件图片的热门话题(非官方）
		$hot_theme_list_with_img=$model->table('circle_theme')->where(array('is_closed'=>0,'has_affix'=>1,'is_official'=>0))->limit(5)->order('theme_browsecount desc')->select();
		if(!empty($hot_theme_list_with_img)){
			$hot_theme_list_with_img = uk86_array_under_reset($hot_theme_list_with_img, 'theme_id'); $themeid_array2 = array_keys($hot_theme_list_with_img);
			// 附件
			$affix_list2 = $model->table('circle_affix')->where(array('theme_id'=>array('in', $themeid_array2), 'affix_type'=>1))->group('theme_id')->select();
			if(!empty($affix_list2)) $affix_list2 = uk86_array_under_reset($affix_list2, 'theme_id');

			foreach ($hot_theme_list_with_img as $key=>$val){
				if(isset($affix_list2[$val['theme_id']])) $hot_theme_list_with_img[$key]['affix'] = uk86_themeImageUrl($affix_list2[$val['theme_id']]['affix_filethumb']);
			}

			Tpl::output('hot_theme_list_with_img', $hot_theme_list_with_img);
		}
		//无附件图片的热门话题（非官方）
		$hotThemeListWithoutImg=$model->table('circle_theme')->where(array('is_closed'=>0,'has_affix'=>0,'is_official'=>0))->limit(6)->order('theme_browsecount desc')->select();
		Tpl::output('hot_theme_list_without_img',$hotThemeListWithoutImg);
		//var_dump($hotThemeListWithoutImg);
		// 首页幻灯
		$loginpic = unserialize(C('circle_loginpic'));
		Tpl::output('loginpic', $loginpic);

		$this->circleSEO();
		Tpl::setLayout('null_layout');
		Tpl::showpage('circle_index');
	}
	/**
	 * 创建圈子
	 */
	public function add_groupOp(){
		if($_SESSION['is_login'] != 1){
			@header('location: '.SHOP_SITE_URL.'/index.php?act=login&ref_url='.getRefUrl());
		}
		if(!intval(C('circle_iscreate'))){
			uk86_showMessage(L('circle_grooup_not_create'), '', '', 'error');
		}
		$model = Model();
		// 在验证
		// 允许创建圈子验证
		$where = array();
		$where['circle_masterid'] = $_SESSION['member_id'];
		$create_count = $model->table('circle')->where($where)->count();
		if(intval($create_count) >= C('circle_createsum')) showDialog(L('circle_create_max_error'));

		// 允许加入圈子验证
		$where = array();
		$where['member_id']	= $_SESSION['member_id'];
		$join_count = $model->table('circle_member')->where($where)->count();
		if(intval($join_count) >= C('circle_joinsum')) showDialog(L('circle_join_max_error'));

		if(uk86_chksubmit()){
			/**
			 * 验证
			 */
			$obj_validate = new Uk86Validate();
			$obj_validate->validateparam = array(
					array("input"=>$_POST["c_name"], "require"=>"true", "message"=>L('circle_name_not_null'))
			);
			$error = $obj_validate->uk86_validate();
			if($error != ''){
				showDialog($error);
			}else{
				$insert = array();
				$insert['circle_name']			= $_POST['c_name'];
				$insert['circle_masterid']		= $_SESSION['member_id'];
				$insert['circle_mastername']	= $_SESSION['member_name'];
				$insert['circle_desc']			= $_POST['c_desc'];
				$insert['circle_tag']			= $_POST['c_tag'];
				$insert['circle_pursuereason']	= $_POST['c_pursuereason'];
				$insert['circle_status']		= 2;
				$insert['is_recommend']			= 0;
				$insert['class_id']				= intval($_POST['class_id']);
				$insert['circle_addtime']		= time();
				$insert['circle_mcount']		= 1;
				$result = $model->table('circle')->insert($insert);
				if($result){
					// Membership level information
					$data = uk86_rkcache('circle_level') ? uk86_rkcache('circle_level') : uk86_rkcache('circle_level', true);

					// 把圈主信息加入圈子会员表
					$insert = array();
					$insert['member_id']	= $_SESSION['member_id'];
					$insert['circle_id']	= $result;
					$insert['circle_name']	= $_POST['c_name'];
					$insert['member_name']	= $_SESSION['member_name'];
					$insert['cm_applytime']	= $insert['cm_jointime'] = time();
					$insert['cm_state']		= 1;
					$insert['cm_level']		= $data[1]['mld_id'];
					$insert['cm_levelname']	= $data[1]['mld_name'];
					$insert['cm_exp']		= 1;
					$insert['cm_nextexp']	= $data[2]['mld_exp'];
					$insert['is_identity']	= 1;
					$insert['cm_lastspeaktime'] = '';
					$model->table('circle_member')->insert($insert);

					showDialog(L('nc_common_op_succ'),'index.php?act=group&c_id='.$result, 'succ');
				}else{
					showDialog(L('nc_common_op_fail'));
				}
			}
		}
		Tpl::output('create_count', $create_count);
		Tpl::output('join_count', $join_count);

		// 圈子分类
		$class_list = $model->table('circle_class')->where(array('class_status'=>1))->order('class_sort asc')->select();
		Tpl::output('class_list', $class_list);

		$this->circleSEO(L('circle_create'));
		Tpl::showpage('group_add');
	}
	/**
	 * 我加入的圈子
	 */
	public function myjoinedcircleOp(){
		$model = Model('circle_member');

		$cm_list = $model->getCircleMemberList(array('member_id'=>$_SESSION['member_id'], 'circle_id' => array('neq', 0)),'circle_id,circle_name,is_identity', 0, 'is_identity asc');
		if (empty($cm_list)) {
			echo false;die;
		}
		if (strtoupper(CHARSET) == 'GBK'){
		    $cm_list = Uk86Language::uk86_getUTF8($cm_list);
		}
		echo json_encode($cm_list);
	}
	/**
	 * 圈子名称验证
	 */
	public function check_circle_nameOp(){
		$name = $_GET['name'];
		if (strtoupper(CHARSET) == 'GBK'){
			$name = Uk86Language::uk86_getGBK($name);
		}
		$rs = Model()->table('circle')->where(array('circle_name'=>$name))->find();
		if (!empty($rs)){
			echo 'false';
		}else{
			echo 'true';
		}
	}
}
