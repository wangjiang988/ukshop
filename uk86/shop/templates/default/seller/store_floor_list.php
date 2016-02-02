<?php defined('InUk86') or exit('Access Invalid!');?>

<div class="tabmenu">
    <?php include uk86_template('layout/submenu');?>
    <a id="add_floor" class="ncsc-btn ncsc-btn-green" title="添加新楼层">添加新楼层</a> </div>
<table class="ncsc-default-table">
    <thead>
    <tr nc_type="table_header">
        <th class="w100">楼层id</th>
        <th class="w100">楼层名称</th>
        <th class="w100">是否隐藏</th>
        <th class="w120">操作</th>
    </tr>
    </thead>
    <tbody>
    <?php if (!empty($output['floor_list'])) { ?>
        <?php foreach ($output['floor_list'] as $val) { ?>
            <tr>
                <td><?php echo $val['id'];?></td>
                <td><?php echo $val['floor_name'];?></td>
                <td><?php if($val['is_hidden']==1)echo "是";else echo "否";?></td>
                <td class="nscs-table-handle">
                        <span><a data-id="<?php echo $val['id'];?>" class="btn-blue" onclick="edit_floor(this);"><i class="icon-edit"></i>
                                <p><?php echo $lang['nc_edit'];?></p>
                            </a></span> <span><a href="javascript:void(0);" onclick="ajax_get_confirm('<?php echo $lang['nc_ensure_del'];?>', '<?php echo uk86_urlShop('store_goods_floor', 'delete_goods_floor', array('id' => $val['id']));?>');" class="btn-red"><i class="icon-trash"></i>
                                <p><?php echo $lang['nc_del'];?></p>
                            </a></span>
                </td>
            </tr>
            <tr style="display:none;">
                <td colspan="20"><div class="ncsc-goods-sku ps-container"></div></td>
            </tr>
        <?php } ?>
    <?php } else { ?>
        <tr>
            <td colspan="20" class="norecord"><div class="warning-option"><i class="icon-warning-sign"></i><span><?php echo $lang['no_record'];?></span></div></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
<script>
    //$(function(){
        //Ajax提示
       /* $('.tip').poshytip({
            className: 'tip-yellowsimple',
            showTimeout: 1,
            alignTo: 'target',
            alignX: 'center',
            alignY: 'top',
            offsetY: 5,
            allowTipHover: false
        });
        $('a[nctype="batch"]').click(function(){
            if($('.checkitem:checked').length == 0){    //没有选择
                showDialog('请选择需要操作的记录');
                return false;
            }
            var _items = '';
            $('.checkitem:checked').each(function(){
                _items += $(this).val() + ',';
            });
            _items = _items.substr(0, (_items.length - 1));

            var data_str = '';
            eval('data_str = ' + $(this).attr('data-param'));

            if (data_str.sign == 'jingle') {
                ajax_form('ajax_jingle', '设置广告词', data_str.url + '&commonid=' + _items + '&inajax=1', '480');
            } else if (data_str.sign == 'plate') {
                ajax_form('ajax_plate', '设置关联版式', data_str.url + '&commonid=' + _items + '&inajax=1', '480');
            }
        });*/

    //});
    $(function(){
        // 添加楼层
        $('#add_floor').click(function(){
            _uri = "<?php echo SHOP_SITE_URL;?>/index.php?act=store_goods_floor&op=add_goods_floor";
            CUR_DIALOG = ajax_form('addfloor_form', '添加楼层', _uri, 520);
        });

        //编辑楼层
        $('#edit_floor').click(function(){

        });
    });

    function edit_floor(event){
        var id = $(event).attr('data-id');
        _uri = "<?php echo SHOP_SITE_URL;?>/index.php?act=store_goods_floor&op=edit_goods_floor&id="+id;
        CUR_DIALOG = ajax_form('editfloor_form', '编辑楼层', _uri, 520);
    }
</script>