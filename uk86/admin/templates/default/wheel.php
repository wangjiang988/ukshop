<?php defined('InUk86') or exit('Access Invalid!');?>
<div class="page">
	<div class="fixed-bar">
	    <div class="item-title">
			<h3><?php echo $lang['nc_wheel']?></h3>
			<ul class="tab-base">
		    	<li><a href = "index.php?act=wheel&op=wheelList"><span><?php echo $lang['nc_wheel_list'];?></span></a></li>
		    	<li><a  class="current"><span><?php echo $output['setting']?$lang['nc_wheel_seetin']:$lang['nc_wheel_add'];?></span></a></li>
			</ul>
	    </div>
    </div>
    <div class="fixed-empty"></div>
    <table class="table tb-type2" id="prompt">
    <tbody>
      <tr class="space odd">
        <th class="nobg" colspan="12"><div class="title">
            <h5><?php echo $lang['nc_prompts'];?></h5>
            <span class="arrow"></span></div></th>
      </tr>
      <tr>
        <td><ul>
            <li><?php echo $lang['wheel_setting_help'];?></li>
            <li><?php echo $lang['wheel_setting_help1'];?></li>
          </ul></td>
      </tr>
    </tbody>
  </table>
    <form method="post" name="wheelForm" id="wheelForm">
    	<input type="hidden" name="form_submit" value="ok" />
    	<input type="hidden" name="wheel_id" value="<?php echo $output['wheel_info']['wheel_id']; ?>"/>
    	<table class="table tb-type2">
    		<tbody>
    			<!-- 大转盘活动名称 -->
		        <tr class="noborder">
		          	<td colspan="2"><label class="validation" for="wheel_title"><?php echo $lang['nc_wheel_title'] ?>:</label></td>
		        </tr>
		        <tr class="noborder">
			    	<td class="vatop rowform"><input type="text" id="wheel_title" name="wheel_title" class="txt" value="<?php echo $output['wheel_info']['wheel_title'] ?>"></td>
			    	<td class="vatop tips"></td>
		        </tr>
		        <!-- 大转盘开启时间 -->
		        <tr class="noborder">
		          	<td colspan="2" class='required'><label class="validation"><?php echo $lang['nc_wheel_start_time'] ?>:</label></td>
		        </tr>
		        <tr class="noborder">
			    	<td class="vatop rowform"><input type="text" id="wheel_start_time" name="wheel_start_time" class="txt time" value="<?php echo $output['wheel_info']['wheel_start_time']?date('Y-m-d H:i:s', $output['wheel_info']['wheel_start_time']):''; ?>"></td>
			    	<td class="vatop tips"></td>
		        </tr>
		        
		        <!-- 大转盘结束时间 -->
		        <tr class="noborder">
		          	<td colspan="2" class='required'><label class="validation"><?php echo $lang['nc_wheel_end_time'] ?>:</label></td>
		        </tr>
		        <tr class="noborder">
			    	<td class="vatop rowform"><input type="text" id="wheel_end_time" name="wheel_end_time" class="txt time" value="<?php echo $output['wheel_info']['wheel_end_time']?date('Y-m-d H:i:s', $output['wheel_info']['wheel_end_time']):''; ?>"></td>
			    	<td class="vatop tips"></td>
		        </tr>
		        <!-- 奖品开始 -->
		        <tr>
		        	<td colspan="2"><label class="validation"><?php echo $lang['wheel_prize_setting']; ?>:</label></td>
		        </tr>
		        <tr>
		        	<td class="" colspan="2">
		        	<table class="table tb-type2 nomargin">
		        		<thead>
			                <tr class="space">
			                	<th width='10%'></th>
			                    <th width='20%'><?php echo $lang['wheel_prize_name']; ?></th>
			                    <th width='20%'><?php echo $lang['wheel_prize_chance']; ?></th>
			                    <th width='20%'><?php echo $lang['wheel_prize_num']; ?></th>
			                    <th width='9%'><?php echo $lang['prize_give']; ?></th>
                                <th width="5%"></th>
			                </tr>
	              		</thead>
			            <tbody class="lottery-list">
			            	<?php if(intval($output['wheel_info']['wheel_id']) > 0) {
			            		foreach ($output['prize_info'] as $k => $v){?>
			            			<tr class="thead">
					                    <th><label><?php echo $lang['nc_wheel_prize'].$output['num_ch'][$k] ?>:</label></th>
					                    <th><input type="text" id="wheel_prize_name_<?php echo ($k+1) ?>" name="wheel_prize_name_<?php echo ($k+1) ?>" value="<?php echo $v['name'] ?>"></th>
					                    <th><input type="text" id="wheel_prize_chance_<?php echo ($k+1) ?>" class="prize-chance" name="wheel_prize_<?php echo ($k+1) ?>" value="<?php echo $v['chance'] ?>">&nbsp;&nbsp;<span class="red"></span></th>
					                    <th><input type="text" id="wheel_prize_num_<?php echo ($k+1) ?>" class="prize-num" name="wheel_prize_num_<?php echo ($k+1) ?>" value='<?php echo $v['num']?$v['num']:0; ?>'>&nbsp;&nbsp;<span class="red"></span></th>
					                	<!-- <th><input type="checkbox" id="wheel_prize_give_<?php echo ($k+1) ?>" name="wheel_prize_give_<?php echo ($k+1) ?>" <?php if($v['give'] == 1){echo "checked='checked'";} ?> value='1' ></th> -->
					                	<th>
					                		<select id="wheel_prize_give_<?php echo ($k+1) ?>" name="wheel_prize_give_<?php echo ($k+1) ?>">
					                			<option value="0"><?php echo $lang['lottery_type_0'] ?></option>
					                			<option value="1" <?php if($v['give'] == 1){echo 'selected="selected"';} ?>><?php echo $lang['lottery_type_1'] ?></option>
					                			<option value="2" <?php if($v['give'] == 2){echo 'selected="selected"';} ?>><?php echo $lang['lottery_type_2'] ?></option>
					                			<option value="3" <?php if($v['give'] == 3){echo 'selected="selected"';} ?>><?php echo $lang['lottery_type_3'] ?></option>
					                			<option value="4" <?php if($v['give'] == 4){echo 'selected="selected"';} ?>><?php echo $lang['lottery_type_4'] ?></option>
					                		</select>
					                	</th>
					                	<th></th>
                                    </tr>
			            	<?php }
			            	}else{
			            		for($k = 0; $k < 5; $k++){ ?>
			            			<tr class="thead">
					                    <th width='180'><label><?php echo $lang['nc_wheel_prize'].$output['num_ch'][$k] ?>:</label></th>
					                    <th><input type="text" id="wheel_prize_name_<?php echo ($k+1) ?>" name="wheel_prize_name_<?php echo ($k+1) ?>" ></th>
					                    <th><input type="text" id="wheel_prize_chance_<?php echo ($k+1) ?>" class="prize-chance" name="wheel_prize_<?php echo ($k+1) ?>" >&nbsp;&nbsp;<span class="red"></span></th>
					                    <th><input type="text" id="wheel_prize_num_<?php echo ($k+1) ?>" class="prize-num" name="wheel_prize_num_<?php echo ($k+1) ?>" value='0'>&nbsp;&nbsp;<span class="red"></span></th>
					                	<!-- <th><input type="checkbox" id="wheel_prize_give_<?php echo ($k+1) ?>" name="wheel_prize_give_<?php echo ($k+1) ?>" value = '1' ></th> -->
					                	<th>
					                		<select id="wheel_prize_give_<?php echo ($k+1) ?>" name="wheel_prize_give_<?php echo ($k+1) ?>">
					                			<option value="0"><?php echo $lang['lottery_type_0'] ?></option>
					                			<option value="1"><?php echo $lang['lottery_type_1'] ?></option>
					                			<option value="2"><?php echo $lang['lottery_type_2'] ?></option>
					                			<option value="3"><?php echo $lang['lottery_type_3'] ?></option>
					                			<option value="4"><?php echo $lang['lottery_type_4'] ?></option>
					                		</select>
					                	</th>
					                	<th></th>
                                    </tr>
			            	<?php 	}
			            	}?>
			            </tbody>  
		        	</table>
		        	</td>
		        </tr>
        		<input type="hidden" name="lottery_length" id="lottery_length" />
		        <!-- 奖品结束 -->
		        
		        <!-- 开启大转盘 -->
		        <tr class="noborder">
		            <td colspan="2" class="required"><label><?php echo $lang['nc_wheel_start']; ?>:</label></td>
		        </tr>
		        <tr class="noborder">
		            <td class="vatop rowform onoff">
			            <label for="wheel_isuse_1" class="cb-enable <?php if($output['wheel_setting'] == '1'){ ?>selected<?php } ?>" title="<?php echo $lang['open'];?>"><span><?php echo $lang['open'];?></span></label>
			            <label for="wheel_isuse_0" class="cb-disable <?php if($output['wheel_setting'] == '0' || $output['wheel_setting'] == ''){ ?>selected<?php } ?>" title="<?php echo $lang['close'];?>"><span><?php echo $lang['close'];?></span></label>
			            <input type="radio" id="wheel_isuse_1" name="wheel_isuse" value="1" checked="checked">
			            <input type="radio" id="wheel_isuse_0" name="wheel_isuse" value="0">
		            <td class="vatop tips"></td>
		        </tr>
		    </tbody>
		    <tfoot>
		        <tr class="tfoot">
		          	<td colspan="2"><a href="JavaScript:void(0);" class="btn" id="submitBtn"><span><?php echo $lang['nc_submit'];?></span></a></td>
		        </tr>
	        </tfoot>
    	</table>
    </form>
</div>
<link type="text/css" rel="stylesheet" href="<?php echo RESOURCE_SITE_URL."/js/jquery-ui/themes/ui-lightness/jquery.ui.css";?>"/>
<script src="<?php echo RESOURCE_SITE_URL."/js/jquery-ui/jquery.ui.js";?>"></script> 
<script src="<?php echo RESOURCE_SITE_URL."/js/jquery-ui/i18n/zh-CN.js";?>" charset="utf-8"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui-timepicker-addon/jquery-ui-timepicker-addon.min.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui-timepicker-addon/jquery-ui-timepicker-addon.min.css"  /> 
<script>
var html = "<a class='del' href='javascript:void(0)' onclick='del_tr()'>删除</a> | <a class='add' href='javascript:void(0)' onclick='add_tr()'>增加</a>";
var length = $('.thead').length;
var num_cn = ['一','二','三','四','五','六','七','八','九','十','十一','十二','十三','十四','十五','十六','十七','十八','十九','二十'];
$(function(){
	$('#submitBtn').click(function(){
		if($("#wheelForm").valid()){
		     $("#wheelForm").submit();
		}
	});
	$('.prize-num').blur(function(){
		if($(this).val() < 0){
			$(this).siblings('span').html('<?php echo $lang['prize_num_setting'] ?>');
			$(this).focus();
		}
		$(this).change(function(){
			$(this).siblings('span').html('');
		});
	});
	$('.prize-chance').blur(function(){
		if($(this).val() < 0){
			$(this).siblings('span').html('<?php echo $lang['prize_chance_setting'] ?>');
			$(this).focus();
		}
		$(this).change(function(){
			$(this).siblings('span').html('');
		});
	});
	$('#lottery_length').val(length);
	$('.thead').last().children('th').last().html(html);
});
function del_tr(){
	if(length <= 5){
		alert('奖品数目最少为5个');
		return;
	}
	$('.thead').last().remove();
	length--;
	$('#lottery_length').val(length);
	$('.thead').last().children('th').last().html(html);
}
function add_tr(){
	if(length >= 20){
		alert('奖品数目最多为20个');
		return;
	}
	$('.thead').last().children('th').last().html('');
	var tr_html = '<tr class="thead"><th width="180"><label><?php echo $lang['nc_wheel_prize']?>'+num_cn[length]+':</label></th><th><input type="text" id="wheel_prize_name_'+(length+1)+'" name="wheel_prize_name_'+(length+1)+'" ></th><th><input type="text" id="wheel_prize_chance_'+(length+1)+'" class="prize-chance" name="wheel_prize_'+(length+1)+'" >&nbsp;&nbsp;<span class="red"></span></th><th><input type="text" id="wheel_prize_num_'+(length+1)+'" class="prize-num" name="wheel_prize_num_'+(length+1)+'" value="0">&nbsp;&nbsp;<span class="red"></span></th><th><select id="wheel_prize_give_'+(length+1)+'" name="wheel_prize_give_'+(length+1)+'"><option value="0"><?php echo $lang["lottery_type_0"] ?></option><option value="1"><?php echo $lang["lottery_type_1"] ?></option><option value="1"><?php echo $lang["lottery_type_2"] ?></option><option value="3"><?php echo $lang["lottery_type_3"] ?></option><option value="4"><?php echo $lang['lottery_type_4'] ?></option></select></th><th></th></tr>';
	length++;
	$('#lottery_length').val(length);
	$('.thead').last().after(tr_html);
	$('.thead').last().children('th').last().html(html);
}
$(document).ready(function(){
	$('#wheel_start_time').datetimepicker({
        controlType: 'select'
 	});
	$('#wheel_end_time').datetimepicker({
        controlType: 'select'
 	});
});
</script>