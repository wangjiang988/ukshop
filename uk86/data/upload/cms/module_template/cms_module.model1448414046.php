<div class="cms-page-module-frame module-style-<?php echo $value['module_style']?>">
<div class="cms-module-frame">
        <div class="cms-module-frame-title">
        <!-- 标题 -->
<div class="cms-module-title">
    <h2 id="cms_module_title" nctype="object_module_edit"><?php echo $module_content['cms_module_title'];?></h2>
    <?php if($output['edit_flag']) { ?>    <div class="cms-index-module-handle"><a nctype="btn_module_title_edit" href="JavaScript:void(0);" class="tip-r" title="编辑标题">编辑标题</a></div>
    <?php } ?></div>

    </div>
                    <div nctype="cms_module_content" class="cms-module-frame-w2">
                        <!-- 图片 -->
<div class="cms-module-assembly-image">
    <div class="content-box">
        <ul id="block1_image" nctype="object_module_edit">
            <?php echo html_entity_decode($module_content['block1_image']);?>        </ul>
        <?php if($output['edit_flag']) { ?>        <div class="cms-index-module-handle"><a nctype="btn_module_image_edit" image_count="1" href="JavaScript:void(0);" class="tip-l" data-title="请上传宽度380像素、高度210像素的图片，过大或过小的图像都将影响显示效果正常。" title="请上传宽度380像素、高度210像素的图片，过大或过小的图像都将影响显示效果正常。">编辑图片</a></div>
        <?php } ?>    </div>
</div>
            </div>
                <div nctype="cms_module_content" class="cms-module-frame-w1">
                        <!-- 文章　-->
<div class="cms-module-assembly-article">
    <div class="title-bar">
        <h3 id="block2_article_title" nctype="object_module_edit"><?php echo $module_content['block2_article_title'];?></h3>
        <?php if($output['edit_flag']) {?>        <div class="cms-index-module-handle"><a nctype="btn_module_title_edit" href="JavaScript:void(0);" class="tip-r" title="编辑标题">编辑标题</a></div>
        <?php } ?>    </div>
    <div class="content-box">
        <ul id="block2_article_content" nctype="object_module_edit">
            <?php echo html_entity_decode($module_content['block2_article_content']);?>        </ul>
        <?php if($output['edit_flag']) { ?>        <div class="cms-index-module-handle"><a nctype="btn_module_article_edit" save_function="article_type_5_save" limit_count="0" href="JavaScript:void(0);" class="tip-l" title="编辑文章">编辑文章</a></div>
        <?php } ?>    </div>
</div>

            </div>
                <div nctype="cms_module_content" class="cms-module-frame-w2">
                        <!-- 文章　-->
<div class="cms-module-assembly-article-image">
    <div class="title-bar">
        <h3 id="block3_article_title" nctype="object_module_edit"><?php echo $module_content['block3_article_title'];?></h3>
        <?php if($output['edit_flag']) {?>        <div class="cms-index-module-handle"><a nctype="btn_module_title_edit" href="JavaScript:void(0);" class="tip-r" title="编辑标题">编辑标题</a></div>
        <?php } ?>    </div>
    <div class="content-box">
        <ul id="block3_article_content" nctype="object_module_edit">
            <?php echo html_entity_decode($module_content['block3_article_content']);?>        </ul>
        <?php if($output['edit_flag']) { ?>        <div class="cms-index-module-handle"><a nctype="btn_module_article_edit" save_function="article_type_3_save" limit_count="0" href="JavaScript:void(0);" class="tip-l" title="编辑图文">编辑图文</a></div>
        <?php } ?>    </div>
</div>

            </div>
            <div class="clear"></div>
    </div>
</div>

