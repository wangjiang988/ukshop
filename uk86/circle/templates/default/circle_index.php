<?php defined('InUk86') or exit('Access Invalid!');?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta charset="utf-8" />
    <title>
        福圈
    </title>
    <meta name="description" content="<?php echo $output['seo_description']; ?>" />
    <meta name="keywords" content="<?php echo $output['seo_keywords']; ?>" />
    <meta name="author" content="dede58" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0"
        />
    <link href="<?php echo CIRCLE_TEMPLATES_URL;?>/css/style.css" rel="stylesheet" type="text/css" />
    <!--[if lt IE 9]>
    <script src="<?php echo CIRCLE_RESOURCE_SITE_URL;?>js/css3-mediaqueries.js">
    </script>
    <script src="<?php echo CIRCLE_RESOURCE_SITE_URL;?>js/html5_tag.js">
    </script>
    <![endif]-->
    <!--[if lte IE 6]>
    <SCRIPT src="<?php echo CIRCLE_RESOURCE_SITE_URL;?>js/iepng.js" type="text/javascript">
    </SCRIPT>
    <script>
        EvPNG.fix('div, ul, img, li, input,a,span,nav,article');
    </script>
    <![endif]-->
</head>

<body>
<!--顶部导航-->
<div class="headerall">
    <div class="headertop">
        <div class="top_logo">
        </div>
        <div class="top_navbg">
        </div>
        <div class="top_nav">
            <ul class="clearfix">
                <a href="<?php echo SHOP_SITE_URL;?>">
                    <li>
                        <i class="nav_i01">
                        </i>
                                <span>
                                    返回商城
                                </span>
                    </li>
                </a>
                <a href="#">
                    <li>
                        <i class="nav_i02">
                        </i>
                                <span>
                                    精彩活动
                                </span>
                    </li>
                </a>
                <a href="#">
                    <li>
                        <i class="nav_i03">
                        </i>
                                <span>
                                    苏趣杂谈
                                </span>
                    </li>
                </a>
                <a href="#">
                    <li>
                        <i class="nav_i04">
                        </i>
                                <span>
                                    好物分享
                                </span>
                    </li>
                </a>
                <a href="<?php echo CIRCLE_SITE_URL;?>/index.php?act=p_center">
                    <li>
                        <i class="nav_i05">
                        </i>
                                <span>
                                    我的福圈
                                </span>
                    </li>
                </a>
            </ul>
        </div>
        <div class="right_input">
            <div class="tleft_box">
                        <span>
                            话题搜索
                        </span>
                <i class="topr_i01">
                </i>
            </div>
            <div class="tright_box">
                <input class="" type="text" name="" value="" placeholder="" />
                <a>
                </a>
            </div>
        </div>
    </div>
</div>
<!--顶部结束-->
<!--轮播与标题-->
<div class="mian_box clearfix">
    <div class="mian_fq_al">
        <!-- <img src="<?php echo CIRCLE_TEMPLATES_URL;?>/images/banner.jpg" width="803" /> -->
        <div class="focus-banner flexslider">
          <ul class="slides">
            <?php if(!empty($output['loginpic']) && is_array($output['loginpic'])){?>
            <?php foreach($output['loginpic'] as $val){?>
            <li><a href="<?php if($val['url'] != ''){echo $val['url'];}else{echo 'javascript:void(0);';}?>" target="_blank"><img src="<?php echo UPLOAD_SITE_URL.'/'.ATTACH_CIRCLE.'/'.$val['pic'];?>"></a></li>
            <?php }?>
            <?php }?>
          </ul>
        </div>
    </div>
    <div class="mian_fq_ar">
        <div class="t01_top">
                    <span>
                        <a href="<?php echo CIRCLE_SITE_URL;?>/index.php?act=p_center">个人中心</a> | <a href="<?php echo SHOP_SITE_URL;?>/index.php?act=login&op=logout">退出</a>
                    </span>
            <i style="background:url(<?php  echo uk86_getMemberAvatarForID($_SESSION['member_id']);?>) no-repeat;background-size: cover">
            </i>
        </div>
        <div class="t01_mid">
            <ul>
                <li>
                    <a href="<?php echo CIRCLE_SITE_URL;?>/index.php?act=p_center&op=my_group">
                        <h2>
                            <?php echo $output['circle_counts']['circle_count'];?>
                        </h2>
                        <p>
                            我的圈子
                        </p>
                    </a>
                </li>
                <li class="line">
                </li>
                <li>
                    <a href="<?php echo CIRCLE_SITE_URL;?>/index.php?act=p_center">
                    <h2>
                        <?php echo $output['circle_counts']['theme_count'];?>
                    </h2>
                    <p>
                        我的话题
                    </p>
                    </a>
                </li>
                <li class="line">
                </li>
                <li>
                    <a href="<?php echo CIRCLE_SITE_URL;?>/index.php?act=p_center">    <!--没有我的回复页面，待修改-->
                        <h2>
                            <?php echo $output['circle_counts']['threply_count'];?>
                        </h2>
                        <p>
                            我的回复
                        </p>
                    </a>
                </li>
            </ul>
        </div>
        <div class="t01_bot">
            <a class="ui_btn" href="<?php echo CIRCLE_SITE_URL?>/index.php?act=index&op=add_group">
                创建圈子
            </a>
        </div>
    </div>
</div>

<!--轮播与标题结束-->
<!--官方活动-->
<div class="mian_box">
    <div class="mian_gf_box clearfix">
        <?php if(!empty($output['official_theme_list'])){$arr=array_splice($output['official_theme_list'],0,2)?>
            <?php foreach($arr as $key=>$official_theme){?>
                <?php if($key==0){?>
                    <div class="mian_gf_la">
                        <a href="<?php echo CIRCLE_SITE_URL;?>/index.php?act=theme&op=theme_detail&c_id=<?php echo $official_theme['circle_id'];?>&t_id=<?php echo $official_theme['theme_id'];?>"><img src="<?php echo uk86_themeImageUrl($official_theme['affix']['affix_filethumb']);?>" /></a>
                    </div>
                <?php }else if($key==1){?>
                    <div class="mian_gf_lb">
                        <a href="<?php echo CIRCLE_SITE_URL;?>/index.php?act=theme&op=theme_detail&c_id=<?php echo $official_theme['circle_id'];?>&t_id=<?php echo $official_theme['theme_id'];?>">
                            <div class="t02_top">
                                <img src="<?php echo uk86_themeImageUrl($official_theme['affix']['affix_filethumb']);?>" />
                            </div>
                            <div class="t02_mid">
                                <h2>
                                    <?php echo $official_theme['theme_name'];?>
                                </h2>
                                <p>
                                    <?php echo uk86_str_cut($official_theme['theme_content'],120);?>
                                </p>
                            </div>
                        </a>
                    </div>
                <?php }?>
            <?php }?>
        <?php }?>

        <?php if(!empty($output['official_theme_list'])){$arr2=array_splice($output['official_theme_list'],0,8)?>
        <div class="mian_gf_rc">
            <?php foreach($arr2 as $key=>$item){?>
                <span class="t02_box">
                       <a href="<?php echo CIRCLE_SITE_URL;?>/index.php?act=theme&op=theme_detail&c_id=<?php echo $item['circle_id'];?>&t_id=<?php echo $item['theme_id'];?>">
                           <img src="<?php echo uk86_themeImageUrl($item['affix']['affix_filethumb']);?>" />
                           <h2>
                               <?php echo uk86_str_cut($item['theme_name'],18);?>
                           </h2>
                           <p>
                               <?php echo uk86_str_cut($item['theme_content'],50);?>
                           </p>
                       </a>
                </span>
            <?php }?>
        </div>
        <?php }?>
    </div>
</div>
<!--官方活动结束-->
<!--推荐话题-->
<div class="mian_box">
    <div class="mian_box_top">
        <div class="mian_box_tit">
            <i class="mbox_t01">
            </i>
                    <span>
                        推荐话题
                    </span>
            <a>
                <em class="quan_ih">
                </em>
                换一批
            </a>
        </div>
    </div>
    <!--推荐话题-->
    <div class="mian_tj_box clearfix">
        <?php if(!empty($output['theme_list'])){ $i=0;?>
            <?php foreach($output['theme_list'] as $val){?>
                <a href="<?php echo CIRCLE_SITE_URL;?>/index.php?act=theme&op=theme_detail&c_id=<?php echo $val['circle_id'];?>&t_id=<?php echo $val['theme_id'];?>">
                <?php if($i==0){?>
                    <div class="mian_tj_list">
                <?php }else if($i%2==1){?>
                    <div class="mian_tj_list tj_left_a">
                <?php }else{?>
                    <div class="mian_tj_list tj_left_b">
                <?PHP }?>
                <img src="<?php echo $val['affix'];?>" />
                <h2>
                    <?php echo $val['theme_name'];?>
                </h2>
                </a>
                <p>
                    来自：<a href="<?php echo CIRCLE_SITE_URL;?>/index.php?act=group&c_id=<?php echo $val['circle_id'];?>"><?php echo $lang['circle_come_from'];?><?php echo $val['circle_name'];?></a>
                </p>
                </div>
                <?php if($i>=5)break;$i++;}?>
        <?php }?>
</div>
<!--推荐话题结束-->
<!--热门-->
<div class="mian_box ">
    <div class="mian_box_top clearfix">
        <div class="mian_box_tit mian_tit_a">
            <i class="mbox_t02">
            </i>
                    <span>
                        热门话题
                    </span>
            <a>
                更多 &gt;&gt;
            </a>
        </div>
        <div class="mian_box_tit mian_tit_b">
            <i class="mbox_t03">
            </i>
                    <span>
                        热门圈子
                    </span>
            <a>
                更多 &gt;&gt;
            </a>
        </div>
    </div>

    <div class="mian_rm_box clearfix">
        <?php if(!empty($output['hot_theme_list_with_img'])){$i=0;$k=0;?>
        <div class="mian_rm_l">
            <div class="tm_l_top  clearfix">
                <?php foreach($output['hot_theme_list_with_img'] as $item){?>
                    <?php if($i==0){?>
                        <div class="tm_l_left">
                            <a href="<?php echo CIRCLE_SITE_URL;?>/index.php?act=theme&op=theme_detail&c_id=<?php echo $item['circle_id'];?>&t_id=<?php echo $item['theme_id'];?>">
                            <a href="<?php echo CIRCLE_SITE_URL;?>/index.php?act=theme&op=theme_detail&c_id=<?php echo $item['circle_id'];?>&t_id=<?php echo $item['theme_id'];?>">
                                <img src="<?php echo $item['affix'];?>" />
                                <div class="tm_rm_div">
                                    <h2>
                                        <?php echo $item['theme_name'];?>
                                    </h2>
                                    <p>
                                        来自：<?php echo $item['circle_name'];?>
                                    </p>
                                </div>
                            </a>

                        </div>
                    <?php }?>
                <?php $i++;}?>
                <div class="tm_l_right">
                    <ul class="clearfix">
                        <?php foreach($output['hot_theme_list_with_img'] as $item){?>
                            <?php if($k!=0){?>
                                <li>
                                    <a href="<?php echo CIRCLE_SITE_URL;?>/index.php?act=theme&op=theme_detail&c_id=<?php echo $item['circle_id'];?>&t_id=<?php echo $item['theme_id'];?>">
                                         <img src="<?php echo $item['affix'];?>" />
                                    </a>
                               </li>
                            <?php }?>
                        <?php $k++;}?>
                    </ul>
                </div>
            </div>
            <div class="tm_l_bot  clearfix">

                <?php if(!empty($output['hot_theme_list_without_img'])){?>
                    <ul class="clearfix">
                        <?php foreach($output['hot_theme_list_without_img'] as $item){?>
                            <li>
                                <i>
                                </i>
                                <a href="<?php echo CIRCLE_SITE_URL;?>/index.php?act=theme&op=theme_detail&c_id=<?php echo $item['circle_id'];?>&t_id=<?php echo $item['theme_id'];?>"">
                                    【<?php echo $item['thclass_name'];?>】<?php echo $item['theme_name'];?>
                                </a>
                            </li>
                        <?php }?>
                    </ul>
                <?php }?>

            </div>
        </div>
    <?php }?>

        <?php if(!empty($output['circle_list'])){ $i=0;?>
            <div class="mian_rm_r">
                <?php foreach($output['circle_list'] as $key=>$item){?>
                    <?php if($i==0){?>
                        <div class="tm_r_list tm_r_none">
                            <a href="<?php echo CIRCLE_SITE_URL.DS.'index.php?act=group&c_id='.$item['circle_id'];?>">
                            <img src="<?php echo uk86_circleLogo($item['circle_id']);?>" />
                            <h2>
                                [<?php echo $item['theme_list']['thclass_name'];?>]<?php echo $item['theme_list']['theme_name'];?>
                            </h2>
                            <p>
                                <?php echo $item['circle_desc'];?>
                            <span>
                                来自：<?php echo $item['circle_name'];?>
                            </span>
                            </p>
                            </a>
                        </div>
                    <?php }else{?>
                        <div class="tm_r_list">
                            <a href="<?php echo CIRCLE_SITE_URL.DS.'index.php?act=group&c_id='.$item['circle_id'];?>">
                                <img src="<?php echo uk86_circleLogo($item['circle_id']);?>" />
                                <h2>
                                    [<?php echo $item['theme_list']['thclass_name'];?>]<?php echo $item['theme_list']['theme_name'];?>
                                </h2>
                                <p>
                                    <?php echo $item['circle_desc'];?>
                                    <span>
                                      来自：<?php echo $item['circle_name'];?>
                                   </span>
                                </p>
                            </a>
                        </div>
                    <?php }?>
                <?php $i++;}?>

            </div>
        <?php }?>

    </div>
</div>
<!--热门结束-->
<!--逛圈圈-->
<div class="mian_box">
    <div class="mian_box_top">
        <div class="mian_box_tit">
            <i class="mbox_t04">
            </i>
                    <span>
                        逛圈圈
                    </span>
            <a>
                <em class="quan_ih">
                </em>
                换一批
            </a>
        </div>
    </div>
    <div class="mian_qq_box clearfix">
        <div class="mian_qq_a">
            <div class="mian_qq_list">
                <img src="<?php echo CIRCLE_TEMPLATES_URL;?>/images/qq01.jpg" />
                <ul class="clearfix">
                    <li>
                        <a href="#">
                            1F : 佳能单反
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            2F : 佳能单反
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            3F : 玫瑰金
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            4F : 玫瑰金
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            5F : 27寸iMAC
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            6F : 27寸iMAC
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            7F : 无线路由器
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            8F : 无线路由器
                        </a>
                    </li>
                </ul>
            </div>
            <div class="mian_qq_list mian_qq_t01">
                <img src="<?php echo CIRCLE_TEMPLATES_URL;?>/images/qq05.jpg" />
                <ul class="clearfix">
                    <li>
                        <a href="#">
                            1F : 佳能单反
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            2F : 佳能单反
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            3F : 玫瑰金
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            4F : 玫瑰金
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            5F : 27寸iMAC
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            6F : 27寸iMAC
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            7F : 无线路由器
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            8F : 无线路由器
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="mian_qq_b">
            <div class="mian_qq_mid">
                <img src="<?php echo CIRCLE_TEMPLATES_URL;?>/images/qq02.jpg" />
                <ul class="clearfix">
                    <li>
                        <a href="#">
                            1F : 佳能单反
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            2F : 佳能单反
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            3F : 玫瑰金
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            4F : 玫瑰金
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            5F : 27寸iMAC
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            6F : 27寸iMAC
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            7F : 无线路由器
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            8F : 无线路由器
                        </a>
                    </li>
                </ul>
                <dl>
                    <dd>
                        <img src="<?php echo CIRCLE_TEMPLATES_URL;?>/images/gq01.jpg" />
                    </dd>
                    <dd class="m_to_left">
                        <img src="<?php echo CIRCLE_TEMPLATES_URL;?>/images/gq02.jpg" />
                    </dd>
                </dl>
            </div>
        </div>
        <div class="mian_qq_c">
            <div class="mian_qq_top">
                <div class="mian_qq_list">
                    <img src="<?php echo CIRCLE_TEMPLATES_URL;?>/images/qq03.jpg" />
                    <ul class="clearfix">
                        <li>
                            <a href="#">
                                1F : 佳能单反
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                2F : 佳能单反
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                3F : 玫瑰金
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                4F : 玫瑰金
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                5F : 27寸iMAC
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                6F : 27寸iMAC
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                7F : 无线路由器
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                8F : 无线路由器
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="mian_qq_list mian_qq_t02">
                    <img src="<?php echo CIRCLE_TEMPLATES_URL;?>/images/qq04.jpg" />
                    <ul class="clearfix">
                        <li>
                            <a href="#">
                                1F : 佳能单反
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                2F : 佳能单反
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                3F : 玫瑰金
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                4F : 玫瑰金
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                5F : 27寸iMAC
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                6F : 27寸iMAC
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                7F : 无线路由器
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                8F : 无线路由器
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="mian_qq_bot">
                <img src="<?php echo CIRCLE_TEMPLATES_URL;?>/images/qq06.jpg" />
                <div class="mian_qq_list">
                    <ul class="clearfix">
                        <li>
                            <a href="#">
                                1F : 佳能单反
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                2F : 佳能单反
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                3F : 玫瑰金
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                4F : 玫瑰金
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                5F : 27寸iMAC
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                6F : 27寸iMAC
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                7F : 无线路由器
                            </a>
                        </li>
                        <li>
                            <a href="#">
                                8F : 无线路由器
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="m_qq_img">
                    <img src="<?php echo CIRCLE_TEMPLATES_URL;?>/images/gq03.jpg" />
                </div>
            </div>
        </div>
    </div>
    <!--逛圈圈结束-->
    <!--好物分享-->
    <div class="mian_box">
        <div class="mian_box_top">
            <div class="mian_box_tit">
                <i class="mbox_t05">
                </i>
                        <span>
                            好物分享
                        </span>
                <a>
                    更多 &gt;&gt;
                </a>
            </div>
        </div>
        <div class="mian_fx_box clearfix">
            <div class="mian_fx_list">
                <img src="<?php echo CIRCLE_TEMPLATES_URL;?>/images/fx01.jpg" />
                <p>
                    良品铺子巴西松子
                </p>
            </div>
            <div class="mian_fx_list fx_left_a">
                <img src="<?php echo CIRCLE_TEMPLATES_URL;?>/images/fx02.jpg" />
                <p>
                    静品香薰精油套装无火香薰香藤条香薰
                </p>
            </div>
            <div class="mian_fx_list fx_left_b">
                <img src="<?php echo CIRCLE_TEMPLATES_URL;?>/images/fx03.jpg" />
                <p>
                    新疆 阿克苏红枣
                </p>
            </div>
            <div class="mian_fx_list fx_left_a">
                <img src="<?php echo CIRCLE_TEMPLATES_URL;?>/images/fx04.jpg" />
                <p>
                    原味松子（罐装）零食 休闲 食品
                </p>
            </div>
            <div class="mian_fx_list fx_left_b">
                <img src="<?php echo CIRCLE_TEMPLATES_URL;?>/images/fx01.jpg" />
                <p>
                    良品铺子巴西松子
                </p>
            </div>
            <div class="mian_fx_list fx_left_a">
                <img src="<?php echo CIRCLE_TEMPLATES_URL;?>/images/fx02.jpg" />
                <p>
                    静品香薰精油套装无火香薰香藤条香薰
                </p>
            </div>
            <div class="mian_fx_list fx_left_b">
                <img src="<?php echo CIRCLE_TEMPLATES_URL;?>/images/fx03.jpg" />
                <p>
                    新疆 阿克苏红枣
                </p>
            </div>
        </div>
    </div>
</div>
</div>
<!--好物分享结束-->
<!--底部 <div class="botall"> <img src="<?php echo CIRCLE_TEMPLATES_URL;?>/images/bot_b.jpg" /> </div>
-->
<div style="z-index:1; background:#fff;">
    <!--底部帮助中心 Start-->
    <div class="lmf_all_foot">
        <div class="lmf_all_foot_con">
                    <span id="HelpListButtom2">
                        <div class="floor_load">
                            <div id="help">
                                <ul class="jd_menu clearfix">
                                    <li class="mainmenu1">
                                        <dl>
                                            <dt>
                                            <div class="gtotop_title">
                                                特色服务
                                            </div>
                                            </dt>
                                            <dd>
                                                <a href="http://www.uk86.cn/HelpList/3949fcbf-1acb-4a4d-a534-028009197354.html"
                                                   target="_blank">
                                                    礼物赠送
                                                </a>
                                            </dd>
                                            <dd>
                                                <a href="http://www.uk86.cn/HelpList/6747acec-16aa-404c-b50a-1c71c76838c7.html"
                                                   target="_blank">
                                                    延保服务
                                                </a>
                                            </dd>
                                            <dd>
                                                <a href="http://www.uk86.cn/HelpList/10d64e84-4be2-4fb0-b9d8-73fb53201d4d.html"
                                                   target="_blank">
                                                    价格保护
                                                </a>
                                            </dd>
                                            <dd>
                                                <a href="http://www.uk86.cn/HelpList/ba54e47c-9931-4232-9acc-a3c4f7e1fd8a.html"
                                                   target="_blank">
                                                    商品拍卖
                                                </a>
                                            </dd>
                                        </dl>
                                    </li>
                                    <li class="mainmenu2">
                                        <dl>
                                            <dt>
                                            <div class="gtotop_title">
                                                售后服务
                                            </div>
                                            </dt>
                                            <dd>
                                                <a href="http://www.uk86.cn/HelpList/30d5bd2c-6cce-4590-a480-d942246ee554.html"
                                                   target="_blank">
                                                    延迟发货
                                                </a>
                                            </dd>
                                            <dd>
                                                <a href="http://www.uk86.cn/HelpList/8b69efb9-4e0f-4787-93c4-01fc26951c3f.html"
                                                   target="_blank">
                                                    上门维修
                                                </a>
                                            </dd>
                                            <dd>
                                                <a href="http://www.uk86.cn/HelpList/36655a65-3db0-4f04-a903-e37fceccb7a3.html"
                                                   target="_blank">
                                                    退货说明
                                                </a>
                                            </dd>
                                            <dd>
                                                <a href="http://www.uk86.cn/HelpList/f579713d-3a8e-4511-8133-9eba7502e252.html"
                                                   target="_blank">
                                                    保修换货
                                                </a>
                                            </dd>
                                            <dd>
                                                <a href="http://www.uk86.cn/HelpList/8301c423-69f6-4804-89a0-68d1e8dc5a4b.html"
                                                   target="_blank">
                                                    联系客服
                                                </a>
                                            </dd>
                                        </dl>
                                    </li>
                                    <li class="mainmenu3">
                                        <dl>
                                            <dt>
                                            <div class="gtotop_title">
                                                支付方式
                                            </div>
                                            </dt>
                                            <dd>
                                                <a href="http://www.uk86.cn/HelpList/8e798030-5e03-4108-81d8-2ddb8ee79433.html"
                                                   target="_blank">
                                                    网银支付
                                                </a>
                                            </dd>
                                            <dd>
                                                <a href="http://www.uk86.cn/HelpList/c80ce511-6ccd-4010-9574-17d3c0bc477e.html"
                                                   target="_blank">
                                                    银行转账
                                                </a>
                                            </dd>
                                            <dd>
                                                <a href="http://www.uk86.cn/HelpList/35cf16e8-b55a-4e02-b929-6214a892cf8e.html"
                                                   target="_blank">
                                                    公司转账
                                                </a>
                                            </dd>
                                            <dd>
                                                <a href="http://www.uk86.cn/HelpList/d6e0bc68-5bb2-4c70-954d-eeb6a9c90dd0.html"
                                                   target="_blank">
                                                    邮局汇款
                                                </a>
                                            </dd>
                                            <dd>
                                                <a href="http://www.uk86.cn/HelpList/5935c140-484d-4c32-b2c8-f1796929ca22.html"
                                                   target="_blank">
                                                    货到付款
                                                </a>
                                            </dd>
                                        </dl>
                                    </li>
                                    <li class="mainmenu4">
                                        <dl>
                                            <dt>
                                            <div class="gtotop_title">
                                                配送方式
                                            </div>
                                            </dt>
                                            <dd>
                                                <a href="http://www.uk86.cn/HelpList/4f65dec6-e9ab-447e-af28-54107b5fa046.html"
                                                   target="_blank">
                                                    申通快递
                                                </a>
                                            </dd>
                                            <dd>
                                                <a href="http://www.uk86.cn/HelpList/4b293e5d-3426-40d0-98ad-2a25067d4909.html"
                                                   target="_blank">
                                                    中铁快运
                                                </a>
                                            </dd>
                                            <dd>
                                                <a href="http://www.uk86.cn/HelpList/78dc26bb-4d89-428e-ac00-7e076d41d80d.html"
                                                   target="_blank">
                                                    特快专递(EMS)
                                                </a>
                                            </dd>
                                            <dd>
                                                <a href="http://www.uk86.cn/HelpList/33962a74-feeb-4621-a3c5-428da05be881.html"
                                                   target="_blank">
                                                    邮局普包
                                                </a>
                                            </dd>
                                            <dd>
                                                <a href="http://www.uk86.cn/HelpList/2ee6a1cb-0e24-47c2-b2fb-42eec42bc7a5.html"
                                                   target="_blank">
                                                    快递运输
                                                </a>
                                            </dd>
                                        </dl>
                                    </li>
                                    <li class="mainmenu5">
                                        <dl>
                                            <dt>
                                            <div class="gtotop_title">
                                                购物指南
                                            </div>
                                            </dt>
                                            <dd>
                                                <a href="http://www.uk86.cn/HelpList/627c500b-378d-42c7-b7a1-e8779db3bf8d.html"
                                                   target="_blank">
                                                    系统指引
                                                </a>
                                            </dd>
                                            <dd>
                                                <a href="http://www.uk86.cn/HelpList/75b176f9-edd8-4f7d-b0e6-45fa17ee7cae.html"
                                                   target="_blank">
                                                    积分方案
                                                </a>
                                            </dd>
                                            <dd>
                                                <a href="http://www.uk86.cn/HelpList/dc52ed6b-b9df-4ce2-afeb-40b8977fbe68.html"
                                                   target="_blank">
                                                    联系客服
                                                </a>
                                            </dd>
                                            <dd>
                                                <a href="http://www.uk86.cn/HelpList/55f12deb-fdab-4909-8d4a-e7d126a24c64.html"
                                                   target="_blank">
                                                    交易条款
                                                </a>
                                            </dd>
                                            <dd>
                                                <a href="http://www.uk86.cn/HelpList/7e649e0a-88b9-43e0-bb29-551a3fef3c37.html"
                                                   target="_blank">
                                                    购物流程
                                                </a>
                                            </dd>
                                        </dl>
                                    </li>
                                    <li class="mainmenu6">
                                        <dl>
                                            <dt>
                                            <div class="gtotop_title">
                                                关于我们
                                            </div>
                                            </dt>
                                            <dd>
                                                <a href="http://www.uk86.cn/HelpList/326267b3-354f-47c7-b3fe-196498cadeab.html"
                                                   target="_blank">
                                                    如何申请开店
                                                </a>
                                            </dd>
                                            <dd>
                                                <a href="http://www.uk86.cn/HelpList/9c7290cc-ebe0-477b-88e1-32bb76a75228.html"
                                                   target="_blank">
                                                    如何管理店铺
                                                </a>
                                            </dd>
                                            <dd>
                                                <a href="http://www.uk86.cn/HelpList/f41a2101-a258-4729-9123-654ec3bfaddb.html"
                                                   target="_blank">
                                                    查看售出商品
                                                </a>
                                            </dd>
                                            <dd>
                                                <a href="http://www.uk86.cn/HelpList/4062943f-b9e7-4e9b-8cc6-b6000e86100f.html"
                                                   target="_blank">
                                                    如何发货
                                                </a>
                                            </dd>
                                            <dd>
                                                <a href="http://www.uk86.cn/HelpList/6f94039b-62c2-4c6d-8391-909d06e0f88d.html"
                                                   target="_blank">
                                                    法律声明
                                                </a>
                                            </dd>
                                        </dl>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </span>
            <div class="lmf_all_foot_adimg" style="display:none;">
                <img src="Themes/Skin_Default/<?php echo CIRCLE_TEMPLATES_URL;?>/Images/bottm_10.jpg" />
            </div>
        </div>
    </div>
    <!--//底部帮助中心 End-->
    <div id="footer">
        <div class="copyright">
                    <span id="FootControl1_DomainCopyright">
                        <span id="FootControl1_DomainCopyright_ctl00_labelButtomInfo">
                            <p style="text-align:center;font-style:normal;text-indent:0px;font-family:Arial, Verdana;color:#999999;font-size:12px;font-weight:normal;">
                                <a href="http://www.u-com.cn/" target="_blank">
                                    优康集团
                                </a>
                                |
                                <a href="http://www.u-com.cn/xwyd.asp" target="_blank">
                                    人力资源
                                </a>
                                |
                                <a href="http://tx.u-com.cn/" target="_blank">
                                    优康通信
                                </a>
                                |
                                <span class="Apple-converted-space">
                                </span>
                                <a href="http://www.u-com.cn/lxwm.asp" target="_blank">
                                    联系我们
                                </a>
                                |
                                <a href="mailto:ucom@u-com.cn" target="_blank">
                                    投诉建议
                                </a>
                                |
                                <a href="http://www.ustp.cn/" target="_blank">
                                    优康科技园
                                </a>
                            </p>
                            <p style="text-align:center;font-style:normal;text-indent:0px;font-family:Arial, Verdana;color:#999999;font-size:12px;font-weight:normal;">
                                地址：苏州市高新区塔园路136号优康科技园3层&nbsp;
                            </p>
                            <p style="text-align:center;font-style:normal;text-indent:0px;font-family:Arial, Verdana;color:#999999;font-size:12px;font-weight:normal;">
                                推荐使用IE8.0浏览器(兼容所有浏览器) CopyRight 2006-2012
                            </p>

                        </span>
                    </span>
        </div>
    </div>
</div>
<!--//底部图片链接及版权信息 End-- </div>
<!--底部结束-->
</body>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.js" charset="utf-8"></script>
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jcarousel/jquery.jcarousel.min.js" charset="utf-8"></script> 
<!-- 引入幻灯片JS --> 
<script type="text/javascript" src="<?php echo RESOURCE_SITE_URL;?>/js/jquery.flexslider-min.js"></script> 

<script type="text/javascript">
    $(function(){
    // 绑定幻灯片事件 
      $('.flexslider').flexslider();
        //图片轮换
      $('#mycarousel1').jcarousel({visible: 8,itemFallbackDimension: 300});
    });
</script>
</html>