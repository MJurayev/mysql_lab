-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 07, 2021 at 09:39 AM
-- Server version: 10.3.13-MariaDB
-- PHP Version: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `college3`
--

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(7) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `middlename` varchar(30) NOT NULL,
  `address` text NOT NULL,
  `stage` int(2) DEFAULT 0,
  `phone` varchar(10) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `category` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `surname`, `name`, `middlename`, `address`, `stage`, `phone`, `birth_date`, `category`) VALUES
(3, 'Jurayev', 'Mansur', 'O\'ktam o\'g\'li', 'Chiroqchi tumani Navruz qishlog\'i', 1, '996672106', '2018-11-07', 'o\'rta'),
(4, 'Malikov', 'Muhiddin', 'Odil o\'g\'li', 'Chiroqchi', 2, '992323233', '2000-10-05', 'oliy');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `id` int(7) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`id`, `name`) VALUES
(12899, 'Avtomobil sozlik'),
(12904, 'Qayta ishlash texnolosgiyalari'),
(12907, 'asd'),
(12908, 'asdasd'),
(12909, 'kjhaklkj'),
(12910, 'asdasdasdasd'),
(12911, 'deleted2121'),
(12912, 'sdf');

-- --------------------------------------------------------

--
-- Table structure for table `lessons`
--

CREATE TABLE `lessons` (
  `id` int(11) NOT NULL,
  `employee_id` int(7) NOT NULL,
  `pupil_id` int(7) DEFAULT NULL,
  `subject_id` int(7) DEFAULT NULL,
  `day_of_week` varchar(20) DEFAULT NULL,
  `para` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `lessons`
--

INSERT INTO `lessons` (`id`, `employee_id`, `pupil_id`, `subject_id`, `day_of_week`, `para`) VALUES
(1, 3, 3, 5, 'Dushanba', 1),
(2, 4, 3, 6, 'Dushanba', 1),
(3, 4, 2, 6, 'Dushanba', 1),
(4, 4, 2, 6, 'Dushanba', 2),
(5, 3, 1, 3, 'Chorshanba', 2),
(6, 3, 1, 2, 'Dushanba', 3),
(7, 3, 1, 2, 'Dushanba', 3),
(8, 3, 1, 2, 'Dushanba', 3),
(9, 3, 3, 4, 'Seshanba', 3);

-- --------------------------------------------------------

--
-- Stand-in structure for view `lessons_view`
-- (See below for the actual view)
--
CREATE TABLE `lessons_view` (
`id` int(11)
,`employee_surname` varchar(30)
,`employee_name` varchar(30)
,`employee_middlename` varchar(30)
,`pupils_surname` varchar(30)
,`pupils_name` varchar(30)
,`pupils_middlename` varchar(30)
,`subject` varchar(30)
,`para` int(1)
,`day_of_week` varchar(20)
);

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `id` int(11) NOT NULL,
  `pupil_id` int(7) DEFAULT NULL,
  `lesson_id` int(7) DEFAULT NULL,
  `mark` int(3) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `marks`
--

INSERT INTO `marks` (`id`, `pupil_id`, `lesson_id`, `mark`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 4, '2020-11-23 16:15:26', '2020-11-23 16:17:54'),
(2, 2, 1, 5, '2020-11-23 16:15:26', '2020-11-23 16:17:54'),
(3, 1, 1, 3, '2020-11-28 07:10:04', '2020-11-28 07:10:04'),
(4, 1, 5, 3, '2021-04-07 06:34:41', '2021-04-07 06:34:41'),
(5, 1, 5, 3, '2021-04-07 06:35:19', '2021-04-07 06:35:19'),
(6, 37, 3, 4, '2021-04-07 06:36:27', '2021-04-07 06:36:27');

-- --------------------------------------------------------

--
-- Stand-in structure for view `marks_view`
-- (See below for the actual view)
--
CREATE TABLE `marks_view` (
`id` int(11)
,`FISH` varchar(92)
,`subject` varchar(30)
,`mark` int(3)
);

-- --------------------------------------------------------

--
-- Table structure for table `pupils`
--

CREATE TABLE `pupils` (
  `id` int(7) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `name` varchar(30) NOT NULL,
  `middlename` varchar(30) NOT NULL,
  `address` text NOT NULL,
  `grade` int(1) DEFAULT 1,
  `phone` varchar(10) DEFAULT NULL,
  `birth_date` date DEFAULT NULL,
  `faculty_id` int(6) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pupils`
--

INSERT INTO `pupils` (`id`, `surname`, `name`, `middlename`, `address`, `grade`, `phone`, `birth_date`, `faculty_id`) VALUES
(1, 'Jurayev', 'Mansu\'&quot;\\&quot;r', 'O\'ktam o\'g\'li', 'Chiroqchi tumani Navruz qishlog\'i 91-uy', 1, '996672106', '2020-11-01', 12904),
(3, 'Malikov', 'Muhiddin', 'Odil o\'g\'li', 'Chiroqchi tumani Navruz qishlog\'i', 1, '99667210', '2020-11-24', 12910),
(37, 'kjhkjhkj', 'jkhjkhjk', 'kjhjkh', 'kjhkjhjk', 2, '12121212', '2001-12-12', 12904),
(39, ';\'\'als;\'', 'asd', 'mnbnbnmb', 'kasdkjlaskhdkljashlkd', 2, '996672106', '2020-10-29', 12910),
(41, 'asass', 'asas', '2323', 'asass', 2, '23232323', '2020-11-11', 12899);

-- --------------------------------------------------------

--
-- Stand-in structure for view `pupils_view`
-- (See below for the actual view)
--
CREATE TABLE `pupils_view` (
`id` int(7)
,`surname` varchar(30)
,`name` varchar(30)
,`middlename` varchar(30)
,`address` text
,`grade` int(1)
,`phone` varchar(10)
,`birth_date` date
,`faculty` varchar(30)
);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(7) NOT NULL,
  `name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`) VALUES
(2, 'Marematika fanlari'),
(3, 'Fizika'),
(4, 'CHQBT'),
(5, 'Avtomobil tuzilishi'),
(6, 'ATX'),
(7, 'Ingliz tili'),
(8, 'Algebra');

-- --------------------------------------------------------

--
-- Structure for view `lessons_view`
--
DROP TABLE IF EXISTS `lessons_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `lessons_view`  AS  select `lessons`.`id` AS `id`,`employees`.`surname` AS `employee_surname`,`employees`.`name` AS `employee_name`,`employees`.`middlename` AS `employee_middlename`,`pupils`.`surname` AS `pupils_surname`,`pupils`.`name` AS `pupils_name`,`pupils`.`middlename` AS `pupils_middlename`,`subjects`.`name` AS `subject`,`lessons`.`para` AS `para`,`lessons`.`day_of_week` AS `day_of_week` from (((`lessons` join `employees` on(`lessons`.`employee_id` = `employees`.`id`)) join `pupils` on(`lessons`.`pupil_id` = `pupils`.`id`)) join `subjects` on(`lessons`.`subject_id` = `subjects`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `marks_view`
--
DROP TABLE IF EXISTS `marks_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `marks_view`  AS  select `lessons`.`id` AS `id`,concat(`pupils`.`surname`,' ',`pupils`.`name`,' ',`pupils`.`middlename`) AS `FISH`,(select `subjects`.`name` from `subjects` where `subjects`.`id` = `lessons`.`subject_id`) AS `subject`,`marks`.`mark` AS `mark` from ((`marks` join `lessons` on(`marks`.`lesson_id` = `lessons`.`id`)) join `pupils` on(`marks`.`pupil_id` = `pupils`.`id`)) ;

-- --------------------------------------------------------

--
-- Structure for view `pupils_view`
--
DROP TABLE IF EXISTS `pupils_view`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`%` SQL SECURITY DEFINER VIEW `pupils_view`  AS  select `pupils`.`id` AS `id`,`pupils`.`surname` AS `surname`,`pupils`.`name` AS `name`,`pupils`.`middlename` AS `middlename`,`pupils`.`address` AS `address`,`pupils`.`grade` AS `grade`,`pupils`.`phone` AS `phone`,`pupils`.`birth_date` AS `birth_date`,`faculty`.`name` AS `faculty` from (`pupils` join `faculty` on(`pupils`.`faculty_id` = `faculty`.`id`)) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lessons`
--
ALTER TABLE `lessons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pupils`
--
ALTER TABLE `pupils`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12913;

--
-- AUTO_INCREMENT for table `lessons`
--
ALTER TABLE `lessons`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `marks`
--
ALTER TABLE `marks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pupils`
--
ALTER TABLE `pupils`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
