-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 08, 2019 at 10:17 AM
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
(1, 1, 'Demolition', '2019-02-02', '2019-02-09', 100),
(2, 2, 'Excavation', '2019-02-10', '2019-02-12', 100),
(3, 3, 'Concrete', '2019-02-10', '2019-02-12', 100),
(4, 4, 'Structure', '2019-02-13', '2019-02-17', 100),
(5, 5, 'Lock Up', '2019-02-18', '2019-02-21', 100),
(6, 6, 'Internal Works', '2019-02-23', '2019-02-25', 100),
(7, 7, 'Hand over', '2019-02-23', '2019-02-25', 100);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chart_task`
--
ALTER TABLE `chart_task`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chart_task`
--
ALTER TABLE `chart_task`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
