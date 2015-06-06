# ************************************************************
# Sequel Pro SQL dump
# Version 4135
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: localhost (MySQL 5.5.38)
# Database: imassage
# Generation Time: 2015-06-06 01:15:00 +0000
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
	(1,'admin','3fe75844cdacd9305950b5ffdef55d94',1433338239);

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
	(5,'李晨',1,'./Imassage/Uploads/20150529/5567fc1b8d500.png','专家','7年工作经验',0,NULL),
	(4,'范冰冰',2,'./Imassage/Uploads/20150529/55680db2bdaa7.png','专家','5年工作经验',0,'[{\"pid\":\"31\",\"title\":\"\\u6d4b\\u8bd5\\u670d\\u52a1\"}]'),
	(6,'赵薇',2,'./Imassage/Uploads/20150529/5567fea2ce879.png','专家','暂无',0,NULL),
	(7,'路易',1,'./Imassage/Uploads/20150529/5567ff1157e84.png','高级','暂无',0,NULL),
	(8,'邓超',1,'./Imassage/Uploads/20150529/5567ff7d00ae1.png','专家','厉害',0,NULL),
	(9,'莫文蔚',2,'./Imassage/Uploads/20150529/556802f8f0bdd.png','高级','哈哈',0,NULL);

/*!40000 ALTER TABLE `Blindman` ENABLE KEYS */;
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
	(1,'',500,1,10000,0);

/*!40000 ALTER TABLE `Coupons` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table CouponsInfo
# ------------------------------------------------------------

DROP TABLE IF EXISTS `CouponsInfo`;

CREATE TABLE `CouponsInfo` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `code` varchar(20) NOT NULL DEFAULT '',
  `usetime` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;



# Dump of table Orders
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Orders`;

CREATE TABLE `Orders` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `uid` int(11) NOT NULL,
  `bid` int(11) DEFAULT NULL,
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
	(1,1,NULL,31,1,26500,26500,NULL,8,1433035562,1433035562,NULL,0,NULL,NULL);

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
	(3,'专家',28000,34);

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
	(31,'测试服务','./Imassage/Uploads/20150529/55680d2472ef2.png',1,'<p>测试服务</p>',26500,60,1),
	(33,'测试服务2','./Imassage/Uploads/20150528/55672485a175c.jpg',1,'<p>测试服务2</p>',23500,45,1),
	(34,'测试服务2','./Imassage/Uploads/20150528/5567248a01485.jpg',1,'<p>测试服务2</p>',23500,45,1),
	(35,'测试服务2','./Imassage/Uploads/20150528/556724acb57be.jpg',1,'<p>测试服务2</p>',23500,45,1),
	(36,'测试服务2','./Imassage/Uploads/20150528/556724c6e6563.jpg',1,'<p>测试服务2</p>',23500,45,1);

/*!40000 ALTER TABLE `Product` ENABLE KEYS */;
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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;

INSERT INTO `User` (`id`, `name`, `phone`, `password`, `money`, `address`, `sex`, `lastlogin`)
VALUES
	(1,'测试','18053722630','',0,'山东济宁',1,NULL);

/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
