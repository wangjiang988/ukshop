<?php
/**
 * 分页类
 *
 *
 * @package   by Uk86 商城开发
 */


defined('InUk86') or exit('Access Invalid!');
class Uk86Page{
	/**
	 * url参数中页码参数名
	 */
	private $page_name = 'curpage';
	/**
	 * 信息总数
	 */
	private $total_num = 1;
	/**
	 * 页码链接
	 */
	private $page_url = '';
	/**
	 * 每页信息数量
	 */
	private $each_num = 10;
	/**
	 * 当前页码
	 */
	private $now_page = 1;
	/**
	 * 设置页码总数
	 */
	private $total_page = 1;
	/**
	 * 输出样式
	 * 4、5为商城伪静态专用样式
	 */
	private $style = 2;
	/**
	 * ajax 分页 预留，目前先不使用
	 * 0为不使用，1为使用，默认为0
	 */
	private $ajax = 0;
	/**
	 * 首页
	 */
	private $pre_home = '';
	/**
	 * 末页
	 */
	private $pre_last = '';
	/**
	 * 上一页
	 */
	private $pre_page = '';
	/**
	 * 下一页
	 */
	private $next_page = '';
	/**
	 * 页码 样式左边界符
	 */
	private $left_html = '<li>';
	/**
	 * 页码 样式右边界符
	 */
	private $right_html = '</li>';
	/**
	 * 选中样式左边界符
	 */
	private $left_current_html = '<li>';
	/**
	 * 选中样式右边界符
	 */
	private $right_current_html = '</li>';
	/**
	 * 省略号样式左边界符
	 */
	private $left_ellipsis_html = '<li>';
	/**
	 * 省略号样式右边界符
	 */
	private $right_ellipsis_html = '</li>';
	/**
	 * 在页码链接a内部的样式 <a>(样式名)页码(样式名)</a>
	 */
	private $left_inside_a_html = '';
	/**
	 * 在页码链接a内部的样式 <a>(样式名)页码(样式名)</a>
	 */
	private $right_inside_a_html = '';

	/**
	 * 构造函数
	 *
	 *  数据库使用到的方法：
	 * 	$this->uk86_setTotalNum($total_num);
	 *  $this->uk86_getLimitStart();
	 *  $this->uk86_getLimitEnd();
	 *
	 * @param
	 * @return
	 */
	public function __construct(){
		Uk86Language::uk86_read('core_lang_index');
		$lang	= Uk86Language::uk86_getLangContent();
		$this->pre_home = $lang['first_page'];
		$this->pre_last = $lang['last_page'];
		$this->pre_page = $lang['pre_page'];
		$this->next_page = $lang['next_page'];
		/**
		 * 设置当前页码
		 */
		$this->uk86_setNowPage($_GET[$this->page_name]);
		/**
		 * 设置当前页面的页码url
		 * 商城伪静态分页不需要使用这个方法
		 */
        if (!in_array($this->style, array(4,5))) {
            $this->uk86_setPageUrl();
        }
	}

	/**
	 * 取得属性
	 *
	 * @param string $key 属性键值
	 * @return string 字符串类型的返回结果
	 */
	public function uk86_get($key){
		return $this->$key;
	}

	/**
	 * 设置属性
	 *
	 * @param string $key 属性键值
	 * @param string $value 属性值
	 * @return bool 布尔类型的返回结果
	 */
	public function uk86_set($key,$value){
		return $this->$key = $value;
	}

	/**
	 * 设置url页码参数名
	 *
	 * @param string $page_name url中传递页码的参数名
	 * @return bool 布尔类型的返沪结果
	 */
	public function uk86_setPageName($page_name){
		$this->page_name = $page_name;
		return true;
	}
	/**
	 * 设置当前页码
	 *
	 * @param int $page 当前页数
	 * @return bool 布尔类型的返回结果
	 */
	public function uk86_setNowPage($page){
		$this->now_page = intval($page)>0?intval($page):1;
		return true;
	}
	/**
	 * 设置每页数量
	 *
	 * @param int $num 每页显示的信息数
	 * @return bool 布尔类型的返回结果
	 */
	public function uk86_setEachNum($num){
		$this->each_num = intval($num)>0?intval($num):10;
		return true;
	}
	/**
	 * 设置输出样式
	 *
	 * @param int $style 样式名
	 * @return bool 布尔类型的返回结果
	 */
	public function uk86_setStyle($style){
		$this->style = ($style == 'admin' ? 2:$style);
		return true;
	}
	/**
	 * 设置信息总数
	 *
	 * @param int $total_num 信息总数
	 * @return bool 布尔类型的返回结果
	 */
	public function uk86_setTotalNum($total_num){
		$this->total_num = $total_num;
		return true;
	}
	/**
	 * 取当前页码
	 *
	 * @param
	 * @return int 整型类型的返回结果
	 */
	public function uk86_getNowPage(){
		return $this->now_page;
	}
	/**
	 * 取页码总数
	 *
	 * @param
	 * @return int 整型类型的返回结果
	 */
	public function uk86_getTotalPage(){
		if ($this->total_page == 1){
			$this->uk86_setTotalPage();
		}
		return $this->total_page;
	}
	/**
	 * 取信息总数
	 *
	 * @param
	 * @return int 整型类型的返回结果
	 */
	public function uk86_getTotalNum(){
		return $this->total_num;
	}
	/**
	 * 取每页信息数量
	 *
	 * @param
	 * @return int 整型类型的返回结果
	 */
	public function uk86_getEachNum(){
		return $this->each_num;
	}
	/**
	 * 取数据库select开始值
	 *
	 * @param
	 * @return int 整型类型的返回结果
	 */
	public function uk86_getLimitStart(){
		if ($this->uk86_getNowPage() <= 1){
			$tmp = 0;
		}else {
            $this->uk86_setTotalPage();
            $this->now_page = $this->now_page > $this->total_page ? $this->total_page : $this->now_page;
			$tmp = ($this->uk86_getNowPage()-1)*$this->uk86_getEachNum();
		}
		return $tmp;
	}
	/**
	 * 取数据库select结束值
	 *
	 * @param
	 * @return int 整型类型的返回结果
	 */
	public function uk86_getLimitEnd(){
		$tmp = $this->uk86_getNowPage()*$this->uk86_getEachNum();
		if ($tmp > $this->uk86_getTotalNum()){
			$tmp = $this->uk86_getTotalNum();
		}
		return $tmp;
	}
	/**
	 * 设置页码总数
	 *
	 * @param int $id 记录ID
	 * @return array $rs_row 返回数组形式的查询结果
	 */
	public function uk86_setTotalPage(){
		$this->total_page = ceil($this->uk86_getTotalNum()/$this->uk86_getEachNum());
	}

	/**
	 * 输出html
	 *
	 * @param
	 * @return string 字符串类型的返回结果
	 */
	public function uk86_show($style = null){
		/**
		 * 设置总数
		 */
		$this->uk86_setTotalPage();
		if (!is_null($style)){
			$this->style = $style;
		}
		$html_page = '';
        $this->left_current_html = '<li><span class="currentpage">';
        $this->right_current_html = '</span></li>';
        $this->left_inside_a_html = '<span>';
        $this->right_inside_a_html = '</span>';
		switch ($this->style) {
			case '1':
				$html_page .= '<ul>';
				if ($this->uk86_getNowPage() <= 1){
					$html_page .= '<li>'.$this->left_inside_a_html.$this->pre_page.$this->right_inside_a_html.'</li>';
				}else {
					$html_page .= '<li><a class="demo" href="'. $this->page_url . ($this->uk86_getNowPage()-1) .'">'.$this->left_inside_a_html.$this->pre_page.$this->right_inside_a_html.'</a></li>';
				}
				if ($this->uk86_getNowPage() == $this->uk86_getTotalPage() || $this->uk86_getTotalPage() == 0){
					$html_page .= '<li>'.$this->left_inside_a_html.$this->next_page.$this->right_inside_a_html.'</li>';
				}else {
					$html_page .= '<li><a class="demo" href="'. $this->page_url . ($this->uk86_getNowPage()+1) .'">'.$this->left_inside_a_html.$this->next_page.$this->right_inside_a_html.'</a></li>';
				}
				$html_page .= '</ul>';
				break;
			case '2':
				$html_page .= '<ul>';
				if ($this->uk86_getNowPage() <= 1){
					$html_page .= '<li>'.$this->left_inside_a_html.$this->pre_home.$this->right_inside_a_html.'</li>';
					$html_page .= '<li>'.$this->left_inside_a_html.$this->pre_page.$this->right_inside_a_html.'</li>';
				}else {
					$html_page .= '<li><a class="demo" href="'. $this->page_url .'1">'.$this->left_inside_a_html.$this->pre_home.$this->right_inside_a_html.'</a></li>';
					$html_page .= '<li><a class="demo" href="'. $this->page_url . ($this->uk86_getNowPage()-1) .'">'.$this->left_inside_a_html.$this->pre_page.$this->right_inside_a_html.'</a></li>';
				}
				$html_page .= $this->uk86_getNowBar();
				if ($this->uk86_getNowPage() == $this->uk86_getTotalPage() || $this->uk86_getTotalPage() == 0){
					$html_page .= '<li>'.$this->left_inside_a_html.$this->next_page.$this->right_inside_a_html.'</li>';
					$html_page .= '<li>'.$this->left_inside_a_html.$this->pre_last.$this->right_inside_a_html.'</li>';
				}else {
					$html_page .= '<li><a class="demo" href="'. $this->page_url . ($this->uk86_getNowPage()+1) .'">'.$this->left_inside_a_html.$this->next_page.$this->right_inside_a_html.'</a></li>';
					$html_page .= '<li><a class="demo" href="'. $this->page_url . $this->uk86_getTotalPage() .'">'.$this->left_inside_a_html.$this->pre_last.$this->right_inside_a_html.'</a></li>';
				}
				$html_page .= '</ul>';
				break;
			case '3':
				$html_page .= '<ul>';
				if ($this->uk86_getNowPage() <= 1){
					$html_page .= '<li>'.$this->left_inside_a_html.$this->pre_page.$this->right_inside_a_html.'</li>';
				}else {
					$html_page .= '<li><a class="demo" href="'. $this->page_url . ($this->uk86_getNowPage()-1) .'">'.$this->left_inside_a_html.$this->pre_page.$this->right_inside_a_html.'</a></li>';
				}
				$html_page .= $this->uk86_getNowBar();
				if ($this->uk86_getNowPage() == $this->uk86_getTotalPage() || $this->uk86_getTotalPage() == 0){
					$html_page .= '<li>'.$this->left_inside_a_html.$this->next_page.$this->right_inside_a_html.'</li>';
					$html_page .= '<li>'.$this->left_inside_a_html.$this->pre_last.$this->right_inside_a_html.'</li>';
				}else {
					$html_page .= '<li><a class="demo" href="'. $this->page_url . ($this->uk86_getNowPage()+1) .'">'.$this->left_inside_a_html.$this->next_page.$this->right_inside_a_html.'</a></li>';
				}
				$html_page .= '</ul>';
				break;
			case '4':
				$html_page .= '<ul>';
				if ($this->uk86_getNowPage() <= 1){
					$html_page .= '<li>'.$this->left_inside_a_html.$this->pre_page.$this->right_inside_a_html.'</li>';
				}else {
					$html_page .= '<li><a class="demo" href="'. $this->uk86_setShopPseudoStaticPageUrl($this->uk86_getNowPage()-1) .'">'.$this->left_inside_a_html.$this->pre_page.$this->right_inside_a_html.'</a></li>';
				}
				if ($this->uk86_getNowPage() == $this->uk86_getTotalPage() || $this->uk86_getTotalPage() == 0){
					$html_page .= '<li>'.$this->left_inside_a_html.$this->next_page.$this->right_inside_a_html.'</li>';
				}else {
					$html_page .= '<li><a class="demo" href="'. $this->uk86_setShopPseudoStaticPageUrl($this->uk86_getNowPage()+1) .'">'.$this->left_inside_a_html.$this->next_page.$this->right_inside_a_html.'</a></li>';
				}
				$html_page .= '</ul>';
				break;
			case '5':
				$html_page .= '<ul>';
				if ($this->uk86_getNowPage() <= 1){
					$html_page .= '<li>'.$this->left_inside_a_html.$this->pre_home.$this->right_inside_a_html.'</li>';
					$html_page .= '<li>'.$this->left_inside_a_html.$this->pre_page.$this->right_inside_a_html.'</li>';
				}else {
					$html_page .= '<li><a class="demo" href="'. $this->uk86_setShopPseudoStaticPageUrl('1') .'">'.$this->left_inside_a_html.$this->pre_home.$this->right_inside_a_html.'</a></li>';
					$html_page .= '<li><a class="demo" href="'. $this->uk86_setShopPseudoStaticPageUrl($this->uk86_getNowPage()-1) .'">'.$this->left_inside_a_html.$this->pre_page.$this->right_inside_a_html.'</a></li>';
				}
				$html_page .= $this->uk86_getNowBar();
				if ($this->uk86_getNowPage() == $this->uk86_getTotalPage() || $this->uk86_getTotalPage() == 0){
					$html_page .= '<li>'.$this->left_inside_a_html.$this->next_page.$this->right_inside_a_html.'</li>';
					$html_page .= '<li>'.$this->left_inside_a_html.$this->pre_last.$this->right_inside_a_html.'</li>';
				}else {
					$html_page .= '<li><a class="demo" href="'. $this->uk86_setShopPseudoStaticPageUrl($this->uk86_getNowPage()+1) .'">'.$this->left_inside_a_html.$this->next_page.$this->right_inside_a_html.'</a></li>';
					$html_page .= '<li><a class="demo" href="'. $this->uk86_setShopPseudoStaticPageUrl($this->uk86_getTotalPage()) .'">'.$this->left_inside_a_html.$this->pre_last.$this->right_inside_a_html.'</a></li>';
				}
				$html_page .= '</ul>';
				break;
			default:
				break;
		}
		/**
		 * 转码
		 */
		/**
		if (strtoupper(CHARSET) == 'GBK' && !empty($html_page)){
			$html_page = iconv('UTF-8','GBK',$html_page);
		}
		*/
		return $html_page;
	}
	/**
	 * 页码条内容
	 * 样式为： 前面2个页码 ... 中间7个页码 ...
	 *
	 * @param
	 * @return string 字符串类型的返回结果
	 */
	private function uk86_getNowBar(){
		/**
		 * 显示效果
		 * 中间显示7个，左右两个，不足则不显示省略号
		 */
		/**
		 * 判断当前页是否大于7
		 */
		if ($this->uk86_getNowPage() >= 7){
			/**
			 * 前面增加省略号，并且计算开始页码
			 */
			$begin = $this->uk86_getNowPage()-2;
		}else {
			/**
			 * 小于7，前面没有省略号
			 */
			$begin = 1;
		}
		/**
		 * 计算结束页码
		 */
		if ($this->uk86_getNowPage()+5 < $this->uk86_getTotalPage()){
			/**
			 * 增加省略号
			 */
			$end = $this->uk86_getNowPage()+5;
		}else {
			$end = $this->uk86_getTotalPage();
		}

		/**
		 * 整理整个页码样式
		 */
		$result = '';
		if ($begin > 1){
			$result .= $this->uk86_setPageHtml(1,1).$this->uk86_setPageHtml(2,2);
			$result .= $this->left_ellipsis_html.'<span>...</span>'.$this->right_ellipsis_html;
		}
		/**
		 * 中间部分内容
		 */
		for ($i=$begin;$i<=$end;$i++){
			$result .= $this->uk86_setPageHtml($i,$i);
		}
		if ($end < $this->uk86_getTotalPage()){
			$result .= $this->left_ellipsis_html.'<span>...</span>'.$this->right_ellipsis_html;
		}
		return $result;
	}

	/**
	 * 设置单个页码周围html代码
	 *
	 * @param string $page_name 页码显示内容
	 * @param string $page 页码数
	 * @return string 字符串类型的返回结果
	 */
	private function uk86_setPageHtml($page_name,$page){
		/**
		 * 判断是否是当前页
		 */
		if ($this->uk86_getNowPage() == $page){
			$result = $this->left_current_html.$page.$this->right_current_html;
		}else {
		    if (in_array($this->style, array(4,5))) {     // 商城伪静态使用
		        $result = $this->left_html."<a class='demo' href='". $this->uk86_setShopPseudoStaticPageUrl($page) ."'>".$this->left_inside_a_html.$page_name.$this->right_inside_a_html."</a>".$this->right_html;
            } else {                                      // 普通分页使用
                $result = $this->left_html."<a class='demo' href='". $this->page_url . $page ."'>".$this->left_inside_a_html.$page_name.$this->right_inside_a_html."</a>".$this->right_html;
		    }
		}
		return $result;
	}

	/**
	 * 取url地址
	 *
	 * @param
	 * @return string 字符串类型的返回结果
	 */
	private function uk86_setPageUrl(){
		$uri = uk86_request_uri() ;
		$_SERVER['REQUEST_URI'] = $uri ;

		/**
		 * 不存在QUERY_STRING时
		 */
		if(empty($_SERVER['QUERY_STRING'])){
			$this->page_url = $_SERVER['REQUEST_URI']."?".$this->page_name."=";
		}else{
			if(stristr($_SERVER['QUERY_STRING'],$this->page_name.'=')){
				/**
				 * 地址存在页面参数
				 */
				$this->page_url = str_replace($this->page_name.'='.$this->now_page,'',$_SERVER['REQUEST_URI']);
				$last = $this->page_url[strlen($this->page_url)-1];
				if($last=='?' || $last=='&'){
					$this->page_url .= $this->page_name."=";
				}else{
					$this->page_url .= '&'.$this->page_name."=";
				}
			}else{
				$this->page_url = $_SERVER['REQUEST_URI'].'&'.$this->page_name.'=';
			}
		}
		return true;
	}
    /**
     * 取url地址
     *
     * @param int $page
     * @return string 字符串类型的返回结果
     */
    private function uk86_setShopPseudoStaticPageUrl($page){
        $param = $_GET;
        $act = $param['act'] == '' ? 'index' : $param['act'];
        unset($param['act']);
        $op = $param['op'] == '' ? 'index' : $param['op'];
        unset($param['op']);
        $param[$this->page_name] = $page;
        return uk86_urlShop($act, $op, $param);
    }
}
