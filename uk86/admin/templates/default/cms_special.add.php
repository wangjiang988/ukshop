<?php defined('InUk86') or exit('Access Invalid!');?>
<style type="text/css">
h3.dialog_head { margin: 0 !important;}
.dialog_content { padding: 0 15px 15px !important; overflow: hidden;}

</style>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/ajax.form.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/dialog/dialog.js" id="dialog_js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/fileupload/jquery.iframe-transport.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/fileupload/jquery.ui.widget.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/fileupload/jquery.fileupload.js" charset="utf-8"></script>
<link media="all" rel="stylesheet" href="<?php echo RESOURCE_SITE_URL;?>/js/jquery.imgareaselect/imgareaselect-animated.css" type="text/css" />
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.imgareaselect/jquery.imgareaselect.min.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.nyroModal/custom.min.js" charset="utf-8"></script>
<link href="<?php echo RESOURCE_SITE_URL;?>/js/jquery.nyroModal/styles/nyroModal.css" rel="stylesheet" type="text/css" id="cssfile2" />
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/cms/cms_special.js" charset="utf-8"></script>
<script type="text/javascript">
$(document).ready(function(){
    $("#btn_draft").click(function() {
        $("#special_state").val("draft");
        $("#add_form").submit();
    });
    $("#btn_publish").click(function() {
        $("#special_state").val("publish");
        $("#add_form").submit();
    });
    $('#add_form').validate({
        errorPlacement: function(error, element){
            error.appendTo(element.parents("tr").prev().find('td:first'));
        },
        rules : {
            <?php if(empty($output['special_detail'])) {?>
            special_image: {
                required : true
            },
            <?php } ?>
            special_title: {
                required : true,
                maxlength : 24,
                minlength : 4
            }
        },
        messages : {
            <?php if(empty($output['special_detail'])) {?>
            special_image: {
                required : "<?php echo $lang['cms_special_image_error'];?>"
            },
            <?php } ?>
            special_title: {
                required : "<?php echo $lang['cms_title_not_null'];?>",
                maxlength : "<?php echo $lang['cms_title_max'];?>", 
                minlength : "<?php echo $lang['cms_title_min'];?>" 
            }
        }
    });
    if($('input[name=special_enroll_status][checked=checked]').val() == 1){
    	$('.display-btn').show();
    }else{
    	$('.display-btn').hide();
    }
    $('input[name=special_enroll_status]').click(function(){
		if($(this).val() == 1){
			$('.display-btn').show();
		}else{
			$('.display-btn').hide();
		}
    });
    
});
</script>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo $lang['nc_cms_special_manage'];?></h3>
      <ul class="tab-base">
        <?php   foreach($output['menu'] as $menu) {  if($menu['menu_type'] == 'text') { ?>
        <li><a href="<?php echo $menu['menu_url'];?>" class="current"><span><?php echo $menu['menu_name'];?></span></a></li>
        <?php }  else { ?>
        <li><a href="<?php echo $menu['menu_url'];?>" ><span><?php echo $menu['menu_name'];?></span></a></li>
        <?php  } }  ?>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form id="add_form" method="post" enctype="multipart/form-data" action="index.php?act=cms_special&op=cms_special_save">
    <input name="special_id" type="hidden" value="<?php if(!empty($output['special_detail'])) echo $output['special_detail']['special_id'];?>" />
    <input id="special_state" name="special_state" type="hidden" value="" />
    <table class="table tb-type2">
      <tbody>
        <tr class="noborder">
          <td colspan="2" class="required"><label for="special_title" class="validation"><?php echo $lang['cms_text_title'];?></label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input id="special_title" name="special_title" class="txt" type="text" value="<?php if(!empty($output['special_detail'])) echo $output['special_detail']['special_title'];?>"/></td>
          <td class="vatop tips"><?php echo $lang['cms_special_title_explain'];?></td>
        </tr>
        <tr class="noborder">
          <td colspan="2" class="required"><label for="special_title" class="validation">专题类型</label></td>
        </tr>
        <tr class="noborder">
            <td class="vatop rowform">
                <select name="special_type">
                    <?php if(!empty($output['special_type_array']) && is_array($output['special_type_array'])) {?>
                    <?php foreach($output['special_type_array'] as $special_type => $special_type_text) {?>
                    <option value="<?php echo $special_type;?>" <?php echo $special_type == $output['special_detail']['special_type']?'selected':'';?>><?php echo $special_type_text;?></option>
                    <?php } ?>
                    <?php } ?>
                </select>
            </td>
          <td class="vatop tips">资讯类型将出现在资讯频道内，商城类型将出现在商城内</td>
        </tr>
        <tr>
          <td colspan="2" class="required"><label class="validation"><?php echo $lang['cms_special_image'];?><?php echo $lang['nc_colon'];?></label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><span class="type-file-show"> <a href="<?php if(!empty($output['special_detail']['special_image'])){ echo uk86_getCMSSpecialImageUrl($output['special_detail']['special_image']);} else {echo ADMIN_TEMPLATES_URL . '/images/preview.png';}?>" nctype="nyroModal"><img class="show_image" src="<?php echo ADMIN_TEMPLATES_URL;?>/images/preview.png"></a>
            </span> 
            <span class="type-file-box">
            <input name="special_image" type="file" class="type-file-file" id="special_image" size="30" hidefocus="true" nctype="cms_image">
            <input name="old_special_image" type="hidden" value="<?php echo $output['special_detail']['special_image'];?>" />
            </span></td>
          <td class="vatop tips"><span class="vatop rowform"><?php echo $lang['cms_special_image_explain'];?></span></td>
        </tr>
        <tr class="space">
          <th colspan="2"><?php echo $lang['cms_special_background'];?></th>
        </tr>
        <tr>
          <td colspan="2" class="required"><?php echo $lang['cms_special_background'];?></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input class="txt" name="special_background_color" type="color" value="<?php if(!empty($output['special_detail'])) echo $output['special_detail']['special_background_color'];?>" /></td>
          <td class="vatop tips"><span class="vatop rowform"><?php echo $lang['cms_special_background_color_explain'];?></span></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><?php echo $lang['cms_special_background_image'];?></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><span class="type-file-show"> <a href="<?php if(!empty($output['special_detail']['special_background'])){ echo uk86_getCMSSpecialImageUrl($output['special_detail']['special_background']);} else {echo ADMIN_TEMPLATES_URL . '/images/preview.png';}?>" nctype="nyroModal"><img class="show_image" src="<?php echo ADMIN_TEMPLATES_URL;?>/images/preview.png"></a>
            </span> <span class="type-file-box">
            <input name="special_background" type="file" class="type-file-file" id="special_background" size="30" hidefocus="true" nctype="cms_image">
            <input name="old_special_background" type="hidden" value="<?php echo $output['special_detail']['special_background'];?>" />
            </span></td>
          <td class="vatop tips"><span class="vatop rowform"><?php echo $lang['cms_special_background_image_explain'];?></span></td>
        </tr>
        <tr>
          <td colspan="2" class="required"><?php echo $lang['cms_special_background_type'];?></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><label class="mr10">
                  <input name="special_repeat" type="radio" value="no-repeat" <?php if($output['special_detail']['special_repeat'] == 'no-repeat') echo 'checked';?> />
              <?php echo $lang['cms_special_background_type_norepeat'];?></label>
            <label class="mr10">
              <input name="special_repeat" type="radio" value="repeat" <?php if($output['special_detail']['special_repeat'] == 'repeat') echo 'checked';?>/>
              <?php echo $lang['cms_special_background_type_repeat'];?></label>
            <label class="mr10">
              <input name="special_repeat" type="radio" value="repeat-x" <?php if($output['special_detail']['special_repeat'] == 'repeat-x') echo 'checked';?>/>
              <?php echo $lang['cms_special_background_type_xrepeat'];?></label>
            <label class="mr10">
              <input name="special_repeat" type="radio" value="repeat-y" <?php if($output['special_detail']['special_repeat'] == 'repeat-y') echo 'checked';?>/>
              <?php echo $lang['cms_special_background_type_yrepeat'];?></label></td>
          <td class="vatop tips"><span class="vatop rowform"><?php echo $lang['cms_special_background_type_explain'];?></span></td>
        </tr>
        <tr class="space">
          <th colspan="2"><?php echo $lang['cms_special_content'];?><?php echo $lang['nc_colon'];?></th>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><?php echo $lang['cms_special_content_top_margin'];?>&nbsp;
            <input class="txt" style=" width: 50px;" name="special_margin_top" type="text" value="<?php echo empty($output['special_detail']['special_margin_top'])?'0':$output['special_detail']['special_margin_top'];?>" />
            像素</td>
          <td class="vatop tips"><span class="vatop rowform"><?php echo $lang['cms_special_content_explain'];?></span></td>
        </tr>
        <tr class="space">
          <th colspan="2">开启专题报名：</th>
        </tr>
        <tr class="noborder">
        	<td><label><input type="radio" name="special_enroll_status" value="1" <?php echo $output['special_detail']['special_enroll_status']?'checked="checked"':''; ?> />开启</label>
        	<label><input type="radio" name="special_enroll_status" value="0" <?php echo $output['special_detail']['special_enroll_status']?'':'checked="checked"'; ?> />关闭</label></td>
        </tr>
        <tr class="space display-btn">
          <th colspan="2">报名按钮设置：</th>
        </tr>
        <tr class="noborder display-btn">
          <td class="vatop rowform">距顶部位置&nbsp;&nbsp;<input class="txt" type="text" style="width: 50px;" name="special_btn_top" value="<?php echo empty($output['special_detail']['special_btn_top'])?'0':$output['special_detail']['special_btn_top']; ?>" /></td>
          <td class="vatop tips">&nbsp;&nbsp;报名按钮距离顶部边距（top）值（单位为像素），默认为0</td>
        </tr>
        <tr class="noborder display-btn">
          <td class="vatop rowform">距左侧位置&nbsp;&nbsp;<input calss="txt" type="text" style="width: 50px;" name="special_btn_left" value="<?php echo empty($output['special_detail']['special_btn_left'])?'auto':$output['special_detail']['special_btn_left']; ?>"/></td>
          <td class="vatop tips" >&nbsp;&nbsp;报名按钮距离顶部边距（left）值（单位为像素），auto为居中，默认为auto</td>
        </tr>
        <tr class="display-btn">
          <td colspan="2" class="required">报名按钮背景色</td>
        </tr>
        <tr class="noborder display-btn">
          <td class="vatop rowform"><input class="txt" name="special_btn_background" type="color" value="<?php echo empty($output['special_detail']['special_btn_background'])?'#F7F7F7':$output['special_detail']['special_btn_background'];?>" /></td>
          <td class="vatop tips"><span class="vatop rowform">作为专题页面报名按钮背景色使用，设置请使用十六进制形式(#XXXXXX)，默认留空为浅灰色背景。</span></td>
        </tr>
        <tr class="display-btn">
          <td colspan="2" class="required">报名按钮字体颜色</td>
        </tr>
        <tr class="noborder display-btn">
          <td class="vatop rowform"><input class="txt" name="special_btn_color" type="color" value="<?php echo empty($output['special_detail']['special_btn_color'])?'#000000':$output['special_detail']['special_btn_color'];?>" /></td>
          <td class="vatop tips"><span class="vatop rowform">作为专题页面报名按钮字体颜色使用，设置请使用十六进制形式(#XXXXXX)，默认留空为黑色。</span></td>
        </tr>
        <tr class="display-btn">
          <td colspan="2" class="required">报名按钮链接</td>
        </tr>
        <tr class="noborder display-btn">
          <td class="vatop rowform"><input class="txt" name="special_btn_url" type="text" value="<?php echo empty($output['special_detail']['special_btn_url'])?'':$output['special_detail']['special_btn_url'];?>"/></td>
          <td class="vatop tips"><span class="vatop rowform">专题报名链接，链接到微圈对应的话题中(链接以http://开头)</span></td>
        </tr>
        <tr>
          <td colspan="2" class="cms-special-tab">
          <div class="nav-bar">
          <input id="btn_content_view" type="button" value="<?php echo $lang['cms_text_view'];?>" class="tab-btn actived" />
          <input id="btn_content_edit" type="button" value="<?php echo $lang['nc_edit'];?>" class="tab-btn" />
          </div>
          <div class="tab-content" style=" position:relative; background-color: <?php echo $output['special_detail']['special_background_color'];?>; background-image: url(<?php if(!empty($output['special_detail']['special_background'])){echo uk86_getCMSSpecialImageUrl($output['special_detail']['special_background']);}?>); background-repeat: <?php echo $output['special_detail']['special_repeat'];?>; background-position: top center; width: 100%; padding: 0; margin: 0; overflow: hidden;"><?php if($output['special_detail']['special_enroll_status'] == 1){ ?><a id="special_btn" href="javascript:void(0);" style="width:170px; box-shadow:3px 3px 3px #999; transform: translate(-50%, -50%); height:56px; display:block; border-radius:10px; color:<?php echo $output['special_detail']['special_btn_color'] ?>; font-size:26px; font-weight:600; line-height:54px; text-align:center; background:<?php echo $output['special_detail']['special_btn_background'] ?>; position:absolute; top:<?php echo $output['special_detail']['special_btn_top']; ?>px; left:<?php if($output['special_detail']['special_btn_left'] == "auto"){echo "50%";}else{ echo $output['special_detail']['special_btn_left']."px";} ?>;">立即报名</a><?php } ?><div id="div_content_view" style=" background-color: transparent; background-image: none; width: 1000px; margin-top: <?php echo $output['special_detail']['special_margin_top']?>px; margin-right: auto; margin-bottom: 0; margin-left: auto; border: 0; overflow: hidden;"></div></div>
          <div id="div_content_edit" class="tab-content" style="display:none;">
          <textarea id="special_content" name="special_content" rows="50" cols="80"><?php echo $output['special_detail']['special_content'];?></textarea>
          </div>
        </td>
        </tr>
        <tr>
          <td colspan="2" class="required"><?php echo $lang['cms_special_image_and_goods'];?></td>
        </tr>
        <tr class="noborder">
          <td><!-- <div class="upload-btn" style=" display: inline-block;"><a href="javascript:void(0);"><span>
              <input type="file" name="special_image_upload" id="picture_image_upload" multiple=""  file_id="0" style="width:120px; height: 40px; cursor: pointer; opacity:0; filter: alpha(opacity=0)" size="1" hidefocus="true" />
              </span>
              <div class="upload-button" style=" display: inline-block;"><?php echo $lang['cms_text_image_upload'];?></div>
              <input id="submit_button" style="display:none" type="button" value="&nbsp;" onClick="submit_form($(this))" />
              </a></div> -->
              <div class="upload-btn"> <a href="javascript:void(0);"><span>
              <input id="btn_show_special_upload_img" type="button" value="" style="width:120px; height: 40px; cursor: pointer; opacity:0; filter: alpha(opacity=0)" />
              </span>
              <div class="upload-button"><?php echo $lang['cms_text_image_upload'];?></div>
              </a> </div>
            <div class="upload-btn"> <a href="javascript:void(0);"><span>
              <input id="btn_show_special_insert_goods" type="button" value="" style="width:120px; height: 40px; cursor: pointer; opacity:0; filter: alpha(opacity=0)" />
              </span>
              <div class="upload-button"><?php echo $lang['cms_text_goods_add'];?></div>
              </a> </div></td>
          <td class="vatop tips"><span class="vatop rowform"><?php echo $lang['cms_special_image_explain1'];?></span></td>
        </tr>
        <!-- <tr>
          <td colspan="2" class="required"><?php echo $lang['cms_special_image_list'];?></td>
        </tr>
        <tr class="noborder">
          <td colspan="2" class="cms-special-uploadpic"><ul id="special_image_list" class="thumblists">
              <?php if(!empty($output['special_detail']['special_image_all'])) { ?>
              <?php $special_image_all = unserialize($output['special_detail']['special_image_all']);?>
              <?php if(!empty($special_image_all) && is_array($special_image_all)) { ?>
              <?php foreach ($special_image_all as $value) {?>
              <?php $image_url = uk86_getCMSSpecialImageUrl($value['image_name']);?>
              <li class="picture">
                <div class="size-64x64"> <span class="thumb size-64x64"><i></i> <img alt="" src="<?php echo $image_url;?>"> </span></div>
                <p class="handle "><a image_url="<?php echo $image_url;?>" nctype="btn_show_image_insert_link" class="insert-link " title="<?php echo $lang['cms_special_image_tips1'];?>">&nbsp;</a><a image_name="<?php echo $value['image_name'];?>" image_url="<?php echo $image_url;?>" nctype="btn_show_image_insert_hot_point" class="insert-hotpoint  " title="<?php echo $lang['cms_special_image_tips2'];?>">&nbsp;</a><a image_name="<?php echo $value['image_name'];?>" nctype="btn_drop_special_image" class="delete  " title="<?php echo $lang['cms_special_image_tips3'];?>">&nbsp;</a></span> </p>
                <input type="hidden" value="<?php echo $value['image_name'];?>" name="special_image_all[]">
              </li>
              <?php } ?>
              <?php } ?>
              <?php } ?>
            </ul></td>
        </tr> -->
      </tbody>
      <tfoot>
        <tr>
          <td colspan="2"><a href="JavaScript:void(0);" class="btn" id="btn_draft"><span><?php echo $lang['cms_special_draft'];?></span></a> <a href="JavaScript:void(0);" class="btn"  id="btn_publish"><span><?php echo $lang['cms_special_publish'];?></span></a></td>
        </tr>
    </table>
  </form>
  <!-- 插入图片链接对话框 -->
  <div id="_dialog_image_insert_link" style="display:none;">
    <div class="upload_adv_dialog dialog-image-insert-link">
      <div class="s-tips"><i></i><?php echo $lang['cms_special_image_link_explain1'];?></div>
      <table id="upload_adv_type" class="table tb-type2">
        <tbody>
          <tr>
            <td class="required" colspan="2"><?php echo $lang['cms_special_image_link_url'];?> </td>
          </tr>
          <tr class="noborder">
            <td class="vatop rowform"><img alt="" src="" class=""></td>
            <td></td>
          </tr>
          <tr class="noborder">
            <td class="vatop rowform"><input nctype="_image_insert_link" type="text" class="txt" /></td>
            <td class="vatop tips"><span class="vatop rowform"><?php echo $lang['cms_special_image_link_url_explain'];?></span></td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="2"><a nctype="btn_image_insert_link" href="JavaScript:void(0);" class="btn" ><span><?php echo $lang['cms_text_save'];?></span></a></td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
  <!-- 插入图片热点对话框 -->
  <div id="_dialog_image_insert_hot_point" style="display:none;">
    <div class="dialog-image-insert-hot-point">
      <div class="s-tips"><i></i><?php echo $lang['cms_special_image_link_hot_explain1'];?></div>
      <table id="upload_adv_type" class="table tb-type2">
        <tbody>
          <tr>
            <td class="required" colspan="2"><?php echo $lang['cms_special_image_link_hot_select'];?><?php echo $lang['nc_colon'];?></td>
          </tr>
          <tr class="noborder">
            <td colspan="2"><div ncytpe="div_image_insert_hot_point" class="special-hot-point" > <img nctype="img_hot_point" alt="" src="<?php echo $image_url;?>"> </div></td>
          </tr>
          <tr>
            <td class="required" colspan="2"><?php echo $lang['cms_special_image_link_hot_url'];?><?php echo $lang['nc_colon'];?></td>
          </tr>
          <tr class="noborder">
            <td class="vatop rowform"><input nctype="x1" type="hidden" />
              <input nctype="y1" type="hidden" />
              <input nctype="x2" type="hidden" />
              <input nctype="y2" type="hidden" />
              <input nctype="w" type="hidden" />
              <input nctype="h" type="hidden" />
              <input nctype="url" type="text" class="txt" style=" width:200px; margin: 0;" />
              <a class="btns" nctype="btn_hot_point_commit" href="javascript:void(0);"><span><?php echo $lang['cms_text_save'];?></span></a></td>
            <td class="vatop tips"><span class="vatop rowform"><?php echo $lang['cms_special_image_link_url_explain'];?></span></td>
          </tr>
          <tr>
            <td colspan="2"><ul nctype="list" class="hot-point-list">
              </ul></td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
            <td colspan="2"><a  nctype="btn_image_insert_hot_point" href="JavaScript:void(0);" class="btn" ><span><?php echo $lang['cms_special_insert_editor'];?></span></a></td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
  <!-- 插入商品对话框 -->
  <div id="_dialog_special_insert_goods" style="display:none;">
    <div class="upload_adv_dialog dialog-special-insert-goods">
      <div class="s-tips"><i></i><?php echo $lang['cms_special_goods_explain1'];?></div>
      <table id="upload_adv_type" class="table tb-type2">
        <tbody>
          <tr>
            <td class="required" colspan="2"><?php echo $lang['cms_special_goods_url'];?><?php echo $lang['nc_colon'];?></td>
          </tr>
          <tr class="noborder">
            <td class="vatop rowform"><input nctype="_input_goods_link" type="text" class="txt" style=" width:200px; margin: 0;" />
              <a class="btns"  nctype="btn_special_goods" href="javascript:void(0);"><span><?php echo $lang['cms_text_save'];?></span></a></td>
            <td class="vatop tips"><span class="vatop rowform"><?php echo $lang['cms_special_goods_explain3'];?></span></td>
          </tr>
          <tr class="noborder">
            <td colspan="2"><ul nctype="_special_goods_list" class="special-goods-list">
              </ul></td>
          </tr>
        </tbody>
        <tfoot>
          <tr>
              <td colspan="2">
                  <a nctype="btn_special_insert_goods" href="JavaScript:void(0);" class="btn" ><span><?php echo $lang['cms_special_insert_editor'];?></span></a>
              </td>
          </tr>
        </tfoot>
      </table>
    </div>
  </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
	var html = '<div class="upload_adv_dialog"><div class="s-tips"><i></i>图片上传建议尺寸为220px*190px</div><form method="post" enctype="multipart/form-data" id="ajax_upload_img" name="ajax_upload_img" action="index.php?act=cms_special&op=special_image_upload"><table id="upload_adv_type" class="table tb-type2"><tbody><tr><td class="required error_title" colspan="2">图片标题<?php echo $lang["nc_colon"];?></td></tr><tr class="noborder"><td colspan="2"><input type="text" name="img_title" id="img_title" maxLength="12" style="width: 230px;"/><span style="color:999999">&nbsp;&nbsp图片标题最多为12个汉字</span></td></tr><tr><td class="required error_url" colspan="2">图片链接<?php echo $lang["nc_colon"];?></td></tr><tr class="noborder"><td colspan="2"><input type="text" name="img_url" id="img_url" style="width: 230px;"/><span style="color:999999">&nbsp;&nbsp图片链接可以是已http://开头的任意链接，也可以为空</span></td></tr><tr><td class="required error_img" colspan="2">选择图片<?php echo $lang["nc_colon"];?></td></tr><tr class="noborder"><td class="vatop rowform"><input type="file" name="special_image_upload"  id="special_image_upload_images"/></td></tr><tr><td><a class="btns" href="javascript:void(0);"  onclick="upload_submit_form()"><span><?php echo $lang["cms_text_save"];?></span></a></td></tr><tr class="noborder"><td colspan="2"><ul nctype="special_image_list_up" id="special_image_list_up"></ul></td></tr></tbody><tfoot><tr><td colspan="2"><a class="btn" id="btn_insert_img" href="JavaScript:void(0);"><span>插入编辑器</span></a></td></tr></tfoot></table></form></div>'
    //插入图片对话框
    $("#btn_show_special_upload_img").click(function(){
        html_form('dialog_special_upload_img', '上传图片', html, 640);
    });
    $('.delete').live('click', function(){
        var image_name = $(this).attr('nctype');
		$(this).parent().parent().remove();
        $.get('index.php?act=cms_special&op=special_image_drop', {image_name:image_name}, function(){return;});
    });
});
function upload_submit_form(){
	$('.error').remove();
	if($('#img_title').val() == ''){ $('.error_title').append('<label class="error">图片标题不能为空</label>'); return;};
	if($("#img_url").val() != '' && $("#img_url").val().substr(0,7) != 'http://'){ $('.error_url').append('<label class="error">请填写真确格式的链接</label>'); return;}
	if($('#special_image_upload_images').val() == ''){ $('.error_img').append('<label class="error">请选择图片</label>'); return;}
	$('#ajax_upload_img').ajaxSubmit({
	     type : 'post',
	     url : 'index.php?act=cms_special&op=special_image_upload',
	     success : function(data){
		     if(data != ''){
	         	 var dataJson = eval('('+ data +')');
	         	 if($('#img_url').val() == ''){
	         	 	var atr = 'href="javascript:void(0);"';
		         }else{
			         var atr = 'href='+ $('#img_url').val() +' target="_blank"';
			     }
	         	 var html_li = '<li style="float:left"><dl><dd class="image"><a '+ atr +' ><img src="'+ dataJson.file_url +'"/></a></dd><dd class="title"><a '+ atr +' >'+ $('#img_title').val() +'</a></dd><dd class="delete" title="删除上传的图片" nctype="'+ dataJson.file_name +'">x</dd></dl></li>';
				 $('.upload_adv_dialog').find("#special_image_list_up").append(html_li);
		     }
	     }
 	});
}

</script>