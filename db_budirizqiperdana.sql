-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               11.3.0-MariaDB-log - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for budirizqiperdana
CREATE DATABASE IF NOT EXISTS `budirizqiperdana` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci */;
USE `budirizqiperdana`;

-- Dumping structure for table budirizqiperdana.absensi
CREATE TABLE IF NOT EXISTS `absensi` (
  `id_absensi` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `judul_absensi` varchar(255) NOT NULL,
  `deskripsi_absensi` varchar(255) NOT NULL,
  `jam_masuk` time NOT NULL,
  `jam_pulang` time NOT NULL,
  `batas_jam_masuk` time NOT NULL,
  `batas_jam_pulang` time NOT NULL,
  `code_absensi` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_absensi`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table budirizqiperdana.absensi: ~2 rows (approximately)
INSERT INTO `absensi` (`id_absensi`, `judul_absensi`, `deskripsi_absensi`, `jam_masuk`, `jam_pulang`, `batas_jam_masuk`, `batas_jam_pulang`, `code_absensi`, `created_at`, `updated_at`) VALUES
	(2, 'Absensi Bulan Juli Minggu Pertama', 'absensi minggu pertama', '07:00:00', '07:50:00', '17:00:00', '17:00:00', NULL, '2024-07-22 19:51:11', '2024-07-22 19:51:11'),
	(3, 'Absensi Bulan Juli Minggu Kedua', 'minggu ke dua', '08:00:00', '08:00:00', '19:00:00', '21:00:00', NULL, '2024-07-23 01:12:03', '2024-07-23 01:15:25'),
	(4, 'Absensi Bulan Juli Minggu Ketiga', 'absensi minggu ketiga', '07:00:00', '17:00:00', '12:00:00', '18:00:00', NULL, '2024-07-24 02:27:41', '2024-07-24 02:27:41');

-- Dumping structure for table budirizqiperdana.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table budirizqiperdana.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table budirizqiperdana.gaji
CREATE TABLE IF NOT EXISTS `gaji` (
  `id_gaji` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `total_masuk` int(10) DEFAULT NULL,
  `total_gaji` int(50) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `tanggal_awal` date DEFAULT NULL,
  `tanggal_akhir` date DEFAULT NULL,
  PRIMARY KEY (`id_gaji`),
  KEY `FK_gaji_users` (`user_id`),
  CONSTRAINT `FK_gaji_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table budirizqiperdana.gaji: ~2 rows (approximately)
INSERT INTO `gaji` (`id_gaji`, `user_id`, `total_masuk`, `total_gaji`, `tanggal`, `created_at`, `updated_at`, `tanggal_awal`, `tanggal_akhir`) VALUES
	(3, 4, 1, 150000, '2024-07-23', '2024-07-23 10:10:56', '2024-07-23 10:10:56', '2024-07-01', '2024-07-31');

-- Dumping structure for table budirizqiperdana.jabatan
CREATE TABLE IF NOT EXISTS `jabatan` (
  `id_jabatan` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_jabatan` varchar(100) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_jabatan`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table budirizqiperdana.jabatan: ~5 rows (approximately)
INSERT INTO `jabatan` (`id_jabatan`, `nama_jabatan`, `created_at`, `updated_at`) VALUES
	(1, 'Pegawai Lapangan', NULL, NULL),
	(2, 'Pelaksana', NULL, NULL),
	(3, 'Direktur', NULL, NULL),
	(4, 'Admin', NULL, NULL);

-- Dumping structure for table budirizqiperdana.kehadiran
CREATE TABLE IF NOT EXISTS `kehadiran` (
  `id_kehadiran` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `id_user` bigint(20) unsigned NOT NULL,
  `id_absensi` bigint(20) unsigned NOT NULL,
  `jam_masuk` time DEFAULT NULL,
  `jam_pulang` time DEFAULT NULL,
  `id_pk` bigint(20) unsigned NOT NULL,
  `jumlah_pk` int(10) DEFAULT NULL,
  `pk_selesai` int(10) DEFAULT NULL,
  `pk_belum` int(10) DEFAULT NULL,
  `status` varchar(50) DEFAULT NULL,
  `tanggal` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_kehadiran`),
  KEY `FK__users` (`id_user`),
  KEY `FK__pk` (`id_pk`),
  KEY `FK_kehadiran_absensi` (`id_absensi`),
  CONSTRAINT `FK__pk` FOREIGN KEY (`id_pk`) REFERENCES `pk` (`id_pk`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK__users` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_kehadiran_absensi` FOREIGN KEY (`id_absensi`) REFERENCES `absensi` (`id_absensi`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table budirizqiperdana.kehadiran: ~4 rows (approximately)
INSERT INTO `kehadiran` (`id_kehadiran`, `id_user`, `id_absensi`, `jam_masuk`, `jam_pulang`, `id_pk`, `jumlah_pk`, `pk_selesai`, `pk_belum`, `status`, `tanggal`, `created_at`, `updated_at`) VALUES
	(3, 4, 2, '06:46:33', '06:52:57', 1, 10, 10, 0, 'hadir', '2024-07-23', '2024-07-22 23:46:58', '2024-07-22 23:53:27'),
	(4, 8, 2, '07:39:20', '07:39:36', 3, 15, 14, 1, 'hadir', '2024-07-23', '2024-07-23 00:39:34', '2024-07-23 00:40:03'),
	(5, 8, 3, '08:18:48', '08:31:21', 2, 10, 2, 8, 'hadir', '2024-07-23', '2024-07-23 01:19:03', '2024-07-23 01:31:44'),
	(6, 4, 4, '09:32:12', NULL, 3, 10, NULL, NULL, 'hadir', '2024-07-24', '2024-07-24 02:33:09', '2024-07-24 02:33:09');

-- Dumping structure for table budirizqiperdana.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table budirizqiperdana.migrations: ~8 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2024_07_19_060626_create_jabatan_table', 2),
	(6, '2024_07_19_060910_create_role_table', 2),
	(7, '2024_07_19_062230_create_absensi_table', 2),
	(8, '2024_07_19_063237_create_pk_table', 2);

-- Dumping structure for table budirizqiperdana.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table budirizqiperdana.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table budirizqiperdana.personal_access_tokens
CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table budirizqiperdana.personal_access_tokens: ~0 rows (approximately)

-- Dumping structure for table budirizqiperdana.pk
CREATE TABLE IF NOT EXISTS `pk` (
  `id_pk` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `nama_pk` varchar(255) NOT NULL,
  `harga_pk` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id_pk`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table budirizqiperdana.pk: ~3 rows (approximately)
INSERT INTO `pk` (`id_pk`, `nama_pk`, `harga_pk`, `created_at`, `updated_at`) VALUES
	(1, 'PK 1', 15000, NULL, NULL),
	(2, 'PK 2', 20000, NULL, NULL),
	(3, 'PK 3', 25000, NULL, NULL);

-- Dumping structure for table budirizqiperdana.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `role` varchar(50) NOT NULL,
  `id_jabatan` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `FK_users_jabatan` (`id_jabatan`),
  CONSTRAINT `FK_users_jabatan` FOREIGN KEY (`id_jabatan`) REFERENCES `jabatan` (`id_jabatan`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table budirizqiperdana.users: ~3 rows (approximately)
INSERT INTO `users` (`id`, `role`, `id_jabatan`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
	(3, 'admin', 4, 'Admin', 'admin@gmail.com', NULL, '$2y$12$8aP.pWAtwrzq7YmsprS2LeUGNb3fX9J4E/3lY.VYl1afR06CXIB.u', NULL, NULL, NULL),
	(4, 'user', 1, 'User', 'user@gmail.com', NULL, '$2y$12$lEib3MvG9brJUw3Zg2svV.HtpaEvmZ1zsl2cU14m0/yChPK5UrEIu', NULL, NULL, NULL),
	(7, 'admin', 4, 'Joko Utama', 'joko@gmail.com', NULL, '$2y$12$pixJV9oIdAEPB13gwH5LG.o4Un584rPWsssreH5CS4KHn3WVvJqeC', NULL, '2024-07-22 01:47:48', '2024-07-22 01:47:48'),
	(8, 'user', 1, 'Dwi Julianto', 'dwi@gmail.com', NULL, '$2y$12$.246z4n1h.vKuAmdGincB.1ue4TEnfEsSuCTngfL6cvRlnqBzq2na', NULL, '2024-07-23 00:38:49', '2024-07-23 00:38:49');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
