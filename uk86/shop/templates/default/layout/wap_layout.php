<?php  defined('InUk86') or exit('Access Invalid!');  ?>
<?php if($tpl_file != BASE_PATH.'/templates/default/wap/index.php' && $tpl_file != BASE_PATH.'/templates/default/wap/goods_info.php'){ ?>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.js"></script>
<?php } ?>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/common.js"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL ?>/js/wap/dialog.js"></script>
<link rel="stylesheet" href="<?php echo SHOP_TEMPLATES_URL ?>/css/wap/dialog.css" type="text/css">
<?php require_once($tpl_file);?>
<?php require_once(uk86_template('layout/wap_layout_foot'));?>