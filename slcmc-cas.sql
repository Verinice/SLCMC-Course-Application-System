-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2024 at 10:18 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `slcmc-cas`
--

-- --------------------------------------------------------

--
-- Table structure for table `applications`
--

CREATE TABLE `applications` (
  `_course_id` int(11) NOT NULL,
  `adm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applications`
--

INSERT INTO `applications` (`_course_id`, `adm`) VALUES
(1, 3843),
(3, 3843);

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `name` text NOT NULL,
  `department` text NOT NULL,
  `modules` int(11) NOT NULL,
  `rating` float NOT NULL DEFAULT 1,
  `description` text NOT NULL,
  `online_opt` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`course_id`, `name`, `department`, `modules`, `rating`, `description`, `online_opt`) VALUES
(1, 'Diploma in Clinical Medicine and Surgery', 'Nephrology', 3, 4.5, 'C and Above in English or Kiswahili and Biology. C- and above in Chemistry and either Mathematics or Physics', 0),
(3, 'Higher Diploma in Critical Care Nursing', 'Nursing', 1, 4.7, 'BSC, KRCHN/KRN/MPH/KRNM and 1 year of Clinical Experience', 0),
(4, 'Higher Diploma in Critical Care Nursing', 'Nursing', 1, 4.3, 'BSC, KRCHN/KRN/MPH/KRNM and 1 year of Clinical Experience', 1),
(5, 'Higher Diploma in Nephrology Nursing', 'Nephrology', 1, 4.6, 'BSC, KRCHN/KRN/MPH/KRNM and 1 year of Clinical Experience', 1),
(6, 'Diploma in Kenya Registered Community Health Nursing', 'Nursing', 3, 4.5, 'C and Above in English or Kiswahili and Biology. C- and above in either Mathematics, Chemistry or Physics', 0),
(7, 'Diploma in Perioperative Theatre Technology', 'Nursing', 3, 4.7, 'C and Above in English or Kiswahili and Biology. C- and above in Chemistry and either Mathematics or Physics', 0),
(8, 'Certificate in Perioperative Theatre Technology', 'Nursing', 1, 4.5, 'C and Above in English or Kiswahili and Biology. C- and above in either Mathematics, Chemistry or Physics', 1),
(9, 'Certificate in Perioperative Theatre Technology', 'Nursing', 1, 4.5, 'C and Above in English or Kiswahili and Biology. C- and above in either Mathematics, Chemistry or Physics', 1),
(10, 'Diploma in Clinical Medicine and Surgery', 'Nephrology', 3, 4.5, 'C and Above in English or Kiswahili and Biology. C- and above in Chemistry and either Mathematics or Physics', 0),
(11, 'Higher Diploma in Critical Care Nursing 1', 'Nursing', 1, 4.3, 'BSC, KRCHN/KRN/MPH/KRNM and 1 year of Clinical Experience', 1),
(12, 'Diploma in Perioperative Theatre Technology 2', 'Nursing', 3, 4.7, 'C and Above in English or Kiswahili and Biology. C- and above in Chemistry and either Mathematics or Physics', 0);

-- --------------------------------------------------------

--
-- Table structure for table `student_meta`
--

CREATE TABLE `student_meta` (
  `admission` int(11) NOT NULL,
  `kcpe_score` int(11) NOT NULL,
  `kcse_score` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_meta`
--

INSERT INTO `student_meta` (`admission`, `kcpe_score`, `kcse_score`) VALUES
(3843, 344, 56),
(5940, 344, 0),
(8499, 344, 76);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `admission_number` int(4) NOT NULL,
  `full_name` text NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` date NOT NULL DEFAULT current_timestamp(),
  `status` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`admission_number`, `full_name`, `email`, `password`, `created_at`, `status`) VALUES
(3843, 'Difatha Thuo', 'difathathuoh8@gmail.com', '$2y$10$JdiFsnshsym55S/d3n1TXOJ6QGMZ9VnBp1FSG7cyD5zTG6de7dF9W', '2024-10-20', 0),
(5940, 'Thuo Kariuki', 'ellenahnduta8@gmail.com', '$2y$10$UxNaj1Ei2mCfr2qAwpe6NOyLrjD47s7yrYts.j/5PA3R1DN/Nqa3a', '2024-10-20', 0),
(8499, 'Thuo Kariuki', 'ellenahnduta@gmail.com', '$2y$10$GSSRAsZlYxpa/OfkKrDOBeIqqkBIpEBXdG.eKbOZFtgdlAsXYX8Qa', '2024-10-20', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `student_meta`
--
ALTER TABLE `student_meta`
  ADD UNIQUE KEY `admission_number` (`admission`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `admission_number` (`admission_number`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
