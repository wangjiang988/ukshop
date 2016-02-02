<link href="<?php echo CMS_TEMPLATES_URL;?>/css/news_style.css" rel="stylesheet" type="text/css">
<div class="news_top_all">
  <div class="news_top_box">
    <div class="zx_logo"></div>
    <div class="zx_nav clearfix">
      <ul>
        <li>
          <a class="one_list" href="<?php echo
          CMS_SITE_URL;?>"><span><?php echo $lang['cms_site_name'];?></span></a>
          <a><span class="h_i">资讯<i></i></span>
            <div class="nav_bg <?php echo $output['index_sign'] == 'article'?'nav_xz':''; ?>"></div></a>
          <a><span class="h_i">画布<i></i></span>
            <div class="nav_bg <?php echo $output['index_sign'] == 'picture'?'nav_xz':''; ?>"></div></a>
          <a><span>专题</span><div class="nav_bg"></div></a>
          <a><span>福圈</span><div class="nav_bg"></div></a>
          <a><span>品牌</span><div class="nav_bg"></div></a>
        </li>
      </ul>

      <div class="right_input">
        <input class="" type="text" name="" value="" placeholder="资讯  画报  商品">
        <a> </a>

      </div>

    </div>
  </div>
</div>