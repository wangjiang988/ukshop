<?php defined('InUk86') or exit('Access Invalid!');?>
<div class="eject_con">
  <div id="ms-warning"></div>
  <form id="addclass_form" action="<?php echo CIRCLE_SITE_URL;?>/index.php?act=manage&op=class_add&c_id=<?php echo $output['c_id'];?>" method="post" class="base-form-style">
    <input type="hidden" value="ok" name="form_submit">
    <dl>
      <dt><?php echo $lang['circle_tclass_name'].$lang['nc_colon'];?></dt>
      <dd>
        <!--<input type="text" name="name" class="w200 text"  />-->
          <select class="w200" style="height: 30px;" name="name">
              <?php foreach($output['allThclassList'] as $key=>$v){?>
                  <option value="<?php echo $v['thclass_name'];?>"><?php echo $v['thclass_name'];?></option>
              <?php }?>
          </select>
      </dd>
    </dl>
    <dl>
      <dt><?php echo $lang['circle_tclass_sort'].$lang['nc_colon'];?></dt>
      <dd>
        <input type="text" name="sort" class="w50 text" value="255" />
      </dd>
    </dl>
    <dl>
      <dt><?php echo $lang['circle_tclass_status'].$lang['nc_colon'];?></dt>
      <dd>
        <input type="radio" name="status" value="1" checked="checked" />
        <?php echo $lang['nc_yes'];?>&nbsp;
        <input type="radio" name="status" value="0" />
        <?php echo $lang['nc_no'];?> </dd>
    </dl>
    <dl class="bottom">
      <dt>&nbsp;</dt>
      <dd><a class="submit-btn" nctype="submit-btn" href="Javascript: void(0)"><?php echo $lang['nc_submit'];?></a></dd>
    </dl>
  </form>
</div>
<script type="text/javascript">
$(function(){
	$('a[nctype="submit-btn"]').click(function(){
		$('#addclass_form').submit();
	});
	
    $('#addclass_form').validate({
        errorLabelContainer: $('#ms-warning'),
        invalidHandler: function(form, validator) {
               $('#ms-warning').show();
        },
    	submitHandler:function(form){
    		ajaxpost('addclass_form', '<?php echo CIRCLE_SITE_URL;?>/index.php?act=manage&op=class_add&c_id=<?php echo $output['c_id'];?>', '', 'onerror');
    	},
        rules : {
            sort : {
                required : true,
                digits : true,
                max : 255
            }
        },
        messages : {
            sort  : {
                required : '<?php echo $lang['circle_tclass_sort_not_null'];?>',
                digits : '<?php echo $lang['circle_tclass_sort_is_digits'];?>',
                max : '<?php echo $lang['circle_tclass_sort_max'];?>'
            }
        }
    });
});
</script> 