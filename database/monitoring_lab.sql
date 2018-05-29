-- MySQL dump 10.13  Distrib 5.7.20, for Linux (x86_64)
--
-- Host: localhost    Database: monitoring_lab
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
-- Table structure for table `tbl_daftar_daerah`
--

DROP TABLE IF EXISTS `tbl_daftar_daerah`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_daftar_daerah` (
  `id` int(10) NOT NULL,
  `kode_daerah` varchar(20) NOT NULL,
  `nama_daerah` varchar(150) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode_daerah_UNIQUE` (`kode_daerah`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_daftar_daerah`
--

LOCK TABLES `tbl_daftar_daerah` WRITE;
/*!40000 ALTER TABLE `tbl_daftar_daerah` DISABLE KEYS */;
INSERT INTO `tbl_daftar_daerah` VALUES (1,'KD-214','Kab. Simelue 2','2018-05-25 04:16:45','2018-05-25 04:16:45');
/*!40000 ALTER TABLE `tbl_daftar_daerah` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_daftar_pengujian`
--

DROP TABLE IF EXISTS `tbl_daftar_pengujian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_daftar_pengujian` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `target_pengujian_id` int(5) DEFAULT NULL,
  `kode_hph` varchar(40) NOT NULL,
  `lama_uji` int(5) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tbl_daftar_pengujian_1_idx` (`target_pengujian_id`),
  CONSTRAINT `fk_tbl_daftar_pengujian_1` FOREIGN KEY (`target_pengujian_id`) REFERENCES `tbl_target_pengujian` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_daftar_pengujian`
--

LOCK TABLES `tbl_daftar_pengujian` WRITE;
/*!40000 ALTER TABLE `tbl_daftar_pengujian` DISABLE KEYS */;
INSERT INTO `tbl_daftar_pengujian` VALUES (1,1,'HPH-001',5,'2018-05-25 15:06:04','2018-05-25 15:06:04'),(2,2,'HPH-002',6,'2018-05-25 15:06:18','2018-05-25 15:06:18');
/*!40000 ALTER TABLE `tbl_daftar_pengujian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_dokter`
--

DROP TABLE IF EXISTS `tbl_dokter`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_dokter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nip_dokter` varchar(20) NOT NULL,
  `nama_lengkap` varchar(75) NOT NULL,
  `alamat` text,
  `no_telpon` varchar(15) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nip_dokter_UNIQUE` (`nip_dokter`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_dokter`
--

LOCK TABLES `tbl_dokter` WRITE;
/*!40000 ALTER TABLE `tbl_dokter` DISABLE KEYS */;
INSERT INTO `tbl_dokter` VALUES (1,'19874214022412424','Drh. Dwi Untari','Jakarta','08937234234',NULL,'2018-05-25 14:16:05'),(2,'123456789','Dr Nama Lengkap','Jakarta pusat','08937234234','2018-05-25 14:16:31','2018-05-25 14:16:31');
/*!40000 ALTER TABLE `tbl_dokter` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_hasil_laboratorium`
--

DROP TABLE IF EXISTS `tbl_hasil_laboratorium`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_hasil_laboratorium` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `karantina_tumbuhan_id` int(10) NOT NULL,
  `hasil` varchar(50) DEFAULT NULL,
  `kesimpulan` varchar(20) DEFAULT NULL,
  `keterangan` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tbl_hasil_pemeriksaan_1_idx` (`karantina_tumbuhan_id`),
  CONSTRAINT `fk_tbl_hasil_pemeriksaan_1` FOREIGN KEY (`karantina_tumbuhan_id`) REFERENCES `tbl_karantina_tumbuhan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_hasil_laboratorium`
--

LOCK TABLES `tbl_hasil_laboratorium` WRITE;
/*!40000 ALTER TABLE `tbl_hasil_laboratorium` DISABLE KEYS */;
INSERT INTO `tbl_hasil_laboratorium` VALUES (1,2,'8,42 EU','Positif','Keterangan','2018-05-27 04:46:44','2018-05-27 04:46:44');
/*!40000 ALTER TABLE `tbl_hasil_laboratorium` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_jabatan`
--

DROP TABLE IF EXISTS `tbl_jabatan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_jabatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_jabatan` varchar(20) DEFAULT NULL,
  `nama_jabatan` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_jabatan`
--

LOCK TABLES `tbl_jabatan` WRITE;
/*!40000 ALTER TABLE `tbl_jabatan` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_jabatan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_karantina_tumbuhan`
--

DROP TABLE IF EXISTS `tbl_karantina_tumbuhan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_karantina_tumbuhan` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `no_permohonan` varchar(80) NOT NULL,
  `tgl_permohonan` date NOT NULL,
  `kodefikasi_sample` int(10) NOT NULL,
  `kategori_id` int(10) NOT NULL,
  `upt_id` int(10) NOT NULL,
  `dokter_id` int(10) NOT NULL,
  `kegiatan_id` int(10) NOT NULL,
  `kode_area` varchar(40) NOT NULL,
  `perusahaan_id` int(10) NOT NULL,
  `dokument_pendukung` varchar(255) DEFAULT NULL,
  `lampiran_hsl_uji` int(1) NOT NULL DEFAULT '0' COMMENT '1 : ada\n0 : Tidak ada',
  `pengiriman_sample` int(1) NOT NULL DEFAULT '1' COMMENT '1 : Diantar Langsung\n2 : Jasa Pos/Kurir',
  `nama_pengantar` varchar(70) NOT NULL,
  `tgl_terima_sample` date NOT NULL,
  `nip_petugas_penerima` varchar(40) NOT NULL,
  `keterangan` text,
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '0= ditolak\n1 = pending\n2= disetujui',
  `saran` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_id` int(10) DEFAULT '1',
  `updated_by` int(10) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `no_permohonan_UNIQUE` (`no_permohonan`),
  KEY `fk_tbl_karantina_tumbuhan_1_idx` (`kodefikasi_sample`),
  KEY `fk_tbl_karantina_tumbuhan_2_idx` (`kategori_id`),
  KEY `fk_tbl_karantina_tumbuhan_3_idx` (`upt_id`),
  KEY `fk_tbl_karantina_tumbuhan_4_idx` (`dokter_id`),
  KEY `fk_tbl_karantina_tumbuhan_5_idx` (`kegiatan_id`),
  KEY `fk_tbl_karantina_tumbuhan_6_idx` (`perusahaan_id`),
  CONSTRAINT `fk_tbl_karantina_tumbuhan_1` FOREIGN KEY (`kodefikasi_sample`) REFERENCES `tbl_sample_tumbuhan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_tbl_karantina_tumbuhan_2` FOREIGN KEY (`kategori_id`) REFERENCES `tbl_kategori` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_tbl_karantina_tumbuhan_3` FOREIGN KEY (`upt_id`) REFERENCES `tbl_upt` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_tbl_karantina_tumbuhan_4` FOREIGN KEY (`dokter_id`) REFERENCES `tbl_dokter` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_tbl_karantina_tumbuhan_5` FOREIGN KEY (`kegiatan_id`) REFERENCES `tbl_kegiatan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_tbl_karantina_tumbuhan_6` FOREIGN KEY (`perusahaan_id`) REFERENCES `tbl_perusahaan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_karantina_tumbuhan`
--

LOCK TABLES `tbl_karantina_tumbuhan` WRITE;
/*!40000 ALTER TABLE `tbl_karantina_tumbuhan` DISABLE KEYS */;
INSERT INTO `tbl_karantina_tumbuhan` VALUES (1,'110822546547','2018-04-10',1,1,1,1,1,'33545',1,NULL,0,2,'Test Nama','2018-04-12','00554881051',NULL,2,'Saran',NULL,'2018-05-27 05:47:16',1,NULL),(2,'6483910527','2018-05-26',1,1,1,1,1,'fasfasfasfsa',1,'',0,1,'Nama Pengantar','2018-05-25','24141412412412','',1,NULL,'2018-05-25 17:16:18','2018-05-25 17:16:18',1,NULL),(3,'PRM-JIHXQ8OWTY47MB1905UZAENF2RL6KDSPGV3C','2018-05-30',1,1,1,1,1,'16511',1,'',0,1,'Kiki','2018-05-28','24141412412412','',1,NULL,'2018-05-28 19:37:57','2018-05-28 19:37:57',2,NULL),(9,'PRM-HKI8UA6QZTPJWV03CNY9OG4DS2X1MERFLB57','2018-05-29',1,1,1,1,1,'16511',1,'report (36).pdf',1,1,'Kiki','2018-05-29','24141412412412','',1,NULL,'2018-05-29 16:59:12','2018-05-29 16:59:12',1,NULL);
/*!40000 ALTER TABLE `tbl_karantina_tumbuhan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_kategori`
--

DROP TABLE IF EXISTS `tbl_kategori`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_kategori` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_kategori`
--

LOCK TABLES `tbl_kategori` WRITE;
/*!40000 ALTER TABLE `tbl_kategori` DISABLE KEYS */;
INSERT INTO `tbl_kategori` VALUES (1,'Identifikasi 2',NULL,NULL,'2018-05-25 12:41:45');
/*!40000 ALTER TABLE `tbl_kategori` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_kegiatan`
--

DROP TABLE IF EXISTS `tbl_kegiatan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_kegiatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kegiatan` varchar(60) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_kegiatan`
--

LOCK TABLES `tbl_kegiatan` WRITE;
/*!40000 ALTER TABLE `tbl_kegiatan` DISABLE KEYS */;
INSERT INTO `tbl_kegiatan` VALUES (1,'Karantina Antar Area',NULL,NULL,NULL);
/*!40000 ALTER TABLE `tbl_kegiatan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_kelompok_pengujian`
--

DROP TABLE IF EXISTS `tbl_kelompok_pengujian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_kelompok_pengujian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kelompok` varchar(150) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_kelompok_pengujian`
--

LOCK TABLES `tbl_kelompok_pengujian` WRITE;
/*!40000 ALTER TABLE `tbl_kelompok_pengujian` DISABLE KEYS */;
INSERT INTO `tbl_kelompok_pengujian` VALUES (1,'Nama Kelompok','2018-05-25 16:02:22','2018-05-25 16:02:22'),(2,'Nama Kelompok 2','2018-05-25 16:02:18','2018-05-25 16:02:18');
/*!40000 ALTER TABLE `tbl_kelompok_pengujian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_korfug`
--

DROP TABLE IF EXISTS `tbl_korfug`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_korfug` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dokter_id` int(5) NOT NULL,
  `tgl_usulan` date NOT NULL,
  `nip_korfug` varchar(50) NOT NULL,
  `karantina_tumbuhan_id` int(10) NOT NULL,
  `kedudukan` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tbl_korfug_1_idx` (`dokter_id`),
  KEY `fk_tbl_korfug_2_idx` (`karantina_tumbuhan_id`),
  CONSTRAINT `fk_tbl_korfug_1` FOREIGN KEY (`dokter_id`) REFERENCES `tbl_dokter` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_tbl_korfug_2` FOREIGN KEY (`karantina_tumbuhan_id`) REFERENCES `tbl_karantina_tumbuhan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_korfug`
--

LOCK TABLES `tbl_korfug` WRITE;
/*!40000 ALTER TABLE `tbl_korfug` DISABLE KEYS */;
INSERT INTO `tbl_korfug` VALUES (3,1,'2018-05-28','19874214022412424',1,'Analis','2018-05-27 09:15:55','2018-05-27 09:15:55'),(4,1,'2018-05-28','19874214022412424',2,'Penyelia','2018-05-27 09:44:34','2018-05-27 09:44:34'),(5,2,'2018-05-29','123456789',2,'Analis','2018-05-28 18:58:01','2018-05-28 18:58:01');
/*!40000 ALTER TABLE `tbl_korfug` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_laboratorium`
--

DROP TABLE IF EXISTS `tbl_laboratorium`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_laboratorium` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_laboratorium` varchar(150) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_laboratorium`
--

LOCK TABLES `tbl_laboratorium` WRITE;
/*!40000 ALTER TABLE `tbl_laboratorium` DISABLE KEYS */;
INSERT INTO `tbl_laboratorium` VALUES (1,'Nama Laboratorium');
/*!40000 ALTER TABLE `tbl_laboratorium` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_metode_pengujian`
--

DROP TABLE IF EXISTS `tbl_metode_pengujian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_metode_pengujian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kelompok` varchar(150) NOT NULL,
  `target_pengujian_id` int(5) DEFAULT NULL,
  `laboratorium_id` int(5) DEFAULT NULL,
  `kelompok_uji_id` int(5) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tbl_metode_pengujian_1_idx` (`target_pengujian_id`),
  KEY `fk_tbl_metode_pengujian_2_idx` (`laboratorium_id`),
  KEY `fk_tbl_metode_pengujian_3_idx` (`kelompok_uji_id`),
  CONSTRAINT `fk_tbl_metode_pengujian_1` FOREIGN KEY (`target_pengujian_id`) REFERENCES `tbl_target_pengujian` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_tbl_metode_pengujian_2` FOREIGN KEY (`laboratorium_id`) REFERENCES `tbl_laboratorium` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_tbl_metode_pengujian_3` FOREIGN KEY (`kelompok_uji_id`) REFERENCES `tbl_kelompok_pengujian` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_metode_pengujian`
--

LOCK TABLES `tbl_metode_pengujian` WRITE;
/*!40000 ALTER TABLE `tbl_metode_pengujian` DISABLE KEYS */;
INSERT INTO `tbl_metode_pengujian` VALUES (1,'Nama Kelompok',1,1,1,'2018-05-25 15:36:32','2018-05-25 15:36:32'),(2,'Nama Kelompok 2',2,1,2,'2018-05-25 16:05:52','2018-05-25 16:05:52');
/*!40000 ALTER TABLE `tbl_metode_pengujian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_penugasan`
--

DROP TABLE IF EXISTS `tbl_penugasan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_penugasan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `no_surat` varchar(50) NOT NULL,
  `target_uji_id` int(10) NOT NULL,
  `kedudukan` varchar(25) DEFAULT NULL,
  `karantina_tumbuhan_id` int(10) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tbl_penugasan_1_idx` (`target_uji_id`),
  KEY `fk_tbl_penugasan_2_idx` (`karantina_tumbuhan_id`),
  CONSTRAINT `fk_tbl_penugasan_1` FOREIGN KEY (`target_uji_id`) REFERENCES `tbl_target_pengujian` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_tbl_penugasan_2` FOREIGN KEY (`karantina_tumbuhan_id`) REFERENCES `tbl_karantina_tumbuhan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_penugasan`
--

LOCK TABLES `tbl_penugasan` WRITE;
/*!40000 ALTER TABLE `tbl_penugasan` DISABLE KEYS */;
INSERT INTO `tbl_penugasan` VALUES (1,'SP-88037',1,'Penyelia',2,'2018-05-26 21:54:11','2018-05-26 21:54:11');
/*!40000 ALTER TABLE `tbl_penugasan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_perusahaan`
--

DROP TABLE IF EXISTS `tbl_perusahaan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_perusahaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_perusahaan` varchar(50) NOT NULL,
  `nama_perusahaan` varchar(100) NOT NULL,
  `alamat` text NOT NULL,
  `no_telpon` varchar(15) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `created_by` int(10) DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode_perusahaan_UNIQUE` (`kode_perusahaan`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_perusahaan`
--

LOCK TABLES `tbl_perusahaan` WRITE;
/*!40000 ALTER TABLE `tbl_perusahaan` DISABLE KEYS */;
INSERT INTO `tbl_perusahaan` VALUES (1,'KP-1219','PT. Equalindo Makmur Alam Sejahtera','Tenggarong Seberang, Kutai Kartanegara','08937234234',NULL,NULL,'2018-05-25 13:46:41');
/*!40000 ALTER TABLE `tbl_perusahaan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_sample_tumbuhan`
--

DROP TABLE IF EXISTS `tbl_sample_tumbuhan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_sample_tumbuhan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_sample` varchar(45) NOT NULL,
  `nama_sample` varchar(200) NOT NULL,
  `jenis_sample` varchar(100) DEFAULT NULL,
  `jml_vol` int(5) DEFAULT NULL,
  `satuan` varchar(45) DEFAULT NULL,
  `nama_komoditas` varchar(200) DEFAULT NULL,
  `tgl_pengambilan_sample` date DEFAULT NULL,
  `metode_pengambilan_sample` varchar(50) DEFAULT NULL,
  `kondisi_sample` int(1) DEFAULT NULL,
  `target_pengujian_id` int(5) NOT NULL,
  `nama_customer` varchar(70) DEFAULT NULL,
  `alamat` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode_sample_UNIQUE` (`kode_sample`),
  KEY `fk_tbl_sample_tumbuhan_1_idx` (`target_pengujian_id`),
  CONSTRAINT `fk_tbl_sample_tumbuhan_1` FOREIGN KEY (`target_pengujian_id`) REFERENCES `tbl_target_pengujian` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_sample_tumbuhan`
--

LOCK TABLES `tbl_sample_tumbuhan` WRITE;
/*!40000 ALTER TABLE `tbl_sample_tumbuhan` DISABLE KEYS */;
INSERT INTO `tbl_sample_tumbuhan` VALUES (1,'SA0001','Nama Sample','Umbi',20,'GRM','Nama Komoditas','2018-05-12','Random',1,1,'Nama Customer','Alamat Customer','2018-05-19 21:22:35',NULL),(2,'SH-1897','Nama Sample','Umbi',5,'GRM','Nama Komoditas','2018-05-12','Random',1,2,'Nama Customer','Alamat Customer','2018-05-25 17:08:29',NULL);
/*!40000 ALTER TABLE `tbl_sample_tumbuhan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_target_pengujian`
--

DROP TABLE IF EXISTS `tbl_target_pengujian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_target_pengujian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_target` varchar(150) NOT NULL,
  `target_hph` varchar(150) NOT NULL,
  `keterangan` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_target_pengujian`
--

LOCK TABLES `tbl_target_pengujian` WRITE;
/*!40000 ALTER TABLE `tbl_target_pengujian` DISABLE KEYS */;
INSERT INTO `tbl_target_pengujian` VALUES (1,'Nama Target','Bachilius','Keterangan','2018-05-25 16:19:06','2018-05-25 16:19:06'),(2,'Nama Target 2','Bachilius P','Keterangan','2018-05-25 16:19:56','2018-05-25 16:19:56');
/*!40000 ALTER TABLE `tbl_target_pengujian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_upt`
--

DROP TABLE IF EXISTS `tbl_upt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_upt` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `kode_upt` varchar(50) NOT NULL,
  `nama_upt` varchar(150) NOT NULL,
  `kelas_upt` varchar(150) DEFAULT NULL,
  `lab_id` int(5) DEFAULT NULL,
  `jns_pelabuhan` varchar(50) DEFAULT NULL,
  `daerah_id` int(10) NOT NULL,
  `alamat` text,
  `no_tlp` varchar(15) DEFAULT NULL,
  `no_fax` varchar(15) DEFAULT NULL,
  `email` varchar(35) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode_upt_UNIQUE` (`kode_upt`),
  KEY `fk_tbl_upt_1_idx` (`lab_id`),
  KEY `fk_tbl_upt_2_idx` (`daerah_id`),
  CONSTRAINT `fk_tbl_upt_1` FOREIGN KEY (`lab_id`) REFERENCES `tbl_laboratorium` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_tbl_upt_2` FOREIGN KEY (`daerah_id`) REFERENCES `tbl_daftar_daerah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_upt`
--

LOCK TABLES `tbl_upt` WRITE;
/*!40000 ALTER TABLE `tbl_upt` DISABLE KEYS */;
INSERT INTO `tbl_upt` VALUES (1,'01801','Wilker Pelabuhan Laut Belawan',NULL,1,'Laut',1,NULL,NULL,NULL,NULL,NULL,NULL),(2,'U-79','Nama Upt 2','Kelas Upt',1,'Udara',1,'jl jati sawangan rt 04/03 no 02','+6281287679290','02155669947477','sheqbo@gmail.com','2018-05-25 11:52:57','2018-05-25 11:52:57');
/*!40000 ALTER TABLE `tbl_upt` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_verifikasi_pengujian`
--

DROP TABLE IF EXISTS `tbl_verifikasi_pengujian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_verifikasi_pengujian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kodefikasi_sample` int(10) DEFAULT NULL,
  `kesiapan_pengujian` int(1) DEFAULT '0' COMMENT '0 = Tidak\n1 = Ya',
  `alasan` varchar(100) DEFAULT NULL,
  `lama_pengujian` int(1) DEFAULT NULL COMMENT 'Satuan = Hari',
  `kondisi_analis` int(1) DEFAULT '0' COMMENT '0 = Buruk\n1 = Baik',
  `kondisi_bahan` int(1) DEFAULT '0' COMMENT '0 = Tidak Tersedia\n1 = Tersedia',
  `kondisi_alat` int(1) DEFAULT '0' COMMENT '0 = Buruk\n1 = Baik',
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tbl_verifikasi_pengujian_1_idx` (`kodefikasi_sample`),
  CONSTRAINT `fk_tbl_verifikasi_pengujian_1` FOREIGN KEY (`kodefikasi_sample`) REFERENCES `tbl_sample_tumbuhan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_verifikasi_pengujian`
--

LOCK TABLES `tbl_verifikasi_pengujian` WRITE;
/*!40000 ALTER TABLE `tbl_verifikasi_pengujian` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_verifikasi_pengujian` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-05-30  0:47:01
