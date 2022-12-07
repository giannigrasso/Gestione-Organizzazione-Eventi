-- MariaDB dump 10.19  Distrib 10.4.24-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: dbgoe
-- ------------------------------------------------------
-- Server version	10.4.24-MariaDB

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
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `companies` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_group1` bigint(20) unsigned NOT NULL,
  `id_group2` bigint(20) unsigned NOT NULL,
  `id_event` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `companies_id_group1_unique` (`id_group1`),
  UNIQUE KEY `companies_id_group2_unique` (`id_group2`),
  KEY `companies_id_event_foreign` (`id_event`),
  CONSTRAINT `companies_id_event_foreign` FOREIGN KEY (`id_event`) REFERENCES `events` (`id`),
  CONSTRAINT `companies_id_group1_foreign` FOREIGN KEY (`id_group1`) REFERENCES `groups` (`id`),
  CONSTRAINT `companies_id_group2_foreign` FOREIGN KEY (`id_group2`) REFERENCES `groups` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `companies`
--

LOCK TABLES `companies` WRITE;
/*!40000 ALTER TABLE `companies` DISABLE KEYS */;
INSERT INTO `companies` VALUES (1,'Compagnia 1 Natale',1,2,2);
/*!40000 ALTER TABLE `companies` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `capacity` int(11) NOT NULL,
  `id_hotel` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `events_id_hotel_foreign` (`id_hotel`),
  CONSTRAINT `events_id_hotel_foreign` FOREIGN KEY (`id_hotel`) REFERENCES `hotels` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (1,'2023-05-05 20:35:00','Festival del film',100,2),(2,'2022-12-25 18:00:00','Evento di natale',40,1),(3,'2023-01-20 13:15:00','Concerto SAMT',400,3);
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
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
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `gender` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'Gruppo 1 Natale',1),(2,'Gruppo 2 Natale',0),(3,'Gruppo 1 Festival',1),(4,'Gruppo 1 scuola',1),(5,'Gruppo 2 scuola',0),(7,'Generic', 1);
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `hotels`
--

DROP TABLE IF EXISTS `hotels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hotels` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hotels`
--

LOCK TABLES `hotels` WRITE;
/*!40000 ALTER TABLE `hotels` DISABLE KEYS */;
INSERT INTO `hotels` VALUES (1,'Hotel Lago Maggiore','Via Varenna 19','Locarno','Svizzera'),(2,'Albergo Losone','Via losone 12','Losone','Svizzera'),(3,'Albergo CPT','Via trevano 4','Canobbio','Svizzera');
/*!40000 ALTER TABLE `hotels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `links`
--

DROP TABLE IF EXISTS `links`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `links` (
  `id_event` bigint(20) unsigned NOT NULL,
  `id_group` bigint(20) unsigned NOT NULL,
  `id_user` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id_event`,`id_group`,`id_user`),
  KEY `links_id_group_foreign` (`id_group`),
  KEY `links_id_user_foreign` (`id_user`),
  CONSTRAINT `links_id_event_foreign` FOREIGN KEY (`id_event`) REFERENCES `events` (`id`),
  CONSTRAINT `links_id_group_foreign` FOREIGN KEY (`id_group`) REFERENCES `groups` (`id`),
  CONSTRAINT `links_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `links`
--

LOCK TABLES `links` WRITE;
/*!40000 ALTER TABLE `links` DISABLE KEYS */;
INSERT INTO `links` VALUES (1,3,2),(1,3,3),(2,4,2);
/*!40000 ALTER TABLE `links` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_100000_create_password_resets_table',1),(2,'2019_08_19_000000_create_failed_jobs_table',1),(3,'2019_12_14_000001_create_personal_access_tokens_table',1),(4,'2022_09_29_082159_create_hotels_table',1),(5,'2022_09_29_082438_create_rooms_table',1),(6,'2022_09_29_082550_create_events_table',1),(7,'2022_09_29_082718_create_groups_table',1),(8,'2022_09_29_082749_create_companies_table',1),(9,'2022_09_29_082830_create_types_table',1),(10,'2022_09_29_084413_create_users_table',1),(11,'2022_09_29_084726_add_two_factor_columns_to_user_table',1),(12,'2022_10_10_114154_create_links_table',1),(13,'2022_11_16_150551_create_userrooms_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
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
-- Table structure for table `rooms`
--

DROP TABLE IF EXISTS `rooms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rooms` (
  `number` int(11) NOT NULL,
  `capacity` int(11) NOT NULL,
  `wifi` tinyint(1) NOT NULL,
  `smoking_area` tinyint(1) NOT NULL,
  `animals` tinyint(1) NOT NULL,
  `id_hotel` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`number`,`id_hotel`),
  KEY `rooms_id_hotel_foreign` (`id_hotel`),
  CONSTRAINT `rooms_id_hotel_foreign` FOREIGN KEY (`id_hotel`) REFERENCES `hotels` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rooms`
--

LOCK TABLES `rooms` WRITE;
/*!40000 ALTER TABLE `rooms` DISABLE KEYS */;
INSERT INTO `rooms` VALUES (10,6,1,1,0,2),(14,6,0,0,1,1),(22,1,1,0,0,2),(79,2,0,0,0,1),(100,5,1,1,0,1),(111,4,0,0,0,1),(113,2,1,0,1,1),(120,4,0,1,1,1),(234,1,0,0,0,1),(301,8,0,0,1,1),(333,10,1,0,1,1),(420,12,1,1,1,1);
/*!40000 ALTER TABLE `rooms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `types`
--

DROP TABLE IF EXISTS `types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `types` (
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `types`
--

LOCK TABLES `types` WRITE;
/*!40000 ALTER TABLE `types` DISABLE KEYS */;
INSERT INTO `types` VALUES ('admin'),('assistente'),('consigliere'),('partecipante');
/*!40000 ALTER TABLE `types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `userrooms`
--

DROP TABLE IF EXISTS `userrooms`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `userrooms` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` bigint(20) unsigned NOT NULL,
  `number_room` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `userrooms_id_user_foreign` (`id_user`),
  KEY `userrooms_number_room_foreign` (`number_room`),
  CONSTRAINT `userrooms_id_user_foreign` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`),
  CONSTRAINT `userrooms_number_room_foreign` FOREIGN KEY (`number_room`) REFERENCES `rooms` (`number`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `userrooms`
--

LOCK TABLES `userrooms` WRITE;
/*!40000 ALTER TABLE `userrooms` DISABLE KEYS */;
/*!40000 ALTER TABLE `userrooms` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `gender` tinyint(1) DEFAULT NULL,
  `name_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `two_factor_confirmed_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_name_type_foreign` (`name_type`),
  CONSTRAINT `users_name_type_foreign` FOREIGN KEY (`name_type`) REFERENCES `types` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin@example.com','Admin','Admin','2022-05-28',1,'admin','$2y$10$GUKkLlic3YSyfTnv8wjVCOzcRD5wRRTus86Ykgcd/M3Zs1E5JbtpK',NULL,NULL,NULL,NULL,'2022-12-05 12:24:55','2022-12-05 12:24:55'),(2,'alice@example.com','Alicia','Rossi','2004-02-14',0,'consigliere','$2y$10$oQ936bYSSCyJbO1xtN6YKedYKe2MkHhKC/Z0gQjli/svMBgKe17hq',NULL,NULL,NULL,NULL,'2022-12-05 12:25:08','2022-12-05 12:25:08'),(3,'user@example.com','Marco','Verdi','1999-04-01',1,'partecipante','$2y$10$IwWOCkA7f69Dh2EbbIeHKO83vV7JRK6MxUkM.bOzoQAIj0kJiWKZy',NULL,NULL,NULL,NULL,'2022-12-05 12:25:23','2022-12-05 12:25:23');
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

-- Dump completed on 2022-12-05 14:49:25
