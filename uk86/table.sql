
ALTER TABLE `#_member` ADD COLUMN `wx_users_id` INT COMMENT '#_wx_users表id';

CREATE TABLE IF NOT EXISTS `#_wechat` (
 `id` INT NOT NULL AUTO_INCREMENT,
 `wxname` VARCHAR(100) NOT NULL COMMENT '公众号名称',
 `wxid` VARCHAR(50) NOT NULL COMMENT '公众号原始ID',
 `wechat` VARCHAR(50) NOT NULL COMMENT '微信号',
 `appid` VARCHAR(100) DEFAULT NULL COMMENT 'AppID',
 `appsecret` VARCHAR(100) DEFAULT NULL COMMENT 'AppSecret',
 PRIMARY KEY(`id`)
)ENGINE=INNODB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `#_wx_users` (
 `id` INT NOT NULL AUTO_INCREMENT,
 `openid` VARCHAR(100) NOT NULL COMMENT 'openid',
 `nickname` VARCHAR(100) DEFAULT '',
 `sex` ENUM('0', '1', '2') DEFAULT '0' COMMENT '0:other,1:man,2:woman',
 `headimgurl` TEXT DEFAULT '',
 `city` VARCHAR(30) DEFAULT '',
 `province` VARCHAR(30) DEFAULT '',
 `country` VARCHAR(30) DEFAULT '',
 `userinfo` TEXT DEFAULT '',
 `create_time` DATETIME,
 `update_time` DATETIME,
 PRIMARY KEY(`id`)
)ENGINE=INNODB DEFAULT CHARSET=utf8;
