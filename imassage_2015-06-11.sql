# ************************************************************
# Sequel Pro SQL dump
# Version 4135
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: localhost (MySQL 5.5.38)
# Database: imassage
# Generation Time: 2015-06-11 09:31:35 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table Admin
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Admin`;

CREATE TABLE `Admin` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `password` varchar(50) NOT NULL DEFAULT '',
  `lastlogin` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `Admin` WRITE;
/*!40000 ALTER TABLE `Admin` DISABLE KEYS */;

INSERT INTO `Admin` (`id`, `name`, `password`, `lastlogin`)
VALUES
	(1,'admin','3fe75844cdacd9305950b5ffdef55d94',1433916663);

/*!40000 ALTER TABLE `Admin` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Blindman
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Blindman`;

CREATE TABLE `Blindman` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `sex` tinyint(1) NOT NULL DEFAULT '1',
  `img` varchar(100) NOT NULL DEFAULT '',
  `level` varchar(50) NOT NULL DEFAULT '',
  `content` varchar(255) NOT NULL DEFAULT '',
  `ordernum` int(11) NOT NULL DEFAULT '0',
  `products` text,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `Blindman` WRITE;
/*!40000 ALTER TABLE `Blindman` DISABLE KEYS */;

INSERT INTO `Blindman` (`id`, `name`, `sex`, `img`, `level`, `content`, `ordernum`, `products`)
VALUES
	(5,'李晨',1,'/Imassage/Uploads/20150529/5567fc1b8d500.png','专家','7年工作经验',0,NULL),
	(4,'范冰冰',2,'/Imassage/Uploads/20150529/55680db2bdaa7.png','专家','5年工作经验',0,'[{\"pid\":\"31\",\"title\":\"\\u6d4b\\u8bd5\\u670d\\u52a1\"}]'),
	(6,'赵薇',2,'/Imassage/Uploads/20150529/5567fea2ce879.png','专家','暂无',0,NULL),
	(7,'路易',1,'/Imassage/Uploads/20150529/5567ff1157e84.png','高级','暂无',0,NULL),
	(8,'邓超',1,'/Imassage/Uploads/20150529/5567ff7d00ae1.png','专家','厉害',0,NULL),
	(9,'莫文蔚',2,'/Imassage/Uploads/20150529/556802f8f0bdd.png','高级','哈哈',0,NULL);

/*!40000 ALTER TABLE `Blindman` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Btime
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Btime`;

CREATE TABLE `Btime` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `tid` tinyint(2) NOT NULL,
  `blindmans` text NOT NULL,
  `bdate` int(10) NOT NULL,
  `isok` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `Btime` WRITE;
/*!40000 ALTER TABLE `Btime` DISABLE KEYS */;

INSERT INTO `Btime` (`id`, `tid`, `blindmans`, `bdate`, `isok`)
VALUES
	(1,1,'',1433952000,0);

/*!40000 ALTER TABLE `Btime` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Comment
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Comment`;

CREATE TABLE `Comment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `content` varchar(255) NOT NULL DEFAULT '',
  `addtime` int(10) NOT NULL,
  `bid` int(11) DEFAULT NULL,
  `pid` int(11) NOT NULL,
  `reply` varchar(255) DEFAULT NULL,
  `isshow` tinyint(1) NOT NULL DEFAULT '0',
  `name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table Coupons
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Coupons`;

CREATE TABLE `Coupons` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '',
  `price` int(9) NOT NULL,
  `minnum` int(11) NOT NULL DEFAULT '0',
  `minprice` int(11) NOT NULL,
  `endtime` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `Coupons` WRITE;
/*!40000 ALTER TABLE `Coupons` DISABLE KEYS */;

INSERT INTO `Coupons` (`id`, `title`, `price`, `minnum`, `minprice`, `endtime`)
VALUES
	(1,'5元',500,1,2000,1500000000);

/*!40000 ALTER TABLE `Coupons` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Coupons_info
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Coupons_info`;

CREATE TABLE `Coupons_info` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) DEFAULT NULL,
  `cid` int(11) NOT NULL,
  `code` varchar(20) NOT NULL DEFAULT '',
  `usetime` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `Coupons_info` WRITE;
/*!40000 ALTER TABLE `Coupons_info` DISABLE KEYS */;

INSERT INTO `Coupons_info` (`id`, `uid`, `cid`, `code`, `usetime`)
VALUES
	(1,NULL,1,'I1l7LX1g4N',NULL),
	(2,NULL,1,'I1lKd65SsY',NULL),
	(3,NULL,1,'I1pNowuM4b',NULL),
	(4,NULL,1,'I13u124XjC',NULL),
	(5,NULL,1,'I1mNk9jdtW',NULL),
	(6,NULL,1,'I1wI3zQK87',NULL),
	(7,NULL,1,'I1Leup4Kcw',NULL),
	(8,NULL,1,'I1Ne3eXLMo',NULL),
	(9,NULL,1,'I1vfi3rKnC',NULL),
	(10,NULL,1,'I1bQweKqn4',NULL),
	(11,NULL,1,'I1lAB25vgb',NULL),
	(12,NULL,1,'I1nu3FepH5',NULL),
	(13,NULL,1,'I1Zyd6lf3P',NULL),
	(14,NULL,1,'I1x022SY5K',NULL),
	(15,NULL,1,'I1OKb6WXXO',NULL),
	(16,NULL,1,'I1stBbM7eI',NULL),
	(17,NULL,1,'I1N9sRabv7',NULL),
	(18,NULL,1,'I1od14GCef',NULL),
	(19,NULL,1,'I1acZfx5tk',NULL),
	(20,NULL,1,'I1JZi3jTrJ',NULL),
	(21,NULL,1,'I15o91KFfl',NULL),
	(22,NULL,1,'I1b46nVCUl',NULL),
	(23,NULL,1,'I1kH2xpJdx',NULL),
	(24,NULL,1,'I1RZRB2VTL',NULL),
	(25,NULL,1,'I1DuHrb54l',NULL),
	(26,NULL,1,'I1zx2EBBM0',NULL),
	(27,NULL,1,'I1B52oQIOz',NULL),
	(28,NULL,1,'I1dHmp5qko',NULL),
	(29,NULL,1,'I18oAOI0fE',NULL),
	(30,NULL,1,'I1DOAVb92f',NULL),
	(31,1,1,'17170606hLafkx2k',NULL);

/*!40000 ALTER TABLE `Coupons_info` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Orders
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Orders`;

CREATE TABLE `Orders` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `bid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `num` int(9) NOT NULL,
  `price` int(9) NOT NULL,
  `total` int(9) NOT NULL,
  `cid` int(11) DEFAULT NULL,
  `status` tinyint(2) DEFAULT NULL,
  `addtime` int(10) NOT NULL,
  `starttime` int(10) NOT NULL,
  `updatetime` int(10) DEFAULT NULL,
  `endtime` int(10) DEFAULT NULL,
  `tmp_status` tinyint(2) DEFAULT NULL,
  `commentid` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `Orders` WRITE;
/*!40000 ALTER TABLE `Orders` DISABLE KEYS */;

INSERT INTO `Orders` (`id`, `uid`, `bid`, `pid`, `num`, `price`, `total`, `cid`, `status`, `addtime`, `starttime`, `updatetime`, `endtime`, `tmp_status`, `commentid`)
VALUES
	(1,1,0,31,1,26500,26500,NULL,8,1433035562,1433035562,NULL,0,NULL,NULL);

/*!40000 ALTER TABLE `Orders` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Package
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Package`;

CREATE TABLE `Package` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(50) NOT NULL DEFAULT '',
  `price` int(9) NOT NULL,
  `pid` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `Package` WRITE;
/*!40000 ALTER TABLE `Package` DISABLE KEYS */;

INSERT INTO `Package` (`id`, `title`, `price`, `pid`)
VALUES
	(1,'高级',23500,34),
	(2,'特级',25500,34),
	(3,'专家',28000,34),
	(4,'高级',12000,36),
	(5,'特级',15000,36),
	(6,'专家',20000,36),
	(7,'高级',4500,35),
	(8,'特级',6000,35),
	(9,'专家',9000,35),
	(10,'高级',10000,33),
	(11,'特级',15200,33),
	(12,'专家',16600,33),
	(13,'高级',6000,31),
	(14,'特级',7000,31),
	(15,'专家',8000,31);

/*!40000 ALTER TABLE `Package` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table Product
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Product`;

CREATE TABLE `Product` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL DEFAULT '',
  `img` varchar(200) DEFAULT NULL,
  `typeid` tinyint(1) NOT NULL,
  `content` text,
  `price` int(9) NOT NULL,
  `timelong` tinyint(3) NOT NULL,
  `minpeople` tinyint(3) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `Product` WRITE;
/*!40000 ALTER TABLE `Product` DISABLE KEYS */;

INSERT INTO `Product` (`id`, `title`, `img`, `typeid`, `content`, `price`, `timelong`, `minpeople`)
VALUES
	(31,'测试服务','/Imassage/Uploads/20150529/55680d2472ef2.png',1,'<p>测试服务</p>',26500,60,1),
	(33,'测试服务2','/Imassage/Uploads/20150528/55672485a175c.jpg',1,'<p>测试服务2</p>',23500,45,1),
	(34,'测试服务2','/Imassage/Uploads/20150528/5567248a01485.jpg',1,'<p>测试服务2</p>',23500,45,1),
	(35,'测试服务2','/Imassage/Uploads/20150528/556724acb57be.jpg',1,'<p>测试服务2</p>',23500,45,1),
	(36,'测试服务2','/Imassage/Uploads/20150528/556724c6e6563.jpg',1,'<p>测试服务2</p>',23500,45,1);

/*!40000 ALTER TABLE `Product` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table System
# ------------------------------------------------------------

DROP TABLE IF EXISTS `System`;

CREATE TABLE `System` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `addtime` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `System` WRITE;
/*!40000 ALTER TABLE `System` DISABLE KEYS */;

INSERT INTO `System` (`id`, `addtime`)
VALUES
	(1,3600);

/*!40000 ALTER TABLE `System` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table User
# ------------------------------------------------------------

DROP TABLE IF EXISTS `User`;

CREATE TABLE `User` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL DEFAULT '',
  `phone` varchar(11) NOT NULL DEFAULT '',
  `password` varchar(50) NOT NULL DEFAULT '',
  `money` int(9) NOT NULL DEFAULT '0',
  `address` varchar(200) DEFAULT NULL,
  `sex` tinyint(1) DEFAULT NULL,
  `lastlogin` int(10) DEFAULT NULL,
  `openid` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;

INSERT INTO `User` (`id`, `name`, `phone`, `password`, `money`, `address`, `sex`, `lastlogin`, `openid`)
VALUES
	(1,'测试','18053722630','',0,'山东济宁',1,NULL,NULL);

/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
