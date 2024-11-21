-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 13, 2023 at 07:57 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `al_class`
--

-- --------------------------------------------------------

--
-- Table structure for table `class`
--

CREATE TABLE `class` (
  `class_id` int(11) NOT NULL,
  `grade` varchar(10) DEFAULT NULL,
  `subject_id` varchar(50) NOT NULL,
  `class_type` varchar(50) DEFAULT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class`
--

INSERT INTO `class` (`class_id`, `grade`, `subject_id`, `class_type`, `time_stamp`) VALUES
(26, '12', '20', 'Practical', '2023-08-13 07:49:21'),
(27, '13', '21', 'Theory', '2023-08-13 07:49:45'),
(28, '13', '20', 'Theory', '2023-08-13 07:50:05');

-- --------------------------------------------------------

--
-- Table structure for table `class_tutor`
--

CREATE TABLE `class_tutor` (
  `id` int(11) NOT NULL,
  `tutor_id` varchar(20) DEFAULT NULL,
  `class_id` varchar(20) DEFAULT NULL,
  `registration_date` date DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `class_tutor`
--

INSERT INTO `class_tutor` (`id`, `tutor_id`, `class_id`, `registration_date`, `status`) VALUES
(113, '21', '26', '2023-08-13', 'allocated'),
(114, '22', '28', '2023-08-13', 'allocated'),
(115, '23', '27', '2023-08-13', 'allocated'),
(116, '24', '26', '2023-08-13', 'allocated'),
(117, '25', '27', '2023-08-13', 'allocated'),
(118, '26', '28', '2023-08-13', 'class_end');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `feedback_id` int(11) NOT NULL,
  `student_id` varchar(100) DEFAULT NULL,
  `title` varchar(100) DEFAULT NULL,
  `feedback_type` varchar(100) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`feedback_id`, `student_id`, `title`, `feedback_type`, `message`, `time_stamp`) VALUES
(8, '6', 'Title....', '', 'In this modified code:\n\nA query ($id_query) is used to retrieve the ID from the users table based on the provided telNo.', '2023-08-09 20:38:39'),
(10, '6', 'In this modified code:  A query ($id_query) is used to retrieve the ID from the users table based on', 'positive', 'In this modified code:\n\nA query ($id_query) is used to retrieve the ID from the users table based on the provided telNo.', '2023-08-09 20:39:15'),
(13, '10', 'sample title', 'positive', 'sample message', '2023-08-13 06:39:04');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `ID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Address` varchar(255) DEFAULT NULL,
  `TelephoneNumber` varchar(20) DEFAULT NULL,
  `DateOfBirth` date DEFAULT NULL,
  `Grade` varchar(10) DEFAULT NULL,
  `Tutor` varchar(100) DEFAULT NULL,
  `Subject` varchar(100) DEFAULT NULL,
  `TimeStamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`ID`, `Name`, `Address`, `TelephoneNumber`, `DateOfBirth`, `Grade`, `Tutor`, `Subject`, `TimeStamp`) VALUES
(5, 'Kasun ', '36/3,01 ST LANE,MIDDLE ROAD,WELEGODA,MATARA', '0765922708', '2000-06-13', '0', '0', '0', '2023-08-09 16:53:46'),
(6, 'Student One', 'Horana', '0782920982', '2003-06-10', '0', '0', '0', '2023-08-09 17:03:00'),
(9, 'supun hewege', 'Galle, 34/2, first lane', '0753233453', '2002-06-13', '0', '0', '0', '2023-08-13 03:06:27'),
(11, 'kavindu', 'matara', '0783444332', '2023-08-24', '0', '0', '0', '2023-08-13 08:07:18');

-- --------------------------------------------------------

--
-- Table structure for table `studentregisteredclass`
--

CREATE TABLE `studentregisteredclass` (
  `registration_id` int(11) NOT NULL,
  `student_id` varchar(45) DEFAULT NULL,
  `class_id` varchar(45) DEFAULT NULL,
  `registration_date` date DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `studentregisteredclass`
--

INSERT INTO `studentregisteredclass` (`registration_id`, `student_id`, `class_id`, `registration_date`, `status`) VALUES
(3, '6', '84', '2023-08-09', 'rejected'),
(4, '6', '87', '2023-08-09', 'accepted'),
(5, '5', '84', '2023-08-11', 'accepted'),
(6, '5', '86', '2023-08-11', 'rejected'),
(7, '5', '85', '2023-08-11', 'accepted'),
(8, '9', '92', '2023-08-13', 'pending'),
(9, '9', '95', '2023-08-13', 'pending'),
(10, '9', '93', '2023-08-13', 'pending'),
(11, '9', '98', '2023-08-13', 'pending'),
(12, '9', '101', '2023-08-13', 'pending'),
(13, '9', '102', '2023-08-13', 'pending'),
(14, '9', '103', '2023-08-13', 'accepted'),
(15, '10', '106', '2023-08-13', 'pending'),
(16, '10', '105', '2023-08-13', 'accepted'),
(17, '10', '97', '2023-08-13', 'pending'),
(18, '11', '113', '2023-08-13', 'pending'),
(19, '11', '114', '2023-08-13', 'pending'),
(20, '11', '115', '2023-08-13', 'accepted'),
(21, '11', '116', '2023-08-13', 'pending'),
(22, '11', '117', '2023-08-13', 'pending'),
(23, '11', '118', '2023-08-13', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `name`, `status`) VALUES
(12, 'Science for Technology', ''),
(14, 'Bio-system technology', ''),
(20, 'Engineering technology', ''),
(21, 'Accounting & management', '');

-- --------------------------------------------------------

--
-- Table structure for table `tutor`
--

CREATE TABLE `tutor` (
  `tutor_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `tel_no` varchar(20) DEFAULT NULL,
  `time_stamp` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tutor`
--

INSERT INTO `tutor` (`tutor_id`, `name`, `tel_no`, `time_stamp`) VALUES
(21, 'Kavindu gamage', '0765922345', '2023-08-13 07:54:35'),
(22, 'Nihal Rathnayake', '0714500788', '2023-08-13 07:55:57'),
(23, 'Sunil Ariyarathna', '0763423453', '2023-08-13 07:57:20'),
(24, 'Kapila Gamage', '0453442233', '2023-08-13 07:58:08'),
(25, 'somapala gamage', '3434345444', '2023-08-13 08:02:53'),
(26, 'Lahiru patirana', '0782343345', '2023-08-13 08:04:06');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `userType` varchar(45) NOT NULL,
  `TimeStamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID`, `Username`, `Password`, `userType`, `TimeStamp`) VALUES
(6, 'admin@gmail.com', '$2y$10$LTwvb1OG73rYM/WqB2SUp./ac3S/OtiYvx/Z5Veg74fL1thLQ8oyu', 'admin', '2023-08-09 16:53:46'),
(7, '0789300983', '$2y$10$LTwvb1OG73rYM/WqB2SUp./ac3S/OtiYvx/Z5Veg74fL1thLQ8oyu', 'tutor', '2023-08-09 16:59:30'),
(8, '0782920982', '$2y$10$I7C74Ec3og9.IABW74RVQuqz2C16VaB4nrB6xGsyj639I1CcvzwYm', 'std', '2023-08-09 17:03:00'),
(9, '0789200987', '$2y$10$w7VczMTj6jep8Ib.tk6ulOFm0zujx1V22.6hwq/fODQ.Jjw7Qes.K', 'tutor', '2023-08-09 19:53:01'),
(13, '0765945708', '', 'tutor', '2023-08-11 16:55:29'),
(22, '3433322333', '$2y$10$w82yQAUnCMDM4XgVy3S8/Ooh7e84kXVDCAuPTYFHGkK.lYQudrbIW', 'tutor', '2023-08-13 03:52:22'),
(23, '2335454344', '$2y$10$suhOXMyzKH1z62Fm9TvUoeh65W0CysT.RhzUS3odBp.vyGQMQApTq', 'tutor', '2023-08-13 03:53:34'),
(25, '3434342233', '$2y$10$tWqvO/AFiz8zDTbgFP.1JukB3raTfTIdg671NwEh/ETgDZAxCteBu', 'tutor', '2023-08-13 06:35:00'),
(27, '0765922345', '$2y$10$RUm30Xh8uOcJ9JVhSBsvQ.DB0NHVnAipizGX4A0zYQpydkfKup6w6', 'tutor', '2023-08-13 07:54:35'),
(28, '0714500788', '$2y$10$hAq4Wiwd63vYOODB06sUde0G.qwjOPDv3AYev8zfrEE38XXKRoGKG', 'tutor', '2023-08-13 07:55:57'),
(29, '0763423453', '$2y$10$ff9mqaKjqt1PeEKN0N1YQO99.85o033W0GjiK3tbfhhV9.XN3lYu2', 'tutor', '2023-08-13 07:57:20'),
(30, '0453442233', '$2y$10$gBHlH9N4aPDUFrBVjBZVce2EkGTiJEYyGmjpa9phlev./mbNhkDr.', 'tutor', '2023-08-13 07:58:08'),
(31, '3434345444', '$2y$10$kiFppRzh/hnTWjSab9kBC.M7EGpgELCg0nj8SPrnuT35mXTpwxKEC', 'tutor', '2023-08-13 08:02:53'),
(32, '0782343345', '$2y$10$73oqqguGN2d3Oa9fl11Zu.SWE3gsATPYS7xIHWVncmnHYp/7pSYye', 'tutor', '2023-08-13 08:04:06'),
(33, '0783444332', '$2y$10$iuvKWPrl3xl9Yp10dKGYu.K6AY.HqP5lBlZr.pfCThUHAgqtkyo.G', 'std', '2023-08-13 08:07:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`class_id`);

--
-- Indexes for table `class_tutor`
--
ALTER TABLE `class_tutor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feedback_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `studentregisteredclass`
--
ALTER TABLE `studentregisteredclass`
  ADD PRIMARY KEY (`registration_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tutor`
--
ALTER TABLE `tutor`
  ADD PRIMARY KEY (`tutor_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `class`
--
ALTER TABLE `class`
  MODIFY `class_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `class_tutor`
--
ALTER TABLE `class_tutor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=119;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feedback_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `studentregisteredclass`
--
ALTER TABLE `studentregisteredclass`
  MODIFY `registration_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tutor`
--
ALTER TABLE `tutor`
  MODIFY `tutor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
