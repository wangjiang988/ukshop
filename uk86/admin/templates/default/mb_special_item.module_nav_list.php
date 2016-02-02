<?php defined('InUk86') or exit('Access Invalid!');?>
<style type="text/css">
.search-goods{
	border-left:1px solid #bce6f8;
	padding-left:20px;
	min-height:280px;
}
.nav_list{ width:330px;}
.error{color:red; font-weight:100;}
.special_nav_list{float:left; margin:10px 10px 0 10px; display:block; width:60px; height:84px; border:1px solid transparent; position:relative;}
.special_nav_list div{ width:10px; height:10px; display:none; position:absolute; top:-1px; left:51px; color:#FFF; font-size:10px; line-height:8px; text-align:center; background:rgba(0, 153, 204, 0.5); cursor:pointer;}
<?php if($item_edit_flag){ ?>
.special_nav_list:hover{border:1px solid rgba(0, 153, 204, 0.5);}
.special_nav_list:hover div{display:block;}
.special_nav_list:hover a{display:block; color:#FFF;}
<?php } ?>
.special_nav_list img{ display:block; width:60px; height:60px; border:0px; border-radius:16px;}
.special_nav_list span{display:block; line-height:24px; color:#999; text-align:center; font-size:14px;}
.nav_edite{ display:none; width:60px; line-height:18px; color:#FFF; text-align:center; position:absolute; top:66px; left:0px; background:rgba(0, 153, 204, 0.5); font-size:12px;}
</style>
<?php if($item_edit_flag) { ?>
<table class="table tb-type2" id="prompt">
    <tbody>
      <tr class="space odd">
        <th colspan="12" class="nobg"> <div class="title nomargin">
            <h5><?php echo $lang['nc_prompts'];?></h5>
            <span class="arrow"></span> </div>
        </th>
      </tr>
      <tr>
        <td><ul>
            <li>鼠标移动到已有的导航上点击出现的删除按钮可以删除对应的导航</li>
            <li>导航需要上传对应的图片（建议尺寸为88*88px）以及对应的链接</li>
            <li>导航链接请以http://开头</li>
            <li>操作完成后点击保存编辑按钮进行保存</li>
          </ul></td>
      </tr>
    </tbody>
</table>
<?php } ?>
<div class="index_block goods-list">
	<?php if($item_edit_flag) { ?>
	<h3>首页导航版块</h3>
	<?php } ?>
	<div nctype="item_content" class="content">
		<?php if($item_edit_flag) { ?>
	    <h5>内容：</h5>
	    <?php } ?>
	    <div class="nav_list">
	    	<ul>
	    		<?php if(!empty($output['item_info']) && is_array($output['item_info'])){ ?>
	    			<?php foreach ($output['item_info']['item_data'] as $nav_key => $nav_val){ ?>
	    				<li class="special_nav_list"  enctype="<?php echo $nav_key; ?>">
	    					<div nctype="<?php echo $nav_key ?>" class="delete_nav" title="删除">x</div>
	    					<a href="javascript:void(0);" class="nav_edite">编辑</a>
	    					<img src="<?php echo uk86_getMbSpecialImageUrl($nav_val['mb_nav_img']); ?>"/>
	    					<span><?php echo $nav_val['mb_nav_name'] ?></span>
	    					<input type="hidden" name="item_data[<?php echo $nav_key; ?>][mb_nav_img]" value="<?php echo $nav_val['mb_nav_img']; ?>"/>
	    					<input type="hidden" name="item_data[<?php echo $nav_key; ?>][mb_nav_name]" value="<?php echo $nav_val['mb_nav_name']; ?>"/>
	    					<input type="hidden" name="item_data[<?php echo $nav_key; ?>][mb_nav_url]" value="<?php echo $nav_val['mb_nav_url'] ?>"/>
	    				</li>
	    			<?php } ?>
	    		<?php } ?>
	    		<?php if(!empty($output['list']) && is_array($output['list'])){ ?>
	    		  <?php foreach ($output['list'] as $list_key => $list_val){?>
	    		    <?php if($list_val['item_type'] == 'nav_list'){ ?>
	    		      <?php foreach ($list_val['item_data'] as $nav_k => $nav_v){ ?>
	    		        <li class="special_nav_list">
	    					<img src="<?php echo uk86_getMbSpecialImageUrl($nav_v['mb_nav_img']); ?>"/>
	    					<span><?php echo $nav_v['mb_nav_name'] ?></span>
	    					<input type="hidden" name="item_data[<?php echo $nav_k; ?>][mb_nav_img]" value="<?php echo $nav_v['mb_nav_img']; ?>"/>
	    					<input type="hidden" name="item_data[<?php echo $nav_k; ?>][mb_nav_name]" value="<?php echo $nav_v['mb_nav_name']; ?>"/>
	    					<input type="hidden" name="item_data[<?php echo $nav_k; ?>][mb_nav_url]" value="<?php echo $nav_v['mb_nav_url'] ?>"/>
	    				</li>
	    		      <?php } ?>
	    		    <?php } ?>
	    		  <?php } ?>
	    		<?php } ?>
	    	</ul>
	    	<div style="clear: both"></div>
	    </div>
	</div>
</div>
<?php if($item_edit_flag) { ?>
<div class="search-goods">
  <h3>添加导航</h3>
  <h5>导航关键字：<span class="nav_error error"></span></h5>
  <input id="txt_nav_name" type="text" class="txt w200" name="nav_name">
  <h5>导航链接：<span class="nav_url_error error"></span></h5>
  <input id="txt_nav_url" type="text" class="txt w200" name="nav_url"/>
  <h5>导航图片：<span class="img_error error"></span></h5>
  <input type="file" id="nav_img_file" name="special_image"/><br /><br />
  <input type="hidden" name="special_id" value="<?php echo $output['item_info']['special_id']; ?>">
  <a href="javascript:void(0);" class="btn" id="save_nav" onclick = "ajax_submit_form()"><span>保存</span></a>
</div>
<?php } ?>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/ajax.form.js"></script>
<script type="text/javascript">
var height_div = $('.goods-list').height();
$('.search-goods').height(height_div);
function ajax_submit_form(){
	$('.error').html('');
	if($('#txt_nav_name').val() == ''){$('.nav_error').html('*导航关键字不能为空'); return;}
	if($('#txt_nav_url').val().substr(0, 7) != 'http://'){$('.nav_url_error').html('*请输入正确的导航链接'); return;}
	if($('#nav_img_file').val() == ''){$('.img_error').html('*请选择图片'); return;}
	$('#form_item').ajaxSubmit({
		 type : 'post',
	     url : 'index.php?act=mb_special&op=special_image_upload',
		 success : function(data){
		    if(data != ''){
			    if(isNaN($('.content .nav_list ul li').last().attr('enctype'))){
			    	var li_num = 1;
				}else{
			    	var li_num = parseInt($('.content .nav_list ul li').last().attr('enctype')) + 1;
				}
				var dataJson = eval('('+ data +')');
				var html = '<li class="special_nav_list" enctype="'+ li_num +'"><div title="删除" class="delete_nav" nctype="'+ li_num +'">x</div><a href="javascript:void(0);" class="nav_edite">编辑</a><img src="'+ dataJson.image_url +'"/><span>'+ $("#txt_nav_name").val() +'</span><input type="hidden" name="item_data['+ li_num +'][mb_nav_img]" value="'+ dataJson.image_name +'"/><input type="hidden" name="item_data['+ li_num +'][mb_nav_name]" value="'+ $('#txt_nav_name').val() +'"/><input type="hidden" name="item_data['+ li_num +'][mb_nav_url]" value="'+ $('#txt_nav_url').val() +'"/></li>';
				$('.nav_list ul').append(html);
				$('#txt_nav_name,#txt_nav_url,#nav_img_file').val('');
		    }
		}
	});
}
$(document).ready(function(){
	//删除导航操作
	$('.delete_nav').click(function(){
		var ok = confirm('确认删除？');
		if(ok){
			$(this).parent().remove();
		}
	});
	//导航编辑
	$('.nav_edite').click(function(){
		var html = '<div class="nav_edite_dialog"><div class="s-tips"><i></i>不上传图片默认为原来的图片</div><form id="ajax_upload_img"><table id="upload_adv_type" class="table tb-type2"><tbody><tr><td class="required error_title" colspan="2">导航关键字：</td></tr><tr class="noborder"><td colspan="2"><input type="text" calss="txt w200" id="nav_detail_title" value="'+ $(this).siblings('input:eq(1)').val() +'"/></td></tr><tr><td class="required error_url" colspan="2">导航链接：</td></tr><tr class="noborder"><td colspan="2"><input type="text" calss="txt w200" id="nav_detail_url" value="'+ $(this).siblings('input:eq(2)').val() +'"/></td></tr><tr><td class="required" colspan="2">导航图片：</td></tr><tr class="noborder"><td colspan="2"><input type="file" id="nav_detail_img" name="special_image"/></td></tr></tbody><tfoot><tr><td colspan="2"><a class="btn" id="btn_nav_detail" onClick="detail_nav('+ $(this).parent().attr('enctype') +')" href="JavaScript:void(0);"><span>保存</span></a></td></tr></tfoot></table><form></div>';
		html_form('nav_edite_dialog_show', '导航编辑', html, 440);
	});
});

function detail_nav(enctype){
	$('.error').remove();
	var nav_detail_title = $('#nav_detail_title').val();
	var nav_detail_url = $('#nav_detail_url').val();
	var nav_detail_img = $('#nav_detail_img').val();
	if(nav_detail_title == ''){ $('.error_title').append('<label class="error">导航关键字不能为空</label>'); return; }
	if(nav_detail_url == ''){$('.error_url').append('<label class="error">导航链接不能为空</label>'); return;}
	$('.special_nav_list[enctype="' + enctype + '"]').children('span').html(nav_detail_title);
	$('.special_nav_list[enctype="' + enctype + '"]').children('input:eq(1)').val(nav_detail_title);
	$('.special_nav_list[enctype="' + enctype + '"]').children('input:eq(2)').val(nav_detail_url);
	if(nav_detail_img != ''){
		$("#ajax_upload_img").ajaxSubmit({
			type : 'post',
		     url : 'index.php?act=mb_special&op=special_image_upload',
			 success : function(data){
			    if(data != ''){
					var data_Json = eval('('+ data +')');
					$('.special_nav_list[enctype="' + enctype + '"]').children('img').attr('src', data_Json.image_url);
					$('.special_nav_list[enctype="' + enctype + '"]').children('input:eq(0)').val(data_Json.image_name);
				}
			}
		});
	}
	$('#fwin_nav_edite_dialog_show').hide();
}
</script>




