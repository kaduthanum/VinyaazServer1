CREATE DATABASE  IF NOT EXISTS `alpha` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `alpha`;
-- MySQL dump 10.13  Distrib 5.5.24, for osx10.5 (i386)
--
-- Host: localhost    Database: alpha
-- ------------------------------------------------------
-- Server version	5.5.13

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `product_property_media`
--

DROP TABLE IF EXISTS `product_property_media`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_property_media` (
  `media_id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(11) unsigned NOT NULL,
  `type` enum('Image','Audio','Video') DEFAULT 'Image',
  `path` varchar(255) NOT NULL,
  `usage_type` enum('A','B') NOT NULL,
  `status` enum('Active','Deleted') DEFAULT 'Active',
  PRIMARY KEY (`media_id`),
  KEY `product_property_media_product_id_fk_idx` (`product_id`),
  CONSTRAINT `product_property_media_product_id_fk` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product` (
  `product_id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(11) unsigned NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `category` enum('Electronics','RealEstate','Spa','Other') NOT NULL,
  `status` enum('Active','Deleted') DEFAULT NULL,
  `exclusive_indicatoy` tinyint(1) NOT NULL,
  PRIMARY KEY (`product_id`),
  KEY `product_user_id_fk_idx` (`user_id`),
  CONSTRAINT `product_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `product_property`
--

DROP TABLE IF EXISTS `product_property`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `product_property` (
  `property_id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `product_id` bigint(11) unsigned NOT NULL,
  `value` varchar(120) NOT NULL,
  `description` varchar(255) NOT NULL,
  `long_description` text,
  `status` enum('Active','Deleted') NOT NULL DEFAULT 'Active',
  PRIMARY KEY (`property_id`),
  KEY `product_property_product_id_fk_idx` (`product_id`),
  CONSTRAINT `product_property_product_id_fk` FOREIGN KEY (`product_id`) REFERENCES `product` (`product_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `user_id` bigint(11) unsigned NOT NULL AUTO_INCREMENT,
  `email_id` varchar(255) NOT NULL,
  `user_type` enum('Admin','Consumer','Enterprise','Business') NOT NULL DEFAULT 'Consumer',
  `first_name` varchar(45) NOT NULL,
  `middle_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `address1` varchar(255) NOT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `mobile` varchar(45) DEFAULT NULL,
  `home` varchar(45) DEFAULT NULL,
  `fax` varchar(45) DEFAULT NULL,
  `login_attempts` int(10) unsigned DEFAULT '0',
  `status` enum('Registered','Active','Blocked') NOT NULL DEFAULT 'Registered',
  PRIMARY KEY (`user_id`,`email_id`),
  UNIQUE KEY `email_id_UNIQUE` (`email_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Table structure for table `user_password`
--

DROP TABLE IF EXISTS `user_password`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_password` (
  `user_id` bigint(11) unsigned NOT NULL,
  `current_password` varchar(45) NOT NULL,
  `new_password` varchar(45) DEFAULT NULL,
  `change_date` bigint(14) DEFAULT NULL,
  `requested_date` bigint(14) DEFAULT NULL,
  `generated_key` char(32) DEFAULT NULL,
  PRIMARY KEY (`user_id`),
  CONSTRAINT `user_password_user_id_fk` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-09-16 16:56:24
