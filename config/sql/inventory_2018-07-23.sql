# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.22)
# Database: inventory
# Generation Time: 2018-07-23 08:48:53 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table migration_versions
# ------------------------------------------------------------

DROP TABLE IF EXISTS `migration_versions`;

CREATE TABLE `migration_versions` (
  `version` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `migration_versions` WRITE;
/*!40000 ALTER TABLE `migration_versions` DISABLE KEYS */;

INSERT INTO `migration_versions` (`version`)
VALUES
	('20180709084353'),
	('20180710033941'),
	('20180710034038'),
	('20180710084135'),
	('20180710084450'),
	('20180710102745');

/*!40000 ALTER TABLE `migration_versions` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table product
# ------------------------------------------------------------

DROP TABLE IF EXISTS `product`;

CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_id` int(11) DEFAULT NULL,
  `supplier_price` double DEFAULT NULL,
  `interest_rate` double NOT NULL,
  `computed_price` double NOT NULL,
  `online_price` double DEFAULT NULL,
  `img` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `product_status` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_D34A04AD2ADD6D8C` (`supplier_id`),
  CONSTRAINT `FK_D34A04AD2ADD6D8C` FOREIGN KEY (`supplier_id`) REFERENCES `supplier` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `product` WRITE;
/*!40000 ALTER TABLE `product` DISABLE KEYS */;

INSERT INTO `product` (`id`, `product_code`, `description`, `supplier_id`, `supplier_price`, `interest_rate`, `computed_price`, `online_price`, `img`, `created_at`, `product_status`)
VALUES
	(1,'adf','What is Lorem Ipsum?\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',1,100,200,300,300,'ccd63a361f1ffc1707826d29f2f6b09a.jpeg','2018-07-10 08:10:05',2),
	(2,'product 002','description',2,5.111,100,10.222,1000,'4f4a1137588f0cbf600a3ebab940efa7.jpeg','2017-07-10 08:10:05',1),
	(3,'003','product 3',1,1000,10,1100,2000,NULL,'2018-07-11 10:35:30',NULL),
	(4,'product 004','product 004 description',2,100,10,110,1000,'fa816d4b199b3783c8d0d112c1fdfbff.jpeg','2018-07-11 10:37:33',NULL),
	(5,'product 005','123',2,123,123,274.29,123,NULL,'2018-07-11 10:52:05',NULL),
	(6,'product 002','123',1,20,10,22,123,NULL,'2018-07-11 10:57:07',NULL),
	(7,'prod 007','007 description',1,10,10,11,20,NULL,'2018-07-11 11:13:41',NULL),
	(8,'008','prod8',2,100,50,150,1200,NULL,'2018-07-11 11:41:23',NULL),
	(10,'prodcodes','descs',NULL,100,10,110,1000,NULL,'2018-07-11 11:55:51',NULL),
	(12,'code','description',2,10,10,11,10,NULL,'2018-07-11 13:05:29',NULL),
	(13,'code','description',2,10,10,11,10,NULL,'2018-07-11 13:06:42',NULL),
	(14,'testi','desc',1,1,200,3,1000,NULL,'2018-07-11 14:24:16',NULL),
	(16,'123','213',2,123,123,274.29,123,NULL,'2018-07-11 14:40:44',NULL),
	(17,'Product 17','seventeen',1,123,123,274.29,123,NULL,'2018-07-11 14:41:04',NULL),
	(18,'asdf','asdf	What is Lorem Ipsum? Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.	What is Lorem Ipsum? Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.',1,11,200,33,1000,NULL,'2018-07-11 15:25:00',NULL),
	(19,'prod 18','18 descriptionss',2,123,100,246,1900,NULL,'2018-07-12 09:23:12',NULL),
	(21,'019','description19',1,123,111,259.53,12,'a8c3a0a963dcd1bc1b0feb35f3228ea1.jpeg','2018-07-13 10:47:17',NULL),
	(25,'afd','123',2,123,123,274.29,123,'c3c98d50602c34639d99fc8ca84ad727.jpeg','2018-07-13 11:38:30',NULL),
	(26,'1123','123',NULL,123,123,274.29,NULL,NULL,'2018-07-13 12:13:13',NULL),
	(27,'1123','123',NULL,123,123,274.29,NULL,NULL,'2018-07-13 12:13:18',NULL),
	(28,'asdf','adsf',NULL,123,222,396.06,123,NULL,'2018-07-13 12:26:09',NULL),
	(29,'asdf','adsf',1,123,222,396.06,123,NULL,'2018-07-13 12:26:26',NULL),
	(30,'asdf','adsf',NULL,123,222,396.06,123,NULL,'2018-07-13 12:27:18',NULL),
	(31,'asdf','adsf',1,123,222,396.06,123,NULL,'2018-07-13 12:54:12',NULL),
	(32,'prodzzz','dfsaf',1,123,123,274.29,1122,NULL,'2018-07-13 14:11:30',NULL),
	(33,'test image','image test desc',1,123,10,135.3,10,'3d39277961f5445d788f48d8a2d6287c.png','2018-07-13 16:32:03',NULL),
	(34,'image extension','description',NULL,100,1,101,123,'','2018-07-13 16:43:46',NULL),
	(36,'imag png','descr',2,1,100,2,4,'28b5a9c43e369c7708a1a0f3774437a7.jpeg','2018-07-13 16:50:17',NULL),
	(37,'123','image test',NULL,100,100,200,1000,'974f4c608def021f5fa421909954e2b8.png','2018-07-13 17:26:49',NULL),
	(38,'123','image test',1,100,100,200,1000,NULL,'2018-07-13 17:28:25',NULL),
	(39,'product 123213','description quick brown fox jumps over the lazy dog.',2,100,100,200,1000,'c851dff216574892452a2316a45f90b6.jpeg','2018-07-17 10:10:24',NULL),
	(40,'test product new','knp_paginator:\r\n    page_range: 5                       # number of links showed in the pagination menu (e.g: you have 10 pages, a page_range of 3, on the 5th page you\'ll see links to page 4, 5, 6)\r\n    default_options:                                 \r\n        page_name: page                 # page query parameter name\r\n        sort_field_name: sort           # sort field query parameter name\r\n        sort_direction_name: direction  # sort direction query parameter name\r\n        distinct: true                  # ensure distinct results, useful when ORM queries are using GROUP BY statements\r\n        filter_field_name: filterField  # filter field query parameter name\r\n        filter_value_name: filterValue  # filter value query parameter name\r\n    template:',2,100,300,400,2000,'1836ebc38fd14e9060f50c5e13318983.jpeg','2018-07-17 17:07:02',NULL);

/*!40000 ALTER TABLE `product` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table supplier
# ------------------------------------------------------------

DROP TABLE IF EXISTS `supplier`;

CREATE TABLE `supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL,
  `contact_no` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `location` longtext COLLATE utf8mb4_unicode_ci,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `supplier` WRITE;
/*!40000 ALTER TABLE `supplier` DISABLE KEYS */;

INSERT INTO `supplier` (`id`, `code`, `name`, `status`, `contact_no`, `location`, `created_at`)
VALUES
	(1,'001','Supplier 001',1,'1234567','NCRs','2018-07-10 12:01:02'),
	(2,'supp 002','Supplier 002',1,'1234567890','University of Eastern Colorado','2018-07-11 12:22:12');

/*!40000 ALTER TABLE `supplier` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table supplier_status
# ------------------------------------------------------------

DROP TABLE IF EXISTS `supplier_status`;

CREATE TABLE `supplier_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status_desc` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

LOCK TABLES `supplier_status` WRITE;
/*!40000 ALTER TABLE `supplier_status` DISABLE KEYS */;

INSERT INTO `supplier_status` (`id`, `status_desc`)
VALUES
	(1,'RR/FF'),
	(2,'testing');

/*!40000 ALTER TABLE `supplier_status` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
