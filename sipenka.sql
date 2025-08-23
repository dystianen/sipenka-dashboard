-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 23, 2025 at 11:56 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sipenka`
--

-- --------------------------------------------------------

--
-- Table structure for table `ahp_normalizations`
--

CREATE TABLE `ahp_normalizations` (
  `ahp_normalization_id` int(11) UNSIGNED NOT NULL,
  `ahp_result_id` int(11) UNSIGNED NOT NULL,
  `criteria_id_row` int(11) UNSIGNED NOT NULL,
  `criteria_id_col` int(11) UNSIGNED NOT NULL,
  `normalized_value` double NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `ahp_normalizations`
--

INSERT INTO `ahp_normalizations` (`ahp_normalization_id`, `ahp_result_id`, `criteria_id_row`, `criteria_id_col`, `normalized_value`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 1, 0.9, '2025-08-23 09:17:08', '2025-08-23 09:17:08', NULL),
(2, 1, 1, 2, 0.9, '2025-08-23 09:17:08', '2025-08-23 09:17:08', NULL),
(3, 1, 2, 1, 0.1, '2025-08-23 09:17:08', '2025-08-23 09:17:08', NULL),
(4, 1, 2, 2, 0.1, '2025-08-23 09:17:08', '2025-08-23 09:17:08', NULL),
(5, 2, 1, 1, 0.9, '2025-08-23 09:18:19', '2025-08-23 09:18:19', NULL),
(6, 2, 1, 2, 0.9, '2025-08-23 09:18:19', '2025-08-23 09:18:19', NULL),
(7, 2, 2, 1, 0.1, '2025-08-23 09:18:19', '2025-08-23 09:18:19', NULL),
(8, 2, 2, 2, 0.1, '2025-08-23 09:18:19', '2025-08-23 09:18:19', NULL),
(9, 3, 1, 1, 0.9, '2025-08-23 09:19:31', '2025-08-23 09:19:31', NULL),
(10, 3, 1, 2, 0.9, '2025-08-23 09:19:31', '2025-08-23 09:19:31', NULL),
(11, 3, 2, 1, 0.1, '2025-08-23 09:19:31', '2025-08-23 09:19:31', NULL),
(12, 3, 2, 2, 0.1, '2025-08-23 09:19:31', '2025-08-23 09:19:31', NULL),
(13, 4, 1, 1, 0.9, '2025-08-23 09:21:42', '2025-08-23 09:21:42', NULL),
(14, 4, 1, 2, 0.9, '2025-08-23 09:21:42', '2025-08-23 09:21:42', NULL),
(15, 4, 2, 1, 0.1, '2025-08-23 09:21:42', '2025-08-23 09:21:42', NULL),
(16, 4, 2, 2, 0.1, '2025-08-23 09:21:42', '2025-08-23 09:21:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ahp_results`
--

CREATE TABLE `ahp_results` (
  `ahp_result_id` int(11) UNSIGNED NOT NULL,
  `period_id` int(11) UNSIGNED NOT NULL,
  `calculated_by` int(11) UNSIGNED NOT NULL,
  `weights` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`weights`)),
  `lambda_max` double DEFAULT NULL,
  `ci` double DEFAULT NULL,
  `consistency_ratio` double DEFAULT NULL,
  `is_valid` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `ahp_results`
--

INSERT INTO `ahp_results` (`ahp_result_id`, `period_id`, `calculated_by`, `weights`, `lambda_max`, `ci`, `consistency_ratio`, `is_valid`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 4, 1, '{\"1\":0.8999999999999999,\"2\":0.1}', NULL, NULL, NULL, 1, '2025-08-23 09:17:08', '2025-08-23 09:17:08', NULL),
(2, 4, 1, '{\"1\":0.8999999999999999,\"2\":0.1}', NULL, NULL, NULL, 1, '2025-08-23 09:18:19', '2025-08-23 09:18:19', NULL),
(3, 4, 1, '{\"1\":0.8999999999999999,\"2\":0.1}', NULL, NULL, NULL, 1, '2025-08-23 09:19:31', '2025-08-23 09:19:31', NULL),
(4, 4, 1, '{\"1\":0.8999999999999999,\"2\":0.1}', NULL, NULL, NULL, 1, '2025-08-23 09:21:42', '2025-08-23 09:21:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ahp_weights`
--

CREATE TABLE `ahp_weights` (
  `ahp_weight_id` int(11) UNSIGNED NOT NULL,
  `ahp_result_id` int(11) UNSIGNED NOT NULL,
  `criteria_id` int(11) UNSIGNED NOT NULL,
  `weight` double NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `ahp_weights`
--

INSERT INTO `ahp_weights` (`ahp_weight_id`, `ahp_result_id`, `criteria_id`, `weight`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 0.9, '2025-08-23 09:17:08', '2025-08-23 09:17:08', NULL),
(2, 1, 2, 0.1, '2025-08-23 09:17:08', '2025-08-23 09:17:08', NULL),
(3, 2, 1, 0.9, '2025-08-23 09:18:19', '2025-08-23 09:18:19', NULL),
(4, 2, 2, 0.1, '2025-08-23 09:18:19', '2025-08-23 09:18:19', NULL),
(5, 3, 1, 0.9, '2025-08-23 09:19:31', '2025-08-23 09:19:31', NULL),
(6, 3, 2, 0.1, '2025-08-23 09:19:31', '2025-08-23 09:19:31', NULL),
(7, 4, 1, 0.9, '2025-08-23 09:21:42', '2025-08-23 09:21:42', NULL),
(8, 4, 2, 0.1, '2025-08-23 09:21:42', '2025-08-23 09:21:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `evaluation_results`
--

CREATE TABLE `evaluation_results` (
  `evaluation_id` int(11) UNSIGNED NOT NULL,
  `teacher_id` int(11) UNSIGNED NOT NULL,
  `ahp_result_id` int(11) UNSIGNED NOT NULL,
  `period_id` int(11) UNSIGNED NOT NULL,
  `rank` int(100) NOT NULL,
  `final_score` float NOT NULL,
  `normalized_score` float NOT NULL,
  `category` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `evaluation_results`
--

INSERT INTO `evaluation_results` (`evaluation_id`, `teacher_id`, `ahp_result_id`, `period_id`, `rank`, `final_score`, `normalized_score`, `category`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 4, 1, 4, 1, 2.8, 0, '', '2025-08-23 09:17:08', '2025-08-23 09:21:42', '2025-08-23 09:21:42'),
(2, 2, 1, 4, 2, 2.5225, 0, '', '2025-08-23 09:17:08', '2025-08-23 09:21:42', '2025-08-23 09:21:42'),
(3, 1, 1, 4, 3, 2.265, 0, '', '2025-08-23 09:17:08', '2025-08-23 09:21:42', '2025-08-23 09:21:42'),
(4, 3, 1, 4, 4, 1.9325, 0, '', '2025-08-23 09:17:08', '2025-08-23 09:21:42', '2025-08-23 09:21:42'),
(5, 4, 4, 4, 1, 2.8, 100, 'Amat Baik (AB)', '2025-08-23 09:21:42', '2025-08-23 09:21:42', NULL),
(6, 2, 4, 4, 2, 2.5225, 90.09, 'Amat Baik (AB)', '2025-08-23 09:21:42', '2025-08-23 09:21:42', NULL),
(7, 1, 4, 4, 3, 2.265, 80.89, 'Baik (B)', '2025-08-23 09:21:42', '2025-08-23 09:21:42', NULL),
(8, 3, 4, 4, 4, 1.9325, 69.02, 'Kurang (K)', '2025-08-23 09:21:42', '2025-08-23 09:21:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `version` varchar(255) NOT NULL,
  `class` varchar(255) NOT NULL,
  `group` varchar(255) NOT NULL,
  `namespace` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `batch` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `version`, `class`, `group`, `namespace`, `time`, `batch`) VALUES
(57, '2025-08-04-015435', 'App\\Database\\Migrations\\CreatePeriodsTable', 'default', 'App', 1755940011, 1),
(58, '2025-08-04-015436', 'App\\Database\\Migrations\\CreateUsersTable', 'default', 'App', 1755940011, 1),
(59, '2025-08-04-015448', 'App\\Database\\Migrations\\CreateTeachersTable', 'default', 'App', 1755940011, 1),
(60, '2025-08-04-015502', 'App\\Database\\Migrations\\CreateAhpResultsTable', 'default', 'App', 1755940012, 1),
(61, '2025-08-04-015504', 'App\\Database\\Migrations\\CreateEvaluationResultsTable', 'default', 'App', 1755940012, 1),
(62, '2025-08-04-130050', 'App\\Database\\Migrations\\CreateQuestionCategoriesTable', 'default', 'App', 1755940012, 1),
(63, '2025-08-04-130107', 'App\\Database\\Migrations\\CreateQuestionSubcategoriesTable', 'default', 'App', 1755940012, 1),
(64, '2025-08-04-130118', 'App\\Database\\Migrations\\CreateQuestionsTable', 'default', 'App', 1755940012, 1),
(65, '2025-08-04-130130', 'App\\Database\\Migrations\\CreateTeacherQuestionScoresTable', 'default', 'App', 1755940012, 1),
(66, '2025-08-04-130132', 'App\\Database\\Migrations\\CreatePairwiseComparisonsTable', 'default', 'App', 1755940012, 1),
(67, '2025-08-23-070323', 'App\\Database\\Migrations\\CreateAHPNormalizations', 'default', 'App', 1755940012, 1),
(68, '2025-08-23-070411', 'App\\Database\\Migrations\\CreateAHPWeights', 'default', 'App', 1755940012, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pairwise_comparisons`
--

CREATE TABLE `pairwise_comparisons` (
  `comparison_id` int(11) UNSIGNED NOT NULL,
  `period_id` int(11) UNSIGNED NOT NULL,
  `criteria_id_1` int(11) UNSIGNED NOT NULL,
  `criteria_id_2` int(11) UNSIGNED NOT NULL,
  `comparison_value` float NOT NULL,
  `created_by` int(11) UNSIGNED NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `pairwise_comparisons`
--

INSERT INTO `pairwise_comparisons` (`comparison_id`, `period_id`, `criteria_id_1`, `criteria_id_2`, `comparison_value`, `created_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 4, 1, 2, 9, 1, '2025-08-23 09:07:35', '2025-08-23 09:07:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `periods`
--

CREATE TABLE `periods` (
  `period_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `periods`
--

INSERT INTO `periods` (`period_id`, `name`, `start_date`, `end_date`, `is_active`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Semester Genap 2024', '2024-01-01', '2024-06-30', 0, '2025-08-23 09:06:57', NULL, NULL),
(2, 'Semester Ganjil 2024', '2024-07-01', '2024-12-31', 0, '2025-08-23 09:06:57', NULL, NULL),
(3, 'Semester Genap 2025', '2024-01-01', '2024-06-30', 0, '2025-08-23 09:06:57', NULL, NULL),
(4, 'Semester Ganjil 2025', '2024-07-01', '2024-12-31', 1, '2025-08-23 09:06:57', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `question_id` int(11) UNSIGNED NOT NULL,
  `category_id` int(11) UNSIGNED NOT NULL,
  `subcategory_id` int(11) UNSIGNED DEFAULT NULL,
  `question_text` text NOT NULL,
  `scoring_type` enum('scale_1_4','scale_1_3','boolean') NOT NULL,
  `weight` float NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_id`, `category_id`, `subcategory_id`, `question_text`, `scoring_type`, `weight`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 1, 'Terdapat: satuan pendidikan, kelas, semester, mata pelajaran atau tema pelajaran/sub tema, jumlah pertemuan', 'scale_1_3', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(2, 1, 2, 'Kesesuaian dengan Kompetensi Dasar', 'scale_1_3', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(3, 1, 2, 'Kesesuaian penggunaan kata kerja operasional dengan kompetensi yang diukur', 'scale_1_3', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(4, 1, 2, 'Kesesuaian rumusan dengan aspek pengetahuan', 'scale_1_3', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(5, 1, 2, 'Kesesuaian rumusan dengan aspek keterampilan', 'scale_1_3', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(6, 1, 3, 'Kesesuaian dengan indikator', 'scale_1_3', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(7, 1, 3, 'Kesesuaian perumusan dengan aspek Audience, Behaviour, Condition, dan Degree', 'scale_1_3', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(8, 1, 4, 'Kesesuaian dengan tujuan pembelajaran', 'scale_1_3', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(9, 1, 4, 'Kesesuaian dengan karakteristik peserta didik', 'scale_1_3', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(10, 1, 4, 'Keruntutan uraian materi ajar', 'scale_1_3', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(11, 1, 5, 'Kesesuaian dengan Tujuan Pembelajaran', 'scale_1_3', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(12, 1, 5, 'Kesesuaian dengan peserta didik', 'scale_1_3', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(13, 1, 5, 'Kesesuaian dengan aspek saintifik', 'scale_1_3', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(14, 1, 5, 'Kesesuaian dengan karakteristik peserta didik', 'scale_1_3', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(15, 1, 6, 'Kesesuaian dengan Tujuan Pembelajaran', 'scale_1_3', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(16, 1, 6, 'Kesesuaian dengan Materi Pembelajaran', 'scale_1_3', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(17, 1, 6, 'Kesesuaian dengan pendekatan saintifik', 'scale_1_3', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(18, 1, 6, 'Kesesuaian dengan karakteristik peserta didik', 'scale_1_3', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(19, 1, 7, 'Kesesuaian dengan tujuan Pembelajaran', 'scale_1_3', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(20, 1, 7, 'Kesesuaian dengan pendekatan saintifik', 'scale_1_3', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(21, 1, 7, 'Kesesuaian dengan karakteristik peserta didik', 'scale_1_3', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(22, 1, 8, 'Menampilkan kegiatan pendahuluan, inti, dan penutup dengan jelas', 'scale_1_3', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(23, 1, 8, 'Kesesuaian kegiatan dengan pendekatan saintific (mengamati, menanya, mengumpulkan informasi mengasosiasikan informasi, mengkomunisasikan) ', 'scale_1_3', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(24, 1, 8, 'Kesesuaian dengan metode pembelajaran', 'scale_1_3', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(25, 1, 8, 'Kesesuaian kegiatan dengan sistematika materi', 'scale_1_3', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(26, 1, 8, 'Kesesuaian alokasi waktu kegiatan pendahuluan, kegiatan inti dan kegiatan penutup dengan cakupan materi', 'scale_1_3', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(27, 1, 9, 'Kesesuaian bentuk, tekhnik dan instrument dengan indicator pencapaian kompetensi', 'scale_1_3', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(28, 1, 9, 'Kesesuaian antara bentuk, tekhnik dan instrument penilaian sikap', 'scale_1_3', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(29, 1, 9, 'Kesesuaian antara bentuk, tekhnik dan instrument penilaian Pengetahuan', 'scale_1_3', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(30, 1, 9, 'Kesesuaian antara bentuk, tekhnik dan instrument penilaian keterampilan', 'scale_1_3', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(31, 2, 10, 'Mengaitkan materi pembelajaran sekarang dengan pengalaman peserta didik atau pembelajaran sebelumnya', 'boolean', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(32, 2, 10, 'Mengajukan pertanyaan menantang', 'boolean', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(33, 2, 10, 'Menyampaikan manfaat materi pembelajaran', 'boolean', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(34, 2, 10, 'Mendemonstrasikan sesuatu yang terkait dengan materi pembelajaran', 'boolean', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(35, 2, 11, 'Menyampaikan kemampuan yang akan dicapai peserta didik', 'boolean', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(36, 2, 11, 'Menyampaikan rencana kegiatan misalnya, individual, kerja kelompok, dan melakukan observasi', 'boolean', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(37, 2, 12, 'Kemampuan menyesuaikan materi dengan tujuan pembelajaran', 'boolean', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(38, 2, 12, 'Kemampuan mengaitkan materi dengan pengetahuan lain yang relevan, perkembangan iptek, dan kehidupan nyata', 'boolean', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(39, 2, 12, 'Menyampaikan pembahasan materi pembelajaran dengan tepat', 'boolean', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(40, 2, 12, 'Menyampaikan materi secara sistematik (mudah ke sulit, dan dari konkret ke abstrak)', 'boolean', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(41, 2, 13, 'Melaksanakan pembelajaran yang sesuai dengan kompetensi yang akan dicapai', 'boolean', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(42, 2, 13, 'Memfasilitasi kegiatan yang memuat komponen eksplorasi, elaborasi, dan konfirmasi', 'boolean', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(43, 2, 13, 'Melaksanakan pembelajaran secara runtut', 'boolean', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(44, 2, 13, 'Menguasai kelas', 'boolean', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(45, 2, 13, 'Melaksanakan pembelajaran yang bersifat kontekstual', 'boolean', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(46, 2, 13, 'Melaksanakan pembelajaran yang memungkinkan tumbuhnya kebiasaan positif (nuturent effect)', 'boolean', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(47, 2, 13, 'Melaksanakan pembelajaran  sesuai dengan alokasi waktu yang direncanakan', 'boolean', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(48, 2, 14, 'Memberikan pertanyaan mengapa dan bagaimana', 'boolean', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(49, 2, 14, 'Memancing peserta didik untuk bertanya', 'boolean', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(50, 2, 14, 'Memfasilitasi peserta didik untuk mencoba', 'boolean', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(51, 2, 14, 'Memfasilitasi peserta didik untuk mengamati', 'boolean', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(52, 2, 14, 'Memfasilitasi peserta didik untuk menganalisis', 'boolean', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(53, 2, 14, 'Memberikan pertanyaan peserta didik untuk menalar (proses berfikir, yang logis dan sistematis)', 'boolean', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(54, 2, 14, 'Menyediakan kegiatan peserta didik untuk menyimpulkan', 'boolean', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(55, 2, 15, 'Menunjukkan keterampilan dalam penggunaan sumber belajar/pembelajaran', 'boolean', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(56, 2, 15, 'Menunjukkan keterampilan dalam penggunaan media pembelajaran', 'boolean', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(57, 2, 15, 'Menghasilkan pesan yang menarik', 'boolean', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(58, 2, 15, 'Melibatkan peserta didik dalam pemanfaatan sumber belajar pembelajaran', 'boolean', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(59, 2, 15, 'Melibatkan peserta didik dalam pemanfaatan media pembelajaran', 'boolean', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(60, 2, 16, 'Menumbuhkan partisipasi aktif peserta didik melalui interaksi guru, peserta didik, sumber belajar', 'boolean', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(61, 2, 16, 'Merespon positif partisipasi peserta didik', 'boolean', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(62, 2, 16, 'Menunjukkan sikap terbuka terhadap respon peserta didik', 'boolean', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(63, 2, 16, 'Menunjukkan hubungan antar pribadi yang kondusif', 'boolean', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(64, 2, 16, 'Menumbuhkan keceriaan atau antusiasme peserta didik dalam belajar', 'boolean', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(65, 2, 17, 'Menggunakan bahasa lisan secara jelas dan lancar', 'boolean', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(66, 2, 17, 'Menggunakan bahasa tulis yang baik dan benar', 'boolean', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(67, 2, 18, 'Melakukan refleksi atau membuat rangkuman dengan melibatkan peserta didik', 'boolean', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(68, 2, 18, 'Memberikan tes lisan atau tulisan', 'boolean', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(69, 2, 18, 'Mengumpulkan hasil kerja sebagai bahan portofolio', 'boolean', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(70, 2, 18, 'Melaksanakan tindak lanjut dengan memberikan arahan kegiatan berikutnya dan tugas pengayaan', 'boolean', 1, '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `question_categories`
--

CREATE TABLE `question_categories` (
  `category_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `question_categories`
--

INSERT INTO `question_categories` (`category_id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Instrumen Perencanaan Kegiatan Pembelajaran', 'Instrumen evaluasi terhadap perencanaan pembelajaran oleh guru', '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(2, 'Instrumen Penilaian Pelaksanaan Pembelajaran', 'Instrumen observasi pelaksanaan kegiatan belajar mengajar', '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `question_subcategories`
--

CREATE TABLE `question_subcategories` (
  `subcategory_id` int(11) UNSIGNED NOT NULL,
  `category_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `question_subcategories`
--

INSERT INTO `question_subcategories` (`subcategory_id`, `category_id`, `name`, `description`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 'Identitas Mata Pelajaran', 'Identitas Mata Pelajaran', '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(2, 1, 'Perumusan Indikator', 'Perumusan Indikator', '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(3, 1, 'Perumusan Tujuan Pembelajaran', 'Perumusan Tujuan Pembelajaran', '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(4, 1, 'Pemilihan Materi Ajar', 'Pemilihan Materi Ajar', '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(5, 1, 'Pemilihan Sumber Belajar', 'Pemilihan Sumber Belajar', '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(6, 1, 'Pemilihan Media  Belajar', 'Pemilihan Media  Belajar', '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(7, 1, 'Metode Pembelajaran', 'Metode Pembelajaran', '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(8, 1, 'Skenario Pembelajaran', 'Skenario Pembelajaran', '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(9, 1, 'Rencana Penilaian Otentik', 'Rencana Penilaian Otentik', '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(10, 2, 'Aspek dan Motivasi', 'Aspek dan Motivasi', '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(11, 2, 'Pencapaian Kompetensi dan Rencana Kegiatan', 'Pencapaian Kompetensi dan Rencana Kegiatan', '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(12, 2, 'Penguasaan Materi Pelajaran', 'Penguasaan Materi Pelajaran', '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(13, 2, 'Penerapan Strategi Pembelajaran yang Mendidik', 'Penerapan Strategi Pembelajaran yang Mendidik', '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(14, 2, 'Penerapan Pendekatan Saintifik', 'Penerapan Pendekatan Saintifik', '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(15, 2, 'Pemanfaatan Sumber Belajar/Media dalam Pembelajaran', 'Pemanfaatan Sumber Belajar/Media dalam Pembelajaran', '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(16, 2, 'Pelibatan Peserta Didik dalam Pembelajaran', 'Pelibatan Peserta Didik dalam Pembelajaran', '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(17, 2, 'Penggunaan Bahasa yang Benar dan Tepat dalam Pembelajaran', 'Penggunaan Bahasa yang Benar dan Tepat dalam Pembelajaran', '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL),
(18, 2, 'Penutup Pembelajaran', 'Penutup Pembelajaran', '2025-08-23 09:06:57', '2025-08-23 09:06:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teachers`
--

CREATE TABLE `teachers` (
  `teacher_id` int(11) UNSIGNED NOT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `education` varchar(50) NOT NULL,
  `major` varchar(100) NOT NULL,
  `institution` varchar(100) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `birth_place` varchar(50) NOT NULL,
  `birth_date` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `photo` varchar(200) NOT NULL,
  `status` enum('active','inactive','on_leave') NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `teachers`
--

INSERT INTO `teachers` (`teacher_id`, `user_id`, `education`, `major`, `institution`, `gender`, `birth_place`, `birth_date`, `address`, `phone_number`, `photo`, `status`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 3, 'S1', 'Pendidikan Matematika', 'Universitas Negeri Yogyakarta', 'Laki-laki', 'Yogyakarta', '1985-06-15', 'Jl. Kaliurang No. 123', '081234567890', '/uploads/teachers/1754289002_756bb255bbe5d16c14d8.jpg', 'active', NULL, NULL, NULL),
(2, 4, 'S2', 'Pendidikan Bahasa Inggris', 'Universitas Indonesia', 'Perempuan', 'Jakarta', '1990-08-20', 'Jl. Sudirman No. 45', '081298765432', '/uploads/teachers/1754289002_756bb255bbe5d16c14d8.jpg', 'active', NULL, NULL, NULL),
(3, 5, 'S1', 'Pendidikan Fisika', 'Universitas Gadjah Mada', 'Laki-laki', 'Magelang', '1987-03-10', 'Jl. Solo Km. 5', '081345678901', '/uploads/teachers/1754289002_756bb255bbe5d16c14d8.jpg', 'on_leave', NULL, NULL, NULL),
(4, 6, 'S1', 'Pendidikan Biologi', 'Universitas Negeri Malang', 'Perempuan', 'Surabaya', '1992-12-05', 'Jl. Diponegoro No. 12', '081356789012', '/uploads/teachers/1754289002_756bb255bbe5d16c14d8.jpg', 'inactive', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_question_scores`
--

CREATE TABLE `teacher_question_scores` (
  `score_id` int(11) UNSIGNED NOT NULL,
  `teacher_id` int(11) UNSIGNED NOT NULL,
  `period_id` int(11) UNSIGNED NOT NULL,
  `question_id` int(11) UNSIGNED NOT NULL,
  `score` float NOT NULL,
  `given_by` int(10) UNSIGNED NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `teacher_question_scores`
--

INSERT INTO `teacher_question_scores` (`score_id`, `teacher_id`, `period_id`, `question_id`, `score`, `given_by`, `notes`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 1, 4, 1, 1, 1, NULL, '2025-08-23 09:11:01', '2025-08-23 09:11:01', NULL),
(2, 1, 4, 2, 2, 1, NULL, '2025-08-23 09:11:01', '2025-08-23 09:11:01', NULL),
(3, 1, 4, 3, 1, 1, NULL, '2025-08-23 09:11:01', '2025-08-23 09:11:01', NULL),
(4, 1, 4, 4, 2, 1, NULL, '2025-08-23 09:11:01', '2025-08-23 09:11:01', NULL),
(5, 1, 4, 5, 2, 1, NULL, '2025-08-23 09:11:01', '2025-08-23 09:11:01', NULL),
(6, 1, 4, 6, 2, 1, NULL, '2025-08-23 09:11:01', '2025-08-23 09:11:01', NULL),
(7, 1, 4, 7, 2, 1, NULL, '2025-08-23 09:11:01', '2025-08-23 09:11:01', NULL),
(8, 1, 4, 8, 2, 1, NULL, '2025-08-23 09:11:01', '2025-08-23 09:11:01', NULL),
(9, 1, 4, 9, 2, 1, NULL, '2025-08-23 09:11:01', '2025-08-23 09:11:01', NULL),
(10, 1, 4, 10, 2, 1, NULL, '2025-08-23 09:11:01', '2025-08-23 09:11:01', NULL),
(11, 1, 4, 11, 2, 1, NULL, '2025-08-23 09:11:01', '2025-08-23 09:11:01', NULL),
(12, 1, 4, 12, 2, 1, NULL, '2025-08-23 09:11:01', '2025-08-23 09:11:01', NULL),
(13, 1, 4, 13, 2, 1, NULL, '2025-08-23 09:11:01', '2025-08-23 09:11:01', NULL),
(14, 1, 4, 14, 2, 1, NULL, '2025-08-23 09:11:01', '2025-08-23 09:11:01', NULL),
(15, 1, 4, 15, 3, 1, NULL, '2025-08-23 09:11:01', '2025-08-23 09:11:01', NULL),
(16, 1, 4, 16, 3, 1, NULL, '2025-08-23 09:11:01', '2025-08-23 09:11:01', NULL),
(17, 1, 4, 17, 3, 1, NULL, '2025-08-23 09:11:01', '2025-08-23 09:11:01', NULL),
(18, 1, 4, 18, 3, 1, NULL, '2025-08-23 09:11:01', '2025-08-23 09:11:01', NULL),
(19, 1, 4, 19, 3, 1, NULL, '2025-08-23 09:11:01', '2025-08-23 09:11:01', NULL),
(20, 1, 4, 20, 3, 1, NULL, '2025-08-23 09:11:01', '2025-08-23 09:11:01', NULL),
(21, 1, 4, 21, 3, 1, NULL, '2025-08-23 09:11:01', '2025-08-23 09:11:01', NULL),
(22, 1, 4, 22, 3, 1, NULL, '2025-08-23 09:11:01', '2025-08-23 09:11:01', NULL),
(23, 1, 4, 23, 3, 1, NULL, '2025-08-23 09:11:01', '2025-08-23 09:11:01', NULL),
(24, 1, 4, 24, 3, 1, NULL, '2025-08-23 09:11:01', '2025-08-23 09:11:01', NULL),
(25, 1, 4, 25, 3, 1, NULL, '2025-08-23 09:11:01', '2025-08-23 09:11:01', NULL),
(26, 1, 4, 26, 3, 1, NULL, '2025-08-23 09:11:01', '2025-08-23 09:11:01', NULL),
(27, 1, 4, 27, 3, 1, NULL, '2025-08-23 09:11:01', '2025-08-23 09:11:01', NULL),
(28, 1, 4, 28, 3, 1, NULL, '2025-08-23 09:11:01', '2025-08-23 09:11:01', NULL),
(29, 1, 4, 29, 3, 1, NULL, '2025-08-23 09:11:01', '2025-08-23 09:11:01', NULL),
(30, 1, 4, 30, 3, 1, NULL, '2025-08-23 09:11:01', '2025-08-23 09:11:01', NULL),
(31, 1, 4, 31, 0, 1, NULL, '2025-08-23 09:11:55', '2025-08-23 09:11:55', NULL),
(32, 1, 4, 32, 1, 1, NULL, '2025-08-23 09:11:55', '2025-08-23 09:11:55', NULL),
(33, 1, 4, 33, 0, 1, NULL, '2025-08-23 09:11:55', '2025-08-23 09:11:55', NULL),
(34, 1, 4, 34, 0, 1, NULL, '2025-08-23 09:11:55', '2025-08-23 09:11:55', NULL),
(35, 1, 4, 35, 0, 1, NULL, '2025-08-23 09:11:55', '2025-08-23 09:11:55', NULL),
(36, 1, 4, 36, 0, 1, NULL, '2025-08-23 09:11:55', '2025-08-23 09:11:55', NULL),
(37, 1, 4, 37, 0, 1, NULL, '2025-08-23 09:11:55', '2025-08-23 09:11:55', NULL),
(38, 1, 4, 38, 0, 1, NULL, '2025-08-23 09:11:55', '2025-08-23 09:11:55', NULL),
(39, 1, 4, 39, 0, 1, NULL, '2025-08-23 09:11:55', '2025-08-23 09:11:55', NULL),
(40, 1, 4, 40, 0, 1, NULL, '2025-08-23 09:11:55', '2025-08-23 09:11:55', NULL),
(41, 1, 4, 41, 0, 1, NULL, '2025-08-23 09:11:55', '2025-08-23 09:11:55', NULL),
(42, 1, 4, 42, 0, 1, NULL, '2025-08-23 09:11:55', '2025-08-23 09:11:55', NULL),
(43, 1, 4, 43, 1, 1, NULL, '2025-08-23 09:11:55', '2025-08-23 09:11:55', NULL),
(44, 1, 4, 44, 1, 1, NULL, '2025-08-23 09:11:55', '2025-08-23 09:11:55', NULL),
(45, 1, 4, 45, 0, 1, NULL, '2025-08-23 09:11:55', '2025-08-23 09:11:55', NULL),
(46, 1, 4, 46, 1, 1, NULL, '2025-08-23 09:11:55', '2025-08-23 09:11:55', NULL),
(47, 1, 4, 47, 0, 1, NULL, '2025-08-23 09:11:55', '2025-08-23 09:11:55', NULL),
(48, 1, 4, 48, 1, 1, NULL, '2025-08-23 09:11:55', '2025-08-23 09:11:55', NULL),
(49, 1, 4, 49, 0, 1, NULL, '2025-08-23 09:11:55', '2025-08-23 09:11:55', NULL),
(50, 1, 4, 50, 1, 1, NULL, '2025-08-23 09:11:55', '2025-08-23 09:11:55', NULL),
(51, 1, 4, 51, 1, 1, NULL, '2025-08-23 09:11:55', '2025-08-23 09:11:55', NULL),
(52, 1, 4, 52, 0, 1, NULL, '2025-08-23 09:11:55', '2025-08-23 09:11:55', NULL),
(53, 1, 4, 53, 1, 1, NULL, '2025-08-23 09:11:55', '2025-08-23 09:11:55', NULL),
(54, 1, 4, 54, 1, 1, NULL, '2025-08-23 09:11:55', '2025-08-23 09:11:55', NULL),
(55, 1, 4, 55, 1, 1, NULL, '2025-08-23 09:11:55', '2025-08-23 09:11:55', NULL),
(56, 1, 4, 56, 1, 1, NULL, '2025-08-23 09:11:55', '2025-08-23 09:11:55', NULL),
(57, 1, 4, 57, 1, 1, NULL, '2025-08-23 09:11:55', '2025-08-23 09:11:55', NULL),
(58, 1, 4, 58, 1, 1, NULL, '2025-08-23 09:11:55', '2025-08-23 09:11:55', NULL),
(59, 1, 4, 59, 1, 1, NULL, '2025-08-23 09:11:55', '2025-08-23 09:11:55', NULL),
(60, 1, 4, 60, 1, 1, NULL, '2025-08-23 09:11:55', '2025-08-23 09:11:55', NULL),
(61, 1, 4, 61, 1, 1, NULL, '2025-08-23 09:11:55', '2025-08-23 09:11:55', NULL),
(62, 1, 4, 62, 0, 1, NULL, '2025-08-23 09:11:55', '2025-08-23 09:11:55', NULL),
(63, 1, 4, 63, 1, 1, NULL, '2025-08-23 09:11:55', '2025-08-23 09:11:55', NULL),
(64, 1, 4, 64, 1, 1, NULL, '2025-08-23 09:11:55', '2025-08-23 09:11:55', NULL),
(65, 1, 4, 65, 0, 1, NULL, '2025-08-23 09:11:55', '2025-08-23 09:11:55', NULL),
(66, 1, 4, 66, 0, 1, NULL, '2025-08-23 09:11:55', '2025-08-23 09:11:55', NULL),
(67, 1, 4, 67, 0, 1, NULL, '2025-08-23 09:11:55', '2025-08-23 09:11:55', NULL),
(68, 1, 4, 68, 0, 1, NULL, '2025-08-23 09:11:55', '2025-08-23 09:11:55', NULL),
(69, 1, 4, 69, 0, 1, NULL, '2025-08-23 09:11:55', '2025-08-23 09:11:55', NULL),
(70, 1, 4, 70, 0, 1, NULL, '2025-08-23 09:11:55', '2025-08-23 09:11:55', NULL),
(71, 2, 4, 1, 1, 1, NULL, '2025-08-23 09:12:45', '2025-08-23 09:12:45', NULL),
(72, 2, 4, 2, 2, 1, NULL, '2025-08-23 09:12:45', '2025-08-23 09:12:45', NULL),
(73, 2, 4, 3, 3, 1, NULL, '2025-08-23 09:12:45', '2025-08-23 09:12:45', NULL),
(74, 2, 4, 4, 3, 1, NULL, '2025-08-23 09:12:45', '2025-08-23 09:12:45', NULL),
(75, 2, 4, 5, 3, 1, NULL, '2025-08-23 09:12:45', '2025-08-23 09:12:45', NULL),
(76, 2, 4, 6, 3, 1, NULL, '2025-08-23 09:12:45', '2025-08-23 09:12:45', NULL),
(77, 2, 4, 7, 3, 1, NULL, '2025-08-23 09:12:45', '2025-08-23 09:12:45', NULL),
(78, 2, 4, 8, 3, 1, NULL, '2025-08-23 09:12:45', '2025-08-23 09:12:45', NULL),
(79, 2, 4, 9, 3, 1, NULL, '2025-08-23 09:12:45', '2025-08-23 09:12:45', NULL),
(80, 2, 4, 10, 3, 1, NULL, '2025-08-23 09:12:45', '2025-08-23 09:12:45', NULL),
(81, 2, 4, 11, 3, 1, NULL, '2025-08-23 09:12:45', '2025-08-23 09:12:45', NULL),
(82, 2, 4, 12, 3, 1, NULL, '2025-08-23 09:12:45', '2025-08-23 09:12:45', NULL),
(83, 2, 4, 13, 3, 1, NULL, '2025-08-23 09:12:45', '2025-08-23 09:12:45', NULL),
(84, 2, 4, 14, 3, 1, NULL, '2025-08-23 09:12:45', '2025-08-23 09:12:45', NULL),
(85, 2, 4, 15, 3, 1, NULL, '2025-08-23 09:12:45', '2025-08-23 09:12:45', NULL),
(86, 2, 4, 16, 3, 1, NULL, '2025-08-23 09:12:45', '2025-08-23 09:12:45', NULL),
(87, 2, 4, 17, 3, 1, NULL, '2025-08-23 09:12:45', '2025-08-23 09:12:45', NULL),
(88, 2, 4, 18, 3, 1, NULL, '2025-08-23 09:12:45', '2025-08-23 09:12:45', NULL),
(89, 2, 4, 19, 3, 1, NULL, '2025-08-23 09:12:45', '2025-08-23 09:12:45', NULL),
(90, 2, 4, 20, 3, 1, NULL, '2025-08-23 09:12:45', '2025-08-23 09:12:45', NULL),
(91, 2, 4, 21, 3, 1, NULL, '2025-08-23 09:12:45', '2025-08-23 09:12:45', NULL),
(92, 2, 4, 22, 3, 1, NULL, '2025-08-23 09:12:45', '2025-08-23 09:12:45', NULL),
(93, 2, 4, 23, 3, 1, NULL, '2025-08-23 09:12:45', '2025-08-23 09:12:45', NULL),
(94, 2, 4, 24, 2, 1, NULL, '2025-08-23 09:12:45', '2025-08-23 09:12:45', NULL),
(95, 2, 4, 25, 3, 1, NULL, '2025-08-23 09:12:45', '2025-08-23 09:12:45', NULL),
(96, 2, 4, 26, 3, 1, NULL, '2025-08-23 09:12:45', '2025-08-23 09:12:45', NULL),
(97, 2, 4, 27, 2, 1, NULL, '2025-08-23 09:12:45', '2025-08-23 09:12:45', NULL),
(98, 2, 4, 28, 2, 1, NULL, '2025-08-23 09:12:45', '2025-08-23 09:12:45', NULL),
(99, 2, 4, 29, 2, 1, NULL, '2025-08-23 09:12:45', '2025-08-23 09:12:45', NULL),
(100, 2, 4, 30, 2, 1, NULL, '2025-08-23 09:12:45', '2025-08-23 09:12:45', NULL),
(101, 2, 4, 31, 1, 1, NULL, '2025-08-23 09:13:30', '2025-08-23 09:13:30', NULL),
(102, 2, 4, 32, 1, 1, NULL, '2025-08-23 09:13:30', '2025-08-23 09:13:30', NULL),
(103, 2, 4, 33, 1, 1, NULL, '2025-08-23 09:13:30', '2025-08-23 09:13:30', NULL),
(104, 2, 4, 34, 1, 1, NULL, '2025-08-23 09:13:30', '2025-08-23 09:13:30', NULL),
(105, 2, 4, 35, 1, 1, NULL, '2025-08-23 09:13:30', '2025-08-23 09:13:30', NULL),
(106, 2, 4, 36, 1, 1, NULL, '2025-08-23 09:13:30', '2025-08-23 09:13:30', NULL),
(107, 2, 4, 37, 0, 1, NULL, '2025-08-23 09:13:30', '2025-08-23 09:13:30', NULL),
(108, 2, 4, 38, 0, 1, NULL, '2025-08-23 09:13:30', '2025-08-23 09:13:30', NULL),
(109, 2, 4, 39, 0, 1, NULL, '2025-08-23 09:13:30', '2025-08-23 09:13:30', NULL),
(110, 2, 4, 40, 0, 1, NULL, '2025-08-23 09:13:30', '2025-08-23 09:13:30', NULL),
(111, 2, 4, 41, 1, 1, NULL, '2025-08-23 09:13:30', '2025-08-23 09:13:30', NULL),
(112, 2, 4, 42, 0, 1, NULL, '2025-08-23 09:13:30', '2025-08-23 09:13:30', NULL),
(113, 2, 4, 43, 1, 1, NULL, '2025-08-23 09:13:30', '2025-08-23 09:13:30', NULL),
(114, 2, 4, 44, 1, 1, NULL, '2025-08-23 09:13:30', '2025-08-23 09:13:30', NULL),
(115, 2, 4, 45, 1, 1, NULL, '2025-08-23 09:13:30', '2025-08-23 09:13:30', NULL),
(116, 2, 4, 46, 1, 1, NULL, '2025-08-23 09:13:30', '2025-08-23 09:13:30', NULL),
(117, 2, 4, 47, 1, 1, NULL, '2025-08-23 09:13:30', '2025-08-23 09:13:30', NULL),
(118, 2, 4, 48, 1, 1, NULL, '2025-08-23 09:13:30', '2025-08-23 09:13:30', NULL),
(119, 2, 4, 49, 0, 1, NULL, '2025-08-23 09:13:30', '2025-08-23 09:13:30', NULL),
(120, 2, 4, 50, 0, 1, NULL, '2025-08-23 09:13:30', '2025-08-23 09:13:30', NULL),
(121, 2, 4, 51, 1, 1, NULL, '2025-08-23 09:13:30', '2025-08-23 09:13:30', NULL),
(122, 2, 4, 52, 0, 1, NULL, '2025-08-23 09:13:30', '2025-08-23 09:13:30', NULL),
(123, 2, 4, 53, 0, 1, NULL, '2025-08-23 09:13:30', '2025-08-23 09:13:30', NULL),
(124, 2, 4, 54, 0, 1, NULL, '2025-08-23 09:13:30', '2025-08-23 09:13:30', NULL),
(125, 2, 4, 55, 0, 1, NULL, '2025-08-23 09:13:30', '2025-08-23 09:13:30', NULL),
(126, 2, 4, 56, 0, 1, NULL, '2025-08-23 09:13:30', '2025-08-23 09:13:30', NULL),
(127, 2, 4, 57, 1, 1, NULL, '2025-08-23 09:13:30', '2025-08-23 09:13:30', NULL),
(128, 2, 4, 58, 1, 1, NULL, '2025-08-23 09:13:30', '2025-08-23 09:13:30', NULL),
(129, 2, 4, 59, 1, 1, NULL, '2025-08-23 09:13:30', '2025-08-23 09:13:30', NULL),
(130, 2, 4, 60, 1, 1, NULL, '2025-08-23 09:13:30', '2025-08-23 09:13:30', NULL),
(131, 2, 4, 61, 0, 1, NULL, '2025-08-23 09:13:30', '2025-08-23 09:13:30', NULL),
(132, 2, 4, 62, 1, 1, NULL, '2025-08-23 09:13:30', '2025-08-23 09:13:30', NULL),
(133, 2, 4, 63, 0, 1, NULL, '2025-08-23 09:13:30', '2025-08-23 09:13:30', NULL),
(134, 2, 4, 64, 1, 1, NULL, '2025-08-23 09:13:30', '2025-08-23 09:13:30', NULL),
(135, 2, 4, 65, 1, 1, NULL, '2025-08-23 09:13:30', '2025-08-23 09:13:30', NULL),
(136, 2, 4, 66, 1, 1, NULL, '2025-08-23 09:13:30', '2025-08-23 09:13:30', NULL),
(137, 2, 4, 67, 1, 1, NULL, '2025-08-23 09:13:30', '2025-08-23 09:13:30', NULL),
(138, 2, 4, 68, 1, 1, NULL, '2025-08-23 09:13:30', '2025-08-23 09:13:30', NULL),
(139, 2, 4, 69, 1, 1, NULL, '2025-08-23 09:13:30', '2025-08-23 09:13:30', NULL),
(140, 2, 4, 70, 0, 1, NULL, '2025-08-23 09:13:30', '2025-08-23 09:13:30', NULL),
(141, 3, 4, 1, 1, 1, NULL, '2025-08-23 09:14:24', '2025-08-23 09:14:24', NULL),
(142, 3, 4, 2, 1, 1, NULL, '2025-08-23 09:14:24', '2025-08-23 09:14:24', NULL),
(143, 3, 4, 3, 2, 1, NULL, '2025-08-23 09:14:24', '2025-08-23 09:14:24', NULL),
(144, 3, 4, 4, 2, 1, NULL, '2025-08-23 09:14:24', '2025-08-23 09:14:24', NULL),
(145, 3, 4, 5, 2, 1, NULL, '2025-08-23 09:14:24', '2025-08-23 09:14:24', NULL),
(146, 3, 4, 6, 2, 1, NULL, '2025-08-23 09:14:24', '2025-08-23 09:14:24', NULL),
(147, 3, 4, 7, 2, 1, NULL, '2025-08-23 09:14:24', '2025-08-23 09:14:24', NULL),
(148, 3, 4, 8, 2, 1, NULL, '2025-08-23 09:14:24', '2025-08-23 09:14:24', NULL),
(149, 3, 4, 9, 2, 1, NULL, '2025-08-23 09:14:24', '2025-08-23 09:14:24', NULL),
(150, 3, 4, 10, 2, 1, NULL, '2025-08-23 09:14:24', '2025-08-23 09:14:24', NULL),
(151, 3, 4, 11, 2, 1, NULL, '2025-08-23 09:14:24', '2025-08-23 09:14:24', NULL),
(152, 3, 4, 12, 3, 1, NULL, '2025-08-23 09:14:24', '2025-08-23 09:14:24', NULL),
(153, 3, 4, 13, 2, 1, NULL, '2025-08-23 09:14:24', '2025-08-23 09:14:24', NULL),
(154, 3, 4, 14, 2, 1, NULL, '2025-08-23 09:14:24', '2025-08-23 09:14:24', NULL),
(155, 3, 4, 15, 2, 1, NULL, '2025-08-23 09:14:24', '2025-08-23 09:14:24', NULL),
(156, 3, 4, 16, 2, 1, NULL, '2025-08-23 09:14:24', '2025-08-23 09:14:24', NULL),
(157, 3, 4, 17, 2, 1, NULL, '2025-08-23 09:14:24', '2025-08-23 09:14:24', NULL),
(158, 3, 4, 18, 2, 1, NULL, '2025-08-23 09:14:24', '2025-08-23 09:14:24', NULL),
(159, 3, 4, 19, 3, 1, NULL, '2025-08-23 09:14:24', '2025-08-23 09:14:24', NULL),
(160, 3, 4, 20, 2, 1, NULL, '2025-08-23 09:14:24', '2025-08-23 09:14:24', NULL),
(161, 3, 4, 21, 2, 1, NULL, '2025-08-23 09:14:24', '2025-08-23 09:14:24', NULL),
(162, 3, 4, 22, 2, 1, NULL, '2025-08-23 09:14:24', '2025-08-23 09:14:24', NULL),
(163, 3, 4, 23, 2, 1, NULL, '2025-08-23 09:14:24', '2025-08-23 09:14:24', NULL),
(164, 3, 4, 24, 2, 1, NULL, '2025-08-23 09:14:24', '2025-08-23 09:14:24', NULL),
(165, 3, 4, 25, 2, 1, NULL, '2025-08-23 09:14:24', '2025-08-23 09:14:24', NULL),
(166, 3, 4, 26, 2, 1, NULL, '2025-08-23 09:14:24', '2025-08-23 09:14:24', NULL),
(167, 3, 4, 27, 2, 1, NULL, '2025-08-23 09:14:24', '2025-08-23 09:14:24', NULL),
(168, 3, 4, 28, 3, 1, NULL, '2025-08-23 09:14:24', '2025-08-23 09:14:24', NULL),
(169, 3, 4, 29, 3, 1, NULL, '2025-08-23 09:14:24', '2025-08-23 09:14:24', NULL),
(170, 3, 4, 30, 3, 1, NULL, '2025-08-23 09:14:24', '2025-08-23 09:14:24', NULL),
(171, 3, 4, 31, 1, 1, NULL, '2025-08-23 09:15:18', '2025-08-23 09:15:18', NULL),
(172, 3, 4, 32, 0, 1, NULL, '2025-08-23 09:15:18', '2025-08-23 09:15:18', NULL),
(173, 3, 4, 33, 1, 1, NULL, '2025-08-23 09:15:18', '2025-08-23 09:15:18', NULL),
(174, 3, 4, 34, 1, 1, NULL, '2025-08-23 09:15:18', '2025-08-23 09:15:18', NULL),
(175, 3, 4, 35, 1, 1, NULL, '2025-08-23 09:15:18', '2025-08-23 09:15:18', NULL),
(176, 3, 4, 36, 1, 1, NULL, '2025-08-23 09:15:18', '2025-08-23 09:15:18', NULL),
(177, 3, 4, 37, 0, 1, NULL, '2025-08-23 09:15:18', '2025-08-23 09:15:18', NULL),
(178, 3, 4, 38, 1, 1, NULL, '2025-08-23 09:15:18', '2025-08-23 09:15:18', NULL),
(179, 3, 4, 39, 1, 1, NULL, '2025-08-23 09:15:18', '2025-08-23 09:15:18', NULL),
(180, 3, 4, 40, 0, 1, NULL, '2025-08-23 09:15:18', '2025-08-23 09:15:18', NULL),
(181, 3, 4, 41, 0, 1, NULL, '2025-08-23 09:15:18', '2025-08-23 09:15:18', NULL),
(182, 3, 4, 42, 0, 1, NULL, '2025-08-23 09:15:18', '2025-08-23 09:15:18', NULL),
(183, 3, 4, 43, 0, 1, NULL, '2025-08-23 09:15:18', '2025-08-23 09:15:18', NULL),
(184, 3, 4, 44, 0, 1, NULL, '2025-08-23 09:15:18', '2025-08-23 09:15:18', NULL),
(185, 3, 4, 45, 0, 1, NULL, '2025-08-23 09:15:18', '2025-08-23 09:15:18', NULL),
(186, 3, 4, 46, 0, 1, NULL, '2025-08-23 09:15:18', '2025-08-23 09:15:18', NULL),
(187, 3, 4, 47, 0, 1, NULL, '2025-08-23 09:15:18', '2025-08-23 09:15:18', NULL),
(188, 3, 4, 48, 0, 1, NULL, '2025-08-23 09:15:18', '2025-08-23 09:15:18', NULL),
(189, 3, 4, 49, 0, 1, NULL, '2025-08-23 09:15:18', '2025-08-23 09:15:18', NULL),
(190, 3, 4, 50, 0, 1, NULL, '2025-08-23 09:15:18', '2025-08-23 09:15:18', NULL),
(191, 3, 4, 51, 0, 1, NULL, '2025-08-23 09:15:18', '2025-08-23 09:15:18', NULL),
(192, 3, 4, 52, 0, 1, NULL, '2025-08-23 09:15:18', '2025-08-23 09:15:18', NULL),
(193, 3, 4, 53, 0, 1, NULL, '2025-08-23 09:15:18', '2025-08-23 09:15:18', NULL),
(194, 3, 4, 54, 0, 1, NULL, '2025-08-23 09:15:18', '2025-08-23 09:15:18', NULL),
(195, 3, 4, 55, 0, 1, NULL, '2025-08-23 09:15:18', '2025-08-23 09:15:18', NULL),
(196, 3, 4, 56, 0, 1, NULL, '2025-08-23 09:15:18', '2025-08-23 09:15:18', NULL),
(197, 3, 4, 57, 1, 1, NULL, '2025-08-23 09:15:18', '2025-08-23 09:15:18', NULL),
(198, 3, 4, 58, 1, 1, NULL, '2025-08-23 09:15:18', '2025-08-23 09:15:18', NULL),
(199, 3, 4, 59, 1, 1, NULL, '2025-08-23 09:15:18', '2025-08-23 09:15:18', NULL),
(200, 3, 4, 60, 1, 1, NULL, '2025-08-23 09:15:18', '2025-08-23 09:15:18', NULL),
(201, 3, 4, 61, 1, 1, NULL, '2025-08-23 09:15:18', '2025-08-23 09:15:18', NULL),
(202, 3, 4, 62, 1, 1, NULL, '2025-08-23 09:15:18', '2025-08-23 09:15:18', NULL),
(203, 3, 4, 63, 1, 1, NULL, '2025-08-23 09:15:18', '2025-08-23 09:15:18', NULL),
(204, 3, 4, 64, 1, 1, NULL, '2025-08-23 09:15:18', '2025-08-23 09:15:18', NULL),
(205, 3, 4, 65, 1, 1, NULL, '2025-08-23 09:15:18', '2025-08-23 09:15:18', NULL),
(206, 3, 4, 66, 1, 1, NULL, '2025-08-23 09:15:18', '2025-08-23 09:15:18', NULL),
(207, 3, 4, 67, 0, 1, NULL, '2025-08-23 09:15:18', '2025-08-23 09:15:18', NULL),
(208, 3, 4, 68, 0, 1, NULL, '2025-08-23 09:15:18', '2025-08-23 09:15:18', NULL),
(209, 3, 4, 69, 0, 1, NULL, '2025-08-23 09:15:18', '2025-08-23 09:15:18', NULL),
(210, 3, 4, 70, 0, 1, NULL, '2025-08-23 09:15:18', '2025-08-23 09:15:18', NULL),
(211, 4, 4, 1, 3, 1, NULL, '2025-08-23 09:16:08', '2025-08-23 09:16:08', NULL),
(212, 4, 4, 2, 3, 1, NULL, '2025-08-23 09:16:08', '2025-08-23 09:16:08', NULL),
(213, 4, 4, 3, 3, 1, NULL, '2025-08-23 09:16:08', '2025-08-23 09:16:08', NULL),
(214, 4, 4, 4, 3, 1, NULL, '2025-08-23 09:16:08', '2025-08-23 09:16:08', NULL),
(215, 4, 4, 5, 3, 1, NULL, '2025-08-23 09:16:08', '2025-08-23 09:16:08', NULL),
(216, 4, 4, 6, 3, 1, NULL, '2025-08-23 09:16:08', '2025-08-23 09:16:08', NULL),
(217, 4, 4, 7, 3, 1, NULL, '2025-08-23 09:16:08', '2025-08-23 09:16:08', NULL),
(218, 4, 4, 8, 3, 1, NULL, '2025-08-23 09:16:08', '2025-08-23 09:16:08', NULL),
(219, 4, 4, 9, 3, 1, NULL, '2025-08-23 09:16:08', '2025-08-23 09:16:08', NULL),
(220, 4, 4, 10, 3, 1, NULL, '2025-08-23 09:16:08', '2025-08-23 09:16:08', NULL),
(221, 4, 4, 11, 3, 1, NULL, '2025-08-23 09:16:08', '2025-08-23 09:16:08', NULL),
(222, 4, 4, 12, 3, 1, NULL, '2025-08-23 09:16:08', '2025-08-23 09:16:08', NULL),
(223, 4, 4, 13, 3, 1, NULL, '2025-08-23 09:16:08', '2025-08-23 09:16:08', NULL),
(224, 4, 4, 14, 3, 1, NULL, '2025-08-23 09:16:08', '2025-08-23 09:16:08', NULL),
(225, 4, 4, 15, 3, 1, NULL, '2025-08-23 09:16:08', '2025-08-23 09:16:08', NULL),
(226, 4, 4, 16, 3, 1, NULL, '2025-08-23 09:16:08', '2025-08-23 09:16:08', NULL),
(227, 4, 4, 17, 3, 1, NULL, '2025-08-23 09:16:08', '2025-08-23 09:16:08', NULL),
(228, 4, 4, 18, 3, 1, NULL, '2025-08-23 09:16:08', '2025-08-23 09:16:08', NULL),
(229, 4, 4, 19, 3, 1, NULL, '2025-08-23 09:16:08', '2025-08-23 09:16:08', NULL),
(230, 4, 4, 20, 3, 1, NULL, '2025-08-23 09:16:08', '2025-08-23 09:16:08', NULL),
(231, 4, 4, 21, 3, 1, NULL, '2025-08-23 09:16:08', '2025-08-23 09:16:08', NULL),
(232, 4, 4, 22, 3, 1, NULL, '2025-08-23 09:16:08', '2025-08-23 09:16:08', NULL),
(233, 4, 4, 23, 3, 1, NULL, '2025-08-23 09:16:08', '2025-08-23 09:16:08', NULL),
(234, 4, 4, 24, 3, 1, NULL, '2025-08-23 09:16:08', '2025-08-23 09:16:08', NULL),
(235, 4, 4, 25, 3, 1, NULL, '2025-08-23 09:16:08', '2025-08-23 09:16:08', NULL),
(236, 4, 4, 26, 3, 1, NULL, '2025-08-23 09:16:08', '2025-08-23 09:16:08', NULL),
(237, 4, 4, 27, 3, 1, NULL, '2025-08-23 09:16:08', '2025-08-23 09:16:08', NULL),
(238, 4, 4, 28, 3, 1, NULL, '2025-08-23 09:16:08', '2025-08-23 09:16:08', NULL),
(239, 4, 4, 29, 3, 1, NULL, '2025-08-23 09:16:08', '2025-08-23 09:16:08', NULL),
(240, 4, 4, 30, 3, 1, NULL, '2025-08-23 09:16:08', '2025-08-23 09:16:08', NULL),
(241, 4, 4, 31, 1, 1, NULL, '2025-08-23 09:16:58', '2025-08-23 09:16:58', NULL),
(242, 4, 4, 32, 1, 1, NULL, '2025-08-23 09:16:58', '2025-08-23 09:16:58', NULL),
(243, 4, 4, 33, 1, 1, NULL, '2025-08-23 09:16:58', '2025-08-23 09:16:58', NULL),
(244, 4, 4, 34, 1, 1, NULL, '2025-08-23 09:16:58', '2025-08-23 09:16:58', NULL),
(245, 4, 4, 35, 1, 1, NULL, '2025-08-23 09:16:58', '2025-08-23 09:16:58', NULL),
(246, 4, 4, 36, 1, 1, NULL, '2025-08-23 09:16:58', '2025-08-23 09:16:58', NULL),
(247, 4, 4, 37, 1, 1, NULL, '2025-08-23 09:16:58', '2025-08-23 09:16:58', NULL),
(248, 4, 4, 38, 1, 1, NULL, '2025-08-23 09:16:58', '2025-08-23 09:16:58', NULL),
(249, 4, 4, 39, 1, 1, NULL, '2025-08-23 09:16:58', '2025-08-23 09:16:58', NULL),
(250, 4, 4, 40, 1, 1, NULL, '2025-08-23 09:16:58', '2025-08-23 09:16:58', NULL),
(251, 4, 4, 41, 1, 1, NULL, '2025-08-23 09:16:58', '2025-08-23 09:16:58', NULL),
(252, 4, 4, 42, 1, 1, NULL, '2025-08-23 09:16:58', '2025-08-23 09:16:58', NULL),
(253, 4, 4, 43, 1, 1, NULL, '2025-08-23 09:16:58', '2025-08-23 09:16:58', NULL),
(254, 4, 4, 44, 1, 1, NULL, '2025-08-23 09:16:58', '2025-08-23 09:16:58', NULL),
(255, 4, 4, 45, 1, 1, NULL, '2025-08-23 09:16:58', '2025-08-23 09:16:58', NULL),
(256, 4, 4, 46, 1, 1, NULL, '2025-08-23 09:16:58', '2025-08-23 09:16:58', NULL),
(257, 4, 4, 47, 1, 1, NULL, '2025-08-23 09:16:58', '2025-08-23 09:16:58', NULL),
(258, 4, 4, 48, 1, 1, NULL, '2025-08-23 09:16:58', '2025-08-23 09:16:58', NULL),
(259, 4, 4, 49, 1, 1, NULL, '2025-08-23 09:16:58', '2025-08-23 09:16:58', NULL),
(260, 4, 4, 50, 1, 1, NULL, '2025-08-23 09:16:58', '2025-08-23 09:16:58', NULL),
(261, 4, 4, 51, 1, 1, NULL, '2025-08-23 09:16:58', '2025-08-23 09:16:58', NULL),
(262, 4, 4, 52, 1, 1, NULL, '2025-08-23 09:16:58', '2025-08-23 09:16:58', NULL),
(263, 4, 4, 53, 1, 1, NULL, '2025-08-23 09:16:58', '2025-08-23 09:16:58', NULL),
(264, 4, 4, 54, 1, 1, NULL, '2025-08-23 09:16:58', '2025-08-23 09:16:58', NULL),
(265, 4, 4, 55, 1, 1, NULL, '2025-08-23 09:16:58', '2025-08-23 09:16:58', NULL),
(266, 4, 4, 56, 1, 1, NULL, '2025-08-23 09:16:58', '2025-08-23 09:16:58', NULL),
(267, 4, 4, 57, 1, 1, NULL, '2025-08-23 09:16:58', '2025-08-23 09:16:58', NULL),
(268, 4, 4, 58, 1, 1, NULL, '2025-08-23 09:16:58', '2025-08-23 09:16:58', NULL),
(269, 4, 4, 59, 1, 1, NULL, '2025-08-23 09:16:58', '2025-08-23 09:16:58', NULL),
(270, 4, 4, 60, 1, 1, NULL, '2025-08-23 09:16:58', '2025-08-23 09:16:58', NULL),
(271, 4, 4, 61, 1, 1, NULL, '2025-08-23 09:16:58', '2025-08-23 09:16:58', NULL),
(272, 4, 4, 62, 1, 1, NULL, '2025-08-23 09:16:58', '2025-08-23 09:16:58', NULL),
(273, 4, 4, 63, 1, 1, NULL, '2025-08-23 09:16:58', '2025-08-23 09:16:58', NULL),
(274, 4, 4, 64, 1, 1, NULL, '2025-08-23 09:16:58', '2025-08-23 09:16:58', NULL),
(275, 4, 4, 65, 1, 1, NULL, '2025-08-23 09:16:58', '2025-08-23 09:16:58', NULL),
(276, 4, 4, 66, 1, 1, NULL, '2025-08-23 09:16:58', '2025-08-23 09:16:58', NULL),
(277, 4, 4, 67, 1, 1, NULL, '2025-08-23 09:16:58', '2025-08-23 09:16:58', NULL),
(278, 4, 4, 68, 1, 1, NULL, '2025-08-23 09:16:58', '2025-08-23 09:16:58', NULL),
(279, 4, 4, 69, 1, 1, NULL, '2025-08-23 09:16:58', '2025-08-23 09:16:58', NULL),
(280, 4, 4, 70, 1, 1, NULL, '2025-08-23 09:16:58', '2025-08-23 09:16:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','kepala_sekolah','guru') NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Administrator', 'admin@gmail.com', '$2y$10$.ZmJ7OP.IMJcG7ygEg8gCu3a0NYYC8LipUVhEsIEBZMp7V42FjmeG', 'admin', '2025-08-23 09:06:57', NULL, NULL),
(2, 'Kepala Sekolah', 'kepala@gmail.com', '$2y$10$3nEjW450/Zd9Y0n1nWDdluOKhgxQc7W0EvdtrvtMy/.pcbCBMsu1q', 'kepala_sekolah', '2025-08-23 09:06:57', NULL, NULL),
(3, 'Guru 1', 'guru1@gmail.com', '$2y$10$XeD4T3qHlkIJV.Z4UrtH0ufUsnnxPZ1aVDGV6delySWdyKISFd4pS', 'guru', '2025-08-23 09:06:57', NULL, NULL),
(4, 'Guru 2', 'guru2@gmail.com', '$2y$10$xubl9rmDsadxpbybqkzPRO31UBpTNJni4J7L4bH.j2PN9rH8.QEjK', 'guru', '2025-08-23 09:06:57', NULL, NULL),
(5, 'Guru 3', 'guru3@gmail.com', '$2y$10$sxrtUh8H0h7Mph3ofkrHA.9gv6zBW/uRbQnEHuJ/0EaAzLnleqHWq', 'guru', '2025-08-23 09:06:57', NULL, NULL),
(6, 'Guru 4', 'guru4@gmail.com', '$2y$10$ED6ZhKL2hF.jHxZ0zpR.l.m1UkgKNTeJKoyHNDGhNA2srHqTcbI7a', 'guru', '2025-08-23 09:06:57', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ahp_normalizations`
--
ALTER TABLE `ahp_normalizations`
  ADD PRIMARY KEY (`ahp_normalization_id`),
  ADD KEY `ahp_normalizations_ahp_result_id_foreign` (`ahp_result_id`);

--
-- Indexes for table `ahp_results`
--
ALTER TABLE `ahp_results`
  ADD PRIMARY KEY (`ahp_result_id`),
  ADD KEY `ahp_results_period_id_foreign` (`period_id`),
  ADD KEY `ahp_results_calculated_by_foreign` (`calculated_by`);

--
-- Indexes for table `ahp_weights`
--
ALTER TABLE `ahp_weights`
  ADD PRIMARY KEY (`ahp_weight_id`),
  ADD KEY `ahp_weights_ahp_result_id_foreign` (`ahp_result_id`);

--
-- Indexes for table `evaluation_results`
--
ALTER TABLE `evaluation_results`
  ADD PRIMARY KEY (`evaluation_id`),
  ADD KEY `evaluation_results_teacher_id_foreign` (`teacher_id`),
  ADD KEY `evaluation_results_ahp_result_id_foreign` (`ahp_result_id`),
  ADD KEY `evaluation_results_period_id_foreign` (`period_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pairwise_comparisons`
--
ALTER TABLE `pairwise_comparisons`
  ADD PRIMARY KEY (`comparison_id`),
  ADD KEY `pairwise_comparisons_period_id_foreign` (`period_id`),
  ADD KEY `pairwise_comparisons_criteria_id_1_foreign` (`criteria_id_1`),
  ADD KEY `pairwise_comparisons_criteria_id_2_foreign` (`criteria_id_2`),
  ADD KEY `pairwise_comparisons_created_by_foreign` (`created_by`);

--
-- Indexes for table `periods`
--
ALTER TABLE `periods`
  ADD PRIMARY KEY (`period_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`),
  ADD KEY `questions_category_id_foreign` (`category_id`),
  ADD KEY `questions_subcategory_id_foreign` (`subcategory_id`);

--
-- Indexes for table `question_categories`
--
ALTER TABLE `question_categories`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `question_subcategories`
--
ALTER TABLE `question_subcategories`
  ADD PRIMARY KEY (`subcategory_id`),
  ADD KEY `question_subcategories_category_id_foreign` (`category_id`);

--
-- Indexes for table `teachers`
--
ALTER TABLE `teachers`
  ADD PRIMARY KEY (`teacher_id`),
  ADD KEY `teachers_user_id_foreign` (`user_id`);

--
-- Indexes for table `teacher_question_scores`
--
ALTER TABLE `teacher_question_scores`
  ADD PRIMARY KEY (`score_id`),
  ADD KEY `teacher_question_scores_teacher_id_foreign` (`teacher_id`),
  ADD KEY `teacher_question_scores_period_id_foreign` (`period_id`),
  ADD KEY `teacher_question_scores_question_id_foreign` (`question_id`),
  ADD KEY `teacher_question_scores_given_by_foreign` (`given_by`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ahp_normalizations`
--
ALTER TABLE `ahp_normalizations`
  MODIFY `ahp_normalization_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `ahp_results`
--
ALTER TABLE `ahp_results`
  MODIFY `ahp_result_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ahp_weights`
--
ALTER TABLE `ahp_weights`
  MODIFY `ahp_weight_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `evaluation_results`
--
ALTER TABLE `evaluation_results`
  MODIFY `evaluation_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `pairwise_comparisons`
--
ALTER TABLE `pairwise_comparisons`
  MODIFY `comparison_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `periods`
--
ALTER TABLE `periods`
  MODIFY `period_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `question_categories`
--
ALTER TABLE `question_categories`
  MODIFY `category_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `question_subcategories`
--
ALTER TABLE `question_subcategories`
  MODIFY `subcategory_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `teachers`
--
ALTER TABLE `teachers`
  MODIFY `teacher_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `teacher_question_scores`
--
ALTER TABLE `teacher_question_scores`
  MODIFY `score_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=281;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ahp_normalizations`
--
ALTER TABLE `ahp_normalizations`
  ADD CONSTRAINT `ahp_normalizations_ahp_result_id_foreign` FOREIGN KEY (`ahp_result_id`) REFERENCES `ahp_results` (`ahp_result_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ahp_results`
--
ALTER TABLE `ahp_results`
  ADD CONSTRAINT `ahp_results_calculated_by_foreign` FOREIGN KEY (`calculated_by`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ahp_results_period_id_foreign` FOREIGN KEY (`period_id`) REFERENCES `periods` (`period_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `ahp_weights`
--
ALTER TABLE `ahp_weights`
  ADD CONSTRAINT `ahp_weights_ahp_result_id_foreign` FOREIGN KEY (`ahp_result_id`) REFERENCES `ahp_results` (`ahp_result_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `evaluation_results`
--
ALTER TABLE `evaluation_results`
  ADD CONSTRAINT `evaluation_results_ahp_result_id_foreign` FOREIGN KEY (`ahp_result_id`) REFERENCES `ahp_results` (`ahp_result_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `evaluation_results_period_id_foreign` FOREIGN KEY (`period_id`) REFERENCES `periods` (`period_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `evaluation_results_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`teacher_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pairwise_comparisons`
--
ALTER TABLE `pairwise_comparisons`
  ADD CONSTRAINT `pairwise_comparisons_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pairwise_comparisons_criteria_id_1_foreign` FOREIGN KEY (`criteria_id_1`) REFERENCES `question_categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pairwise_comparisons_criteria_id_2_foreign` FOREIGN KEY (`criteria_id_2`) REFERENCES `question_categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pairwise_comparisons_period_id_foreign` FOREIGN KEY (`period_id`) REFERENCES `periods` (`period_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `questions`
--
ALTER TABLE `questions`
  ADD CONSTRAINT `questions_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `question_categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `questions_subcategory_id_foreign` FOREIGN KEY (`subcategory_id`) REFERENCES `question_subcategories` (`subcategory_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `question_subcategories`
--
ALTER TABLE `question_subcategories`
  ADD CONSTRAINT `question_subcategories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `question_categories` (`category_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teachers`
--
ALTER TABLE `teachers`
  ADD CONSTRAINT `teachers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `teacher_question_scores`
--
ALTER TABLE `teacher_question_scores`
  ADD CONSTRAINT `teacher_question_scores_given_by_foreign` FOREIGN KEY (`given_by`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teacher_question_scores_period_id_foreign` FOREIGN KEY (`period_id`) REFERENCES `periods` (`period_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teacher_question_scores_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`question_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teacher_question_scores_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `teachers` (`teacher_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
