-- MySQL dump 10.13  Distrib 5.7.20, for Linux (x86_64)
--
-- Host: localhost    Database: new_monitoring_lab
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
-- Table structure for table `tbl_daerah`
--

DROP TABLE IF EXISTS `tbl_daerah`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_daerah` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_daerah` varchar(15) NOT NULL,
  `nama_daerah` varchar(150) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode_daerah_UNIQUE` (`kode_daerah`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_daerah`
--

LOCK TABLES `tbl_daerah` WRITE;
/*!40000 ALTER TABLE `tbl_daerah` DISABLE KEYS */;
INSERT INTO `tbl_daerah` VALUES (1,'KD-667','Kab. Simelue','2018-06-02 20:18:09','2018-06-02 20:18:47');
/*!40000 ALTER TABLE `tbl_daerah` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_dokter_hewan`
--

DROP TABLE IF EXISTS `tbl_dokter_hewan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_dokter_hewan` (
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
-- Dumping data for table `tbl_dokter_hewan`
--

LOCK TABLES `tbl_dokter_hewan` WRITE;
/*!40000 ALTER TABLE `tbl_dokter_hewan` DISABLE KEYS */;
INSERT INTO `tbl_dokter_hewan` VALUES (1,'NDH-950.848','DRH. Riani Pratiwi','Jakarta Pusat','08937234234','2018-06-04 07:23:56','2018-06-04 07:23:56'),(2,'NDH-308.829','DRH. Edho Sulaiman','Jakarta Selatan','08937234234','2018-06-04 07:24:19','2018-06-04 07:24:27');
/*!40000 ALTER TABLE `tbl_dokter_hewan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_jabatan`
--

DROP TABLE IF EXISTS `tbl_jabatan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_jabatan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_jabatan` varchar(15) NOT NULL,
  `nama_jabatan` varchar(150) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode_jabatan_UNIQUE` (`kode_jabatan`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_jabatan`
--

LOCK TABLES `tbl_jabatan` WRITE;
/*!40000 ALTER TABLE `tbl_jabatan` DISABLE KEYS */;
INSERT INTO `tbl_jabatan` VALUES (1,'KJ-664','Bendahara','2018-06-02 20:31:11','2018-06-02 20:31:17');
/*!40000 ALTER TABLE `tbl_jabatan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_jenis_pengujian`
--

DROP TABLE IF EXISTS `tbl_jenis_pengujian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_jenis_pengujian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_jenis_pengujian` varchar(150) NOT NULL,
  `target_pengujian_id` int(5) NOT NULL,
  `metode_pengujian_id` int(10) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tbl_jenis_pengujian_1_idx` (`target_pengujian_id`),
  KEY `fk_tbl_jenis_pengujian_2_idx` (`metode_pengujian_id`),
  CONSTRAINT `fk_tbl_jenis_pengujian_1` FOREIGN KEY (`target_pengujian_id`) REFERENCES `tbl_target_pengujian` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_tbl_jenis_pengujian_2` FOREIGN KEY (`metode_pengujian_id`) REFERENCES `tbl_metode_pengujian` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_jenis_pengujian`
--

LOCK TABLES `tbl_jenis_pengujian` WRITE;
/*!40000 ALTER TABLE `tbl_jenis_pengujian` DISABLE KEYS */;
INSERT INTO `tbl_jenis_pengujian` VALUES (1,'Elisa BVD',1,2,'2018-06-03 11:24:07','2018-06-03 11:24:07'),(2,'HI - AI',1,1,'2018-06-03 11:24:29','2018-06-03 11:24:47');
/*!40000 ALTER TABLE `tbl_jenis_pengujian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_kategori`
--

DROP TABLE IF EXISTS `tbl_kategori`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_kategori` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_kategori` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_kategori`
--

LOCK TABLES `tbl_kategori` WRITE;
/*!40000 ALTER TABLE `tbl_kategori` DISABLE KEYS */;
INSERT INTO `tbl_kategori` VALUES (1,'Identifikasi','2018-06-04 09:16:58','2018-06-04 09:17:03');
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
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_kegiatan`
--

LOCK TABLES `tbl_kegiatan` WRITE;
/*!40000 ALTER TABLE `tbl_kegiatan` DISABLE KEYS */;
INSERT INTO `tbl_kegiatan` VALUES (1,'Karantina Antar Area','2018-06-04 07:08:42','2018-06-04 07:08:55'),(2,'Karantina Antar Daerah','2018-06-04 07:08:51','2018-06-04 07:08:51'),(3,'Eksport','2018-06-04 07:08:51','2018-06-04 07:08:51');
/*!40000 ALTER TABLE `tbl_kegiatan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_kelompok_metode_pengujian`
--

DROP TABLE IF EXISTS `tbl_kelompok_metode_pengujian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_kelompok_metode_pengujian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_kelompok` varchar(15) NOT NULL,
  `nama_kelompok` varchar(150) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode_kelompok_UNIQUE` (`kode_kelompok`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_kelompok_metode_pengujian`
--

LOCK TABLES `tbl_kelompok_metode_pengujian` WRITE;
/*!40000 ALTER TABLE `tbl_kelompok_metode_pengujian` DISABLE KEYS */;
INSERT INTO `tbl_kelompok_metode_pengujian` VALUES (1,'KMP-670','Kimia Sederhana','2018-06-02 20:45:38','2018-06-02 20:45:38'),(2,'KMP-841','Kimia Kompleks','2018-06-02 20:45:55','2018-06-02 20:46:01');
/*!40000 ALTER TABLE `tbl_kelompok_metode_pengujian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_kelompok_sample`
--

DROP TABLE IF EXISTS `tbl_kelompok_sample`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_kelompok_sample` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_kelompok` varchar(15) NOT NULL,
  `nama_kelompok` varchar(150) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode_kelompok_UNIQUE` (`kode_kelompok`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_kelompok_sample`
--

LOCK TABLES `tbl_kelompok_sample` WRITE;
/*!40000 ALTER TABLE `tbl_kelompok_sample` DISABLE KEYS */;
INSERT INTO `tbl_kelompok_sample` VALUES (1,'KS-641','Hewan','2018-06-02 23:47:01','2018-06-02 23:47:01'),(2,'KS-693','Unggas','2018-06-02 23:47:06','2018-06-02 23:47:06'),(3,'KS-181','Mamalia','2018-06-02 23:47:20','2018-06-02 23:47:20'),(4,'KS-623','Reptil','2018-06-02 23:47:27','2018-06-02 23:47:27'),(5,'KS-235','Amfibi','2018-06-02 23:47:34','2018-06-02 23:47:34'),(6,'KS-140','Serangga','2018-06-02 23:47:42','2018-06-02 23:47:42'),(7,'KS-113','Hewan Lain','2018-06-02 23:47:56','2018-06-02 23:47:56');
/*!40000 ALTER TABLE `tbl_kelompok_sample` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_kode_hs`
--

DROP TABLE IF EXISTS `tbl_kode_hs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_kode_hs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_hs` varchar(15) NOT NULL,
  `uraian_komoditas` text,
  `description_english` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode_hs_UNIQUE` (`kode_hs`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_kode_hs`
--

LOCK TABLES `tbl_kode_hs` WRITE;
/*!40000 ALTER TABLE `tbl_kode_hs` DISABLE KEYS */;
INSERT INTO `tbl_kode_hs` VALUES (1,'KHS-475','Kuda, keledai, bagal dan hinne,hidup','Live horses, asses, mules and hinnies','2018-06-02 23:31:56','2018-06-02 23:33:57');
/*!40000 ALTER TABLE `tbl_kode_hs` ENABLE KEYS */;
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
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_laboratorium`
--

LOCK TABLES `tbl_laboratorium` WRITE;
/*!40000 ALTER TABLE `tbl_laboratorium` DISABLE KEYS */;
INSERT INTO `tbl_laboratorium` VALUES (1,'Serologi','2018-06-02 20:56:21','2018-06-02 20:56:21'),(2,'Bakteriologi','2018-06-02 20:56:38','2018-06-02 20:56:38'),(3,'Virologi','2018-06-02 20:56:52','2018-06-02 20:56:52'),(4,'Histlogi','2018-06-02 20:57:03','2018-06-02 20:57:03'),(5,'Patologi','2018-06-02 20:57:13','2018-06-02 20:57:13'),(6,'Parasitologi','2018-06-02 20:57:22','2018-06-02 20:57:22'),(7,'Imunologi','2018-06-02 20:57:31','2018-06-02 20:57:31'),(8,'Toksikologi','2018-06-02 20:57:39','2018-06-02 20:57:39'),(9,'Biomolekuler','2018-06-02 20:57:56','2018-06-02 20:57:56'),(10,'Kimia','2018-06-02 20:58:02','2018-06-02 20:58:32');
/*!40000 ALTER TABLE `tbl_laboratorium` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_media_transpor`
--

DROP TABLE IF EXISTS `tbl_media_transpor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_media_transpor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_media_transpor` varchar(150) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_media_transpor`
--

LOCK TABLES `tbl_media_transpor` WRITE;
/*!40000 ALTER TABLE `tbl_media_transpor` DISABLE KEYS */;
INSERT INTO `tbl_media_transpor` VALUES (1,'Air Kapur','2018-06-04 06:24:14','2018-06-04 06:24:14'),(2,'Spiritus','2018-06-04 06:24:22','2018-06-04 06:24:22'),(3,'Cool Box','2018-06-04 06:24:33','2018-06-04 06:24:33'),(4,'Alkohol 99%','2018-06-04 06:24:45','2018-06-04 06:24:54');
/*!40000 ALTER TABLE `tbl_media_transpor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_metode_pengujian`
--

DROP TABLE IF EXISTS `tbl_metode_pengujian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_metode_pengujian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_metode_pengujian` varchar(150) NOT NULL,
  `target_pengujian_id` int(5) NOT NULL,
  `laboratorium_id` int(5) NOT NULL,
  `kelompok_metode_pengujian_id` int(10) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tbl_metode_pengujian_1_idx` (`target_pengujian_id`),
  KEY `fk_tbl_metode_pengujian_2_idx` (`laboratorium_id`),
  KEY `fk_tbl_metode_pengujian_3_idx` (`kelompok_metode_pengujian_id`),
  CONSTRAINT `fk_tbl_metode_pengujian_1` FOREIGN KEY (`target_pengujian_id`) REFERENCES `tbl_target_pengujian` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_tbl_metode_pengujian_2` FOREIGN KEY (`laboratorium_id`) REFERENCES `tbl_laboratorium` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_tbl_metode_pengujian_3` FOREIGN KEY (`kelompok_metode_pengujian_id`) REFERENCES `tbl_kelompok_metode_pengujian` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_metode_pengujian`
--

LOCK TABLES `tbl_metode_pengujian` WRITE;
/*!40000 ALTER TABLE `tbl_metode_pengujian` DISABLE KEYS */;
INSERT INTO `tbl_metode_pengujian` VALUES (1,'TPC[KM-H-4-01]',1,1,1,NULL,'2018-06-02 22:24:02'),(2,'Eber Test **)',2,10,2,'2018-06-02 22:23:27','2018-06-02 22:23:56');
/*!40000 ALTER TABLE `tbl_metode_pengujian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_negara`
--

DROP TABLE IF EXISTS `tbl_negara`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_negara` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_negara` varchar(15) NOT NULL,
  `nama_negara` varchar(70) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode_negara_UNIQUE` (`kode_negara`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_negara`
--

LOCK TABLES `tbl_negara` WRITE;
/*!40000 ALTER TABLE `tbl_negara` DISABLE KEYS */;
INSERT INTO `tbl_negara` VALUES (1,'ID','Indonesia','2018-06-04 05:31:47','2018-06-04 05:33:11'),(2,'EN','English','2018-06-04 05:33:30','2018-06-04 05:33:30');
/*!40000 ALTER TABLE `tbl_negara` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_pegawai`
--

DROP TABLE IF EXISTS `tbl_pegawai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_pegawai` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nip_pegawai` varchar(150) NOT NULL,
  `nama_lengkap` varchar(150) NOT NULL,
  `jabatan_id` int(5) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nip_UNIQUE` (`nip_pegawai`),
  KEY `fk_tbl_pegawai_1_idx` (`jabatan_id`),
  CONSTRAINT `fk_tbl_pegawai_1` FOREIGN KEY (`jabatan_id`) REFERENCES `tbl_jabatan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_pegawai`
--

LOCK TABLES `tbl_pegawai` WRITE;
/*!40000 ALTER TABLE `tbl_pegawai` DISABLE KEYS */;
INSERT INTO `tbl_pegawai` VALUES (1,'NP-100.100.100','Kiki Kurniawan',1,'2018-06-02 23:09:09','2018-06-02 23:10:43'),(2,'NP-719.206.500','Edie',1,'2018-06-03 11:44:49','2018-06-03 11:44:49'),(3,'NP-219.579.987','Achmad Baharudin',1,'2018-06-03 11:45:14','2018-06-03 11:45:14');
/*!40000 ALTER TABLE `tbl_pegawai` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_permohonan`
--

DROP TABLE IF EXISTS `tbl_permohonan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_permohonan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tgl_permohonan` date NOT NULL,
  `no_agenda` varchar(100) NOT NULL,
  `no_permohonan` varchar(100) NOT NULL,
  `kategori_uji_id` int(5) NOT NULL,
  `dokter_hewan_id` int(5) NOT NULL,
  `kegiatan_id` int(5) NOT NULL,
  `upt_id` int(5) DEFAULT NULL,
  `daerah_id` int(5) DEFAULT NULL,
  `perusahaan_id` int(5) DEFAULT NULL,
  `negara_id` int(3) DEFAULT NULL COMMENT '1: hewan\n2: tumbuhan',
  `type_permohonan` int(1) DEFAULT '1' COMMENT '1: hewan\n2: tumbuhan',
  `nama_pemilik` varchar(100) DEFAULT NULL,
  `alamat_pemilik` text,
  `lampiran_hasil_uji` int(1) DEFAULT '1' COMMENT '1 : ada\n0 : Tidak ada',
  `dokument_pendukung` varchar(255) DEFAULT NULL,
  `pengiriman_sample` int(1) DEFAULT '1' COMMENT '1 : Diantar Langsung\n2 : Jasa Pos/Kurir',
  `nama_pengirim` varchar(100) DEFAULT NULL,
  `tgl_terima_sample` date DEFAULT NULL,
  `nip_petugas_penerima` varchar(70) DEFAULT NULL,
  `keterangan` text,
  `status` int(1) NOT NULL DEFAULT '1' COMMENT '0= ditolak\n1 = pending\n2= disetujui',
  `saran` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `user_id` int(10) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `no_agenda_UNIQUE` (`no_agenda`),
  UNIQUE KEY `no_permohonan_UNIQUE` (`no_permohonan`),
  KEY `fk_tbl_permohonan_1_idx` (`dokter_hewan_id`),
  KEY `fk_tbl_permohonan_2_idx` (`kegiatan_id`),
  CONSTRAINT `fk_tbl_permohonan_1` FOREIGN KEY (`dokter_hewan_id`) REFERENCES `tbl_dokter_hewan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_tbl_permohonan_2` FOREIGN KEY (`kegiatan_id`) REFERENCES `tbl_kegiatan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_permohonan`
--

LOCK TABLES `tbl_permohonan` WRITE;
/*!40000 ALTER TABLE `tbl_permohonan` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_permohonan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_permohonan_pengujian`
--

DROP TABLE IF EXISTS `tbl_permohonan_pengujian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_permohonan_pengujian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `permohonan_id` int(10) NOT NULL,
  `target_uji_golongan_id` int(5) NOT NULL,
  `target_pest_id` int(5) NOT NULL,
  `lama_uji` int(3) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tbl_permohonan_pengujian_1_idx` (`permohonan_id`),
  KEY `fk_tbl_permohonan_pengujian_2_idx` (`target_uji_golongan_id`),
  KEY `fk_tbl_permohonan_pengujian_3_idx` (`target_pest_id`),
  CONSTRAINT `fk_tbl_permohonan_pengujian_1` FOREIGN KEY (`permohonan_id`) REFERENCES `tbl_permohonan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_tbl_permohonan_pengujian_2` FOREIGN KEY (`target_uji_golongan_id`) REFERENCES `tbl_target_uji_golongan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_tbl_permohonan_pengujian_3` FOREIGN KEY (`target_pest_id`) REFERENCES `tbl_target_pest` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_permohonan_pengujian`
--

LOCK TABLES `tbl_permohonan_pengujian` WRITE;
/*!40000 ALTER TABLE `tbl_permohonan_pengujian` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_permohonan_pengujian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_perusahaan`
--

DROP TABLE IF EXISTS `tbl_perusahaan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_perusahaan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_perusahaan` varchar(15) NOT NULL,
  `nama_perusahaan` varchar(150) NOT NULL,
  `alamat` text,
  `no_telpon` varchar(15) DEFAULT NULL,
  `contact_person` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode_perusahaan_UNIQUE` (`kode_perusahaan`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_perusahaan`
--

LOCK TABLES `tbl_perusahaan` WRITE;
/*!40000 ALTER TABLE `tbl_perusahaan` DISABLE KEYS */;
INSERT INTO `tbl_perusahaan` VALUES (1,'KP-100.100','Arifin','BALIKPAPAN','08937234234','','2018-06-03 11:41:46','2018-06-03 11:41:56'),(3,'KP-276.308','Yudi Arisandi','Samarinda','08937234234','','2018-06-03 11:42:58','2018-06-03 11:44:23');
/*!40000 ALTER TABLE `tbl_perusahaan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_sample`
--

DROP TABLE IF EXISTS `tbl_sample`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_sample` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_sample` varchar(45) NOT NULL,
  `nama_sample` varchar(200) NOT NULL,
  `jenis_sample` varchar(100) DEFAULT NULL,
  `jml_vol` int(5) DEFAULT NULL,
  `satuan_id` int(5) NOT NULL,
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
  KEY `fk_tbl_sample_tumbuhan_1_idx` (`satuan_id`),
  KEY `fk_tbl_sample_tumbuhan_2_idx` (`target_pengujian_id`),
  CONSTRAINT `fk_tbl_sample_tumbuhan_1` FOREIGN KEY (`satuan_id`) REFERENCES `tbl_satuan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_tbl_sample_tumbuhan_2` FOREIGN KEY (`target_pengujian_id`) REFERENCES `tbl_target_pengujian` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_sample`
--

LOCK TABLES `tbl_sample` WRITE;
/*!40000 ALTER TABLE `tbl_sample` DISABLE KEYS */;
INSERT INTO `tbl_sample` VALUES (1,'KST-319.263','Serum Darah Kambit Bibit','Serum',1,1,'Serum Darah Kambit Bibit','2018-06-10','Random',1,4,'Ahmad Baharudin','Jakarta','2018-06-04 10:39:52','2018-06-04 10:40:01');
/*!40000 ALTER TABLE `tbl_sample` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_sample_permohonan`
--

DROP TABLE IF EXISTS `tbl_sample_permohonan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_sample_permohonan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `permohonan_id` int(10) NOT NULL,
  `sample_id` int(10) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_tbl_sample_permohonan_2_idx` (`sample_id`),
  KEY `fk_tbl_sample_permohonan_1_idx` (`permohonan_id`),
  CONSTRAINT `fk_tbl_sample_permohonan_1` FOREIGN KEY (`permohonan_id`) REFERENCES `tbl_permohonan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_tbl_sample_permohonan_2` FOREIGN KEY (`sample_id`) REFERENCES `tbl_sample` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_sample_permohonan`
--

LOCK TABLES `tbl_sample_permohonan` WRITE;
/*!40000 ALTER TABLE `tbl_sample_permohonan` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_sample_permohonan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_satuan`
--

DROP TABLE IF EXISTS `tbl_satuan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_satuan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_satuan` varchar(15) NOT NULL,
  `nama_satuan` varchar(150) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode_satuan_UNIQUE` (`kode_satuan`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_satuan`
--

LOCK TABLES `tbl_satuan` WRITE;
/*!40000 ALTER TABLE `tbl_satuan` DISABLE KEYS */;
INSERT INTO `tbl_satuan` VALUES (1,'GRM','Gram','2018-06-03 00:09:25','2018-06-03 00:09:25'),(2,'AMP','Ampul','2018-06-03 00:11:25','2018-06-03 00:18:20');
/*!40000 ALTER TABLE `tbl_satuan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_target_pengujian`
--

DROP TABLE IF EXISTS `tbl_target_pengujian`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_target_pengujian` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_target_pengujian` varchar(150) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_target_pengujian`
--

LOCK TABLES `tbl_target_pengujian` WRITE;
/*!40000 ALTER TABLE `tbl_target_pengujian` DISABLE KEYS */;
INSERT INTO `tbl_target_pengujian` VALUES (1,'Viral','2018-06-02 21:10:36','2018-06-02 21:10:36'),(2,'Mikal','2018-06-02 21:10:40','2018-06-02 21:10:40'),(3,'Bakterial','2018-06-02 21:10:48','2018-06-02 21:10:48'),(4,'Parasit','2018-06-02 21:10:54','2018-06-02 21:10:54'),(5,'Toksin','2018-06-02 21:11:03','2018-06-02 21:11:10');
/*!40000 ALTER TABLE `tbl_target_pengujian` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_target_pest`
--

DROP TABLE IF EXISTS `tbl_target_pest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_target_pest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_target_pest` varchar(15) NOT NULL,
  `nama_target_hph` varchar(150) NOT NULL,
  `target_pengujian_id` int(5) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode_target_pest_UNIQUE` (`kode_target_pest`),
  KEY `fk_tbl_target_pest_1_idx` (`target_pengujian_id`),
  CONSTRAINT `fk_tbl_target_pest_1` FOREIGN KEY (`target_pengujian_id`) REFERENCES `tbl_target_pengujian` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_target_pest`
--

LOCK TABLES `tbl_target_pest` WRITE;
/*!40000 ALTER TABLE `tbl_target_pest` DISABLE KEYS */;
INSERT INTO `tbl_target_pest` VALUES (1,'KTP-618','Bacillus Anthracis',1,'2018-06-03 11:02:31','2018-06-03 11:02:39');
/*!40000 ALTER TABLE `tbl_target_pest` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_target_uji_golongan`
--

DROP TABLE IF EXISTS `tbl_target_uji_golongan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_target_uji_golongan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_target_uji` varchar(15) NOT NULL,
  `kelompok_sample_id` int(10) NOT NULL,
  `nama_ilmiah` varchar(150) DEFAULT NULL,
  `kode_hs_id` int(10) NOT NULL,
  `satuan_id` int(5) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode_target_uji_UNIQUE` (`kode_target_uji`),
  KEY `fk_tbl_target_uji_1_idx` (`kelompok_sample_id`),
  KEY `fk_tbl_target_uji_2_idx` (`kode_hs_id`),
  KEY `fk_tbl_target_uji_golongan_1_idx` (`satuan_id`),
  CONSTRAINT `fk_tbl_target_uji_1` FOREIGN KEY (`kelompok_sample_id`) REFERENCES `tbl_kelompok_sample` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_tbl_target_uji_2` FOREIGN KEY (`kode_hs_id`) REFERENCES `tbl_kode_hs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_tbl_target_uji_golongan_1` FOREIGN KEY (`satuan_id`) REFERENCES `tbl_satuan` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_target_uji_golongan`
--

LOCK TABLES `tbl_target_uji_golongan` WRITE;
/*!40000 ALTER TABLE `tbl_target_uji_golongan` DISABLE KEYS */;
INSERT INTO `tbl_target_uji_golongan` VALUES (1,'KT-528',2,'Gallus Domesticus',1,1,'2018-06-03 10:39:08','2018-06-03 10:39:21');
/*!40000 ALTER TABLE `tbl_target_uji_golongan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_upt`
--

DROP TABLE IF EXISTS `tbl_upt`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tbl_upt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `kode_upt` varchar(15) NOT NULL,
  `nama_upt` varchar(150) NOT NULL,
  `daerah_id` int(5) NOT NULL,
  `jenis_pelabuhan` varchar(15) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `kode_upt_UNIQUE` (`kode_upt`),
  KEY `fk_tbl_upt_1_idx` (`daerah_id`),
  CONSTRAINT `fk_tbl_upt_1` FOREIGN KEY (`daerah_id`) REFERENCES `tbl_daerah` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_upt`
--

LOCK TABLES `tbl_upt` WRITE;
/*!40000 ALTER TABLE `tbl_upt` DISABLE KEYS */;
INSERT INTO `tbl_upt` VALUES (1,'KD-100.100.100','Kutai Kartanegara',1,'Laut','2018-06-03 08:47:13','2018-06-03 08:47:13');
/*!40000 ALTER TABLE `tbl_upt` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-06-07 19:41:40
