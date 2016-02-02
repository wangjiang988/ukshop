<?php defined('InUk86') or exit('Access Invalid!');?>

<div class="tabmenu">
  <?php include uk86_template('layout/submenu');?>
</div>
<div class="ncsc-form-default">
  <form method="post"  action="index.php?act=store_deliver_set&op=free_delivery" id="my_store_form">
    <input type="hidden" name="form_submit" value="ok" />
    <dl>
      <dt>是否包邮<?php echo $lang['nc_colon'];?></dt>
      <dd>
        <label><input type="radio" name="store_free_delivery" value="1" <?php echo $output['store_free_delivery']?'checked="checked"':'' ?> /> 是 </label>&nbsp;&nbsp;&nbsp;&nbsp;<label><input type="radio" value="0" name="store_free_delivery" <?php echo !$output['store_free_delivery']?'checked="checked"':'' ?>/> 否</label>
        <p class="hint">默认为不包邮，若开启则免运费额度失效</p>
      </dd>
    </dl>
    <div class="bottom">
        <label class="submit-border"><input type="submit" class="submit" value="<?php echo $lang['nc_common_button_save'];?>" /></label>
      </div>
  </form>
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/common_select.js" charset="utf-8"></script> 
<script type="text/javascript">
var SITEURL = "<?php echo SHOP_SITE_URL; ?>";
$(function(){
	$('#my_store_form').validate({
    	submitHandler:function(form){
    		ajaxpost('my_store_form', '', '', 'onerror')
    	},
		rules : {
			store_free_price: {
			required : true,
			number : true
			}
        },
        messages : {
        	store_free_price: {
				required : '请填写金额',
				number : '请正确填写'
			}
        }
    });    
    
});
</script> 
