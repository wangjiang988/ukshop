<?php defined('InUk86') or exit('Access Invalid!');?>
<link href="<?php echo ADMIN_TEMPLATES_URL;?>/css/font/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
<!--[if IE 7]>
  <link rel="stylesheet" href="<?php echo ADMIN_TEMPLATES_URL;?>/css/font/font-awesome/css/font-awesome-ie7.min.css">
<![endif]-->
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>开通服务类商品城市</h3>
      <ul class="tab-base">
        <li><a class="current"><span>城市列表</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form id="area_form" method="post" action="index.php?act=servicegoods_area&op=update_goods_area">
    <input type="hidden" name="form_submit" value="ok" />
    <input type="hidden" name="act" value="servicegoods_area" />
    <input type="hidden" name="op" value="update_goods_area" />
    <input type="hidden" name="county" id="county" value="" />
    <table class="table tb-type2" id="prompt">
      <tbody>
        <tr class="space odd">
          <th colspan="12"><div class="title">
              <h5><?php echo $lang['nc_prompts'];?></h5>
              <span class="arrow"></span></div></th>
        </tr>
        <tr>
          <td><ul>
              <li>只有在此处选中的城市，才会在本地化中显示服务类商品</li>
              <li>选择完城市后，系统并未保存，需要点击页面底部的保存按钮系统才会保存设置的地区</li>
            </ul></td>
        </tr>
        <tr class="space odd">
            <th colspan="12"><div class="title">
                    <h5>当前已经开通的城市</h5>
                    <span class="arrow"></span></div></th>
        </tr>
        <tr>
            <td>
                    <?php foreach($output['service_city_array'] as $k=>$vo){?>
                        <label style="margin-right: 30px;font-size:14px;font-weight: bold"><?php echo $vo['area_name'];?></label>
                    <?php }?>
            </td>
        </tr>
      </tbody>
    </table>
      <br/>
    <table id="table_area_box" class="table tb-type2">
      <thead>
        <tr class="thead">
          <th class="w10"></th>
          <th class="w120">省</th>
          <th>市</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($output['province_array'] as $pid => $pinfo) {?>
        <tr>
          <td></td>
          <td><label>
              <input type="checkbox"  value="<?php echo $pinfo['area_id'];?>" name="province[]">
              <strong><?php echo $pinfo['area_name']?></strong></label></td>
          <td><?php if (is_array($pinfo['child'])) {?>
            <?php foreach($pinfo['child'] as $city_id => $city) {?>
            <div class="area-list">
              <label>
                <input <?php if ($city['area_service']) echo 'checked';?> type="checkbox" nc_province="<?php echo $pinfo['area_id'];?>" value="<?php echo $city['area_id'];?>" name="city[]">
                <?php echo $city['area_name'];?> </label>
           </div>
            <?php }?></td>
        </tr>
        <?php }?>
        <?php }?>
      </tbody>
      <tfoot>
        <tr class="tfoot">
          <td colspan="15"><a href="JavaScript:void(0);" class="btn" id="submitBtn"><span><?php echo $lang['nc_submit'];?></span></a></td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/area_array.js" charset="utf-8"></script> 
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/dialog/dialog.js" id="dialog_js" charset="utf-8"></script> 
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script> 
<script type="text/javascript">
$(function(){

	//省点击事件
    $('input[name="province[]"]').on('click',function(){
        if ($(this).attr('checked') == 'checked'){
        	$('input[nc_province="' + $(this).val() + '"]').each(function(){
            	$(this).attr('checked','checked');      //全部选中
       		   $('span[city_id="'+$(this).val()+'"]').html(count);
        	});
        }else{
        	$('input[nc_province="' + $(this).val() + '"]').each(function(){
            	$(this).attr('checked',false);           //全部不选中
        		$('span[city_id="'+$(this).val()+'"]').html(0);
        	});
        }
    });

    //表单提交事件
	$("#submitBtn").click(function(){
        $("#area_form").submit();
	});
});
</script>