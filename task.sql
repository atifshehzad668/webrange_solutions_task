-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 02, 2026 at 10:09 PM
-- Server version: 8.0.31
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `task`
--

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

DROP TABLE IF EXISTS `cache`;
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

DROP TABLE IF EXISTS `cache_locks`;
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `owner` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`),
  KEY `cache_locks_expiration_index` (`expiration`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

DROP TABLE IF EXISTS `jobs`;
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `attempts` tinyint UNSIGNED NOT NULL,
  `reserved_at` int UNSIGNED DEFAULT NULL,
  `available_at` int UNSIGNED NOT NULL,
  `created_at` int UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

DROP TABLE IF EXISTS `job_batches`;
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `options` mediumtext COLLATE utf8mb4_unicode_ci,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2026_04_02_194017_create_products_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `description`, `created_at`, `updated_at`) VALUES
(4, 'Ergonomic Office Chair', '249.00', 'Adjustable lumbar support, breathable mesh back, and 360° swivel base.', '2026-04-02 14:44:27', '2026-04-02 14:44:27'),
(5, 'Portable SSD 1TB', '79.99', 'USB 3.2 Gen 2 portable solid-state drive with read speeds up to 1050 MB/s.', '2026-04-02 14:44:27', '2026-04-02 14:44:27'),
(6, '4K Webcam', '129.99', 'Ultra HD video conferencing camera with built-in mic and autofocus.', '2026-04-02 14:44:27', '2026-04-02 14:44:27'),
(7, 'Smart LED Desk Lamp', '39.99', 'Touch-dimmable lamp with adjustable colour temperature and USB charging port.', '2026-04-02 14:44:27', '2026-04-02 14:44:27'),
(8, 'Laptop Stand Aluminium', '29.99', 'Foldable, height-adjustable stand compatible with 10–17 inch laptops.', '2026-04-02 14:44:27', '2026-04-02 14:44:27'),
(9, 'Noise-Cancelling Earbuds', '59.99', 'True wireless earbuds with ANC, 28-hour total playtime, and IPX4 rating.', '2026-04-02 14:44:27', '2026-04-02 14:44:27'),
(10, 'Wireless Charging Pad', '19.99', '10W fast wireless charger compatible with Qi-enabled smartphones.', '2026-04-02 14:44:27', '2026-04-02 14:44:27'),
(11, 'Wireless Bluetooth Headphones', '49.99', 'Over-ear headphones with noise cancellation and 30-hour battery life.', '2026-04-02 14:44:57', '2026-04-02 14:44:57'),
(12, 'Mechanical Keyboard', '89.99', 'Compact TKL layout with Cherry MX Red switches and RGB backlight.', '2026-04-02 14:44:57', '2026-04-02 14:44:57'),
(13, 'USB-C Hub 7-in-1', '34.99', 'Expands a single USB-C port to HDMI, USB 3.0, SD card reader, and more.', '2026-04-02 14:44:57', '2026-04-02 14:44:57'),
(14, 'Ergonomic Office Chair', '249.00', 'Adjustable lumbar support, breathable mesh back, and 360° swivel base.', '2026-04-02 14:44:57', '2026-04-02 14:44:57'),
(15, 'Portable SSD 1TB', '79.99', 'USB 3.2 Gen 2 portable solid-state drive with read speeds up to 1050 MB/s.', '2026-04-02 14:44:57', '2026-04-02 14:44:57'),
(16, '4K Webcam', '129.99', 'Ultra HD video conferencing camera with built-in mic and autofocus.', '2026-04-02 14:44:57', '2026-04-02 14:44:57'),
(17, 'Smart LED Desk Lamp', '39.99', 'Touch-dimmable lamp with adjustable colour temperature and USB charging port.', '2026-04-02 14:44:57', '2026-04-02 14:44:57'),
(18, 'Laptop Stand Aluminium', '29.99', 'Foldable, height-adjustable stand compatible with 10–17 inch laptops.', '2026-04-02 14:44:57', '2026-04-02 14:44:57'),
(19, 'Noise-Cancelling Earbuds', '59.99', 'True wireless earbuds with ANC, 28-hour total playtime, and IPX4 rating.', '2026-04-02 14:44:57', '2026-04-02 14:44:57'),
(20, 'Wireless Charging Pad', '19.99', '10W fast wireless charger compatible with Qi-enabled smartphones.', '2026-04-02 14:44:57', '2026-04-02 14:44:57'),
(21, 'atque molestiae odit', '465.38', 'Doloremque eius rerum molestiae deserunt a voluptatem sed dolor libero ratione aspernatur laboriosam corporis.', '2026-04-02 14:45:00', '2026-04-02 14:45:00'),
(22, 'corporis animi eos', '360.93', 'Eum ea et velit molestiae blanditiis aut rerum dolores cum amet et dolore voluptatem non animi rerum.', '2026-04-02 14:45:00', '2026-04-02 14:45:00'),
(23, 'eligendi eaque qui', '260.45', 'In sapiente repellat omnis blanditiis perspiciatis quia rerum est tenetur consequuntur dolores exercitationem corporis hic magni rerum.', '2026-04-02 14:45:00', '2026-04-02 14:45:00'),
(24, 'aut expedita distinctio', '139.90', 'Placeat quis labore aut quidem laboriosam et dolorem ut ratione ut reiciendis deserunt.', '2026-04-02 14:45:00', '2026-04-02 14:45:00'),
(25, 'modi distinctio autem', '627.55', 'Est ducimus fuga voluptatem voluptas ex tenetur dolor delectus quam illo quo et dolores aliquam qui.', '2026-04-02 14:45:00', '2026-04-02 14:45:00'),
(26, 'quaerat distinctio explicabo', '189.44', 'Numquam fuga sit consequatur autem repellendus est iusto reiciendis asperiores minima voluptatibus earum qui facere maxime omnis.', '2026-04-02 14:45:00', '2026-04-02 14:45:00'),
(27, 'aut et harum', '731.13', 'Quis odio aliquam rerum minima numquam consectetur id consequatur eos animi facere ipsum qui sit qui.', '2026-04-02 14:45:00', '2026-04-02 14:45:00'),
(28, 'cupiditate quisquam voluptatem', '436.25', 'Nam non laborum amet dicta ipsum sunt sed est velit architecto magnam est et optio rerum.', '2026-04-02 14:45:00', '2026-04-02 14:45:00'),
(29, 'eos et odio', '116.16', 'Sint eligendi alias natus deserunt expedita rem optio rem dolores ut qui sunt molestiae.', '2026-04-02 14:45:00', '2026-04-02 14:45:00'),
(30, 'possimus qui accusantium', '324.71', 'Ipsum voluptatum quaerat similique ab consequuntur id accusamus minima aliquam qui ut.', '2026-04-02 14:45:00', '2026-04-02 14:45:00');

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('gaXAeOFdPnhqIo85Ju10XjJ1sizUZIegI56Q5vuM', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:149.0) Gecko/20100101 Firefox/149.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNkhsWnA5b0F2OXZnbzRmNTJ6RXhPR25xdkc0STlNUXlDUnczbTR0MSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1775161691),
('K8255ZYxKc3QUdUMBqtzs77nR7YoUZwFE5Mbljhx', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/146.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiM2RIT3Fvakl2dzdzdXJqZVpUMnYzR2dQa0hZRkRTUzRHTG9UaUVISSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6NDQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9odHRwLXJlcXVlc3Q/cmV0cmllcz0zIjtzOjU6InJvdXRlIjtOO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1775167515),
('MNOYUwiRyFuqH3NOnsqvQ7ipfknDYrML65JC3jRY', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:148.0) Gecko/20100101 Firefox/148.0', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiT0ViSHhvVFlJU2tCQWJxY1o0bkJneVp3Y2dkWnpHUzNIbHZvZEQ3aSI7czo5OiJfcHJldmlvdXMiO2E6Mjp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7czo1OiJyb3V0ZSI7Tjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319fQ==', 1775160402);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
