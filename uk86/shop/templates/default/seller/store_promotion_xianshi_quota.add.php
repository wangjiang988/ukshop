<?php defined('InUk86') or exit('Access Invalid!'); ?>

<div class="tabmenu">
  <?php include uk86_template('layout/submenu');?>
</div>
<div class="ncsc-form-default">
  <form id="add_form" action="<?php echo uk86_urlShop('store_promotion_xianshi', 'quota_create_order',array('type'=>'2'));?>" method="post">
  	<input type="hidden" value="0" id="price" name="price">
  	<input type="hidden" value="0" id="unit_price" name="unit_price">
    <dl>
      <dt><i class="required">*</i><?php echo $lang['xianshi_quota_add_quantity'].$lang['nc_colon'];?></dt>
      <dd>
          <input id="quota_quantity" name="quota_quantity" type="text" class="text w30" /><em class="add-on"><?php echo $lang['text_month'];?></em><span></span>
        <p class="hint"><?php echo $lang['xianshi_price_explain1'];?></p>
        <p class="hint"><?php echo $lang['xianshi_price_explain2'].$output['setting_config']['promotion_xianshi_price'].$lang['nc_yuan'];?> ; </p>
        <p class="hint"><strong style="color: red">相关费用会在店铺的账期结算中扣除</strong></p>
      </dd>
    </dl>
    <div class="bottom">
      <label class="submit-border"><input id="submit_button" type="button" class="submit" value="<?php echo $lang['nc_submit'];?>"></label>
    </div>
  </form>
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/common.js" charset="utf-8"></script>
<script type="text/javascript">
$(document).ready(function(){
	$("#submit_button").click(function(){
			var unit_price = <?php echo C('groupbuy_price');?>;
	    var quantity = $("#quota_quantity").val();
	    var price = unit_price * quantity;
	    $("#unit_price").val(unit_price);
	    $("#price").val(price);
	    $("#add_form").submit();
		});
	
    //页面输入内容验证
    $("#add_form").validate({
        errorPlacement: function(error, element){
            var error_td = element.parent('dd').children('span');
            error_td.append(error);
        },
//  	submitHandler:function(form){
//          var unit_price = <?php echo $output['setting_config']['promotion_xianshi_price'];?>;
//          var quantity = $("#quota_quantity").val();
//          var price = unit_price * quantity;
//          $("#unit_price").val(unit_price);
//          $("#price").val(price);
//          $("#add_form").submit();
////          showDialog('<?php echo $lang['xianshi_quota_add_confirm'];?>'+price+'<?php echo $lang['nc_yuan'];?>', 'confirm', '', function(){
////          	ajaxpost('add_form', '', '', 'onerror');
////          	});
//  	},
            rules : {
                quota_quantity : {
                    required : true,
                    digits : true,
                    min : 1,
                    max : 12
                }
            },
                messages : {
                    quota_quantity : {
                        required : "<i class='icon-exclamation-sign'></i><?php echo $lang['xianshi_quota_quantity_error'];?>",
                        digits : "<i class='icon-exclamation-sign'></i><?php echo $lang['xianshi_quota_quantity_error'];?>",
                        min : "<i class='icon-exclamation-sign'></i><?php echo $lang['xianshi_quota_quantity_error'];?>",
                        max : "<i class='icon-exclamation-sign'></i><?php echo $lang['xianshi_quota_quantity_error'];?>"
                    }
                }
    });
});
</script>
