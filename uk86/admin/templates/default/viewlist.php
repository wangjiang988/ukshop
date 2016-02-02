<?php defined('InUk86') or exit('Access Invalid!');?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo $lang['view_list_title'];?></h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span><?php echo $lang['nc_manage'];?></span></a></li>
        <li><a href="index.php?act=view&op=view_add" ><span><?php echo $lang['nc_new'];?></span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="get" name="formSearch">
    <input type="hidden" value="view" name="act">
    <input type="hidden" value="viewlist" name="op">
    <table class="tb-type1 noborder search">
      <tbody>
        <tr>
          <th><label for="search_title"><?php echo $lang['view_index_title'];?></label></th>
          <td><input type="text" value="<?php echo $output['search_title'];?>" name="search_title" id="search_title" class="txt"></td>
          <th><label for="search_ac_id"><?php echo $lang['view_index_class'];?></label></th>
          <td><select name="search_ac_id" id="search_ac_id" class="">
              <option value="0"><?php echo $lang['nc_please_choose'];?>...</option>
             
                            <option <?php if($output['search_ac_id'] == 1){ ?>selected='selected'<?php } ?> value="1"><?php echo $lang['view_platform'];?></option>
			  <option <?php if($output['search_ac_id'] == 2){ ?>selected='selected'<?php } ?> value="2"><?php echo $lang['view_shop'];?></option>
              
            </select></td>
          <td><a href="javascript:document.formSearch.submit();" class="btn-search " title="<?php echo $lang['nc_query'];?>">&nbsp;</a>
            <?php if($output['search_title'] != '' or $output['search_ac_id'] != ''){?>
            <a href="index.php?act=view&op=viewlist" class="btns " title="<?php echo $lang['nc_cancel_search'];?>"><span><?php echo $lang['nc_cancel_search'];?></span></a>
            <?php }?></td>
        </tr>
      </tbody>
    </table>
  </form>
  <table class="table tb-type2" id="prompt">
    <tbody>
      <tr class="space odd">
        <th colspan="12"><div class="title">
            <h5><?php echo $lang['nc_prompts'];?></h5>
            <span class="arrow"></span></div></th>
      </tr>
      <tr>
        <td><ul>
            <li><?php echo $lang['view_list_help'];?></li>
          </ul></td>
      </tr>
    </tbody>
  </table>
  <form method="post" id="form_article">
    <input type="hidden" name="form_submit" value="ok" />
    <table class="table tb-type2">
      <thead>
        <tr class="thead">
          <th class="w24"></th>
          <th class="w48"><?php echo $lang['nc_sort'];?></th>
          <th><?php echo $lang['view_index_title'];?></th>
          <th><?php echo $lang['view_index_class'];?></th>
		  <th><?php echo $lang['view_index_state'];?></th>
          <th class="align-center"><?php echo $lang['view_index_creator'];?></th>
          <th class="align-center"><?php echo $lang['view_index_addtime'];?></th>
          <th class="w60 align-center"><?php echo $lang['nc_handle'];?></th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($output['view_list']) && is_array($output['view_list'])){ ?>
        <?php foreach($output['view_list'] as $k => $v){ ?>
        <tr class="hover">
          <td><input type="checkbox" name='del_id[]' value="<?php echo $v['view_id']; ?>" class="checkitem"></td>
          <td><?php echo $v['view_sort']; ?></td>
          <td><?php echo $v['view_title']; ?></td>
          <td><?php echo $v['view_class']; ?></td>
		  <td><?php if($v['view_state']){echo '已开通';}else { echo '未开通';} ?></td>
          <td class="align-center"><?php echo $v['view_creator']; ?></td>
          <td class="nowrap align-center"><?php echo $v['view_time']; ?></td>
          <td class="align-center"><a href="index.php?act=view&op=view_detail_list&view_id=<?php echo $v['view_id']; ?>"><?php echo $lang['nc_edit'];?></a></td>
        </tr>
        <?php } ?>
        <?php }else { ?>
        <tr class="no_data">
          <td colspan="10"><?php echo $lang['nc_no_record'];?></td>
        </tr>
        <?php } ?>
      </tbody>
      <tfoot>
        <?php if(!empty($output['view_list']) && is_array($output['view_list'])){ ?>
        <tr class="tfoot">
          <td><input type="checkbox" class="checkall" id="checkallBottom"></td>
          <td colspan="16"><label for="checkallBottom"><?php echo $lang['nc_select_all']; ?></label>
            &nbsp;&nbsp;<a href="JavaScript:void(0);" class="btn" onclick="if(confirm('<?php echo $lang['nc_ensure_del'];?>')){$('#form_article').submit();}"><span><?php echo $lang['nc_del'];?></span></a>
            <div class="pagination"> <?php echo $output['page'];?> </div></td>
        </tr>
        <?php } ?>
      </tfoot>
    </table>
  </form>
</div>
