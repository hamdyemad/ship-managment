-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 07, 2022 at 03:07 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ship_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_sellers`
--

CREATE TABLE `account_sellers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(11) UNSIGNED NOT NULL,
  `shippment_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'اذا كانت القيمة فارغة الشحنة pickup',
  `pickup_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'اذا كانت القيمة فارغة الشحنة pickup',
  `cash` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rate` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cost` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `delivery_commission` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT '0',
  `seller_commission` int(11) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `addresses`
--

CREATE TABLE `addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `address_line` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `building` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `floor` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `apartment` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contact_phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `area_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `addresses`
--

INSERT INTO `addresses` (`id`, `address_line`, `building`, `floor`, `apartment`, `contact_name`, `contact_email`, `contact_phone`, `user_id`, `city_id`, `area_id`, `created_at`, `updated_at`) VALUES
(4, '7st ahmed shbeb', 'q', 'qd', 'xc', 'asd', '1asdasdasdasd@asdas', '011452059120', 25, 2, 3, '2022-07-04 15:19:27', '2022-07-04 15:19:27'),
(5, 'qqqqqqqqqqqqqqqqqqqqq', 'a', 'w', '7', 'asd', 'asdasdas', '04560456456', 26, 2, 3, '2022-07-05 10:46:13', '2022-07-05 10:46:13');

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `type` enum('admin','sub-admin') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'sub-admin',
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `gender` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dofbirth` date NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `type`, `email`, `avatar`, `email_verified_at`, `gender`, `phone`, `dofbirth`, `password`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin', 'admin1@shipexeg.com', 'uploads/users/xeroclient6_27_20223_02_08am-1656584317.png', NULL, 'male', '01152059120', '2022-06-28', '$2y$10$xIQxYq4kAd6T9oDoobFXIOBuPRtwo/fAKzWs4ZvbvXkku9iVOj7Uq', '2022-06-28 09:26:33', '2022-06-30 08:18:37');

-- --------------------------------------------------------

--
-- Table structure for table `areas`
--

CREATE TABLE `areas` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `area` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `areas`
--

INSERT INTO `areas` (`id`, `area`, `rate`, `city_id`, `created_at`, `updated_at`) VALUES
(3, 'maadi', '50', 2, '2022-07-01 09:31:25', '2022-07-01 09:31:25'),
(4, 'dar elsalaam', '30', 2, '2022-07-01 09:31:31', '2022-07-01 09:31:31');

-- --------------------------------------------------------

--
-- Table structure for table `assignedpickups`
--

CREATE TABLE `assignedpickups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `driver_id` bigint(20) UNSIGNED NOT NULL,
  `pickup_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE `cities` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `city` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `city`, `rate`, `created_at`, `updated_at`) VALUES
(2, 'cairo', '60', '2022-06-30 08:22:00', '2022-06-30 08:22:24'),
(3, 'aaa', '10', '2022-07-06 14:41:22', '2022-07-06 14:41:22');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `deliveries`
--

CREATE TABLE `deliveries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `driver_id` bigint(20) UNSIGNED NOT NULL,
  `shippment_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'اذا كانت القيمة فارغة الشحنة pickup',
  `pickup_id` bigint(20) UNSIGNED DEFAULT NULL COMMENT 'اذا كانت القيمة فارغة الشحنة shippment',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `drivers`
--

CREATE TABLE `drivers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `special_pickup` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance` double NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `drivers`
--

INSERT INTO `drivers` (`id`, `name`, `email`, `phone`, `password`, `special_pickup`, `balance`, `created_at`, `updated_at`) VALUES
(9, 'haha_driver', 'haha_driver@shipexeg.com', '05464564561', '$2y$10$SNvS4.XPx5wKOeKWvitLReF9qg9QafwGZn56E2.n1wukYURQZrWie', '15', 0, '2022-07-04 16:31:27', '2022-07-06 12:36:56'),
(10, 'pppppppp_driver', 'pppppppp_driver@shipexeg.com', '01545645644', '$2y$10$j5QWSSbEP1apFwzf2wx2nOHMUDbC3V/I.eEY.sAZbscqC4zRXIwb6', '10', 0, '2022-07-04 16:55:48', '2022-07-04 16:55:48');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `name`, `avatar`, `email`, `phone`, `password`, `created_at`, `updated_at`) VALUES
(6, 'asd_employee', NULL, 'asd_employee@shipexeg.com', '01551720391', '$2y$10$YCQRZlFL1veopDxUlidPx.Wsvn0ktAnTrYPdC7/kkjt1nySom0bZi', '2022-07-04 15:14:57', '2022-07-04 15:14:57'),
(7, 'qwe_employee', NULL, 'qwe_employee@shipexeg.com', '01155205912', '$2y$10$/M.eO95UQOyNdQi1cOFNgeUP.EMYqxsvxQLPRMeAcTO85AtC4vhQ.', '2022-07-04 15:16:25', '2022-07-04 15:16:25');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
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
(5, '2022_04_12_215559_create_admins_table', 1),
(6, '2022_04_13_143925_create_cities_table', 1),
(7, '2022_04_14_134015_create_areas_table', 1),
(8, '2022_04_17_231039_create_addresses_table', 1),
(9, '2022_04_17_231057_create_contacts_table', 1),
(10, '2022_04_19_202619_create_shippments_table', 1),
(11, '2022_04_24_200155_create_pickups_table', 1),
(12, '2022_04_28_153100_create_drivers_table', 1),
(13, '2022_04_28_225321_create_employees_table', 1),
(14, '2022_05_10_143319_create_deliveries_table', 1),
(15, '2022_05_21_175431_create_account_sellers_table', 1),
(16, '2022_05_23_124005_create_schedule_sellers_table', 1),
(17, '2022_05_25_131755_create_scheduledrivers_table', 1),
(18, '2022_05_27_145306_create_specialprices_table', 1),
(19, '2022_05_27_150650_add_special_price_to_specialprices_table', 1),
(20, '2022_05_30_105443_add_status_to_pickups_table', 1),
(21, '2022_05_30_133324_create_assignedpickups_table', 1),
(22, '2022_06_04_142227_create_trackings_table', 1),
(23, '2022_06_23_180643_create_permission_tables', 1),
(26, '2022_07_04_160753_create_shippments_histories_table', 2),
(27, '2022_07_04_161450_create_pickups_histories_table', 3),
(30, '2022_07_04_161825_create_roles_table', 4);

-- --------------------------------------------------------

--
-- Table structure for table `model_has_permissions`
--

CREATE TABLE `model_has_permissions` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `model_has_roles`
--

CREATE TABLE `model_has_roles` (
  `id` bigint(20) NOT NULL,
  `model_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `model_type` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `model_has_roles`
--

INSERT INTO `model_has_roles` (`id`, `model_id`, `role_id`, `model_type`, `created_at`, `updated_at`) VALUES
(2, 25, 1, NULL, NULL, NULL),
(3, 26, 1, NULL, NULL, NULL),
(4, 6, 3, NULL, NULL, NULL),
(5, 7, 3, NULL, NULL, NULL),
(6, 9, 2, NULL, NULL, NULL),
(7, 10, 2, NULL, NULL, NULL),
(9, 11, 2, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group_by` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `value`, `group_by`, `created_at`, `updated_at`) VALUES
(45, 'show all cities', 'cities.index', 'cities', '2022-06-30 10:49:58', '2022-06-30 10:49:58'),
(46, 'create city', 'cities.create', 'cities', '2022-06-30 10:49:58', '2022-06-30 10:49:58'),
(47, 'edit city', 'cities.edit', 'cities', '2022-06-30 10:49:58', '2022-06-30 10:49:58'),
(48, 'delete city', 'cities.destroy', 'cities', '2022-06-30 10:49:58', '2022-06-30 10:49:58'),
(49, 'show all areas', 'areas.index', 'areas', '2022-06-30 10:49:58', '2022-06-30 10:49:58'),
(50, 'create area', 'areas.create', 'areas', '2022-06-30 10:49:58', '2022-06-30 10:49:58'),
(51, 'edit area', 'areas.edit', 'areas', '2022-06-30 10:49:58', '2022-06-30 10:49:58'),
(52, 'delete area', 'areas.destroy', 'areas', '2022-06-30 10:49:58', '2022-06-30 10:49:58'),
(53, 'show all sellers', 'sellers.index', 'sellers', '2022-07-01 11:41:41', '2022-07-01 11:41:41'),
(54, 'create seller', 'sellers.create', 'sellers', '2022-07-01 11:46:47', '2022-07-01 11:46:47'),
(55, 'edit seller', 'sellers.edit', 'sellers', '2022-07-01 12:04:16', '2022-07-01 12:04:16'),
(56, 'delete seller', 'sellers.destroy', 'sellers', '2022-07-01 12:04:30', '2022-07-01 12:04:30'),
(57, 'show all shippments', 'shippments.index', 'shippments', '2022-07-01 12:04:52', '2022-07-01 12:04:52'),
(58, 'create shippment', 'shippments.create', 'shippments', '2022-07-01 12:05:22', '2022-07-01 12:05:22'),
(59, 'edit shippments', 'shippments.edit', 'shippments', '2022-07-01 12:05:39', '2022-07-01 12:05:39'),
(60, 'delete shippment', 'shippments.destroy', 'shippments', '2022-07-01 12:05:52', '2022-07-01 12:05:52'),
(61, 'show shippment', 'shippments.show', 'shippments', '2022-07-01 12:12:37', '2022-07-01 12:12:37'),
(62, 'show all assigned pickups', 'assigned_pickups.index', 'assigned pickups', '2022-07-01 13:03:06', '2022-07-01 13:03:06'),
(63, 'assign pickup', 'assigned_pickups.assign', 'assigned pickups', '2022-07-01 13:04:14', '2022-07-01 13:04:14'),
(64, 'show all roles', 'roles.index', 'roles', '2022-07-01 13:15:10', '2022-07-01 13:15:10'),
(65, 'create role', 'roles.create', 'roles', '2022-07-01 13:15:26', '2022-07-01 13:15:26'),
(66, 'edit role', 'roles.edit', 'roles', '2022-07-01 13:15:46', '2022-07-01 13:15:46'),
(67, 'delete role', 'roles.destroy', 'roles', '2022-07-01 13:16:04', '2022-07-01 13:16:04'),
(68, 'show all drivers', 'drivers.index', 'drivers', '2022-07-01 13:22:13', '2022-07-01 13:22:13'),
(69, 'create driver', 'drivers.create', 'drivers', '2022-07-01 13:22:49', '2022-07-01 13:22:49'),
(70, 'edit driver', 'drivers.edit', 'drivers', '2022-07-01 13:23:03', '2022-07-01 13:23:03'),
(71, 'delete driver', 'drivers.destroy', 'drivers', '2022-07-01 13:23:22', '2022-07-01 13:23:22'),
(72, 'show all employees', 'employees.index', 'employees', '2022-07-01 13:42:45', '2022-07-01 13:42:45'),
(73, 'create employees', 'employees.create', 'employees', '2022-07-01 13:43:05', '2022-07-01 13:43:05'),
(74, 'edit employees', 'employees.edit', 'employees', '2022-07-01 13:43:25', '2022-07-01 13:43:25'),
(75, 'delete employees', 'employees.destroy', 'employees', '2022-07-01 13:43:39', '2022-07-01 13:43:39');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pickups`
--

CREATE TABLE `pickups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `seller_settled` int(11) NOT NULL DEFAULT 0,
  `driver_settled` tinyint(1) NOT NULL DEFAULT 0,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `time` time NOT NULL,
  `date` date NOT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `package` int(11) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `address_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pickups_histories`
--

CREATE TABLE `pickups_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `pickup_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'seller', '2022-07-04 14:25:49', '2022-07-04 14:25:49'),
(2, 'driver', '2022-07-04 14:26:03', '2022-07-04 14:26:03'),
(3, 'employee', '2022-07-04 15:14:34', '2022-07-04 15:14:34');

-- --------------------------------------------------------

--
-- Table structure for table `role_has_permissions`
--

CREATE TABLE `role_has_permissions` (
  `id` bigint(20) NOT NULL,
  `role_id` bigint(11) UNSIGNED NOT NULL,
  `permission_id` bigint(11) UNSIGNED NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role_has_permissions`
--

INSERT INTO `role_has_permissions` (`id`, `role_id`, `permission_id`, `created_at`, `updated_at`) VALUES
(1, 1, 57, '2022-07-04 14:36:33', '2022-07-04 14:36:33'),
(3, 3, 45, '2022-07-04 15:14:34', '2022-07-04 15:14:34'),
(4, 3, 46, '2022-07-04 15:14:34', '2022-07-04 15:14:34'),
(5, 3, 47, '2022-07-04 15:14:34', '2022-07-04 15:14:34'),
(6, 3, 49, '2022-07-04 15:14:34', '2022-07-04 15:14:34'),
(7, 3, 50, '2022-07-04 15:14:34', '2022-07-04 15:14:34'),
(8, 3, 51, '2022-07-04 15:14:34', '2022-07-04 15:14:34'),
(9, 3, 53, '2022-07-04 15:14:34', '2022-07-04 15:14:34'),
(10, 3, 54, '2022-07-04 15:14:34', '2022-07-04 15:14:34'),
(11, 3, 55, '2022-07-04 15:14:34', '2022-07-04 15:14:34'),
(12, 3, 57, '2022-07-04 15:14:34', '2022-07-04 15:14:34'),
(13, 3, 58, '2022-07-04 15:14:34', '2022-07-04 15:14:34'),
(14, 3, 59, '2022-07-04 15:14:34', '2022-07-04 15:14:34'),
(15, 3, 61, '2022-07-04 15:14:34', '2022-07-04 15:14:34'),
(16, 3, 62, '2022-07-04 15:14:34', '2022-07-04 15:14:34'),
(17, 3, 63, '2022-07-04 15:14:34', '2022-07-04 15:14:34'),
(18, 3, 68, '2022-07-04 15:14:34', '2022-07-04 15:14:34'),
(19, 3, 69, '2022-07-04 15:14:34', '2022-07-04 15:14:34'),
(20, 3, 70, '2022-07-04 15:14:34', '2022-07-04 15:14:34'),
(21, 3, 72, '2022-07-04 15:14:34', '2022-07-04 15:14:34'),
(22, 3, 73, '2022-07-04 15:14:34', '2022-07-04 15:14:34'),
(23, 3, 74, '2022-07-04 15:14:34', '2022-07-04 15:14:34'),
(24, 2, 57, '2022-07-05 10:44:21', '2022-07-05 10:44:21'),
(25, 2, 61, '2022-07-05 10:44:21', '2022-07-05 10:44:21');

-- --------------------------------------------------------

--
-- Table structure for table `scheduledrivers`
--

CREATE TABLE `scheduledrivers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `driver_id` bigint(20) UNSIGNED NOT NULL,
  `from` date NOT NULL,
  `to` date NOT NULL,
  `total_cost` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `total_delivery_commission` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `schedule_sellers`
--

CREATE TABLE `schedule_sellers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `from` date NOT NULL,
  `to` date NOT NULL,
  `price` int(11) NOT NULL,
  `additional_price` int(11) NOT NULL DEFAULT 0,
  `costs` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shippments`
--

CREATE TABLE `shippments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shippment_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `business_referance` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `shipper` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `receiver_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `receiver_phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `allow_open` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `package_details` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `note` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT 'created',
  `barcode` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `area_id` bigint(20) UNSIGNED NOT NULL,
  `on_hold` date DEFAULT NULL,
  `seller_settled` tinyint(1) NOT NULL DEFAULT 0,
  `driver_settled` tinyint(1) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `shippments_histories`
--

CREATE TABLE `shippments_histories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `shippment_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `specialprices`
--

CREATE TABLE `specialprices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `city_id` bigint(20) UNSIGNED NOT NULL,
  `area_id` bigint(20) UNSIGNED NOT NULL,
  `special_price` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `specialprices`
--

INSERT INTO `specialprices` (`id`, `user_id`, `city_id`, `area_id`, `special_price`, `created_at`, `updated_at`) VALUES
(1, 26, 2, 3, '15', '2022-07-06 08:18:26', '2022-07-06 08:18:26'),
(2, 25, 2, 3, '90', '2022-07-06 08:20:55', '2022-07-06 08:20:55');

-- --------------------------------------------------------

--
-- Table structure for table `trackings`
--

CREATE TABLE `trackings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `shippment_id` bigint(20) UNSIGNED NOT NULL,
  `status` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `special_pickup` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `balance` double NOT NULL DEFAULT 0,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `avatar`, `email`, `phone`, `password`, `special_pickup`, `balance`, `remember_token`, `created_at`, `updated_at`) VALUES
(25, 'moza_seller', NULL, 'moza_seller@shipexeg.com', '01152059120', '$2y$10$F0QMh/ZJzR878R9qRsKpK.3hJhLWOxJlrNCcmqOVjrQJISa2sMIzW', '30', 0, NULL, '2022-07-04 15:12:44', '2022-07-06 09:20:52'),
(26, 'kareem_seller', NULL, 'kareem_seller@shipexeg.com', '01551720391', '$2y$10$z6WQ3tw2OotYA2TM2OEGqeFCTc20mAdcAaqCLblAQHf4/P0K6SNeW', '20', 0, NULL, '2022-07-04 15:13:04', '2022-07-04 15:13:04');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_sellers`
--
ALTER TABLE `account_sellers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `addresses`
--
ALTER TABLE `addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `addresses_area_id_foreign` (`area_id`),
  ADD KEY `addresses_city_id_foreign` (`city_id`),
  ADD KEY `addresses_user_id_foreign` (`user_id`);

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `areas`
--
ALTER TABLE `areas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `areas_city_id_foreign` (`city_id`);

--
-- Indexes for table `assignedpickups`
--
ALTER TABLE `assignedpickups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assignedpickups_driver_id_foreign` (`driver_id`),
  ADD KEY `assignedpickups_pickup_id_foreign` (`pickup_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `contacts_email_unique` (`email`);

--
-- Indexes for table `deliveries`
--
ALTER TABLE `deliveries`
  ADD PRIMARY KEY (`id`),
  ADD KEY `deliveries_driver_id_foreign` (`driver_id`),
  ADD KEY `shippment_id` (`shippment_id`),
  ADD KEY `pickup_id` (`pickup_id`);

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD PRIMARY KEY (`permission_id`,`model_id`,`model_type`),
  ADD KEY `model_has_permissions_model_id_model_type_index` (`model_id`,`model_type`);

--
-- Indexes for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `value` (`value`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `pickups`
--
ALTER TABLE `pickups`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pickups_address_id_foreign` (`address_id`),
  ADD KEY `pickups_user_id_foreign` (`user_id`);

--
-- Indexes for table `pickups_histories`
--
ALTER TABLE `pickups_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_id` (`permission_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `scheduledrivers`
--
ALTER TABLE `scheduledrivers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `scheduledrivers_driver_id_foreign` (`driver_id`);

--
-- Indexes for table `schedule_sellers`
--
ALTER TABLE `schedule_sellers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `schedule_sellers_user_id_foreign` (`user_id`);

--
-- Indexes for table `shippments`
--
ALTER TABLE `shippments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `shippments_area_id_foreign` (`area_id`),
  ADD KEY `shippments_city_id_foreign` (`city_id`);

--
-- Indexes for table `shippments_histories`
--
ALTER TABLE `shippments_histories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `specialprices`
--
ALTER TABLE `specialprices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `specialprices_area_id_foreign` (`area_id`),
  ADD KEY `specialprices_city_id_foreign` (`city_id`),
  ADD KEY `specialprices_user_id_foreign` (`user_id`);

--
-- Indexes for table `trackings`
--
ALTER TABLE `trackings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trackings_shippment_id_foreign` (`shippment_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_sellers`
--
ALTER TABLE `account_sellers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=63;

--
-- AUTO_INCREMENT for table `addresses`
--
ALTER TABLE `addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `areas`
--
ALTER TABLE `areas`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `assignedpickups`
--
ALTER TABLE `assignedpickups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `deliveries`
--
ALTER TABLE `deliveries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=81;

--
-- AUTO_INCREMENT for table `drivers`
--
ALTER TABLE `drivers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `model_has_roles`
--
ALTER TABLE `model_has_roles`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pickups`
--
ALTER TABLE `pickups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `pickups_histories`
--
ALTER TABLE `pickups_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `scheduledrivers`
--
ALTER TABLE `scheduledrivers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `schedule_sellers`
--
ALTER TABLE `schedule_sellers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `shippments`
--
ALTER TABLE `shippments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `shippments_histories`
--
ALTER TABLE `shippments_histories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `specialprices`
--
ALTER TABLE `specialprices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `trackings`
--
ALTER TABLE `trackings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account_sellers`
--
ALTER TABLE `account_sellers`
  ADD CONSTRAINT `account_sellers_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `addresses`
--
ALTER TABLE `addresses`
  ADD CONSTRAINT `addresses_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `addresses_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `areas`
--
ALTER TABLE `areas`
  ADD CONSTRAINT `areas_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`);

--
-- Constraints for table `assignedpickups`
--
ALTER TABLE `assignedpickups`
  ADD CONSTRAINT `assignedpickups_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `assignedpickups_pickup_id_foreign` FOREIGN KEY (`pickup_id`) REFERENCES `pickups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `deliveries`
--
ALTER TABLE `deliveries`
  ADD CONSTRAINT `deliveries_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `deliveries_ibfk_1` FOREIGN KEY (`shippment_id`) REFERENCES `shippments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `deliveries_ibfk_2` FOREIGN KEY (`pickup_id`) REFERENCES `pickups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `model_has_permissions`
--
ALTER TABLE `model_has_permissions`
  ADD CONSTRAINT `model_has_permissions_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pickups`
--
ALTER TABLE `pickups`
  ADD CONSTRAINT `pickups_address_id_foreign` FOREIGN KEY (`address_id`) REFERENCES `addresses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pickups_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_has_permissions`
--
ALTER TABLE `role_has_permissions`
  ADD CONSTRAINT `role_has_permissions_ibfk_1` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_has_permissions_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `scheduledrivers`
--
ALTER TABLE `scheduledrivers`
  ADD CONSTRAINT `scheduledrivers_driver_id_foreign` FOREIGN KEY (`driver_id`) REFERENCES `drivers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `schedule_sellers`
--
ALTER TABLE `schedule_sellers`
  ADD CONSTRAINT `schedule_sellers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `shippments`
--
ALTER TABLE `shippments`
  ADD CONSTRAINT `shippments_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `shippments_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `specialprices`
--
ALTER TABLE `specialprices`
  ADD CONSTRAINT `specialprices_area_id_foreign` FOREIGN KEY (`area_id`) REFERENCES `areas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `specialprices_city_id_foreign` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `specialprices_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `trackings`
--
ALTER TABLE `trackings`
  ADD CONSTRAINT `trackings_shippment_id_foreign` FOREIGN KEY (`shippment_id`) REFERENCES `shippments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
