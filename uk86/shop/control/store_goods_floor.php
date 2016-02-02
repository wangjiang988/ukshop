<?php

defined('InUk86') or exit('Access Invalid!');

class store_goods_floorControl extends BaseSellerControl {
    public function __construct() {
        parent::__construct();
    }

    /**
     * 店铺楼层列表
     */
    public function indexOP(){
        $model=Model();
       // var_dump($_SESSION);
        $floor_list=$model->table('store_floor')->where(array("store_id"=>$_SESSION['store_id']))->select();
        Tpl::output("floor_list",$floor_list);
        //var_dump($floor_list);
        Tpl::showpage('store_floor_list');
    }

    /**
     * 添加店铺楼层
     */
    public function add_goods_floorOp(){
        if(uk86_chksubmit()) {
            $data['store_id']=$_SESSION['store_id'];
            $data['floor_name']=$_POST['floor_name'];
            $data['create_at']=time();
            $data['update_at']=time();
            $data['is_hidden']=$_POST['is_hidden'];
            $model=Model();
            if($model->table('store_floor')->insert($data)){
                showDialog(L('nc_common_op_succ'), 'reload', 'succ', 'CUR_DIALOG.close();');
            }else{
                showDialog('添加楼层失败', '', 'error', 'CUR_DIALOG.close();');
            }
        }

        Tpl::setDir('home');
        Tpl::showpage('store_floor_add', 'null_layout');
    }

    public function edit_goods_floorOp(){
        $condition['store_id']=$_SESSION['store_id'];
        $model=Model();
        if(uk86_chksubmit()) {
            $condition['id']=$_POST['id'];
            $data['floor_name']=$_POST['floor_name'];
            $data['update_at']=time();
            $data['is_hidden']=$_POST['is_hidden'];

            if($model->table('store_floor')->where($condition)->update($data)){
                showDialog(L('nc_common_op_succ'), 'reload', 'succ', 'CUR_DIALOG.close();');
            }else{
                showDialog('编辑楼层失败', '', 'error', 'CUR_DIALOG.close();');
            }
        }
        $condition['id']=$_GET['id'];
        $floor=$model->table('store_floor')->where($condition)->find();
        Tpl::output('floor',$floor);
        Tpl::setDir('home');
        Tpl::showpage('store_floor_edit', 'null_layout');
    }

    public function delete_goods_floorOp(){
        $condition['id']=$_GET['id'];
        $condition['store_id']=$_SESSION['store_id'];
        $model=Model();
        if($model->table('store_floor')->where($condition)->delete()){
            showDialog('删除成功','reload','succ');
        }else{
            showDialog('删除失败','','error');
        }
    }
}