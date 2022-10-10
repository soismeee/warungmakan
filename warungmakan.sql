-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 07, 2022 at 07:10 AM
-- Server version: 5.7.33
-- PHP Version: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `warungmakan`
--

-- --------------------------------------------------------

--
-- Table structure for table `detail_transaksi_penjualans`
--

CREATE TABLE `detail_transaksi_penjualans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `no_trans` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_pesanan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `menu` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama_makanan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_minuman` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `nama_jusbuah` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `jumlah` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_harga` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jus_buahs`
--

CREATE TABLE `jus_buahs` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `jus_buahs`
--

INSERT INTO `jus_buahs` (`id`, `nama`, `harga`, `keterangan`, `created_at`, `updated_at`) VALUES
('JB001', 'Alpukat', '10000', '-', '2022-10-04 20:57:12', '2022-10-04 20:57:12'),
('JB002', 'Melon', '7000', '-', '2022-10-04 20:57:22', '2022-10-04 20:57:22'),
('JB003', 'Mangga', '7000', '-', '2022-10-04 20:57:33', '2022-10-04 20:57:33'),
('JB004', 'Apel', '7000', '-', '2022-10-04 20:57:43', '2022-10-04 20:57:43');

-- --------------------------------------------------------

--
-- Table structure for table `kodes`
--

CREATE TABLE `kodes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kode` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kodes`
--

INSERT INTO `kodes` (`id`, `name`, `kode`, `created_at`, `updated_at`) VALUES
(1, 'MA001', 'MA', '2022-10-06 01:26:23', '2022-10-06 01:26:23'),
(2, 'MA002', 'MA', '2022-10-06 01:26:23', '2022-10-06 01:26:23'),
(3, 'MA003', 'MA', '2022-10-06 01:27:11', '2022-10-06 01:27:11'),
(4, 'MA004', 'MA', '2022-10-06 01:27:11', '2022-10-06 01:27:11'),
(5, 'MA005', 'MA', '2022-10-06 01:27:11', '2022-10-06 01:27:11'),
(6, 'MA006', 'MA', '2022-10-06 01:27:11', '2022-10-06 01:27:11'),
(7, 'MA007', 'MA', '2022-10-06 01:27:11', '2022-10-06 01:27:11'),
(8, 'MA008', 'MA', '2022-10-06 01:27:11', '2022-10-06 01:27:11'),
(9, 'MA009', 'MA', '2022-10-06 01:27:11', '2022-10-06 01:27:11'),
(10, 'MI001', 'MI', '2022-10-06 01:37:47', '2022-10-06 01:37:47'),
(11, 'MI002', 'MI', '2022-10-06 01:37:47', '2022-10-06 01:37:47'),
(12, 'MI003', 'MI', '2022-10-06 01:37:47', '2022-10-06 01:37:47'),
(13, 'MI004', 'MI', '2022-10-06 01:37:47', '2022-10-06 01:37:47'),
(14, 'MI005', 'MI', '2022-10-06 01:37:47', '2022-10-06 01:37:47'),
(15, 'JB001', 'JB', '2022-10-06 01:39:22', '2022-10-06 01:39:22'),
(16, 'JB002', 'JB', '2022-10-06 01:39:22', '2022-10-06 01:39:22'),
(17, 'JB003', 'JB', '2022-10-06 01:39:22', '2022-10-06 01:39:22'),
(18, 'JB004', 'JB', '2022-10-06 01:39:22', '2022-10-06 01:39:22'),
(19, 'MA010', 'MA', '2022-10-06 02:52:21', '2022-10-06 02:52:21'),
(20, 'MI006', 'MI', '2022-10-06 08:09:40', '2022-10-06 08:09:40');

-- --------------------------------------------------------

--
-- Table structure for table `makanans`
--

CREATE TABLE `makanans` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `makanans`
--

INSERT INTO `makanans` (`id`, `nama`, `harga`, `keterangan`, `created_at`, `updated_at`) VALUES
('MA001', 'Nasi Goreng', '12000', '-', '2022-10-04 20:53:12', '2022-10-04 20:53:12'),
('MA002', 'Kwe tiaw Goreng', '12000', '-', '2022-10-04 20:53:27', '2022-10-04 20:53:27'),
('MA003', 'Cap Cay Goreng', '12000', '-', '2022-10-04 20:53:42', '2022-10-04 20:53:42'),
('MA004', 'Mie Goreng', '10000', '-', '2022-10-04 20:53:57', '2022-10-04 20:53:57'),
('MA005', 'Telur Bakar/Goreng', '5000', '-', '2022-10-04 20:54:25', '2022-10-04 20:54:25'),
('MA006', 'Tahu/Tempe Bakar/Goreng', '4000', '-', '2022-10-04 20:54:53', '2022-10-04 20:54:53'),
('MA007', 'Roti Bakar', '7000', '-', '2022-10-04 20:55:05', '2022-10-04 20:55:05'),
('MA008', 'Pisang Bakar', '7000', '-', '2022-10-04 20:55:17', '2022-10-04 20:55:17'),
('MA010', 'Nasi Putih', '4000', '-', '2022-10-06 02:52:21', '2022-10-06 08:09:08');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_09_17_161322_create_makanans_table', 1),
(6, '2022_09_17_161602_create_minumen_table', 1),
(7, '2022_09_17_161653_create_jus_buahs_table', 1),
(8, '2022_09_17_161844_create_transaksi_penjualans_table', 1),
(9, '2022_09_17_162422_create_detail_transaksi_penjualans_table', 1),
(10, '2022_10_05_135025_create_rekap_penjualans_table', 2),
(11, '2022_10_06_012134_create_kodes_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `minumen`
--

CREATE TABLE `minumen` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nama` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `harga` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `keterangan` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `minumen`
--

INSERT INTO `minumen` (`id`, `nama`, `harga`, `keterangan`, `created_at`, `updated_at`) VALUES
('MI001', 'Es Teh', '3000', '-', '2022-10-04 20:55:43', '2022-10-04 20:55:43'),
('MI002', 'Teh Hangat', '2000', '-', '2022-10-04 20:55:56', '2022-10-04 20:55:56'),
('MI003', 'Es Jeruk', '4000', '-', '2022-10-04 20:56:07', '2022-10-04 20:56:07'),
('MI004', 'Jeruk Hangat', '3000', '-', '2022-10-04 20:56:18', '2022-10-04 20:56:18'),
('MI005', 'Goodday', '5000', '-', '2022-10-04 20:56:45', '2022-10-04 20:56:45'),
('MI006', 'Nutrisari', '5000', '-', '2022-10-06 08:09:40', '2022-10-06 08:09:40');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rekap_penjualans`
--

CREATE TABLE `rekap_penjualans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pendapatan` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `belanja` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `laba` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tanggal` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaksi_penjualans`
--

CREATE TABLE `transaksi_penjualans` (
  `no_trans` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `tanggal` date NOT NULL,
  `total_bayar` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uang_kembali` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Owner Djamal', 'owner', NULL, '$2y$10$OLccb7JxtYrNH00iRIsu5uVsFq6eyxgo4IzH6HzgJKwHXKQeddHsW', '1', NULL, '2022-10-01 21:23:59', '2022-10-07 00:09:21'),
(3, 'test', 'test', NULL, '$2y$10$j8xDC8exQnfcF8YTrntC.uu0LVgyiokrGQx5jxnWU6w2bTYIt1UWa', '2', NULL, '2022-10-03 05:10:22', '2022-10-03 05:10:22'),
(4, 'Indra', 'Indra', NULL, '$2y$10$xr3OU09vG5KPNnr5prln2uMnbLJVq6xCrNRC9rDydXNWIBiNS/jMW', '2', NULL, '2022-10-06 08:08:40', '2022-10-06 08:08:40');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `detail_transaksi_penjualans`
--
ALTER TABLE `detail_transaksi_penjualans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `jus_buahs`
--
ALTER TABLE `jus_buahs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kodes`
--
ALTER TABLE `kodes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `makanans`
--
ALTER TABLE `makanans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `minumen`
--
ALTER TABLE `minumen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `rekap_penjualans`
--
ALTER TABLE `rekap_penjualans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transaksi_penjualans`
--
ALTER TABLE `transaksi_penjualans`
  ADD PRIMARY KEY (`no_trans`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `detail_transaksi_penjualans`
--
ALTER TABLE `detail_transaksi_penjualans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kodes`
--
ALTER TABLE `kodes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rekap_penjualans`
--
ALTER TABLE `rekap_penjualans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
