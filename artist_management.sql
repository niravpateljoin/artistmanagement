-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: May 11, 2021 at 11:32 AM
-- Server version: 5.7.31
-- PHP Version: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `artist_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `celebrity`
--

DROP TABLE IF EXISTS `celebrity`;
CREATE TABLE IF NOT EXISTS `celebrity` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` date DEFAULT NULL,
  `bio` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `celebrity`
--

INSERT INTO `celebrity` (`id`, `name`, `birthday`, `bio`, `type`) VALUES
(1, 'Virat kohli', '1988-08-06', 'Virat Kohli is an Indian cricketer and the current captain of the India national team. A right-handed top-order batsman, Kohli is regarded as one of the best contemporary batsmen in the world.', 'manager'),
(2, 'Amitabh Bachchan', '1958-07-07', 'Amitabh Bachchan is an Indian film actor, film producer, television host, occasional playback singer and former politician. He is regarded as one of the greatest and most influential actors in the history of Indian cinema.', ''),
(3, 'kangana ranaut', '2021-01-01', 'Kangana Ranaut is an Indian actress and filmmaker who works in Hindi films. The recipient of several awards, including four National Film Awards and four Filmfare Awards, she has featured six times in Forbes India\'s Celebrity 100 list.', 'manager'),
(4, 'Narendra modi', '1950-09-05', 'Narendra Damodardas Modi is an Indian politician serving as the 14th and current prime minister of India since 2014. He was the chief minister of Gujarat from 2001 to 2014 and is the member of Parliament for Varanasi.', 'publicist'),
(5, 'anushka sharma', '1988-05-01', 'Anushka Sharma is an Indian actress and producer.', 'agent');

-- --------------------------------------------------------

--
-- Table structure for table `celebrity_representative`
--

DROP TABLE IF EXISTS `celebrity_representative`;
CREATE TABLE IF NOT EXISTS `celebrity_representative` (
  `celebrity_id` int(11) NOT NULL,
  `representative_id` int(11) NOT NULL,
  PRIMARY KEY (`celebrity_id`,`representative_id`),
  KEY `IDX_3B9810D69D12EF95` (`celebrity_id`),
  KEY `IDX_3B9810D6FC3FF006` (`representative_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `celebrity_representative`
--

INSERT INTO `celebrity_representative` (`celebrity_id`, `representative_id`) VALUES
(1, 12),
(1, 15),
(2, 12),
(2, 13),
(2, 16),
(3, 15),
(3, 16),
(4, 15),
(5, 13),
(5, 15),
(5, 16);

-- --------------------------------------------------------

--
-- Table structure for table `fos_user`
--

DROP TABLE IF EXISTS `fos_user`;
CREATE TABLE IF NOT EXISTS `fos_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `username_canonical` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_canonical` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `confirmation_token` varchar(180) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_957A647992FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_957A6479A0D96FBF` (`email_canonical`),
  UNIQUE KEY `UNIQ_957A6479C05FB297` (`confirmation_token`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `fos_user`
--

INSERT INTO `fos_user` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `confirmation_token`, `password_requested_at`, `roles`) VALUES
(1, 'neelk2929@gmail.com', 'neelk2929@gmail.com', 'neelk2929@gmail.com', 'neelk2929@gmail.com', 1, 'KWxZj8bu89433xDtc46h7xACVWahtA3rPhaLIOmgcfQ', '$2y$13$sG.zgN8WBsraGm.vYMTyHetuRYnv/xohpUticqdvur766z2V/cLRG', '2021-05-11 11:05:24', NULL, NULL, 'a:0:{}'),
(3, 'neelk2929@gmail.com33', 'neelk2929@gmail.com33', 'neelk2929@gmail.com33', 'neelk2929@gmail.com33', 1, '5QNRW28a0FoZ3jjkDSaE.NN7P3k0YmMg8K/VrGGxy4Q', '$2y$13$fM8KCVCBqpzDigqDWy9v8etaGWx3k3y7cnvPtTaENd76Nrd5lMs9C', '2021-05-11 05:59:06', NULL, NULL, 'a:0:{}');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
CREATE TABLE IF NOT EXISTS `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `changeNotes` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `createdAt` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `log`
--

INSERT INTO `log` (`id`, `changeNotes`, `createdAt`) VALUES
(67, 'Celebrity birthday updated from - 2020-07-05 to - 1988-05-01 By neelk2929@gmail.com', '2021-05-11 10:50:07'),
(68, 'Celebrity\'s representative list updated from -  to - anurag kashyap, Narendra Modi, rajkumar hirani By neelk2929@gmail.com', '2021-05-11 10:50:07'),
(69, 'Celebrity bio updated from - Anushka Sharma is an Indian actress and producer who works in Hindi films. to - Anushka Sharma is an Indian actress and producer. By neelk2929@gmail.com', '2021-05-11 10:50:24'),
(71, 'Celebrity\'s representative list updated from -  to - Narendra Modi By neelk2929@gmail.com', '2021-05-11 10:51:28'),
(72, 'Celebrity birthday updated from - 2018-04-15 to - 1950-09-05 By neelk2929@gmail.com', '2021-05-11 10:51:56'),
(73, 'Celebrity birthday updated from -  to - 2021-01-01 By neelk2929@gmail.com', '2021-05-11 10:53:56'),
(74, 'Celebrity\'s representative list updated from -  to - Narendra Modi, rajkumar hirani By neelk2929@gmail.com', '2021-05-11 10:53:56'),
(75, 'Celebrity birthday updated from -  to - 1958-07-07 By neelk2929@gmail.com', '2021-05-11 10:54:22'),
(76, 'Celebrity\'s representative list updated from -  to - anurag kashyap, rajkumar hirani, sunil gavaskar By neelk2929@gmail.com', '2021-05-11 10:54:22'),
(77, 'Celebrity birthday updated from -  to - 1988-05-06 By neelk2929@gmail.com', '2021-05-11 10:54:52'),
(78, 'Celebrity\'s representative list updated from -  to - Narendra Modi, sunil gavaskar By neelk2929@gmail.com', '2021-05-11 10:54:52'),
(79, 'Celebrity birthday updated from - 1988-05-06 to - 1988-08-06 By neelk2929@gmail.com', '2021-05-11 10:55:44'),
(80, 'Celebrity role updated from -  to - manager By neelk2929@gmail.com', '2021-05-11 11:19:45'),
(81, 'Celebrity role updated from - manager to - agent By neelk2929@gmail.com', '2021-05-11 11:20:22'),
(82, 'Celebrity role updated from -  to - agent By neelk2929@gmail.com', '2021-05-11 11:20:37'),
(83, 'Celebrity role updated from -  to - publicist By neelk2929@gmail.com', '2021-05-11 11:20:48'),
(84, 'Celebrity role updated from -  to - manager By neelk2929@gmail.com', '2021-05-11 11:20:56'),
(85, 'Celebrity role updated from - agent to - publicist By neelk2929@gmail.com', '2021-05-11 11:28:38'),
(86, 'Celebrity role updated from - publicist to - manager By neelk2929@gmail.com', '2021-05-11 11:29:02'),
(87, 'Representative\'s celebrity list updated from - anushka sharma, kangana ranaut to - anushka sharma, kangana ranaut, Narendra modi By neelk2929@gmail.com', '2021-05-11 11:29:35'),
(88, 'Representative name updated from - rajkumar hirani to - rajkumar hiranis By neelk2929@gmail.com', '2021-05-11 11:29:48'),
(89, 'Representative company updated from - Rajkumar Hirani house to - Rajkumar Hirani houses By neelk2929@gmail.com', '2021-05-11 11:29:48'),
(90, 'Representative emails updated from - raju@official.gmail.com to - raju@official.gmail.coms By neelk2929@gmail.com', '2021-05-11 11:29:48'),
(91, 'Representative name updated from - rajkumar hiranis to - rajkumar hirani By neelk2929@gmail.com', '2021-05-11 11:30:01'),
(92, 'Representative company updated from - Rajkumar Hirani houses to - Rajkumar Hirani house By neelk2929@gmail.com', '2021-05-11 11:30:01'),
(93, 'Representative emails updated from - raju@official.gmail.coms to - raju@official.gmail.com By neelk2929@gmail.com', '2021-05-11 11:30:01');

-- --------------------------------------------------------

--
-- Table structure for table `migration_versions`
--

DROP TABLE IF EXISTS `migration_versions`;
CREATE TABLE IF NOT EXISTS `migration_versions` (
  `version` varchar(14) COLLATE utf8mb4_unicode_ci NOT NULL,
  `executed_at` datetime NOT NULL COMMENT '(DC2Type:datetime_immutable)',
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `representative`
--

DROP TABLE IF EXISTS `representative`;
CREATE TABLE IF NOT EXISTS `representative` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `company` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `emails` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `representative`
--

INSERT INTO `representative` (`id`, `name`, `company`, `emails`) VALUES
(12, 'sunil gavaskar', 'Professional Management Group', 'anowarsha67@gmail.com'),
(13, 'anurag kashyap', 'Phantom Films', 'customercareofficials@gmail.com'),
(15, 'Narendra Modi', '-', 'Narendra@official.gmail.com'),
(16, 'rajkumar hirani', 'Rajkumar Hirani house', 'raju@official.gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `representative_celebrity`
--

DROP TABLE IF EXISTS `representative_celebrity`;
CREATE TABLE IF NOT EXISTS `representative_celebrity` (
  `representative_id` int(11) NOT NULL,
  `celebrity_id` int(11) NOT NULL,
  PRIMARY KEY (`representative_id`,`celebrity_id`),
  KEY `IDX_4E0C8E92FC3FF006` (`representative_id`),
  KEY `IDX_4E0C8E929D12EF95` (`celebrity_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `representative_celebrity`
--

INSERT INTO `representative_celebrity` (`representative_id`, `celebrity_id`) VALUES
(12, 1),
(13, 2),
(13, 3),
(15, 4),
(16, 3),
(16, 4),
(16, 5);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `celebrity_representative`
--
ALTER TABLE `celebrity_representative`
  ADD CONSTRAINT `FK_3B9810D69D12EF95` FOREIGN KEY (`celebrity_id`) REFERENCES `celebrity` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_3B9810D6FC3FF006` FOREIGN KEY (`representative_id`) REFERENCES `representative` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `representative_celebrity`
--
ALTER TABLE `representative_celebrity`
  ADD CONSTRAINT `FK_4E0C8E929D12EF95` FOREIGN KEY (`celebrity_id`) REFERENCES `celebrity` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_4E0C8E92FC3FF006` FOREIGN KEY (`representative_id`) REFERENCES `representative` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
