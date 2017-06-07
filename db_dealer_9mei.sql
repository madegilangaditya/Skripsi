/*
SQLyog Ultimate v11.33 (64 bit)
MySQL - 5.1.41 : Database - db_dealer
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`db_dealer` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `db_dealer`;

/*Table structure for table `tb_angsuran` */

DROP TABLE IF EXISTS `tb_angsuran`;

CREATE TABLE `tb_angsuran` (
  `id_angsuran` int(11) NOT NULL AUTO_INCREMENT,
  `uang_muka` int(11) NOT NULL,
  `angsuran` int(11) NOT NULL,
  `jangka_waktu` tinyint(2) DEFAULT NULL,
  `id_harga` tinyint(4) DEFAULT NULL,
  `id_finance` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id_angsuran`),
  KEY `id_harga` (`id_harga`),
  KEY `id_finance` (`id_finance`),
  CONSTRAINT `tb_angsuran_ibfk_2` FOREIGN KEY (`id_harga`) REFERENCES `tb_harga` (`id_harga`),
  CONSTRAINT `tb_angsuran_ibfk_3` FOREIGN KEY (`id_finance`) REFERENCES `tb_finance` (`id_finance`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_angsuran` */

/*Table structure for table `tb_cart` */

DROP TABLE IF EXISTS `tb_cart`;

CREATE TABLE `tb_cart` (
  `id_cart` int(11) NOT NULL AUTO_INCREMENT,
  `id_login` int(11) DEFAULT NULL,
  `id_harga` int(11) DEFAULT NULL,
  `id_warna` tinyint(4) DEFAULT NULL,
  `jumlah` tinyint(4) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  PRIMARY KEY (`id_cart`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `tb_cart` */

insert  into `tb_cart`(`id_cart`,`id_login`,`id_harga`,`id_warna`,`jumlah`,`tanggal`) values (8,20,12,8,1,'2017-04-27');

/*Table structure for table `tb_dealer` */

DROP TABLE IF EXISTS `tb_dealer`;

CREATE TABLE `tb_dealer` (
  `id_dealer` int(11) NOT NULL AUTO_INCREMENT,
  `id_kecamatan` tinyint(4) DEFAULT NULL,
  `nama_dealer` varchar(20) NOT NULL,
  `alamat` varchar(200) NOT NULL,
  `telp` char(12) DEFAULT NULL,
  `id_login` smallint(6) DEFAULT NULL,
  PRIMARY KEY (`id_dealer`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

/*Data for the table `tb_dealer` */

insert  into `tb_dealer`(`id_dealer`,`id_kecamatan`,`nama_dealer`,`alamat`,`telp`,`id_login`) values (1,57,'kasih motor','jalan balai no 32','081989898878',NULL),(2,31,'Tirta Agung Motor','Jl. Wr. Supratman, Sumerta','0361247423',8),(3,1,'Bintang Mas Motor','Jl I Gusti Ngurah Rai 66, Dauh Waru','036541324',9),(6,28,'Astra Motor Nusa Dua','Jl. By Pass Ngurah Rai No.100X, Benoa','0361770507',25);

/*Table structure for table `tb_det_motor` */

DROP TABLE IF EXISTS `tb_det_motor`;

CREATE TABLE `tb_det_motor` (
  `id_det_motor` tinyint(4) NOT NULL AUTO_INCREMENT,
  `id_motor` tinyint(4) NOT NULL,
  `nama_det_motor` varchar(25) NOT NULL,
  PRIMARY KEY (`id_det_motor`),
  KEY `id_motor` (`id_motor`),
  CONSTRAINT `tb_det_motor_ibfk_1` FOREIGN KEY (`id_motor`) REFERENCES `tb_motor` (`id_motor`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `tb_det_motor` */

insert  into `tb_det_motor`(`id_det_motor`,`id_motor`,`nama_det_motor`) values (4,3,'Jupiter Z F1'),(7,4,'Revo FI FIT'),(8,4,'Revo FI STD'),(9,4,'Revo FI CW'),(10,5,'Blade 125 R FI'),(11,5,'Blade 125 Repsol FI'),(12,2,'Supra X 125 FI STD'),(13,2,'Supra X 125 FI CW'),(14,6,'Supra X 125 Helm In '),(15,7,'Supra GTR 150 Sporty'),(16,7,'Supra GTR 150 Exclusive'),(17,8,'Spacy PGM FI');

/*Table structure for table `tb_det_transaksi` */

DROP TABLE IF EXISTS `tb_det_transaksi`;

CREATE TABLE `tb_det_transaksi` (
  `id_det_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaksi` int(11) NOT NULL,
  `id_harga` tinyint(4) NOT NULL,
  `id_warna` tinyint(4) DEFAULT NULL,
  `jumlah` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id_det_transaksi`),
  KEY `id_transaksi` (`id_transaksi`),
  KEY `id_harga` (`id_harga`),
  KEY `id_warna` (`id_warna`),
  CONSTRAINT `tb_det_transaksi_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `tb_transaksi` (`id_transaksi`) ON UPDATE CASCADE,
  CONSTRAINT `tb_det_transaksi_ibfk_3` FOREIGN KEY (`id_warna`) REFERENCES `tb_warna` (`id_warna`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=latin1;

/*Data for the table `tb_det_transaksi` */

insert  into `tb_det_transaksi`(`id_det_transaksi`,`id_transaksi`,`id_harga`,`id_warna`,`jumlah`) values (18,18,9,NULL,1),(19,19,9,NULL,1),(20,20,9,3,2),(21,20,9,1,2),(22,20,9,2,1),(23,20,11,1,1),(24,21,9,1,1),(25,22,11,2,1),(26,23,9,1,1),(27,24,9,1,1),(29,28,12,8,1),(40,42,12,7,2),(41,43,11,1,1),(42,44,12,7,1),(43,45,17,21,1),(44,46,9,1,1);

/*Table structure for table `tb_fasilitas` */

DROP TABLE IF EXISTS `tb_fasilitas`;

CREATE TABLE `tb_fasilitas` (
  `id_fasilitas` smallint(6) NOT NULL AUTO_INCREMENT,
  `id_harga` tinyint(4) DEFAULT NULL,
  `servis` tinyint(4) DEFAULT NULL,
  `helm` enum('1','2') DEFAULT NULL,
  `bpkb` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id_fasilitas`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `tb_fasilitas` */

insert  into `tb_fasilitas`(`id_fasilitas`,`id_harga`,`servis`,`helm`,`bpkb`) values (1,9,5,'2',3),(2,11,4,'1',4),(3,12,5,'1',5),(4,13,4,'1',5),(5,14,3,'1',3),(6,15,5,'1',5),(7,16,4,'1',4),(8,17,4,'1',4),(9,18,4,'1',4),(10,19,4,'1',4);

/*Table structure for table `tb_finance` */

DROP TABLE IF EXISTS `tb_finance`;

CREATE TABLE `tb_finance` (
  `id_finance` tinyint(4) NOT NULL AUTO_INCREMENT,
  `id_kecamatan` tinyint(4) DEFAULT NULL,
  `nama_finance` varchar(20) NOT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `telp` char(12) DEFAULT NULL,
  PRIMARY KEY (`id_finance`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tb_finance` */

insert  into `tb_finance`(`id_finance`,`id_kecamatan`,`nama_finance`,`alamat`,`telp`) values (1,47,'FIF','jalan pulo jon no 32','089898787363');

/*Table structure for table `tb_harga` */

DROP TABLE IF EXISTS `tb_harga`;

CREATE TABLE `tb_harga` (
  `id_harga` tinyint(4) NOT NULL AUTO_INCREMENT,
  `id_det_motor` tinyint(4) DEFAULT NULL,
  `id_dealer` int(11) DEFAULT NULL,
  `harga_cash` int(11) unsigned DEFAULT NULL,
  `stok` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id_harga`),
  KEY `id_dealer` (`id_dealer`),
  KEY `id_det_motor` (`id_det_motor`),
  CONSTRAINT `tb_harga_ibfk_2` FOREIGN KEY (`id_dealer`) REFERENCES `tb_dealer` (`id_dealer`),
  CONSTRAINT `tb_harga_ibfk_3` FOREIGN KEY (`id_det_motor`) REFERENCES `tb_det_motor` (`id_det_motor`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

/*Data for the table `tb_harga` */

insert  into `tb_harga`(`id_harga`,`id_det_motor`,`id_dealer`,`harga_cash`,`stok`) values (9,7,2,13500000,125),(11,7,3,14450000,99),(12,10,2,13500000,12),(13,13,3,18650000,18),(15,12,3,17550000,20),(16,14,3,19100000,80),(17,16,2,22850000,29),(18,7,6,14450000,44),(19,17,6,15300000,40);

/*Table structure for table `tb_kabupaten` */

DROP TABLE IF EXISTS `tb_kabupaten`;

CREATE TABLE `tb_kabupaten` (
  `id_kabupaten` int(20) NOT NULL AUTO_INCREMENT,
  `id_provinsi` int(20) DEFAULT NULL,
  `nama_kabupaten` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_kabupaten`),
  KEY `id_provinsi` (`id_provinsi`),
  CONSTRAINT `id_provinsi` FOREIGN KEY (`id_provinsi`) REFERENCES `tb_provinsi` (`id_provinsi`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `tb_kabupaten` */

insert  into `tb_kabupaten`(`id_kabupaten`,`id_provinsi`,`nama_kabupaten`) values (1,16,'Jembrana'),(2,16,'Buleleng'),(3,16,'Tabanan'),(4,16,'Badung'),(5,16,'Denpasar'),(6,16,'Gianyar'),(7,16,'Klungkung'),(8,16,'Bangli'),(9,16,'Karangasem');

/*Table structure for table `tb_kecamatan` */

DROP TABLE IF EXISTS `tb_kecamatan`;

CREATE TABLE `tb_kecamatan` (
  `id_kecamatan` tinyint(4) NOT NULL AUTO_INCREMENT,
  `id_kabupaten` int(20) DEFAULT NULL,
  `nama_kecamatan` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_kecamatan`),
  KEY `id_kabupaten` (`id_kabupaten`),
  CONSTRAINT `id_kabupaten` FOREIGN KEY (`id_kabupaten`) REFERENCES `tb_kabupaten` (`id_kabupaten`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=58 DEFAULT CHARSET=latin1;

/*Data for the table `tb_kecamatan` */

insert  into `tb_kecamatan`(`id_kecamatan`,`id_kabupaten`,`nama_kecamatan`) values (1,1,'Negara'),(2,1,'Mendoyo'),(3,1,'Pekutatan'),(4,1,'Melaya'),(5,2,'Gerokgak'),(6,2,'Seirit'),(7,2,'Busungbiu'),(8,2,'Banjar'),(9,2,'Sukasada'),(10,2,'Buleleng'),(11,2,'Sawan'),(12,2,'Kubutambahan'),(13,2,'Tejakula'),(14,3,'Selemadeg'),(15,3,'Selemadeg Timur'),(16,3,'Selemadeg Barat'),(17,3,'Kerambitan'),(18,3,'Tabanan'),(19,3,'Kediri'),(20,3,'Marga'),(21,3,'Penebel'),(22,3,'Baturiti'),(23,3,'Pupuan'),(24,4,'Kuta'),(25,4,'Mengwi'),(26,4,'Abiansemal'),(27,4,'Petang'),(28,4,'Kuta Selatan'),(29,4,'Kuta Utara'),(30,5,'Denpasar Selatan'),(31,5,'Denpasar Timur'),(32,5,'Denpasar Barat'),(33,5,'Denpasar Utara'),(34,6,'Sukawati'),(35,6,'Blahbatuh'),(36,6,'Gianyar'),(37,6,'Tampaksiring'),(38,6,'Ubud'),(39,6,'Tegalalang'),(40,6,'Payangan'),(41,7,'Nusa Penida'),(42,7,'Banjarangkan'),(43,7,'Klungkung'),(44,7,'Dawan'),(45,8,'Susut'),(46,8,'Bangli'),(47,8,'Tembuku'),(48,8,'Kintamani'),(49,9,'Rendang'),(50,9,'Sideman'),(51,9,'Manggis'),(52,9,'Karangasem'),(53,9,'Abang'),(54,9,'Bebandem'),(55,9,'Selat'),(56,9,'Kubu'),(57,1,'Jembrana');

/*Table structure for table `tb_kredit` */

DROP TABLE IF EXISTS `tb_kredit`;

CREATE TABLE `tb_kredit` (
  `id_kredit` int(11) NOT NULL AUTO_INCREMENT,
  `id_det_transaksi` int(11) NOT NULL,
  `id_angsuran` int(11) NOT NULL,
  PRIMARY KEY (`id_kredit`),
  KEY `id_det_transaksi` (`id_det_transaksi`),
  KEY `id_angsuran` (`id_angsuran`),
  CONSTRAINT `tb_kredit_ibfk_1` FOREIGN KEY (`id_det_transaksi`) REFERENCES `tb_det_transaksi` (`id_det_transaksi`) ON UPDATE CASCADE,
  CONSTRAINT `tb_kredit_ibfk_2` FOREIGN KEY (`id_angsuran`) REFERENCES `tb_angsuran` (`id_angsuran`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_kredit` */

/*Table structure for table `tb_login` */

DROP TABLE IF EXISTS `tb_login`;

CREATE TABLE `tb_login` (
  `id_login` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(20) NOT NULL,
  `otoritas` enum('1','2','3','4') NOT NULL COMMENT '1=user, 2=admin, 3=dealer, 4=finance',
  PRIMARY KEY (`id_login`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

/*Data for the table `tb_login` */

insert  into `tb_login`(`id_login`,`username`,`password`,`otoritas`) values (1,'admin','admin','2'),(6,'kasmor','kasmor','3'),(7,'jon','jon','4'),(8,'dealer1','dealer1','3'),(9,'dealer2','dealer2','3'),(10,'joni','joni','1'),(11,'joan','joan','1'),(12,'joana','joana','1'),(13,'bro','bro','1'),(17,'mad','mad','1'),(18,'bro1','bro1','1'),(19,'bro2','bro2','1'),(20,'brojon','brojon','1'),(21,'gilang','gilang','1'),(22,'sukra','sukra','1'),(25,'asnusa','asnusa','3');

/*Table structure for table `tb_member` */

DROP TABLE IF EXISTS `tb_member`;

CREATE TABLE `tb_member` (
  `id_member` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_member`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tb_member` */

insert  into `tb_member`(`id_member`,`username`,`password`,`email`) values (1,'jon','jon','jon@jon');

/*Table structure for table `tb_merk` */

DROP TABLE IF EXISTS `tb_merk`;

CREATE TABLE `tb_merk` (
  `id_merk` tinyint(4) NOT NULL AUTO_INCREMENT,
  `nama_merk` varchar(20) NOT NULL,
  `gambar` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id_merk`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `tb_merk` */

insert  into `tb_merk`(`id_merk`,`nama_merk`,`gambar`) values (1,'Honda','images/barang/merk/3277238_20130203121230.jpg'),(2,'Yamaha','images/barang/merk/cloud1.png');

/*Table structure for table `tb_motor` */

DROP TABLE IF EXISTS `tb_motor`;

CREATE TABLE `tb_motor` (
  `id_motor` tinyint(4) NOT NULL AUTO_INCREMENT,
  `id_merk` tinyint(4) DEFAULT NULL,
  `id_type` tinyint(4) DEFAULT NULL,
  `nama_motor` varchar(20) NOT NULL,
  `deskripsi` text NOT NULL,
  `spesifikasi` text NOT NULL,
  PRIMARY KEY (`id_motor`),
  KEY `id_merk` (`id_merk`),
  KEY `id_type` (`id_type`),
  CONSTRAINT `tb_motor_ibfk_1` FOREIGN KEY (`id_merk`) REFERENCES `tb_merk` (`id_merk`),
  CONSTRAINT `tb_motor_ibfk_2` FOREIGN KEY (`id_type`) REFERENCES `tb_type` (`id_type`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `tb_motor` */

insert  into `tb_motor`(`id_motor`,`id_merk`,`id_type`,`nama_motor`,`deskripsi`,`spesifikasi`) values (2,1,1,'Supra X 125','<p><strong>Motor Honda Supra X 125</strong>&nbsp;seperti kita tahu adalah&nbsp;<strong>Rajanya Motor Bebek</strong>&nbsp;hadir dalam 2 varian:</p>\r\n\r\n<ol>\r\n	<li>Supra X FI STD (Pelek Jari Jari)</li>\r\n	<li>Supra X FI CW (Pelek Racing)</li>\r\n</ol>\r\n\r\n<p>Beberapa penghargaan yang telah dimenangkan oleh&nbsp;<strong>Honda Supra X</strong>&nbsp;adalah:</p>\r\n\r\n<ol>\r\n	<li>Best Fuel Consumption Kategori Motor Bebek 120 &ndash; 125 cc di Otomotif Award 2010</li>\r\n	<li>Best Design Kategori Motor Bebek Injeksi di Otomotif Award 2010</li>\r\n	<li>Best Fuel Consumption Kategori Motor Bebek Injeksi di Otomotif Award 2010</li>\r\n	<li>Indonesia Best Brand Award (IBBA) 2012 dari majalah SWA.</li>\r\n	<li>Kartini Award for Not Automatic Motorcyle dari majalah Kartini.</li>\r\n	<li>Top Brand 2012.</li>\r\n	<li>Top Brand 2013 dari Majalah Marketing dan Lembaga Survey Frontier.</li>\r\n</ol>\r\n\r\n<p>Berikut adalah beberapa fitur unggulan dari Honda Supra X 125 FI ini:</p>\r\n\r\n<ol>\r\n	<li>Mesin 125cc &ndash; 4 tak SOHC dengan PGM-FI.</li>\r\n	<li>Charging port untuk handphone anda.</li>\r\n	<li>Pengaman kunci kontak bermagnet (secure key shutter) untuk mengurangi resiko pencurian.</li>\r\n	<li>Sistem pembuka kunci jok &nbsp;yang berada di rumah kunci utama di depan.</li>\r\n	<li>Fitur gantungan barang dengan pengaman pada bagian leher motor.</li>\r\n	<li>Speedometer sporty &amp; informatif dengan combined Analog &ndash; Digital panel meter.</li>\r\n	<li>Rem cakram ganda&nbsp;&ndash; Front &amp; Rear disk brake yang meningkatkan aspek keselamatan dengan sistem pengereman yang lebih optimal (khusus Supra X 125 CW. Fitur ini tidak hadir di Supra X 125 STD).</li>\r\n	<li>Konsumsi bahan bakar hingga 61,8 km/liter (pengujian internal).</li>\r\n</ol>\r\n','<table border=\"1\">\r\n	<tbody>\r\n		<tr>\r\n			<td colspan=\"2\">DIMENSI</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Dimensi (P x L x T)</td>\r\n			<td>1.918 x 709 x 1.101 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Jarak sumbu Roda</td>\r\n			<td>1.235 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Jarak terendah ke tanah</td>\r\n			<td>136.5 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Berat kosong</td>\r\n			<td>103 kg (STD)<br />\r\n			106 kg (CW)</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">RANGKA</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Rangka</td>\r\n			<td>Tulang punggung</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Suspensi depan</td>\r\n			<td>Teleskopik</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Suspensi belakang</td>\r\n			<td>Lengan ayun dengan shockbreaker ganda</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Ukuran Ban depan</td>\r\n			<td>70/90 &ndash; 17 M/C 38P</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Ukuran Ban Belakang</td>\r\n			<td>80/90 &ndash; 17 M/C 44P</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Rem depan</td>\r\n			<td>Cakram hidrolik dengan piston tunggal</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Rem belakang</td>\r\n			<td>Tromol (STD)<br />\r\n			Cakram hidrolik dengan piston tunggal (CW)</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">MESIN</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Tipe mesin</td>\r\n			<td>4 Langkah SOHC, Silinder tunggal</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Sistem pendinginan</td>\r\n			<td>Pendinginan udara</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Diameter x langkah</td>\r\n			<td>52.4 x 57.9 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Volume langkah</td>\r\n			<td>124,89 cc</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Perbandingan kompresi</td>\r\n			<td>9,3 : 1</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Daya maksimum</td>\r\n			<td>7.40 kW (10.1 PS) / 8.000 rpm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Torsi maksimum</td>\r\n			<td>9.30 Nm (0.95 kgf.m) / 4.000 rpm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Tipe kopling</td>\r\n			<td>Multiple wet clutch with coil spring</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Starter</td>\r\n			<td>Starter kaki dan elektrik</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Busi</td>\r\n			<td>NGK CPR6EA-9 / ND U20EPR9</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Sistem bahan bakar</td>\r\n			<td>Karburator</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">KAPASITAS</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Kapasitas tangki bahan bakar</td>\r\n			<td>4,0 liter</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Kapasitas Minyak Pelumas Mesin</td>\r\n			<td>0,7 liter pada penggantian periodik</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Transmisi</td>\r\n			<td>4 kecepatan, rotary</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Pola pengoperan gigi</td>\r\n			<td>N-1-2-3-4-N</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">KELISTRIKAN</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Tipe battery</td>\r\n			<td>MF 12V &ndash; 3.0 Ah</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Sistem pengapian</td>\r\n			<td>Full Transisterized</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n'),(3,2,1,'Jupiter','hjkj','dad'),(4,1,1,'Revo','<p><strong>Motor Honda Revo</strong>&nbsp;adalah motor bebek paling populer di Indonesia. Dengan tagline &ldquo;Kerennya Jagoan Kita&rdquo;,</p>\r\n\r\n<p>Fitur unggulan Honda Revo series adalah:</p>\r\n\r\n<ol>\r\n	<li>Mesin injeksi tangguh &amp; irit teknologi PGM-FI, membuat New Honda Revo FI lebih bertenaga, mudah dirawat.</li>\r\n	<li>Bagasi serba guna berkapasitas 7 liter.</li>\r\n	<li>Front disk brake yang membantu pengereman.</li>\r\n	<li>Secure key shutter&nbsp;&ndash; pengaman kunci kontak bermagnet (magnetic key shutter) yang efektif mengurangi resiko pencurian motor.</li>\r\n</ol>\r\n\r\n<p>Motor Honda Revo FI ini memiliki konsumsi BBM 62.2 km/liter yang diuji melalui metode pengujian ECE R40.</p>\r\n','<table border=\"1\">\r\n	<tbody>\r\n		<tr>\r\n			<td colspan=\"2\">DIMENSI</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Dimensi (P x L x T)</td>\r\n			<td>1.919 x 709 x 1.080 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Jarak sumbu Roda</td>\r\n			<td>1.227 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Jarak terendah ke tanah</td>\r\n			<td>135 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Berat kosong</td>\r\n			<td>97.5 kg</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">RANGKA</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Rangka</td>\r\n			<td>Tulang punggung</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Suspensi depan</td>\r\n			<td>Teleskopik</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Suspensi belakang</td>\r\n			<td>Lengan ayun dengan suspensi ganda</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Ukuran Ban depan</td>\r\n			<td>70/90 &ndash; 17 M/C 38P</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Ukuran Ban Belakang</td>\r\n			<td>80/90 &ndash; 17 M/C 44P</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Rem depan</td>\r\n			<td>Cakram hidrolik dengan piston tunggal</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Rem belakang</td>\r\n			<td>Tromol</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">MESIN</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Tipe mesin</td>\r\n			<td>4 Langkah SOHC, silinder tunggal</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Sistem pendinginan</td>\r\n			<td>Pendinginan udara</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Diameter x langkah</td>\r\n			<td>50 x 55,6 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Volume langkah</td>\r\n			<td>109,17 cc</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Perbandingan kompresi</td>\r\n			<td>9,3 : 1</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Daya maksimum</td>\r\n			<td>6,56 kW (8,91 PS) / 7.500 rpm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Torsi maksimum</td>\r\n			<td>&ndash;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Kopling</td>\r\n			<td>Multiple wet clutch with Diaphragm Spring</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Starter</td>\r\n			<td>Starter kaki dan elektrik</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Busi</td>\r\n			<td>NGK CPR6EA-9S atau NDU20EPR9S</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">KAPASITAS</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Kapasitas tangki bahan bakar</td>\r\n			<td>4,0 liter</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Kapasitas Minyak Pelumas Mesin</td>\r\n			<td>0,8 liter pada penggantian periodik</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Transmisi</td>\r\n			<td>4 kecepatan/bertautan tetap</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Pola Pengoperan Gigi</td>\r\n			<td>N &ndash; 1 &ndash; 2 &ndash; 3 &ndash; 4 &ndash; N</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">KELISTRIKAN</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Aki</td>\r\n			<td>MF battery, 12 V &ndash; 3 A.h</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Sistem pengapian</td>\r\n			<td>Full Transisterized</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n'),(5,1,1,'Blade','<p><strong>Motor New Honda Blade</strong>&nbsp;&ndash; The Real Racing Spirit tampil dalam 3 pilihan warna. New Honda Blade merupakan motor bebek beraura balap dengan desain ramping, mesin performa tinggi dan fitur fitur handal. Desain bodinya tampil dengan garis-garis yang tajam dan tegas, serta warna bodi dan grafis striping yang agresif.</p>\r\n\r\n<p>New Honda Blade memiliki pilihan warna winning red&nbsp;yang terinspirasi dari DNA balap Honda. Selain itu juga, New Honda Blade memiliki pilihan warna tim Repsol Honda yang berlaga di MotoGP.</p>\r\n\r\n<p>Motor ini diterima dengan baik sebagai ikon balap Honda oleh generasi muda atau konsumen berjiwa muda yang tampil percaya diri dan menyenangi aktifitas balap.&nbsp;Sejak pertama kali diperkenalkan pada Agustus 2011 hingga Oktober 2012, New Honda Blade telah terjual lebih dari 300,000 unit.</p>\r\n\r\n<p>Motor New&nbsp;Honda Blade&nbsp;ini juga memenangkan penghargaan Best Design Kategori Bebek 100-115 cc di Otomotif Award 2010.</p>\r\n\r\n<p>Fitur New Honda Blade</p>\r\n\r\n<p>Berikut adalah beberapa fitur dari Honda Blade 125 FI:</p>\r\n\r\n<ol>\r\n	<li>Kapasitas tangki BBM yang besar hingga 4 liter.</li>\r\n	<li>Kapasitas bagasi luas hinga 7.3 liter.</li>\r\n	<li>Lampu utama ganda yang dilengkapi multireflektor, memberikan jangkauan lampu lebih luas dan terang.</li>\r\n	<li>Mesin injeksi 125 cc, SOHC, empat langkah, silinder tunggal.</li>\r\n	<li>Front &amp; Rear Disc Brake &ndash; rek cakram.</li>\r\n	<li>Secure Key Shutter&nbsp;&ndash; Sistem penguncian bermagnet yang kuat dan nyaman, mengurangi resiko pencurian.</li>\r\n</ol>\r\n','<table border=1>\r\n	<tbody>\r\n		<tr>\r\n			<td colspan=\"2\">DIMENSI</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Dimensi (P x L x T)</td>\r\n			<td>1.902 x 707x 1.103 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Jarak sumbu Roda</td>\r\n			<td>1.235 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Jarak terendah ke tanah</td>\r\n			<td>136.5 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Berat kosong</td>\r\n			<td>106 kg (tipe R &amp; Repsol)<br />\r\n			104 kg (tipe S)</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">RANGKA</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Rangka</td>\r\n			<td>Tulang punggung</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Suspensi depan</td>\r\n			<td>Teleskopik</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Suspensi belakang</td>\r\n			<td>Lengan ayun dengan suspensi ganda</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Ukuran Ban depan</td>\r\n			<td>70/90 &ndash; 17 M/C 38P</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Ukuran Ban Belakang</td>\r\n			<td>80/90 &ndash; 17 M/C 44P</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Rem depan</td>\r\n			<td>Cakram hidrolik dengan piston tunggal</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Rem belakang</td>\r\n			<td>Cakram hidrolik dengan piston tunggal (tipe R)<br />\r\n			Tromol (tipe S)</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">MESIN</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Sistem Suplai Bahan Bakar</td>\r\n			<td>Injeksi (PGM-FI/Programmed Fuel Injection)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Tipe mesin</td>\r\n			<td>4 Langkah SOHC, silinder tunggal</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Sistem pendinginan</td>\r\n			<td>Pendinginan udara</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Diameter x langkah</td>\r\n			<td>52.4 x 57.9 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Volume langkah</td>\r\n			<td>124,89 cc</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Perbandingan kompresi</td>\r\n			<td>9,3 : 1</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Daya maksimum</td>\r\n			<td>7.40 kW (10.1 PS) / 8000 rpm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Torsi maksimum</td>\r\n			<td>9,30 Nm (0.95 kgf.m) / 4000 rpm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Kopling</td>\r\n			<td>Multiple wet clutch with coil spring</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Starter</td>\r\n			<td>Starter kaki dan elektrik</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Busi</td>\r\n			<td>NGK CPR6EA-9 / ND U20EPR9</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">KAPASITAS</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Kapasitas tangki bahan bakar</td>\r\n			<td>4,0 liter</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Kapasitas Minyak Pelumas Mesin</td>\r\n			<td>0,7 liter pada penggantian periodik</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Transmisi</td>\r\n			<td>4 kecepatan rotary &ndash; N-1-2-3-4-N</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">KELISTRIKAN</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Aki</td>\r\n			<td>MF battery, 12 V &ndash; 3 A.h</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Sistem pengapian</td>\r\n			<td>Full transisterized</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n'),(6,1,1,'Supra X 125 Helm In','<p><strong>Honda Supra X 125 Helm In</strong>&nbsp;merupakan motor bebek pertama di Indonesia yang mengaplikasikan bagasi super besar mampu menampung sebuah helm full face.Motor ini memiliki kapasitas bagasi mencapai 19,5 liter dan kapasitas tangki bensin motor yang mencapai 5,6 liter. Dalam kondisi tangki penuh, Honda Supra X 125 Helm In mampu berjalan sejauh 287,168 km.</p>\r\n\r\n<p><strong>Perbedaan Honda Supra X 125 Helm In dengan Honda Supra X 125 CW</strong></p>\r\n\r\n<p>Berikut adalah perbedaan Honda Supra X 125 Helm In dengan&nbsp;Honda Supra X 125 CW</p>\r\n\r\n<ol>\r\n	<li>Secara ukuran varian Helm In memiliki dimensi 10 persen lebih besar dari model sebelumnya</li>\r\n	<li>Perubahan desain pada lampu sein dan lampu belakang dengan LED</li>\r\n	<li>Lapisan krom sebagai pelindung panas pada knalpot.</li>\r\n</ol>\r\n\r\n<p><strong>Fitur Honda Supra X 125 Helm in PGM-FI</strong></p>\r\n\r\n<p>Berikut adalah beberapa fitur andalan Honda Supra X 125 Helm In PGM-FI:</p>\r\n\r\n<ol>\r\n	<li>Kapasitas bagasi 19.5 liter &ndash; Dapat menyimpan helm</li>\r\n	<li>Kapasitas tangki BBM 5.6 liter</li>\r\n	<li>Teknologi PGM-FI</li>\r\n	<li>Desain modern dengan lampu utama ganda</li>\r\n	<li>Desain sayap samping 3D yang fungsional</li>\r\n	<li>Desain lampu belakang ganda tampil modern dengan bohlam dan mika lampu LED (Light Emitted Diode)</li>\r\n	<li>Desain dudukan pijakan kaki belakang yang modern terbuat dari bahan aluminium casting</li>\r\n	<li>Desain knalpot dilengkapi pelindung yang elegan.</li>\r\n</ol>\r\n','<table border=1>\r\n	<tbody>\r\n		<tr>\r\n			<td colspan=\"2\">DIMENSI</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Dimensi (P x L x T)</td>\r\n			<td>1.932 x 711x 1092 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Jarak sumbu Roda</td>\r\n			<td>1.258 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Jarak terendah ke tanah</td>\r\n			<td>135 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Berat kosong</td>\r\n			<td>107 kg</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">RANGKA</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Rangka</td>\r\n			<td>Tulang punggung</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Suspensi depan</td>\r\n			<td>Teleskopik</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Suspensi belakang</td>\r\n			<td>Lengan ayun dan peredam kejut ganda</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Ukuran Ban depan</td>\r\n			<td>70/90 &ndash; 17 M/C 38P</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Ukuran Ban Belakang</td>\r\n			<td>80/90 &ndash; 17 M/C 44P</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Rem depan</td>\r\n			<td>Cakram hidrolik dengan piston tunggal</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Rem belakang</td>\r\n			<td>Cakram hidrolik dengan piston tunggal</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">MESIN</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Tipe mesin</td>\r\n			<td>4 langkah, SOHC</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Sistem pendinginan</td>\r\n			<td>Pendinginan udara dengan kipas</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Diameter x langkah</td>\r\n			<td>52.4 x 57.9 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Volume langkah</td>\r\n			<td>124.8 cc</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Perbandingan kompresi</td>\r\n			<td>9,3 : 1</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Daya maksimum</td>\r\n			<td>9.6 PS / 7500 rpm (tipe Helm In CW)<br />\r\n			9.63 PS / 7500 rpm (tipe PGM-FI)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Torsi maksimum</td>\r\n			<td>1.08 kgf.m / 5500 rpm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Kopling</td>\r\n			<td>Ganda, otomatis, sentrifugal, tipe basah</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Starter</td>\r\n			<td>Pedal &amp; Elektrik</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Busi</td>\r\n			<td>ND U20EPR9, NGK CPR6EA-9</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">KAPASITAS</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Kapasitas tangki bahan bakar</td>\r\n			<td>5.6 liter</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Kapasitas Minyak Pelumas Mesin</td>\r\n			<td>0,7 liter pada penggantian periodik</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Transmisi</td>\r\n			<td>4 kecepatan rotary/bertautan tetap</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">KELISTRIKAN</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Aki</td>\r\n			<td>MF 12V-3.0Ah</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Sistem pengapian</td>\r\n			<td>Full Transisterized, Battery (tipe PGM-FI)</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n'),(7,1,1,'Supra GTR 150','<p>AHM dengan resmi memperkenalkan All New Honda Supra GTR150 yang diklaim mampu melahap seluruh medan. AHM ingin menunjukkan bahwa konsep sepeda motor ini tak hanya tangguh sebagai sepeda motor perkotaan, tetapi juga bisa menaklukkan segala kondisi jalan dengan nyaman.</p>\r\n\r\n<p>Model motor sport cub ini memiliki desain dengan posisi berkendara yang menghadirkan kenyamanan optimal, mudah dikendalikan dan stabil dikendarai selama berpetualang dan berkendara jarak jauh yang dikembangkan khusus untuk menjadi pilihan tepat bagi pengendara yang mendambakan kepuasan sejati di setiap perjalanan.</p>\r\n\r\n<p>Fitur All New Honda Supra GTR 150 :</p>\r\n\r\n<ol>\r\n	<li>Desain agresif</li>\r\n	<li>Kombinasi digital panel meter</li>\r\n	<li>Penggunaan lampu LED pada seluruh sistem pencahayaan memberikan tampilan lebih futuristik, intensitas cahaya lebih terang, daya tahan lebih lama dan lebih hemat energi.</li>\r\n	<li>Panel indikator digital yang futuristik dan fungsional menampilkan informasi lengkap seperti kecepatan, putaran mesin, jam digital dan trip meter.</li>\r\n	<li>Akselerasi responsif di setiap perpindahan gigi transmisi hingga&nbsp;11,6 kW (15,9 PS) / 9.000 rpm.</li>\r\n	<li>Mampu dipacu hingga 122 km/jam dengan tetap menghasilkan tingkat konsumsi bahan bakar yang efisien.</li>\r\n	<li>Mesin generasi terbaru 150cc,DOHC&nbsp;4 katup, 6 kecepatan, berpendingin cairan (liquid-cooled) dengan&nbsp;teknologi injeksi PGM-FI.</li>\r\n	<li>Kapasitas tanki bensin 4,5 liter.</li>\r\n	<li>Penggunaan ban tubeless yang lebih besar untuk memberikan rasa aman pada saat menikung maupun pada kecepatan tinggi.</li>\r\n	<li>Rem cakram&nbsp;depan dan belakang.</li>\r\n	<li>Teknologi&nbsp;Secure Key Shutter.</li>\r\n	<li>Hemat bahan bakar dan mampu&nbsp;<strong>menjelajah hingga mencapai 42.20 km / liter&nbsp;</strong>dengan metode pengetesan EURO 3 yang dilakukan perusahaan berdasarkan metode ECE R40. (<strong>EURO 2 : 47,41 km/l</strong>)</li>\r\n</ol>\r\n','<table border=1>\r\n	<tbody>\r\n		<tr>\r\n			<td colspan=\"2\">DIMENSI</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Dimensi (P x L x T)</td>\r\n			<td>2.025 x 725 x 1.102 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Jarak Sumbu Roda</td>\r\n			<td>1.284 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Jarak Terendah Ke Tanah</td>\r\n			<td>150 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Ketinggian Tempat Duduk</td>\r\n			<td>780 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Berat Kosong</td>\r\n			<td>119 kg</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Radius Putar</td>\r\n			<td>1.900 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">RANGKA</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Tipe Rangka</td>\r\n			<td>Twin Tube Steel</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Tipe Suspensi Depan</td>\r\n			<td>Teleskopik</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Tipe Suspensi Belakang</td>\r\n			<td>Lengan Ayun dengan Suspensi Tunggal</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Ukuran Ban Depan</td>\r\n			<td>90/80 &ndash; 17 46P (Tubeless)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Ukuran Ban Belakang</td>\r\n			<td>120/70 &ndash; 17 58P (Tubeless)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Rem depan</td>\r\n			<td>Cakram Hidrolik</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Rem belakang</td>\r\n			<td>Cakram Hidrolik</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">MESIN</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Tipe mesin</td>\r\n			<td>4 Langkah, DOHC &ndash; 4 Katup</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Sistem Pendinginan Mesin</td>\r\n			<td>Liquid Cooled with Auto Fan</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Diameter x Langkah</td>\r\n			<td>57,3 x 57,8</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Kapasitas Mesin</td>\r\n			<td>149,16 cc</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Perbandingan kompresi</td>\r\n			<td>11,3 : 1</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Daya Maksimum</td>\r\n			<td>11,6 kW (15,9PS) / 9.000 rpm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Torsi Maksimum</td>\r\n			<td>13,5 Nm (1,38 kgf.m) / 6.500 rpm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Tipe Kopling</td>\r\n			<td>Wet Multiplate with Coil Springs</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Sistem Start</td>\r\n			<td>Electric &amp; Kick Starter</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Sistem Suplai Bahan Bakar</td>\r\n			<td>PGM-FI</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Sistem Pelumasan</td>\r\n			<td>Basah</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">KAPASITAS</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Kapasitas Tangki Bahan Bakar</td>\r\n			<td>4,5 liter</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Kapasitas Minyak Pelumas</td>\r\n			<td>1,1 liter (Penggantian Periodik)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Tipe Transmisi</td>\r\n			<td>Manual, 6-Kecepatan</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Pola Perpindahan Gigi</td>\r\n			<td>1-N-2-3-4-5-6</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">KELISTRIKAN</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Tipe Baterai</td>\r\n			<td>MF 12V &ndash; 5.0 Ah</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Tipe Pengapian</td>\r\n			<td>Full-Transistor</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Tipe Busi</td>\r\n			<td>NGK MR9C-9N atau ND U27EPR-N9</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n'),(8,1,2,'Spacy','<p><strong>Honda Spacy Helm-In</strong>, skuter matik elegan dan lega terbaru dari Honda. Terobosan terbaru dari PT. Astra Honda Motor (AHM) Indonesia, Honda Spacy Helm-In memiliki kapasitas tangki bagasi yang luas hingga 18 liter cukup untuk memuat full helm motor. Dengan kapasitasnya yang luas, PT. AHM Indonesia berharap agar konsep Spacy Helm-In ini dapat memulai trend baru di komunitas pengendara motor di Indonesia dalam membawa barang barang dalam berpergian dengan menggunakan motor.</p>\r\n\r\n<p>Selain dari kapasitas tangki bagasi yang besar,&nbsp;<strong>Honda Spacy Helm-In&nbsp;</strong>juga dilengkapi dengan kapasitas tangki bensin extra besar (5 liter) yang membuatnya mampu untuk melakukan perjalanan panjang dengan sekali isi bensin.Honda Spacy Helm-In juga disertai tempat duduk yang lebih lebar, nyaman, dan ergonomis untuk kenyamanan sang pengendara. Dengan lebar dan panjang tempat duduk yang lebih besar, Honda Spacy Helm In menjadi pilihan untuk membonceng penumpang.</p>\r\n\r\n<p>Honda Spacy Helm-In memiliki fitur baru Automatic Headlight On yang otomatis menyalakan lampu pada saat mesin hidup. Fitur lain yang ada pada Honda Spacy ini adalah&nbsp;tuas pengunci rem,&nbsp;side stand switch&nbsp;(standar samping otomatis), dan pengaman kunci otomatis bermagnet.</p>\r\n','<table>\r\n	<tbody>\r\n		<tr>\r\n			<td colspan=\"2\">DIMENSI</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Dimensi (P x L x T)</td>\r\n			<td>1.841 x 669 x 1.094 mm (tipe PGM-FI)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Jarak sumbu Roda</td>\r\n			<td>1.256 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Jarak terendah ke tanah</td>\r\n			<td>128 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Berat kosong</td>\r\n			<td>99 kg (tipe PGM-FI)</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">RANGKA</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Rangka</td>\r\n			<td>Tulang punggung</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Suspensi depan</td>\r\n			<td>Teleskopik</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Suspensi belakang</td>\r\n			<td>Lengan ayun dengan shockbreaker tunggal</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Ukuran Ban depan</td>\r\n			<td>80/90-14 M/C 40P</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Ukuran Ban Belakang</td>\r\n			<td>90/90-14 M/C 46P</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Rem depan</td>\r\n			<td>Cakram hidrolik dengan piston tunggal</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Rem belakang</td>\r\n			<td>Tromol</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">MESIN</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Tipe mesin</td>\r\n			<td>4 Langkah SOHC</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Sistem pendinginan</td>\r\n			<td>Pendinginan udara dengan kipas</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Diameter x langkah</td>\r\n			<td>50 x 55 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Volume langkah</td>\r\n			<td>108 cc</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Perbandingan kompresi</td>\r\n			<td>9,2 : 1</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Daya maksimum</td>\r\n			<td>8.67 PS / 8.000 rpm (tipe PGM-FI)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Torsi maksimum</td>\r\n			<td>0,91 kgf.m / 6.500 rpm (tipe PGM-FI)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Kopling</td>\r\n			<td>Otomatis, sentrifugal, tipe kering</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Starter</td>\r\n			<td>Pedal &amp; Elektrik</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Busi</td>\r\n			<td>NGK CPR8EA-9 DENSO U24EPR9 (tipe PGM-FI)</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">KAPASITAS</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Kapasitas tangki bahan bakar</td>\r\n			<td>5.5 liter (tipe PGM-FI)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Kapasitas Minyak Pelumas Mesin</td>\r\n			<td>0,7 liter pada penggantian periodik</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Transmisi</td>\r\n			<td>Otomatis, V-Matic</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">KELISTRIKAN</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Aki</td>\r\n			<td>12V &ndash; 3A.h (tipe MF)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Sistem pengapian</td>\r\n			<td>Full Transisterized, Baterai (tipe PGM-FI)</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Lampu depan</td>\r\n			<td>12V 32W x 1</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Lampu senja</td>\r\n			<td>12V 3,4W x 1</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n');

/*Table structure for table `tb_pelanggan` */

DROP TABLE IF EXISTS `tb_pelanggan`;

CREATE TABLE `tb_pelanggan` (
  `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT,
  `No_KTP` char(16) DEFAULT NULL,
  `nama_pelanggan` varchar(20) DEFAULT NULL,
  `alamat` varchar(200) DEFAULT NULL,
  `id_kecamatan` tinyint(4) DEFAULT NULL,
  `jenis_kelamin` enum('1','2') DEFAULT NULL COMMENT '1=laki, 2=perempuan',
  `telp` char(12) DEFAULT NULL,
  `email` varchar(20) DEFAULT NULL,
  `id_login` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_pelanggan`),
  KEY `id_kecamatan` (`id_kecamatan`),
  CONSTRAINT `tb_pelanggan_ibfk_1` FOREIGN KEY (`id_kecamatan`) REFERENCES `tb_kecamatan` (`id_kecamatan`) ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;

/*Data for the table `tb_pelanggan` */

insert  into `tb_pelanggan`(`id_pelanggan`,`No_KTP`,`nama_pelanggan`,`alamat`,`id_kecamatan`,`jenis_kelamin`,`telp`,`email`,`id_login`) values (3,'23123123','sdasd','adsdweqe',29,'1','13132424',NULL,1),(4,'123123','jon','sdsadasfef',48,'2','12312312',NULL,1),(7,'13123','ajdkasjd','asdasd',48,'2','12312312',NULL,1),(8,'13123','ajdkasjd','asdasd',48,'2','12312312',NULL,1),(9,'13123','ajdkasjd','asdasd',48,'2','12312312',NULL,1),(10,'14567','jonhanes','jalan',26,'1','12312312',NULL,1),(11,'123','bro','jalan',26,'1','123',NULL,1),(12,'12312','jon','ajdkasjd',26,'1','123123',NULL,1),(13,'2131','jon','kajdajskd',26,'1','2131231',NULL,1),(14,'1231421','jon','jalan pulau rote 24, goa gong asdasdklaskdlka',26,'1','231312',NULL,1),(15,'342424','johanes','jalan pulau merdeka 327, plaga',26,'1','123123123',NULL,1),(16,'1231','joads','ada',24,'2','123',NULL,1),(17,'123242424','brojon','jalan juanda 31, marikosa',48,'1','12324213','brojon@jon.com',20),(18,'09230910239','biadi','jalan jalan jon',26,'1','9231313213',NULL,20),(19,'123242424','brojon','jalan juanda 31, marikosa',26,'1','12324213',NULL,20),(20,'123242424','brojon','jalan juanda 31, marikosa',45,'1','12324213',NULL,20),(21,'123242424','brojon','jalan juanda 31, marikosa',47,'1','12324213',NULL,20),(22,'10122323293','Made Gilang Aditya','jalan jimbaran 37',24,'1','089783778900','madegilangaditya@gma',21),(23,'123454658089','sukra','jalan joh no 23',48,'1','098944999','asdjakjd@gmail.com',22),(24,'123242424','brojonadas','jalan juanda 31, marikosa',48,'1','12324213',NULL,20),(25,'10122323293','Made Gilang Aditya1','jalan jimbaran 37',24,'1','089783778900',NULL,21),(26,'10122323293','Made Gilang ','jalan jimbaran 37',24,'1','089783778900',NULL,21);

/*Table structure for table `tb_provinsi` */

DROP TABLE IF EXISTS `tb_provinsi`;

CREATE TABLE `tb_provinsi` (
  `id_provinsi` int(20) NOT NULL,
  `nama_provinsi` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_provinsi`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_provinsi` */

insert  into `tb_provinsi`(`id_provinsi`,`nama_provinsi`) values (0,'Aceh'),(1,'Sumatera Utara'),(2,'Sumtera Barat'),(3,'Riau'),(4,'Jambi'),(5,'Sumatera Selatan'),(6,'Bengkulu'),(7,'Lampung'),(8,'Bangka Belitung'),(9,'Kepulauan Riau'),(10,'DKI Jakarta'),(11,'Jawa Barat'),(12,'Jawa Tengah'),(13,'Yogyakarta'),(14,'Jawa Timur'),(15,'Banten'),(16,'Bali'),(17,'Nusa Tenggara Barat'),(18,'Nusa Tenggara Timur'),(19,'Kalimantan Barat'),(20,'Kalimantan Tengah'),(21,'Kalimantan Selatan'),(22,'Kalimantan Timur'),(23,'Sulawesi Utara'),(24,'Sulawesi Tengah'),(25,'Sulawesi Selatan'),(26,'Sulawesi tenggara'),(27,'Gorontalo'),(28,'Sulawesi Barat'),(29,'Maluku'),(30,'Maluku Utara'),(31,'Papua'),(32,'Papua Barat');

/*Table structure for table `tb_transaksi` */

DROP TABLE IF EXISTS `tb_transaksi`;

CREATE TABLE `tb_transaksi` (
  `id_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `id_pelanggan` int(11) NOT NULL,
  `tgl_transaksi` date NOT NULL,
  `jumlah_harga` int(11) NOT NULL,
  `status` enum('1','2') DEFAULT NULL COMMENT '1=sudah dibayar, 2=pending',
  `jenis_transaksi` enum('1','2') DEFAULT NULL COMMENT '1=cash, 2=kredit',
  PRIMARY KEY (`id_transaksi`),
  KEY `id_pelanggan` (`id_pelanggan`),
  CONSTRAINT `tb_transaksi_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `tb_pelanggan` (`id_pelanggan`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

/*Data for the table `tb_transaksi` */

insert  into `tb_transaksi`(`id_transaksi`,`id_pelanggan`,`tgl_transaksi`,`jumlah_harga`,`status`,`jenis_transaksi`) values (1,7,'2017-02-12',29000000,NULL,NULL),(2,8,'2017-02-12',29000000,NULL,NULL),(3,9,'2017-02-12',29000000,NULL,NULL),(4,10,'2017-02-12',29000000,NULL,NULL),(5,11,'2017-02-12',29000000,NULL,NULL),(6,12,'2017-02-16',29000000,NULL,NULL),(7,13,'2017-02-16',41000000,NULL,NULL),(8,14,'2017-02-16',41000000,NULL,NULL),(9,15,'2017-02-17',30000000,NULL,NULL),(10,16,'2017-02-19',2147483647,NULL,NULL),(11,18,'2017-02-21',2147483647,NULL,NULL),(12,19,'2017-02-23',42000000,NULL,NULL),(13,19,'2017-02-23',15000631,NULL,NULL),(14,20,'2017-02-27',0,'2',NULL),(15,21,'2017-02-27',14500061,'2',NULL),(16,21,'2017-02-27',15000062,'2',NULL),(17,21,'2017-02-27',15000063,'2',NULL),(18,21,'2017-03-01',13500039,'2',NULL),(19,21,'2017-03-02',13500041,'2',NULL),(20,21,'2017-03-08',81000029,'2',NULL),(21,21,'2017-03-08',13500029,'2',NULL),(22,21,'2017-03-08',14000031,'2',NULL),(23,21,'2017-03-21',13500042,'2','1'),(24,22,'2017-04-19',13500041,'2','1'),(28,22,'2017-04-19',13500042,'2','1'),(42,22,'2017-04-27',27000049,'2','1'),(43,22,'2017-04-27',14000050,'2','1'),(44,26,'2017-04-27',13500051,'2','1'),(45,22,'2017-04-27',22850052,'2','1'),(46,22,'2017-04-27',13500053,'2','1');

/*Table structure for table `tb_type` */

DROP TABLE IF EXISTS `tb_type`;

CREATE TABLE `tb_type` (
  `id_type` tinyint(4) NOT NULL AUTO_INCREMENT,
  `nama_type` varchar(20) NOT NULL,
  PRIMARY KEY (`id_type`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tb_type` */

insert  into `tb_type`(`id_type`,`nama_type`) values (1,'bebek'),(2,'Matic'),(4,'racing'),(5,'scooter');

/*Table structure for table `tb_warna` */

DROP TABLE IF EXISTS `tb_warna`;

CREATE TABLE `tb_warna` (
  `id_warna` tinyint(4) NOT NULL AUTO_INCREMENT,
  `id_det_motor` tinyint(4) DEFAULT NULL,
  `warna` varchar(20) DEFAULT NULL,
  `gambar` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_warna`),
  KEY `id_det_motor` (`id_det_motor`),
  CONSTRAINT `tb_warna_ibfk_1` FOREIGN KEY (`id_det_motor`) REFERENCES `tb_det_motor` (`id_det_motor`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

/*Data for the table `tb_warna` */

insert  into `tb_warna`(`id_warna`,`id_det_motor`,`warna`,`gambar`) values (1,7,'Neo Green','images/barang/detail/Honda-Revo-FIT-Neo-Green.jpg'),(2,7,'Raving Red','images/barang/detail/Honda-Revo-FIT-Raving-Red.jpg'),(3,7,'Galaxy Blue','images/barang/detail/Honda-Revo-FIT-Galaxy-Blue.jpg'),(4,8,'Quantum Black','images/barang/detail/Honda-Revo-STD-Quantum-Black.jpg'),(5,9,'Cosmic White','images/barang/detail/Honda-Revo-CW-Cosmic-White.jpg'),(6,9,'Quantum Black','images/barang/detail/Honda-Revo-CW-Quantum-Black.jpg'),(7,10,'Winning Red','images/barang/detail/New-Honda-Blade-125-FI-Winning-Red.jpg'),(8,10,'Sporty Yellow','images/barang/detail/New-Honda-Blade-125-FI-Sporty-Yellow.jpg'),(9,11,'Repsol Edition','images/barang/detail/New-Honda-Blade-124-FI-Repsol-Edition.jpg'),(10,12,'Graceful Red','images/barang/detail/Honda-Supra-X-125-FI-STD-Red.jpg'),(11,13,'Quantum Black','images/barang/detail/New-Honda-Supra-X-125-FI-Quantum-Black.jpg'),(12,13,'Fabulous White','images/barang/detail/New-Honda-Supra-X-125-FI-Fabulous-White.jpg'),(13,13,'Razor White','images/barang/detail/New-Honda-Supra-X-125-FI-Razor-White.jpg'),(14,13,'Energetic Black','images/barang/detail/New-Honda-Supra-X-125-FI-Energetic-Black.jpg'),(15,14,'Black Red','images/barang/detail/Honda-Supra-X-Helm-In-PGM-FI-Merah2.jpg'),(16,14,'Black Blue','images/barang/detail/Honda-Supra-X-Helm-In-PGM-FI-Biru2.jpg'),(17,14,'Black Violet','images/barang/detail/Honda-Supra-X-Helm-In-PGM-FI-Violet1.jpg'),(18,15,'Spartan Red','images/barang/detail/All-New-Honda-Supra-GTR-150-Sporty-Spartan-Red.jpg'),(19,15,'Cruiser White','images/barang/detail/All-New-Honda-Supra-GTR-150-Sporty-Cruiser-White.jpg'),(20,16,'Grande Blue','images/barang/detail/All-New-Honda-Supra-GTR-150-Exclusive-Grande-Blue.jpg'),(21,16,'Gun Black','images/barang/detail/All-New-Honda-Supra-GTR-150-Exclusive-Gun-Black.jpg'),(22,17,'Merah','images/barang/detail/Honda-Spacy-Merah1.jpg'),(23,17,'Hitam','images/barang/detail/Honda-Spacy-Hitam1.jpg'),(24,17,'Putih','images/barang/detail/Honda-Spacy-Putih1.jpg');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
