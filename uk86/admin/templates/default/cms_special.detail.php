<?php defined('InUk86') or exit('Access Invalid!');?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE9" />
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET;?>">
<title><?php echo $output['special_detail']['special_title']; ?></title>
<meta name="keywords" content="<?php echo $output['special_detail']['special_title']; ?>" />
<meta name="description" content="<?php echo $output['special_detail']['special_title']; ?>" />

<script type="text/javascript">
$(document).ready(function(){
    $('#special_btn').mousedown(function(){ $(this).css('box-shadow','0px 0px 0px'); });
    $('#special_btn').mouseup(function(){ $(this).css('box-shadow','3px 3px 3px #999'); });
    $('#special_btn').click(function(){
    	if(<?php echo $_SESSION['is_login']?1:0;?> == 0){
    		window.location.href="<?php echo SHOP_SITE_URL; ?>/index.php?act=login&op=index";
    	}
    	window.open($(this).attr('nctype'));
    });

});
</script>
<style type="text/css">
#body {position:relative;  color: #333333; background-color: <?php echo $output['special_detail']['special_background_color'];?>; background-image: url(<?php echo uk86_getCMSSpecialImageUrl($output['special_detail']['special_background']);?>); background-repeat: <?php echo $output['special_detail']['special_repeat'];?>; background-position: top center; width: 100%; padding: 0; margin: 0; overflow: hidden;}
img { border: 0; vertical-align: top; }
a:hover{text-decoration:none;}
#special_btn{width:170px;  box-shadow:3px 3px 3px #999; transform: translate(-50%, -50%); height:56px; display:block; border-radius:10px; font-size:26px; font-weight:600; line-height:54px; text-align:center;}
.cms-special-detail-content {width: 1000px; margin-top: <?php echo $output['special_detail']['special_margin_top']?>px; margin-right: auto; margin-bottom: 0; margin-left: auto; overflow: hidden;}
.special-content-link, .special-hot-point { text-align: 0; display: block; width: 100%; float: left; clear: both; padding: 0; margin: 0; border: 0; overflow: hidden;}
.special-content-goods-list { width: 1000px; margin: 0 auto; overflow: hidden;}

.special-goods-list { width: 988px; padding: 0 2px 0 0; overflow: hidden;}
.special-goods-list li { background:#fff; float: left; width: 220px; height:220px; padding: 0px 0px; margin: 13px;}
.special-goods-list dl { border: none; width: 220px; height: 60px; padding: 160px 0 0 0; position: relative; z-index: 1;}
.special-goods-list dt.name { font-size: 12px; line-height: 18px; height: 18px; margin-top:0px; overflow: hidden; position:absolute; z-index:100; top:186px; background:#FFF; width:220px; text-indent:1em; white-space:nowrap; text-overflow:ellipsis;}
.special-goods-list dd.image { width: 220px; height: 220px; position: absolute; z-index: 1; top: 0; left: 0;}
.special-goods-list dd.image a { text-align: center; vertical-align: middle; display: table-cell; width:220px; height: auto; overflow: hidden; width:210px;}
.special-goods-list dd.image img { width: 220px; height: 220px; margin-top:expression(100-this.height/2); z-index:2;}
.special-goods-list dd.price { color: #999; width:220px; margin:0 auto; position:absolute; z-index:100; background:#FFF; float:left; top:204px; line-height:18px; height:18px;  text-indent:1em;}
.special-goods-list dd.price em { font-weight: 600; color: #F30;}

#special_image_list_up { width: 988px; padding: 0 2px 0 0; overflow: hidden;}
#special_image_list_up li { float: left; list-style-type: none; width: 220px; margin: 13px;}
#special_image_list_up dl{ width:220px; background:#FFF; position:relative; z-index:1; border:0px;}
#special_image_list_up dd.image{ width:220px; height:190px;  z-index:1;}
#special_image_list_up dd.image img{width:220px; height:190px; z-index:1;}
#special_image_list_up dd.title {color:#999; line-height:36px; font-size:16px; width:200px; margin:0 auto;	}
</style>
</head>
<body>
<?php if($output['special_detail']['special_enroll_status'] == 1){ ?><a id="special_btn" nctype="<?php echo $output['special_detail']['special_btn_url']; ?>" href="javascript:void(0);" style="color:<?php echo $output['special_detail']['special_btn_color'] ?>; background:<?php echo $output['special_detail']['special_btn_background'] ?>; position:absolute; top:<?php echo $output['special_detail']['special_btn_top']; ?>px; left:<?php if($output['special_detail']['special_btn_left'] == "auto"){echo "50%";}else{ echo $output['special_detail']['special_btn_left']."px";} ?>;">立即报名</a><?php } ?>
<div class="cms-special-detail-content">
<?php echo html_entity_decode($output['special_detail']['special_content']);?>
</div>
</body>
</html>
