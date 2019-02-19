CREATE DATABASE  IF NOT EXISTS `hair_salon` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `hair_salon`;
-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: hair_salon
-- ------------------------------------------------------
-- Server version	5.7.23

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
-- Table structure for table `clients`
--

DROP TABLE IF EXISTS `clients`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) COLLATE utf8_lithuanian_ci DEFAULT NULL,
  `visits` int(11) DEFAULT NULL,
  `active_reservation` int(11) DEFAULT NULL,
  `session` varchar(100) COLLATE utf8_lithuanian_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clients`
--

LOCK TABLES `clients` WRITE;
/*!40000 ALTER TABLE `clients` DISABLE KEYS */;
INSERT INTO `clients` VALUES (1,'Jonas Jonaitis',0,NULL,NULL),(5,'Petras Petraitis',0,NULL,NULL);
/*!40000 ALTER TABLE `clients` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hairdressers`
--

DROP TABLE IF EXISTS `hairdressers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hairdressers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(45) CHARACTER SET utf8 COLLATE utf8_lithuanian_ci DEFAULT NULL,
  `last_name` varchar(45) CHARACTER SET utf8 COLLATE utf8_lithuanian_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf16 COLLATE=utf16_lithuanian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hairdressers`
--

LOCK TABLES `hairdressers` WRITE;
/*!40000 ALTER TABLE `hairdressers` DISABLE KEYS */;
INSERT INTO `hairdressers` VALUES (1,'Ona','Onutė'),(2,'Ieva','Ievutė'),(3,'Rima','Rimutė'),(4,'Monika','Monikutė');
/*!40000 ALTER TABLE `hairdressers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `reservations`
--

DROP TABLE IF EXISTS `reservations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reservations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `hairdresser_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=207 DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservations`
--

LOCK TABLES `reservations` WRITE;
/*!40000 ALTER TABLE `reservations` DISABLE KEYS */;
INSERT INTO `reservations` VALUES (1,'2019-02-19 10:00:00',1,1);
/*!40000 ALTER TABLE `reservations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `times`
--

DROP TABLE IF EXISTS `times`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `times` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=203 DEFAULT CHARSET=utf8 COLLATE=utf8_lithuanian_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `times`
--

LOCK TABLES `times` WRITE;
/*!40000 ALTER TABLE `times` DISABLE KEYS */;
INSERT INTO `times` VALUES (1,'2019-02-19 10:00:00'),(2,'2019-02-19 10:15:00'),(3,'2019-02-19 10:30:00'),(4,'2019-02-19 10:45:00'),(5,'2019-02-19 11:00:00'),(6,'2019-02-19 11:15:00'),(7,'2019-02-19 11:30:00'),(8,'2019-02-19 11:45:00'),(9,'2019-02-19 12:00:00'),(10,'2019-02-19 12:15:00'),(11,'2019-02-19 12:30:00'),(12,'2019-02-19 12:45:00'),(13,'2019-02-19 13:00:00'),(14,'2019-02-19 13:15:00'),(15,'2019-02-19 13:30:00'),(16,'2019-02-19 13:45:00'),(17,'2019-02-19 14:00:00'),(18,'2019-02-19 14:15:00'),(19,'2019-02-19 14:30:00'),(20,'2019-02-19 14:45:00'),(21,'2019-02-19 15:00:00'),(22,'2019-02-19 15:15:00'),(23,'2019-02-19 15:30:00'),(24,'2019-02-19 15:45:00'),(25,'2019-02-19 16:00:00'),(26,'2019-02-19 16:15:00'),(27,'2019-02-19 16:30:00'),(28,'2019-02-19 16:45:00'),(29,'2019-02-19 17:00:00'),(30,'2019-02-19 17:15:00'),(31,'2019-02-19 17:30:00'),(32,'2019-02-19 17:45:00'),(33,'2019-02-19 18:00:00'),(34,'2019-02-19 18:15:00'),(35,'2019-02-19 18:30:00'),(36,'2019-02-19 18:45:00'),(37,'2019-02-19 19:00:00'),(38,'2019-02-19 19:15:00'),(39,'2019-02-19 19:30:00'),(40,'2019-02-19 19:45:00'),(41,'2019-02-20 10:00:00'),(42,'2019-02-20 10:15:00'),(43,'2019-02-20 10:30:00'),(44,'2019-02-20 10:45:00'),(45,'2019-02-20 11:00:00'),(46,'2019-02-20 11:15:00'),(47,'2019-02-20 11:30:00'),(48,'2019-02-20 11:45:00'),(49,'2019-02-20 12:00:00'),(50,'2019-02-20 12:15:00'),(51,'2019-02-20 12:30:00'),(52,'2019-02-20 12:45:00'),(53,'2019-02-20 13:00:00'),(54,'2019-02-20 13:15:00'),(55,'2019-02-20 13:30:00'),(56,'2019-02-20 13:45:00'),(57,'2019-02-20 14:00:00'),(58,'2019-02-20 14:15:00'),(59,'2019-02-20 14:30:00'),(60,'2019-02-20 14:45:00'),(61,'2019-02-20 15:00:00'),(62,'2019-02-20 15:15:00'),(63,'2019-02-20 15:30:00'),(64,'2019-02-20 15:45:00'),(65,'2019-02-20 16:00:00'),(66,'2019-02-20 16:15:00'),(67,'2019-02-20 16:30:00'),(68,'2019-02-20 16:45:00'),(69,'2019-02-20 17:00:00'),(70,'2019-02-20 17:15:00'),(71,'2019-02-20 17:30:00'),(72,'2019-02-20 17:45:00'),(73,'2019-02-20 18:00:00'),(74,'2019-02-20 18:15:00'),(75,'2019-02-20 18:30:00'),(76,'2019-02-20 18:45:00'),(77,'2019-02-20 19:00:00'),(78,'2019-02-20 19:15:00'),(79,'2019-02-20 19:30:00'),(80,'2019-02-20 19:45:00'),(81,'2019-02-21 10:00:00'),(82,'2019-02-21 10:15:00'),(83,'2019-02-21 10:30:00'),(84,'2019-02-21 10:45:00'),(85,'2019-02-21 11:00:00'),(86,'2019-02-21 11:15:00'),(87,'2019-02-21 11:30:00'),(88,'2019-02-21 11:45:00'),(89,'2019-02-21 12:00:00'),(90,'2019-02-21 12:15:00'),(91,'2019-02-21 12:30:00'),(92,'2019-02-21 12:45:00'),(93,'2019-02-21 13:00:00'),(94,'2019-02-21 13:15:00'),(95,'2019-02-21 13:30:00'),(96,'2019-02-21 13:45:00'),(97,'2019-02-21 14:00:00'),(98,'2019-02-21 14:15:00'),(99,'2019-02-21 14:30:00'),(100,'2019-02-21 14:45:00'),(101,'2019-02-21 15:00:00'),(102,'2019-02-21 15:15:00'),(103,'2019-02-21 15:30:00'),(104,'2019-02-21 15:45:00'),(105,'2019-02-21 16:00:00'),(106,'2019-02-21 16:15:00'),(107,'2019-02-21 16:30:00'),(108,'2019-02-21 16:45:00'),(109,'2019-02-21 17:00:00'),(110,'2019-02-21 17:15:00'),(111,'2019-02-21 17:30:00'),(112,'2019-02-21 17:45:00'),(113,'2019-02-21 18:00:00'),(114,'2019-02-21 18:15:00'),(115,'2019-02-21 18:30:00'),(116,'2019-02-21 18:45:00'),(117,'2019-02-21 19:00:00'),(118,'2019-02-21 19:15:00'),(119,'2019-02-21 19:30:00'),(120,'2019-02-21 19:45:00'),(121,'2019-02-22 10:00:00'),(122,'2019-02-22 10:15:00'),(123,'2019-02-22 10:30:00'),(124,'2019-02-22 10:45:00'),(125,'2019-02-22 11:00:00'),(126,'2019-02-22 11:15:00'),(127,'2019-02-22 11:30:00'),(128,'2019-02-22 11:45:00'),(129,'2019-02-22 12:00:00'),(130,'2019-02-22 12:15:00'),(131,'2019-02-22 12:30:00'),(132,'2019-02-22 12:45:00'),(133,'2019-02-22 13:00:00'),(134,'2019-02-22 13:15:00'),(135,'2019-02-22 13:30:00'),(136,'2019-02-22 13:45:00'),(137,'2019-02-22 14:00:00'),(138,'2019-02-22 14:15:00'),(139,'2019-02-22 14:30:00'),(140,'2019-02-22 14:45:00'),(141,'2019-02-22 15:00:00'),(142,'2019-02-22 15:15:00'),(143,'2019-02-22 15:30:00'),(144,'2019-02-22 15:45:00'),(145,'2019-02-22 16:00:00'),(146,'2019-02-22 16:15:00'),(147,'2019-02-22 16:30:00'),(148,'2019-02-22 16:45:00'),(149,'2019-02-22 17:00:00'),(150,'2019-02-22 17:15:00'),(151,'2019-02-22 17:30:00'),(152,'2019-02-22 17:45:00'),(153,'2019-02-22 18:00:00'),(154,'2019-02-22 18:15:00'),(155,'2019-02-22 18:30:00'),(156,'2019-02-22 18:45:00'),(157,'2019-02-22 19:00:00'),(158,'2019-02-22 19:15:00'),(159,'2019-02-22 19:30:00'),(160,'2019-02-22 19:45:00'),(161,'2019-02-23 10:00:00'),(162,'2019-02-23 10:15:00'),(163,'2019-02-23 10:30:00'),(164,'2019-02-23 10:45:00'),(165,'2019-02-23 11:00:00'),(166,'2019-02-23 11:15:00'),(167,'2019-02-23 11:30:00'),(168,'2019-02-23 11:45:00'),(169,'2019-02-23 12:00:00'),(170,'2019-02-23 12:15:00'),(171,'2019-02-23 12:30:00'),(172,'2019-02-23 12:45:00'),(173,'2019-02-23 13:00:00'),(174,'2019-02-23 13:15:00'),(175,'2019-02-23 13:30:00'),(176,'2019-02-23 13:45:00'),(177,'2019-02-23 14:00:00'),(178,'2019-02-23 14:15:00'),(179,'2019-02-23 14:30:00'),(180,'2019-02-23 14:45:00'),(181,'2019-02-23 15:00:00'),(182,'2019-02-23 15:15:00'),(183,'2019-02-23 15:30:00'),(184,'2019-02-23 15:45:00'),(185,'2019-02-23 16:00:00'),(186,'2019-02-23 16:15:00'),(187,'2019-02-23 16:30:00'),(188,'2019-02-23 16:45:00'),(189,'2019-02-23 17:00:00'),(190,'2019-02-23 17:15:00'),(191,'2019-02-23 17:30:00'),(192,'2019-02-23 17:45:00'),(193,'2019-02-23 18:00:00'),(194,'2019-02-23 18:15:00'),(195,'2019-02-23 18:30:00'),(196,'2019-02-23 18:45:00'),(197,'2019-02-23 19:00:00'),(198,'2019-02-23 19:15:00'),(199,'2019-02-23 19:30:00'),(200,'2019-02-23 19:45:00');
/*!40000 ALTER TABLE `times` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-02-19 23:41:41