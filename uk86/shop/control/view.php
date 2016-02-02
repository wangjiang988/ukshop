<?php
/**
 * 账号同步
*
*
*
**by Uk86 商城开发*/

defined('InUk86') or exit('Access Invalid!');
class viewControl{

    public function showViewOp(){
        
        $view_id = intval($_GET['view_id']);
        $view = Model('view');
        $result = $view->getOneById($view_id);
        $path = BASE_SITE_URL.'/data/upload/'.$result['view_path'].'/test.xml';
        
        Tpl::output('path',$path);
        Tpl::showpage('view','view');
    }
    public function viewList()
    {
        $view = Model('view');
        $viewlist = $view->getViewList();
        Tpl::output('viewlist',$viewlist);
        Tpl::showpage('home/viewlist');
    }
}