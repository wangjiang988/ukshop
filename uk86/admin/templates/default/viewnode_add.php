<?php defined('InUk86') or exit('Access Invalid!');?>

<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3>锚点</h3>
      <ul class="tab-base">
        <li><a href="index.php?act=view&op=nodelist&view_detail_id=<?php echo $output['viewdetail_id'];?>&view_id=<?php echo $output['view_id'];?>"><span><?php echo $lang['nc_manage'];?></span></a></li>
        <li><a href="JavaScript:void(0);" class="current"><span><?php echo $lang['nc_new'];?></span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <form id="article_class_form" method="post">
    <input type="hidden" name="form_submit" value="ok" />
    <table class="table tb-type2">
      <tbody>
        <tr class="noborder">
          <td colspan="2" class="required"><label class="validation" for="ac_name"><?php echo $lang['view_index_title'];?>:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="" name="ac_name" id="ac_name" class="txt"></td>
          <td class="vatop tips"></td>
        </tr>
        
        <tr>
          <td colspan="2" class="required"><label for="ac_sort">锚点角度:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="" name="ac_sort" id="ac_sort" class="txt"></td>
          <td class="vatop tips">锚点指向角度</td>
        </tr>
		<tr>
          <td colspan="2" class="required"><label for="ac_h">锚点高度:</label></td>
        </tr>
        <tr class="noborder">
          <td class="vatop rowform"><input type="text" value="" name="ac_h" id="ac_h" class="txt"></td>
          <td class="vatop tips">锚点高度</td>
        </tr>
		<tr>
          <td colspan="2" class="required"><label for="linkscence">锚点对象:</label></td>
        </tr>
		<tr class="noborder">
          <td class="vatop rowform"><select name="linkscence" id="linkscence">
              <option value=""><?php echo $lang['nc_please_choose'];?>...</option>
              <?php if(!empty($output['parent_list']) && is_array($output['parent_list'])){ ?>
              <?php foreach($output['parent_list'] as $k => $v){ ?>
              <option value="<?php echo 'sence_'.$v['view_detail_sort'];?>"><?php echo 'sence_'.$v['view_detail_sort'];?></option>
              <?php } ?>
              <?php } ?>
            </select></td>
          <td class="vatop tips"></td>
        </tr>
      </tbody>
      <tfoot>
        <tr class="tfoot">
          <td colspan="15" ><a href="JavaScript:void(0);" class="btn" id="submitBtn"><span><?php echo $lang['nc_submit'];?></span></a></td>
        </tr>
      </tfoot>
    </table>
  </form>
</div>
<script>
//按钮先执行验证再提交表单
$(function(){$("#submitBtn").click(function(){
    if($("#article_class_form").valid()){
     $("#article_class_form").submit();
	}
	});
});
//
$(document).ready(function(){
	$('#article_class_form').validate({
        errorPlacement: function(error, element){
			error.appendTo(element.parent().parent().prev().find('td:first'));
        },
        rules : {
            ac_name : {
                required : true,
                remote   : {                
                url :'index.php?act=view&op=ajax&branch=check_node_name',
                type:'get',
                data:{
                    ac_name : function(){
                        return $('#ac_name').val();
                    },
					viewdetail_id:'<?php echo $output['viewdetail_id'];?>'
                  }
                }
            },
            ac_sort : {
                number   : true
            },
			ac_h : {
                number   : true
            }
        },
        messages : {
            ac_name : {
                required : '<?php echo $lang['view_add_name_null'];?>',
                remote   : '<?php echo $lang['view_add_name_exists'];?>'
            },
            ac_sort  : {
                number   : '<?php echo $lang['node_add_sort_int'];?>'
            },
			ac_h  : {
                number   : '<?php echo $lang['node_add_sort_int'];?>'
            }
        }
    });
});
</script>
