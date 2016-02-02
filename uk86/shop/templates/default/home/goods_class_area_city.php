<div class="filter-detailc" id="addressDraw">
   <dl class="location-hots">常用城市</dl>
    <?php foreach($output['city_array'] as $k=>$city){?>
      <?php if($k%4==0){?>
        <dl class="location-hots" style="height: 40px">
      <?php }?>
           <dd><a href="<?php echo replaceParam(array('area_id' =>$city['area_id']));?>"><?php echo $city['area_name'];?></a></dd>
      <?php if($k%4==3){?>
        </dl>
      <?php }?>
      <?php if($k==15)break;?>
    <?php }?>
  <p class="oreder-default"><a href="<?php echo dropParam(array('area_id'));?>">不限地区</a></p>
</div>
