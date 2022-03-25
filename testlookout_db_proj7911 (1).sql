-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 23, 2022 at 06:44 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `testlookout_db_proj7911`
--

-- --------------------------------------------------------

--
-- Table structure for table `lo_tblapplier`
--

CREATE TABLE `lo_tblapplier` (
  `id` mediumint(10) UNSIGNED NOT NULL,
  `user_id` mediumint(10) UNSIGNED DEFAULT NULL,
  `apply` enum('1','0','2') NOT NULL DEFAULT '0' COMMENT '0=apply, 1=accept,2=deny',
  `job` mediumint(10) UNSIGNED DEFAULT NULL,
  `report` mediumint(10) UNSIGNED DEFAULT NULL,
  `is_delete` enum('Y','N','') NOT NULL DEFAULT 'N',
  `lastly_editedBy` enum('J','O','A') DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lo_tblapplier`
--

INSERT INTO `lo_tblapplier` (`id`, `user_id`, `apply`, `job`, `report`, `is_delete`, `lastly_editedBy`, `date_created`, `date_updated`) VALUES
(12, 14, '0', 2, NULL, 'N', NULL, '2022-03-20 22:11:53', '2022-03-20 22:11:53'),
(14, 14, '0', 14, NULL, 'N', NULL, '2022-03-20 22:13:36', '2022-03-20 22:13:36'),
(15, 14, '1', 1, NULL, 'N', NULL, '2022-03-22 17:18:39', '2022-03-22 19:56:11'),
(16, 14, '2', 5, NULL, 'N', NULL, '2022-03-22 17:19:11', '2022-03-22 20:08:33'),
(17, 14, '1', 15, NULL, 'N', NULL, '2022-03-22 17:21:31', '2022-03-22 19:56:10'),
(18, 14, '1', 16, NULL, 'N', NULL, '2022-03-22 20:25:58', '2022-03-22 20:26:24');

-- --------------------------------------------------------

--
-- Table structure for table `lo_tblcategory`
--

CREATE TABLE `lo_tblcategory` (
  `id` mediumint(10) UNSIGNED NOT NULL,
  `category_name` varchar(20) NOT NULL,
  `category_subname` varchar(20) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lo_tblcategory`
--

INSERT INTO `lo_tblcategory` (`id`, `category_name`, `category_subname`, `date_created`, `date_updated`) VALUES
(1, 'IT', 'ANDROID DEVELOPER', '2022-03-10 13:47:56', '2022-03-10 13:47:56'),
(2, 'IT', 'WEB DEVELOPER', '2022-03-10 13:47:56', '2022-03-10 13:47:56'),
(3, 'IT', 'PYTHON DEVELOPER', '2022-03-10 13:47:56', '2022-03-10 13:47:56'),
(4, 'IT', 'FRONTEND DEVELOPER', '2022-03-10 13:47:56', '2022-03-10 13:47:56'),
(5, 'EDUCATION', 'TEACHER', '2022-03-10 13:47:56', '2022-03-10 13:47:56'),
(6, 'EDUCATION', 'SCHOOL DRIVERS', '2022-03-10 13:47:56', '2022-03-10 13:47:56'),
(7, 'MARKETING', 'SALES PERSON', '2022-03-10 13:47:56', '2022-03-10 13:47:56'),
(8, 'MARKETING', 'ADERTISER', '2022-03-10 13:47:56', '2022-03-10 13:47:56'),
(9, 'MARKETING', 'INVENTORY', '2022-03-10 13:47:56', '2022-03-10 13:47:56'),
(10, 'BUSSINESS', 'MANAGER', '2022-03-10 13:47:56', '2022-03-10 13:47:56'),
(11, 'BUSSINESS', 'REAL-ESTATE', '2022-03-10 13:47:56', '2022-03-10 13:47:56'),
(12, 'OTHERS', 'SECURITY', '2022-03-10 13:47:56', '2022-03-10 13:47:56'),
(13, 'OTHERS', 'SERVENTS', '2022-03-10 13:47:56', '2022-03-10 13:47:56'),
(14, 'OTHERS', 'DRIVERS', '2022-03-10 13:47:56', '2022-03-10 13:47:56'),
(15, 'OTHERS', 'PEIONS', '2022-03-10 13:47:56', '2022-03-10 13:47:56');

-- --------------------------------------------------------

--
-- Table structure for table `lo_tblcomments`
--

CREATE TABLE `lo_tblcomments` (
  `id` mediumint(10) UNSIGNED NOT NULL,
  `user_id` mediumint(10) UNSIGNED NOT NULL,
  `job_id` mediumint(10) UNSIGNED NOT NULL,
  `comment_desc` varchar(255) NOT NULL,
  `comment_createdBy` enum('A','O','J') NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lo_tblcomments`
--

INSERT INTO `lo_tblcomments` (`id`, `user_id`, `job_id`, `comment_desc`, `comment_createdBy`, `date_created`, `date_updated`) VALUES
(6, 14, 14, 'this is comment', 'J', '2022-03-23 04:50:05', '2022-03-23 04:50:05'),
(8, 14, 14, 'this is comment', 'J', '2022-03-23 04:51:19', '2022-03-23 04:51:19'),
(9, 14, 14, 'His is the comments', 'J', '2022-03-23 05:19:27', '2022-03-23 05:19:27'),
(10, 14, 14, 'We glad to join you', 'J', '2022-03-23 05:19:59', '2022-03-23 05:19:59'),
(11, 2, 1, 'THis is Commnet for ypu', 'O', '2022-03-23 05:26:46', '2022-03-23 05:26:46'),
(12, 2, 17, 'This is the comments', 'O', '2022-03-23 05:28:18', '2022-03-23 05:28:18'),
(13, 14, 17, 'xxxxxxxxfaa', 'J', '2022-03-23 05:28:47', '2022-03-23 05:28:47'),
(14, 14, 17, 'Good to knpw', 'J', '2022-03-23 05:29:41', '2022-03-23 05:29:41'),
(15, 2, 17, 'Yup', 'O', '2022-03-23 05:29:57', '2022-03-23 05:29:57');

-- --------------------------------------------------------

--
-- Table structure for table `lo_tbljobs`
--

CREATE TABLE `lo_tbljobs` (
  `id` mediumint(10) UNSIGNED NOT NULL,
  `user_id` mediumint(10) UNSIGNED NOT NULL,
  `job_title` varchar(200) NOT NULL,
  `job_desc` varchar(255) NOT NULL,
  `job_amt` int(10) NOT NULL,
  `job_hours` enum('1','2','0') NOT NULL DEFAULT '1',
  `job_miniexp` mediumint(3) UNSIGNED DEFAULT 0,
  `job_vacancy` mediumint(5) NOT NULL,
  `job_location` varchar(150) DEFAULT NULL,
  `job_responsibility` varchar(100) DEFAULT NULL,
  `job_skillRequire` varchar(100) DEFAULT NULL,
  `category_id` mediumint(10) UNSIGNED NOT NULL,
  `is_deleted` enum('Y','N') NOT NULL DEFAULT 'N',
  `is_reported` enum('Y','N') NOT NULL DEFAULT 'N',
  `job_createdBy` enum('A','O') DEFAULT NULL,
  `job_lastlyEdited` enum('A','O') DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lo_tbljobs`
--

INSERT INTO `lo_tbljobs` (`id`, `user_id`, `job_title`, `job_desc`, `job_amt`, `job_hours`, `job_miniexp`, `job_vacancy`, `job_location`, `job_responsibility`, `job_skillRequire`, `category_id`, `is_deleted`, `is_reported`, `job_createdBy`, `job_lastlyEdited`, `date_created`, `date_updated`) VALUES
(1, 2, 'PHP DEVELOPER', 'This job is for developers', 10000, '2', 2, 50, 'this is location', NULL, 'any', 2, 'N', 'N', 'O', 'O', '2022-03-10 20:55:48', '2022-03-10 20:59:00'),
(2, 1, 'PHP DEVELOPER II ', 'This job is for developers', 70000, '2', 2, 50, 'this is location', NULL, 'any', 2, 'N', 'N', 'O', 'O', '2022-03-10 20:56:28', '2022-03-10 20:59:15'),
(3, 1, 'SOME INFO', 'SOME INFO', 1111, '1', 0, 2, 'SOME INFO', NULL, 'SOME INFO', 14, 'N', 'N', 'O', 'O', '2022-03-10 23:10:43', '2022-03-10 23:10:43'),
(4, 2, 'SOME INFO2', 'SOME INFO2', 989, '0', 5, 4, 'SOME INFO', NULL, 'SOME INFO', 10, 'N', 'N', 'O', 'O', '2022-03-10 23:10:43', '2022-03-20 21:06:58'),
(5, 2, 'SOME INFO', 'SOME INFO', 4000, '2', 0, 5, 'SOME INFO', NULL, 'SOME INFO', 2, 'N', 'N', 'O', 'O', '2022-03-10 23:11:12', '2022-03-20 21:06:58'),
(6, 2, 'SOME INFO', 'SOME INFO', 4000, '2', 0, 5, 'SOME INFO', NULL, 'SOME INFO', 2, 'N', 'N', 'O', 'O', '2022-03-10 23:11:19', '2022-03-20 21:06:58'),
(7, 2, 'SOME INFO', 'SOME INFO', 40300, '2', 0, 4, 'SOME INFO', NULL, 'SOME INFO', 2, 'N', 'N', 'O', 'O', '2022-03-10 23:12:04', '2022-03-20 21:06:58'),
(8, 1, 'SOME INFO', 'SOME INFO', 4100, '2', 0, 5, 'SOME INFO', NULL, 'SOME INFO', 2, 'N', 'N', 'O', 'O', '2022-03-10 23:12:04', '2022-03-10 23:12:04'),
(9, 2, 'SOME INFO', 'SOME INFO', 4000, '2', 0, 7, 'SOME INFO', NULL, 'SOME INFO', 2, 'N', 'N', 'O', 'O', '2022-03-10 23:12:04', '2022-03-20 21:06:58'),
(10, 1, 'SOME INFO', 'SOME INFO', 4000, '2', 0, 3, 'SOME INFO', NULL, 'SOME INFO', 2, 'N', 'N', 'O', 'O', '2022-03-10 23:12:05', '2022-03-10 23:12:05'),
(11, 2, 'This Is Location\r\n\r\n', 'This Is Location\r\n\r\n', 10000, '0', 0, 12, 'Rajkot', NULL, 'This Is Location\r\n\r\n', 10, 'N', 'N', 'O', 'O', '2022-03-10 23:24:41', '2022-03-10 23:24:41'),
(12, 11, 'PHP DEVELOPER', 'This is Detail', 5000, '2', 0, 6, '', NULL, '', 5, 'N', 'N', 'O', 'O', '2022-03-11 04:37:03', '2022-03-11 04:37:03'),
(13, 13, 'Python Developers', 'We need a pyhton developers', 15000, '0', 2, 5, '', NULL, '', 3, 'N', 'N', 'O', 'O', '2022-03-19 18:49:04', '2022-03-20 22:17:58'),
(14, 13, 'Android developer', 'this is description', 50000, '2', 0, 5, '', '', '', 1, 'N', 'N', 'O', 'O', '2022-03-20 10:29:49', '2022-03-20 22:17:58'),
(15, 2, 'NEWW', 'Ddsfsd', 30000, '2', 1, 5, '', '', '', 7, 'N', 'N', 'O', 'O', '2022-03-22 17:21:08', '2022-03-22 17:21:08'),
(16, 2, 'SSS', 'fafasf', 44, '0', 4, 1, '', '', '', 7, 'N', 'N', 'O', 'O', '2022-03-22 20:25:19', '2022-03-22 20:25:19'),
(17, 2, 'xxxxx', 'xxxx', 2222, '0', 1, 33, '', '', '', 6, 'N', 'N', 'O', 'O', '2022-03-23 05:27:54', '2022-03-23 05:27:54'),
(18, 2, 'fdafa', 'afa', 44, '1', 44, 4, '', '', '', 6, 'N', 'N', 'O', 'O', '2022-03-23 05:38:20', '2022-03-23 05:38:20');

-- --------------------------------------------------------

--
-- Table structure for table `lo_tblotp`
--

CREATE TABLE `lo_tblotp` (
  `id` mediumint(10) UNSIGNED NOT NULL,
  `user_email` varchar(150) NOT NULL,
  `type` enum('REG','FPASS','CONTACT') NOT NULL,
  `verify_code` varchar(16) NOT NULL,
  `verify_status` enum('0','1') NOT NULL DEFAULT '0',
  `is_verify` enum('0','1') NOT NULL DEFAULT '0',
  `date_created` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lo_tblotp`
--

INSERT INTO `lo_tblotp` (`id`, `user_email`, `type`, `verify_code`, `verify_status`, `is_verify`, `date_created`) VALUES
(1, 'tenjvi41297512@gmail.com', 'REG', 'harsh108qpod', '0', '0', '2022-03-10 10:46:15'),
(2, 'yogesh6114992@gmail.com', 'REG', 'diines88doif', '1', '1', '2022-03-10 10:46:56'),
(3, 'akkipandya2580@gmail.com', 'REG', '50YG57', '1', '1', '2022-03-10 11:25:01'),
(8, 'dsd@ee.dd', 'REG', 'N950A9', '1', '1', '2022-03-10 15:12:20'),
(11, 'shyamadesara7911@gmail.com ', 'REG', 'abcdefg1234567qw', '1', '1', '2022-03-11 04:24:55'),
(12, 'adfly22112001@gmail.com', 'REG', '6Q4GNK', '1', '1', '2022-03-13 04:53:18'),
(13, 'Ajay123@gmail.com', 'REG', 'UA610K', '0', '1', '2022-03-17 15:25:39'),
(25, 'Ajay1234@gmail.com', 'REG', '4J15V0', '0', '1', '2022-03-17 15:55:30'),
(44, 'Ajay123@gmail.comd', 'REG', '380Q7M', '0', '1', '2022-03-17 16:56:29'),
(46, 'Ajay123@gmadil.comd', 'REG', '11585Z', '0', '1', '2022-03-17 16:58:53');

-- --------------------------------------------------------

--
-- Table structure for table `lo_tblprofileuser`
--

CREATE TABLE `lo_tblprofileuser` (
  `id` mediumint(10) UNSIGNED NOT NULL,
  `user_id` mediumint(10) UNSIGNED NOT NULL,
  `profile_userName` varchar(20) NOT NULL,
  `jobS_resume` varchar(255) DEFAULT NULL,
  `jobS_occupation` varchar(50) DEFAULT NULL,
  `jobS_exp` mediumint(20) DEFAULT NULL,
  `category_id` mediumint(10) UNSIGNED DEFAULT NULL,
  `org_name` varchar(20) DEFAULT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lo_tblprofileuser`
--

INSERT INTO `lo_tblprofileuser` (`id`, `user_id`, `profile_userName`, `jobS_resume`, `jobS_occupation`, `jobS_exp`, `category_id`, `org_name`, `date_created`, `date_updated`) VALUES
(10, 10, 'ADOvwvsSva', 'NULL', NULL, 0, 0, 'NULL', '2022-03-10 18:11:50', '2022-03-10 18:11:50'),
(11, 1, 'weqdwqe', NULL, 'Manager', 5, 1, 'GOOGLE', '2022-03-10 21:28:16', '2022-03-10 21:28:16'),
(12, 2, 'errqerrq', NULL, NULL, NULL, 8, NULL, '2022-03-10 21:28:16', '2022-03-10 21:28:16'),
(13, 11, 'gXVdNmMqWG', 'NULL', NULL, 0, 0, 'NULL', '2022-03-11 04:25:12', '2022-03-11 04:25:12'),
(15, 13, 'prqgMUvPUh', 'NULL', NULL, 0, NULL, 'NULL', '2022-03-12 03:31:59', '2022-03-12 03:31:59'),
(16, 14, 'UBlfGjELHr', 'NULL', NULL, 0, NULL, 'NULL', '2022-03-13 04:57:49', '2022-03-13 04:57:49');

-- --------------------------------------------------------

--
-- Table structure for table `lo_tblreports`
--

CREATE TABLE `lo_tblreports` (
  `id` mediumint(10) UNSIGNED NOT NULL,
  `user_id` mediumint(10) UNSIGNED NOT NULL,
  `job_id` mediumint(10) UNSIGNED NOT NULL,
  `report_title` varchar(50) DEFAULT NULL,
  `report_desc` varchar(255) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `lo_tblusers`
--

CREATE TABLE `lo_tblusers` (
  `id` mediumint(10) UNSIGNED NOT NULL,
  `user_fname` varchar(20) NOT NULL,
  `user_lname` varchar(20) NOT NULL,
  `user_email` varchar(150) NOT NULL,
  `user_contactNumber` bigint(10) UNSIGNED NOT NULL,
  `user_dob` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `user_country` varchar(20) DEFAULT NULL,
  `user_state` varchar(30) DEFAULT NULL,
  `user_city` varchar(20) DEFAULT NULL,
  `user_address` varchar(100) DEFAULT NULL,
  `user_photo` varchar(200) DEFAULT NULL,
  `user_password` varchar(32) DEFAULT NULL,
  `user_gender` enum('M','F','N') DEFAULT NULL,
  `user_type` enum('A','O','J') NOT NULL DEFAULT 'J',
  `is_live` enum('Y','N') NOT NULL DEFAULT 'N',
  `is_deleted` enum('Y','N') NOT NULL DEFAULT 'N',
  `date_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `date_updated` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lo_tblusers`
--

INSERT INTO `lo_tblusers` (`id`, `user_fname`, `user_lname`, `user_email`, `user_contactNumber`, `user_dob`, `user_country`, `user_state`, `user_city`, `user_address`, `user_photo`, `user_password`, `user_gender`, `user_type`, `is_live`, `is_deleted`, `date_created`, `date_updated`) VALUES
(1, 'dfa2427156', 'zpm213541411', 'tenjvi41297512@gmail.com', 2334017277, '2022-03-20 20:26:20', '', '', '', '', 'default.png', '25f9e794323b453885f5181f1b624d0b', 'M', 'O', 'Y', 'N', '2022-03-10 10:46:15', '2022-03-20 20:26:20'),
(2, 'aq71321238', 'dd1314141258', 'yogesh6114992@gmail.com', 7855810543, '2022-03-23 05:42:44', '', '', '', '', 'default.png', '25f9e794323b453885f5181f1b624d0b', 'F', 'O', 'N', 'N', '2022-03-10 10:46:56', '2022-03-23 05:42:44'),
(10, 'Shyam', 'fsdfsdfsd', 'dsd@ee.dd', 7897897890, '2022-03-13 04:33:55', NULL, NULL, NULL, NULL, 'Cars-87.jpeg', '25f9e794323b453885f5181f1b624d0b', 'M', 'O', 'N', 'N', '2022-03-10 18:11:50', '2022-03-13 04:33:55'),
(11, 'Shyam', 'fsdfsdfsd', 'desara7911@gmail.com', 9016077892, '2022-03-12 04:30:27', NULL, NULL, NULL, NULL, 'default.png', '25f9e794323b453885f5181f1b624d0b', 'M', 'J', 'Y', 'N', '2022-03-11 04:25:12', '2022-03-12 04:30:27'),
(12, 'Shyam', 'fsdfsdfsd', 'shyamlladesara7911@gmail.com', 9999666655, '2022-03-12 03:31:49', NULL, NULL, NULL, NULL, 'default.jpeg', '25f9e794323b453885f5181f1', 'M', 'O', 'Y', 'N', '2022-03-12 03:29:01', '2022-03-12 03:31:49'),
(13, 'Shyam', 'fsdfsdfsd', 'shyamadesara7911@gmail.com', 9999666655, '2022-03-22 16:36:44', NULL, NULL, NULL, NULL, 'default.png', '25f9e794323b453885f5181f1b624d0b', 'M', 'O', 'N', 'N', '2022-03-12 03:31:58', '2022-03-22 16:36:44'),
(14, 'SSSS', 'adesara', 'adfly22112001@gmail.com', 9638358590, '2022-03-22 18:57:48', NULL, NULL, NULL, NULL, 'images.jpeg', '25f9e794323b453885f5181f1b624d0b', 'F', 'J', 'Y', 'N', '2022-03-13 04:57:48', '2022-03-22 18:57:48');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lo_tblapplier`
--
ALTER TABLE `lo_tblapplier`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lo_tblcategory`
--
ALTER TABLE `lo_tblcategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lo_tblcomments`
--
ALTER TABLE `lo_tblcomments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_comment_id` (`user_id`),
  ADD KEY `fk_id_comment_jobid` (`job_id`);

--
-- Indexes for table `lo_tbljobs`
--
ALTER TABLE `lo_tbljobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_job_id` (`user_id`),
  ADD KEY `fk_id_job_catid` (`category_id`);

--
-- Indexes for table `lo_tblotp`
--
ALTER TABLE `lo_tblotp`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- Indexes for table `lo_tblprofileuser`
--
ALTER TABLE `lo_tblprofileuser`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id` (`user_id`),
  ADD KEY `fk_id_catId` (`category_id`);

--
-- Indexes for table `lo_tblreports`
--
ALTER TABLE `lo_tblreports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_id_report_id` (`user_id`),
  ADD KEY `fk_id_reports_id` (`job_id`);

--
-- Indexes for table `lo_tblusers`
--
ALTER TABLE `lo_tblusers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lo_tblapplier`
--
ALTER TABLE `lo_tblapplier`
  MODIFY `id` mediumint(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `lo_tblcategory`
--
ALTER TABLE `lo_tblcategory`
  MODIFY `id` mediumint(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `lo_tblcomments`
--
ALTER TABLE `lo_tblcomments`
  MODIFY `id` mediumint(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `lo_tbljobs`
--
ALTER TABLE `lo_tbljobs`
  MODIFY `id` mediumint(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `lo_tblotp`
--
ALTER TABLE `lo_tblotp`
  MODIFY `id` mediumint(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `lo_tblprofileuser`
--
ALTER TABLE `lo_tblprofileuser`
  MODIFY `id` mediumint(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `lo_tblreports`
--
ALTER TABLE `lo_tblreports`
  MODIFY `id` mediumint(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lo_tblusers`
--
ALTER TABLE `lo_tblusers`
  MODIFY `id` mediumint(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `lo_tblapplier`
--
ALTER TABLE `lo_tblapplier`
  ADD CONSTRAINT `fk_apply_id_jobs_id` FOREIGN KEY (`job`) REFERENCES `lo_tbljobs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_apply_id_report_id` FOREIGN KEY (`report`) REFERENCES `lo_tblreports` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_apply_id_user_id` FOREIGN KEY (`user_id`) REFERENCES `lo_tblusers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lo_tblcomments`
--
ALTER TABLE `lo_tblcomments`
  ADD CONSTRAINT `fk_id_comment_id` FOREIGN KEY (`user_id`) REFERENCES `lo_tblusers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_comment_jobid` FOREIGN KEY (`job_id`) REFERENCES `lo_tbljobs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lo_tbljobs`
--
ALTER TABLE `lo_tbljobs`
  ADD CONSTRAINT `fk_id_job_catid` FOREIGN KEY (`category_id`) REFERENCES `lo_tblcategory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_job_id` FOREIGN KEY (`user_id`) REFERENCES `lo_tblusers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lo_tblprofileuser`
--
ALTER TABLE `lo_tblprofileuser`
  ADD CONSTRAINT `fk_id_catId` FOREIGN KEY (`category_id`) REFERENCES `lo_tblcategory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_profileUser` FOREIGN KEY (`user_id`) REFERENCES `lo_tblusers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `lo_tblreports`
--
ALTER TABLE `lo_tblreports`
  ADD CONSTRAINT `fk_id_report_id` FOREIGN KEY (`user_id`) REFERENCES `lo_tblusers` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_reports_id` FOREIGN KEY (`job_id`) REFERENCES `lo_tbljobs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
