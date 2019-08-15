-- phpMyAdmin SQL Dump
-- version 4.7.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 14, 2018 at 07:40 PM
-- Server version: 5.6.39-cll-lve
-- PHP Version: 5.5.38

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `owlphin`
--
CREATE DATABASE IF NOT EXISTS `owlphin` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `owlphin`;

-- --------------------------------------------------------

--
-- Table structure for table `company_profile`
--

CREATE TABLE `company_profile` (
  `company_account_id` int(11) NOT NULL,
  `e_hash` varchar(255) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `business_stream_name` varchar(255) NOT NULL,
  `company_website_url` varchar(255) DEFAULT NULL,
  `last_checks_rjobs` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_profile`
--

INSERT INTO `company_profile` (`company_account_id`, `e_hash`, `company_name`, `business_stream_name`, `company_website_url`, `last_checks_rjobs`) VALUES
(11, '0df4d21aa821b7d7beece61dd11b28a1', 'Fan Milk Ltd', 'Manufacturing / Production', 'www.fanmilk-gh.com/', '2018-05-05 11:40:13'),
(12, 'f0d4aba03e9dd88a6ae6f6eb68e34ca5', 'Vodafone Ghana', 'ICT / Telecommunications', 'www.vodafone.com.gh', '2018-05-10 15:51:47'),
(16, '2ca478e396711677c3fbeca6a0b7aae0', 'Electricity Company of Ghana Limited', 'Government / Defence', 'www.ecgonline.info/', '0000-00-00 00:00:00'),
(17, '66dd5ea2332e18de80c3dac79a74e671', 'Ghana International School', 'Education', 'gis.edu.gh/', '0000-00-00 00:00:00'),
(18, '00894b017054aed3d7f6f739be30045a', 'Glo Ghana', 'ICT / Telecommunications', 'www.gloworld.com/gh/', '2018-05-10 16:32:24'),
(19, 'df2726b6b0b9e5830fed2a5b1ed40c13', 'Ghana Revenue Authority (GRA)', 'Government / Defence', 'www.gra.gov.gh/', '0000-00-00 00:00:00'),
(21, '2a0214a3f8131e3d6e23582d64499cf0', 'Emma Technical Institute', 'ICT / Telecommunications', '', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `education_detail`
--

CREATE TABLE `education_detail` (
  `id` int(11) NOT NULL,
  `e_hash` varchar(255) NOT NULL,
  `certificate_degree_name` varchar(50) DEFAULT NULL,
  `major` varchar(100) DEFAULT NULL,
  `institute_university_name` varchar(100) DEFAULT NULL,
  `starting_date` int(11) NOT NULL,
  `completion_date` int(11) DEFAULT NULL,
  `cgpa` varchar(20) DEFAULT NULL,
  `percentage` varchar(20) DEFAULT NULL,
  `postdate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `education_detail`
--

INSERT INTO `education_detail` (`id`, `e_hash`, `certificate_degree_name`, `major`, `institute_university_name`, `starting_date`, `completion_date`, `cgpa`, `percentage`, `postdate`) VALUES
(4, 'bf63cf876b1809c051ae9154742962db', 'Bachelor/s degree', 'Business Administration', 'University of Ghana - Legon', 2014, 2018, '', NULL, '2018-04-19 05:18:49'),
(5, '06e7c8c9d3e43c91c48c7e92fa845312', 'Bachelor/s degree', 'Law', 'University of Ghana - Legon', 2010, 2014, '', NULL, '2018-04-19 05:25:49'),
(6, 'e33783d23850f519c729f1861b10220c', 'Bachelor/s degree', 'Information Systems', 'Harvard University', 2006, 2014, '', NULL, '2018-04-19 10:36:57'),
(7, '5a93e3c3c4328ea99f7bc7c3871943c7', 'Doctor of Philosophy  phD', 'Quantum Physics', 'KNUST', 2012, 2016, '3.9', NULL, '2018-04-19 10:44:09'),
(8, 'e91442f2f700ee5af67afb0f3ff29f1f', 'Other', 'Science', 'Saint Petersburg Secondary School', 2012, 2016, '', NULL, '2018-04-19 10:48:23'),
(10, 'c853406f3d11dcf98006a61cc9434a47', 'Bachelor/s degree', 'Information Technology', 'GTUC', 2014, 2018, '', NULL, '2018-04-29 12:41:09'),
(11, '5b5ff06ec85fa23f5fe4d3e87d69e39e', 'Bachelor/s degree', 'IT', 'GTUC', 2011, 2026, '75', NULL, '2018-05-04 00:41:21'),
(12, 'b61b156cee58711f0acb93ccd52f090d', 'Degree', 'IT', 'Ghana Technology University ', 2014, 2018, '85', NULL, '2018-05-10 12:50:35');

-- --------------------------------------------------------

--
-- Table structure for table `experience_detail`
--

CREATE TABLE `experience_detail` (
  `id` int(11) NOT NULL,
  `e_hash` varchar(255) NOT NULL,
  `is_current_job` enum('0','1') NOT NULL DEFAULT '0',
  `job_title` varchar(100) NOT NULL,
  `job_specialization` varchar(255) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `business_stream` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `date_date` date NOT NULL,
  `description` text NOT NULL,
  `postdate` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `experience_detail`
--

INSERT INTO `experience_detail` (`id`, `e_hash`, `is_current_job`, `job_title`, `job_specialization`, `company_name`, `business_stream`, `start_date`, `date_date`, `description`, `postdate`) VALUES
(3, '06e7c8c9d3e43c91c48c7e92fa845312', '1', 'Teacher', 'Teaching / Education', 'Little Saint Basic School', 'Education', '2016-05-26', '0000-00-00', '', '2018-04-19 05:25:49'),
(4, '5a93e3c3c4328ea99f7bc7c3871943c7', '0', 'Pharmacist', 'Healthcare / Pharmaceutical', 'Ghana Atomic Energy Commission Clinic', 'Healthcare', '2012-09-19', '2016-06-15', '', '2018-04-19 10:44:09'),
(6, 'b61b156cee58711f0acb93ccd52f090d', '1', 'Teacher', 'Information Technology', 'Miracle Preparatory School', 'Education', '2016-02-07', '2016-02-10', '', '2018-05-10 12:50:35');

-- --------------------------------------------------------

--
-- Table structure for table `job_post`
--

CREATE TABLE `job_post` (
  `id` int(11) NOT NULL,
  `company_id` varchar(100) NOT NULL,
  `job_type` varchar(50) NOT NULL,
  `created_date` datetime NOT NULL,
  `deadline_date` datetime NOT NULL,
  `deadline_mhs` varchar(10) NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `job_description` text NOT NULL,
  `region` varchar(50) NOT NULL,
  `qualification` varchar(255) NOT NULL,
  `is_active` enum('0','1') NOT NULL DEFAULT '0',
  `edit_elapsed` enum('0','1') NOT NULL DEFAULT '0',
  `time_elapsed` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `job_post_activity`
--

CREATE TABLE `job_post_activity` (
  `id` int(11) NOT NULL,
  `e_hash` varchar(255) NOT NULL,
  `job_post_id` int(11) NOT NULL,
  `apply_date` datetime NOT NULL,
  `seeker_profile_strength` int(11) NOT NULL,
  `skill_match` int(11) NOT NULL,
  `degree_match` int(11) NOT NULL,
  `industry_xp` int(11) NOT NULL,
  `seeker_result` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `job_post_skill_set`
--

CREATE TABLE `job_post_skill_set` (
  `id` int(11) NOT NULL,
  `job_post_id` int(11) NOT NULL,
  `skill_set_name` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `note_type` enum('a','s','r','o') NOT NULL,
  `e_hash` varchar(255) NOT NULL,
  `initiator_hash` varchar(255) NOT NULL,
  `job_post_id` int(11) NOT NULL,
  `note` text NOT NULL,
  `did_read` enum('0','1') NOT NULL DEFAULT '0',
  `date_time` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `note_type`, `e_hash`, `initiator_hash`, `job_post_id`, `note`, `did_read`, `date_time`) VALUES
(255, 'a', 'c853406f3d11dcf98006a61cc9434a47', '', 0, 'Hello Kwabena. Thanks for joining Owlphin. We hope you get excited when you consider the possibilities of landing your dream job. We can not wait for you to get started. You might want to start by:<br>- Tailoring your Profile <br> Your profile is a virtual representation of your physical CV. Make a good one.', '0', '2018-04-29 12:41:09'),
(256, 'a', '5b5ff06ec85fa23f5fe4d3e87d69e39e', '', 0, 'Hello Kofi. Thanks for joining Owlphin. We hope you get excited when you consider the possibilities of landing your dream job. We can not wait for you to get started. You might want to start by:<br>- Tailoring your Profile <br> Your profile is a virtual representation of your physical CV. Make a good one.', '0', '2018-05-04 00:41:21'),
(257, 'a', 'b61b156cee58711f0acb93ccd52f090d', '', 0, 'Hello Desmond. Thanks for joining Owlphin. We hope you get excited when you consider the possibilities of landing your dream job. We can not wait for you to get started. You might want to start by:<br>- Tailoring your Profile <br> Your profile is a virtual representation of your physical CV. Make a good one.', '0', '2018-05-10 12:50:35');

-- --------------------------------------------------------

--
-- Table structure for table `seeker_bookmarks`
--

CREATE TABLE `seeker_bookmarks` (
  `id` int(11) NOT NULL,
  `e_hash` varchar(255) NOT NULL,
  `job_id` int(11) NOT NULL,
  `datesaved` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `seeker_profile`
--

CREATE TABLE `seeker_profile` (
  `user_account_id` int(11) NOT NULL,
  `e_hash` varchar(255) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `date_of_birth` date NOT NULL,
  `gender` varchar(6) NOT NULL,
  `seeker_bio` text NOT NULL,
  `cv` varchar(255) NOT NULL,
  `profile_strength` int(11) NOT NULL,
  `last_job_apply_date` datetime DEFAULT NULL,
  `last_check_bookmarks` datetime NOT NULL,
  `last_checks_jobs` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seeker_profile`
--

INSERT INTO `seeker_profile` (`user_account_id`, `e_hash`, `firstname`, `lastname`, `date_of_birth`, `gender`, `seeker_bio`, `cv`, `profile_strength`, `last_job_apply_date`, `last_check_bookmarks`, `last_checks_jobs`) VALUES
(6, 'bf63cf876b1809c051ae9154742962db', 'Efua', 'Biney', '1996-11-22', 'f', ' ', '', 13, '2018-04-19 17:41:12', '2018-04-28 22:31:33', '2018-04-28 22:30:48'),
(7, '06e7c8c9d3e43c91c48c7e92fa845312', 'Adwoa', 'Gyamaa-Boakye', '1996-07-08', 'f', ' ', '', 9, '2018-04-19 17:40:59', '0000-00-00 00:00:00', '2018-04-20 00:40:45'),
(8, 'e33783d23850f519c729f1861b10220c', 'Micheal', 'Glover', '1994-04-19', 'm', ' ', '', 0, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, '5a93e3c3c4328ea99f7bc7c3871943c7', 'Rose', 'Derse', '1984-01-29', 'f', ' ', '', 0, NULL, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 'e91442f2f700ee5af67afb0f3ff29f1f', 'Prince', 'Adjei-Yeboah', '1991-06-15', 'm', ' ', '', 4, NULL, '2018-05-05 11:25:42', '0000-00-00 00:00:00'),
(14, 'c853406f3d11dcf98006a61cc9434a47', 'Kwabena', 'Aboagye', '1996-12-05', 'm', ' ', '', 4, NULL, '2018-05-10 08:53:56', '2018-05-13 07:47:51'),
(15, '5b5ff06ec85fa23f5fe4d3e87d69e39e', 'Kofi', 'Ofei', '2000-05-03', 'm', ' ', '', 4, NULL, '0000-00-00 00:00:00', '2018-05-04 07:49:28'),
(20, 'b61b156cee58711f0acb93ccd52f090d', 'Desmond', 'Duodu', '1992-07-12', 'm', ' ', 'cv98269.doc', 27, NULL, '2018-05-10 20:10:58', '2018-05-10 20:11:04');

-- --------------------------------------------------------

--
-- Table structure for table `seeker_skill_set`
--

CREATE TABLE `seeker_skill_set` (
  `id` int(11) NOT NULL,
  `e_hash` varchar(255) NOT NULL,
  `skill_set_name` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `seeker_skill_set`
--

INSERT INTO `seeker_skill_set` (`id`, `e_hash`, `skill_set_name`) VALUES
(1, 'bf63cf876b1809c051ae9154742962db', 'Public Speaking'),
(2, 'bf63cf876b1809c051ae9154742962db', 'Web Application Development'),
(3, 'b61b156cee58711f0acb93ccd52f090d', 'Data (Extraction/Entry/Verification)'),
(4, 'b61b156cee58711f0acb93ccd52f090d', 'Form Development and Processing'),
(5, 'b61b156cee58711f0acb93ccd52f090d', 'Public Speaking'),
(6, 'b61b156cee58711f0acb93ccd52f090d', 'Photo Editing'),
(7, 'b61b156cee58711f0acb93ccd52f090d', 'Web Research'),
(8, 'b61b156cee58711f0acb93ccd52f090d', 'Digital survey development and administration'),
(9, 'b61b156cee58711f0acb93ccd52f090d', 'Digital Marketing & Advertising'),
(10, 'b61b156cee58711f0acb93ccd52f090d', 'Mobile Application Development'),
(11, 'b61b156cee58711f0acb93ccd52f090d', 'Legal Document Review'),
(12, 'b61b156cee58711f0acb93ccd52f090d', 'Business Template Review and Redevelopment'),
(13, 'b61b156cee58711f0acb93ccd52f090d', 'Business Plan development and proof reading'),
(14, 'b61b156cee58711f0acb93ccd52f090d', 'Desk Feasibility Research'),
(15, 'b61b156cee58711f0acb93ccd52f090d', 'Proposal Development'),
(16, 'b61b156cee58711f0acb93ccd52f090d', 'Product Research'),
(17, 'b61b156cee58711f0acb93ccd52f090d', 'Project Research'),
(18, 'b61b156cee58711f0acb93ccd52f090d', 'Market Research'),
(19, 'b61b156cee58711f0acb93ccd52f090d', 'Process Development'),
(20, 'b61b156cee58711f0acb93ccd52f090d', 'Financial Templates'),
(21, 'b61b156cee58711f0acb93ccd52f090d', 'Web Application Development'),
(22, 'b61b156cee58711f0acb93ccd52f090d', 'Website Development'),
(23, 'b61b156cee58711f0acb93ccd52f090d', 'Logo/3D Designs');

-- --------------------------------------------------------

--
-- Table structure for table `user_account`
--

CREATE TABLE `user_account` (
  `id` int(11) NOT NULL,
  `e_hash` varchar(255) NOT NULL,
  `user_type` varchar(10) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(100) NOT NULL,
  `is_active` enum('N','Y') NOT NULL DEFAULT 'N',
  `contact_number` varchar(12) NOT NULL,
  `email_notification_active` enum('N','Y') NOT NULL DEFAULT 'Y',
  `user_image` varchar(255) DEFAULT NULL,
  `avatartemp` varchar(255) DEFAULT NULL,
  `registration_date` datetime NOT NULL,
  `last_login_date` datetime NOT NULL,
  `ip` varchar(255) NOT NULL,
  `activated` enum('0','1') NOT NULL DEFAULT '0',
  `last_notes_check` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_account`
--

INSERT INTO `user_account` (`id`, `e_hash`, `user_type`, `email`, `password`, `is_active`, `contact_number`, `email_notification_active`, `user_image`, `avatartemp`, `registration_date`, `last_login_date`, `ip`, `activated`, `last_notes_check`) VALUES
(6, 'bf63cf876b1809c051ae9154742962db', 'seeker', 'seeker-one@bacsyd.com', 'a127fd1f86e4ab650f2216f09992afa4', 'N', '', 'Y', 'dp405509.jpg', NULL, '2018-04-19 05:18:49', '2018-04-29 11:33:19', '41.66.199.65', '1', '2018-04-20 01:08:18'),
(7, '06e7c8c9d3e43c91c48c7e92fa845312', 'seeker', 'seeker-two@bacsyd.com', 'a127fd1f86e4ab650f2216f09992afa4', 'N', '', 'Y', NULL, NULL, '2018-04-19 05:25:49', '2018-04-19 17:13:17', '154.160.2.76', '1', '2018-04-20 00:50:25'),
(8, 'e33783d23850f519c729f1861b10220c', 'seeker', 'seeker-three@bacsyd.com', 'a127fd1f86e4ab650f2216f09992afa4', 'N', '', 'Y', NULL, NULL, '2018-04-19 10:36:57', '0000-00-00 00:00:00', '41.66.199.1', '1', '0000-00-00 00:00:00'),
(9, '5a93e3c3c4328ea99f7bc7c3871943c7', 'seeker', 'seeker-four@bacsyd.com', 'a127fd1f86e4ab650f2216f09992afa4', 'N', '', 'Y', NULL, NULL, '2018-04-19 10:44:09', '0000-00-00 00:00:00', '41.66.199.1', '1', '0000-00-00 00:00:00'),
(10, 'e91442f2f700ee5af67afb0f3ff29f1f', 'seeker', 'seeker-five@bacsyd.com', 'a127fd1f86e4ab650f2216f09992afa4', 'N', '', 'Y', NULL, NULL, '2018-04-19 10:48:23', '2018-05-05 01:45:54', '41.66.199.15', '1', '2018-05-05 11:25:44'),
(11, '0df4d21aa821b7d7beece61dd11b28a1', 'recruiter', 'recruiter-one@bacsyd.com', 'a127fd1f86e4ab650f2216f09992afa4', 'N', '0228366177', 'Y', 'dp902902.jpg', '73309.jpg', '2018-04-19 10:52:50', '2018-05-10 08:56:41', '197.251.240.163', '1', '2018-05-05 11:40:11'),
(12, 'f0d4aba03e9dd88a6ae6f6eb68e34ca5', 'recruiter', 'recruiter-two@bacsyd.com', 'a127fd1f86e4ab650f2216f09992afa4', 'N', '0202746727', 'Y', 'dp135824.jpg', '77682.jpg', '2018-04-19 10:54:41', '2018-05-10 08:51:36', '197.251.240.163', '1', '0000-00-00 00:00:00'),
(14, 'c853406f3d11dcf98006a61cc9434a47', 'seeker', 'mtckobby@gmail.com', 'a127fd1f86e4ab650f2216f09992afa4', 'Y', '', 'Y', NULL, NULL, '2018-04-29 12:41:09', '2018-05-13 00:47:33', '41.66.199.137', '1', '2018-05-09 07:44:20'),
(15, '5b5ff06ec85fa23f5fe4d3e87d69e39e', 'seeker', 'bekoekofi@gmail.com', '568983d209f019e54d6a607eec5f50c0', 'Y', '', 'Y', NULL, NULL, '2018-05-04 00:48:51', '2018-05-04 12:48:12', '41.66.202.223', '1', '2018-05-04 07:49:12'),
(16, '2ca478e396711677c3fbeca6a0b7aae0', 'recruiter', 'recruiter-three@bacsyd.com', 'a127fd1f86e4ab650f2216f09992afa4', 'N', '0302676727', 'Y', 'dp120562.jpg', '58463.jpg', '2018-05-10 09:00:33', '2018-05-10 09:27:48', '197.251.240.163', '1', '0000-00-00 00:00:00'),
(17, '66dd5ea2332e18de80c3dac79a74e671', 'recruiter', 'recruiter-four@bacsyd.com', 'a127fd1f86e4ab650f2216f09992afa4', 'N', '0302777163', 'Y', 'dp448285.png', '60946.png', '2018-05-10 09:10:47', '2018-05-10 09:29:34', '197.251.240.163', '1', '0000-00-00 00:00:00'),
(18, '00894b017054aed3d7f6f739be30045a', 'recruiter', 'recruiter-five@bacsyd.com', 'a127fd1f86e4ab650f2216f09992afa4', 'N', '0230010100', 'Y', 'dp790948.jpg', '67834.jpg', '2018-05-10 09:22:41', '2018-05-10 09:32:51', '197.251.240.163', '1', '0000-00-00 00:00:00'),
(19, 'df2726b6b0b9e5830fed2a5b1ed40c13', 'recruiter', 'recruiter-six@bacsyd.com', 'a127fd1f86e4ab650f2216f09992afa4', 'N', '0302760015', 'Y', 'dp324053.jpg', '33017.jpg', '2018-05-10 09:26:19', '2018-05-10 09:34:32', '197.251.240.163', '1', '0000-00-00 00:00:00'),
(20, 'b61b156cee58711f0acb93ccd52f090d', 'seeker', 'adoniaduodu@gmail.com', 'a07887b3fedffdb6033d15e4da0f892d', 'N', '', 'Y', NULL, NULL, '2018-05-10 12:50:35', '2018-05-10 13:03:08', '41.66.255.161', '1', '2018-05-10 20:09:10'),
(21, '2a0214a3f8131e3d6e23582d64499cf0', 'recruiter', 'adoniaduodu@yahoo.com', 'a07887b3fedffdb6033d15e4da0f892d', 'N', '0302401125', 'Y', NULL, NULL, '2018-05-10 12:58:19', '0000-00-00 00:00:00', '41.66.255.161', '0', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `company_profile`
--
ALTER TABLE `company_profile`
  ADD PRIMARY KEY (`company_account_id`),
  ADD UNIQUE KEY `company_account_id` (`company_account_id`,`e_hash`);

--
-- Indexes for table `education_detail`
--
ALTER TABLE `education_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `experience_detail`
--
ALTER TABLE `experience_detail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_post`
--
ALTER TABLE `job_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_post_activity`
--
ALTER TABLE `job_post_activity`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_post_skill_set`
--
ALTER TABLE `job_post_skill_set`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seeker_bookmarks`
--
ALTER TABLE `seeker_bookmarks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `seeker_profile`
--
ALTER TABLE `seeker_profile`
  ADD PRIMARY KEY (`user_account_id`),
  ADD UNIQUE KEY `user_account_id` (`user_account_id`,`e_hash`);

--
-- Indexes for table `seeker_skill_set`
--
ALTER TABLE `seeker_skill_set`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_account`
--
ALTER TABLE `user_account`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`e_hash`,`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `education_detail`
--
ALTER TABLE `education_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `experience_detail`
--
ALTER TABLE `experience_detail`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `job_post`
--
ALTER TABLE `job_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `job_post_activity`
--
ALTER TABLE `job_post_activity`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `job_post_skill_set`
--
ALTER TABLE `job_post_skill_set`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=258;
--
-- AUTO_INCREMENT for table `seeker_bookmarks`
--
ALTER TABLE `seeker_bookmarks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `seeker_skill_set`
--
ALTER TABLE `seeker_skill_set`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `user_account`
--
ALTER TABLE `user_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
