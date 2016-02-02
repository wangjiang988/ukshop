/*
Navicat MySQL Data Transfer

Source Server         : 127.0.0.1
Source Server Version : 50534
Source Host           : localhost:3306
Source Database       : ukshop

Target Server Type    : MYSQL
Target Server Version : 50534
File Encoding         : 65001

Date: 2016-01-11 12:46:44
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `ukshop_pm_order`
-- ----------------------------
CREATE TABLE `ukshop_pm_order` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '虚拟订单索引id',
  `order_sn` bigint(20) unsigned NOT NULL COMMENT '订单编号',
  `store_name` varchar(50) NOT NULL COMMENT '卖家店铺名称',
  `buyer_id` int(11) unsigned NOT NULL COMMENT '买家id',
  `buyer_name` varchar(50) NOT NULL COMMENT '买家登录名',
  `add_time` int(10) unsigned NOT NULL COMMENT '订单生成时间',
  `payment_code` char(10) NOT NULL DEFAULT '' COMMENT '支付方式名称代码',
  `payment_time` int(10) unsigned DEFAULT '0' COMMENT '支付(付款)时间',
  `trade_no` varchar(35) DEFAULT NULL COMMENT '第三方平台交易号',
  `close_time` int(10) unsigned DEFAULT '0' COMMENT '关闭时间',
  `close_reason` varchar(50) DEFAULT NULL COMMENT '关闭原因',
  `finnshed_time` int(11) DEFAULT NULL COMMENT '完成时间',
  `order_amount` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '订单总价格(支付金额)',
  `refund_amount` decimal(10,2) DEFAULT '0.00' COMMENT '退款金额',
  `rcb_amount` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '充值卡支付金额',
  `pd_amount` decimal(10,2) unsigned NOT NULL DEFAULT '0.00' COMMENT '预存款支付金额',
  `order_state` tinyint(4) NOT NULL DEFAULT '0' COMMENT '订单状态：0(已取消)10(默认):未付款;20:已付款;40:已完成;',
  `refund_state` tinyint(1) unsigned DEFAULT '0' COMMENT '退款状态:0是无退款,1是部分退款,2是全部退款',
  `buyer_msg` varchar(150) DEFAULT NULL COMMENT '买家留言',
  `delete_state` tinyint(4) NOT NULL DEFAULT '0' COMMENT '删除状态0未删除1放入回收站2彻底删除',
  `goods_name` varchar(50) NOT NULL COMMENT '商品名称',
  `goods_price` decimal(10,2) NOT NULL COMMENT '商品价格',
  `goods_num` smallint(5) unsigned NOT NULL DEFAULT '1' COMMENT '商品数量',
  `order_from` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1WEB2mobile',
  `evaluation_state` tinyint(4) NOT NULL DEFAULT '0' COMMENT '评价状态0默认1已评价2禁止评价',
  `evaluation_time` int(11) NOT NULL DEFAULT '0' COMMENT '评价时间',
  `use_state` tinyint(4) DEFAULT '0' COMMENT '使用状态0默认，未使用1已使用，有一个被使用即为1',
  PRIMARY KEY (`order_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='促销订单表';

-- ----------------------------
-- Records of ukshop_vr_order
-- ----------------------------
-- 2016. 1.12 add by  wangjiang
ALTER TABLE `ukshop_pm_order`
ADD COLUMN `goods_type`  int(4) NOT NULL DEFAULT 1 COMMENT '1抢购2.限时，3满送，4优惠套餐，5推荐站位，6卡卷包' AFTER `delete_state`;


-- ----------------------------
-- Records of ukshop_adv_position
-- ----------------------------
-- 2016. 1.12 add by  bzhang
ALTER TABLE `ukshop_adv_position`
ADD COLUMN `adv_type`  int(4) NOT NULL DEFAULT 1 COMMENT '1、普通广告2、旗舰店广告';



-- 2016.1.14  add by wangjiang
ALTER TABLE `ukshop_brand`
ADD COLUMN `is_pay`  tinyint(1) NULL DEFAULT '0 ' COMMENT '是否付款 1付  0未付' AFTER `show_type`,
ADD COLUMN `order_id`  int(11) NULL COMMENT 'pm表中的order_id' AFTER `is_pay`,
ADD COLUMN `order_sn`  bigint(20) NULL COMMENT 'pm表中订单编号' AFTER `order_id`;

ALTER TABLE `ukshop_brand` ADD UNIQUE INDEX `order_id` (`order_id`) USING BTREE ;
