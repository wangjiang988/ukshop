<?php defined('InUk86') or exit('Access Invalid!'); ?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta id="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" name="viewport">
<meta name="apple-themes-web-app-capable" content="yes">
<meta content="yes" name="apple-mobile-web-app-capable">
<meta content="black" name="apple-mobile-web-app-status-bar-style">
<meta content="telephone=no" name="format-detection">
<meta content="email=no" name="format-detection">
<meta name="format-detection" content="telephone=no">
<title>优康_更换头像</title>
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/main.css" type="text/css" media="all">
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/account.css" type="text/css" media="all">
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.Jcrop/jquery.Jcrop.js"></script>
<link href="<?php echo RESOURCE_SITE_URL;?>/js/jquery.Jcrop/jquery.Jcrop.min.css" rel="stylesheet" type="text/css" id="cssfile2" />
<style type="text/css">
.dialogMsg{padding-bottom:0.2rem;}
</style>
</head>
<body>
<!--顶部-->
<header id="header">
	<div class="header_con">
	<div class="headerleft">
		<a href="index.php?act=wap_member_setting&op=account"><i class="icon-arrow-left"></i></a>
	</div>
		<div class="top-tit-div">
			更换头像
		</div>
		<div class="headerRight">
		</div>
	</div>
</header>
<div id="content" style="background: #FFF;">
	<?php if(empty($output['newfile'])){ ?>
	 <div class="change_avatar">
	  <form id="form_avaster" method="post" action="index.php?act=wap_member_setting&op=upload" enctype='multipart/form-data'>
	   <input type="hidden" name="form_submit" value="ok" />
	   <table>
	     <tr>
	       <td valign="top" style="width:1.4rem;">头像预览：</td>
	       <td><img src="<?php echo uk86_getMemberAvatar($output['member_info']['member_avatar']); ?>"><br />
	         <span style="color:#FFA500; font-size:0.22rem;">头像默认尺寸为120x120像素，请根据系统操作提示进行裁剪并生效。</span>
	       </td>
	     </tr>
	     <tr><td>&nbsp;</td><td></td></tr>
	     <tr>
	       <td>更换头像：</td>
	       <td><label><span class="avatar_upload">上传图片</span>
	       		<input  accept="image/*" type="file" class="hidden" id="pic" name="pic" value=""/>
	       	</label>
	       	</td>
	     </tr>
	   </table>
	  </form>
	 </div>
	<?php }else{ ?>
	 <form action="index.php?act=wap_member_setting&op=cut" id="form_cut" method="post">
	    <input type="hidden" name="form_submit" value="ok" />
	    <input type="hidden" id="x1" name="x1" />
	    <input type="hidden" id="x2" name="x2" />
	    <input type="hidden" id="w" name="w" />
	    <input type="hidden" id="y1" name="y1" />
	    <input type="hidden" id="y2" name="y2" />
	    <input type="hidden" id="h" name="h" />
	    <input type="hidden" id="newfile" name="newfile" value="<?php echo $output['newfile'];?>" />
	    <div class="pic-cut-120">
	      <div class="work-title">工作区</div>
	      <div class="work-layer">
	        <p><img id="nccropbox" src="<?php echo UPLOAD_SITE_URL.DS.ATTACH_AVATAR.DS.$output['newfile'].'?'.microtime(); ?>"/></p>
	      </div>
	      <div class="thumb-title">裁切预览</div>
	      <div class="thumb-layer">
	        <p><img id="preview" src="<?php echo UPLOAD_SITE_URL.DS.ATTACH_AVATAR.DS.$output['newfile'].'?'.microtime();?>"/></p>
	      </div>
	      <div class="cut-btn">
	        <input type="button" id="ncsubmit" class="submit avatar_submit" value="提交" />
	      </div>
	    </div>
	  </form>
	<?php } ?>
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/zepto.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/carousel-image.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/common.js"></script>
<script type="text/javascript">
$(document).ready(function(){
	$('.all_foot').hide();
	<?php if(empty($output['newfile'])){ ?>
	$('#pic').change(function(){
		var filepatd=$(this).val();
		var extStart=filepatd.lastIndexOf(".");
		var ext=filepatd.substring(extStart,filepatd.lengtd).toUpperCase();
		if(ext!=".PNG"&&ext!=".GIF"&&ext!=".JPG"&&ext!=".JPEG"){
			showError("文件类型错误，请选择图片文件（png|gif|jpg|jpeg）");
			$(this).attr('value','');
			return false;
		}
		if ($(this).val() == '') return false;
		$("#form_avaster").submit();
	});
	<?php }else{ ?>
	function showPreview(coords){
		if (parseInt(coords.w) > 0){
			var rx = 120 / coords.w;
			var ry = 120 / coords.h;
			$('#preview').css({
				width: Math.round(rx * <?php echo $output['width'];?>) + 'px',
				height: Math.round(ry * <?php echo $output['height'];?>) + 'px',
				marginLeft: '-' + Math.round(rx * coords.x) + 'px',
				marginTop: '-' + Math.round(ry * coords.y) + 'px'
			});
		}
		$('#x1').val(coords.x);
		$('#y1').val(coords.y);
		$('#x2').val(coords.x2);
		$('#y2').val(coords.y2);
		$('#w').val(coords.w*1.35);
		$('#h').val(coords.h*1.35);
	}
	/* Jcrop */
    $('#nccropbox').Jcrop({
	aspectRatio:1,
	setSelect: [ 0, 0, 120, 120 ],
	minSize:[50, 50],
	allowSelect:0,
	onChange: showPreview,
	onSelect: showPreview
    });
	$('#ncsubmit').click(function() {
		var x1 = $('#x1').val();
		var y1 = $('#y1').val();
		var x2 = $('#x2').val();
		var y2 = $('#y2').val();
		var w = $('#w').val();
		var h = $('#h').val();
		if(x1=="" || y1=="" || x2=="" || y2=="" || w=="" || h==""){
			alert("您必须先选定一个区域");
			return false;
		}else{
			$('#form_cut').submit();
		}
	});
	<?php } ?>
});
</script>
</body>
</html>