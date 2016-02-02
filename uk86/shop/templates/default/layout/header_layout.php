/**
 * Created by PhpStorm.
 * User: dianxia
 * Date: 2016-01-12
 * Time: 23:28
 */
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>

    <title><?php echo $output['html_title'];?></title>
    <meta name="keywords" content="<?php echo $output['seo_keywords']; ?>" />
    <meta name="description" content="<?php echo $output['seo_description']; ?>" />
    <?php echo html_entity_decode($output['setting_config']['qq_appcode'],ENT_QUOTES); ?><?php echo html_entity_decode($output['setting_config']['sina_appcode'],ENT_QUOTES); ?><?php echo html_entity_decode($output['setting_config']['share_qqzone_appcode'],ENT_QUOTES); ?><?php echo html_entity_decode($output['setting_config']['share_sinaweibo_appcode'],ENT_QUOTES); ?>
    <style type="text/css">
        body {
            _behavior: url(<?php echo SHOP_TEMPLATES_URL;
?>/css/csshover.htc);
        }
    </style>
    <link rel="shortcut icon" href="<?php echo BASE_SITE_URL;?>/favicon.ico" />
    <link href="<?php echo SHOP_TEMPLATES_URL;?>/css/base.css" rel="stylesheet" type="text/css">
    <?php if($output['index_sign'] == 'index' && $output['index_sign'] != '0'){?><link href="<?php echo SHOP_TEMPLATES_URL;?>/css/home_header_index.css" rel="stylesheet" type="text/css">   <!--�������ҳ������ҳ�ض���ʽ-->
    <?php }else{?>
        <link href="<?php echo SHOP_TEMPLATES_URL;?>/css/home_header.css" rel="stylesheet" type="text/css">
    <?php }?>
    <link href="<?php echo SHOP_TEMPLATES_URL;?>/css/home_login.css" rel="stylesheet" type="text/css">
    <link href="<?php echo SHOP_RESOURCE_SITE_URL;?>/font/font-awesome/css/font-awesome.min.css" rel="stylesheet" />

    <!--[if IE 7]>
    <link rel="stylesheet" href="<?php echo SHOP_RESOURCE_SITE_URL;?>/font/font-awesome/css/font-awesome-ie7.min.css">
    <![endif]-->
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="<?php echo RESOURCE_SITE_URL;?>/js/html5shiv.js"></script>
    <script src="<?php echo RESOURCE_SITE_URL;?>/js/respond.min.js"></script>
    <![endif]-->
    <!--[if IE 6]>
    <script src="<?php echo RESOURCE_SITE_URL;?>/js/IE6_PNG.js"></script>
    <script>
        DD_belatedPNG.fix('.pngFix');
    </script>
    <script>
        // <![CDATA[
if((window.navigator.appName.toUpperCase().indexOf("MICROSOFT")>=0)&&(document.execCommand))
try{
document.execCommand("BackgroundImageCache", false, true);
   }
catch(e){}
// ]]>
</script>
<![endif]-->
    <script>
        var COOKIE_PRE = '<?php echo COOKIE_PRE;?>';var _CHARSET = '<?php echo strtolower(CHARSET);?>';var SITEURL = '<?php echo SHOP_SITE_URL;?>';var SHOP_SITE_URL = '<?php echo SHOP_SITE_URL;?>';var RESOURCE_SITE_URL = '<?php echo RESOURCE_SITE_URL;?>';var RESOURCE_SITE_URL = '<?php echo RESOURCE_SITE_URL;?>';var SHOP_TEMPLATES_URL = '<?php echo SHOP_TEMPLATES_URL;?>';
    </script>
    <script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.js"></script>
    <script src="<?php echo RESOURCE_SITE_URL;?>/js/common.js" charset="utf-8"></script>
    <script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-ui/jquery.ui.js"></script>
    <script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.validation.min.js"></script>
    <script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.masonry.js"></script>
    <script src="<?php echo RESOURCE_SITE_URL;?>/js/dialog/dialog.js" id="dialog_js" charset="utf-8"></script>
    <!--<script src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.lazyload.js"></script>-->

    <link href="<?php echo SHOP_TEMPLATES_URL ;?>/css/base_1.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo SHOP_TEMPLATES_URL ;?>/css/layout_index.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo SHOP_TEMPLATES_URL ;?>/css/home_index.css" rel="stylesheet" type="text/css" />

    <script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery-1.8.3.js"/></script>
    <script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.luara.0.0.1.min.js"/></script>
    <script type="text/javascript">
        $(function(){
            $('.part-05 .bd-04 ul li').hover(
                function(){
                    $(this).addClass("active");
                },
                function () {
                    $(this).removeClass("active");
                }

            );

            $('.dl-out').hover(
                function(){
                    $(this).addClass("active");
                },
                function () {
                    $(this).removeClass("active");
                }
            );
            $('.dl-out-second').hover(
                function(){
                    $(this).addClass("active");
                },
                function () {
                    $(this).removeClass("active");
                }
            );

            $('.sc-box').hover(
                function(){
                    $(this).addClass("active");
                },
                function () {
                    $(this).removeClass("active");
                }
            );

            $('.settleup').hover(
                function(){
                    $(this).addClass("settleup-active");
                },
                function () {
                    $(this).removeClass("settleup-active");
                }
            );
            $('.mylife').hover(
                function(){
                    $(this).addClass("mylife-active");
                },
                function () {
                    $(this).removeClass("mylife-active");
                }
            );

            $('.user-tx').click(function(){
                $('.user-login-box').show();
            })
            $('.close').click(function(){
                $('.user-login-box').hide();
            })
        });


    </script>


</head>

<body>

