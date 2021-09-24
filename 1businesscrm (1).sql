-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Aug 22, 2021 at 06:31 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.4.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `1businesscrm`
--

-- --------------------------------------------------------

--
-- Table structure for table `business_informations`
--

DROP TABLE IF EXISTS `business_informations`;
CREATE TABLE IF NOT EXISTS `business_informations` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `organization_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_logo` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_description` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_address` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `official_email_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `official_contact_number` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `business_informations_user_id_unique` (`user_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `business_informations`
--

INSERT INTO `business_informations` (`id`, `user_id`, `organization_name`, `business_name`, `business_logo`, `business_description`, `business_address`, `official_email_id`, `official_contact_number`, `created_at`, `updated_at`) VALUES
(2, 2, NULL, 'Creative Dev', NULL, NULL, NULL, NULL, NULL, '2021-03-27 10:21:27', '2021-03-27 10:21:27'),
(3, 3, NULL, 'hjkkjkjhj', NULL, NULL, NULL, NULL, NULL, '2021-03-29 06:45:39', '2021-03-29 06:45:39'),
(4, 4, NULL, 'asdasa', NULL, NULL, NULL, NULL, NULL, '2021-03-30 03:55:27', '2021-03-30 03:55:27'),
(5, 5, NULL, 'dssfd', NULL, NULL, NULL, NULL, NULL, '2021-03-30 07:27:38', '2021-03-30 07:27:38'),
(6, 6, NULL, 'dds', NULL, NULL, NULL, NULL, NULL, '2021-03-31 02:50:14', '2021-03-31 02:50:14');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_03_25_042610_create_subdomains_table', 1),
(5, '2021_03_25_045749_create_business_informations_table', 1),
(6, '2021_03_26_075726_add_first_login_at_to_users_table', 1),
(7, '2021_03_29_062812_add_owner_id_to_users_table', 2),
(8, '2021_03_29_081514_create_sessions_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expire_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_id_index` (`email_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('6PZiGg72oFF68mfBLP63Sjz7YbpGeS5WWA5xm9GR', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.90 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoiZlc5anVLTXUxQmZnTFV3QVl3MzlvU3lvUEhJeDVqYVNNSVlHYlhRSCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xYnVzaW5lc3Njcm0uaW4vYXV0aC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1617005855),
('CmdSWluhZR2OJAnrh9NpMBUIeMoZcIMOvQKuFdq4', 2, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.90 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoidDMwdjdxUTJJenRNVE5XelNiZ1RIMzZlcHVvWWJOTUdLclJ0UnI2UCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xYnVzaW5lc3Njcm0uaW4vYXV0aC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjI7fQ==', 1617005902),
('Eb7UfY7zgFDAOLMkqO93YYKWMV518wu5jUj3yDqG', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/89.0.4389.90 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiblFNa3dCR2JDeXRYTXdBcnVpT1NJN2xVYW9hczVlSVAwUW45ejY4RCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzM6Imh0dHA6Ly8xYnVzaW5lc3Njcm0uaW4vYXV0aC9sb2dpbiI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1617005905);

-- --------------------------------------------------------

--
-- Table structure for table `subdomains`
--

DROP TABLE IF EXISTS `subdomains`;
CREATE TABLE IF NOT EXISTS `subdomains` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Inactive, 1=Active, 3=Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `subdomains_user_id_unique` (`user_id`),
  UNIQUE KEY `subdomains_name_unique` (`name`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subdomains`
--

INSERT INTO `subdomains` (`id`, `user_id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(2, 2, 'user1', 1, '2021-03-27 10:21:27', '2021-03-27 10:26:18'),
(3, 3, 'user2', 1, '2021-03-29 06:45:39', '2021-03-29 06:49:24'),
(4, 4, 'qwqq', 0, '2021-03-30 03:55:27', '2021-03-30 03:55:27'),
(5, 5, 'wweqw', 1, '2021-03-30 07:27:38', '2021-03-30 07:30:28'),
(6, 6, 'user21', 0, '2021-03-31 02:50:14', '2021-03-31 02:50:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile_number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_owner` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=No, 1=Yes',
  `owner_id` bigint(20) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0 for owner else id',
  `status` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=Inactive, 1=Active, 2=Blocked, 3=Deleted',
  `email_verify_token` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `email_verify_token_expire_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `first_login_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_id_unique` (`email_id`),
  UNIQUE KEY `users_mobile_number_unique` (`mobile_number`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `email_id`, `mobile_number`, `password`, `is_owner`, `owner_id`, `status`, `email_verify_token`, `email_verified_at`, `email_verify_token_expire_at`, `remember_token`, `first_login_at`, `created_at`, `updated_at`) VALUES
(2, 'Arindam', 'Roy', 'testarix123@yopmail.com', '9836395513', '$2y$10$NIUdid2EPLP6WZTrOvt6PuUWOcOFECZxrT3rpG8z1uff0oF8GvSMS', 1, 0, 1, NULL, '2021-03-27 10:26:18', NULL, NULL, '2021-03-30 13:04:27', '2021-03-27 10:21:27', '2021-03-30 07:34:27'),
(3, 'san', 'roy', 'testarix12@yopmail.com', '9988776654', '$2y$10$C6kryMqDZ7t/Va22Knp9CefJYn6Lxp6V8nURdahai72Cv0lcnd1Ky', 1, 0, 1, NULL, '2021-03-29 06:49:24', NULL, NULL, NULL, '2021-03-29 06:45:39', '2021-03-29 06:49:24'),
(4, 'cxzx', 'xzczx', 'xxx1005@yopmail.com', '456456567656', '$2y$10$tYesb5ADUwcY/.bNKb9b1ONaWneKJTaRfBRyhO8VOMq.aXHX1RFRO', 1, 0, 0, 'b2dvb3NvNWx1YXJ1ejk4ZmtrMGx1d2ptZzhwajZ2bXpoY2Q3NDV2aDV1M2FpY3dhYmFncXN3NWpjcTVo', NULL, '2021-03-31 03:55:27', NULL, NULL, '2021-03-30 03:55:27', '2021-03-31 01:06:00'),
(5, 'xczxc', 'xzcxz', 'asdas@yopmail.com', '2312234234', '$2y$10$YyTp5TuqhlAMGMjwUxedi.uzMFJu6r1sGr1U3Auz2ybgu2ug3Lgr2', 1, 0, 1, NULL, '2021-03-30 07:30:28', NULL, NULL, NULL, '2021-03-30 07:27:38', '2021-03-30 07:30:28'),
(6, 'cxvxc', 'cxvcx', 'testarix1s23@yopmail.com', '34333453443', '$2y$10$1cu6ENW.oxUS8.MOivkiEuP9LtAAwVvdZWQAUB/JW3OzrtFvUiCO6', 1, 0, 0, 'bTM4c2JmdWk4bGZkcnA2MXYxNGZ4amN0Z2syYjlqaXI5aThlaGZ3ZHl6b2ZpZHdoYWM0ZXlxZWFrbmhy', NULL, '2021-04-01 02:50:14', NULL, NULL, '2021-03-31 02:50:14', '2021-03-31 02:50:14');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
