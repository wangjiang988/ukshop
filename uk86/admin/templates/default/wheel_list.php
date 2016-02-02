<?php defined('InUk86') or exit('Access Invalid!'); ?>
<div class="page">
	<div class="fixed-bar">
		<div class="item-title">
		  <h3><?php echo $lang['nc_wheel']?></h3>
			<ul class="tab-base">
		    	<li><a class="current"><span><?php echo $lang['nc_wheel_list'];?></span></a></li>
		    	<li><a href = "index.php?act=wheel&op=index" ><span><?php echo $lang['nc_wheel_add'];?></span></a></li>
			</ul>
	    </div>
    </div>
    <div class="fixed-empty"></div>
    <table class="tb-type1 noborder search">
      <tbody>
        <tr>
          <th><label for="searchtitle"><?php echo $lang['nc_wheel_title']; ?></label></th>
          <form method="get" name="formSearch">
		    <input type="hidden" name="act" value="wheel">
		    <input type="hidden" name="op" value="wheelList">
	          <td><input type="text" name="searchtitle" id="searchtitle" value='<?php echo $_GET['searchtitle'];?>' class="txt" ></td>
	          <td><select name="searchstate">
	              <option value="-1"><?php echo $lang['wheel_status'] ?></option>
	              <option value="1" <?php if ($_GET['searchstate'] == 1){echo 'selected=selected';}?> ><?php echo $lang['wheel_status_open'] ?></option>
	              <option value="0" <?php if ($_GET['searchstate'] == 0 && $_GET['searchstate'] != ''){echo 'selected=selected';}?> ><?php echo $lang['wheel_status_close'] ?></option>
	            </select>
	          </td>
	          <td><a  href="javascript:document.formSearch.submit();" class="btn-search" title="<?php echo $lang['nc_query']; ?>">&nbsp;</a></td>
          </form>
        </tr>
      </tbody>
    </table>
    <table class="table tb-type2" id="prompt">
    <tbody>
      <tr class="space odd">
        <th class="nobg" colspan="12"><div class="title">
            <h5><?php echo $lang['nc_prompts'];?></h5>
            <span class="arrow"></span></div></th>
      </tr>
      <tr>
        <td><ul>
            <li><?php echo $lang['wheel_list_help'];?></li>
            <li><?php echo $lang['wheel_list_help1'];?></li>
          </ul></td>
      </tr>
    </tbody>
  </table>
  <form id="listform" action="index.php?act=wheel&op=wheel_del" method='post'>
  <table class="table tb-type2">
      <thead>
        <tr class="thead">
          <th class="w24">&nbsp;</th>
          <th class="w48 "><?php echo $lang['lottery_num'];?></th>
          <th class="w96"><?php echo $lang['nc_wheel_title'];?></th>
          <th class="align-center"><?php echo $lang['wheel_start_time'];?></th>
          <th class="align-center"><?php echo $lang['wheel_end_time'];?></th>
          <th class="align-center"><?php echo $lang['wheel_sort'];?></th>
          <th class="align-center w96"><?php echo $lang['nc_wheel_start'];?></th>
          <th class="align-center"><?php echo $lang['wheel_add_time'];?></th>
          <th class="align-center"><?php echo $lang['wheel_update_time'];?></th>
          <th class="w150 align-center"><?php echo $lang['nc_handle'];?></th>
        </tr>
      </thead>
   	  <tbody id="treet1">
   	  <?php  if(!empty($output['list']) && is_array($output['list'])){ ?>
   	    <?php foreach ($output['list'] as $k => $v){ ?>
   		<tr class="hover edit row noborder">
   			<td><input type="checkbox" name='wheel_id[]' value="<?php echo $v['wheel_id'];?>" class="checkitem"></td>
   			<td><?php echo $k+1 ?></td>
   			<td><?php echo $v['wheel_title'] ?></td>
   			<td class="align-center"><?php echo date('Y-m-d H:s',$v['wheel_start_time']) ?></td>
   			<td class="align-center"><?php echo date('Y-m-d H:s',$v['wheel_end_time']) ?></td>
   			<td class='align-center'> <input type="text" value='<?php echo $v['sort'] ?>' class='w48 set-sort' title='<?php echo $v['wheel_id'] ?>'/> </td>
   			<td class='align-center'><?php echo $v['wheel_isuse'] == 1 ? $lang['wheel_status_open'] : $lang['wheel_status_close'] ?></td>
   			<td class="align-center"><?php echo date('Y-m-d H:s',$v['wheel_add_time']) ?></td>
   			<td class="align-center"><?php echo date('Y-m-d H:s',$v['last_updata_time']?$v['last_updata_time']:$v['wheel_add_time']) ?></td>
   			<td class="align-center">
   				<a href='index.php?act=wheel&op=index&id=<?php echo $v['wheel_id'] ?>'><?php echo $lang['wheel_setting'] ?></a> |
   				<a href='index.php?act=wheel&op=lottery_list&id=<?php echo $v['wheel_id'] ?>'><?php echo $lang['lottery_list'] ?></a>	
   			</td>
   		</tr>
   		<?php } ?>
   	  <?php }else{ ?>
   	  	<tr class="no_data">
          <td colspan="10"><?php echo $lang['nc_no_record'];?></td>
        </tr>
      <?php } ?>
     </tbody>
     <tfoot>
        <?php if(!empty($output['list']) && is_array($output['list'])){ ?>
        <tr class="tfoot">
          <td><input type="checkbox" class="checkall" id="checkallBottom" name="chkVal"></td>
          <td colspan="16"><label for="checkallBottom"><?php echo $lang['nc_select_all']; ?></label>
            &nbsp;&nbsp;<a href="JavaScript:void(0);" class="btn" onclick="submit_form('del');"><span><?php echo $lang['nc_del'];?></span></a>
            <div class="pagination"> <?php echo $output['show_page'];?> </div></td>
        </tr>
        <?php } ?>
    </tfoot>
    </table>
    </form>
</div>
<script type="text/javascript">
$(function(){
	$('.set-sort').change(function(){
		var id = $(this).attr('title');
		var sort = $(this).val();
		$.post('index.php?act=wheel&op=set_sort',{wheel_id:id, sort:sort},function(msg){
			if(msg){
				window.location.href = 'index.php?act=wheel&op=wheelList';	
			}
		});
	});
});
function submit_form(op){
	if(op=='del'){
		if(!confirm('<?php echo $lang['wheel_del_warming'].$lang['nc_ensure_del'];?>')){
			return false;
		}
	}
	//$('#listop').val(op);
	$('#listform').submit();
}
</script>