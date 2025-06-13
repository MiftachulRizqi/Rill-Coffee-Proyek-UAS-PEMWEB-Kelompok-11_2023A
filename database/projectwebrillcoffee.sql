-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2025 at 09:04 AM
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
-- Database: `projectwebrillcoffee`
--

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

CREATE TABLE `menus` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nama_kopi` varchar(255) NOT NULL,
  `harga` decimal(8,2) NOT NULL,
  `deskripsi` text NOT NULL,
  `foto` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `nama_kopi`, `harga`, `deskripsi`, `foto`, `created_at`, `updated_at`) VALUES
(5, 'Cappucino', 9999.00, 'dibuat dengan espresso, susu panas, dan busa susu. Minuman ini memiliki perbandingan yang sama antara espresso, susu, dan busa, menciptakan rasa yang lembut, halus, dan seimbang.', 'photos/1749460801_cappucino.jpg', '2025-06-09 02:20:01', '2025-06-09 02:20:01'),
(6, 'Mocha', 9999.00, 'Perpaduan antara susu perah asli dengan perasa mocha, menjadikan minuman ini sangat diminati', 'photos/1749460909_mocha.jpg', '2025-06-09 02:21:49', '2025-06-09 06:10:23'),
(7, 'Brown Sugar', 9999.00, 'Perpaduan susu berkualitas dengan karamel dan topping boba, sehingga minuman ini menjadi sangat manis.', 'photos/1749461045_brownsugar.jpg', '2025-06-09 02:24:05', '2025-06-09 02:24:05'),
(8, 'Americano', 5999.00, 'Kopi hitam yang dibuat dengan cara menuangkan air panas ke dalam espresso', 'photos/1749461101_americano.jpg', '2025-06-09 02:25:01', '2025-06-09 02:25:01'),
(9, 'Red Velvet', 9999.00, 'Perpaduan antara susu dengan sentuhan rasa asam dan sedikit rasa cokelat.', 'photos/1749461179_red velvet.jpg', '2025-06-09 02:26:19', '2025-06-09 02:26:19'),
(10, 'Matcha', 9999.00, 'Perpaduan antara bubuk matcha yang kaya rasa hijau dan mutiara boba yang kenyal.', 'photos/1749461226_matcha.jpg', '2025-06-09 02:27:06', '2025-06-09 02:27:06');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(25, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(26, '2019_08_19_000000_create_failed_jobs_table', 1),
(27, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(28, '2025_04_20_150715_create_users_table', 1),
(29, '2025_04_20_150852_create_menus_table', 1),
(30, '2025_04_20_150906_create_orders_table', 1),
(31, '2025_06_02_064143_add_api_key_to_users_table', 1),
(32, '2025_06_07_130319_create_reviews_table', 1),
(33, '2025_06_09_050816_add_customer_fields_to_orders_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `menu_id` bigint(20) UNSIGNED NOT NULL,
  `jumlah` int(11) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `waktu_pesan` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` text NOT NULL,
  `nomor_wa` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `menu_id`, `jumlah`, `status`, `waktu_pesan`, `created_at`, `updated_at`, `nama`, `alamat`, `nomor_wa`) VALUES
(3, 2, 8, 4, 'confirmed', '2025-06-09 02:29:30', '2025-06-09 02:29:30', '2025-06-09 02:32:55', 'dandy', 'Simo Pomahan 22', '0258656'),
(4, 2, 9, 9, 'confirmed', '2025-06-09 02:30:16', '2025-06-09 02:30:16', '2025-06-09 02:32:57', 'ahahahaha', 'Simo Pomahan 22', '02158455645'),
(6, 6, 6, 12, 'cancelled', '2025-06-10 18:40:49', '2025-06-10 18:40:49', '2025-06-10 18:41:05', 'Aji Kurnia', 'Candi Borobudur', '098765431234'),
(7, 6, 10, 3, 'pending', '2025-06-10 18:47:30', '2025-06-10 18:47:30', '2025-06-10 18:47:30', 'novan', 'suko', '0895621063841'),
(8, 6, 5, 5, 'confirmed', '2025-06-10 18:48:12', '2025-06-10 18:48:12', '2025-06-10 18:49:04', 'yunus', 'simo gunung', '0895842149041'),
(9, 5, 6, 5, 'confirmed', '2025-06-10 19:09:32', '2025-06-10 19:09:32', '2025-06-10 19:12:59', 'ilham', 'sukodono gang 1', '024542124544'),
(11, 7, 6, 4, 'confirmed', '2025-06-11 23:21:22', '2025-06-11 23:21:22', '2025-06-11 23:25:01', 'ilham', 'sukodono gang 1', '0215652255');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `rating` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`id`, `name`, `message`, `rating`, `created_at`, `updated_at`) VALUES
(4, 'Dandy Satriawan', 'Mas nya sangat ganteng, Saya jadi suka pesan disini.', 5, '2025-06-09 02:31:23', '2025-06-09 02:31:23'),
(5, 'Aji Kurnia Akbar', 'Pelayanannya bagus, Karyawannya juga ramah, Kalo soal rasa tidak diragukan', 5, '2025-06-09 02:32:37', '2025-06-09 02:32:37'),
(6, 'aji', 'peak kopi', 5, '2025-06-10 18:32:56', '2025-06-10 18:32:56'),
(7, 'ilham', 'minumannya sangat enak', 5, '2025-06-10 19:10:05', '2025-06-10 19:10:05'),
(8, 'ilham', 'sangat bagus pelayanannya', 5, '2025-06-11 23:21:54', '2025-06-11 23:21:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'customer',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `api_key` varchar(80) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`, `api_key`) VALUES
(1, 'ilhammusidik', 'ilhamadmin1@gmail.com', '$2y$10$8n2a.PhrdWl7z7tbOhnHD.fhPl1yFbeGA4WRvUcVtvv37s1PptGaG', 'admin', '2025-06-08 02:42:31', '2025-06-08 02:42:31', NULL),
(2, 'dandysatriawan', 'dandysatriawan@gmail.com', '$2y$10$jUavPfhUESTBagSGZXZNqOgZ1/xHrFKUKK.c0FT.H702MeN7MpOce', 'customer', '2025-06-08 21:54:27', '2025-06-08 21:54:27', NULL),
(3, 'novan', 'novan@gmail.com', '$2y$10$uvnDlNpk9g8hF1b6w.k3K.fjh4h6IFuMDTDU9LkkOu0X1JJ3Dyj9y', 'customer', '2025-06-09 07:01:26', '2025-06-09 07:01:26', NULL),
(4, 'rizqi', 'rizqi@gmail.com', '$2y$10$3buX7ugnUe25geCGHo.dEulNvk0zJUbOY.UhQbOoeOZsVmp/FL5Ka', 'customer', '2025-06-09 07:23:18', '2025-06-09 07:23:18', NULL),
(5, 'ilham', 'ilham1@gmail.com', '$2y$10$K9/L7pR/h3oR53.Ngd/Om.B3qA8S0KzSqe06E1z1MkFw.zR2jyxSG', 'customer', '2025-06-10 18:28:48', '2025-06-10 18:28:48', NULL),
(6, 'Miftachul Rizqi', 'mrz@gmail.com', '$2y$10$AUFGqVWhvZAqy3aAx4fnMOjazLLmwNEK5UC6yjS6fywlOm8MedU56', 'customer', '2025-06-10 18:38:50', '2025-06-10 18:38:50', NULL),
(7, 'ilham', 'ilham11@gmail.com', '$2y$10$zhhjtMAzX.xVxR2T5YJVT.d1djs0LIvPkbT1kewz3syAVh1izAYm2', 'customer', '2025-06-11 23:09:16', '2025-06-11 23:09:16', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `menus`
--
ALTER TABLE `menus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_menu_id_foreign` (`menu_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_api_key_unique` (`api_key`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menus`
--
ALTER TABLE `menus`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
