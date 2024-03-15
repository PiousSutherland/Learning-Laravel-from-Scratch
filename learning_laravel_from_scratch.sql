-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
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


-- Dumping database structure for learning_laravel_from_scratch
CREATE DATABASE IF NOT EXISTS `learning_laravel_from_scratch` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `learning_laravel_from_scratch`;

-- Dumping structure for table learning_laravel_from_scratch.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table learning_laravel_from_scratch.cache: ~2 rows (approximately)
INSERT INTO `cache` (`key`, `value`, `expiration`) VALUES
	('posts.all', 'O:29:"Illuminate\\Support\\Collection":2:{s:8:"\0*\0items";a:5:{i:0;O:15:"App\\Models\\Post":5:{s:5:"title";s:13:"My Fifth Post";s:7:"excerpt";s:56:"Lorem ipsum dolor sit amet consectetur adipisicing elit.";s:4:"date";s:10:"16-03-2024";s:4:"body";s:232:"\n<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta impedit ullam ea voluptatum dolor modi. Ipsam\r\n    commodi voluptatibus, nam suscipit expedita in unde ad perspiciatis dolores magnam repudiandae. Nulla, quae.\r\n</p>";s:4:"slug";s:13:"my-fifth-post";}i:2;O:15:"App\\Models\\Post":5:{s:5:"title";s:14:"My Fourth Post";s:7:"excerpt";s:56:"Lorem ipsum dolor sit amet consectetur adipisicing elit.";s:4:"date";s:10:"16-03-2024";s:4:"body";s:232:"\n<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta impedit ullam ea voluptatum dolor modi. Ipsam\r\n    commodi voluptatibus, nam suscipit expedita in unde ad perspiciatis dolores magnam repudiandae. Nulla, quae.\r\n</p>";s:4:"slug";s:14:"my-fourth-post";}i:1;O:15:"App\\Models\\Post":5:{s:5:"title";s:13:"My First Post";s:7:"excerpt";s:56:"Lorem ipsum dolor sit amet consectetur adipisicing elit.";s:4:"date";s:10:"15-03-2024";s:4:"body";s:232:"\n<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta impedit ullam ea voluptatum dolor modi. Ipsam\r\n    commodi voluptatibus, nam suscipit expedita in unde ad perspiciatis dolores magnam repudiandae. Nulla, quae.\r\n</p>";s:4:"slug";s:13:"my-first-post";}i:3;O:15:"App\\Models\\Post":5:{s:5:"title";s:14:"My Second Post";s:7:"excerpt";s:56:"Lorem ipsum dolor sit amet consectetur adipisicing elit.";s:4:"date";s:10:"15-03-2024";s:4:"body";s:232:"\n<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta impedit ullam ea voluptatum dolor modi. Ipsam\r\n    commodi voluptatibus, nam suscipit expedita in unde ad perspiciatis dolores magnam repudiandae. Nulla, quae.\r\n</p>";s:4:"slug";s:14:"my-second-post";}i:4;O:15:"App\\Models\\Post":5:{s:5:"title";s:13:"My Third Post";s:7:"excerpt";s:56:"Lorem ipsum dolor sit amet consectetur adipisicing elit.";s:4:"date";s:10:"15-03-2024";s:4:"body";s:232:"\n<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Dicta impedit ullam ea voluptatum dolor modi. Ipsam\r\n    commodi voluptatibus, nam suscipit expedita in unde ad perspiciatis dolores magnam repudiandae. Nulla, quae.\r\n</p>";s:4:"slug";s:13:"my-third-post";}}s:28:"\0*\0escapeWhenCastingToString";b:0;}', 2025869618);

-- Dumping structure for table learning_laravel_from_scratch.cache_locks
CREATE TABLE IF NOT EXISTS `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table learning_laravel_from_scratch.cache_locks: ~0 rows (approximately)

-- Dumping structure for table learning_laravel_from_scratch.failed_jobs
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table learning_laravel_from_scratch.failed_jobs: ~0 rows (approximately)

-- Dumping structure for table learning_laravel_from_scratch.jobs
CREATE TABLE IF NOT EXISTS `jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint unsigned NOT NULL,
  `reserved_at` int unsigned DEFAULT NULL,
  `available_at` int unsigned NOT NULL,
  `created_at` int unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table learning_laravel_from_scratch.jobs: ~0 rows (approximately)

-- Dumping structure for table learning_laravel_from_scratch.job_batches
CREATE TABLE IF NOT EXISTS `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int NOT NULL,
  `pending_jobs` int NOT NULL,
  `failed_jobs` int NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext,
  `cancelled_at` int DEFAULT NULL,
  `created_at` int NOT NULL,
  `finished_at` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table learning_laravel_from_scratch.job_batches: ~0 rows (approximately)

-- Dumping structure for table learning_laravel_from_scratch.migrations
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table learning_laravel_from_scratch.migrations: ~3 rows (approximately)
INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '0001_01_01_000000_create_users_table', 1),
	(2, '0001_01_01_000001_create_cache_table', 1),
	(3, '0001_01_01_000002_create_jobs_table', 1);

-- Dumping structure for table learning_laravel_from_scratch.password_reset_tokens
CREATE TABLE IF NOT EXISTS `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table learning_laravel_from_scratch.password_reset_tokens: ~0 rows (approximately)

-- Dumping structure for table learning_laravel_from_scratch.sessions
CREATE TABLE IF NOT EXISTS `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text,
  `payload` longtext NOT NULL,
  `last_activity` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table learning_laravel_from_scratch.sessions: ~2 rows (approximately)
INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
	('OE6U7YLpGxrp152Zy6p7Eoo0SuM5AUqRxqwxl27e', NULL, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/120.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiVFFJNjhLSlF6YVFQZmVPODNEUjNZdWtjOHcwNFlsZUo3cW9SSzRRbCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MjE6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMCI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1710509618);

-- Dumping structure for table learning_laravel_from_scratch.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Dumping data for table learning_laravel_from_scratch.users: ~0 rows (approximately)

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
