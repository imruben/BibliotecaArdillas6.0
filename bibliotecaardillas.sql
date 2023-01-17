-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 17, 2023 at 11:09 PM
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
  `available` bit(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `llibres`
--

INSERT INTO `llibres` (`ISBN`, `title`, `edition`, `author`, `available`) VALUES
('1234566891234', 'The Nuts', 1998, 'Perico Palotes', b'1'),
('1234567591234', 'More Nuts', 2010, 'Salvador Raya', b'0'),
('1234597891234', 'A good nut', 2010, 'MiniBuyer', b'0'),
('1236567891234', 'Lots Nuts', 1022, 'Scrat(ardilla de ice age)', b'0'),
('1542635894125', 'Bellota y sus amigos', 2018, 'Nil Ojeda', b'0'),
('4645644235222', 'Las bellotas y el ser humano', 2019, 'Ayuso', b'1');

-- --------------------------------------------------------

--
-- Table structure for table `prestecs`
--

CREATE TABLE `prestecs` (
  `idUser` int(11) NOT NULL,
  `ISBN` varchar(13) NOT NULL,
  `reserve_date` date DEFAULT NULL,
  `idReserve` int(11) NOT NULL,
  `return_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `prestecs`
--

INSERT INTO `prestecs` (`idUser`, `ISBN`, `reserve_date`, `idReserve`, `return_date`) VALUES
(564665, '1234567591234', '2023-01-17', 73, '2020-06-16'),
(564665, '1542635894125', '2023-01-17', 74, '2023-02-16'),
(564675, '1236567891234', '2023-01-17', 75, '2023-02-16'),
(564675, '1234597891234', '2023-01-17', 76, '2023-02-16');

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
(564662, 'alvin', 'alvin@gmail.com', 111222333, '$2y$04$cs04J4GVhIym8E3QYbwfKu6lLgFaUdZxCUjEd3pomcyNfTtXdFgT.', 2),
(564665, 'pepe', 'pepe@gmail.com', 445558882, '$2y$04$fvsvshIfn1YAbwkIg7hMUO2QAUzH.BRofNpJgI3PknxgMrOzMxZLO', 1),
(564666, 'admin', 'admin@gmail.com', 111222333, '$2y$04$yjZTKikdnVTEUs4bdGc/iu9XMshMEPBaamRIFYsH.65nr6isruhwq', 3),
(564675, 'perico', 'perico@gmail.com', 555999888, '$2y$04$K2tmv616Tl1v0mVC5EE9mO3talaHvnedWSA6Hv.3/8RU53QqcCwTa', 1);

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
  MODIFY `idReserve` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `usuaris`
--
ALTER TABLE `usuaris`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=564676;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
