-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2026 at 11:34 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pandcraft`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity_logs`
--

CREATE TABLE `activity_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `role` varchar(255) DEFAULT NULL,
  `action` varchar(255) NOT NULL,
  `table_name` varchar(255) DEFAULT NULL,
  `record_id` bigint(20) UNSIGNED DEFAULT NULL,
  `changes` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`changes`)),
  `ip_address` varchar(255) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `activity_logs`
--

INSERT INTO `activity_logs` (`id`, `user_id`, `role`, `action`, `table_name`, `record_id`, `changes`, `ip_address`, `user_agent`, `created_at`, `updated_at`) VALUES
(1, NULL, 'pemilik', 'CREATE', 'tb_produk', 19, '{\"old\":[],\"new\":{\"nama_produk\":\"Keranjang Anyam Pandan\",\"harga\":\"65000\",\"status_produk\":\"Tersedia\",\"stok\":\"3\",\"gambar\":\"1780564404_bosque.jpeg\",\"id_produk\":19}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-04 02:13:24', '2026-06-04 02:13:24'),
(2, NULL, 'pemilik', 'UPDATE', 'tb_produk', 19, '{\"old\":[],\"new\":{\"nama_produk\":\"Keranjang Anyam Pandan\",\"harga\":\"65000\",\"status_produk\":\"Tersedia\",\"stok\":\"3\",\"gambar\":\"1780564404_bosque.jpeg\",\"id_produk\":19}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-04 02:14:08', '2026-06-04 02:14:08'),
(3, NULL, 'pemilik', 'DELETE', 'tb_produk', 19, '{\"old\":{\"id_produk\":19,\"nama_produk\":\"Tikar Anyam Pandan\",\"harga\":\"75000\",\"stok\":3,\"status_produk\":\"Tersedia\",\"gambar\":\"1780564404_bosque.jpeg\"},\"new\":[]}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-04 02:16:22', '2026-06-04 02:16:22'),
(4, NULL, 'pemilik', 'DELETE', 'tb_produk', 7, '{\"old\":{\"id_produk\":7,\"nama_produk\":\"Tikar Anyam Pandan\",\"harga\":\"45000\",\"stok\":1,\"status_produk\":\"Tersedia\",\"gambar\":\"Tikar.jpg\"},\"new\":[]}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-04 02:19:01', '2026-06-04 02:19:01'),
(5, NULL, 'pemilik', 'CREATE', 'tb_produk', 20, '{\"old\":[],\"new\":{\"nama_produk\":\"Tas Anyam Pandan\",\"harga\":\"55000\",\"status_produk\":\"Tersedia\",\"stok\":\"10\",\"gambar\":\"1780564787_Desain Pemdes-08.jpg\",\"id_produk\":20}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-04 02:19:47', '2026-06-04 02:19:47'),
(6, NULL, 'pemilik', 'UPDATE', 'tb_produk', 6, '{\"stok\":{\"old\":1,\"new\":\"2\"}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-04 04:59:21', '2026-06-04 04:59:21'),
(7, NULL, 'pemilik', 'UPDATE', 'tb_produk', 6, '{\"stok\":{\"old\":2,\"new\":\"3\"}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-08 08:31:45', '2026-06-08 08:31:45'),
(8, NULL, 'pemilik', 'UPDATE', 'tb_produk', 4, '{\"stok\":{\"old\":2,\"new\":\"3\"}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-08 09:16:58', '2026-06-08 09:16:58'),
(9, NULL, 'pembeli', 'PROCESS_FAILED', 'tb_pesanan', NULL, '{\"reason\":\"SQLSTATE[42S22]: Column not found: 1054 Unknown column \'created_at\' in \'field list\' (Connection: mysql, Host: 127.0.0.1, Port: 3306, Database: pandcraft, SQL: insert into `tb_pembeli` (`nama_pembeli`, `no_hp`, `alamat`, `created_at`, `updated_at`) values (Diksa, 08765786543, Surabaya, 2026-06-08 16:55:33, 2026-06-08 16:55:33))\",\"user_id\":null}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-08 09:55:33', '2026-06-08 09:55:33'),
(10, NULL, 'pembeli', 'PROCESS_FAILED', 'tb_pesanan', NULL, '{\"reason\":\"SQLSTATE[42S22]: Column not found: 1054 Unknown column \'created_at\' in \'field list\' (Connection: mysql, Host: 127.0.0.1, Port: 3306, Database: pandcraft, SQL: insert into `tb_pembeli` (`nama_pembeli`, `no_hp`, `alamat`, `created_at`, `updated_at`) values (PUTRI, 085304743039, GRESIK, 2026-06-08 17:11:37, 2026-06-08 17:11:37))\",\"user_id\":null}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-08 10:11:37', '2026-06-08 10:11:37'),
(11, NULL, 'pembeli', 'PROCESS_FAILED', 'tb_pesanan', NULL, '{\"reason\":\"SQLSTATE[42S22]: Column not found: 1054 Unknown column \'created_at\' in \'field list\' (Connection: mysql, Host: 127.0.0.1, Port: 3306, Database: pandcraft, SQL: insert into `tb_pembeli` (`nama_pembeli`, `no_hp`, `alamat`, `created_at`, `updated_at`) values (DINI, 08765786543, GRESIK, 2026-06-08 17:12:35, 2026-06-08 17:12:35))\",\"user_id\":null}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-08 10:12:35', '2026-06-08 10:12:35'),
(12, NULL, 'pemilik', 'CREATE', 'tb_produk', 24, '{\"old\":[],\"new\":{\"nama_produk\":\"Keranjang Anyam Pandan\",\"harga\":\"25000\",\"status_produk\":\"Tersedia\",\"stok\":\"2\",\"gambar\":\"1780940999_WhatsApp Image 2026-06-08 at 22.52.04.jpeg\",\"id_produk\":24}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-08 10:49:59', '2026-06-08 10:49:59'),
(13, NULL, 'pemilik', 'UPDATE', 'tb_produk', 24, '{\"stok\":{\"old\":2,\"new\":\"3\"},\"gambar\":{\"old\":\"1780940999_WhatsApp Image 2026-06-08 at 22.52.04.jpeg\",\"new\":\"1780941149_user flow foodsafe - Penjual.png\"}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-08 10:52:29', '2026-06-08 10:52:29'),
(14, NULL, 'admin', 'UPDATE', 'tb_produk', 24, '{\"stok\":{\"old\":3,\"new\":\"2\"},\"gambar\":{\"old\":\"1780941149_user flow foodsafe - Penjual.png\",\"new\":\"1780941398_photo.jpg\"}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-08 10:56:38', '2026-06-08 10:56:38'),
(15, NULL, 'admin', 'UPDATE', 'tb_produk', 24, '{\"stok\":{\"old\":2,\"new\":\"2\"},\"gambar\":{\"old\":\"1780941398_photo.jpg\",\"new\":\"1780941418_WhatsApp Image 2026-06-08 at 22.52.04.jpeg\"}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-08 10:56:58', '2026-06-08 10:56:58'),
(16, NULL, 'admin', 'UPDATE', 'tb_produk', 24, '{\"stok\":{\"old\":2,\"new\":\"3\"}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-08 11:00:39', '2026-06-08 11:00:39'),
(17, NULL, 'pemilik', 'UPDATE', 'tb_produk', 24, '{\"stok\":{\"old\":3,\"new\":\"4\"}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-08 11:02:06', '2026-06-08 11:02:06'),
(18, NULL, 'pembeli', 'PROCESS', 'tb_pesanan', 41, '{\"process\":\"ORDER_CREATED\",\"details\":{\"id_pembeli\":39,\"id_produk\":\"6\",\"jumlah\":\"1\",\"total_harga\":110000,\"metode_bayar\":\"COD\",\"stok_awal\":3,\"stok_akhir\":2}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-08 11:06:25', '2026-06-08 11:06:25'),
(19, NULL, 'pemilik', 'CREATE', 'tb_produk', 25, '{\"old\":[],\"new\":{\"nama_produk\":\"Tikar Anyam Pandan\",\"harga\":\"70000\",\"status_produk\":\"Tersedia\",\"stok\":\"2\",\"gambar\":\"1780942381_ilustrasi-restoran-1_169.jpeg\",\"id_produk\":25}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-08 11:13:01', '2026-06-08 11:13:01'),
(20, NULL, 'pemilik', 'DELETE', 'tb_produk', 25, '{\"old\":{\"id_produk\":25,\"nama_produk\":\"Tikar Anyam Pandan\",\"harga\":\"70000\",\"stok\":2,\"status_produk\":\"Tersedia\",\"gambar\":\"1780942381_ilustrasi-restoran-1_169.jpeg\"},\"new\":[]}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-08 11:14:17', '2026-06-08 11:14:17'),
(21, NULL, 'pemilik', 'CREATE', 'tb_produk', 26, '{\"old\":[],\"new\":{\"nama_produk\":\"Tas Anyam Pandan\",\"harga\":\"33000\",\"status_produk\":\"Tersedia\",\"stok\":\"2\",\"gambar\":\"1780972637_49.jpg\",\"id_produk\":26}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-08 19:37:17', '2026-06-08 19:37:17'),
(22, NULL, 'pembeli', 'PROCESS', 'tb_pesanan', 42, '{\"process\":\"ORDER_CREATED\",\"details\":{\"id_pembeli\":40,\"id_produk\":\"4\",\"jumlah\":\"1\",\"total_harga\":60000,\"metode_bayar\":\"Transfer\",\"stok_awal\":3,\"stok_akhir\":2}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-08 19:38:58', '2026-06-08 19:38:58'),
(23, NULL, 'admin', 'UPDATE', 'tb_produk', 26, '{\"stok\":{\"old\":2,\"new\":\"5\"},\"gambar\":{\"old\":\"1780972637_49.jpg\",\"new\":\"1780972797_photo.jpg\"}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-08 19:39:57', '2026-06-08 19:39:57'),
(24, NULL, 'pemilik', 'DELETE', 'tb_produk', 26, '{\"old\":{\"id_produk\":26,\"nama_produk\":\"Tas Anyam Pandan\",\"harga\":\"33000\",\"stok\":5,\"status_produk\":\"Tersedia\",\"gambar\":\"1780972797_photo.jpg\"},\"new\":[]}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-08 19:46:00', '2026-06-08 19:46:00'),
(25, NULL, 'pemilik', 'DELETE', 'tb_produk', 24, '{\"old\":{\"id_produk\":24,\"nama_produk\":\"Keranjang Anyam Pandan\",\"harga\":\"25000\",\"stok\":4,\"status_produk\":\"Tersedia\",\"gambar\":\"1780941418_WhatsApp Image 2026-06-08 at 22.52.04.jpeg\"},\"new\":[]}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-08 21:13:41', '2026-06-08 21:13:41'),
(26, NULL, 'pembeli', 'PROCESS', 'tb_pesanan', 43, '{\"process\":\"ORDER_CREATED\",\"details\":{\"id_pembeli\":41,\"id_produk\":\"20\",\"jumlah\":\"1\",\"total_harga\":65000,\"metode_bayar\":\"Transfer\",\"stok_awal\":3,\"stok_akhir\":2}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-08 21:23:14', '2026-06-08 21:23:14'),
(27, NULL, 'pembeli', 'PROCESS', 'tb_pesanan', 44, '{\"process\":\"ORDER_CREATED\",\"details\":{\"id_pembeli\":42,\"id_produk\":\"4\",\"jumlah\":\"1\",\"total_harga\":60000,\"metode_bayar\":\"Transfer\",\"stok_awal\":2,\"stok_akhir\":1}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-08 22:08:31', '2026-06-08 22:08:31'),
(28, NULL, 'admin', 'CREATE', 'tb_produk', 27, '{\"old\":[],\"new\":{\"nama_produk\":\"Keranjang Anyam Pandan\",\"harga\":\"55000\",\"status_produk\":\"Tersedia\",\"stok\":\"2\",\"gambar\":\"1780982017_WhatsApp Image 2026-06-08 at 22.52.04.jpeg\",\"id_produk\":27}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-08 22:13:37', '2026-06-08 22:13:37'),
(29, NULL, 'pembeli', 'PROCESS', 'tb_pesanan', 45, '{\"process\":\"ORDER_CREATED\",\"details\":{\"id_pembeli\":43,\"id_produk\":\"27\",\"jumlah\":\"1\",\"total_harga\":65000,\"metode_bayar\":\"Transfer\",\"stok_awal\":2,\"stok_akhir\":1}}', '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', '2026-06-08 22:22:26', '2026-06-08 22:22:26');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_05_28_141756_create_sessions_table', 2),
(5, '2026_06_04_000000_create_activity_logs_table', 2),
(6, '2026_06_04_000001_add_stok_constraint_to_produk', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('GbCO6Au6PcWFutPX0yhbDDG66HUqQgZwIQgK1rNh', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/148.0.0.0 Safari/537.36', 'YTozOntzOjY6Il9mbGFzaCI7YToyOntzOjM6Im5ldyI7YTowOnt9czozOiJvbGQiO2E6MDp7fX1zOjk6Il9wcmV2aW91cyI7YToyOntzOjM6InVybCI7czoyMToiaHR0cDovLzEyNy4wLjAuMTo4MDAwIjtzOjU6InJvdXRlIjtOO31zOjY6Il90b2tlbiI7czo0MDoiY2JvYVVWS0pOY0NaclZLcjhYeGl1Y2prYWpydWNFajVrbFpQa29lTSI7fQ==', 1780983666);

-- --------------------------------------------------------

--
-- Table structure for table `tb_detail_pesanan`
--

CREATE TABLE `tb_detail_pesanan` (
  `id_detail` int(50) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `id_produk` int(11) NOT NULL,
  `jumlah` int(50) NOT NULL,
  `harga_satuan` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_detail_pesanan`
--

INSERT INTO `tb_detail_pesanan` (`id_detail`, `id_pesanan`, `id_produk`, `jumlah`, `harga_satuan`) VALUES
(21, 26, 6, 1, 100000),
(27, 32, 6, 1, 100000),
(29, 34, 5, 1, 10000000),
(30, 35, 4, 1, 50000),
(32, 37, 5, 1, 10000000),
(33, 38, 20, 1, 55000),
(34, 39, 20, 1, 55000),
(36, 41, 6, 1, 100000),
(37, 42, 4, 1, 50000),
(38, 43, 20, 1, 55000),
(39, 44, 4, 1, 50000),
(40, 45, 27, 1, 55000);

-- --------------------------------------------------------

--
-- Table structure for table `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kategori` int(50) NOT NULL,
  `nama_kategori` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembayaran`
--

CREATE TABLE `tb_pembayaran` (
  `id_pembayaran` int(50) NOT NULL,
  `id_pesanan` int(11) NOT NULL,
  `metode_bayar` varchar(50) NOT NULL,
  `tgl_bayar` date NOT NULL,
  `status_pembayaran` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pembayaran`
--

INSERT INTO `tb_pembayaran` (`id_pembayaran`, `id_pesanan`, `metode_bayar`, `tgl_bayar`, `status_pembayaran`) VALUES
(12, 26, 'COD', '0000-00-00', 'Pembayaran Berhasil'),
(16, 32, 'COD', '2026-06-01', 'Pembayaran Berhasil'),
(17, 33, 'Transfer', '2026-06-02', 'Pembayaran Berhasil'),
(18, 34, 'Transfer', '2026-06-03', 'Pembayaran Berhasil'),
(19, 35, 'Transfer', '2026-06-03', 'Pembayaran Berhasil'),
(20, 36, 'Transfer', '2026-06-04', 'Pembayaran Berhasil'),
(21, 37, 'COD', '2026-06-04', 'Pembayaran Berhasil'),
(22, 38, 'COD', '2026-06-04', 'Pembayaran Berhasil'),
(23, 39, 'Transfer', '2026-06-08', 'Pembayaran Berhasil'),
(25, 41, 'COD', '2026-06-08', 'Pembayaran Berhasil'),
(26, 42, 'Transfer', '2026-06-09', 'Menunggu Pembayaran'),
(27, 43, 'Transfer', '2026-06-09', 'Menunggu Pembayaran'),
(28, 44, 'Transfer', '2026-06-09', 'Pembayaran Berhasil'),
(29, 45, 'Transfer', '2026-06-09', 'Menunggu Pembayaran');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pembeli`
--

CREATE TABLE `tb_pembeli` (
  `id_pembeli` int(50) NOT NULL,
  `nama_pembeli` varchar(50) NOT NULL,
  `no_hp` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pembeli`
--

INSERT INTO `tb_pembeli` (`id_pembeli`, `nama_pembeli`, `no_hp`, `alamat`) VALUES
(24, 'Pudel', '0846213465', 'Surabaya'),
(30, 'Pacar Junghwan', '08765786543', 'Gresik'),
(31, 'Adeeva', '08985677939', 'Gresik'),
(32, 'Lala', '0876578637244', 'Nganjuk'),
(33, 'Siti Ainur', '08767354268', 'Pati'),
(34, 'Vera', '083122456326', 'Gresik'),
(35, 'Kiki', '089737898', 'Ngawi'),
(36, 'Fadilun', '0897567283', 'Jombang'),
(37, 'Nisa', '089745578', 'Nganjuk'),
(38, 'lolo', '039635728', 'pekalongan'),
(39, 'BELA', '08765786543', 'BENGKULU'),
(40, 'Bicis', '0846213465', 'Solo'),
(41, 'Ranti', '0846213465', 'Gresik'),
(42, 'Vera', '0846213465', 'Gresik'),
(43, 'Fadillll', '0854637876', 'Jombang');

-- --------------------------------------------------------

--
-- Table structure for table `tb_pesanan`
--

CREATE TABLE `tb_pesanan` (
  `id_pesanan` int(50) NOT NULL,
  `id_pembeli` int(11) NOT NULL,
  `tgl_pesanan` date NOT NULL,
  `total_harga` decimal(12,0) NOT NULL,
  `jumlah_pesanan` int(50) NOT NULL,
  `status_pesanan` varchar(50) NOT NULL,
  `status` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_pesanan`
--

INSERT INTO `tb_pesanan` (`id_pesanan`, `id_pembeli`, `tgl_pesanan`, `total_harga`, `jumlah_pesanan`, `status_pesanan`, `status`) VALUES
(26, 24, '2026-04-29', 100000, 1, 'Selesai', NULL),
(32, 30, '2026-06-01', 110000, 1, 'Selesai', NULL),
(33, 31, '2026-06-02', 55000, 1, 'Selesai', NULL),
(34, 32, '2026-06-03', 10010000, 1, 'Selesai', NULL),
(35, 33, '2026-06-03', 60000, 1, 'Selesai', NULL),
(36, 34, '2026-06-04', 55000, 1, 'Dikirim', NULL),
(37, 35, '2026-06-04', 10010000, 1, 'Selesai', NULL),
(38, 36, '2026-06-04', 65000, 1, 'Selesai', NULL),
(39, 37, '2026-06-08', 65000, 1, 'Selesai', NULL),
(41, 39, '2026-06-08', 110000, 1, 'Selesai', NULL),
(42, 40, '2026-06-09', 60000, 1, 'Menunggu', NULL),
(43, 41, '2026-06-09', 65000, 1, 'Menunggu', NULL),
(44, 42, '2026-06-09', 60000, 1, 'Dikirim', NULL),
(45, 43, '2026-06-09', 65000, 1, 'Menunggu', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tb_produk`
--

CREATE TABLE `tb_produk` (
  `id_produk` int(50) NOT NULL,
  `nama_produk` varchar(50) NOT NULL,
  `harga` decimal(12,0) NOT NULL,
  `stok` int(45) NOT NULL,
  `status_produk` varchar(50) NOT NULL,
  `gambar` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_produk`
--

INSERT INTO `tb_produk` (`id_produk`, `nama_produk`, `harga`, `stok`, `status_produk`, `gambar`) VALUES
(4, 'Tas Anyam Pandan', 50000, 1, 'Tersedia', 'TasAnyamPandan.jpeg'),
(5, 'Keranjang Anyam Pandan', 10000000, 3, 'Tersedia', '1780591150_photo.jpg'),
(6, 'Dompet Anyam Pandan', 100000, 2, 'Tersedia', 'e7a488480418bfaa064472d1c9d0fc37.jpg'),
(20, 'Tikar Anyam Pandan', 55000, 2, 'Tersedia', '1780591034_Tikar.jpg'),
(27, 'Keranjang Anyam Pandan', 55000, 1, 'Tersedia', '1780982017_WhatsApp Image 2026-06-08 at 22.52.04.jpeg');

-- --------------------------------------------------------

--
-- Table structure for table `tb_user`
--

CREATE TABLE `tb_user` (
  `id_user` varchar(50) NOT NULL,
  `nama` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `role` varchar(50) NOT NULL,
  `no_hp` int(50) NOT NULL,
  `remember_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tb_user`
--

INSERT INTO `tb_user` (`id_user`, `nama`, `email`, `password`, `role`, `no_hp`, `remember_token`) VALUES
('USR001', 'Vera', 'vera@gmail.com', 'Vera123', 'pemilik', 2147483647, NULL),
('USR002', 'Diksa', 'diksa@gmail.com', 'Diksa123', 'admin', 2147483647, NULL),
('USR003', 'Fadil', 'fadil@gmail.com', 'Fadil123', 'pembeli', 2147483647, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `activity_logs`
--
ALTER TABLE `activity_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `activity_logs_user_id_index` (`user_id`),
  ADD KEY `activity_logs_table_name_index` (`table_name`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_expiration_index` (`expiration`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`),
  ADD KEY `cache_locks_expiration_index` (`expiration`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `tb_detail_pesanan`
--
ALTER TABLE `tb_detail_pesanan`
  ADD PRIMARY KEY (`id_detail`),
  ADD KEY `id_produk` (`id_produk`),
  ADD KEY `id_pesanan` (`id_pesanan`);

--
-- Indexes for table `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD PRIMARY KEY (`id_pembayaran`),
  ADD KEY `id_pesanan` (`id_pesanan`);

--
-- Indexes for table `tb_pembeli`
--
ALTER TABLE `tb_pembeli`
  ADD PRIMARY KEY (`id_pembeli`);

--
-- Indexes for table `tb_pesanan`
--
ALTER TABLE `tb_pesanan`
  ADD PRIMARY KEY (`id_pesanan`),
  ADD KEY `id_pembeli` (`id_pembeli`);

--
-- Indexes for table `tb_produk`
--
ALTER TABLE `tb_produk`
  ADD PRIMARY KEY (`id_produk`),
  ADD UNIQUE KEY `id_produk` (`id_produk`);

--
-- Indexes for table `tb_user`
--
ALTER TABLE `tb_user`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `activity_logs`
--
ALTER TABLE `activity_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tb_detail_pesanan`
--
ALTER TABLE `tb_detail_pesanan`
  MODIFY `id_detail` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  MODIFY `id_pembayaran` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `tb_pembeli`
--
ALTER TABLE `tb_pembeli`
  MODIFY `id_pembeli` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `tb_pesanan`
--
ALTER TABLE `tb_pesanan`
  MODIFY `id_pesanan` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `tb_produk`
--
ALTER TABLE `tb_produk`
  MODIFY `id_produk` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tb_detail_pesanan`
--
ALTER TABLE `tb_detail_pesanan`
  ADD CONSTRAINT `tb_detail_pesanan_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `tb_produk` (`id_produk`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `tb_detail_pesanan_ibfk_2` FOREIGN KEY (`id_pesanan`) REFERENCES `tb_pesanan` (`id_pesanan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_pembayaran`
--
ALTER TABLE `tb_pembayaran`
  ADD CONSTRAINT `tb_pembayaran_ibfk_1` FOREIGN KEY (`id_pesanan`) REFERENCES `tb_pesanan` (`id_pesanan`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tb_pesanan`
--
ALTER TABLE `tb_pesanan`
  ADD CONSTRAINT `tb_pesanan_ibfk_1` FOREIGN KEY (`id_pembeli`) REFERENCES `tb_pembeli` (`id_pembeli`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
