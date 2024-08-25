-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: hidden_facts_db
-- ------------------------------------------------------
-- Server version	8.0.34

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `admin` (
  `adminId` varchar(36) NOT NULL,
  `name` varchar(75) NOT NULL,
  `email` varchar(45) NOT NULL,
  `username` varchar(45) NOT NULL,
  `password` text NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`adminId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admin`
--

LOCK TABLES `admin` WRITE;
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` VALUES ('15546c8b-91a3-41e9-8b3b-93e7fd20c6e7','Super User','admin@hiddenfacts.com','adminuser','$2y$12$SDbjKBVwaXIdxTvfHpxkM.UYJDUrJCNvK28bWGhadY9XCEX7ZBBuG','2024-08-19 10:20:15','2024-08-24 05:12:55');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `auth`
--

DROP TABLE IF EXISTS `auth`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `auth` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `userId` varchar(36) NOT NULL,
  `username` varchar(75) NOT NULL,
  `email` varchar(75) NOT NULL,
  `password` text NOT NULL,
  `deviceId` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`,`userId`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  UNIQUE KEY `email_UNIQUE` (`email`),
  KEY `userId_idx` (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `auth`
--

LOCK TABLES `auth` WRITE;
/*!40000 ALTER TABLE `auth` DISABLE KEYS */;
INSERT INTO `auth` VALUES (1,'9cbb5fdb-fb83-4d75-afe8-32e39d8fa828','yay','yay@gmail.com','$2y$12$P6UaJMLzF8wjfkqQ3cOr/uQLZCFGkPhPG8cYYuaLrJl9OT/ubp7XC','','2024-08-10 09:30:11','2024-08-25 01:21:23');
/*!40000 ALTER TABLE `auth` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `book`
--

DROP TABLE IF EXISTS `book`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `book` (
  `book_id` varchar(36) NOT NULL,
  `title` varchar(75) NOT NULL,
  `price` decimal(12,2) NOT NULL,
  `descr` text,
  `thumbnail` text,
  `book_file` text NOT NULL,
  `class_id` int DEFAULT NULL,
  `subject_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`book_id`),
  KEY `classId_idx` (`class_id`),
  KEY `subjectId_idx` (`subject_id`),
  CONSTRAINT `classId` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `subjectId` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `book`
--

LOCK TABLES `book` WRITE;
/*!40000 ALTER TABLE `book` DISABLE KEYS */;
INSERT INTO `book` VALUES ('9cd70787-543e-473d-a500-a4c152d66406','The Learners',23456.00,'The learners is just a learner','storage/app/public/book/1724551472_best_selling3.jpg','storage/app/public/book/document/1724473582_DissertationIMart.pdf',2,6,'2024-08-24 04:40:38','2024-08-25 01:04:32'),('9cd71980-bb58-45c1-b05f-536c3b30365d','Turtle',345645.00,'Descr','storage/app/public/book/1724551495_best_selling1.jpg','storage/app/public/book/document/1724477861_Resume Ayomidipupo Jubril Ajayi (1).pdf',1,2,'2024-08-24 05:16:37','2024-08-25 01:04:55'),('9cd8d8ad-c9c8-4fec-a7e1-335216c6b9bc','Joe Regan',3445.00,'Another one','storage/app/public/book/1724551618_best_selling2.jpg','storage/app/public/book/document/1724551618_Vecteezy-License-Information.pdf',2,2,'2024-08-25 02:07:02',NULL),('9cd8d8c6-a9e0-483b-ab81-64644d9af0a6','Joe Regan 2',3445.00,'Another one','storage/app/public/book/1724551637_best_selling4.jpg','storage/app/public/book/document/1724551637_Vecteezy-License-Information.pdf',2,2,'2024-08-25 02:07:17',NULL),('9cd8d8e3-019c-4533-9d6f-2abad6a7a326','Joe Regan Part 3',3445.00,'Another one','storage/app/public/book/1724551913_best_selling1.jpg','storage/app/public/book/document/1724551656_Vecteezy-License-Information.pdf',3,1,'2024-08-25 02:07:36','2024-08-25 01:11:53'),('9cd8d909-bb03-40cf-a51d-a0df08ae8fe7','Toosle Fold Part 3',3445.00,'Another one','storage/app/public/book/1724551681_best_selling5.jpg','storage/app/public/book/document/1724551681_Vecteezy-License-Information.pdf',1,7,'2024-08-25 02:08:01',NULL),('9cd8d932-ad17-4ca3-8d5c-c76d18ce4cf3','Toosle Fold Part',3445.00,'Another one','storage/app/public/book/1724551708_best_selling7.jpg','storage/app/public/book/document/1724551708_Vecteezy-License-Information.pdf',3,6,'2024-08-25 02:08:28',NULL),('9cd8d94e-b6f2-4f7e-a81d-4894fc6a8558','Toosle Fold Part 1',3445.00,'Another one','storage/app/public/book/1724551726_best_selling6.jpg','storage/app/public/book/document/1724551726_Vecteezy-License-Information.pdf',3,5,'2024-08-25 02:08:46',NULL),('9cd8d970-9ba8-4724-a2ee-3d1211f0681e','Toosle Fold Part 2',3445.00,'Another one','storage/app/public/book/1724551749_best_selling9.jpg','storage/app/public/book/document/1724551749_Vecteezy-License-Information.pdf',1,2,'2024-08-25 02:09:09','2024-08-25 06:14:19'),('9cd8d99c-d3a9-4a5e-ba97-078de38417d2','Toosle',3445.00,'Another one','storage/app/public/book/1724551778_best_selling8.jpg','storage/app/public/book/document/1724551778_Vecteezy-License-Information.pdf',2,3,'2024-08-25 02:09:38',NULL),('9cd8d9ff-20d9-480f-8a66-1ba199575f51','Toosle Thic',3445.00,'Another one','storage/app/public/book/1724551842_best-books1.jpg','storage/app/public/book/document/1724551842_Vecteezy-License-Information.pdf',3,1,'2024-08-25 02:10:42',NULL);
/*!40000 ALTER TABLE `book` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `cart` (
  `id` int NOT NULL AUTO_INCREMENT,
  `qty` int unsigned NOT NULL DEFAULT '1',
  `format` varchar(15) NOT NULL DEFAULT 'softcopy',
  `book` varchar(36) DEFAULT NULL,
  `user` varchar(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `cart_book_idx` (`book`),
  KEY `cart_user_idx` (`user`),
  CONSTRAINT `cart_book` FOREIGN KEY (`book`) REFERENCES `book` (`book_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `cartUser` FOREIGN KEY (`user`) REFERENCES `auth` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cart`
--

LOCK TABLES `cart` WRITE;
/*!40000 ALTER TABLE `cart` DISABLE KEYS */;
INSERT INTO `cart` VALUES (1,1,'soft','9cd8d94e-b6f2-4f7e-a81d-4894fc6a8558','9cbb5fdb-fb83-4d75-afe8-32e39d8fa828','2024-08-25 07:40:11','2024-08-25 07:40:11');
/*!40000 ALTER TABLE `cart` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `class`
--

DROP TABLE IF EXISTS `class`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `class` (
  `id` int NOT NULL AUTO_INCREMENT,
  `class_name` varchar(45) NOT NULL,
  `descr` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `class`
--

LOCK TABLES `class` WRITE;
/*!40000 ALTER TABLE `class` DISABLE KEYS */;
INSERT INTO `class` VALUES (1,'Class of 1',NULL,'2024-08-24 03:23:57','2024-08-24 02:27:11'),(2,'Class 2',NULL,'2024-08-24 03:25:11',NULL),(3,'Class 3','A class of 3 as in third','2024-08-24 03:25:27','2024-08-24 02:27:55');
/*!40000 ALTER TABLE `class` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `dev_credentials`
--

DROP TABLE IF EXISTS `dev_credentials`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `dev_credentials` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `dev_credentials`
--

LOCK TABLES `dev_credentials` WRITE;
/*!40000 ALTER TABLE `dev_credentials` DISABLE KEYS */;
INSERT INTO `dev_credentials` VALUES (1,'Ayo','2024-08-10 10:08:52',NULL),(2,'Praise','2024-08-10 10:08:52',NULL),(3,'Collins','2024-08-10 10:08:52',NULL);
/*!40000 ALTER TABLE `dev_credentials` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2019_12_14_000001_create_personal_access_tokens_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
INSERT INTO `personal_access_tokens` VALUES (1,'App\\Models\\DevCredentials','1','Ayo:Dev','bbdfd05d464818004d440caa206fac7578ec9eb78b76bf8db74d2427734f7440','[\"*\"]','2024-08-17 11:16:13',NULL,'2024-08-10 08:00:08','2024-08-17 11:16:13'),(2,'App\\Models\\DevCredentials','2','Praise:Dev','1a1a70f9a2d7ce17833cd4baabfaa44b1a64720293fd61f869c88b46e8a624e4','[\"*\"]',NULL,NULL,'2024-08-10 08:00:08','2024-08-10 08:00:08'),(3,'App\\Models\\DevCredentials','3','Collins:Dev','b5c3d219dcda49c5bd206da7d69de48b25b07e16594492a389b9e39f8536399c','[\"*\"]',NULL,NULL,'2024-08-10 08:00:08','2024-08-10 08:00:08'),(4,'App\\Models\\User','1','yay','9e5738990f4558de82c3e30767d313a3ca9f1233a4d02489a0294dc2e17e9d86','[\"*\"]',NULL,'2025-08-10 09:30:11','2024-08-10 09:30:11','2024-08-10 09:30:11'),(5,'App\\Models\\User','1','yay','a76d07352662e491cf4563f79d5ca53188be2f98779ec0aa3f28354c1a5c3004','[\"*\"]',NULL,'2025-08-17 03:39:21','2024-08-17 03:39:21','2024-08-17 03:39:21'),(6,'App\\Models\\User','1','yay','036931ed638a5977ec64cd80a201e84bca0b68f39385bb8e0525eb58106033ba','[\"*\"]',NULL,'2025-08-17 10:58:51','2024-08-17 10:58:51','2024-08-17 10:58:51'),(7,'App\\Models\\User','1','yay','77376057b7f580f1c121dce96b21289f4feba50a4de53dab2c93e49dfbdb28b7','[\"*\"]',NULL,'2025-08-17 11:00:17','2024-08-17 11:00:17','2024-08-17 11:00:17'),(8,'App\\Models\\User','1','yay','1913d2abb91d019f1d3b3fac11a7fe68becb007784cd4d0206134031fa9aea73','[\"*\"]',NULL,'2025-08-17 19:30:20','2024-08-17 19:30:20','2024-08-17 19:30:20'),(9,'App\\Models\\User','1','yay','ab5ec23dcd10caf043409f0d3858f8c009a20ea6e2a300031554f062d7c4095a','[\"*\"]',NULL,'2025-08-17 19:31:33','2024-08-17 19:31:33','2024-08-17 19:31:33'),(10,'App\\Models\\User','1','yay','32b603b738a5506139e8c5bec232262cb91d47554acef35c2bc7ce84a19d58a2','[\"*\"]',NULL,'2025-08-17 19:32:15','2024-08-17 19:32:15','2024-08-17 19:32:15'),(11,'App\\Models\\User','1','yay','6632b68dc79acafe19be3f8a026abb29befb4283e26903849f15eed56ed93afe','[\"*\"]',NULL,'2025-08-17 19:34:10','2024-08-17 19:34:10','2024-08-17 19:34:10'),(12,'App\\Models\\User','1','yay','5ebcb2e619eebdd75b66d6091434ef2906a80120f4d3e42e2112c7f15731a71e','[\"*\"]',NULL,'2025-08-18 07:10:50','2024-08-18 07:10:51','2024-08-18 07:10:51'),(13,'App\\Models\\User','1','yay','30fb7c2c0f564f2cf59cbf3dab4162f448ecdbdd3f9e035081302d913912fd29','[\"*\"]',NULL,'2025-08-24 01:20:37','2024-08-24 01:20:39','2024-08-24 01:20:39'),(14,'App\\Models\\User','1','yay','0bed2a7e182947149df9c243894a59701c1be6af702383942190f83407bd28ae','[\"*\"]',NULL,'2025-08-25 00:13:03','2024-08-25 00:13:04','2024-08-25 00:13:04'),(15,'App\\Models\\User','1','yay','1c9dab1443dc699797b6cdd47fb4f2cd2a2acf155273943d1b25376b462daab7','[\"*\"]',NULL,'2025-08-25 07:36:04','2024-08-25 07:36:05','2024-08-25 07:36:05');
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `profile`
--

DROP TABLE IF EXISTS `profile`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `profile` (
  `id` int NOT NULL AUTO_INCREMENT,
  `first_name` varchar(75) NOT NULL,
  `last_name` varchar(75) NOT NULL,
  `tel` varchar(15) DEFAULT NULL,
  `profile_image` varchar(255) DEFAULT NULL,
  `address` text,
  `userId` varchar(36) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `authUser_idx` (`userId`),
  CONSTRAINT `auth_user` FOREIGN KEY (`userId`) REFERENCES `auth` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `profile`
--

LOCK TABLES `profile` WRITE;
/*!40000 ALTER TABLE `profile` DISABLE KEYS */;
INSERT INTO `profile` VALUES (1,'Ay','AJ',NULL,NULL,NULL,'9cbb5fdb-fb83-4d75-afe8-32e39d8fa828','2024-08-10 09:30:11','2024-08-25 01:18:18');
/*!40000 ALTER TABLE `profile` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subject`
--

DROP TABLE IF EXISTS `subject`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `subject` (
  `id` int NOT NULL AUTO_INCREMENT,
  `subject_name` varchar(45) NOT NULL,
  `descr` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subject`
--

LOCK TABLES `subject` WRITE;
/*!40000 ALTER TABLE `subject` DISABLE KEYS */;
INSERT INTO `subject` VALUES (1,'English',NULL,'2024-08-24 02:42:54',NULL),(2,'Literature','Just Literature','2024-08-24 02:45:57',NULL),(3,'Novel','Just Novels','2024-08-24 02:48:13',NULL),(5,'Acting Book',NULL,'2024-08-24 02:51:21','2024-08-24 02:16:51'),(6,'Actor',NULL,'2024-08-24 02:55:33',NULL),(7,'Actress',NULL,'2024-08-24 02:55:52',NULL);
/*!40000 ALTER TABLE `subject` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `transaction` (
  `id` int NOT NULL AUTO_INCREMENT,
  `cost` decimal(19,2) NOT NULL,
  `details` json NOT NULL,
  `user` varchar(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `transUser_idx` (`user`),
  CONSTRAINT `trans_user` FOREIGN KEY (`user`) REFERENCES `auth` (`userId`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transaction`
--

LOCK TABLES `transaction` WRITE;
/*!40000 ALTER TABLE `transaction` DISABLE KEYS */;
/*!40000 ALTER TABLE `transaction` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_collections`
--

DROP TABLE IF EXISTS `user_collections`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_collections` (
  `id` int NOT NULL AUTO_INCREMENT,
  `userId` varchar(36) NOT NULL,
  `book_id` varchar(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `coll_user_idx` (`userId`),
  KEY `cool_book_idx` (`book_id`),
  CONSTRAINT `coll_book` FOREIGN KEY (`book_id`) REFERENCES `book` (`book_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `coll_user` FOREIGN KEY (`userId`) REFERENCES `auth` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_collections`
--

LOCK TABLES `user_collections` WRITE;
/*!40000 ALTER TABLE `user_collections` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_collections` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `video_links`
--

DROP TABLE IF EXISTS `video_links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `video_links` (
  `video_id` int NOT NULL AUTO_INCREMENT,
  `video_link` text NOT NULL,
  `subject_id` int DEFAULT NULL,
  `class_id` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`video_id`),
  KEY `video_class_idx` (`class_id`),
  KEY `video_subj_idx` (`subject_id`),
  CONSTRAINT `video_class` FOREIGN KEY (`class_id`) REFERENCES `class` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `video_subj` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `video_links`
--

LOCK TABLES `video_links` WRITE;
/*!40000 ALTER TABLE `video_links` DISABLE KEYS */;
INSERT INTO `video_links` VALUES (1,'https://youtube.com/embed/nK1BwdLw0Co?si=1Hq5xyhJfvS_wg67',7,2,'2024-08-25 10:09:12','2024-08-25 10:48:13'),(2,'https://www.youtube.com/embed/tgbNymZ7vqY',2,1,'2024-08-25 10:49:08',NULL);
/*!40000 ALTER TABLE `video_links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `wishlist`
--

DROP TABLE IF EXISTS `wishlist`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `wishlist` (
  `id` int NOT NULL AUTO_INCREMENT,
  `book_ref` varchar(36) DEFAULT NULL,
  `user_id` varchar(36) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `bookRef_idx` (`book_ref`),
  KEY `wish_user_idx` (`user_id`),
  CONSTRAINT `bookRef` FOREIGN KEY (`book_ref`) REFERENCES `book` (`book_id`) ON DELETE SET NULL ON UPDATE CASCADE,
  CONSTRAINT `wish_user` FOREIGN KEY (`user_id`) REFERENCES `auth` (`userId`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `wishlist`
--

LOCK TABLES `wishlist` WRITE;
/*!40000 ALTER TABLE `wishlist` DISABLE KEYS */;
/*!40000 ALTER TABLE `wishlist` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-08-25 12:07:09
