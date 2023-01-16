-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 16, 2023 at 04:22 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bibliotecaardillas`
--

-- --------------------------------------------------------

--
-- Table structure for table `autores`
--

CREATE TABLE `autores` (
  `idAutor` int(11) NOT NULL,
  `nombre` varchar(155) DEFAULT NULL,
  `pais` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `llibres`
--

CREATE TABLE `llibres` (
  `ISBN` varchar(13) NOT NULL,
  `title` varchar(105) DEFAULT NULL,
  `edition` int(4) DEFAULT NULL,
  `author` varchar(50) NOT NULL,
  `imgPath` varchar(50) NOT NULL,
  `available` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `llibres`
--

INSERT INTO `llibres` (`ISBN`, `title`, `edition`, `author`, `imgPath`, `available`) VALUES
('1234566891234', 'The Nuts', 2015, 'Perico Palotes', 'aaa', b'1'),
('1234567591234', 'More Nuts', 2010, 'Salvador Raya', 'a', b'1'),
('1234597891234', 'A good nut', 2010, 'MiniBuyer', 'a', b'1'),
('1236567891234', 'Lots Nuts', 1022, 'Scrat(ardilla de ice age)', 'a', b'1'),
('1542635894125', 'Bellota y sus amigos', 2018, 'Nil Ojeda', 'bellotaysusamigos.jpg', b'1'),
('4645644235222', 'Las bellotas y el ser humano', 2019, 'Ayuso', 'lasbellotasyelserhumano.jpg', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `prestecs`
--

CREATE TABLE `prestecs` (
  `idUser` int(11) NOT NULL,
  `ISBN` varchar(13) NOT NULL,
  `reserve_date` datetime DEFAULT NULL,
  `idReserve` int(11) NOT NULL,
  `days_penalty` int(11) DEFAULT NULL,
  `return_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prestecs`
--

INSERT INTO `prestecs` (`idUser`, `ISBN`, `reserve_date`, `idReserve`, `days_penalty`, `return_date`) VALUES
(564665, '2147483647568', '2023-01-15 00:00:00', 18, 0, '2023-01-15'),
(564665, '2147483647568', '2023-01-15 00:00:00', 19, 0, '2023-01-15'),
(564665, '1542635894125', '2023-01-15 00:00:00', 20, 0, '2023-01-15'),
(564665, '1542635894125', '2023-01-16 00:00:00', 21, 0, '2023-01-16');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `rol` varchar(155) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `usuaris`
--

CREATE TABLE `usuaris` (
  `idUser` int(11) NOT NULL,
  `username` varchar(155) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` int(9) DEFAULT NULL,
  `password` varchar(355) DEFAULT NULL,
  `idRol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usuaris`
--

INSERT INTO `usuaris` (`idUser`, `username`, `email`, `phone`, `password`, `idRol`) VALUES
(564662, 'alvin', 'alvin@gmail.com', 111222333, '$2y$04$FMBVZOe1sBxQuSp7gYH51.GU4tyYN3mwdItyS09zkFOfyY8ya8M8W', 1),
(564665, 'pepe', 'pepe@gmail.com', 445558882, '$2y$04$bkag9O7vv6tpRuPSBO58cOE4UCCnWpvAKhalL41yg9.7RCv33IIHm', 2),
(564666, 'admin', 'admin@gmail.com', 111222333, '$2y$04$3mZeYD3hlKXnrQMb5qYOMexryOZdOPLoFEe9HDGoLZP2KLNBxd3eO', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `autores`
--
ALTER TABLE `autores`
  ADD PRIMARY KEY (`idAutor`);

--
-- Indexes for table `llibres`
--
ALTER TABLE `llibres`
  ADD PRIMARY KEY (`ISBN`);

--
-- Indexes for table `prestecs`
--
ALTER TABLE `prestecs`
  ADD PRIMARY KEY (`idReserve`);

--
-- Indexes for table `usuaris`
--
ALTER TABLE `usuaris`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `autores`
--
ALTER TABLE `autores`
  MODIFY `idAutor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prestecs`
--
ALTER TABLE `prestecs`
  MODIFY `idReserve` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `usuaris`
--
ALTER TABLE `usuaris`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=564668;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
