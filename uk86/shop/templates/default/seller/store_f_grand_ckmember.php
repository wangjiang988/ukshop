<?php defined('InUk86') or exit('Access Invalid!');?>
<div class="tabmenu">
  <?php include uk86_template('layout/submenu');?>
</div>
<div class="tabmenu">
<form method="get" action="index.php">
    <table class="search-form">
	    <input type="hidden" id='act' name='act' value='store_fcode_grand' />
	    <input type="hidden" id='op' name='op' value='fcode_grand' />
    	<tr>
    		<td width="450">&nbsp;</td>
    		<td><select name="search_field_name" class="w80"><option <?php echo ($output['search_field_name'] == 'member_name')?'selected="selected"':''; ?> value="member_name">会员名</option><option <?php echo ($output['search_field_name'] == 'member_truename')?'selected="selected"':''; ?> value="member_truename">真实姓名</option></select></td>
    		<td><input type="text" class="text w150" name="search_field_value" value="<?php echo $output['search_field_value']; ?>"/></td>
    		<td><select name="search_sort">
				<option value="">排序</option>
				<option <?php echo ($output['search_sort'] == 'member_login_time desc')?'selected="selected"':''; ?> value="member_login_time desc">最后登录</option>
				<option <?php echo ($output['search_sort'] == 'member_login_num desc')?'selected="selected"':''; ?> value="member_login_num desc">登录次数</option>
				</select></td>
    		<td><select name="search_grade">
				<option value="-1">会员级别</option>
				<option <?php echo ($_GET['search_grade'] == '0')?'selected="selected"':''; ?> value="0">V0</option>
				<option <?php echo ($_GET['search_grade'] == '1')?'selected="selected"':''; ?> value="1">V1</option>
				<option <?php echo ($_GET['search_grade'] == '2')?'selected="selected"':''; ?> value="2">V2</option>
				<option <?php echo ($_GET['search_grade'] == '3')?'selected="selected"':''; ?> value="3">V3</option>
				</select></td>
    		<td class="tc"><input type="submit" value="搜索" class="submit" style="border:1px solid #CCC; line-height:26px;"/></td>
    	</tr>
    </table>
</form>
<form id="select_form" method="post" action="index.php">
<input type="hidden" id='act' name='act' value='store_fcode_grand' />
<input type="hidden" id='op' name='op' value='fcode_grand_all' />
<input type="hidden" name="goods_commonid" id="goods_commonid" value="<?php echo $output['common_id']; ?>"/>
<table class="ncsc-default-table">
	<thead>
      <tr>
        <th class="w50"></th>
        <th class="tl">会员</th>
        <th class="w150">登录次数</th>
        <th class="w150">经验值</th>
        <th class="w150">级别</th>
        <th class="w100"><?php echo $lang['nc_handle'];?></th>
      </tr>
    </thead>
    <tbody>
    	<?php if(!empty($output['member_list']) && is_array($output['member_list'])){ ?>
    		<?php foreach($output['member_list'] as $k => $v){ ?>
    			<tr>
    				<th><input type="checkbox" name="member_id[]" class="check_member" value="<?php echo $v['member_id']; ?>"></th>
    				<th style="text-align:left;">
    					<p><strong><?php echo $v['member_name'] ?></strong><span style="color: 5da4d9;">（真实姓名：<?php echo $v['member_truename']?$v['member_truename']:'保密'; ?>）</span></p>
    					<p>注册时间：<?php echo $v['member_time'] ?></p>
    				</th>
    				<th style="text-align: center;"><?php echo $v['member_login_num']; ?></th>
    				<th style="text-align: center;"><?php echo $v['member_points']; ?></th>
    				<th style="text-align: center;"><?php echo $v['member_grade'];?></th>
    				<th style="text-align: center;"><a nctype="<?php echo $v['member_id']; ?>" class="fafang" href="javascript:void(0);">发放</a></th>
    			</tr>
    		<?php } ?>
    	<?php } ?>
    </tbody>
    <tfoot>
      <?php  if (!empty($output['member_list'])) { ?>
      <tr>
      	<th colspan="20" style="text-align: left;"><label><input style="position:relative; top:1px;" id="check_all" type="checkbox"/>&nbsp;&nbsp;全 选</label><a class="ncsc-btn-mini" style="margin-left: 20px;" href="javascript:void(0);">发  放</a></th>
      </tr>
      <tr><td colspan="20"><div class="pagination"><?php echo $output['page']; ?></div></td></tr>
      <?php } ?>
    </tfoot>
</table>
</form>
</div>
<script type="text/javascript">
$(document).ready(function(){
	//全选
	$("#check_all").live('click', function(){
		if($(this).attr('checked')){
			$('.check_member').attr('checked', 'checked');
			var member_num = $('.check_member').length;
			var member_arr = [];
			for(var i = 0; i < member_num; i++){
				member_arr[i] = $('.check_member').eq(i).val();
			}
			$.post('index.php?act=store_fcode_grand&op=ajax_ckmember_all', {goods_commonid:$('#goods_commonid').val(), member_array:member_arr}, function(data){
				if(data != ''){
					var data_json = eval('('+ data +')');
					var member_names = data_json.member_name.join('、');
					var is_ok = confirm('会员（'+ member_names +'）已拥有该商品的F码\n确认重复发放？');
					if(!is_ok){
						for(var j = 0; j < data_json.member_id.length; j++){
							$('.check_member[value='+data_json.member_id[j]+']').removeAttr('checked');
						}
					}
				}
			});
		}else{
			$('.check_member').removeAttr('checked');
		}
	});

	$('.check_member').live('click', function(){
		if($(this).attr('checked')){
			$.post('index.php?act=store_fcode_grand&op=ajax_ckmember_one', {goods_commonid:$('#goods_commonid').val(), member_id:$(this).val()}, function(data){
				if(data != ''){
					var data_json = eval('('+ data +')');
					var isok = confirm('会员（'+data_json.member_name+'）已拥有该商品F码\n确认重复发放？');
					if(!isok){
						$('.check_member[value='+ data_json.member_id +']').removeAttr('checked');
					}
				}
			});
		}
	});

	$('.fafang').live('click', function(){
		var member_id = $(this).attr('nctype');
		var is_true = true;
		$.post('index.php?act=store_fcode_grand&op=ajax_ckmember_one', {goods_commonid:$('#goods_commonid').val(), member_id:member_id}, function(data){
			if(data != ''){
				var data_json = eval('('+ data +')');
				var is_ko = confirm('该会员已拥有该商品F码\n确认重复发放？');
				if(is_ko){
					is_true = true;
				}else{
					is_true = false;
				}
			}
			if(is_true){
				var goods_commonid = $('#goods_commonid').val();
				window.location.href = 'index.php?act=store_fcode_grand&op=fcode_grand_one&goods_commonid='+goods_commonid+'&member_id='+member_id;
			}
		});
	});

	$('.ncsc-btn-mini').live('click', function(){
		$('#select_form').submit();
	});
});
</script>