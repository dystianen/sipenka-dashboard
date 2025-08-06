-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 06, 2025 at 12:06 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `kinerja_guru`
--

-- --------------------------------------------------------

--
-- Table structure for table `ahp_results`
--

CREATE TABLE `ahp_results` (
  `ahp_result_id` int(11) UNSIGNED NOT NULL,
  `period_id` int(11) UNSIGNED NOT NULL,
  `calculated_by` int(11) UNSIGNED NOT NULL,
  `weights` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`weights`)),
  `cr_value` float NOT NULL,
  `is_valid` tinyint(1) NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

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
(248, '2025-08-04-015435', 'App\\Database\\Migrations\\CreatePeriodsTable', 'default', 'App', 1754474239, 1),
(249, '2025-08-04-015436', 'App\\Database\\Migrations\\CreateUsersTable', 'default', 'App', 1754474239, 1),
(250, '2025-08-04-015448', 'App\\Database\\Migrations\\CreateTeachersTable', 'default', 'App', 1754474239, 1),
(251, '2025-08-04-015502', 'App\\Database\\Migrations\\CreateAhpResultsTable', 'default', 'App', 1754474239, 1),
(252, '2025-08-04-015504', 'App\\Database\\Migrations\\CreateEvaluationResultsTable', 'default', 'App', 1754474239, 1),
(253, '2025-08-04-130050', 'App\\Database\\Migrations\\CreateQuestionCategoriesTable', 'default', 'App', 1754474239, 1),
(254, '2025-08-04-130107', 'App\\Database\\Migrations\\CreateQuestionSubcategoriesTable', 'default', 'App', 1754474239, 1),
(255, '2025-08-04-130118', 'App\\Database\\Migrations\\CreateQuestionsTable', 'default', 'App', 1754474239, 1),
(256, '2025-08-04-130130', 'App\\Database\\Migrations\\CreateTeacherQuestionScoresTable', 'default', 'App', 1754474239, 1),
(257, '2025-08-04-130132', 'App\\Database\\Migrations\\CreatePairwiseComparisonsTable', 'default', 'App', 1754474239, 1);

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
(1, 'Semester Genap 2024', '2024-01-01', '2024-06-30', 0, '2025-08-06 09:57:28', NULL, NULL),
(2, 'Semester Ganjil 2024', '2024-07-01', '2024-12-31', 0, '2025-08-06 09:57:28', NULL, NULL),
(3, 'Semester Genap 2025', '2024-01-01', '2024-06-30', 0, '2025-08-06 09:57:28', NULL, NULL),
(4, 'Semester Ganjil 2025', '2024-07-01', '2024-12-31', 1, '2025-08-06 09:57:28', NULL, NULL);

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
(1, 1, 1, 'Terdapat: satuan pendidikan, kelas, semester, mata pelajaran atau tema pelajaran/sub tema, jumlah pertemuan', 'scale_1_3', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(2, 1, 2, 'Kesesuaian dengan Kompetensi Dasar', 'scale_1_3', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(3, 1, 2, 'Kesesuaian penggunaan kata kerja operasional dengan kompetensi yang diukur', 'scale_1_3', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(4, 1, 2, 'Kesesuaian rumusan dengan aspek pengetahuan', 'scale_1_3', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(5, 1, 2, 'Kesesuaian rumusan dengan aspek keterampilan', 'scale_1_3', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(6, 1, 3, 'Kesesuaian dengan indikator', 'scale_1_3', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(7, 1, 3, 'Kesesuaian perumusan dengan aspek Audience, Behaviour, Condition, dan Degree', 'scale_1_3', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(8, 1, 4, 'Kesesuaian dengan tujuan pembelajaran', 'scale_1_3', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(9, 1, 4, 'Kesesuaian dengan karakteristik peserta didik', 'scale_1_3', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(10, 1, 4, 'Keruntutan uraian materi ajar', 'scale_1_3', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(11, 1, 5, 'Kesesuaian dengan Tujuan Pembelajaran', 'scale_1_3', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(12, 1, 5, 'Kesesuaian dengan peserta didik', 'scale_1_3', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(13, 1, 5, 'Kesesuaian dengan aspek saintifik', 'scale_1_3', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(14, 1, 5, 'Kesesuaian dengan karakteristik peserta didik', 'scale_1_3', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(15, 1, 6, 'Kesesuaian dengan Tujuan Pembelajaran', 'scale_1_3', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(16, 1, 6, 'Kesesuaian dengan Materi Pembelajaran', 'scale_1_3', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(17, 1, 6, 'Kesesuaian dengan pendekatan saintifik', 'scale_1_3', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(18, 1, 6, 'Kesesuaian dengan karakteristik peserta didik', 'scale_1_3', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(19, 1, 7, 'Kesesuaian dengan tujuan Pembelajaran', 'scale_1_3', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(20, 1, 7, 'Kesesuaian dengan pendekatan saintifik', 'scale_1_3', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(21, 1, 7, 'Kesesuaian dengan karakteristik peserta didik', 'scale_1_3', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(22, 1, 8, 'Menampilkan kegiatan pendahuluan, inti, dan penutup dengan jelas', 'scale_1_3', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(23, 1, 8, 'Kesesuaian kegiatan dengan pendekatan saintific (mengamati, menanya, mengumpulkan informasi mengasosiasikan informasi, mengkomunisasikan) ', 'scale_1_3', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(24, 1, 8, 'Kesesuaian dengan metode pembelajaran', 'scale_1_3', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(25, 1, 8, 'Kesesuaian kegiatan dengan sistematika materi', 'scale_1_3', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(26, 1, 8, 'Kesesuaian alokasi waktu kegiatan pendahuluan, kegiatan inti dan kegiatan penutup dengan cakupan materi', 'scale_1_3', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(27, 1, 9, 'Kesesuaian bentuk, tekhnik dan instrument dengan indicator pencapaian kompetensi', 'scale_1_3', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(28, 1, 9, 'Kesesuaian antara bentuk, tekhnik dan instrument penilaian sikap', 'scale_1_3', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(29, 1, 9, 'Kesesuaian antara bentuk, tekhnik dan instrument penilaian Pengetahuan', 'scale_1_3', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(30, 1, 9, 'Kesesuaian antara bentuk, tekhnik dan instrument penilaian keterampilan', 'scale_1_3', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(31, 2, 10, 'Mengaitkan materi pembelajaran sekarang dengan pengalaman peserta didik atau pembelajaran sebelumnya', 'boolean', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(32, 2, 10, 'Mengajukan pertanyaan menantang', 'boolean', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(33, 2, 10, 'Menyampaikan manfaat materi pembelajaran', 'boolean', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(34, 2, 10, 'Mendemonstrasikan sesuatu yang terkait dengan materi pembelajaran', 'boolean', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(35, 2, 11, 'Menyampaikan kemampuan yang akan dicapai peserta didik', 'boolean', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(36, 2, 11, 'Menyampaikan rencana kegiatan misalnya, individual, kerja kelompok, dan melakukan observasi', 'boolean', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(37, 2, 12, 'Kemampuan menyesuaikan materi dengan tujuan pembelajaran', 'boolean', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(38, 2, 12, 'Kemampuan mengaitkan materi dengan pengetahuan lain yang relevan, perkembangan iptek, dan kehidupan nyata', 'boolean', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(39, 2, 12, 'Menyampaikan pembahasan materi pembelajaran dengan tepat', 'boolean', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(40, 2, 12, 'Menyampaikan materi secara sistematik (mudah ke sulit, dan dari konkret ke abstrak)', 'boolean', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(41, 2, 13, 'Melaksanakan pembelajaran yang sesuai dengan kompetensi yang akan dicapai', 'boolean', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(42, 2, 13, 'Memfasilitasi kegiatan yang memuat komponen eksplorasi, elaborasi, dan konfirmasi', 'boolean', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(43, 2, 13, 'Melaksanakan pembelajaran secara runtut', 'boolean', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(44, 2, 13, 'Menguasai kelas', 'boolean', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(45, 2, 13, 'Melaksanakan pembelajaran yang bersifat kontekstual', 'boolean', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(46, 2, 13, 'Melaksanakan pembelajaran yang memungkinkan tumbuhnya kebiasaan positif (nuturent effect)', 'boolean', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(47, 2, 13, 'Melaksanakan pembelajaran  sesuai dengan alokasi waktu yang direncanakan', 'boolean', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(48, 2, 14, 'Memberikan pertanyaan mengapa dan bagaimana', 'boolean', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(49, 2, 14, 'Memancing peserta didik untuk bertanya', 'boolean', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(50, 2, 14, 'Memfasilitasi peserta didik untuk mencoba', 'boolean', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(51, 2, 14, 'Memfasilitasi peserta didik untuk mengamati', 'boolean', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(52, 2, 14, 'Memfasilitasi peserta didik untuk menganalisis', 'boolean', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(53, 2, 14, 'Memberikan pertanyaan peserta didik untuk menalar (proses berfikir, yang logis dan sistematis)', 'boolean', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(54, 2, 14, 'Menyediakan kegiatan peserta didik untuk menyimpulkan', 'boolean', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(55, 2, 15, 'Menunjukkan keterampilan dalam penggunaan sumber belajar/pembelajaran', 'boolean', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(56, 2, 15, 'Menunjukkan keterampilan dalam penggunaan media pembelajaran', 'boolean', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(57, 2, 15, 'Menghasilkan pesan yang menarik', 'boolean', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(58, 2, 15, 'Melibatkan peserta didik dalam pemanfaatan sumber belajar pembelajaran', 'boolean', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(59, 2, 15, 'Melibatkan peserta didik dalam pemanfaatan media pembelajaran', 'boolean', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(60, 2, 16, 'Menumbuhkan partisipasi aktif peserta didik melalui interaksi guru, peserta didik, sumber belajar', 'boolean', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(61, 2, 16, 'Merespon positif partisipasi peserta didik', 'boolean', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(62, 2, 16, 'Menunjukkan sikap terbuka terhadap respon peserta didik', 'boolean', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(63, 2, 16, 'Menunjukkan hubungan antar pribadi yang kondusif', 'boolean', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(64, 2, 16, 'Menumbuhkan keceriaan atau antusiasme peserta didik dalam belajar', 'boolean', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(65, 2, 17, 'Menggunakan bahasa lisan secara jelas dan lancar', 'boolean', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(66, 2, 17, 'Menggunakan bahasa tulis yang baik dan benar', 'boolean', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(67, 2, 18, 'Melakukan refleksi atau membuat rangkuman dengan melibatkan peserta didik', 'boolean', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(68, 2, 18, 'Memberikan tes lisan atau tulisan', 'boolean', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(69, 2, 18, 'Mengumpulkan hasil kerja sebagai bahan portofolio', 'boolean', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(70, 2, 18, 'Melaksanakan tindak lanjut dengan memberikan arahan kegiatan berikutnya dan tugas pengayaan', 'boolean', 1, '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL);

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
(1, 'Instrumen Perencanaan Kegiatan Pembelajaran', 'Instrumen evaluasi terhadap perencanaan pembelajaran oleh guru', '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(2, 'Instrumen Penilaian Pelaksanaan Pembelajaran', 'Instrumen observasi pelaksanaan kegiatan belajar mengajar', '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL);

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
(1, 1, 'Identitas Mata Pelajaran', 'Identitas Mata Pelajaran', '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(2, 1, 'Perumusan Indikator', 'Perumusan Indikator', '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(3, 1, 'Perumusan Tujuan Pembelajaran', 'Perumusan Tujuan Pembelajaran', '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(4, 1, 'Pemilihan Materi Ajar', 'Pemilihan Materi Ajar', '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(5, 1, 'Pemilihan Sumber Belajar', 'Pemilihan Sumber Belajar', '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(6, 1, 'Pemilihan Media  Belajar', 'Pemilihan Media  Belajar', '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(7, 1, 'Metode Pembelajaran', 'Metode Pembelajaran', '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(8, 1, 'Skenario Pembelajaran', 'Skenario Pembelajaran', '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(9, 1, 'Rencana Penilaian Otentik', 'Rencana Penilaian Otentik', '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(10, 2, 'Aspek dan Motivasi', 'Aspek dan Motivasi', '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(11, 2, 'Pencapaian Kompetensi dan Rencana Kegiatan', 'Pencapaian Kompetensi dan Rencana Kegiatan', '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(12, 2, 'Penguasaan Materi Pelajaran', 'Penguasaan Materi Pelajaran', '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(13, 2, 'Penerapan Strategi Pembelajaran yang Mendidik', 'Penerapan Strategi Pembelajaran yang Mendidik', '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(14, 2, 'Penerapan Pendekatan Saintifik', 'Penerapan Pendekatan Saintifik', '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(15, 2, 'Pemanfaatan Sumber Belajar/Media dalam Pembelajaran', 'Pemanfaatan Sumber Belajar/Media dalam Pembelajaran', '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(16, 2, 'Pelibatan Peserta Didik dalam Pembelajaran', 'Pelibatan Peserta Didik dalam Pembelajaran', '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(17, 2, 'Penggunaan Bahasa yang Benar dan Tepat dalam Pembelajaran', 'Penggunaan Bahasa yang Benar dan Tepat dalam Pembelajaran', '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL),
(18, 2, 'Penutup Pembelajaran', 'Penutup Pembelajaran', '2025-08-06 09:57:28', '2025-08-06 09:57:28', NULL);

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
(1, 'Administrator', 'admin@gmail.com', '$2y$10$nNPnGbNVcLsj9ZYKiXfa/.7VLfw0sFOwSSlpzH67uP9KifOjaJVhC', 'admin', '2025-08-06 09:57:28', NULL, NULL),
(2, 'Kepala Sekolah', 'kepala@gmail.com', '$2y$10$w7gHOWhCLykzWyGgAYnacOQ6vQbegb4U82WgSisFkvNn8IVU/duVu', 'kepala_sekolah', '2025-08-06 09:57:28', NULL, NULL),
(3, 'Guru 1', 'guru1@gmail.com', '$2y$10$481lAUv37Hr9bqTSrJDDhuyp0Qlau4i8IJdbob4D4RlqjH3d0DZui', 'guru', '2025-08-06 09:57:28', NULL, NULL),
(4, 'Guru 2', 'guru2@gmail.com', '$2y$10$axQVGHkePkxmuw6PG5psAeQYCk4loDoS7SPCle0iECts5p3SsUXMa', 'guru', '2025-08-06 09:57:28', NULL, NULL),
(5, 'Guru 3', 'guru3@gmail.com', '$2y$10$u.IYdQpxMzvJiGK0fk8MueQxpazrN6aO47dlAdZtQf8Bu7y2FjAeS', 'guru', '2025-08-06 09:57:28', NULL, NULL),
(6, 'Guru 4', 'guru4@gmail.com', '$2y$10$lnGHBXNTKk4b7DrAt5xq4er0d.p4g/pAiXJBw.olr3LUcGtk4UGjO', 'guru', '2025-08-06 09:57:28', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ahp_results`
--
ALTER TABLE `ahp_results`
  ADD PRIMARY KEY (`ahp_result_id`),
  ADD KEY `ahp_results_period_id_foreign` (`period_id`),
  ADD KEY `ahp_results_calculated_by_foreign` (`calculated_by`);

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
-- AUTO_INCREMENT for table `ahp_results`
--
ALTER TABLE `ahp_results`
  MODIFY `ahp_result_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `evaluation_results`
--
ALTER TABLE `evaluation_results`
  MODIFY `evaluation_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=258;

--
-- AUTO_INCREMENT for table `pairwise_comparisons`
--
ALTER TABLE `pairwise_comparisons`
  MODIFY `comparison_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

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
  MODIFY `score_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ahp_results`
--
ALTER TABLE `ahp_results`
  ADD CONSTRAINT `ahp_results_calculated_by_foreign` FOREIGN KEY (`calculated_by`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ahp_results_period_id_foreign` FOREIGN KEY (`period_id`) REFERENCES `periods` (`period_id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
