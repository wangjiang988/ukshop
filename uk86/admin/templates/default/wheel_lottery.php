<?php defined('InUk86') or exit('Access Invalid!');?>
<div class="page">
	<div class="fixed-bar">
	    <div class="item-title">
			<h3><?php echo $lang['nc_wheel']?></h3>
			<ul class="tab-base">
		    	<li><a href="index.php?act=wheel&op=wheelList" ><span><?php echo $lang['nc_wheel_list'];?></span></a></li>
		    	<li><a class="current" ><span><?php echo $lang['lottery_list'];?></span></a></li>
			</ul>
	    </div>
    </div>
    <div class="fixed-empty"></div>
    <table class="tb-type1 noborder search">
      <tbody>
        <tr>
          <th><label for="searchtitle"><?php echo $lang['member_name']; ?></label></th>
          <form method="get" name="formSearch">
		    <input type="hidden" name="act" value="wheel">
		    <input type="hidden" name="op" value="lottery_list">
		    <input type="hidden" name='id' value='<?php echo $_GET['id'] ?>' />
	          <td><input type="text" name="searchtitle" id="searchtitle" value='<?php echo $_GET['searchtitle'];?>' class="txt" ></td>
	          <td><a  href="javascript:document.formSearch.submit();" class="btn-search" title="<?php echo $lang['nc_query']; ?>">&nbsp;</a></td>
          </form>
        </tr>
      </tbody>
    </table>
    <table class="table tb-type2 nomargin">
        <thead>
	         <tr class="space">
	             <th width='10%'><?php echo $lang['lottery_num']; ?></th>
	             <th width='15%'><?php echo $lang['member_name']; ?></th>
                 <th width='15%'><?php echo $lang['wheel_prize_name']; ?></th>
                 <th width='15%'><?php echo $lang['lottery_time']; ?></th>
                 <th width='10%'><?php echo $lang['nc_wheel_start']; ?></th>
                 <th width='15%'>操作</th>
		     </tr>
        </thead>
        <tbody>
        	<?php if(!empty($output['lottery_list']) && is_array($output['lottery_list'])){ ?>
        	<?php foreach ($output['lottery_list'] as $k => $v){ ?>
        	<tr class="thead">
        		<td align='left'><?php echo $k+1; ?></td>
        		<td align='left'><?php echo $v['member_name']; ?></td>
        		<td align='left'><?php echo $v['prize_name']; ?></td>
        		<td align='left'><?php echo date('Y-m-d H:i:s', $v['lottery_time']); ?></td>
        		<td align='left'><?php echo $v['status']?$lang['lottery_status_yes']:$lang['lottery_status_no'] ?></td>
        		<td align='left'><?php if($v['status'] == 0){ ?><a href="javascript:void(0);" onclick="lottery_status(<?php echo $v['lottery_id'] ?>)">发放奖品</a><?php } ?></td>
        	</tr>
        	<?php } ?>
        	<?php }else{ ?>
        	<tr class="no_data">
          		<td colspan="10"><?php echo $lang['nc_no_record'];?></td>
        	</tr>
        	<?php }?>
        </tbody>
        <tfoot>
        <?php if(!empty($output['lottery_list']) && is_array($output['lottery_list'])){ ?>
        <tr class="tfoot">
          <td colspan="16">
            <div class="pagination"> <?php echo $output['show_page'];?> </div></td>
        </tr>
        <?php } ?>
    </tfoot>
  	</table>
</div>
<script type="text/javascript">
function lottery_status(lottery_id){
	var result = confirm('确认发放奖品？');
	if(result){
		window.location.href = 'index.php?act=wheel&op=lottery_status&id='+lottery_id;
	}
}
</script>