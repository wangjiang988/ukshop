<?php defined('InUk86') or exit('Access Invalid!');?>

<div class="wrap">
  <div class="tabmenu">
    <?php include uk86_template('layout/submenu');?>
  </div>
  <form id="voucher_list_form" method="get">
    <table class="ncm-search-table">
      <input type="hidden" id='act' name='act' value='member_free' />
      <input type="hidden" id='op' name='op' value='index' />
      <tr>
        <td>&nbsp;</td>
        <td class="w100 tr">
          <select name="select_detail_state">
            <option value="3" <?php if ($_GET['select_detail_state'] == '3'){echo 'selected=true';}?>> 状态 </option>
            <option value="0" <?php if ($_GET['select_detail_state'] == '0'){echo 'selected=true';}?>> 未使用 </option>
            <option value="1" <?php if ($_GET['select_detail_state'] == '1'){echo 'selected=true';}?>> 已使用 </option>
          </select></td>
        <td class="w70 tc"><label class="submit-border">
            <input type="submit" class="submit" value="<?php echo $lang['nc_search'];?>" />
          </label></td>
      </tr>
    </table>
  </form>
  <table class="ncm-default-table">
    <thead>
      <tr>
        <th class="w10"></th>
        <th class="w70"></th>
        <th class="tl">F码编码</th>
        <th class="w100">获去方式</th>
        <th class="w70"></th>
        <th class="w100">状态</th>
        <th class="w70"></th>
        <th class="w100">操作</th>
      </tr>
    </thead>
    <tbody>
      <?php  if (count($output['list'])>0) { ?>
      <?php foreach($output['list'] as $val) { ?>
      <tr class="bd-line">
        <td></td>
        <td></td>
        <!-- <td><div class="ncm-goods-thumb"><a href="javascript:void(0);"><img src="<?php echo $val['voucher_t_customimg'];?>" onMouseOver="toolTip('<img src=<?php echo $val['voucher_t_customimg'];?>>')" onMouseOut="toolTip()" /></a></div></td> -->
        <td class="tl"><dl class="goods-name">
            <dt><?php echo $val['free_code'];?></dt>
          </dl>
        </td>
        <td><?php echo $val['get_type'] ?></td>
        <td></td>	
        <td><?php echo $val['free_state']?'已用':'未用';?></td>
        <td></td>
        <td class="ncm-table-handle"><?php if ($val['free_state'] == '0'){?>
          <span><a href="<?php echo uk86_urlShop('goods', 'index', array('goods_id'=>$val['free_goods_id']));?>" class="btn-green" ><i class="icon-shopping-cart"></i><p>使用</p></a></span>
          <?php } elseif ($val['free_state'] == '1'){?>
          <a href="index.php?act=member_order&op=show_order&order_id=<?php echo $val['voucher_order_id'];?>"><?php echo $lang['voucher_voucher_vieworder'];?></a>
          <?php }?></td>
      </tr>
      <?php }?>
      <?php } else { ?>
      <tr>
        <td colspan="20" class="norecord"><div class="warning-option"><i>&nbsp;</i><span>你还没有F码哦!</span></div></td>
      </tr>
      <?php } ?>
    </tbody>
    <?php  if (count($output['list'])>0) { ?>
    <tfoot>
      <tr>
        <td colspan="20"><div class="pagination"><?php echo $output['show_page'];?></div></td>
      </tr>
    </tfoot>
    <?php }?>
    
  </table>
  </div>
