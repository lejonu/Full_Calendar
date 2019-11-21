DROP SCHEMA IF EXISTS `db_calendar`;
CREATE SCHEMA `db_calendar` ;

USE `db_calendar` ;

DROP TABLE IF EXISTS `events`;

CREATE TABLE `events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(220) DEFAULT NULL,
  `color` varchar(20) DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `end` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

LOCK TABLES `events` WRITE;

INSERT INTO `events` VALUES (1,'Primeiro','Preto','2019-11-24 00:00:00','2019-11-24 00:00:00'),(2,'Segundo','Azul','2019-11-25 00:00:00','2019-11-25 00:00:00'),(3,'Terceiro','Vermelho','2019-11-26 00:00:00','2019-11-26 00:00:00');

UNLOCK TABLES;
