-- MariaDB dump 10.19  Distrib 10.4.19-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: db_laravel
-- ------------------------------------------------------
-- Server version	10.4.19-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `activity_log`
--

DROP TABLE IF EXISTS `activity_log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `activity_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `log_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `subject_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `event` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `subject_id` bigint(20) unsigned DEFAULT NULL,
  `causer_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `causer_id` bigint(20) unsigned DEFAULT NULL,
  `properties` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`properties`)),
  `batch_uuid` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subject` (`subject_type`,`subject_id`),
  KEY `causer` (`causer_type`,`causer_id`),
  KEY `activity_log_log_name_index` (`log_name`)
) ENGINE=InnoDB AUTO_INCREMENT=459 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `activity_log`
--

LOCK TABLES `activity_log` WRITE;
/*!40000 ALTER TABLE `activity_log` DISABLE KEYS */;
INSERT INTO `activity_log` VALUES (1,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',482,'[]',NULL,'2021-10-29 02:30:24','2021-10-29 02:30:24'),(2,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2021-10-29 02:30:27','2021-10-29 02:30:27'),(3,'default','Ubah Data Pegawai dengan ID = 93',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2021-10-29 02:30:57','2021-10-29 02:30:57'),(4,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2021-10-29 02:31:03','2021-10-29 02:31:03'),(5,'default','Login',NULL,NULL,NULL,'App\\Models\\User',482,'[]',NULL,'2021-10-29 02:31:12','2021-10-29 02:31:12'),(6,'default','Login',NULL,NULL,NULL,'App\\Models\\User',482,'[]',NULL,'2021-10-29 02:32:48','2021-10-29 02:32:48'),(7,'default','Ubah Data Profil dengan ID = 482',NULL,NULL,NULL,'App\\Models\\User',482,'[]',NULL,'2021-10-29 02:33:32','2021-10-29 02:33:32'),(8,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',482,'[]',NULL,'2021-10-29 02:33:36','2021-10-29 02:33:36'),(9,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2021-10-29 02:33:38','2021-10-29 02:33:38'),(10,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2021-10-29 03:10:02','2021-10-29 03:10:02'),(11,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2021-10-29 03:12:09','2021-10-29 03:12:09'),(12,'default','Ubah Data Pengaturan',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2021-10-29 03:16:43','2021-10-29 03:16:43'),(13,'default','Ubah Data Pengaturan',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2021-10-29 03:16:50','2021-10-29 03:16:50'),(14,'default','Ubah Data Pengaturan',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2021-10-29 03:17:10','2021-10-29 03:17:10'),(15,'default','Ubah Data Pengaturan',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2021-10-29 03:23:12','2021-10-29 03:23:12'),(16,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2021-10-29 03:23:19','2021-10-29 03:23:19'),(17,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2021-10-29 03:23:25','2021-10-29 03:23:25'),(18,'default','Ubah Data Pengaturan',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2021-10-29 03:23:40','2021-10-29 03:23:40'),(19,'default','Ubah Data Pengaturan',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2021-10-29 03:23:45','2021-10-29 03:23:45'),(20,'default','Ubah Data Pengaturan',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2021-10-29 03:23:50','2021-10-29 03:23:50'),(21,'default','Ubah Data Pengaturan',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2021-10-29 03:23:55','2021-10-29 03:23:55'),(22,'default','Ubah Data Pengaturan',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2021-10-29 03:23:59','2021-10-29 03:23:59'),(23,'default','Ubah Data Pengaturan',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2021-10-29 03:24:03','2021-10-29 03:24:03'),(24,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2021-10-29 03:25:32','2021-10-29 03:25:32'),(25,'default','Login',NULL,NULL,NULL,'App\\Models\\User',482,'[]',NULL,'2021-10-29 03:25:39','2021-10-29 03:25:39'),(26,'default','Ubah Data Profil dengan ID = 482',NULL,NULL,NULL,'App\\Models\\User',482,'[]',NULL,'2021-10-29 03:26:56','2021-10-29 03:26:56'),(27,'default','Login',NULL,NULL,NULL,'App\\Models\\User',482,'[]',NULL,'2021-10-29 03:27:02','2021-10-29 03:27:02'),(28,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',482,'[]',NULL,'2021-10-29 03:46:26','2021-10-29 03:46:26'),(29,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2021-10-29 06:15:38','2021-10-29 06:15:38'),(30,'default','Ubah Data Pengaturan',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2021-10-29 06:18:08','2021-10-29 06:18:08'),(31,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2021-10-29 06:18:12','2021-10-29 06:18:12'),(32,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2021-10-29 06:29:41','2021-10-29 06:29:41'),(33,'default','Tambah Data Pegawai',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2021-10-29 06:30:33','2021-10-29 06:30:33'),(34,'default','Ubah Data Pegawai dengan ID = 97',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2021-10-29 06:30:48','2021-10-29 06:30:48'),(35,'default','Ubah Data Pegawai dengan ID = 97',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2021-10-29 06:33:39','2021-10-29 06:33:39'),(36,'default','Ubah Data Pegawai dengan ID = 97',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2021-10-29 06:35:31','2021-10-29 06:35:31'),(37,'default','Ubah Data Pegawai dengan ID = 97',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2021-10-29 06:35:48','2021-10-29 06:35:48'),(38,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2021-10-31 15:24:55','2021-10-31 15:24:55'),(39,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2021-10-31 23:55:21','2021-10-31 23:55:21'),(40,'default','Ubah Data Profil dengan ID = 1',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2021-10-31 23:57:18','2021-10-31 23:57:18'),(41,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2021-12-16 06:57:54','2021-12-16 06:57:54'),(42,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2021-12-16 06:58:01','2021-12-16 06:58:01'),(43,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-11 02:56:11','2022-01-11 02:56:11'),(44,'default','Ubah Data Profil dengan ID = 1',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-11 02:56:32','2022-01-11 02:56:32'),(45,'default','Tambah Data Group',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-11 04:59:37','2022-01-11 04:59:37'),(46,'default','Tambah Data Group',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-11 05:01:48','2022-01-11 05:01:48'),(47,'default','Tambah Data Group',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-11 05:01:57','2022-01-11 05:01:57'),(48,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-11 06:28:42','2022-01-11 06:28:42'),(49,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-11 06:56:59','2022-01-11 06:56:59'),(50,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-11 06:57:20','2022-01-11 06:57:20'),(51,'default','Ubah Data User dengan ID = 482',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-11 06:57:53','2022-01-11 06:57:53'),(52,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-11 06:57:56','2022-01-11 06:57:56'),(53,'default','Login',NULL,NULL,NULL,'App\\Models\\User',482,'[]',NULL,'2022-01-11 06:58:06','2022-01-11 06:58:06'),(54,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',482,'[]',NULL,'2022-01-11 07:32:51','2022-01-11 07:32:51'),(55,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-11 07:32:54','2022-01-11 07:32:54'),(56,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-12 02:01:34','2022-01-12 02:01:34'),(57,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-12 02:05:59','2022-01-12 02:05:59'),(58,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-12 02:06:01','2022-01-12 02:06:01'),(59,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-12 02:11:35','2022-01-12 02:11:35'),(60,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-12 02:11:53','2022-01-12 02:11:53'),(61,'default','Tambah Data Menu',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-12 02:51:15','2022-01-12 02:51:15'),(62,'default','Tambah Data Menu',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-12 02:52:26','2022-01-12 02:52:26'),(63,'default','Ubah Data Menu dengan ID = 4',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-12 03:02:21','2022-01-12 03:02:21'),(64,'default','Ubah Data Menu dengan ID = 4',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-12 03:02:25','2022-01-12 03:02:25'),(65,'default','Ubah Data Menu dengan ID = 4',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-12 03:02:30','2022-01-12 03:02:30'),(66,'default','Ubah Data Menu dengan ID = 4',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-12 03:02:41','2022-01-12 03:02:41'),(67,'default','Tambah Data Menu',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-12 03:04:48','2022-01-12 03:04:48'),(68,'default','Tambah Data Menu',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-12 03:05:31','2022-01-12 03:05:31'),(69,'default','Ubah Data Menu dengan ID = 4',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-12 03:11:39','2022-01-12 03:11:39'),(70,'default','Ubah Data Menu dengan ID = 4',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-12 03:11:44','2022-01-12 03:11:44'),(71,'default','Tambah Data Sub Menu',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-12 05:28:40','2022-01-12 05:28:40'),(72,'default','Tambah Data Sub Menu',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-12 05:29:55','2022-01-12 05:29:55'),(73,'default','Tambah Data Sub Menu',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-12 05:31:59','2022-01-12 05:31:59'),(74,'default','Ubah Data Sub Menu dengan ID = 1',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-12 05:39:50','2022-01-12 05:39:50'),(75,'default','Ubah Data Sub Menu dengan ID = 1',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-12 05:39:56','2022-01-12 05:39:56'),(76,'default','Ubah Data Sub Menu dengan ID = 1',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-12 05:40:07','2022-01-12 05:40:07'),(77,'default','Tambah Data Sub Menu',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-12 05:42:20','2022-01-12 05:42:20'),(78,'default','Tambah Data Sub Menu',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-12 05:43:01','2022-01-12 05:43:01'),(79,'default','Tambah Data Sub Menu',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-12 05:43:18','2022-01-12 05:43:18'),(80,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-13 02:13:03','2022-01-13 02:13:03'),(81,'default','Tambah Data Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-13 03:00:18','2022-01-13 03:00:18'),(82,'default','Tambah Data Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-13 03:00:23','2022-01-13 03:00:23'),(83,'default','Tambah Data Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-13 03:02:25','2022-01-13 03:02:25'),(84,'default','Ubah Data Sub Menu dengan ID = 1',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-13 06:22:51','2022-01-13 06:22:51'),(85,'default','Ubah Data Sub Menu dengan ID = 1',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-13 06:23:00','2022-01-13 06:23:00'),(86,'default','Tambah Data Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-13 06:35:05','2022-01-13 06:35:05'),(87,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-13 06:43:16','2022-01-13 06:43:16'),(88,'default','Login',NULL,NULL,NULL,'App\\Models\\User',482,'[]',NULL,'2022-01-13 06:43:27','2022-01-13 06:43:27'),(89,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',482,'[]',NULL,'2022-01-13 06:43:58','2022-01-13 06:43:58'),(90,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-13 06:44:02','2022-01-13 06:44:02'),(91,'default','Tambah Data Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-13 06:44:29','2022-01-13 06:44:29'),(92,'default','Tambah Data Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-13 06:44:57','2022-01-13 06:44:57'),(93,'default','Ubah Data Pengaturan',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-13 07:38:53','2022-01-13 07:38:53'),(94,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-14 01:56:30','2022-01-14 01:56:30'),(95,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-14 02:20:21','2022-01-14 02:20:21'),(96,'default','Login',NULL,NULL,NULL,'App\\Models\\User',482,'[]',NULL,'2022-01-14 02:20:30','2022-01-14 02:20:30'),(97,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',482,'[]',NULL,'2022-01-14 02:20:40','2022-01-14 02:20:40'),(98,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-14 02:20:43','2022-01-14 02:20:43'),(99,'default','Tambah Data Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-14 02:21:01','2022-01-14 02:21:01'),(100,'default','Login',NULL,NULL,NULL,'App\\Models\\User',482,'[]',NULL,'2022-01-14 02:21:29','2022-01-14 02:21:29'),(101,'default','Ubah Data Menu dengan ID = 2',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-14 03:51:12','2022-01-14 03:51:12'),(102,'default','Ubah Data Menu dengan ID = 2',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-14 03:51:16','2022-01-14 03:51:16'),(103,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-14 06:57:06','2022-01-14 06:57:06'),(104,'default','Ubah Data Menu Akses dengan ID = 4',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-14 08:21:19','2022-01-14 08:21:19'),(105,'default','Ubah Data Menu Akses dengan ID = 4',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-14 08:21:43','2022-01-14 08:21:43'),(106,'default','Ubah Data Menu Akses dengan ID = 5',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-14 08:23:05','2022-01-14 08:23:05'),(107,'default','Ubah Data Menu Akses dengan ID = 4',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-14 08:23:23','2022-01-14 08:23:23'),(108,'default','Hapus Data Menu Akses dengan ID = 3',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-14 08:27:11','2022-01-14 08:27:11'),(109,'default','Tambah Data Menu Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-14 08:27:55','2022-01-14 08:27:55'),(110,'default','Tambah Data Sub Menu Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-14 09:23:31','2022-01-14 09:23:31'),(111,'default','Tambah Data Sub Menu Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-14 09:26:16','2022-01-14 09:26:16'),(112,'default','Tambah Data Sub Menu Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-14 09:26:47','2022-01-14 09:26:47'),(113,'default','Hapus Data Sub Menu Akses dengan ID = ',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-14 09:31:27','2022-01-14 09:31:27'),(114,'default','Hapus Data Sub Menu Akses dengan ID = ',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-14 09:32:28','2022-01-14 09:32:28'),(115,'default','Hapus Data Sub Menu Akses dengan ID = ',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-14 09:34:29','2022-01-14 09:34:29'),(116,'default','Hapus Data Sub Menu Akses dengan ID = 1',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-14 09:35:23','2022-01-14 09:35:23'),(117,'default','Ubah Data Sub Menu Akses dengan ID = 2',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-14 09:54:54','2022-01-14 09:54:54'),(118,'default','Ubah Data Sub Menu Akses dengan ID = 2',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-14 09:54:59','2022-01-14 09:54:59'),(119,'default','Ubah Data Sub Menu Akses dengan ID = 2',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-14 09:55:05','2022-01-14 09:55:05'),(120,'default','Hapus Data Menu dengan ID = 1',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-14 09:57:33','2022-01-14 09:57:33'),(121,'default','Hapus Data Menu dengan ID = 2',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-14 09:57:59','2022-01-14 09:57:59'),(122,'default','Hapus Data Menu dengan ID = 3',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-14 09:58:02','2022-01-14 09:58:02'),(123,'default','Tambah Data Menu',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-14 09:59:00','2022-01-14 09:59:00'),(124,'default','Tambah Data Menu Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-14 09:59:17','2022-01-14 09:59:17'),(125,'default','Tambah Data Menu',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-14 10:22:35','2022-01-14 10:22:35'),(126,'default','Tambah Data Menu Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-14 10:23:01','2022-01-14 10:23:01'),(127,'default','Ubah Data Menu dengan ID = 6',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-14 10:23:13','2022-01-14 10:23:13'),(128,'default','Ubah Data Pengaturan',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-14 11:11:47','2022-01-14 11:11:47'),(129,'default','Ubah Data Menu dengan ID = 5',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-14 11:12:19','2022-01-14 11:12:19'),(130,'default','Ubah Data Menu dengan ID = 5',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-14 11:12:32','2022-01-14 11:12:32'),(131,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-14 11:12:52','2022-01-14 11:12:52'),(132,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-14 11:54:24','2022-01-14 11:54:24'),(133,'default','Ubah Data Pengaturan',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-14 12:00:55','2022-01-14 12:00:55'),(134,'default','Ubah Data Sub Menu dengan ID = 6',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-14 12:01:35','2022-01-14 12:01:35'),(135,'default','Ubah Data Sub Menu dengan ID = 6',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-14 12:01:44','2022-01-14 12:01:44'),(136,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-15 09:29:42','2022-01-15 09:29:42'),(137,'default','Tambah Data Menu',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-15 09:31:03','2022-01-15 09:31:03'),(138,'default','Tambah Data Sub Menu',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-15 09:39:32','2022-01-15 09:39:32'),(139,'default','Tambah Data Menu Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-15 09:46:20','2022-01-15 09:46:20'),(140,'default','Tambah Data Sub Menu Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-15 10:02:06','2022-01-15 10:02:06'),(141,'default','Hapus Data Sub Menu Akses dengan ID = 3',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-15 10:07:48','2022-01-15 10:07:48'),(142,'default','Tambah Data Sub Menu Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-15 11:29:04','2022-01-15 11:29:04'),(143,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-15 14:15:57','2022-01-15 14:15:57'),(144,'default','Ubah Data Sub Menu Akses dengan ID = 13',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-15 14:25:25','2022-01-15 14:25:25'),(145,'default','Ubah Data Sub Menu Akses dengan ID = 13',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-15 14:27:54','2022-01-15 14:27:54'),(146,'default','Ubah Data Sub Menu Akses dengan ID = 13',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-15 14:28:01','2022-01-15 14:28:01'),(147,'default','Ubah Data Sub Menu Akses dengan ID = 13',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-15 14:28:09','2022-01-15 14:28:09'),(148,'default','Ubah Data Sub Menu Akses dengan ID = 13',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-15 14:28:16','2022-01-15 14:28:16'),(149,'default','Ubah Data Sub Menu Akses dengan ID = 13',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-15 14:28:25','2022-01-15 14:28:25'),(150,'default','Ubah Data Sub Menu Akses dengan ID = 13',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-15 14:28:34','2022-01-15 14:28:34'),(151,'default','Ubah Data Sub Menu Akses dengan ID = 13',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-15 14:28:40','2022-01-15 14:28:40'),(152,'default','Tambah Data Sub Menu Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-15 14:28:54','2022-01-15 14:28:54'),(153,'default','Tambah Data Sub Menu Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-15 14:29:05','2022-01-15 14:29:05'),(154,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-15 16:29:15','2022-01-15 16:29:15'),(155,'default','Tambah Data Sub Menu Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-15 16:34:34','2022-01-15 16:34:34'),(156,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-16 00:52:03','2022-01-16 00:52:03'),(157,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-16 00:52:34','2022-01-16 00:52:34'),(158,'default','Login',NULL,NULL,NULL,'App\\Models\\User',482,'[]',NULL,'2022-01-16 00:52:41','2022-01-16 00:52:41'),(159,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-16 03:39:18','2022-01-16 03:39:18'),(160,'default','Login',NULL,NULL,NULL,'App\\Models\\User',482,'[]',NULL,'2022-01-16 04:05:51','2022-01-16 04:05:51'),(161,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-16 10:13:45','2022-01-16 10:13:45'),(162,'default','Tambah Data Menu',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-16 10:43:46','2022-01-16 10:43:46'),(163,'default','Ubah Data Menu dengan ID = 4',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-16 10:44:21','2022-01-16 10:44:21'),(164,'default','Tambah Data Menu Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-16 10:48:47','2022-01-16 10:48:47'),(165,'default','Hapus Data Menu dengan ID = 8',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-16 10:49:24','2022-01-16 10:49:24'),(166,'default','Ubah Data Menu dengan ID = 4',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-16 10:50:22','2022-01-16 10:50:22'),(167,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-17 02:48:51','2022-01-17 02:48:51'),(168,'default','Tambah Data Sub Menu Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-17 02:50:06','2022-01-17 02:50:06'),(169,'default','Tambah Data Sub Menu Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-17 02:50:22','2022-01-17 02:50:22'),(170,'default','Tambah Data Menu',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-17 02:50:48','2022-01-17 02:50:48'),(171,'default','Hapus Data Menu dengan ID = 9',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-17 02:51:16','2022-01-17 02:51:16'),(172,'default','Tambah Data Sub Menu Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-17 02:51:55','2022-01-17 02:51:55'),(173,'default','Tambah Data Menu',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-17 02:53:20','2022-01-17 02:53:20'),(174,'default','Tambah Data Menu Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-17 02:53:37','2022-01-17 02:53:37'),(175,'default','Hapus Data Menu dengan ID = 10',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-17 02:54:29','2022-01-17 02:54:29'),(176,'default','Tambah Data Menu',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-17 02:56:51','2022-01-17 02:56:51'),(177,'default','Tambah Data Sub Menu Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-17 02:57:44','2022-01-17 02:57:44'),(178,'default','Tambah Data Sub Menu Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-17 02:57:56','2022-01-17 02:57:56'),(179,'default','Tambah Data Sub Menu Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-17 02:58:06','2022-01-17 02:58:06'),(180,'default','Tambah Data Menu Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-17 02:58:18','2022-01-17 02:58:18'),(181,'default','Hapus Data Menu dengan ID = 11',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-17 02:59:12','2022-01-17 02:59:12'),(182,'default','Tambah Data Menu',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-17 02:59:32','2022-01-17 02:59:32'),(183,'default','Tambah Data Sub Menu',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-17 02:59:46','2022-01-17 02:59:46'),(184,'default','Tambah Data Menu Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-17 03:00:28','2022-01-17 03:00:28'),(185,'default','Ubah Data Menu Akses dengan ID = 9',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-17 03:00:44','2022-01-17 03:00:44'),(186,'default','Tambah Data Sub Menu Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-17 03:00:57','2022-01-17 03:00:57'),(187,'default','Hapus Data Sub Menu Akses dengan ID = 23',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-17 03:01:05','2022-01-17 03:01:05'),(188,'default','Tambah Data Sub Menu Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-17 03:01:16','2022-01-17 03:01:16'),(189,'default','Ubah Data Sub Menu Akses dengan ID = 24',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-17 03:01:20','2022-01-17 03:01:20'),(190,'default','Hapus Data Menu Akses dengan ID = 9',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-17 03:02:06','2022-01-17 03:02:06'),(191,'default','Tambah Data Sub Menu Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-17 03:07:17','2022-01-17 03:07:17'),(192,'default','Login',NULL,NULL,NULL,'App\\Models\\User',482,'[]',NULL,'2022-01-17 03:10:26','2022-01-17 03:10:26'),(193,'default','Tambah Data Menu Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-17 03:11:56','2022-01-17 03:11:56'),(194,'default','Tambah Data Sub Menu Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-17 03:12:16','2022-01-17 03:12:16'),(195,'default','Ubah Data Menu Akses dengan ID = 8',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-17 03:18:27','2022-01-17 03:18:27'),(196,'default','Ubah Data Menu Akses dengan ID = 8',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-17 03:18:37','2022-01-17 03:18:37'),(197,'default','Ubah Data Sub Menu Akses dengan ID = 21',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-17 03:30:08','2022-01-17 03:30:08'),(198,'default','Ubah Data Sub Menu Akses dengan ID = 21',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-17 03:30:19','2022-01-17 03:30:19'),(199,'default','Ubah Data Sub Menu Akses dengan ID = 21',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-17 03:30:29','2022-01-17 03:30:29'),(200,'default','Ubah Data Sub Menu Akses dengan ID = 21',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-17 03:30:40','2022-01-17 03:30:40'),(201,'default','Hapus Data Menu dengan ID = 12',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-17 03:31:16','2022-01-17 03:31:16'),(202,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-17 06:28:53','2022-01-17 06:28:53'),(203,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-17 06:52:02','2022-01-17 06:52:02'),(204,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-18 02:38:00','2022-01-18 02:38:00'),(205,'default','Tambah Data Group',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-18 02:38:17','2022-01-18 02:38:17'),(206,'default','Ubah Data Group dengan ID = 3',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-18 02:41:41','2022-01-18 02:41:41'),(207,'default','Tambah Data User',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-18 02:47:10','2022-01-18 02:47:10'),(208,'default','Ubah Data User dengan ID = 483',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-18 02:57:18','2022-01-18 02:57:18'),(209,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-18 05:41:46','2022-01-18 05:41:46'),(210,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-01-18 06:05:28','2022-01-18 06:05:28'),(211,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-02-18 01:08:52','2022-02-18 01:08:52'),(212,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-02-18 01:09:12','2022-02-18 01:09:12'),(213,'default','Tambah Data Menu',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-02-18 01:16:32','2022-02-18 01:16:32'),(214,'default','Tambah Data Sub Menu',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-02-18 01:16:58','2022-02-18 01:16:58'),(215,'default','Tambah Data Sub Menu',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-02-18 01:17:10','2022-02-18 01:17:10'),(216,'default','Ubah Data Menu dengan ID = 4',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-02-18 01:17:34','2022-02-18 01:17:34'),(217,'default','Ubah Data Menu dengan ID = 5',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-02-18 01:17:39','2022-02-18 01:17:39'),(218,'default','Ubah Data Menu dengan ID = 6',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-02-18 01:17:47','2022-02-18 01:17:47'),(219,'default','Ubah Data Menu dengan ID = 6',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-02-18 01:18:18','2022-02-18 01:18:18'),(220,'default','Ubah Data Menu dengan ID = 13',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-02-18 01:18:25','2022-02-18 01:18:25'),(221,'default','Tambah Data Menu Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-02-18 01:25:25','2022-02-18 01:25:25'),(222,'default','Tambah Data Sub Menu Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-02-18 01:25:42','2022-02-18 01:25:42'),(223,'default','Tambah Data Sub Menu Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-02-18 01:25:54','2022-02-18 01:25:54'),(224,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-02-18 05:17:34','2022-02-18 05:17:34'),(225,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-02-18 10:53:02','2022-02-18 10:53:02'),(226,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-02-18 10:54:33','2022-02-18 10:54:33'),(227,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-02-20 11:08:56','2022-02-20 11:08:56'),(228,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-02-20 11:11:06','2022-02-20 11:11:06'),(229,'default','Hapus Data Pegawai dengan ID = 98',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-02-20 11:31:06','2022-02-20 11:31:06'),(230,'default','Hapus Data Pegawai dengan ID = 99',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-02-20 11:31:26','2022-02-20 11:31:26'),(231,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-02-20 11:37:32','2022-02-20 11:37:32'),(232,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-02-20 11:57:54','2022-02-20 11:57:54'),(233,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-02-20 11:59:01','2022-02-20 11:59:01'),(234,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-02-20 12:01:00','2022-02-20 12:01:00'),(235,'default','Ubah Data User dengan ID = 484',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-02-20 12:02:17','2022-02-20 12:02:17'),(236,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-02-20 12:02:23','2022-02-20 12:02:23'),(237,'default','Login',NULL,NULL,NULL,'App\\Models\\User',484,'[]',NULL,'2022-02-20 12:02:29','2022-02-20 12:02:29'),(238,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',484,'[]',NULL,'2022-02-20 12:02:34','2022-02-20 12:02:34'),(239,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 02:12:52','2022-03-01 02:12:52'),(240,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 02:33:28','2022-03-01 02:33:28'),(241,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 02:49:53','2022-03-01 02:49:53'),(242,'default','Ubah Data User dengan ID = 483',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 02:50:27','2022-03-01 02:50:27'),(243,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 02:50:36','2022-03-01 02:50:36'),(244,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 03:44:42','2022-03-01 03:44:42'),(245,'default','Hapus Data User dengan ID = 486',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 03:45:10','2022-03-01 03:45:10'),(246,'default','Hapus Data User dengan ID = 487',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 03:47:20','2022-03-01 03:47:20'),(247,'default','Hapus Data User dengan ID = 488',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 03:50:22','2022-03-01 03:50:22'),(248,'default','Hapus Data User dengan ID = 489',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 04:06:28','2022-03-01 04:06:28'),(249,'default','Hapus Data User dengan ID = 490',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 04:11:39','2022-03-01 04:11:39'),(250,'default','Hapus Data User dengan ID = 492',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 04:25:03','2022-03-01 04:25:03'),(251,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 04:42:26','2022-03-01 04:42:26'),(252,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 04:42:56','2022-03-01 04:42:56'),(253,'default','Hapus Data User dengan ID = 493',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 04:43:10','2022-03-01 04:43:10'),(254,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 06:11:48','2022-03-01 06:11:48'),(255,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 06:16:03','2022-03-01 06:16:03'),(256,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 06:16:31','2022-03-01 06:16:31'),(257,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',495,'[]',NULL,'2022-03-01 06:18:09','2022-03-01 06:18:09'),(258,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 06:18:28','2022-03-01 06:18:28'),(259,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 06:18:36','2022-03-01 06:18:36'),(260,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 06:19:15','2022-03-01 06:19:15'),(261,'default','Hapus Data User dengan ID = 495',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 06:19:26','2022-03-01 06:19:26'),(262,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 06:20:18','2022-03-01 06:20:18'),(263,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 06:20:20','2022-03-01 06:20:20'),(264,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 06:21:47','2022-03-01 06:21:47'),(265,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',496,'[]',NULL,'2022-03-01 06:23:10','2022-03-01 06:23:10'),(266,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 06:23:13','2022-03-01 06:23:13'),(267,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 07:48:09','2022-03-01 07:48:09'),(268,'default','Hapus Data User dengan ID = 496',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 07:49:12','2022-03-01 07:49:12'),(269,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 07:52:37','2022-03-01 07:52:37'),(270,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 07:53:06','2022-03-01 07:53:06'),(271,'default','Hapus Data User dengan ID = 497',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 07:53:33','2022-03-01 07:53:33'),(272,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 07:53:37','2022-03-01 07:53:37'),(273,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',498,'[]',NULL,'2022-03-01 07:54:10','2022-03-01 07:54:10'),(274,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 07:54:13','2022-03-01 07:54:13'),(275,'default','Hapus Data User dengan ID = 498',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 07:54:20','2022-03-01 07:54:20'),(276,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 07:54:39','2022-03-01 07:54:39'),(277,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',499,'[]',NULL,'2022-03-01 07:56:24','2022-03-01 07:56:24'),(278,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 07:56:27','2022-03-01 07:56:27'),(279,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 08:13:38','2022-03-01 08:13:38'),(280,'default','Hapus Data User dengan ID = 499',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 08:14:25','2022-03-01 08:14:25'),(281,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 08:14:29','2022-03-01 08:14:29'),(282,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',500,'[]',NULL,'2022-03-01 08:17:12','2022-03-01 08:17:12'),(283,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 08:17:14','2022-03-01 08:17:14'),(284,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 08:17:20','2022-03-01 08:17:20'),(285,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 08:17:25','2022-03-01 08:17:25'),(286,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 08:17:32','2022-03-01 08:17:32'),(287,'default','Hapus Data User dengan ID = 500',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 08:18:01','2022-03-01 08:18:01'),(288,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 08:18:07','2022-03-01 08:18:07'),(289,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',501,'[]',NULL,'2022-03-01 08:19:25','2022-03-01 08:19:25'),(290,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 08:19:27','2022-03-01 08:19:27'),(291,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 08:19:51','2022-03-01 08:19:51'),(292,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 08:19:53','2022-03-01 08:19:53'),(293,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 08:20:00','2022-03-01 08:20:00'),(294,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 08:20:02','2022-03-01 08:20:02'),(295,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 08:22:07','2022-03-01 08:22:07'),(296,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 08:24:17','2022-03-01 08:24:17'),(297,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 08:24:42','2022-03-01 08:24:42'),(298,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 08:25:19','2022-03-01 08:25:19'),(299,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',502,'[]',NULL,'2022-03-01 08:27:22','2022-03-01 08:27:22'),(300,'default','Login',NULL,NULL,NULL,'App\\Models\\User',502,'[]',NULL,'2022-03-01 08:27:29','2022-03-01 08:27:29'),(301,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',502,'[]',NULL,'2022-03-01 08:27:37','2022-03-01 08:27:37'),(302,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 08:27:40','2022-03-01 08:27:40'),(303,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 08:27:52','2022-03-01 08:27:52'),(304,'default','Login',NULL,NULL,NULL,'App\\Models\\User',502,'[]',NULL,'2022-03-01 08:27:59','2022-03-01 08:27:59'),(305,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',502,'[]',NULL,'2022-03-01 08:29:34','2022-03-01 08:29:34'),(306,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 08:29:41','2022-03-01 08:29:41'),(307,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 08:30:14','2022-03-01 08:30:14'),(308,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 08:30:16','2022-03-01 08:30:16'),(309,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 08:31:29','2022-03-01 08:31:29'),(310,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-01 08:34:44','2022-03-01 08:34:44'),(311,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-02 02:21:11','2022-03-02 02:21:11'),(312,'default','Tambah Data Menu',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-02 02:38:46','2022-03-02 02:38:46'),(313,'default','Ubah Data Menu dengan ID = 4',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-02 02:39:12','2022-03-02 02:39:12'),(314,'default','Ubah Data Menu dengan ID = 14',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-02 02:39:20','2022-03-02 02:39:20'),(315,'default','Ubah Data Menu dengan ID = 14',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-02 02:40:34','2022-03-02 02:40:34'),(316,'default','Tambah Data Menu Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-02 02:40:51','2022-03-02 02:40:51'),(317,'default','Ubah Data Menu dengan ID = 14',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-02 02:44:57','2022-03-02 02:44:57'),(318,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-02 02:54:21','2022-03-02 02:54:21'),(319,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-02 03:07:29','2022-03-02 03:07:29'),(320,'default','Login',NULL,NULL,NULL,'App\\Models\\User',503,'[]',NULL,'2022-03-02 03:09:35','2022-03-02 03:09:35'),(321,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',503,'[]',NULL,'2022-03-02 03:09:55','2022-03-02 03:09:55'),(322,'default','Login',NULL,NULL,NULL,'App\\Models\\User',503,'[]',NULL,'2022-03-02 03:11:54','2022-03-02 03:11:54'),(323,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',503,'[]',NULL,'2022-03-02 03:13:24','2022-03-02 03:13:24'),(324,'default','Login',NULL,NULL,NULL,'App\\Models\\User',503,'[]',NULL,'2022-03-02 03:13:40','2022-03-02 03:13:40'),(325,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-02 03:14:05','2022-03-02 03:14:05'),(326,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-02 03:14:07','2022-03-02 03:14:07'),(327,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-02 03:14:13','2022-03-02 03:14:13'),(328,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-02 03:14:15','2022-03-02 03:14:15'),(329,'default','Hapus Data Pegawai dengan ID = 100',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-02 04:19:16','2022-03-02 04:19:16'),(330,'default','Hapus Data User dengan ID = 502',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-02 04:28:03','2022-03-02 04:28:03'),(331,'default','Ubah Data Profil dengan ID = 1',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-02 04:29:20','2022-03-02 04:29:20'),(332,'default','Ubah Data Pegawai dengan ID = 97',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-02 04:33:26','2022-03-02 04:33:26'),(333,'default','Ubah Data Pegawai dengan ID = 97',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-02 04:33:34','2022-03-02 04:33:34'),(334,'default','Ubah Data Pegawai dengan ID = 97',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-02 04:33:44','2022-03-02 04:33:44'),(335,'default','Ubah Data User dengan ID = 485',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-02 04:34:58','2022-03-02 04:34:58'),(336,'default','Ubah Data User dengan ID = 485',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-02 04:36:11','2022-03-02 04:36:11'),(337,'default','Hapus Data User dengan ID = 485',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-02 04:36:15','2022-03-02 04:36:15'),(338,'default','Ubah Data Group dengan ID = 3',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-02 05:28:42','2022-03-02 05:28:42'),(339,'default','Tambah Data Menu Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-02 07:56:25','2022-03-02 07:56:25'),(340,'default','Ubah Data Menu Akses dengan ID = 17',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-02 07:56:34','2022-03-02 07:56:34'),(341,'default','Hapus Data Menu Akses dengan ID = 17',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-02 07:56:45','2022-03-02 07:56:45'),(342,'default','Tambah Data Menu Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-02 07:56:59','2022-03-02 07:56:59'),(343,'default','Tambah Data Sub Menu Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-02 08:04:04','2022-03-02 08:04:04'),(344,'default','Ubah Data Sub Menu Akses dengan ID = 29',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-02 08:04:18','2022-03-02 08:04:18'),(345,'default','Hapus Data Sub Menu Akses dengan ID = 29',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-02 08:04:36','2022-03-02 08:04:36'),(346,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-02 08:08:09','2022-03-02 08:08:09'),(347,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-02 08:08:11','2022-03-02 08:08:11'),(348,'default','Tambah Data Sub Menu Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-02 08:09:38','2022-03-02 08:09:38'),(349,'default','Tambah Data Sub Menu Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-02 08:09:51','2022-03-02 08:09:51'),(350,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-07 02:29:51','2022-03-07 02:29:51'),(351,'default','Tambah Data Menu Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-07 02:35:11','2022-03-07 02:35:11'),(352,'default','Ubah Data Menu Akses dengan ID = 19',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-07 02:35:51','2022-03-07 02:35:51'),(353,'default','Ubah Data Menu Akses dengan ID = 19',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-07 02:36:38','2022-03-07 02:36:38'),(354,'default','Hapus Data Menu Akses dengan ID = 19',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-07 02:37:23','2022-03-07 02:37:23'),(355,'default','Tambah Data Sub Menu Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-07 02:37:59','2022-03-07 02:37:59'),(356,'default','Ubah Data Sub Menu Akses dengan ID = 35',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-07 02:38:05','2022-03-07 02:38:05'),(357,'default','Ubah Data Sub Menu Akses dengan ID = 35',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-07 02:38:14','2022-03-07 02:38:14'),(358,'default','Hapus Data Sub Menu Akses dengan ID = 35',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-07 02:38:24','2022-03-07 02:38:24'),(359,'default','Ubah Data Menu dengan ID = 7',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-07 02:41:51','2022-03-07 02:41:51'),(360,'default','Ubah Data Menu dengan ID = 7',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-07 02:41:59','2022-03-07 02:41:59'),(361,'default','Tambah Data Sub Menu',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-07 02:51:22','2022-03-07 02:51:22'),(362,'default','Ubah Data Sub Menu dengan ID = 13',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-07 02:54:17','2022-03-07 02:54:17'),(363,'default','Ubah Data Sub Menu dengan ID = 13',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-07 02:54:24','2022-03-07 02:54:24'),(364,'default','Ubah Data Sub Menu dengan ID = 13',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-07 02:55:08','2022-03-07 02:55:08'),(365,'default','Ubah Data Sub Menu dengan ID = 13',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-07 02:55:21','2022-03-07 02:55:21'),(366,'default','Ubah Data Sub Menu dengan ID = 9',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-07 02:56:22','2022-03-07 02:56:22'),(367,'default','Ubah Data Sub Menu dengan ID = 13',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-07 02:56:29','2022-03-07 02:56:29'),(368,'default','Hapus Data Sub Menu dengan ID = 13',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-07 02:58:12','2022-03-07 02:58:12'),(369,'default','Tambah Data Sub Menu Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-07 03:00:22','2022-03-07 03:00:22'),(370,'default','Ubah Data Sub Menu Akses dengan ID = 36',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-07 03:02:28','2022-03-07 03:02:28'),(371,'default','Ubah Data Sub Menu Akses dengan ID = 36',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-07 03:04:59','2022-03-07 03:04:59'),(372,'default','Ubah Data Sub Menu Akses dengan ID = 36',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-07 03:05:33','2022-03-07 03:05:33'),(373,'default','Ubah Data Sub Menu Akses dengan ID = 36',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-07 03:05:53','2022-03-07 03:05:53'),(374,'default','Ubah Data Sub Menu Akses dengan ID = 36',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-07 03:07:18','2022-03-07 03:07:18'),(375,'default','Ubah Data Sub Menu Akses dengan ID = 36',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-07 03:08:12','2022-03-07 03:08:12'),(376,'default','Hapus Data Sub Menu Akses dengan ID = 36',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-07 03:08:16','2022-03-07 03:08:16'),(377,'default','Ubah Data Group dengan ID = 3',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-07 03:10:29','2022-03-07 03:10:29'),(378,'default','Ubah Data Menu dengan ID = 13',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-07 03:11:06','2022-03-07 03:11:06'),(379,'default','Ubah Data Profil dengan ID = 1',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-07 03:11:54','2022-03-07 03:11:54'),(380,'default','Ubah Data Profil dengan ID = 1',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-07 03:12:26','2022-03-07 03:12:26'),(381,'default','Ubah Data Profil dengan ID = 1',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-07 03:13:40','2022-03-07 03:13:40'),(382,'default','Ubah Data User dengan ID = 484',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-07 03:13:58','2022-03-07 03:13:58'),(383,'default','Hapus Data User dengan ID = 484',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-07 03:14:07','2022-03-07 03:14:07'),(384,'default','Tambah Data Sub Menu Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-07 03:16:20','2022-03-07 03:16:20'),(385,'default','Ubah Data Sub Menu Akses dengan ID = 38',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-07 03:16:48','2022-03-07 03:16:48'),(386,'default','Hapus Data Sub Menu Akses dengan ID = 38',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-07 03:16:51','2022-03-07 03:16:51'),(387,'default','Ubah Data Menu Akses dengan ID = 18',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-07 03:18:09','2022-03-07 03:18:09'),(388,'default','Ubah Data Sub Menu dengan ID = 9',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-07 03:19:56','2022-03-07 03:19:56'),(389,'default','Tambah Data Sub Menu',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-07 03:20:06','2022-03-07 03:20:06'),(390,'default','Ubah Data Sub Menu dengan ID = 14',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-07 03:20:12','2022-03-07 03:20:12'),(391,'default','Hapus Data Sub Menu dengan ID = 14',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-07 03:20:17','2022-03-07 03:20:17'),(392,'default','Ubah Data Pegawai dengan ID = 97',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-07 03:22:26','2022-03-07 03:22:26'),(393,'default','Hapus Data Pegawai dengan ID = 97',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-07 03:22:30','2022-03-07 03:22:30'),(394,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-07 03:29:17','2022-03-07 03:29:17'),(395,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-08 01:20:10','2022-03-08 01:20:10'),(396,'default','Tambah Data Group',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-08 01:22:30','2022-03-08 01:22:30'),(397,'default','Tambah Data Menu Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-08 01:22:50','2022-03-08 01:22:50'),(398,'default','Tambah Data Sub Menu Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-08 01:23:11','2022-03-08 01:23:11'),(399,'default','Ubah Data Sub Menu Akses dengan ID = 39',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-08 01:23:18','2022-03-08 01:23:18'),(400,'default','Hapus Data Sub Menu Akses dengan ID = 39',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-08 01:23:30','2022-03-08 01:23:30'),(401,'default','Ubah Data Menu Akses dengan ID = 20',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-08 01:23:51','2022-03-08 01:23:51'),(402,'default','Hapus Data Menu Akses dengan ID = 20',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-08 01:24:02','2022-03-08 01:24:02'),(403,'default','Tambah Data Sub Menu Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-08 01:27:50','2022-03-08 01:27:50'),(404,'default','Tambah Data Sub Menu Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-08 01:28:05','2022-03-08 01:28:05'),(405,'default','Tambah Data Menu Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-08 01:29:10','2022-03-08 01:29:10'),(406,'default','Hapus Data Menu Akses dengan ID = 21',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-08 01:30:29','2022-03-08 01:30:29'),(407,'default','Hapus Data Group dengan ID = 4',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-08 01:30:40','2022-03-08 01:30:40'),(408,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-08 01:35:37','2022-03-08 01:35:37'),(409,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-08 01:35:39','2022-03-08 01:35:39'),(410,'default','Ubah Data Menu dengan ID = 7',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-08 01:41:09','2022-03-08 01:41:09'),(411,'default','Tambah Data Sub Menu',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-08 01:41:20','2022-03-08 01:41:20'),(412,'default','Ubah Data Sub Menu dengan ID = 15',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-08 01:41:28','2022-03-08 01:41:28'),(413,'default','Hapus Data Sub Menu dengan ID = 15',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-08 01:41:32','2022-03-08 01:41:32'),(414,'default','Tambah Data Sub Menu Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-08 01:49:14','2022-03-08 01:49:14'),(415,'default','Hapus Data Sub Menu Akses dengan ID = 43',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-08 01:49:29','2022-03-08 01:49:29'),(416,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-08 01:53:48','2022-03-08 01:53:48'),(417,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-08 02:00:40','2022-03-08 02:00:40'),(418,'default','Ubah Data Pengaturan',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-08 02:15:22','2022-03-08 02:15:22'),(419,'default','Ubah Data Pengaturan',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-08 02:15:52','2022-03-08 02:15:52'),(420,'default','Ubah Data Pengaturan',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-08 02:15:57','2022-03-08 02:15:57'),(421,'default','Ubah Data Pengaturan',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-08 02:16:05','2022-03-08 02:16:05'),(422,'default','Ubah Data Pengaturan',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-08 02:16:13','2022-03-08 02:16:13'),(423,'default','Ubah Data Pengaturan',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-08 02:16:18','2022-03-08 02:16:18'),(424,'default','Ubah Data Menu dengan ID = 7',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-08 02:23:32','2022-03-08 02:23:32'),(425,'default','Ubah Data Pegawai dengan ID = 93',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-08 02:25:06','2022-03-08 02:25:06'),(426,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-08 02:25:10','2022-03-08 02:25:10'),(427,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-08 02:27:41','2022-03-08 02:27:41'),(428,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-08 02:27:49','2022-03-08 02:27:49'),(429,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-08 02:31:33','2022-03-08 02:31:33'),(430,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-08 02:31:42','2022-03-08 02:31:42'),(431,'default','Login',NULL,NULL,NULL,'App\\Models\\User',504,'[]',NULL,'2022-03-08 02:34:37','2022-03-08 02:34:37'),(432,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',504,'[]',NULL,'2022-03-08 02:35:30','2022-03-08 02:35:30'),(433,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',504,'[]',NULL,'2022-03-08 02:36:58','2022-03-08 02:36:58'),(434,'default','Login',NULL,NULL,NULL,'App\\Models\\User',504,'[]',NULL,'2022-03-08 02:37:06','2022-03-08 02:37:06'),(435,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',504,'[]',NULL,'2022-03-08 02:37:10','2022-03-08 02:37:10'),(436,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',504,'[]',NULL,'2022-03-08 02:44:30','2022-03-08 02:44:30'),(437,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-08 02:55:22','2022-03-08 02:55:22'),(438,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-03-08 03:24:16','2022-03-08 03:24:16'),(439,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-05-19 06:31:48','2022-05-19 06:31:48'),(440,'default','Log Out',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-05-19 07:04:18','2022-05-19 07:04:18'),(441,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-05-19 07:57:58','2022-05-19 07:57:58'),(442,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-05-23 00:01:15','2022-05-23 00:01:15'),(443,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-05-23 07:16:48','2022-05-23 07:16:48'),(444,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-05-23 22:04:39','2022-05-23 22:04:39'),(445,'default','Ubah Data Menu dengan ID = 4',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-05-23 22:38:46','2022-05-23 22:38:46'),(446,'default','Tambah Data Menu',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-05-23 22:41:29','2022-05-23 22:41:29'),(447,'default','Ubah Data Menu dengan ID = 4',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-05-23 22:42:25','2022-05-23 22:42:25'),(448,'default','Ubah Data Menu dengan ID = 15',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-05-23 22:42:54','2022-05-23 22:42:54'),(449,'default','Ubah Data Menu dengan ID = 14',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-05-23 22:43:02','2022-05-23 22:43:02'),(450,'default','Ubah Data Menu dengan ID = 5',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-05-23 22:43:08','2022-05-23 22:43:08'),(451,'default','Ubah Data Menu dengan ID = 13',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-05-23 22:43:22','2022-05-23 22:43:22'),(452,'default','Ubah Data Menu dengan ID = 15',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-05-23 22:43:55','2022-05-23 22:43:55'),(453,'default','Tambah Data Menu Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-05-23 22:44:19','2022-05-23 22:44:19'),(454,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-05-24 00:36:47','2022-05-24 00:36:47'),(455,'default','Login',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-05-24 13:33:26','2022-05-24 13:33:26'),(456,'default','Ubah Data Menu dengan ID = 13',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-05-24 13:50:32','2022-05-24 13:50:32'),(457,'default','Tambah Data Menu',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-05-24 13:50:50','2022-05-24 13:50:50'),(458,'default','Tambah Data Menu Akses',NULL,NULL,NULL,'App\\Models\\User',1,'[]',NULL,'2022-05-24 13:51:12','2022-05-24 13:51:12');
/*!40000 ALTER TABLE `activity_log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(18) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'Administrator',0,1,'2022-01-11 05:01:48','2022-01-11 05:01:48'),(2,'Operator',0,1,'2022-01-11 05:01:57','2022-01-11 05:01:57'),(3,'Kasir',0,1,'2022-01-18 02:38:17','2022-01-18 02:41:41');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `image_uploads`
--

DROP TABLE IF EXISTS `image_uploads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `image_uploads` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `filename` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `image_uploads`
--

LOCK TABLES `image_uploads` WRITE;
/*!40000 ALTER TABLE `image_uploads` DISABLE KEYS */;
INSERT INTO `image_uploads` VALUES (1,'1653344319104DSC_5410 copy2.jpg','2022-05-23 22:18:39','2022-05-23 22:18:39'),(2,'1653344321784DSC_0410.JPG','2022-05-23 22:18:42','2022-05-23 22:18:42'),(3,'1653344324688photo_2.jpg','2022-05-23 22:18:45','2022-05-23 22:18:45'),(4,'1653344427962banner.png','2022-05-23 22:20:28','2022-05-23 22:20:28'),(8,'1653344596999DSC_5410 copy2.jpg','2022-05-23 22:23:17','2022-05-23 22:23:17'),(12,'1653344747149DSC_5410 copy2.jpg','2022-05-23 22:25:47','2022-05-23 22:25:47'),(13,'1653344749990Untitled-2.jpg','2022-05-23 22:25:50','2022-05-23 22:25:50'),(15,'1653344802347WhatsApp Image 2021-11-06 at 19.37.12.jpeg','2022-05-23 22:26:42','2022-05-23 22:26:42'),(16,'1653344853634photo_2.jpg','2022-05-23 22:27:34','2022-05-23 22:27:34'),(17,'1653344856062DSC_5410 copy2.jpg','2022-05-23 22:27:36','2022-05-23 22:27:36'),(22,'16533526167503167995-min.jpg','2022-05-24 00:36:57','2022-05-24 00:36:57');
/*!40000 ALTER TABLE `image_uploads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_accesses`
--

DROP TABLE IF EXISTS `menu_accesses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_accesses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL DEFAULT 0,
  `menu_id` int(11) NOT NULL DEFAULT 0,
  `create` int(11) NOT NULL DEFAULT 0,
  `read` int(11) NOT NULL DEFAULT 0,
  `update` int(11) NOT NULL DEFAULT 0,
  `delete` int(11) NOT NULL DEFAULT 0,
  `print` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `group_id` (`group_id`),
  KEY `menu_id` (`menu_id`),
  CONSTRAINT `FK_access_tbl_group_tbl` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_access_tbl_menu_tbl` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_accesses`
--

LOCK TABLES `menu_accesses` WRITE;
/*!40000 ALTER TABLE `menu_accesses` DISABLE KEYS */;
INSERT INTO `menu_accesses` VALUES (1,1,4,1,1,1,1,1,1,'2022-01-13 03:02:25','2022-01-13 03:02:25'),(7,1,5,1,1,1,1,1,1,'2022-01-14 09:59:17','2022-01-14 09:59:17'),(8,1,6,1,1,1,1,1,1,'2022-01-14 10:23:01','2022-01-17 03:18:37'),(13,1,7,1,1,1,1,1,1,'2022-01-17 03:00:28','2022-01-17 03:00:28'),(14,2,7,1,1,1,1,1,1,'2022-01-17 03:11:56','2022-01-17 03:11:56'),(15,1,13,1,1,1,1,1,1,'2022-02-18 01:25:25','2022-02-18 01:25:25'),(16,1,14,1,1,1,1,1,1,'2022-03-02 02:40:51','2022-03-02 02:40:51'),(18,3,4,1,1,0,1,1,1,'2022-03-02 07:56:59','2022-03-07 03:18:09'),(22,1,15,1,1,1,1,1,1,'2022-05-23 22:44:19','2022-05-23 22:44:19'),(23,1,16,1,1,1,1,1,1,'2022-05-24 13:51:12','2022-05-24 13:51:12');
/*!40000 ALTER TABLE `menu_accesses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_name` varchar(18) DEFAULT NULL,
  `link` varchar(50) DEFAULT NULL,
  `attribute` varchar(50) DEFAULT NULL,
  `position` int(11) NOT NULL DEFAULT 0,
  `desc` tinytext DEFAULT NULL,
  `category` int(11) NOT NULL DEFAULT 0,
  `status` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menus`
--

LOCK TABLES `menus` WRITE;
/*!40000 ALTER TABLE `menus` DISABLE KEYS */;
INSERT INTO `menus` VALUES (4,'Pengaturan','#','fa fa-cogs',9,NULL,1,1,1,'2022-01-12 03:05:31','2022-05-23 22:42:25'),(5,'Log Activity','log','fa fa-circle-notch',7,NULL,2,1,1,'2022-01-14 09:59:00','2022-05-23 22:43:08'),(6,'Data Pegawai','pegawai','fa fa-list',2,NULL,2,1,1,'2022-01-14 10:22:35','2022-02-18 01:18:18'),(7,'Rekapitulasi','#','fa fa-database',1,NULL,2,1,1,'2022-01-15 09:31:03','2022-03-07 02:41:59'),(13,'Report','#','fa fa-list',5,NULL,2,1,1,'2022-02-18 01:16:32','2022-05-24 13:50:32'),(14,'Kirim Email','email','fa fa-envelope',8,NULL,2,1,1,'2022-03-02 02:38:46','2022-05-23 22:43:02'),(15,'Dropzone','dropzone','fa fa-image',3,NULL,2,1,1,'2022-05-23 22:41:29','2022-05-23 22:43:55'),(16,'Database','database','fa fa-database',4,NULL,2,1,1,'2022-05-24 13:50:50','2022-05-24 13:50:50');
/*!40000 ALTER TABLE `menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2014_10_12_200000_add_two_factor_columns_to_users_table',2),(5,'2019_12_14_000001_create_personal_access_tokens_table',2),(6,'2021_04_05_060844_create_sessions_table',2),(7,'2021_05_11_132318_create_events_table',3),(8,'2021_10_28_132348_create_activity_log_table',4),(9,'2021_10_28_132349_add_event_column_to_activity_log_table',4),(10,'2021_10_28_132350_add_batch_uuid_column_to_activity_log_table',4),(11,'2022_05_20_182048_create_image_uploads_table',5);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES ('adri.saputra.ibrahim@gmail.com','$2y$10$1ZCbChwlh1RE.Fl3G0zoje4PR2GtxKM9Nzrrdq2IG1kO1Nv6gKupC','2022-03-01 03:06:40');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pegawai_tbl`
--

DROP TABLE IF EXISTS `pegawai_tbl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pegawai_tbl` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nip` varchar(18) DEFAULT NULL,
  `nama_pegawai` varchar(100) DEFAULT NULL,
  `tempat_lahir` varchar(50) DEFAULT NULL,
  `tanggal_lahir` date DEFAULT NULL,
  `jenis_kelamin` varchar(50) DEFAULT NULL,
  `alamat` text DEFAULT NULL,
  `agama` varchar(300) DEFAULT NULL,
  `gol_darah` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `foto_formal` varchar(50) DEFAULT NULL,
  `foto_kedinasan` varchar(50) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `status_hapus` int(11) DEFAULT 0,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=101 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pegawai_tbl`
--

LOCK TABLES `pegawai_tbl` WRITE;
/*!40000 ALTER TABLE `pegawai_tbl` DISABLE KEYS */;
INSERT INTO `pegawai_tbl` VALUES (1,'196406211985032009','Hj. Sitti Saleha, SE, M.Si','sasa','1964-06-21','Wanita','ssa','Islam',NULL,'a@gmail.com','1635393285.jpg','1635393266.jpg','PNS',0,1,'2021-05-03 06:20:18','2021-10-28 03:54:45'),(2,'196412311998011000','Ir. Laode Hamalin, M.Si',NULL,'1970-01-01','Pria',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:18','2021-06-20 17:18:44'),(3,'196312301986072000','Wa Ode Nuryani, SE',NULL,'1963-12-30','Wanita',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:18','2021-05-03 06:20:18'),(4,'196602011984111000','Sutomo, SP, M. Si',NULL,'1966-02-01','Pria',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:18','2021-05-03 06:20:18'),(5,'196302081993031000','Ir. Irmanuddin',NULL,'1963-02-08','Pria',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:18','2021-05-03 06:20:18'),(6,'196412301994031000','Ir. Sapoan, M.Si',NULL,'1970-01-01','Pria',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:18','2021-06-20 18:34:09'),(7,'196207171983022000','Rukmini, SE',NULL,'1962-07-17','Wanita',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:18','2021-05-03 06:20:18'),(8,'196504101985031000','Najamuddin Pidani,S.Sos',NULL,'1965-04-10','Pria',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:18','2021-05-03 06:20:18'),(9,'198005222006041000','La Ode. Muh. Rusdin Jaya, S.IP, M.Si',NULL,'1980-05-22','Pria',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:18','2021-05-03 06:20:18'),(10,'196608121994041000','Drs. Muslimin',NULL,'1966-08-12','Pria',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:18','2021-05-03 06:20:18'),(11,'196605291995031000','Sulkifli Saleh,ST.M.Si',NULL,'1966-05-29','Pria',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:18','2021-05-03 06:20:18'),(12,'196603071994032000','Hasnawati, SE',NULL,'1966-03-07','Wanita',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:18','2021-05-03 06:20:18'),(13,'196605101995032000','Andi Indriani P.U, SH',NULL,'1966-11-10','Wanita',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:18','2021-05-03 06:20:18'),(14,'197102211991032000','Darmawati Gamma, SH',NULL,'1971-02-21','Wanita',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:18','2021-05-03 06:20:18'),(15,'196303021985032000','Nursan, S.Sos',NULL,'1963-02-03','Wanita',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:18','2021-05-03 06:20:18'),(16,'196412311985031000','Kasman,S.Pd',NULL,'1964-12-12','Pria',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:19','2021-05-03 06:20:19'),(17,'196712311993111000','Abdul Latif, S.Sos',NULL,'1967-12-12','Pria',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:19','2021-05-03 06:20:19'),(18,'197312262001121000','Monasman, ST','uuu','1973-12-26','Pria','uuu','Islam','A',NULL,NULL,NULL,'PNS',0,1,'2021-05-03 06:20:19','2021-10-28 04:02:52'),(19,'197605252001122000','Nahrida, ST',NULL,'1976-05-25','Wanita',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:19','2021-05-03 06:20:19'),(20,'196508081994032000','Tina Sidupa, S.E',NULL,'1965-08-08','Wanita',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:19','2021-05-03 06:20:19'),(21,'196705271994031000','La Ode Amirul Mukminin, A.Md',NULL,'1967-05-27','Pria',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:19','2021-05-03 06:20:19'),(22,'196602182007012000','Sachiko Isamu, SE',NULL,'1966-02-18','Wanita',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:19','2021-05-03 06:20:19'),(23,'197301012006041000','Akra Sipa,ST',NULL,'1973-01-01','Pria',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:19','2021-05-03 06:20:19'),(24,'198011212005022000','Veradela Nandha Tiara, ST',NULL,'1980-11-21','Wanita',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:19','2021-05-03 06:20:19'),(25,'197006062005022000','Halimah Saleh Putri,SH',NULL,'1970-06-03','Wanita',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:19','2021-05-03 06:20:19'),(26,'197809272002121000','Adyanto Halyawan, S.E',NULL,'1978-09-27','Pria',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:19','2021-05-03 06:20:19'),(27,'197709102006042000','Wahyuni, S.Si',NULL,'1977-09-10','Wanita',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:19','2021-05-03 06:20:19'),(28,'198305062011011000','Muh. Yasser Tuwu, SE., M.Sc',NULL,'1983-05-06','Pria',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:19','2021-05-03 06:20:19'),(29,'198404062011011000','La Ode Muh. Fitrah Arsyad, SE. M. Si',NULL,'1984-04-06','Pria',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:19','2021-05-03 06:20:19'),(30,'196410101988011000','Haryanto',NULL,'1964-10-10','Pria',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:19','2021-05-03 06:20:19'),(31,'197009181996031000','Moh. Iskandar Azis, A.Md',NULL,'1970-09-18','Pria',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:20','2021-05-03 06:20:20'),(32,'198205212006041000','Kemal Jusra, S.Si, M.Si',NULL,'1982-05-21','Pria',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:20','2021-05-03 06:20:20'),(33,'196812311994031000','Khaidir, S.Si',NULL,'1968-12-31','Pria',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:20','2021-05-03 06:20:20'),(34,'198011112010012000','Rosmaidar HS S.Sos',NULL,'1980-11-14','Wanita',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:20','2021-05-03 06:20:20'),(35,'197809212010011000','Oon Sulfikar,SH.MM',NULL,'1978-09-21','Pria',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:20','2021-05-03 06:20:20'),(36,'197810052008012000','Siti Nurhanti, S.Pi',NULL,'1978-10-05','Wanita',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:20','2021-05-03 06:20:20'),(37,'198408112010012000','Andi Zakiah Wahidah, ST. M.Si',NULL,'1984-08-11','Wanita',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:20','2021-05-03 06:20:20'),(38,'198411072008032000','Anisyah Ringgasa, S.Si',NULL,'1984-11-07','Wanita',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:20','2021-05-03 06:20:20'),(39,'197803162008011000','Hasmindar, S.P',NULL,'1978-03-16','Pria',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:20','2021-05-03 06:20:20'),(40,'198106202010011000','Andi Puhu, S.Pd',NULL,'1981-06-20','Pria',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:20','2021-05-03 06:20:20'),(41,'19857142006021000','La Ode Muh. Qamal Jogugu S, STP, ME',NULL,'1985-07-14','Pria',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:20','2021-05-03 06:20:20'),(42,'197312152009011000','Bachar, ST',NULL,'1973-12-15','Pria',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:20','2021-05-03 06:20:20'),(43,'197902222009012000','Ariskha Sazriany HS, ST',NULL,'1979-02-22','Wanita',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:20','2021-05-03 06:20:20'),(44,'198111022009012000','Indri, S. Pi',NULL,'1981-11-02','Wanita',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:20','2021-05-03 06:20:20'),(45,'197905022009042000','Wa Ode Hardiana, SE',NULL,'1979-05-02','Wanita',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:20','2021-05-03 06:20:20'),(46,'198304182009042000','Wa Ode Hasniati, S. Si',NULL,'1983-04-18','Wanita',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:20','2021-05-03 06:20:20'),(47,'198510222010012000','Henny Savitri Oktaviana, S. Si, M.Si',NULL,'1985-10-22','Wanita',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:21','2021-05-03 06:20:21'),(48,'197805152010011000','Mardan, SE',NULL,'1978-05-15','Pria',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:21','2021-05-03 06:20:21'),(49,'198301122011011000','Ikbal Hidayat, S.T',NULL,'1983-01-12','Pria',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:21','2021-05-03 06:20:21'),(50,'198203102010012000','Jumarlian Santi Rafiun,SP',NULL,'1982-03-10','Wanita',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:21','2021-05-03 06:20:21'),(51,'198402152011012000','Febriani Arumi, ST',NULL,'1984-02-15','Wanita',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:21','2021-05-03 06:20:21'),(52,'198209222011012000','Sitti Aisyah, SE',NULL,'1982-09-22','Wanita',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:21','2021-05-03 06:20:21'),(53,'196411021986032000','Suryamin',NULL,'1964-11-02','Wanita',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:21','2021-05-03 06:20:21'),(54,'196310111985031000','Hamzah',NULL,'1963-10-11','Pria',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:21','2021-05-03 06:20:21'),(55,'197212122007012000','Indriyani Sudibyo,S.Sos',NULL,'1972-12-12','Wanita',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:21','2021-05-03 06:20:21'),(56,'198103172010012000','Windi Dianovita, ST',NULL,'1981-03-17','Wanita',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:21','2021-05-03 06:20:21'),(57,'198304192010012000','Sulistiany Tamrin, ST',NULL,'1983-04-19','Wanita',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:21','2021-05-03 06:20:21'),(58,'198705132011012000','Dian Sulistyowati,S.Kom,M.E',NULL,'1987-05-13','Wanita',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:21','2021-05-03 06:20:21'),(59,'198503262011012000','Imayanti Suhardin, SE',NULL,'1985-03-26','Wanita',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:21','2021-05-03 06:20:21'),(60,'198010132009011000','Dian Hidayah S,Sos',NULL,'1980-10-13','Pria',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:21','2021-05-03 06:20:21'),(61,'197911112009011000','La Ode Muhammad Ihsan Abdi, SP',NULL,'1979-11-11','Pria',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:21','2021-05-03 06:20:21'),(62,'196608192006042000','Sitti Salma, ST, M.Si',NULL,'1966-08-19','Wanita',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:22','2021-05-03 06:20:22'),(63,'196306101994031000','Asrul Suaeb',NULL,'1963-06-10','Pria',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:22','2021-05-03 06:20:22'),(64,'198509252009012000','Sitti Wahyuni, S.TP',NULL,'1985-09-24','Wanita',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:22','2021-05-03 06:20:22'),(65,'197806032005021000','Mauliddun, SH',NULL,'1978-06-03','Pria',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:22','2021-05-03 06:20:22'),(66,'197512082007012000','Jusanti, S.Sos',NULL,'1975-12-08','Wanita',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:22','2021-05-03 06:20:22'),(67,'198412062014032000','Wa Ode Kasmila, S. Si, M.Si',NULL,'1984-12-06','Wanita',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:22','2021-05-03 06:20:22'),(68,'198702202010012000','Sufiati, A. Md,SE',NULL,'1987-02-20','Wanita',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:22','2021-05-03 06:20:22'),(69,'197710262007122000','Reniati, S. Sos',NULL,'1977-10-26','Wanita',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:22','2021-05-03 06:20:22'),(70,'196707072014082000','Sitti Asniah, SE',NULL,'1967-07-07','Wanita',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:22','2021-05-03 06:20:22'),(71,'197912212014082000','Mulyani Abuhari, SE',NULL,'1979-12-21','Wanita',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:22','2021-05-03 06:20:22'),(72,'198510032010011000','Amir Pae, A.Md,SE',NULL,'1985-10-03','Pria',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:22','2021-05-03 06:20:22'),(73,'197906112007011000','E m i, S.Si',NULL,'1979-06-11','Pria',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:22','2021-05-03 06:20:22'),(74,'196904012008011000','Basri, SH',NULL,'1969-04-01','Pria',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:22','2021-05-03 06:20:22'),(75,'198003112009011000','Agus, S.Si',NULL,'1980-03-11','Pria',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:22','2021-05-03 06:20:22'),(76,'196708261989032000','Nurlina Malik',NULL,'1967-12-12','Wanita',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:22','2021-05-03 06:20:22'),(77,'196601101991031000','Sapiuddin',NULL,'1966-01-10','Pria',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:22','2021-05-03 06:20:22'),(78,'197503072008012000','Bahrain, SE',NULL,'1975-03-07','Wanita',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:23','2021-05-03 06:20:23'),(79,'198504262008011000','La Ode Muh. Ikbal Beau,S.Sos',NULL,'1985-04-06','Pria',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:23','2021-05-03 06:20:23'),(80,'197909172009011000','Muhammad Zailani Sanusi, S.E',NULL,'1979-09-17','Pria',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:23','2021-05-03 06:20:23'),(81,'198407022014081000','Samsuddin,SH',NULL,'1984-07-02','Pria',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:23','2021-05-03 06:20:23'),(82,'198910182015022000','Erika Ayu Christanti, A.Md',NULL,'1989-10-18','Wanita',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:23','2021-05-03 06:20:23'),(83,'197809022014071000','Asjan Husain,ST',NULL,'1978-09-02','Pria',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:23','2021-05-03 06:20:23'),(84,'198301052009012000','Hamira, A. Md. Kom',NULL,'1983-01-05','Wanita',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:23','2021-05-03 06:20:23'),(85,'197409042014062000','Riny astuti, S. Sos',NULL,'1974-09-04','Wanita',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:23','2021-05-03 06:20:23'),(86,'198912272015021000','Mardiono, A.Md',NULL,'1989-12-27','Pria',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:23','2021-05-03 06:20:23'),(87,'196412312006041000','Asikin Jamal',NULL,'1964-12-12','Pria',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:23','2021-05-03 06:20:23'),(88,'196312312007011000','La Ode Hafilu',NULL,'1963-12-12','Pria',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:23','2021-05-03 06:20:23'),(89,'198302142008011000','Wahyuddin Amir Manab',NULL,'1983-02-14','Pria',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:23','2021-05-03 06:20:23'),(90,'198201102009012000','Misna Haseng',NULL,'1982-01-10','Wanita',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:23','2021-05-03 06:20:23'),(91,'197908272011011000','Agus Herdianto, A.Md',NULL,'1979-08-27','Pria',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:23','2021-05-03 06:20:23'),(92,'198306192010011000','Munandar ',NULL,'1983-06-19','Pria',NULL,NULL,NULL,NULL,NULL,NULL,'PNS',0,NULL,'2021-05-03 06:20:23','2021-05-03 06:20:23'),(93,'197412022014081000','Faisal','xxx','1974-12-02','Pria','xx','Islam',NULL,NULL,NULL,NULL,'PNS',0,1,'2021-05-03 06:20:24','2021-10-29 02:30:57');
/*!40000 ALTER TABLE `pegawai_tbl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessions`
--

LOCK TABLES `sessions` WRITE;
/*!40000 ALTER TABLE `sessions` DISABLE KEYS */;
INSERT INTO `sessions` VALUES ('5cTaC0q1l19sW83VGYLVqcvvmS2Ub6pCfzMGBLwx',1,'::1','Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/101.0.4951.67 Safari/537.36','YTo1OntzOjY6Il90b2tlbiI7czo0MDoiT0JHUVRiVzhhMWZMNUgxYjlDVVh3dzR1dFdGZTJUcWJlc3g1TG40RyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDE6Imh0dHA6Ly9sb2NhbGhvc3QvY29yZS1sYXJhdmVsLXRzL2RhdGFiYXNlIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MDoibG9naW5fd2ViXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MTtzOjE3OiJwYXNzd29yZF9oYXNoX3dlYiI7czo2MDoiJDJ5JDEwJFJjLmVDdWQ1SVlnYUpBZUZJYWVUMk9RTTlMNE1pcWRWa1YuLnAxd2JRdm5QeHhHNkw2N215Ijt9',1653400342);
/*!40000 ALTER TABLE `sessions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `application_name` varchar(200) DEFAULT NULL,
  `short_application_name` varchar(200) DEFAULT NULL,
  `small_icon` varchar(100) DEFAULT NULL,
  `large_icon` varchar(100) DEFAULT NULL,
  `background_login` varchar(100) DEFAULT NULL,
  `background_sidebar` varchar(100) DEFAULT NULL,
  `layout` varchar(100) DEFAULT NULL,
  `skin` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,'CORE LARAVEL','CORE','16354773231.png','16354769112.png','16354882883.jpg',NULL,'default','skin-green-light',1,'2021-10-29 02:58:27','2022-03-08 02:16:18');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sub_menu_accesses`
--

DROP TABLE IF EXISTS `sub_menu_accesses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sub_menu_accesses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_id` int(11) NOT NULL DEFAULT 0,
  `menu_id` int(11) NOT NULL DEFAULT 0,
  `sub_menu_id` int(11) NOT NULL DEFAULT 0,
  `create` int(11) NOT NULL DEFAULT 0,
  `read` int(11) NOT NULL DEFAULT 0,
  `update` int(11) NOT NULL DEFAULT 0,
  `delete` int(11) NOT NULL DEFAULT 0,
  `print` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `menu_id` (`menu_id`),
  KEY `group_id` (`group_id`),
  KEY `sub_menu_id` (`sub_menu_id`),
  CONSTRAINT `FK_sub_menu_access_tbl_group_tbl` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_sub_menu_access_tbl_menu_access_tbl_2` FOREIGN KEY (`menu_id`) REFERENCES `menu_accesses` (`menu_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_sub_menu_access_tbl_sub_menu_tbl` FOREIGN KEY (`sub_menu_id`) REFERENCES `sub_menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sub_menu_accesses`
--

LOCK TABLES `sub_menu_accesses` WRITE;
/*!40000 ALTER TABLE `sub_menu_accesses` DISABLE KEYS */;
INSERT INTO `sub_menu_accesses` VALUES (25,1,7,9,1,1,1,1,1,1,'2022-01-17 03:07:17','2022-01-17 03:07:17'),(26,2,7,9,1,1,1,1,1,1,'2022-01-17 03:12:16','2022-01-17 03:12:16'),(27,1,13,11,1,1,1,1,1,1,'2022-02-18 01:25:42','2022-02-18 01:25:42'),(28,1,13,12,1,1,1,1,1,1,'2022-02-18 01:25:54','2022-02-18 01:25:54'),(40,1,4,8,1,1,1,1,1,1,'2022-03-08 01:26:36','2022-03-08 01:26:37'),(41,1,4,6,1,1,1,1,1,1,'2022-03-08 01:27:50','2022-03-08 01:27:50'),(42,1,4,7,1,1,1,1,1,1,'2022-03-08 01:28:05','2022-03-08 01:28:05');
/*!40000 ALTER TABLE `sub_menu_accesses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sub_menus`
--

DROP TABLE IF EXISTS `sub_menus`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sub_menus` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `menu_id` int(11) NOT NULL,
  `sub_menu_name` varchar(18) DEFAULT NULL,
  `link` varchar(50) DEFAULT NULL,
  `attribute` varchar(50) DEFAULT NULL,
  `position` int(11) NOT NULL DEFAULT 0,
  `desc` tinytext DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `user_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  KEY `menu_id` (`menu_id`),
  CONSTRAINT `FK_sub_menu_tbl_group_tbl` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sub_menus`
--

LOCK TABLES `sub_menus` WRITE;
/*!40000 ALTER TABLE `sub_menus` DISABLE KEYS */;
INSERT INTO `sub_menus` VALUES (6,4,'User','user','fa-circle-notch',1,NULL,1,1,'2022-01-12 05:42:20','2022-01-14 12:01:44'),(7,4,'Menu','menu','fa-circle-notch',3,NULL,1,1,'2022-01-12 05:43:01','2022-01-12 05:43:01'),(8,4,'Group','group','fa-circle-notch',2,NULL,1,1,'2022-01-12 05:43:18','2022-01-12 05:43:18'),(9,7,'Grafik','rekapitulasi_jumlah_pegawai',NULL,1,NULL,1,1,'2022-01-15 09:39:32','2022-01-15 09:39:32'),(11,13,'Excel','report_excel',NULL,1,NULL,1,1,'2022-02-18 01:16:58','2022-02-18 01:16:58'),(12,13,'PDF','report_pdf',NULL,2,NULL,1,1,'2022-02-18 01:17:10','2022-02-18 01:17:10');
/*!40000 ALTER TABLE `sub_menus` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `foto` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=505 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'administrator','adri.saputra.ibrahim@gmail.com','2022-03-01 08:30:46','$2y$10$Rc.eCud5IYgaJAeFIaeT2OQM9L4MiqdVkV..p1wbQvnPxxG6L67my',NULL,NULL,NULL,1,'1641869792.jpg',1,'2021-04-05 06:20:00','2022-03-01 08:30:46'),(482,'operator','operator@gmail.com',NULL,'$2y$10$RFfcHMYYV/VNaeZZXsZiBuYURin.uYGD9BMBDfhpbxxI./GOWqf3.',NULL,NULL,NULL,2,'1635474811.jpg',1,'2021-10-28 04:09:14','2022-01-11 06:57:53'),(483,'adri','adri.saputra.ibrahim2@gmail.com',NULL,'$2y$10$5Z9InSn74rzyZaUdO5fzRuPV.mA9tbNRp4e63QhxNdvblheRkuguS',NULL,NULL,NULL,3,NULL,1,'2022-01-18 02:47:10','2022-03-01 02:50:27'),(504,'euis','euis.nurhiliya@gmail.com','2022-03-08 02:35:23','$2y$10$zdjpHYCbhvpoW5OC.aUOUOOkkmTbEy0PXjb/ydIA4olH3GxQD43FW',NULL,NULL,'vSI8lloZqzCFPMBgXq5BIaZP8tF6d0tnI9xP6m0QjqgpLNLVmpbqf5q0NEin',2,NULL,1,'2022-03-08 02:32:03','2022-03-08 02:44:26');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-05-24 21:55:14
