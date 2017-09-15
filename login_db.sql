-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 15, 2017 at 08:22 AM
-- Server version: 5.7.19-0ubuntu0.16.04.1
-- PHP Version: 7.0.22-0ubuntu0.16.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_activations`
--

CREATE TABLE `account_activations` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `activation_key` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Information Technology', '2017-08-28 23:27:59', '2017-08-28 23:27:59'),
(2, 'Accounting', '2017-08-28 23:27:59', '2017-08-28 23:27:59');

-- --------------------------------------------------------

--
-- Table structure for table `emergencies`
--

CREATE TABLE `emergencies` (
  `id` bigint(20) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `emergency_recipients`
--

CREATE TABLE `emergency_recipients` (
  `id` bigint(20) NOT NULL,
  `batch_id` bigint(20) NOT NULL,
  `recipient_id` varchar(255) DEFAULT NULL,
  `recipient` varchar(255) NOT NULL,
  `remarks` text,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `emergency_recipients`
--

INSERT INTO `emergency_recipients` (`id`, `batch_id`, `recipient_id`, `recipient`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 911111, NULL, '639330442353', 'a:no', '2017-09-05 14:00:43', '2017-09-05 14:00:43'),
(2, 911111, NULL, '639176710089', 'a:no', '2017-09-05 14:00:43', '2017-09-05 14:00:43'),
(3, 759158, 's:5', '639157559924', NULL, '2017-09-06 16:11:43', '2017-09-06 16:11:43'),
(4, 759158, 's:6', '639556898908', NULL, '2017-09-06 16:11:43', '2017-09-06 16:11:43'),
(5, 759158, 's:7', '639052134991', NULL, '2017-09-06 16:11:43', '2017-09-06 16:11:43'),
(6, 759158, 's:8', '639053451736', NULL, '2017-09-06 16:11:43', '2017-09-06 16:11:43'),
(7, 759158, 's:9', '639059291642', NULL, '2017-09-06 16:11:43', '2017-09-06 16:11:43'),
(8, 759158, 's:10', '639278194356', NULL, '2017-09-06 16:11:43', '2017-09-06 16:11:43'),
(9, 759158, 'p:2', '639330442353', NULL, '2017-09-06 16:11:43', '2017-09-06 16:11:43'),
(10, 759158, 'p:3', '639176710089', NULL, '2017-09-06 16:11:43', '2017-09-06 16:11:43'),
(11, 1253907066, 's:5', '639157559924', NULL, '2017-09-06 18:37:20', '2017-09-06 18:37:20'),
(12, 1253907066, 's:6', '639556898908', NULL, '2017-09-06 18:37:20', '2017-09-06 18:37:20'),
(13, 1253907066, 's:7', '639052134991', NULL, '2017-09-06 18:37:20', '2017-09-06 18:37:20'),
(14, 1253907066, 's:8', '639053451736', NULL, '2017-09-06 18:37:20', '2017-09-06 18:37:20'),
(15, 1253907066, 's:9', '639059291642', NULL, '2017-09-06 18:37:20', '2017-09-06 18:37:20'),
(16, 1253907066, 's:10', '639278194356', NULL, '2017-09-06 18:37:20', '2017-09-06 18:37:20'),
(17, 1253907066, 'p:2', '639330442353', NULL, '2017-09-06 18:37:20', '2017-09-06 18:37:20'),
(18, 1253907066, 'p:3', '639176710089', NULL, '2017-09-06 18:37:20', '2017-09-06 18:37:20'),
(19, 527302, 's:5', '639157559924', NULL, '2017-09-06 19:18:48', '2017-09-06 19:18:48'),
(20, 527302, 's:6', '639556898908', 'a:no', '2017-09-06 19:18:48', '2017-09-06 19:18:48'),
(21, 527302, 's:7', '639052134991', '1', '2017-09-06 19:18:48', '2017-09-06 19:18:48'),
(22, 527302, 's:8', '639053451736', NULL, '2017-09-06 19:18:48', '2017-09-06 19:18:48'),
(23, 527302, 's:9', '639059291642', NULL, '2017-09-06 19:18:48', '2017-09-06 19:18:48'),
(24, 527302, 's:10', '639278194356', NULL, '2017-09-06 19:18:48', '2017-09-06 19:18:48'),
(25, 527302, 'p:2', '639330442353', NULL, '2017-09-06 19:18:48', '2017-09-06 19:18:48'),
(26, 527302, 'p:3', '639176710089', NULL, '2017-09-06 19:18:48', '2017-09-06 19:18:48');

-- --------------------------------------------------------

--
-- Table structure for table `emergency_responses`
--

CREATE TABLE `emergency_responses` (
  `id` bigint(20) NOT NULL,
  `response` text NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `emergency_id` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `enrolled_subjects`
--

CREATE TABLE `enrolled_subjects` (
  `id` bigint(20) NOT NULL,
  `enrollee_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enrolled_subjects`
--

INSERT INTO `enrolled_subjects` (`id`, `enrollee_id`, `subject_id`, `created_at`, `updated_at`) VALUES
(4, 5, 1, '2017-08-10 17:14:02', '2017-08-10 17:14:02'),
(5, 6, 1, '2017-08-10 17:14:02', '2017-08-10 17:14:02'),
(6, 7, 2, '2017-08-10 17:14:02', '2017-08-10 17:14:02'),
(7, 8, 2, '2017-08-10 17:14:02', '2017-08-10 17:14:02'),
(8, 9, 3, '2017-08-10 17:14:02', '2017-08-10 17:14:02'),
(9, 10, 3, '2017-08-10 17:14:02', '2017-08-10 17:14:02');

-- --------------------------------------------------------

--
-- Table structure for table `enrollees`
--

CREATE TABLE `enrollees` (
  `id` bigint(20) NOT NULL,
  `student_id` bigint(20) NOT NULL,
  `school_year_id` int(11) NOT NULL,
  `school_course_id` int(11) NOT NULL,
  `school_section_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `enrollees`
--

INSERT INTO `enrollees` (`id`, `student_id`, `school_year_id`, `school_course_id`, `school_section_id`, `created_at`, `updated_at`) VALUES
(5, 5, 1, 1, 1, '2017-08-10 17:12:04', '2017-08-10 17:12:04'),
(6, 6, 1, 1, 2, '2017-08-10 17:12:04', '2017-08-10 17:12:04'),
(7, 7, 1, 1, 4, '2017-08-10 17:12:04', '2017-08-10 17:12:04'),
(8, 8, 1, 1, 3, '2017-08-10 17:12:04', '2017-08-10 17:12:04'),
(9, 9, 1, 2, 5, '2017-08-10 17:12:04', '2017-08-10 17:12:04'),
(10, 10, 1, 2, 6, '2017-08-10 17:12:04', '2017-08-10 17:12:04');

-- --------------------------------------------------------

--
-- Table structure for table `handle_courses`
--

CREATE TABLE `handle_courses` (
  `id` bigint(20) NOT NULL,
  `user_type_id` bigint(20) NOT NULL,
  `school_course_id` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `handle_courses`
--

INSERT INTO `handle_courses` (`id`, `user_type_id`, `school_course_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '2017-08-21 11:53:08', '2017-08-21 11:53:08'),
(2, 1, 2, '2017-08-21 11:53:08', '2017-08-21 11:53:08'),
(7, 7, 1, '2017-08-21 12:52:44', '2017-08-21 12:52:44'),
(9, 2, 1, '2017-08-21 13:16:47', '2017-08-21 13:16:47'),
(10, 2, 2, '2017-08-21 13:16:47', '2017-08-21 13:16:47'),
(11, 9, 1, '2017-08-29 21:49:12', '2017-08-29 21:49:12');

-- --------------------------------------------------------

--
-- Table structure for table `login_logs`
--

CREATE TABLE `login_logs` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `remarks` text NOT NULL,
  `status_id` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_logs`
--

INSERT INTO `login_logs` (`id`, `user_id`, `ip_address`, `remarks`, `status_id`, `created_at`, `updated_at`) VALUES
(111, 2, '127.0.0.1', 'Successful', 1, '2017-08-10 17:20:05', '2017-08-10 17:20:05'),
(112, 1, '127.0.0.1', 'Successful', 1, '2017-08-10 17:24:51', '2017-08-10 17:24:51'),
(113, 1, '127.0.0.1', 'Successful', 1, '2017-08-10 17:25:03', '2017-08-10 17:25:03'),
(114, NULL, '127.0.0.1', 'Failed', 2, '2017-08-11 13:21:27', '2017-08-11 13:21:27'),
(115, NULL, '127.0.0.1', 'Failed', 2, '2017-08-11 13:21:59', '2017-08-11 13:21:59'),
(116, NULL, '127.0.0.1', 'Failed', 2, '2017-08-11 13:22:34', '2017-08-11 13:22:34'),
(117, NULL, '127.0.0.1', 'Failed', 2, '2017-08-12 08:20:03', '2017-08-12 08:20:03'),
(118, 1, '127.0.0.1', 'Successful', 1, '2017-08-12 08:20:12', '2017-08-12 08:20:12'),
(119, 1, '127.0.0.1', 'Successful', 1, '2017-08-13 12:24:05', '2017-08-13 12:24:05'),
(120, 2, '127.0.0.1', 'Successful', 1, '2017-08-13 12:24:29', '2017-08-13 12:24:29'),
(121, NULL, '127.0.0.1', 'Failed', 2, '2017-08-16 15:12:05', '2017-08-16 15:12:05'),
(122, NULL, '127.0.0.1', 'Failed', 2, '2017-08-16 15:12:31', '2017-08-16 15:12:31'),
(123, 1, '127.0.0.1', 'Successful', 1, '2017-08-16 15:12:37', '2017-08-16 15:12:37'),
(124, 1, '127.0.0.1', 'Successful', 1, '2017-08-16 16:10:17', '2017-08-16 16:10:17'),
(125, 1, '127.0.0.1', 'Successful', 1, '2017-08-16 18:40:27', '2017-08-16 18:40:27'),
(126, 1, '127.0.0.1', 'Successful', 1, '2017-08-16 23:17:46', '2017-08-16 23:17:46'),
(127, 1, '127.0.0.1', 'Successful', 1, '2017-08-17 09:20:28', '2017-08-17 09:20:28'),
(128, 1, '127.0.0.1', 'Successful', 1, '2017-08-17 12:00:17', '2017-08-17 12:00:17'),
(129, 1, '127.0.0.1', 'Successful', 1, '2017-08-17 14:13:01', '2017-08-17 14:13:01'),
(130, 1, '127.0.0.1', 'Successful', 1, '2017-08-17 15:59:24', '2017-08-17 15:59:24'),
(131, 1, '127.0.0.1', 'Successful', 1, '2017-08-19 01:33:25', '2017-08-19 01:33:25'),
(132, 1, '127.0.0.1', 'Successful', 1, '2017-08-19 16:31:28', '2017-08-19 16:31:28'),
(133, 1, '127.0.0.1', 'Successful', 1, '2017-08-19 17:10:04', '2017-08-19 17:10:04'),
(134, 1, '127.0.0.1', 'Successful', 1, '2017-08-19 22:52:48', '2017-08-19 22:52:48'),
(135, 1, '127.0.0.1', 'Successful', 1, '2017-08-20 00:14:59', '2017-08-20 00:14:59'),
(136, 1, '127.0.0.1', 'Successful', 1, '2017-08-20 04:11:12', '2017-08-20 04:11:12'),
(137, 1, '127.0.0.1', 'Successful', 1, '2017-08-20 10:01:42', '2017-08-20 10:01:42'),
(138, 1, '127.0.0.1', 'Successful', 1, '2017-08-20 10:49:12', '2017-08-20 10:49:12'),
(139, 1, '127.0.0.1', 'Successful', 1, '2017-08-20 13:37:05', '2017-08-20 13:37:05'),
(140, 1, '127.0.0.1', 'Successful', 1, '2017-08-20 20:30:58', '2017-08-20 20:30:58'),
(141, 2, '127.0.0.1', 'Successful', 1, '2017-08-20 20:38:07', '2017-08-20 20:38:07'),
(142, 2, '127.0.0.1', 'Successful', 1, '2017-08-20 21:47:44', '2017-08-20 21:47:44'),
(143, 1, '127.0.0.1', 'Successful', 1, '2017-08-20 23:55:36', '2017-08-20 23:55:36'),
(144, 1, '127.0.0.1', 'Successful', 1, '2017-08-21 01:14:01', '2017-08-21 01:14:01'),
(145, 1, '127.0.0.1', 'Successful', 1, '2017-08-21 11:13:13', '2017-08-21 11:13:13'),
(146, 2, '127.0.0.1', 'Successful', 1, '2017-08-21 13:11:58', '2017-08-21 13:11:58'),
(147, 1, '127.0.0.1', 'Successful', 1, '2017-08-21 13:16:41', '2017-08-21 13:16:41'),
(148, 2, '127.0.0.1', 'Successful', 1, '2017-08-21 13:16:54', '2017-08-21 13:16:54'),
(149, 1, '127.0.0.1', 'Successful', 1, '2017-08-21 13:21:41', '2017-08-21 13:21:41'),
(150, 1, '127.0.0.1', 'Successful', 1, '2017-08-26 22:18:22', '2017-08-26 22:18:22'),
(151, 2, '127.0.0.1', 'Successful', 1, '2017-08-27 01:49:44', '2017-08-27 01:49:44'),
(152, 1, '127.0.0.1', 'Successful', 1, '2017-08-27 01:55:01', '2017-08-27 01:55:01'),
(153, 2, '127.0.0.1', 'Successful', 1, '2017-08-27 02:11:43', '2017-08-27 02:11:43'),
(154, 1, '127.0.0.1', 'Successful', 1, '2017-08-27 02:12:07', '2017-08-27 02:12:07'),
(155, 1, '127.0.0.1', 'Successful', 1, '2017-08-28 14:34:00', '2017-08-28 14:34:00'),
(156, 2, '127.0.0.1', 'Successful', 1, '2017-08-28 14:46:57', '2017-08-28 14:46:57'),
(157, 1, '127.0.0.1', 'Successful', 1, '2017-08-28 23:22:35', '2017-08-28 23:22:35'),
(158, 2, '127.0.0.1', 'Successful', 1, '2017-08-28 23:53:17', '2017-08-28 23:53:17'),
(159, 1, '127.0.0.1', 'Successful', 1, '2017-08-29 09:58:30', '2017-08-29 09:58:30'),
(160, 1, '127.0.0.1', 'Successful', 1, '2017-08-29 16:58:14', '2017-08-29 16:58:14'),
(161, 1, '127.0.0.1', 'Successful', 1, '2017-08-29 21:09:56', '2017-08-29 21:09:56'),
(162, 2, '127.0.0.1', 'Successful', 1, '2017-08-29 21:19:32', '2017-08-29 21:19:32'),
(163, 1, '127.0.0.1', 'Successful', 1, '2017-08-29 21:37:37', '2017-08-29 21:37:37'),
(164, 2, '127.0.0.1', 'Successful', 1, '2017-08-29 22:44:17', '2017-08-29 22:44:17'),
(165, NULL, '127.0.0.1', 'Failed', 2, '2017-09-02 23:03:04', '2017-09-02 23:03:04'),
(166, 1, '127.0.0.1', 'Successful', 1, '2017-09-02 23:03:40', '2017-09-02 23:03:40'),
(167, 1, '127.0.0.1', 'Successful', 1, '2017-09-03 00:28:07', '2017-09-03 00:28:07'),
(168, 2, '127.0.0.1', 'Successful', 1, '2017-09-03 00:28:38', '2017-09-03 00:28:38'),
(169, 1, '127.0.0.1', 'Successful', 1, '2017-09-03 00:29:24', '2017-09-03 00:29:24'),
(170, 1, '127.0.0.1', 'Successful', 1, '2017-09-03 23:23:40', '2017-09-03 23:23:40'),
(171, 1, '127.0.0.1', 'Successful', 1, '2017-09-04 09:32:06', '2017-09-04 09:32:06'),
(172, 1, '127.0.0.1', 'Successful', 1, '2017-09-04 10:35:17', '2017-09-04 10:35:17'),
(173, 1, '127.0.0.1', 'Successful', 1, '2017-09-04 11:56:34', '2017-09-04 11:56:34'),
(174, 1, '127.0.0.1', 'Successful', 1, '2017-09-04 12:48:31', '2017-09-04 12:48:31'),
(175, 1, '127.0.0.1', 'Successful', 1, '2017-09-04 12:48:49', '2017-09-04 12:48:49'),
(176, 1, '127.0.0.1', 'Successful', 1, '2017-09-04 12:49:57', '2017-09-04 12:49:57'),
(177, 1, '127.0.0.1', 'Successful', 1, '2017-09-04 16:12:50', '2017-09-04 16:12:50'),
(178, 1, '127.0.0.1', 'Successful', 1, '2017-09-05 09:51:27', '2017-09-05 09:51:27'),
(179, 1, '127.0.0.1', 'Successful', 1, '2017-09-05 09:59:28', '2017-09-05 09:59:28'),
(180, 1, '127.0.0.1', 'Successful', 1, '2017-09-05 10:02:06', '2017-09-05 10:02:06'),
(181, 1, '127.0.0.1', 'Successful', 1, '2017-09-05 10:19:45', '2017-09-05 10:19:45'),
(182, 2, '127.0.0.1', 'Successful', 1, '2017-09-05 14:31:02', '2017-09-05 14:31:02'),
(183, 2, '127.0.0.1', 'Successful', 1, '2017-09-05 14:33:01', '2017-09-05 14:33:01'),
(184, 1, '127.0.0.1', 'Successful', 1, '2017-09-05 15:00:36', '2017-09-05 15:00:36'),
(185, 2, '127.0.0.1', 'Successful', 1, '2017-09-06 16:16:32', '2017-09-06 16:16:32'),
(186, 1, '127.0.0.1', 'Successful', 1, '2017-09-13 00:23:21', '2017-09-13 00:23:21');

-- --------------------------------------------------------

--
-- Table structure for table `logout_logs`
--

CREATE TABLE `logout_logs` (
  `id` bigint(20) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `remarks` text,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `logout_logs`
--

INSERT INTO `logout_logs` (`id`, `user_id`, `ip_address`, `remarks`, `created_at`, `updated_at`) VALUES
(10, 1, '127.0.0.1', '', '2017-08-10 17:19:56', '2017-08-10 17:19:56'),
(11, 2, '127.0.0.1', '', '2017-08-10 17:24:47', '2017-08-10 17:24:47'),
(12, 1, '127.0.0.1', '', '2017-08-10 17:24:57', '2017-08-10 17:24:57'),
(13, 1, '127.0.0.1', 'Successful', '2017-08-20 20:38:02', '2017-08-20 20:38:02'),
(14, 1, '127.0.0.1', 'Successful', '2017-08-21 13:11:51', '2017-08-21 13:11:51'),
(15, 2, '127.0.0.1', 'Successful', '2017-08-21 13:16:37', '2017-08-21 13:16:37'),
(16, 1, '127.0.0.1', 'Successful', '2017-08-21 13:16:49', '2017-08-21 13:16:49'),
(17, 2, '127.0.0.1', 'Successful', '2017-08-21 13:21:17', '2017-08-21 13:21:17'),
(18, 1, '127.0.0.1', 'Successful', '2017-08-27 01:49:38', '2017-08-27 01:49:38'),
(19, 2, '127.0.0.1', 'Successful', '2017-08-27 01:54:57', '2017-08-27 01:54:57'),
(20, 1, '127.0.0.1', 'Successful', '2017-08-27 02:11:35', '2017-08-27 02:11:35'),
(21, 2, '127.0.0.1', 'Successful', '2017-08-27 02:12:02', '2017-08-27 02:12:02'),
(22, 1, '127.0.0.1', 'Successful', '2017-08-28 14:46:49', '2017-08-28 14:46:49'),
(23, 1, '127.0.0.1', 'Successful', '2017-08-29 16:58:10', '2017-08-29 16:58:10'),
(24, 1, '127.0.0.1', 'Successful', '2017-08-29 21:19:24', '2017-08-29 21:19:24'),
(25, 2, '127.0.0.1', 'Successful', '2017-08-29 21:42:47', '2017-08-29 21:42:47'),
(26, 1, '127.0.0.1', 'Successful', '2017-09-03 00:28:27', '2017-09-03 00:28:27'),
(27, 1, '127.0.0.1', 'Successful', '2017-09-04 12:48:44', '2017-09-04 12:48:44'),
(28, 1, '127.0.0.1', 'Successful', '2017-09-04 12:49:53', '2017-09-04 12:49:53'),
(29, 1, '127.0.0.1', 'Successful', '2017-09-05 10:00:27', '2017-09-05 10:00:27'),
(30, 1, '127.0.0.1', 'Successful', '2017-09-05 10:01:34', '2017-09-05 10:01:34'),
(31, 1, '127.0.0.1', 'Successful', '2017-09-05 10:19:34', '2017-09-05 10:19:34'),
(32, 1, '127.0.0.1', 'Successful', '2017-09-05 14:30:56', '2017-09-05 14:30:56'),
(33, 2, '127.0.0.1', 'Successful', '2017-09-05 14:32:52', '2017-09-05 14:32:52'),
(34, 2, '127.0.0.1', 'Successful', '2017-09-05 15:00:26', '2017-09-05 15:00:26'),
(35, 1, '127.0.0.1', 'Successful', '2017-09-07 09:58:36', '2017-09-07 09:58:36');

-- --------------------------------------------------------

--
-- Table structure for table `message_recipients`
--

CREATE TABLE `message_recipients` (
  `id` bigint(20) NOT NULL,
  `batch_id` bigint(20) NOT NULL,
  `student_id` bigint(20) NOT NULL,
  `recipient` varchar(255) DEFAULT NULL,
  `remarks` text,
  `message_type_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message_recipients`
--

INSERT INTO `message_recipients` (`id`, `batch_id`, `student_id`, `recipient`, `remarks`, `message_type_id`, `created_at`, `updated_at`) VALUES
(1, 1253508857, 0, '639157559924', NULL, 1, '2017-09-06 11:22:30', '2017-09-06 11:22:30'),
(2, 1253508857, 0, '639556898908', NULL, 1, '2017-09-06 11:22:30', '2017-09-06 11:22:30'),
(3, 1253508857, 0, '639052134991', NULL, 1, '2017-09-06 11:22:30', '2017-09-06 11:22:30'),
(4, 1253508857, 0, '639053451736', NULL, 1, '2017-09-06 11:22:30', '2017-09-06 11:22:30'),
(5, 934978, 0, '639278194356', NULL, 1, '2017-09-06 11:37:32', '2017-09-06 11:37:32'),
(6, 934978, 0, '639059291642', NULL, 1, '2017-09-06 11:37:33', '2017-09-06 11:37:33'),
(7, 779152, 0, '639556898908', NULL, 4, '2017-09-06 16:16:53', '2017-09-06 16:16:53'),
(8, 779152, 0, '639157559924', NULL, 4, '2017-09-06 16:16:53', '2017-09-06 16:16:53'),
(9, 832689, 0, '639278194356', NULL, 4, '2017-09-06 16:17:57', '2017-09-06 16:17:57'),
(10, 832689, 0, '639059291642', NULL, 4, '2017-09-06 16:17:57', '2017-09-06 16:17:57'),
(11, 832689, 0, '639157559924', NULL, 4, '2017-09-06 16:17:57', '2017-09-06 16:17:57'),
(12, 832689, 0, '639556898908', NULL, 4, '2017-09-06 16:17:57', '2017-09-06 16:17:57'),
(13, 832689, 0, '639052134991', NULL, 4, '2017-09-06 16:17:57', '2017-09-06 16:17:57'),
(14, 832689, 0, '639053451736', NULL, 4, '2017-09-06 16:17:57', '2017-09-06 16:17:57'),
(15, 478243, 0, '639278194356', NULL, 4, '2017-09-06 16:18:48', '2017-09-06 16:18:48'),
(16, 478243, 0, '639059291642', NULL, 4, '2017-09-06 16:18:48', '2017-09-06 16:18:48'),
(17, 752367, 10, '639278194356', 'survey', 2, '2017-09-06 16:22:42', '2017-09-06 16:22:42'),
(18, 752367, 0, '639556898908', NULL, 2, '2017-09-06 16:22:42', '2017-09-06 16:22:42'),
(19, 752367, 0, '639052134991', NULL, 2, '2017-09-06 16:22:42', '2017-09-06 16:22:42'),
(20, 752367, 0, '639053451736', NULL, 2, '2017-09-06 16:22:42', '2017-09-06 16:22:42'),
(21, 143872, 10, '639278194356', NULL, 1, '2017-09-06 16:54:55', '2017-09-06 16:54:55'),
(22, 143872, 9, '639059291642', NULL, 1, '2017-09-06 16:54:55', '2017-09-06 16:54:55');

-- --------------------------------------------------------

--
-- Table structure for table `message_types`
--

CREATE TABLE `message_types` (
  `id` bigint(20) NOT NULL,
  `type` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_repliable` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `message_types`
--

INSERT INTO `message_types` (`id`, `type`, `created_at`, `updated_at`, `is_repliable`) VALUES
(1, 'Announcement', '2017-08-07 21:52:00', '2017-08-07 21:52:00', 0),
(2, 'Survey', '2017-08-07 21:52:00', '2017-08-07 21:52:00', 1),
(3, 'Emergency', '2017-08-07 21:52:00', '2017-08-07 21:52:00', 1),
(4, 'Groupings', '2017-08-07 21:52:00', '2017-08-07 21:52:00', 0);

-- --------------------------------------------------------

--
-- Table structure for table `password_types`
--

CREATE TABLE `password_types` (
  `id` bigint(20) NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `password_types`
--

INSERT INTO `password_types` (`id`, `type`, `created_at`, `updated_at`) VALUES
(1, 'System Generated', '2017-06-14 23:28:37', '2017-06-14 23:28:37'),
(2, 'Manual Input', '2017-06-14 23:28:37', '2017-06-14 23:28:37');

-- --------------------------------------------------------

--
-- Table structure for table `professor_subjects`
--

CREATE TABLE `professor_subjects` (
  `id` bigint(20) NOT NULL,
  `professor_id` bigint(20) NOT NULL,
  `school_subject_id` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `professor_subjects`
--

INSERT INTO `professor_subjects` (`id`, `professor_id`, `school_subject_id`, `created_at`, `updated_at`) VALUES
(7, 2, 1, '2017-09-13 11:15:45', '2017-09-13 11:15:45'),
(8, 2, 3, '2017-09-13 11:15:45', '2017-09-13 11:15:45'),
(9, 2, 2, '2017-09-13 11:15:45', '2017-09-13 11:15:45');

-- --------------------------------------------------------

--
-- Table structure for table `response_messages`
--

CREATE TABLE `response_messages` (
  `id` bigint(20) NOT NULL,
  `msisdn` varchar(255) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `msg_id` bigint(20) DEFAULT NULL,
  `message` text NOT NULL,
  `received_time` datetime NOT NULL,
  `referring_msg_id` bigint(20) DEFAULT NULL,
  `referring_batch_id` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `response_messages`
--

INSERT INTO `response_messages` (`id`, `msisdn`, `sender`, `msg_id`, `message`, `received_time`, `referring_msg_id`, `referring_batch_id`, `created_at`, `updated_at`) VALUES
(1, '752367', '639278194356', 29854363, 'sending reply 0826 0834', '2017-08-26 08:34:44', 1693951733, 752367, '2017-08-26 21:12:25', '2017-08-26 21:12:25');

-- --------------------------------------------------------

--
-- Table structure for table `school_courses`
--

CREATE TABLE `school_courses` (
  `id` bigint(20) NOT NULL,
  `description` varchar(255) NOT NULL,
  `acronym` varchar(255) NOT NULL,
  `department_id` bigint(20) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school_courses`
--

INSERT INTO `school_courses` (`id`, `description`, `acronym`, `department_id`, `created_at`, `updated_at`) VALUES
(1, 'AGD', 'i', 1, '2017-06-27 21:14:02', '2017-06-27 21:14:02'),
(2, 'BSIT', 'i', 1, '2017-06-27 21:14:02', '2017-06-27 21:14:02'),
(4, 'BSA', 'a', 2, '2017-08-16 21:47:50', '2017-08-16 21:47:50'),
(5, 'BSBA Accounting', 'a', 2, '2017-08-28 23:34:16', '2017-08-28 23:34:16');

-- --------------------------------------------------------

--
-- Table structure for table `school_fix_sections`
--

CREATE TABLE `school_fix_sections` (
  `id` int(11) NOT NULL,
  `section` varchar(255) DEFAULT NULL,
  `school_course_id` int(11) NOT NULL,
  `school_level_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school_fix_sections`
--

INSERT INTO `school_fix_sections` (`id`, `section`, `school_course_id`, `school_level_id`, `created_at`, `updated_at`) VALUES
(1, '403i', 1, 4, '2017-08-10 13:20:31', '2017-08-10 13:20:31'),
(2, '406i', 1, 4, '2017-08-10 13:20:31', '2017-08-10 13:20:31'),
(3, '403i', 1, 4, '2017-08-10 13:20:31', '2017-08-10 13:20:31'),
(4, '404i', 1, 4, '2017-08-10 13:20:31', '2017-08-10 13:20:31'),
(5, '301a', 2, 3, '2017-08-10 16:14:38', '2017-08-10 16:14:38'),
(6, '107a', 2, 1, '2017-08-16 21:19:35', '2017-08-16 21:19:35'),
(8, '207i', 1, 2, '2017-08-16 21:22:05', '2017-08-16 21:22:05');

-- --------------------------------------------------------

--
-- Table structure for table `school_levels`
--

CREATE TABLE `school_levels` (
  `id` int(11) NOT NULL,
  `level` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school_levels`
--

INSERT INTO `school_levels` (`id`, `level`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, '1st Year', '2017-08-09 15:14:26', '2017-08-09 15:14:26'),
(2, 2, '2nd Year', '2017-08-09 15:14:26', '2017-08-09 15:14:26'),
(3, 3, '3rd Year', '2017-08-09 15:14:26', '2017-08-09 15:14:26'),
(4, 4, '4th Year', '2017-08-09 15:14:26', '2017-08-09 15:14:26');

-- --------------------------------------------------------

--
-- Table structure for table `school_sections`
--

CREATE TABLE `school_sections` (
  `id` bigint(20) NOT NULL,
  `section` varchar(255) DEFAULT NULL,
  `school_level_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school_sections`
--

INSERT INTO `school_sections` (`id`, `section`, `school_level_id`, `created_at`, `updated_at`) VALUES
(1, '403i', 4, '2017-08-09 00:00:00', '2017-08-09 00:00:00'),
(2, '406i', 4, '2017-08-09 00:00:00', '2017-08-09 00:00:00'),
(3, '403i', 4, '2017-08-09 00:00:00', '2017-08-09 00:00:00'),
(4, '404i', 4, '2017-08-10 00:00:00', '2017-08-10 00:00:00'),
(5, '301a', 3, '2017-08-10 00:00:00', '2017-08-10 00:00:00'),
(6, '107a', 1, '2017-08-16 21:20:45', '2017-08-16 21:20:45'),
(8, '207i', 2, '2017-08-16 21:22:05', '2017-08-16 21:22:05');

-- --------------------------------------------------------

--
-- Table structure for table `school_subjects`
--

CREATE TABLE `school_subjects` (
  `id` bigint(20) NOT NULL,
  `code` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school_subjects`
--

INSERT INTO `school_subjects` (`id`, `code`, `description`, `created_at`, `updated_at`) VALUES
(1, '64', 'ITC-64', '2017-08-09 22:11:11', '2017-08-09 22:11:11'),
(2, '29', 'ITC-29', '2017-08-09 22:11:11', '2017-08-09 22:11:11'),
(3, '63', 'ITC-63', '2017-08-10 17:03:51', '2017-08-10 17:03:51'),
(4, '89', 'ITC-89', '2017-08-16 21:34:47', '2017-08-16 21:34:47');

-- --------------------------------------------------------

--
-- Table structure for table `school_years`
--

CREATE TABLE `school_years` (
  `id` bigint(20) NOT NULL,
  `year_from` int(11) NOT NULL,
  `year_to` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school_years`
--

INSERT INTO `school_years` (`id`, `year_from`, `year_to`, `created_at`, `updated_at`) VALUES
(1, 2017, 2018, '2017-06-27 21:16:33', '2017-06-27 21:16:33');

-- --------------------------------------------------------

--
-- Table structure for table `secret_questions`
--

CREATE TABLE `secret_questions` (
  `id` bigint(20) NOT NULL,
  `question` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `secret_questions`
--

INSERT INTO `secret_questions` (`id`, `question`, `created_at`, `updated_at`) VALUES
(1, 'What was your childhood nickname?', '2017-06-14 23:05:28', '2017-06-14 23:05:28'),
(2, 'What is the name of your favorite childhood friend?', '2017-06-14 23:05:42', '2017-06-14 23:05:42'),
(3, 'What was your favorite sport in high school?', '2017-06-14 23:05:42', '2017-06-14 23:05:42'),
(4, 'What was your favorite food as a child?', '2017-06-14 23:05:42', '2017-06-14 23:05:42'),
(5, 'Who is your childhood sports hero?', '2017-06-14 23:05:42', '2017-06-14 23:05:42');

-- --------------------------------------------------------

--
-- Table structure for table `sent_messages`
--

CREATE TABLE `sent_messages` (
  `id` bigint(20) NOT NULL,
  `response_code` varchar(255) DEFAULT NULL,
  `batch_id` bigint(20) DEFAULT NULL,
  `message` text,
  `user_id` bigint(20) NOT NULL,
  `message_type_id` bigint(20) NOT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sent_messages`
--

INSERT INTO `sent_messages` (`id`, `response_code`, `batch_id`, `message`, `user_id`, `message_type_id`, `remarks`, `created_at`, `updated_at`, `status`) VALUES
(2, NULL, 911111, 'asdasd', 1, 1, '1', '2017-09-05 11:37:49', '2017-09-05 11:37:49', 1),
(5, NULL, 911111, 'asd', 2, 4, '1', '2017-09-05 14:31:48', '2017-09-05 14:31:48', 1),
(6, NULL, 911111, 'ads', 2, 4, '1', '2017-09-05 14:33:24', '2017-09-05 14:33:24', 1),
(7, NULL, 911111, 'asd', 2, 4, '1', '2017-09-05 14:33:57', '2017-09-05 14:33:57', 1),
(9, NULL, 1253508857, 'asdasd', 1, 1, '1', '2017-09-06 11:22:30', '2017-09-06 11:22:30', 0),
(10, NULL, 694354, 'asd', 1, 1, '1', '2017-09-06 11:36:34', '2017-09-06 11:36:34', 0),
(11, NULL, 934978, 'asdsad', 1, 1, '1', '2017-09-06 11:37:32', '2017-09-06 11:37:32', 0),
(13, NULL, 779152, 'announcement as prof', 2, 4, '1', '2017-09-06 16:16:53', '2017-09-06 16:16:53', 0),
(14, NULL, 832689, 'announcement as chairman', 2, 4, '1', '2017-09-06 16:17:57', '2017-09-06 16:17:57', 0),
(15, NULL, 478243, 'message as dean', 2, 4, '1', '2017-09-06 16:18:48', '2017-09-06 16:18:48', 0),
(16, NULL, 752367, 'survey message', 1, 2, '1', '2017-09-06 16:22:41', '2017-09-06 16:22:41', 0),
(17, NULL, 143872, 'Hello announcement everyone', 1, 1, '1', '2017-09-06 16:54:54', '2017-09-06 16:54:54', 0),
(18, NULL, 1253907066, 'asdasd', 1, 3, '1', '2017-09-06 18:37:20', '2017-09-06 18:37:20', 0),
(19, NULL, 527302, 'asdsadsa', 1, 3, '1', '2017-09-06 19:18:48', '2017-09-06 19:18:48', 0);

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` bigint(20) NOT NULL,
  `description` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Active', '2017-06-14 23:19:26', '2017-06-14 23:19:26'),
(2, 'Inactive', '2017-06-14 23:19:26', '2017-06-14 23:19:26');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` bigint(20) NOT NULL,
  `student_code` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `mobile_number` varchar(20) NOT NULL,
  `course_id` int(11) NOT NULL DEFAULT '0',
  `year_section_id` bigint(20) NOT NULL DEFAULT '0',
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `student_code`, `first_name`, `middle_name`, `last_name`, `email_address`, `mobile_number`, `course_id`, `year_section_id`, `created_at`, `updated_at`) VALUES
(5, 'i-00005', 'Natalia', NULL, 'Ibarra', 'natalia.ibarra@gmail.com', '09157559924', 1, 0, '2017-08-10 17:03:00', '2017-08-10 17:03:00'),
(6, 'i-00006', 'Josh', NULL, 'David', 'josh.david@gmail.com', '09556898908', 1, 0, '2017-08-10 17:03:00', '2017-08-10 17:03:00'),
(7, 'i-00007', 'Hadeya', '', 'Riga', 'hadeya.riga@gmail.com', '09052134991', 1, 0, '2017-08-10 17:03:00', '2017-08-29 16:59:49'),
(8, 'i-00008', 'Jeremiah', NULL, 'Tolentino', 'jeremiah.tolentino@gmail.com', '09053451736', 1, 0, '2017-08-10 17:03:00', '2017-08-10 17:03:00'),
(9, 'a-00009', 'Folah', '', 'Dimayuga', 'folah.dimayuga@gmail.com', '09059291642', 2, 0, '2017-08-10 17:03:00', '2017-08-20 14:13:14'),
(10, 'a-00010', 'James', NULL, 'Virtucio', 'james.virtucio@gmail.com', '09278194356', 2, 0, '2017-08-10 17:03:00', '2017-08-10 17:03:00');

-- --------------------------------------------------------

--
-- Table structure for table `surveys`
--

CREATE TABLE `surveys` (
  `id` bigint(20) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `unknown_responses`
--

CREATE TABLE `unknown_responses` (
  `id` bigint(20) NOT NULL,
  `msisdn` varchar(255) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `msg_id` bigint(20) DEFAULT NULL,
  `message` text NOT NULL,
  `received_time` datetime NOT NULL,
  `referring_msg_id` bigint(20) DEFAULT NULL,
  `referring_batch_id` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `secret_question_id` bigint(20) DEFAULT NULL,
  `answer` text,
  `user_type_id` bigint(20) NOT NULL,
  `department_id` bigint(20) DEFAULT '0',
  `status_id` bigint(20) NOT NULL,
  `password_type_id` bigint(20) NOT NULL,
  `password_expiry_date` datetime NOT NULL,
  `ip_address` varchar(255) NOT NULL,
  `failed_login_attempt` int(11) NOT NULL,
  `failed_login_time` datetime DEFAULT NULL,
  `disable_login_failure` int(11) NOT NULL,
  `last_access` datetime DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email_address`, `username`, `password`, `secret_question_id`, `answer`, `user_type_id`, `department_id`, `status_id`, `password_type_id`, `password_expiry_date`, `ip_address`, `failed_login_attempt`, `failed_login_time`, `disable_login_failure`, `last_access`, `created_at`, `updated_at`) VALUES
(1, 'admin@gmail.com', 'admin', 'Admin1234$', 1, 'je', 1, 0, 1, 2, '2017-09-28 00:00:00', '127.0.0.2', 0, '2017-09-02 23:03:04', 0, '2017-08-10 00:15:06', '2017-06-15 11:16:11', '2017-06-15 11:16:11'),
(2, 'john.cena@gmail.com', 'jcena', 'John1234$', 1, 'JC', 8, 1, 1, 2, '2017-07-26 00:00:00', '127.0.0.1', 0, '2017-08-16 15:12:31', 0, '2017-08-10 01:43:28', '2017-06-26 18:03:02', '2017-06-26 18:03:02'),
(3, 'mj_caabaya@yahoo.com', 'root', 'BXcm6HL33O', 1, 'Mac', 2, 1, 1, 1, '2017-09-28 22:18:24', '127.0.0.1', 0, NULL, 0, NULL, '2017-08-29 22:18:24', '2017-08-29 22:18:24'),
(4, 'asdasd@gmail.com', 'aaaa', 'g1558FlAYY', 1, 'Mac', 2, 0, 1, 1, '2017-10-07 09:59:20', '127.0.0.1', 0, NULL, 0, NULL, '2017-09-07 09:59:20', '2017-09-07 09:59:20'),
(5, 'mj_caabayb@yahoo.com', 'bbb', 'gJ3GRzkTi8', 1, 'Mac', 2, 0, 1, 1, '2017-10-07 10:22:47', '127.0.0.1', 0, NULL, 0, NULL, '2017-09-07 10:22:47', '2017-09-07 10:22:47');

-- --------------------------------------------------------

--
-- Table structure for table `user_infos`
--

CREATE TABLE `user_infos` (
  `id` bigint(20) NOT NULL,
  `user_id` bigint(20) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `mobile_number` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_infos`
--

INSERT INTO `user_infos` (`id`, `user_id`, `first_name`, `middle_name`, `last_name`, `mobile_number`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', '', 'admin', '', '2017-06-15 11:16:11', '2017-06-15 11:16:11'),
(2, 2, 'John', 'M', 'Cena', '09330442353', '2017-06-26 18:03:39', '2017-06-26 18:03:39'),
(3, 3, 'Marc', 'V', 'Caabay', '09176710089', '2017-08-29 22:18:24', '2017-08-29 22:18:24'),
(4, 4, 'asdasd', 'asd', 'Caabay', '09176710089', '2017-09-07 09:59:20', '2017-09-07 09:59:20'),
(5, 5, 'Marc', 'V', 'Caabay', '09176710089', '2017-09-07 10:22:47', '2017-09-07 10:22:47');

-- --------------------------------------------------------

--
-- Table structure for table `user_types`
--

CREATE TABLE `user_types` (
  `id` bigint(20) NOT NULL,
  `type` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_types`
--

INSERT INTO `user_types` (`id`, `type`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '2017-06-14 23:24:20', '2017-06-14 23:24:20'),
(2, 'Professor', '2017-06-14 23:24:20', '2017-06-14 23:24:20'),
(7, 'Chairman', '2017-08-21 12:52:44', '2017-08-21 12:52:44'),
(8, 'Dean', '2017-08-28 23:30:18', '2017-08-28 23:30:18');

-- --------------------------------------------------------

--
-- Table structure for table `year_sections`
--

CREATE TABLE `year_sections` (
  `id` bigint(20) NOT NULL,
  `section` varchar(255) NOT NULL,
  `school_year_id` bigint(20) NOT NULL,
  `course_id` bigint(20) NOT NULL,
  `prof_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_activations`
--
ALTER TABLE `account_activations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emergencies`
--
ALTER TABLE `emergencies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emergency_recipients`
--
ALTER TABLE `emergency_recipients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emergency_responses`
--
ALTER TABLE `emergency_responses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrolled_subjects`
--
ALTER TABLE `enrolled_subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enrollees`
--
ALTER TABLE `enrollees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `handle_courses`
--
ALTER TABLE `handle_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_logs`
--
ALTER TABLE `login_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logout_logs`
--
ALTER TABLE `logout_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message_recipients`
--
ALTER TABLE `message_recipients`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message_types`
--
ALTER TABLE `message_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_types`
--
ALTER TABLE `password_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `professor_subjects`
--
ALTER TABLE `professor_subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `response_messages`
--
ALTER TABLE `response_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_courses`
--
ALTER TABLE `school_courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_fix_sections`
--
ALTER TABLE `school_fix_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_levels`
--
ALTER TABLE `school_levels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_sections`
--
ALTER TABLE `school_sections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_subjects`
--
ALTER TABLE `school_subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_years`
--
ALTER TABLE `school_years`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `secret_questions`
--
ALTER TABLE `secret_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sent_messages`
--
ALTER TABLE `sent_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `surveys`
--
ALTER TABLE `surveys`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unknown_responses`
--
ALTER TABLE `unknown_responses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_infos`
--
ALTER TABLE `user_infos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_types`
--
ALTER TABLE `user_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `year_sections`
--
ALTER TABLE `year_sections`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_activations`
--
ALTER TABLE `account_activations`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `emergencies`
--
ALTER TABLE `emergencies`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `emergency_recipients`
--
ALTER TABLE `emergency_recipients`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
--
-- AUTO_INCREMENT for table `emergency_responses`
--
ALTER TABLE `emergency_responses`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `enrolled_subjects`
--
ALTER TABLE `enrolled_subjects`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `enrollees`
--
ALTER TABLE `enrollees`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `handle_courses`
--
ALTER TABLE `handle_courses`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `login_logs`
--
ALTER TABLE `login_logs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=187;
--
-- AUTO_INCREMENT for table `logout_logs`
--
ALTER TABLE `logout_logs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `message_recipients`
--
ALTER TABLE `message_recipients`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
--
-- AUTO_INCREMENT for table `message_types`
--
ALTER TABLE `message_types`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `password_types`
--
ALTER TABLE `password_types`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `professor_subjects`
--
ALTER TABLE `professor_subjects`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `response_messages`
--
ALTER TABLE `response_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `school_courses`
--
ALTER TABLE `school_courses`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `school_fix_sections`
--
ALTER TABLE `school_fix_sections`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `school_levels`
--
ALTER TABLE `school_levels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `school_sections`
--
ALTER TABLE `school_sections`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `school_subjects`
--
ALTER TABLE `school_subjects`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `school_years`
--
ALTER TABLE `school_years`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `secret_questions`
--
ALTER TABLE `secret_questions`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `sent_messages`
--
ALTER TABLE `sent_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `surveys`
--
ALTER TABLE `surveys`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `unknown_responses`
--
ALTER TABLE `unknown_responses`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user_infos`
--
ALTER TABLE `user_infos`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `year_sections`
--
ALTER TABLE `year_sections`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
