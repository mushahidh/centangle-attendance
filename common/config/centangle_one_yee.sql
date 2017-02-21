-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2017 at 06:55 AM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `centangle_one_yee`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendence`
--

CREATE TABLE IF NOT EXISTS `attendence` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` varchar(45) NOT NULL,
  `time_in` varchar(45) NOT NULL,
  `time_out` varchar(45) NOT NULL,
  `daytime` date NOT NULL,
  `staff_id` int(11) NOT NULL,
  `is_offical` varchar(45) NOT NULL,
  `working_from_home` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `staff_id` (`staff_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=91 ;

--
-- Dumping data for table `attendence`
--

INSERT INTO `attendence` (`id`, `status`, `time_in`, `time_out`, `daytime`, `staff_id`, `is_offical`, `working_from_home`) VALUES
(75, '1', '09:00:00 AM', '05:00:00 AM', '2017-01-17', 6, '1', ''),
(76, '1', '09:00:00 AM', '05:00:00 AM', '2017-01-17', 7, '1', ''),
(77, '1', '09:00:00 AM', '05:00:00 AM', '2017-01-17', 9, '1', ''),
(78, '1', '09:00:00 AM', '05:00:00 AM', '2017-01-17', 11, '1', ''),
(79, '1', '09:00:00 AM', '05:00:00 AM', '2017-01-17', 14, '1', ''),
(80, '1', '09:00:00 AM', '05:00:00 AM', '2017-01-17', 16, '1', ''),
(81, '1', '09:00:00 AM', '05:00:00 AM', '2017-01-17', 17, '1', ''),
(82, '1', '09:00:00 AM', '05:00:00 AM', '2017-01-17', 18, '1', ''),
(83, '1', '09:00:00 AM', '05:00:00 AM', '2017-01-17', 19, '1', ''),
(84, '1', '09:00:00 AM', '05:00:00 AM', '2017-01-17', 20, '1', ''),
(85, '1', '09:00:00 AM', '05:00:00 AM', '2017-01-17', 21, '1', ''),
(86, '1', '09:00:00 AM', '05:00:00 AM', '2017-01-17', 22, '1', ''),
(89, '1', '', '', '2017-01-20', 16, '', ''),
(90, '1', '', '', '2017-02-20', 16, '', '');

-- --------------------------------------------------------

--
-- Table structure for table `auth_assignment`
--

CREATE TABLE IF NOT EXISTS `auth_assignment` (
  `item_name` varchar(64) NOT NULL,
  `user_id` varchar(64) NOT NULL,
  `created_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`item_name`,`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_assignment`
--

INSERT INTO `auth_assignment` (`item_name`, `user_id`, `created_at`) VALUES
('create-staff', '1', NULL),
('mark-attendence', '1', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item`
--

CREATE TABLE IF NOT EXISTS `auth_item` (
  `name` varchar(64) NOT NULL,
  `type` int(11) NOT NULL,
  `description` text,
  `rule_name` varchar(64) DEFAULT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`),
  KEY `rule_name` (`rule_name`),
  KEY `type` (`type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `auth_item`
--

INSERT INTO `auth_item` (`name`, `type`, `description`, `rule_name`, `data`, `created_at`, `updated_at`) VALUES
('create-staff', 1, 'allow user to create the staff', NULL, NULL, NULL, NULL),
('delet_attendence', 1, 'can delet attendence', NULL, NULL, NULL, NULL),
('mark-attendence', 1, 'allow user to matk attendence', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `auth_item_child`
--

CREATE TABLE IF NOT EXISTS `auth_item_child` (
  `parent` varchar(64) NOT NULL,
  `child` varchar(64) NOT NULL,
  PRIMARY KEY (`parent`,`child`),
  KEY `child` (`child`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `auth_rule`
--

CREATE TABLE IF NOT EXISTS `auth_rule` (
  `name` varchar(64) NOT NULL,
  `data` text,
  `created_at` int(11) DEFAULT NULL,
  `updated_at` int(11) DEFAULT NULL,
  PRIMARY KEY (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `calendar`
--

CREATE TABLE IF NOT EXISTS `calendar` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date NOT NULL DEFAULT '0000-00-00',
  `val` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `calendar`
--

INSERT INTO `calendar` (`id`, `date`, `val`) VALUES
(1, '2016-10-03', 56),
(2, '2016-10-04', 23),
(3, '2016-10-02', 43),
(4, '2016-10-05', 17),
(5, '2016-10-06', 23223);

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `logo` varchar(75) NOT NULL,
  `address` varchar(75) NOT NULL,
  `url` varchar(45) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `company`
--

INSERT INTO `company` (`id`, `name`, `logo`, `address`, `url`) VALUES
(8, 'Centangle Intractive', 'uploads/CentangleIntractive.png', '3rd Floor, CIS Technology, Shehra-e-Jamhuriyat, Sector G-5/2, Islamabad, Pa', 'http://centangle.com/');

-- --------------------------------------------------------

--
-- Table structure for table `fine`
--

CREATE TABLE IF NOT EXISTS `fine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fine` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `staff_id` (`staff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE IF NOT EXISTS `holidays` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `allowed_holiday` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `starting_date` date NOT NULL,
  `ending_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `staff_id` (`staff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1462949436),
('m130524_201442_init', 1462949444);

-- --------------------------------------------------------

--
-- Table structure for table `monthly_report`
--

CREATE TABLE IF NOT EXISTS `monthly_report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id` int(11) NOT NULL,
  `total_office_days` int(11) NOT NULL,
  `total_present` int(11) NOT NULL,
  `allowed_vocation` int(11) NOT NULL,
  `vocation_used` int(11) NOT NULL,
  `vocation_left` int(11) NOT NULL,
  `extra_vocation` int(11) NOT NULL,
  `fine` int(11) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `staff_id` (`staff_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1872 ;

--
-- Dumping data for table `monthly_report`
--

INSERT INTO `monthly_report` (`id`, `staff_id`, `total_office_days`, `total_present`, `allowed_vocation`, `vocation_used`, `vocation_left`, `extra_vocation`, `fine`, `date`) VALUES
(1860, 6, 1, 1, 2, 0, 2, 0, 0, '2017-01-17'),
(1861, 7, 1, 1, 2, 0, 2, 0, 0, '2017-01-17'),
(1862, 9, 1, 1, 2, 0, 2, 0, 0, '2017-01-17'),
(1863, 11, 1, 1, 2, 0, 2, 0, 0, '2017-01-17'),
(1864, 14, 1, 1, 2, 0, 2, 0, 0, '2017-01-17'),
(1865, 16, 1, 1, 2, 0, 2, 0, 0, '2017-01-17'),
(1866, 17, 1, 1, 2, 0, 2, 0, 0, '2017-01-17'),
(1867, 18, 1, 1, 2, 0, 2, 0, 0, '2017-01-17'),
(1868, 19, 1, 1, 2, 0, 2, 0, 0, '2017-01-17'),
(1869, 20, 1, 1, 2, 0, 2, 0, 0, '2017-01-17'),
(1870, 21, 1, 1, 2, 0, 2, 0, 0, '2017-01-17'),
(1871, 22, 1, 1, 2, 0, 2, 0, 0, '2017-01-17');

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE IF NOT EXISTS `staff` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `position` varchar(45) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `profile_pic` varchar(45) NOT NULL,
  `user_id` int(11) NOT NULL,
  `company_id` int(11) NOT NULL,
  `salary` int(11) NOT NULL,
  `working_days` enum('24','20') NOT NULL,
  `created_date` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `company_id` (`company_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `name`, `position`, `gender`, `profile_pic`, `user_id`, `company_id`, `salary`, `working_days`, `created_date`) VALUES
(6, 'Arslan Khalid', 'Head of Services', 'Male', 'uploads/ArslanKhalid.jpg', 6, 8, 50000, '24', '2016-07-07'),
(7, 'Safi Mustafa', 'Senior Developer', 'Male', 'uploads/SafiMustafa.jpg', 13, 8, 50000, '24', '2016-07-07'),
(9, 'Muhammad Irfan', 'Senior Developer', 'Male', 'uploads/MuhammadIrfan.jpg', 5, 8, 50000, '24', '2016-07-07'),
(11, 'Usman Iqbal', 'web developer', 'Male', 'uploads/Usman.jpg', 9, 8, 15000, '20', '2016-07-07'),
(14, 'Sundus Bokhari', 'Android Developer', 'Female', 'uploads/SundusBokhari.jpg', 11, 8, 35000, '20', '2016-11-01'),
(16, 'Sajid ali', 'Web Developer', 'Male', 'uploads/Sajidali.jpg', 3, 8, 25000, '20', '2017-01-01'),
(17, 'Fareed', 'CEO', 'Male', 'uploads/Fareed.jpg', 14, 8, 50000, '24', '2016-12-31'),
(18, 'Mushahid', 'Technical Officer', 'Male', 'uploads/Mushahid.jpg', 7, 8, 50000, '24', '2016-12-31'),
(19, 'Imran', 'Web Developer', 'Male', 'uploads/Imran.jpg', 8, 8, 50000, '24', '2016-12-31'),
(20, 'Billal', 'Web Developer', 'Male', 'uploads/Billal.jpg', 4, 8, 18000, '20', '2016-12-31'),
(21, 'Maryam Zehra', 'Designer', 'Male', 'uploads/MaryamZehra.jpg', 12, 8, 15000, '20', '2016-12-31'),
(22, 'nabahat', 'Content Writer', 'Male', 'uploads/nabahat.jpg', 10, 8, 15000, '20', '2016-12-31');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `auth_key` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password_reset_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` smallint(6) NOT NULL DEFAULT '10',
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `password_reset_token` (`password_reset_token`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `auth_key`, `password_hash`, `password_reset_token`, `email`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'ToKHuV-XPOikcT6jrSxKSSyH-W7KIH_A', '$2y$13$RrNfNOTNA3/HPSnQbYDqeekOsXOxmK9Wvg9G3h2EQM/V/EyM7v1WK', NULL, 'rajwabarocho@gmail.com', 10, 1470221931, 1470221931),
(3, 'sajid', 'N7ISX4nsXumtTpG5eUYl_efQebdHaWIG', '$2y$13$VX2NaDYQG0kgG8dCHdM4i.jHJNLT9rIda6NKa2ynmYuJzDVudVS9S', NULL, 'admin@gnail.com', 10, 1483428542, 1483428542),
(4, 'Bilal', 'd5LvQJghMwxB-7UDm5OZgnVo63R9TcVl', '$2y$13$zuWlEgLmvDamVjrVnWTinuSA4sMaNQ3fqIHDh2BlpHvpSHftXd2m6', NULL, 'bilal@centangle.com', 10, 1484636392, 1484636392),
(5, 'irfan', '5yfjutVd3HRRemWapA66MzYN-UHa7rLz', '$2y$13$Xzukwzfyt9e/H9Wx72A7suFEvmEF9IENwhuVoCZ1nPdR87YAttkBu', NULL, 'irfan@centangle.com', 10, 1484636428, 1484636428),
(6, 'arslan', 'xbW-8JSh4zFXIEfcmO11WG0X0GlaV8kT', '$2y$13$Kv9SuTBsyEaN/bPAqkSf4ug0h541E5jQhaejo6thfAKvznLvv04aC', NULL, 'arslan@centangle.com', 10, 1484636463, 1484636463),
(7, 'mushahid', 'zGRzojZVKzvqfoYnn-dLPsd_Oq_yL12r', '$2y$13$VLuIg8Bm5w2ZspsN/qq0EeAMsDoMuqBTfYieTLef7k4XFWCJY.hDy', NULL, 'mushahid@centangle.com', 10, 1484636528, 1484636528),
(8, 'imran', 'JtTuUmE0Empv1Xlb6mBPFRjm81V27_S_', '$2y$13$YDFXkGCH0A1kAsB7viZ78ewqK7G5UWp6YjtviznxLnbXPg5teOJWe', NULL, 'imran@centangle.com', 10, 1484636581, 1484636581),
(9, 'usman', 'kowXFCzFC_dyvZwajnPaqKeyQsw6mAyD', '$2y$13$mkroLuCTh//W4fBi/Jx8reK0OmJVtQVU2vtkq7URfmiNNi02SvANG', NULL, 'usman@centangle.com', 10, 1484636632, 1484636632),
(10, 'nabahat', 'N5EZY-2P7o9w5tT3Ku-ied1lSO0zc1Rz', '$2y$13$THQ6sjRRZp1PWTN.s/b6XOa5nqyV0PFdmg4BhUc781Kcs3exYx9t.', NULL, 'nabahat@centangle.com', 10, 1484636733, 1484636733),
(11, 'sundus', 'q7zyVouJCxCECEOD8Zfh7xUDYjz9WCkc', '$2y$13$UpZSfumz4hhxWlEtsH8VwutjW6F6G76PQNeSOQJ/C5Ov.Ul/M4tzu', NULL, 'sundus@centangle.com', 10, 1484636773, 1484636773),
(12, 'maryam', 'HD_XPKxcfkO0hdWvBt0UGfkCUj9PRODl', '$2y$13$vwun2w7zzxzCulwGJVpeseg.CJD6qzXS7kNT6oJBxCYyZuhBTxPJC', NULL, 'maryam@centangle.com', 10, 1484636809, 1484636809),
(13, 'safi', 'd5XOMDEppCIk3uPKEEI0-TmfV9-l8bZU', '$2y$13$orGB17IS/pFhX0wuStpxt.0OfiUz9.s2wCq2IfJ2DLS/kWBM44wYu', NULL, 'safi@centangle.com', 10, 1484636906, 1484636906),
(14, 'fareed', 'VI2r_bcvaou851awwxoDxxxBXKJ9QzhO', '$2y$13$aKH/22K/iHZwC.U8xCbA6.q5DHtnKEjrQ8msChy53ZYXHqm3QfB1a', NULL, 'fareed@gmail.com', 10, 1484636956, 1484636956);

-- --------------------------------------------------------

--
-- Table structure for table `vocation`
--

CREATE TABLE IF NOT EXISTS `vocation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `leave_start` date NOT NULL,
  `leave_end` date NOT NULL,
  `vocation_days` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `staff_id` (`staff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `working_hours`
--

CREATE TABLE IF NOT EXISTS `working_hours` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `attendence_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `check_in` datetime DEFAULT NULL,
  `check_out` datetime DEFAULT NULL,
  `working_date` date NOT NULL,
  `system_checked_out` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=243 ;

--
-- Dumping data for table `working_hours`
--

INSERT INTO `working_hours` (`id`, `attendence_id`, `user_id`, `check_in`, `check_out`, `working_date`, `system_checked_out`) VALUES
(229, 75, 6, '2017-01-17 09:00:00', '2017-01-17 05:00:00', '2017-01-17', ''),
(230, 76, 13, '2017-01-17 09:00:00', '2017-01-17 05:00:00', '2017-01-17', ''),
(231, 77, 5, '2017-01-17 09:00:00', '2017-01-17 05:00:00', '2017-01-17', ''),
(232, 78, 9, '2017-01-17 09:00:00', '2017-01-17 05:00:00', '2017-01-17', ''),
(233, 79, 11, '2017-01-17 09:00:00', '2017-01-17 05:00:00', '2017-01-17', ''),
(234, 80, 3, '2017-01-17 09:00:00', '2017-01-17 05:00:00', '2017-01-17', ''),
(235, 81, 14, '2017-01-17 09:00:00', '2017-01-17 05:00:00', '2017-01-17', ''),
(236, 82, 7, '2017-01-17 09:00:00', '2017-01-17 05:00:00', '2017-01-17', ''),
(237, 83, 8, '2017-01-17 09:00:00', '2017-01-17 05:00:00', '2017-01-17', ''),
(238, 84, 4, '2017-01-17 09:00:00', '2017-01-17 05:00:00', '2017-01-17', ''),
(239, 85, 12, '2017-01-17 09:00:00', '2017-01-17 05:00:00', '2017-01-17', ''),
(240, 86, 10, '2017-01-17 09:00:00', '2017-01-17 05:00:00', '2017-01-17', ''),
(241, 89, 3, '2017-01-20 11:46:41', '2017-01-20 11:46:49', '2017-01-20', ''),
(242, 90, 3, '2017-02-20 01:01:41', '2017-02-20 01:01:52', '2017-02-20', '');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendence`
--
ALTER TABLE `attendence`
  ADD CONSTRAINT `attendence_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_assignment`
--
ALTER TABLE `auth_assignment`
  ADD CONSTRAINT `auth_assignment_ibfk_1` FOREIGN KEY (`item_name`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `auth_item`
--
ALTER TABLE `auth_item`
  ADD CONSTRAINT `auth_item_ibfk_1` FOREIGN KEY (`rule_name`) REFERENCES `auth_rule` (`name`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `auth_item_child`
--
ALTER TABLE `auth_item_child`
  ADD CONSTRAINT `auth_item_child_ibfk_1` FOREIGN KEY (`parent`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `auth_item_child_ibfk_2` FOREIGN KEY (`child`) REFERENCES `auth_item` (`name`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `fine`
--
ALTER TABLE `fine`
  ADD CONSTRAINT `fine_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `holidays`
--
ALTER TABLE `holidays`
  ADD CONSTRAINT `holidays_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `monthly_report`
--
ALTER TABLE `monthly_report`
  ADD CONSTRAINT `monthly_report_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `staff`
--
ALTER TABLE `staff`
  ADD CONSTRAINT `staff_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `staff_ibfk_2` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vocation`
--
ALTER TABLE `vocation`
  ADD CONSTRAINT `vocation_ibfk_1` FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
