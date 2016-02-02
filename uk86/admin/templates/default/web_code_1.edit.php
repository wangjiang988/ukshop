<?php defined('InUk86') or exit('Access Invalid!');?>
<link href="<?php echo ADMIN_TEMPLATES_URL;?>/css/font/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
<!--[if IE 7]>
  <link rel="stylesheet" href="<?php echo ADMIN_TEMPLATES_URL;?>/css/font/font-awesome/css/font-awesome-ie7.min.css">
<![endif]-->
<style type="text/css">
h3.dialog_head {
	margin: 0 !important;
}
.dialog_content {
	width: 610px;
	padding: 0 15px 15px 15px !important;
	overflow: hidden;
}
</style>

<script type="text/javascript">
var SHOP_SITE_URL = "<?php echo SHOP_SITE_URL; ?>";
var UPLOAD_SITE_URL = "<?php echo UPLOAD_SITE_URL; ?>";
</script>
<div class="page">
  <div class="fixed-bar">
    <div class="item-title">
      <h3><?php echo $lang['web_config_index'];?></h3>
      <ul class="tab-base">
        <li><a href="index.php?act=web_config&op=web_config"><span><?php echo '板块区';?></span></a></li>
        <li><a href="index.php?act=web_config&op=web_edit&web_id=<?php echo $_GET['web_id'];?>"><span><?php echo $lang['web_config_web_edit'];?></span></a></li>
        <li><a href="JavaScript:void(0);" class="current"><span><?php echo $lang['web_config_code_edit'];?></span></a></li>
      </ul>
    </div>
  </div>
  <div class="fixed-empty"></div>
  <table class="tb-type1 noborder">   <!--面包屑-->
    <tbody>
      <tr>
        <th><label><?php echo $lang['web_config_web_name'];?>:</label></th>
        <td><label><?php echo $output['web_array']['web_name']?></label></td>
        <th><label><?php echo $lang['web_config_style_name'];?>:</label></th>
        <td><label><?php echo $output['style_array'][$output['web_array']['style_name']];?></label></td>
      </tr>
    </tbody>
  </table>
  <br/>
  <label>板块样式选择</label>
  <select id="selectStyle">
    <option value="0" >默认样式</option>
    <option value="1" <?php if($_GET['style']==1)echo "selected";?>>样式1</option>
    <option value="2" <?php if($_GET['style']==2)echo "selected";?>>样式2</option>
    <option value="3" <?php if($_GET['style']==3)echo "selected";?>>样式3</option>
  </select>
  <table class="table tb-type2" id="prompt">   <!--提示帮助-->
    <tbody>
      <tr class="space odd">
        <th colspan="12"><div class="title"><h5><?php echo $lang['nc_prompts'];?></h5><span class="arrow"></span></div></th>
      </tr>
      <tr>
        <td>
        <ul>
            <li><?php echo $lang['web_config_edit_help1'];?></li>
            <li><?php echo $lang['web_config_edit_help2'];?></li>
            <li><?php echo $lang['web_config_edit_help3'];?></li>
          </ul></td>
      </tr>
    </tbody>
  </table>

</div>
<?php if(isset($_GET['style'])&&$_GET['style']!=0){
  include uk86_template("layout/index_floor_".$_GET['style']);     //
}else{
  include  uk86_template("layout/index_floor_default");           //加载默认模板
}
?>
<script>
   $(function(){
      $("#selectStyle").change(function(){
        var p1=$(this).children('option:selected').val();//这就是selected的值
        window.location.href="<?php echo ADMIN_SITE_URL;?>"+"/index.php?act=web_config&op=code_edit&style="+p1+"&web_id="+"<?php echo $_GET['web_id'];?>";
       });
   });
</script>
