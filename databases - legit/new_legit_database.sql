-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jul 28, 2022 at 07:12 AM
-- Server version: 5.7.36
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_cbt`
--
CREATE DATABASE IF NOT EXISTS `test_cbt` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test_cbt`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date_joined` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ID`, `user_name`, `password`, `status`, `date_joined`) VALUES
(1, 'emmysoft_admin', 'f0f017e86ed74d2f7aa355b60b23e1331ffd3d12', 0, '\n06/06/22 - 07:22:30:am');

-- --------------------------------------------------------

--
-- Table structure for table `admin_info`
--

DROP TABLE IF EXISTS `admin_info`;
CREATE TABLE IF NOT EXISTS `admin_info` (
  `A_ID` int(11) NOT NULL DEFAULT '0',
  `user_name` varchar(255) NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL DEFAULT '0',
  `email` varchar(255) NOT NULL DEFAULT '0',
  `birthday` varchar(255) NOT NULL DEFAULT '0',
  `sex` varchar(10) NOT NULL DEFAULT '0',
  `comment` varchar(255) NOT NULL DEFAULT '0',
  `home_address` varchar(255) NOT NULL DEFAULT '0',
  `phone_number` varchar(255) NOT NULL DEFAULT '0',
  `profile_picture` varchar(255) NOT NULL DEFAULT '0',
  `profile_updated` tinyint(1) NOT NULL DEFAULT '0',
  `time_updated` varchar(255) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_info`
--

INSERT INTO `admin_info` (`A_ID`, `user_name`, `password`, `email`, `birthday`, `sex`, `comment`, `home_address`, `phone_number`, `profile_picture`, `profile_updated`, `time_updated`, `status`) VALUES
(1, 'emmysoft_admin', 'f0f017e86ed74d2f7aa355b60b23e1331ffd3d12', 'emmysoftadmin@gmail.com', '2022-06-06', 'male', 'CEO @ Emmysoft CBT , CEO @ Emmysoft Games, Co-Founder, Web Developer Game developer,   @ Quadstack Unprogrammed Programmer', '28 emmanuel streeet', '090548646486', '-2798042131654561652.png', 1, '07/06/22 - 12:27:32:am', 0);

-- --------------------------------------------------------

--
-- Table structure for table `admin_msgs`
--

DROP TABLE IF EXISTS `admin_msgs`;
CREATE TABLE IF NOT EXISTS `admin_msgs` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `User_ID` int(11) NOT NULL,
  `message` text NOT NULL,
  `date_added` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `events_manager`
--

DROP TABLE IF EXISTS `events_manager`;
CREATE TABLE IF NOT EXISTS `events_manager` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `btn_pressed` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events_manager`
--

INSERT INTO `events_manager` (`ID`, `btn_pressed`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `date_joined` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `user_name`, `password`, `status`, `date_joined`) VALUES
(7, 'oyindamola', 'fe3b5ff9ab1056fa8f0cf7fc0b1204115d2d944a', 0, '02/06/22 - 01:32:01:pm'),
(2, 'kgifty', 'c04cea9e34a2e84d93f40a0776c338d7c27c9e0a', 0, '01/06/22 - 02:08:13:pm'),
(3, 'quadstack', 'd0da1819128ffdc0f1d5e0e13db5ce857a9395b9', 1, '01/06/22 - 02:14:54:pm'),
(4, 'joseph', '8c6df410d7e8989e98bd620983a1b1891143d1e9', 0, '01/06/22 - 06:15:52:pm'),
(5, 'Emmysoft', 'efdb8f7f2fe9c47e34dfe1fb7c491d0638ec2d86', 0, '01/06/22 - 06:39:15:pm'),
(8, 'emmanuel', 'efdb8f7f2fe9c47e34dfe1fb7c491d0638ec2d86', 1, '02/06/22 - 01:59:11:pm'),
(9, 'adedoyin emmanuel', '4970b1e739537fdda4fa309d7757d01c5e800236', 1, '04/06/22 - 05:04:49:am'),
(10, 'sarah love', '7901b032b0e84273d1be624407a64b5fb158c3de', 0, '06/06/22 - 08:20:47:am'),
(11, 'Emmysoft Games', 'decfb66d43a3247639de44d4253ecd65d6b897f4', 1, '11/06/22 - 08:22:54:pm'),
(12, 'Fisayo', '241f4395b83b2893033a223900d091e818a4ccde', 0, '11/06/22 - 08:31:18:pm'),
(13, 'henqsoft', '4e88c416653d2ca30d226f9861233edb3c25e606', 1, '12/06/22 - 06:54:49:am'),
(14, 'bola', '9b1e73c64300ec5a37a83304eea9f46d32368d0c', 0, '19/06/22 - 07:10:19:am'),
(15, 'Amede Topper', 'f1454c26a79115304b9f636cef24ab6704d181be', 0, '03/07/22 - 09:07:19:am'),
(16, 'amede winner', '85f940c72d551ab70c79a22134a14dc2838d31ab', 1, '03/07/22 - 09:08:42:am'),
(17, 'Adedoyin Aderonke', 'd4e7f296de5a8496794696f474ebc901075ed95a', 1, '08/07/22 - 09:38:19:pm'),
(18, 'daniel pascal', '3d0f3b9ddcacec30c4008c5e030e6c13a478cb4f', 1, '21/07/22 - 04:58:56:pm'),
(19, 'Samson Odunaro', '38a6c9ee0a4f1ab2eefddae27990e67a8c5733f6', 1, '22/07/22 - 10:30:31:am'),
(20, 'emmysoft jr', 'f5dbfc4c324f83862529adb55c29f9ddf719b192', 1, '26/07/22 - 06:58:10:pm'),
(21, 'kolawole gift', 'c04cea9e34a2e84d93f40a0776c338d7c27c9e0a', 1, '27/07/22 - 07:56:54:pm'),
(22, 'kolawole thanks', '613bbf8abd03e46963b79f5904f6893faf38c6a9', 0, '27/07/22 - 07:59:05:pm'),
(23, 'abike big head', '72cc8279f43d494a7f61f53195a8797e829a12da', 0, '27/07/22 - 08:51:35:pm'),
(24, 'menthol', '0ebc79111751865a8f270246b1be04e214ab56dd', 0, '27/07/22 - 08:52:52:pm'),
(25, 'tomi tomato', '1c3f704cb51e403ca868437e82c98b13fd6cbd4a', 0, '27/07/22 - 09:01:15:pm'),
(26, 'enny bae', 'f30ffae44c2c0ec2a5d11050981c4d3a94f852a8', 0, '27/07/22 - 09:02:23:pm'),
(27, 'anita', 'd56c82a0ab1c536999c31ae5e2c0dab85f47a331', 0, '27/07/22 - 09:03:14:pm'),
(28, 'lilian', '634369de306b78c92506d6dbe2e7260b2ee2d0a2', 0, '27/07/22 - 09:04:08:pm'),
(29, 'teniola', 'cdf4aa29608861fecfd3de7b4289e3a66eec6fe0', 0, '27/07/22 - 09:07:12:pm'),
(30, 'john doe', 'a51dda7c7ff50b61eaea0444371f4a6a9301e501', 0, '27/07/22 - 09:19:29:pm');

-- --------------------------------------------------------

--
-- Table structure for table `users_info`
--

DROP TABLE IF EXISTS `users_info`;
CREATE TABLE IF NOT EXISTS `users_info` (
  `U_ID` int(11) NOT NULL DEFAULT '0',
  `user_name` varchar(255) NOT NULL DEFAULT '0',
  `password` varchar(255) NOT NULL DEFAULT '0',
  `email` varchar(255) NOT NULL DEFAULT '0',
  `birthday` varchar(255) NOT NULL DEFAULT '0',
  `sex` varchar(10) NOT NULL DEFAULT '0',
  `comment` varchar(255) NOT NULL DEFAULT '0',
  `home_address` varchar(255) NOT NULL DEFAULT '0',
  `phone_number` varchar(50) NOT NULL DEFAULT '0',
  `profile_picture` varchar(255) NOT NULL DEFAULT '0',
  `profile_updated` tinyint(1) NOT NULL DEFAULT '0',
  `time_updated` varchar(255) NOT NULL DEFAULT '0',
  `status` int(10) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_info`
--

INSERT INTO `users_info` (`U_ID`, `user_name`, `password`, `email`, `birthday`, `sex`, `comment`, `home_address`, `phone_number`, `profile_picture`, `profile_updated`, `time_updated`, `status`) VALUES
(3, 'quadstack', 'd0da1819128ffdc0f1d5e0e13db5ce857a9395b9', 'quadstack@gmail.com', '2022-06-02', 'male', 'we provide solutions to business', '1-3 eccowas girl\'s hostel avanue', '946046046046406', '-492126871654176042.png', 1, '02/06/22 - 01:20:42:pm', 1),
(2, 'kgifty', 'c04cea9e34a2e84d93f40a0776c338d7c27c9e0a', 'kolowolegift@gmail.com', '2022-06-01', 'female', 'i am a tech girl  i was trained by the best my one and only crush @emmysoft =&gt; CEO @EmmysoftGames', '1-3 eccowas girls hostel avanue', '09047258353853', '1657170978.png', 1, '07/07/22 - 05:16:18:am', 0),
(4, 'joseph', '8c6df410d7e8989e98bd620983a1b1891143d1e9', 'joseph@gmail.com', '2022-06-01', 'male', 'i am a cool guy', '28 joseph streeet', '09589539538', '53506471654107435.jpeg', 1, '01/06/22 - 06:17:15:pm', 0),
(5, 'Emmysoft', 'efdb8f7f2fe9c47e34dfe1fb7c491d0638ec2d86', 'emmysoft@gmail.com', '2005-09-14', 'male', 'i am a programmer i have no life', '42 kuburat agbeduyi street', '07061620301', '3240961654108884.jpg', 1, '01/06/22 - 06:41:24:pm', 0),
(7, 'oyindamola', 'fe3b5ff9ab1056fa8f0cf7fc0b1204115d2d944a', 'oyindamola@gmail.com', '2022-06-02', 'female', 'i love reading, studying, playing games and cooking', '1-3 eccowas girls hostel avanue', '0905468846486', '96051031654177758.png', 1, '02/06/22 - 01:49:18:pm', 0),
(8, 'emmanuel', 'efdb8f7f2fe9c47e34dfe1fb7c491d0638ec2d86', 'emmanuel@gmail.com', '2005-09-14', 'male', 'i am a programmer i have no life @adedoyin Emmanuel don\'t confuse @kgifty, change your fucking name don\'t steal my babe :)', '42 kuburat agbeduyi street', '07061620301', '-991579061654325856.png', 1, '04/06/22 - 06:57:36:am', 1),
(9, 'adedoyin emmanuel', '4970b1e739537fdda4fa309d7757d01c5e800236', 'adedoyinemmanuel@gmail.com', '2022-06-04', 'male', 'i am a programmer i have no life mark my words, i Definitely would make it one day', '42 kuburat agbeduyi street', '090538758482353', '-1269718441654319519.png', 1, '04/06/22 - 05:11:59:am', 0),
(10, 'sarah love', '7901b032b0e84273d1be624407a64b5fb158c3de', 'sarahlove@gmail.com', '2022-06-06', 'female', 'i love reading, swimming, even though i can\'t swim, i also love hanging around with my friends..', '1-3 eccowas girls hostel avenue upstairs', '090576946486464', '24252321654503832.png', 1, '06/06/22 - 08:23:52:am', 0),
(11, 'Emmysoft Games', 'decfb66d43a3247639de44d4253ecd65d6b897f4', 'emmysoftgames@gmail.com', '2022-06-11', 'male', 'Full Stack Developer, Game Developer @Quadstack and yeah i trained my crush =&gt; @kgifty', '23, boy\'s hostel street near mr samson bed', '0905538649353', '-6570127041655018995.png', 1, '12/06/22 - 07:29:55:am', 1),
(12, 'Fisayo', '241f4395b83b2893033a223900d091e818a4ccde', 'fisayo@gmail.com', '2022-06-11', 'male', 'graphics designer, front end designer @ quadstack', '11 shoprite bustop', '989437637535385', '65155031654979578.png', 1, '11/06/22 - 08:32:58:pm', 0),
(13, 'henqsoft', '4e88c416653d2ca30d226f9861233edb3c25e606', 'henqsoftproductions@gmail.com', '2022-06-12', 'male', 'henqsoft production.. graphics designer, frontend designer, programmer @ quadstack', '13 mother\'s joy streeet', '080754785634564', '59573371655017248.png', 1, '12/06/22 - 07:00:48:am', 1),
(14, 'bola', '9b1e73c64300ec5a37a83304eea9f46d32368d0c', 'bummibokun18@gmail.com', '2009-12-04', 'male', 'fuck u', '8 church of christ', '080832511272', '-7094884801656847631.png', 1, '03/07/22 - 11:27:11:am', 0),
(15, '0', '0', '0', '0', '0', '0', '0', '0', '0', 0, '0', 0),
(16, 'amede winner', '85f940c72d551ab70c79a22134a14dc2838d31ab', 'amedewinner@gmail.com', '2022-07-03', 'male', 'i am a cool guy, i am a beginner in free fire', '1-3 eccowas hostel avanue', '09086531456', '5783081656845811.png', 1, '03/07/22 - 10:56:51:am', 1),
(17, 'Adedoyin Aderonke', 'd4e7f296de5a8496794696f474ebc901075ed95a', 'roeadedoyin@gmail.com', '2022-07-08', 'female', 'i am a writer', '42, kuburat agbeduyi street', '0904858458464', '80973941657316751.jpg', 1, '08/07/22 - 09:45:51:pm', 1),
(18, 'daniel pascal', '3d0f3b9ddcacec30c4008c5e030e6c13a478cb4f', 'danielpascal@gmail.com', '2022-07-21', 'male', 'i love coding in python', '1-4, Omolabake avenue', '08130772803', '36822321658422925.jpg', 1, '21/07/22 - 05:02:05:pm', 1),
(19, 'Samson Odunaro', '38a6c9ee0a4f1ab2eefddae27990e67a8c5733f6', 'samsonodunaro@gmail.com', '2022-07-22', 'male', 'CEO  @  Quadstack solutions', '1-4, Omolabake avenue', '08130772803', '34688401658486096.jpg', 1, '22/07/22 - 10:34:56:am', 1),
(20, 'emmysoft jr', 'f5dbfc4c324f83862529adb55c29f9ddf719b192', 'emmysoftjr@gmail.com', '2022-07-15', 'male', 'i am a programmer', 'Iyana Ijana', '08130772803', '73729901658909217.gif', 1, '27/07/22 - 08:06:57:am', 1),
(21, '0', '0', '0', '0', '0', '0', '0', '0', '0', 0, '0', 1),
(22, '0', '0', '0', '0', '0', '0', '0', '0', '0', 0, '0', 0),
(23, '0', '0', '0', '0', '0', '0', '0', '0', '0', 0, '0', 0),
(24, '0', '0', '0', '0', '0', '0', '0', '0', '0', 0, '0', 0),
(25, '0', '0', '0', '0', '0', '0', '0', '0', '0', 0, '0', 0),
(26, '0', '0', '0', '0', '0', '0', '0', '0', '0', 0, '0', 0),
(27, '0', '0', '0', '0', '0', '0', '0', '0', '0', 0, '0', 0),
(28, '0', '0', '0', '0', '0', '0', '0', '0', '0', 0, '0', 0),
(29, '0', '0', '0', '0', '0', '0', '0', '0', '0', 0, '0', 0),
(30, '0', '0', '0', '0', '0', '0', '0', '0', '0', 0, '0', 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_msgs`
--

DROP TABLE IF EXISTS `users_msgs`;
CREATE TABLE IF NOT EXISTS `users_msgs` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `User_ID` int(11) NOT NULL,
  `Receiver_ID` int(20) NOT NULL,
  `message` text NOT NULL,
  `date_added` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=297 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_msgs`
--

INSERT INTO `users_msgs` (`ID`, `User_ID`, `Receiver_ID`, `message`, `date_added`) VALUES
(257, 2, 8, 'that\'s great to hear...', '09/07/22 - 02:52:11:am'),
(258, 8, 2, 'yeah thanks so what\'s up, what are you doing', '09/07/22 - 02:52:48:am'),
(259, 2, 8, 'i am fine', '09/07/22 - 02:52:58:am'),
(260, 8, 2, 'okay', '09/07/22 - 02:53:06:am'),
(261, 2, 8, 'bye', '09/07/22 - 02:53:13:am'),
(262, 2, 8, 'good night dear', '09/07/22 - 04:15:40:am'),
(263, 2, 8, 'are you online now', '09/07/22 - 04:27:09:am'),
(30, 8, 2, 'hello gift', '08/07/22 - 03:08:19:pm'),
(31, 2, 8, 'hello Emmanuel', '08/07/22 - 03:08:24:pm'),
(32, 8, 2, 'hello gift', '08/07/22 - 03:08:53:pm'),
(33, 2, 8, 'how are you doing, i told you about my code..', '08/07/22 - 03:11:04:pm'),
(34, 8, 2, 'yeah, i would fix your code for you', '08/07/22 - 03:12:04:pm'),
(238, 2, 5, 'okay that\'s good to hear', '08/07/22 - 03:26:40:pm'),
(239, 5, 2, 'so what are you doing', '08/07/22 - 03:28:54:pm'),
(240, 2, 5, 'i am cooking for my mum, i am preparing noodles, you', '08/07/22 - 03:29:52:pm'),
(241, 5, 2, 'what do you think i would be doing, lol', '08/07/22 - 03:30:21:pm'),
(242, 2, 5, 'i am cooking for my mum, i am preparing noodles, you', '08/07/22 - 03:30:58:pm'),
(277, 2, 17, 'yeah, we actually plan of furthering our â£â£ after our secondary school, you know we kinda have to face studies in school .. so we could get  little freedom at least after school', '09/07/22 - 06:05:36:am'),
(264, 8, 2, 'yeah i am online', '09/07/22 - 04:49:24:am'),
(265, 2, 8, 'okay, i wanted to tell you something', '09/07/22 - 04:54:02:am'),
(266, 17, 2, 'hello gift', '09/07/22 - 05:52:24:am'),
(267, 17, 2, 'how are you doing', '09/07/22 - 05:52:44:am'),
(268, 17, 2, 'nice chatting with you', '09/07/22 - 05:53:00:am'),
(269, 2, 17, 'hi, how are you doing...', '09/07/22 - 05:59:35:am'),
(270, 2, 17, 'i am gift, emmanuel\'s ðŸ˜ðŸ˜', '09/07/22 - 05:59:56:am'),
(271, 17, 2, 'yeah, i know that already, it is quite obvious', '09/07/22 - 06:01:33:am'),
(272, 2, 17, 'i know right, ðŸ¤', '09/07/22 - 06:01:57:am'),
(273, 17, 2, 'okay i guess you are good right', '09/07/22 - 06:02:09:am'),
(274, 17, 2, 'emmanuel told me you could speak chinese', '09/07/22 - 06:02:26:am'),
(275, 2, 17, 'yeah, in fact i am teaching him already how to speak chinese and he is really improving', '09/07/22 - 06:03:11:am'),
(276, 17, 2, 'wow that\'s nice, i bet you two would make a great combo', '09/07/22 - 06:03:46:am'),
(243, 2, 8, 'alright thanks', '08/07/22 - 05:08:46:pm'),
(244, 8, 2, 'yeah, you are welcome', '08/07/22 - 05:10:11:pm'),
(245, 2, 8, 'so do you have any project on your mind', '08/07/22 - 05:11:47:pm'),
(246, 2, 8, 'like a project you are working on currently', '08/07/22 - 05:12:10:pm'),
(247, 2, 8, 'not really a game or so', '08/07/22 - 05:12:34:pm'),
(248, 8, 2, 'yeah, i do, i would let you know once i am done with it', '08/07/22 - 05:16:35:pm'),
(251, 2, 8, 'okay emmanuel, i would appreciate that', '08/07/22 - 11:31:36:pm'),
(250, 2, 3, 'hello quadstack', '08/07/22 - 05:50:19:pm'),
(252, 8, 2, 'okay, you are welcome jare', '08/07/22 - 11:32:01:pm'),
(253, 2, 8, 'hey, good afternoon', '08/07/22 - 11:47:35:pm'),
(254, 2, 8, 'hey', '09/07/22 - 02:49:51:am'),
(255, 2, 8, 'what\'s up', '09/07/22 - 02:50:01:am'),
(256, 8, 2, 'i am good', '09/07/22 - 02:51:43:am'),
(83, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:24:pm'),
(84, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:24:pm'),
(85, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:24:pm'),
(86, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:25:pm'),
(87, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:25:pm'),
(88, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:25:pm'),
(89, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:25:pm'),
(90, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:25:pm'),
(91, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:25:pm'),
(92, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:25:pm'),
(93, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:25:pm'),
(94, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:25:pm'),
(95, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:25:pm'),
(96, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:25:pm'),
(97, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:26:pm'),
(98, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:26:pm'),
(99, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:26:pm'),
(100, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:26:pm'),
(101, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:26:pm'),
(102, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:26:pm'),
(103, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:26:pm'),
(104, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:26:pm'),
(105, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:26:pm'),
(106, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:26:pm'),
(107, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:26:pm'),
(108, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:27:pm'),
(109, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:27:pm'),
(110, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:27:pm'),
(111, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:27:pm'),
(112, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:27:pm'),
(113, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:27:pm'),
(114, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:27:pm'),
(115, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:27:pm'),
(116, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:28:pm'),
(117, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:28:pm'),
(118, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:28:pm'),
(119, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:28:pm'),
(120, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:28:pm'),
(121, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:28:pm'),
(122, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:28:pm'),
(123, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:28:pm'),
(124, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:28:pm'),
(125, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:28:pm'),
(126, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:28:pm'),
(127, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:28:pm'),
(128, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:29:pm'),
(129, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:29:pm'),
(130, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:29:pm'),
(131, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:29:pm'),
(132, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:29:pm'),
(133, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:29:pm'),
(134, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:29:pm'),
(135, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:29:pm'),
(136, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:29:pm'),
(137, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:29:pm'),
(138, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:29:pm'),
(139, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:29:pm'),
(140, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:30:pm'),
(141, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:30:pm'),
(142, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:30:pm'),
(143, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:30:pm'),
(144, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:30:pm'),
(145, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:30:pm'),
(146, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:30:pm'),
(147, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:30:pm'),
(148, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:30:pm'),
(149, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:30:pm'),
(150, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:30:pm'),
(151, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:30:pm'),
(152, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:30:pm'),
(153, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:30:pm'),
(154, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:31:pm'),
(155, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:31:pm'),
(156, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:31:pm'),
(157, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:31:pm'),
(158, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:31:pm'),
(159, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:31:pm'),
(160, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:31:pm'),
(161, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:31:pm'),
(162, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:31:pm'),
(163, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:31:pm'),
(164, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:31:pm'),
(165, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:31:pm'),
(166, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:31:pm'),
(167, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:32:pm'),
(168, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:32:pm'),
(169, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:32:pm'),
(170, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:32:pm'),
(171, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:32:pm'),
(172, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:32:pm'),
(173, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:32:pm'),
(174, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:32:pm'),
(175, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:32:pm'),
(176, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:32:pm'),
(177, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:32:pm'),
(178, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:33:pm'),
(179, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:33:pm'),
(180, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:33:pm'),
(181, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:33:pm'),
(182, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:33:pm'),
(183, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:33:pm'),
(184, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:33:pm'),
(185, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:33:pm'),
(186, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:33:pm'),
(187, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:33:pm'),
(188, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:33:pm'),
(189, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:33:pm'),
(190, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:34:pm'),
(191, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:34:pm'),
(192, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:34:pm'),
(193, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:34:pm'),
(194, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:34:pm'),
(195, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:34:pm'),
(196, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:34:pm'),
(197, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:34:pm'),
(198, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:34:pm'),
(199, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:34:pm'),
(200, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:34:pm'),
(201, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:35:pm'),
(202, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:35:pm'),
(203, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:35:pm'),
(204, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:35:pm'),
(205, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:35:pm'),
(206, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:35:pm'),
(207, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:35:pm'),
(208, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:35:pm'),
(209, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:35:pm'),
(210, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:35:pm'),
(211, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:35:pm'),
(212, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:36:pm'),
(213, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:36:pm'),
(214, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:36:pm'),
(215, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:36:pm'),
(216, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:36:pm'),
(217, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:36:pm'),
(218, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:36:pm'),
(219, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:36:pm'),
(220, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:36:pm'),
(221, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:36:pm'),
(222, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:36:pm'),
(223, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:37:pm'),
(224, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:37:pm'),
(225, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:37:pm'),
(226, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:37:pm'),
(227, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:37:pm'),
(228, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:37:pm'),
(229, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:37:pm'),
(230, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:37:pm'),
(231, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:37:pm'),
(232, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:38:pm'),
(233, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:38:pm'),
(234, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:38:pm'),
(235, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:38:pm'),
(236, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:38:pm'),
(237, 5, 2, 'coding is fine thanks', '08/07/22 - 03:23:39:pm'),
(278, 2, 8, 'yeah, so i you told me you had a dream about me ðŸ˜‹', '13/07/22 - 04:34:37:am'),
(279, 8, 2, 'you*', '13/07/22 - 04:54:29:am'),
(280, 2, 8, 'no, you told me you had a dream about me.. :)', '13/07/22 - 04:55:21:am'),
(281, 8, 2, 'yeah that\'s true', '13/07/22 - 05:23:39:am'),
(282, 8, 2, 'i wanted to tell you but i forgot that day', '13/07/22 - 05:23:52:am'),
(283, 8, 2, 'sorry', '13/07/22 - 05:24:05:am'),
(284, 18, 9, 'hello cultist', '26/07/22 - 01:11:57:pm'),
(285, 18, 9, 'you think say i don\'t know wetin dey sup', '26/07/22 - 01:12:18:pm'),
(286, 2, 18, 'mumu', '26/07/22 - 06:42:09:pm'),
(287, 2, 18, 'what\'s up how are you doing', '26/07/22 - 06:42:53:pm'),
(288, 18, 2, 'hey idiot', '26/07/22 - 06:43:11:pm'),
(289, 18, 2, 'how are you doing', '26/07/22 - 06:44:06:pm'),
(290, 2, 18, 'i guess you just joined this platform', '26/07/22 - 06:46:33:pm'),
(291, 18, 2, 'yeah, i just joined this platform created by Emmysoft and it is nice right', '26/07/22 - 06:47:49:pm'),
(292, 2, 18, 'yeah, i even took a cbt recently', '26/07/22 - 06:48:07:pm'),
(293, 2, 18, 'bye, we talk tomorrow', '26/07/22 - 06:48:21:pm'),
(294, 18, 8, 'boss how you dey na', '27/07/22 - 07:16:41:am'),
(295, 18, 9, 'what\'s up man i just added another feature hahaha', '27/07/22 - 07:23:59:am'),
(296, 18, 9, 'well i would see yu in shool ahahahah', '27/07/22 - 07:24:13:am');

-- --------------------------------------------------------

--
-- Table structure for table `users_questions`
--

DROP TABLE IF EXISTS `users_questions`;
CREATE TABLE IF NOT EXISTS `users_questions` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `test_ID` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `opt_1` varchar(255) NOT NULL,
  `opt_2` varchar(255) NOT NULL,
  `opt_3` varchar(255) NOT NULL,
  `opt_4` varchar(255) NOT NULL,
  `true_ans` int(11) NOT NULL,
  `time_added` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_questions`
--

INSERT INTO `users_questions` (`ID`, `test_ID`, `question`, `opt_1`, `opt_2`, `opt_3`, `opt_4`, `true_ans`, `time_added`) VALUES
(1, 8, 'what operating system is best for hackers', 'windows OS', 'mac OS', 'chromebook OS', 'linux OS', 4, '10/06/22 - 06:51:36:am'),
(2, 8, 'what operating system is the most popular', 'mac OS', 'windows OS', 'linux OS', 'chromebook OS', 2, '10/06/22 - 06:58:02:am'),
(3, 9, 'what is agriculture ?', 'the cultivation of crops and rearing of animals for man', 'the cultivation of crops alone', 'the rearing of animals alone', 'none of the above', 1, '10/06/22 - 07:00:14:am'),
(4, 13, 'who is the father of heredity', 'EmmySoft', 'Lord Michael Faraday', 'Gregor mendel', 'George Bush', 3, '10/06/22 - 07:06:12:am'),
(5, 12, 'what is the hardest topic is further maths', 'calculus', 'algebra', 'differentiation', 'integration', 1, '10/06/22 - 07:07:28:am'),
(6, 10, 'which of the following is the efficient method of industrial/commercial water purification', 'filtering alone', 'boiling alone', 'using a purification plant', 'the answer is not there', 3, '10/06/22 - 07:09:49:am'),
(7, 10, 'who discovered electrolysis', 'Michael faraday', 'George bush', 'sir Isaac newton', 'Albert Einstein', 1, '10/06/22 - 07:12:02:am'),
(8, 11, 'what aspect of English deals with pronunciation of sounds and how their application', 'Spoken English', 'Applicable English', 'Oral English', 'the answer is not above', 3, '10/06/22 - 07:14:55:am'),
(9, 11, 'would you pass this exam you are writing', 'yes', 'no', 'i am not sure', 'if God wants me to pass i would pass', 1, '10/06/22 - 07:15:53:am'),
(10, 9, 'would you pass this exam', 'not sure', 'i think so', 'yes i would pass', 'if God wants me to pass', 3, '10/06/22 - 07:16:57:am'),
(11, 13, 'the term &quot;Biology&quot; means what', 'a subject we study in science class', 'a subject that studies the living things in our environment', 'a subject that deals with living thing and none living things', 'Bio\'s and Logos', 2, '10/06/22 - 07:18:52:am'),
(12, 12, 'what is the product of 2X + 9X', 'syntax error', '11X', 'maths error', '11', 2, '10/06/22 - 07:20:02:am'),
(13, 8, 'what is the full meaning of HTML', 'head, toe, mark language', 'hyper text markup language', 'hypo text markup language', 'the answer is not there', 2, '10/06/22 - 07:22:12:am'),
(14, 8, 'what is the best framework for a PHP developer', 'codeigniter', 'laravel', 'wordpress', 'wix', 2, '15/06/22 - 12:41:23:pm'),
(15, 8, 'what programming language is best for data analyst?', 'java', 'php', 'SQL', 'python', 3, '15/06/22 - 02:53:59:pm'),
(16, 17, 'what language is recommend for a data analyst?', 'PHP', 'SQLI', 'python', 'java', 2, '15/06/22 - 02:56:51:pm'),
(17, 17, '______ is a language used to query database', 'JAVA', 'PYTHON', 'PHP (PHP hypertext preprocessor)', 'SQL (structured query language)', 4, '15/06/22 - 02:58:09:pm'),
(18, 17, 'what query language is the most flexible and most popular', 'Django', 'Flask', 'Oracle', 'SQL', 3, '15/06/22 - 02:59:57:pm'),
(19, 17, '______ is a language used to query database', 'JAVA', 'PYTHON', 'PHP (PHP hypertext preprocessor)', 'SQL (structured query language)', 4, '15/06/22 - 03:02:09:pm'),
(20, 18, '__________ is the full meaning of ICT', 'Information communication technology', 'Information technology', 'Information connection technology', 'informational communicational technology', 1, '18/06/22 - 07:16:14:pm'),
(21, 18, 'what is the full meaning of CSS', 'casket style shit', 'cascading style shit', 'cascading styling sheet', 'cascading style sheet', 4, '18/06/22 - 07:18:03:pm'),
(22, 18, 'what is PHP', 'personal home processor', 'PHP hypertext pre-processor', 'personal hypertext pre-processor', 'personally hypo-text pre-processor', 2, '18/06/22 - 07:24:58:pm'),
(23, 18, 'Who invented the WINDOWS OS', 'Bill Gates', 'Mark Zukerberg', 'Elon Musk', 'Bredian Eich', 1, '18/06/22 - 07:27:15:pm'),
(24, 18, 'who invented the APPLE OS', 'Bill Gates', 'Mark Zukerberg', 'Steve Jobs', 'Elon Musk', 3, '18/06/22 - 07:28:07:pm'),
(25, 18, 'what operating system (OS) is the most used', 'Chrome book OS', 'Mac book', 'Windows OS', 'Linux OS', 3, '18/06/22 - 07:29:36:pm'),
(26, 18, '___________________ invented the linux operating', 'IBM industries', 'Linux Torvalrds', 'william Linux', 'Torvalds William Linux', 2, '18/06/22 - 07:30:59:pm'),
(27, 18, 'who is the father of computer', 'Bill Gates', 'Elon Musk', 'Charles Babbage', 'Edward Saverin', 3, '18/06/22 - 07:33:16:pm'),
(28, 18, 'what is the default interpreter of Javascript (JS) when it was first invented', 'Spidermonkey', 'chakara', 'V8 Engine', 'V6 Engine', 1, '18/06/22 - 07:35:21:pm'),
(29, 18, 'what is the most popular and efficient browser interpreter engine for Javascript (JS)', 'Google V8 Engine', 'Google V6 Engine', 'Chakara', 'Spidermonkey', 1, '18/06/22 - 07:36:29:pm');

-- --------------------------------------------------------

--
-- Table structure for table `users_subjects`
--

DROP TABLE IF EXISTS `users_subjects`;
CREATE TABLE IF NOT EXISTS `users_subjects` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `subject_name` varchar(255) NOT NULL,
  `date_added` varchar(255) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_subjects`
--

INSERT INTO `users_subjects` (`ID`, `subject_name`, `date_added`) VALUES
(1, 'computer studies', '07/05/22 - 11:33:58:am'),
(2, 'further maths', '07/06/22 - 11:33:58:pm'),
(3, 'chemistry', '07/06/22 - 11:34:13:pm'),
(4, 'agric', '07/06/22 - 11:34:21:pm'),
(5, 'biology', '09/06/22 - 07:06:49:am'),
(6, 'english language', '09/06/22 - 08:11:58:am'),
(7, 'social studies', '10/06/22 - 09:53:04:am'),
(8, 'Christian Religious Studies', '12/06/22 - 09:03:34:am'),
(9, 'History', '12/06/22 - 09:07:38:am'),
(10, 'civic education', '12/06/22 - 09:08:16:am'),
(11, 'french', '12/06/22 - 11:35:53:am'),
(12, 'yoruba', '13/06/22 - 03:29:14:pm'),
(19, 'Home Economics', '24/07/22 - 09:39:05:pm');

-- --------------------------------------------------------

--
-- Table structure for table `users_test`
--

DROP TABLE IF EXISTS `users_test`;
CREATE TABLE IF NOT EXISTS `users_test` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `subject_ID` int(11) NOT NULL,
  `test_name` varchar(255) NOT NULL,
  `total_questions` int(100) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_test`
--

INSERT INTO `users_test` (`ID`, `subject_ID`, `test_name`, `total_questions`) VALUES
(17, 13, 'data processing exam', 25),
(14, 7, 'social studies exam', 20),
(15, 8, 'CRS Exam', 20),
(16, 9, 'history exam', 20),
(8, 1, 'computer exam', 20),
(9, 4, 'agric exam', 20),
(10, 3, 'chemistry exam', 20),
(11, 6, 'english exam', 20),
(12, 2, 'further maths', 20),
(13, 5, 'biology exam', 20),
(18, 14, 'ICT exam', 10),
(19, 15, 'Computer Science Exam', 20),
(20, 16, 'Creative Art Exam', 20),
(21, 4, 'Data Processing Exam', 25);

-- --------------------------------------------------------

--
-- Table structure for table `user_answer`
--

DROP TABLE IF EXISTS `user_answer`;
CREATE TABLE IF NOT EXISTS `user_answer` (
  `user_ID` varchar(255) NOT NULL,
  `test_ID` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `opt_1` varchar(255) NOT NULL,
  `opt_2` varchar(255) NOT NULL,
  `opt_3` varchar(255) NOT NULL,
  `opt_4` varchar(255) NOT NULL,
  `true_ans` int(11) NOT NULL,
  `user_ans` int(11) NOT NULL,
  `date_added` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_answer`
--

INSERT INTO `user_answer` (`user_ID`, `test_ID`, `question`, `opt_1`, `opt_2`, `opt_3`, `opt_4`, `true_ans`, `user_ans`, `date_added`) VALUES
('7', 11, 'what aspect of English deals with pronunciation of sounds and how their application', 'Spoken English', 'Applicable English', 'Oral English', 'the answer is not above', 3, 2, '04:46:54:am'),
('7', 8, 'what operating system is best for hackers', 'windows OS', 'mac OS', 'chromebook OS', 'linux OS', 4, 4, '07:43:09:am'),
('13', 8, 'what operating system is best for hackers', 'windows OS', 'mac OS', 'chromebook OS', 'linux OS', 4, 3, '12:37:53:pm'),
('13', 8, 'what operating system is best for hackers', 'windows OS', 'mac OS', 'chromebook OS', 'linux OS', 4, 4, '12:38:02:pm'),
('13', 8, 'what operating system is best for hackers', 'windows OS', 'mac OS', 'chromebook OS', 'linux OS', 4, 4, '12:38:10:pm'),
('13', 8, 'what operating system is best for hackers', 'windows OS', 'mac OS', 'chromebook OS', 'linux OS', 4, 3, '12:41:40:pm'),
('13', 8, 'what operating system is best for hackers', 'windows OS', 'mac OS', 'chromebook OS', 'linux OS', 4, 2, '12:41:46:pm'),
('13', 8, 'what operating system is best for hackers', 'windows OS', 'mac OS', 'chromebook OS', 'linux OS', 4, 2, '12:41:50:pm'),
('13', 8, 'what operating system is best for hackers', 'windows OS', 'mac OS', 'chromebook OS', 'linux OS', 4, 1, '02:05:17:pm'),
('13', 8, 'what operating system is best for hackers', 'windows OS', 'mac OS', 'chromebook OS', 'linux OS', 4, 4, '02:46:56:pm'),
('13', 8, 'what operating system is best for hackers', 'windows OS', 'mac OS', 'chromebook OS', 'linux OS', 4, 4, '02:47:14:pm'),
('13', 8, 'what operating system is best for hackers', 'windows OS', 'mac OS', 'chromebook OS', 'linux OS', 4, 4, '02:47:43:pm'),
('13', 8, 'what operating system is best for hackers', 'windows OS', 'mac OS', 'chromebook OS', 'linux OS', 4, 3, '02:47:53:pm'),
('13', 8, 'what operating system is best for hackers', 'windows OS', 'mac OS', 'chromebook OS', 'linux OS', 4, 2, '02:48:05:pm'),
('13', 8, 'what operating system is best for hackers', 'windows OS', 'mac OS', 'chromebook OS', 'linux OS', 4, 2, '02:48:17:pm'),
('13', 8, 'what operating system is best for hackers', 'windows OS', 'mac OS', 'chromebook OS', 'linux OS', 4, 2, '03:13:41:pm'),
('13', 8, 'what operating system is best for hackers', 'windows OS', 'mac OS', 'chromebook OS', 'linux OS', 4, 2, '03:14:20:pm'),
('13', 8, 'what operating system is best for hackers', 'windows OS', 'mac OS', 'chromebook OS', 'linux OS', 4, 4, '12:19:45:am'),
('13', 8, 'what operating system is best for hackers', 'windows OS', 'mac OS', 'chromebook OS', 'linux OS', 4, 4, '12:23:40:am'),
('13', 8, 'what operating system is best for hackers', 'windows OS', 'mac OS', 'chromebook OS', 'linux OS', 4, 2, '12:23:47:am'),
('13', 8, 'what operating system is best for hackers', 'windows OS', 'mac OS', 'chromebook OS', 'linux OS', 4, 2, '12:24:04:am'),
('13', 8, 'what operating system is best for hackers', 'windows OS', 'mac OS', 'chromebook OS', 'linux OS', 4, 2, '12:24:15:am'),
('13', 8, 'what operating system is best for hackers', 'windows OS', 'mac OS', 'chromebook OS', 'linux OS', 4, 2, '12:24:21:am'),
('13', 8, 'what operating system is best for hackers', 'windows OS', 'mac OS', 'chromebook OS', 'linux OS', 4, 2, '12:24:27:am'),
('13', 8, 'what operating system is best for hackers', 'windows OS', 'mac OS', 'chromebook OS', 'linux OS', 4, 3, '12:24:33:am'),
('13', 8, 'what operating system is best for hackers', 'windows OS', 'mac OS', 'chromebook OS', 'linux OS', 4, 2, '12:24:51:am'),
('13', 17, 'what language is recommend for a data analyst?', 'PHP', 'SQLI', 'python', 'java', 2, 2, '12:27:12:am'),
('13', 17, 'what language is recommend for a data analyst?', 'PHP', 'SQLI', 'python', 'java', 2, 4, '12:27:20:am'),
('13', 17, 'what language is recommend for a data analyst?', 'PHP', 'SQLI', 'python', 'java', 2, 3, '12:27:32:am'),
('13', 17, 'what language is recommend for a data analyst?', 'PHP', 'SQLI', 'python', 'java', 2, 4, '12:27:38:am'),
('13', 17, 'what language is recommend for a data analyst?', 'PHP', 'SQLI', 'python', 'java', 2, 4, '12:27:54:am'),
('13', 9, 'what is agriculture ?', 'the cultivation of crops and rearing of animals for man', 'the cultivation of crops alone', 'the rearing of animals alone', 'none of the above', 1, 1, '12:31:10:am'),
('13', 9, 'what is agriculture ?', 'the cultivation of crops and rearing of animals for man', 'the cultivation of crops alone', 'the rearing of animals alone', 'none of the above', 1, 3, '12:33:16:am'),
('13', 9, 'what is agriculture ?', 'the cultivation of crops and rearing of animals for man', 'the cultivation of crops alone', 'the rearing of animals alone', 'none of the above', 1, 1, '12:34:04:am'),
('13', 13, 'who is the father of heredity', 'EmmySoft', 'Lord Michael Faraday', 'Gregor mendel', 'George Bush', 3, 3, '12:35:15:am'),
('13', 13, 'who is the father of heredity', 'EmmySoft', 'Lord Michael Faraday', 'Gregor mendel', 'George Bush', 3, 1, '12:35:29:am'),
('13', 13, 'who is the father of heredity', 'EmmySoft', 'Lord Michael Faraday', 'Gregor mendel', 'George Bush', 3, 3, '12:35:35:am'),
('13', 13, 'who is the father of heredity', 'EmmySoft', 'Lord Michael Faraday', 'Gregor mendel', 'George Bush', 3, 2, '12:35:46:am'),
('13', 13, 'who is the father of heredity', 'EmmySoft', 'Lord Michael Faraday', 'Gregor mendel', 'George Bush', 3, 2, '12:36:05:am'),
('13', 12, 'what is the hardest topic is further maths', 'calculus', 'algebra', 'differentiation', 'integration', 1, 1, '12:37:04:am'),
('13', 12, 'what is the hardest topic is further maths', 'calculus', 'algebra', 'differentiation', 'integration', 1, 2, '12:37:13:am'),
('13', 12, 'what is the hardest topic is further maths', 'calculus', 'algebra', 'differentiation', 'integration', 1, 2, '12:37:24:am'),
('13', 8, 'what operating system is best for hackers', 'windows OS', 'mac OS', 'chromebook OS', 'linux OS', 4, 4, '12:38:10:am'),
('13', 11, 'what aspect of English deals with pronunciation of sounds and how their application', 'Spoken English', 'Applicable English', 'Oral English', 'the answer is not above', 3, 3, '12:38:51:am'),
('13', 11, 'what aspect of English deals with pronunciation of sounds and how their application', 'Spoken English', 'Applicable English', 'Oral English', 'the answer is not above', 3, 1, '12:39:00:am'),
('13', 11, 'what aspect of English deals with pronunciation of sounds and how their application', 'Spoken English', 'Applicable English', 'Oral English', 'the answer is not above', 3, 3, '12:40:41:am'),
('13', 11, 'what aspect of English deals with pronunciation of sounds and how their application', 'Spoken English', 'Applicable English', 'Oral English', 'the answer is not above', 3, 1, '12:40:50:am'),
('13', 11, 'what aspect of English deals with pronunciation of sounds and how their application', 'Spoken English', 'Applicable English', 'Oral English', 'the answer is not above', 3, 3, '12:41:01:am'),
('13', 11, 'what aspect of English deals with pronunciation of sounds and how their application', 'Spoken English', 'Applicable English', 'Oral English', 'the answer is not above', 3, 1, '12:42:37:am'),
('13', 10, 'which of the following is the efficient method of industrial/commercial water purification', 'filtering alone', 'boiling alone', 'using a purification plant', 'the answer is not there', 3, 3, '12:43:10:am'),
('13', 10, 'which of the following is the efficient method of industrial/commercial water purification', 'filtering alone', 'boiling alone', 'using a purification plant', 'the answer is not there', 3, 1, '12:43:17:am'),
('13', 10, 'which of the following is the efficient method of industrial/commercial water purification', 'filtering alone', 'boiling alone', 'using a purification plant', 'the answer is not there', 3, 3, '12:43:30:am'),
('13', 10, 'which of the following is the efficient method of industrial/commercial water purification', 'filtering alone', 'boiling alone', 'using a purification plant', 'the answer is not there', 3, 4, '12:43:37:am'),
('13', 10, 'which of the following is the efficient method of industrial/commercial water purification', 'filtering alone', 'boiling alone', 'using a purification plant', 'the answer is not there', 3, 3, '12:44:33:am'),
('5', 8, 'what operating system is best for hackers', 'windows OS', 'mac OS', 'chromebook OS', 'linux OS', 4, 3, '06:31:58:pm'),
('5', 8, 'what programming language is best for data analyst?', 'java', 'php', 'SQL', 'python', 3, 2, '06:31:54:pm'),
('5', 8, 'what is the best framework for a PHP developer', 'codeigniter', 'laravel', 'wordpress', 'wix', 2, 2, '06:31:50:pm'),
('5', 8, 'what is the full meaning of HTML', 'head, toe, mark language', 'hyper text markup language', 'hypo text markup language', 'the answer is not there', 2, 2, '06:31:44:pm'),
('5', 8, 'what programming language is best for data analyst?', 'java', 'php', 'SQL', 'python', 3, 2, '06:31:23:pm'),
('5', 8, 'what is the full meaning of HTML', 'head, toe, mark language', 'hyper text markup language', 'hypo text markup language', 'the answer is not there', 2, 4, '06:31:14:pm'),
('5', 8, 'what is the best framework for a PHP developer', 'codeigniter', 'laravel', 'wordpress', 'wix', 2, 2, '06:31:19:pm'),
('5', 8, 'what operating system is the most popular', 'mac OS', 'windows OS', 'linux OS', 'chromebook OS', 2, 4, '06:31:08:pm'),
('8', 8, 'what operating system is best for hackers', 'windows OS', 'mac OS', 'chromebook OS', 'linux OS', 4, 4, '02:53:58:am'),
('8', 8, 'what operating system is the most popular', 'mac OS', 'windows OS', 'linux OS', 'chromebook OS', 2, 2, '02:54:02:am'),
('8', 8, 'what is the full meaning of HTML', 'head, toe, mark language', 'hyper text markup language', 'hypo text markup language', 'the answer is not there', 2, 2, '02:54:07:am'),
('8', 8, 'what is the best framework for a PHP developer', 'codeigniter', 'laravel', 'wordpress', 'wix', 2, 2, '02:54:12:am'),
('8', 8, 'what operating system is best for hackers', 'windows OS', 'mac OS', 'chromebook OS', 'linux OS', 4, 3, '02:54:20:am'),
('2', 13, 'who is the father of heredity', 'EmmySoft', 'Lord Michael Faraday', 'Gregor mendel', 'George Bush', 3, 3, '09:28:47:am'),
('2', 13, 'who is the father of heredity', 'EmmySoft', 'Lord Michael Faraday', 'Gregor mendel', 'George Bush', 3, 2, '09:42:06:am');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
