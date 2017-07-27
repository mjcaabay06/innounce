-- MySQL dump 10.13  Distrib 5.7.18, for Linux (x86_64)
--
-- Host: localhost    Database: login_db
-- ------------------------------------------------------
-- Server version	5.7.18-0ubuntu0.16.04.1

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
-- Table structure for table `account_activations`
--

DROP TABLE IF EXISTS `account_activations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `account_activations` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `activation_key` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account_activations`
--

LOCK TABLES `account_activations` WRITE;
/*!40000 ALTER TABLE `account_activations` DISABLE KEYS */;
INSERT INTO `account_activations` VALUES (7,1,'699262','2017-06-16 13:35:09','2017-06-16 13:35:09');
/*!40000 ALTER TABLE `account_activations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `courses`
--

DROP TABLE IF EXISTS `courses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `courses` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  `acronym` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `courses`
--

LOCK TABLES `courses` WRITE;
/*!40000 ALTER TABLE `courses` DISABLE KEYS */;
INSERT INTO `courses` VALUES (1,'Information Technology','i','2017-06-27 21:14:02','2017-06-27 21:14:02'),(2,'Management','m','2017-06-27 21:14:02','2017-06-27 21:14:02');
/*!40000 ALTER TABLE `courses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emergencies`
--

DROP TABLE IF EXISTS `emergencies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emergencies` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emergencies`
--

LOCK TABLES `emergencies` WRITE;
/*!40000 ALTER TABLE `emergencies` DISABLE KEYS */;
/*!40000 ALTER TABLE `emergencies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emergency_responses`
--

DROP TABLE IF EXISTS `emergency_responses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emergency_responses` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `response` text NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `emergency_id` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emergency_responses`
--

LOCK TABLES `emergency_responses` WRITE;
/*!40000 ALTER TABLE `emergency_responses` DISABLE KEYS */;
/*!40000 ALTER TABLE `emergency_responses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `login_logs`
--

DROP TABLE IF EXISTS `login_logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `login_logs` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `remarks` text NOT NULL,
  `status_id` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=84 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `login_logs`
--

LOCK TABLES `login_logs` WRITE;
/*!40000 ALTER TABLE `login_logs` DISABLE KEYS */;
INSERT INTO `login_logs` VALUES (5,NULL,'127.0.0.1','Failed',2,'2017-06-16 18:51:50','2017-06-16 18:51:50'),(7,1,NULL,'Successful',1,'2017-06-16 19:02:32','2017-06-16 19:02:32'),(11,1,NULL,'Successful',1,'2017-06-16 19:52:26','2017-06-16 19:52:26'),(12,NULL,'127.0.0.1','Failed',2,'2017-06-16 20:49:28','2017-06-16 20:49:28'),(13,1,NULL,'Successful',1,'2017-06-16 21:21:04','2017-06-16 21:21:04'),(14,NULL,'127.0.0.1','Failed',2,'2017-06-16 21:33:09','2017-06-16 21:33:09'),(15,NULL,'127.0.0.1','Failed',2,'2017-06-16 21:36:19','2017-06-16 21:36:19'),(16,NULL,'127.0.0.1','Failed',2,'2017-06-16 21:37:57','2017-06-16 21:37:57'),(17,NULL,'127.0.0.1','Failed',2,'2017-06-16 21:38:37','2017-06-16 21:38:37'),(18,NULL,'127.0.0.1','Failed',2,'2017-06-16 21:38:56','2017-06-16 21:38:56'),(19,NULL,'127.0.0.1','Failed',2,'2017-06-16 21:39:13','2017-06-16 21:39:13'),(20,NULL,'127.0.0.1','Failed',2,'2017-06-16 21:43:17','2017-06-16 21:43:17'),(21,NULL,'127.0.0.1','Failed',2,'2017-06-16 21:43:50','2017-06-16 21:43:50'),(22,NULL,'127.0.0.1','Failed',2,'2017-06-16 21:44:02','2017-06-16 21:44:02'),(23,NULL,'127.0.0.1','Failed',2,'2017-06-16 21:44:39','2017-06-16 21:44:39'),(24,NULL,'127.0.0.1','Failed',2,'2017-06-16 21:44:44','2017-06-16 21:44:44'),(25,NULL,'127.0.0.1','Failed',2,'2017-06-16 21:44:50','2017-06-16 21:44:50'),(26,NULL,'127.0.0.1','Failed',2,'2017-06-16 21:45:08','2017-06-16 21:45:08'),(27,NULL,'127.0.0.1','Failed',2,'2017-06-16 21:56:25','2017-06-16 21:56:25'),(28,NULL,'127.0.0.1','Failed',2,'2017-06-16 21:56:36','2017-06-16 21:56:36'),(29,NULL,'127.0.0.1','Failed',2,'2017-06-16 21:56:42','2017-06-16 21:56:42'),(30,NULL,'127.0.0.1','Failed',2,'2017-06-16 21:57:43','2017-06-16 21:57:43'),(31,NULL,'127.0.0.1','Failed',2,'2017-06-16 21:58:09','2017-06-16 21:58:09'),(32,NULL,'127.0.0.1','Failed',2,'2017-06-16 21:58:21','2017-06-16 21:58:21'),(33,NULL,'127.0.0.1','Failed',2,'2017-06-16 21:58:42','2017-06-16 21:58:42'),(34,NULL,'127.0.0.1','Failed',2,'2017-06-16 21:59:17','2017-06-16 21:59:17'),(35,NULL,'127.0.0.1','Failed',2,'2017-06-16 21:59:43','2017-06-16 21:59:43'),(36,NULL,'127.0.0.1','Failed',2,'2017-06-16 21:59:47','2017-06-16 21:59:47'),(37,NULL,'127.0.0.1','Failed',2,'2017-06-16 22:13:57','2017-06-16 22:13:57'),(38,NULL,'127.0.0.1','Failed',2,'2017-06-16 22:14:54','2017-06-16 22:14:54'),(39,NULL,'127.0.0.1','Failed',2,'2017-06-16 22:20:42','2017-06-16 22:20:42'),(40,1,NULL,'Successful',1,'2017-06-16 22:25:12','2017-06-16 22:25:12'),(41,1,NULL,'Successful',1,'2017-06-16 22:25:49','2017-06-16 22:25:49'),(42,NULL,'127.0.0.1','Failed',2,'2017-06-16 23:21:43','2017-06-16 23:21:43'),(43,NULL,'127.0.0.1','Failed',2,'2017-06-16 23:23:28','2017-06-16 23:23:28'),(44,1,NULL,'Successful',1,'2017-06-16 23:23:37','2017-06-16 23:23:37'),(45,NULL,'127.0.0.1','Failed',2,'2017-06-16 23:23:53','2017-06-16 23:23:53'),(46,1,NULL,'Successful',1,'2017-06-16 23:24:04','2017-06-16 23:24:04'),(47,1,NULL,'Successful',1,'2017-06-16 23:37:01','2017-06-16 23:37:01'),(48,1,NULL,'Successful',1,'2017-06-16 23:37:29','2017-06-16 23:37:29'),(49,1,NULL,'Successful',1,'2017-06-17 00:13:14','2017-06-17 00:13:14'),(50,1,NULL,'Successful',1,'2017-06-18 22:23:30','2017-06-18 22:23:30'),(51,1,NULL,'Successful',1,'2017-06-22 10:39:25','2017-06-22 10:39:25'),(52,1,NULL,'Successful',1,'2017-06-22 21:11:16','2017-06-22 21:11:16'),(53,1,NULL,'Successful',1,'2017-06-26 16:54:52','2017-06-26 16:54:52'),(54,1,NULL,'Successful',1,'2017-06-26 16:56:32','2017-06-26 16:56:32'),(55,1,NULL,'Successful',1,'2017-06-26 16:59:32','2017-06-26 16:59:32'),(56,1,NULL,'Successful',1,'2017-06-26 17:00:50','2017-06-26 17:00:50'),(57,1,NULL,'Successful',1,'2017-06-27 21:25:58','2017-06-27 21:25:58'),(58,2,NULL,'Successful',1,'2017-06-27 21:50:29','2017-06-27 21:50:29'),(59,2,NULL,'Successful',1,'2017-06-27 21:52:13','2017-06-27 21:52:13'),(60,1,NULL,'Successful',1,'2017-06-27 21:55:14','2017-06-27 21:55:14'),(61,2,NULL,'Successful',1,'2017-06-27 21:57:22','2017-06-27 21:57:22'),(62,1,NULL,'Successful',1,'2017-06-27 22:03:25','2017-06-27 22:03:25'),(63,2,NULL,'Successful',1,'2017-06-27 22:09:32','2017-06-27 22:09:32'),(64,1,NULL,'Successful',1,'2017-06-27 22:10:56','2017-06-27 22:10:56'),(65,1,NULL,'Successful',1,'2017-06-28 21:52:48','2017-06-28 21:52:48'),(66,1,NULL,'Successful',1,'2017-06-29 22:10:03','2017-06-29 22:10:03'),(67,1,NULL,'Successful',1,'2017-06-30 08:49:01','2017-06-30 08:49:01'),(68,1,NULL,'Successful',1,'2017-06-30 10:54:18','2017-06-30 10:54:18'),(69,2,NULL,'Successful',1,'2017-06-30 11:17:24','2017-06-30 11:17:24'),(70,1,NULL,'Successful',1,'2017-06-30 15:44:45','2017-06-30 15:44:45'),(71,2,NULL,'Successful',1,'2017-06-30 15:44:57','2017-06-30 15:44:57'),(72,1,NULL,'Successful',1,'2017-07-10 21:04:05','2017-07-10 21:04:05'),(73,1,NULL,'Successful',1,'2017-07-16 08:54:02','2017-07-16 08:54:02'),(74,2,NULL,'Successful',1,'2017-07-16 09:50:40','2017-07-16 09:50:40'),(75,1,NULL,'Successful',1,'2017-07-16 09:50:53','2017-07-16 09:50:53'),(76,1,NULL,'Successful',1,'2017-07-16 11:36:51','2017-07-16 11:36:51'),(77,NULL,'127.0.0.1','Failed',2,'2017-07-16 13:47:18','2017-07-16 13:47:18'),(78,NULL,'127.0.0.1','Failed',2,'2017-07-16 13:47:27','2017-07-16 13:47:27'),(79,NULL,'127.0.0.1','Failed',2,'2017-07-16 13:48:23','2017-07-16 13:48:23'),(80,1,NULL,'Successful',1,'2017-07-16 13:49:06','2017-07-16 13:49:06'),(81,3,NULL,'Successful',1,'2017-07-16 14:27:44','2017-07-16 14:27:44'),(82,3,NULL,'Successful',1,'2017-07-16 14:28:04','2017-07-16 14:28:04'),(83,1,NULL,'Successful',1,'2017-07-16 14:28:19','2017-07-16 14:28:19');
/*!40000 ALTER TABLE `login_logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_types`
--

DROP TABLE IF EXISTS `password_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_types` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_types`
--

LOCK TABLES `password_types` WRITE;
/*!40000 ALTER TABLE `password_types` DISABLE KEYS */;
INSERT INTO `password_types` VALUES (1,'System Generated','2017-06-14 23:28:37','2017-06-14 23:28:37'),(2,'Manual Input','2017-06-14 23:28:37','2017-06-14 23:28:37');
/*!40000 ALTER TABLE `password_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `school_years`
--

DROP TABLE IF EXISTS `school_years`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `school_years` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `year_from` int(11) NOT NULL,
  `year_to` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `school_years`
--

LOCK TABLES `school_years` WRITE;
/*!40000 ALTER TABLE `school_years` DISABLE KEYS */;
INSERT INTO `school_years` VALUES (1,2017,2018,'2017-06-27 21:16:33','2017-06-27 21:16:33');
/*!40000 ALTER TABLE `school_years` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `secret_questions`
--

DROP TABLE IF EXISTS `secret_questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `secret_questions` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `question` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `secret_questions`
--

LOCK TABLES `secret_questions` WRITE;
/*!40000 ALTER TABLE `secret_questions` DISABLE KEYS */;
INSERT INTO `secret_questions` VALUES (1,'What was your childhood nickname?','2017-06-14 23:05:28','2017-06-14 23:05:28'),(2,'What is the name of your favorite childhood friend?','2017-06-14 23:05:42','2017-06-14 23:05:42'),(3,'What was your favorite sport in high school?','2017-06-14 23:05:42','2017-06-14 23:05:42'),(4,'What was your favorite food as a child?','2017-06-14 23:05:42','2017-06-14 23:05:42'),(5,'Who is your childhood sports hero?','2017-06-14 23:05:42','2017-06-14 23:05:42');
/*!40000 ALTER TABLE `secret_questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `statuses`
--

DROP TABLE IF EXISTS `statuses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `statuses` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `description` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `statuses`
--

LOCK TABLES `statuses` WRITE;
/*!40000 ALTER TABLE `statuses` DISABLE KEYS */;
INSERT INTO `statuses` VALUES (1,'Active','2017-06-14 23:19:26','2017-06-14 23:19:26'),(2,'Inactive','2017-06-14 23:19:26','2017-06-14 23:19:26');
/*!40000 ALTER TABLE `statuses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `students`
--

DROP TABLE IF EXISTS `students`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `students` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `mobile_number` varchar(20) NOT NULL,
  `year_section_id` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `students`
--

LOCK TABLES `students` WRITE;
/*!40000 ALTER TABLE `students` DISABLE KEYS */;
INSERT INTO `students` VALUES (1,'Fatima','E','Valdez','fatima.valdez@gmail.com','09062820782',15,'2017-06-26 18:09:45','2017-06-26 18:09:45'),(2,'James','A','Harden','james.harden@gmail.com','09177629194',6,'2017-06-29 22:32:22','2017-06-29 22:32:22');
/*!40000 ALTER TABLE `students` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `surveys`
--

DROP TABLE IF EXISTS `surveys`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `surveys` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `surveys`
--

LOCK TABLES `surveys` WRITE;
/*!40000 ALTER TABLE `surveys` DISABLE KEYS */;
INSERT INTO `surveys` VALUES (1,'This is just a survey','2017-07-10 21:57:13','2017-07-10 21:57:13');
/*!40000 ALTER TABLE `surveys` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_infos`
--

DROP TABLE IF EXISTS `user_infos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_infos` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_infos`
--

LOCK TABLES `user_infos` WRITE;
/*!40000 ALTER TABLE `user_infos` DISABLE KEYS */;
INSERT INTO `user_infos` VALUES (1,1,'MJ','V','Caabay','09330442353','2017-06-15 11:16:11','2017-06-15 11:16:11'),(2,2,'Johna','M','Cena','09330442353','2017-06-26 18:03:39','2017-06-26 18:03:39');
/*!40000 ALTER TABLE `user_infos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_types`
--

DROP TABLE IF EXISTS `user_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_types` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_types`
--

LOCK TABLES `user_types` WRITE;
/*!40000 ALTER TABLE `user_types` DISABLE KEYS */;
INSERT INTO `user_types` VALUES (1,'Admin','2017-06-14 23:24:20','2017-06-14 23:24:20'),(2,'Professor','2017-06-14 23:24:20','2017-06-14 23:24:20');
/*!40000 ALTER TABLE `user_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `email_address` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `secret_question_id` bigint(20) DEFAULT NULL,
  `answer` text,
  `user_type_id` bigint(20) NOT NULL,
  `status_id` bigint(20) NOT NULL,
  `password_type_id` bigint(20) NOT NULL,
  `password_expiry_date` datetime NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `failed_login_attempt` int(11) NOT NULL,
  `failed_login_time` datetime DEFAULT NULL,
  `disable_login_failure` int(11) NOT NULL,
  `last_access` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'marc.caabay@gmail.com','mjcaabay','Marc1234$',1,'Mac',1,1,2,'2017-08-15 00:00:00','127.0.0.2',0,'2017-07-16 13:47:28',0,'2017-07-16 14:27:38','2017-06-15 11:16:11','2017-06-15 11:16:11'),(2,'john.cena@gmail.com','jcena','John1234$',1,'JC',1,2,2,'2017-07-26 00:00:00','127.0.0.1',0,NULL,0,'2017-07-16 09:50:46','2017-06-26 18:03:02','2017-06-26 18:03:02');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `year_sections`
--

DROP TABLE IF EXISTS `year_sections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `year_sections` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `section` varchar(255) NOT NULL,
  `school_year_id` bigint(20) NOT NULL,
  `course_id` bigint(20) NOT NULL,
  `prof_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `year_sections`
--

LOCK TABLES `year_sections` WRITE;
/*!40000 ALTER TABLE `year_sections` DISABLE KEYS */;
INSERT INTO `year_sections` VALUES (1,'101i',1,1,0,'2017-06-27 21:24:35','2017-06-27 21:24:35'),(2,'101m',1,2,0,'2017-06-27 21:24:35','2017-06-27 21:24:35'),(3,'102i',1,1,2,'2017-06-27 21:24:35','2017-06-27 21:24:35'),(4,'102m',1,2,0,'2017-06-27 21:24:35','2017-06-27 21:24:35'),(5,'201i',1,1,2,'2017-06-27 21:24:35','2017-06-27 21:24:35'),(6,'201m',1,2,2,'2017-06-27 21:24:35','2017-06-27 21:24:35'),(7,'202i',1,1,2,'2017-06-27 21:24:35','2017-06-27 21:24:35'),(8,'202m',1,2,0,'2017-06-27 21:24:35','2017-06-27 21:24:35'),(9,'301i',1,1,0,'2017-06-27 21:24:35','2017-06-27 21:24:35'),(10,'301m',1,2,0,'2017-06-27 21:24:35','2017-06-27 21:24:35'),(11,'302i',1,1,0,'2017-06-27 21:24:35','2017-06-27 21:24:35'),(12,'302m',1,2,0,'2017-06-27 21:24:35','2017-06-27 21:24:35'),(13,'401i',1,1,0,'2017-06-27 21:24:36','2017-06-27 21:24:36'),(14,'401m',1,2,0,'2017-06-27 21:24:36','2017-06-27 21:24:36'),(15,'402i',1,1,2,'2017-06-27 21:24:36','2017-06-27 21:24:36'),(16,'402m',1,2,0,'2017-06-27 21:24:36','2017-06-27 21:24:36');
/*!40000 ALTER TABLE `year_sections` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-07-16 14:44:55
