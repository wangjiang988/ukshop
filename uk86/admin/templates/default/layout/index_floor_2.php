<style>
</style>
<tabl;height:200pxe id="layout_style" class="table tb-type2 nohover">    <!--模板编辑-->
<tbody>
<tr>
    <td colspan="2" class="required"><label><?php echo $lang['web_config_edit_html'].$lang['nc_colon'];?></label></td>  <!--板块内容设置-->
</tr>
<tr class="noborder">
    <td colspan="2" class="vatop"><div class="home-templates-board-layout style-<?php echo $output['web_array']['style_name'];?>">
            <div class="left">


                <!--                <dl id="left_tit">   <!--标题图片设置-->
                <!--                    <dt>-->
                <!--                    <h4>--><?php //echo $lang['web_config_picture_tit'];?><!--</h4>-->
                <!--                    <a href="JavaScript:show_dialog('upload_tit');"><i class="icon-edit"></i>--><?php //echo $lang['nc_edit'];?><!--</a></dt>-->
                <!--                    <dd class="tit-txt" --><?php //if($output['code_tit']['code_info']['type'] != 'txt'){ ?><!--style="display:none;"--><?php //} ?><!-->
                <!--                        <div id="picture_floor" class="txt-type">-->
                <!--                            <span>--><?php //echo $output['code_tit']['code_info']['floor'];?><!--</span>-->
                <!--                            <h2>--><?php //echo $output['code_tit']['code_info']['title'];?><!--</h2>-->
                <!--                        </div>-->
                <!--                    </dd>-->
                <!--                    <dd class="tit-pic" --><?php //if($output['code_tit']['code_info']['type'] == 'txt'){ ?><!--style="display:none;"--><?php //} ?><!-->
                <!--                        <div id="picture_tit" class="picture">-->
                <!--                            <img src="--><?php //echo UPLOAD_SITE_URL.'/'.$output['code_tit']['code_info']['pic'];?><!--"/>-->
                <!--                        </div>-->
                <!--                    </dd>-->
                <!--                </dl>-->
                <dl style="height: 300px;">     <!-- 活动图片设置-->
                    <dt>
                    <h4><?php echo $lang['web_config_picture_act'];?></h4>
                    <a href="JavaScript:show_dialog('upload_act');"><i class="icon-picture"></i><?php echo $lang['nc_edit'];?></a></dt>
                    <dd class="act-pic">
                        <div id="picture_act" class="picture">
                            <?php if(!empty($output['code_act']['code_info']['pic'])) { ?>
                                <img src="<?php echo UPLOAD_SITE_URL.'/'.$output['code_act']['code_info']['pic'];?>"/>
                            <?php } ?>
                        </div>
                    </dd>
                </dl>
                <dl class="left-tit" style="height:120px;">   <!-- 左侧下面的分类-->
                    <dt>
                    <h4><?php echo $lang['web_config_edit_category'];?></h4>
                    <a href="JavaScript:show_dialog('category_list');"><i class="icon-th"></i><?php echo $lang['nc_edit'];?></a></dt>
                    <dd class="category-list">
                        <?php if (is_array($output['code_category_list']['code_info']['goods_class']) && !empty($output['code_category_list']['code_info']['goods_class'])) { ?>
                            <ul>
                                <?php foreach ($output['code_category_list']['code_info']['goods_class'] as $k => $v) { ?>
                                    <li title="<?php echo $v['gc_name'];?>"><a href="javascript:void(0);"><?php echo $v['gc_name'];?></a></li>
                                <?php } ?>
                            </ul>
                        <?php }else { ?>
                            <ul>
                                <li><a href="javascript:void(0);"><?php echo $lang['web_config_gc_name'];?></a></li>
                                <li><a href="javascript:void(0);"><?php echo $lang['web_config_gc_name'];?></a></li>
                                <li><a href="javascript:void(0);"><?php echo $lang['web_config_gc_name'];?></a></li>
                                <li><a href="javascript:void(0);"><?php echo $lang['web_config_gc_name'];?></a></li>
                                <li><a href="javascript:void(0);"><?php echo $lang['web_config_gc_name'];?></a></li>
                                <li><a href="javascript:void(0);"><?php echo $lang['web_config_gc_name'];?></a></li>
                                <!--  <li><a href="javascript:void(0);"><?php /*echo $lang['web_config_gc_name'];*/?></a></li>
                                <li><a href="javascript:void(0);"><?php /*echo $lang['web_config_gc_name'];*/?></a></li>
                                <li><a href="javascript:void(0);"><?php /*echo $lang['web_config_gc_name'];*/?></a></li>
                                <li><a href="javascript:void(0);"><?php /*echo $lang['web_config_gc_name'];*/?></a></li>
                                <li><a href="javascript:void(0);"><?php /*echo $lang['web_config_gc_name'];*/?></a></li>
                                <li><a href="javascript:void(0);"><?php /*echo $lang['web_config_gc_name'];*/?></a></li>-->
                            </ul>
                        <?php } ?>
                    </dd>
                </dl>
                <!--<dl>
                    <dt>
                    <h4><?php /*echo $lang['web_config_brand_title'];*/?></h4>
                    <a href="JavaScript:show_dialog('brand_list');"><i class="icon-ticket"></i><?php /*echo $lang['nc_edit'];*/?></a></dt>
                    <dd>
                        <ul class="brands" style="height:120px;">
                            <?php /*if (is_array($output['code_brand_list']['code_info']) && !empty($output['code_brand_list']['code_info'])) { */?>
                                <?php /*foreach ($output['code_brand_list']['code_info'] as $key => $val) { */?>
                                    <li><span><img title="<?php /*echo $val['brand_name'];*/?>" src="<?php /*echo UPLOAD_SITE_URL.'/'.$val['brand_pic'];*/?>"/> </span></li>
                                <?php /*} */?>
                            <?php /*}else { */?>
                                <li>
                                    <span><i class="icon-picture"></i></span>
                                </li>
                                <li>
                                    <span><i class="icon-picture"></i></span>
                                </li>
                                <li>
                                    <span><i class="icon-picture"></i></span>
                                </li>
                                <li>
                                    <span><i class="icon-picture"></i></span>
                                </li>
                                <li>
                                    <span><i class="icon-picture"></i></span>
                                </li>
                                <li>
                                    <span><i class="icon-picture"></i></span>
                                </li>
                            <?php /*} */?>
                        </ul>
                    </dd>
                </dl>-->
            </div>
            <div class="middle" style="width:700px">  <!--中间部分-->
                <div><?php if (is_array($output['code_recommend_list']['code_info']) && !empty($output['code_recommend_list']['code_info'])) { ?>
                        <?php foreach ($output['code_recommend_list']['code_info'] as $key => $val) { ?>
                            <?php if(!empty($val['goods_list']) && is_array($val['goods_list'])){?>
                                <dl recommend_id="<?php echo $key;?>">
                                    <dt>
                                    <h4><?php echo $val['recommend']['name'];?></h4>
                                    <a href="JavaScript:del_recommend(<?php echo $key;?>);"><i class="icon-remove-sign "></i><?php echo $lang['nc_del'];$i=0?></a>
                                    <a href="JavaScript:show_recommend_dialog(<?php echo $key;?>);"><i class="icon-shopping-cart"></i><?php echo '商品块';?></a>
                                    <!-- <a href="JavaScript:show_recommend_pic_dialog(<?php /*echo $key;*/?>);"><i class="icon-lightbulb"></i><?php /*echo '广告块';*/?></a>-->
                                    </dt>
                                    <dd>
                                        <?php if(!empty($val['goods_list']) && is_array($val['goods_list'])) { ?>
                                            <ul class="goods-list" style="width: 700px !important;height:400px">
                                                <?php foreach($val['goods_list'] as $k => $v) { ?>
                                                    <li style="height:200px;width:139px"><!--<span>--><!--<a href="javascript:void(0);">-->
                                                        <img style="height:200px;width:139px" title="<?php echo $v['goods_name'];?>" src="<?php echo strpos($v['goods_pic'],'http')===0 ? $v['goods_pic']:UPLOAD_SITE_URL."/".$v['goods_pic'];?>"/><!--</a></span>-->
                                                    </li>
                                                <?php } ?>
                                            </ul>
                                        <?php } elseif (!empty($val['pic_list']) && is_array($val['pic_list'])) { ?>
                                            <!-- <div class="middle-banner">
                                            <a href="javascript:void(0);" class="left-a"><img pic_url="<?php /*echo $val['pic_list']['11']['pic_url'];*/?>" title="<?php /*echo $val['pic_list']['11']['pic_name'];*/?>" src="<?php /*echo UPLOAD_SITE_URL.'/'.$val['pic_list']['11']['pic_img'];*/?>"/></a>
                                            <a href="javascript:void(0);" class="left-b"><img pic_url="<?php /*echo $val['pic_list']['12']['pic_url'];*/?>" title="<?php /*echo $val['pic_list']['12']['pic_name'];*/?>" src="<?php /*echo UPLOAD_SITE_URL.'/'.$val['pic_list']['12']['pic_img'];*/?>"/></a>
                                            <a href="javascript:void(0);" class="middle-a"><img pic_url="<?php /*echo $val['pic_list']['14']['pic_url'];*/?>" title="<?php /*echo $val['pic_list']['14']['pic_name'];*/?>" src="<?php /*echo UPLOAD_SITE_URL.'/'.$val['pic_list']['14']['pic_img'];*/?>"/></a>
                                            <a href="javascript:void(0);" class="right-a"><img pic_url="<?php /*echo $val['pic_list']['21']['pic_url'];*/?>" title="<?php /*echo $val['pic_list']['21']['pic_name'];*/?>" src="<?php /*echo UPLOAD_SITE_URL.'/'.$val['pic_list']['21']['pic_img'];*/?>"/></a>
                                            <a href="javascript:void(0);" class="right-b"><img pic_url="<?php /*echo $val['pic_list']['24']['pic_url'];*/?>" title="<?php /*echo $val['pic_list']['24']['pic_name'];*/?>" src="<?php /*echo UPLOAD_SITE_URL.'/'.$val['pic_list']['24']['pic_img'];*/?>"/></a>
                                            <a href="javascript:void(0);" class="bottom-a"><img pic_url="<?php /*echo $val['pic_list']['31']['pic_url'];*/?>" title="<?php /*echo $val['pic_list']['31']['pic_name'];*/?>" src="<?php /*echo UPLOAD_SITE_URL.'/'.$val['pic_list']['31']['pic_img'];*/?>"/></a>
                                            <a href="javascript:void(0);" class="bottom-b"><img pic_url="<?php /*echo $val['pic_list']['32']['pic_url'];*/?>" title="<?php /*echo $val['pic_list']['32']['pic_name'];*/?>" src="<?php /*echo UPLOAD_SITE_URL.'/'.$val['pic_list']['32']['pic_img'];*/?>"/></a>
                                            <a href="javascript:void(0);" class="bottom-c"><img pic_url="<?php /*echo $val['pic_list']['33']['pic_url'];*/?>" title="<?php /*echo $val['pic_list']['33']['pic_name'];*/?>" src="<?php /*echo UPLOAD_SITE_URL.'/'.$val['pic_list']['33']['pic_img'];*/?>"/></a>
                                            <a href="javascript:void(0);" class="bottom-d"><img pic_url="<?php /*echo $val['pic_list']['34']['pic_url'];*/?>" title="<?php /*echo $val['pic_list']['34']['pic_name'];*/?>" src="<?php /*echo UPLOAD_SITE_URL.'/'.$val['pic_list']['34']['pic_img'];*/?>"/></a>
                                        </div>-->
                                        <?php }else { ?>
                                            <ul class="goods-list" style="width: 700px !important;height:400px">
                                                <li style="width:135px;height:200px"><img src="http://placehold.it/135*200" /></li>
                                                <li style="width:135px;height:200px"><i class="icon-gift"></i></li>
                                                <li style="width:135px;height:200px"><i class="icon-gift"></i></li>
                                                <li style="width:135px;height:200px"><i class="icon-gift"></i></li>
                                                <li style="width:135px;height:200px"><i class="icon-gift"></i></li>
                                                <li style="width:135px;height:200px"><i class="icon-gift"></i></li>
                                                <li style="width:135px;height:200px"><i class="icon-gift"></i></li>
                                                <li style="width:135px;height:200px"><i class="icon-gift"></i></li>
                                                <li style="width:135px;height:200px"><i class="icon-gift"></i></li>
                                                <li style="width:135px;height:200px"><i class="icon-gift"></i></li>
                                            </ul>
                                        <?php } ?>
                                    </dd>
                                </dl>
                            <?php }?>
                        <?php } ?>
                    <?php } ?>

                     <div class="add-tab" id="btn_add_list"><a href="JavaScript:add_recommend();"><i class="icon-plus-sign-alt"></i><?php echo $lang['web_config_add_recommend'];?></a></div>
                </div>
            </div>
            <!--  <div class="right">

                <dl>
                    <dt>
                    <h4><?php /*echo '切换广告图片';*/?></h4>
                    <a href="JavaScript:show_dialog('upload_adv');"><?php /*echo $lang['nc_edit'];*/?></a></dt>
                    <dd class="adv-pic">
                        <div id="picture_adv" class="picture">
                            <?php /*if(is_array($output['code_adv']['code_info']) && !empty($output['code_adv']['code_info'])) {
                                $adv = current($output['code_adv']['code_info']);
                                */?>
                                <?php /*if(is_array($adv) && !empty($adv)) { */?>
                                    <img src="<?php /*echo UPLOAD_SITE_URL.'/'.$adv['pic_img'];*/?>"/>
                                <?php /*} */?>
                            <?php /*} */?>
                        </div>
                    </dd>
                </dl>
            </div>-->
        </div></td>
</tr>
</tbody>
<tfoot>
<tr class="tfoot">
    <td colspan="2" ><a href="index.php?act=web_config&op=web_html&web_id=<?php echo $_GET['web_id'];?>&web_style=<?php echo $_GET['style'];?>" class="btn" id="submitBtn"><span><?php echo $lang['web_config_web_html'];?></span></a></td>
</tr>
</tfoot>
</table>
<!-- 标题图片 -->
<div id="upload_tit_dialog" style="display:none;">  <!--左侧点编辑之后的弹窗-->
    <table class="table tb-type2">
        <tbody>
        <tr class="space odd" id="prompt">
            <th class="nobg" colspan="12"><div class="title">
                    <h5><?php echo $lang['nc_prompts'];?></h5>
                    <span class="arrow"></span></div></th>
        </tr>
        <tr>
            <td><ul>
                    <li><?php echo $lang['web_config_prompt_tit'];?></li>
                </ul></td>
        </tr>
        </tbody>
    </table>
    <form id="upload_tit_form" name="upload_tit_form" enctype="multipart/form-data" method="post" action="index.php?act=web_api&op=upload_pic" target="upload_pic">
        <input type="hidden" name="form_submit" value="ok" />
        <input type="hidden" name="web_id" value="<?php echo $output['code_tit']['web_id'];?>">
        <input type="hidden" name="code_id" value="<?php echo $output['code_tit']['code_id'];?>">
        <input type="hidden" name="tit[pic]" value="<?php echo $output['code_tit']['code_info']['pic'];?>">
        <input type="hidden" name="tit[url]" value="">
        <table class="table tb-type2">
            <tbody>
            <tr>
                <td colspan="2" class="required"><?php echo $lang['web_config_upload_type'].$lang['nc_colon'];?>
                </td>
            </tr>
            <tr class="noborder">
                <td class="vatop rowform">
                    <label title="<?php echo $lang['web_config_upload_pic'];?>">
                        <input type="radio" name="tit[type]" value="pic" onclick="upload_type('tit');" <?php if($output['code_tit']['code_info']['type'] != 'txt'){ ?>checked="checked"<?php } ?>>
                        <span><?php echo $lang['web_config_upload_pic'];?></span></label>
                    <label title="<?php echo '文字类型';?>">
                        <input type="radio" name="tit[type]" value="txt" onclick="upload_type('tit');" <?php if($output['code_tit']['code_info']['type'] == 'txt'){ ?>checked="checked"<?php } ?>>
                        <span><?php echo '文字类型';?></span></label>
                </td>
                <td class="vatop tips"></td>
            </tr>
            </tbody>
        </table>
        <table id="upload_tit_type_pic" class="table tb-type2" <?php if($output['code_tit']['code_info']['type'] == 'txt'){ ?>style="display:none;"<?php } ?>>
            <tbody>
            <tr>
                <td colspan="2" class="required"><?php echo $lang['web_config_upload_tit'].$lang['nc_colon'];?></td>
            </tr>
            <tr class="noborder">
                <td class="vatop rowform"><span class="type-file-box">
            <input type='text' name='textfield' id='textfield1' class='type-file-text' />
            <input type='button' name='button' id='button1' value='' class='type-file-button' />
            <input name="pic" id="pic" type="file" class="type-file-file" size="30">
            </span></td>
                <td class="vatop tips"><?php echo $lang['web_config_upload_tit_tips'];?></td>
            </tr>
            </tbody>
        </table>
        <table id="upload_tit_type_txt" class="table tb-type2" <?php if($output['code_tit']['code_info']['type'] != 'txt'){ ?>style="display:none;"<?php } ?>>
            <tbody>
            <tr>
                <td colspan="2" class="required"><?php echo '楼层编号'.$lang['nc_colon'];?></td>
            </tr>
            <tr class="noborder">
                <td class="vatop rowform">
                    <input class="txt" type="text" name="tit[floor]" id="tit_floor" value="<?php echo $output['code_tit']['code_info']['floor'];?>">
                </td>
                <td class="vatop tips"><?php echo '如1F、2F、3F。';?></td>
            </tr>
            <tr>
                <td colspan="2" class="required"><?php echo '版块标题'.$lang['nc_colon'];?></td>
            </tr>
            <tr class="noborder">
                <td class="vatop rowform">
                    <input class="txt" type="text" name="tit[title]" id="tit_title" value="<?php echo $output['code_tit']['code_info']['title'];?>">
                </td>
                <td class="vatop tips"><?php echo '如鞋包配饰、男女服装、运动户外。';?></td>
            </tr>
            </tbody>
        </table>
        <a href="JavaScript:void(0);" onclick="$('#upload_tit_form').submit();" class="btn"><span><?php echo $lang['nc_submit'];?></span></a>
    </form>
</div>
<!-- 推荐分类模块 -->
<div id="category_list_dialog" style="display:none;">
    <div class="dialog-handle">
        <h4 class="dialog-handle-title"><?php echo $lang['web_config_category_title'];?></h4>
        <p><span class="handle">
      <select name="gc_parent_id" id="gc_parent_id" class=" w200" onchange="get_goods_class();">
          <option value="0">-<?php echo $lang['nc_please_choose'];?>-</option>
          <?php if(!empty($output['parent_goods_class']) && is_array($output['parent_goods_class'])) { ?>
              <?php foreach($output['parent_goods_class'] as $k => $v) { ?>
                  <option value="<?php echo $v['gc_id'];?>"><?php echo $v['gc_name'];?></option>
              <?php } ?>
          <?php } ?>
      </select>
      </span> <span class="note"><?php echo $lang['web_config_category_note'];?></span></p>
    </div>
    <form id="category_list_form">
        <input type="hidden" name="web_id" value="<?php echo $output['code_category_list']['web_id'];?>">
        <input type="hidden" name="code_id" value="<?php echo $output['code_category_list']['code_id'];?>">
        <div class="s-tips"><i></i><?php echo $lang['web_config_category_tips'];?></div>
        <div class="category-list category-list-edit">
            <dl>
                <?php if (is_array($output['code_category_list']['code_info']['goods_class']) && !empty($output['code_category_list']['code_info']['goods_class'])) { ?>
                    <?php foreach($output['code_category_list']['code_info']['goods_class'] as $k => $v) { ?>
                        <dd gc_id="<?php echo $v['gc_id'];?>" title="<?php echo $v['gc_name'];?>" ondblclick="del_goods_class(<?php echo $v['gc_id'];?>);">
                            <i onclick="del_goods_class(<?php echo $v['gc_id'];?>);"></i><?php echo $v['gc_name'];?>
                            <input name="category_list[goods_class][<?php echo $v['gc_id'];?>][gc_id]" value="<?php echo $v['gc_id'];?>" type="hidden">
                            <input name="category_list[goods_class][<?php echo $v['gc_id'];?>][gc_name]" value="<?php echo $v['gc_name'];?>" type="hidden">
                        </dd>
                    <?php } ?>
                <?php } ?>
            </dl>
        </div>
        <a href="JavaScript:void(0);" onclick="update_category();" class="btn ml30"><span><?php echo $lang['web_config_save'];?></span></a>
    </form>
</div>
<!-- 活动图片 -->
<div id="upload_act_dialog" class="upload_act_dialog" style="display:none;">
    <table class="table tb-type2">
        <tbody>
        <tr class="space odd" id="prompt">
            <th class="nobg" colspan="12"><div class="title">
                    <h5><?php echo $lang['nc_prompts'];?></h5>
                    <span class="arrow"></span></div></th>
        </tr>
        <tr>
            <td><ul>
                    <li><?php echo $lang['web_config_prompt_act'];?></li>
                </ul></td>
        </tr>
        </tbody>
    </table>
    <form id="upload_act_form" name="upload_act_form" enctype="multipart/form-data" method="post" action="index.php?act=web_api&op=upload_pic" target="upload_pic">
        <input type="hidden" name="form_submit" value="ok" />
        <input type="hidden" name="web_id" value="<?php echo $output['code_act']['web_id'];?>"/>
        <input type="hidden" name="code_id" value="<?php echo $output['code_act']['code_id'];?>"/>
        <input type="hidden" name="act[pic]" value="<?php echo $output['code_act']['code_info']['pic'];?>"/>
        <input type="hidden" name="act[type]" value="pic"/>
        <table class="table tb-type2" id="upload_act_type_pic" <?php if($output['code_act']['code_info']['type'] == 'adv') { ?>style="display:none;"<?php } ?>>
            <tbody>
            <tr>
                <td colspan="2" class="required"><?php echo '活动名称'.$lang['nc_colon'];?></td>
            </tr>
            <tr class="noborder">
                <td class="vatop rowform">
                    <input class="txt" type="text" name="act[title]" value="<?php echo $output['code_act']['code_info']['title'];?>"/>
                </td>
                <td class="vatop tips"><?php echo '';?></td>
            </tr>
            <tr>
                <td colspan="2" class="required"><label><?php echo $lang['web_config_upload_url'].$lang['nc_colon'];?></label></td>
            </tr>
            <tr class="noborder">
                <td class="vatop rowform"><input name="act[url]" value="<?php echo !empty($output['code_act']['code_info']['url']) ? $output['code_act']['code_info']['url']:SHOP_SITE_URL;?>" class="txt" type="text"></td>
                <td class="vatop tips"><?php echo $lang['web_config_upload_act_url'];?></td>
            </tr>
            <tr>
                <td colspan="2" class="required"><label><?php echo $lang['web_config_upload_act'].$lang['nc_colon'];?></label></td>
            </tr>
            <tr class="noborder">
                <td class="vatop rowform"><span class="type-file-box">
            <input type='text' name='textfield' id='textfield1' class='type-file-text' />
            <input type='button' name='button' id='button1' value='' class='type-file-button' />
            <input name="pic" id="pic" type="file" class="type-file-file" size="30"/>
            </span></td>
                <td class="vatop tips"><?php echo $lang['web_config_upload_act_tips'];?></td>
            </tr>
            </tbody>
        </table>
        <a href="JavaScript:void(0);" onclick="$('#upload_act_form').submit();" class="btn"><span><?php echo $lang['nc_submit'];?></span></a>
    </form>
</div>
<!-- 商品推荐模块 -->
<div id="recommend_list_dialog" style="display:none;">
    <form id="recommend_list_form">
        <input type="hidden" name="web_id" value="<?php echo $output['code_recommend_list']['web_id'];?>">
        <input type="hidden" name="code_id" value="<?php echo $output['code_recommend_list']['code_id'];?>">
        <div id="recommend_input_list" style="display:none;"><!-- 推荐拖动排序 --></div>
        <?php if (is_array($output['code_recommend_list']['code_info']) && !empty($output['code_recommend_list']['code_info'])) { ?>
            <?php foreach ($output['code_recommend_list']['code_info'] as $key => $val) { ?>
                <dl select_recommend_id="<?php echo $key;?>">
                    <dt>
                    <h4 class="dialog-handle-title"><?php echo $lang['web_config_recommend_title'];?></h4>
                    <div class="dialog-handle-box"><span class="left">
                  <input name="recommend_list[<?php echo $key;?>][recommend][name]" value="<?php echo $val['recommend']['name'];?>" type="text" class="w200">
                  </span><span class="right"><?php echo $lang['web_config_recommend_tips'];?></span>
                        <div class="clear"></div>
                    </div>
                    </dt>
                    <dd>
                        <h4 class="dialog-handle-title"><?php echo $lang['web_config_recommend_goods'];?></h4>
                        <div class="s-tips"><i></i><?php echo $lang['web_config_recommend_goods_tips'];?></div>
                        <ul class="dialog-goodslist-s1 goods-list">
                            <?php if(!empty($val['goods_list']) && is_array($val['goods_list'])) { ?>
                                <?php foreach($val['goods_list'] as $k => $v) { ?>
                                    <li id="select_recommend_<?php echo $key;?>_goods_<?php echo $k;?>">
                                        <div ondblclick="del_recommend_goods(<?php echo $v['goods_id'];?>);" class="goods-pic">
                                            <span class="ac-ico" onclick="del_recommend_goods(<?php echo $v['goods_id'];?>);"></span> <span class="thumb size-72x72"><i></i><img select_goods_id="<?php echo $v['goods_id'];?>" title="<?php echo $v['goods_name'];?>" src="<?php echo strpos($v['goods_pic'],'http')===0 ? $v['goods_pic']:UPLOAD_SITE_URL."/".$v['goods_pic'];?>" onload="javascript:DrawImage(this,72,72);" /></span></div>
                                        <div class="goods-name"><a href="<?php echo SHOP_SITE_URL."/index.php?act=goods&goods_id=".$v['goods_id'];?>" target="_blank"><?php echo $v['goods_name'];?></a></div>
                                        <input name="recommend_list[<?php echo $key;?>][goods_list][<?php echo $v['goods_id'];?>][goods_id]" value="<?php echo $v['goods_id'];?>" type="hidden">
                                        <input name="recommend_list[<?php echo $key;?>][goods_list][<?php echo $v['goods_id'];?>][market_price]" value="<?php echo $v['market_price'];?>" type="hidden">
                                        <input name="recommend_list[<?php echo $key;?>][goods_list][<?php echo $v['goods_id'];?>][goods_name]" value="<?php echo $v['goods_name'];?>" type="hidden">
                                        <input name="recommend_list[<?php echo $key;?>][goods_list][<?php echo $v['goods_id'];?>][goods_price]" value="<?php echo $v['goods_price'];?>" type="hidden">
                                        <input name="recommend_list[<?php echo $key;?>][goods_list][<?php echo $v['goods_id'];?>][goods_pic]" value="<?php echo $v['goods_pic'];?>" type="hidden">
                                    </li>
                                <?php } ?>
                            <?php } elseif (!empty($val['pic_list']) && is_array($val['pic_list'])) { ?>
                                <?php foreach($val['pic_list'] as $k => $v) { ?>
                                    <li id="select_recommend_<?php echo $key;?>_pic_<?php echo $k;?>" style="display:none;">
                                        <input name="recommend_list[<?php echo $key;?>][pic_list][<?php echo $v['pic_id'];?>][pic_id]" value="<?php echo $v['pic_id'];?>" type="hidden">
                                        <input name="recommend_list[<?php echo $key;?>][pic_list][<?php echo $v['pic_id'];?>][pic_name]" value="<?php echo $v['pic_name'];?>" type="hidden">
                                        <input name="recommend_list[<?php echo $key;?>][pic_list][<?php echo $v['pic_id'];?>][pic_url]" value="<?php echo $v['pic_url'];?>" type="hidden">
                                        <input name="recommend_list[<?php echo $key;?>][pic_list][<?php echo $v['pic_id'];?>][pic_img]" value="<?php echo $v['pic_img'];?>" type="hidden">
                                    </li>
                                <?php } ?>
                            <?php } ?>
                        </ul>
                    </dd>
                </dl>
            <?php } ?>
        <?php } ?>
        <div id="add_recommend_list" style="display:none;"></div>
        <h4 class="dialog-handle-title"><?php echo $lang['web_config_recommend_add_goods'];?></h4>
        <div class="dialog-show-box">
            <table class="tb-type1 noborder search">
                <tbody>
                <tr>
                    <th><label><?php echo $lang['web_config_recommend_gcategory'];?></label></th>
                    <td class="dialog-select-bar" id="recommend_gcategory">
                        <input type="hidden" id="cate_id" name="cate_id" value="0" class="mls_id" />
                        <input type="hidden" id="cate_name" name="cate_name" value="" class="mls_names" />
                        <select>
                            <option value="0">-<?php echo $lang['nc_please_choose'];?>-</option>
                            <?php if(!empty($output['goods_class']) && is_array($output['goods_class'])) { ?>
                                <?php foreach($output['goods_class'] as $k => $v) { ?>
                                    <option value="<?php echo $v['gc_id'];?>"><?php echo $v['gc_name'];?></option>
                                <?php } ?>
                            <?php } ?>
                        </select>
                    </td>
                </tr>
                <tr>
                    <th><label for="recommend_goods_name"><?php echo $lang['web_config_recommend_goods_name'];?></label></th>
                    <td><input type="text" value="" name="recommend_goods_name" id="recommend_goods_name" class="txt">
                        <a href="JavaScript:void(0);" onclick="get_recommend_goods();" class="btn-search " title="<?php echo $lang['nc_query'];?>"></a>
                    </td>
                </tr>
                </tbody>
            </table>
            <div id="show_recommend_goods_list" class="show-recommend-goods-list"></div>
            <div class="clear"></div>
        </div>
        <div class="clear"></div>
        <a href="JavaScript:void(0);" onclick="update_recommend();" class="btn"><span><?php echo $lang['web_config_save'];?></span></a>
    </form>
</div>
<!-- 中部推荐图片 -->
<div id="recommend_pic_dialog" style="display:none;">
    <form id="recommend_pic_form" name="recommend_pic_form" enctype="multipart/form-data" method="post" action="index.php?act=web_api&op=recommend_pic" target="upload_pic">
        <input type="hidden" name="form_submit" value="ok" />
        <input type="hidden" name="web_id" value="<?php echo $output['code_recommend_list']['web_id'];?>">
        <input type="hidden" name="code_id" value="<?php echo $output['code_recommend_list']['code_id'];?>">
        <input type="hidden" name="key_id" value="">
        <input type="hidden" name="pic_id" value="">
        <dl>
            <dt>
            <h4 class="dialog-handle-title"><?php echo '推荐模块标题名称';?></h4>
            <div class="dialog-handle-box"><span class="left">
              <input name="recommend_list[recommend][name]" value="" type="text" class="w200">
              </span><span class="right"><?php echo ' 修改该区域中部推荐模块选项卡名称，控制名称字符在4-8字左右，超出范围自动隐藏';?></span>
                <div class="clear"></div>
            </div>
            </dt>
        </dl>
        <div class="s-tips"><i></i><?php echo '单击左侧编号选中对应的位置，在右侧上传和修改图片信息。';?></div>
        <table class="">
            <tr>
                <td id="add_recommend_pic">
                    <?php if (is_array($output['code_recommend_list']['code_info']) && !empty($output['code_recommend_list']['code_info'])) { ?>
                        <?php foreach ($output['code_recommend_list']['code_info'] as $key => $val) { ?>
                            <?php if (!empty($val['pic_list']) && is_array($val['pic_list'])) { ?>
                                <div select_recommend_pic_id="<?php echo $key;?>" class="middle-banner">
                                    <a recommend_pic_id="11" href="javascript:void(0);" class="left-a"><img pic_url="<?php echo $val['pic_list']['11']['pic_url'];?>" title="<?php echo $val['pic_list']['11']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['11']['pic_img'];?>"/></a>
                                    <a recommend_pic_id="12" href="javascript:void(0);" class="left-b"><img pic_url="<?php echo $val['pic_list']['12']['pic_url'];?>" title="<?php echo $val['pic_list']['12']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['12']['pic_img'];?>"/></a>
                                    <a recommend_pic_id="14" href="javascript:void(0);" class="middle-a"><img pic_url="<?php echo $val['pic_list']['14']['pic_url'];?>" title="<?php echo $val['pic_list']['14']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['14']['pic_img'];?>"/></a>
                                    <a recommend_pic_id="21" href="javascript:void(0);" class="right-a"><img pic_url="<?php echo $val['pic_list']['21']['pic_url'];?>" title="<?php echo $val['pic_list']['21']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['21']['pic_img'];?>"/></a>
                                    <a recommend_pic_id="24" href="javascript:void(0);" class="right-b"><img pic_url="<?php echo $val['pic_list']['24']['pic_url'];?>" title="<?php echo $val['pic_list']['24']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['24']['pic_img'];?>"/></a>
                                    <a recommend_pic_id="31" href="javascript:void(0);" class="bottom-a"><img pic_url="<?php echo $val['pic_list']['31']['pic_url'];?>" title="<?php echo $val['pic_list']['31']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['31']['pic_img'];?>"/></a>
                                    <a recommend_pic_id="32" href="javascript:void(0);" class="bottom-b"><img pic_url="<?php echo $val['pic_list']['32']['pic_url'];?>" title="<?php echo $val['pic_list']['32']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['32']['pic_img'];?>"/></a>
                                    <a recommend_pic_id="33" href="javascript:void(0);" class="bottom-c"><img pic_url="<?php echo $val['pic_list']['33']['pic_url'];?>" title="<?php echo $val['pic_list']['33']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['33']['pic_img'];?>"/></a>
                                    <a recommend_pic_id="34" href="javascript:void(0);" class="bottom-d"><img pic_url="<?php echo $val['pic_list']['34']['pic_url'];?>" title="<?php echo $val['pic_list']['34']['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_list']['34']['pic_img'];?>"/></a>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    <?php } ?>
                </td>
                <td>
                    <table class="table tb-type2">
                        <tbody>
                        <tr>
                            <td><?php echo '文字标题'.$lang['nc_colon'];?></td>
                        </tr>
                        <tr class="noborder">
                            <td class="vatop rowform">
                                <input class="txt" type="text" name="pic_list[pic_name]" value="">
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo '跳转链接'.$lang['nc_colon'];?></td>
                        </tr>
                        <tr class="noborder">
                            <td class="vatop rowform">
                                <input class="txt" type="text" name="pic_list[pic_url]" value="<?php echo SHOP_SITE_URL;?>">
                            </td>
                        </tr>
                        <tr>
                            <td><?php echo '图片上传'.$lang['nc_colon'];?></td>
                        </tr>
                        <tr class="noborder">
                            <td class="vatop rowform"><span class="type-file-box">
                        <input type='text' name='textfield' id='textfield1' value='' class='type-file-text' />
                        <input type='button' name='button' id='button1' value='' class='type-file-button' />
                        <input name="pic" id="pic" type="file" class="type-file-file" value='' size="30">
                        </span></td>
                        </tr>
                        </tbody>
                        <tfoot>
                        <tr class="tfoot">
                            <td colspan="15" ><a href="JavaScript:void(0);" onclick="$('#recommend_pic_form').submit();" class="btn"><span><?php echo $lang['web_config_save'];?></span></a></td>
                        </tr>
                        </tfoot>
                    </table>
                </td>
            </tr>
        </table>
    </form>
</div>
<!-- 品牌模块 -->
<div id="brand_list_dialog" class="brand_list_dialog" style="display:none;">
    <form id="brand_list_form">
        <input type="hidden" name="web_id" value="<?php echo $output['code_brand_list']['web_id'];?>">
        <input type="hidden" name="code_id" value="<?php echo $output['code_brand_list']['code_id'];?>">
        <dd>
            <h4 class="dialog-handle-title"><?php echo '已选择品牌';?></h4>
            <div class="s-tips"><i></i><?php echo $lang['web_config_brand_tips'];?></div>
            <ul class="brands dialog-brandslist-s1">
                <?php if (is_array($output['code_brand_list']['code_info']) && !empty($output['code_brand_list']['code_info'])) { ?>
                    <?php foreach ($output['code_brand_list']['code_info'] as $key => $val) { ?>
                        <li>
                            <div class="brands-pic"><span class="ac-ico" onclick="del_brand(<?php echo $val['brand_id'];?>);"></span><span class="thumb size-88x29"><i></i><img ondblclick="del_brand(<?php echo $val['brand_id'];?>);" select_brand_id="<?php echo $val['brand_id'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['brand_pic'];?>" onload="javascript:DrawImage(this,88,30);" /></span></div>
                            <div class="brands-name"><?php echo $val['brand_name'];?></div>
                            <input name="brand_list[<?php echo $val['brand_id'];?>][brand_id]" value="<?php echo $val['brand_id'];?>" type="hidden">
                            <input name="brand_list[<?php echo $val['brand_id'];?>][brand_name]" value="<?php echo $val['brand_name'];?>" type="hidden">
                            <input name="brand_list[<?php echo $val['brand_id'];?>][brand_pic]" value="<?php echo $val['brand_pic'];?>" type="hidden">
                        </li>
                    <?php } ?>
                <?php } ?>
            </ul>
        </dd>
        <h4 class="dialog-handle-title"><?php echo $lang['web_config_brand_list'];?></h4>
        <div class="dialog-show-box">
            <table class="tb-type1 noborder search">
                <tbody>
                <tr>
                    <th><label for="recommend_brand_name"><?php echo '品牌名称';?></label></th>
                    <td><input type="text" value="" name="recommend_brand_name" id="recommend_brand_name" class="txt">
                        <a href="JavaScript:void(0);" onclick="get_recommend_brand();" class="btn-search " title="<?php echo $lang['nc_query'];?>"></a>
                    </td>
                </tr>
                </tbody>
            </table>
            <div id="show_brand_list"></div></div>

        <a href="JavaScript:void(0);" onclick="update_brand();" class="btn"><span><?php echo $lang['web_config_save'];?></span></a>
    </form>
</div>
<!-- 切换广告图片 -->
<div id="upload_adv_dialog" class="upload_adv_dialog" style="display:none;">
    <form id="upload_adv_form" name="upload_adv_form" enctype="multipart/form-data" method="post" action="index.php?act=web_api&op=slide_adv" target="upload_pic">
        <input type="hidden" name="web_id" value="<?php echo $output['code_adv']['web_id'];?>">
        <input type="hidden" name="code_id" value="<?php echo $output['code_adv']['code_id'];?>">
        <dd>
            <h4 class="dialog-handle-title"><?php echo '已上传图片';?></h4>
            <div class="s-tips"><i></i><?php echo '小提示：单击图片选中修改，拖动可以排序，最少保留1个，最多可加5个，保存后生效。';?></div>
            <ul class="adv dialog-adv-s1">
                <?php if (is_array($output['code_adv']['code_info']) && !empty($output['code_adv']['code_info'])) { ?>
                    <?php foreach ($output['code_adv']['code_info'] as $key => $val) { ?>
                        <?php if (is_array($val) && !empty($val)) { ?>
                            <li slide_adv_id="<?php echo $val['pic_id'];?>">
                                <div class="adv-pic"><span class="ac-ico" onclick="del_slide_adv(<?php echo $val['pic_id'];?>);"></span><img onclick="select_slide_adv(<?php echo $val['pic_id'];?>);" title="<?php echo $val['pic_name'];?>" src="<?php echo UPLOAD_SITE_URL.'/'.$val['pic_img'];?>"/></div>
                                <input name="adv[<?php echo $val['pic_id'];?>][pic_id]" value="<?php echo $val['pic_id'];?>" type="hidden">
                                <input name="adv[<?php echo $val['pic_id'];?>][pic_name]" value="<?php echo $val['pic_name'];?>" type="hidden">
                                <input name="adv[<?php echo $val['pic_id'];?>][pic_url]" value="<?php echo $val['pic_url'];?>" type="hidden">
                                <input name="adv[<?php echo $val['pic_id'];?>][pic_img]" value="<?php echo $val['pic_img'];?>" type="hidden">
                            </li>
                        <?php } ?>
                    <?php } ?>
                <?php } ?>
            </ul>
            <div class="add-adv"><a class="btn-add-nofloat" href="JavaScript:add_slide_adv();"><?php echo '新增图片';?></a>(最多5个)</div>
        </dd>
        <table id="upload_slide_adv" class="table tb-type2" style="display:none;">
            <tbody>
            <tr>
                <td colspan="2" class="required"><?php echo '文字标题'.$lang['nc_colon'];?></td>
            </tr>
            <tr class="noborder">
                <td class="vatop rowform"><input type="hidden" name="slide_id" value="">
                    <input class="txt" type="text" name="slide_pic[pic_name]" value="">
                </td>
                <td class="vatop tips"></td>
            </tr>
            <tr>
                <td colspan="2" class="required"><label><?php echo $lang['web_config_upload_url'].$lang['nc_colon'];?></label></td>
            </tr>
            <tr>
                <td class="vatop rowform"><input name="slide_pic[pic_url]" value="" class="txt" type="text"></td>
                <td class="vatop tips"><?php echo $lang['web_config_adv_url_tips'];?></td>
            </tr>
            <tr>
                <td colspan="2" class="required"><?php echo $lang['web_config_upload_adv_pic'].$lang['nc_colon'];?></td>
            </tr>
            <tr class="noborder">
                <td class="vatop rowform"><span class="type-file-box">
            <input type='text' name='textfield' id='textfield1' class='type-file-text' />
            <input type='button' name='button' id='button1' value='' class='type-file-button' />
            <input name="pic" id="pic" type="file" class="type-file-file" size="30">
            </span></td>
                <td class="vatop tips"><?php echo $lang['web_config_upload_pic_tips'];?></td>
            </tr>
            </tbody>
        </table>
        <a href="JavaScript:void(0);" onclick="$('#upload_adv_form').submit();" class="btn"><span><?php echo $lang['web_config_save'];?></span></a>
    </form>
</div>
<iframe style="display:none;" src="" name="upload_pic"></iframe>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.ajaxContent.pack.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/dialog/dialog.js" id="dialog_js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/common_select.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.mousewheel.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/js/waypoints.js"></script>
<script src="<?php echo RESOURCE_SITE_URL;?>/web_config/web_index_2.js"></script>