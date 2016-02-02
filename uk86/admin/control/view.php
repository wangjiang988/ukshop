<?php
/**
 * 账号同步
 *
 *
 *
 **by Uk86 商城开发*/

defined('InUk86') or exit('Access Invalid!');
class viewControl extends SystemControl{
	
	public function __construct(){
		parent::__construct();
		Uk86Language::uk86_read('view');
	}
/**
	 * 所有全景制作列表
	 *
	 */ 
	public function viewlistOp(){

		$model_view	= Model('view');
		if (uk86_chksubmit()){
			if (is_array($_POST['del_id']) && !empty($_POST['del_id'])){
				$model_upload = Model('upload');
				foreach ($_POST['del_id'] as $k => $v){
					
					$model_view->del($v);
				}
				$this->log(L('article_index_del_succ').'[ID:'.implode(',',$_POST['del_id']).']',null);
				uk86_showMessage($lang['article_index_del_succ']);
			}else {
				uk86_showMessage($lang['article_index_choose']);
			}
		}
		/**
		 * 检索条件
		 */
		$condition['ac_id'] = intval($_GET['search_ac_id']);
		$condition['like_title'] = trim($_GET['search_title']);
		/**
		 * 分页
		 */
		$page	= new Uk86Page();
		$page->uk86_setEachNum(10);
		$page->uk86_setStyle('admin');
		/**
		 * 列表
		 */
		$view_list = $model_view->getViewList($condition,$page);
		/**
		 * 整理列表内容
		 */
		 if(!empty($view_list)){
		foreach ($view_list as $k => $v){
				/**
				 * 发布时间
				 */
				$view_list[$k]['view_time'] = date('Y-m-d H:i:s',$v['article_time']);			}
		
		}
		Tpl::output('view_list',$view_list);
		Tpl::output('search_ac_id',intval($_GET['search_ac_id']));
		Tpl::showpage('viewlist');
	}
	/*
	新增全景
	*/
	public function view_addOp(){
	    $lang	= Uk86Language::uk86_getLangContent();
		$model_view = Model('view');
		if (uk86_chksubmit()){
			/**
			 * 验证
			 */
			$obj_validate = new Uk86Validate();
			$obj_validate->validateparam = array(
				array("input"=>$_POST["ac_name"], "require"=>"true", "message"=>$lang['view_add_name_null']),
				array("input"=>$_POST["ac_sort"], "require"=>"true", 'validator'=>'Number', "message"=>$lang['view_add_sort_int']),
			);
			$error = $obj_validate->uk86_validate();
			if ($error != ''){
				uk86_showMessage($error);
			}else {

				$insert_array = array();
				$insert_array['view_title'] = trim($_POST['ac_name']);
				$insert_array['view_class'] = 'platform';
				$insert_array['view_sort'] = trim($_POST['ac_sort']);
				$insert_array['view_time'] = time();
				$insert_array['view_creator'] = $this->getAdminInfo()['name'];
				$insert_array['view_state'] = '未开通';
				$result = $model_view->add($insert_array);
				if ($result){
				$path = BASE_DATA_PATH.'/upload/'.ATTACH_VIEW.'/platform_'.$result;
				if(!is_dir($path)){
				mkdir($path,0777,true);
				$path = ATTACH_VIEW.'/platform_'.$result;
				$update_array = array();
				$update_array['view_id'] = $result;
				$update_array['view_path'] = $path;
				$model_view->update($update_array);}
					$url = array(
						array(
							'url'=>'index.php?act=view&op=viewlist',
							'msg'=>$lang['view_back_2list'].$path,
						),
						array(
							'url'=>'index.php?act=view&op=view_add',
							'msg'=>$lang['view_add_continue'].$path,
						)
					);
					$this->log(l('nc_add,article_class_index_class').'['.$_POST['ac_name'].']',1);
					uk86_showMessage($lang['article_class_add_succ'],$url);
				}else {
					uk86_showMessage($lang['article_class_add_fail']);
				}
			}
		}
		$model_view	= Model('view');
		$view_list	= $model_view->getList();
		Tpl::output('view_list',$view_list);
		Tpl::showpage('view_add');
	}
	/**
	 * QQ互联
	 */
	 public function view_editOp(){
	 Tpl::showpage('view_detail_list');
	 }
	public function ajaxOp(){
	
	switch ($_GET['branch']){
			/**
			 * 验证是否有重复的名称
			 */ 
				case 'check_class_name':
				$model_class = Model('view');
				$condition['view_title'] = trim($_GET['ac_name']);
				$class_list = $model_class->getOneByName($condition);
				
				if (empty($class_list)){
					echo 'true';exit;
				}else {
					echo 'false';exit;
				}
				break;
				case 'del_file_upload':
				if (intval($_GET['file_id']) > 0){
					$model_upload = Model('upload');
					/**
					 * 删除图片
					 */
					$file_array = $model_upload->getOneUpload(intval($_GET['file_id']));
					@unlink(BASE_UPLOAD_PATH.DS.ATTACH_ARTICLE.DS.$file_array['file_name']);
					/**
					 * 删除信息
					 */
					$model_upload->del(intval($_GET['file_id']));
					echo 'true';exit;
				}else {
					echo 'false';exit;
				}
				break;
	}
	}
	
	
	
	public function view_detail_listOp()
	{
		
		$view_id = $_GET['view_id'];
		$model_detail_view	= Model('viewdetail');
		$view_detail_list	= $model_detail_view->getListByViewId($view_id);
		Tpl::output('view_id',$view_id);
		Tpl::output('view_detail_list',$view_detail_list);
		Tpl::output('search_ac_id',intval($_GET['search_ac_id']));
		Tpl::showpage('view_detail_list');
	}
	
	
	
	
	public function view_detail_addOp()
	{	$view_id = $_GET['view_id'];
		$lang	= Uk86Language::uk86_getLangContent();
		$model_detail = Model('viewdetail');
		$model_view = Model('view');
		$result = $model_view->getOneById($_GET['view_id']);
		
		/**
		 * 保存
		 */
		if (uk86_chksubmit()){
		
			/**
			 * 验证
			 */
			$obj_validate = new Uk86Validate();
			$obj_validate->validateparam = array(
				array("input"=>$_POST["article_title"], "require"=>"true", "message"=>$lang['article_add_title_null']),
				array("input"=>$_POST["ac_id"], "require"=>"true", "message"=>$lang['article_add_class_null']),
				array("input"=>$_POST["article_content"], "require"=>"true", "message"=>$lang['article_add_content_null']),
				array("input"=>$_POST["article_sort"], "require"=>"true", 'validator'=>'Number', "message"=>$lang['article_add_sort_int']),
			);
			$error = $obj_validate->uk86_validate();
			if ($error != ''){
				uk86_showMessage($error);
			}else {

				$insert_array = array();
				$insert_array['viewdetail_title'] = trim($_POST['article_title']);
				$insert_array['view_id'] = intval($_POST['view_id']);
				$insert_array['article_url'] = trim($_POST['article_url']);
				$insert_array['article_show'] = trim($_POST['article_show']);
				$insert_array['article_sort'] = trim($_POST['article_sort']);
				$insert_array['article_content'] = trim($_POST['article_content']);
				$insert_array['article_time'] = time();
				$result = $model_article->add($insert_array);
				if ($result){
					/**
					 * 更新图片信息ID
					 */
					$model_upload = Model('upload');
					if (is_array($_POST['file_id'])){
						foreach ($_POST['file_id'] as $k => $v){
							$v = intval($v);
							$update_array = array();
							$update_array['upload_id'] = $v;
							$update_array['item_id'] = $result;
							$model_upload->update($update_array);
							unset($update_array);
						}
					}

					$url = array(
						array(
							'url'=>'index.php?act=view&op=view_detail_list',
							'msg'=>"{$lang['article_add_tolist']}",
						),
						array(
							'url'=>'index.php?act=view&op=viewdetail_add&view_id='.intval($_POST['view_id']),
							'msg'=>"{$lang['article_add_continueadd']}",
						),
					);
					$this->log(L('article_add_ok').'['.$_POST['article_title'].']',null);
					uk86_showMessage("{$lang['article_add_ok']}",$url);
				}else {
					uk86_showMessage("{$lang['article_add_fail']}");
				}
			}
		}
		/**
		 * 分类列表
		 */
		$model_class = Model('article_class');
		$parent_list = $model_class->getTreeClassList(2);
		if (is_array($parent_list)){
			$unset_sign = false;
			foreach ($parent_list as $k => $v){
				$parent_list[$k]['ac_name'] = str_repeat("&nbsp;",$v['deep']*2).$v['ac_name'];
			}
		}
		/**
		 * 模型实例化
		 */
		$model_upload = Model('upload');
		$condition['upload_type'] = '1';
		$condition['item_id'] = '0';
		$file_upload = $model_upload->getUploadList($condition);
		if (is_array($file_upload)){
			foreach ($file_upload as $k => $v){
				$file_upload[$k]['upload_path'] = UPLOAD_SITE_URL.'/'.ATTACH_ARTICLE.'/'.$file_upload[$k]['file_name'];
			}
		}
		Tpl::output('view_id',$view_id);
		Tpl::output('view_path',$result['view_path']);
		Tpl::output('PHPSESSID',session_id());
		Tpl::output('ac_id',intval($_GET['ac_id']));
		Tpl::output('parent_list',$parent_list);
		Tpl::output('file_upload',$file_upload);
		Tpl::showpage('view_detail_add');
	}
	public function viewdetail_pic_uploadOp(){
		/**
		 * 上传图片
		 */
		
		$upload = new Uk86UploadFile();
		
		$model_view = Model('view');
		$result = $model_view->getOneById($_GET['view_id']);
		
		$upload->uk86_set('default_dir',$result['view_path']);
		$result = $upload->uk86_upfile('fileupload');
		if ($result){
			$_POST['pic'] = $upload->file_name;
			
		}else {
			echo 'error';exit;
		}
		/**
		 * 模型实例化
		 */
		$model_upload = Model('upload');
		/**
		 * 图片数据入库
		 */
		$insert_array = array();
		$insert_array['file_name'] = $_POST['pic'];
		$insert_array['upload_type'] = '1';
		$insert_array['file_size'] = $_FILES['fileupload']['size'];
		$insert_array['upload_time'] = time();
		$insert_array['item_id'] = intval($_POST['item_id']);
		$result = $model_upload->add($insert_array);
		if ($result){
			$data = array();
			$data['file_id'] = $result;
			$data['file_name'] = $_POST['pic'];
			$data['file_path'] = $_POST['pic'];
			/**
			 * 整理为json格式
			 */
			$output = json_encode($data);
			echo $output;
		}

	}
	public function write2xmlOp($path)
	{
	$xml = new XMLWriter();
	$uri = $path.'test.xml';
	$xml->openUri($path);
//  输出方式，也可以设置为某个xml文件地址，直接输出成文件
	$xml->setIndentString('  ');
	$xml->setIndent(true);
 
	$xml->startDocument('1.0');
//  开始创建文件
//  根结点
	$xml->startElement('krpano');
	$xml->writeAttribute('onstart', 'startup();');
	$xml->writeAttribute('version', '1.16');
	$xml->writeAttribute('title', '');

	$xml->startElement('include');
	$xml->writeAttribute('url','skin/vtourskin.xml');//皮肤路径
	$xml->endElement();

	$xml->startElement('skin_settings');
	$xml->writeAttribute('controlbar_offset','20');
	$xml->writeAttribute('tooltips_mapspots','true');
	$xml->writeAttribute('tooltips_hotspots','true');
	$xml->writeAttribute('tooltips_thumbs','true');
	$xml->writeAttribute('thumbs_scrollindicator','false');
	$xml->writeAttribute('thumbs_scrollbuttons','false');
	$xml->writeAttribute('thumbs_onhoverscrolling','false');
	$xml->writeAttribute('thumbs_draggin','true');
	$xml->writeAttribute('thumbs_text','true');
	$xml->writeAttribute('thumbs_opened','true');
	$xml->writeAttribute('thumbs_crop','0|40|240|160');
	$xml->writeAttribute('thumbs_padding','10');
	$xml->writeAttribute('thumbs_height','80');
	$xml->writeAttribute('thumbs_width','120');
	$xml->writeAttribute('gyro','true');
	$xml->writeAttribute('bingmaps_zoombuttons','false');
	$xml->writeAttribute('bingmaps_key','');
	$xml->writeAttribute('bingmaps','false');
	$xml->endElement();

	$xml->startElement('layer');
	$xml->writeAttribute('url','');
	$xml->writeAttribute('opened_onclick','openurl(\'...\',_blank);');
	$xml->writeAttribute('scale','0.25');
	$xml->writeAttribute('name','skin_logo');
	$xml->endElement();

	$xml->startElement('action');
	$xml->writeAttribute('namae','startup');
	$xml->text('if(startscene === null, copy(startscene,scene[0].name)); loadscene(get(startscene), null, MERGE);');
	$xml->endElement();

	write_sence($xml);

	$xml->endElement(); //  article
	$xml->endDocument();
 
	$xml->flush();

	}
	public function write_senceOp($xml)
	{
	$xml->startElement('sence');
	$xml->writeAttribute('title','xuanguan');//title设置
	$xml->writeAttribute('onstart','');
	$xml->writeAttribute('name','sence_1');//场景名称
	$xml->writeAttribute('heading','');
	$xml->writeAttribute('lng','');
	$xml->writeAttribute('lat','');
	$xml->writeAttribute('thumburl','panos/1.tiles/thumb.jpg');//预览图设置
	
	$xml->startElement('view');
	$xml->writeAttribute('limitview','auto');
	$xml->writeAttribute('fovmax','140');
	$xml->writeAttribute('fovmin','70');
	$xml->writeAttribute('maxpixelzoom','2.0');
	$xml->writeAttribute('fov','120.000');
	$xml->writeAttribute('fovtype','MFOV');
	$xml->writeAttribute('vlookat','3.273');
	$xml->writeAttribute('hlookat','-125.515');
	$xml->endElement();
	
	$xml->startElement('preview');
	$xml->writeAttribute('url','panos/1.tiles/preview.jpg');//预览图设置
	$xml->endElement();
	
	$xml->startElement('image');
	
	$xml->startElement('cube');
	$xml->writeAttribute('url','panos/1.tiles/panos_%s.jpg');//全景图片
	$xml->endElement();
	
	$xml->startElement('mobile');
	
	$xml->startElement('cube');
	$xml->writeAttribute('url','panos/1.tiles/panos_%s.jpg');
	$xml->endElement();
	
	$xml->endElement();//mobile
	
	$xml->endElement();//image
	
	
	
	$xml->endElement();
	}
	public function xmldata($view_id)
	{
	$model_detail = Model('viewdetail');
	$viewdetail_list = $model_detail->getListById($view_id);
	$data = array();
	for($i=0;$i<$viewdetail_list.count();$i++)
	{
		$data[$i]['sence_id'] = $viewdetail_list[$i]['view_detail_sort'];
		$data[$i]['sence_node'] = $viewdetail_list[$i]['view_detail_node'];
	}
	return $data;
	}
}

