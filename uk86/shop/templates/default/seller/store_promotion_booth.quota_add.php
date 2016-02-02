<?php defined('InUk86') or exit('Access Invalid!');?>
<div class="tabmenu">
  <?php include uk86_template('layout/submenu');?>
</div>
<div class="ncsc-form-default">
  <?php if ($output['menu_key'] == 'booth_quota_add') {?>
  <form id="add_form" action="<?php echo uk86_urlShop('store_promotion_booth', 'booth_quota_add');?>" method="post">
  <?php } else {?>
  <form id="add_form" action="<?php echo uk86_urlShop('store_promotion_booth', 'quota_create_order',array('type'=>'5'));?>" method="post">
  <?php }?>
  	<input type="hidden" value="0" id="price" name="price">
  	<input type="hidden" value="0" id="unit_price" name="unit_price">
    <input type="hidden" name="form_submit" value="ok" />
    <dl>
      <dt><i class="required">*</i>套餐购买数量：</dt>
      <dd>
        <input id="quota_quantity" name="quota_quantity" type="text" class="text w50"/><em class="add-on">月</em><span></span>
        <p class="hint">购买单位为月(30天)，一次最多购买12个月，购买后立即生效，即可添加推荐商品。</p>
        <p class="hint"><?php printf('每月您需要支付%d元。', intval(C('promotion_booth_price')));?></p>
        <p class="hint"><strong style="color: red">相关费用会在店铺的账期结算中扣除</strong></p>
      </dd>
    </dl>
    <div class="bottom">
      <label class="submit-border"><input id="submit_button" type="button" value="<?php echo $lang['nc_submit'];?>" class="submit"></label>
    </div>
  </form>
</div>
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
//		submitHandler:function(form){
//			var unit_price = parseInt(<?php echo C('promotion_booth_price');?>);
//			var quantity = parseInt($("#quota_quantity").val());
//			var price = unit_price * quantity;
//			$("#unit_price").val(unit_price);
//	    $("#price").val(price);
//	    $("#add_form").submit();
//			showDialog('确认购买?您总共需要支付'+price+'元', 'confirm', '', function(){ajaxpost('add_form', '', '', 'onerror');});
//		},
		rules : {
			quota_quantity : {
				required : true,
				digits : true,
				range : [1,12]
			}
		},
		messages : {
			quota_quantity : {
				required : '<i class="icon-exclamation-sign"></i>套餐购买数量不能为空，且必须为1~12之间的整数',
				digits : '<i class="icon-exclamation-sign"></i>套餐购买数量不能为空，且必须为1~12之间的整数',
				range : '<i class="icon-exclamation-sign"></i>套餐购买数量不能为空，且必须为1~12之间的整数'
			}
		}
	});
});
</script> 
