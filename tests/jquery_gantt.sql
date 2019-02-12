-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 12, 2019 at 05:03 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jquery_gantt`
--

-- --------------------------------------------------------

--
-- Table structure for table `chart_task`
--

CREATE TABLE `chart_task` (
  `id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `start` date NOT NULL,
  `end` date NOT NULL,
  `progress` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chart_task`
--

INSERT INTO `chart_task` (`id`, `project_id`, `name`, `start`, `end`, `progress`) VALUES
(1, 1, 'Demolition', '2019-02-02', '2019-02-13', 100),
(2, 2, 'Excavation', '2019-02-13', '2019-02-12', 100),
(3, 1, 'Concrete', '2019-02-10', '2019-02-28', 100),
(4, 2, 'Structure', '2019-02-04', '2019-02-26', 100),
(5, 2, 'Lock Up', '2019-02-18', '2019-02-21', 100),
(6, 1, 'Internal Works', '2019-02-19', '2019-02-25', 100),
(7, 2, 'Hand over', '2019-02-23', '2019-02-25', 100),
(8, 1, 'Lophils', '2019-02-08', '2019-02-27', 100),
(9, 2, 'DG Test', '2019-02-02', '2019-02-15', 100);

-- --------------------------------------------------------

--
-- Table structure for table `project_tbl`
--

CREATE TABLE `project_tbl` (
  `project_id` int(12) NOT NULL,
  `project_name` varchar(50) NOT NULL,
  `project_add` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_tbl`
--

INSERT INTO `project_tbl` (`project_id`, `project_name`, `project_add`) VALUES
(1, 'ASUS', 'Philippines'),
(2, 'Project Smelly', 'Kahit Naligo Na');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chart_task`
--
ALTER TABLE `chart_task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_tbl`
--
ALTER TABLE `project_tbl`
  ADD PRIMARY KEY (`project_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chart_task`
--
ALTER TABLE `chart_task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `project_tbl`
--
ALTER TABLE `project_tbl`
  MODIFY `project_id` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
