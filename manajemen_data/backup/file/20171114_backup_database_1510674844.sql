DROP TABLE dokter;

CREATE TABLE `dokter` (
  `kd_dokter` int(11) NOT NULL AUTO_INCREMENT,
  `kd_poli` int(11) NOT NULL,
  `tgl_kunjungan` int(12) NOT NULL,
  `kd_user` int(11) NOT NULL,
  `nm_dokter` varchar(300) NOT NULL,
  `sip` enum('pagi','siang','malam','') NOT NULL,
  `tmpat_lhr` varchar(300) NOT NULL,
  `no_tlp` varchar(14) NOT NULL,
  `alamat` varchar(300) NOT NULL,
  PRIMARY KEY (`kd_dokter`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO dokter VALUES("5","2","1410530415","9","Maful Prayoga Arnandi","","Banjarnegara","0892112312","Punggelan, Banjarnegara");
INSERT INTO dokter VALUES("6","2","1410530573","9","Rasya P Arnandi","","","886789678966","Banjarnegara");
INSERT INTO dokter VALUES("7","1","2014","10","Mama","","","284924","Klapa");
INSERT INTO dokter VALUES("8","1","1410613435","9","Bapa","","","323","Kalimanah");



DROP TABLE kunjungan;

CREATE TABLE `kunjungan` (
  `tgl_kunjungan` date NOT NULL,
  `no_pasien` int(11) NOT NULL,
  `kd_poli` int(11) NOT NULL,
  `jam_kunjungan` time NOT NULL,
  `kd_kunjungan` int(12) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`kd_kunjungan`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

INSERT INTO kunjungan VALUES("2014-02-19","16","2","06:44:00","6");
INSERT INTO kunjungan VALUES("2014-09-11","19","2","01:37:00","7");
INSERT INTO kunjungan VALUES("2014-09-11","22","1","05:21:00","8");
INSERT INTO kunjungan VALUES("2014-09-11","18","1","05:05:00","9");
INSERT INTO kunjungan VALUES("2014-09-11","20","2","05:20:00","10");
INSERT INTO kunjungan VALUES("2016-11-07","16","1","10:52:00","11");



DROP TABLE laboratorium;

CREATE TABLE `laboratorium` (
  `kd_lab` int(11) NOT NULL AUTO_INCREMENT,
  `no_rm` int(11) NOT NULL,
  `hasil_lab` varchar(300) NOT NULL,
  `ket` text NOT NULL,
  PRIMARY KEY (`kd_lab`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

INSERT INTO laboratorium VALUES("4","6","Berhasil","Berhasil Uji Laborat");
INSERT INTO laboratorium VALUES("5","6","Gagal","Kekurangan Peralatan");
INSERT INTO laboratorium VALUES("6","6","Berhasil","Berhasil melakukan uji coba.");
INSERT INTO laboratorium VALUES("7","5","Berhasil Uji Coba","Pengujian kadar gula darah pada pasien");



DROP TABLE login;

CREATE TABLE `login` (
  `kd_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(300) NOT NULL,
  `password` varchar(300) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `alamat` text NOT NULL,
  PRIMARY KEY (`kd_user`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

INSERT INTO login VALUES("9","maful","3532c59f0f59e9fc8b2c9ea41e24b196","Maful P Arnandi","Klapa, Punggelan, Banjarnegara.");
INSERT INTO login VALUES("10","rochmad","ebecf868c14c5f88146da2608a1feed2","Rochmad Widianto","Klaten");



DROP TABLE obat;

CREATE TABLE `obat` (
  `kd_obat` int(11) NOT NULL AUTO_INCREMENT,
  `nm_obat` varchar(300) NOT NULL,
  `jml_obat` int(11) NOT NULL,
  `ukuran` int(11) NOT NULL,
  `harga` int(25) NOT NULL,
  PRIMARY KEY (`kd_obat`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

INSERT INTO obat VALUES("1","Paracetamol","10","10","10000");
INSERT INTO obat VALUES("4","Jamu kamu","20","2","200000");
INSERT INTO obat VALUES("5","Komik","200","1","1000");



DROP TABLE pasien;

CREATE TABLE `pasien` (
  `no_pasien` int(11) NOT NULL AUTO_INCREMENT,
  `nm_pasien` varchar(300) NOT NULL,
  `j_kel` varchar(100) NOT NULL,
  `agama` varchar(100) NOT NULL,
  `alamat` varchar(300) NOT NULL,
  `tgl_lhr` date NOT NULL,
  `usia` int(3) NOT NULL,
  `no_tlp` int(14) NOT NULL,
  `nm_kk` varchar(300) NOT NULL,
  `hub_kel` varchar(100) NOT NULL,
  PRIMARY KEY (`no_pasien`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

INSERT INTO pasien VALUES("18","Anggit Pratitis","Pria","Islam","Punggelan","1996-01-06","18","123123","Sugiarso Sudir","Anak Kandung");
INSERT INTO pasien VALUES("19","Dea Melinda Utami","Wanita","Islam","Punggelan","2013-01-06","1","123123","David","Anak Kandung");
INSERT INTO pasien VALUES("20","David","Pria","Islam","Punggelan","1986-01-06","24","123123","Prayit","Anak Kandung");
INSERT INTO pasien VALUES("21","Rochmad Widianto","Pria","Islam","Klaten","1992-11-22","25","856123456","Sukirno","Anak Kandung");



DROP TABLE poliklinik;

CREATE TABLE `poliklinik` (
  `kd_poli` int(11) NOT NULL AUTO_INCREMENT,
  `nm_poli` varchar(300) NOT NULL,
  `lantai` int(11) NOT NULL,
  PRIMARY KEY (`kd_poli`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

INSERT INTO poliklinik VALUES("1","Poli Perut","4");
INSERT INTO poliklinik VALUES("2","Poli Hidung dan Tenggorokan","1");
INSERT INTO poliklinik VALUES("4","Poli Telinga","3");



DROP TABLE rekam_medis;

CREATE TABLE `rekam_medis` (
  `no_rm` int(11) NOT NULL AUTO_INCREMENT,
  `kd_tindakan` int(11) NOT NULL,
  `kd_obat` int(11) NOT NULL,
  `kd_user` int(11) NOT NULL,
  `no_pasien` int(11) NOT NULL,
  `diagnosa` varchar(300) NOT NULL,
  `resep` varchar(300) NOT NULL,
  `keluhan` varchar(300) NOT NULL,
  `tgl_pemeriksaan` int(12) NOT NULL,
  `ket` text NOT NULL,
  PRIMARY KEY (`no_rm`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

INSERT INTO rekam_medis VALUES("6","2","2","2","18","stadium","Infotermida","letih","1410044752","sakit parah");
INSERT INTO rekam_medis VALUES("8","2","2","2","19","terjangkit","Minum Obat","pusing kepala","1410530415","sakit kentut");
INSERT INTO rekam_medis VALUES("9","5","1","9","18","terjangkit","3 kali sehari","Nyeri Otot","1410530573","sasasa");
INSERT INTO rekam_medis VALUES("10","5","1","9","16","gejala","2 kali sehari","Sakit Pinggang","1410530415","Diberi Obat");



DROP TABLE tindakan;

CREATE TABLE `tindakan` (
  `kd_tindakan` int(11) NOT NULL AUTO_INCREMENT,
  `nm_tindakan` varchar(300) NOT NULL,
  `ket` text NOT NULL,
  PRIMARY KEY (`kd_tindakan`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

INSERT INTO tindakan VALUES("5","Rawat Inap","Di Rawat di Rumah Sakit");
INSERT INTO tindakan VALUES("7","Rawat Inap","UPT Puskesmas 1");
INSERT INTO tindakan VALUES("8","Rawat Jalan","Rawat Jalan dengan minum obat teratur");



