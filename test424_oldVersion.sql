# ************************************************************
# Sequel Pro SQL dump
# Version 4541
#
# http://www.sequelpro.com/
# https://github.com/sequelpro/sequelpro
#
# Host: 127.0.0.1 (MySQL 5.7.19-0ubuntu0.16.04.1)
# Database: test424
# Generation Time: 2017-11-19 10:48:16 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table article
# ------------------------------------------------------------

DROP TABLE IF EXISTS `article`;

CREATE TABLE `article` (
  `Aid` int(11) NOT NULL,
  `Disease_id` int(11) NOT NULL,
  `Atitle` varchar(100) NOT NULL DEFAULT '',
  `Alabel` varchar(100) DEFAULT NULL,
  `Asource` varchar(200) DEFAULT NULL,
  `Acontent` varchar(1000) NOT NULL DEFAULT '',
  `Apicture_url` varchar(200) DEFAULT NULL,
  `Acontent_url` varchar(200) DEFAULT NULL,
  `Apush_date` datetime NOT NULL,
  PRIMARY KEY (`Aid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table clock
# ------------------------------------------------------------

DROP TABLE IF EXISTS `clock`;

CREATE TABLE `clock` (
  `User_id` int(11) NOT NULL,
  `clock_id` int(11) NOT NULL AUTO_INCREMENT,
  `Reminder_time` time NOT NULL,
  `dName` varchar(255) NOT NULL DEFAULT '',
  `dDose` varchar(255) NOT NULL DEFAULT '',
  PRIMARY KEY (`clock_id`,`User_id`,`Reminder_time`,`dName`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `clock` WRITE;
/*!40000 ALTER TABLE `clock` DISABLE KEYS */;

INSERT INTO `clock` (`User_id`, `clock_id`, `Reminder_time`, `dName`, `dDose`)
VALUES
	(1,1,'11:22:33','?','111');

/*!40000 ALTER TABLE `clock` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table disease
# ------------------------------------------------------------

DROP TABLE IF EXISTS `disease`;

CREATE TABLE `disease` (
  `Disease_id` int(11) NOT NULL COMMENT '????ID',
  `Section_id` int(11) NOT NULL COMMENT '????ID',
  `Disease_name` varchar(20) DEFAULT NULL COMMENT '????????',
  `Disease_Position` varchar(20) NOT NULL DEFAULT '' COMMENT '???????',
  `Disease_define` varchar(2000) DEFAULT NULL COMMENT '????????',
  `Disease_cause` varchar(2000) DEFAULT NULL COMMENT '????????',
  `Disease_symptom` varchar(2000) DEFAULT NULL COMMENT '??????',
  `Disease_complication` varchar(2000) DEFAULT NULL COMMENT '?????????',
  `Disease_cure` varchar(2000) DEFAULT NULL COMMENT '????????',
  `Disease_check` varchar(2000) DEFAULT NULL COMMENT '???????',
  `Disease_diagnosis` varchar(2000) DEFAULT NULL COMMENT '??????????',
  `Disease_prevention` varchar(2000) DEFAULT NULL COMMENT '??????????',
  `Disease_Image` varchar(20) DEFAULT NULL COMMENT '????????',
  `Disease_Video` varchar(20) DEFAULT NULL COMMENT '?????????',
  `Disease_gender` int(11) DEFAULT NULL COMMENT '???????????',
  PRIMARY KEY (`Disease_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table health_information
# ------------------------------------------------------------

DROP TABLE IF EXISTS `health_information`;

CREATE TABLE `health_information` (
  `Hid` int(11) NOT NULL,
  `Huser_id` int(11) NOT NULL,
  `Huser_height` decimal(5,2) DEFAULT NULL,
  `Huser_weight` decimal(5,2) DEFAULT NULL,
  `Hblood_sugar` decimal(5,2) DEFAULT NULL,
  `Hblood_fat` decimal(5,2) DEFAULT NULL,
  `Heart_rate` int(11) DEFAULT NULL,
  `Hcholesterol_ester` decimal(5,2) DEFAULT NULL,
  `Htriglyceride` decimal(5,2) DEFAULT NULL,
  `Htotal_cholesterol` decimal(5,2) DEFAULT NULL,
  `Hdiastolic_pressure` int(11) DEFAULT NULL,
  `Hsystolic_pressure` int(11) DEFAULT NULL,
  `Hear_temperature` int(11) DEFAULT NULL,
  `Hrecording_date` datetime NOT NULL,
  `Hrecording_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`Hid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table medical_history
# ------------------------------------------------------------

DROP TABLE IF EXISTS `medical_history`;

CREATE TABLE `medical_history` (
  `user_id` int(11) NOT NULL,
  `disease_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



# Dump of table test1
# ------------------------------------------------------------

DROP TABLE IF EXISTS `test1`;

CREATE TABLE `test1` (
  `id_test` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `name_test` varchar(255) CHARACTER SET utf8 NOT NULL DEFAULT '',
  PRIMARY KEY (`id_test`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

LOCK TABLES `test1` WRITE;
/*!40000 ALTER TABLE `test1` DISABLE KEYS */;

INSERT INTO `test1` (`id_test`, `name_test`)
VALUES
	(2,'petter'),
	(3,'jack'),
	(4,'111');

/*!40000 ALTER TABLE `test1` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table user
# ------------------------------------------------------------

DROP TABLE IF EXISTS `user`;

CREATE TABLE `user` (
  `User_id` int(11) NOT NULL,
  `User_name` varchar(20) DEFAULT NULL,
  `User_password` varchar(20) NOT NULL DEFAULT '',
  `User_phone` varchar(20) DEFAULT NULL,
  `User_sex` varchar(20) NOT NULL DEFAULT '',
  `User_age` int(11) DEFAULT NULL,
  `User_email` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`User_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;

INSERT INTO `user` (`User_id`, `User_name`, `User_password`, `User_phone`, `User_sex`, `User_age`, `User_email`)
VALUES
	(1,NULL,'',NULL,'',NULL,NULL);

/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
