-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.21-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             11.3.0.6295
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for batik
-- CREATE DATABASE IF NOT EXISTS `batik` !40100 DEFAULT CHARACTER SET utf8mb4 ;
-- USE `batik`;

-- Dumping structure for table batik.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(256) NOT NULL,
  `nama_admin` varchar(256) NOT NULL,
  PRIMARY KEY (`id_admin`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Dumping data for table batik.admin: ~0 rows (approximately)
/*!40000 ALTER TABLE `admin` DISABLE KEYS */;
INSERT INTO `admin` (`id_admin`, `email`, `password`, `nama_admin`) VALUES
  (1, 'admin@admin.com', '$2y$12$CzTPDRz6XkQuTVV5Dy.fMevPLdIKPTD4.9XgP4ZdPP9P8eCDF3N3y', 'Admin Default'),
  (7, 'rhadi.indrawankkpi@gmail.com', '$2y$12$dxuVALMN8ozxIbXCP9mYBunna3QZEN3dpYsjz8.W6X/Nhe2ALdEuK', 'Rhadi Indrawan');
/*!40000 ALTER TABLE `admin` ENABLE KEYS */;

-- Dumping structure for table batik.check_out
CREATE TABLE IF NOT EXISTS `check_out` (
  `id_checkout` varchar(250) NOT NULL DEFAULT 'AUTO_INCREMENT',
  `id_pelanggan` int(11) DEFAULT NULL,
  `id_barang` varchar(250) DEFAULT NULL,
  `jum_dibeli` varchar(250) DEFAULT NULL,
  `total_harga` double DEFAULT NULL,
  `bayar_via` varchar(150) DEFAULT NULL,
  `foto_bukti_tf` text DEFAULT NULL,
  `status_pesanan` varchar(50) DEFAULT NULL,
  `tgl_pesan` datetime DEFAULT NULL,
  PRIMARY KEY (`id_checkout`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table batik.check_out: ~2 rows (approximately)
/*!40000 ALTER TABLE `check_out` DISABLE KEYS */;
INSERT INTO `check_out` (`id_checkout`, `id_pelanggan`, `id_barang`, `jum_dibeli`, `total_harga`, `bayar_via`, `foto_bukti_tf`, `status_pesanan`, `tgl_pesan`) VALUES
  ('CKO1426653165', 7, '7||8||9||', '1||1||1||', 850000, 'BRI', '1116576552WhatsApp_Image_2021-11-28_at_17.37.07-removebg-preview.png', 'Dikemas', '2022-06-19 17:36:54');
/*!40000 ALTER TABLE `check_out` ENABLE KEYS */;

-- Dumping structure for table batik.pelanggan
CREATE TABLE IF NOT EXISTS `pelanggan` (
  `id_pelanggan` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(256) NOT NULL,
  `nama_pelanggan` varchar(256) NOT NULL,
  `no_hp` varchar(256) NOT NULL,
  PRIMARY KEY (`id_pelanggan`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Dumping data for table batik.pelanggan: ~0 rows (approximately)
/*!40000 ALTER TABLE `pelanggan` DISABLE KEYS */;
INSERT INTO `pelanggan` (`id_pelanggan`, `email`, `password`, `nama_pelanggan`, `no_hp`) VALUES
  (5, 'rhadi.indrawankkpi@gmail.com', '$2y$12$obd08EPI9EvxAvRoxd0N8ezGkoofXzjFKvR.FGn6jWf.svqHwwzCa', 'rhadi indrawan', '085255554789'),
  (7, 'rina@rina.com', '$2y$12$KuNnuyNNYSmzUn0pGuycLuXqo3iH8HeYtz4Nie87bsRa/4y6DuNoy', 'Rina Andini', '085255554789');
/*!40000 ALTER TABLE `pelanggan` ENABLE KEYS */;

-- Dumping structure for table batik.pesanan
CREATE TABLE IF NOT EXISTS `pesanan` (
  `id_pesanan` varchar(250) NOT NULL,
  `id_pelanggan` int(11) DEFAULT NULL,
  `id_barang` int(11) DEFAULT NULL,
  `jum_dibeli` int(11) DEFAULT NULL,
  `total_harga` double DEFAULT NULL,
  `tgl_pesan` datetime DEFAULT NULL,
  PRIMARY KEY (`id_pesanan`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Dumping data for table batik.pesanan: ~0 rows (approximately)
/*!40000 ALTER TABLE `pesanan` DISABLE KEYS */;
/*!40000 ALTER TABLE `pesanan` ENABLE KEYS */;

-- Dumping structure for table batik.suplier
CREATE TABLE IF NOT EXISTS `suplier` (
  `id_suplier` int(11) NOT NULL AUTO_INCREMENT,
  `nama_suplier` varchar(150) DEFAULT NULL,
  `no_suplier` varchar(50) DEFAULT NULL,
  `alamat_suplier` varchar(150) DEFAULT NULL,
  PRIMARY KEY (`id_suplier`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table batik.suplier: ~0 rows (approximately)
/*!40000 ALTER TABLE `suplier` DISABLE KEYS */;
/*!40000 ALTER TABLE `suplier` ENABLE KEYS */;

-- Dumping structure for table batik.tb_barang
CREATE TABLE IF NOT EXISTS `tb_barang` (
  `id_barang` int(11) NOT NULL AUTO_INCREMENT,
  `nama_barang` varchar(250) DEFAULT NULL,
  `harga_barang` double DEFAULT NULL,
  `berat` int(11) DEFAULT NULL,
  `desk_barang` text DEFAULT NULL,
  `stok` int(11) DEFAULT NULL,
  `foto` text DEFAULT NULL,
  PRIMARY KEY (`id_barang`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table batik.tb_barang: ~3 rows (approximately)
/*!40000 ALTER TABLE `tb_barang` DISABLE KEYS */;
INSERT INTO `tb_barang` (`id_barang`, `nama_barang`, `harga_barang`, `berat`, `desk_barang`, `stok`, `foto`) VALUES
  (7, 'Baju Batik Tulip', 200000, 1, 'Kain dengan kualitas terbaik', 46, '960348271batik-tulip.jpg'),
  (8, 'Batik Couple', 500000, 1, 'Kain dengan kualitas terbaik', 26, '1127942242batik-couple.jpg'),
  (9, 'Batik Tunik', 150000, 1, 'Kain dengan kualitas terbaik', 18, '1750986003btik-tunik.jpg');
/*!40000 ALTER TABLE `tb_barang` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
