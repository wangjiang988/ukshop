<?php
/**
 * 圈子话题管理
 *
 *
 *
 **by Uk86 商城开发*/

defined('InUk86') or exit('Access Invalid!');
class circle_themeControl extends SystemControl{
	public function __construct(){
		parent::__construct();
		Uk86Language::uk86_read('circle');
	}
	/**
	 * 话题列表
	 */
	public function theme_listOp(){

		$model = Model();
		if (uk86_chksubmit()){
			if (!empty($_POST['check_theme_id']) && is_array($_POST['check_theme_id'])){
				foreach ($_POST['check_theme_id'] as $t_id){
					$theme_info = $model->table('circle_theme')->where(array('theme_id'=>$t_id))->find();
					if(empty($theme_info)){
						continue;
					}

					// 删除附件
					$affix_list = $model->table('circle_affix')->where(array('theme_id'=>$t_id))->select();
					if(!empty($affix_list)){
						foreach ($affix_list as $val){
							@unlink(uk86_themeImagePath($val['affix_filename']));
							@unlink(uk86_themeImagePath($val['affix_filethumb']));
						}
						$model->table('circle_affix')->where(array('theme_id'=>$t_id))->delete();
					}

					// 删除商品
					$model->table('circle_thg')->where(array('theme_id'=>$t_id))->delete();

					// 删除赞表相关
					$model->table('circle_like')->where(array('theme_id'=>$t_id))->delete();

					// 删除回复
					$model->table('circle_threply')->where(array('theme_id'=>$t_id))->delete();

					// 更新圈子主题数量
					$model->table('circle')->update(array('circle_id'=>$theme_info['circle_id'], 'circle_thcount'=>array('exp','circle_thcount-1')));

					// The recycle bin add delete records
					$param = array();
					$param['theme_id']	= $t_id;
					$param['op_id']		= 0;
					$param['op_name']	= L('cirlce_administrator');
					$param['type']		= 'admintheme';
					Model('circle_recycle')->saveRecycle($param, $theme_info);

					// 删除话题
					$model->table('circle_theme')->delete($t_id);

					// Experience
					if(intval($theme_info['theme_exp']) > 0){
						$param = array();
						$param['member_id']		= $theme_info['member_id'];
						$param['member_name']	= $theme_info['member_name'];
						$param['circle_id']		= $theme_info['circle_id'];
						$param['itemid']		= $t_id;
						$param['type']			= 'delRelease';
						$param['exp']			= $theme_info['theme_exp'];
						Model('circle_exp')->saveExp($param);
					}
				}
			}
			uk86_showMessage(L('nc_common_op_succ'), 'index.php?act=circle_theme&op=theme_list');
		}
		$where = array();
		if($_GET['searchname'] != ''){
			$where['theme_name'] = array('like', '%'.$_GET['searchname'].'%');
		}
		if($_GET['classname'] != ''){
			$where['circle_name'] = array('like', '%'.$_GET['classname'].'%');
		}
		if($_GET['searchtop'] != '' && in_array($_GET['searchtop'], array(0,1))){
			$where['is_stick'] = intval($_GET['searchtop']);
		}
		if($_GET['searchcream'] != '' && in_array($_GET['searchcream'], array(0,1))){
			$where['is_digest']	= intval($_GET['searchcream']);
		}
		if($_GET['searchrecommend'] != '' && in_array($_GET['searchrecommend'], array(0,1))){
			$where['is_recommend'] = intval($_GET['searchrecommend']);
		}
		$theme_list	= $model->table('circle_theme')->where($where)->order('theme_id desc')->page(10)->select();
		if(!empty($theme_list)){
			$theme_list = uk86_array_under_reset($theme_list, 'theme_id'); $themeid_array = array_keys($theme_list);

			// 附件
			$affix_list = $model->table('circle_affix')->where(array('theme_id'=>array('in', $themeid_array), 'affix_type'=>1))->group('theme_id')->select();
			if(!empty($affix_list)) $affix_list = uk86_array_under_reset($affix_list, 'theme_id');


			foreach ($theme_list as $key=>$val){
				if(isset($affix_list[$val['theme_id']])) $theme_list[$key]['affix'] = uk86_themeImageUrl($affix_list[$val['theme_id']]['affix_filethumb']);
			}
		}
		Tpl::output('theme_list', $theme_list);
		Tpl::output('page', $model->showpage(2));
		Tpl::showpage('circle_theme.list');
	}
	/**
	 * 话题详细
	 */
	public function theme_infoOp(){
		$model = Model();
		$t_id = intval($_GET['t_id']);
		$theme_info = $model->table('circle_theme')->find($t_id);
		Tpl::output('theme_info', $theme_info);

		if($theme_info['theme_special'] == 1){
			$poll_info = $model->table('circle_thpoll')->find($t_id);
			$option_list = $model->table('circle_thpolloption')->where(array('theme_id'=>$t_id))->order('pollop_sort asc')->select();
			Tpl::output('poll_info', $poll_info);
			Tpl::output('option_list', $option_list);
		}
		Tpl::showpage('circle_theme.info');
	}
	/**
	 * 删除话题
	 */
	public function theme_delOp(){
		$model = Model();
		// 验证话题
		$t_id = intval($_GET['t_id']); $c_id = intval($_GET['c_id']);
		$theme_info = $model->table('circle_theme')->where(array('theme_id'=>$t_id, 'circle_id'=>$c_id))->find();
		if(empty($theme_info)){
			uk86_showMessage(L('param_error'));
		}

		// 删除附件
		$affix_list = $model->table('circle_affix')->where(array('theme_id'=>$t_id))->select();
		if(!empty($affix_list)){
			foreach ($affix_list as $val){
				@unlink(uk86_themeImagePath($val['affix_filename']));
				@unlink(uk86_themeImagePath($val['affix_filethumb']));
			}
			$model->table('circle_affix')->where(array('theme_id'=>$t_id))->delete();
		}

		// 删除商品
		$model->table('circle_thg')->where(array('theme_id'=>$t_id))->delete();

		// 删除赞表相关
		$model->table('circle_like')->where(array('theme_id'=>$t_id))->delete();

		// 删除回复
		$model->table('circle_threply')->where(array('theme_id'=>$t_id))->delete();

		// The recycle bin add delete records
		$param = array();
		$param['theme_id']	= $t_id;
		$param['op_id']		= 0;
		$param['op_name']	= L('cirlce_administrator');
		$param['type']		= 'admintheme';
		Model('circle_recycle')->saveRecycle($param, $theme_info);

		// 删除话题
		$model->table('circle_theme')->delete($t_id);

		// 更新圈子主题数量
		$model->table('circle')->update(array('circle_id'=>$c_id, 'circle_thcount'=>array('exp','circle_thcount-1')));

		// Experience
		if(intval($theme_info['theme_exp']) > 0){
			$param = array();
			$param['member_id']		= $theme_info['member_id'];
			$param['member_name']	= $theme_info['member_name'];
			$param['circle_id']		= $theme_info['circle_id'];
			$param['itemid']		= $t_id;
			$param['type']			= 'delRelease';
			$param['exp']			= $theme_info['theme_exp'];
			Model('circle_exp')->saveExp($param);
		}

		uk86_showMessage(L('nc_common_op_succ'), 'index.php?act=circle_theme&op=theme_list');
	}
	/**
	 * 话题回复
	 */
	public function theme_replyOp(){
		$model = Model();
		if(uk86_chksubmit()){
			$t_id = intval($_POST['t_id']);
			if (!empty($_POST['check_reply_id']) && is_array($_POST['check_reply_id'])){
				foreach ($_POST['check_reply_id'] as $r_id){
					// 验证回复
					$reply_info = $model->table('circle_threply')->where(array('theme_id'=>$t_id, 'reply_id'=>$r_id))->find();
					if(empty($reply_info)){
						uk86_showMessage(L('param_error'));
					}

					// 删除附件
					$affix_list = $model->table('circle_affix')->where(array('affix_type'=>2, 'theme_id'=>$t_id, 'reply_id'=>$r_id))->select();
					if(!empty($affix_list)){
						foreach ($affix_list as $val){
							@unlink(uk86_themeImagePath($val['affix_filename']));
							@unlink(uk86_themeImagePath($val['affix_filethumb']));
						}
						$model->table('circle_affix')->where(array('affix_type'=>2 ,'theme_id'=>$t_id, 'reply_id'=>$r_id))->delete();
					}

					// 删除商品
					$model->table('circle_thg')->where(array('theme_id'=>$t_id, 'reply_id'=>$r_id))->delete();

					// The recycle bin add delete records
					$param = array();
					$param['theme_id']	= $t_id;
					$param['reply_id']	= $r_id;
					$param['op_id']		= 0;
					$param['op_name']	= L('cirlce_administrator');
					$param['type']		= 'adminreply';
					Model('circle_recycle')->saveRecycle($param, $reply_info);

					// 删除回复
					$model->table('circle_threply')->where(array('theme_id'=>$t_id, 'reply_id'=>$r_id))->delete();

					// 更新话题回复数
					$model->table('circle_theme')->update(array('theme_id'=>$t_id, 'theme_commentcount'=>array('exp', 'theme_commentcount-1')));
					// Experience
					if(intval($reply_info['reply_exp']) > 0){
						$param = array();
						$param['member_id']		= $reply_info['member_id'];
						$param['member_name']	= $reply_info['member_name'];
						$param['circle_id']		= $reply_info['circle_id'];
						$param['itemid']		= $t_id.','.$r_id;
						$param['type']			= 'delReplied';
						$param['exp']			= $reply_info['reply_exp'];
						Model('circle_exp')->saveExp($param);
					}
				}
			}

			uk86_showMessage(L('nc_common_op_succ'));
		}
		$t_id = intval($_GET['t_id']);
		$reply_list = $model->table('circle_threply')->where(array('theme_id'=>$t_id))->page(10)->select();
		Tpl::output('t_id', $t_id);
		Tpl::output('page', $model->showpage(2));
		Tpl::output('reply_list', $reply_list);
		Tpl::showpage('circle_theme.reply');
	}
	/**
	 * 话题回复删除
	 */
	public function theme_replydelOp(){
		$t_id = intval($_GET['t_id']);
		$r_id = intval($_GET['r_id']);
		$model = Model();
		// 验证回复
		$reply_info = $model->table('circle_threply')->where(array('theme_id'=>$t_id, 'reply_id'=>$r_id))->find();
		if(empty($reply_info)){
			uk86_showMessage(L('param_error'));
		}

		// 删除附件
		$affix_list = $model->table('circle_affix')->where(array('affix_type'=>2, 'theme_id'=>$t_id, 'reply_id'=>$r_id))->select();
		if(!empty($affix_list)){
			foreach ($affix_list as $val){
				@unlink(uk86_themeImagePath($val['affix_filename']));
				@unlink(uk86_themeImagePath($val['affix_filethumb']));
			}
			$model->table('circle_affix')->where(array('affix_type'=>2 ,'theme_id'=>$t_id, 'reply_id'=>$r_id))->delete();
		}

		// 删除商品
		$model->table('circle_thg')->where(array('theme_id'=>$t_id, 'reply_id'=>$r_id))->delete();

		// The recycle bin add delete records
		$param = array();
		$param['theme_id']	= $t_id;
		$param['reply_id']	= $r_id;
		$param['op_id']		= 0;
		$param['op_name']	= L('cirlce_administrator');
		$param['type']		= 'adminreply';
		Model('circle_recycle')->saveRecycle($param, $reply_info);

		// 删除回复
		$model->table('circle_threply')->where(array('theme_id'=>$t_id, 'reply_id'=>$r_id))->delete();

		// 更新话题回复数
		$model->table('circle_theme')->update(array('theme_id'=>$t_id, 'theme_commentcount'=>array('exp', 'theme_commentcount-1')));
		// Experience
		if(intval($reply_info['reply_exp']) > 0){
			$param = array();
			$param['member_id']		= $reply_info['member_id'];
			$param['member_name']	= $reply_info['member_name'];
			$param['circle_id']		= $reply_info['circle_id'];
			$param['itemid']		= $t_id.','.$r_id;
			$param['type']			= 'delReplied';
			$param['exp']			= $reply_info['reply_exp'];
			Model('circle_exp')->saveExp($param);
		}
		uk86_showMessage(L('nc_common_op_succ'));
	}
	/**
	 * ajax操作
	 */
//	public function ajaxOp(){
//		switch ($_GET['branch']){
//			case 'recommend':
//				$update = array(
//					'theme_id'=>intval($_GET['id']),
//					$_GET['column']=>$_GET['value']
//				);
//				Model()->table('circle_theme')->update($update);
//				echo 'true';
//				break;
//		}
//	}

	/**
	 *圈子话题分类列表
	 */
	public function theme_class_listOp(){
		$model = Model();
		if(uk86_chksubmit()){
			// 批量删除
			if($_POST['submit_type'] == 'batchdel'){
				$id_array	=$_POST['check_class_id'];
				if(empty($id_array) && !is_array($id_array)) {
					uk86_showMessage("请选择一个分类");
				}
				$where = array('thclass_id'=>array('in',$id_array));
				$model->table('circle_thclass_list')->where($where)->delete();
				uk86_showMessage("操作成功");
			}
		}
		$where = array();
		//var_dump($_GET['searchname']);
		if(trim($_GET['searchname']) != ''){
			$where['thclass_name']		= array('like', '%'.trim($_GET['searchname']).'%');
		}
		if(trim($_GET['searchstatus']) != ''){
			$where['thclass_status']		= intval($_GET['searchstatus']);
		}
		$class_list = $model->table('circle_thclass_list')->where($where)->order('class_sort asc')->select();
		Tpl::output('class_list', $class_list);
		Tpl::showpage('circle_theme_class.list');
	}

	/**
	 * 分类删除操作
	 */
	public function class_delOp(){
		$thclassid=$_GET["thclassid"];
		$where = array('thclass_id'=>$thclassid);
		Model('circle_thclass_list')->where($where)->delete();
		uk86_showMessage("删除成功");
	}

	/**
	 * ajax操作
	 */
	public function ajaxOp(){
		switch ($_GET['branch']){
			case 'recommend':
				$update = array(
					'theme_id'=>intval($_GET['id']),
					$_GET['column']=>$_GET['value']
				);
				Model()->table('circle_theme')->update($update);
				echo 'true';
				break;
			case 'status':
			case 'sort':
			case 'name':
				$update = array(
					'thclass_id'=>intval($_GET['id']),
					$_GET['column']=>intval($_GET['value'])
				);
				//var_dump($update);
				$condition['thclass_id']=intval($_GET['id']);
				if(Model()->table('circle_thclass_list')->where($condition)->update($update)){
					echo 'true';
				}else{
					echo 'false';
				}

				break;
		}
	}

	/**
	 * 圈子话题分类添加
	 */
	public function theme_class_addOp(){
		$model = Model();
		if(uk86_chksubmit()){
			/**
			 * 验证
			 */
			$obj_validate = new Uk86Validate();
			$obj_validate->validateparam = array(
				array("input"=>$_POST["class_name"], "require"=>"true", "message"=>L('circle_class_name_not_null')),
				array("input"=>$_POST["class_sort"], "require"=>"true", 'validator'=>'Number', "message"=>L('circle_class_sort_is_number')),
			);
			$error = $obj_validate->uk86_validate();
			if($error != ''){
				uk86_showMessage($error);
			}else{
				$insert = array();
				$insert['thclass_name']		= trim($_POST['class_name']);
				$insert['class_sort']		= intval($_POST['class_sort']);
				$insert['thclass_status']		= intval($_POST['status']);
				$result = $model->table('circle_thclass_list')->insert($insert);
				if($result){
					$url = array(
						array(
							'url'=>'index.php?act=circle_theme&op=theme_class_add',
							'msg'=>L('circle_continue_add'),
						),
						array(
							'url'=>'index.php?act=circle_theme&op=theme_class_list',
							'msg'=>L('circle_return_list'),
						)
					);
					uk86_showMessage(L('nc_common_op_succ'),$url);
				}else{
					uk86_showMessage(L('nc_common_op_fail'));
				}
			}
		}
		// 商品分类
		//$gc_list = Model('goods_class')->getGoodsClassListByParentId(0);
		//Tpl::output('gc_list', $gc_list);

		Tpl::showpage('circle_theme_class.add');
	}

	/**
	 * 圈子话题分类编辑
	 */
	public function theme_class_editOp(){
		$model = Model();
		if(uk86_chksubmit()){
			/**
			 * 验证
			 */
			$obj_validate = new Uk86Validate();
			$obj_validate->validateparam = array(
				array("input"=>$_POST["class_name"], "require"=>"true", "message"=>L('circle_class_name_not_null')),
				array("input"=>$_POST["class_sort"], "require"=>"true", 'validator'=>'Number', "message"=>L('circle_class_sort_is_number')),
			);
			$error = $obj_validate->uk86_validate();
			if($error != ''){
				uk86_showMessage($error);
			}else{
				$update = array();
				$condition['thclass_id']		= intval($_POST['class_id']);
				$update['thclass_name']	= trim($_POST['class_name']);
				$update['class_sort']	= intval($_POST['class_sort']);
				$update['thclass_status']	= intval($_POST['status']);
				$result = $model->table('circle_thclass_list')->where($condition)->update($update);
				if($result){
					uk86_showMessage(L('nc_common_op_succ'),'index.php?act=circle_theme&op=theme_class_list');
				}else{
					uk86_showMessage(L('nc_common_op_fail'));
				}
			}
		}
		$id = intval($_GET['classid']);
		if($id <= 0){
			uk86_showMessage(L('param_error'));
		}
		$thclassid['thclass_id']=$id;
		$class_info = $model->table('circle_thclass_list')->where($thclassid)->find();
        //var_dump($class_info);
		Tpl::output('class_info', $class_info);
		// 商品分类
		//$gc_list = Model('goods_class')->getGoodsClassListByParentId(0);
		//Tpl::output('gc_list', $gc_list);

		Tpl::showpage('circle_theme_class.edit');
	}
}
