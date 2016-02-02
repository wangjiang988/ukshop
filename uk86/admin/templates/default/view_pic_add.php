<?php defined('InUk86') or exit('Access Invalid!');?>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo $lang['view_detail_edit'];?></h3>
      <ul class="tab-base">
        <li><a href="index.php?act=view&op=view_detail_list" ><span><?php echo $lang['nc_manage'];?></span></a></li>
        <li><a href="JavaScript:void(0);" class="current"><span><?php echo $lang['nc_new'];?></span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <table class="table tb-type2" id="prompt">
    <tbody>
      <tr class="space odd">
        <th colspan="12"><div class="title">
            <h5><?php echo $lang['nc_prompts'];?></h5>
            <span class="arrow"></span></div></th>
      </tr>
      <tr>
        <td><ul>
            <li><?php echo $lang['view_add_help_1'];?></li>
			<li><?php echo $lang['view_add_help_2'];?></li>
			<li><?php echo $lang['view_add_help_3'];?></li>
			<li><?php echo $lang['view_add_help_4'];?></li>
          </ul></td>
      </tr>
    </tbody>
  </table>
  <form id="article_form" method="post" name="articleForm">
    <input type="hidden" name="form_submit" value="ok" />
    <table class="table tb-type2 nobdb">
      <tbody>
	  <!--顶部图片上传-->
		<tr>
          <td colspan="2" class="required"><?php echo "顶部图片上传:pano_u.jpg";?>:</td>
        </tr>
        <tr class="noborder">
          <td colspan="2" id="divComUploadContainer"><input type="file" multiple="multiple" id="fileupload_u" name="fileupload"/></td>
		  <td colspan="1" class="required"><?php echo $lang['view_add_uploaded'];?>:</td>
		  <td colspan="1"><ul id="thumbnails_u" class="thumblists">
		  <?php if(isset($output['pano_u'])){?>
              
              <li id="<?php echo $output['u_id'];?>" class="picture" >
                <input type="hidden" name="file_id[]" value="<?php echo $output['u_id'];?>" />
                <div class="size-64x64"><span class="thumb"><i></i><img src="<?php echo $output['pano_u'];?>" alt="pano_u.jpg" onload="javascript:DrawImage(this,64,64);"/></span></div>
                <p><span><a href="javascript:insert_editor('<?php echo $output['pano_u'];?>');"><?php echo $lang['article_add_insert'];?></a></span><span><a href="javascript:del_file_upload('<?php echo $output['u_id'];?>');"><?php echo $lang['nc_del'];?></a></span></p>
              </li>
              
              <?php } ?></td>
        </tr>
		
		<!--底部图片上传-->
		<tr>
          <td colspan="2" class="required"><?php echo "底部图片上传：pano_d.jpg";?>:</td>
        </tr>
        <tr class="noborder">
          <td colspan="2" id="divComUploadContainer"><input type="file" multiple="multiple" id="fileupload_d" name="fileupload" /></td>
		  <td colspan="1" class="required"><?php echo $lang['view_add_uploaded'];?>:</td>
		  <td colspan="1"><ul id="thumbnails_d" class="thumblists">
		  <?php if(isset($output['pano_d'])){?>
              
              <li id="<?php echo $output['d_id'];?>" class="picture" >
                <input type="hidden" name="file_id[]" value="<?php echo $output['d_id'];?>" />
                <div class="size-64x64"><span class="thumb"><i></i><img src="<?php echo $output['pano_d'];?>" alt="pano_d.jpg" onload="javascript:DrawImage(this,64,64);"/></span></div>
                <p><span><a href="javascript:insert_editor('<?php echo $output['pano_d'];?>');"><?php echo $lang['article_add_insert'];?></a></span><span><a href="javascript:del_file_upload('<?php echo $output['d_id'];?>');"><?php echo $lang['nc_del'];?></a></span></p>
              </li>
              
              <?php } ?></td>
        </tr>
		<!--前部图片上传-->
		<tr>
          <td colspan="2" class="required"><?php echo "前方图pain上传:pano_f.jgp";?>:</td>
        </tr>
        <tr class="noborder">
          <td colspan="2" id="divComUploadContainer"><input type="file" multiple="multiple" id="fileupload_f" name="fileupload" /></td>
		  <td colspan="1" class="required"><?php echo $lang['view_add_uploaded'];?>:</td>
		  <td colspan="1"><ul id="thumbnails_f" class="thumblists">
		  <?php if(isset($output['pano_f'])){?>
              
              <li id="<?php echo $output['f_id'];?>" class="picture" >
                <input type="hidden" name="file_id[]" value="<?php echo $output['f_id'];?>" />
                <div class="size-64x64"><span class="thumb"><i></i><img src="<?php echo $output['pano_f'];?>" alt="pano_f.jpg" onload="javascript:DrawImage(this,64,64);"/></span></div>
                <p><span><a href="javascript:insert_editor('<?php echo $output['pano_f'];?>');"><?php echo $lang['article_add_insert'];?></a></span><span><a href="javascript:del_file_upload('<?php echo $output['f_id'];?>');"><?php echo $lang['nc_del'];?></a></span></p>
              </li>
              
              <?php } ?></td>
        </tr>
		<!--后部图片上传-->
		<tr>
          <td colspan="2" class="required"><?php echo "后方图片上传:pano_b.jpg";?>:</td>
        </tr>
        <tr class="noborder">
          <td colspan="2" id="divComUploadContainer"><input type="file" multiple="multiple" id="fileupload_b" name="fileupload" /></td>
		  <td colspan="1" class="required"><?php echo $lang['view_add_uploaded'];?>:</td>
		  <td colspan="1"><ul id="thumbnails_b" class="thumblists">
		  <?php if(isset($output['pano_b'])){?>
              
              <li id="<?php echo $output['b_id'];?>" class="picture" >
                <input type="hidden" name="file_id[]" value="<?php echo $output['b_id'];?>" />
                <div class="size-64x64"><span class="thumb"><i></i><img src="<?php echo $output['pano_b'];?>" alt="pano_b.jpg" onload="javascript:DrawImage(this,64,64);"/></span></div>
                <p><span><a href="javascript:insert_editor('<?php echo $output['pano_u'];?>');"><?php echo $lang['article_add_insert'];?></a></span><span><a href="javascript:del_file_upload('<?php echo $output['b_id'];?>');"><?php echo $lang['nc_del'];?></a></span></p>
              </li>
              
              <?php } ?></td>
        </tr>
		<!--左部图片上传-->
		<tr>
          <td colspan="2" class="required"><?php echo "左方图片上传:pano_l.jpg";?>:</td>
        </tr>
        <tr class="noborder">
          <td colspan="2" id="divComUploadContainer"><input type="file" multiple="multiple" id="fileupload_l" name="fileupload" /></td>
		  <td colspan="1" class="required"><?php echo $lang['view_add_uploaded'];?>:</td>
		  <td colspan="1"><ul id="thumbnails_l" class="thumblists">
		  <?php if(isset($output['pano_l'])){?>
              
              <li id="<?php echo $output['l_id'];?>" class="picture" >
                <input type="hidden" name="file_id[]" value="<?php echo $output['l_id'];?>" />
                <div class="size-64x64"><span class="thumb"><i></i><img src="<?php echo $output['pano_l'];?>" alt="pano_l.jpg" onload="javascript:DrawImage(this,64,64);"/></span></div>
                <p><span><a href="javascript:insert_editor('<?php echo $output['pano_l'];?>');"><?php echo $lang['article_add_insert'];?></a></span><span><a href="javascript:del_file_upload('<?php echo $output['l_id'];?>');"><?php echo $lang['nc_del'];?></a></span></p>
              </li>
              
              <?php } ?></td>
        </tr>
		<!--右部图片上传-->
		<tr>
          <td colspan="2" class="required"><?php echo "右方图片上传:pano_r.jpg";?>:</td>
        </tr>
        <tr class="noborder">
          <td colspan="2" id="divComUploadContainer"><input type="file" multiple="multiple" id="fileupload_r" name="fileupload" /></td>
		  <td colspan="1" class="required"><?php echo $lang['view_add_uploaded'];?>:</td>
		  <td colspan="1"><ul id="thumbnails_r" class="thumblists">
		  <?php if(isset($output['pano_r'])){?>
              
              <li id="<?php echo $output['r_id'];?>" class="picture" >
                <input type="hidden" name="file_id[]" value="<?php echo $output['r_id'];?>" />
                <div class="size-64x64"><span class="thumb"><i></i><img src="<?php echo $output['pano_u'];?>" alt="pano_r.jpg" onload="javascript:DrawImage(this,64,64);"/></span></div>
                <p><span><a href="javascript:insert_editor('<?php echo $output['pano_r'];?>');"><?php echo $lang['article_add_insert'];?></a></span><span><a href="javascript:del_file_upload('<?php echo $output['r_id'];?>');"><?php echo $lang['nc_del'];?></a></span></p>
              </li>
              
              <?php } ?></td>
        </tr>
		<!--缩略图片上传-->
		<tr>
          <td colspan="2" class="required"><?php echo "缩略图上传:thumb.jpg";?>:</td>
        </tr>
        <tr class="noborder">
          <td colspan="2" id="divComUploadContainer"><input type="file" multiple="multiple" id="fileupload_th" name="fileupload" /></td>
		  <td colspan="1" class="required"><?php echo $lang['view_add_uploaded'];?>:</td>
		  <td colspan="1"><ul id="thumbnails_th" class="thumblists">
		  <?php if(isset($output['thumb'])){?>
              
              <li id="<?php echo $output['thumb_id'];?>" class="picture" >
                <input type="hidden" name="file_id[]" value="<?php echo $output['thumb_id'];?>" />
                <div class="size-64x64"><span class="thumb"><i></i><img src="<?php echo $output['thumb'];?>" alt="thumb.jpg" onload="javascript:DrawImage(this,64,64);"/></span></div>
                <p><span><a href="javascript:insert_editor('<?php echo $output['thumb'];?>');"><?php echo $lang['article_add_insert'];?></a></span><span><a href="javascript:del_file_upload('<?php echo $output['thumb_id'];?>');"><?php echo $lang['nc_del'];?></a></span></p>
              </li>
              
              <?php } ?></td>
        </tr>
		<!--预览图片上传-->
		<tr>
          <td colspan="2" class="required"><?php echo "预览图上传:preview.jpg";?>:</td>
        </tr>
        <tr class="noborder">
          <td colspan="2" id="divComUploadContainer"><input type="file" multiple="multiple" id="fileupload_pre" name="fileupload" /></td>
		  <td colspan="1" class="required"><?php echo $lang['view_add_uploaded'];?>:</td>
		  <td colspan="1"><ul id="thumbnails_pre" class="thumblists">
		  <?php if(isset($output['preview'])){?>
              
              <li id="<?php echo $output['preview_id'];?>" class="picture" >
                <input type="hidden" name="file_id[]" value="<?php echo $output['preview_id'];?>" />
                <div class="size-64x64"><span class="thumb"><i></i><img src="<?php echo $output['preview'];?>" alt="preview.jpg" onload="javascript:DrawImage(this,64,64);"/></span></div>
                <p><span><a href="javascript:insert_editor('<?php echo $output['preview'];?>');"><?php echo $lang['article_add_insert'];?></a></span><span><a href="javascript:del_file_upload('<?php echo $output['preview_id'];?>');"><?php echo $lang['nc_del'];?></a></span></p>
              </li>
              
              <?php } ?></td>
        </tr>
		
      </tbody>
      <tfoot>
        <tr class="tfoot">
          <td colspan="15" ><a href="JavaScript:void(0);" class="btn" id="submitBtn"><span><?php echo $lang['nc_submit'];?></span></a></td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/fileupload/jquery.iframe-transport.js" charset="utf-8"></script> 
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/fileupload/jquery.ui.widget.js" charset="utf-8"></script> 
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/fileupload/jquery.fileupload.js" charset="utf-8"></script> 
<script>
//按钮先执行验证再提交表单
$(function(){$("#submitBtn").click(function(){
	
	
    if($("#article_form").valid()){
     $("#article_form").submit();
	}
	});
});
//
$(document).ready(function(){
	$('#article_form').validate({
        errorPlacement: function(error, element){
			error.appendTo(element.parent().parent().prev().find('td:first'));
        },
        rules : {
            ac_name : {
                required : true,
                remote   : {                
                url :'index.php?act=view&op=ajax&branch=check_view_name&view_id=<?php echo $output['view_id'];?>',
                type:'get',
                data:{
                    ac_name : function(){
                        return $('#ac_name').val();
                    }
                  }
                }
            },
			ac_sort : {
                number   : true,
				remote   : {                
                url :'index.php?act=view&op=ajax&branch=check_view_sort&view_id=<?php echo $output['view_id'];?>',
                type:'get',
                data:{
                    ac_name : function(){
                        return $('#ac_name').val();
                    }
                  }
                }
            }
        },
        messages : {
            ac_name : {
                required : '<?php echo $lang['view_add_name_null'];?>',
                remote   : '<?php echo $lang['view_add_name_exists'];?>'
            },
			ac_sort : {
                number : '<?php echo $lang['view_add_sort_null'];?>',
                remote   : '<?php echo $lang['view_add_sort_exists'];?>'
            }
        }
    });
    // 图片上传
    $('#fileupload_u').ready(function(){
	
		$('#fileupload_u').fileupload({
            dataType: 'json',
            url: 'index.php?act=view&op=viewdetail_pic_upload&name=pano_u.jpg&pic_path=<?php echo $output['pic_path'];?>',
            done: function (e,data) {
                if(data != 'error'){
                	add_uploadedfile_u(data.result);
                }
			
            }
        });
    });
	$('#fileupload_d').ready(function(){
	
		$('#fileupload_d').fileupload({
            dataType: 'json',
            url: 'index.php?act=view&op=viewdetail_pic_upload&name=pano_d.jpg&pic_path=<?php echo $output['pic_path'];?>',
            done: function (e,data) {
                if(data != 'error'){
                	add_uploadedfile_d(data.result);
                }
			
            }
        });
    });
	$('#fileupload_f').ready(function(){
	
		$('#fileupload_f').fileupload({
            dataType: 'json',
            url: 'index.php?act=view&op=viewdetail_pic_upload&name=pano_f.jpg&pic_path=<?php echo $output['pic_path'];?>',
            done: function (e,data) {
                if(data != 'error'){
                	add_uploadedfile_f(data.result);
                }
			
            }
        });
    });
	$('#fileupload_b').ready(function(){
	
		$('#fileupload_b').fileupload({
            dataType: 'json',
            url: 'index.php?act=view&op=viewdetail_pic_upload&name=pano_b.jpg&pic_path=<?php echo $output['pic_path'];?>',
            done: function (e,data) {
                if(data != 'error'){
                	add_uploadedfile_b(data.result);
                }
			
            }
        });
    });
	$('#fileupload_l').ready(function(){
	
		$('#fileupload_l').fileupload({
            dataType: 'json',
            url: 'index.php?act=view&op=viewdetail_pic_upload&name=pano_l.jpg&pic_path=<?php echo $output['pic_path'];?>',
            done: function (e,data) {
                if(data != 'error'){
                	add_uploadedfile_l(data.result);
                }
			
            }
        });
    });
	$('#fileupload_r').ready(function(){
	
		$('#fileupload_r').fileupload({
            dataType: 'json',
            url: 'index.php?act=view&op=viewdetail_pic_upload&name=pano_r.jpg&pic_path=<?php echo $output['pic_path'];?>',
            done: function (e,data) {
                if(data != 'error'){
                	add_uploadedfile_r(data.result);
                }
			
            }
        });
    });
	$('#fileupload_th').ready(function(){
	
		$('#fileupload_th').fileupload({
            dataType: 'json',
            url: 'index.php?act=view&op=viewdetail_pic_upload&name=thumb.jpg&pic_path=<?php echo $output['pic_path'];?>',
            done: function (e,data) {
                if(data != 'error'){
                	add_uploadedfile_th(data.result);
                }
			
            }
        });
    });
	$('#fileupload_pre').ready(function(){
	
		$('#fileupload_pre').fileupload({
            dataType: 'json',
            url: 'index.php?act=view&op=viewdetail_pic_upload&name=preview.jpg&pic_path=<?php echo $output['pic_path'];?>',
            done: function (e,data) {
                if(data != 'error'){
                	add_uploadedfile_pre(data.result);
                }
			
            }
        });
    });
});


function add_uploadedfile_u(file_data)
{

    var newImg = '<li id="' + file_data.file_id + '" class="picture"><input type="hidden" name="file_id[]" value="' + file_data.file_id + '" /><div class="size-64x64"><span class="thumb"><i></i><img src="<?php echo UPLOAD_SITE_URL.'/'.$output['pic_path'].'/';?>' + file_data.file_name + '" alt="' + file_data.file_name + '" width="64px" height="64px"/></span></div><p><span><a href="javascript:insert_editor(\'<?php echo UPLOAD_SITE_URL.'/'.$output['pic_path'].'/';?>' + file_data.file_name + '\');"><?php echo $lang['article_add_insert'];?></a></span><span><a href="javascript:del_file_upload(' + file_data.file_id + ');"><?php echo $lang['nc_del'];?></a></span></p></li>';
    $('#thumbnails_u').prepend(newImg);
}
function add_uploadedfile_d(file_data)
{

    var newImg = '<li id="' + file_data.file_id + '" class="picture"><input type="hidden" name="file_id[]" value="' + file_data.file_id + '" /><div class="size-64x64"><span class="thumb"><i></i><img src="<?php echo UPLOAD_SITE_URL.'/'.$output['pic_path'].'/';?>' + file_data.file_name + '" alt="' + file_data.file_name + '" width="64px" height="64px"/></span></div><p><span><a href="javascript:insert_editor(\'<?php echo UPLOAD_SITE_URL.'/'.$output['pic_path'].'/';?>' + file_data.file_name + '\');"><?php echo $lang['article_add_insert'];?></a></span><span><a href="javascript:del_file_upload(' + file_data.file_id + ');"><?php echo $lang['nc_del'];?></a></span></p></li>';
    $('#thumbnails_d').prepend(newImg);
}
function add_uploadedfile_f(file_data)
{

    var newImg = '<li id="' + file_data.file_id + '" class="picture"><input type="hidden" name="file_id[]" value="' + file_data.file_id + '" /><div class="size-64x64"><span class="thumb"><i></i><img src="<?php echo UPLOAD_SITE_URL.'/'.$output['pic_path'].'/';?>' + file_data.file_name + '" alt="' + file_data.file_name + '" width="64px" height="64px"/></span></div><p><span><a href="javascript:insert_editor(\'<?php echo UPLOAD_SITE_URL.'/'.$output['pic_path'].'/';?>' + file_data.file_name + '\');"><?php echo $lang['article_add_insert'];?></a></span><span><a href="javascript:del_file_upload(' + file_data.file_id + ');"><?php echo $lang['nc_del'];?></a></span></p></li>';
    $('#thumbnails_f').prepend(newImg);
}
function add_uploadedfile_b(file_data)
{

    var newImg = '<li id="' + file_data.file_id + '" class="picture"><input type="hidden" name="file_id[]" value="' + file_data.file_id + '" /><div class="size-64x64"><span class="thumb"><i></i><img src="<?php echo UPLOAD_SITE_URL.'/'.$output['pic_path'].'/';?>' + file_data.file_name + '" alt="' + file_data.file_name + '" width="64px" height="64px"/></span></div><p><span><a href="javascript:insert_editor(\'<?php echo UPLOAD_SITE_URL.'/'.$output['pic_path'].'/';?>' + file_data.file_name + '\');"><?php echo $lang['article_add_insert'];?></a></span><span><a href="javascript:del_file_upload(' + file_data.file_id + ');"><?php echo $lang['nc_del'];?></a></span></p></li>';
    $('#thumbnails_b').prepend(newImg);
}
function add_uploadedfile_l(file_data)
{

    var newImg = '<li id="' + file_data.file_id + '" class="picture"><input type="hidden" name="file_id[]" value="' + file_data.file_id + '" /><div class="size-64x64"><span class="thumb"><i></i><img src="<?php echo UPLOAD_SITE_URL.'/'.$output['pic_path'].'/';?>' + file_data.file_name + '" alt="' + file_data.file_name + '" width="64px" height="64px"/></span></div><p><span><a href="javascript:insert_editor(\'<?php echo UPLOAD_SITE_URL.'/'.$output['pic_path'].'/';?>' + file_data.file_name + '\');"><?php echo $lang['article_add_insert'];?></a></span><span><a href="javascript:del_file_upload(' + file_data.file_id + ');"><?php echo $lang['nc_del'];?></a></span></p></li>';
    $('#thumbnails_l').prepend(newImg);
}
function add_uploadedfile_r(file_data)
{

    var newImg = '<li id="' + file_data.file_id + '" class="picture"><input type="hidden" name="file_id[]" value="' + file_data.file_id + '" /><div class="size-64x64"><span class="thumb"><i></i><img src="<?php echo UPLOAD_SITE_URL.'/'.$output['pic_path'].'/';?>' + file_data.file_name + '" alt="' + file_data.file_name + '" width="64px" height="64px"/></span></div><p><span><a href="javascript:insert_editor(\'<?php echo UPLOAD_SITE_URL.'/'.$output['pic_path'].'/';?>' + file_data.file_name + '\');"><?php echo $lang['article_add_insert'];?></a></span><span><a href="javascript:del_file_upload(' + file_data.file_id + ');"><?php echo $lang['nc_del'];?></a></span></p></li>';
    $('#thumbnails_r').prepend(newImg);
}
function add_uploadedfile_th(file_data)
{

    var newImg = '<li id="' + file_data.file_id + '" class="picture"><input type="hidden" name="file_id[]" value="' + file_data.file_id + '" /><div class="size-64x64"><span class="thumb"><i></i><img src="<?php echo UPLOAD_SITE_URL.'/'.$output['pic_path'].'/';?>' + file_data.file_name + '" alt="' + file_data.file_name + '" width="64px" height="64px"/></span></div><p><span><a href="javascript:insert_editor(\'<?php echo UPLOAD_SITE_URL.'/'.$output['pic_path'].'/';?>' + file_data.file_name + '\');"><?php echo $lang['article_add_insert'];?></a></span><span><a href="javascript:del_file_upload(' + file_data.file_id + ');"><?php echo $lang['nc_del'];?></a></span></p></li>';
    $('#thumbnails_th').prepend(newImg);
}
function add_uploadedfile_pre(file_data)
{

    var newImg = '<li id="' + file_data.file_id + '" class="picture"><input type="hidden" name="file_id[]" value="' + file_data.file_id + '" /><div class="size-64x64"><span class="thumb"><i></i><img src="<?php echo UPLOAD_SITE_URL.'/'.$output['pic_path'].'/';?>' + file_data.file_name + '" alt="' + file_data.file_name + '" width="64px" height="64px"/></span></div><p><span><a href="javascript:insert_editor(\'<?php echo UPLOAD_SITE_URL.'/'.$output['pic_path'].'/';?>' + file_data.file_name + '\');"><?php echo $lang['article_add_insert'];?></a></span><span><a href="javascript:del_file_upload(' + file_data.file_id + ');"><?php echo $lang['nc_del'];?></a></span></p></li>';
    $('#thumbnails_pre').prepend(newImg);
}
function insert_editor(file_path){
	KE.appendHtml('article_content', '<img src="'+ file_path + '" alt="'+ file_path + '">');
}
function del_file_upload(file_id)
{
    if(!window.confirm('<?php echo $lang['nc_ensure_del'];?>')){
        return;
    }
    $.getJSON('index.php?act=view&op=ajax&branch=del_file_upload&file_id=' + file_id, function(result){
        if(result){
            $('#' + file_id).remove();
        }else{
            alert('<?php echo $lang['view_add_del_fail'];?>');
        }
    });
}



</script>