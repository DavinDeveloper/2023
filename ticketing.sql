-- --------------------------------------------------------
-- Host:                         dbms.dharmap.com
-- Server version:               10.3.28-MariaDB - MariaDB Server
-- Server OS:                    Linux
-- HeidiSQL Version:             12.3.0.6589
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Dumping structure for table ticketing.department
CREATE TABLE IF NOT EXISTS `department` (
  `id_department` int(5) NOT NULL AUTO_INCREMENT,
  `nama_department` varchar(255) NOT NULL,
  `date_created` varchar(255) NOT NULL,
  `date_updated` varchar(255) NOT NULL,
  PRIMARY KEY (`id_department`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ticketing.department: ~2 rows (approximately)
INSERT INTO `department` (`id_department`, `nama_department`, `date_created`, `date_updated`) VALUES
	(1, 'Support', '30-08-2023', '-'),
	(2, 'Finance', '30-08-2023', '-');

-- Dumping structure for table ticketing.forgot_request_token
CREATE TABLE IF NOT EXISTS `forgot_request_token` (
  `id` int(9) NOT NULL AUTO_INCREMENT,
  `email` varchar(50) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expired` enum('0','1') NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- Dumping data for table ticketing.forgot_request_token: ~11 rows (approximately)
INSERT INTO `forgot_request_token` (`id`, `email`, `token`, `expired`) VALUES
	(6, 'abdulrohim34@gmail.com', '$2y$10$Z9LHrtt4nJbH6Ys8XoIvjeF4f4ERWaGX3T34xqMj1l21ALJTXT146', '0'),
	(7, 'abdulrohim34@gmail.com', '$2y$10$uzC8.nw5jRyGWSLYJmT8cO1uUdPVCtgxBHatjpmPW3Fn4OsqmhTtK', '0'),
	(8, 'abdulrohim34@gmail.com', '$2y$10$ondUMvo9OFe5mrz8ksx2WuSw7jSDOJTmhFWqotTihB9/nn0nnymG6', '1'),
	(9, 'abdulrohim34@gmail.com', '$2y$10$Mh8H6kYBFieoKYFq2eOVUuu1xwtIsZzZbHmyGu.civKT48jDk2/tu', '1'),
	(10, 'abdulrohim34@gmail.com', '$2y$10$Oe19gPPdCRlZ90hGgS3n..5V7HuAxaM8ksPBaskZYd90UvkbADaCi', '1'),
	(11, 'abdulrohim34@gmail.com', '$2y$10$URwBStTkCrAxZ50FUn60deMwSCdXRaqnL/K8OaGPJPXAPjNW6NcbO', '1'),
	(12, 'abdulrohim34@gmail.com', '$2y$10$K9IjzAHTJGz4p7ChYArztO9uT4tHSJi1NozPPt7YFuw4ilx.cGwN.', '0'),
	(13, 'abdulrohim34@gmail.com', '$2y$10$g02qol6P6Jql4VyVwH639.d8wlmQJVXNegsxUvByzXea7ct0VcbMK', '1'),
	(14, 'abdulrohim34@gmail.com', '$2y$10$sZLL8GoqAt13kxREITcCHOnBqhb.L1GaPH67mn51T0FCqJO5NfdOS', '0'),
	(15, 'abdulrohim34@gmail.com', '$2y$10$ZOhdNguGfQ1ZalbjKp0RU.QKc.QmCdnATOyyGektqe9xlt3d1WXVG', '1'),
	(16, 'abdulrohim34@gmail.com', '$2y$10$aIFBjy/egjdSdh.9vfZKY.2IqpzzRA9PuQNBwRxMn7501tmRdleEe', '0'),
	(17, 'abdulrohim34@gmail.com', '$2y$10$BUfgekrYUQelNX1XnxZE4uuavBE5OEbV2tabSHAfq1NZ9TyyNDDpa', '0');

-- Dumping structure for table ticketing.tiket
CREATE TABLE IF NOT EXISTS `tiket` (
  `id_tiket` int(5) NOT NULL AUTO_INCREMENT,
  `t_subject` varchar(255) NOT NULL,
  `t_status` varchar(255) NOT NULL,
  `t_users` int(10) NOT NULL,
  `t_email` int(10) NOT NULL,
  `t_unit` int(10) NOT NULL,
  `t_topic` int(10) NOT NULL,
  `t_department` int(10) NOT NULL,
  `t_assigned` int(10) NOT NULL,
  `t_priority` int(10) NOT NULL,
  `n_users` varchar(255) NOT NULL,
  `n_email` varchar(255) NOT NULL,
  `n_unit` varchar(255) NOT NULL,
  `n_topic` varchar(255) NOT NULL,
  `n_department` varchar(255) NOT NULL,
  `n_assigned` varchar(255) NOT NULL,
  `t_created_date` varchar(255) NOT NULL,
  `t_due_date` varchar(255) NOT NULL,
  `t_update_date` varchar(255) NOT NULL,
  `t_thread` varchar(255) NOT NULL,
  `t_reply_thread` varchar(255) NOT NULL,
  `clicked_from_technician` enum('Y','N') NOT NULL DEFAULT 'N',
  PRIMARY KEY (`id_tiket`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ticketing.tiket: ~4 rows (approximately)
INSERT INTO `tiket` (`id_tiket`, `t_subject`, `t_status`, `t_users`, `t_email`, `t_unit`, `t_topic`, `t_department`, `t_assigned`, `t_priority`, `n_users`, `n_email`, `n_unit`, `n_topic`, `n_department`, `n_assigned`, `t_created_date`, `t_due_date`, `t_update_date`, `t_thread`, `t_reply_thread`, `clicked_from_technician`) VALUES
	(1, 'softwarenya dibukanya lama', 'Pending', 7, 7, 2, 3, 7, 0, 0, 'abdul rohim', 'abdulrohim739@gmail.com', 'GBC', 'Software', '', '', '01-12-2023 01:35 pm', '14-12-2023', '-', 'test', '', 'N'),
	(2, 'test', 'Assigned', 7, 7, 2, 3, 7, 2, 1, 'abdul rohim', 'abdulrohim739@gmail.com', 'GBC', 'Software', '', 'Teknisi 1', '01-12-2023 01:36 pm', '29-12-2023', '05-12-2023 01:30 pm', 'test', '', 'N'),
	(3, 'test', 'Closed', 16, 16, 2, 3, 16, 15, 1, 'member', 'member', 'GBC', 'Software', 'Support', 'teknisi2', '06-12-2023 07:47 am', '06-12-2023', '06-12-2023 08:01 am', 'test', 'hello world', 'Y'),
	(4, 'tiket baru', 'Assigned', 16, 16, 2, 3, 16, 15, 0, 'member', 'member', 'GBC', 'Software', 'Support', 'teknisi2', '06-12-2023 08:12 am', '21-12-2023', '06-12-2023 09:40 am', 'tiket baru', 'hello world', 'Y');

-- Dumping structure for table ticketing.topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int(5) NOT NULL AUTO_INCREMENT,
  `nama_topic` varchar(255) NOT NULL,
  `date_created` varchar(255) NOT NULL,
  `date_updated` varchar(255) NOT NULL,
  PRIMARY KEY (`id_topic`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ticketing.topic: ~1 rows (approximately)
INSERT INTO `topic` (`id_topic`, `nama_topic`, `date_created`, `date_updated`) VALUES
	(3, 'Software', '30-08-2023', '-');

-- Dumping structure for table ticketing.unit
CREATE TABLE IF NOT EXISTS `unit` (
  `id_unit` int(5) NOT NULL AUTO_INCREMENT,
  `nama_unit` varchar(255) NOT NULL,
  `singkatan_unit` varchar(255) NOT NULL,
  `date_created` varchar(255) NOT NULL,
  `date_updated` varchar(255) NOT NULL,
  PRIMARY KEY (`id_unit`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Dumping data for table ticketing.unit: ~1 rows (approximately)
INSERT INTO `unit` (`id_unit`, `nama_unit`, `singkatan_unit`, `date_created`, `date_updated`) VALUES
	(2, '-', 'GBC', '30-08-2023', '-');

-- Dumping structure for table ticketing.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `number_phone` varchar(20) NOT NULL,
  `department` varchar(255) NOT NULL,
  `unit` varchar(20) NOT NULL,
  `hakakses` varchar(20) NOT NULL,
  `date_created` varchar(255) NOT NULL,
  `status` int(1) NOT NULL,
  `photo` varchar(255) NOT NULL DEFAULT 'default.svg',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- Dumping data for table ticketing.users: ~5 rows (approximately)
INSERT INTO `users` (`id`, `username`, `password`, `email`, `name`, `number_phone`, `department`, `unit`, `hakakses`, `date_created`, `status`, `photo`) VALUES
	(1, 'admin', '$2y$10$gFBeKiox/pQ.ExIig9ydQ.6tfGwPbNR6k/Q3jEXpWczictA0uFu3.', 'admin@gmail.com', 'Admin', '', '', '', 'administrator', '30-08-2023', 1, 'default.svg'),
	(2, 'teknisi1', '$2y$10$jJsoOe3PGYvJNUMifEjmi.8z63CsON3v697t6Txvs74EClCT4KHCi', 'teknisi1@gmail.com', 'Teknisi 1', '082113460348', 'Finance', 'PT ABC', 'teknisi', '30-08-2023', 1, 'default.svg'),
	(15, 'teknisi2', '$2y$10$aqbHWdYj4PA0RgCBr1dj2e0KllHthzAm/o9Woz6Kk0PKh5.jY5qOm', 'teknisi2', 'teknisi2', '082113460348', 'Support', 'GBC', 'teknisi', '06-12-2023', 1, 'default.svg'),
	(16, 'member', '$2y$10$wig39tZkYoG7dJ7k6ztCDOLQ1ZD8UL0LcDgZmdQF7G2q/uWhu7roq', 'member', 'member', 'member', 'Support', 'GBC', 'member', '06-12-2023', 1, 'default.svg'),
	(17, 'admin1', '$2y$10$GQS8.t6XJiHQlOfcTD/CU.oEL2ubJSQjUzsYZ23p5J1apHF03Mogy', 'admin1', 'admin1', 'admin1', 'Support', 'GBC', 'admin', '06-12-2023', 1, 'default.svg');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
