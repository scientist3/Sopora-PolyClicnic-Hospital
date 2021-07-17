-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2019 at 05:18 PM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 5.6.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospital`
--

-- --------------------------------------------------------

--
-- Table structure for table `acm_account`
--

CREATE TABLE `acm_account` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `type` varchar(20) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `acm_account`
--

INSERT INTO `acm_account` (`id`, `name`, `type`, `description`, `date`, `status`) VALUES
(8, 'Doctor Visit Fees', '1', 'your text will appear here', '2017-02-28', 1),
(10, 'Credit Account  of Hospital', '2', 'your text will appear here', '2017-01-16', 1),
(11, 'Last Account', '2', 'your text will appear here', '2017-01-16', 1),
(15, 'abc', '1', '', '2018-03-08', 1),
(16, 'Nihar Ranjan Patra', '1', '9000', '2018-04-21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `acm_invoice`
--

CREATE TABLE `acm_invoice` (
  `id` int(11) NOT NULL,
  `patient_id` varchar(20) NOT NULL,
  `total` float NOT NULL,
  `vat` float NOT NULL,
  `discount` float NOT NULL,
  `grand_total` float NOT NULL,
  `paid` float NOT NULL,
  `due` float NOT NULL,
  `created_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `acm_invoice`
--

INSERT INTO `acm_invoice` (`id`, `patient_id`, `total`, `vat`, `discount`, `grand_total`, `paid`, `due`, `created_id`, `date`, `status`) VALUES
(14, 'PNYXYXZM', 50, 7.5, 15, 42.5, 0, 42.5, 2, '2017-01-10', 1),
(15, 'PL8XEPGJ', 500, 25, 100, 425, 425, 0, 2, '2017-01-15', 1),
(16, 'PNR6B7EY', 1800, 180, 540, 1440, 0, 1440, 27, '2017-01-16', 1),
(17, 'PZZWZDVA', 9000, 450, 180, 9270, 0, 9270, 27, '2017-02-27', 1),
(18, 'PBNAYR1Q ', 1000, 50, 30, 1020, 0, 1020, 2, '2018-03-08', 1),
(19, 'P72P7031', 20000, 1000, 2000, 19000, 0, 19000, 27, '2018-03-08', 1),
(20, 'PF1R8I8T', 250, 0, 0, 250, 250, 0, 27, '2019-05-21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `acm_invoice_details`
--

CREATE TABLE `acm_invoice_details` (
  `id` int(11) NOT NULL,
  `invoice_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `quantity` float NOT NULL,
  `price` float NOT NULL,
  `subtotal` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `acm_invoice_details`
--

INSERT INTO `acm_invoice_details` (`id`, `invoice_id`, `account_id`, `description`, `quantity`, `price`, `subtotal`) VALUES
(70, 14, 8, 'Visit', 1, 50, 50),
(71, 15, 8, 'Doctor visit fee', 1, 500, 500),
(73, 16, 8, 'This is demo doctor', 3, 600, 1800),
(74, 17, 8, 'Doctor Visit', 1, 5000, 5000),
(75, 17, 9, 'Bed Fee', 1, 4000, 4000),
(76, 18, 13, 'saline', 10, 100, 1000),
(77, 19, 8, 'fhh', 10, 2000, 20000),
(78, 20, 8, 'test', 1, 250, 250);

-- --------------------------------------------------------

--
-- Table structure for table `acm_payment`
--

CREATE TABLE `acm_payment` (
  `id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `pay_to` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `amount` float NOT NULL,
  `created_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `acm_payment`
--

INSERT INTO `acm_payment` (`id`, `account_id`, `pay_to`, `description`, `amount`, `created_id`, `date`, `status`) VALUES
(8, 10, 'Alamin', 'your text will appear here', 500, 2, '2017-01-16', 1),
(9, 11, 'Tanzil', 'your text will appear here', 400, 2, '2017-01-16', 1),
(10, 10, 'Jon Dye', 'your text will appear here', 200, 27, '2017-01-17', 1),
(11, 10, 'Kanye', 'your text will appear here', 500, 27, '2017-01-16', 1),
(12, 11, 'MR. RAHIM', 'your text will appear here', 10000, 27, '2017-02-27', 1),
(13, 10, 'nida', '', 1000, 2, '2018-03-08', 1),
(14, 11, 'xyz', '', 3000, 27, '2018-03-08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `id` int(11) NOT NULL,
  `appointment_id` varchar(20) DEFAULT NULL,
  `patient_id` varchar(20) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `schedule_id` int(11) DEFAULT NULL,
  `serial_no` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `problem` varchar(255) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `create_date` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `appointment_id`, `patient_id`, `department_id`, `doctor_id`, `schedule_id`, `serial_no`, `date`, `problem`, `created_by`, `create_date`, `status`) VALUES
(74, 'AERIUIM1', 'PL8XEPGJ', 15, 15, 21, 1, '2017-01-13', 'your text will appear here', 1, '2017-01-12', 1),
(75, 'AU6167SP', 'P3GWY7V3', 15, 15, 21, 2, '2017-01-13', 'your text will appear here', 8, '2017-01-12', 1),
(76, 'ASAXBOMC', 'PMXZFDP9', 24, 1, 22, 29, '2017-01-14', 'your text will appear here', 2, '2017-01-12', 1),
(77, 'AZO0W67W', 'PL8XEPGJ', 15, 15, 21, 3, '2017-01-20', 'your text will appear here', 8, '2017-01-15', 1),
(78, 'ALEMBJQL', 'P79I35Q5', 12, 12, 19, 1, '2017-01-22', 'your text will appear here', 7, '2017-01-16', 1),
(79, 'AL4WVCVD', 'PPPZJP52', 12, 1, 24, 1, '2017-01-18', 'your text will appear here', 7, '2017-01-16', 1),
(80, 'AZ0YMNYW', 'PNR6B7EY', 15, 1, 21, 1, '2017-01-18', 'your text will appear here', 8, '2017-01-16', 1),
(81, 'AMUYVE7L', 'PR5JXID6', 18, 1, 25, 2, '2017-01-16', 'your text will appear here', 2, '2017-01-16', 1),
(84, 'AK6VLKQ1', 'PYRT7ZOS', 12, 1, 24, 2, '2017-01-18', 'your text will appear here', 1, '2017-01-16', 1),
(85, 'ARUMVG9X', 'P43O0999', 12, 12, 19, 1, '2017-03-05', 'your text will appear here', 0, '2017-02-28', 1),
(86, 'AJ449ZTS', 'PNR6B7EY', 12, 12, 19, 1, '2017-10-29', 'General Checkup', 2, '2017-10-25', 1),
(87, 'ALISBM5P', 'PNR6B7EY', 12, 12, 24, 4, '2017-10-25', '', 2, '2017-10-25', 1),
(88, 'A0D5CVPH', 'P3Y2QHWN', 12, 12, 24, 1, '2018-03-14', 'stomach pain and fever', 2, '2018-03-09', 1),
(89, 'A3QY7FDW', 'PF1R8I8T', 15, 15, 21, 12, '2019-05-22', 'Chest Problem', 7, '2019-05-21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bm_bed`
--

CREATE TABLE `bm_bed` (
  `id` int(11) NOT NULL,
  `type` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `limit` int(3) NOT NULL,
  `charge` float NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bm_bed`
--

INSERT INTO `bm_bed` (`id`, `type`, `description`, `limit`, `charge`, `status`) VALUES
(1, 'NON-AC - 5th Floor', 'This is Test Bed', 20, 5000, 1),
(2, 'AC - 4th Floor', 'This is Test bed\r\n', 5, 10000, 1),
(3, 'AC - 3rd Floor', 'This is Test bed\r\n', 10, 12000, 1),
(4, 'AC - 2nd Floor', 'This is Test bed\r\n', 2, 18000, 1),
(5, 'Non AC 2nd floor', 'this is test bed', 1, 100, 1);

-- --------------------------------------------------------

--
-- Table structure for table `bm_bed_assign`
--

CREATE TABLE `bm_bed_assign` (
  `id` int(11) NOT NULL,
  `serial` varchar(20) DEFAULT NULL,
  `patient_id` varchar(20) NOT NULL,
  `bed_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `assign_date` date NOT NULL,
  `discharge_date` date NOT NULL,
  `assign_by` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bm_bed_assign`
--

INSERT INTO `bm_bed_assign` (`id`, `serial`, `patient_id`, `bed_id`, `description`, `assign_date`, `discharge_date`, `assign_by`, `status`) VALUES
(206, 'AM4QD0', 'PA0I54ZM', 2, '', '2017-01-24', '2017-01-27', 2, 1),
(207, 'AM4QD0', 'PA0I54ZM', 2, '', '2017-01-25', '2017-01-27', 2, 1),
(208, 'AM4QD0', 'PA0I54ZM', 2, '', '2017-01-26', '2017-01-27', 2, 1),
(209, 'AM4QD0', 'PA0I54ZM', 2, '', '2017-01-27', '2017-01-27', 2, 1),
(223, 'WYUKLB', 'PA0I54ZM', 2, '', '2017-01-24', '2017-01-25', 2, 1),
(224, 'WYUKLB', 'PA0I54ZM', 2, '', '2017-01-25', '2017-01-25', 2, 1),
(241, '2ZUESF', 'P1RNKS9W', 1, '', '2017-01-24', '2017-01-28', 2, 1),
(242, '2ZUESF', 'P1RNKS9W', 1, '', '2017-01-25', '2017-01-28', 2, 1),
(243, '2ZUESF', 'P1RNKS9W', 1, '', '2017-01-26', '2017-01-28', 2, 1),
(244, '2ZUESF', 'P1RNKS9W', 1, '', '2017-01-27', '2017-01-28', 2, 1),
(245, '2ZUESF', 'P1RNKS9W', 1, '', '2017-01-28', '2017-01-28', 2, 1),
(246, 'V5JDZV', 'PYRT7ZOS', 2, '', '2017-01-26', '2017-01-28', 2, 1),
(247, 'V5JDZV', 'PYRT7ZOS', 2, '', '2017-01-27', '2017-01-28', 2, 1),
(248, 'V5JDZV', 'PYRT7ZOS', 2, '', '2017-01-28', '2017-01-28', 2, 1),
(254, 'CQAGY3', 'P3GWY7V3', 1, '', '2017-01-24', '2017-01-31', 2, 1),
(255, 'CQAGY3', 'P3GWY7V3', 1, '', '2017-01-25', '2017-01-31', 2, 1),
(256, 'CQAGY3', 'P3GWY7V3', 1, '', '2017-01-26', '2017-01-31', 2, 1),
(257, 'CQAGY3', 'P3GWY7V3', 1, '', '2017-01-27', '2017-01-31', 2, 1),
(258, 'CQAGY3', 'P3GWY7V3', 1, '', '2017-01-28', '2017-01-31', 2, 1),
(259, 'CQAGY3', 'P3GWY7V3', 1, '', '2017-01-29', '2017-01-31', 2, 1),
(260, 'CQAGY3', 'P3GWY7V3', 1, '', '2017-01-30', '2017-01-31', 2, 1),
(261, 'CQAGY3', 'P3GWY7V3', 1, '', '2017-01-31', '2017-01-31', 2, 1),
(262, 'FXWA25', 'PA0I54ZM', 1, '', '2017-01-24', '2017-01-28', 2, 1),
(263, 'FXWA25', 'PA0I54ZM', 1, '', '2017-01-25', '2017-01-28', 2, 1),
(264, 'FXWA25', 'PA0I54ZM', 1, '', '2017-01-26', '2017-01-28', 2, 1),
(265, 'FXWA25', 'PA0I54ZM', 1, '', '2017-01-27', '2017-01-28', 2, 1),
(266, 'FXWA25', 'PA0I54ZM', 1, '', '2017-01-28', '2017-01-28', 2, 1),
(270, '8G3DZ5', 'ASDFG', 1, '', '2017-02-23', '2017-02-23', 1, 1),
(271, 'B6LJFN', 'PNR6B7EY', 2, '', '2017-02-23', '2017-02-28', 1, 1),
(272, 'B6LJFN', 'PNR6B7EY', 2, '', '2017-02-24', '2017-02-28', 1, 1),
(273, 'B6LJFN', 'PNR6B7EY', 2, '', '2017-02-25', '2017-02-28', 1, 1),
(274, 'B6LJFN', 'PNR6B7EY', 2, '', '2017-02-26', '2017-02-28', 1, 1),
(275, 'B6LJFN', 'PNR6B7EY', 2, '', '2017-02-27', '2017-02-28', 1, 1),
(276, 'B6LJFN', 'PNR6B7EY', 2, '', '2017-02-28', '2017-02-28', 1, 1),
(277, 'JO0XFS', 'PBNAYR1Q', 5, '', '2018-03-08', '2018-03-08', 2, 1),
(278, 'QI3RCD', 'PJ3URDGO', 1, '', '2018-03-08', '2018-03-09', 2, 1),
(279, 'QI3RCD', 'PJ3URDGO', 1, '', '2018-03-09', '2018-03-09', 2, 1),
(280, 'HN9JGA', 'P72P7031', 1, '', '2018-03-08', '2018-03-08', 1, 1),
(281, 'UW26JD', '5', 2, '', '2018-04-20', '2018-04-27', 2, 1),
(282, 'UW26JD', '5', 2, '', '2018-04-21', '2018-04-27', 2, 1),
(283, 'UW26JD', '5', 2, '', '2018-04-22', '2018-04-27', 2, 1),
(284, 'UW26JD', '5', 2, '', '2018-04-23', '2018-04-27', 2, 1),
(285, 'UW26JD', '5', 2, '', '2018-04-24', '2018-04-27', 2, 1),
(286, 'UW26JD', '5', 2, '', '2018-04-25', '2018-04-27', 2, 1),
(287, 'UW26JD', '5', 2, '', '2018-04-26', '2018-04-27', 2, 1),
(288, 'UW26JD', '5', 2, '', '2018-04-27', '2018-04-27', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `cm_patient`
--

CREATE TABLE `cm_patient` (
  `id` int(11) NOT NULL,
  `patient_id` varchar(30) NOT NULL,
  `case_manager_id` int(11) NOT NULL,
  `ref_doctor_id` int(11) DEFAULT NULL,
  `hospital_name` varchar(255) DEFAULT NULL,
  `hospital_address` text,
  `doctor_name` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cm_patient`
--

INSERT INTO `cm_patient` (`id`, `patient_id`, `case_manager_id`, `ref_doctor_id`, `hospital_name`, `hospital_address`, `doctor_name`, `created_by`, `date`, `status`) VALUES
(1, 'P1XWEV6W', 30, 1, 'Hospital ', 'address,pin', 'John Doe', 2, '2017-04-22', 1),
(7, 'P45KRFCA', 30, 1, 'name HOSPITAL', 'address,pin', 'XYZ', 2, '2017-04-22', 1),
(9, 'PNR6B7EY', 30, 14, 'name HOSPITAL', 'address,pin', '', 2, '2017-04-22', 1),
(10, 'P43O0999', 30, 17, 'name HOSPITAL', 'address,pin', 'TEST', 2, '2017-04-23', 1),
(11, 'P1XWEV6W', 31, 12, 'name Hospital', 'address,pin', 'Demo Doctor', 2, '2017-04-23', 1),
(12, 'P45KRFCA', 31, 1, 'name HOSPITAL', 'addrss', '', 2, '2017-04-23', 1),
(13, 'PBNAYR1Q', 31, 32, 'Life care', 'jubliee park', '', 2, '2018-03-08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cm_status`
--

CREATE TABLE `cm_status` (
  `id` int(11) NOT NULL,
  `critical_status` varchar(255) NOT NULL DEFAULT '1',
  `cm_patient_id` int(11) NOT NULL,
  `description` text,
  `datetime` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cm_status`
--

INSERT INTO `cm_status` (`id`, `critical_status`, `cm_patient_id`, `description`, `datetime`) VALUES
(20, 'Undeterminate', 1, 'Good', '2017-04-22 13:02:16'),
(21, 'Undeterminate', 1, 'TEST', '2017-04-22 13:04:22'),
(22, 'Undeterminate', 12, 'One Star', '2017-04-22 13:16:01'),
(23, 'Undeterminate', 12, 'Two Star', '2017-04-22 13:16:07'),
(24, 'Undeterminate', 12, 'Five Star', '2017-04-22 13:16:15'),
(25, 'Undeterminate', 12, 'Three Star', '2017-04-22 13:16:23'),
(26, 'Undeterminate', 12, 'Four Star', '2017-04-22 13:35:36'),
(33, 'Undeterminate', 1, 'Good', '2017-04-22 14:13:04'),
(34, 'Undeterminate', 9, 'Critical', '2017-04-22 15:02:27'),
(35, 'Undeterminate', 9, 'Fair !', '2017-04-22 15:02:36'),
(36, 'Undeterminate', 12, 'Good', '2017-04-23 08:33:08'),
(37, 'Undeterminate', 9, 'TEST', '2017-04-23 08:45:11'),
(38, 'Undeterminate', 10, 'Undetermined', '2017-04-23 09:22:55'),
(39, 'Undeterminate', 10, 'TEST ', '2017-04-23 09:49:19'),
(40, 'Undeterminate', 10, 'TET', '2017-04-23 09:52:10'),
(41, 'Undeterminate', 11, 'Undetermined status ', '2017-04-23 09:58:00'),
(42, 'Undeterminate', 11, 'Current status is fair', '2017-04-23 09:58:30'),
(43, 'HELLO #', 12, 'WORLD!', '2017-04-25 12:43:44'),
(44, 'HELLO', 12, 'WORLD', '2017-04-25 12:52:57'),
(45, 'ASFSD', 12, 'SFASF', '2017-04-25 12:52:57'),
(46, 'ASFSD', 12, 'SFASF', '2017-04-25 12:52:57'),
(47, 'ASFSD', 12, 'SFASF', '2017-04-25 12:52:57');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `dprt_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`dprt_id`, `name`, `description`, `status`) VALUES
(12, 'Microbiology', 'your text will appear here', 1),
(13, 'Neonatal', 'your text will appear here', 1),
(14, 'Nephrology', 'your text will appear here', 1),
(15, 'Neurology', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ipsum magna, gravida nec erat ac, malesuada pharetra felis. Phasellus eu dolor orci. Duis et dictum sem, sit amet sagittis dolor. Curabitur scelerisque, nunc eget viverra malesuada, nunc ligula tincidunt nisi, eget elementum urna magna at dui. Praesent eu tincidunt arcu. Ut imperdiet a ligula nec dapibus. Aliquam erat volutpat. Donec auctor elementum accumsan. Vestibulum velit augue, feugiat ac nisl in, pharetra accumsan ligula. Proin nunc mauris, ultrices quis tristique vitae, ornare quis nunc. Aenean ut tincidunt lorem. Maecenas consectetur faucibus velit, nec tincidunt nulla fermentum sed.\r\n\r\n', 1),
(16, 'Oncology', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ipsum magna, gravida nec erat ac, malesuada pharetra felis. Phasellus eu dolor orci. Duis et dictum sem, sit amet sagittis dolor. Curabitur scelerisque, nunc eget viverra malesuada, nunc ligula tincidunt nisi, eget elementum urna magna at dui. Praesent eu tincidunt arcu. Ut imperdiet a ligula nec dapibus. Aliquam erat volutpat. Donec auctor elementum accumsan. Vestibulum velit augue, feugiat ac nisl in, pharetra accumsan ligula. Proin nunc mauris, ultrices quis tristique vitae, ornare quis nunc. Aenean ut tincidunt lorem. Maecenas consectetur faucibus velit, nec tincidunt nulla fermentum sed.\r\n\r\n', 1),
(17, 'Orthopaedics', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ipsum magna, gravida nec erat ac, malesuada pharetra felis. Phasellus eu dolor orci. Duis et dictum sem, sit amet sagittis dolor. Curabitur scelerisque, nunc eget viverra malesuada, nunc ligula tincidunt nisi, eget elementum urna magna at dui. Praesent eu tincidunt arcu. Ut imperdiet a ligula nec dapibus. Aliquam erat volutpat. Donec auctor elementum accumsan. Vestibulum velit augue, feugiat ac nisl in, pharetra accumsan ligula. Proin nunc mauris, ultrices quis tristique vitae, ornare quis nunc. Aenean ut tincidunt lorem. Maecenas consectetur faucibus velit, nec tincidunt nulla fermentum sed.\r\n\r\n', 1),
(18, 'Pharmacy', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ipsum magna, gravida nec erat ac, malesuada pharetra felis. Phasellus eu dolor orci. Duis et dictum sem, sit amet sagittis dolor. Curabitur scelerisque, nunc eget viverra malesuada, nunc ligula tincidunt nisi, eget elementum urna magna at dui. Praesent eu tincidunt arcu. Ut imperdiet a ligula nec dapibus. Aliquam erat volutpat. Donec auctor elementum accumsan. Vestibulum velit augue, feugiat ac nisl in, pharetra accumsan ligula. Proin nunc mauris, ultrices quis tristique vitae, ornare quis nunc. Aenean ut tincidunt lorem. Maecenas consectetur faucibus velit, nec tincidunt nulla fermentum sed.\r\n\r\n', 1),
(19, 'Radiotherapy', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ipsum magna, gravida nec erat ac, malesuada pharetra felis. Phasellus eu dolor orci. Duis et dictum sem, sit amet sagittis dolor. Curabitur scelerisque, nunc eget viverra malesuada, nunc ligula tincidunt nisi, eget elementum urna magna at dui. Praesent eu tincidunt arcu. Ut imperdiet a ligula nec dapibus. Aliquam erat volutpat. Donec auctor elementum accumsan. Vestibulum velit augue, feugiat ac nisl in, pharetra accumsan ligula. Proin nunc mauris, ultrices quis tristique vitae, ornare quis nunc. Aenean ut tincidunt lorem. Maecenas consectetur faucibus velit, nec tincidunt nulla fermentum sed.\r\n\r\n', 1),
(21, 'Rheumatology', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ipsum magna, gravida nec erat ac, malesuada pharetra felis. Phasellus eu dolor orci. Duis et dictum sem, sit amet sagittis dolor. Curabitur scelerisque, nunc eget viverra malesuada, nunc ligula tincidunt nisi, eget elementum urna magna at dui. Praesent eu tincidunt arcu. Ut imperdiet a ligula nec dapibus. Aliquam erat volutpat. Donec auctor elementum accumsan. Vestibulum velit augue, feugiat ac nisl in, pharetra accumsan ligula. Proin nunc mauris, ultrices quis tristique vitae, ornare quis nunc. Aenean ut tincidunt lorem. Maecenas consectetur faucibus velit, nec tincidunt nulla fermentum sed.\r\n\r\n', 1),
(22, 'Gynaecology', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ipsum magna, gravida nec erat ac, malesuada pharetra felis. Phasellus eu dolor orci. Duis et dictum sem, sit amet sagittis dolor. Curabitur scelerisque, nunc eget viverra malesuada, nunc ligula tincidunt nisi, eget elementum urna magna at dui. Praesent eu tincidunt arcu. Ut imperdiet a ligula nec dapibus. Aliquam erat volutpat. Donec auctor elementum accumsan. Vestibulum velit augue, feugiat ac nisl in, pharetra accumsan ligula. Proin nunc mauris, ultrices quis tristique vitae, ornare quis nunc. Aenean ut tincidunt lorem. Maecenas consectetur faucibus velit, nec tincidunt nulla fermentum sed.\r\n\r\n', 1),
(23, 'Obstetrics', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ipsum magna, gravida nec erat ac, malesuada pharetra felis. Phasellus eu dolor orci. Duis et dictum sem, sit amet sagittis dolor. Curabitur scelerisque, nunc eget viverra malesuada, nunc ligula tincidunt nisi, eget elementum urna magna at dui. Praesent eu tincidunt arcu. Ut imperdiet a ligula nec dapibus. Aliquam erat volutpat. Donec auctor elementum accumsan. Vestibulum velit augue, feugiat ac nisl in, pharetra accumsan ligula. Proin nunc mauris, ultrices quis tristique vitae, ornare quis nunc. Aenean ut tincidunt lorem. Maecenas consectetur faucibus velit, nec tincidunt nulla fermentum sed.\r\n\r\n', 1),
(25, 'General Surgery', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ipsum magna, gravida nec erat ac, malesuada pharetra felis. Phasellus eu dolor orci. Duis et dictum sem, sit amet sagittis dolor. Curabitur scelerisque, nunc eget viverra malesuada, nunc ligula tincidunt nisi, eget elementum urna magna at dui. Praesent eu tincidunt arcu. Ut imperdiet a ligula nec dapibus. Aliquam erat volutpat. Donec auctor elementum accumsan. Vestibulum velit augue, feugiat ac nisl in, pharetra accumsan ligula.', 1),
(28, 'Physiotherapy', 'Physical therapy, also known as physiotherapy, is one of the allied health professions that, by using mechanical force and movements, manual therapy, exercise therapy and electrotherapy, remediates impairments and promotes mobility', 1),
(29, 'Hospital management', 'will manage task', 1),
(30, 'Laboratory', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `document`
--

CREATE TABLE `document` (
  `id` int(11) NOT NULL,
  `patient_id` varchar(30) NOT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `description` text,
  `hidden_attach_file` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `upload_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `document`
--

INSERT INTO `document` (`id`, `patient_id`, `doctor_id`, `description`, `hidden_attach_file`, `date`, `upload_by`) VALUES
(4, 'P1XWEV6W', 1, '<p>TET</p>', './assets/attachments/admin_kill-command_hi_bengali-1531392.zip', '2017-04-25', 2),
(5, 'P1XWEV6W', 13, '<p>TET</p>', './assets/attachments/admin_chrysanthemum.jpg', '2017-04-25', 2),
(6, 'P1XWEV6W', 13, '<p>TET</p>', './assets/attachments/admin_examplefile.pdf', '2017-04-25', 2),
(9, 'P45KRFCA', 16, '<p>P45KRFCA</p>', './assets/attachments/admin_admin_examplefile.pdf', '2017-04-25', 2),
(10, '12', 32, '', './assets/attachments/admin_hms.png', '2018-03-08', 2),
(11, 'P72P7031', 1, '', './assets/attachments/doctor_hms.png', '2018-03-08', 1),
(12, 'P3Y2QHWN', 15, '<p>Stomach Pain and fever</p>', './assets/attachments/admin_1928be0.jpg', '2018-03-09', 2);

-- --------------------------------------------------------

--
-- Table structure for table `enquiry`
--

CREATE TABLE `enquiry` (
  `enquiry_id` int(11) NOT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `enquiry` text,
  `checked` tinyint(1) DEFAULT NULL,
  `ip_address` varchar(20) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `checked_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `enquiry`
--

INSERT INTO `enquiry` (`enquiry_id`, `email`, `phone`, `name`, `enquiry`, `checked`, `ip_address`, `user_agent`, `checked_by`, `created_date`, `status`) VALUES
(56, 'tanzil4091@gmail.com', '1922296392', 'Tanzil Ahmad', 'Hi ! I want to add your Hospital', 1, '103.225.228.130', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.95 Safari/537.36', 2, '2017-01-16 05:29:20', 1),
(57, 'sumch@gmail.com', '1922296398', 'Tarek', 'Hi ! I want to work with hospital', 1, '103.225.228.130', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.95 Safari/537.36', 7, '2017-01-16 05:30:05', 1),
(58, 'jon@gmail.com', '1782296392', 'Jon Doy', 'Hi ! How are you. i want to work with demo hospital limited.', 1, '103.225.228.130', 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_11_3) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/55.0.2883.95 Safari/537.36', 7, '2017-01-16 05:31:15', 1),
(59, 'john@doe.com', '01255564757845', 'John Doe', '<p>HELLO</p>', 1, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36', 2, '2017-02-26 09:32:46', 0),
(60, 'john@doe.com', '01255564757845', 'John Doe', '<p>HELLO</p>', 1, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36', 7, '2017-02-26 09:34:20', 0),
(62, 'john@doe.com', '01312323456', 'John Doe', '<p>Hello World!</p>\r\n<p>Â </p>', 1, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36', 2, '2017-02-26 11:25:20', 1),
(63, 'receptionist@demo.com', '0123456789', 'Test', '<p>HELLO ADMIN!</p>', 1, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36', 2, '2017-02-27 09:06:10', 1),
(64, 'test@demo.com', '0123456789', 'Test', 'Need a Doctor for Check-up?\r\nJUST MAKE AN APPOINTMENT & YOU\'RE DONE !', 1, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36', 2, '2017-02-27 10:32:02', 1),
(65, 'swift@example.com', '1234567890', 'Swift', 'Need a Doctor for Check-up?\r\nJUST MAKE AN APPOINTMENT & YOU\'RE DONE !', 1, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36', 2, '2017-02-28 11:39:52', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ha_birth`
--

CREATE TABLE `ha_birth` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `patient_id` varchar(30) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ha_birth`
--

INSERT INTO `ha_birth` (`id`, `title`, `description`, `patient_id`, `doctor_id`, `date`, `status`) VALUES
(1, 'Accident ', 'Insurance companies will try to pay you less than your claim is worth. Don\'t let them! Use our free case evaluation to get the true value of your injury case.\r\n\r\nAccidents that commonly result in compensation include:\r\n\r\nCar accident injuries\r\nPedestrian accidents\r\nHit and runs\r\nDrunk driving crashes\r\nDangerous road construction accidents\r\nMotorcycle accidents\r\nCommercial trucking accidents\r\nUninsured motorists\r\nYour case review will be performed by a local car accident attorney. They will provide you an accurate estimate of your claim value and can help you get money for lost wages, personal injuries, medical bills, and pain and suffering.\r\n\r\nThe case evaluation is of no obligation to you. However, even if you do choose to work with a car accident attorney, you pay $0 unless you win! There are no upfront fees.', 'PNYXYXZM', 13, '2017-01-09', 1),
(2, 'Insurance companies will try to pay you less than .', 'PHP 5.5+ require at least Windows 2008/Vista, or 2008r2, 2012, 2012r2, 2016 or 7, 8, 8.1, 10. Either 32-Bit or 64-bit (aka X86 or X64. PHP does not run on Windows RT/WOA/ARM).\r\n\r\nPHP requires the Visual C runtime(CRT). Many applications require that so it may already be installed.\r\n\r\nPHP 5.5 and 5.6 require VC CRT 11 (Visual Studio 2012). See: Â» https://www.microsoft.com/en-us/download/details.aspx?id=30679\r\n\r\nPHP 7.0+ requires VC CRT 14 (Visual Studio 2015). See: Â» https://www.microsoft.com/en-us/download/details.aspx?id=48145\r\n\r\nYou MUST download the x86 CRT for PHP x86 builds and the x64 CRT for PHP x64 builds.\r\n\r\nIf CRT is already installed, the installer will tell you that and not change anything.\r\n\r\nThe CRT installer supports the /quiet and /norestart command-line switches, so you can script running it.\r\n\r\nVC11 CRT DLLs can be copied from your local machine to a remote machine(a `Copy Deployment` installation) instead of running the installer on the remote machine (such as a web server you have restricted access to). See: http://www.sitepoint.com/install-php53-windows/\r\n\r\nVC14 CRT does not support a `Copy Deployment` installation. VC14 CRT has many more DLLs(most in files with names starting with api-*). If you can find them all and copy them, it will also work (try a tool like Resource Hacker to get a list of all the DLLs to copy).', 'PMXZFDP9', 17, '2017-01-31', 1),
(3, 'TEST', '', '12213', 0, '2017-02-23', 1),
(4, 'TEST', '', '12213', 1, '2017-02-23', 1),
(5, 'TEST', 'à¦‡à¦°à¦¾à¦¨à§‡à¦° à¦ªà§à¦°à¦¤à¦¿à¦°à¦•à§à¦·à¦¾ à¦¸à¦•à§à¦·à¦®à¦¤à¦¾ à¦…à¦¬à¦œà§à¦žà¦¾ à¦•à¦°à¦²à§‡ à¦¯à§à¦•à§à¦¤à¦°à¦¾à¦·à§à¦Ÿà§à¦°à¦•à§‡ à¦®à§à¦–à§‡à¦° à¦“à¦ªà¦° à¦•à¦ à¦¿à¦¨ à¦œà¦¬à¦¾à¦¬ à¦¦à§‡à¦¬à§‡ à¦¤à¦¾à¦°à¦¾à¥¤ à¦‡à¦°à¦¾à¦¨à§‡à¦° à¦…à¦­à¦¿à¦œà¦¾à¦¤ à¦°à§‡à¦­à¦²à§à¦¯à§à¦¶à¦¨à¦¾à¦°à¦¿ à¦—à¦¾à¦°à§à¦¡à§‡à¦° à¦à¦•à¦œà¦¨ à¦•à¦®à¦¾à¦¨à§à¦¡à¦¾à¦° à¦—à¦¤à¦•à¦¾à¦² à¦¬à§à¦§à¦¬à¦¾à¦° à¦à¦‡ à¦®à¦¨à§à¦¤à¦¬à§à¦¯ à¦•à¦°à§‡à¦›à§‡à¦¨à¥¤ à¦¬à¦¾à¦°à§à¦¤à¦¾ à¦¸à¦‚à¦¸à§à¦¥à¦¾ à¦°à§Ÿà¦Ÿà¦¾à¦°à§à¦¸à§‡à¦° à¦–à¦¬à¦°à§‡ à¦à¦‡ à¦¤à¦¥à§à¦¯ à¦œà¦¾à¦¨à¦¾à¦¨à§‹ à¦¹à§Ÿà¥¤\r\n\r\nà¦¯à§à¦•à§à¦¤à¦°à¦¾à¦·à§à¦Ÿà§à¦°à§‡à¦° à¦ªà§à¦°à¦¤à¦¿ à¦‡à¦™à§à¦—à¦¿à¦¤ à¦•à¦°à§‡ à¦—à¦¾à¦°à§à¦¡à§‡à¦° à¦¸à§à¦¥à¦²à¦¬à¦¾à¦¹à¦¿à¦¨à§€à¦° à¦ªà§à¦°à¦§à¦¾à¦¨ à¦œà§‡à¦¨à¦¾à¦°à§‡à¦² à¦®à§‹à¦¹à¦¾à¦®à§à¦®à¦¦ à¦ªà¦¾à¦•à¦ªà§‹à¦° à¦¬à¦²à§‡à¦¨, à¦‡à¦°à¦¾à¦¨à¦•à§‡ à¦®à§‚à¦²à§à¦¯à¦¾à§Ÿà¦¨à§‡à¦° à¦•à§à¦·à§‡à¦¤à§à¦°à§‡ à¦¶à¦¤à§à¦°à§à¦° à¦­à§à¦² à¦•à¦°à¦¾ à¦‰à¦šà¦¿à¦¤ à¦¨à§Ÿà¥¤ à¦¤à¦¾à¦°à¦¾ à¦¯à¦¦à¦¿ à¦ à¦•à§à¦·à§‡à¦¤à§à¦°à§‡ à¦­à§à¦² à¦•à¦°à§‡, à¦¤à¦¾à¦¹à¦²à§‡ à¦®à§à¦–à§‡à¦° à¦“à¦ªà¦° à¦¤à¦¾à¦°à¦¾ à¦•à¦ à¦¿à¦¨ à¦œà¦¬à¦¾à¦¬ à¦ªà¦¾à¦¬à§‡à¥¤\r\n\r\nà¦œà§‡à¦¨à¦¾à¦°à§‡à¦² à¦ªà¦¾à¦•à¦ªà§‹à¦° à¦à¦‡ à¦‰à¦¦à§à¦§à§ƒà¦¤à¦¿ à¦°à§‡à¦­à¦²à§à¦¯à§à¦¶à¦¨à¦¾à¦°à¦¿ à¦—à¦¾à¦°à§à¦¡à§‡à¦° à¦¸à¦‚à¦¬à¦¾à¦¦ à¦“à§Ÿà§‡à¦¬à¦¸à¦¾à¦‡à¦Ÿà§‡ à¦ªà§à¦°à¦•à¦¾à¦¶à¦¿à¦¤ à¦¹à§Ÿà§‡à¦›à§‡à¥¤\r\n\r\nà¦—à¦¤à¦•à¦¾à¦² à¦°à§‡à¦­à¦²à§à¦¯à§à¦¶à¦¨à¦¾à¦°à¦¿ à¦—à¦¾à¦°à§à¦¡à§‡à¦° à¦¤à¦¿à¦¨ à¦¦à¦¿à¦¨à§‡à¦° à¦¸à¦¾à¦®à¦°à¦¿à¦• à¦®à¦¹à§œà¦¾ à¦¶à§‡à¦· à¦¹à§Ÿà¥¤ à¦‡à¦°à¦¾à¦¨à§‡à¦° à¦®à¦§à§à¦¯ à¦“ à¦ªà§‚à¦°à§à¦¬à¦¾à¦žà§à¦šà¦²à§‡ à¦à¦‡ à¦®à¦¹à§œà¦¾ à¦…à¦¨à§à¦·à§à¦ à¦¿à¦¤ à¦¹à§Ÿà¥¤ à¦®à¦¹à§œà¦¾à§Ÿ à¦°à¦•à§‡à¦Ÿ, à¦¬à§œ à¦•à¦¾à¦®à¦¾à¦¨, à¦Ÿà§à¦¯à¦¾à¦‚à¦•, à¦¹à§‡à¦²à¦¿à¦•à¦ªà§à¦Ÿà¦¾à¦° à¦ªà§à¦°à¦­à§ƒà¦¤à¦¿ à¦¸à¦®à¦°à¦¾à¦¸à§à¦¤à§à¦° à¦“ à¦¸à¦°à¦žà§à¦œà¦¾à¦® à¦¬à§à¦¯à¦¬à¦¹à¦¾à¦° à¦•à¦°à¦¾ à¦¹à§Ÿà¥¤\r\n\r\nà¦œà§‡à¦¨à¦¾à¦°à§‡à¦² à¦ªà¦¾à¦•à¦ªà§‹à¦° à¦¬à¦²à§‡à¦¨, à¦¬à¦¿à¦¶à§à¦¬ à¦”à¦¦à§à¦§à¦¤à§à¦¯à§‡à¦° à¦ªà§à¦°à¦¤à¦¿ à¦à¦‡ à¦¸à¦¾à¦®à¦°à¦¿à¦• à¦®à¦¹à§œà¦¾à¦° à¦¬à¦¾à¦°à§à¦¤à¦¾â€”â€˜à¦¬à§‹à¦•à¦¾à¦®à¦¿ à¦•à§‡à¦¾à¦°à§‹ à¦¨à¦¾â€™à¥¤ à¦­à§‚à¦®à¦¿à¦¤à§‡ à¦‡à¦°à¦¾à¦¨à§‡à¦° à¦¶à¦•à§à¦¤à¦¿ à¦†à¦œ à¦¸à¦¬à¦¾à¦‡ à¦¦à§‡à¦–à¦¤à§‡ à¦ªà¦¾à¦šà§à¦›à§‡à¥¤\r\n\r\nà¦°à§‡à¦­à¦²à§à¦¯à§à¦¶à¦¨à¦¾à¦°à¦¿ à¦—à¦¾à¦°à§à¦¡à§‡à¦° à¦¦à¦¾à¦¬à¦¿, à¦¤à¦¾à¦°à¦¾ à¦‰à¦¨à§à¦¨à¦¤ à¦°à¦•à§‡à¦Ÿà§‡à¦° à¦ªà¦°à§€à¦•à§à¦·à¦¾ à¦šà¦¾à¦²à¦¿à§Ÿà§‡à¦›à§‡à¥¤ à¦®à¦¹à§œà¦¾à§Ÿ à¦¡à§à¦°à§‹à¦¨à¦“ à¦¬à§à¦¯à¦¬à¦¹à¦¾à¦° à¦•à¦°à¦¾ à¦¹à§Ÿà§‡à¦›à§‡à¥¤\r\n\r\n\r\nà¦•à§à¦·à§‡à¦ªà¦£à¦¾à¦¸à§à¦¤à§à¦° à¦ªà¦°à§€à¦•à§à¦·à¦¾ à¦¨à¦¿à§Ÿà§‡ à¦¡à§‹à¦¨à¦¾à¦²à§à¦¡ à¦Ÿà§à¦°à¦¾à¦®à§à¦ªà§‡à¦° à¦¯à§à¦•à§à¦¤à¦°à¦¾à¦·à§à¦Ÿà§à¦°à§‡à¦° à¦¹à§à¦®à¦•à¦¿-à¦§à¦®à¦•à¦¿à¦° à¦®à¦§à§à¦¯à§‡ à¦‡à¦°à¦¾à¦¨ à¦à¦‡ à¦¸à¦¾à¦®à¦°à¦¿à¦• à¦®à¦¹à§œà¦¾ à¦šà¦¾à¦²à¦¾à¦²à¥¤', 'PNR6B7EY', 1, '2017-02-23', 1),
(6, 'birth report', '', 'PBNAYR1Q', 32, '1992-11-01', 1),
(7, 'birth report', 'test', 'P72P7031', 1, '2018-03-08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ha_category`
--

CREATE TABLE `ha_category` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `description` text,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ha_category`
--

INSERT INTO `ha_category` (`id`, `name`, `description`, `status`) VALUES
(16, 'F', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ipsum magna, gravida nec erat ac, malesuada pharetra felis. Phasellus eu dolor orci. Duis et dictum sem, sit amet sagittis dolor. Curabitur scelerisque, nunc eget viverra malesuada, nunc ligula tincidunt nisi, eget elementum urna magna at dui. Praesent eu tincidunt arcu. Ut imperdiet a ligula nec dapibus. Aliquam erat volutpat. Donec auctor elementum accumsan. Vestibulum velit augue, feugiat ac nisl in, pharetra accumsan ligula. Proin nunc mauris, ultrices quis tristique vitae, ornare quis nunc. Aenean ut tincidunt lorem. Maecenas consectetur faucibus velit, nec tincidunt nulla fermentum sed.</p>', 1),
(17, 'E', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ipsum magna, gravida nec erat ac, malesuada pharetra felis. Phasellus eu dolor orci. Duis et dictum sem, sit amet sagittis dolor. Curabitur scelerisque, nunc eget viverra malesuada, nunc ligula tincidunt nisi, eget elementum urna magna at dui. Praesent eu tincidunt arcu. Ut imperdiet a ligula nec dapibus. Aliquam erat volutpat. Donec auctor elementum accumsan. Vestibulum velit augue, feugiat ac nisl in, pharetra accumsan ligula. Proin nunc mauris, ultrices quis tristique vitae, ornare quis nunc. Aenean ut tincidunt lorem. Maecenas consectetur faucibus velit, nec tincidunt nulla fermentum sed.</p>', 1),
(18, 'D', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ipsum magna, gravida nec erat ac, malesuada pharetra felis. Phasellus eu dolor orci. Duis et dictum sem, sit amet sagittis dolor. Curabitur scelerisque, nunc eget viverra malesuada, nunc ligula tincidunt nisi, eget elementum urna magna at dui. Praesent eu tincidunt arcu. Ut imperdiet a ligula nec dapibus. Aliquam erat volutpat. Donec auctor elementum accumsan. Vestibulum velit augue, feugiat ac nisl in, pharetra accumsan ligula. Proin nunc mauris, ultrices quis tristique vitae, ornare quis nunc. Aenean ut tincidunt lorem. Maecenas consectetur faucibus velit, nec tincidunt nulla fermentum sed.</p>', 1),
(19, 'C', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ipsum magna, gravida nec erat ac, malesuada pharetra felis. Phasellus eu dolor orci. Duis et dictum sem, sit amet sagittis dolor. Curabitur scelerisque, nunc eget viverra malesuada, nunc ligula tincidunt nisi, eget elementum urna magna at dui. Praesent eu tincidunt arcu. Ut imperdiet a ligula nec dapibus. Aliquam erat volutpat. Donec auctor elementum accumsan. Vestibulum velit augue, feugiat ac nisl in, pharetra accumsan ligula. Proin nunc mauris, ultrices quis tristique vitae, ornare quis nunc. Aenean ut tincidunt lorem. Maecenas consectetur faucibus velit, nec tincidunt nulla fermentum sed.</p>', 1),
(21, 'B', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ipsum magna, gravida nec erat ac, malesuada pharetra felis. Phasellus eu dolor orci. Duis et dictum sem, sit amet sagittis dolor. Curabitur scelerisque, nunc eget viverra malesuada, nunc ligula tincidunt nisi, eget elementum urna magna at dui. Praesent eu tincidunt arcu. Ut imperdiet a ligula nec dapibus. Aliquam erat volutpat. Donec auctor elementum accumsan. Vestibulum velit augue, feugiat ac nisl in, pharetra accumsan ligula. Proin nunc mauris, ultrices quis tristique vitae, ornare quis nunc. Aenean ut tincidunt lorem. Maecenas consectetur faucibus velit, nec tincidunt nulla fermentum sed.</p>', 1),
(22, 'A', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ipsum magna, gravida nec erat ac, malesuada pharetra felis. Phasellus eu dolor orci. Duis et dictum sem, sit amet sagittis dolor. Curabitur scelerisque, nunc eget viverra malesuada, nunc ligula tincidunt nisi, eget elementum urna magna at dui. Praesent eu tincidunt arcu. Ut imperdiet a ligula nec dapibus. Aliquam erat volutpat. Donec auctor elementum accumsan. Vestibulum velit augue, feugiat ac nisl in, pharetra accumsan ligula. Proin nunc mauris, ultrices quis tristique vitae, ornare quis nunc. Aenean ut tincidunt lorem. Maecenas consectetur faucibus velit, nec tincidunt nulla fermentum sed.</p>', 1),
(23, 'G', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ipsum magna, gravida nec erat ac, malesuada pharetra felis. Phasellus eu dolor orci. Duis et dictum sem, sit amet sagittis dolor. Curabitur scelerisque, nunc eget viverra malesuada, nunc ligula tincidunt nisi, eget elementum urna magna at dui. Praesent eu tincidunt arcu. Ut imperdiet a ligula nec dapibus. Aliquam erat volutpat. Donec auctor elementum accumsan. Vestibulum velit augue, feugiat ac nisl in, pharetra accumsan ligula. Proin nunc mauris, ultrices quis tristique vitae, ornare quis nunc. Aenean ut tincidunt lorem. Maecenas consectetur faucibus velit, nec tincidunt nulla fermentum sed.</p>', 1),
(25, 'H', '<p>The quick brown fox jumps over the lazy dog</p>', 1),
(27, 'I', '<p>How do I get started with my computer?</p>\r\n<div class=\"contentContainer\">\r\n<h1 class=\"title\">How do I get started with my computer?</h1>\r\n<p class=\"para\">Â </p>\r\n<p class=\"para\">Getting Started contains a list of tasks you might want to perform when you set up your computer. Tasks in Getting Started include:</p>\r\n<ul class=\"unordered\">\r\n<li class=\"listItem\">\r\n<p class=\"para\">Transferring files from another computer</p>\r\n</li>\r\n<li class=\"listItem\">\r\n<p class=\"para\">Adding new users to your computer</p>\r\n</li>\r\n<li class=\"listItem\">\r\n<p class=\"para\">Backing up your files</p>\r\n</li>\r\n<li class=\"listItem\">\r\n<p class=\"para\">Personalizing <span class=\"notLocalizable\">Windows</span></p>\r\n</li>\r\n</ul>\r\n</div>\r\n<p>Â </p>', 1),
(28, 'J', '', 1),
(29, 'H', '<p>abc</p>', 1),
(30, 'K', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ha_death`
--

CREATE TABLE `ha_death` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `patient_id` varchar(30) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ha_death`
--

INSERT INTO `ha_death` (`id`, `title`, `description`, `patient_id`, `doctor_id`, `date`, `status`) VALUES
(1, 'Accident', 'Insurance companies will try to pay you less than your claim is worth. Don\'t let them! Use our free case evaluation to get the true value of your injury case.\r\n\r\nAccidents that commonly result in compensation include:\r\n\r\nCar accident injuries\r\nPedestrian accidents\r\nHit and runs\r\nDrunk driving crashes\r\nDangerous road construction accidents\r\nMotorcycle accidents\r\nCommercial trucking accidents\r\nUninsured motorists\r\nYour case review will be performed by a local car accident attorney. They will provide you an accurate estimate of your claim value and can help you get money for lost wages, personal injuries, medical bills, and pain and suffering.\r\n\r\nThe case evaluation is of no obligation to you. However, even if you do choose to work with a car accident attorney, you pay $0 unless you win! There are no upfront fees.', 'PNYXYXZM', 0, '2017-01-09', 1),
(2, 'Test', 'HELLO', 'PNYXYXZM', 0, '2017-02-01', 1),
(3, 'TEST', '', '12213', 1, '2017-02-23', 1),
(4, 'death reprot', '', 'P72P7031', 0, '2018-03-07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ha_investigation`
--

CREATE TABLE `ha_investigation` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `patient_id` varchar(30) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ha_investigation`
--

INSERT INTO `ha_investigation` (`id`, `title`, `description`, `patient_id`, `doctor_id`, `picture`, `date`, `status`) VALUES
(2, 'TEST', 'TEST', '32424', 12, '', '2017-02-05', 1),
(5, 'TEST', '', '32424', 0, 'assets/images/investigation/2017-02-05/C.jpg', '2017-02-05', 1),
(6, 'How do I get started with my computer?', 'Getting Started contains a list of tasks you might want to perform when you set up your computer. Tasks in Getting Started include:\r\n\r\nTransferring files from another computer\r\n\r\nAdding new users to your computer\r\n\r\nBacking up your files\r\n\r\nPersonalizing Windows\r\n\r\nClick to open Getting Started.\r\n\r\nThese topics will help you get started with Windows 7. You can also go to the Windows website to learn more about setting up a computer.\r\n\r\nShow contentHide content Protect your computer\r\nWhat is Action Center? \r\n\r\nInstall Windows updates \r\n\r\nWhy use a standard account instead of an administrator account? \r\n\r\nWindows Firewall: recommended links \r\n\r\nBack up your files \r\n\r\nShow contentHide content First week tasks\r\nConnect to the Internet \r\n\r\nTransfer files and settings from another computer \r\n\r\nCreate a user account \r\n\r\nWhat you need to set up a home network \r\n\r\nHow can I tell if Windows is activated? \r\n\r\nWindows Basics: all topics \r\n\r\nShow contentHide content Set up hardware and get drivers\r\nWhat is a driver? \r\n\r\nInstall a printer \r\n\r\nFind and install printer drivers \r\n\r\nInstalling new hardware: recommended links \r\n\r\nShow contentHide content Install programs\r\nInstall a program \r\n\r\nChange which programs Windows uses by default \r\n\r\nMake older programs run in this version of Windows \r\n', '32424', 1, 'assets/images/investigation/2017-02-05/H.jpg', '2017-02-05', 1),
(7, 'gfhhgv', '', 'yyvgfgvf', 0, '', '2017-02-27', 1),
(8, 'investigation report', '', 'P72P7031', 0, '', '2018-03-08', 1),
(9, 'investigation details', '', 'P72P7031', 0, '', '2018-03-07', 1),
(10, 'Report', '', 'P3Y2QHWN', 16, 'assets/images/investigation/2018-03-09/1.jpg', '2018-03-09', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ha_medicine`
--

CREATE TABLE `ha_medicine` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL,
  `manufactured_by` varchar(255) NOT NULL,
  `create_date` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ha_medicine`
--

INSERT INTO `ha_medicine` (`id`, `name`, `category_id`, `description`, `price`, `manufactured_by`, `create_date`, `status`) VALUES
(5, 'General Surgery', 22, '<p><img src=\"../../../assets/tinymce/plugins/emoticons/img/smiley-cry.gif\" alt=\"cry\" /><img src=\"../../../assets/tinymce/plugins/emoticons/img/smiley-cool.gif\" alt=\"cool\" /><img src=\"../../../assets/tinymce/plugins/emoticons/img/smiley-sealed.gif\" alt=\"sealed\" /><img src=\"../../../assets/tinymce/plugins/emoticons/img/smiley-wink.gif\" alt=\"wink\" /><img src=\"../../../assets/tinymce/plugins/emoticons/img/smiley-surprised.gif\" alt=\"surprised\" /></p>', 160, 'Square', '2017-02-28', 1),
(6, 'General Surgery', 19, '<p>HELLO WORLD!</p>', 160, 'Square', '2017-02-06', 1),
(7, 'General Surgery', 21, '<p><img src=\"../../../assets/tinymce/plugins/emoticons/img/smiley-cry.gif\" alt=\"cry\" /><img src=\"../../../assets/tinymce/plugins/emoticons/img/smiley-cool.gif\" alt=\"cool\" /><img src=\"../../../assets/tinymce/plugins/emoticons/img/smiley-sealed.gif\" alt=\"sealed\" /><img src=\"../../../assets/tinymce/plugins/emoticons/img/smiley-wink.gif\" alt=\"wink\" /><img src=\"../../../assets/tinymce/plugins/emoticons/img/smiley-surprised.gif\" alt=\"surprised\" /></p>', 160, 'Square', '2017-02-06', 1),
(8, 'General Surgery', 18, '<p><img src=\"../../../assets/tinymce/plugins/emoticons/img/smiley-cry.gif\" alt=\"cry\" /><img src=\"../../../assets/tinymce/plugins/emoticons/img/smiley-cool.gif\" alt=\"cool\" /><img src=\"../../../assets/tinymce/plugins/emoticons/img/smiley-sealed.gif\" alt=\"sealed\" /><img src=\"../../../assets/tinymce/plugins/emoticons/img/smiley-wink.gif\" alt=\"wink\" /><img src=\"../../../assets/tinymce/plugins/emoticons/img/smiley-surprised.gif\" alt=\"surprised\" /></p>', 160, 'Square', '2017-02-06', 1),
(9, 'General Surgery', 17, '<p><img src=\"../../../assets/tinymce/plugins/emoticons/img/smiley-cry.gif\" alt=\"cry\" /><img src=\"../../../assets/tinymce/plugins/emoticons/img/smiley-cool.gif\" alt=\"cool\" /><img src=\"../../../assets/tinymce/plugins/emoticons/img/smiley-sealed.gif\" alt=\"sealed\" /><img src=\"../../../assets/tinymce/plugins/emoticons/img/smiley-wink.gif\" alt=\"wink\" /><img src=\"../../../assets/tinymce/plugins/emoticons/img/smiley-surprised.gif\" alt=\"surprised\" /></p>', 160, 'Square', '2017-02-06', 1),
(10, 'General Surgery', 23, '<p><img src=\"../../../assets/tinymce/plugins/emoticons/img/smiley-cry.gif\" alt=\"cry\" /><img src=\"../../../assets/tinymce/plugins/emoticons/img/smiley-cool.gif\" alt=\"cool\" /><img src=\"../../../assets/tinymce/plugins/emoticons/img/smiley-sealed.gif\" alt=\"sealed\" /><img src=\"../../../assets/tinymce/plugins/emoticons/img/smiley-wink.gif\" alt=\"wink\" /><img src=\"../../../assets/tinymce/plugins/emoticons/img/smiley-surprised.gif\" alt=\"surprised\" /></p>', 160, 'Square', '2017-02-06', 1),
(12, 'General Surgery', 21, '<p><img src=\"../../../assets/tinymce/plugins/emoticons/img/smiley-cry.gif\" alt=\"cry\" /><img src=\"../../../assets/tinymce/plugins/emoticons/img/smiley-cool.gif\" alt=\"cool\" /><img src=\"../../../assets/tinymce/plugins/emoticons/img/smiley-sealed.gif\" alt=\"sealed\" /><img src=\"../../../assets/tinymce/plugins/emoticons/img/smiley-wink.gif\" alt=\"wink\" /><img src=\"../../../assets/tinymce/plugins/emoticons/img/smiley-surprised.gif\" alt=\"surprised\" /></p>', 160, 'Square', '2017-02-06', 1),
(13, 'General Surgery', 22, '<p><img src=\"../../../assets/tinymce/plugins/emoticons/img/smiley-cry.gif\" alt=\"cry\" /><img src=\"../../../assets/tinymce/plugins/emoticons/img/smiley-cool.gif\" alt=\"cool\" /><img src=\"../../../assets/tinymce/plugins/emoticons/img/smiley-sealed.gif\" alt=\"sealed\" /><img src=\"../../../assets/tinymce/plugins/emoticons/img/smiley-wink.gif\" alt=\"wink\" /><img src=\"../../../assets/tinymce/plugins/emoticons/img/smiley-surprised.gif\" alt=\"surprised\" /></p>', 160, 'Square', '2017-02-06', 1),
(14, 'General Surgery', 27, '<h2>Cos&rsquo;&egrave; Lorem Ipsum?</h2>\r\n<p><strong>Lorem Ipsum</strong> &egrave; un testo segnaposto utilizzato nel settore della tipografia e della stampa. Lorem Ipsum &egrave; considerato il testo segnaposto standard sin dal sedicesimo secolo, quando un anonimo tipografo prese una cassetta di caratteri e li assembl&ograve; per preparare un testo campione. &Egrave; sopravvissuto non solo a pi&ugrave; di cinque secoli, ma anche al passaggio alla videoimpaginazione, pervenendoci sostanzialmente inalterato. Fu reso popolare, negli anni &rsquo;60, con la diffusione dei fogli di caratteri trasferibili &ldquo;Letraset&rdquo;, che contenevano passaggi del Lorem Ipsum, e pi&ugrave; recentemente da software di impaginazione come Aldus PageMaker, che includeva versioni del Lorem Ipsum.</p>', 160, 'Square', '2017-02-07', 1),
(15, 'New', 29, '<p>TEST</p>', 199, 'Acme', '2017-02-28', 1),
(16, 'Test', 30, '<p>TEST Medicine</p>', 200, 'Acme', '2017-02-28', 1),
(17, 'PAN D', 25, '', 40, '', '2018-03-08', 1),
(18, 'paracetamol', 30, '', 100, 'paramount', '2018-03-08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ha_operation`
--

CREATE TABLE `ha_operation` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `patient_id` varchar(30) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ha_operation`
--

INSERT INTO `ha_operation` (`id`, `title`, `description`, `patient_id`, `doctor_id`, `date`, `status`) VALUES
(1, 'RWA', 'Insurance companies will try to pay you less than your claim is worth. Don\'t let them! Use our free case evaluation to get the true value of your injury case.\r\n\r\nAccidents that commonly result in compensation include:\r\n\r\nCar accident injuries\r\nPedestrian accidents\r\nHit and runs\r\nDrunk driving crashes\r\nDangerous road construction accidents\r\nMotorcycle accidents\r\nCommercial trucking accidents\r\nUninsured motorists\r\nYour case review will be performed by a local car accident attorney. They will provide you an accurate estimate of your claim value and can help you get money for lost wages, personal injuries, medical bills, and pain and suffering.\r\n\r\nThe case evaluation is of no obligation to you. However, even if you do choose to work with a car accident attorney, you pay $0 unless you win! There are no upfront fees. innovative', 'PNYXYXZM', 13, '2017-01-09', 1),
(2, 'asdf', '', '12213', 1, '2017-02-23', 1),
(3, 'op report', 'cancer surgery', 'P72P7031', 17, '2018-03-08', 1),
(4, 'birth report', '', 'P72P7031', 1, '2018-03-08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE `language` (
  `id` int(11) UNSIGNED NOT NULL,
  `phrase` text NOT NULL,
  `english` text,
  `hindi` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `phrase`, `english`, `hindi`) VALUES
(19, 'email', 'Email Address', ''),
(20, 'password', 'Password', ''),
(21, 'login', 'Log In', ''),
(22, 'incorrect_email_password', 'Incorrect Email/Password!', ''),
(23, 'user_role', 'User Role', ''),
(24, 'please_login', 'Please Log In', ''),
(25, 'setting', 'Setting', ''),
(26, 'profile', 'Profile', ''),
(27, 'logout', 'Log Out', ''),
(28, 'please_try_again', 'Please Try Again', ''),
(29, 'admin', 'Admin', ''),
(30, 'doctor', 'Doctor', ''),
(31, 'representative', 'Representative', ''),
(32, 'dashboard', 'Dashboard', ''),
(33, 'department', 'Department', ''),
(34, 'add_department', 'Add Department', ''),
(35, 'department_list', 'Department List', ''),
(36, 'add_doctor', 'Add Doctor', ''),
(37, 'doctor_list', 'Doctor List', ''),
(38, 'add_representative', 'Add Representative', ''),
(39, 'representative_list', 'Representative List', ''),
(40, 'patient', 'Patient', ''),
(41, 'add_patient', 'Add Patient', ''),
(42, 'patient_list', 'Patient List', ''),
(43, 'schedule', 'Schedule', ''),
(44, 'add_schedule', 'Add Schedule', ''),
(45, 'schedule_list', 'Schedule List', ''),
(46, 'appointment', 'Appointment', ''),
(47, 'add_appointment', 'Add Appointment', ''),
(48, 'appointment_list', 'Appointment List', ''),
(49, 'enquiry', 'Enquiry', ''),
(50, 'language_setting', 'Language Setting', ''),
(51, 'appointment_report', 'Appointment Report', ''),
(52, 'assign_by_all', 'Assign by All', ''),
(53, 'assign_by_doctor', 'Assign by Doctor', ''),
(54, 'assign_to_doctor', 'Assign to Doctor', ''),
(55, 'assign_by_representative', 'Assign by Representative', ''),
(56, 'report', 'Report', ''),
(57, 'assign_by_me', 'Assign by Me', ''),
(58, 'assign_to_me', 'Assign to Me', ''),
(59, 'website', 'Website', ''),
(60, 'slider', 'Slider', ''),
(61, 'section', 'Section', ''),
(62, 'section_item', 'Section Item', ''),
(63, 'comments', 'Comment', ''),
(64, 'latest_enquiry', 'Latest Enquiry', ''),
(65, 'total_progress', 'Total Progress', ''),
(66, 'last_year_status', 'Showing status from the last year', ''),
(67, 'department_name', 'Department Name', ''),
(68, 'description', 'Description', ''),
(69, 'status', 'Status', ''),
(70, 'active', 'Active', ''),
(71, 'inactive', 'Inactive', ''),
(72, 'cancel', 'Cancel', ''),
(73, 'save', 'Save', ''),
(75, 'serial', 'SL.NO', ''),
(76, 'action', 'Action', ''),
(77, 'edit', 'Edit ', ''),
(78, 'delete', 'Delete', ''),
(79, 'save_successfully', 'Save Successfully!', ''),
(80, 'update_successfully', 'Update Successfully!', ''),
(81, 'department_edit', 'Department Edit', ''),
(82, 'delete_successfully', 'Delete successfully!', ''),
(83, 'are_you_sure', 'Are You Sure ? ', ''),
(84, 'first_name', 'First Name', ''),
(85, 'last_name', 'Last Name', ''),
(86, 'phone', 'Phone No', ''),
(87, 'mobile', 'Mobile No', ''),
(88, 'blood_group', 'Blood Group', ''),
(89, 'sex', 'Sex', ''),
(90, 'date_of_birth', 'Date of Birth', ''),
(91, 'address', 'Address', ''),
(92, 'invalid_picture', 'Invalid Picture', ''),
(93, 'doctor_profile', 'Doctor Profile', ''),
(94, 'edit_profile', 'Edit Profile', ''),
(95, 'edit_doctor', 'Edit Doctor', ''),
(98, 'designation', 'Designation', ''),
(99, 'short_biography', 'Short Biography', ''),
(100, 'picture', 'Picture', ''),
(101, 'specialist', 'Specialist', ''),
(102, 'male', 'Male', ''),
(103, 'female', 'Female', ''),
(104, 'education_degree', 'Education/Degree', ''),
(105, 'create_date', 'Create Date', ''),
(106, 'view', 'View', ''),
(107, 'doctor_information', 'Doctor Information', ''),
(108, 'update_date', 'Update Date', ''),
(109, 'print', 'Print', ''),
(110, 'representative_edit', 'Representative Edit', ''),
(112, 'patient_information', 'Patient Information', ''),
(113, 'other', 'Other', ''),
(114, 'patient_id', 'Patient ID', ''),
(115, 'age', 'Age', ''),
(116, 'patient_edit', 'Patient Edit', ''),
(117, 'id_no', 'ID No.', ''),
(118, 'select_option', 'Select Option', ''),
(119, 'doctor_name', 'Doctor Name', ''),
(120, 'day', 'Day', ''),
(121, 'start_time', 'Start Time', ''),
(122, 'end_time', 'End Time', ''),
(123, 'per_patient_time', 'Per Patient Time', ''),
(124, 'serial_visibility_type', 'Serial Visibility', ''),
(125, 'sequential', 'Sequential', ''),
(126, 'timestamp', 'Timestamp', ''),
(127, 'available_days', 'Available Days', ''),
(128, 'schedule_edit', 'Schedule Edit', ''),
(129, 'available_time', 'Available Time', ''),
(130, 'serial_no', 'Serial No', ''),
(131, 'problem', 'Problem', ''),
(132, 'appointment_date', 'Appointment Date', ''),
(133, 'you_are_already_registered', 'You Are Already Registered', ''),
(134, 'invalid_patient_id', 'Invalid patient ID', ''),
(135, 'invalid_input', 'Invalid Input', ''),
(137, 'no_doctor_available', 'No Doctor Available', ''),
(138, 'invalid_department', 'Invalid Department!', ''),
(139, 'no_schedule_available', 'No Schedule Available', ''),
(140, 'please_fillup_all_required_fields', 'Please fillup all required filelds', ''),
(141, 'appointment_id', 'Appointment ID', ''),
(142, 'schedule_time', 'Schedule Time', ''),
(143, 'appointment_information', 'Appointment Information', ''),
(144, 'full_name', 'Full Name', ''),
(145, 'read_unread', 'Read / Unread', ''),
(146, 'date', 'Date', ''),
(147, 'ip_address', 'IP Address', ''),
(148, 'user_agent', 'User Agent', ''),
(149, 'checked_by', 'Checked By', ''),
(150, 'enquiry_date', 'Enquirey Date', ''),
(152, 'enquiry_list', 'Enquiry List', ''),
(153, 'filter', 'Filter', ''),
(154, 'start_date', 'Start Date', ''),
(155, 'end_date', 'End Date', ''),
(156, 'application_title', 'Application Title', ''),
(157, 'favicon', 'Favicon', ''),
(158, 'logo', 'Logo', ''),
(159, 'footer_text', 'Footer Text', ''),
(160, 'language', 'Language', ''),
(161, 'appointment_assign_by_all', 'Appointment Assign by All', ''),
(162, 'appointment_assign_by_doctor', 'Appointment Assign by Doctor', ''),
(163, 'appointment_assign_by_representative', 'Appointment Assign by Representative', ''),
(164, 'appointment_assign_to_all_doctor', 'Appointment Assign to All Doctor', ''),
(165, 'appointment_assign_to_me', 'Appointment Assign to Me', ''),
(166, 'appointment_assign_by_me', 'Appointment Assign by Me', ''),
(167, 'type', 'Type', ''),
(168, 'website_title', 'Website Title', ''),
(169, 'invalid_logo', 'Invalid Logo', ''),
(170, 'details', 'Details', ''),
(171, 'website_setting', 'Website Setting', ''),
(172, 'submit_successfully', 'Submit Successfully!', ''),
(173, 'application_setting', 'Application Setting', ''),
(174, 'invalid_favicon', 'Invalid Favicon', ''),
(175, 'new_enquiry', 'New Enquiry', ''),
(176, 'information', 'Information', ''),
(177, 'home', 'Home', ''),
(178, 'select_department', 'Select Department', ''),
(179, 'select_doctor', 'Select Doctor', ''),
(180, 'select_representative', 'Select Representative', ''),
(181, 'post_id', 'Post ID', ''),
(182, 'thank_you_for_your_comment', 'Thank you for your comment!', ''),
(183, 'comment_id', 'Comment ID', ''),
(184, 'comment_status', 'Comment Status', ''),
(185, 'comment_added_successfully', 'Comment Added Successfully', ''),
(186, 'comment_remove_successfully', 'Comment Remove Successfully', ''),
(187, 'select_item', 'Section Item', ''),
(188, 'add_item', 'Add Item', ''),
(189, 'menu_name', 'Menu Name', ''),
(190, 'title', 'Title', ''),
(191, 'position', 'Position', ''),
(192, 'invalid_icon_image', 'Invalid Icon Image!', ''),
(193, 'about', 'About', ''),
(194, 'blog', 'Blog', ''),
(195, 'service', 'Service', ''),
(196, 'item_edit', 'Item Edit', ''),
(197, 'registration_successfully', 'Registration Successfully', ''),
(198, 'add_section', 'Add Section', ''),
(199, 'section_name', 'Section Name', ''),
(200, 'invalid_featured_image', 'Invalid Featured Image!', ''),
(201, 'section_edit', 'Section Edit', ''),
(202, 'meta_description', 'Meta Description', ''),
(203, 'twitter_api', 'Twitter Api', ''),
(204, 'google_map', 'Google Map', ''),
(205, 'copyright_text', 'Copyright Text', ''),
(206, 'facebook_url', 'Facebook URL', ''),
(207, 'twitter_url', 'Twitter URL', ''),
(208, 'vimeo_url', 'Vimeo URL', ''),
(209, 'instagram_url', 'Instagram Url', ''),
(210, 'dribbble_url', 'Dribbble URL', ''),
(211, 'skype_url', 'Skype URL', ''),
(212, 'add_slider', 'Add Slider', ''),
(213, 'subtitle', 'Sub Title', ''),
(214, 'slide_position', 'Slide Position', ''),
(215, 'invalid_image', 'Invalid Image', ''),
(216, 'image_is_required', 'Image is required', ''),
(217, 'slider_edit', 'Slider Edit', ''),
(218, 'meta_keyword', 'Meta Keyword', ''),
(219, 'year', 'Year', ''),
(220, 'month', 'Month', ''),
(221, 'recent_post', 'Recent Post', ''),
(222, 'leave_a_comment', 'Leave a Comment', ''),
(223, 'submit', 'Submit', ''),
(224, 'google_plus_url', 'Google Plus URL', ''),
(225, 'website_status', 'Website Status', ''),
(226, 'new_slide', 'New Slide', ''),
(227, 'new_section', 'New Section', ''),
(228, 'subtitle_description', 'Sub Title / Description', ''),
(229, 'featured_image', 'Featured Image', ''),
(230, 'new_item', 'New Item', ''),
(231, 'item_position', 'Item Position', ''),
(232, 'icon_image', 'Icon Image', ''),
(233, 'post_title', 'Post Title', ''),
(234, 'add_to_website', 'Add to Website', ''),
(235, 'read_more', 'Read More', ''),
(236, 'registration', 'Registration', ''),
(237, 'appointment_form', 'Appointment Form', ''),
(238, 'contact', 'Contact', ''),
(239, 'optional', 'Optional', ''),
(240, 'customer_comments', 'Customer Comments', ''),
(241, 'need_a_doctor_for_checkup', 'Need a Doctor for Check-up?', ''),
(242, 'just_make_an_appointment_and_you_are_done', 'JUST MAKE AN APPOINTMENT & YOU\'RE DONE ! ', ''),
(243, 'get_an_appointment', 'Get an appointment', ''),
(244, 'latest_news', 'Latest News', ''),
(245, 'latest_tweet', 'Latest Tweet', ''),
(246, 'menu', 'Menu', ''),
(247, 'select_user_role', 'Select User Role', ''),
(248, 'site_align', 'Website Align', ''),
(249, 'right_to_left', 'Right to Left', ''),
(250, 'left_to_right', 'Left to Right', ''),
(251, 'account_manager', 'Account Manager', ''),
(252, 'add_invoice', 'Add Invoice', ''),
(253, 'invoice_list', 'Invoice List', ''),
(254, 'account_list', 'Account List', ''),
(255, 'add_account', 'Add Account', ''),
(256, 'account_name', 'Account Name', ''),
(257, 'credit', 'Credit', ''),
(258, 'debit', 'Debit', ''),
(259, 'account_edit', 'Account Edit', ''),
(260, 'quantity', 'Quantity', ''),
(261, 'price', 'Price', ''),
(262, 'total', 'Total', ''),
(263, 'remove', 'Remove', ''),
(264, 'add', 'Add', ''),
(265, 'subtotal', 'Sub Total', ''),
(266, 'vat', 'Vat', ''),
(267, 'grand_total', 'Grand Total', ''),
(268, 'discount', 'Discount', ''),
(269, 'paid', 'Paid', ''),
(270, 'due', 'Due', ''),
(271, 'reset', 'Reset', ''),
(272, 'add_or_remove', 'Add / Remove', ''),
(273, 'invoice', 'Invoice', ''),
(274, 'invoice_information', 'Invoice Information', ''),
(275, 'invoice_edit', 'Invoice Edit', ''),
(276, 'update', 'Update', ''),
(277, 'all', 'All', ''),
(278, 'patient_wise', 'Patient Wise', ''),
(279, 'account_wise', 'Account Wise', ''),
(280, 'debit_report', 'Debit Report', ''),
(281, 'credit_report', 'Credit Report', ''),
(282, 'payment_list', 'Payment List', ''),
(283, 'add_payment', 'Add Payment', ''),
(284, 'payment_edit', 'Payment Edit', ''),
(285, 'pay_to', 'Pay To', ''),
(286, 'amount', 'Amount', ''),
(287, 'bed_type', 'Bed Type', ''),
(288, 'bed_limit', 'Bed Capacity', ''),
(289, 'charge', 'Charge', ''),
(290, 'bed_list', 'Bed List', ''),
(291, 'add_bed', 'Add Bed', ''),
(292, 'bed_manager', 'Bed Manager', ''),
(293, 'bed_edit', 'Bed Edit', ''),
(294, 'bed_assign', 'Bed Assign', ''),
(295, 'assign_date', 'Assign Date', ''),
(296, 'discharge_date', 'Discharge Date', ''),
(297, 'bed_assign_list', 'Bed Assign List', ''),
(298, 'assign_by', 'Assign By', ''),
(299, 'bed_available', 'Bed is Available', ''),
(300, 'bed_not_available', 'Bed is Not Available', ''),
(301, 'invlid_input', 'Invalid Input', ''),
(302, 'allocated', 'Allocated', ''),
(303, 'free_now', 'Free', ''),
(304, 'select_only_avaiable_days', 'Select Only Avaiable Days', ''),
(305, 'human_resources', 'Human Resources', ''),
(306, 'nurse_list', 'Nurse List', ''),
(307, 'add_employee', 'Add Employee', ''),
(308, 'user_type', 'User Type', ''),
(309, 'employee_information', 'Employee Information', ''),
(310, 'employee_edit', 'Edit Employee', ''),
(311, 'laboratorist_list', 'Laboratorist List', ''),
(312, 'accountant_list', 'Accountant List', ''),
(313, 'receptionist_list', 'Receptionist List', ''),
(314, 'pharmacist_list', 'Pharmacist List', ''),
(315, 'nurse', 'Nurse', ''),
(316, 'laboratorist', 'Laboratorist', ''),
(317, 'pharmacist', 'Pharmacist', ''),
(318, 'accountant', 'Accountant', ''),
(319, 'receptionist', 'Receptionist', ''),
(320, 'noticeboard', 'Noticeboard', ''),
(321, 'notice_list', 'Notice List', ''),
(322, 'add_notice', 'Add Notice', ''),
(323, 'hospital_activities', 'Hospital Activities', ''),
(324, 'death_report', 'Death Report', ''),
(325, 'add_death_report', 'Add Death Report', ''),
(326, 'death_report_edit', 'Death Report Edit', ''),
(327, 'birth_report', 'Birth Report', ''),
(328, 'birth_report_edit', 'Birth Report Edit', ''),
(329, 'add_birth_report', 'Add Birth Report', ''),
(330, 'add_operation_report', 'Add Operation Report', ''),
(331, 'operation_report', 'Operation Report', ''),
(332, 'investigation_report', 'Investigation Report', ''),
(333, 'add_investigation_report', 'Add Investigation Report', ''),
(334, 'add_medicine_category', 'Add Medicine Category', ''),
(335, 'medicine_category_list', 'Medicine Category List', ''),
(336, 'category_name', 'Category Name', ''),
(337, 'medicine_category_edit', 'Medicine Category Edit', ''),
(338, 'add_medicine', 'Add Medicine ', ''),
(339, 'medicine_list', 'Medicine List', ''),
(340, 'medicine_edit', 'Medicine Edit', ''),
(341, 'manufactured_by', 'Manufactured By', ''),
(342, 'medicine_name', 'Medicine Name', ''),
(343, 'messages', 'Messages', ''),
(344, 'inbox', 'Inbox', ''),
(345, 'sent', 'Sent', ''),
(346, 'new_message', 'New Message', ''),
(347, 'sender', 'Sender Name', ''),
(349, 'message', 'Message', ''),
(350, 'subject', 'Subject', ''),
(351, 'receiver_name', 'Send To', ''),
(352, 'select_user', 'Select User', ''),
(353, 'message_sent', 'Messages Sent', ''),
(354, 'mail', 'Mail', ''),
(355, 'send_mail', 'Send Mail', ''),
(356, 'mail_setting', 'Mail Setting', ''),
(357, 'protocol', 'Protocol', ''),
(358, 'mailpath', 'Mail Path', ''),
(359, 'mailtype', 'Mail Type', ''),
(360, 'validate_email', 'Validate Email Address', ''),
(361, 'true', 'True', ''),
(362, 'false', 'False', ''),
(363, 'attach_file', 'Attach File', ''),
(364, 'wordwrap', 'Enable Word Wrap', ''),
(365, 'send', 'Send', ''),
(366, 'upload_successfully', 'Upload Successfully!', ''),
(367, 'app_setting', 'App Setting', ''),
(368, 'case_manager', 'Case Manager', ''),
(369, 'patient_status', 'Patient Status', ''),
(370, 'patient_status_edit', 'Edit Patient Status', ''),
(371, 'add_patient_status', 'Add Patient Status', ''),
(372, 'add_new_status', 'Add New Status', ''),
(373, 'case_manager_list', 'Case Manager List', ''),
(374, 'hospital_address', 'Hospital Address', ''),
(375, 'ref_doctor_name', 'Ref. Doctor Name', ''),
(376, 'hospital_name', 'Hospital Name', ''),
(377, 'patient_name', 'Patient  Name', ''),
(378, 'document_list', 'Document List', ''),
(379, 'add_document', 'Add Document', ''),
(380, 'upload_by', 'Upload By', ''),
(381, 'documents', 'Documents', ''),
(382, 'prescription', 'Prescription', ''),
(383, 'add_prescription', 'Add Prescription', ''),
(384, 'prescription_list', 'Prescription List', ''),
(385, 'add_insurance', 'Add Insurance', ''),
(386, 'insurance_list', 'Insurance List', ''),
(387, 'insurance_name', 'Insurance Name', ''),
(388, 'medicine_name', 'Medicine Name', ''),
(389, 'add_medicine', 'Add Medicine', ''),
(390, 'medicine_list', 'Medicine List', ''),
(391, 'add_patient_case_study', 'Add Patient Case Study', ''),
(392, 'patient_case_study_list', 'Patient Case Study List', ''),
(393, 'food_allergies', 'Food Allergies', ''),
(394, 'tendency_bleed', 'Tendency Bleed', ''),
(395, 'heart_disease', 'Heart Disease', ''),
(396, 'high_blood_pressure', 'High Blood Pressure', ''),
(397, 'diabetic', 'Diabetic', ''),
(398, 'surgery', 'Surgery', ''),
(399, 'accident', 'Accident', ''),
(400, 'others', 'Others', ''),
(401, 'family_medical_history', 'Family Medical History', ''),
(402, 'current_medication', 'Current Medication', ''),
(403, 'female_pregnancy', 'Female Pregnancy', ''),
(404, 'breast_feeding', 'Breast Feeding', ''),
(405, 'health_insurance', 'Health Insurance', ''),
(406, 'low_income', 'Low Income', ''),
(407, 'reference', 'Reference', ''),
(408, 'status', 'Status', ''),
(409, 'medicine_name', 'Medicine Name', ''),
(410, 'instruction', 'Instruction', ''),
(411, 'medicine_type', 'Medicine Type', ''),
(412, 'days', 'Days', ''),
(413, 'weight', 'Weight', ''),
(414, 'blood_pressure', 'Blood Pressure', ''),
(415, 'old', 'Old', ''),
(416, 'new', 'New', ''),
(417, 'case_study', 'Case Study', ''),
(418, 'chief_complain', 'Chief Complain', ''),
(419, 'patient_notes', 'Patient Notes', ''),
(420, 'visiting_fees', 'Visiting Fees', ''),
(421, 'diagnosis', 'Diagnosis', ''),
(422, 'prescription_id', 'Prescription ID', ''),
(423, 'name', 'Name', ''),
(424, 'prescription_information', 'Prescription Information', '');

-- --------------------------------------------------------

--
-- Table structure for table `mail_setting`
--

CREATE TABLE `mail_setting` (
  `id` int(11) NOT NULL,
  `protocol` varchar(20) NOT NULL,
  `mailpath` varchar(255) NOT NULL,
  `mailtype` varchar(20) NOT NULL,
  `validate_email` varchar(20) NOT NULL,
  `wordwrap` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `mail_setting`
--

INSERT INTO `mail_setting` (`id`, `protocol`, `mailpath`, `mailtype`, `validate_email`, `wordwrap`) VALUES
(5, 'sendmail', '/usr/sbin/sendmail', 'html', 'false', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `datetime` datetime NOT NULL,
  `sender_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=unseen, 1=seen, 2=delete',
  `receiver_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=unseen, 1=seen, 2=delete'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `sender_id`, `receiver_id`, `subject`, `message`, `datetime`, `sender_status`, `receiver_status`) VALUES
(1, 2, 1, 'TEST', '<p>Â TEST</p>', '2017-02-07 00:00:00', 2, 2),
(3, 26, 3, 'TEST', '<p>receiver_id<strong></strong></p>', '2017-02-07 00:00:00', 0, 0),
(10, 2, 17, 'TEST', '<p>bbjkjhjh</p>', '2017-02-07 11:34:41', 0, 0),
(11, 2, 14, 'Google Search Google or type URL Say \"Ok Google\" Voice search has been turned off. Details ', '<div id=\"lga\" class=\"\"><img id=\"hplogo\" title=\"Google\" src=\"https://www.google.com/images/branding/googlelogo/2x/googlelogo_color_272x92dp.png\" alt=\"Google\" width=\"272\" height=\"92\">\r\n<div id=\"logo-sub\">Â </div>\r\n</div>\r\n&lt;form id=\"f\" action=\"https://www.google.com/search\" method=\"get\"&gt;\r\n<div id=\"hf\">Â </div>\r\n<div id=\"fkbx\" class=\"\">\r\n<div id=\"fkbx-text\">Search Google or type URL</div>\r\n&lt;input id=\"q\" tabindex=\"-1\" autocomplete=\"off\" name=\"q\" type=\"url\" /&gt;\r\n<div id=\"fkbx-spch\" tabindex=\"0\">Â </div>\r\n</div>\r\n&lt;/form&gt;\r\n<div id=\"spch\" class=\"spch s2fp\">Â </div>\r\n<div id=\"most-visited\" class=\"mv-hide\">Â </div>', '2017-02-07 12:31:34', 0, 0),
(12, 17, 2, 'TEST', '<p>bbjkjhjh</p>', '2017-02-07 11:34:41', 0, 1),
(13, 26, 2, 'TEST', '<p>receiver_id<strong></strong></p>', '2017-02-07 00:00:00', 0, 1),
(14, 1, 2, 'HELLO ', 'What is Lorem Ipsum?\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2017-02-08 06:12:13', 0, 1),
(15, 1, 2, 'What is Lorem Ipsum?', '<div>\r\n<h2>What is Lorem Ipsum?</h2>\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n</div>\r\n<div>\r\n<h2>Why do we use it?</h2>\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n</div>\r\n<p>Â </p>\r\n<div>\r\n<h2>Where does it come from?</h2>\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p>\r\n<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>\r\n</div>', '2017-02-08 07:34:28', 1, 1),
(16, 2, 1, 'Lorem Ipsum', '<h1>Lorem Ipsum</h1>\r\n<h4>\"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...\"</h4>\r\n<h5>\"There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain...\"</h5>\r\n<hr>\r\n<div id=\"Content\">\r\n<div id=\"Panes\">\r\n<div>\r\n<h2>What is Lorem Ipsum?</h2>\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n</div>\r\n<div>\r\n<h2>Why do we use it?</h2>\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n</div>\r\n<br>\r\n<div>\r\n<h2>Where does it come from?</h2>\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of \"de Finibus Bonorum et Malorum\" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, \"Lorem ipsum dolor sit amet..\", comes from a line in section 1.10.32.</p>\r\n<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from \"de Finibus Bonorum et Malorum\" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>\r\n</div>\r\n<div>\r\n<h2>Where can I get some?</h2>\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don\'t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn\'t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>\r\n</div>\r\n</div>\r\n</div>', '2017-02-08 07:36:12', 1, 1),
(17, 2, 22, 'What is Lorem Ipsum?', '<p>The quick brown fox jumps over the lazy dog!</p>', '2017-02-08 11:51:55', 1, 0),
(18, 2, 15, 'What is Lorem Ipsum?', '<p>The quick brown fox jumps over the lazy dog!</p>', '2017-02-08 01:23:01', 1, 1),
(19, 2, 1, 'HELLO', '<p>TEST</p>', '2017-02-09 07:41:33', 1, 1),
(20, 2, 28, 'Subject', '<p>asdasd</p>', '2017-02-11 01:32:23', 1, 0),
(21, 2, 19, 'Subject', '<p>Message</p>', '2017-02-13 05:58:31', 1, 0),
(22, 1, 2, 'Subject', '<p>Message</p>', '2017-02-13 05:59:13', 1, 1),
(23, 2, 1, 'TEST SUBJECT', '<p>HELLO WORLD</p>\r\n<p>Â </p>', '2017-02-19 11:38:42', 1, 2),
(24, 1, 19, 'hello', '<p>TEST</p>', '2017-02-22 01:31:33', 1, 1),
(25, 27, 19, 'hello', '<p>TEST</p>', '2017-02-23 11:23:13', 1, 0),
(26, 27, 24, 'hello', '<p>TEST</p>', '2017-02-23 11:23:31', 1, 1),
(27, 27, 28, 'hello', '<p>TSET</p>', '2017-02-23 11:23:40', 1, 0),
(28, 1, 27, 'hello', '<p>HELLO World</p>\r\n<p>Hello World!</p>\r\n<p>hElLo WoRld</p>\r\n<p>HeLlO wOrLd</p>', '2017-02-23 12:04:50', 1, 1),
(29, 27, 1, 'hello', '<p>THIS IS TEST MESSAGE</p>', '2017-02-23 12:05:26', 1, 1),
(30, 19, 2, 'HELLO', '<p>HELLO WORLD!</p>', '2017-02-25 09:45:52', 1, 1),
(31, 29, 2, 'HELLO', '<p>TEST</p>', '2017-02-25 11:04:54', 1, 1),
(32, 7, 2, 'TEST', '<p>TEST</p>', '2017-02-26 08:32:47', 1, 1),
(33, 7, 29, 'TEST', '<p>TEST</p>', '2017-02-26 08:32:55', 1, 0),
(34, 7, 1, 'TEST', '<p>STET</p>', '2017-02-26 08:33:05', 1, 2),
(35, 28, 27, 'TEST', '<p>TEST</p>', '2017-02-26 11:56:26', 1, 0),
(36, 28, 2, 'TEST', '<p>TEST</p>', '2017-02-26 11:56:40', 1, 0),
(37, 24, 2, 'TEST', '<p>TEST MESSAGE</p>', '2017-02-28 05:57:19', 1, 1),
(38, 7, 19, 'HELLO WORLD', '<p>HELLO WORLD</p>', '2017-02-28 01:27:40', 1, 0),
(39, 7, 2, 'HELLO WORLD', '<p>HELLO WORLD<strong></strong></p>', '2017-02-28 01:27:49', 1, 1),
(40, 7, 27, 'HELLO WORLD', '<p>HELLO WORLD</p>', '2017-02-28 01:27:54', 1, 1),
(41, 7, 2, 'HELLO WORLD', '<p>HELLO WORLD</p>', '2017-02-28 01:28:00', 1, 2),
(42, 30, 8, 'TEST', '<p>TEST</p>', '2017-04-23 07:45:16', 1, 0),
(43, 30, 17, 'TEST', '<p>TEST2</p>', '2017-04-23 07:45:27', 1, 0),
(44, 30, 18, 'TEST3', '<p>TE#</p>', '2017-04-23 07:45:36', 1, 0),
(45, 30, 2, 'TEST', '<p>HELLO</p>', '2017-04-23 08:23:01', 1, 0),
(46, 2, 30, 'TEST', '<p>TEST</p>', '2017-04-23 10:52:10', 0, 1),
(47, 2, 30, 'TEST Again', '<p>TEST Again</p>', '2017-04-23 10:52:22', 0, 1),
(48, 30, 2, 'TEST3', '<p>TEST</p>', '2017-04-23 10:55:23', 0, 1),
(49, 2, 32, 'hii', '<p>ER</p>', '2018-03-08 08:52:39', 1, 0),
(50, 19, 32, 'hii', '<p>hii</p>', '2018-03-08 10:31:45', 1, 0),
(51, 24, 17, 'testing', '<p>testing</p>', '2018-03-08 10:35:35', 1, 0),
(52, 1, 8, 'offer latter', '<p>dgfdgfdg dfgdf</p>', '2018-05-17 12:12:38', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE `notice` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `assign_by` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`id`, `title`, `description`, `start_date`, `end_date`, `assign_by`, `status`) VALUES
(3, 'Font Awesome -The use of these trademarks does not indicate endorsement of the trademark holder by Font Awesome, nor vice versa.', '<section>\r\n<section class=\"hidden-print\">\r\n<div class=\"stripe-ad\">\r\n<section class=\"hidden-print\">\r\n<div class=\"stripe-ad\">\r\n<h1 class=\"lead\"><strong>Font Awesome</strong> is fully open source and is GPL friendly. You can use it for commercial projects, open source projects, or really just about whatever you want.</h1>\r\n</div>\r\n</section>\r\n<section>\r\n<div class=\"alert alert-success\">\r\n<ul class=\"fa-ul margin-bottom-none\">\r\n<li>Attribution is no longer required as of Font Awesome 3.0 but is much appreciated: \"Font Awesome by Dave Gandy - http://fontawesome.io\".</li>\r\n</ul>\r\n</div>\r\n</section>\r\n<section>\r\n<h2 class=\"page-header\">Font License</h2>\r\n<ul>\r\n<li>Applies to all desktop and webfont files in the following directory: <code>font-awesome/fonts/</code>.</li>\r\n<li>License: SIL OFL 1.1</li>\r\n<li>URL: <a href=\"http://scripts.sil.org/OFL\">http://scripts.sil.org/OFL</a></li>\r\n</ul>\r\n</section>\r\n<section>\r\n<h2 class=\"page-header\">Code License</h2>\r\n<ul>\r\n<li>Applies to all CSS and LESS files in the following directories: <code>font-awesome/css/</code>, <code>font-awesome/less/</code>, and <code>font-awesome/scss/</code>.</li>\r\n<li>License: MIT License</li>\r\n<li>URL: <a href=\"http://opensource.org/licenses/mit-license.html\">http://opensource.org/licenses/mit-license.html</a></li>\r\n</ul>\r\n</section>\r\n<section>\r\n<h2 class=\"page-header\">Documentation License</h2>\r\n<ul>\r\n<li>Applies to all Font Awesome project files that are not a part of the Font or Code licenses.</li>\r\n<li>License: CC BY 3.0</li>\r\n<li>URL: <a href=\"http://creativecommons.org/licenses/by/3.0/\">http://creativecommons.org/licenses/by/3.0/</a></li>\r\n</ul>\r\n</section>\r\n<section>\r\n<h2 class=\"page-header\">Brand Icons</h2>\r\n<ul class=\"margin-bottom-none padding-left-lg\">\r\n<li>All brand icons are trademarks of their respective owners.</li>\r\n<li>The use of these trademarks does not indicate endorsement of the trademark holder by Font Awesome, nor vice versa.</li>\r\n<li>Brand icons should only be used to represent the company or product to which they refer.</li>\r\n<li class=\"strong\">Please do not use brand logos for any purpose except to represent that particular brand or service.</li>\r\n</ul>\r\n</section>\r\n</div>\r\n</section>\r\n</section>', '2017-01-02', '2017-01-30', 2, 1),
(4, 'Font Awesome is fully open source and is GPL friendly', '<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>', '2017-01-30', '2017-01-31', 2, 1),
(8, 'Lorem Ipsum', '<p><span class=\"cm-string\"><strong>Lorem Ipsum is simply dummy text of the printing and typesetting industry.</strong></span></p>\r\n<p><span class=\"cm-string\"><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'</span><span class=\"cm-string\">\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</span></p>\r\n<table style=\"border-color: #0283ed; background-color: #d9d4d4; width: 100%; height: 300px; margin-left: auto; margin-right: auto;\" border=\"10\" cellspacing=\"2\" cellpadding=\"2\">\r\n<tbody>\r\n<tr>\r\n<td style=\"text-align: center;\"><strong>SAT</strong></td>\r\n<td style=\"text-align: center;\"><strong>SUN</strong></td>\r\n<td style=\"text-align: center;\"><strong>MON</strong></td>\r\n<td style=\"text-align: center;\"><strong>TUE</strong></td>\r\n<td style=\"text-align: center;\"><strong>WED</strong></td>\r\n<td style=\"text-align: center;\"><strong>THU</strong></td>\r\n<td style=\"text-align: center;\"><strong>FRI</strong></td>\r\n</tr>\r\n<tr>\r\n<td style=\"text-align: center;\">A</td>\r\n<td style=\"text-align: center;\">B</td>\r\n<td style=\"text-align: center;\">C</td>\r\n<td style=\"text-align: center;\">D</td>\r\n<td style=\"text-align: center;\">E</td>\r\n<td style=\"text-align: center;\">F</td>\r\n<td style=\"text-align: center;\">G</td>\r\n</tr>\r\n<tr>\r\n<td style=\"text-align: center;\">H</td>\r\n<td style=\"text-align: center;\">I</td>\r\n<td style=\"text-align: center;\">J</td>\r\n<td style=\"text-align: center;\">K</td>\r\n<td style=\"text-align: center;\">L</td>\r\n<td style=\"text-align: center;\">M</td>\r\n<td style=\"text-align: center;\">N</td>\r\n</tr>\r\n</tbody>\r\n</table>', '2017-01-01', '2017-01-02', 2, 1),
(9, 'Summer Solstice 2016 (Southern Hemisphere)', '<p><a href=\"https://www.google.com/logos/doodles/2016/summer-solstice-2016-southern-hemisphere-5137503691472896.2-hp2x.gif\"><strong><img src=\"https://www.google.com/logos/doodles/2016/summer-solstice-2016-southern-hemisphere-5137503691472896.2-hp2x.gif\" alt=\"Visit http://google.com\" width=\"390\" height=\"132\"></strong></a></p>\r\n<p><strong>Today</strong> marks the first day of <strong>summer</strong> and the longest day of the year for the southern hemisphere. The summer solstice is named for the brief time when the sun appears to pause its movement across the sky. At that moment, the tilt and rotation of the earth shifts our view of the sunâ€™s direction from northward to southward, causing it to hang momentarily suspended. Doodler Nate Swinehart created a family of anthropomorphized rocks to commemorate the change of season.Â Enjoy the peak of summer in the southern hemisphere with todayâ€™s Doodle!</p>\r\n<p>Â <img src=\"../../../assets/tinymce/plugins/emoticons/img/smiley-innocent.gif\" alt=\"innocent\"><img src=\"../../../assets/tinymce/plugins/emoticons/img/smiley-laughing.gif\" alt=\"laughing\"></p>\r\n<p>&lt;iframe src=\"//www.youtube.com/embed/i8z6c_71aWY\" width=\"100%\" height=\"200\" allowfullscreen=\"allowfullscreen\"&gt;&lt;/iframe&gt;</p>\r\n<p>Â </p>\r\n<p>Â </p>\r\n<p>Â </p>\r\n<p>Â </p>', '2017-01-30', '2017-01-31', 2, 1),
(10, 'Trademarks', '<p>The use of these trademarks does not indicate endorsement of the trademark holder by Font Awesome</p>', '2018-03-08', '2018-03-23', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `id` int(11) NOT NULL,
  `patient_id` varchar(20) DEFAULT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `blood_group` varchar(10) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `affliate` varchar(50) DEFAULT NULL,
  `picture` varchar(50) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `patient_id`, `firstname`, `lastname`, `email`, `password`, `phone`, `mobile`, `address`, `sex`, `blood_group`, `date_of_birth`, `affliate`, `picture`, `created_by`, `create_date`, `status`) VALUES
(26, 'PHR2DQW0', 'Jajia Jannat ', 'Rahi', NULL, NULL, '0182222221111', '01911112223333', '301,bti central plaza', 'Male', 'A+', '2000-01-01', NULL, 'assets/images/patient/2017-01-16/p11.png', 2, '2017-01-12', 1),
(27, 'P1RNKS9W', 'Jajia Jannat ', 'Rahi', NULL, NULL, '017344444111', '018111111111111', 'South Ferri Ghat,Padma River,Chandpur', 'Male', 'A+', '1999-01-01', NULL, 'assets/images/patient/2017-01-16/p10.png', 2, '2017-01-12', 1),
(28, 'PMXZFDP9', 'Himik ', 'Andlazuna', NULL, NULL, '0182222221111', '01911112223333', 'jr,Road,Complex cirt', 'Male', 'A-', '1991-05-23', NULL, 'assets/images/patient/2017-01-16/p9.png', 2, '2017-01-12', 1),
(29, 'P3GWY7V3', 'Znakng ', 'Xinaktar', NULL, NULL, '01711111122', '018111111111111', '231,East Patalipur,Sonamuri', 'Male', 'B+', '1980-02-03', NULL, 'assets/images/patient/2017-01-16/p8.png', 2, '2017-01-12', 1),
(30, 'PA0I54ZM', 'Tanzil', 'Ahmad', NULL, NULL, '1922296392', '1922296392', '98 Green Road, Farmgate, Dhaka-1215', 'Male', 'O+', '1980-02-03', NULL, 'assets/images/patient/2017-01-16/p7.png', 2, '2017-01-12', 1),
(31, 'PL8XEPGJ', 'Amer', 'Ahmedullah ', NULL, NULL, '017222222222', '01922296392', '231,East Patalipur,Sonamuri', 'Male', 'B+', '1970-01-01', NULL, 'assets/images/patient/2017-01-16/p6.png', 2, '2017-01-12', 1),
(32, 'P79I35Q5', 'Tanzil', 'Ahmad', NULL, NULL, '1922296392', '1922296392', '98 Green Road, Farmgate, Dhaka-1215', 'Male', 'B+', '1980-02-03', NULL, 'assets/images/patient/2017-01-16/p4.png', 2, '2017-01-15', 1),
(33, 'PT5L36X1', 'Tanzil', 'Ahmad', NULL, NULL, '1922296392', '1922296392', '98 Green Road, Farmgate, Dhaka-1215', 'Male', '', '0000-00-00', NULL, 'assets/images/patient/2017-01-16/p3.png', 2, '2017-01-16', 1),
(34, 'PR5JXID6', 'Tanzil', 'Ahmad', NULL, NULL, '1922296392', '1922296392', '98 Green Road, Farmgate, Dhaka-1215', 'Male', '', '0000-00-00', NULL, 'assets/images/patient/2017-01-16/p2.png', 2, '2017-01-16', 1),
(35, 'PPPZJP52', 'Tanzil', 'Ahmad', NULL, NULL, '1922296392', '1922296392', '98 Green Road, Farmgate, Dhaka-1215', 'Male', 'A-', '0000-00-00', NULL, 'assets/images/patient/2017-01-16/p1.png', 2, '2017-01-16', 1),
(36, 'PNR6B7EY', 'Tanzil', 'Ahmad', NULL, NULL, '1922296392', '1922296392', '98 Green Road, Farmgate, Dhaka-1215', 'Male', 'B+', '1969-12-31', NULL, 'assets/images/patient/2017-01-16/p.png', 1, '2017-01-16', 1),
(37, 'PYRT7ZOS', 'Tanzil', 'Ahmad', NULL, NULL, '1922296392', '1922296392', '98 Green Road, Farmgate, Dhaka-1215', 'Male', 'B-', '1969-12-31', NULL, 'assets/images/patient/2017-01-16/p5.png', 1, '2017-01-16', 1),
(38, 'PZZWZDVA', 'Tuhin', 'Sorkar', NULL, NULL, '', '0123456789', 'Hello', 'Male', '', '2017-02-26', NULL, '', 26, '2017-02-26', 1),
(39, 'P43O0999', 'Sahed', 'Abdullah', NULL, NULL, '', '0123456789', 'TEST', 'Male', 'A+', '2017-04-02', NULL, NULL, NULL, '2017-02-28', 1),
(40, 'P1XWEV6W', 'Alex', 'Anderson', 'patient@demo.com', '827ccb0eea8a706c4c34a16891f84e7b', NULL, '02123456789', 'Kathal Bagan, Dhaka', 'Male', NULL, '1970-01-01', NULL, 'assets/images/patient/2017-03-02/i.jpg', 40, '2017-03-02', 1),
(41, 'P72P7031', 'Tuhin', 'Sorkar', NULL, NULL, '012346578955', '01324658585585', 'TEST', 'Male', 'O+', '2017-04-20', NULL, '', 1, '2017-04-20', 1),
(42, 'P45KRFCA', 'Jahed', 'Abdullah', 'jahed@demo.com', '827ccb0eea8a706c4c34a16891f84e7b', '0123456789', '0123456788', 'Dhaka, Bangladesh', 'Male', 'B+', '1997-04-20', NULL, 'assets/images/patient/2017-04-20/i.jpg', 2, '2017-04-20', 1),
(43, 'PJ3URDGO', 'kamal', 'uddin', 'kamal@demo.com', '827ccb0eea8a706c4c34a16891f84e7b', '', '1234567890', 'TEST', 'Male', 'B+', '2017-04-24', NULL, '', 1, '2017-04-24', 1),
(44, 'PBNAYR1Q', 'ashwni', 'rajvaidye', 'ashwini@demo.com', '2852f697a9f8581725c6fc6a5472a2e5', '', '7890887767', 'shahgunj', 'Female', 'B+', '1998-09-01', NULL, '', 2, '2018-03-08', 1),
(45, 'PF51Q7X3', 'kishor', 'kulkarni', 'n@gmail.com', '866e09729ff6bea8cd0aac76e9d74d88', '', '9011220012', 'cannought', 'Male', '', '1992-03-08', NULL, '', 1, '2018-03-08', 1),
(46, 'P3Y2QHWN', 'HARISH', 'SHARMA', 'harish@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '', '9852291477', 'cidco', 'Male', 'O+', '2018-03-09', NULL, '', 2, '2018-03-09', 1),
(47, 'PF1R8I8T', 'Zulfikar Ali', 'Bhat', 'zulfikar@hms.com', '81dc9bdb52d04dc20036dbd8313ed055', '9070888777', '9070888777', 'Srinagar', 'Male', 'A+', '2002-05-21', NULL, 'assets/images/patient/2019-05-21/4.jpg', 7, '2019-05-21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pr_case_study`
--

CREATE TABLE `pr_case_study` (
  `id` int(11) UNSIGNED NOT NULL,
  `patient_id` varchar(30) DEFAULT NULL,
  `food_allergies` varchar(255) DEFAULT NULL,
  `tendency_bleed` varchar(255) DEFAULT NULL,
  `heart_disease` varchar(255) DEFAULT NULL,
  `high_blood_pressure` varchar(255) DEFAULT NULL,
  `diabetic` varchar(255) DEFAULT NULL,
  `surgery` varchar(255) DEFAULT NULL,
  `accident` varchar(255) DEFAULT NULL,
  `others` varchar(255) DEFAULT NULL,
  `family_medical_history` varchar(255) DEFAULT NULL,
  `current_medication` varchar(255) DEFAULT NULL,
  `female_pregnancy` varchar(255) DEFAULT NULL,
  `breast_feeding` varchar(255) DEFAULT NULL,
  `health_insurance` varchar(255) DEFAULT NULL,
  `low_income` varchar(255) DEFAULT NULL,
  `reference` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pr_case_study`
--

INSERT INTO `pr_case_study` (`id`, `patient_id`, `food_allergies`, `tendency_bleed`, `heart_disease`, `high_blood_pressure`, `diabetic`, `surgery`, `accident`, `others`, `family_medical_history`, `current_medication`, `female_pregnancy`, `breast_feeding`, `health_insurance`, `low_income`, `reference`, `status`) VALUES
(2, 'P1RNKS9W', 'Yes', 'No', 'No', 'Yes', 'No', 'No', 'No', 'No', 'Yes', 'No', 'No', 'No', 'Yes', 'Yes', 'None', 1),
(3, 'P1RNKS9W', 'No', 'No', 'No', 'No', 'No', 'No', 'Yes', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 'No', 1),
(4, 'PX1231', 'yes', 'no', 'no', 'no', 'yes', 'yes', 'no', '', 'no', '', 'no', 'no', 'yes', '50000', '', 1),
(5, 'P72P7031', 'NO', 'YES', 'NO', 'NO', 'diabetic', 'yes', 'no', 'NO', 'NO', 'NO', 'no', 'YES', 'NO', 'NO', 'NO', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pr_insurance`
--

CREATE TABLE `pr_insurance` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pr_insurance`
--

INSERT INTO `pr_insurance` (`id`, `name`, `description`, `status`) VALUES
(1, 'IFIS', '', 1),
(2, 'FILI', '', 1),
(5, 'IBIL', '', 1),
(6, 'bajaj life insurance', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pr_prescription`
--

CREATE TABLE `pr_prescription` (
  `id` int(11) UNSIGNED NOT NULL,
  `appointment_id` varchar(30) DEFAULT NULL,
  `patient_id` varchar(30) NOT NULL,
  `patient_type` varchar(50) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `chief_complain` text,
  `insurance_id` int(11) DEFAULT NULL,
  `weight` varchar(50) DEFAULT NULL,
  `blood_pressure` varchar(255) DEFAULT NULL,
  `medicine` text,
  `diagnosis` text,
  `visiting_fees` float DEFAULT NULL,
  `patient_notes` text,
  `reference_by` varchar(50) DEFAULT NULL,
  `reference_to` varchar(50) DEFAULT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pr_prescription`
--

INSERT INTO `pr_prescription` (`id`, `appointment_id`, `patient_id`, `patient_type`, `doctor_id`, `chief_complain`, `insurance_id`, `weight`, `blood_pressure`, `medicine`, `diagnosis`, `visiting_fees`, `patient_notes`, `reference_by`, `reference_to`, `date`) VALUES
(1, 'PRK4YUVG', 'P1RNKS9W', 'New', 2, 'TEST', 0, '100', '100', '[{\"name\":\"Acetaminophen\",\"type\":\"\",\"instruction\":\"Test Instruction \",\"days\":\"\"}]', '[{\"name\":\"TE2\",\"instruction\":\"TESt\"},{\"name\":\"TES@\",\"instruction\":\"erwersd\"},{\"name\":\"asdfsdaf\",\"instruction\":\"asdfsadf\"}]', 2500, 'TEST', '', '0', '2017-06-15'),
(2, 'P1XWEV6W', 'P1XWEV6W', 'Old', 1, 'TEST', 0, '100', '100', '[{\"name\":\"Naproxen\",\"type\":\"Tab\",\"instruction\":\"Test Instruction\",\"days\":\"3\"},{\"name\":\"Ciprofloxacin\",\"type\":\"Tab\",\"instruction\":\"Test Instruction\",\"days\":\"4\"},{\"name\":\"Amoxicillin\",\"type\":\"Tab\",\"instruction\":\"Test Instruction\",\"days\":\"5\"}]', '[{\"name\":\"X-Rays\",\"instruction\":\"Test Instruction\"},{\"name\":\"Test\",\"instruction\":\"Test Instruction\"}]', 2000, 'Test Notes', '', '0', '2017-06-17'),
(5, 'PRQN4V6Y', 'P1RNKS9W', 'Old', 1, 'Where does it come from?\r\nContrary to popular belief, Lorem Ipsum is not simply random text. \r\nIt has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. ', 1, '100', '50', '[{\"name\":\"Naproxen\",\"type\":\"TAB\",\"instruction\":\"TEST\",\"days\":\"2\"},{\"name\":\"Amoxicillin\",\"type\":\"TAB\",\"instruction\":\"\",\"days\":\"3\"},{\"name\":\"Amoxicillin\",\"type\":\"TAB\",\"instruction\":\"\",\"days\":\"3\"},{\"name\":\"Banana\",\"type\":\"TAB\",\"instruction\":\"\",\"days\":\"3\"},{\"name\":\"Coconut\",\"type\":\"Cap\",\"instruction\":\"\",\"days\":\"3\"},{\"name\":\"Melon\",\"type\":\"Cap\",\"instruction\":\"\",\"days\":\"3\"}]', '[{\"name\":\"TEST\",\"instruction\":\"TEST\"},{\"name\":\"TEST\",\"instruction\":\"asdfsdaf\"},{\"name\":\"TEST AGAin\",\"instruction\":\"Dsafasdf\"}]', 222, 'Where does it come from? Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. ', '', '0', '2017-07-02'),
(6, 'PRG6PTKT', 'P1RNKS9W', 'New', 1, 'How would I go about removing a number of years from the date that piece of code gives me? ... For your situation you could take advantage of PHP\'s implicit type casting and simply use .... 1 hour ago - Sterling Archer ...', 5, '100', '10', '[{\"name\":\"Apple\",\"type\":\"Tab\",\"instruction\":\"Test1\",\"days\":\"1\"},{\"name\":\"Mango\",\"type\":\"Cap\",\"instruction\":\"Test2\",\"days\":\"2\"},{\"name\":\"Orange\",\"type\":\"Cap\",\"instruction\":\"Test2\",\"days\":\"2\"},{\"name\":\"Coconut\",\"type\":\"Cap\",\"instruction\":\"Test2\",\"days\":\"2\"},{\"name\":\"Grape\",\"type\":\"Liq\",\"instruction\":\"T\",\"days\":\"1\"}]', '[{\"name\":\"X Rays\",\"instruction\":\"Test \"},{\"name\":\"ORM\",\"instruction\":\"Test \"}]', 100, 'How would I go about removing a number of years from the date that piece of code gives me? ... For your situation you could take advantage of PHP\'s implicit type casting and simply use .... 1 hour ago - Sterling Archer ...', '', '0', '2017-07-02'),
(7, 'PRMJ2GRO', 'P1RNKS9W', 'New', 12, 'TSET', 1, '100', '10', '[{\"name\":\"Apple\",\"type\":\"Tab\",\"instruction\":\"\",\"days\":\"2\"},{\"name\":\"Banana\",\"type\":\"TAB\",\"instruction\":\"\",\"days\":\"4\"},{\"name\":\"Test\",\"type\":\"CAP\",\"instruction\":\"\",\"days\":\"3\"}]', '[{\"name\":\"X RAYS\",\"instruction\":\"TEST\"},{\"name\":\"XSFS\",\"instruction\":\"TEST\"}]', 2000, 'TEST', 'No', NULL, '2017-06-20'),
(8, 'PR3TC768', 'P1XWEV6W', 'New', 12, 'TEST', 0, '100', '10', '[{\"name\":\"Apple\",\"type\":\"Tab\",\"instruction\":\"Test\",\"days\":\"3\"},{\"name\":\"Banana\",\"type\":\"Tab\",\"instruction\":\"Test\",\"days\":\"3\"},{\"name\":\"Lychee\",\"type\":\"Cap\",\"instruction\":\"Test\",\"days\":\"3\"},{\"name\":\"Grape\",\"type\":\"Tab\",\"instruction\":\"Test\",\"days\":\"3\"}]', '[{\"name\":\"X Rays\",\"instruction\":\"Test\"},{\"name\":\"Gebe\",\"instruction\":\"Test\"}]', 2000, 'TEST', 'No', NULL, '2017-06-20'),
(9, 'AL4WVCVD', 'PPPZJP52', 'New', 1, 'TEST', 0, '100', '', '[{\"name\":\"General Surgery\",\"type\":\"\",\"instruction\":\"\",\"days\":\"\"},{\"name\":\"New\",\"type\":\"\",\"instruction\":\"\",\"days\":\"\"}]', '[{\"name\":\"\",\"instruction\":\"\"}]', 0, '', '', NULL, '2017-07-02'),
(10, 'ARUMVG9X', 'P43O0999', 'New', 1, 'TEST', 0, '100', '', '[{\"name\":\"TEST\",\"type\":\"\",\"instruction\":\"\",\"days\":\"\"}]', '[{\"name\":\"\",\"instruction\":\"\"}]', 0, '', '', NULL, '2017-07-02'),
(11, 'AK6VLKQ1', 'PYRT7ZOS', 'New', 1, 'TEST', 0, '80', '', '[{\"name\":\"General Surgery\",\"type\":\"\",\"instruction\":\"\",\"days\":\"\"}]', '[{\"name\":\"TEST\",\"instruction\":\"\"}]', 0, '', '', NULL, '2017-07-02'),
(12, 'AZ0YMNYW', 'PNR6B7EY', 'New', 1, 'TEST', 0, '58', '', '[{\"name\":\"Test\",\"type\":\"\",\"instruction\":\"\",\"days\":\"\"}]', '[{\"name\":\"\",\"instruction\":\"\"}]', 2000, '', '', NULL, '2017-07-03'),
(13, 'A3QY7FDW', 'PF1R8I8T', 'New', 15, 'chest problem', 0, '50', '50', '[{\"name\":\"paracetamol\",\"type\":\"ss\",\"instruction\":\"ss\",\"days\":\"7\"}]', '[{\"name\":\"CBC\",\"instruction\":\"dddd\"}]', 250, 'test', 'dr asihq', NULL, '2019-05-21');

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `schedule_id` int(11) NOT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `available_days` varchar(50) DEFAULT NULL,
  `per_patient_time` time DEFAULT NULL,
  `serial_visibility_type` tinyint(4) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`schedule_id`, `doctor_id`, `start_time`, `end_time`, `available_days`, `per_patient_time`, `serial_visibility_type`, `status`) VALUES
(12, 13, '06:00:00', '11:00:00', 'Sunday', '00:00:30', 1, 1),
(13, 12, '08:00:00', '16:00:00', 'Monday', '00:00:35', 2, 1),
(14, 14, '13:00:00', '18:00:00', 'Tuesday', '00:00:40', 1, 1),
(16, 16, '10:00:00', '14:00:00', 'Thursday', '00:00:25', 2, 1),
(17, 17, '11:00:00', '17:00:00', 'Friday', '00:00:40', 1, 1),
(18, 18, '03:00:00', '10:00:00', 'Saturday', '00:00:45', 1, 1),
(19, 12, '04:00:00', '11:00:00', 'Sunday', '00:05:00', 1, 1),
(20, 1, '03:00:00', '06:00:00', 'Friday', '00:30:00', 2, 1),
(21, 15, '03:00:00', '06:00:00', 'Wednesday', '00:10:00', 1, 1),
(22, 14, '02:00:00', '09:00:00', 'Saturday', '00:05:00', 1, 1),
(23, 15, '04:00:00', '10:00:00', 'Friday', '00:00:25', 1, 1),
(24, 12, '08:00:00', '13:00:00', 'Wednesday', '00:40:00', 2, 1),
(25, 16, '02:15:15', '10:35:15', 'Monday', '00:05:00', 1, 1),
(26, 1, '08:00:00', '12:00:00', 'Sunday', '00:45:00', 1, 1),
(27, 32, '04:00:00', '15:25:30', 'Monday', '00:10:00', 1, 1),
(28, 1, '02:00:00', '09:00:00', 'Monday', '00:05:00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `setting_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `logo` varchar(50) DEFAULT NULL,
  `favicon` varchar(100) DEFAULT NULL,
  `language` varchar(100) DEFAULT NULL,
  `site_align` varchar(50) DEFAULT NULL,
  `footer_text` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`setting_id`, `title`, `description`, `email`, `phone`, `logo`, `favicon`, `language`, `site_align`, `footer_text`) VALUES
(2, 'Ramzana Hospital', 'NH2 Nowgam Bypass Srinagar', 'hospital@gmail.com', '1234567890', 'assets/images/apps/2017-10-24/7.jpg', 'assets/images/icons/2017-10-24/7.jpg', 'english', 'LTR', '2019©Copyright JKED');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(50) DEFAULT NULL,
  `lastname` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(32) DEFAULT NULL,
  `user_role` tinyint(1) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `mobile` varchar(20) DEFAULT NULL,
  `short_biography` text,
  `picture` varchar(50) DEFAULT NULL,
  `specialist` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `blood_group` varchar(10) DEFAULT NULL,
  `degree` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `create_date` date DEFAULT NULL,
  `update_date` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `firstname`, `lastname`, `email`, `password`, `user_role`, `designation`, `department_id`, `address`, `phone`, `mobile`, `short_biography`, `picture`, `specialist`, `date_of_birth`, `sex`, `blood_group`, `degree`, `created_by`, `create_date`, `update_date`, `status`) VALUES
(1, 'Samim Hasan', 'Khan', 'doctor@demo.com', '827ccb0eea8a706c4c34a16891f84e7b', 2, 'Asstt. Profesor', 12, 'Test', '0123456798', '0123456798', '<p>TEST</p>', 'assets/images/doctor/2016-11-03/d1.png', 'TEST', '2016-10-12', 'Male', 'A+', '<p>TEST</p>', 1, '2017-03-16', NULL, 1),
(2, 'Jhon', 'Doy', 'admin@demo.com', '827ccb0eea8a706c4c34a16891f84e7b', 1, NULL, NULL, '98 Green Road, Farmgate, Dhaka-1215', NULL, '1922296392', NULL, 'assets/images/doctor/2017-05-14/u2.png', NULL, '1970-01-01', 'Male', NULL, NULL, 2, '2017-05-14', NULL, 1),
(7, 'Hasan', 'Khan', 'receptionist@demo.com', '827ccb0eea8a706c4c34a16891f84e7b', 7, NULL, NULL, 'TEST', NULL, '018211555555', NULL, 'assets/images/human_resources/2017-02-01/H.jpg', NULL, '1970-01-01', 'Male', NULL, NULL, 7, '2017-03-16', NULL, 1),
(8, 'Ashik', 'Islam', 'representative@demo.com', '827ccb0eea8a706c4c34a16891f84e7b', 8, NULL, NULL, 'Dhaka, Bangladesh', NULL, '0123456789', NULL, 'assets/images/human_resources/2017-02-04/d1.jpg', NULL, '1970-01-01', 'Male', NULL, NULL, 8, '2017-03-16', NULL, 1),
(12, 'Dr. Elvera ', 'A. Lewis', 'elvera@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 2, 'MBBS', 12, '3028 University Street Redmond, WA 98052 ', '01888237267', '01888237267', '<p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident, similique sunt in culpa qui officia deserunt mollitia animi, id est laborum et dolorum fuga.</p>', 'assets/images/doctor/2017-01-10/.jpeg', 'Nose', '0000-00-00', 'Male', 'A+', '<p><strong>Bachelor\'s degrees</strong> are offered at all 4-year colleges and universities, from large public institutions to small private colleges. The two most common types of bachelor\'s degrees are the Bachelor of Arts (B.A.) and Bachelor of Science (', 2, '2017-01-10', NULL, 1),
(13, 'Dr.Mesut ', 'Alzain', 'mesut@bdtask.com', '25d55ad283aa400af464c76d713c07ad', 2, 'Assistant Professor ', 13, '87,East Anadulala City ', '', '018111111111111', '', 'assets/images/doctor/2017-01-12/d6.jpg', 'Neonatal', '1980-02-03', 'Male', 'A-', '<p>M.B.B.S,FCFS,Pharma.D,CCFA,NFDA</p>', 2, '2017-01-12', NULL, 1),
(14, 'Dr.Ykayama', 'Durusalaln', 'murat1@bdtask.com', '8ce87b8ec346ff4c80635f667d1592ae', 2, 'Professor ', 24, '231,East Patalipur,Sonamuri', '01711111122', '01911112223333', '', 'assets/images/doctor/2017-01-12/d5.jpg', 'Urology ', '1980-01-01', 'Female', 'A+', '<p>M.B.B.S,FCFS,Pharma.D,CCFA,NFDA</p>', 2, '2017-01-12', NULL, 1),
(15, 'Dr.Zesika', 'Hayat', 'hayat@bdtask.com', '827ccb0eea8a706c4c34a16891f84e7b', 2, 'Assistant Professor ', 15, '54,East Park Street,North Sonaimuri', '01711111122', '+0111133445782', '', 'assets/images/doctor/2017-01-12/d4.jpg', 'Neurology ', '1991-05-23', 'Male', 'O-', '<p>M.B.B.S,FCFS,Pharma.D,CCFA,NFDA</p>', 2, '2017-01-12', NULL, 1),
(16, 'Dr.Dilmara ', 'Xyanturamana ', 'dilmara@bdtask.com', 'fcea920f7412b5da7be0cf42b8c93759', 2, 'Professor ', 18, 'South Ferri Ghat,Padma River,Chandpur', '01711111122', '+0123111189323', '', 'assets/images/doctor/2017-01-12/d3.png', 'Medicine ', '1980-03-05', 'Male', 'A-', '<p>M.B.B.S,FCFS,Pharma.D,CCFA,NFDA</p>', 2, '2017-01-12', NULL, 1),
(17, 'Dr. Ahmed ', 'Abdullah', 'ahemd@bdtask.com', 'e10adc3949ba59abbe56e057f20f883e', 2, 'Professor ', 12, '231,East Patalipur,Sonamuri', '0182222221111', '01911112223333', '', 'assets/images/doctor/2017-01-12/d2.png', 'Microbiologist ', '1968-01-01', 'Male', 'A+', '<p>M.B.B.S,FCFS,Pharma.D,CCFA,NFDA</p>', 2, '2017-01-12', NULL, 1),
(18, 'Dr.Huyan', 'Xinan', 'xinan@bdtask.com', 'fcea920f7412b5da7be0cf42b8c93759', 2, 'Assistant Professor ', 22, '231,East Patalipur,Sonamuri,Nkhali', '0181111111112222', '+0111133445782', '', 'assets/images/doctor/2017-01-12/d1.png', 'Gynecologist ', '1985-01-12', 'Male', '', '<p>M.B.B.S,FCFS,Pharma.D,CCFA,NFDA</p>', 2, '2017-01-12', NULL, 1),
(19, 'Ahmed', 'Ziniya', 'laboratorist@demo.com', '827ccb0eea8a706c4c34a16891f84e7b', 4, NULL, NULL, '231,East Patalipur,Sonamuri', NULL, '+0111133445782', NULL, 'assets/images/representative/2017-01-16/p3.png', NULL, '1970-01-01', 'Male', NULL, NULL, 19, '2017-03-16', NULL, 1),
(22, 'Dr.Murtaza', 'Alainar', 'murtaz@bdtask.com', '25f9e794323b453885f5181f1b624d0b', 2, 'Professor', 15, '56/C, East Bankuraz,North City ', '092222223333', '019833333222', '<p>Write about doctor in here.doctor short biography.</p>', 'assets/images/doctor/2017-01-15/d.jpg', 'Neurology ', '1987-03-21', 'Male', 'A+', '<p>MBBS,FCCS,DPD,ORCH(NEU),MCCCO</p>', 2, '2017-03-05', NULL, 1),
(24, 'Meshu', 'Munawar', 'pharmacist@demo.com', '827ccb0eea8a706c4c34a16891f84e7b', 6, NULL, NULL, 'Dhaka', NULL, '018211555555', NULL, 'assets/images/human_resources/2017-02-01/i1.jpg', NULL, '1970-01-01', 'Male', NULL, NULL, 24, '2017-03-16', NULL, 1),
(27, 'Tuhin', 'Sorkar', 'accountant@demo.com', '827ccb0eea8a706c4c34a16891f84e7b', 3, NULL, NULL, 'TEST', NULL, '018211555555', NULL, 'assets/images/human_resources/2017-02-01/i2.jpg', NULL, '1970-01-01', 'Male', NULL, NULL, 27, '2017-03-16', NULL, 1),
(29, 'Bay', 'Smith', 'nurse@demo.com', '827ccb0eea8a706c4c34a16891f84e7b', 5, NULL, NULL, 'Dhaka, Bangladesh', NULL, '018211555555', NULL, 'assets/images/human_resources/2017-02-01/d.jpg', NULL, '1970-01-01', 'Male', NULL, NULL, 29, '2017-03-16', NULL, 1),
(30, 'Tuhin', 'Abdullah', 'case@demo.com', '827ccb0eea8a706c4c34a16891f84e7b', 9, NULL, NULL, 'TEST', NULL, '0123456788', NULL, '', NULL, '1970-01-01', 'Male', NULL, NULL, 30, '2017-04-23', NULL, 1),
(31, 'John', 'Doe', 'case2@demo.com', '827ccb0eea8a706c4c34a16891f84e7b', 9, NULL, NULL, 'India', NULL, '0123459689', NULL, '', NULL, NULL, 'Male', NULL, NULL, 2, '2017-04-23', NULL, 1),
(32, 'Dr tekwani', 'tekwani', 'tek@demo.com', 'e412cc4709b388b855179d68cc8fb27a', 2, 'MD', 17, 'Jubliee park', '', '7507875026', '', '', '', '2018-03-08', 'Male', 'A-', '', 2, '2018-03-08', NULL, 1),
(33, 'vaishali', 'dongre', 'v@demo.com', 'c83ffd5f4c0e41a79f9c1c9809296dae', 5, NULL, NULL, 'cidco', NULL, '9765116652', NULL, '', NULL, NULL, 'Female', NULL, NULL, 2, '2018-03-08', NULL, 1),
(34, 'sunita', 'kakkar', 's@demo.com', '270bc4393030fbfb947e9ec35b9c82e1', 4, NULL, NULL, 'nirala bazar', NULL, '987611552', NULL, '', NULL, NULL, 'Female', NULL, NULL, 2, '2018-03-08', NULL, 1),
(35, 'sadhna', 'roy', 'sadhna@gmail.com', '34e1115126bfd6b2796e7d0641a87d2a', 6, NULL, NULL, '36 Guruprasad laxminagar garkheda near sutgirni chowk Aurangabad Maharashtra', NULL, '9923599652', NULL, '', NULL, NULL, 'Female', NULL, NULL, 2, '2018-03-09', NULL, 1),
(36, 'Amit', 'Patil', 'amit@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', 2, 'MBBS', 17, 'Pune', '', '99887766550`', '', 'assets/images/doctor/2018-05-23/a.png', '', '2018-05-23', 'Male', '', '', 2, '2018-05-23', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ws_comment`
--

CREATE TABLE `ws_comment` (
  `id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `comment` text NOT NULL,
  `date` datetime NOT NULL,
  `add_to_website` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ws_comment`
--

INSERT INTO `ws_comment` (`id`, `item_id`, `name`, `email`, `comment`, `date`, `add_to_website`) VALUES
(64, 25, 'John Doe', 'doe@example.com', 'Hello World!', '2017-01-15 11:42:47', 1),
(65, 24, 'Tanzil Ahmad', 'tanzil4091@gmail.com', 'I highly recommend this application for hospital management', '2017-01-16 01:50:48', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ws_item`
--

CREATE TABLE `ws_item` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `icon_image` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text,
  `position` int(2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `counter` int(11) NOT NULL DEFAULT '0',
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ws_item`
--

INSERT INTO `ws_item` (`id`, `name`, `icon_image`, `title`, `description`, `position`, `status`, `counter`, `date`) VALUES
(24, 'blog', 'assets_web/images/icon_image/2017-01-12/t.jpg', 'Nullam et lorem quis risus porttitor sollicitudin vitae', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris et sapien a leo imperdiet auctor. Nullam sollicitudin quam ut diam lacinia, non venenatis odio vehicula. Ut ultricies vel leo sit amet vestibulum. Curabitur elementum lacus sagittis dolor scelerisque, sit amet molestie nulla mattis. Aliquam eu semper diam. Sed vulputate bibendum erat ac luctus. Curabitur a pretium purus. Suspendisse quis suscipit eros. Cras felis odio, aliquam et rhoncus sit amet, dapibus eget tellus. Etiam porttitor lacus in nibh fringilla, id ullamcorper ipsum egestas. Vivamus dictum dui vel erat suscipit egestas. Pellentesque ut arcu eget sem pretium auctor a sed purus. Cras gravida lorem eu feugiat malesuada. Etiam sollicitudin enim quis neque viverra semper.</p>\r\n<p>Aenean ac feugiat urna, eu finibus velit. Nunc dictum ante a velit pharetra, ut ultrices ante posuere. Quisque a ante sodales dolor gravida pulvinar. Integer enim justo, pulvinar non feugiat at, venenatis eu ex. Nullam ac finibus orci. Aenean metus felis, euismod vitae sollicitudin quis, convallis eu diam. Vestibulum et dictum nisi. Phasellus dapibus dui urna, et pellentesque orci egestas vel. Aliquam iaculis urna sed metus consectetur luctus. Vivamus ac sagittis dui. Ut ultrices, mauris vel pulvinar suscipit, orci diam suscipit felis, sit amet imperdiet magna mauris a urna. Aliquam condimentum urna ipsum, a rutrum sapien dapibus in. Etiam eleifend lobortis velit, a consequat leo sodales sit amet. Pellentesque mattis, massa in sollicitudin accumsan, nibh nisl facilisis urna, a blandit nunc eros vel neque. Proin sed nisi sed eros condimentum maximus sit amet sed eros. Aenean interdum aliquam egestas.</p>\r\n<p>Nullam et lorem quis risus porttitor sollicitudin vitae nec arcu. Quisque rhoncus orci diam, eu fringilla lacus convallis a. Donec tincidunt enim in hendrerit varius. Maecenas vel vestibulum metus. Curabitur eleifend ut purus vel consequat. Aenean hendrerit pulvinar placerat. Suspendisse at accumsan leo. Aenean cursus tortor et augue efficitur faucibus. Integer eget ullamcorper dui. Aliquam porttitor ac risus ac malesuada.</p>', 1, 1, 23, '2017-01-12'),
(25, 'blog', 'assets_web/images/icon_image/2017-01-12/e.jpg', 'Nullam et lorem quis risus porttitor sollicitudin vitae', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris et sapien a leo imperdiet auctor. Nullam sollicitudin quam ut diam lacinia, non venenatis odio vehicula. Ut ultricies vel leo sit amet vestibulum. Curabitur elementum lacus sagittis dolor scelerisque, sit amet molestie nulla mattis. Aliquam eu semper diam. Sed vulputate bibendum erat ac luctus. Curabitur a pretium purus. Suspendisse quis suscipit eros. Cras felis odio, aliquam et rhoncus sit amet, dapibus eget tellus. Etiam porttitor lacus in nibh fringilla, id ullamcorper ipsum egestas. Vivamus dictum dui vel erat suscipit egestas. Pellentesque ut arcu eget sem pretium auctor a sed purus. Cras gravida lorem eu feugiat malesuada. Etiam sollicitudin enim quis neque viverra semper.</p>\r\n<p>Aenean ac feugiat urna, eu finibus velit. Nunc dictum ante a velit pharetra, ut ultrices ante posuere. Quisque a ante sodales dolor gravida pulvinar. Integer enim justo, pulvinar non feugiat at, venenatis eu ex. Nullam ac finibus orci. Aenean metus felis, euismod vitae sollicitudin quis, convallis eu diam. Vestibulum et dictum nisi. Phasellus dapibus dui urna, et pellentesque orci egestas vel. Aliquam iaculis urna sed metus consectetur luctus. Vivamus ac sagittis dui. Ut ultrices, mauris vel pulvinar suscipit, orci diam suscipit felis, sit amet imperdiet magna mauris a urna. Aliquam condimentum urna ipsum, a rutrum sapien dapibus in. Etiam eleifend lobortis velit, a consequat leo sodales sit amet. Pellentesque mattis, massa in sollicitudin accumsan, nibh nisl facilisis urna, a blandit nunc eros vel neque. Proin sed nisi sed eros condimentum maximus sit amet sed eros. Aenean interdum aliquam egestas.</p>\r\n<p>Nullam et lorem quis risus porttitor sollicitudin vitae nec arcu. Quisque rhoncus orci diam, eu fringilla lacus convallis a. Donec tincidunt enim in hendrerit varius. Maecenas vel vestibulum metus. Curabitur eleifend ut purus vel consequat. Aenean hendrerit pulvinar placerat. Suspendisse at accumsan leo. Aenean cursus tortor et augue efficitur faucibus. Integer eget ullamcorper dui. Aliquam porttitor ac risus ac malesuada.</p>', 2, 1, 14, '2017-01-12'),
(26, 'blog', 'assets_web/images/icon_image/2017-01-12/d.jpg', 'Nullam et lorem quis risus porttitor sollicitudin vitae', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris et sapien a leo imperdiet auctor. Nullam sollicitudin quam ut diam lacinia, non venenatis odio vehicula. Ut ultricies vel leo sit amet vestibulum. Curabitur elementum lacus sagittis dolor scelerisque, sit amet molestie nulla mattis. Aliquam eu semper diam. Sed vulputate bibendum erat ac luctus. Curabitur a pretium purus. Suspendisse quis suscipit eros. Cras felis odio, aliquam et rhoncus sit amet, dapibus eget tellus. Etiam porttitor lacus in nibh fringilla, id ullamcorper ipsum egestas. Vivamus dictum dui vel erat suscipit egestas. Pellentesque ut arcu eget sem pretium auctor a sed purus. Cras gravida lorem eu feugiat malesuada. Etiam sollicitudin enim quis neque viverra semper.</p>\r\n<p>Aenean ac feugiat urna, eu finibus velit. Nunc dictum ante a velit pharetra, ut ultrices ante posuere. Quisque a ante sodales dolor gravida pulvinar. Integer enim justo, pulvinar non feugiat at, venenatis eu ex. Nullam ac finibus orci. Aenean metus felis, euismod vitae sollicitudin quis, convallis eu diam. Vestibulum et dictum nisi. Phasellus dapibus dui urna, et pellentesque orci egestas vel. Aliquam iaculis urna sed metus consectetur luctus. Vivamus ac sagittis dui. Ut ultrices, mauris vel pulvinar suscipit, orci diam suscipit felis, sit amet imperdiet magna mauris a urna. Aliquam condimentum urna ipsum, a rutrum sapien dapibus in. Etiam eleifend lobortis velit, a consequat leo sodales sit amet. Pellentesque mattis, massa in sollicitudin accumsan, nibh nisl facilisis urna, a blandit nunc eros vel neque. Proin sed nisi sed eros condimentum maximus sit amet sed eros. Aenean interdum aliquam egestas.</p>\r\n<p>Nullam et lorem quis risus porttitor sollicitudin vitae nec arcu. Quisque rhoncus orci diam, eu fringilla lacus convallis a. Donec tincidunt enim in hendrerit varius. Maecenas vel vestibulum metus. Curabitur eleifend ut purus vel consequat. Aenean hendrerit pulvinar placerat. Suspendisse at accumsan leo. Aenean cursus tortor et augue efficitur faucibus. Integer eget ullamcorper dui. Aliquam porttitor ac risus ac malesuada.</p>', 3, 1, 5, '2017-01-12'),
(27, 'blog', 'assets_web/images/icon_image/2017-01-12/m.jpg', 'Nullam et lorem quis risus porttitor sollicitudin vitae', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris et sapien a leo imperdiet auctor. Nullam sollicitudin quam ut diam lacinia, non venenatis odio vehicula. Ut ultricies vel leo sit amet vestibulum. Curabitur elementum lacus sagittis dolor scelerisque, sit amet molestie nulla mattis. Aliquam eu semper diam. Sed vulputate bibendum erat ac luctus. Curabitur a pretium purus. Suspendisse quis suscipit eros. Cras felis odio, aliquam et rhoncus sit amet, dapibus eget tellus. Etiam porttitor lacus in nibh fringilla, id ullamcorper ipsum egestas. Vivamus dictum dui vel erat suscipit egestas. Pellentesque ut arcu eget sem pretium auctor a sed purus. Cras gravida lorem eu feugiat malesuada. Etiam sollicitudin enim quis neque viverra semper.</p>\r\n<p>Aenean ac feugiat urna, eu finibus velit. Nunc dictum ante a velit pharetra, ut ultrices ante posuere. Quisque a ante sodales dolor gravida pulvinar. Integer enim justo, pulvinar non feugiat at, venenatis eu ex. Nullam ac finibus orci. Aenean metus felis, euismod vitae sollicitudin quis, convallis eu diam. Vestibulum et dictum nisi. Phasellus dapibus dui urna, et pellentesque orci egestas vel. Aliquam iaculis urna sed metus consectetur luctus. Vivamus ac sagittis dui. Ut ultrices, mauris vel pulvinar suscipit, orci diam suscipit felis, sit amet imperdiet magna mauris a urna. Aliquam condimentum urna ipsum, a rutrum sapien dapibus in. Etiam eleifend lobortis velit, a consequat leo sodales sit amet. Pellentesque mattis, massa in sollicitudin accumsan, nibh nisl facilisis urna, a blandit nunc eros vel neque. Proin sed nisi sed eros condimentum maximus sit amet sed eros. Aenean interdum aliquam egestas.</p>\r\n<p>Nullam et lorem quis risus porttitor sollicitudin vitae nec arcu. Quisque rhoncus orci diam, eu fringilla lacus convallis a. Donec tincidunt enim in hendrerit varius. Maecenas vel vestibulum metus. Curabitur eleifend ut purus vel consequat. Aenean hendrerit pulvinar placerat. Suspendisse at accumsan leo. Aenean cursus tortor et augue efficitur faucibus. Integer eget ullamcorper dui. Aliquam porttitor ac risus ac malesuada.</p>', 4, 1, 0, '2017-01-12'),
(28, 'service', 'assets_web/images/icon_image/2017-05-14/u3.png', 'Emergency Care', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum non tellus quis ante vulputate mattis vitae id erat. Nulla in volutpat justo, et scelerisque dui. Suspendisse vel volutpat tortor, et porttitor erat. Phasellus in enim sed lorem ullamcorper convallis. Ut aliquam nulla vel metus eleifend pulvinar. Mauris vitae sem a augue sollicitudin semper. Integer finibus pretium suscipit. Nulla vehicula metus ligula, vel rutrum augue rhoncus ac. Sed sed tortor sed sapien porta porta non sit amet libero. Pellentesque dictum ex nec risus maximus, ut gravida felis tincidunt. Nunc sem ligula, elementum non tincidunt eu, lacinia vitae tortor. Pellentesque tincidunt libero id suscipit tincidunt. Ut enim dolor, consequat a hendrerit in, vulputate a risus. In pulvinar elit non turpis rhoncus, non mattis lectus fringilla.', 1, 1, 0, '2017-05-14'),
(29, 'service', 'assets_web/images/icon_image/2017-01-13/u.png', 'Call Center 24/7', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum non tellus quis ante vulputate mattis vitae id erat. Nulla in volutpat justo, et scelerisque dui. Suspendisse vel volutpat tortor, et porttitor erat. Phasellus in enim sed lorem ullamcorper convallis. Ut aliquam nulla vel metus eleifend pulvinar. Mauris vitae sem a augue sollicitudin semper. Integer finibus pretium suscipit. Nulla vehicula metus ligula, vel rutrum augue rhoncus ac. Sed sed tortor sed sapien porta porta non sit amet libero. Pellentesque dictum ex nec risus maximus, ut gravida felis tincidunt. Nunc sem ligula, elementum non tincidunt eu, lacinia vitae tortor. Pellentesque tincidunt libero id suscipit tincidunt. Ut enim dolor, consequat a hendrerit in, vulputate a risus. In pulvinar elit non turpis rhoncus, non mattis lectus fringilla.', 2, 1, 0, '2017-01-13'),
(30, 'service', 'assets_web/images/icon_image/2017-01-13/h1.png', 'Cardiac Surgery', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum non tellus quis ante vulputate mattis vitae id erat. Nulla in volutpat justo, et scelerisque dui. Suspendisse vel volutpat tortor, et porttitor erat. Phasellus in enim sed lorem ullamcorper convallis. Ut aliquam nulla vel metus eleifend pulvinar. Mauris vitae sem a augue sollicitudin semper. Integer finibus pretium suscipit. Nulla vehicula metus ligula, vel rutrum augue rhoncus ac. Sed sed tortor sed sapien porta porta non sit amet libero. Pellentesque dictum ex nec risus maximus, ut gravida felis tincidunt. Nunc sem ligula, elementum non tincidunt eu, lacinia vitae tortor. Pellentesque tincidunt libero id suscipit tincidunt. Ut enim dolor, consequat a hendrerit in, vulputate a risus. In pulvinar elit non turpis rhoncus, non mattis lectus fringilla.', 3, 1, 0, '2017-01-13'),
(31, 'service', 'assets_web/images/icon_image/2017-01-13/D.png', 'Dental Care', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum non tellus quis ante vulputate mattis vitae id erat. Nulla in volutpat justo, et scelerisque dui. Suspendisse vel volutpat tortor, et porttitor erat. Phasellus in enim sed lorem ullamcorper convallis. Ut aliquam nulla vel metus eleifend pulvinar. Mauris vitae sem a augue sollicitudin semper. Integer finibus pretium suscipit. Nulla vehicula metus ligula, vel rutrum augue rhoncus ac. Sed sed tortor sed sapien porta porta non sit amet libero. Pellentesque dictum ex nec risus maximus, ut gravida felis tincidunt. Nunc sem ligula, elementum non tincidunt eu, lacinia vitae tortor. Pellentesque tincidunt libero id suscipit tincidunt. Ut enim dolor, consequat a hendrerit in, vulputate a risus. In pulvinar elit non turpis rhoncus, non mattis lectus fringilla.', 4, 1, 0, '2017-01-13'),
(32, 'service', 'assets_web/images/icon_image/2017-01-13/i.png', 'Ophthalmology', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum non tellus quis ante vulputate mattis vitae id erat. Nulla in volutpat justo, et scelerisque dui. Suspendisse vel volutpat tortor, et porttitor erat. Phasellus in enim sed lorem ullamcorper convallis. Ut aliquam nulla vel metus eleifend pulvinar. Mauris vitae sem a augue sollicitudin semper. Integer finibus pretium suscipit. Nulla vehicula metus ligula, vel rutrum augue rhoncus ac. Sed sed tortor sed sapien porta porta non sit amet libero. Pellentesque dictum ex nec risus maximus, ut gravida felis tincidunt. Nunc sem ligula, elementum non tincidunt eu, lacinia vitae tortor. Pellentesque tincidunt libero id suscipit tincidunt. Ut enim dolor, consequat a hendrerit in, vulputate a risus. In pulvinar elit non turpis rhoncus, non mattis lectus fringilla.', 5, 1, 0, '2017-01-13'),
(33, 'service', 'assets_web/images/icon_image/2017-05-14/u4.png', 'Neurology ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum non tellus quis ante vulputate mattis vitae id erat. Nulla in volutpat justo, et scelerisque dui. Suspendisse vel volutpat tortor, et porttitor erat. Phasellus in enim sed lorem ullamcorper convallis. Ut aliquam nulla vel metus eleifend pulvinar. Mauris vitae sem a augue sollicitudin semper. Integer finibus pretium suscipit. Nulla vehicula metus ligula, vel rutrum augue rhoncus ac. Sed sed tortor sed sapien porta porta non sit amet libero. Pellentesque dictum ex nec risus maximus, ut gravida felis tincidunt. Nunc sem ligula, elementum non tincidunt eu, lacinia vitae tortor. Pellentesque tincidunt libero id suscipit tincidunt. Ut enim dolor, consequat a hendrerit in, vulputate a risus. In pulvinar elit non turpis rhoncus, non mattis lectus fringilla.', 6, 1, 0, '2017-05-14'),
(34, 'about', 'assets_web/images/icon_image/2017-01-13/p.jpg', 'ABOUT US', '\r\n\r\n\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ipsum magna, gravida nec erat ac, malesuada pharetra felis. Phasellus eu dolor orci. Duis et dictum sem, sit amet sagittis dolor. Curabitur scelerisque, nunc eget viverra malesuada, nunc ligula tincidunt nisi, eget elementum urna magna at dui. Praesent eu tincidunt arcu. Ut imperdiet a ligula nec dapibus. Aliquam erat volutpat. Donec auctor elementum accumsan. Vestibulum velit augue, feugiat ac nisl in, pharetra accumsan ligula. Proin nunc mauris, ultrices quis tristique vitae, ornare quis nunc. Aenean ut tincidunt lorem. Maecenas consectetur faucibus velit, nec tincidunt nulla fermentum sed.\r\nAenean id ante blandit, mattis lacus ac, placerat elit. Vestibulum purus nisl, aliquam ut velit sed, fermentum bibendum ipsum. Vivamus sagittis mi ac erat fermentum, sed molestie tellus tincidunt. Curabitur mauris nisi, molestie viverra semper eget, elementum et odio. Etiam enim massa, fringilla eu malesuada in, volutpat eget sapien. Nunc aliquam diam in ex facilisis, non feugiat tellus tristique. Integer quis lorem at justo mollis dictum. Aenean nec nibh eget arcu faucibus dictum ac sit amet augue. Aliquam quis rhoncus ex. In euismod felis mauris, vel euismod risus ornare sit amet. Nunc iaculis nec dolor vel eleifend. Sed quis felis at enim faucibus commodo. Donec quis condimentum velit, sit amet luctus leo. Curabitur a volutpat lorem. Duis ut leo quis erat pellentesque tincidunt.\r\nUt eu enim eu ante faucibus tincidunt. Maecenas lorem purus, cursus in massa nec, convallis porta velit. Etiam aliquet tortor sed fermentum tempor. Maecenas quis ornare lacus, eu maximus purus. Mauris et pellentesque tellus, sed ullamcorper ipsum. Sed non volutpat risus. Donec sit amet sem vitae purus mollis sodales. Suspendisse ut ipsum sed lorem feugiat congue sed non tortor. Mauris laoreet lorem sed varius placerat. Nullam tincidunt neque vitae eros ullamcorper, laoreet finibus erat convallis. Vestibulum vehicula turpis dui, vitae ultrices ante fermentum in. Sed laoreet pharetra pretium. In hac habitasse platea dictumst. Morbi a bibendum velit.\r\nPhasellus luctus dignissim quam, et elementum mi aliquam sed. In non tortor nec libero porta egestas. Fusce id dictum augue, non condimentum eros. In in mi arcu. Suspendisse potenti. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Etiam euismod dictum justo vel condimentum. Donec leo mauris, ultrices ac risus nec, efficitur finibus eros. Ut ut blandit ex, vel porta nulla. Integer ut dapibus lectus. Duis sollicitudin metus ipsum, vitae euismod nisl sagittis et.\r\n\r\n\r\n', 1, 1, 13, '2017-01-13'),
(35, 'about', 'assets_web/images/icon_image/2017-01-13/g.jpg', 'Our Vision & Mission ', '\r\n\r\n\r\n\r\nLorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ipsum magna, gravida nec erat ac, malesuada pharetra felis. Phasellus eu dolor orci. Duis et dictum sem, sit amet sagittis dolor. Curabitur scelerisque, nunc eget viverra malesuada, nunc ligula tincidunt nisi, eget elementum urna magna at dui. Praesent eu tincidunt arcu. Ut imperdiet a ligula nec dapibus. Aliquam erat volutpat. Donec auctor elementum accumsan. Vestibulum velit augue, feugiat ac nisl in, pharetra accumsan ligula. Proin nunc mauris, ultrices quis tristique vitae, ornare quis nunc. Aenean ut tincidunt lorem. Maecenas consectetur faucibus velit, nec tincidunt nulla fermentum sed.\r\nAenean id ante blandit, mattis lacus ac, placerat elit. Vestibulum purus nisl, aliquam ut velit sed, fermentum bibendum ipsum. Vivamus sagittis mi ac erat fermentum, sed molestie tellus tincidunt. Curabitur mauris nisi, molestie viverra semper eget, elementum et odio. Etiam enim massa, fringilla eu malesuada in, volutpat eget sapien. Nunc aliquam diam in ex facilisis, non feugiat tellus tristique. Integer quis lorem at justo mollis dictum. Aenean nec nibh eget arcu faucibus dictum ac sit amet augue. Aliquam quis rhoncus ex. In euismod felis mauris, vel euismod risus ornare sit amet. Nunc iaculis nec dolor vel eleifend. Sed quis felis at enim faucibus commodo. Donec quis condimentum velit, sit amet luctus leo. Curabitur a volutpat lorem. Duis ut leo quis erat pellentesque tincidunt.\r\nUt eu enim eu ante faucibus tincidunt. Maecenas lorem purus, cursus in massa nec, convallis porta velit. Etiam aliquet tortor sed fermentum tempor. Maecenas quis ornare lacus, eu maximus purus. Mauris et pellentesque tellus, sed ullamcorper ipsum. Sed non volutpat risus. Donec sit amet sem vitae purus mollis sodales. Suspendisse ut ipsum sed lorem feugiat congue sed non tortor. Mauris laoreet lorem sed varius placerat. Nullam tincidunt neque vitae eros ullamcorper, laoreet finibus erat convallis. Vestibulum vehicula turpis dui, vitae ultrices ante fermentum in. Sed laoreet pharetra pretium. In hac habitasse platea dictumst. Morbi a bibendum velit.\r\nPhasellus luctus dignissim quam, et elementum mi aliquam sed. In non tortor nec libero porta egestas. Fusce id dictum augue, non condimentum eros. In in mi arcu. Suspendisse potenti. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Etiam euismod dictum justo vel condimentum. Donec leo mauris, ultrices ac risus nec, efficitur finibus eros. Ut ut blandit ex, vel porta nulla. Integer ut dapibus lectus. Duis sollicitudin metus ipsum, vitae euismod nisl sagittis et.\r\n\r\n\r\n', 2, 1, 1, '2017-01-13'),
(36, 'appointment', 'assets_web/images/icon_image/2017-01-13/6.png', 'Emergency Care', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ipsum magna, gravida nec erat ac, malesuada pharetra felis. Phasellus eu dolor orci. Duis et dictum sem, sit amet sagittis dolor. Curabitur scelerisque, nunc eget viverra malesuada, nunc ligula tincidunt nisi, eget elementum urna magna at dui. Praesent eu tincidunt arcu. Ut imperdiet a ligula nec dapibus. Aliquam erat volutpat. Donec auctor elementum accumsan. Vestibulum velit augue, feugiat ac nisl in, pharetra accumsan ligula. Proin nunc mauris, ultrices quis tristique vitae, ornare quis nunc. Aenean ut tincidunt lorem. Maecenas consectetur faucibus velit, nec tincidunt nulla fermentum sed.', 1, 1, 0, '2017-01-13'),
(37, 'appointment', 'assets_web/images/icon_image/2017-01-13/5.png', 'Test Appointment', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ipsum magna, gravida nec erat ac, malesuada pharetra felis. Phasellus eu dolor orci. Duis et dictum sem, sit amet sagittis dolor. Curabitur scelerisque, nunc eget viverra malesuada, nunc ligula tincidunt nisi, eget elementum urna magna at dui. Praesent eu tincidunt arcu. Ut imperdiet a ligula nec dapibus. Aliquam erat volutpat. Donec auctor elementum accumsan. Vestibulum velit augue, feugiat ac nisl in, pharetra accumsan ligula. Proin nunc mauris, ultrices quis tristique vitae, ornare quis nunc. Aenean ut tincidunt lorem. Maecenas consectetur faucibus velit, nec tincidunt nulla fermentum sed.', 2, 1, 0, '2017-01-13'),
(38, 'appointment', 'assets_web/images/icon_image/2017-01-13/N1.png', 'Neurology Surgery ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ipsum magna, gravida nec erat ac, malesuada pharetra felis. Phasellus eu dolor orci. Duis et dictum sem, sit amet sagittis dolor. Curabitur scelerisque, nunc eget viverra malesuada, nunc ligula tincidunt nisi, eget elementum urna magna at dui. Praesent eu tincidunt arcu. Ut imperdiet a ligula nec dapibus. Aliquam erat volutpat. Donec auctor elementum accumsan. Vestibulum velit augue, feugiat ac nisl in, pharetra accumsan ligula. Proin nunc mauris, ultrices quis tristique vitae, ornare quis nunc. Aenean ut tincidunt lorem. Maecenas consectetur faucibus velit, nec tincidunt nulla fermentum sed.', 3, 1, 0, '2017-02-20'),
(39, 'appointment', 'assets_web/images/icon_image/2017-05-14/51.png', 'Oncology ', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ipsum magna, gravida nec erat ac, malesuada pharetra felis. Phasellus eu dolor orci. Duis et dictum sem, sit amet sagittis dolor. Curabitur scelerisque, nunc eget viverra malesuada, nunc ligula tincidunt nisi, eget elementum urna magna at dui. Praesent eu tincidunt arcu. Ut imperdiet a ligula nec dapibus. Aliquam erat volutpat. Donec auctor elementum accumsan. Vestibulum velit augue, feugiat ac nisl in, pharetra accumsan ligula. Proin nunc mauris, ultrices quis tristique vitae, ornare quis nunc. Aenean ut tincidunt lorem. Maecenas consectetur faucibus velit, nec tincidunt nulla fermentum sed.', 4, 1, 0, '2017-05-14');

-- --------------------------------------------------------

--
-- Table structure for table `ws_section`
--

CREATE TABLE `ws_section` (
  `id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `description` text,
  `featured_image` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ws_section`
--

INSERT INTO `ws_section` (`id`, `name`, `title`, `description`, `featured_image`) VALUES
(19, 'service', 'Service We Offer', 'Our department & special service ', 'assets_web/images/uploads/2016-11-02/b.jpg'),
(20, 'about', 'About Us', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC.Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature froLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,m 45 BC.Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC.Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC.', 'assets_web/images/uploads/2016-11-05/a1.jpg'),
(23, 'appointment', 'Why Choose Us', 'Our department & special service ', 'assets_web/images/uploads/2016-11-06/d.png'),
(26, 'doctor', 'OUR DOCTOR', 'Our department & special service ', 'assets_web/images/uploads/2016-11-05/d.png'),
(27, 'department', 'DEPARTMENT', 'Our department & special service ', ''),
(28, 'blog', 'Latest Blog', 'Latest topics of the webstie', 'assets_web/images/uploads/2016-11-05/c.png');

-- --------------------------------------------------------

--
-- Table structure for table `ws_setting`
--

CREATE TABLE `ws_setting` (
  `id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `logo` varchar(50) DEFAULT NULL,
  `favicon` varchar(100) DEFAULT NULL,
  `meta_tag` varchar(255) DEFAULT NULL,
  `meta_keyword` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(16) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `copyright_text` varchar(255) DEFAULT NULL,
  `twitter_api` text,
  `google_map` text,
  `facebook` varchar(100) DEFAULT NULL,
  `twitter` varchar(100) DEFAULT NULL,
  `vimeo` varchar(100) DEFAULT NULL,
  `instagram` varchar(100) DEFAULT NULL,
  `dribbble` varchar(100) DEFAULT NULL,
  `skype` varchar(100) DEFAULT NULL,
  `google_plus` varchar(100) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ws_setting`
--

INSERT INTO `ws_setting` (`id`, `title`, `description`, `logo`, `favicon`, `meta_tag`, `meta_keyword`, `email`, `phone`, `address`, `copyright_text`, `twitter_api`, `google_map`, `facebook`, `twitter`, `vimeo`, `instagram`, `dribbble`, `skype`, `google_plus`, `status`) VALUES
(3, 'Hospital', 'your text will appear here', 'assets_web/images/icons/2017-04-13/f.png', 'assets_web/images/icons/2017-04-13/f1.png', 'your text appear  here', 'your text appear  here', 'hospital@hospital.com', '9876543210', '456/B, Street, State,345,COUNtry', 'your text appear  here', '<a class=\"twitter-timeline\" data-lang=\"en\" data-dnt=\"true\" data-link-color=\"#207FDD\" href=\"https://twitter.com/taylorswift13\">Tweets by taylorswift13</a> <script async src=\"//platform.twitter.com/widgets.js\" charset=\"utf-8\"></script>', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d29215.021939977993!2d90.40923229999999!3d23.75173875!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sbn!2sbd!4v1477987829881\" width=\"600\" height=\"450\" frameborder=\"0\" style=\"border:0\" allowfullscreen></iframe>', 'http://facebook.com/', 'http://', 'http://', 'http://', 'http://', 'http://', 'http://', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ws_slider`
--

CREATE TABLE `ws_slider` (
  `id` int(11) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `subtitle` varchar(100) DEFAULT NULL,
  `description` text,
  `image` varchar(100) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ws_slider`
--

INSERT INTO `ws_slider` (`id`, `title`, `subtitle`, `description`, `image`, `position`, `status`) VALUES
(1, 'your text will appear here', 'your text will appear here', '<p>Lorem Ipsum is simply dummy text of the printingLorem Ipsum is simply dummy text of the printing Lorem Ipsum is simply dummy text of the printing Lorem Ipsum is simply dummy text of the printing Lorem Ipsum is simply dummy text of the printing Lorem Ipsum is simply dummy text of the printing</p>', 'assets_web/images/slider/2016-11-03/a2.jpg', 3, 1),
(2, 'your text will appear here', 'your text will appear here', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting</p>', 'assets_web/images/slider/2017-01-16/d1.jpg', 1, 1),
(5, 'your text will appear here', 'your text will appear here', '<p><strong>Lorem Ipsum</strong></p>\r\n<hr />\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,</p>\r\n<ul>\r\n<li>Demo Hospital Limited</li>\r\n<li>&lt;script&gt;alert(2)&lt;/script&gt;</li>\r\n</ul>', 'assets_web/images/slider/2016-11-03/s.jpg', 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `acm_account`
--
ALTER TABLE `acm_account`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `acm_invoice`
--
ALTER TABLE `acm_invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `acm_invoice_details`
--
ALTER TABLE `acm_invoice_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `acm_payment`
--
ALTER TABLE `acm_payment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bm_bed`
--
ALTER TABLE `bm_bed`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bm_bed_assign`
--
ALTER TABLE `bm_bed_assign`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cm_patient`
--
ALTER TABLE `cm_patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cm_status`
--
ALTER TABLE `cm_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`dprt_id`);

--
-- Indexes for table `document`
--
ALTER TABLE `document`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enquiry`
--
ALTER TABLE `enquiry`
  ADD PRIMARY KEY (`enquiry_id`);

--
-- Indexes for table `ha_birth`
--
ALTER TABLE `ha_birth`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ha_category`
--
ALTER TABLE `ha_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ha_death`
--
ALTER TABLE `ha_death`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ha_investigation`
--
ALTER TABLE `ha_investigation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ha_medicine`
--
ALTER TABLE `ha_medicine`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ha_operation`
--
ALTER TABLE `ha_operation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `language`
--
ALTER TABLE `language`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mail_setting`
--
ALTER TABLE `mail_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notice`
--
ALTER TABLE `notice`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pr_case_study`
--
ALTER TABLE `pr_case_study`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pr_insurance`
--
ALTER TABLE `pr_insurance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pr_prescription`
--
ALTER TABLE `pr_prescription`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`schedule_id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`setting_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `ws_comment`
--
ALTER TABLE `ws_comment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ws_item`
--
ALTER TABLE `ws_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ws_section`
--
ALTER TABLE `ws_section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ws_setting`
--
ALTER TABLE `ws_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ws_slider`
--
ALTER TABLE `ws_slider`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `acm_account`
--
ALTER TABLE `acm_account`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `acm_invoice`
--
ALTER TABLE `acm_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `acm_invoice_details`
--
ALTER TABLE `acm_invoice_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `acm_payment`
--
ALTER TABLE `acm_payment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=90;

--
-- AUTO_INCREMENT for table `bm_bed`
--
ALTER TABLE `bm_bed`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `bm_bed_assign`
--
ALTER TABLE `bm_bed_assign`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=289;

--
-- AUTO_INCREMENT for table `cm_patient`
--
ALTER TABLE `cm_patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `cm_status`
--
ALTER TABLE `cm_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `dprt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `document`
--
ALTER TABLE `document`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `enquiry`
--
ALTER TABLE `enquiry`
  MODIFY `enquiry_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `ha_birth`
--
ALTER TABLE `ha_birth`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `ha_category`
--
ALTER TABLE `ha_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `ha_death`
--
ALTER TABLE `ha_death`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `ha_investigation`
--
ALTER TABLE `ha_investigation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `ha_medicine`
--
ALTER TABLE `ha_medicine`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `ha_operation`
--
ALTER TABLE `ha_operation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `language`
--
ALTER TABLE `language`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=425;

--
-- AUTO_INCREMENT for table `mail_setting`
--
ALTER TABLE `mail_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `notice`
--
ALTER TABLE `notice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `pr_case_study`
--
ALTER TABLE `pr_case_study`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `pr_insurance`
--
ALTER TABLE `pr_insurance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pr_prescription`
--
ALTER TABLE `pr_prescription`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `ws_comment`
--
ALTER TABLE `ws_comment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `ws_item`
--
ALTER TABLE `ws_item`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `ws_section`
--
ALTER TABLE `ws_section`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `ws_setting`
--
ALTER TABLE `ws_setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `ws_slider`
--
ALTER TABLE `ws_slider`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
