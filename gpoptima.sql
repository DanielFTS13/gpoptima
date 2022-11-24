-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 24, 2022 at 12:58 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.3.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gpoptima`
--

-- --------------------------------------------------------

--
-- Table structure for table `autos`
--

CREATE TABLE `autos` (
  `ID_AUTO` int(11) NOT NULL,
  `MARCA` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `autos`
--

INSERT INTO `autos` (`ID_AUTO`, `MARCA`) VALUES
(1, 'HONDA'),
(2, 'KIA'),
(3, 'FORD'),
(4, 'NISSAN');

-- --------------------------------------------------------

--
-- Table structure for table `clientes`
--

CREATE TABLE `clientes` (
  `ID_CLIENTE` int(11) NOT NULL,
  `NOMBRE` varchar(200) NOT NULL,
  `EDAD` int(11) NOT NULL,
  `TELEFONO` varchar(12) NOT NULL,
  `EMAIL` varchar(160) NOT NULL,
  `ID_MARCA` int(11) NOT NULL,
  `ID_MODELO` int(11) NOT NULL,
  `CREATE_RECORD` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `clientes`
--

INSERT INTO `clientes` (`ID_CLIENTE`, `NOMBRE`, `EDAD`, `TELEFONO`, `EMAIL`, `ID_MARCA`, `ID_MODELO`, `CREATE_RECORD`) VALUES
(6, 'ERIK DANIEL', 28, '5628279516', 'daniel.ramirez.fts13@gmail.com', 2, 6, '2022-11-23 16:01:10'),
(7, 'JAN EUTIQUIO MATA PEREZ', 32, '4681118044', 'daniel.ramirez.fts13@gmail.com', 3, 9, '2022-11-23 17:54:43');

-- --------------------------------------------------------

--
-- Table structure for table `modelos`
--

CREATE TABLE `modelos` (
  `ID_MODELO` int(11) NOT NULL,
  `ID_MARCA` int(11) NOT NULL,
  `MODELO` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `modelos`
--

INSERT INTO `modelos` (`ID_MODELO`, `ID_MARCA`, `MODELO`) VALUES
(1, 1, 'CRV'),
(2, 1, 'HRV'),
(3, 1, 'BRV'),
(4, 2, 'SOUL'),
(5, 2, 'RIO'),
(6, 2, 'SPORTAGE'),
(8, 3, 'MUSTANG'),
(9, 3, 'ESCAPE'),
(10, 3, 'FIESTA'),
(11, 4, 'VERSA'),
(12, 4, 'MARCH'),
(13, 4, 'SENTRA');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `autos`
--
ALTER TABLE `autos`
  ADD PRIMARY KEY (`ID_AUTO`);

--
-- Indexes for table `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`ID_CLIENTE`);

--
-- Indexes for table `modelos`
--
ALTER TABLE `modelos`
  ADD PRIMARY KEY (`ID_MODELO`),
  ADD KEY `ID_MARCA` (`ID_MARCA`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `autos`
--
ALTER TABLE `autos`
  MODIFY `ID_AUTO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `clientes`
--
ALTER TABLE `clientes`
  MODIFY `ID_CLIENTE` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `modelos`
--
ALTER TABLE `modelos`
  MODIFY `ID_MODELO` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
