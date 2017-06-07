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
  `id_det_motor` tinyint(4) NOT NULL,
  `id_finance` int(11) NOT NULL,
  `id_dealer` int(11) NOT NULL,
  `jangka_waktu` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`id_angsuran`),
  KEY `id_finance` (`id_finance`),
  KEY `id_dealer` (`id_dealer`),
  KEY `id_det_motor` (`id_det_motor`),
  CONSTRAINT `tb_angsuran_ibfk_2` FOREIGN KEY (`id_finance`) REFERENCES `tb_finance` (`id_finance`) ON UPDATE CASCADE,
  CONSTRAINT `tb_angsuran_ibfk_3` FOREIGN KEY (`id_dealer`) REFERENCES `tb_dealer` (`id_dealer`) ON UPDATE CASCADE,
  CONSTRAINT `tb_angsuran_ibfk_4` FOREIGN KEY (`id_det_motor`) REFERENCES `tb_det_motor` (`id_det_motor`)
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `tb_cart` */

insert  into `tb_cart`(`id_cart`,`id_login`,`id_harga`,`id_warna`,`jumlah`,`tanggal`) values (1,20,9,1,1,'2017-03-09');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tb_dealer` */

insert  into `tb_dealer`(`id_dealer`,`id_kecamatan`,`nama_dealer`,`alamat`,`telp`,`id_login`) values (1,57,'kasih motor','jalan balai no 32','081989898878',NULL),(2,46,'dealer1','aksjdkasjdk','98987890931',8),(3,45,'dealer2','jalan jalan','12321312321',9);

/*Table structure for table `tb_det_angsuran` */

DROP TABLE IF EXISTS `tb_det_angsuran`;

CREATE TABLE `tb_det_angsuran` (
  `id_det_angsuran` int(11) NOT NULL AUTO_INCREMENT,
  `id_angsuran` int(11) NOT NULL,
  `uang_muka` int(11) NOT NULL,
  `angsuran` int(11) NOT NULL,
  PRIMARY KEY (`id_det_angsuran`),
  KEY `id_angsuran` (`id_angsuran`),
  CONSTRAINT `tb_det_angsuran_ibfk_1` FOREIGN KEY (`id_angsuran`) REFERENCES `tb_angsuran` (`id_angsuran`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `tb_det_angsuran` */

/*Table structure for table `tb_det_motor` */

DROP TABLE IF EXISTS `tb_det_motor`;

CREATE TABLE `tb_det_motor` (
  `id_det_motor` tinyint(4) NOT NULL AUTO_INCREMENT,
  `id_motor` tinyint(4) NOT NULL,
  `nama_det_motor` varchar(20) NOT NULL,
  PRIMARY KEY (`id_det_motor`),
  KEY `id_motor` (`id_motor`),
  CONSTRAINT `tb_det_motor_ibfk_1` FOREIGN KEY (`id_motor`) REFERENCES `tb_motor` (`id_motor`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `tb_det_motor` */

insert  into `tb_det_motor`(`id_det_motor`,`id_motor`,`nama_det_motor`) values (1,2,'Supra X 125 PGM FI'),(2,2,'Supra X 125 FI STD'),(4,3,'Jupiter Z F1'),(5,1,'adsa'),(6,1,'adsa'),(7,4,'Revo FI FIT');

/*Table structure for table `tb_det_transaksi` */

DROP TABLE IF EXISTS `tb_det_transaksi`;

CREATE TABLE `tb_det_transaksi` (
  `id_det_transaksi` int(11) NOT NULL AUTO_INCREMENT,
  `id_transaksi` int(11) NOT NULL,
  `id_harga` tinyint(4) NOT NULL,
  `id_warna` tinyint(4) DEFAULT NULL,
  `jenis_transaksi` enum('1','2') DEFAULT NULL COMMENT '1=cash, 2=kredit',
  `jumlah` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id_det_transaksi`),
  KEY `id_transaksi` (`id_transaksi`),
  KEY `id_harga` (`id_harga`),
  CONSTRAINT `tb_det_transaksi_ibfk_1` FOREIGN KEY (`id_transaksi`) REFERENCES `tb_transaksi` (`id_transaksi`) ON UPDATE CASCADE,
  CONSTRAINT `tb_det_transaksi_ibfk_2` FOREIGN KEY (`id_harga`) REFERENCES `tb_harga` (`id_harga`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

/*Data for the table `tb_det_transaksi` */

insert  into `tb_det_transaksi`(`id_det_transaksi`,`id_transaksi`,`id_harga`,`id_warna`,`jenis_transaksi`,`jumlah`) values (2,6,7,NULL,'1',2),(3,7,7,NULL,'1',2),(4,7,6,NULL,'1',1),(5,8,7,NULL,'1',2),(6,8,6,NULL,'1',1),(7,9,2,NULL,'1',1),(8,9,2,NULL,'1',1),(9,10,1,NULL,'1',1),(10,11,1,NULL,'1',1),(11,12,2,NULL,'1',2),(12,12,6,NULL,'1',1),(13,13,2,NULL,'1',1),(14,14,2,NULL,'1',1),(15,15,7,NULL,'1',1),(16,16,2,NULL,'1',1),(17,17,2,NULL,'1',1),(18,18,9,NULL,'1',1),(19,19,9,NULL,'1',1),(20,20,9,3,'1',2),(21,20,9,1,'1',2),(22,20,9,2,'1',1),(23,20,11,1,'1',1),(24,21,9,1,'1',1),(25,22,11,2,'1',1);

/*Table structure for table `tb_finance` */

DROP TABLE IF EXISTS `tb_finance`;

CREATE TABLE `tb_finance` (
  `id_finance` int(11) NOT NULL AUTO_INCREMENT,
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `tb_harga` */

insert  into `tb_harga`(`id_harga`,`id_det_motor`,`id_dealer`,`harga_cash`,`stok`) values (1,1,2,15000000,18),(2,2,2,15000000,12),(6,4,3,12000000,9),(7,2,3,14500000,17),(8,1,3,14800000,20),(9,7,2,13500000,2),(11,7,3,14000000,9);

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
  `id_det_angsuran` int(11) NOT NULL,
  PRIMARY KEY (`id_kredit`),
  KEY `id_det_transaksi` (`id_det_transaksi`),
  KEY `id_det_angsuran` (`id_det_angsuran`),
  CONSTRAINT `tb_kredit_ibfk_1` FOREIGN KEY (`id_det_transaksi`) REFERENCES `tb_det_transaksi` (`id_det_transaksi`) ON UPDATE CASCADE,
  CONSTRAINT `tb_kredit_ibfk_2` FOREIGN KEY (`id_det_angsuran`) REFERENCES `tb_det_angsuran` (`id_det_angsuran`) ON UPDATE CASCADE
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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=latin1;

/*Data for the table `tb_login` */

insert  into `tb_login`(`id_login`,`username`,`password`,`otoritas`) values (1,'admin','admin','2'),(6,'kasmor','kasmor','3'),(7,'jon','jon','4'),(8,'dealer1','dealer1','3'),(9,'dealer2','dealer2','3'),(10,'joni','joni','1'),(11,'joan','joan','1'),(12,'joana','joana','1'),(13,'bro','bro','1'),(17,'mad','mad','1'),(18,'bro1','bro1','1'),(19,'bro2','bro2','1'),(20,'brojon','brojon','1');

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

insert  into `tb_merk`(`id_merk`,`nama_merk`,`gambar`) values (1,'honda','images/barang/merk/3277238_20130203121230.jpg'),(2,'Yamaha','images/barang/merk/cloud1.png');

/*Table structure for table `tb_motor` */

DROP TABLE IF EXISTS `tb_motor`;

CREATE TABLE `tb_motor` (
  `id_motor` tinyint(4) NOT NULL AUTO_INCREMENT,
  `id_merk` tinyint(4) DEFAULT NULL,
  `id_type` tinyint(4) DEFAULT NULL,
  `nama_motor` varchar(20) NOT NULL,
  `deskripsi` text NOT NULL,
  `spesifikasi` text NOT NULL,
  `gambar` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id_motor`),
  KEY `id_merk` (`id_merk`),
  KEY `id_type` (`id_type`),
  CONSTRAINT `tb_motor_ibfk_1` FOREIGN KEY (`id_merk`) REFERENCES `tb_merk` (`id_merk`),
  CONSTRAINT `tb_motor_ibfk_2` FOREIGN KEY (`id_type`) REFERENCES `tb_type` (`id_type`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `tb_motor` */

insert  into `tb_motor`(`id_motor`,`id_merk`,`id_type`,`nama_motor`,`deskripsi`,`spesifikasi`,`gambar`) values (1,1,1,'supra fit','<p>sdakd</p>\r\n','<p>dasd</p>\r\n','images/barang/motor/cloud2.png'),(2,1,1,'Supra X 125','sdasdsa','<table border=\"1\">\r\n	<tbody>\r\n		<tr>\r\n			<td colspan=\"2\">DIMENSI</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Dimensi (P x L x T)</td>\r\n			<td>1.918 x 709 x 1.101 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Jarak sumbu Roda</td>\r\n			<td>1.235 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Jarak terendah ke tanah</td>\r\n			<td>136.5 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Berat kosong</td>\r\n			<td>103 kg (STD)<br />\r\n			106 kg (CW)</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">RANGKA</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Rangka</td>\r\n			<td>Tulang punggung</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Suspensi depan</td>\r\n			<td>Teleskopik</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Suspensi belakang</td>\r\n			<td>Lengan ayun dengan shockbreaker ganda</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Ukuran Ban depan</td>\r\n			<td>70/90 &ndash; 17 M/C 38P</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Ukuran Ban Belakang</td>\r\n			<td>80/90 &ndash; 17 M/C 44P</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Rem depan</td>\r\n			<td>Cakram hidrolik dengan piston tunggal</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Rem belakang</td>\r\n			<td>Tromol (STD)<br />\r\n			Cakram hidrolik dengan piston tunggal (CW)</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">MESIN</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Tipe mesin</td>\r\n			<td>4 Langkah SOHC, Silinder tunggal</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Sistem pendinginan</td>\r\n			<td>Pendinginan udara</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Diameter x langkah</td>\r\n			<td>52.4 x 57.9 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Volume langkah</td>\r\n			<td>124,89 cc</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Perbandingan kompresi</td>\r\n			<td>9,3 : 1</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Daya maksimum</td>\r\n			<td>7.40 kW (10.1 PS) / 8.000 rpm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Torsi maksimum</td>\r\n			<td>9.30 Nm (0.95 kgf.m) / 4.000 rpm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Tipe kopling</td>\r\n			<td>Multiple wet clutch with coil spring</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Starter</td>\r\n			<td>Starter kaki dan elektrik</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Busi</td>\r\n			<td>NGK CPR6EA-9 / ND U20EPR9</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Sistem bahan bakar</td>\r\n			<td>Karburator</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">KAPASITAS</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Kapasitas tangki bahan bakar</td>\r\n			<td>4,0 liter</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Kapasitas Minyak Pelumas Mesin</td>\r\n			<td>0,7 liter pada penggantian periodik</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Transmisi</td>\r\n			<td>4 kecepatan, rotary</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Pola pengoperan gigi</td>\r\n			<td>N-1-2-3-4-N</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">KELISTRIKAN</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Tipe battery</td>\r\n			<td>MF 12V &ndash; 3.0 Ah</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Sistem pengapian</td>\r\n			<td>Full Transisterized</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n','images/barang/motor/Honda-Supra-X-1251.jpg'),(3,2,1,'Jupiter','hjkj','dad',NULL),(4,1,1,'Revo','<p><strong>Motor Honda Revo</strong>&nbsp;adalah motor bebek paling populer di Indonesia. Dengan tagline &ldquo;Kerennya Jagoan Kita&rdquo;,</p>\r\n\r\n<p>Fitur unggulan Honda Revo series adalah:</p>\r\n\r\n<ol>\r\n	<li>Mesin injeksi tangguh &amp; irit teknologi PGM-FI, membuat New Honda Revo FI lebih bertenaga, mudah dirawat.</li>\r\n	<li>Bagasi serba guna berkapasitas 7 liter.</li>\r\n	<li>Front disk brake yang membantu pengereman.</li>\r\n	<li>Secure key shutter&nbsp;&ndash; pengaman kunci kontak bermagnet (magnetic key shutter) yang efektif mengurangi resiko pencurian motor.</li>\r\n</ol>\r\n\r\n<p>Motor Honda Revo FI ini memiliki konsumsi BBM 62.2 km/liter yang diuji melalui metode pengujian ECE R40.</p>\r\n','<table border=\"1\">\r\n	<tbody>\r\n		<tr>\r\n			<td colspan=\"2\">DIMENSI</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Dimensi (P x L x T)</td>\r\n			<td>1.919 x 709 x 1.080 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Jarak sumbu Roda</td>\r\n			<td>1.227 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Jarak terendah ke tanah</td>\r\n			<td>135 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Berat kosong</td>\r\n			<td>97.5 kg</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">RANGKA</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Rangka</td>\r\n			<td>Tulang punggung</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Suspensi depan</td>\r\n			<td>Teleskopik</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Suspensi belakang</td>\r\n			<td>Lengan ayun dengan suspensi ganda</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Ukuran Ban depan</td>\r\n			<td>70/90 &ndash; 17 M/C 38P</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Ukuran Ban Belakang</td>\r\n			<td>80/90 &ndash; 17 M/C 44P</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Rem depan</td>\r\n			<td>Cakram hidrolik dengan piston tunggal</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Rem belakang</td>\r\n			<td>Tromol</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">MESIN</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Tipe mesin</td>\r\n			<td>4 Langkah SOHC, silinder tunggal</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Sistem pendinginan</td>\r\n			<td>Pendinginan udara</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Diameter x langkah</td>\r\n			<td>50 x 55,6 mm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Volume langkah</td>\r\n			<td>109,17 cc</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Perbandingan kompresi</td>\r\n			<td>9,3 : 1</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Daya maksimum</td>\r\n			<td>6,56 kW (8,91 PS) / 7.500 rpm</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Torsi maksimum</td>\r\n			<td>&ndash;</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Kopling</td>\r\n			<td>Multiple wet clutch with Diaphragm Spring</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Starter</td>\r\n			<td>Starter kaki dan elektrik</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Busi</td>\r\n			<td>NGK CPR6EA-9S atau NDU20EPR9S</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">KAPASITAS</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Kapasitas tangki bahan bakar</td>\r\n			<td>4,0 liter</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Kapasitas Minyak Pelumas Mesin</td>\r\n			<td>0,8 liter pada penggantian periodik</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Transmisi</td>\r\n			<td>4 kecepatan/bertautan tetap</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Pola Pengoperan Gigi</td>\r\n			<td>N &ndash; 1 &ndash; 2 &ndash; 3 &ndash; 4 &ndash; N</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"2\">KELISTRIKAN</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Aki</td>\r\n			<td>MF battery, 12 V &ndash; 3 A.h</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Sistem pengapian</td>\r\n			<td>Full Transisterized</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n','images/barang/motor/');

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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

/*Data for the table `tb_pelanggan` */

insert  into `tb_pelanggan`(`id_pelanggan`,`No_KTP`,`nama_pelanggan`,`alamat`,`id_kecamatan`,`jenis_kelamin`,`telp`,`email`,`id_login`) values (3,'23123123','sdasd','adsdweqe',29,'1','13132424',NULL,1),(4,'123123','jon','sdsadasfef',48,'2','12312312',NULL,1),(7,'13123','ajdkasjd','asdasd',48,'2','12312312',NULL,1),(8,'13123','ajdkasjd','asdasd',48,'2','12312312',NULL,1),(9,'13123','ajdkasjd','asdasd',48,'2','12312312',NULL,1),(10,'14567','jonhanes','jalan',26,'1','12312312',NULL,1),(11,'123','bro','jalan',26,'1','123',NULL,1),(12,'12312','jon','ajdkasjd',26,'1','123123',NULL,1),(13,'2131','jon','kajdajskd',26,'1','2131231',NULL,1),(14,'1231421','jon','jalan pulau rote 24, goa gong asdasdklaskdlka',26,'1','231312',NULL,1),(15,'342424','johanes','jalan pulau merdeka 327, plaga',26,'1','123123123',NULL,1),(16,'1231','joads','ada',24,'2','123',NULL,1),(17,'123242424','brojon','jalan juanda 31, marikosa',48,'1','12324213','brojon@jon.com',20),(18,'09230910239','biadi','jalan jalan jon',26,'1','9231313213',NULL,20),(19,'123242424','brojon','jalan juanda 31, marikosa',26,'1','12324213',NULL,20),(20,'123242424','brojon','jalan juanda 31, marikosa',45,'1','12324213',NULL,20),(21,'123242424','brojon','jalan juanda 31, marikosa',47,'1','12324213',NULL,20);

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
  PRIMARY KEY (`id_transaksi`),
  KEY `id_pelanggan` (`id_pelanggan`),
  CONSTRAINT `tb_transaksi_ibfk_1` FOREIGN KEY (`id_pelanggan`) REFERENCES `tb_pelanggan` (`id_pelanggan`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=latin1;

/*Data for the table `tb_transaksi` */

insert  into `tb_transaksi`(`id_transaksi`,`id_pelanggan`,`tgl_transaksi`,`jumlah_harga`,`status`) values (1,7,'2017-02-12',29000000,NULL),(2,8,'2017-02-12',29000000,NULL),(3,9,'2017-02-12',29000000,NULL),(4,10,'2017-02-12',29000000,NULL),(5,11,'2017-02-12',29000000,NULL),(6,12,'2017-02-16',29000000,NULL),(7,13,'2017-02-16',41000000,NULL),(8,14,'2017-02-16',41000000,NULL),(9,15,'2017-02-17',30000000,NULL),(10,16,'2017-02-19',2147483647,NULL),(11,18,'2017-02-21',2147483647,NULL),(12,19,'2017-02-23',42000000,NULL),(13,19,'2017-02-23',15000631,NULL),(14,20,'2017-02-27',0,'2'),(15,21,'2017-02-27',14500061,'2'),(16,21,'2017-02-27',15000062,'2'),(17,21,'2017-02-27',15000063,'2'),(18,21,'2017-03-01',13500039,'2'),(19,21,'2017-03-02',13500041,'2'),(20,21,'2017-03-08',81000029,'2'),(21,21,'2017-03-08',13500029,'2'),(22,21,'2017-03-08',14000031,'2');

/*Table structure for table `tb_type` */

DROP TABLE IF EXISTS `tb_type`;

CREATE TABLE `tb_type` (
  `id_type` tinyint(4) NOT NULL AUTO_INCREMENT,
  `nama_type` varchar(20) NOT NULL,
  PRIMARY KEY (`id_type`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

/*Data for the table `tb_type` */

insert  into `tb_type`(`id_type`,`nama_type`) values (1,'bebek'),(2,'Matic'),(3,'moge'),(4,'racing'),(5,'scooter');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `tb_warna` */

insert  into `tb_warna`(`id_warna`,`id_det_motor`,`warna`,`gambar`) values (1,7,'Neo Green','images/barang/detail/Honda-Revo-FIT-Neo-Green-200x200.jpg'),(2,7,'Raving Red','images/barang/detail/Honda-Revo-FIT-Raving-Red-200x200.jpg'),(3,7,'Galaxy Blue','images/barang/detail/Honda-Revo-FIT-Galaxy-Blue-200x200.jpg');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
