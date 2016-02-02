<?php defined('InUk86') or exit('Access Invalid!');?>
<style type="text/css">
.search-goods{
	border-left:1px solid #bce6f8;
	padding-left:20px;
	min-height:280px;
}
.error{color:red; font-weight:100;}
.class_list{ width:330px;}
.goods_class_list{width:105px; height:37px; float:left; text-align:center; position:relative;}
.goods_class_list:nth-of-type(3n+1){border:1px solid #dedede; border-left:0; border-top:0;}
.goods_class_list:nth-of-type(3n+2){border-bottom:1px solid #dedede;}
.goods_class_list:nth-of-type(3n+3){border:1px solid #dedede; border-right:0; border-top:0;}
.goods_class_list:nth-of-type(1){border-top:1px solid #dedede;}
.goods_class_list:nth-of-type(2){border-top:1px solid #dedede;}
.goods_class_list:nth-of-type(3){border-top:1px solid #dedede;}
.goods_class_list img{width:20px; height:20px; position:relative; top:6px;}
.goods_class_list span{font-size:13px; line-height:37px;}
.search_list {margin:15px 0 15px 0; line-height:18px;}
.search_list a{white-space:nowrap;}
.search_gc_info{width:105px; height:38px; border:1px solid #dedede; margin-left:20px; line-height:38px; text-align:center; font-size:13px;}
.goods_class_list div{ width:10px; height:10px; display:none; position:absolute; top:-1px; left:95px; color:#FFF; font-size:10px; line-height:8px; text-align:center; background:#00a4d9; cursor:pointer;}
<?php if($item_edit_flag){ ?>
.goods_class_list:hover{background:#bce6f8;}
.goods_class_list:hover div{display:block;}
<?php } ?>
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
            <li>鼠标移动到已有的商品分类上点击出现的删除按钮可以删除对应商品分类</li>
            <li>推进分类需要上传对应的图片（建议尺寸为36*36px）</li>
            <li>操作完成后点击保存编辑按钮进行保存</li>
          </ul></td>
      </tr>
    </tbody>
</table>
<?php } ?>
<div class="index_block goods-list">
  <?php if($item_edit_flag) { ?>
  <h3>首页推进商品分类版块</h3>
  <?php } ?>
  <div nctype="item_content" class="content">
    <div class="class_list">
      <ul>
        <?php if(!empty($output['item_info']) && is_array($output['item_info'])){ ?>
	      <?php foreach ($output['item_info']['item_data'] as $gc_key => $gc_val){ ?>
	        <li class="goods_class_list" enctype="<?php echo $gc_key; ?>">
	          <div title="删除" class="delete_gc" nctype="<?php echo $gc_key ?>">x</div>
	          <img src="<?php echo uk86_getMbSpecialImageUrl($gc_val['mb_gc_img']); ?>"/>
	          <span>&nbsp;<?php echo $gc_val['mb_gc_name'] ?></span>
	          <input type="hidden" name="item_data[<?php echo $gc_key; ?>][mb_gc_img]" value="<?php echo $gc_val['mb_gc_img']; ?>"/>
    		  <input type="hidden" name="item_data[<?php echo $gc_key; ?>][mb_gc_name]" value="<?php echo $gc_val['mb_gc_name']; ?>"/>
	        </li>
	      <?php } ?>
	    <?php } ?>
	    <?php if(!empty($output['list']) && is_array($output['list'])){ ?>
    		<?php foreach ($output['list'] as $list_key => $list_val){?>
    		  <?php if($list_val['item_type'] == 'class_list'){ ?>
    		    <?php foreach ($list_val['item_data'] as $gc_k => $gc_v){ ?>
    		      <li class="goods_class_list">
    				<img src="<?php echo uk86_getMbSpecialImageUrl($gc_v['mb_gc_img']); ?>"/>
          			<span>&nbsp;<?php echo $gc_v['mb_gc_name'] ?></span>
    				<input type="hidden" name="item_data[<?php echo $gc_k; ?>][mb_gc_img]" value="<?php echo $gc_v['mb_gc_img']; ?>"/>
    				<input type="hidden" name="item_data[<?php echo $gc_k; ?>][mb_gc_name]" value="<?php echo $gc_v['mb_gc_name']; ?>"/>
    			  </li>
    		    <?php } ?>
    		  <?php } ?>
    		<?php } ?>
    	<?php } ?>
      </ul>
      <div style="clear: both;"></div>
    </div>
  </div>
</div>
<?php if($item_edit_flag) { ?>
<div class="search-goods">
  <h3>添加分类</h3>
  <h5>图片上传：<span class="calss_img_error error"></span></h5>
  <input type="file" name="special_image" id="goods_class_image"/><br /><br />
  <h5>商品分类关键字：<span class="class_error error"></span></h5>
  <input id="txt_class_name" type="text" class="txt w200" name="goods_class_name">
  <a class="btn-search" title="搜索" href="javascript:void(0);" id="search_goods_class" style="margin-left: 0px;"></a>
  <div class="search_list"></div>
  <a href="javascript:void(0);" class="btn" id="save_goods_class" onClick="save_gc_info()"><span>保存</span></a>
</div>
<?php } ?>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/ajax.form.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('#txt_class_name').focus(function(){$('.class_error').html('');});
	$('#goods_class_image').change(function(){$('.calss_img_error').html('');});
	$('#search_goods_class').click(function(){
		var goods_class = $('#txt_class_name').val();
		if(goods_class == ''){$('.class_error').html('*请输入关键字'); return;}
		$.post('index.php?act=mb_special&op=search_goods_class', {class_name:goods_class}, function(data){
			var dataJson = eval('('+ data +')');
			var html = '';
			for(var i = 0; i < dataJson.length; i++){
				html += '<a href="javascript:void(0);" onClick="select_gc_info(this)" id="'+ dataJson[i].gc_id +'">'+ dataJson[i].gc_name +'</a>';
				if(i < dataJson.length-1){
					html += ' | ';
				}
			}
			if(html == ''){
				showError('没有该商品分类');
				return;
			}
			$('.search_list').html(html);
		});
	});
	$('.delete_gc').click(function(){
		var ok = confirm('确认删除？');
		if(ok){
			$(this).parent().remove();
		}
	});
});
function select_gc_info(e){
	$('.class_error').html('');
	var gc_name = e.innerHTML;
	var gc_id = e.id;
	html = '<div class="search_gc_info" nctype="'+ gc_id +'">'+ gc_name +'</div>';
	$('.search_list').html(html);
}
function save_gc_info(){
	if($('#goods_class_image').val() == ''){$('.calss_img_error').html('*请选择上传的图片'); return;}
	var gc_name = $('.search_gc_info').html();
	var gc_id = $('.search_gc_info').attr('nctype');
	if(!gc_name){$('.class_error').html('*请选择商品分类'); return;}
	var save_gc_id = $('ul [enctype="'+ gc_id +'"]').attr('enctype');
	if(save_gc_id > 0){showError('该推进分类已存在，请勿重复添加');return;}
	$('#form_item').ajaxSubmit({
		 type : 'post',
	     url : 'index.php?act=mb_special&op=special_image_upload',
		 success : function(data){
		    if(data != ''){
				var dataJson = eval('('+ data +')');
				var html = '<li class="goods_class_list" enctype="'+ gc_id +'"><div title="删除" class="delete_gc" nctype="'+ gc_id +'">x</div><img src="'+ dataJson.image_url +'"/><span>&nbsp;'+ gc_name +'</span><input type="hidden" name="item_data['+ gc_id +'][mb_gc_img]" value="'+ dataJson.image_name +'"/><input type="hidden" name="item_data['+ gc_id +'][mb_gc_name]" value="'+ gc_name +'"/></li>';
 				$('.class_list ul').append(html);
 				$('.search_gc_info').remove();
		    }
		}
	});
}
</script>



