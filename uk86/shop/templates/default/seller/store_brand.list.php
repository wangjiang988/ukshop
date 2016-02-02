<?php defined('InUk86') or exit('Access Invalid!');?>

<div class="tabmenu">
  <?php include uk86_template('layout/submenu');?>
  <?php if(isset($output['cant_apply']) && $output['cant_apply'] != true ){?><a href="javascript:void(0)" class="ncsc-btn ncsc-btn-green" nc_type="dialog" dialog_title="<?php echo $lang['store_goods_brand_apply'];?>" dialog_id="my_goods_brand_apply" dialog_width="480" uri="index.php?act=store_brand&op=brand_add"><?php echo $lang['store_goods_brand_apply'];?></a></div><?php }?>
<table class="search-form">
  <form method="get">
    <input type="hidden" name="act" value="store_brand">
    <input type="hidden" name="op" value="brand_list">
    <tr>
      <!--<td>&nbsp;</td>
      <th><?php echo $lang['store_goods_brand_name'];?></th>
      <td class="w160"><input type="text" class="text" name="brand_name" value="<?php echo $_GET['brand_name']; ?>"/></td>
      <td class="w70 tc"><label class="submit-border"><input type="submit" class="submit" value="<?php echo $lang['nc_search'];?>" /></label></td>-->
    </tr>
  </form>
</table>
<table class="ncsc-default-table">
  <thead>
    <tr>
      <th class="w150"><?php echo $lang['store_goods_brand_icon'];?></th>
      <th><?php echo $lang['store_goods_brand_name'];?></th>
      <th><?php echo $lang['store_goods_brand_belong_class'];?></th>
      <th>支付状态</th>
      <!--<th>品牌状态</th>-->
      <th class="w200"><?php echo $lang['nc_handle'];?></th>
    </tr>
  </thead>
  <tbody>
    <?php if (!empty($output['brand_list'])) { ?>
    <?php foreach($output['brand_list'] as $val) { ?>
    <tr class="bd-line">
      <td><img src="<?php echo uk86_brandImage($val['brand_pic']);?>" onload="javascript:DrawImage(this,88,44);" /></td>
      <td><?php echo $val['brand_name']; ?></td>
      <td><?php echo $val['brand_class']; ?></td>
      <!--<td><?php if($val['is_pay']){ echo '已支付:￥'.$val['order_info']['order_amount']; }else{ echo "未支付";} ?></td>-->
      	<td><?php if($val['is_pay']){ echo '已支付'; }else{ echo "未支付";} ?></td>
      <td class="nscs-table-handle">
      	<?php if($val['brand_apply'] == 0 ){?>
      		  <span><a href="javascript:void(0)" class="btn-blue"><i class="icon-lock"></i><p>等待审核</p></a></span>
      	<?php }else{?>	
		      	<!--<span><a href="javascript:void(0)" class="btn-blue" nc_type="dialog" dialog_title="<?php echo $lang['store_goods_brand_edit'];?>" dialog_id="my_goods_brand_edit" dialog_width="480" uri="index.php?act=store_brand&op=brand_add&brand_id=<?php echo $val['brand_id']; ?>"><i class="icon-edit"></i><p><?php echo $lang['nc_edit'];?></p></a></span>-->
		      	<!--<?php if ($val['is_pay'] == 0) { ?>
		          <span><a href="javascript:void(0)" class="btn-red" onclick="ajax_get_confirm('<?php echo $lang['nc_ensure_del'];?>', 'index.php?act=store_brand&op=drop_brand&brand_id=<?php echo $val['brand_id']; ?>');"><i class="icon-trash"></i><p><?php echo $lang['nc_del'];?></p></a></span>
		        <?php } ?>-->
		        <?php if ($val['is_pay'] == 0) { ?>
		          <span><a href="index.php?act=store_brand&op=pay&brand_id=<?php echo $val['brand_id']; ?>" class="btn-blue"><i class="icon-arrow-right"></i><p>去付款</p></a></span>
		        <?php } ?>
        
        	
        <?php }?>
      </td>
    </tr>
    <?php } ?>
    <?php } else { ?>
    <tr>
      <td colspan="20" class="norecord"><div class="warning-option"><i class="icon-warning-sign"></i><span><?php echo $lang['no_record'];?></span></div></td>
    </tr>
    <?php } ?>
  </tbody>
  <tfoot>
    <!--<?php if (!empty($output['brand_list'])) { ?>
    <tr>
      <td colspan="20"><div class="pagination"><?php echo $output['show_page']; ?></div></td>
    </tr>
    <?php } ?>-->
  </tfoot>
</table>
