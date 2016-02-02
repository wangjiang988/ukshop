<?php defined('InUk86') or exit('Access Invalid!');?>
      <div class="title">
	  
        <h3><a href="<?php echo uk86_urlShop('category', 'index');?>">所有商品分类</a></h3><!--所有商品分类-->
        <i></i>
        </div>
      <div class="category">
        <ul class="menu">
          <?php if (!empty($output['show_goods_class']) && is_array($output['show_goods_class'])) { $i = 0; ?>
          <?php foreach ($output['show_goods_class'] as $key => $val) { $i++; ?>
          <li cat_id="<?php echo $val['gc_id'];?>" class="<?php echo $i%2==1 ? 'odd':'even';?>" <?php if($i>5){?>style="display:none;"<?php }?>>
            <div class="class">
              <?php if(!empty($val['pic'])) { ?>
              <span class="ico"><img src="<?php echo $val['pic'];?>"></span>
              <?php } ?>
              <h4><a href="<?php echo uk86_urlShop('search','index',array('cate_id'=> $val['gc_id']));?>"><?php echo $val['gc_name'];?></a></h4>
              <span class="recommend-class">
              <?php if (!empty($val['class3']) && is_array($val['class3'])) { ?>
              <?php foreach ($val['class3'] as $k => $v) { ?>
              <a href="<?php echo uk86_urlShop('search','index',array('cate_id'=> $v['gc_id']));?>" title="<?php echo $v['gc_name']; ?>"><?php echo $v['gc_name'];?></a>
              
              <?php } ?>
              <?php } ?>
              </span>
            </div>
              <span class="arrow"></span>
              <div class="class-container sub-postion-<?php echo $i ?>">
                <div class="sub-class fl" cat_menu_id="<?php echo $val['gc_id'];?>">
                  <div class="class-cate">
                      <?php if (!empty($val['class2']) && is_array($val['class2'])) { ?>
                      <?php foreach ($val['class2'] as $k => $v) {?>
                      <dl>

                          <dt class='class-2'><h3><a href="<?php echo uk86_urlShop('search','index',array('cate_id'=> $v['gc_id']));?>"><?php echo $v['gc_name'];?></a></h3></dt>
                                           
                          <dd class="goods-class class-3">
                            <?php if (!empty($v['class3']) && is_array($v['class3'])) { $index=0;?>
                            <?php foreach ($v['class3'] as $k3 => $v3) { if($index>14)break;$index++;?>
                            <a href="<?php echo uk86_urlShop('search','index',array('cate_id'=> $v3['gc_id']));?>"><?php echo $v3['gc_name'];?></a>
                            <?php } ?>
                            <?php } ?>
                        </dd>
                       
                      </dl>
                      <?php } ?>
                      <?php } ?>
                  </div>
                </div>
                <?php if(!empty($output['brand_info'])){?>
                    <div style="width: 220px; height:300px; margin-top:20px;float:right;text-align:center;border-left:1px dotted #e6e6e6;">
                      <?php $j = 0; ?>
                      <?php foreach ($output['brand_info'] as $ki => $vi){ ?>
                        <?php if($vi['parent_id'] == $val['gc_id']){ $j++; ?>
                          <a style="display:inline-block;margin-bottom:12px" href="<?php echo uk86_urlShop('brand', 'list', array('brand'=>$vi['brand_id']));?>"><img class='brand_pic' title="<?php echo $vi['brand_name'] ?>" src='<?php echo uk86_brandImage($vi['brand_pic']) ?>' /></a>
                          <?php if($j >= 10) break;?>
                        <?php } ?>
                      <?php } ?>
                    </div>
                <?php }?>  
            </div>
          </li>
          <?php } ?>
          <?php } ?>
        </ul>
      </div>
      