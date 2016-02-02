<?php
/**
 * 手机端cms
 * @author ZHUXUESONG
 *
 */
defined('InUk86') or exit('Access Invalid!');

class wap_cmsControl extends BaseWapControl{
	
	/**
	 * cms首页列表
	 */
	public function indexOp(){
		header('Content-type:text/html; charset=utf-8');
		$model = Model();
		//文章分类列表
		$article_class = $model->table('cms_article_class')->where(true)->field('class_id, class_name')->order('class_sort asc')->select();
		//所有文章
		$condition = array();
		$condition['article_state'] = 3;
		$field = 'article_id, article_title, article_class_id, article_abstract, article_image, article_attachment_path, article_click, article_share_count';
 		$article = $model->table('cms_article')->where($condition)->field($field)->order('article_modify_time desc, article_sort asc')->select();
 		//如果文章有开始和结束时间，对其进行过滤
 		foreach ($article as $k => $v){
 			if(!empty($v['article_start_time']) && $v['article_start_time'] > time()){
 				unset($article[$k]);
 			}
 			if(!empty($v['article_end_time']) && $v['article_end_time'] <= time()){
 				unset($article[$k]);
 			}
 		}
		Tpl::output('all_article', $article);
		//文章分类显示
		$article_other = array();
		foreach($article_class as $c_val){
			foreach ($article as $a_val){
				if($a_val['article_class_id'] == $c_val['class_id']){
					$article_other[$c_val['class_id']][] = $a_val;
				}
			}
		}
		//过滤没有文章的分类
		foreach ($article_class as $key => $val){
			if(empty($article_other[$val['class_id']]) || !is_array($article_other[$val['class_id']])){
				unset($article_class[$key]);
			}
		}
		Tpl::output('article_class', $article_class);
		Tpl::output('article_other', $article_other);
		Tpl::showpage('cms_article.index');
	}
	
	/**
	 * 文章搜索
	 */
	public function searchOp(){
		$keyword = trim($_GET['keyword']);
		if($keyword == ''){
			$this->wap_showDialog('请输入搜索关键字');
		}
		$field = 'article_id, article_title, article_class_id, article_abstract, article_image, article_attachment_path, article_click, article_share_count';
		$condition = 'article_state = 3 and (article_title like "%'.$keyword.'%" or article_abstract like "%'.$keyword.'%" or article_title_short like "%'.$keyword.'%")';
		$list = Model('cms_article')->where($condition)->field($field)->order('article_commend_flag desc, article_sort asc')->select();
		Tpl::output('all_article', $list);
		Tpl::showpage('cms_article.search');
	}
	
	/**
	 * 咨询文章页
	 */
	public function article_infoOp(){
		$article_id = intval($_GET['article_id']);
		//文章浏览数量+1
		Model('cms_article')->where(array('article_id' => $article_id))->setInc('article_click', 1);
		$article_info = Model('cms_article')->where(array('article_id' => $article_id))->field('*')->find();
		Tpl::output('info', $article_info);
		//获取评论
		$field = 'comment_id, comment_message, comment_member_id, comment_time, comment_up';
		$condition = array();
		$condition['comment_type'] = 1;
		$condition['comment_object_id'] = $article_id;
	//	$condition['comment_quote'] = NULL;
		$comment = Model()->table('cms_comment')->where($condition)->field($field)->order('comment_time desc')->select();
		Tpl::output('comment', $comment);
		Tpl::showpage('cms_article.info');
	}
	
	/**
	 * 顶某一条评论
	 */
	public function comment_upOp(){
		if($this->checkMemberLogin()){
			$comment_id = intval($_GET['comment_id']);
			if(empty($comment_id)){
				exit(json_encode(array('state' => false, 'url' => false)));
			}
			$comment_up_model = Model('cms_comment_up');
			//判断会员是否已经赞过该评论
			$relult = $comment_up_model->where(array('comment_id' => $comment_id, 'up_member_id' => $_SESSION['member_id']))->field('up_id')->find();
			if(!empty($relult['up_id'])){
				exit(json_encode(array('state' => false, 'url' => false)));
			}
			//插入数据库
			$insert = array();
			$insert['comment_id'] = $comment_id;
			$insert['up_member_id'] = intval($_SESSION['member_id']);
			$insert['up_time'] = time();
			$relult1 = $comment_up_model->insert($insert);
			if($relult1){
				//评论顶数量+1
				Model()->table('cms_comment')->where(array('comment_id' => $comment_id))->setInc('comment_up', 1);
				exit(json_encode(array('state' => true, 'url' => false)));
			}
			exit(json_encode(array('state' => false, 'url' => false)));
		}
		exit(json_encode(array('state' => false, 'url' => true)));
	}
	
	/**
	 * 评论文章
	 */
	public function get_commentOp(){
		if($this->checkMemberLogin()){
			$article_id = intval($_GET['article_id']);
			$model = Model();
			$insert = array();
			$insert['comment_type'] = 1;
			$insert['comment_object_id'] = $article_id;
			$insert['comment_message'] = $_GET['comment_content'];
			$insert['comment_member_id'] = intval($_SESSION['member_id']);
			$insert['comment_time'] = time();
			$result1 = $model->table('cms_comment')->insert($insert);
			if($result1){
				$model->table('cms_article')->where(array('article_id' => $article_id))->setInc('article_comment_count', 1);
				exit(json_encode(array('state' => true, 'url' => false)));
			}
			exit(json_encode(array('state' => false, 'url' => false)));
		}else{
			exit(json_encode(array('state' => false, 'url' => true)));
		}
	}
	
	/**
	 * 文章发布者删除评论
	 */
	public function del_commentOp(){
		$model = Model();
		//删除评论记录
		$result = $model->table('cms_comment')->where(array('comment_id' => intval($_GET['comment_id'])))->delete();
		if($result){
			//评论数量-1
			$model->table('cms_article')->where(array('article_id' => intval($_GET['article_id'])))->setInc('article_comment_count', -1);
			exit(json_encode(array('state' => true)));
		}
		exit(json_encode(array('state' => false)));
	}
	
	/**
	 * 分享文章
	 */
	public function share_articleOp(){
		if(!$this->checkMemberLogin()){
			exit('-1');
		}
		$article_id = intval($_POST['article_id']);
		$share_message = $_POST['content'];
		$model = Model();
		$field = 'article_id, article_title, article_image, article_attachment_path';
		$condition = array();
		$condition['article_id'] = $article_id;
		$article_info = $model->table('cms_article')->where($condition)->field($field)->find();
		$trace_content = $this->get_share_contentOp($article_info);
		//插入数据
		$insert = array();
		$insert['trace_originalid'] = 0;
		$insert['trace_originalmemberid'] = 0;
		$insert['trace_memberid'] = $_SESSION['member_id'];
		$insert['trace_membername'] = $_SESSION['member_name'];
		$insert['trace_memberavatar'] = 'avatar_'.$insert['trace_memberid'].'.jpg';
		$insert['trace_title'] = $share_message;
		$insert['trace_content'] = $trace_content;
		$insert['trace_title'] = time();
		$insert['trace_state'] = 0;
		$insert['trace_privacy'] = 0;
		$insert['trace_commentcount'] = 0;
		$insert['trace_copycount'] = 0;
		$insert['trace_from'] = 4;
		$result = $model->table('sns_tracelog')->insert($insert);
		if($result){
			//分享次数+1
			$model->table('cms_article')->where($condition)->setInc('article_share_count', 1);
			exit('1');
		}
		exit('0');
	}
	
	/**
	 * 判断会员是否登录
	 * @return boolean
	 */
	private function checkMemberLogin(){
		if($_SESSION['is_login'] == 1){
			return true;
		}else{
			return false;
		}
	}
	
	/**
	 * 合成分享content数据
	 * @param unknown $array
	 * @return string
	 */
	private function get_share_contentOp($array = array()){
		$content = '<div class="fd-media">
			<div class="goodsimg"><a target="_blank" href="'.uk86_getCMSArticleImageUrl($array['article_attachment_path'], $array['article_image']).'" onload="javascript:DrawImage(this,120,120);"></a></div>
			<div class="goodsinfo">
				<dl>
					<dt><a target="_blank" href="http://127.0.0.1/uk86/cms/index.php?act=article&op=article_detail&article_id='.$array['article_id'].'">'.$array['article_title'].'</a></dt>
					<dd>"'.$_SESSION['member_name'].'"在资讯频道分享了文章<a target="_blank" href="http://127.0.0.1/uk86/cms/index.php?act=article&op=article_detail&article_id='.$array['article_id'].'">去看看</a></dd>
				</dl>
			</div>
		</div>';
		return $content;
	}
}
?>