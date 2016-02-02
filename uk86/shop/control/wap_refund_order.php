<?php
/**
 *
 * 处理�?�?
 * @author zhengzhihao
 */
defined('InUk86') or exit('Access Invalid!');

class wap_refund_orderControl extends BaseWapControl
{
    public function __construct()
    {
        parent::__construct();

        if (!$_SESSION['is_login']) {
            header('Location:index.php?act=wap_login&op=login');
        }
        $model_refund = Model('refund_return');
        $model_refund->getRefundStateArray();
    }

    public function indexOp(){
       // var_dump($_SESSION);
        $condition['buyer_id']=$_SESSION['member_id'];
        //$condition['buyer_id']=11;
        $model=Model();
        $refund_list=$model->table('refund_return')->where($condition)->select();

        if(!empty($refund_list)){
            foreach($refund_list as $key=>$val){
                if($val['goods_id']==0){
                    $refund_order_list=$model->table('order_goods')->where(array('order_id'=>$val['order_id']))->select();
                    $refund_shopping_fee=$model->field('shipping_fee')->table('order')->where(array('order_id'=>$val['order_id']))->find();
                    $refund_list[$key]['shopping_fee']=$refund_shopping_fee['shipping_fee'];
                }else{
                    $refund_order_list=$model->table('order_goods')->where(array('order_id'=>$val['order_id'],'goods_id'=>$val['goods_id']))->find();
                }
                $refund_list[$key]['goods_list']=$refund_order_list;
            }
        }
        //var_dump($refund_list);
        Tpl::output('refund_list',$refund_list);
        Tpl::showpage('refund_list');
    }

    public function refundOp(){
        $model_order=Model();
        $condition=array('order_id'=>$_GET['order_id']);
        $refund_order_info=$model_order->table('order')->where($condition)->find();
        $refund_reason_info=Model()->table('refund_reason')->order('sort')->select();

        Tpl::output('reason_info',$refund_reason_info);
        Tpl::output("refund_order",$refund_order_info);
        Tpl::showpage('refund');
    }

    public function seller_refundOp(){
        $model_trade = Model('trade');
        $model_refund = Model('refund_return');
        $order_id = intval($_POST['order_id']);  //订单id
        if($order_id==null){
            header('Location:index.php?act=wap_refund_order&op=index');
        }
        $condition = array();
        $condition['buyer_id'] = $_SESSION['member_id'];
        $condition['order_id'] = $order_id;

        $order = Model()->table('order')->where($condition)->find();
        Tpl::output('order',$order);

        $order_amount = $order['order_amount'];//订单金额
        $condition = array();
        $condition['buyer_id'] = $order['buyer_id'];
        $condition['order_id'] = $order_id;
        $condition['goods_id'] = '0';
        $condition['seller_state'] = array('lt','3');
        $refund_list = Model()->table('refund_return')->where($condition)->select();

        $refund = array();
        if (!empty($refund_list) && is_array($refund_list)) {
            $refund = $refund_list[0];
        }
        $order_paid = $model_trade->getOrderState('order_paid');
        $payment_code = $order['payment_code'];//支付方式
        var_dump($order['order_state']);
//        if ($refund['refund_id'] > 0 || $order['order_state'] != $order_paid || $payment_code == 'offline') {//�?查订单状�?,防止页面刷新不及时�?�成数据错误
//            showDialog(Uk86Language::uk86_get('wrong_argument'),'index.php?act=member_order&op=index','error');
//        }
        $refund_array = array();
        $refund_array['refund_type'] = '1';//类型:1为退款，2为退货?
        $refund_array['seller_state'] = '1';//状�??:1为待审核,2为同�?,3为不同意
        $refund_array['order_lock'] = '2';//锁定类型:1为不用锁�?,2为需要锁�?
        $refund_array['goods_id'] = '0';
        $refund_array['order_goods_id'] = '0';
        $refund_array['order_id']=$order['order_id'];
        $refund_array['reason_id'] = $_POST['reason_id'];
        $refund_array['reason_info'] = $_POST['reason_info'];
        $refund_array['goods_name'] = "全部商品退款";
        $refund_array['refund_amount'] = uk86_ncPriceFormat($order_amount);
        $refund_array['buyer_message'] = $_POST['buyer_message'];

        $refund_array['add_time'] = time();

        $pic_array = array();
        $pic_array['buyer'] = $this->upload_pic();//上传凭证
        $info = serialize($pic_array);
        $refund_array['pic_info'] = $info;
        if($refund_list.length==0){
            $state = $model_refund->addRefundReturn($refund_array,$order);  //添加
        }else{
            $con['order_id']=$order_id;
            $con['buyer_id']=$order['buyer_id'];
            $con['goods_id']=0;
            $con['seller_state']=array('lt',3);
            $state=Model()->table('refund_return')->where($con)->update($refund_array);  //更新
        }

      if ($state) {
           $model_refund->editOrderLock($order_id);
       } else {
            showDialog(Uk86Language::uk86_get('nc_common_save_fail'),'reload','error');
        }

        $refund_info=Model()->table('refund_return')->where($condition)->find();
        $refund_reason=Model()->table('refund_reason')->where(array('reason_id'=>$refund_info['reason_id']))->find();
        $refund_info['refund_reason']=$refund_reason['reason_info'];
        Tpl::output('refund_info',$refund_info);
        Tpl::showpage("seller_refund");
    }

    public function  refund_successOp(){
        Tpl::showpage("refund_success");
    }


    /**
     * �?款记录列表页
     *
     */
//    public function indexOp(){
//        $model_refund = Model('refund_return');
//        $condition = array();
//        //$condition['buyer_id'] = $_SESSION['member_id'];
//        $condition['buyer_id'] = 11;
//        if (trim($_GET['add_time_from']) != '' || trim($_GET['add_time_to']) != ''){
//            $add_time_from = strtotime(trim($_GET['add_time_from']));
//            $add_time_to = strtotime(trim($_GET['add_time_to']));
//            if ($add_time_from !== false || $add_time_to !== false){
//                $condition['add_time'] = array('time',array($add_time_from,$add_time_to));
//            }
//        }
//        $refund_list = $model_refund->getRefundList($condition,10);
//        Tpl::output('refund_list',$refund_list);
//        var_dump($refund_list);
//        Tpl::showpage('refund_list');
//    }
    /**
     * �?款记录查�?
     *
     */
    public function viewOp(){
        $model_refund = Model('refund_return');
        $condition = array();
        $condition['buyer_id'] = $_SESSION['member_id'];
        $condition['refund_id'] = intval($_GET['refund_id']);
        $refund_list = $model_refund->getRefundList($condition);
        $refund = $refund_list[0];
        Tpl::output('refund',$refund);
        $info['buyer'] = array();
        if(!empty($refund['pic_info'])) {
            $info = unserialize($refund['pic_info']);
        }
        Tpl::output('pic_list',$info['buyer']);
        $condition = array();
        $condition['order_id'] = $refund['order_id'];
        $model_refund->getRightOrderList($condition, $refund['order_goods_id']);

        Tpl::showpage('member_refund_view');
    }
    /**
     * 上传凭证
     *
     */
    private function upload_pic() {
        $refund_pic = array();
        $refund_pic[1] = 'refund_pic1';
        $refund_pic[2] = 'refund_pic2';
        $refund_pic[3] = 'refund_pic3';
        $pic_array = array();
        $upload = new Uk86UploadFile();
        $dir = ATTACH_PATH.DS.'refund'.DS;
        $upload->uk86_set('default_dir',$dir);
        $upload->uk86_set('allow_type',array('jpg','jpeg','gif','png'));
        $count = 1;
        foreach($refund_pic as $pic) {
            if (!empty($_FILES[$pic]['name'])){
                $result = $upload->uk86_upfile($pic);
                if ($result){
                    $pic_array[$count] = $upload->file_name;
                    $upload->file_name = '';
                } else {
                    $pic_array[$count] = '';
                }
            }
            $count++;
        }
        return $pic_array;
    }

    public function cancel_refundOp(){
        $order_id=$_GET['order_id'];
        $order_sn=$_GET['order_sn'];
        $lock['lock_state']=0;
        $lock['refund_state']=0;
        $lock['refund_amount']=0;
        $state=Model()->table('order')->where(array('order_id'=>$order_id,"order_sn"=>$order_sn,"order_state"=>20))->update($lock);     //解除锁状态，删除
        Model()->table('refund_return')->where(array('order_id'=>$order_id,"order_sn"=>$order_sn,"seller_state"=>1))->delete();         //删除退款表里面的内容
        header('Location:index.php?act=wap_refund_order&op=index');
    }
}