-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jun 25, 2019 at 06:42 AM
-- Server version: 5.5.27
-- PHP Version: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `hospital`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE IF NOT EXISTS `account` (
  `acc_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Account Id',
  `user_id` int(11) NOT NULL COMMENT 'User Id',
  `transaction_id` varchar(50) NOT NULL COMMENT 'Transaction/Appoinment id/bank Reciept',
  `date` date NOT NULL COMMENT 'Transaction Date',
  `credit` decimal(10,0) NOT NULL COMMENT 'Credit amount',
  `debit` decimal(10,0) NOT NULL COMMENT 'Debit Amount',
  `balance` decimal(20,0) NOT NULL COMMENT 'Remaining Balance',
  `status` tinyint(1) NOT NULL COMMENT 'Status of This Transaction',
  PRIMARY KEY (`acc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`acc_id`, `user_id`, `transaction_id`, `date`, `credit`, `debit`, `balance`, `status`) VALUES
(1, 7, 'AJ3TC768', '2019-05-27', 400, 0, 400, 1);

-- --------------------------------------------------------

--
-- Table structure for table `acm_account`
--

CREATE TABLE IF NOT EXISTS `acm_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` varchar(20) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `acm_account`
--

INSERT INTO `acm_account` (`id`, `name`, `type`, `description`, `date`, `status`) VALUES
(17, 'Cash', '2', 'Cash In Hand', '2019-05-25', 1),
(18, 'Bank', '2', '', '2019-05-25', 1),
(19, 'Doctor 1-Aamir', '1', '', '2019-05-25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `acm_invoice`
--

CREATE TABLE IF NOT EXISTS `acm_invoice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` varchar(20) NOT NULL,
  `total` float NOT NULL,
  `vat` float NOT NULL,
  `discount` float NOT NULL,
  `grand_total` float NOT NULL,
  `paid` float NOT NULL,
  `due` float NOT NULL,
  `created_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `acm_invoice`
--

INSERT INTO `acm_invoice` (`id`, `patient_id`, `total`, `vat`, `discount`, `grand_total`, `paid`, `due`, `created_id`, `date`, `status`) VALUES
(1, 'PSPAM4QD', 340, 17, 6.8, 350.2, 350.2, 0, 2, '2019-06-12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `acm_invoice_details`
--

CREATE TABLE IF NOT EXISTS `acm_invoice_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `quantity` float NOT NULL,
  `price` float NOT NULL,
  `subtotal` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `acm_invoice_details`
--

INSERT INTO `acm_invoice_details` (`id`, `invoice_id`, `account_id`, `description`, `quantity`, `price`, `subtotal`) VALUES
(5, 1, 19, '', 1, 100, 100),
(6, 1, 19, '', 2, 120, 240);

-- --------------------------------------------------------

--
-- Table structure for table `acm_payment`
--

CREATE TABLE IF NOT EXISTS `acm_payment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `account_id` int(11) NOT NULL,
  `pay_to` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `amount` float NOT NULL,
  `created_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `acm_payment`
--

INSERT INTO `acm_payment` (`id`, `account_id`, `pay_to`, `description`, `amount`, `created_id`, `date`, `status`) VALUES
(16, 18, 'Wasi', '', 234, 2, '2019-06-12', 1);

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE IF NOT EXISTS `appointment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `appointment_id` varchar(20) DEFAULT NULL,
  `patient_id` varchar(20) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `schedule_id` int(11) DEFAULT NULL,
  `serial_no` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `amount` int(11) NOT NULL COMMENT 'Consultation Free Patient Has To Pay',
  `problem` varchar(255) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `create_date` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=95 ;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`id`, `appointment_id`, `patient_id`, `department_id`, `doctor_id`, `schedule_id`, `serial_no`, `date`, `amount`, `problem`, `created_by`, `create_date`, `status`) VALUES
(90, 'AS36UETW', 'PF1R8I8T', 25, 37, 29, 1, '2019-05-30', 251, 'Chest Pain', 7, '2019-05-25', 1),
(91, 'ALY9T7CJ', 'PF1R8I8T', 25, 37, 30, 1, '2019-05-25', 251, '', 7, '2019-05-25', 1),
(93, 'ABAV1AB1', 'P3TC768W', 28, 41, 31, 1, '2019-05-27', 500, 'Stress', 7, '2019-05-26', 1),
(94, 'AJ3TC768', 'P3TC768W', 12, 42, 32, 1, '2019-05-28', 400, '', 7, '2019-05-27', 1);

-- --------------------------------------------------------

--
-- Table structure for table `bm_bed`
--

CREATE TABLE IF NOT EXISTS `bm_bed` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `limit` int(3) NOT NULL,
  `charge` float NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

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

CREATE TABLE IF NOT EXISTS `bm_bed_assign` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `serial` varchar(20) DEFAULT NULL,
  `patient_id` varchar(20) NOT NULL,
  `bed_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `assign_date` date NOT NULL,
  `discharge_date` date NOT NULL,
  `assign_by` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=289 ;

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

CREATE TABLE IF NOT EXISTS `cm_patient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` varchar(30) NOT NULL,
  `case_manager_id` int(11) NOT NULL,
  `ref_doctor_id` int(11) DEFAULT NULL,
  `hospital_name` varchar(255) DEFAULT NULL,
  `hospital_address` text,
  `doctor_name` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

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

CREATE TABLE IF NOT EXISTS `cm_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `critical_status` varchar(255) NOT NULL DEFAULT '1',
  `cm_patient_id` int(11) NOT NULL,
  `description` text,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=48 ;

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

CREATE TABLE IF NOT EXISTS `department` (
  `dprt_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`dprt_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

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

CREATE TABLE IF NOT EXISTS `document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` varchar(30) NOT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `description` text,
  `hidden_attach_file` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `upload_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

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

CREATE TABLE IF NOT EXISTS `enquiry` (
  `enquiry_id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `enquiry` text,
  `checked` tinyint(1) DEFAULT NULL,
  `ip_address` varchar(20) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `checked_by` int(11) DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`enquiry_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=66 ;

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
(64, 'test@demo.com', '0123456789', 'Test', 'Need a Doctor for Check-up?\r\nJUST MAKE AN APPOINTMENT & YOU''RE DONE !', 1, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36', 2, '2017-02-27 10:32:02', 1),
(65, 'swift@example.com', '1234567890', 'Swift', 'Need a Doctor for Check-up?\r\nJUST MAKE AN APPOINTMENT & YOU''RE DONE !', 1, '::1', 'Mozilla/5.0 (Windows NT 6.1) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/56.0.2924.87 Safari/537.36', 2, '2017-02-28 11:39:52', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ha_birth`
--

CREATE TABLE IF NOT EXISTS `ha_birth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `patient_id` varchar(30) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `ha_birth`
--

INSERT INTO `ha_birth` (`id`, `title`, `description`, `patient_id`, `doctor_id`, `date`, `status`) VALUES
(1, 'Accident ', 'Insurance companies will try to pay you less than your claim is worth. Don''t let them! Use our free case evaluation to get the true value of your injury case.\r\n\r\nAccidents that commonly result in compensation include:\r\n\r\nCar accident injuries\r\nPedestrian accidents\r\nHit and runs\r\nDrunk driving crashes\r\nDangerous road construction accidents\r\nMotorcycle accidents\r\nCommercial trucking accidents\r\nUninsured motorists\r\nYour case review will be performed by a local car accident attorney. They will provide you an accurate estimate of your claim value and can help you get money for lost wages, personal injuries, medical bills, and pain and suffering.\r\n\r\nThe case evaluation is of no obligation to you. However, even if you do choose to work with a car accident attorney, you pay $0 unless you win! There are no upfront fees.', 'PNYXYXZM', 13, '2017-01-09', 1),
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

CREATE TABLE IF NOT EXISTS `ha_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `description` text,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `ha_category`
--

INSERT INTO `ha_category` (`id`, `name`, `description`, `status`) VALUES
(16, 'F', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ipsum magna, gravida nec erat ac, malesuada pharetra felis. Phasellus eu dolor orci. Duis et dictum sem, sit amet sagittis dolor. Curabitur scelerisque, nunc eget viverra malesuada, nunc ligula tincidunt nisi, eget elementum urna magna at dui. Praesent eu tincidunt arcu. Ut imperdiet a ligula nec dapibus. Aliquam erat volutpat. Donec auctor elementum accumsan. Vestibulum velit augue, feugiat ac nisl in, pharetra accumsan ligula. Proin nunc mauris, ultrices quis tristique vitae, ornare quis nunc. Aenean ut tincidunt lorem. Maecenas consectetur faucibus velit, nec tincidunt nulla fermentum sed.</p>', 1),
(17, 'E', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ipsum magna, gravida nec erat ac, malesuada pharetra felis. Phasellus eu dolor orci. Duis et dictum sem, sit amet sagittis dolor. Curabitur scelerisque, nunc eget viverra malesuada, nunc ligula tincidunt nisi, eget elementum urna magna at dui. Praesent eu tincidunt arcu. Ut imperdiet a ligula nec dapibus. Aliquam erat volutpat. Donec auctor elementum accumsan. Vestibulum velit augue, feugiat ac nisl in, pharetra accumsan ligula. Proin nunc mauris, ultrices quis tristique vitae, ornare quis nunc. Aenean ut tincidunt lorem. Maecenas consectetur faucibus velit, nec tincidunt nulla fermentum sed.</p>', 1),
(18, 'D', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ipsum magna, gravida nec erat ac, malesuada pharetra felis. Phasellus eu dolor orci. Duis et dictum sem, sit amet sagittis dolor. Curabitur scelerisque, nunc eget viverra malesuada, nunc ligula tincidunt nisi, eget elementum urna magna at dui. Praesent eu tincidunt arcu. Ut imperdiet a ligula nec dapibus. Aliquam erat volutpat. Donec auctor elementum accumsan. Vestibulum velit augue, feugiat ac nisl in, pharetra accumsan ligula. Proin nunc mauris, ultrices quis tristique vitae, ornare quis nunc. Aenean ut tincidunt lorem. Maecenas consectetur faucibus velit, nec tincidunt nulla fermentum sed.</p>', 1),
(19, 'C', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ipsum magna, gravida nec erat ac, malesuada pharetra felis. Phasellus eu dolor orci. Duis et dictum sem, sit amet sagittis dolor. Curabitur scelerisque, nunc eget viverra malesuada, nunc ligula tincidunt nisi, eget elementum urna magna at dui. Praesent eu tincidunt arcu. Ut imperdiet a ligula nec dapibus. Aliquam erat volutpat. Donec auctor elementum accumsan. Vestibulum velit augue, feugiat ac nisl in, pharetra accumsan ligula. Proin nunc mauris, ultrices quis tristique vitae, ornare quis nunc. Aenean ut tincidunt lorem. Maecenas consectetur faucibus velit, nec tincidunt nulla fermentum sed.</p>', 1),
(21, 'B', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ipsum magna, gravida nec erat ac, malesuada pharetra felis. Phasellus eu dolor orci. Duis et dictum sem, sit amet sagittis dolor. Curabitur scelerisque, nunc eget viverra malesuada, nunc ligula tincidunt nisi, eget elementum urna magna at dui. Praesent eu tincidunt arcu. Ut imperdiet a ligula nec dapibus. Aliquam erat volutpat. Donec auctor elementum accumsan. Vestibulum velit augue, feugiat ac nisl in, pharetra accumsan ligula. Proin nunc mauris, ultrices quis tristique vitae, ornare quis nunc. Aenean ut tincidunt lorem. Maecenas consectetur faucibus velit, nec tincidunt nulla fermentum sed.</p>', 1),
(22, 'Antibiotic ', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ipsum magna, gravida nec erat ac, malesuada pharetra felis. Phasellus eu dolor orci. Duis et dictum sem, sit amet sagittis dolor. Curabitur scelerisque, nunc eget viverra malesuada, nunc ligula tincidunt nisi, eget elementum urna magna at dui. Praesent eu tincidunt arcu. Ut imperdiet a ligula nec dapibus. Aliquam erat volutpat. Donec auctor elementum accumsan. Vestibulum velit augue, feugiat ac nisl in, pharetra accumsan ligula. Proin nunc mauris, ultrices quis tristique vitae, ornare quis nunc. Aenean ut tincidunt lorem. Maecenas consectetur faucibus velit, nec tincidunt nulla fermentum sed.</p>', 1),
(23, 'G', '<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Integer ipsum magna, gravida nec erat ac, malesuada pharetra felis. Phasellus eu dolor orci. Duis et dictum sem, sit amet sagittis dolor. Curabitur scelerisque, nunc eget viverra malesuada, nunc ligula tincidunt nisi, eget elementum urna magna at dui. Praesent eu tincidunt arcu. Ut imperdiet a ligula nec dapibus. Aliquam erat volutpat. Donec auctor elementum accumsan. Vestibulum velit augue, feugiat ac nisl in, pharetra accumsan ligula. Proin nunc mauris, ultrices quis tristique vitae, ornare quis nunc. Aenean ut tincidunt lorem. Maecenas consectetur faucibus velit, nec tincidunt nulla fermentum sed.</p>', 1),
(25, 'H', '<p>The quick brown fox jumps over the lazy dog</p>', 1),
(27, 'I', '<p>How do I get started with my computer?</p>\r\n<div class="contentContainer">\r\n<h1 class="title">How do I get started with my computer?</h1>\r\n<p class="para">Â </p>\r\n<p class="para">Getting Started contains a list of tasks you might want to perform when you set up your computer. Tasks in Getting Started include:</p>\r\n<ul class="unordered">\r\n<li class="listItem">\r\n<p class="para">Transferring files from another computer</p>\r\n</li>\r\n<li class="listItem">\r\n<p class="para">Adding new users to your computer</p>\r\n</li>\r\n<li class="listItem">\r\n<p class="para">Backing up your files</p>\r\n</li>\r\n<li class="listItem">\r\n<p class="para">Personalizing <span class="notLocalizable">Windows</span></p>\r\n</li>\r\n</ul>\r\n</div>\r\n<p>Â </p>', 1),
(28, 'J', '', 1),
(29, 'H', '<p>abc</p>', 1),
(30, 'K', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ha_death`
--

CREATE TABLE IF NOT EXISTS `ha_death` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `patient_id` varchar(30) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `ha_death`
--

INSERT INTO `ha_death` (`id`, `title`, `description`, `patient_id`, `doctor_id`, `date`, `status`) VALUES
(1, 'Accident', 'Insurance companies will try to pay you less than your claim is worth. Don''t let them! Use our free case evaluation to get the true value of your injury case.\r\n\r\nAccidents that commonly result in compensation include:\r\n\r\nCar accident injuries\r\nPedestrian accidents\r\nHit and runs\r\nDrunk driving crashes\r\nDangerous road construction accidents\r\nMotorcycle accidents\r\nCommercial trucking accidents\r\nUninsured motorists\r\nYour case review will be performed by a local car accident attorney. They will provide you an accurate estimate of your claim value and can help you get money for lost wages, personal injuries, medical bills, and pain and suffering.\r\n\r\nThe case evaluation is of no obligation to you. However, even if you do choose to work with a car accident attorney, you pay $0 unless you win! There are no upfront fees.', 'PNYXYXZM', 0, '2017-01-09', 1),
(2, 'Test', 'HELLO', 'PNYXYXZM', 0, '2017-02-01', 1),
(3, 'TEST', '', '12213', 1, '2017-02-23', 1),
(4, 'death reprot', '', 'P72P7031', 0, '2018-03-07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ha_investigation`
--

CREATE TABLE IF NOT EXISTS `ha_investigation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `patient_id` varchar(30) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `ha_investigation`
--

INSERT INTO `ha_investigation` (`id`, `title`, `description`, `patient_id`, `doctor_id`, `picture`, `date`, `status`) VALUES
(11, 'RBC Repots', 'Normal \r\nBlood Count Is OK.', '1234', 37, '', '2019-05-25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ha_medicine`
--

CREATE TABLE IF NOT EXISTS `ha_medicine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `batchNo` varchar(30) NOT NULL COMMENT 'Medicine Batch No',
  `expiry_date` date NOT NULL COMMENT 'Expiry Date Of Medicine',
  `manufac_date` date NOT NULL COMMENT 'Manufacturing Date Of Medicine',
  `unit` int(11) NOT NULL COMMENT 'Unit Type 1 For Bottle 2 For Strip',
  `tabletsPerStrip` int(11) NOT NULL COMMENT 'If Strip Unit Type Then Tablets Per Strip',
  `quantity` double NOT NULL COMMENT 'Quantity',
  `total_quantity` int(11) NOT NULL COMMENT 'Total Bottels or Tablets',
  `mrp` int(11) NOT NULL COMMENT 'MRP Selling Price',
  `purchaseValue` int(11) NOT NULL COMMENT 'Purchase Value Buying Price',
  `manufactured_by` varchar(255) NOT NULL,
  `taxPercentage` int(11) NOT NULL COMMENT 'Tax Percentage',
  `create_date` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=20 ;

--
-- Dumping data for table `ha_medicine`
--

INSERT INTO `ha_medicine` (`id`, `name`, `category_id`, `batchNo`, `expiry_date`, `manufac_date`, `unit`, `tabletsPerStrip`, `quantity`, `total_quantity`, `mrp`, `purchaseValue`, `manufactured_by`, `taxPercentage`, `create_date`, `status`) VALUES
(1, 'General Surgery', 22, '1234', '2019-06-08', '2019-06-02', 1, 1, 4, 4, 200, 180, 'Square', 5, '2019-06-18', 1),
(2, 'General Surgery', 19, '4565', '2019-06-08', '2019-06-02', 2, 6, 20, 120, 100, 80, 'Square', 5, '2019-06-18', 1),
(3, 'General Surgery', 23, '1234', '2019-06-09', '2019-06-02', 1, 1, 112, 102, 230, 200, 'Square', 5, '2019-06-18', 1),
(4, 'Paracetamol', 30, '1234', '2019-06-19', '2019-05-01', 2, 10, 73, 1500, 50, 40, 'Paramount', 5, '2019-06-18', 1),
(5, 'Neosorb', 22, 'BE014', '2019-04-01', '2017-05-01', 1, 1, 10, 10, 48, 40, 'Biological E. Limited', 5, '2019-06-18', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ha_operation`
--

CREATE TABLE IF NOT EXISTS `ha_operation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `patient_id` varchar(30) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `ha_operation`
--

INSERT INTO `ha_operation` (`id`, `title`, `description`, `patient_id`, `doctor_id`, `date`, `status`) VALUES
(1, 'RWA', 'Insurance companies will try to pay you less than your claim is worth. Don''t let them! Use our free case evaluation to get the true value of your injury case.\r\n\r\nAccidents that commonly result in compensation include:\r\n\r\nCar accident injuries\r\nPedestrian accidents\r\nHit and runs\r\nDrunk driving crashes\r\nDangerous road construction accidents\r\nMotorcycle accidents\r\nCommercial trucking accidents\r\nUninsured motorists\r\nYour case review will be performed by a local car accident attorney. They will provide you an accurate estimate of your claim value and can help you get money for lost wages, personal injuries, medical bills, and pain and suffering.\r\n\r\nThe case evaluation is of no obligation to you. However, even if you do choose to work with a car accident attorney, you pay $0 unless you win! There are no upfront fees. innovative', 'PNYXYXZM', 13, '2017-01-09', 1),
(2, 'asdf', '', '12213', 1, '2017-02-23', 1),
(3, 'op report', 'cancer surgery', 'P72P7031', 17, '2018-03-08', 1),
(4, 'birth report', '', 'P72P7031', 1, '2018-03-08', 1);

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

CREATE TABLE IF NOT EXISTS `language` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `phrase` text NOT NULL,
  `english` text,
  `hindi` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=463 ;

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
(242, 'just_make_an_appointment_and_you_are_done', 'JUST MAKE AN APPOINTMENT & YOU''RE DONE ! ', ''),
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
(424, 'prescription_information', 'Prescription Information', ''),
(425, 'stock', 'Stock', NULL),
(426, 'stock_list', 'Stock List', NULL),
(427, 'consultation_fee', 'Consultation Fee', NULL),
(429, 'doctor_cons_fee', 'Consultation Fee', NULL),
(430, 'amount', 'Amount', NULL),
(431, 'paid', 'Paid', NULL),
(432, 'balance', 'Balance', NULL),
(433, 'account', 'Account', NULL),
(434, 'add_transaction', 'Add Transaction', NULL),
(435, 'unit', 'Unit', NULL),
(436, 'strip', 'Strip', NULL),
(437, 'bottle', 'Bottle', NULL),
(438, 'batchNo', 'Batch No', NULL),
(439, 'expiry_date', 'Expiry Date', NULL),
(440, 'manufac_date', 'Manufacturing Date ', NULL),
(441, 'mrp', 'MRP', NULL),
(442, 'purchaseValue', 'Purchase Value', NULL),
(443, 'quantity', 'Quantity', NULL),
(444, 'tabletsPerStrip', 'Tablets Per Strip', NULL),
(445, 'taxPercentage', 'Tax Percentage', NULL),
(446, 'sale', 'Sale', NULL),
(447, 'purchase', 'Purchase', NULL),
(448, 'cash', 'Cash', NULL),
(449, 'cashType', 'Cash/Credit', NULL),
(450, 'billNo', 'Bill No', NULL),
(451, 'itemName', 'Item Name', NULL),
(452, 'netValue', 'Net Value', NULL),
(453, 'purchase_list', 'Purchase List', NULL),
(454, 'addPurchase', 'Add Purchase', NULL),
(455, 'add_supplier', 'Add Supplier', NULL),
(456, 'list_supplier', 'Supplier List', NULL),
(457, 'list_sale', 'Sale List', NULL),
(458, 'company', 'Company', NULL),
(459, 'update_supplier', 'Update Supplier', NULL),
(460, 'select_supplier', 'Select Supplier', NULL),
(461, 'supplier', 'Supplier', NULL),
(462, 'cash_credit', 'Cash/Credit', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `mail_setting`
--

CREATE TABLE IF NOT EXISTS `mail_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `protocol` varchar(20) NOT NULL,
  `mailpath` varchar(255) NOT NULL,
  `mailtype` varchar(20) NOT NULL,
  `validate_email` varchar(20) NOT NULL,
  `wordwrap` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `mail_setting`
--

INSERT INTO `mail_setting` (`id`, `protocol`, `mailpath`, `mailtype`, `validate_email`, `wordwrap`) VALUES
(5, 'sendmail', '/usr/sbin/sendmail', 'html', 'false', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE IF NOT EXISTS `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sender_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `datetime` datetime NOT NULL,
  `sender_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=unseen, 1=seen, 2=delete',
  `receiver_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '0=unseen, 1=seen, 2=delete',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=55 ;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `sender_id`, `receiver_id`, `subject`, `message`, `datetime`, `sender_status`, `receiver_status`) VALUES
(1, 2, 1, 'TEST', '<p>Â TEST</p>', '2017-02-07 00:00:00', 2, 2),
(3, 26, 3, 'TEST', '<p>receiver_id<strong></strong></p>', '2017-02-07 00:00:00', 0, 0),
(10, 2, 17, 'TEST', '<p>bbjkjhjh</p>', '2017-02-07 11:34:41', 0, 0),
(11, 2, 14, 'Google Search Google or type URL Say "Ok Google" Voice search has been turned off. Details ', '<div id="lga" class=""><img id="hplogo" title="Google" src="https://www.google.com/images/branding/googlelogo/2x/googlelogo_color_272x92dp.png" alt="Google" width="272" height="92">\r\n<div id="logo-sub">Â </div>\r\n</div>\r\n&lt;form id="f" action="https://www.google.com/search" method="get"&gt;\r\n<div id="hf">Â </div>\r\n<div id="fkbx" class="">\r\n<div id="fkbx-text">Search Google or type URL</div>\r\n&lt;input id="q" tabindex="-1" autocomplete="off" name="q" type="url" /&gt;\r\n<div id="fkbx-spch" tabindex="0">Â </div>\r\n</div>\r\n&lt;/form&gt;\r\n<div id="spch" class="spch s2fp">Â </div>\r\n<div id="most-visited" class="mv-hide">Â </div>', '2017-02-07 12:31:34', 0, 0),
(12, 17, 2, 'TEST', '<p>bbjkjhjh</p>', '2017-02-07 11:34:41', 0, 1),
(13, 26, 2, 'TEST', '<p>receiver_id<strong></strong></p>', '2017-02-07 00:00:00', 0, 1),
(14, 1, 2, 'HELLO ', 'What is Lorem Ipsum?\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '2017-02-08 06:12:13', 0, 1),
(15, 1, 2, 'What is Lorem Ipsum?', '<div>\r\n<h2>What is Lorem Ipsum?</h2>\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n</div>\r\n<div>\r\n<h2>Why do we use it?</h2>\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n</div>\r\n<p>Â </p>\r\n<div>\r\n<h2>Where does it come from?</h2>\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>\r\n<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>\r\n</div>', '2017-02-08 07:34:28', 1, 1),
(16, 2, 1, 'Lorem Ipsum', '<h1>Lorem Ipsum</h1>\r\n<h4>"Neque porro quisquam est qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit..."</h4>\r\n<h5>"There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain..."</h5>\r\n<hr>\r\n<div id="Content">\r\n<div id="Panes">\r\n<div>\r\n<h2>What is Lorem Ipsum?</h2>\r\n<p><strong>Lorem Ipsum</strong> is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>\r\n</div>\r\n<div>\r\n<h2>Why do we use it?</h2>\r\n<p>It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).</p>\r\n</div>\r\n<br>\r\n<div>\r\n<h2>Where does it come from?</h2>\r\n<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.</p>\r\n<p>The standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.</p>\r\n</div>\r\n<div>\r\n<h2>Where can I get some?</h2>\r\n<p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don''t look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn''t anything embarrassing hidden in the middle of text. All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable. The generated Lorem Ipsum is therefore always free from repetition, injected humour, or non-characteristic words etc.</p>\r\n</div>\r\n</div>\r\n</div>', '2017-02-08 07:36:12', 1, 1),
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
(45, 30, 2, 'TEST', '<p>HELLO</p>', '2017-04-23 08:23:01', 1, 1),
(46, 2, 30, 'TEST', '<p>TEST</p>', '2017-04-23 10:52:10', 0, 1),
(47, 2, 30, 'TEST Again', '<p>TEST Again</p>', '2017-04-23 10:52:22', 0, 1),
(48, 30, 2, 'TEST3', '<p>TEST</p>', '2017-04-23 10:55:23', 0, 2),
(49, 2, 32, 'hii', '<p>ER</p>', '2018-03-08 08:52:39', 1, 0),
(50, 19, 32, 'hii', '<p>hii</p>', '2018-03-08 10:31:45', 1, 0),
(51, 24, 17, 'testing', '<p>testing</p>', '2018-03-08 10:35:35', 1, 0),
(52, 1, 8, 'offer latter', '<p>dgfdgfdg dfgdf</p>', '2018-05-17 12:12:38', 1, 0),
(53, 7, 37, 'Hello', '<p>bfgbfgbfgbf ffgbffb   f f fg d f dfgbfbfg d</p>', '2019-05-22 09:34:21', 1, 0),
(54, 24, 27, 'Help', '<p>Help Me Plaese</p>', '2019-05-27 11:25:31', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `notice`
--

CREATE TABLE IF NOT EXISTS `notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `assign_by` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `notice`
--

INSERT INTO `notice` (`id`, `title`, `description`, `start_date`, `end_date`, `assign_by`, `status`) VALUES
(11, 'New System Is Developed- Sopora PolyClicnic Website', '<p>We Are Digitalizing our Clicnic.</p>\r\n<p>Now Everything Will Be Recorded and Processed.</p>\r\n<p> </p>', '2019-05-22', '2019-06-30', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE IF NOT EXISTS `patient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=52 ;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`id`, `patient_id`, `firstname`, `lastname`, `email`, `password`, `phone`, `mobile`, `address`, `sex`, `blood_group`, `date_of_birth`, `affliate`, `picture`, `created_by`, `create_date`, `status`) VALUES
(48, 'PSPAM4QD', 'Sajid', 'Bhat', NULL, 'd41d8cd98f00b204e9800998ecf8427e', NULL, '9906123456', 'Safapora', 'Male', NULL, '2019-05-26', NULL, NULL, 2, '2019-05-26', 1),
(49, 'PN53V0HJ', 'Wasi', 'Bhat', NULL, 'd41d8cd98f00b204e9800998ecf8427e', NULL, '9990009909', 'Ganderbal', 'Male', NULL, '1970-01-01', NULL, NULL, 2, '2019-05-26', 1),
(51, 'P3TC768W', 'Khalid', 'Ahanger', NULL, 'd41d8cd98f00b204e9800998ecf8427e', NULL, '9876543210', 'Safapora', 'Male', NULL, '1970-01-01', NULL, NULL, 2, '2019-05-26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `pr_case_study`
--

CREATE TABLE IF NOT EXISTS `pr_case_study` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
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
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

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

CREATE TABLE IF NOT EXISTS `pr_insurance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

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

CREATE TABLE IF NOT EXISTS `pr_prescription` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
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
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `pr_prescription`
--

INSERT INTO `pr_prescription` (`id`, `appointment_id`, `patient_id`, `patient_type`, `doctor_id`, `chief_complain`, `insurance_id`, `weight`, `blood_pressure`, `medicine`, `diagnosis`, `visiting_fees`, `patient_notes`, `reference_by`, `reference_to`, `date`) VALUES
(1, 'PRK4YUVG', 'P1RNKS9W', 'New', 2, 'TEST', 0, '100', '100', '[{"name":"Acetaminophen","type":"","instruction":"Test Instruction ","days":""}]', '[{"name":"TE2","instruction":"TESt"},{"name":"TES@","instruction":"erwersd"},{"name":"asdfsdaf","instruction":"asdfsadf"}]', 2500, 'TEST', '', '0', '2017-06-15'),
(2, 'P1XWEV6W', 'P1XWEV6W', 'Old', 1, 'TEST', 0, '100', '100', '[{"name":"Naproxen","type":"Tab","instruction":"Test Instruction","days":"3"},{"name":"Ciprofloxacin","type":"Tab","instruction":"Test Instruction","days":"4"},{"name":"Amoxicillin","type":"Tab","instruction":"Test Instruction","days":"5"}]', '[{"name":"X-Rays","instruction":"Test Instruction"},{"name":"Test","instruction":"Test Instruction"}]', 2000, 'Test Notes', '', '0', '2017-06-17'),
(5, 'PRQN4V6Y', 'P1RNKS9W', 'Old', 1, 'Where does it come from?\r\nContrary to popular belief, Lorem Ipsum is not simply random text. \r\nIt has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. ', 1, '100', '50', '[{"name":"Naproxen","type":"TAB","instruction":"TEST","days":"2"},{"name":"Amoxicillin","type":"TAB","instruction":"","days":"3"},{"name":"Amoxicillin","type":"TAB","instruction":"","days":"3"},{"name":"Banana","type":"TAB","instruction":"","days":"3"},{"name":"Coconut","type":"Cap","instruction":"","days":"3"},{"name":"Melon","type":"Cap","instruction":"","days":"3"}]', '[{"name":"TEST","instruction":"TEST"},{"name":"TEST","instruction":"asdfsdaf"},{"name":"TEST AGAin","instruction":"Dsafasdf"}]', 222, 'Where does it come from? Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. ', '', '0', '2017-07-02'),
(6, 'PRG6PTKT', 'P1RNKS9W', 'New', 1, 'How would I go about removing a number of years from the date that piece of code gives me? ... For your situation you could take advantage of PHP''s implicit type casting and simply use .... 1 hour ago - Sterling Archer ...', 5, '100', '10', '[{"name":"Apple","type":"Tab","instruction":"Test1","days":"1"},{"name":"Mango","type":"Cap","instruction":"Test2","days":"2"},{"name":"Orange","type":"Cap","instruction":"Test2","days":"2"},{"name":"Coconut","type":"Cap","instruction":"Test2","days":"2"},{"name":"Grape","type":"Liq","instruction":"T","days":"1"}]', '[{"name":"X Rays","instruction":"Test "},{"name":"ORM","instruction":"Test "}]', 100, 'How would I go about removing a number of years from the date that piece of code gives me? ... For your situation you could take advantage of PHP''s implicit type casting and simply use .... 1 hour ago - Sterling Archer ...', '', '0', '2017-07-02'),
(7, 'PRMJ2GRO', 'P1RNKS9W', 'New', 12, 'TSET', 1, '100', '10', '[{"name":"Apple","type":"Tab","instruction":"","days":"2"},{"name":"Banana","type":"TAB","instruction":"","days":"4"},{"name":"Test","type":"CAP","instruction":"","days":"3"}]', '[{"name":"X RAYS","instruction":"TEST"},{"name":"XSFS","instruction":"TEST"}]', 2000, 'TEST', 'No', NULL, '2017-06-20'),
(8, 'PR3TC768', 'P1XWEV6W', 'New', 12, 'TEST', 0, '100', '10', '[{"name":"Apple","type":"Tab","instruction":"Test","days":"3"},{"name":"Banana","type":"Tab","instruction":"Test","days":"3"},{"name":"Lychee","type":"Cap","instruction":"Test","days":"3"},{"name":"Grape","type":"Tab","instruction":"Test","days":"3"}]', '[{"name":"X Rays","instruction":"Test"},{"name":"Gebe","instruction":"Test"}]', 2000, 'TEST', 'No', NULL, '2017-06-20'),
(9, 'AL4WVCVD', 'PPPZJP52', 'New', 1, 'TEST', 0, '100', '', '[{"name":"General Surgery","type":"","instruction":"","days":""},{"name":"New","type":"","instruction":"","days":""}]', '[{"name":"","instruction":""}]', 0, '', '', NULL, '2017-07-02'),
(10, 'ARUMVG9X', 'P43O0999', 'New', 1, 'TEST', 0, '100', '', '[{"name":"TEST","type":"","instruction":"","days":""}]', '[{"name":"","instruction":""}]', 0, '', '', NULL, '2017-07-02'),
(11, 'AK6VLKQ1', 'PYRT7ZOS', 'New', 1, 'TEST', 0, '80', '', '[{"name":"General Surgery","type":"","instruction":"","days":""}]', '[{"name":"TEST","instruction":""}]', 0, '', '', NULL, '2017-07-02'),
(12, 'AZ0YMNYW', 'PNR6B7EY', 'New', 1, 'TEST', 0, '58', '', '[{"name":"Test","type":"","instruction":"","days":""}]', '[{"name":"","instruction":""}]', 2000, '', '', NULL, '2017-07-03'),
(13, 'A3QY7FDW', 'PF1R8I8T', 'New', 15, 'chest problem', 0, '50', '50', '[{"name":"paracetamol","type":"ss","instruction":"ss","days":"7"}]', '[{"name":"CBC","instruction":"dddd"}]', 250, 'test', 'dr asihq', NULL, '2019-05-21');

-- --------------------------------------------------------

--
-- Table structure for table `purchase`
--

CREATE TABLE IF NOT EXISTS `purchase` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `item_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `cash_credit` tinyint(4) NOT NULL COMMENT '1=Cash 2= Credit',
  `amount` bigint(20) NOT NULL,
  `discount` int(11) NOT NULL,
  `netValue` int(11) NOT NULL,
  `date` date NOT NULL,
  `billno` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `existing_quantity_input` int(11) NOT NULL,
  `create_date` date NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Dumping data for table `purchase`
--

INSERT INTO `purchase` (`id`, `user_id`, `item_id`, `supplier_id`, `cash_credit`, `amount`, `discount`, `netValue`, `date`, `billno`, `quantity`, `existing_quantity_input`, `create_date`, `status`) VALUES
(8, 24, 4, 6, 2, 0, 10, 490, '2019-06-20', 1452, 10, 63, '2019-06-20', 1),
(9, 24, 3, 5, 2, 0, 0, 2300, '2019-06-21', 1234, 10, 102, '2019-06-21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE IF NOT EXISTS `schedule` (
  `schedule_id` int(11) NOT NULL AUTO_INCREMENT,
  `doctor_id` int(11) DEFAULT NULL,
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `available_days` varchar(50) DEFAULT NULL,
  `per_patient_time` time DEFAULT NULL,
  `serial_visibility_type` tinyint(4) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`schedule_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`schedule_id`, `doctor_id`, `start_time`, `end_time`, `available_days`, `per_patient_time`, `serial_visibility_type`, `status`) VALUES
(31, 41, '09:00:00', '16:00:00', 'Monday', '00:10:00', 1, 1),
(32, 42, '09:00:00', '16:00:00', 'Tuesday', '00:10:00', 1, 1),
(33, 38, '09:00:00', '16:00:00', 'Wednesday', '00:05:00', 1, 1),
(34, 40, '09:00:00', '16:00:00', 'Thursday', '00:10:00', 1, 1),
(35, 43, '09:00:00', '16:00:00', 'Friday', '00:10:00', 1, 1),
(36, 37, '09:00:00', '16:00:00', 'Saturday', '00:05:00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE IF NOT EXISTS `setting` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `description` text,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `logo` varchar(50) DEFAULT NULL,
  `favicon` varchar(100) DEFAULT NULL,
  `language` varchar(100) DEFAULT NULL,
  `site_align` varchar(50) DEFAULT NULL,
  `footer_text` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`setting_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`setting_id`, `title`, `description`, `email`, `phone`, `logo`, `favicon`, `language`, `site_align`, `footer_text`) VALUES
(2, 'Sopora Polyclicnic', 'New Coloney Sopora', 'hospital@gmail.com', '1234567890', 'assets/images/apps/2017-01-14/H.png', 'assets/images/icons/2017-02-18/f.ico', 'english', 'LTR', '2019©Copyright JKED');

-- --------------------------------------------------------

--
-- Table structure for table `supplier`
--

CREATE TABLE IF NOT EXISTS `supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Supplier Id',
  `name` varchar(50) NOT NULL COMMENT 'Supplier Name',
  `address` varchar(200) NOT NULL COMMENT 'Supplier Address',
  `phone` bigint(20) NOT NULL COMMENT 'Phone No',
  `company` varchar(100) NOT NULL,
  `create_date` date NOT NULL COMMENT 'Supplier Date Created',
  `type` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `supplier`
--

INSERT INTO `supplier` (`id`, `name`, `address`, `phone`, `company`, `create_date`, `type`, `status`) VALUES
(5, 'Wasi', 'Ganderbal', 9906895623, 'WasiCompany', '2019-06-17', 0, 1),
(6, 'Irfan', 'Safapora', 9797410440, 'SimahCompany', '2019-06-17', 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `transaction`
--

CREATE TABLE IF NOT EXISTS `transaction` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `supplier_id` int(11) NOT NULL,
  `cash_credit` int(11) NOT NULL,
  `amount` bigint(20) NOT NULL,
  `created_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `transaction`
--

INSERT INTO `transaction` (`id`, `user_id`, `supplier_id`, `cash_credit`, `amount`, `created_date`) VALUES
(1, 24, 6, 2, 490, '2019-06-20'),
(2, 24, 5, 2, 2300, '2019-06-21');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `consfee` int(11) NOT NULL COMMENT 'Doctors Consultation Fee',
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
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `firstname`, `lastname`, `email`, `password`, `user_role`, `designation`, `department_id`, `address`, `phone`, `mobile`, `consfee`, `short_biography`, `picture`, `specialist`, `date_of_birth`, `sex`, `blood_group`, `degree`, `created_by`, `create_date`, `update_date`, `status`) VALUES
(2, 'Dr Manzoorr', 'Sopori', 'admin@demo.com', '827ccb0eea8a706c4c34a16891f84e7b', 1, NULL, NULL, '98 Green Road, Farmgate, Dhaka-1215', NULL, '1922296392', 0, NULL, 'assets/images/doctor/2019-06-05/S1.png', NULL, '1970-01-01', 'Male', NULL, NULL, 2, '2019-06-05', NULL, 1),
(7, 'Anayat', 'Quarashee', 'receptionist@demo.com', '827ccb0eea8a706c4c34a16891f84e7b', 7, NULL, NULL, 'Ganderbal', NULL, '9797069554', 0, NULL, 'assets/images/human_resources/2017-02-01/H.jpg', NULL, '1970-01-01', 'Male', NULL, NULL, 2, '2019-05-25', NULL, 1),
(8, 'Ashik', 'Islam', 'representative@demo.com', '827ccb0eea8a706c4c34a16891f84e7b', 8, NULL, NULL, 'Dhaka, Bangladesh', NULL, '0123456789', 0, NULL, 'assets/images/human_resources/2017-02-04/d1.jpg', NULL, '1970-01-01', 'Male', NULL, NULL, 8, '2017-03-16', NULL, 1),
(19, 'Ahmed', 'Ziniya', 'laboratorist@demo.com', '827ccb0eea8a706c4c34a16891f84e7b', 4, NULL, NULL, '231,East Patalipur,Sonamuri', NULL, '+0111133445782', 0, NULL, 'assets/images/representative/2017-01-16/p3.png', NULL, '1970-01-01', 'Male', NULL, NULL, 19, '2017-03-16', NULL, 1),
(24, 'Meshu', 'Munawar', 'pharmacist@demo.com', '827ccb0eea8a706c4c34a16891f84e7b', 6, NULL, NULL, 'Dhaka', NULL, '018211555555', 0, NULL, 'assets/images/human_resources/2017-02-01/i1.jpg', NULL, '1970-01-01', 'Male', NULL, NULL, 24, '2017-03-16', NULL, 1),
(27, 'Tuhin', 'Sorkar', 'accountant@demo.com', '827ccb0eea8a706c4c34a16891f84e7b', 3, NULL, NULL, 'TEST', NULL, '018211555555', 0, NULL, 'assets/images/human_resources/2017-02-01/i2.jpg', NULL, '1970-01-01', 'Male', NULL, NULL, 27, '2017-03-16', NULL, 1),
(29, 'Bay', 'Smith', 'nurse@demo.com', '827ccb0eea8a706c4c34a16891f84e7b', 5, NULL, NULL, 'Dhaka, Bangladesh', NULL, '018211555555', 0, NULL, 'assets/images/human_resources/2017-02-01/d.jpg', NULL, '1970-01-01', 'Male', NULL, NULL, 29, '2017-03-16', NULL, 1),
(30, 'Tuhin', 'Abdullah', 'case@demo.com', '827ccb0eea8a706c4c34a16891f84e7b', 9, NULL, NULL, 'TEST', NULL, '0123456788', 0, NULL, '', NULL, '1970-01-01', 'Male', NULL, NULL, 30, '2017-04-23', NULL, 1),
(31, 'John', 'Doe', 'case2@demo.com', '827ccb0eea8a706c4c34a16891f84e7b', 9, NULL, NULL, 'India', NULL, '0123459689', 0, NULL, '', NULL, NULL, 'Male', NULL, NULL, 2, '2017-04-23', NULL, 1),
(33, 'vaishali', 'dongre', 'v@demo.com', 'c83ffd5f4c0e41a79f9c1c9809296dae', 5, NULL, NULL, 'cidco', NULL, '9765116652', 0, NULL, '', NULL, NULL, 'Female', NULL, NULL, 2, '2018-03-08', NULL, 1),
(34, 'Sunita', 'Kakkar', 'sunita@demo.com', '270bc4393030fbfb947e9ec35b9c82e1', 4, NULL, NULL, 'Srinagar', NULL, '987611552', 0, NULL, '', NULL, NULL, 'Female', NULL, NULL, 2, '2019-05-25', NULL, 1),
(35, 'sadhna', 'roy', 'sadhna@gmail.com', '34e1115126bfd6b2796e7d0641a87d2a', 6, NULL, NULL, '36 Guruprasad laxminagar garkheda near sutgirni chowk Aurangabad Maharashtra', NULL, '9923599652', 0, NULL, '', NULL, NULL, 'Female', NULL, NULL, 2, '2018-03-09', NULL, 1),
(37, 'Dr. Aamir', 'Bashir', 'clan@gmail.com', '25f9e794323b453885f5181f1b624d0b', 2, 'MBBS, MD', 25, 'Safapora', '9906832154', '9906832154', 251, '', 'assets/images/doctor/2019-05-25/a.png', 'Heart', '1993-10-04', 'Male', 'O+', '', 2, '2019-05-26', NULL, 1),
(38, 'Dr. Manzoor', 'Sopora', 'drmanzoor@gmail.com', 'd3166b45b32aff8c4ff6a1d2094588b9', 2, 'MBBS, MD, MAAS', 14, 'Sopora', '9906455678', '9906455678', 200, '', 'assets/images/doctor/2019-05-26/a.jpg', 'ENT ', '1982-05-26', 'Male', 'O-', '', 2, '2019-05-26', NULL, 1),
(40, 'Dr. Sajid', 'Illahi', 'sajid1@doctor.com', '25c3b454e2197249971a4098cace4ed8', 2, 'MBBS', 15, 'Safapora', '9906123789', '9906123789', 300, '', 'assets/images/doctor/2019-05-26/21.jpg', 'Gestrologist', '1994-03-01', 'Male', 'A-', '', 2, '2019-05-26', NULL, 1),
(41, 'Dr. Aabid', 'Sofi', 'aabid@doctor.com', '6c5c238311b71755597ce1b6118c55dc', 2, 'MBBS', 28, 'Safapora', '9874563212', '9874563212', 500, '', 'assets/images/doctor/2019-05-26/g.jpg', 'Psychologist', '1991-03-01', 'Male', 'O+', '', 2, '2019-05-26', NULL, 1),
(42, 'Dr. Asif', 'Wani', 'asif@doctor.com', 'ce0b996aa0b7d64169a4b8ffeaf878c5', 2, 'MBBS', 12, 'Hakabara', '987654321', '987654321', 400, '', 'assets/images/doctor/2019-05-26/P.jpg', 'Stomac', '1992-06-01', 'Male', 'A-', '', 2, '2019-05-26', NULL, 1),
(43, 'Dr. Aasiya', 'Rashe', 'aasiya@doctor.com', 'ae3d1dd9971d956167b4a732d476636c', 2, 'MBBS,MD', 13, 'Safapora', '987535195', '987535195', 150, '', 'assets/images/doctor/2019-05-26/r.png', 'Mind', '1991-08-02', 'Female', 'B+', '', 2, '2019-05-26', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `ws_comment`
--

CREATE TABLE IF NOT EXISTS `ws_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `comment` text NOT NULL,
  `date` datetime NOT NULL,
  `add_to_website` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=66 ;

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

CREATE TABLE IF NOT EXISTS `ws_item` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `icon_image` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` text,
  `position` int(2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `counter` int(11) NOT NULL DEFAULT '0',
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=40 ;

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

CREATE TABLE IF NOT EXISTS `ws_section` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `description` text,
  `featured_image` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `ws_section`
--

INSERT INTO `ws_section` (`id`, `name`, `title`, `description`, `featured_image`) VALUES
(19, 'service', 'Service We Offer', 'Our department & special service ', 'assets_web/images/uploads/2016-11-02/b.jpg'),
(20, 'about', 'About Us', 'Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC.Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature froLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,m 45 BC.Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC.Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC.', 'assets_web/images/uploads/2016-11-05/a1.jpg'),
(23, 'appointment', 'Why Choose Us', 'Our department & special service ', 'assets_web/images/uploads/2016-11-06/d.png'),
(26, 'doctor', 'OUR DOCTOR', 'Our department & special service ', 'assets_web/images/uploads/2016-11-05/d.png'),
(27, 'department', 'DEPARTMENT', 'Our department & special service ', ''),
(28, 'blog', 'Latest Blog', 'Latest topics of the webstie', 'assets_web/images/uploads/2016-11-05/c.png');

-- --------------------------------------------------------

--
-- Table structure for table `ws_setting`
--

CREATE TABLE IF NOT EXISTS `ws_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
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
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `ws_setting`
--

INSERT INTO `ws_setting` (`id`, `title`, `description`, `logo`, `favicon`, `meta_tag`, `meta_keyword`, `email`, `phone`, `address`, `copyright_text`, `twitter_api`, `google_map`, `facebook`, `twitter`, `vimeo`, `instagram`, `dribbble`, `skype`, `google_plus`, `status`) VALUES
(3, 'Hospital', 'your text will appear here', 'assets_web/images/icons/2017-04-13/f.png', 'assets_web/images/icons/2017-04-13/f1.png', 'your text appear  here', 'your text appear  here', 'hospital@hospital.com', '9876543210', '456/B, Street, State,345,COUNtry', 'your text appear  here', '<a class="twitter-timeline" data-lang="en" data-dnt="true" data-link-color="#207FDD" href="https://twitter.com/taylorswift13">Tweets by taylorswift13</a> <script async src="//platform.twitter.com/widgets.js" charset="utf-8"></script>', '<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d29215.021939977993!2d90.40923229999999!3d23.75173875!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sbn!2sbd!4v1477987829881" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>', 'http://facebook.com/', 'http://', 'http://', 'http://', 'http://', 'http://', 'http://', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ws_slider`
--

CREATE TABLE IF NOT EXISTS `ws_slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `subtitle` varchar(100) DEFAULT NULL,
  `description` text,
  `image` varchar(100) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `ws_slider`
--

INSERT INTO `ws_slider` (`id`, `title`, `subtitle`, `description`, `image`, `position`, `status`) VALUES
(1, 'your text will appear here', 'your text will appear here', '<p>Lorem Ipsum is simply dummy text of the printingLorem Ipsum is simply dummy text of the printing Lorem Ipsum is simply dummy text of the printing Lorem Ipsum is simply dummy text of the printing Lorem Ipsum is simply dummy text of the printing Lorem Ipsum is simply dummy text of the printing</p>', 'assets_web/images/slider/2016-11-03/a2.jpg', 3, 1),
(2, 'your text will appear here', 'your text will appear here', '<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting</p>', 'assets_web/images/slider/2017-01-16/d1.jpg', 1, 1),
(5, 'your text will appear here', 'your text will appear here', '<p><strong>Lorem Ipsum</strong></p>\r\n<hr />\r\n<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting,</p>\r\n<ul>\r\n<li>Demo Hospital Limited</li>\r\n<li>&lt;script&gt;alert(2)&lt;/script&gt;</li>\r\n</ul>', 'assets_web/images/slider/2016-11-03/s.jpg', 1, 1);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
