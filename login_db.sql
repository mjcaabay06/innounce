-- phpMyAdmin SQL Dump
-- version 4.5.4.1deb2ubuntu2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Aug 28, 2017 at 04:07 PM
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
(9, 10, 3, '2017-08-10 17:14:02', '2017-08-10 17:14:02'),
(10, 11, 1, '2017-08-27 02:10:58', '2017-08-27 02:10:58');

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
(10, 10, 1, 2, 6, '2017-08-10 17:12:04', '2017-08-10 17:12:04'),
(11, 11, 1, 1, 8, '2017-08-27 02:10:58', '2017-08-27 02:10:58');

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
(10, 2, 2, '2017-08-21 13:16:47', '2017-08-21 13:16:47');

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
(156, 2, '127.0.0.1', 'Successful', 1, '2017-08-28 14:46:57', '2017-08-28 14:46:57');

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
(22, 1, '127.0.0.1', 'Successful', '2017-08-28 14:46:49', '2017-08-28 14:46:49');

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
(1, 2, 1, '2017-08-09 22:17:02', '2017-08-09 22:17:02'),
(2, 2, 2, '2017-08-09 22:17:02', '2017-08-09 22:17:02'),
(3, 2, 3, '2017-08-10 17:20:43', '2017-08-10 17:20:43');

-- --------------------------------------------------------

--
-- Table structure for table `response_messages`
--

CREATE TABLE `response_messages` (
  `id` bigint(20) NOT NULL,
  `msisdn` varchar(255) NOT NULL,
  `sender` varchar(255) NOT NULL,
  `msg_id` bigint(20) NOT NULL,
  `message` text NOT NULL,
  `received_time` datetime NOT NULL,
  `referring_msg_id` bigint(20) NOT NULL,
  `referring_batch_id` bigint(20) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `response_messages`
--

INSERT INTO `response_messages` (`id`, `msisdn`, `sender`, `msg_id`, `message`, `received_time`, `referring_msg_id`, `referring_batch_id`, `created_at`, `updated_at`) VALUES
(1, '44786201091', '63176710089', 29854363, 'sending reply 0826 0834', '2017-08-26 08:34:44', 1693951733, 1243690345, '2017-08-26 21:12:25', '2017-08-26 21:12:25');

-- --------------------------------------------------------

--
-- Table structure for table `school_courses`
--

CREATE TABLE `school_courses` (
  `id` bigint(20) NOT NULL,
  `description` varchar(255) NOT NULL,
  `acronym` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school_courses`
--

INSERT INTO `school_courses` (`id`, `description`, `acronym`, `created_at`, `updated_at`) VALUES
(1, 'Information Technology', 'i', '2017-06-27 21:14:02', '2017-06-27 21:14:02'),
(2, 'Accounting', 'a', '2017-06-27 21:14:02', '2017-06-27 21:14:02'),
(4, 'Management', 'm', '2017-08-16 21:47:50', '2017-08-16 21:47:50');

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
  `batch_id` bigint(20) DEFAULT NULL,
  `message` text,
  `user_id` bigint(20) NOT NULL,
  `message_type_id` bigint(20) NOT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sent_messages`
--

INSERT INTO `sent_messages` (`id`, `batch_id`, `message`, `user_id`, `message_type_id`, `remarks`, `created_at`, `updated_at`) VALUES
(1, 1243690345, 'Sample survey', 2, 3, NULL, '2017-08-26 00:00:00', '2017-08-26 00:00:00');

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
(7, 'i-00007', 'Hadeya', NULL, 'Riga', 'hadeya.riga@gmail.com', '09052134991', 1, 0, '2017-08-10 17:03:00', '2017-08-10 17:03:00'),
(8, 'i-00008', 'Jeremiah', NULL, 'Tolentino', 'jeremiah.tolentino@gmail.com', '09053451736', 1, 0, '2017-08-10 17:03:00', '2017-08-10 17:03:00'),
(9, 'a-00009', 'Folah', '', 'Dimayuga', 'folah.dimayuga@gmail.com', '09059291642', 2, 0, '2017-08-10 17:03:00', '2017-08-20 14:13:14'),
(10, 'a-00010', 'James', NULL, 'Virtucio', 'james.virtucio@gmail.com', '09278194356', 2, 0, '2017-08-10 17:03:00', '2017-08-10 17:03:00'),
(11, 'i-00011', 'Marc', 'V', 'Caabay', 'mj_caabay@yahoo.com', '09176710089', 1, 0, '2017-08-27 02:09:33', '2017-08-27 02:09:33');

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

INSERT INTO `users` (`id`, `email_address`, `username`, `password`, `secret_question_id`, `answer`, `user_type_id`, `status_id`, `password_type_id`, `password_expiry_date`, `ip_address`, `failed_login_attempt`, `failed_login_time`, `disable_login_failure`, `last_access`, `created_at`, `updated_at`) VALUES
(1, 'admin@gmail.com', 'admin', 'admin', 1, 'je', 1, 1, 2, '2017-09-09 00:00:00', '127.0.0.2', 0, '2017-08-10 12:56:14', 0, '2017-08-10 00:15:06', '2017-06-15 11:16:11', '2017-06-15 11:16:11'),
(2, 'john.cena@gmail.com', 'jcena', 'John1234$', 1, 'JC', 2, 1, 2, '2017-07-26 00:00:00', '127.0.0.1', 0, '2017-08-16 15:12:31', 0, '2017-08-10 01:43:28', '2017-06-26 18:03:02', '2017-06-26 18:03:02');

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
(2, 2, 'John', 'M', 'Cena', '09330442353', '2017-06-26 18:03:39', '2017-06-26 18:03:39');

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
(7, 'IT-Chairman', '2017-08-21 12:52:44', '2017-08-21 12:52:44');

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
-- Indexes for table `emergencies`
--
ALTER TABLE `emergencies`
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
-- AUTO_INCREMENT for table `emergencies`
--
ALTER TABLE `emergencies`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `emergency_responses`
--
ALTER TABLE `emergency_responses`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `enrolled_subjects`
--
ALTER TABLE `enrolled_subjects`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `enrollees`
--
ALTER TABLE `enrollees`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `handle_courses`
--
ALTER TABLE `handle_courses`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `login_logs`
--
ALTER TABLE `login_logs`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;
--
-- AUTO_INCREMENT for table `logout_logs`
--
ALTER TABLE `logout_logs`
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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `response_messages`
--
ALTER TABLE `response_messages`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `school_courses`
--
ALTER TABLE `school_courses`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
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
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `surveys`
--
ALTER TABLE `surveys`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_infos`
--
ALTER TABLE `user_infos`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_types`
--
ALTER TABLE `user_types`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `year_sections`
--
ALTER TABLE `year_sections`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
