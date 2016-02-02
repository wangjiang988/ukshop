<?php defined('InUk86') or exit('Access Invalid!');?>
<style>
    a.btn-submit{
        background-color:#5bb75b;padding:6px 15px;color:#Fff;text-align:center
    }
    a.btn-submit:hover{
        text-decoration: none;
    }
</style>
<div class="eject_con">
    <div id="ms-warning"></div>
    <form id="addfloor_form" action="<?php echo SHOP_SITE_URL;?>/index.php?act=store_goods_floor&op=add_goods_floor" method="post" class="base-form-style">
        <input type="hidden" value="ok" name="form_submit"/>
        <dl>
            <dt>楼层名称</dt>
            <dd>
                <input type="text" name="floor_name" class="w200 text" required/>
            </dd>
        </dl>
        <dl>
            <dt>状态</dt>
            <dd>
                <input type="radio" name="is_hidden" value="0" checked="checked" />
                显示&nbsp;
                <input type="radio" name="is_hidden" value="1" />
                隐藏</dd>
        </dl>
        <dl class="bottom">
            <dt>&nbsp;</dt>
            <dd><a class="btn-submit" nctype="submit-btn" href="Javascript: void(0)"><?php echo $lang['nc_submit'];?></a></dd>
        </dl>
    </form>
</div>
<script type="text/javascript">
    $(function(){
        $('a[nctype="submit-btn"]').click(function(){
            $('#addfloor_form').submit();
        });

        $('#addfloor_form').validate({
            errorLabelContainer: $('#ms-warning'),
            invalidHandler: function(form, validator) {
                $('#ms-warning').show();
            },
            submitHandler:function(form){
                ajaxpost('addfloor_form', '<?php echo CIRCLE_SITE_URL;?>/index.php?act=store_floor_list&op=add_goods_floor', 'onerror');
            },
            rules : {
                floor_name : {
                    required : true,
                }
            },
            messages : {
                floor_name  : {
                    required : '楼层名称不能为空',
                }
            }
        });
    });
</script> 