-- MySQL dump 10.13  Distrib 5.7.20, for Linux (x86_64)
--
-- Host: localhost    Database: monitoring_lab_auth
-- ------------------------------------------------------
-- Server version	5.7.22-0ubuntu0.16.04.1

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
-- Table structure for table `menu`
--

DROP TABLE IF EXISTS `menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) DEFAULT NULL,
  `slug` varchar(55) DEFAULT NULL,
  `url` varchar(55) DEFAULT NULL,
  `menu_group_id` int(5) DEFAULT NULL,
  `have_sub_menu` tinyint(1) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `order` int(3) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `slug_UNIQUE` (`slug`),
  UNIQUE KEY `url_UNIQUE` (`url`),
  KEY `fk_menu_1_idx` (`menu_group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu`
--

LOCK TABLES `menu` WRITE;
/*!40000 ALTER TABLE `menu` DISABLE KEYS */;
INSERT INTO `menu` VALUES (23,'User Administrator','user-administrartor','user_administrator()',2,0,1,1,NULL,NULL),(44,'Daerah','daerah','menu_master_daerah()',3,0,1,2,NULL,NULL),(45,'Jabatan','jabatan','menu_master_jabatan()',3,0,1,3,NULL,NULL),(46,'Kelompok Metode Pengujian','kelompok-metode-pengujian','menu_master_kel_metode_pengujian()',3,0,1,4,NULL,NULL),(47,'Laboratorium','laboratorium','menu_master_laboratorium()',3,0,1,5,NULL,NULL),(48,'Target Pengujian','target-pengujian','menu_master_target_pengujian()',3,0,1,6,NULL,NULL),(49,'Metode Pengujian','metode-pengujian','menu_master_metode_pengujian()',3,0,1,7,NULL,NULL),(50,'Pegawai','pegawai','menu_master_pegawai()',3,0,1,8,NULL,NULL),(51,'Kode HS','kode-hs','menu_master_kode_hs()',3,0,1,9,NULL,NULL),(52,'Kelompok Sample','kelompok-sample','menu_master_kelompok_sample()',3,0,1,10,NULL,NULL),(53,'Satuan','satuan','menu_master_satuan()',3,0,1,11,NULL,NULL),(54,'Upt','upt','menu_master_upt()',3,0,1,12,NULL,NULL),(55,'Target Uji Golongan','target-uji-golongan','menu_master_target_uji_golongan()',3,0,1,13,NULL,NULL),(56,'Target Pest','target-pest','menu_master_target_pest()',3,0,1,14,NULL,NULL),(57,'Jenis Pengujian','jenis-pengujian','menu_master_jenis_pengujian()',3,0,1,15,NULL,NULL),(58,'Perusahaan','perusahaan','menu_master_perusahaan()',3,0,1,16,NULL,NULL),(59,'Negara','negara','menu_master_negara()',3,0,1,17,NULL,NULL),(60,'Media Transpor','media-transpor','menu_master_media_transpor()',3,0,1,18,NULL,NULL),(61,'Kegiatan','kegiatan','menu_master_kegiatan()',3,0,1,19,NULL,NULL),(62,'Dokter Hewan','dokter-hewan','menu_master_dokter_hewan()',3,0,1,20,NULL,NULL),(64,'Kategori','kategori','menu_master_kategori()',3,0,1,22,NULL,NULL),(65,'Daftar Sample','sample','menu_master_sample()',1,0,1,23,NULL,NULL),(66,'Permohonan','permohonan','menu_master_permohonan()',1,0,1,24,NULL,NULL);
/*!40000 ALTER TABLE `menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `menu_group`
--

DROP TABLE IF EXISTS `menu_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `menu_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `icon` varchar(45) DEFAULT NULL,
  `order` int(2) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `system_id` int(5) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title_UNIQUE` (`title`),
  KEY `fk_menu_group_1_idx` (`system_id`),
  CONSTRAINT `fk_menu_group_1` FOREIGN KEY (`system_id`) REFERENCES `system` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `menu_group`
--

LOCK TABLES `menu_group` WRITE;
/*!40000 ALTER TABLE `menu_group` DISABLE KEYS */;
INSERT INTO `menu_group` VALUES (1,'DATA MONITORING','fa-book',1,1,1,NULL,NULL),(2,'AMS','fa-user',2,1,2,NULL,NULL),(3,'MASTER DATA','fa-book',3,1,1,NULL,NULL);
/*!40000 ALTER TABLE `menu_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `privilage`
--

DROP TABLE IF EXISTS `privilage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `privilage` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `privilage`
--

LOCK TABLES `privilage` WRITE;
/*!40000 ALTER TABLE `privilage` DISABLE KEYS */;
INSERT INTO `privilage` VALUES (1,'User Privilage','User Privilage','User Privilage',NULL,NULL),(2,'Admin Privilage','Admin Privilage','Admin Privilage',NULL,NULL);
/*!40000 ALTER TABLE `privilage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role`
--

DROP TABLE IF EXISTS `role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `role` (
  `user_id` int(10) NOT NULL,
  `privilage_id` int(10) NOT NULL,
  PRIMARY KEY (`user_id`,`privilage_id`),
  KEY `fk_role_2_idx` (`privilage_id`),
  CONSTRAINT `fk_role_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_role_2` FOREIGN KEY (`privilage_id`) REFERENCES `privilage` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role`
--

LOCK TABLES `role` WRITE;
/*!40000 ALTER TABLE `role` DISABLE KEYS */;
INSERT INTO `role` VALUES (1,2);
/*!40000 ALTER TABLE `role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sub_menu`
--

DROP TABLE IF EXISTS `sub_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sub_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(60) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `url` varchar(100) NOT NULL,
  `menu_id` int(3) NOT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `title_UNIQUE` (`title`),
  UNIQUE KEY `slug_UNIQUE` (`slug`),
  UNIQUE KEY `url_UNIQUE` (`url`),
  KEY `fk_sub_menu_1_idx` (`menu_id`),
  CONSTRAINT `fk_sub_menu_1` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sub_menu`
--

LOCK TABLES `sub_menu` WRITE;
/*!40000 ALTER TABLE `sub_menu` DISABLE KEYS */;
/*!40000 ALTER TABLE `sub_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system`
--

DROP TABLE IF EXISTS `system`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `slug` varchar(90) NOT NULL,
  `order` tinyint(2) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `name_UNIQUE` (`name`),
  UNIQUE KEY `slug_UNIQUE` (`slug`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system`
--

LOCK TABLES `system` WRITE;
/*!40000 ALTER TABLE `system` DISABLE KEYS */;
INSERT INTO `system` VALUES (1,'CONTENT MANAGEMENT SYSTEM','cms',1,NULL,NULL),(2,'ACCOUNT MANAGEMENT SYSTEM','ams',2,NULL,NULL);
/*!40000 ALTER TABLE `system` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `system_location`
--

DROP TABLE IF EXISTS `system_location`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `system_location` (
  `user_id` int(3) NOT NULL,
  `system_id` int(3) NOT NULL,
  PRIMARY KEY (`user_id`,`system_id`),
  KEY `fk_system_location_1_idx` (`user_id`),
  KEY `fk_system_location_2_idx` (`system_id`),
  CONSTRAINT `FK_system_location_system` FOREIGN KEY (`system_id`) REFERENCES `system` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_system_location_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `system_location`
--

LOCK TABLES `system_location` WRITE;
/*!40000 ALTER TABLE `system_location` DISABLE KEYS */;
INSERT INTO `system_location` VALUES (1,1),(1,2);
/*!40000 ALTER TABLE `system_location` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_menu`
--

DROP TABLE IF EXISTS `user_menu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_menu` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `user_id` int(10) NOT NULL,
  `menu_id` int(10) NOT NULL,
  PRIMARY KEY (`id`,`user_id`,`menu_id`),
  KEY `fk_user_menu_1_idx` (`user_id`),
  KEY `fk_user_menu_2_idx` (`menu_id`),
  CONSTRAINT `fk_user_menu_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_user_menu_2` FOREIGN KEY (`menu_id`) REFERENCES `menu` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=579 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_menu`
--

LOCK TABLES `user_menu` WRITE;
/*!40000 ALTER TABLE `user_menu` DISABLE KEYS */;
INSERT INTO `user_menu` VALUES (556,1,44),(557,1,62),(558,1,45),(559,1,57),(560,1,64),(561,1,61),(562,1,46),(563,1,52),(564,1,51),(565,1,47),(566,1,60),(567,1,49),(568,1,59),(569,1,50),(570,1,58),(571,1,53),(572,1,48),(573,1,56),(574,1,55),(575,1,54),(576,1,65),(577,1,66),(578,1,23);
/*!40000 ALTER TABLE `user_menu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(80) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email_UNIQUE` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','sheqbo@gmail.com','$2y$10$HID2BFqetjGlJQQ5biCpXuSMTqQfbU.EqeS/2ARWU0A7v7WzIT59i','0GI5iQB7xP7VR7Er1qD1oDjDeSzFUeqOXmsQEhMyIAdYHT4L8uNQz2KqwJsw',1,'2017-05-04 09:58:53','2018-05-29 09:24:07');
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

-- Dump completed on 2018-06-07 19:42:12
