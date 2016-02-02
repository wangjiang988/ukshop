<?php
/**
 * 清理缓存
 **by Uk86 商城开发*/

defined('InUk86') or exit('Access Invalid!');

class cacheControl extends SystemControl
{
    protected $cacheItems = array(
        'setting',          // 基本缓存
        'seo',              // SEO缓存
        'groupbuy_price',   // 抢购价格区间
        'nav',              // 底部导航缓存
        'express',          // 快递公司
        'store_class',      // 店铺分类
        'store_grade',      // 店铺等级
        'store_msg_tpl',    // 店铺消息
        'member_msg_tpl',   // 用户消息
        'consult_type',     // 咨询类型
        'circle_level',     // 圈子成员等级
    );

    public function __construct()
    {
        parent::__construct();
        Uk86Language::uk86_read('cache');
    }

    /**
     * 清理缓存
     */
    public function clearOp()
    {
        if (!uk86_chksubmit()) {
            Tpl::showpage('cache.clear');
            return;
        }

        $lang = Uk86Language::uk86_getLangContent();

        // 清理所有缓存
        if ($_POST['cls_full'] == 1) {
            foreach ($this->cacheItems as $i) {
                uk86_dkcache($i);
            }

            // 表主键
            Model::dropTablePkArrayCache();

            // 商品分类
            uk86_dkcache('gc_class');
            uk86_dkcache('all_categories');
            uk86_dkcache('goods_class_seo');
            uk86_dkcache('class_tag');

            // 广告
            Model('adv')->makeApAllCache();

            // 首页
            Model('web_config')->getWebHtml('index', 1);
            uk86_delCacheFile('index');
        } else {
            $todo = (array) $_POST['cache'];

            foreach ($this->cacheItems as $i) {
                if (in_array($i, $todo)) {
                    uk86_dkcache($i);
                }
            }

            // 表主键
            if (in_array('table', $todo)) {
                Model::dropTablePkArrayCache();
            }

            // 商品分类
            if (in_array('goodsclass', $todo)) {
                uk86_dkcache('gc_class');
                uk86_dkcache('all_categories');
                uk86_dkcache('goods_class_seo');
                uk86_dkcache('class_tag');
            }

            // 广告
            if (in_array('adv', $todo)) {
                Model('adv')->makeApAllCache();
            }

            // 首页
            if (in_array('index', $todo)) {
                Model('web_config')->getWebHtml('index', 1);
                uk86_delCacheFile('index');
            }
        }

        $this->log(L('cache_cls_operate'));
        uk86_showMessage($lang['cache_cls_ok']);
    }
}
