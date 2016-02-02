<?php defined('InUk86') or exit('Access Invalid!');?>
<style type="text/css">
tbody td{text-align:center;}
</style>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo $lang['member_index_manage']?></h3>
      <ul class="tab-base">
        <li><a href="index.php?act=notice&op=notice"><span><?php echo $lang['notice_index_send'];?></span></a></li>
        <li><a href="JavaScript:void(0);" class="current"><span>通知列表</span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  
  <table class="table tb-type2" id="prompt">
    <tbody>
      <tr class="space odd">
        <th colspan="12"><div class="title">
            <h5><?php echo $lang['nc_prompts'];?></h5>
            <span class="arrow"></span></div></th>
      </tr>
      <tr>
        <td><ul>
            <li>对于全部会员通知可以修改发送状态</li>
          </ul></td>
      </tr>
    </tbody>
  </table>
  <form method="post" id="form_member">
    <input type="hidden" name="form_submit" value="ok" />
    <table class="table tb-type2 nobdb">
      <thead>
        <tr class="thead">
          <th style="width: 10px">&nbsp;</th>

          <th class="align-center" style="width: 50px">序号</th>
          <th class="align-center">通知类型</th>
          <th class="align-center">通知内容</th>
          <th class="align-center">通知时间</th>
          <th class="align-center">发送状态</th>
          <th class="align-center">操作</th>
        </tr>
      <tbody>
        <?php if(!empty($output['message']) && is_array($output['message'])){ ?>
	      <?php foreach ($output['message'] as $key => $val){ ?>
	        <tr>
	          <td></td>
	          <td><?php echo $key; ?></td>
	          <td title="<?php echo $val['member_names']; ?>"><?php echo ($val['to_member_id'] == 'all')?'发送给所有会员':'发送给指定会员'; ?></td>
	          <td title="<?php echo $val['message_body']; ?>"><?php echo $val['message_body']; ?></td>
	          <td><?php echo date('Y-m-d H:i:s', $val['message_time']); ?></td>
	          <td class="yes-onoff"><a class="<?php if($val['message_state'] == 0){echo 'enabled';}else{echo 'disabled';} ?>" nctype="<?php echo $val['message_id']; ?>"></a></td>
	          <td><a href="javascript:del_message(<?php echo $val['message_id']; ?>);">删除</a></td>
	        </tr>
	      <?php } ?>
        <?php }else { ?>
        <tr class="no_data">
          <td colspan="11"><?php echo $lang['nc_no_record']?></td>
        </tr>
        <?php } ?>
      </tbody>
      <tfoot class="tfoot">
        <?php if(!empty($output['message']) && is_array($output['message'])){ ?>
        <tr>
        <td class="w24"></td>
          <td colspan="16">
         <div class="pagination"> <?php echo $output['page'];?> </div></td>
        </tr>
        <?php } ?>
      </tfoot>
    </table>
  </form>
</div>
<script>
$(function(){
    $('#ncsubmit').click(function(){
    	$('input[name="op"]').val('member');$('#formSearch').submit();
    });	
    $('.yes-onoff a').click(function(){
        var id = $(this).attr('nctype');
        if($(this).hasClass('enabled')){
            var state = 1;
        }else{
            var state = 0;
        }
        $.post('index.php?act=notice&op=change_state', {state:state, id:id}, function(msg){
			if(msg > 0){
	            if(state == 1){
                    $('a[nctype="'+id+'"]').removeClass('enabled');
                    $('a[nctype="'+id+'"]').addClass('disabled');
	            }else{
	            	$('a[nctype="'+id+'"]').removeClass('disabled');
                    $('a[nctype="'+id+'"]').addClass('enabled');
	            }
			}
        });
    });
});
function del_message(id){
	if(!id){return false};
	if(confirm('确认删除？')){
		window.location.href="index.php?act=notice&op=del_message&id="+id;
	}
}
</script>
