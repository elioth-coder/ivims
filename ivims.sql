-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 06, 2024 at 11:29 AM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ivims`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `color` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`id`, `title`, `content`, `color`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Welcome! to IVIM System v1.0.0', 'An Integrated Vehicle Insurance Management System for the hardworking Filipinos.', 'green', 'visible', '2024-11-24 03:52:24', '2024-11-24 04:05:57'),
(4, 'Technical Support Still Not Available', 'Technical and customer support from LTO Central Office (LTMS) is still unavailable today, July 25 2024 following the work suspension of government offices due to typhoon “Carina&amp;amp;amp;quot;. We are available to service you today. However, for issues that need LTO Ticketing support, please anticipate extended turnaround time for resolution. Keep safe everyone.', 'red', 'visible', '2024-11-24 04:11:58', '2024-11-24 04:12:24');

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
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `origin` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `code`, `name`, `origin`, `email`, `phone`, `address`, `created_at`, `updated_at`) VALUES
(1, 'MICI', 'Malayan Insurance Company, Inc.', 'https://malayan.com', 'malayan@malayan.com', '+632 8242 8888', '4F Yuchengco Tower | 484 Quintin Paredes St., Binondo, Manila', '2024-11-24 05:53:15', '2024-11-24 05:53:15'),
(3, 'BPI-MSIC', 'BPI/MS Insurance Corporation', 'https://bpims.com', 'insure@bpims.com', '+632 8840 9000', '6811 BPI Philam Life Makati, Ayala Avenue, Makati City', '2024-11-24 06:12:39', '2024-11-24 06:18:25'),
(4, 'CINCOR', 'Cibeles Insurance Corporation', 'https://www.cibeles.com.ph/', 'info@cibeles.com.ph', '+632 8242-1631 to 40', '6th Floor State Centre Building, 333 Juan Luna Street, Binondo, Manila,', '2024-11-26 18:35:16', '2024-11-26 18:35:59'),
(5, 'SICI', 'Standard Insurance Company, Inc.', 'https://www.standard-insurance.com/', 'teamonline@standard-insurance.com', '+632 8845 1111', '28/F Petron MegaPlaza Bldg., #358 Sen. Gil Puyat Ave. Makati City', '2024-11-26 18:41:20', '2024-11-26 18:41:20'),
(6, 'AIA', 'AIA Philippines', 'https://www.aia.com.ph', 'customerservice.ph@aia.com', '(02) 8 528 2000', '23rd Floor 8767 AIA Tower (formerly Philam Life Tower) Paseo De Roxas,', '2024-11-26 18:43:28', '2024-11-26 18:43:28'),
(7, 'AIC', 'ALLIEDBANKERS INSURANCE CORPORATION', 'https://www.alliedbankers.com.ph/', 'info@alliedbankers.com.ph', '+632 8243-0075', '17/F FEDERAL TOWER BUILDING, DASMARIHAS STREET COR. MUELLE DE BINONDO, BINONDO, MANILA', '2024-11-29 17:16:46', '2024-11-29 17:16:46'),
(8, 'PPI', 'PHILIPPINE PRUDENTIAL INSURANCE COMPANY', 'https://www.prudential.com.ph', 'info@prudential.com.ph', '(02) 8 887 8585', '7/F MAKATI CORPORATE CENTER  AYALA AVENUE  MAKATI CITY', '2024-12-05 16:59:22', '2024-12-05 16:59:22'),
(9, 'SLI', 'SUN LIFE INSURANCE', 'https://www.sunlife.com.ph', 'service.ph@sunlife.com', '(02) 8 849 9888', '5TH FLOOR SUN LIFE CENTRE  BONIFACIO GLOBAL CITY  TAGUIG', '2024-12-05 16:59:22', '2024-12-05 16:59:22'),
(10, 'CLI', 'CARITAS LIFE INSURANCE CORPORATION', 'https://www.caritaslife.com.ph', 'helpdesk@caritaslife.com.ph', '+632 8833 1818', '3/F CARITAS BUILDING  ESPANA BOULEVARD  MANILA', '2024-12-05 16:59:23', '2024-12-05 16:59:23'),
(11, 'MPI', 'MALAYAN INSURANCE COMPANY', 'https://www.malayan.com.ph', 'customercare@malayan.com.ph', '(02) 8 878 3600', '6TH FLOOR YUCHENGCO TOWER  RCBC PLAZA  MAKATI CITY', '2024-12-05 16:59:23', '2024-12-05 16:59:23'),
(12, 'PGA', 'PGA SOMPO INSURANCE CORPORATION', 'https://www.pgasompo.com', 'contact@pgasompo.com.ph', '(02) 8 888 9999', '18/F ONE CORPORATE CENTER  ORTIGAS CENTER  PASIG CITY', '2024-12-05 16:59:24', '2024-12-05 16:59:24'),
(13, 'AXA', 'AXA PHILIPPINES', 'https://www.axa.com.ph', 'customer.service@axa.com.ph', '+632 8 581 5292', '11/F GT TOWER INTERNATIONAL  AYALA AVENUE  MAKATI CITY', '2024-12-05 16:59:24', '2024-12-05 16:59:24'),
(14, 'FPG', 'FPG INSURANCE', 'https://www.fpginsurance.com', 'info@fpginsurance.com.ph', '+632 8879 9000', '6TH FLOOR ZUELLIG BUILDING  MAKATI CITY', '2024-12-05 16:59:24', '2024-12-05 16:59:24'),
(15, 'MPIA', 'METRO PACIFIC INSURANCE AGENCY', 'https://www.mpiagency.ph', 'info@mpiagency.com.ph', '(02) 8 898 6888', '8/F MPIC BUILDING  ORTIGAS CENTER  PASIG CITY', '2024-12-05 16:59:25', '2024-12-05 16:59:25'),
(16, 'CTI', 'CEBUANA LHUILLIER INSURANCE CORPORATION', 'https://www.cebuanalhuillier.com.ph', 'claims@cebuanalhuillier.com.ph', '(02) 8 778 7000', '2/F CLC BUILDING  AYALA AVENUE  MAKATI CITY', '2024-12-05 16:59:25', '2024-12-05 16:59:25'),
(17, 'GIC', 'GENERAL INSURANCE COMPANY OF THE PHILIPPINES', 'https://www.gicph.com.ph', 'contactus@gicph.com.ph', '+632 8234 4567', '7/F PIONEER HIGHLANDS  MANDALUYONG CITY', '2024-12-05 16:59:26', '2024-12-05 16:59:26'),
(18, 'CLI2', 'COCOLIFE INSURANCE COMPANY', 'https://www.cocolife.com.ph', 'support@cocolife.com', '(02) 8 810 7888', '4/F COCOLIFE BUILDING  MAKATI AVENUE  MAKATI CITY', '2024-12-05 16:59:26', '2024-12-05 16:59:26'),
(19, 'BPI', 'BPI-MS INSURANCE CORPORATION', 'https://www.bpi-ms.com.ph', 'care@bpi-ms.com.ph', '+632 8 880 1400', '5/F BPI BUILDING  PASEO DE ROXAS  MAKATI CITY', '2024-12-05 16:59:26', '2024-12-05 16:59:26'),
(20, 'RFI', 'RELIANCE SURETY AND INSURANCE CO. INC.', 'https://www.reliance.com.ph', 'info@reliance.com.ph', '+632 8361 7440', '9/F RELIANCE TOWER  QUEZON AVENUE  QUEZON CITY', '2024-12-05 16:59:27', '2024-12-05 16:59:27'),
(21, 'APC', 'ASIA-PACIFIC INSURANCE', 'https://www.apinsurance.com.ph', 'services@apinsurance.com.ph', '(02) 8 883 1234', '6/F ASIA TOWER  LEGAZPI VILLAGE  MAKATI CITY', '2024-12-05 16:59:27', '2024-12-05 16:59:27'),
(22, 'CHI', 'CHARTER PING AN INSURANCE CORPORATION', 'https://www.charterpingan.com.ph', 'info@charterpingan.com.ph', '+632 8 849 9888', '10/F PIONEER BUILDING  PASIG CITY', '2024-12-05 16:59:28', '2024-12-05 16:59:28'),
(23, 'ICI', 'INSULAR LIFE ASSURANCE COMPANY', 'https://www.insularlife.com.ph', 'contact@insularlife.com', '(02) 8 582 1828', 'INSULAR LIFE CORPORATE CENTRE  FILINVEST CITY  ALABANG', '2024-12-05 16:59:28', '2024-12-05 16:59:28'),
(24, 'MPIB', 'MANULIFE PHILIPPINES', 'https://www.manulife.com.ph', 'phsupport@manulife.com', '+632 8884 7000', '12/F MANULIFE CENTER  AYALA AVENUE  MAKATI CITY', '2024-12-05 16:59:28', '2024-12-05 16:59:28'),
(25, 'SLP', 'ST. PETER LIFE PLAN', 'https://www.stpeter.com.ph', 'care@stpeter.com.ph', '(02) 8 923 8000', 'ST. PETER CORPORATE CENTER  QUEZON CITY', '2024-12-05 16:59:29', '2024-12-05 16:59:29');

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
(5, '2024_11_20_141751_update_users_table', 2),
(6, '2024_11_20_161756_add_role_to_users_table', 3),
(7, '2024_11_24_102801_create_announcements_table', 4),
(9, '2024_11_24_123738_create_companies_table', 5),
(11, '2024_11_24_164856_create_vehicle_premiums_table', 6),
(13, '2024_11_25_013648_create_policy_holders_table', 7),
(14, '2024_11_26_160513_create_vehicle_details_table', 8),
(16, '2024_11_26_161312_create_policy_details_table', 9),
(17, '2024_11_26_223905_create_personal_access_tokens_table', 10),
(18, '2024_12_02_125116_create_valid_ids_table', 11),
(19, '2024_12_02_134648_update_valid_ids_table', 12);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `policy_details`
--

CREATE TABLE `policy_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `coc_no` varchar(255) NOT NULL,
  `policy_no` varchar(255) NOT NULL,
  `or_no` varchar(255) NOT NULL,
  `date_issued` date NOT NULL,
  `validity` int(11) NOT NULL,
  `premium` double NOT NULL,
  `premium_code` varchar(255) NOT NULL,
  `inception_date` date NOT NULL,
  `expiry_date` date NOT NULL,
  `policy_holder_id` int(11) NOT NULL,
  `vehicle_detail_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `policy_details`
--

INSERT INTO `policy_details` (`id`, `coc_no`, `policy_no`, `or_no`, `date_issued`, `validity`, `premium`, `premium_code`, `inception_date`, `expiry_date`, `policy_holder_id`, `vehicle_detail_id`, `company_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, '1733468605181891', '1733468605181119', '1733468605181799', '2023-05-14', 3, 1610, '1', '2023-05-14', '2026-05-14', 1, 1, 1, 1, '2024-12-05 23:03:25', '2024-12-05 23:03:25'),
(2, '1733468605611951', '1733468605611204', '1733468605611668', '2023-06-23', 1, 610, '2', '2023-06-23', '2024-06-23', 2, 2, 3, 1, '2024-12-05 23:03:25', '2024-12-05 23:03:25'),
(3, '1733468605977219', '1733468605977127', '1733468605977295', '2023-08-12', 3, 3440, '3', '2023-08-12', '2026-08-12', 3, 3, 5, 1, '2024-12-05 23:03:25', '2024-12-05 23:03:25'),
(4, '1733468606388884', '1733468606388522', '1733468606388885', '2023-07-01', 1, 740, '4', '2023-07-01', '2024-07-01', 4, 4, 23, 1, '2024-12-05 23:03:26', '2024-12-05 23:03:26'),
(5, '1733468606815730', '1733468606815792', '1733468606815473', '2023-09-05', 3, 3150, '5', '2023-09-05', '2026-09-05', 5, 5, 6, 1, '2024-12-05 23:03:26', '2024-12-05 23:03:26'),
(6, '1733468607210315', '1733468607210421', '1733468607210411', '2023-11-21', 1, 1450, '6', '2023-11-21', '2024-11-21', 6, 6, 5, 1, '2024-12-05 23:03:27', '2024-12-05 23:03:27'),
(7, '1733468607609545', '1733468607609129', '1733468607609997', '2023-05-29', 1, 250, '7', '2023-05-29', '2024-05-29', 7, 7, 9, 1, '2024-12-05 23:03:27', '2024-12-05 23:03:27'),
(8, '1733468608005650', '1733468608005440', '1733468608005838', '2023-12-09', 3, 720, '8', '2023-12-09', '2026-12-09', 8, 8, 4, 1, '2024-12-05 23:03:28', '2024-12-05 23:03:28'),
(9, '1733468608405683', '1733468608405331', '1733468608405151', '2023-08-15', 1, 720, '8', '2023-08-15', '2024-08-15', 9, 9, 4, 1, '2024-12-05 23:03:28', '2024-12-05 23:03:28'),
(10, '1733468608828632', '1733468608828370', '1733468608828753', '2023-04-02', 3, 1610, '1', '2023-04-02', '2026-04-02', 10, 10, 3, 1, '2024-12-05 23:03:28', '2024-12-05 23:03:28'),
(11, '1733468609218950', '1733468609218126', '1733468609218723', '2023-10-20', 1, 610, '2', '2023-10-20', '2024-10-20', 11, 11, 3, 1, '2024-12-05 23:03:29', '2024-12-05 23:03:29'),
(12, '1733468609634803', '1733468609634872', '1733468609634167', '2023-06-25', 3, 3440, '3', '2023-06-25', '2026-06-25', 12, 12, 19, 1, '2024-12-05 23:03:29', '2024-12-05 23:03:29'),
(13, '1733468610023816', '1733468610023724', '1733468610023443', '2023-07-30', 1, 610, '2', '2023-07-30', '2024-07-30', 13, 13, 5, 1, '2024-12-05 23:03:30', '2024-12-05 23:03:30'),
(14, '1733468610416278', '1733468610416337', '1733468610416311', '2023-11-10', 3, 3440, '3', '2023-11-10', '2026-11-10', 14, 14, 4, 1, '2024-12-05 23:03:30', '2024-12-05 23:03:30'),
(15, '1733468610830887', '1733468610830929', '1733468610830132', '2023-09-16', 1, 740, '4', '2023-09-16', '2024-09-16', 15, 15, 5, 1, '2024-12-05 23:03:30', '2024-12-05 23:03:30'),
(16, '1733468611258210', '1733468611258528', '1733468611258666', '2023-12-03', 3, 3150, '5', '2023-12-03', '2026-12-03', 16, 16, 3, 1, '2024-12-05 23:03:31', '2024-12-05 23:03:31'),
(17, '1733468611682166', '1733468611682426', '1733468611682815', '2024-01-22', 1, 1450, '6', '2024-01-22', '2025-01-22', 17, 17, 5, 1, '2024-12-05 23:03:31', '2024-12-05 23:03:31'),
(18, '1733468612100473', '1733468612100910', '1733468612100762', '2023-10-13', 3, 3150, '5', '2023-10-13', '2026-10-13', 18, 18, 14, 1, '2024-12-05 23:03:32', '2024-12-05 23:03:32'),
(19, '1733468612509354', '1733468612509813', '1733468612509729', '2023-07-04', 1, 1450, '6', '2023-07-04', '2024-07-04', 19, 19, 19, 1, '2024-12-05 23:03:32', '2024-12-05 23:03:32'),
(20, '1733468612909311', '1733468612909463', '1733468612909617', '2024-03-08', 3, 3440, '3', '2024-03-08', '2027-03-08', 20, 20, 13, 1, '2024-12-05 23:03:32', '2024-12-05 23:03:32'),
(21, '1733468613323931', '1733468613323499', '1733468613323215', '2024-01-01', 1, 1200, '3', '2024-01-01', '2025-01-01', 21, 21, 5, 1, '2024-12-05 23:03:33', '2024-12-05 23:03:33'),
(22, '1733468613758356', '1733468613758762', '1733468613758928', '2023-09-22', 3, 3150, '5', '2023-09-22', '2026-09-22', 22, 22, 13, 1, '2024-12-05 23:03:33', '2024-12-05 23:03:33'),
(23, '1733468614146730', '1733468614146969', '1733468614146220', '2023-12-14', 1, 740, '4', '2023-12-14', '2024-12-14', 23, 23, 14, 1, '2024-12-05 23:03:34', '2024-12-05 23:03:34'),
(24, '1733468614530545', '1733468614530675', '1733468614530996', '2023-11-17', 3, 3150, '5', '2023-11-17', '2026-11-17', 24, 24, 19, 1, '2024-12-05 23:03:34', '2024-12-05 23:03:34'),
(25, '1733468614959551', '1733468614959502', '1733468614959569', '2023-08-18', 1, 250, '7', '2023-08-18', '2024-08-18', 25, 25, 4, 1, '2024-12-05 23:03:34', '2024-12-05 23:03:34'),
(26, '1733468615370599', '1733468615370844', '1733468615370160', '2023-05-07', 3, 720, '8', '2023-05-07', '2026-05-07', 26, 26, 5, 1, '2024-12-05 23:03:35', '2024-12-05 23:03:35'),
(27, '1733468615800126', '1733468615800830', '1733468615800393', '2023-07-19', 1, 600, '2', '2023-07-19', '2024-07-19', 27, 27, 13, 1, '2024-12-05 23:03:35', '2024-12-05 23:03:35'),
(28, '1733468616193462', '1733468616193624', '1733468616193840', '2024-02-20', 3, 2120, '4', '2024-02-20', '2027-02-20', 28, 28, 14, 1, '2024-12-05 23:03:36', '2024-12-05 23:03:36'),
(29, '1733468616613817', '1733468616613677', '1733468616613255', '2023-12-06', 1, 720, '8', '2023-12-06', '2024-12-06', 29, 29, 19, 1, '2024-12-05 23:03:36', '2024-12-05 23:03:36'),
(30, '1733468617015972', '1733468617015867', '1733468617015669', '2023-06-12', 3, 2120, '4', '2023-06-12', '2026-06-12', 30, 30, 14, 1, '2024-12-05 23:03:37', '2024-12-05 23:03:37');

-- --------------------------------------------------------

--
-- Table structure for table `policy_holders`
--

CREATE TABLE `policy_holders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `id_type` varchar(255) NOT NULL,
  `id_number` varchar(255) NOT NULL,
  `business` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `suffix` varchar(255) DEFAULT NULL,
  `gender` varchar(255) NOT NULL,
  `birthday` date NOT NULL,
  `address` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contact_no` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `policy_holders`
--

INSERT INTO `policy_holders` (`id`, `id_type`, `id_number`, `business`, `first_name`, `middle_name`, `last_name`, `suffix`, `gender`, `birthday`, `address`, `email`, `contact_no`, `created_at`, `updated_at`) VALUES
(1, 'PASSPORT ID', 'P123456789', 'SOFTWARE ENGINEER', 'ALBERT', 'NULL', 'SANTOS', 'NULL', 'MALE', '1990-01-15', 'QUEZON CITY  MANILA', 'albert.santos@gmail.com', '0917 123 4567', '2024-12-05 22:21:21', '2024-12-05 22:21:21'),
(2, 'SSS ID', '34-5678901-9', 'GRAPHIC DESIGNER', 'BEA', 'NULL', 'GARCIA', 'NULL', 'FEMALE', '1995-06-25', 'CEBU CITY  CEBU', 'bea.garcia@gmail.com', '0921 456 7890', '2024-12-05 22:21:21', '2024-12-05 22:21:21'),
(3, 'UMID ID', '0012-3456789-0', 'ARCHITECT', 'CARLOS', 'NULL', 'DEL ROSARIO', 'NULL', 'MALE', '1984-03-12', 'SAN FERNANDO  PAMPANGA', 'carlos.rosario@gmail.com', '0936 789 1234', '2024-12-05 22:21:21', '2024-12-05 22:21:21'),
(4, 'DRIVER LICENSE', 'N08-21-987654', 'TEACHER', 'DIANA', 'NULL', 'CRUZ', 'NULL', 'FEMALE', '1988-12-05', 'ANGELES CITY  PAMPANGA', 'diana.cruz@gmail.com', '0942 321 6549', '2024-12-05 22:21:22', '2024-12-05 22:21:22'),
(5, 'TIN ID', '111-222-333-444', 'ACCOUNTANT', 'ELAINE', 'NULL', 'RAMOS', 'NULL', 'FEMALE', '1993-07-18', 'PASIG CITY  MANILA', 'elaine.ramos@gmail.com', '0998 111 2222', '2024-12-05 22:21:22', '2024-12-05 22:21:22'),
(6, 'PASSPORT ID', 'P987654321', 'BANKER', 'FRANCIS', 'NULL', 'TAN', 'NULL', 'MALE', '1981-09-23', 'MARIKINA CITY  MANILA', 'francis.tan@gmail.com', '0918 654 7894', '2024-12-05 22:21:23', '2024-12-05 22:21:23'),
(7, 'SSS ID', '55-6789012-3', 'MECHANICAL ENGINEER', 'GABRIEL', 'NULL', 'LEE', 'NULL', 'MALE', '1996-02-03', 'ILOILO CITY  ILOILO', 'gabriel.lee@gmail.com', '0907 345 7896', '2024-12-05 22:21:23', '2024-12-05 22:21:23'),
(8, 'DRIVER LICENSE', 'M09-12-123789', 'ENTREPRENEUR', 'HANNAH', 'NULL', 'CHUA', 'NULL', 'FEMALE', '1994-08-17', 'TAGUIG CITY  MANILA', 'hannah.chua@gmail.com', '0923 456 7890', '2024-12-05 22:21:24', '2024-12-05 22:21:24'),
(9, 'TIN ID', '789-456-123-000', 'BUSINESS OWNER', 'IVAN', 'NULL', 'GUTIERREZ', 'NULL', 'MALE', '1987-11-02', 'CALOOCAN CITY  MANILA', 'ivan.gutierrez@gmail.com', '0978 111 8888', '2024-12-05 22:21:24', '2024-12-05 22:21:24'),
(10, 'UMID ID', '0023-4567891-1', 'CIVIL ENGINEER', 'JAMES', 'NULL', 'MONTECLARO', 'NULL', 'MALE', '1992-05-30', 'SAN PABLO  LAGUNA', 'james.monteclaro@gmail.com', '0916 222 4444', '2024-12-05 22:21:24', '2024-12-05 22:21:24'),
(11, 'PASSPORT ID', 'P123987456', 'DATA ANALYST', 'KAREN', 'NULL', 'FLORES', 'NULL', 'FEMALE', '1985-04-12', 'BACOLOD CITY  NEGROS', 'karen.flores@gmail.com', '0945 678 9123', '2024-12-05 22:21:25', '2024-12-05 22:21:25'),
(12, 'SSS ID', '11-2223456-0', 'NURSE', 'LARA', 'NULL', 'MARTINEZ', 'NULL', 'FEMALE', '1989-10-10', 'DAGUPAN CITY  PANGASINAN', 'lara.martinez@gmail.com', '0908 111 5678', '2024-12-05 22:21:25', '2024-12-05 22:21:25'),
(13, 'DRIVER LICENSE', 'A01-15-654321', 'PILOT', 'MIGUEL', 'NULL', 'SANTIAGO', 'NULL', 'MALE', '1980-06-14', 'GENERAL SANTOS CITY', 'miguel.santiago@gmail.com', '0928 999 8888', '2024-12-05 22:21:26', '2024-12-05 22:21:26'),
(14, 'TIN ID', '321-654-987-000', 'CHEF', 'NATALIE', 'NULL', 'TORRES', 'NULL', 'FEMALE', '1997-03-03', 'CAGAYAN DE ORO  MISAMIS ORIENTAL', 'natalie.torres@gmail.com', '0917 333 7777', '2024-12-05 22:21:26', '2024-12-05 22:21:26'),
(15, 'UMID ID', '0034-5678912-2', 'LAWYER', 'OLIVER', 'NULL', 'BALTAZAR', 'NULL', 'MALE', '1983-07-22', 'VIGAN CITY  ILOCOS SUR', 'oliver.baltazar@gmail.com', '0938 444 6666', '2024-12-05 22:21:26', '2024-12-05 22:21:26'),
(16, 'PASSPORT ID', 'P654987321', 'FINANCIAL ANALYST', 'PAMELA', 'NULL', 'SALVADOR', 'NULL', 'FEMALE', '1990-12-13', 'ZAMBOANGA CITY', 'pamela.salvador@gmail.com', '0921 555 3333', '2024-12-05 22:21:27', '2024-12-05 22:21:27'),
(17, 'SSS ID', '77-8901234-5', 'REAL ESTATE AGENT', 'QUINN', 'NULL', 'FERRER', 'NULL', 'MALE', '1995-01-19', 'CAVITE CITY  CAVITE', 'quinn.ferrer@gmail.com', '0914 777 2222', '2024-12-05 22:21:27', '2024-12-05 22:21:27'),
(18, 'DRIVER LICENSE', 'B02-18-876543', 'EVENT PLANNER', 'ROSIE', 'NULL', 'VILLANUEVA', 'NULL', 'FEMALE', '1998-09-16', 'BATANGAS CITY  BATANGAS', 'rosie.villanueva@gmail.com', '0947 444 9999', '2024-12-05 22:21:28', '2024-12-05 22:21:28'),
(19, 'TIN ID', '654-789-321-000', 'PHARMACIST', 'SAMUEL', 'NULL', 'BARRIOS', 'NULL', 'MALE', '1986-05-25', 'MANDAUE CITY  CEBU', 'samuel.barrios@gmail.com', '0926 333 5555', '2024-12-05 22:21:28', '2024-12-05 22:21:28'),
(20, 'UMID ID', '0045-6789123-3', 'SOFTWARE DEVELOPER', 'TINA', 'NULL', 'OCAMPO', 'NULL', 'FEMALE', '1992-02-21', 'TUGUEGARAO CITY  CAGAYAN', 'tina.ocampo@gmail.com', '0933 555 4444', '2024-12-05 22:21:29', '2024-12-05 22:21:29'),
(21, 'PASSPORT ID', 'P987123654', 'TELEVISION PRODUCER', 'URIEL', 'NULL', 'BAUTISTA', 'NULL', 'MALE', '1984-11-11', 'BAGUIO CITY  BENGUET', 'uriel.bautista@gmail.com', '0915 222 6666', '2024-12-05 22:21:29', '2024-12-05 22:21:29'),
(22, 'SSS ID', '88-9012345-6', 'PHOTOGRAPHER', 'VERONICA', 'NULL', 'LIM', 'NULL', 'FEMALE', '1996-08-08', 'ZAMBOANGA DEL NORTE', 'veronica.lim@gmail.com', '0915 212 6786', '2024-12-05 22:21:29', '2024-12-05 22:21:29'),
(23, 'DRIVER LICENSE', 'C03-21-123987', 'DIGITAL MARKETER', 'WARREN', 'NULL', 'VELASCO', 'NULL', 'MALE', '1990-04-30', 'LEGAZPI CITY  ALBAY', 'warren.velasco@gmail.com', '0935 777 8888', '2024-12-05 22:21:30', '2024-12-05 22:21:30'),
(24, 'TIN ID', '123-456-789-000', 'CONTENT CREATOR', 'XAVIER', 'NULL', 'YULO', 'NULL', 'MALE', '1993-12-02', 'ILOILO CITY  ILOILO', 'xavier.yulo@gmail.com', '0912 555 9999', '2024-12-05 22:21:30', '2024-12-05 22:21:30'),
(25, 'UMID ID', '0056-7891234-4', 'VETERINARIAN', 'YVONNE', 'NULL', 'ZAMORA', 'NULL', 'FEMALE', '1988-03-20', 'SAN JOSE  NUEVA ECIJA', 'yvonne.zamora@gmail.com', '0943 222 3333', '2024-12-05 22:21:31', '2024-12-05 22:21:31'),
(26, 'PASSPORT ID', 'P321654987', 'RESEARCHER', 'ZACHARY', 'NULL', 'NAVARRO', 'NULL', 'MALE', '1991-07-14', 'SORSOGON CITY  SORSOGON', 'zachary.navarro@gmail.com', '0919 999 2222', '2024-12-05 22:21:31', '2024-12-05 22:21:31'),
(27, 'SSS ID', '99-0123456-7', 'PUBLIC RELATIONS MANAGER', 'AMANDA', 'NULL', 'ORTIZ', 'NULL', 'FEMALE', '1984-10-09', 'BACOOR  CAVITE', 'amanda.ortiz@gmail.com', '0934 444 9999', '2024-12-05 22:21:31', '2024-12-05 22:21:31'),
(28, 'DRIVER LICENSE', 'D04-24-654789', 'FITNESS TRAINER', 'BRYAN', 'NULL', 'PALMA', 'NULL', 'MALE', '1986-06-22', 'NAGA CITY  CAMARINES SUR', 'bryan.palma@gmail.com', '0910 777 1111', '2024-12-05 22:21:32', '2024-12-05 22:21:32'),
(29, 'TIN ID', '987-654-321-000', 'ARTIST', 'CARLA', 'NULL', 'SISON', 'NULL', 'FEMALE', '1999-05-08', 'TACLOBAN CITY  LEYTE', 'carla.sison@gmail.com', '0911 222 9999', '2024-12-05 22:21:32', '2024-12-05 22:21:32'),
(30, 'UMID ID', '0067-8912345-5', 'POLICE OFFICER', 'DEXTER', 'NULL', 'PEREZ', 'NULL', 'MALE', '1983-11-07', 'SAN FERNANDO  LA UNION', 'dexter.perez@gmail.com', '0917 111 8888', '2024-12-05 22:21:33', '2024-12-05 22:21:33');

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
('fAoex0MxCp9wszzrXl8nsJtvR3aKZz6jPA4SUXbD', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36', 'YTo0OntzOjY6Il90b2tlbiI7czo0MDoia0R3NW5pNlBQa1ZwMWZyQUZVYkprUmNqSVNWWk5md2dWSWtna21YeiI7czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDM6Imh0dHA6Ly9sb2NhbGhvc3Q6MzAwMC9hdXRoZW50aWNhdGlvbi9jcmVhdGUiO31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1733478627),
('hwLZw5k3jQbgUMn6l4rbAvAkTWTpFldLaEmXtYKu', 1, '127.0.0.1', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:133.0) Gecko/20100101 Firefox/133.0', 'YTo1OntzOjY6Il90b2tlbiI7czo0MDoiWlcwcldRRXZuVkZVRGRYelBrS1VDWXR0UEZjTEtqQVBmQzNaaG0xQyI7czozOiJ1cmwiO2E6MTp7czo4OiJpbnRlbmRlZCI7czozODoiaHR0cDovL2xvY2FsaG9zdDozMDAwL3NldHRpbmcvdmFsaWRfaWQiO31zOjk6Il9wcmV2aW91cyI7YToxOntzOjM6InVybCI7czo1OToiaHR0cDovL2xvY2FsaG9zdDozMDAwL2F1dG9maWxsL3BvbGljeV9ob2xkZXIvMDAxMi0zNDU2Nzg5LTAiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX1zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO30=', 1733473745);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role` varchar(255) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `contact_no` varchar(255) DEFAULT NULL,
  `birthday` date NOT NULL,
  `gender` varchar(255) NOT NULL,
  `suffix` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role`, `company_id`, `contact_no`, `birthday`, `gender`, `suffix`, `last_name`, `middle_name`, `first_name`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 1, '0969 470 8031', '1994-06-16', 'male', NULL, 'Barker', '', 'Elioth', 'Elioth Barker', 'elioth.barker@gmail.com', NULL, '$2y$12$zcPJE7rJSVLEzKz8YkG4ue6Y6hteFhQV2EoqJMIrxD01lXxXqR8w.', NULL, '2024-11-20 14:41:44', '2024-11-20 14:41:44'),
(2, 'agent', 3, '0969 470 8031', '1994-06-16', 'male', NULL, 'Coder', NULL, 'Elioth', 'Elioth Coder', 'elioth.coder@gmail.com', NULL, '$2y$12$th7RSSbFaoOV1ula.siQz.wdIzTXhNtvqbrpDfaHBy2Hzrg40M526', NULL, '2024-11-24 07:34:20', '2024-11-24 07:34:20'),
(5, 'agent', 7, '0969 470 8031', '1994-06-16', 'MALE', NULL, 'PEÑA', NULL, 'CHRISTIAN', 'CHRISTIAN PEñA', 'christian940616@gmail.com', NULL, '$2y$12$DfY5DMzYysaNnZmxvwH5jefUG/Fv96NxzGbgMVtkNs6rFKlBX66/e', NULL, '2024-11-29 17:28:09', '2024-11-29 17:28:45');

-- --------------------------------------------------------

--
-- Table structure for table `valid_ids`
--

CREATE TABLE `valid_ids` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `valid_ids`
--

INSERT INTO `valid_ids` (`id`, `code`, `description`, `created_at`, `updated_at`) VALUES
(1, 'SSS ID', 'ID ISSUED BY SOCIAL SECURITY SYSTEM', '2024-12-02 05:07:41', '2024-12-02 05:53:49'),
(2, 'PHILHEALTH ID', 'ID ISSUED BY PHILIPPINE HEALTH INSURANCE CORPORATION', '2024-12-02 05:13:44', '2024-12-02 05:53:59'),
(3, 'TIN ID', 'ID ISSUED BY BUREAU OF INTERNAL REVENUE', '2024-12-02 05:14:18', '2024-12-02 05:53:39'),
(4, 'DRIVER LICENSE', 'ID ISSUED BY LAND TRANSPORTATION OFFICE', '2024-12-02 05:39:29', '2024-12-02 05:55:19'),
(5, 'UMID ID', 'UNIFIED MULTI-PURPOSE ID', '2024-12-05 21:12:52', '2024-12-05 21:12:52');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_details`
--

CREATE TABLE `vehicle_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mv_file_no` varchar(255) DEFAULT NULL,
  `plate_no` varchar(255) DEFAULT NULL,
  `serial_no` varchar(255) NOT NULL,
  `motor_no` varchar(255) NOT NULL,
  `make` varchar(255) NOT NULL,
  `model` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL,
  `body_type` varchar(255) NOT NULL,
  `authorized_cap` int(11) NOT NULL,
  `unladen_weight` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicle_details`
--

INSERT INTO `vehicle_details` (`id`, `mv_file_no`, `plate_no`, `serial_no`, `motor_no`, `make`, `model`, `color`, `body_type`, `authorized_cap`, `unladen_weight`, `created_at`, `updated_at`) VALUES
(1, '1301-0001462575', 'ZXD5821', '2A4GM68426R668321', '48FD8923', 'TOYOTA', 'FORTUNER 2020', 'BLACK', 'SUV', 2500, 1800, '2024-12-05 22:20:16', '2024-12-05 22:20:16'),
(2, '1301-0001462576', 'XFR1723', '1FMZU63K73UB12345', '53ME4824', 'MITSUBISHI', 'MONTERO 2019', 'WHITE', 'SUV', 2700, 2000, '2024-12-05 22:20:16', '2024-12-05 22:20:16'),
(3, '1301-0001462577', 'MLR0924', 'JA4GJ31EX8U805432', '67KD1231', 'HYUNDAI', 'ACCENT 2018', 'SILVER', 'SEDAN', 1300, 900, '2024-12-05 22:20:17', '2024-12-05 22:20:17'),
(4, '1301-0001462578', 'KDP3812', '5LMFU28RX3LJ03235', '48H7G112', 'SUZUKI', 'SWIFT 2021', 'BLUE', 'HATCHBACK', 1500, 950, '2024-12-05 22:20:17', '2024-12-05 22:20:17'),
(5, '1301-0001462579', 'PQM4782', 'WDB1234561A832123', '64SME854', 'FORD', 'RANGER 2020', 'GREEN', 'PICK-UP TRUCK', 2600, 2150, '2024-12-05 22:20:17', '2024-12-05 22:20:17'),
(6, '1301-0001462580', 'LHD9832', 'WAUZZZ4FX8N012345', '54H8G214', 'ISUZU', 'D-MAX 2019', 'RED', 'PICK-UP TRUCK', 2800, 2200, '2024-12-05 22:20:18', '2024-12-05 22:20:18'),
(7, '1301-0001462581', 'RTC3124', 'WVWZZZ3CZ8E123456', '41FD7342', 'KIA', 'SPORTAGE 2020', 'GREY', 'SUV', 2450, 1750, '2024-12-05 22:20:18', '2024-12-05 22:20:18'),
(8, '1301-0001462582', 'FHR8531', 'VF31BXHL612345678', '52KD3127', 'HONDA', 'CIVIC 2022', 'BLUE', 'SEDAN', 1250, 890, '2024-12-05 22:20:19', '2024-12-05 22:20:19'),
(9, '1301-0001462583', 'JNK0984', '1HGCM82633A123456', '63SME582', 'TOYOTA', 'COROLLA 2019', 'SILVER', 'SEDAN', 1350, 910, '2024-12-05 22:20:19', '2024-12-05 22:20:19'),
(10, '1301-0001462584', 'XBC3725', '3FAHP08177R123456', '56G9H128', 'FORD', 'ESCAPE 2021', 'BLACK', 'SUV', 2400, 1900, '2024-12-05 22:20:19', '2024-12-05 22:20:19'),
(11, '1301-0001462585', 'QWR4932', '4S4BP61C287311234', '61KJ7423', 'NISSAN', 'ALMERA 2020', 'WHITE', 'SEDAN', 1200, 850, '2024-12-05 22:20:20', '2024-12-05 22:20:20'),
(12, '1301-0001462586', 'MNB6321', '3LNHL2GCXDR121321', '65FD8421', 'MITSUBISHI', 'XPANDER 2019', 'RED', 'HATCHBACK', 1400, 980, '2024-12-05 22:20:20', '2024-12-05 22:20:20'),
(13, '1301-0001462587', 'ZDF7843', '1FM5K8D81GGA12345', '48GK5427', 'HYUNDAI', 'TUCSON 2020', 'GREEN', 'SUV', 2550, 2100, '2024-12-05 22:20:21', '2024-12-05 22:20:21'),
(14, '1301-0001462588', 'KLO9742', '1B7GL22X1YS781234', '57SME9732', 'FORD', 'EVEREST 2021', 'BLUE', 'PICK-UP TRUCK', 2700, 2250, '2024-12-05 22:20:21', '2024-12-05 22:20:21'),
(15, '1301-0001462589', 'NHV8234', '2HGFB2F52DH123456', '52KD0981', 'TOYOTA', 'WIGO 2020', 'ORANGE', 'HATCHBACK', 1100, 720, '2024-12-05 22:20:21', '2024-12-05 22:20:21'),
(16, '1301-0001462590', 'QRT9842', 'WBA3A9C52EF123456', '64KD8712', 'SUZUKI', 'ERTIGA 2020', 'SILVER', 'MPV', 1800, 1400, '2024-12-05 22:20:22', '2024-12-05 22:20:22'),
(17, '1301-0001462591', 'PXC8745', '1D7HU18D92J123456', '49FD7423', 'ISUZU', 'MU-X 2021', 'BLACK', 'SUV', 2600, 2150, '2024-12-05 22:20:22', '2024-12-05 22:20:22'),
(18, '1301-0001462592', 'FYT1098', '2FMDK3GC6DB123456', '67GK8943', 'KIA', 'SORENTO 2022', 'WHITE', 'SUV', 2450, 1700, '2024-12-05 22:20:23', '2024-12-05 22:20:23'),
(19, '1301-0001462593', 'OTN4573', 'WDC1631542X123456', '48KD0924', 'HONDA', 'JAZZ 2021', 'BLUE', 'HATCHBACK', 1250, 870, '2024-12-05 22:20:23', '2024-12-05 22:20:23'),
(20, '1301-0001462594', 'NPX1938', 'WBAFR7C52FD123456', '53SME3471', 'TOYOTA', 'HILUX 2022', 'GREY', 'PICK-UP TRUCK', 2800, 2300, '2024-12-05 22:20:23', '2024-12-05 22:20:23'),
(21, '1301-0001462595', 'LQP9843', '1HGCM82633A812345', '54FD9231', 'HYUNDAI', 'SANTAFE 2018', 'RED', 'SUV', 2500, 2000, '2024-12-05 22:20:24', '2024-12-05 22:20:24'),
(22, '1301-0001462596', 'MZC5482', 'JN1AZ4EH2DM812345', '63KD4723', 'NISSAN', 'X-TRAIL 2019', 'WHITE', 'SUV', 2600, 2100, '2024-12-05 22:20:24', '2024-12-05 22:20:24'),
(23, '1301-0001462597', 'ZWD1038', 'WDDGF8AB2DR123456', '52SME8624', 'MITSUBISHI', 'LANCER 2020', 'SILVER', 'SEDAN', 1400, 940, '2024-12-05 22:20:25', '2024-12-05 22:20:25'),
(24, '1301-0001462598', 'FPL8724', '1D7RV1CT4BS123456', '68GK4371', 'FORD', 'EXPEDITION 2022', 'BLACK', 'SUV', 3000, 2500, '2024-12-05 22:20:25', '2024-12-05 22:20:25'),
(25, '1301-0001462599', 'HJR3287', '2T1BU4EE9BC812345', '45KD7932', 'HONDA', 'CR-V 2021', 'BLUE', 'SUV', 2600, 2200, '2024-12-05 22:20:25', '2024-12-05 22:20:25'),
(26, '1301-0001462600', 'MBX4839', 'JM3ER2B51B8123456', '42SME9241', 'SUZUKI', 'CIAZ 2019', 'GREEN', 'SEDAN', 1350, 920, '2024-12-05 22:20:26', '2024-12-05 22:20:26'),
(27, '1301-0001462601', 'XPW3972', 'WDCYC3HF6HX123456', '67FD9032', 'KIA', 'RIO 2020', 'SILVER', 'HATCHBACK', 1300, 900, '2024-12-05 22:20:26', '2024-12-05 22:20:26'),
(28, '1301-0001462602', 'LNV8274', '4T1BG22K81U123456', '64SME2037', 'NISSAN', 'PATROL 2019', 'GOLD', 'PICK-UP TRUCK', 2750, 2200, '2024-12-05 22:20:27', '2024-12-05 22:20:27'),
(29, '1301-0001462603', 'OZB2937', '1FMCU0GX7EUB12345', '41FD6321', 'TOYOTA', 'CAMRY 2022', 'BLACK', 'SEDAN', 1250, 860, '2024-12-05 22:20:27', '2024-12-05 22:20:27'),
(30, '1301-0001462604', 'ZNL4823', 'JH4KA4530NC123456', '54SME8742', 'FORD', 'FOCUS 2021', 'BLUE', 'HATCHBACK', 1450, 980, '2024-12-05 22:20:27', '2024-12-05 22:20:27'),
(31, '1301-0001462605', 'FQR5721', 'JHMBB6240WC812345', '63KD0298', 'HONDA', 'CITY 2021', 'WHITE', 'SEDAN', 1200, 830, '2024-12-05 22:20:28', '2024-12-05 22:20:28');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_premiums`
--

CREATE TABLE `vehicle_premiums` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `one_year` double NOT NULL,
  `three_years` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vehicle_premiums`
--

INSERT INTO `vehicle_premiums` (`id`, `code`, `type`, `one_year`, `three_years`, `created_at`, `updated_at`) VALUES
(1, '1', 'Private Cars (including jeeps and AUVs)', 560, 1610, '2024-11-24 09:26:18', '2024-11-24 09:26:18'),
(3, '2', 'Light Medium Trucks (Own Goods) Not over 3,930 kgs.', 610, 1750, '2024-11-24 09:28:20', '2024-11-24 09:39:06'),
(4, '3', 'Heavy Trucks (Own Good), Private Buses over 3,930 kgs.', 1200, 3440, '2024-11-24 09:41:16', '2024-11-24 09:41:16'),
(5, '4', 'AC and Tourists Cars', 740, 2120, '2024-11-24 09:41:41', '2024-11-24 09:41:41'),
(6, '5', 'Taxi, PUJ and Mini bus', 1100, 3150, '2024-11-24 09:42:00', '2024-11-24 09:42:00'),
(7, '6', 'PUB and Tourists Bus', 1450, 4150, '2024-11-24 09:42:23', '2024-11-24 09:42:23'),
(8, '7', 'Motorcycles/Tricycles/Trailers', 250, 720, '2024-11-24 09:42:48', '2024-11-24 09:42:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `companies_code_unique` (`code`),
  ADD UNIQUE KEY `companies_name_unique` (`name`);

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
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `policy_details`
--
ALTER TABLE `policy_details`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `policy_details_coc_no_unique` (`coc_no`),
  ADD UNIQUE KEY `policy_details_policy_no_unique` (`policy_no`),
  ADD UNIQUE KEY `policy_details_or_no_unique` (`or_no`);

--
-- Indexes for table `policy_holders`
--
ALTER TABLE `policy_holders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `valid_ids`
--
ALTER TABLE `valid_ids`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `valid_ids_code_unique` (`code`);

--
-- Indexes for table `vehicle_details`
--
ALTER TABLE `vehicle_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_premiums`
--
ALTER TABLE `vehicle_premiums`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `vehicle_premiums_code_unique` (`code`),
  ADD UNIQUE KEY `vehicle_premiums_type_unique` (`type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `policy_details`
--
ALTER TABLE `policy_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `policy_holders`
--
ALTER TABLE `policy_holders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `valid_ids`
--
ALTER TABLE `valid_ids`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `vehicle_details`
--
ALTER TABLE `vehicle_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `vehicle_premiums`
--
ALTER TABLE `vehicle_premiums`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
