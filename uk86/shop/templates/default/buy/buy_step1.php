<?php defined('InUk86') or exit('Access Invalid!');?>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/common_select.js"></script>

<form method="post" id="order_form" name="order_form" action="index.php">
<?php include uk86_template('buy/buy_fcode');?>
<div class="ncc-main">
  <div class="ncc-title">
    <h3><?php echo $lang['cart_index_ensure_info'];?></h3>
    <h5>请仔细核对填写收货、发票等信息，以确保物流快递及时准确投递。</h5>
  </div>

    <?php if($output['mentioning'] == 1){ ?>
    	<span>&nbsp;&nbsp;是否门店自提：&nbsp;&nbsp;&nbsp;&nbsp;</span>
    	<label><input type="radio" value="1" checked="checked" name="mention_radio" id="mention_radio_yes"  /> 是</label>&nbsp;&nbsp;&nbsp;&nbsp;
    	<label><input type="radio" value="0" name="mention_radio" id="mention_radio_no" /> 否</label>
    	<br/><br/>
    <?php } else { ?>
        <span>&nbsp;&nbsp;是否门店自提：&nbsp;&nbsp;&nbsp;&nbsp;</span>
        <label><input type="radio" value="1" name="mention_radio" id="mention_radio_yes" <?php echo $_POST['store_mention'] == 1?'checked="checked"':'' ?> /> 是</label>&nbsp;&nbsp;&nbsp;&nbsp;
        <label><input type="radio" value="0" name="mention_radio" id="mention_radio_no" <?php echo $_POST['store_mention'] == 1?'':'checked="checked"' ?>/> 否</label>
        <br/><br/>
    <?php } ?>
    <span id="buy_address"><?php include uk86_template('buy/buy_address');?></span>
    <div class="ncc-receipt-info" id="store_address">
	  <div class="ncc-receipt-info-title">
	    <h3>店铺信息</h3>
	  </div>
	  <div id="addr_list" class="ncc-candidate-items">
	    <ul>
	      <li><span class="true-name"><?php echo $output['store_info']['live_store_name'] ?></span><span class="address"><?php echo $output['store_info']['live_store_address'] ?></span><span class="phone"><i class="icon-mobile-phone"></i> <?php echo $output['store_info']['live_store_tel'] ?></span><span>公交：<?php echo $output['store_info']['live_store_bus'] ?></span></li>
	    </ul>
	  </div>
	</div>
    <?php include uk86_template('buy/buy_payment');?>
    <?php include uk86_template('buy/buy_invoice');?>
    <?php include uk86_template('buy/buy_goods_list');?>
    <?php include uk86_template('buy/buy_amount');?>
    <input value="buy" type="hidden" name="act">
    <input value="buy_step2" type="hidden" name="op">
    <!-- 来源于购物车标志 -->
    <input value="<?php echo $output['ifcart'];?>" type="hidden" name="ifcart">

    <!-- offline/online -->
    <input value="online" name="pay_name" id="pay_name" type="hidden">

    <!-- 是否保存增值税发票判断标志 -->
    <input value="<?php echo $output['vat_hash'];?>" name="vat_hash" type="hidden">

    <!-- 收货地址ID -->
    <input value="<?php echo $output['address_info']['address_id'];?>" name="address_id" id="address_id" type="hidden">

    <!-- 城市ID(运费) -->
    <input value="" name="buy_city_id" id="buy_city_id" type="hidden">

    <!-- 记录所选地区是否支持货到付款 第一个前端JS判断 第二个后端PHP判断 -->
    <input value="" id="allow_offpay" name="allow_offpay" type="hidden">
    <input value="" id="allow_offpay_batch" name="allow_offpay_batch" type="hidden">
    <input value="" id="offpay_hash" name="offpay_hash" type="hidden">
    <input value="" id="offpay_hash_batch" name="offpay_hash_batch" type="hidden">

    <!-- 默认使用的发票 -->
    <input value="<?php echo $output['inv_info']['inv_id'];?>" name="invoice_id" id="invoice_id" type="hidden">
    <input value="<?php echo uk86_getReferer();?>" name="ref_url" type="hidden">
</div>
</form>
<script type="text/javascript">
var SUBMIT_FORM = true;
//计算总运费和每个店铺小计
function calcOrder() {
    var allTotal = 0;
    $('em[nc_type="eachStoreTotal"]').each(function(){
        store_id = $(this).attr('store_id');
        var eachTotal = 0;
        if ($('#eachStoreFreight_'+store_id).length > 0) {
        	eachTotal += parseFloat($('#eachStoreFreight_'+store_id).html());
	    }
        if ($('#eachStoreGoodsTotal_'+store_id).length > 0) {
        	eachTotal += parseFloat($('#eachStoreGoodsTotal_'+store_id).html());
	    }
        if ($('#eachStoreManSong_'+store_id).length > 0) {
        	eachTotal += parseFloat($('#eachStoreManSong_'+store_id).html());
	    }
        if ($('#eachStoreVoucher_'+store_id).length > 0) {
        	eachTotal += parseFloat($('#eachStoreVoucher_'+store_id).html());
        }
        $(this).html(number_format(eachTotal,2));
        allTotal += eachTotal;
    });
    $('#orderTotal').html(number_format(allTotal,2));
}
$(function(){
    var store_name = $('em[nc_type="eachStoreTotal"]').attr('store_id');
	var freight = $('#eachStoreFreight_'+store_name).text();
    $.ajaxSetup({
        async : false
    });
    $('select[nctype="voucher"]').on('change',function(){
        if ($(this).val() == '') {
        	$('#eachStoreVoucher_'+items[1]).html('-0.00');
        } else {
            var items = $(this).val().split('|');
            $('#eachStoreVoucher_'+items[1]).html('-'+number_format(items[2],2));
        }
        calcOrder();
    });

    <?php if (!empty($output['available_pd_amount']) || !empty($output['available_rcb_amount'])) { ?>
    function showPaySubmit() {
        if ($('input[name="pd_pay"]').attr('checked') || $('input[name="rcb_pay"]').attr('checked')) {
        	$('#pay-password').val('');
        	$('#password_callback').val('');
        	$('#pd_password').show();
        } else {
        	$('#pd_password').hide();
        }
    }

    $('#pd_pay_submit').on('click',function(){
        if ($('#pay-password').val() == '') {
        	showDialog('请输入支付密码', 'error','','','','','','','','',2);return false;
        }
        $('#password_callback').val('');
		$.get("index.php?act=buy&op=check_pd_pwd", {'password':$('#pay-password').val()}, function(data){
            if (data == '1') {
            	$('#password_callback').val('1');
            	$('#pd_password').hide();
            } else {
            	$('#pay-password').val('');
            	showDialog('支付密码码错误', 'error','','','','','','','','',2);
            }
        });
    });
    <?php } ?>

    <?php if (!empty($output['available_rcb_amount'])) { ?>
    $('input[name="rcb_pay"]').on('change',function(){
    	showPaySubmit();
    	if ($(this).attr('checked') && !$('input[name="pd_pay"]').attr('checked')) {
        	if (<?php echo $output['available_rcb_amount']?> >= parseFloat($('#orderTotal').html())) {
            	$('input[name="pd_pay"]').attr('checked',false).attr('disabled',true);
        	}
    	} else {
    		$('input[name="pd_pay"]').attr('disabled',false);
    	}
    });
    <?php } ?>

    <?php if (!empty($output['available_pd_amount'])) { ?>
    $('input[name="pd_pay"]').on('change',function(){
    	showPaySubmit();
    	if ($(this).attr('checked') && !$('input[name="rcb_pay"]').attr('checked')) {
        	if (<?php echo $output['available_pd_amount']?> >= parseFloat($('#orderTotal').html())) {
            	$('input[name="rcb_pay"]').attr('checked',false).attr('disabled',true);
        	}
    	} else {
    		$('input[name="rcb_pay"]').attr('disabled',false);
    	}    	
    });
    <?php } ?>
	if(<?php echo $output['mentioning']?1:0 ?> == 1){
// 		var store_id = $('em[nc_type="eachStoreTotal"]').attr('store_id');
 		$('#eachStoreFreight_'+store_name).html('0.00');
//		$('#freight_sotre').hide();
		calcOrder();
//		$('#buy_address').hide();
		$('#store_address').show();
//		$('#buy_city_id').val(0);
		ableSubmitOrder();
	}else{
		$('#store_address').hide();
//		$('#freight_sotre').show();
		$('#eachStoreFreight_'+store_name).html(freight);
		calcOrder();
	}
	$('#mention_radio_yes').click(function(){
// 		var store_id = $('em[nc_type="eachStoreTotal"]').attr('store_id');
 		$('#eachStoreFreight_'+store_name).html('0.00');
//		$('#freight_sotre').hide();
		calcOrder();
//		$('#buy_address').hide();
		$('#store_address').show();
//		$('#buy_city_id').val(0);
		ableSubmitOrder();
	});
	$('#mention_radio_no').click(function(){
//		$('#buy_address').show();
		$('#store_address').hide();
//		$('#freight_sotre').show();
		$('#eachStoreFreight_'+store_name).html(freight);
		calcOrder();
		if(<?php echo intval($output['address_info']['address_id'])?> < 1){
			disableSubmitOrder();
		}
	});
});
function disableOtherEdit(showText){
	$('a[nc_type="buy_edit"]').each(function(){
	    if ($(this).css('display') != 'none'){
			$(this).after('<font color="#B0B0B0">' + showText + '</font>');
		    $(this).hide();
	    }
	});
	disableSubmitOrder();
}
function ableOtherEdit(){
	$('a[nc_type="buy_edit"]').show().next('font').remove();
	ableSubmitOrder();

}
function ableSubmitOrder(){
	$('#submitOrder').on('click',function(){uk86_submitNext()}).css('cursor','').addClass('ncc-btn-acidblue');
}
function disableSubmitOrder(){
	$('#submitOrder').unbind('click').css('cursor','not-allowed').removeClass('ncc-btn-acidblue');
}


</script> 
