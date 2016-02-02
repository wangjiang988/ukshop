<?php defined('InUk86') or exit('Access Invalid!');?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>锚点</h3>
      <ul class="tab-base">
        <li><a href="JavaScript:void(0);" class="current"><span><?php echo $lang['nc_manage'];?></span></a></li>
        <li><a href="index.php?act=view&op=node_add&viewdetail_id=<?php echo $output['viewdetail_id'];?>&view_id=<?php echo $output['view_id'];?>" ><span><?php echo $lang['nc_new'];?></span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form method="get" name="formSearch">
    <input type="hidden" value="view" name="act">
    <input type="hidden" value="viewlist" name="op">
   
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
          <th class="w48">场景</th>
          <th>角度</th>
          <th>高度</th>      
          <th class="w60 align-center"><?php echo $lang['nc_handle'];?></th>
        </tr>
      </thead>
      <tbody>
        <?php if(!empty($output['nodelist']) && is_array($output['nodelist'])){ $i=0?>
        <?php foreach($output['nodelist'] as $k => $v){ ?>
        <tr class="hover">
          <td><input type="checkbox" name='del_id[]' class="checkitem"></td>
		  <td><?php echo $v['linkscence']; ?></td>
          <td><?php echo $v['atv']; ?></td>
          <td><?php echo $v['ath']; ?></td>
          <td class="align-center"><a href="index.php?act=view&op=node_del&viewdetail_id=<?php echo $output['viewdetail_id']; ?>&nodenum=<?php echo $i;?>&view_id=<?php echo $output['view_id'];?>"><?php echo $lang['nc_del'];?></a></td>
        </tr>
        <?php $i++;} ?>
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
