-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 12, 2024 at 06:06 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.3.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projectsnhs`
--

-- --------------------------------------------------------

--
-- Table structure for table `announcement`
--

CREATE TABLE `announcement` (
  `id` int(11) NOT NULL,
  `date` varchar(30) CHARACTER SET latin1 NOT NULL,
  `announcement` varchar(500) CHARACTER SET latin1 NOT NULL,
  `title` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `announcement`
--

INSERT INTO `announcement` (`id`, `date`, `announcement`, `title`) VALUES
(1, '2024-06-10', 'we are now open for SY 2024 enrollment, you can now submit your forms by fill-upping the necessary documents.\r\n                        ', 'Enrollment 2024'),
(4, '2024-06-11', 'NO CLASSES TOMMORROW                          \r\n                        ', 'WALANG PASOK BUKAS');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `COURSE_ID` int(11) NOT NULL,
  `COURSE_NAME` varchar(30) NOT NULL,
  `COURSE_MAJOR` int(2) NOT NULL,
  `COURSE_LEVEL` varchar(50) NOT NULL DEFAULT '1',
  `COURSE_DESC` varchar(255) NOT NULL,
  `DEPT_ID` int(11) NOT NULL,
  `SETSEMESTER` varchar(90) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`COURSE_ID`, `COURSE_NAME`, `COURSE_MAJOR`, `COURSE_LEVEL`, `COURSE_DESC`, `DEPT_ID`, `SETSEMESTER`) VALUES
(2, '8', 8, '1', 'Junior Level', 37, ''),
(3, '9', 0, '1', 'Junior High', 37, ''),
(4, '10', 0, '1', 'Junior High', 37, ''),
(5, '11', 0, '1', 'Senior High', 33, ''),
(6, '12', 0, '1', 'Senior High', 35, ''),
(66, '7', 0, '1', 'secton 7', 0, ''),
(69, '7', 0, '1', 'qwq', 37, ''),
(70, '7', 0, '1', 'qq', 37, ''),
(71, '7', 0, '1', 'Junior High', 37, ''),
(72, '7', 0, '1', 'g7', 37, ''),
(73, '7', 0, '1', 'Junior Level', 37, ''),
(74, '8', 0, '1', 'Junior Level', 37, ''),
(75, '12', 0, '1', 'Senior Level', 34, ''),
(76, '11', 0, '1', 'Senior Level', 33, ''),
(77, '11', 0, '1', 'Senior Level', 33, ''),
(78, '7', 0, '1', 'Junior Level', 37, ''),
(79, '11', 0, '1', 'Senior Level', 33, ''),
(80, '7', 0, '1', 'Junior Level', 37, ''),
(81, '7', 7, '1', 'Junior Level', 37, '');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `DEPT_ID` int(11) NOT NULL,
  `DEPARTMENT_NAME` varchar(30) NOT NULL,
  `DEPARTMENT_DESC` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`DEPT_ID`, `DEPARTMENT_NAME`, `DEPARTMENT_DESC`) VALUES
(33, 'HUMMS', 'Humanities And Social Sciences.'),
(34, 'STEM', 'Science,Technology,Engineering and Mathematics'),
(35, 'ABM', 'Accountancy,Business and Management'),
(37, 'None', 'None   \r\n                      ');

-- --------------------------------------------------------

--
-- Table structure for table `schoolyr`
--

CREATE TABLE `schoolyr` (
  `SYID` int(11) NOT NULL,
  `AY` varchar(30) NOT NULL,
  `SEMESTER` varchar(20) NOT NULL,
  `COURSE_ID` int(11) NOT NULL,
  `IDNO` int(30) NOT NULL,
  `CATEGORY` varchar(30) NOT NULL DEFAULT 'ENROLLED',
  `DATE_RESERVED` datetime NOT NULL,
  `DATE_ENROLLED` datetime NOT NULL,
  `STATUS` varchar(30) NOT NULL DEFAULT 'New'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schoolyr`
--

INSERT INTO `schoolyr` (`SYID`, `AY`, `SEMESTER`, `COURSE_ID`, `IDNO`, `CATEGORY`, `DATE_RESERVED`, `DATE_ENROLLED`, `STATUS`) VALUES
(199, '2023-2024', 'Second', 30, 100000080, 'ENROLLED', '2023-09-16 00:00:00', '2023-09-16 00:00:00', 'New'),
(200, '2023-2024', 'First', 59, 1000000204, 'ENROLLED', '2023-10-07 00:00:00', '2023-10-07 00:00:00', 'New'),
(201, '2023-2024', '2023-2024', 60, 1000000205, 'ENROLLED', '2023-10-10 00:00:00', '2023-10-10 00:00:00', 'New'),
(202, '2023-2024', '2023-2024', 61, 1000000206, 'ENROLLED', '2023-10-11 00:00:00', '2023-10-11 00:00:00', 'New'),
(203, '2023-2024', '2023-2024', 62, 1000000209, 'ENROLLED', '2023-10-24 00:00:00', '2023-10-24 00:00:00', 'New'),
(204, '2023-2024', '2023-2024', 61, 1000000210, 'ENROLLED', '2023-11-03 00:00:00', '2023-11-03 00:00:00', 'New'),
(205, '2023-2024', '2023-2024', 63, 1000000211, 'ENROLLED', '2023-11-03 00:00:00', '2023-11-03 00:00:00', 'New'),
(206, '2024-2025', '2023-2024', 63, 1000000212, 'ENROLLED', '2024-01-23 00:00:00', '2024-01-23 00:00:00', 'New'),
(207, '2024-2025', '2023-2024', 0, 1000000214, 'ENROLLED', '2024-01-23 00:00:00', '2024-01-23 00:00:00', 'New'),
(208, '2024-2025', '2023-2024', 0, 1000000215, 'ENROLLED', '2024-01-23 00:00:00', '2024-01-23 00:00:00', 'New'),
(209, '2024-2025', '2023-2024', 0, 1000000216, 'ENROLLED', '2024-01-23 00:00:00', '2024-01-23 00:00:00', 'New'),
(210, '2024-2025', '2023-2024', 0, 1000000217, 'ENROLLED', '2024-01-23 00:00:00', '2024-01-23 00:00:00', 'New'),
(211, '2024-2025', '2023-2024', 0, 1000000218, 'ENROLLED', '2024-01-23 00:00:00', '2024-01-23 00:00:00', 'New'),
(212, '2024-2025', '2023-2024', 0, 1000000219, 'ENROLLED', '2024-01-23 00:00:00', '2024-01-23 00:00:00', 'New'),
(213, '2024-2025', '2023-2024', 0, 1000000219, 'ENROLLED', '2024-01-23 00:00:00', '2024-01-23 00:00:00', 'New'),
(214, '2024-2025', '2023-2024', 0, 1000000226, 'ENROLLED', '2024-06-07 00:00:00', '2024-06-07 00:00:00', 'New'),
(215, '2024-2025', '2023-2024', 0, 1000000227, 'ENROLLED', '2024-06-07 00:00:00', '2024-06-07 00:00:00', 'New'),
(216, '2024-2025', '2023-2024', 0, 1000000228, 'ENROLLED', '2024-06-07 00:00:00', '2024-06-07 00:00:00', 'New'),
(217, '2024-2025', '2026-2027', 0, 1000000231, 'ENROLLED', '2024-06-07 00:00:00', '2024-06-07 00:00:00', 'New'),
(218, '2024-2025', '2026-2027', 0, 1000000229, 'ENROLLED', '2024-06-07 00:00:00', '2024-06-07 00:00:00', 'New'),
(219, '2024-2025', '2026-2027', 0, 1000000230, 'ENROLLED', '2024-06-07 00:00:00', '2024-06-07 00:00:00', 'New'),
(220, '2024-2025', '2026-2027', 0, 1000000234, 'ENROLLED', '2024-06-10 00:00:00', '2024-06-10 00:00:00', 'New'),
(221, '2024-2025', '2026-2027', 0, 1000000233, 'ENROLLED', '2024-06-10 00:00:00', '2024-06-10 00:00:00', 'New'),
(222, '2024-2025', '2024-2025', 0, 1000000235, 'ENROLLED', '2024-06-11 00:00:00', '2024-06-11 00:00:00', 'New'),
(223, '2024-2025', '2024-2025', 0, 1000000237, 'ENROLLED', '2024-06-11 00:00:00', '2024-06-11 00:00:00', 'New'),
(224, '2024-2025', '2024-2025', 0, 1000000237, 'ENROLLED', '2024-06-11 00:00:00', '2024-06-11 00:00:00', 'New');

-- --------------------------------------------------------

--
-- Table structure for table `tblauto`
--

CREATE TABLE `tblauto` (
  `ID` int(11) NOT NULL,
  `autocode` varchar(255) DEFAULT NULL,
  `autoname` varchar(255) DEFAULT NULL,
  `appendchar` varchar(255) DEFAULT NULL,
  `autostart` int(11) DEFAULT 0,
  `autoend` int(11) DEFAULT 0,
  `incrementvalue` int(11) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tblauto`
--

INSERT INTO `tblauto` (`ID`, `autocode`, `autoname`, `appendchar`, `autostart`, `autoend`, `incrementvalue`) VALUES
(1, 'Asset', 'Asset', 'ASitem', 0, 3, 1),
(2, 'Trans', 'Transaction', 'TrAnS', 1, 5, 1),
(3, 'SIDNO', 'IDNO', '2015', 1000000, 238, 1),
(4, 'EMPLOYEE', 'EMPID', '020010', 0, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblinstructor`
--

CREATE TABLE `tblinstructor` (
  `INST_ID` int(11) NOT NULL,
  `INST_NAME` varchar(90) NOT NULL,
  `INST_MAJOR` varchar(90) NOT NULL,
  `INST_CONTACT` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblinstructor`
--

INSERT INTO `tblinstructor` (`INST_ID`, `INST_NAME`, `INST_MAJOR`, `INST_CONTACT`) VALUES
(32, 'kim namjoon', '9', 'Siakol'),
(33, 'kim sookjin', '10', 'Calialily'),
(34, 'Kinnam Jun', '10', 'Siakol');

-- --------------------------------------------------------

--
-- Table structure for table `tbllogs`
--

CREATE TABLE `tbllogs` (
  `LOGID` int(11) NOT NULL,
  `USERID` int(11) NOT NULL,
  `LOGDATETIME` datetime NOT NULL,
  `LOGROLE` varchar(55) NOT NULL,
  `LOGMODE` varchar(55) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbllogs`
--

INSERT INTO `tbllogs` (`LOGID`, `USERID`, `LOGDATETIME`, `LOGROLE`, `LOGMODE`) VALUES
(364, 1, '2023-10-10 05:36:07', 'Administrator', 'Logged in'),
(365, 1000000204, '2023-10-10 09:52:05', 'Student', 'Logged in'),
(366, 1, '2023-10-10 13:51:46', 'Administrator', 'Logged in'),
(367, 1, '2023-10-10 13:54:31', 'Administrator', 'Logged out'),
(368, 1, '2023-10-10 13:54:39', 'Administrator', 'Logged in'),
(369, 1, '2023-10-10 13:57:38', 'Administrator', 'Logged out'),
(370, 1, '2023-10-10 13:57:44', 'Administrator', 'Logged in'),
(371, 1, '2023-10-10 15:33:10', 'Administrator', 'Logged out'),
(372, 3, '2023-10-10 15:33:20', 'Registrar', 'Logged in'),
(373, 1000000204, '2023-10-10 15:34:43', 'Student', 'Logged out'),
(374, 1000000205, '2023-10-10 16:01:33', 'Student', 'Logged in'),
(375, 3, '2023-10-10 16:08:26', 'Registrar', 'Logged out'),
(376, 1, '2023-10-10 16:08:50', 'Administrator', 'Logged in'),
(377, 1000000205, '2023-10-10 16:09:04', 'Student', 'Logged out'),
(378, 1, '2023-10-11 08:08:05', 'Administrator', 'Logged in'),
(379, 1, '2023-10-11 08:37:42', 'Administrator', 'Logged out'),
(380, 3, '2023-10-11 08:37:55', 'Registrar', 'Logged in'),
(381, 3, '2023-10-11 08:53:51', 'Registrar', 'Logged out'),
(382, 1, '2023-10-11 08:53:59', 'Administrator', 'Logged in'),
(383, 1000000206, '2023-10-11 08:55:16', 'Student', 'Logged in'),
(384, 1, '2023-10-11 14:32:05', 'Administrator', 'Logged in'),
(385, 1, '2023-10-11 16:15:29', 'Administrator', 'Logged out'),
(386, 1, '2023-10-11 16:22:15', 'Administrator', 'Logged in'),
(387, 1000000204, '2023-10-12 06:01:23', 'Student', 'Logged in'),
(388, 1, '2023-10-12 06:41:30', 'Administrator', 'Logged in'),
(389, 1000000204, '2023-10-12 06:54:04', 'Student', 'Logged out'),
(390, 1000000206, '2023-10-12 06:54:15', 'Student', 'Logged in'),
(391, 1000000206, '2023-10-12 06:55:39', 'Student', 'Logged out'),
(392, 1, '2023-10-12 14:15:38', 'Administrator', 'Logged in'),
(393, 1000000206, '2023-10-24 02:24:09', 'Student', 'Logged in'),
(394, 1, '2023-10-24 02:25:24', 'Administrator', 'Logged in'),
(395, 1000000206, '2023-10-24 02:28:21', 'Student', 'Logged out'),
(396, 1000000206, '2023-10-24 02:29:58', 'Student', 'Logged out'),
(397, 1000000207, '2023-10-24 02:47:03', 'Student', 'Logged out'),
(398, 1, '2023-10-24 05:56:30', 'Administrator', 'Logged in'),
(399, 1000000206, '2023-10-24 06:58:38', 'Student', 'Logged in'),
(400, 1000000206, '2023-10-24 06:58:55', 'Student', 'Logged out'),
(401, 1000000208, '2023-10-24 07:25:42', 'Student', 'Logged out'),
(402, 1000000206, '2023-10-24 07:33:19', 'Student', 'Logged in'),
(403, 1000000206, '2023-10-24 07:39:15', 'Student', 'Logged out'),
(404, 1000000209, '2023-10-24 07:51:59', 'Student', 'Logged out'),
(405, 1000000209, '2023-10-24 07:52:47', 'Student', 'Logged in'),
(406, 1000000209, '2023-10-24 08:33:30', 'Student', 'Logged out'),
(407, 1000000206, '2023-10-24 08:33:41', 'Student', 'Logged in'),
(408, 1000000206, '2023-11-03 03:50:47', 'Student', 'Logged in'),
(409, 1000000206, '2023-11-03 03:50:53', 'Student', 'Logged out'),
(410, 1000000206, '2023-11-03 03:51:06', 'Student', 'Logged in'),
(411, 1000000206, '2023-11-03 03:51:12', 'Student', 'Logged out'),
(412, 1000000206, '2023-11-03 03:51:43', 'Student', 'Logged in'),
(413, 1000000206, '2023-11-03 04:01:42', 'Student', 'Logged out'),
(414, 1000000210, '2023-11-03 04:04:14', 'Student', 'Logged out'),
(415, 1000000210, '2023-11-03 04:04:26', 'Student', 'Logged in'),
(416, 1000000210, '2023-11-03 04:04:31', 'Student', 'Logged out'),
(417, 1000000210, '2023-11-03 04:23:25', 'Student', 'Logged in'),
(418, 1000000210, '2023-11-03 04:23:29', 'Student', 'Logged out'),
(419, 1000000210, '2023-11-03 04:23:41', 'Student', 'Logged in'),
(420, 1000000210, '2023-11-03 04:23:44', 'Student', 'Logged out'),
(421, 1000000210, '2023-11-03 04:25:42', 'Student', 'Logged in'),
(422, 1000000210, '2023-11-03 04:25:45', 'Student', 'Logged out'),
(423, 1, '2023-11-03 04:34:56', 'Administrator', 'Logged in'),
(424, 1, '2023-11-03 04:51:48', 'Administrator', 'Logged out'),
(425, 1, '2023-11-03 04:52:01', 'Administrator', 'Logged in'),
(426, 1, '2023-11-03 04:52:06', 'Administrator', 'Logged out'),
(427, 1, '2023-11-03 04:54:58', 'Administrator', 'Logged in'),
(428, 1, '2023-11-03 05:05:22', 'Administrator', 'Logged out'),
(429, 1000000206, '2023-11-03 12:38:52', 'Student', 'Logged in'),
(430, 1000000206, '2023-11-03 12:40:24', 'Student', 'Logged out'),
(431, 1000000206, '2023-11-03 12:54:02', 'Student', 'Logged in'),
(432, 1000000206, '2023-11-03 12:54:08', 'Student', 'Logged out'),
(433, 1000000206, '2023-11-03 13:02:20', 'Student', 'Logged in'),
(434, 1000000206, '2023-11-03 13:02:25', 'Student', 'Logged out'),
(435, 1000000207, '2023-11-03 13:02:33', 'Student', 'Logged in'),
(436, 1000000207, '2023-11-03 13:02:40', 'Student', 'Logged out'),
(437, 1000000209, '2023-11-03 13:02:49', 'Student', 'Logged in'),
(438, 1000000209, '2023-11-03 13:02:54', 'Student', 'Logged out'),
(439, 1000000210, '2023-11-03 13:03:01', 'Student', 'Logged in'),
(440, 1000000210, '2023-11-03 13:03:12', 'Student', 'Logged out'),
(441, 3, '2023-11-03 13:08:29', 'Registrar', 'Logged in'),
(442, 3, '2023-11-03 13:08:39', 'Registrar', 'Logged out'),
(443, 3, '2023-11-03 13:09:52', 'Registrar', 'Logged in'),
(444, 3, '2023-11-03 13:11:16', 'Registrar', 'Logged out'),
(445, 1, '2023-11-03 13:11:24', 'Administrator', 'Logged in'),
(446, 1000000206, '2023-11-03 13:15:05', 'Student', 'Logged in'),
(447, 1000000206, '2023-11-03 13:16:45', 'Student', 'Logged out'),
(448, 1000000211, '2023-11-03 13:22:11', 'Student', 'Logged out'),
(449, 1, '2023-11-03 13:48:52', 'Administrator', 'Logged out'),
(450, 1000000206, '2023-11-04 03:57:03', 'Student', 'Logged in'),
(451, 1000000206, '2023-11-04 03:57:22', 'Student', 'Logged out'),
(452, 1000000210, '2023-11-04 07:38:39', 'Student', 'Logged in'),
(453, 1000000210, '2023-11-04 07:38:46', 'Student', 'Logged out'),
(454, 1000000206, '2023-11-04 12:48:21', 'Student', 'Logged in'),
(455, 1000000206, '2023-11-04 13:05:39', 'Student', 'Logged out'),
(456, 1000000210, '2023-11-05 12:41:38', 'Student', 'Logged in'),
(457, 1000000210, '2023-11-05 12:41:42', 'Student', 'Logged out'),
(458, 1000000210, '2023-11-06 04:18:42', 'Student', 'Logged out'),
(459, 3, '2023-11-06 07:19:10', 'Registrar', 'Logged in'),
(460, 3, '2023-11-06 07:19:20', 'Registrar', 'Logged out'),
(461, 3, '2023-11-06 07:19:42', 'Registrar', 'Logged in'),
(462, 3, '2023-11-06 07:20:17', 'Registrar', 'Logged out'),
(463, 3, '2023-11-06 07:21:09', 'Registrar', 'Logged in'),
(464, 3, '2023-11-06 07:25:56', 'Registrar', 'Logged out'),
(465, 1, '2023-11-06 07:26:03', 'Administrator', 'Logged in'),
(466, 1, '2023-11-06 07:26:31', 'Administrator', 'Logged out'),
(467, 1, '2023-11-06 07:26:43', 'Administrator', 'Logged in'),
(468, 1, '2023-11-06 07:26:55', 'Administrator', 'Logged out'),
(469, 3, '2023-11-06 07:27:01', 'Registrar', 'Logged in'),
(470, 3, '2023-11-06 07:27:05', 'Registrar', 'Logged out'),
(471, 1, '2023-11-06 07:27:13', 'Administrator', 'Logged in'),
(472, 1, '2023-11-06 07:28:03', 'Administrator', 'Logged out'),
(473, 1, '2023-11-06 07:28:57', 'Administrator', 'Logged in'),
(474, 1, '2023-11-06 07:28:59', 'Administrator', 'Logged out'),
(475, 1, '2023-11-06 07:47:47', 'Administrator', 'Logged in'),
(476, 1, '2023-11-06 07:48:43', 'Administrator', 'Logged out'),
(477, 1, '2023-11-06 08:08:19', 'Administrator', 'Logged in'),
(478, 1, '2023-11-06 08:08:21', 'Administrator', 'Logged out'),
(479, 1, '2023-11-06 12:17:46', 'Administrator', 'Logged in'),
(480, 1, '2023-11-06 12:17:56', 'Administrator', 'Logged out'),
(481, 1000000210, '2023-11-06 13:20:24', 'Student', 'Logged out'),
(482, 1000000210, '2023-11-06 13:21:56', 'Student', 'Logged out'),
(483, 1000000210, '2023-11-06 13:22:55', 'Student', 'Logged out'),
(484, 1000000210, '2023-11-06 13:25:02', 'Student', 'Logged out'),
(485, 1000000210, '2023-11-06 13:25:57', 'Student', 'Logged out'),
(486, 1000000210, '2023-11-06 13:31:47', 'Student', 'Logged out'),
(487, 1000000212, '2023-11-06 13:35:01', 'Student', 'Logged out'),
(488, 1000000212, '2023-11-06 13:35:15', 'Student', 'Logged in'),
(489, 1000000212, '2023-11-06 13:35:28', 'Student', 'Logged out'),
(490, 1000000212, '2023-11-06 13:40:04', 'Student', 'Logged in'),
(491, 1000000212, '2023-11-06 13:41:02', 'Student', 'Logged out'),
(492, 1000000212, '2023-11-06 14:08:19', 'Student', 'Logged out'),
(493, 1000000212, '2023-11-06 14:15:56', 'Student', 'Logged out'),
(494, 1000000212, '2023-11-06 14:16:13', 'Student', 'Logged out'),
(495, 1000000212, '2023-11-07 02:13:53', 'Student', 'Logged out'),
(496, 1, '2023-11-07 02:22:11', 'Administrator', 'Logged out'),
(497, 1, '2023-11-07 03:13:13', 'Administrator', 'Logged out'),
(498, 1, '2023-11-07 03:13:28', 'Administrator', 'Logged out'),
(499, 1, '2023-11-07 03:25:11', 'Administrator', 'Logged out'),
(500, 1, '2023-11-07 03:26:06', 'Administrator', 'Logged out'),
(501, 1, '2023-11-07 03:29:39', 'Administrator', 'Logged out'),
(502, 1, '2023-11-07 03:30:23', 'Administrator', 'Logged out'),
(503, 3, '2023-11-07 03:30:32', 'Registrar', 'Logged in'),
(504, 3, '2023-11-07 03:36:11', 'Registrar', 'Logged out'),
(505, 1, '2023-11-07 03:36:48', 'Administrator', 'Logged out'),
(506, 1, '2023-11-07 04:05:07', 'Administrator', 'Logged out'),
(507, 1000000212, '2023-11-07 04:46:16', 'Student', 'Logged out'),
(508, 1000000212, '2023-11-07 04:46:35', 'Student', 'Logged out'),
(509, 1, '2023-11-07 04:47:22', 'Administrator', 'Logged out'),
(510, 1000000234, '2024-01-23 08:54:07', 'Student', 'Logged out'),
(511, 1, '2024-01-23 09:02:18', 'Administrator', 'Logged out'),
(512, 1000000213, '2024-01-23 09:08:52', 'Student', 'Logged out'),
(513, 1000000214, '2024-01-23 11:59:15', 'Student', 'Logged out'),
(514, 1000000215, '2024-01-23 12:01:34', 'Student', 'Logged out'),
(515, 1000000216, '2024-01-23 13:08:28', 'Student', 'Logged out'),
(516, 1000000217, '2024-01-23 16:57:25', 'Student', 'Logged out'),
(517, 1000000218, '2024-01-23 18:26:10', 'Student', 'Logged out'),
(518, 1000000219, '2024-01-23 20:56:47', 'Student', 'Logged out'),
(519, 1, '2024-01-23 20:59:22', 'Administrator', 'Logged out'),
(520, 1000000219, '2024-01-23 21:00:31', 'Student', 'Logged in'),
(521, 1000000219, '2024-01-23 21:00:41', 'Student', 'Logged out'),
(522, 1000000219, '2024-01-23 21:34:51', 'Student', 'Logged in'),
(523, 1000000219, '2024-01-23 21:35:00', 'Student', 'Logged out'),
(524, 1000000220, '2024-01-23 22:50:23', 'Student', 'Logged out'),
(525, 1000000219, '2024-01-29 04:49:05', 'Student', 'Logged in'),
(526, 1000000219, '2024-01-29 04:49:11', 'Student', 'Logged out'),
(527, 1000000221, '2024-01-29 04:54:24', 'Student', 'Logged out'),
(528, 1000000221, '2024-01-29 04:55:06', 'Student', 'Logged in'),
(529, 1000000221, '2024-01-29 04:55:12', 'Student', 'Logged out'),
(530, 1000000221, '2024-01-29 04:56:01', 'Student', 'Logged in'),
(531, 1000000221, '2024-01-29 04:56:05', 'Student', 'Logged out'),
(532, 1000000221, '2024-01-29 04:56:38', 'Student', 'Logged in'),
(533, 1000000221, '2024-01-29 04:57:38', 'Student', 'Logged out'),
(534, 1000000220, '2024-01-29 04:57:49', 'Student', 'Logged in'),
(535, 1000000220, '2024-01-29 04:58:55', 'Student', 'Logged out'),
(536, 1000000220, '2024-01-29 04:59:02', 'Student', 'Logged in'),
(537, 1000000220, '2024-01-29 05:01:28', 'Student', 'Logged out'),
(538, 1000000221, '2024-01-29 05:07:22', 'Student', 'Logged in'),
(539, 1000000221, '2024-01-29 05:07:41', 'Student', 'Logged out'),
(540, 1000000222, '2024-01-29 05:09:34', 'Student', 'Logged out'),
(541, 1, '2024-01-29 15:18:54', 'Administrator', 'Logged out'),
(542, 1, '2024-06-06 09:33:00', 'Administrator', 'Logged out'),
(543, 1, '2024-06-06 09:33:16', 'Administrator', 'Logged out'),
(544, 1000000223, '2024-06-06 10:15:30', 'Student', 'Logged out'),
(545, 1000000223, '2024-06-06 10:45:51', 'Student', 'Logged in'),
(546, 1000000223, '2024-06-06 10:46:10', 'Student', 'Logged out'),
(547, 1000000224, '2024-06-07 05:00:49', 'Student', 'Logged out'),
(548, 1, '2024-06-07 05:01:05', 'Administrator', 'Logged out'),
(549, 1, '2024-06-07 05:03:30', 'Administrator', 'Logged out'),
(550, 1000000225, '2024-06-07 05:16:30', 'Student', 'Logged out'),
(551, 1000000226, '2024-06-07 05:39:53', 'Student', 'Logged out'),
(552, 1, '2024-06-07 05:40:40', 'Administrator', 'Logged out'),
(553, 1000000226, '2024-06-07 05:41:00', 'Student', 'Logged in'),
(554, 1000000226, '2024-06-07 05:41:30', 'Student', 'Logged out'),
(555, 1000000227, '2024-06-07 05:45:19', 'Student', 'Logged out'),
(556, 1, '2024-06-07 05:49:35', 'Administrator', 'Logged out'),
(557, 1000000228, '2024-06-07 05:57:44', 'Student', 'Logged out'),
(558, 1, '2024-06-07 05:59:17', 'Administrator', 'Logged out'),
(559, 1, '2024-06-07 07:02:54', 'Administrator', 'Logged out'),
(560, 1, '2024-06-07 09:35:30', 'Administrator', 'Logged out'),
(561, 1000000229, '2024-06-07 09:40:48', 'Student', 'Logged out'),
(562, 1000000232, '2024-06-10 03:20:26', 'Student', 'Logged out'),
(563, 1000000233, '2024-06-10 04:11:14', 'Student', 'Logged out'),
(564, 1, '2024-06-10 04:38:11', 'Administrator', 'Logged out'),
(565, 1000000234, '2024-06-10 04:40:37', 'Student', 'Logged out'),
(566, 1, '2024-06-10 06:12:06', 'Administrator', 'Logged out'),
(567, 1, '2024-06-10 07:27:30', 'Administrator', 'Logged out'),
(568, 1, '2024-06-10 07:28:12', 'Administrator', 'Logged out'),
(569, 1, '2024-06-10 08:18:29', 'Administrator', 'Logged out'),
(570, 1, '2024-06-10 08:21:46', 'Administrator', 'Logged out'),
(571, 1000000234, '2024-06-10 08:24:53', 'Student', 'Logged in'),
(572, 1000000234, '2024-06-10 08:26:32', 'Student', 'Logged out'),
(573, 1, '2024-06-10 10:16:09', 'Administrator', 'Logged out'),
(574, 1, '2024-06-10 11:08:12', 'Administrator', 'Logged out'),
(575, 1, '2024-06-11 05:28:31', 'Administrator', 'Logged out'),
(576, 1000000235, '2024-06-11 05:30:53', 'Student', 'Logged out'),
(577, 1, '2024-06-11 05:31:22', 'Administrator', 'Logged out'),
(578, 1000000235, '2024-06-11 05:31:41', 'Student', 'Logged in'),
(579, 1000000235, '2024-06-11 05:32:24', 'Student', 'Logged out'),
(580, 1, '2024-06-11 05:34:46', 'Administrator', 'Logged out'),
(581, 1000000236, '2024-06-11 05:35:06', 'Student', 'Logged out'),
(582, 1, '2024-06-11 09:39:12', 'Administrator', 'Logged out'),
(583, 1000000237, '2024-06-12 02:05:38', 'Student', 'Logged out'),
(584, 1000000235, '2024-06-12 04:02:08', 'Student', 'Logged in');

-- --------------------------------------------------------

--
-- Table structure for table `tblsection`
--

CREATE TABLE `tblsection` (
  `section_id` int(11) NOT NULL,
  `section_name` varchar(255) NOT NULL,
  `section_level` int(2) NOT NULL,
  `deleted_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tblsection`
--

INSERT INTO `tblsection` (`section_id`, `section_name`, `section_level`, `deleted_date`) VALUES
(4, 'ST. JOHN MARY VIANEY', 7, NULL),
(5, 'ST. LAWRENCE', 7, NULL),
(6, 'ST. HYACINTCH', 7, NULL),
(7, 'ST. AUGUSTIN', 7, NULL),
(8, 'ST. VINCENT', 8, NULL),
(9, 'ST. GREGORY', 8, NULL),
(10, 'ST. JEROME', 8, NULL),
(11, 'ST. LORENZO', 8, NULL),
(12, 'ST. MARK', 9, NULL),
(13, 'ST. LUKE', 9, NULL),
(14, 'ST. MARY', 9, NULL),
(15, 'ST. MICHAEL', 9, NULL),
(16, 'ST. IGNACIOUS', 9, NULL),
(17, 'ST. FRANCIS', 9, NULL),
(18, 'ST. THERESE', 9, NULL),
(19, 'ST. ELIZABETH', 10, NULL),
(20, 'ST. MARGARETH', 10, NULL),
(21, 'ST. CECILIA', 10, NULL),
(22, 'ST. GERTRUDE', 10, NULL),
(23, 'ST. CLAIRE', 10, NULL),
(24, '(HUMMS) ALEXANDRITE', 11, NULL),
(25, '(HUMMS) SAFIRE', 11, NULL),
(26, '(HUMSS) ARCHIMEDES', 12, NULL),
(27, '(HUMMS) COPPERNICUS', 12, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tblsemester`
--

CREATE TABLE `tblsemester` (
  `SEMID` int(11) NOT NULL,
  `SEMESTER` varchar(90) NOT NULL,
  `SETSEM` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblsemester`
--

INSERT INTO `tblsemester` (`SEMID`, `SEMESTER`, `SETSEM`) VALUES
(1, '2023-2024', 0),
(2, '2024-2025', 1),
(4, '2026-2027', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblstuddetails`
--

CREATE TABLE `tblstuddetails` (
  `DETAIL_ID` int(11) NOT NULL,
  `GUARDIAN` varchar(255) NOT NULL,
  `GCONTACT` varchar(40) NOT NULL,
  `IDNO` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblstuddetails`
--

INSERT INTO `tblstuddetails` (`DETAIL_ID`, `GUARDIAN`, `GCONTACT`, `IDNO`) VALUES
(156, 'wala', '', 1000000226),
(157, 'walana', '', 1000000227),
(158, 'meron na', '09656565656', 1000000228),
(159, 'ronal', '09676656565', 1000000229),
(160, 'asaasasas', '03959656665', 1000000230),
(161, 'Addatu', '11111111111', 1000000231),
(162, 'asdsadsad', '123213213', 1000000232),
(163, 'ronald', '09665548777', 1000000233),
(164, 'QWERTY', '09568174111', 1000000234),
(165, 'ADMIN', '09656665566', 1000000235),
(166, 'dfdfdf', '09845454154', 1000000236),
(167, 'ronal', '09562231123', 1000000237);

-- --------------------------------------------------------

--
-- Table structure for table `tblstudent`
--

CREATE TABLE `tblstudent` (
  `S_ID` int(11) NOT NULL,
  `IDNO` int(20) NOT NULL,
  `section_id` int(11) DEFAULT NULL,
  `FNAME` varchar(40) NOT NULL,
  `LNAME` varchar(40) NOT NULL,
  `MNAME` varchar(40) NOT NULL,
  `SEX` varchar(10) NOT NULL DEFAULT 'Male',
  `BDAY` date NOT NULL,
  `BPLACE` text NOT NULL,
  `STATUS` varchar(30) NOT NULL,
  `AGE` int(30) NOT NULL,
  `NATIONALITY` varchar(40) NOT NULL,
  `RELIGION` varchar(255) NOT NULL,
  `CONTACT_NO` varchar(40) NOT NULL,
  `HOME_ADD` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `student_status` text NOT NULL,
  `YEARLEVEL` int(3) NOT NULL,
  `STRAND` varchar(30) NOT NULL,
  `COURSE_ID` int(11) NOT NULL,
  `STUDPHOTO` varchar(255) NOT NULL,
  `STUDFILE` varchar(255) NOT NULL,
  `SEMESTER` varchar(30) NOT NULL,
  `SYEAR` varchar(30) NOT NULL,
  `NewEnrollees` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblstudent`
--

INSERT INTO `tblstudent` (`S_ID`, `IDNO`, `section_id`, `FNAME`, `LNAME`, `MNAME`, `SEX`, `BDAY`, `BPLACE`, `STATUS`, `AGE`, `NATIONALITY`, `RELIGION`, `CONTACT_NO`, `HOME_ADD`, `email`, `password`, `student_status`, `YEARLEVEL`, `STRAND`, `COURSE_ID`, `STUDPHOTO`, `STUDFILE`, `SEMESTER`, `SYEAR`, `NewEnrollees`) VALUES
(155, 1000000226, 5, 'Jhasper', 'Frio', 'N', 'Male', '2000-03-07', 'dsds', 'Single', 0, 'pihu', 'Romantic Catholic', '09234567787', 'Cagayan', 'admin', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'New', 8, 'TBA', 0, '', 'student_file/1710637656666.jpg', '2023-2024', '', 0),
(156, 1000000227, NULL, 'qwq', 'qwqw', 'q', 'Female', '1999-10-13', 'qwq', 'Single', 0, '09767676757', 'qwqwq', '09767676757', 'qwqwqw', 'qwerty', 'f865b53623b121fd34ee5426c792e5c33af8c227', 'New', 8, 'TBA', 0, '', 'student_file/1710720657917.jpg', '2023-2024', '', 0),
(157, 1000000228, NULL, 'mark', 'hjgh', 'g', 'Female', '2000-02-07', 'Piat Cagayan', 'Single', 0, 'Black American', 'sdss', '09651432232', 'wdwd', 'youall', 'b1b3773a05c0ed0176787a4f1574ff0075f7521e', 'New', 8, 'TBA', 0, '', '', '2023-2024', '', 0),
(158, 1000000229, NULL, 'Durgi', 'Dora', 's', 'Female', '2001-02-07', 'Piat', 'Single', 0, 'Filam', 'ROmantic Catholic', '09651465587', 'asasa', 'durgijhjh', '80f4c56df4c81a8b0782d32f554f7fe44eace976', 'New', 7, 'TBA', 0, '', '', '2026-2027', '', 0),
(159, 1000000230, NULL, 'sasas', 'sasasas', 'a', 'Female', '2000-02-07', 'Piat Cagayan', 'Single', 0, 'pihu', 'qwqwq', '09865654564', 'asasasasasa', 'administrative', 'd033e22ae348aeb5660fc2140aec35850c4da997', 'New', 7, 'TBA', 0, '', '', '2026-2027', '', 0),
(160, 1000000231, NULL, 'Jhasper', 'Addatu', 'N', 'Male', '1966-06-07', 'Piat', 'Single', 0, 'Filam', 'Roman Catholic ', '11111111111', 'Piat', 'Addatu', '8cb2237d0679ca88db6464eac60da96345513964', 'New', 10, 'STEM', 0, '', '', '2026-2027', '', 0),
(161, 1000000232, 5, 'sapdoapsdo', 'adsad', 'a', 'Female', '2000-05-05', 'asdsada', 'Single', 0, 'asd', 'zxc', '12123213213', 'apsodapsdosapd', 'addatujhasper0@gmail.com', '$2y$10$IegMo2y.ZhJl.MTpNZdof.0dkTpSn3H0laCo2VIHJe1BJom74SPjq', 'New', 7, 'TBA', 0, '', '', '2026-2027', '', 1),
(162, 1000000233, NULL, 'wewewd', 'dfdfdf', 'b', 'Male', '1997-01-10', 'calayuan', 'Single', 0, 'Filam', 'ROmantic Catholic', '09887454552', 'apsodapsdosapd', 'wait', '205b614b0be903bca26abb8d0c90ee3fa1f02615', 'New', 7, 'MARITES', 0, '', 'student_file/MEDICAL-CERT-UPDATED.pdf', '2026-2027', '', 0),
(163, 1000000234, NULL, 'Mark', 'DelaCRUZ', 'b', 'Male', '1999-06-08', 'calayuan', 'Married', 0, 'Filam', 'ROmantic Catholic', '09651432877', 'cALAYAN, island', 'one0onebinary@gmail.com', '$2y$10$ckWFT5CZ5qPZMk.7ucwj3.kfh1Z89Tr6KG.EaPhTsyHTqFijXBaEm', 'New', 12, 'ICT', 0, 'student_image/IMG_SEGMENT_20240601_070755.png', 'student_file/SSS-SICKNESS-NOTIFICATION-FORM-2015 (1).pdf', '2026-2027', '', 0),
(164, 1000000235, NULL, 'MARK', 'MARK', 'M', 'Female', '2004-01-11', 'Piat', 'Single', 0, '09564445455', 'ROmantic Catholic', '09564445455', 'CLAYAN', 'aimyam08@gmail.com', '80f4c56df4c81a8b0782d32f554f7fe44eace976', 'New', 7, 'TBA', 0, '', '', '2024-2025', '', 0),
(165, 1000000236, 19, 'qwerty', 'qwerty', 'q', 'Female', '1995-06-06', 'asdsada', 'Married', 0, 'Filam', 'ROmantic Catholic', '09564654644', 'apsodapsdosapd', 'aimyam10@gmail.com', '80f4c56df4c81a8b0782d32f554f7fe44eace976', 'New', 10, 'TBA', 0, '', '', '2024-2025', '', 1),
(166, 1000000237, 27, 'wakowako', 'wako', 'a', 'Female', '2002-02-13', 'asdsada', 'Married', 0, 'dfdfd', 'ROmantic Catholic', '09856421232', 'spidjij', 'mronel8584@gmail.com', '80f4c56df4c81a8b0782d32f554f7fe44eace976', 'New', 12, 'HUMSS', 0, '', '', '2024-2025', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `useraccounts`
--

CREATE TABLE `useraccounts` (
  `ACCOUNT_ID` int(11) NOT NULL,
  `ACCOUNT_NAME` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_pass` text NOT NULL,
  `ACCOUNT_TYPE` varchar(30) NOT NULL,
  `EMPID` int(11) NOT NULL,
  `USERIMAGE` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `useraccounts`
--

INSERT INTO `useraccounts` (`ACCOUNT_ID`, `ACCOUNT_NAME`, `user_email`, `user_pass`, `ACCOUNT_TYPE`, `EMPID`, `USERIMAGE`) VALUES
(1, 'admin', 'snhsmain3@gmail.com', '$2y$10$khoeuRXYLUn4eCtiD9SB1OZkj2Wg0rM/isyGtIanbe5N2275HldN2', 'Administrator', 1234, 'photos/04.jpg'),
(3, 'admin1', 'registrarsnhs@gmail.com', '$2y$10$khoeuRXYLUn4eCtiD9SB1OZkj2Wg0rM/isyGtIanbe5N2275HldN2', 'Registrar', 0, 'photos/01.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `announcement`
--
ALTER TABLE `announcement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`COURSE_ID`),
  ADD KEY `DEPT_ID` (`DEPT_ID`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`DEPT_ID`);

--
-- Indexes for table `schoolyr`
--
ALTER TABLE `schoolyr`
  ADD PRIMARY KEY (`SYID`),
  ADD KEY `IDNO` (`IDNO`);

--
-- Indexes for table `tblauto`
--
ALTER TABLE `tblauto`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `autocode` (`autocode`);

--
-- Indexes for table `tblinstructor`
--
ALTER TABLE `tblinstructor`
  ADD PRIMARY KEY (`INST_ID`);

--
-- Indexes for table `tbllogs`
--
ALTER TABLE `tbllogs`
  ADD PRIMARY KEY (`LOGID`);

--
-- Indexes for table `tblsection`
--
ALTER TABLE `tblsection`
  ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `tblsemester`
--
ALTER TABLE `tblsemester`
  ADD PRIMARY KEY (`SEMID`);

--
-- Indexes for table `tblstuddetails`
--
ALTER TABLE `tblstuddetails`
  ADD PRIMARY KEY (`DETAIL_ID`),
  ADD KEY `IDNO` (`IDNO`);

--
-- Indexes for table `tblstudent`
--
ALTER TABLE `tblstudent`
  ADD PRIMARY KEY (`S_ID`),
  ADD UNIQUE KEY `IDNO` (`IDNO`);

--
-- Indexes for table `useraccounts`
--
ALTER TABLE `useraccounts`
  ADD PRIMARY KEY (`ACCOUNT_ID`),
  ADD UNIQUE KEY `ACCOUNT_USERNAME` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `announcement`
--
ALTER TABLE `announcement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `COURSE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `DEPT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `schoolyr`
--
ALTER TABLE `schoolyr`
  MODIFY `SYID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=225;

--
-- AUTO_INCREMENT for table `tblauto`
--
ALTER TABLE `tblauto`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblinstructor`
--
ALTER TABLE `tblinstructor`
  MODIFY `INST_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tbllogs`
--
ALTER TABLE `tbllogs`
  MODIFY `LOGID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=585;

--
-- AUTO_INCREMENT for table `tblsection`
--
ALTER TABLE `tblsection`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tblsemester`
--
ALTER TABLE `tblsemester`
  MODIFY `SEMID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tblstuddetails`
--
ALTER TABLE `tblstuddetails`
  MODIFY `DETAIL_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT for table `tblstudent`
--
ALTER TABLE `tblstudent`
  MODIFY `S_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=167;

--
-- AUTO_INCREMENT for table `useraccounts`
--
ALTER TABLE `useraccounts`
  MODIFY `ACCOUNT_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
