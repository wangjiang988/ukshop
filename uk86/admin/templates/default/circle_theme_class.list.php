<?php defined('InUk86') or exit('Access Invalid!');?>
<!--话题分类页面-->
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>圈子话题分类管理</h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span><?php echo $lang['nc_manage'];?></span></a></li>
        <li><a href="index.php?act=circle_theme&op=theme_class_add" ><span><?php echo $lang['nc_new'];?></span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="get" name="formSearch">
    <input type="hidden" name="act" value="circle_theme">
    <input type="hidden" name="op" value="theme_class_list">
    <table class="tb-type1 noborder search">
      <tbody>
        <tr>
          <th><label for="searchtitle">话题分类名称</label></th>
          <td><input type="text" name="searchname" id="searchname" class="txt" value='<?php echo $_GET['searchname'];?>'></td>
          <th><label>话题分类状态</label></th>
          <td><select name="searchstatus">
              <option value=""><?php echo $lang['nc_common_pselect'];?></option>
              <option value="1" <?php if ($_GET['searchstatus'] == '1'){echo 'selected=selected';}?>><?php echo $lang['nc_open'];?></option>
              <option value="0" <?php if ($_GET['searchstatus'] == '0'){echo 'selected=selected';}?>><?php echo $lang['nc_close'];?></option>
            </select>
          </td>
          <td><a href="javascript:document.formSearch.submit();" class="btn-search " title="<?php echo $lang['nc_query']; ?>">&nbsp;</a></td>
        </tr>
      </tbody>
    </table>
  </form>
   <table class="table tb-type2" id="prompt">
    <tbody>
      <tr class="space odd">
        <th class="nobg" colspan="12"><div class="title"><h5><?php echo $lang['nc_prompts'];?></h5><span class="arrow"></span></div></th>
      </tr>
      <tr>
        <td>
        <ul>
            <li>管理提供给用户的圈子话题分类</li>
            <li>用户选择的话题分类全部由这里给出</li>
          </ul></td>
      </tr>
    </tbody>
  </table>
  <form method='post' name="class_form" id="class_form">
    <input type="hidden" name="form_submit" value="ok" />
    <input type="hidden" name="submit_type" id="submit_type" value="" />
    <table class="table tb-type2">
      <thead>
        <tr class="thead">
          <th></th>
          <th><?php echo $lang['nc_sort'];?></th>
          <th>圈子话题分类名称</th>
          <th class="align-center"><?php echo $lang['nc_status'];?></th>
          <th><?php echo $lang['nc_handle'];?></th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($output['class_list']) && is_array($output['class_list'])){ ?>
        <?php foreach($output['class_list'] as $k => $v){ ?>
        <tr class="hover edit">
          <td class="w24"><input type="checkbox" name="check_class_id[]" value="<?php echo $v['thclass_id'];?>" class="checkitem"></td>
          <td class="w48 sort"><span title="<?php echo $lang['nc_editable'];?>" fieldid="<?php echo $v['thclass_id'];?>" ajax_branch="sort" datatype="number" fieldname="class_sort" nc_type="inline_edit" class="editable "><?php echo $v['class_sort'];?></span></td>
          <td class="w50pre name">
          <span title="<?php echo $lang['nc_editable'];?>" required="1" fieldid="<?php echo $v['thclass_id'];?>" ajax_branch="name" fieldname="thclass_name" nc_type="inline_edit" class="editable "><?php echo $v['thclass_name'];?></span>
          </td>
          <td class="align-center power-onoff"><?php if($v['thclass_status'] == 0){ ?>
            <a href="JavaScript:void(0);" class=" disabled" fieldvalue="0" fieldid="<?php echo $v['thclass_id'];?>" ajax_branch="status" fieldname="thclass_status" nc_type="inline_edit" title="<?php echo $lang['nc_editable'];?>"><img src="<?php echo ADMIN_TEMPLATES_URL;?>/images/transparent.gif"></a>
            <?php }else{ ?>
            <a href="JavaScript:void(0);" class=" enabled" fieldvalue="1" fieldid="<?php echo $v['thclass_id'];?>" ajax_branch="status" fieldname="thclass_status" nc_type="inline_edit" title="<?php echo $lang['nc_editable'];?>"><img src="<?php echo ADMIN_TEMPLATES_URL;?>/images/transparent.gif"></a>
            <?php } ?></td>
          <td class="w84"><a href="index.php?act=circle_theme&op=theme_class_edit&classid=<?php echo $v['thclass_id'];?>"><?php echo $lang['nc_edit'];?></a> | <a href="javascript:if(confirm('<?php echo $lang['nc_ensure_del'];?>'))window.location = 'index.php?act=circle_theme&op=class_del&thclassid=<?php echo $v['thclass_id'];?>';"><?php echo $lang['nc_del'];?></a></td>
        </tr>
        <?php } ?>
        <?php }else { ?>
        <tr class="no_data">
          <td colspan="10"><?php echo $lang['nc_no_record'];?></td>
        </tr>
        <?php } ?>
      </tbody>
      <?php if(!empty($output['class_list']) && is_array($output['class_list'])){ ?>
      <tfoot>
        <tr class="tfoot">
          <td><input type="checkbox" class="checkall" id="checkall_1"></td>
          <td id="batchAction" colspan="15"><span class="all_checkbox">
            <label for="checkall_2"><?php echo $lang['nc_select_all'];?></label>
            </span>&nbsp;&nbsp;<a href="JavaScript:void(0);" class="btn" onclick="if(confirm('<?php echo $lang['nc_ensure_del'];?>')){$('#submit_type').val('batchdel');$('#class_form').submit();}"><span><?php echo $lang['nc_del'];?></span></a>
            </td>
        </tr>
      </tfoot>
      <?php } ?>
    </table>
  </form>
</div>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.edit.js" charset="utf-8"></script>  
