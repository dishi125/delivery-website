-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Nov 11, 2020 at 08:31 PM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `delivery`
--

-- --------------------------------------------------------

--
-- Table structure for table `assign_driver`
--

DROP TABLE IF EXISTS `assign_driver`;
CREATE TABLE IF NOT EXISTS `assign_driver` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `driver_id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `is_delivery_complete` tinyint(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `assign_driver`
--

INSERT INTO `assign_driver` (`id`, `driver_id`, `from_user_id`, `is_delivery_complete`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, '2020-07-10 06:30:38', '2020-07-10 06:46:51'),
(2, 1, 5, 1, '2020-07-10 07:18:13', '2020-07-10 07:19:50'),
(3, 1, 9, 1, '2020-07-11 10:04:07', '2020-07-11 10:05:50'),
(4, 2, 14, 1, '2020-07-13 07:13:46', '2020-07-13 07:25:50'),
(5, 2, 18, 1, '2020-07-18 06:13:43', '2020-07-18 06:15:16'),
(6, 2, 20, 1, '2020-07-18 08:40:56', '2020-07-18 08:42:26'),
(7, 1, 22, 1, '2020-07-18 09:50:02', '2020-07-18 09:51:07'),
(8, 2, 24, 1, '2020-07-20 05:34:58', '2020-07-20 05:39:16'),
(9, 2, 28, 1, '2020-07-20 06:22:26', '2020-07-20 06:24:23'),
(10, 2, 44, 1, '2020-07-23 08:26:14', '2020-07-23 08:31:02'),
(11, 2, 60, 1, '2020-07-24 05:01:34', '2020-07-24 05:04:49'),
(12, 3, 66, 1, '2020-07-24 06:02:21', '2020-07-24 06:03:53'),
(13, 3, 62, 1, '2020-07-24 10:28:01', '2020-07-24 10:31:43'),
(14, 3, 70, 1, '2020-07-24 10:59:28', '2020-07-24 11:01:31');

-- --------------------------------------------------------

--
-- Table structure for table `car_makes`
--

DROP TABLE IF EXISTS `car_makes`;
CREATE TABLE IF NOT EXISTS `car_makes` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `car_models`
--

DROP TABLE IF EXISTS `car_models`;
CREATE TABLE IF NOT EXISTS `car_models` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `car_make_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

DROP TABLE IF EXISTS `cities`;
CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `country_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `province_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `country_name`, `province_name`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Australia', NULL, 'test1_auscity', '2020-09-28 04:50:55', '2020-09-28 04:50:55', NULL),
(2, 'Australia', NULL, 'test2_auscity', '2020-09-28 04:51:15', '2020-09-28 04:51:15', NULL),
(3, 'Canada', NULL, 'test1_cancity', '2020-09-28 04:51:41', '2020-09-28 04:51:41', NULL),
(4, 'Canada', NULL, 'test2_cancity', '2020-09-28 04:51:58', '2020-09-28 04:51:58', NULL),
(5, 'India', NULL, 'test1_indcity', '2020-09-28 04:52:20', '2020-09-28 04:52:20', NULL),
(6, 'India', NULL, 'test2_indcity', '2020-09-28 04:52:38', '2020-09-28 04:52:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

DROP TABLE IF EXISTS `companies`;
CREATE TABLE IF NOT EXISTS `companies` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'company1', '2020-05-20 11:15:50', '2020-05-20 11:15:50'),
(2, 'Company2', '2020-05-20 11:16:24', '2020-05-20 11:16:24');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

DROP TABLE IF EXISTS `countries`;
CREATE TABLE IF NOT EXISTS `countries` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Canada', '2020-05-20 11:14:46', '2020-05-20 11:14:46'),
(2, 'India', '2020-05-20 11:14:52', '2020-05-20 11:14:52'),
(3, 'Australia', '2020-05-20 11:15:40', '2020-05-20 11:15:40');

-- --------------------------------------------------------

--
-- Table structure for table `delivery_addresses`
--

DROP TABLE IF EXISTS `delivery_addresses`;
CREATE TABLE IF NOT EXISTS `delivery_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL,
  `to_form` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_id` text COLLATE utf8mb4_unicode_ci,
  `country_id` int(11) NOT NULL,
  `province` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postalcode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street_add` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` decimal(10,7) DEFAULT NULL,
  `long` decimal(10,7) DEFAULT NULL,
  `street_add1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sms_verification` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) DEFAULT NULL,
  `planname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_sent_req` tinyint(1) DEFAULT '0',
  `is_confirmed` tinyint(1) NOT NULL DEFAULT '0',
  `is_assign` tinyint(1) NOT NULL DEFAULT '0',
  `is_complete` tinyint(1) NOT NULL DEFAULT '0',
  `delivery_cmppic` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

DROP TABLE IF EXISTS `drivers`;
CREATE TABLE IF NOT EXISTS `drivers` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_email_verified` int(11) NOT NULL DEFAULT '0',
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_pic` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `car_make` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `car_model` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `year` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `car_image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`id`, `fname`, `lname`, `email`, `is_email_verified`, `mobile`, `address`, `password`, `profile_pic`, `car_make`, `car_model`, `year`, `car_image`, `created_at`, `updated_at`) VALUES
(1, 'Yogita', 'Kacha', 'yogitakacha1999@gmail.com', 0, '9016757577', 'katargam surat', '$2y$10$6zofVR3/A77BLE.YsQP7ye1tpLPy17AdyLz0Qp2kj8pS7kTIY0ylm', '', 'xyz1', 'xyz', '2020', '', '2020-06-03 06:35:53', '2020-06-03 06:35:53'),
(2, 'test yash', 'Driver', 'testdriver@winemails.com', 0, '9016757577', 'gcgghcvghc', '$2y$10$kMfR3IdBPhjMhQgpU/mHsOCuSYVNvEqWKLpdb9HGqgKw96dpVsJoe', '3461594615159.png', 'omni123', 'omni123', '2002', '1941595221274.jpeg', '2020-07-13 04:40:12', '2020-07-23 08:05:37'),
(3, 'Rohan ', 'Patel', 'rohan.vasundhara19@gmail.com', 0, '9016757577', 'Athawaget ,surat', '$2y$10$6zofVR3/A77BLE.YsQP7ye1tpLPy17AdyLz0Qp2kj8pS7kTIY0ylm', '', 'xyz', 'xyzz', '2027', '', '2020-07-24 00:00:00', '2020-07-24 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `driver_review`
--

DROP TABLE IF EXISTS `driver_review`;
CREATE TABLE IF NOT EXISTS `driver_review` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `driver_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `driver_review`
--

INSERT INTO `driver_review` (`id`, `driver_id`, `user_id`, `rate`, `comment`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 5, 'Good Service', '2020-06-03 06:38:21', '2020-06-03 06:38:21'),
(2, 2, 6, 3, 'Good Service', '2020-07-20 04:17:41', '2020-07-20 04:17:41'),
(3, 2, 6, 5, 'Good Service', '2020-07-20 04:49:58', '2020-07-20 04:49:58'),
(4, 2, 6, 5, 'Thank You', '2020-07-20 04:50:19', '2020-07-20 04:50:19'),
(5, 2, 6, 5, 'xxZxzx', '2020-07-23 07:17:17', '2020-07-23 07:17:17'),
(6, 2, 6, 0, 'asdfasdfas', '2020-07-23 07:20:15', '2020-07-23 07:20:15'),
(7, 2, 6, 4, 'Good Service Provider', '2020-07-23 08:39:40', '2020-07-23 08:39:40');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2020_05_05_102249_create_delivery_address_table', 1),
(5, '2020_05_05_104642_create_web_user_table', 1),
(6, '2020_05_05_104801_create_driver_table', 1),
(7, '2020_05_05_105813_create_package_table', 1),
(8, '2020_05_05_112907_create_country_table', 1),
(9, '2020_05_05_112949_create_company_table', 1),
(10, '2020_05_09_054716_add_image_to_web_user_table', 1),
(11, '2020_05_09_054942_add_image_to_driver_table', 1),
(12, '2020_05_18_104032_add_year_to_drivers', 1),
(13, '2020_05_18_111931_change_year_column_type_to_drivers', 1),
(14, '2020_05_19_101145_add_kgcm_to_packages_table', 1),
(15, '2020_05_19_102125_add_parentid_to_delivery_addresses_table', 1),
(16, '2020_05_19_111900_add_address2_to_addresses_table', 1),
(17, '2020_05_20_093951_delete_companyis_to_packages', 1),
(18, '2020_05_20_094824_add_nullable_to_packages', 1),
(19, '2020_05_21_052015_add_nullable_to_delivery_addresses', 2),
(20, '2020_05_22_113516_add_price_to_delivery_addresses_table', 2),
(21, '2020_05_25_051028_add_is_confirm_to_delivery_addresses', 2),
(22, '2020_05_26_115905_create_assign_driver_table', 2),
(23, '2020_05_26_121953_add_assign_drive_to_delivery_addresses_table', 2),
(24, '2020_05_27_055057_add_is_busy_to_delivery_addresses_table', 2),
(25, '2020_05_27_062309_rename_is_busy_to_delivery_addresses_table', 2),
(26, '2020_05_27_104214_add_delivery_completion_pic_to_delivery_addresses_table', 2),
(27, '2020_05_30_055308_create_review_for_driver', 3),
(28, '2020_05_30_074012_create_review_for_user', 3),
(31, '2020_06_01_050144_create_transaction_table', 4),
(32, '2020_06_01_053437_change_datatype_to_transaction_table', 4),
(33, '2020_06_01_090657_add_transaction_id_to_transaction_table', 4),
(34, '2020_06_05_072435_add_lat_long_to_delivery_addresses_table', 5),
(35, '2020_06_11_040642_create_temp_delivery_addresses_table', 5),
(36, '2020_06_11_041854_create_temp_package_table', 5),
(37, '2020_06_11_045839_add_nullable_to_user_id_to_temaddresses_table', 5),
(38, '2020_06_11_054236_add_location_to_temppackages_table', 5),
(39, '2020_06_12_045340_add_packgcnt_to_tmp_package_table', 5),
(40, '2020_06_12_110821_add_place_to_tmp_package_table', 5),
(41, '2020_06_13_043600_add_lat_long_to_temp_delivery_addresses_table', 5),
(42, '2020_06_25_051949_alter_table_temp_delivery_addresses_change_company_type', 6),
(43, '2020_06_25_052334_alter_table_delivery_addresses_change_company_type', 6),
(44, '2020_07_01_070533_add_plnanname_to_temp_delivery_addresses_table', 6),
(45, '2020_07_01_081733_add_plnanname_to_delivery_addresses_table', 6),
(46, '2020_07_01_112129_add_fields_to_package_detail_table', 6),
(47, '2020_07_02_090029_add_toform_field_to_delivery_addresses', 6),
(48, '2020_07_03_104030_add_sent_request_to_delivery_addresses', 6),
(49, '2020_07_03_105026_add_sent_request_to_temp_delivery_addresses', 6),
(50, '2020_07_07_061826_add_is_complete_field_to_assign_driver_table', 6),
(51, '2020_07_13_102358_change_datatype_of_latlong_to_delivery_addresses_table', 7),
(52, '2020_07_13_102704_change_datatype_of_latlong_to_temp_delivery_addresses_table', 7),
(53, '2020_07_23_112859_change_datatype_of_comment_in_userreview', 8),
(54, '2020_07_23_113057_change_datatype_of_comment_in_driverreview', 8),
(55, '2020_09_10_083841_add_is_email_verified_in_drivers_table', 9),
(56, '2020_09_10_091748_create_car_makes_table', 9),
(57, '2020_09_11_065035_create_car_models_table', 9),
(58, '2020_09_25_060022_create_provinces_table', 10),
(59, '2020_09_25_062533_create_cities_table', 10),
(60, '2020_09_25_082614_add_province_city_postalcode_to_temp_delivery_addresses', 10),
(61, '2020_09_25_122133_add_province_city_postalcode_to_delivery_addresses', 10),
(62, '2020_10_05_053113_add_province_name_to_cities', 11);

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

DROP TABLE IF EXISTS `packages`;
CREATE TABLE IF NOT EXISTS `packages` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `to_address_id` int(11) NOT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `place` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `packagecnt` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight` int(11) NOT NULL,
  `packagekg` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dimesionl` int(11) DEFAULT NULL,
  `dimesionw` int(11) DEFAULT NULL,
  `dimesionh` int(11) DEFAULT NULL,
  `dimensions` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dvalue` int(11) DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `provinces`
--

DROP TABLE IF EXISTS `provinces`;
CREATE TABLE IF NOT EXISTS `provinces` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `country_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `provinces`
--

INSERT INTO `provinces` (`id`, `country_name`, `name`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Australia', 'test1_auspro', '2020-09-28 04:48:08', '2020-09-28 04:48:54', NULL),
(2, 'Australia', 'test2_auspro', '2020-09-28 04:48:31', '2020-09-28 04:48:31', NULL),
(3, 'Canada', 'test1_canpro', '2020-09-28 04:49:21', '2020-09-28 04:49:21', NULL),
(4, 'Canada', 'test2_canpro', '2020-09-28 04:49:38', '2020-09-28 04:49:38', NULL),
(5, 'India', 'test1_indpro', '2020-09-28 04:49:58', '2020-09-28 04:49:58', NULL),
(6, 'India', 'test2_indpro', '2020-09-28 04:50:19', '2020-09-28 04:50:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `temp_delivery_addresses`
--

DROP TABLE IF EXISTS `temp_delivery_addresses`;
CREATE TABLE IF NOT EXISTS `temp_delivery_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) DEFAULT NULL,
  `to_form` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company_id` text COLLATE utf8mb4_unicode_ci,
  `country_id` int(11) NOT NULL,
  `province` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `postalcode` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `street_add` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `lat` decimal(10,7) NOT NULL,
  `long` decimal(10,7) NOT NULL,
  `street_add1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile1` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sms_verification` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) DEFAULT NULL,
  `planname` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_sent_req` tinyint(1) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `temp_package`
--

DROP TABLE IF EXISTS `temp_package`;
CREATE TABLE IF NOT EXISTS `temp_package` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `to_address_id` int(11) NOT NULL,
  `location` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `place` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `packagecnt` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight` int(11) NOT NULL,
  `packagekg` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dimesionl` int(11) DEFAULT NULL,
  `dimesionw` int(11) DEFAULT NULL,
  `dimesionh` int(11) DEFAULT NULL,
  `dimesions` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dvalue` int(11) DEFAULT NULL,
  `image` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

DROP TABLE IF EXISTS `transaction`;
CREATE TABLE IF NOT EXISTS `transaction` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `transaction_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payment_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `payer_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `invoice` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `transaction_id`, `payment_id`, `payer_id`, `amount`, `description`, `invoice`, `status`, `created_at`, `updated_at`) VALUES
(1, 'TRANSACTION20200710', 'PAYID-L4EAVDQ3SU29515EW1526453', 1, 100, 'Delivery In Hour', '5f080a8ad798d', 'approved', '2020-07-10 06:28:30', '2020-07-10 06:29:01'),
(2, NULL, 'PAYID-L4EBK6Y22V37723EE620570B', 5, 50, 'Delivery In Hour', '5f0815789ece5', 'pending', '2020-07-10 07:15:07', '2020-07-10 07:15:07'),
(3, 'TRANSACTION20200710', 'PAYID-L4EBLSA39M81329TT682745B', 5, 50, 'Delivery In Hour', '5f0815c57a799', 'approved', '2020-07-10 07:16:24', '2020-07-10 07:16:49'),
(4, 'TRANSACTION20200711', 'PAYID-L4EY4MY1PR856866G150891Y', 9, 500, 'Delivery In Hour', '5f098e2fa4b48', 'approved', '2020-07-11 10:02:27', '2020-07-11 10:02:51'),
(5, NULL, 'PAYID-L4E24FI8FA14761KC717041G', 12, 1000, 'Delivery In Hour', '5f09ae1299809', 'pending', '2020-07-11 12:18:29', '2020-07-11 12:18:29'),
(6, NULL, 'PAYID-L4F6OMI5J768834GX126642P', 12, 1000, 'Delivery In Hour', '5f0be72db03ae', 'pending', '2020-07-13 04:46:41', '2020-07-13 04:46:41'),
(7, NULL, 'PAYID-L4F6UEA6AV42968D94845243', 14, 1, 'Delivery In Hour', '5f0bea0dd630d', 'pending', '2020-07-13 04:58:56', '2020-07-13 04:58:56'),
(8, NULL, 'PAYID-L4GAMFY2S043571YA389732E', 14, 1, 'Delivery In Hour', '5f0c0613c7800', 'pending', '2020-07-13 06:58:31', '2020-07-13 06:58:31'),
(9, 'TRANSACTION20200713', 'PAYID-L4GANGQ8NR6066350066534Y', 14, 1, 'Delivery In Hour', '5f0c0697b2a74', 'approved', '2020-07-13 07:00:42', '2020-07-13 07:03:56'),
(10, NULL, 'PAYID-L4GANQI7WR19325EE342454X', 14, 1, 'Delivery In Hour', '5f0c06bea6426', 'pending', '2020-07-13 07:01:21', '2020-07-13 07:01:21'),
(11, NULL, 'PAYID-L4GANQI9LU08486WJ024783T', 14, 1, 'Delivery In Hour', '5f0c06beaf6bc', 'pending', '2020-07-13 07:01:21', '2020-07-13 07:01:21'),
(12, NULL, 'PAYID-L4GAN4Q56V79266K28204644', 14, 1, 'Delivery In Hour', '5f0c06ef70914', 'pending', '2020-07-13 07:02:10', '2020-07-13 07:02:10'),
(13, 'TRANSACTION20200718', 'PAYID-L4JJE3Y9VY10684AM2417029', 18, 1, 'Delivery In Hour', '5f12926c3d427', 'approved', '2020-07-18 06:10:55', '2020-07-18 06:12:59'),
(14, 'TRANSACTION20200718', 'PAYID-L4JLKDQ2AG08626KC070963H', 20, 1, 'Delivery In Hour', '5f12b50a91163', 'approved', '2020-07-18 08:38:38', '2020-07-18 08:39:31'),
(15, 'TRANSACTION20200718', 'PAYID-L4JMK6I1X5701298F379463F', 22, 1, 'Delivery In Hour', '5f12c57662dd6', 'approved', '2020-07-18 09:48:41', '2020-07-18 09:49:07'),
(16, NULL, 'PAYID-L4KRYOI0PX895245F873734R', 12, 1000, 'Delivery In Hour', '5f151c35d4ad4', 'pending', '2020-07-20 04:23:21', '2020-07-20 04:23:21'),
(17, NULL, 'PAYID-L4KRYOI51V19308V6044264W', 12, 1000, 'Delivery In Hour', '5f151c35ea5ee', 'pending', '2020-07-20 04:23:21', '2020-07-20 04:23:21'),
(18, NULL, 'PAYID-L4KSDWI3PY914407M136231T', 24, 1, 'Delivery In Hour', '5f1521d612e1e', 'pending', '2020-07-20 04:47:21', '2020-07-20 04:47:21'),
(19, NULL, 'PAYID-L4KSMKI50X790570Y276132R', 24, 1, 'Delivery In Hour', '5f1526269f5d0', 'pending', '2020-07-20 05:05:46', '2020-07-20 05:05:46'),
(20, NULL, 'PAYID-L4KSNDQ0KM42354TN106953X', 12, 1000, 'Delivery In Hour', '5f15268bd453e', 'pending', '2020-07-20 05:07:26', '2020-07-20 05:07:26'),
(21, 'TRANSACTION20200720', 'PAYID-L4KSY6Q7M8156783J6801922', 24, 1, 'Delivery In Hour', '5f152c76c5784', 'approved', '2020-07-20 05:32:42', '2020-07-20 05:34:00'),
(22, NULL, 'PAYID-L4KTBLY52X951640P207642S', 28, 1, 'Delivery In Hour', '5f1530acd3dc5', 'pending', '2020-07-20 05:50:39', '2020-07-20 05:50:39'),
(23, NULL, 'PAYID-L4KTIJI3C555355TY234944Y', 28, 1, 'Delivery In Hour', '5f153422b3bee', 'pending', '2020-07-20 06:05:26', '2020-07-20 06:05:26'),
(24, NULL, 'PAYID-L4KTJEA5XH158704A450004D', 28, 1, 'Delivery In Hour', '5f15348dc7549', 'pending', '2020-07-20 06:07:12', '2020-07-20 06:07:12'),
(25, NULL, 'PAYID-L4KTJPI0VU058126X110473W', 28, 1, 'Delivery In Hour', '5f1534bac56d9', 'pending', '2020-07-20 06:07:57', '2020-07-20 06:07:57'),
(26, NULL, 'PAYID-L4KTJ2Y8VX97662F7559693J', 28, 1, 'Delivery In Hour', '5f1534e8a8dcb', 'pending', '2020-07-20 06:08:43', '2020-07-20 06:08:43'),
(27, 'TRANSACTION20200720', 'PAYID-L4KTKYY1G492199UG990702K', 28, 1, 'Delivery In Hour', '5f153560a8150', 'approved', '2020-07-20 06:10:44', '2020-07-20 06:12:33'),
(28, NULL, 'PAYID-L4KW5MA9LK90160GG385351A', 34, 1, 'Delivery In Hour', '5f156ead782da', 'pending', '2020-07-20 10:15:12', '2020-07-20 10:15:12'),
(29, NULL, 'PAYID-L4KW5QI0UL07150JE232932B', 34, 1, 'Delivery In Hour', '5f156ebe9bcd0', 'pending', '2020-07-20 10:15:29', '2020-07-20 10:15:29'),
(30, NULL, 'PAYID-L4KW6EA8KB72909UP8911108', 34, 1, 'Delivery In Hour', '5f156f0dd3551', 'pending', '2020-07-20 10:16:49', '2020-07-20 10:16:49'),
(31, NULL, 'PAYID-L4KW6XI8061175584583894A', 34, 1, 'Delivery In Hour', '5f156f5ae1851', 'pending', '2020-07-20 10:18:05', '2020-07-20 10:18:05'),
(32, NULL, 'PAYID-L4KW7QA7EE0559950671371M', 34, 1, 'Delivery In Hour', '5f156fbd25c59', 'pending', '2020-07-20 10:19:44', '2020-07-20 10:19:44'),
(33, NULL, 'PAYID-L4KW77Y2CT92475CD570830N', 34, 1, 'Delivery In Hour', '5f156ffaa6fdd', 'pending', '2020-07-20 10:20:47', '2020-07-20 10:20:47'),
(34, NULL, 'PAYID-L4KXAJQ279052462G584794N', 34, 1, 'Delivery In Hour', '5f157023c52b4', 'pending', '2020-07-20 10:21:26', '2020-07-20 10:21:26'),
(35, NULL, 'PAYID-L4MEH7Y1Y244531L3326981D', 38, 5000, 'Delivery In Hour', '5f1843fc94764', 'pending', '2020-07-22 13:49:51', '2020-07-22 13:49:51'),
(36, 'TRANSACTION20200723', 'PAYID-L4MUQWQ38811100HH162093J', 44, 1, 'Delivery In Hour', '5f194857234f6', 'approved', '2020-07-23 08:20:42', '2020-07-23 08:22:28'),
(37, 'TRANSACTION20200724', 'PAYID-L4NGUGA21E59626C6841613Y', 60, 1, 'Delivery In Hour', '5f1a6a1314ee0', 'approved', '2020-07-24 04:56:56', '2020-07-24 04:57:59'),
(38, 'TRANSACTION20200724', 'PAYID-L4NHSDQ9CC89486XY0298023', 66, 1, 'Delivery In Hour', '5f1a790b2619f', 'approved', '2020-07-24 06:00:46', '2020-07-24 06:01:33'),
(39, 'TRANSACTION20200724', 'PAYID-L4NIPTQ6PD17978XA229510G', 62, 1, 'Delivery In Hour', '5f1a87cb6ce64', 'approved', '2020-07-24 07:03:42', '2020-07-24 07:04:13'),
(40, 'TRANSACTION20200724', 'PAYID-L4NK53I5A836396FJ309340T', 36, 1, 'Delivery In Hour', '5f1aaeea44ba4', 'approved', '2020-07-24 09:50:37', '2020-07-24 09:51:06'),
(41, 'TRANSACTION20200724', 'PAYID-L4NL4NY4M603547GF685120N', 70, 1, 'Delivery In Hour', '5f1abe347791f', 'approved', '2020-07-24 10:55:51', '2020-07-24 10:56:26'),
(42, NULL, 'PAYID-L4QJV2Q38S82421UU811271X', 38, 5000, 'Delivery In Hour', '5f209ae7862b4', 'pending', '2020-07-28 21:38:51', '2020-07-28 21:38:51'),
(43, NULL, 'PAYID-L4QJV3Q38J54517N7411544T', 38, 5000, 'Delivery In Hour', '5f209aebc2b13', 'pending', '2020-07-28 21:38:54', '2020-07-28 21:38:54'),
(44, NULL, 'PAYID-L4QJV3Y6GK26532T2653325L', 38, 5000, 'Delivery In Hour', '5f209aeccfdcc', 'pending', '2020-07-28 21:38:55', '2020-07-28 21:38:55');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin.vasundhara@gmail.com', NULL, '$2y$10$nUAYM6mTWsX2d4Zc4vBOg.NPZiIr5g.ypxk8MIljRN7rTydVxQ/06', NULL, '2020-05-20 00:00:00', '2020-05-20 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_review`
--

DROP TABLE IF EXISTS `user_review`;
CREATE TABLE IF NOT EXISTS `user_review` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `driver_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `comment` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_review`
--

INSERT INTO `user_review` (`id`, `driver_id`, `user_id`, `to_user_id`, `rate`, `comment`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 3, 'Good', '2020-07-10 06:43:58', '2020-07-10 06:43:58'),
(2, 1, 1, 5, 0, 'Superb', '2020-07-10 07:19:12', '2020-07-10 07:19:12'),
(3, 2, 6, 15, 5, 'very good', '2020-07-13 07:26:18', '2020-07-13 07:26:18'),
(4, 2, 6, 19, 3, 'good', '2020-07-18 06:15:28', '2020-07-18 06:15:28'),
(5, 2, 6, 21, 4, 'Good', '2020-07-18 08:42:47', '2020-07-18 08:42:47'),
(6, 2, 6, 45, 5, 'good Customer', '2020-07-23 08:31:43', '2020-07-23 08:31:43'),
(8, 3, 6, 67, 4, 'test', '2020-07-24 06:04:07', '2020-07-24 06:04:07'),
(9, 3, 7, 63, 3, 'sdbfjksbdjkfbkj fsjkgfkjsdf fgjksdgfjkgds jghfjk sdfsdjhjkh  ks fjsdjfsdg ksdj fgk sdjkjg kjgfk sjdgkfgk sgfjksg fs sdbfjksbdjkfbkj fsjkgfkjsdf fgjksdgfjkgds jghfjk sdfsdjhjkh  ks fjsdjfsdg ksdj fgk sdjkjg kjgfk sjdgkfgk sgfjksg fssdbfjksbdjkfbkj fsjkgfkjsdf fgjksdgfjkgds jghfjk sdfsdjhjkh  ks fjsdjfs', '2020-07-24 10:30:17', '2020-07-24 10:30:17'),
(10, 3, 7, 62, 5, 'Good', '2020-07-24 10:31:54', '2020-07-24 10:31:54');

-- --------------------------------------------------------

--
-- Table structure for table `web_users`
--

DROP TABLE IF EXISTS `web_users`;
CREATE TABLE IF NOT EXISTS `web_users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `fname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lname` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `is_email_verified` int(11) NOT NULL DEFAULT '0',
  `mobile` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `profile_pic` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `web_users`
--

INSERT INTO `web_users` (`id`, `fname`, `lname`, `email`, `is_email_verified`, `mobile`, `address`, `password`, `profile_pic`, `created_at`, `updated_at`) VALUES
(1, 'yogita', 'kacha', 'yogitakacha1999@gmail.com', 0, '9016757577', 'Katargam surat', '$2y$10$ahJD577k2sZ8c0gVYrE3SuxO0C.lDKIViO6whjei3kOj/JxOzdk2O', '', '2020-05-20 11:09:52', '2020-07-10 07:22:28'),
(2, 'Alan', 'Halabi', 'ahalabi@acceinfo.com', 0, '4165620115', '86 Ringwood Drive,, Office No. 208.', '$2y$10$T3Ep1ql9jNPI/sIXLQxBtO9fkK1ZiA1PGKuoByPnI769SHVXwoJNe', '', '2020-05-20 13:20:06', '2020-05-27 14:05:02'),
(3, 'Ghiath', 'Halabi', 'ghiathh@yahoo.com', 0, '4165620115', '63 Deerglen Terr', '$2y$10$ujgX468Q5he3Wul6e90bTucOPTWw4vsJZI/6N/IS8GYhShDT7TObG', '', '2020-05-26 21:45:06', '2020-05-26 21:45:06'),
(4, 'test', 'testing', 'dishita@gmail.com', 0, '9016757577', 'katargam surat', '$2y$10$XueWdkB1eWKXZvD.wElRpe4d7oYP3gwoq/IDt.fLHODUlGlALpZiC', '', '2020-05-28 09:43:49', '2020-06-02 11:08:38'),
(5, 'Ghiath', 'Halabi', 'gh@yahoo.com', 0, '4165620115', '63 Deerglen Terr', '$2y$10$8KjG1eh8LhjipTvk3iXAAOvD3APypP6DHfrM8Sa/RYqdQVDLafsTa', '', '2020-05-28 21:16:45', '2020-05-28 21:16:45'),
(6, 'Yash', 'Rana', 'testios@djemail.net', 0, '9016757577', 'dfsdfsdccasdcas', '$2y$10$vBqMQ9WKwDz8HqRWBPjNjOMBS7ARB4kqBRRkYYOBeHWtAsh5GO7Ga', '371594464803.png', '2020-07-11 10:51:37', '2020-07-20 04:30:54'),
(7, 'xyz', 'xyz1', 'sp292202@gmail.com', 0, '9016757577', 'gajera,katargam surat', '$2y$10$ahJD577k2sZ8c0gVYrE3SuxO0C.lDKIViO6whjei3kOj/JxOzdk2O', '', '2020-07-23 00:00:00', '2020-07-23 00:00:00'),
(8, 'dishita', 'sojitra', 'dishita1@gmail.com', 0, '7894561234', 'dasd  sdad', '$2y$10$vNNy0egiiF1ThZBvjDtmYuVHn4wNI2DZqmAUw/9WeqhF1EAoSt7Zy', '', '2020-09-28 04:18:15', '2020-09-28 04:18:15'),
(12, 'dishita', 'sojitra', 'dishu1205099@gmail.com', 0, '1234567896', 'jhkhkjhkjhjk', '$2y$10$NDGP0c9YHlKel90CbZJ3q.4QfNtKa1nlnz81cO23Zc3xBw0EfaolK', '', '2020-10-04 12:35:41', '2020-10-05 07:51:00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
