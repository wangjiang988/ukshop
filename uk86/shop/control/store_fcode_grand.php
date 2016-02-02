<?php
/**
 * 发放F码
 *
 * By UK86商城开发
 */
defined('InUk86') or exit('Access Invalid!');

class store_fcode_grandControl extends BaseSellerControl
{
    public function __construct()
    {
        parent::__construct();
    }

    public function indexOp()
    {
        $model_goods = Model('goods');

        $where = array();
        $where['store_id'] = $_SESSION['store_id'];
        $where['is_fcode'] = 1;
        $goods_list = $model_goods->getGoodsCommonOnlineList($where);
        Tpl::output('show_page', $model_goods->showpage());
        Tpl::output('goods_list', $goods_list);

        // 计算库存
        $storage_array = $model_goods->calculateStorage($goods_list);
        Tpl::output('storage_array', $storage_array);

        // 商品分类
        $store_goods_class = Model('store_goods_class')->getClassTree(array('store_id' => $_SESSION['store_id'], 'stc_state' => '1'));
        Tpl::output('store_goods_class', $store_goods_class);
        self::profile_menu('free_freight', 'index');
        Tpl::showpage('store.f_grand');
    }

    public function fcode_grandOp()
    {
        $model_member = Model('member');
        //会员级别
        $member_grade = $model_member->getMemberGradeArr();
        if ($_GET['search_field_value'] != '') {
            switch ($_GET['search_field_name']) {
                case 'member_name':
                    $condition['member_name'] = array('like', '%' . trim($_GET['search_field_value']) . '%');
                    break;
                case 'member_email':
                    $condition['member_email'] = array('like', '%' . trim($_GET['search_field_value']) . '%');
                    break;
                case 'member_truename':
                    $condition['member_truename'] = array('like', '%' . trim($_GET['search_field_value']) . '%');
                    break;
            }
        }
        if ($_GET['search_state'] != '') {
            switch ($_GET['search_state']) {
                case 'no_informallow':
                    $condition['inform_allow'] = '2';
                    break;
                case 'no_isbuy':
                    $condition['is_buy'] = '0';
                    break;
                case 'no_isallowtalk':
                    $condition['is_allowtalk'] = '0';
                    break;
                case 'no_memberstate':
                    $condition['member_state'] = '0';
                    break;
            }
        }
        //会员等级
        $search_grade = intval($_GET['search_grade']);
        if ($search_grade >= 0 && $member_grade && $_GET['search_grade'] != '') {
            $condition['member_exppoints'] = array(array('egt', $member_grade[$search_grade]['exppoints']), array('lt', $member_grade[$search_grade + 1]['exppoints']), 'and');
        }
        //排序
        $order = trim($_GET['search_sort']);
        if (empty($order)) {
            $order = 'member_id desc';
        }
        $member_list = $model_member->getMemberList($condition, '*', 10, $order);
        //整理会员信息
        if (is_array($member_list)) {
            foreach ($member_list as $k => $v) {
                $member_list[$k]['member_time'] = $v['member_time'] ? date('Y-m-d H:i:s', $v['member_time']) : '';
                $member_list[$k]['member_login_time'] = $v['member_login_time'] ? date('Y-m-d H:i:s', $v['member_login_time']) : '';
                $member_list[$k]['member_grade'] = ($t = $model_member->getOneMemberGrade($v['member_exppoints'], false, $member_grade)) ? $t['level_name'] : '';
            }
        }
        Tpl::output('member_grade', $member_grade);
        Tpl::output('search_sort', trim($_GET['search_sort']));
        Tpl::output('search_field_name', trim($_GET['search_field_name']));
        Tpl::output('search_field_value', trim($_GET['search_field_value']));
        Tpl::output('member_list', $member_list);
        Tpl::output('page', $model_member->showpage());

        $common_id = $_GET['id'];
        Tpl::output('common_id', $common_id);
        self::profile_menu('ckmember', 'fcode_grand');
        Tpl::showpage('store_f_grand_ckmember');
    }

    /**
     * 批量发放F码操作
     */
    public function fcode_grand_allOp()
    {
        $goods_commonid = intval($_POST['goods_commonid']);
        $goods_info = Model()->table('goods')->field('goods_id, goods_storage')->where(array('goods_commonid' => $goods_commonid))->find();
        $free_model = Model('free');
        $owner_ids = $free_model->where(array('free_goods_commonid' => $goods_commonid))->field('free_owner_id, free_owner_name')->select();

        //判断库存
        $sum = count($owner_ids) + count($_POST['member_id']);
        if (intval($goods_info['goods_storage']) < $sum) {
            showDialog('该F码商品库存不足', '', 'error');
        }

        //判断F码剩余数量
        $fcode_num = Model('goods_fcode')->where(array('fc_fafang' => 0, 'goods_commonid' => $goods_commonid))->count();
        if ($fcode_num < count($_POST['member_id'])) {
            showDialog('该F码商品F码数量不足，F码剩余' . $fcode_num . '个', '', 'error');
        }

        $insert_array = array();
        $insert_array['free_goods_id'] = intval($goods_info['goods_id']);
        $insert_array['free_goods_commonid'] = $goods_commonid;
        $insert_array['free_grand_time'] = time();
        $insert_array['store_id'] = intval($_SESSION['store_id']);
        $insert_array['get_type'] = '店铺发送';
        $sms = new Uk86Sms();
        foreach ($_POST['member_id'] as $keys => $value) {
            $insert_array['free_owner_id'] = intval($value);
            $member_info = Model()->table('member')->where(array('member_id' => $value))->field('member_name, member_mobile, member_email')->find();
            $insert_array['free_owner_name'] = $member_info['member_name'];
            //取一条F码，并修改F码发放状态
            $fcode_info = Model()->table('goods_fcode')->field('fc_id, fc_code')->where(array('fc_fafang' => 0, 'fc_state' => 0, 'goods_commonid' => $goods_commonid))->find();
            Model()->table('goods_fcode')->where(array('fc_id' => $fcode_info['fc_id']))->update(array('fc_fafang' => 1));

            $insert_array['fcode_id'] = intval($fcode_info['fc_id']);
            $insert_array['free_code'] = $fcode_info['fc_code'];

            //写入F码记录表
            Model('free')->insert($insert_array);
            //发送短信通知用户
            if (!empty($member_info['member_mobile'])) {
                $message = '尊敬的用户，店铺' . $_SESSION['store_name'] . '于' . date('Y-m-d H:i') . '给您发送了F码，请进入商城确认。';
                $sms->uk86_send($member_info['member_mobile'], $message);
            }
            //发送邮件通知
            if (!empty($member_info['member_email'])) {
//            $model_tpl = Model('mail_templates');
//            $tpl_info = $model_tpl->getTplInfo(array('code'=>'f_code_send'));
//            $param = array();
//            $param['site_name']	= C('site_name');
//            $param['user_name'] = $member_info['member_name'];
//            $param['site_url'] = SHOP_SITE_URL;
//            $param['store_name'] = $_SESSION['store_name'];
//            $param['date'] = date('Y-m-d H:i');
//            $subject	= uk86_ncReplaceText($tpl_info['title'],$param);
//            $message	= uk86_ncReplaceText($tpl_info['content'],$param);
                $subject = C('site_name') . 'F码发放';
                $message = '尊敬的用户，店铺' . $_SESSION['store_name'] . '于' . date('Y-m-d H:i') . '给您发送了F码，请进入商城确认。';
                $email = new Uk86Email();
                $email->uk86_send_sys_email($member_info['member_email'], $subject, $message);
            }
        }
        showDialog('操作成功', 'index.php?act=store_fcode_grand&op=index', 'error');
    }

    /**
     * 发放单个F码操作
     */
    public function fcode_grand_oneOp()
    {
        $goods_commonid = intval($_GET['goods_commonid']);
        $goods_info = Model()->table('goods')->field('goods_id, goods_storage')->where(array('goods_commonid' => $goods_commonid))->find();
        $free_model = Model('free');
        $owner_ids = $free_model->where(array('free_goods_id' => $goods_info['goods_id']))->field('free_owner_id, free_owner_name')->select();

        //判断库存
        $sum = count($owner_ids) + 1;
        if (intval($goods_info['goods_storage']) < $sum) {
            showDialog('该F码商品库存不足', '', 'error');
        }
        //判断F码剩余数量
        $fcode_num = Model('goods_fcode')->where(array('fc_fafang' => 0, 'goods_commonid' => $goods_commonid))->count();
        if ($fcode_num < 1) {
            showDialog('该F码商品F码数量不足', '', 'error');
        }

        $insert_array = array();
        $insert_array['free_goods_id'] = intval($goods_info['goods_id']);
        $insert_array['free_goods_commonid'] = $goods_commonid;
        $insert_array['free_grand_time'] = time();
        $insert_array['free_owner_id'] = intval($_GET['member_id']);
        $insert_array['store_id'] = intval($_SESSION['store_id']);
        $insert_array['get_type'] = '店铺发送';
        $member_info = Model()->table('member')->where(array('member_id' => $insert_array['free_owner_id']))->field('member_name, member_mobile, member_email')->find();
        $insert_array['free_owner_name'] = $member_info['member_name'];
        //取一条F码，并修改F码发放状态
        $fcode_info = Model()->table('goods_fcode')->field('fc_id, fc_code')->where(array('fc_fafang' => 0, 'fc_state' => 0, 'goods_commonid' => $goods_commonid))->find();

        Model()->table('goods_fcode')->where(array('fc_id' => $fcode_info['fc_id']))->update(array('fc_fafang' => 1));

        $insert_array['fcode_id'] = intval($fcode_info['fc_id']);
        $insert_array['free_code'] = $fcode_info['fc_code'];

        //写入F码记录表
        $result = Model('free')->insert($insert_array);
        //发送短信通知用户
        if (!empty($member_info['member_mobile'])) {
            $sms = new Uk86Sms();
            $message = '尊敬的用户，店铺' . $_SESSION['store_name'] . '于' . date('Y-m-d H:i') . '给您发送了F码，请进入商城确认。';
            $sms->uk86_send($member_info['member_mobile'], $message);
        }
        //发送邮件通知
        if (!empty($member_info['member_email'])) {
//            $model_tpl = Model('mail_templates');
//            $tpl_info = $model_tpl->getTplInfo(array('code'=>'f_code_send'));
//            $param = array();
//            $param['site_name']	= C('site_name');
//            $param['user_name'] = $member_info['member_name'];
//            $param['site_url'] = SHOP_SITE_URL;
//            $param['store_name'] = $_SESSION['store_name'];
//            $param['date'] = date('Y-m-d H:i');
//            $subject	= uk86_ncReplaceText($tpl_info['title'],$param);
//            $message	= uk86_ncReplaceText($tpl_info['content'],$param);
            $subject = C('site_name') . 'F码发放';
            $message = '尊敬的用户，店铺' . $_SESSION['store_name'] . '于' . date('Y-m-d H:i') . '给您发送了F码，请进入商城确认。';
            $email = new Uk86Email();
            $email->uk86_send_sys_email($member_info['member_email'], $subject, $message);
        }
        if ($result) {
            uk86_showMessage('操作成功');
        } else {
            uk86_showMessage('操作失败');
        }
    }

    /**
     * F码发放记录
     */
    public function fcode_grand_infoOp()
    {
        $model_free = Model('free');
        $fcode_info = $model_free->where(array('store_id' => intval($_SESSION['store_id'])))->page(10)->select();
        //获取F码对应商品信息
        $goods_id_array = array();
        foreach ($fcode_info as $k => $v) {
            $goods_id_array[$k] = $v['free_goods_id'];
        }
        $goods_id_str = implode(',', $goods_id_array);
        $goods_array = Model()->table('goods')->field('goods_id, goods_name, goods_image')->where('goods_id in (' . $goods_id_str . ')')->select();
        foreach ($fcode_info as $key => $val) {
            foreach ($goods_array as $ke => $va) {
                if ($val['free_goods_id'] == $va['goods_id']) {
                    $fcode_info[$key]['goods_name'] = $va['goods_name'];
                    $fcode_info[$key]['goods_image'] = $va['goods_image'];
                }
            }
        }
        Tpl::output('fcode_info', $fcode_info);
        Tpl::output('page', $model_free->showpage(2));
        self::profile_menu('free_freight', 'fcode_grand_info');
        Tpl::showpage('store_f_grand_info');
    }

    /**
     * 全选会员是异步判断会员是否已拥有该商品F码
     */
    public function ajax_ckmember_allOp()
    {
        $goods_commonid = intval($_POST['goods_commonid']);
        $owner_ids = Model('free')->where(array('free_goods_commonid' => $goods_commonid))->field('free_owner_id, free_owner_name')->select();
        $member_array = array();
        $i = 0;
        foreach ($_POST['member_array'] as $k => $v) {
            foreach ($owner_ids as $key => $val) {
                if ($v == $val['free_owner_id']) {
                    $member_array['member_name'][$i] = $val['free_owner_name'];
                    $member_array['member_id'][$i] = $val['free_owner_id'];
                    $i++;
                }
            }
        }
        if (!empty($member_array)) {
            //去除数组中重复的值
            $member_array['member_name'] = array_unique($member_array['member_name']);
            $member_array['member_id'] = array_unique($member_array['member_id']);
            //重新排序
            $member_arr = array();
            $j = 0;
            foreach ($member_array['member_id'] as $k => $v) {
                $member_arr['member_id'][$j] = $v;
                $member_arr['member_name'][$j] = $member_array['member_name'][$k];
            }
            if (strtoupper(CHARSET) == 'GBK') {
                $data = Uk86Language::uk86_getUTF8($member_arr);//网站GBK使用编码时,转换为UTF-8,防止json输出汉字问题
            }
            echo json_encode($member_arr);
        }
    }

    /**
     * 异步判断某个会员是否拥有该商品的F码
     */
    public function ajax_ckmember_oneOp()
    {
        $goods_commonid = intval($_POST['goods_commonid']);
        $owner_ids = Model('free')->where(array('free_goods_commonid' => $goods_commonid))->field('free_owner_id, free_owner_name')->select();
        $member_arr = array();
        foreach ($owner_ids as $key => $val) {
            if ($_POST['member_id'] == $val['free_owner_id']) {
                $member_arr['member_id'] = $val['free_owner_id'];
                $member_arr['member_name'] = $val['free_owner_name'];
            }
        }
        if (!empty($member_arr)) {
            if (strtoupper(CHARSET) == 'GBK') {
                $data = Uk86Language::uk86_getUTF8($member_arr);//网站GBK使用编码时,转换为UTF-8,防止json输出汉字问题
            }
            echo json_encode($member_arr);
        }
    }

    /**
     * 用户中心右边，小导航
     *
     * @param string $menu_type 导航类型
     * @param string $menu_key 当前导航的menu_key
     * @return
     */
    private function profile_menu($menu_type, $menu_key = '')
    {
        $menu_array = array();
        switch ($menu_type) {
            case 'free_freight':
                $menu_array = array(
                    array('menu_key' => 'index', 'menu_name' => 'F码商品', 'menu_url' => 'index.php?act=store_fcode_grand'),
                    array('menu_key' => 'fcode_grand_info', 'menu_name' => '发放记录', 'menu_url' => 'index.php?act=store_fcode_grand&op=fcode_grand_info')
                );
                break;
            case 'ckmember':
                $menu_array = array(
                    array('menu_key' => 'index', 'menu_name' => 'F码商品', 'menu_url' => 'index.php?act=store_fcode_grand'),
                    array('menu_key' => 'fcode_grand', 'menu_name' => '发放F码', 'menu_url' => ''),
                    array('menu_key' => 'fcode_grand_info', 'menu_name' => '发放记录', 'menu_url' => 'index.php?act=store_fcode_grand&op=fcode_grand_info')
                );
                break;
        }
        Tpl::output('member_menu', $menu_array);
        Tpl::output('menu_key', $menu_key);
    }
}