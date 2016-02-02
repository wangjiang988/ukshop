<?php defined('InUk86') or exit('Access Invalid!');?>
<style type="text/css">
a:hover{text-decoration:none;}
</style>
<div class="tabmenu">
  <?php include uk86_template('layout/submenu');?>
</div>
<div class="tabmenu">
  <table class="ncsc-default-table">
	<thead>
      <tr>
      	<th style="width: 25px;"></th>
        <th class="tl">F码商品</th>
        <th class="w150">F码编码</th>
        <th class="w50"></th>
        <th class="w150">会员名称</th>
        <th class="w50"></th>
        <th class="w150">发放时间</th>
        <th class="w50"></th>
      </tr>
    </thead>
    <tbody>
      <?php if(!empty($output['fcode_info']) && is_array($output['fcode_info'])){ ?>
        <?php foreach ($output['fcode_info'] as $i => $value){ ?>
          <tr>
          	<th></th>
            <th><a href="<?php echo uk86_urlShop('goods', 'index' ,array('goods_id' => $value['free_goods_id'])); ?>"><img style="width: 34px; height:34px; border:1px solid #EEE;" src="<?php echo uk86_thumb($value, 60);?>"></a>&nbsp;&nbsp;<a href="<?php echo uk86_urlShop('goods', 'index' ,array('goods_id' => $value['free_goods_id'])); ?>"><?php echo $value['goods_name']; ?></a></th>
            <th style="text-align: center;"><?php echo $value['free_code']; ?></th>
            <th></th>
            <th style="text-align: center;"><?php echo $value['free_owner_name']; ?></th>
            <th></th>
            <th style="text-align: center;"><?php echo date('Y-m-d H:i:s', $value['free_grand_time']);?></th>
            <th></th>
          </tr>
        <?php } ?>
      <?php } ?>
    </tbody>
    <tfoot>
      <tr>
      	<th style="text-align: center;" colspan="20"><div class="pagination"> <?php echo $output['page']; ?> </div></th>
      </tr>
    </tfoot>
  </table>
</div>
