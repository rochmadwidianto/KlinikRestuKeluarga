DROP TABLE bayar;

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
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`bayar_id`),
  KEY `FK_bayar_rekam_medis_id` (`bayar_rekam_medis_id`),
  CONSTRAINT `FK_bayar_rekam_medis_id` FOREIGN KEY (`bayar_rekam_medis_id`) REFERENCES `rekam_medis` (`rekam_medis_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO bayar VALUES("4","2","2017-10-23","15000.00","43000.00","1000.00","5000.00","0.00","2500.00","66500.00","klinik","2017-10-23 21:59:24","","2017-11-06 20:51:43");
INSERT INTO bayar VALUES("5","1","2017-10-27","15000.00","30000.00","2000.00","5000.00","0.00","0.00","52000.00","admin","2017-10-27 23:05:49","","2017-11-06 20:51:51");
INSERT INTO bayar VALUES("6","5","2017-11-05","35000.00","60000.00","3000.00","5000.00","0.00","5000.00","108000.00","admin","2017-11-05 10:44:43","","2017-11-06 20:52:15");



DROP TABLE daftar;

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
  `update_at` datetime DEFAULT NULL,
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

INSERT INTO daftar VALUES("6","1","1","1","3","2017-10-14","Demam dan sakit kepala","Ya","Ya","Ya","admin","2017-10-15 01:00:35","admin","2017-10-31 20:14:09");
INSERT INTO daftar VALUES("7","1","2","2","1","2017-10-16","Mual dan Muntah","Ya","Ya","Ya","admin","2017-10-16 22:11:38","klinik","2017-10-31 20:14:11");
INSERT INTO daftar VALUES("9","1","2","2","4","2017-10-31","Mual dan demam","Ya","Ya","Tidak","klinik","2017-10-31 19:48:14","klinik","2017-10-31 21:29:52");
INSERT INTO daftar VALUES("10","1","1","1","7","2017-11-01","Gatal Seluruh Badan","Ya","Tidak","Tidak","klinik","2017-11-01 20:00:41","admin","2017-11-06 21:30:43");
INSERT INTO daftar VALUES("11","1","2","1","3","2017-11-02","Sakit Kepala","Tidak","Tidak","Tidak","klinik","2017-11-02 22:36:05","admin","2017-11-06 22:43:38");
INSERT INTO daftar VALUES("12","1","1","1","8","2017-11-05","Sakit Kepala","Ya","Ya","Ya","admin","2017-11-05 10:35:25","admin","2017-11-05 10:44:44");



DROP TABLE dokter;

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
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`dokter_id`),
  KEY `FK_dokter_poliklinik_id` (`dokter_poliklinik_id`),
  CONSTRAINT `FK_dokter_poliklinik_id` FOREIGN KEY (`dokter_poliklinik_id`) REFERENCES `poliklinik` (`poliklinik_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO dokter VALUES("4","1","dr Hasan","2017/123/UMUM/00022","Laki - Laki","Islam","08912345678","1989-02-15","Gombang, Cawas, Klaten","klinik","2017-10-31 22:58:29","0000-00-00 00:00:00","2017-10-31 23:02:06");
INSERT INTO dokter VALUES("5","2","dra Windy Indriyastuti","2012/109/IKA/00034","Perempuan","Islam","098223345521","1980-03-14","Klaten","klinik","2017-10-31 22:59:39","0000-00-00 00:00:00","2017-10-31 22:59:49");
INSERT INTO dokter VALUES("6","4","dr Gilang Jatmiko","2011/11/GIGI/00213","Laki - Laki","Islam","0872342112223","1981-03-07","Surakarta","klinik","2017-10-31 23:01:42","","2017-10-31 23:01:42");
INSERT INTO dokter VALUES("7","2","dr Rina Indriyana","2015/012.A/00056","Perempuan","Kristen","087234671823","1988-07-14","Sleman, Yogyakarta","admin","2017-11-08 19:26:19","","2017-11-08 19:26:19");



DROP TABLE dokter_jadwal;

CREATE TABLE `dokter_jadwal` (
  `dokter_jadwal_id` int(11) NOT NULL AUTO_INCREMENT,
  `dokter_jadwal_dokter_id` int(11) DEFAULT NULL,
  `dokter_jadwal_hari` varchar(20) DEFAULT NULL,
  `dokter_jadwal_start` time DEFAULT NULL,
  `dokter_jadwal_end` time DEFAULT NULL,
  PRIMARY KEY (`dokter_jadwal_id`),
  KEY `FK_dokter_id` (`dokter_jadwal_dokter_id`),
  CONSTRAINT `FK_dokter_id` FOREIGN KEY (`dokter_jadwal_dokter_id`) REFERENCES `dokter` (`dokter_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

INSERT INTO dokter_jadwal VALUES("1","7","Senin","08:30:00","12:00:00");
INSERT INTO dokter_jadwal VALUES("2","7","Selasa","09:00:00","10:00:00");
INSERT INTO dokter_jadwal VALUES("3","7","Rabu","12:00:00","13:00:00");



DROP TABLE layanan;

CREATE TABLE `layanan` (
  `layanan_id` int(11) NOT NULL AUTO_INCREMENT,
  `layanan_kode` varchar(255) DEFAULT NULL,
  `layanan_nama` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_by` varchar(255) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`layanan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO layanan VALUES("1","A","Umum","admin","2017-10-13 21:54:11","0000-00-00 00:00:00","2017-10-13 21:59:53");
INSERT INTO layanan VALUES("2","B","BPJS","admin","2017-10-13 21:54:33","0000-00-00 00:00:00","2017-10-31 23:21:55");



DROP TABLE pasien;

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
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`pasien_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

INSERT INTO pasien VALUES("1","000001","Tiya Apriliyanti","Perempuan","Islam","085642428252","1992-04-05","26","Juwiring, Klaten","Pasien Lama","klinik","2017-10-13 00:10:08","0000-00-00 00:00:00","2017-10-18 22:51:38");
INSERT INTO pasien VALUES("3","000002","Rochmad Widianto","Laki - Laki","Islam","085725655554","1992-11-22","25","Karangkundi, Kapungan, Polanharjo, Klaten","Pasien Baru","admin","2017-10-13 20:38:36","2017-10-20 20:26:34","2017-10-20 20:26:34");
INSERT INTO pasien VALUES("4","000003","Devita Putri P","Perempuan","Islam","081234567890","2012-11-13","5","Yogyakarta","Pasien Baru","admin","2017-10-14 14:55:22","2017-10-15 00:06:29","2017-10-15 00:06:29");
INSERT INTO pasien VALUES("7","000004","Siska Putri Andini","Perempuan","Islam","08712353222111","1995-07-14","19","Pedan, Klaten","Pasien Baru","klinik","2017-10-31 22:48:52","","2017-10-31 22:48:52");
INSERT INTO pasien VALUES("8","000005","Arief Hendrawan","Laki - Laki","Islam","089123456789","1992-03-04","24","Gombang, Cawas, Klaten","Pasien Baru","klinik","2017-10-31 22:51:43","","2017-10-31 22:51:43");
INSERT INTO pasien VALUES("9","000006","Hendra Kurniawan","Laki - Laki","Islam","08123456789","1970-10-14","47","Cawas, Klaten","","admin","2017-11-04 22:22:22","","2017-11-04 22:22:22");



DROP TABLE periksa;

CREATE TABLE `periksa` (
  `periksa_id` int(11) NOT NULL AUTO_INCREMENT,
  `periksa_rekam_medis_id` int(11) NOT NULL,
  `periksa_tanggal` date DEFAULT NULL,
  `periksa_hasil` text,
  `periksa_catatan` text,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_by` varchar(255) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`periksa_id`),
  KEY `FK_periksa_rekam_medis_id` (`periksa_rekam_medis_id`),
  CONSTRAINT `FK_periksa_rekam_medis_id` FOREIGN KEY (`periksa_rekam_medis_id`) REFERENCES `rekam_medis` (`rekam_medis_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

INSERT INTO periksa VALUES("6","1","2017-10-16","Hasil Pemeriksaan Bagus","Kurangi Konsumsi Kopi","admin","2017-10-16 21:44:50","","2017-10-16 21:44:50");
INSERT INTO periksa VALUES("7","2","2017-10-23","Bagus","Kurangi begadang dan mandi malam","klinik","2017-10-23 20:15:05","","2017-10-23 20:15:05");
INSERT INTO periksa VALUES("9","4","2017-10-31","Bagus","Istirahat yang cukup","klinik","2017-10-31 21:29:52","","2017-10-31 21:29:52");
INSERT INTO periksa VALUES("10","5","2017-11-05","Hasil Pemeriksaan","Catatan","admin","2017-11-05 10:43:05","","2017-11-05 10:43:05");



DROP TABLE petugas;

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
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`petugas_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

INSERT INTO petugas VALUES("1","A123","Devita Putri Permatasari","Admin Pendaftaran","Perempuan","Islam","085123456789","Klaten","Bertanggung jawab sepenuhnya dalam mengatur pendaftaran pasien","admin","2017-10-13 21:08:40","0000-00-00 00:00:00","2017-10-13 21:12:02");



DROP TABLE poliklinik;

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
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`poliklinik_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO poliklinik VALUES("1","PL001","Poliklinik Umum","R123","Rochmad Widianto","Untuk pelayanan umum","admin","2017-10-13 21:38:08","0000-00-00 00:00:00","2017-10-13 21:39:17");
INSERT INTO poliklinik VALUES("2","PL002","Poliklinik Ibu dan Anak","R254","Tiya Apriliyanti","Untuk pelayanan Ibu dan Anak","admin","2017-10-13 21:39:04","","2017-10-13 21:39:04");
INSERT INTO poliklinik VALUES("4","PL003","Poliklinik Gigi","R254","Devita Putri Permatasari","Untuk pelayanan gigi dan mulut","admin","2017-10-13 21:40:38","","2017-10-13 21:40:38");



DROP TABLE rekam_medis;

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
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`rekam_medis_id`),
  KEY `FK_rekam_medis_daftar_id` (`rekam_medis_daftar_id`),
  CONSTRAINT `FK_rekam_medis_daftar_id` FOREIGN KEY (`rekam_medis_daftar_id`) REFERENCES `daftar` (`daftar_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

INSERT INTO rekam_medis VALUES("1","6","RM20171015.000002.001","Ultraflu","Sakit kepala sudah 3 hari disertai demam dan kadang - kadang merasa mual","2017-10-15","Amocxilin 250mg 2 x 1\nParacetamol 500mg 3 x 1","admin","2017-10-15 15:44:15","admin","2017-10-20 23:05:59");
INSERT INTO rekam_medis VALUES("2","7","RM20171016.000001.002","Ultraflu & Konidin","Sering mual selama 3 hari berturut - turut","2017-10-16","Meiji 3 x 1\nPromag 3 x 2\nAmoxilin 2 x 1","admin","2017-10-16 22:12:31","klinik","2017-10-23 20:15:05");
INSERT INTO rekam_medis VALUES("4","9","RM20171031.000003.002","-","-","2017-10-31","Amoxilin 250mg 2 x 3\nParacetamol 500mg 3 x 1\n","klinik","2017-10-31 20:20:46","klinik","2017-10-31 21:29:52");
INSERT INTO rekam_medis VALUES("5","12","RM20171105.000005.001","Alergi Obat","Diagnosa","2017-11-05","Terapi","admin","2017-11-05 10:40:50","admin","2017-11-05 10:43:05");
INSERT INTO rekam_medis VALUES("6","10","RM20171106.000004.001","Paracetamol","Demam tinggi selama 2 hari","2017-11-06","","admin","2017-11-06 21:30:44","","2017-11-06 21:30:44");



DROP TABLE tindakan;

CREATE TABLE `tindakan` (
  `tindakan_id` int(11) NOT NULL AUTO_INCREMENT,
  `tindakan_kode` varchar(255) DEFAULT NULL,
  `tindakan_nama` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_by` varchar(255) DEFAULT NULL,
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`tindakan_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

INSERT INTO tindakan VALUES("1","RJ","Rawat Jalan","admin","2017-10-13 22:04:44","0000-00-00 00:00:00","2017-10-13 22:06:32");
INSERT INTO tindakan VALUES("2","RI","Rawat Inap","admin","2017-10-13 22:04:53","","2017-10-13 22:04:53");



DROP TABLE users;

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
  `update_at` datetime DEFAULT NULL,
  PRIMARY KEY (`user_id`,`username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO users VALUES("1","admin","21232f297a57a5a743894a0e4a801fc3","admin","admin@mail.com","082356785333","administrator","Y","avatar4.png","baim","2017-01-13 13:27:52","klinik","2017-11-03 22:13:29");
INSERT INTO users VALUES("3","dokter","d22af4180eee4bd95072eb90f94930e5","Dokter","dokter@mail.com","081329076822","dokter","Y","avatar.png","klinik","2017-11-03 22:11:33","","2017-11-03 22:11:33");
INSERT INTO users VALUES("4","petugas","afb91ef692fd08c445e8cb1bab2ccf9c","Petugas","petugas@mail.com","089221342890","petugas","Y","avatar3.png","klinik","2017-11-03 22:12:41","","2017-11-03 22:12:41");



