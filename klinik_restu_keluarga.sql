/*
SQLyog Ultimate v11.2 (64 bit)
MySQL - 5.6.16 : Database - klinik_restu_keluarga
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`klinik_restu_keluarga` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `klinik_restu_keluarga`;

/*Table structure for table `bayar` */

DROP TABLE IF EXISTS `bayar`;

CREATE TABLE `bayar` (
  `bayar_id` int(11) NOT NULL AUTO_INCREMENT,
  `bayar_rekam_medis_id` int(11) NOT NULL,
  `bayar_tanggal` date DEFAULT NULL,
  `bayar_jasa_dokter` decimal(20,2) DEFAULT NULL,
  `bayar_harga_obat` decimal(20,2) DEFAULT NULL,
  `bayar_biaya_tindakan` decimal(20,2) DEFAULT NULL,
  `bayar_biaya_laborat` decimal(20,2) DEFAULT NULL,
  `bayar_biaya_persalinan` decimal(20,2) DEFAULT NULL,
  `bayar_biaya_lain` decimal(20,2) DEFAULT NULL,
  `bayar_biaya` decimal(20,2) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_by` varchar(255) DEFAULT NULL,
  `update_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`bayar_id`),
  KEY `FK_bayar_rekam_medis_id` (`bayar_rekam_medis_id`),
  CONSTRAINT `FK_bayar_rekam_medis_id` FOREIGN KEY (`bayar_rekam_medis_id`) REFERENCES `rekam_medis` (`rekam_medis_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `bayar` */

insert  into `bayar`(`bayar_id`,`bayar_rekam_medis_id`,`bayar_tanggal`,`bayar_jasa_dokter`,`bayar_harga_obat`,`bayar_biaya_tindakan`,`bayar_biaya_laborat`,`bayar_biaya_persalinan`,`bayar_biaya_lain`,`bayar_biaya`,`created_by`,`created_at`,`update_by`,`update_at`) values (4,2,'2017-10-23','15000.00','43000.00','1000.00','5000.00',NULL,'2500.00','66500.00','klinik','2017-10-23 21:59:24',NULL,'2017-11-06 20:51:43'),(5,1,'2017-10-27','15000.00','30000.00','2000.00','5000.00',NULL,'0.00','52000.00','admin','2017-10-27 23:05:49',NULL,'2017-11-06 20:51:51'),(6,5,'2017-11-05','35000.00','60000.00','3000.00','5000.00',NULL,'5000.00','108000.00','admin','2017-11-05 10:44:43',NULL,'2017-11-06 20:52:15'),(7,6,'2017-11-15','23000.00','34000.00','12000.00','0.00','0.00','0.00','69000.00','admin','2017-11-15 23:03:40',NULL,'2017-11-15 23:03:40');

/*Table structure for table `daftar` */

DROP TABLE IF EXISTS `daftar`;

CREATE TABLE `daftar` (
  `daftar_id` int(11) NOT NULL AUTO_INCREMENT,
  `daftar_tindakan_id` int(11) NOT NULL,
  `daftar_layanan_id` int(11) NOT NULL,
  `daftar_poliklinik_id` int(11) NOT NULL,
  `daftar_pasien_id` int(11) NOT NULL,
  `daftar_tanggal` date DEFAULT NULL,
  `daftar_keluhan` text,
  `daftar_is_rm` enum('Ya','Tidak') DEFAULT 'Tidak',
  `daftar_is_periksa` enum('Ya','Tidak') DEFAULT 'Tidak',
  `daftar_is_bayar` enum('Ya','Tidak') DEFAULT 'Tidak',
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_by` varchar(255) DEFAULT NULL,
  `update_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`daftar_id`),
  KEY `FK_daftar_tindakan_id` (`daftar_tindakan_id`),
  KEY `FK_daftar_layanan_id` (`daftar_layanan_id`),
  KEY `FK_daftar_pasien_id` (`daftar_pasien_id`),
  KEY `FK_daftar_poliklinik_id` (`daftar_poliklinik_id`),
  CONSTRAINT `FK_daftar_layanan_id` FOREIGN KEY (`daftar_layanan_id`) REFERENCES `layanan` (`layanan_id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_daftar_pasien_id` FOREIGN KEY (`daftar_pasien_id`) REFERENCES `pasien` (`pasien_id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_daftar_poliklinik_id` FOREIGN KEY (`daftar_poliklinik_id`) REFERENCES `poliklinik` (`poliklinik_id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_daftar_tindakan_id` FOREIGN KEY (`daftar_tindakan_id`) REFERENCES `tindakan` (`tindakan_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `daftar` */

insert  into `daftar`(`daftar_id`,`daftar_tindakan_id`,`daftar_layanan_id`,`daftar_poliklinik_id`,`daftar_pasien_id`,`daftar_tanggal`,`daftar_keluhan`,`daftar_is_rm`,`daftar_is_periksa`,`daftar_is_bayar`,`created_by`,`created_at`,`update_by`,`update_at`) values (6,1,1,1,3,'2017-10-14','Demam dan sakit kepala','Ya','Ya','Ya','admin','2017-10-15 01:00:35','admin','2017-10-31 20:14:09'),(7,1,2,2,1,'2017-10-16','Mual dan Muntah','Ya','Ya','Ya','admin','2017-10-16 22:11:38','klinik','2017-10-31 20:14:11'),(9,1,2,2,4,'2017-10-31','Mual dan demam','Ya','Ya','Tidak','klinik','2017-10-31 19:48:14','klinik','2017-10-31 21:29:52'),(10,1,1,1,7,'2017-11-01','Gatal Seluruh Badan','Ya','Ya','Ya','klinik','2017-11-01 20:00:41','admin','2017-11-06 21:30:43'),(11,1,2,1,3,'2017-11-02','Sakit Kepala','Tidak','Tidak','Tidak','klinik','2017-11-02 22:36:05','admin','2017-11-06 22:43:38'),(12,1,1,1,8,'2017-11-05','Sakit Kepala','Ya','Ya','Ya','admin','2017-11-05 10:35:25','admin','2017-11-05 10:44:44');

/*Table structure for table `dokter` */

DROP TABLE IF EXISTS `dokter`;

CREATE TABLE `dokter` (
  `dokter_id` int(11) NOT NULL AUTO_INCREMENT,
  `dokter_poliklinik_id` int(11) NOT NULL,
  `dokter_nama` varchar(255) DEFAULT NULL,
  `dokter_sip` varchar(255) DEFAULT NULL,
  `dokter_gender` enum('Laki - Laki','Perempuan') DEFAULT NULL,
  `dokter_agama` enum('Islam','Kristen','Katholik','Hindu','Budha') DEFAULT NULL,
  `dokter_telp` varchar(255) DEFAULT NULL,
  `dokter_tanggal_lahir` date DEFAULT NULL,
  `dokter_alamat` text,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_by` varchar(255) DEFAULT NULL,
  `update_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`dokter_id`),
  KEY `FK_dokter_poliklinik_id` (`dokter_poliklinik_id`),
  CONSTRAINT `FK_dokter_poliklinik_id` FOREIGN KEY (`dokter_poliklinik_id`) REFERENCES `poliklinik` (`poliklinik_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `dokter` */

insert  into `dokter`(`dokter_id`,`dokter_poliklinik_id`,`dokter_nama`,`dokter_sip`,`dokter_gender`,`dokter_agama`,`dokter_telp`,`dokter_tanggal_lahir`,`dokter_alamat`,`created_by`,`created_at`,`update_by`,`update_at`) values (4,1,'dr Hasan','2017/123/UMUM/00022','Laki - Laki','Islam','08912345678','1989-02-15','Gombang, Cawas, Klaten','klinik','2017-10-31 22:58:29','admin','2017-10-31 23:02:06'),(5,2,'dra Windy Indriyastuti','2012/109/IKA/00034','Perempuan','Islam','098223345521','1980-03-14','Klaten','klinik','2017-10-31 22:59:39','0000-00-00 00:00:00','2017-10-31 22:59:49'),(6,4,'dr Gilang Jatmiko','2011/11/GIGI/00213','Laki - Laki','Islam','0872342112223','1981-03-07','Surakarta','klinik','2017-10-31 23:01:42',NULL,'2017-10-31 23:01:42'),(7,2,'dr Rina Indriyana','2015/012.A/00056','Perempuan','Kristen','087234671823','1988-07-14','Sleman, Yogyakarta','admin','2017-11-08 19:26:19',NULL,'2017-11-08 19:26:19');

/*Table structure for table `dokter_jadwal` */

DROP TABLE IF EXISTS `dokter_jadwal`;

CREATE TABLE `dokter_jadwal` (
  `dokter_jadwal_id` int(11) NOT NULL AUTO_INCREMENT,
  `dokter_jadwal_dokter_id` int(11) DEFAULT NULL,
  `dokter_jadwal_hari` varchar(20) DEFAULT NULL,
  `dokter_jadwal_start` time DEFAULT NULL,
  `dokter_jadwal_end` time DEFAULT NULL,
  PRIMARY KEY (`dokter_jadwal_id`),
  KEY `FK_dokter_id` (`dokter_jadwal_dokter_id`),
  CONSTRAINT `FK_dokter_id` FOREIGN KEY (`dokter_jadwal_dokter_id`) REFERENCES `dokter` (`dokter_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `dokter_jadwal` */

insert  into `dokter_jadwal`(`dokter_jadwal_id`,`dokter_jadwal_dokter_id`,`dokter_jadwal_hari`,`dokter_jadwal_start`,`dokter_jadwal_end`) values (1,7,'Senin','08:30:00','12:00:00'),(2,7,'Selasa','09:00:00','10:00:00'),(3,7,'Rabu','12:00:00','13:00:00'),(4,4,'Rabu','09:30:00','10:00:00'),(5,4,'Jumat','12:00:00','13:30:00'),(6,4,'Sabtu','13:00:00','18:00:00');

/*Table structure for table `layanan` */

DROP TABLE IF EXISTS `layanan`;

CREATE TABLE `layanan` (
  `layanan_id` int(11) NOT NULL AUTO_INCREMENT,
  `layanan_kode` varchar(255) DEFAULT NULL,
  `layanan_nama` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_by` varchar(255) DEFAULT NULL,
  `update_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`layanan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `layanan` */

insert  into `layanan`(`layanan_id`,`layanan_kode`,`layanan_nama`,`created_by`,`created_at`,`update_by`,`update_at`) values (1,'A','Umum','admin','2017-10-13 21:54:11','0000-00-00 00:00:00','2017-10-13 21:59:53'),(2,'B','BPJS','admin','2017-10-13 21:54:33','0000-00-00 00:00:00','2017-10-31 23:21:55');

/*Table structure for table `pasien` */

DROP TABLE IF EXISTS `pasien`;

CREATE TABLE `pasien` (
  `pasien_id` int(11) NOT NULL AUTO_INCREMENT,
  `pasien_nomor` varchar(255) DEFAULT NULL,
  `pasien_nama` varchar(255) DEFAULT NULL,
  `pasien_gender` enum('Laki - Laki','Perempuan') DEFAULT NULL,
  `pasien_agama` enum('Islam','Kristen','Katholik','Hindu','Budha') DEFAULT NULL,
  `pasien_telp` varchar(255) DEFAULT NULL,
  `pasien_tanggal_lahir` date DEFAULT NULL,
  `pasien_umur` varchar(20) DEFAULT NULL,
  `pasien_alamat` text,
  `pasien_keterangan` text,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_by` varchar(255) DEFAULT NULL,
  `update_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`pasien_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `pasien` */

insert  into `pasien`(`pasien_id`,`pasien_nomor`,`pasien_nama`,`pasien_gender`,`pasien_agama`,`pasien_telp`,`pasien_tanggal_lahir`,`pasien_umur`,`pasien_alamat`,`pasien_keterangan`,`created_by`,`created_at`,`update_by`,`update_at`) values (1,'000001','Tiya Apriliyanti','Perempuan','Islam','085642428252','1992-04-05','26','Juwiring, Klaten','Pasien Lama','klinik','2017-10-13 00:10:08','0000-00-00 00:00:00','2017-10-18 22:51:38'),(3,'000002','Rochmad Widianto','Laki - Laki','Islam','085725655554','1992-11-22','25','Karangkundi, Kapungan, Polanharjo, Klaten','Pasien Baru','admin','2017-10-13 20:38:36','2017-10-20 20:26:34','2017-10-20 20:26:34'),(4,'000003','Devita Putri P','Perempuan','Islam','081234567890','2012-11-13','5','Yogyakarta','Pasien Baru','admin','2017-10-14 14:55:22','2017-10-15 00:06:29','2017-10-15 00:06:29'),(7,'000004','Siska Putri Andini','Perempuan','Islam','08712353222111','1995-07-14','19','Pedan, Klaten','Pasien Baru','klinik','2017-10-31 22:48:52',NULL,'2017-10-31 22:48:52'),(8,'000005','Arief Hendrawan','Laki - Laki','Islam','089123456789','1992-03-04','24','Gombang, Cawas, Klaten','Pasien Baru','klinik','2017-10-31 22:51:43',NULL,'2017-10-31 22:51:43'),(9,'000006','Hendra Kurniawan','Laki - Laki','Islam','08123456789','1970-10-14','47','Cawas, Klaten','','admin','2017-11-04 22:22:22',NULL,'2017-11-04 22:22:22');

/*Table structure for table `periksa` */

DROP TABLE IF EXISTS `periksa`;

CREATE TABLE `periksa` (
  `periksa_id` int(11) NOT NULL AUTO_INCREMENT,
  `periksa_rekam_medis_id` int(11) NOT NULL,
  `periksa_tanggal` date DEFAULT NULL,
  `periksa_hasil` text,
  `periksa_catatan` text,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_by` varchar(255) DEFAULT NULL,
  `update_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`periksa_id`),
  KEY `FK_periksa_rekam_medis_id` (`periksa_rekam_medis_id`),
  CONSTRAINT `FK_periksa_rekam_medis_id` FOREIGN KEY (`periksa_rekam_medis_id`) REFERENCES `rekam_medis` (`rekam_medis_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `periksa` */

insert  into `periksa`(`periksa_id`,`periksa_rekam_medis_id`,`periksa_tanggal`,`periksa_hasil`,`periksa_catatan`,`created_by`,`created_at`,`update_by`,`update_at`) values (6,1,'2017-10-16','Hasil Pemeriksaan Bagus','Kurangi Konsumsi Kopi','admin','2017-10-16 21:44:50',NULL,'2017-10-16 21:44:50'),(7,2,'2017-10-23','Bagus','Kurangi begadang dan mandi malam','klinik','2017-10-23 20:15:05',NULL,'2017-10-23 20:15:05'),(9,4,'2017-10-31','Bagus','Istirahat yang cukup','klinik','2017-10-31 21:29:52',NULL,'2017-10-31 21:29:52'),(10,5,'2017-11-05','Hasil Pemeriksaan','Catatan','admin','2017-11-05 10:43:05',NULL,'2017-11-05 10:43:05'),(11,6,'2017-11-15','Bagus','Suntik','admin','2017-11-15 23:03:14',NULL,'2017-11-15 23:03:14');

/*Table structure for table `petugas` */

DROP TABLE IF EXISTS `petugas`;

CREATE TABLE `petugas` (
  `petugas_id` int(11) NOT NULL AUTO_INCREMENT,
  `petugas_nomor` varchar(255) DEFAULT NULL,
  `petugas_nama` varchar(255) DEFAULT NULL,
  `petugas_jabatan` varchar(20) DEFAULT NULL,
  `petugas_gender` enum('Laki - Laki','Perempuan') DEFAULT NULL,
  `petugas_agama` enum('Islam','Kristen','Katholik','Hindu','Budha') DEFAULT NULL,
  `petugas_telp` varchar(255) DEFAULT NULL,
  `petugas_alamat` text,
  `petugas_keterangan` text,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_by` varchar(255) DEFAULT NULL,
  `update_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`petugas_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `petugas` */

insert  into `petugas`(`petugas_id`,`petugas_nomor`,`petugas_nama`,`petugas_jabatan`,`petugas_gender`,`petugas_agama`,`petugas_telp`,`petugas_alamat`,`petugas_keterangan`,`created_by`,`created_at`,`update_by`,`update_at`) values (1,'A123','Devita Putri Permatasari','Admin Pendaftaran','Perempuan','Islam','085123456789','Klaten','Bertanggung jawab sepenuhnya dalam mengatur pendaftaran pasien','admin','2017-10-13 21:08:40','0000-00-00 00:00:00','2017-10-13 21:12:02');

/*Table structure for table `poliklinik` */

DROP TABLE IF EXISTS `poliklinik`;

CREATE TABLE `poliklinik` (
  `poliklinik_id` int(11) NOT NULL AUTO_INCREMENT,
  `poliklinik_kode` varchar(255) DEFAULT NULL,
  `poliklinik_nama` varchar(255) DEFAULT NULL,
  `poliklinik_ruangan` varchar(20) DEFAULT NULL,
  `poliklinik_penanggung_jawab` varchar(255) DEFAULT NULL,
  `poliklinik_keterangan` text,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_by` varchar(255) DEFAULT NULL,
  `update_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`poliklinik_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `poliklinik` */

insert  into `poliklinik`(`poliklinik_id`,`poliklinik_kode`,`poliklinik_nama`,`poliklinik_ruangan`,`poliklinik_penanggung_jawab`,`poliklinik_keterangan`,`created_by`,`created_at`,`update_by`,`update_at`) values (1,'PL001','Poliklinik Umum','R123','Rochmad Widianto','Untuk pelayanan umum','admin','2017-10-13 21:38:08','0000-00-00 00:00:00','2017-10-13 21:39:17'),(2,'PL002','Poliklinik Ibu dan Anak','R254','Tiya Apriliyanti','Untuk pelayanan Ibu dan Anak','admin','2017-10-13 21:39:04',NULL,'2017-10-13 21:39:04'),(4,'PL003','Poliklinik Gigi','R254','Devita Putri Permatasari','Untuk pelayanan gigi dan mulut','admin','2017-10-13 21:40:38',NULL,'2017-10-13 21:40:38');

/*Table structure for table `rekam_medis` */

DROP TABLE IF EXISTS `rekam_medis`;

CREATE TABLE `rekam_medis` (
  `rekam_medis_id` int(11) NOT NULL AUTO_INCREMENT,
  `rekam_medis_daftar_id` int(11) NOT NULL,
  `rekam_medis_nomor` varchar(100) DEFAULT NULL,
  `rekam_medis_alergi` text,
  `rekam_medis_diagnosa` text,
  `rekam_medis_tanggal` date DEFAULT NULL,
  `rekam_medis_terapi` text,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_by` varchar(255) DEFAULT NULL,
  `update_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`rekam_medis_id`),
  KEY `FK_rekam_medis_daftar_id` (`rekam_medis_daftar_id`),
  CONSTRAINT `FK_rekam_medis_daftar_id` FOREIGN KEY (`rekam_medis_daftar_id`) REFERENCES `daftar` (`daftar_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `rekam_medis` */

insert  into `rekam_medis`(`rekam_medis_id`,`rekam_medis_daftar_id`,`rekam_medis_nomor`,`rekam_medis_alergi`,`rekam_medis_diagnosa`,`rekam_medis_tanggal`,`rekam_medis_terapi`,`created_by`,`created_at`,`update_by`,`update_at`) values (1,6,'RM20171015.000002.001','Ultraflu','Sakit kepala sudah 3 hari disertai demam dan kadang - kadang merasa mual','2017-10-15','Amocxilin 250mg 2 x 1\r\nParacetamol 500mg 3 x 1','admin','2017-10-15 15:44:15','admin','2017-10-20 23:05:59'),(2,7,'RM20171016.000001.002','Ultraflu & Konidin','Sering mual selama 3 hari berturut - turut','2017-10-16','Meiji 3 x 1\r\nPromag 3 x 2\r\nAmoxilin 2 x 1','admin','2017-10-16 22:12:31','klinik','2017-10-23 20:15:05'),(4,9,'RM20171031.000003.002','-','-','2017-10-31','Amoxilin 250mg 2 x 3\r\nParacetamol 500mg 3 x 1\r\n','klinik','2017-10-31 20:20:46','klinik','2017-10-31 21:29:52'),(5,12,'RM20171105.000005.001','Alergi Obat','Diagnosa','2017-11-05','Terapi','admin','2017-11-05 10:40:50','admin','2017-11-05 10:43:05'),(6,10,'RM20171106.000004.001','Paracetamol','Demam tinggi selama 2 hari','2017-11-06','Amoxilin 250mg 2 x 1\r\nMeiji 500mg 3 x 1','admin','2017-11-06 21:30:44','admin','2017-11-06 21:30:44');

/*Table structure for table `tindakan` */

DROP TABLE IF EXISTS `tindakan`;

CREATE TABLE `tindakan` (
  `tindakan_id` int(11) NOT NULL AUTO_INCREMENT,
  `tindakan_kode` varchar(255) DEFAULT NULL,
  `tindakan_nama` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_by` varchar(255) DEFAULT NULL,
  `update_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`tindakan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tindakan` */

insert  into `tindakan`(`tindakan_id`,`tindakan_kode`,`tindakan_nama`,`created_by`,`created_at`,`update_by`,`update_at`) values (1,'RJ','Rawat Jalan','admin','2017-10-13 22:04:44','0000-00-00 00:00:00','2017-10-13 22:06:32'),(2,'RI','Rawat Inap','admin','2017-10-13 22:04:53',NULL,'2017-10-13 22:04:53');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `no_telp` varchar(20) DEFAULT NULL,
  `level` char(20) NOT NULL,
  `aktif` enum('N','Y') NOT NULL DEFAULT 'Y',
  `foto_user` varchar(50) DEFAULT NULL,
  `created_by` varchar(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_by` varchar(50) DEFAULT NULL,
  `update_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`,`username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`user_id`,`username`,`password`,`nama_lengkap`,`email`,`no_telp`,`level`,`aktif`,`foto_user`,`created_by`,`created_at`,`update_by`,`update_at`) values (1,'admin','21232f297a57a5a743894a0e4a801fc3','admin','admin@mail.com','082356785333','administrator','Y','avatar4.png','baim','2017-01-13 13:27:52','klinik','2017-11-03 22:13:29'),(3,'dokter','d22af4180eee4bd95072eb90f94930e5','Dokter','dokter@mail.com','081329076822','dokter','Y','avatar.png','klinik','2017-11-03 22:11:33',NULL,'2017-11-03 22:11:33'),(4,'petugas','afb91ef692fd08c445e8cb1bab2ccf9c','Petugas','petugas@mail.com','089221342890','petugas','Y','avatar3.png','klinik','2017-11-03 22:12:41',NULL,'2017-11-03 22:12:41');

/* Function  structure for function  `fc_jmlcl` */

/*!50003 DROP FUNCTION IF EXISTS `fc_jmlcl` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `fc_jmlcl`(`id` VARCHAR(225) , `id_peg` INT(11), `tgl1` DATE, `tgl2` DATE) RETURNS double
BEGIN
	DECLARE jumlah DOUBLE;
		SELECT SUM(nilai) * kali INTO jumlah FROM kegiatan_harian 
		LEFT OUTER JOIN kegiatan ON kegiatan_harian.id_kegiatan = kegiatan.id_kegiatan 
		LEFT OUTER JOIN pegawai ON kegiatan_harian.id_pegawai = pegawai.id_pegawai
		WHERE kegiatan_harian.id_kegiatan=id
		AND kegiatan_harian.id_pegawai=id_peg
		AND kegiatan_harian.tgl_kegiatan BETWEEN tgl1 AND tgl2;	
	RETURN jumlah;
END */$$
DELIMITER ;

/* Function  structure for function  `fc_jmlcl_copy` */

/*!50003 DROP FUNCTION IF EXISTS `fc_jmlcl_copy` */;
DELIMITER $$

/*!50003 CREATE DEFINER=`root`@`localhost` FUNCTION `fc_jmlcl_copy`(`id_peg` INT(11) ) RETURNS int(11)
BEGIN	
	DECLARE xx VARCHAR(225); 
		SELECT
			kegiatan.id_kegiatan INTO xx
			FROM
			kegiatan
			INNER JOIN sub_kategori ON kegiatan.id_sub_kategori = sub_kategori.id_sub_kategori
			INNER JOIN kategori ON sub_kategori.id_kategori = kategori.id_kategori
			INNER JOIN kat_jab ON kategori.id_kat_jab = kat_jab.id_kat_jab
			INNER JOIN jabatan ON jabatan.id_kat_jab = kat_jab.id_kat_jab
			INNER JOIN pegawai ON pegawai.id_jabatan = jabatan.id_jabatan
			WHERE pegawai.id_pegawai = id_peg;
	RETURN xx;
END */$$
DELIMITER ;

/*Table structure for table `v_daftar` */

DROP TABLE IF EXISTS `v_daftar`;

/*!50001 DROP VIEW IF EXISTS `v_daftar` */;
/*!50001 DROP TABLE IF EXISTS `v_daftar` */;

/*!50001 CREATE TABLE  `v_daftar`(
 `daftar_id` int(11) ,
 `daftar_tindakan_id` int(11) ,
 `daftar_layanan_id` int(11) ,
 `daftar_poliklinik_id` int(11) ,
 `daftar_pasien_id` int(11) ,
 `daftar_tanggal` date ,
 `daftar_keluhan` text ,
 `daftar_is_rm` enum('Ya','Tidak') ,
 `daftar_is_periksa` enum('Ya','Tidak') ,
 `daftar_is_bayar` enum('Ya','Tidak') ,
 `created_by` varchar(255) ,
 `created_at` timestamp ,
 `update_by` varchar(255) ,
 `update_at` datetime ,
 `tindakan_id` int(11) ,
 `tindakan_nama` varchar(255) ,
 `layanan_id` int(11) ,
 `layanan_nama` varchar(255) ,
 `poliklinik_id` int(11) ,
 `poliklinik_kode` varchar(255) ,
 `poliklinik_nama` varchar(255) ,
 `pasien_id` int(11) ,
 `pasien_nomor` varchar(255) ,
 `pasien_nama` varchar(255) 
)*/;

/*Table structure for table `v_daftar_rm` */

DROP TABLE IF EXISTS `v_daftar_rm`;

/*!50001 DROP VIEW IF EXISTS `v_daftar_rm` */;
/*!50001 DROP TABLE IF EXISTS `v_daftar_rm` */;

/*!50001 CREATE TABLE  `v_daftar_rm`(
 `rekam_medis_id` int(11) ,
 `rekam_medis_daftar_id` int(11) ,
 `rekam_medis_nomor` varchar(100) ,
 `rekam_medis_alergi` text ,
 `rekam_medis_diagnosa` text ,
 `rekam_medis_tanggal` date ,
 `rekam_medis_terapi` text ,
 `created_by` varchar(255) ,
 `created_at` timestamp ,
 `update_by` varchar(255) ,
 `update_at` datetime ,
 `dokter_id` int(11) ,
 `dokter_nama` varchar(255) ,
 `dokter_sip` varchar(255) ,
 `dokter_telp` varchar(255) ,
 `poliklinik_id` int(11) ,
 `poliklinik_kode` varchar(255) ,
 `poliklinik_nama` varchar(255) ,
 `daftar_id` int(11) ,
 `tindakan_nama` varchar(255) ,
 `layanan_nama` varchar(255) ,
 `pasien_id` int(11) ,
 `pasien_nomor` varchar(255) ,
 `pasien_nama` varchar(255) ,
 `pasien_gender` enum('Laki - Laki','Perempuan') ,
 `pasien_umur` varchar(20) ,
 `pasien_agama` enum('Islam','Kristen','Katholik','Hindu','Budha') ,
 `pasien_telp` varchar(255) ,
 `pasien_tanggal_lahir` date ,
 `pasien_alamat` text ,
 `daftar_is_periksa` enum('Ya','Tidak') ,
 `daftar_is_bayar` enum('Ya','Tidak') ,
 `daftar_keluhan` text ,
 `periksa_id` int(11) ,
 `periksa_hasil` text ,
 `periksa_catatan` text ,
 `periksa_tanggal` date ,
 `bayar_id` int(11) ,
 `bayar_tanggal` date ,
 `bayar_jasa_dokter` decimal(20,2) ,
 `bayar_harga_obat` decimal(20,2) ,
 `bayar_biaya_tindakan` decimal(20,2) ,
 `bayar_biaya_laborat` decimal(20,2) ,
 `bayar_biaya_persalinan` decimal(20,2) ,
 `bayar_biaya_lain` decimal(20,2) ,
 `bayar_biaya` decimal(20,2) 
)*/;

/*Table structure for table `v_dok_poli` */

DROP TABLE IF EXISTS `v_dok_poli`;

/*!50001 DROP VIEW IF EXISTS `v_dok_poli` */;
/*!50001 DROP TABLE IF EXISTS `v_dok_poli` */;

/*!50001 CREATE TABLE  `v_dok_poli`(
 `dokter_id` int(11) ,
 `dokter_poliklinik_id` int(11) ,
 `dokter_nama` varchar(255) ,
 `dokter_sip` varchar(255) ,
 `dokter_gender` enum('Laki - Laki','Perempuan') ,
 `dokter_agama` enum('Islam','Kristen','Katholik','Hindu','Budha') ,
 `dokter_telp` varchar(255) ,
 `dokter_tanggal_lahir` date ,
 `dokter_alamat` text ,
 `created_by` varchar(255) ,
 `created_at` timestamp ,
 `update_by` varchar(255) ,
 `update_at` datetime ,
 `poliklinik_nama` varchar(255) 
)*/;

/*View structure for view v_daftar */

/*!50001 DROP TABLE IF EXISTS `v_daftar` */;
/*!50001 DROP VIEW IF EXISTS `v_daftar` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_daftar` AS (select `d`.`daftar_id` AS `daftar_id`,`d`.`daftar_tindakan_id` AS `daftar_tindakan_id`,`d`.`daftar_layanan_id` AS `daftar_layanan_id`,`d`.`daftar_poliklinik_id` AS `daftar_poliklinik_id`,`d`.`daftar_pasien_id` AS `daftar_pasien_id`,`d`.`daftar_tanggal` AS `daftar_tanggal`,`d`.`daftar_keluhan` AS `daftar_keluhan`,`d`.`daftar_is_rm` AS `daftar_is_rm`,`d`.`daftar_is_periksa` AS `daftar_is_periksa`,`d`.`daftar_is_bayar` AS `daftar_is_bayar`,`d`.`created_by` AS `created_by`,`d`.`created_at` AS `created_at`,`d`.`update_by` AS `update_by`,`d`.`update_at` AS `update_at`,`tindakan`.`tindakan_id` AS `tindakan_id`,`tindakan`.`tindakan_nama` AS `tindakan_nama`,`layanan`.`layanan_id` AS `layanan_id`,`layanan`.`layanan_nama` AS `layanan_nama`,`poliklinik`.`poliklinik_id` AS `poliklinik_id`,`poliklinik`.`poliklinik_kode` AS `poliklinik_kode`,`poliklinik`.`poliklinik_nama` AS `poliklinik_nama`,`pasien`.`pasien_id` AS `pasien_id`,`pasien`.`pasien_nomor` AS `pasien_nomor`,`pasien`.`pasien_nama` AS `pasien_nama` from ((((`daftar` `d` join `layanan` on((`layanan`.`layanan_id` = `d`.`daftar_layanan_id`))) join `tindakan` on((`tindakan`.`tindakan_id` = `d`.`daftar_tindakan_id`))) join `poliklinik` on((`poliklinik`.`poliklinik_id` = `d`.`daftar_poliklinik_id`))) join `pasien` on((`pasien`.`pasien_id` = `d`.`daftar_pasien_id`)))) */;

/*View structure for view v_daftar_rm */

/*!50001 DROP TABLE IF EXISTS `v_daftar_rm` */;
/*!50001 DROP VIEW IF EXISTS `v_daftar_rm` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_daftar_rm` AS (select `rm`.`rekam_medis_id` AS `rekam_medis_id`,`rm`.`rekam_medis_daftar_id` AS `rekam_medis_daftar_id`,`rm`.`rekam_medis_nomor` AS `rekam_medis_nomor`,`rm`.`rekam_medis_alergi` AS `rekam_medis_alergi`,`rm`.`rekam_medis_diagnosa` AS `rekam_medis_diagnosa`,`rm`.`rekam_medis_tanggal` AS `rekam_medis_tanggal`,`rm`.`rekam_medis_terapi` AS `rekam_medis_terapi`,`rm`.`created_by` AS `created_by`,`rm`.`created_at` AS `created_at`,`rm`.`update_by` AS `update_by`,`rm`.`update_at` AS `update_at`,`dokter`.`dokter_id` AS `dokter_id`,`dokter`.`dokter_nama` AS `dokter_nama`,`dokter`.`dokter_sip` AS `dokter_sip`,`dokter`.`dokter_telp` AS `dokter_telp`,`poliklinik`.`poliklinik_id` AS `poliklinik_id`,`poliklinik`.`poliklinik_kode` AS `poliklinik_kode`,`poliklinik`.`poliklinik_nama` AS `poliklinik_nama`,`daftar`.`daftar_id` AS `daftar_id`,`tindakan`.`tindakan_nama` AS `tindakan_nama`,`layanan`.`layanan_nama` AS `layanan_nama`,`pasien`.`pasien_id` AS `pasien_id`,`pasien`.`pasien_nomor` AS `pasien_nomor`,`pasien`.`pasien_nama` AS `pasien_nama`,`pasien`.`pasien_gender` AS `pasien_gender`,`pasien`.`pasien_umur` AS `pasien_umur`,`pasien`.`pasien_agama` AS `pasien_agama`,`pasien`.`pasien_telp` AS `pasien_telp`,`pasien`.`pasien_tanggal_lahir` AS `pasien_tanggal_lahir`,`pasien`.`pasien_alamat` AS `pasien_alamat`,`daftar`.`daftar_is_periksa` AS `daftar_is_periksa`,`daftar`.`daftar_is_bayar` AS `daftar_is_bayar`,`daftar`.`daftar_keluhan` AS `daftar_keluhan`,`periksa`.`periksa_id` AS `periksa_id`,`periksa`.`periksa_hasil` AS `periksa_hasil`,`periksa`.`periksa_catatan` AS `periksa_catatan`,`periksa`.`periksa_tanggal` AS `periksa_tanggal`,`bayar`.`bayar_id` AS `bayar_id`,`bayar`.`bayar_tanggal` AS `bayar_tanggal`,`bayar`.`bayar_jasa_dokter` AS `bayar_jasa_dokter`,`bayar`.`bayar_harga_obat` AS `bayar_harga_obat`,`bayar`.`bayar_biaya_tindakan` AS `bayar_biaya_tindakan`,`bayar`.`bayar_biaya_laborat` AS `bayar_biaya_laborat`,`bayar`.`bayar_biaya_persalinan` AS `bayar_biaya_persalinan`,`bayar`.`bayar_biaya_lain` AS `bayar_biaya_lain`,`bayar`.`bayar_biaya` AS `bayar_biaya` from ((((((((`rekam_medis` `rm` join `daftar` on((`daftar`.`daftar_id` = `rm`.`rekam_medis_daftar_id`))) join `pasien` on((`pasien`.`pasien_id` = `daftar`.`daftar_pasien_id`))) join `tindakan` on((`tindakan`.`tindakan_id` = `daftar`.`daftar_tindakan_id`))) join `poliklinik` on((`poliklinik`.`poliklinik_id` = `daftar`.`daftar_poliklinik_id`))) left join `dokter` on((`dokter`.`dokter_poliklinik_id` = `poliklinik`.`poliklinik_id`))) left join `bayar` on((`bayar`.`bayar_rekam_medis_id` = `rm`.`rekam_medis_id`))) left join `periksa` on((`periksa`.`periksa_rekam_medis_id` = `rm`.`rekam_medis_id`))) join `layanan` on((`layanan`.`layanan_id` = `daftar`.`daftar_layanan_id`)))) */;

/*View structure for view v_dok_poli */

/*!50001 DROP TABLE IF EXISTS `v_dok_poli` */;
/*!50001 DROP VIEW IF EXISTS `v_dok_poli` */;

/*!50001 CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_dok_poli` AS (select `d`.`dokter_id` AS `dokter_id`,`d`.`dokter_poliklinik_id` AS `dokter_poliklinik_id`,`d`.`dokter_nama` AS `dokter_nama`,`d`.`dokter_sip` AS `dokter_sip`,`d`.`dokter_gender` AS `dokter_gender`,`d`.`dokter_agama` AS `dokter_agama`,`d`.`dokter_telp` AS `dokter_telp`,`d`.`dokter_tanggal_lahir` AS `dokter_tanggal_lahir`,`d`.`dokter_alamat` AS `dokter_alamat`,`d`.`created_by` AS `created_by`,`d`.`created_at` AS `created_at`,`d`.`update_by` AS `update_by`,`d`.`update_at` AS `update_at`,`poliklinik`.`poliklinik_nama` AS `poliklinik_nama` from (`dokter` `d` join `poliklinik` on((`poliklinik`.`poliklinik_id` = `d`.`dokter_poliklinik_id`)))) */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
