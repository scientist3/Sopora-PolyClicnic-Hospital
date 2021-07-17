-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.1.13-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win32
-- HeidiSQL Version:             9.4.0.5174
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table db_hospital_230.acm_account
DROP TABLE IF EXISTS `acm_account`;
CREATE TABLE IF NOT EXISTS `acm_account` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `type` varchar(20) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table db_hospital_230.acm_invoice
DROP TABLE IF EXISTS `acm_invoice`;
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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table db_hospital_230.acm_invoice_details
DROP TABLE IF EXISTS `acm_invoice_details`;
CREATE TABLE IF NOT EXISTS `acm_invoice_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `invoice_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `quantity` float NOT NULL,
  `price` float NOT NULL,
  `subtotal` float NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=76 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table db_hospital_230.acm_payment
DROP TABLE IF EXISTS `acm_payment`;
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table db_hospital_230.appointment
DROP TABLE IF EXISTS `appointment`;
CREATE TABLE IF NOT EXISTS `appointment` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
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
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table db_hospital_230.bm_bed
DROP TABLE IF EXISTS `bm_bed`;
CREATE TABLE IF NOT EXISTS `bm_bed` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `limit` int(3) NOT NULL,
  `charge` float NOT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table db_hospital_230.bm_bed_assign
DROP TABLE IF EXISTS `bm_bed_assign`;
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
) ENGINE=InnoDB AUTO_INCREMENT=277 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table db_hospital_230.cm_patient
DROP TABLE IF EXISTS `cm_patient`;
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table db_hospital_230.cm_status
DROP TABLE IF EXISTS `cm_status`;
CREATE TABLE IF NOT EXISTS `cm_status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `critical_status` varchar(255) NOT NULL DEFAULT '1',
  `cm_patient_id` int(11) NOT NULL,
  `description` text,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table db_hospital_230.department
DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `dprt_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`dprt_id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table db_hospital_230.document
DROP TABLE IF EXISTS `document`;
CREATE TABLE IF NOT EXISTS `document` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` varchar(30) NOT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `description` text,
  `hidden_attach_file` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `upload_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table db_hospital_230.enquiry
DROP TABLE IF EXISTS `enquiry`;
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
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table db_hospital_230.ha_birth
DROP TABLE IF EXISTS `ha_birth`;
CREATE TABLE IF NOT EXISTS `ha_birth` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `patient_id` varchar(30) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table db_hospital_230.ha_category
DROP TABLE IF EXISTS `ha_category`;
CREATE TABLE IF NOT EXISTS `ha_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) DEFAULT NULL,
  `description` text,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table db_hospital_230.ha_death
DROP TABLE IF EXISTS `ha_death`;
CREATE TABLE IF NOT EXISTS `ha_death` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `patient_id` varchar(30) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table db_hospital_230.ha_investigation
DROP TABLE IF EXISTS `ha_investigation`;
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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table db_hospital_230.ha_medicine
DROP TABLE IF EXISTS `ha_medicine`;
CREATE TABLE IF NOT EXISTS `ha_medicine` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `description` text NOT NULL,
  `price` float NOT NULL,
  `manufactured_by` varchar(255) NOT NULL,
  `create_date` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table db_hospital_230.ha_operation
DROP TABLE IF EXISTS `ha_operation`;
CREATE TABLE IF NOT EXISTS `ha_operation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `patient_id` varchar(30) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table db_hospital_230.language
DROP TABLE IF EXISTS `language`;
CREATE TABLE IF NOT EXISTS `language` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `phrase` text NOT NULL,
  `english` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=425 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table db_hospital_230.mail_setting
DROP TABLE IF EXISTS `mail_setting`;
CREATE TABLE IF NOT EXISTS `mail_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `protocol` varchar(20) NOT NULL,
  `mailpath` varchar(255) NOT NULL,
  `mailtype` varchar(20) NOT NULL,
  `validate_email` varchar(20) NOT NULL,
  `wordwrap` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table db_hospital_230.message
DROP TABLE IF EXISTS `message`;
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
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table db_hospital_230.notice
DROP TABLE IF EXISTS `notice`;
CREATE TABLE IF NOT EXISTS `notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `assign_by` int(11) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table db_hospital_230.patient
DROP TABLE IF EXISTS `patient`;
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
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table db_hospital_230.pr_case_study
DROP TABLE IF EXISTS `pr_case_study`;
CREATE TABLE IF NOT EXISTS `pr_case_study` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` varchar(30) NOT NULL,
  `food_allergies` varchar(255) NOT NULL,
  `tendency_bleed` varchar(255) NOT NULL,
  `heart_disease` varchar(255) NOT NULL,
  `high_blood_pressure` varchar(255) NOT NULL,
  `diabetic` varchar(255) NOT NULL,
  `surgery` varchar(255) NOT NULL,
  `accident` varchar(255) NOT NULL,
  `others` varchar(255) NOT NULL,
  `family_medical_history` varchar(255) NOT NULL,
  `current_medication` varchar(255) NOT NULL,
  `female_pregnancy` varchar(255) NOT NULL,
  `breast_feeding` varchar(255) NOT NULL,
  `health_insurance` varchar(255) NOT NULL,
  `low_income` varchar(255) NOT NULL,
  `reference` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table db_hospital_230.pr_insurance
DROP TABLE IF EXISTS `pr_insurance`;
CREATE TABLE IF NOT EXISTS `pr_insurance` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table db_hospital_230.pr_prescription
DROP TABLE IF EXISTS `pr_prescription`;
CREATE TABLE IF NOT EXISTS `pr_prescription` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prescription_id` varchar(30) DEFAULT NULL,
  `patient_id` varchar(30) NOT NULL,
  `patient_type` varchar(50) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `chief_complain` text NOT NULL,
  `insurance_id` int(11) DEFAULT NULL,
  `weight` varchar(50) NOT NULL,
  `blood_pressure` varchar(255) NOT NULL,
  `medicine` text NOT NULL,
  `diagnosis` text NOT NULL,
  `visiting_fees` float NOT NULL,
  `patient_notes` text NOT NULL,
  `reference_by` varchar(50) DEFAULT NULL,
  `reference_to` varchar(50) DEFAULT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table db_hospital_230.schedule
DROP TABLE IF EXISTS `schedule`;
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
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table db_hospital_230.setting
DROP TABLE IF EXISTS `setting`;
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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table db_hospital_230.user
DROP TABLE IF EXISTS `user`;
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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table db_hospital_230.ws_comment
DROP TABLE IF EXISTS `ws_comment`;
CREATE TABLE IF NOT EXISTS `ws_comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `item_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `comment` text NOT NULL,
  `date` datetime NOT NULL,
  `add_to_website` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=66 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table db_hospital_230.ws_item
DROP TABLE IF EXISTS `ws_item`;
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
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table db_hospital_230.ws_section
DROP TABLE IF EXISTS `ws_section`;
CREATE TABLE IF NOT EXISTS `ws_section` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `title` varchar(50) DEFAULT NULL,
  `description` text,
  `featured_image` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table db_hospital_230.ws_setting
DROP TABLE IF EXISTS `ws_setting`;
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
-- Dumping structure for table db_hospital_230.ws_slider
DROP TABLE IF EXISTS `ws_slider`;
CREATE TABLE IF NOT EXISTS `ws_slider` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) DEFAULT NULL,
  `subtitle` varchar(100) DEFAULT NULL,
  `description` text,
  `image` varchar(100) DEFAULT NULL,
  `position` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- Data exporting was unselected.
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
