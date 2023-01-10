-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 10, 2023 at 05:07 PM
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
  `ISBN` int(13) NOT NULL,
  `title` varchar(105) DEFAULT NULL,
  `edition` date DEFAULT NULL,
  `idAuthor` int(11) NOT NULL,
  `imgPath` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `llibres`
--

INSERT INTO `llibres` (`ISBN`, `title`, `edition`, `idAuthor`, `imgPath`) VALUES
(545646, 'Bellota y sus amigos', '0000-00-00', 2, 'bellotaysusamigos.jpg'),
(2147483647, 'Las bellotas y el ser humano', '0000-00-00', 1, 'lasbellotasyelserhumano.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `prestamos`
--

CREATE TABLE `prestamos` (
  `idUsuario` int(11) NOT NULL,
  `ISBN` int(11) NOT NULL,
  `fecha_prestamo` datetime DEFAULT NULL,
  `id_prestamo` varchar(45) NOT NULL,
  `dias_sancion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `idUsuari` int(11) NOT NULL,
  `username` varchar(155) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` int(9) DEFAULT NULL,
  `password` varchar(355) DEFAULT NULL,
  `idRol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usuaris`
--

INSERT INTO `usuaris` (`idUsuari`, `username`, `email`, `phone`, `password`, `idRol`) VALUES
(564656, 'pepe', 'pepe@gmail.com', 666555444, '$2y$04$10yrC.OsYRnc/OmoTrMn7.kKQ3XYhW42t2N.UQfXuuHocf01crG0e', 2),
(564657, 'pepe', 'pepe@gmail.com', 666555444, '$2y$04$Vt2XWZRJKDfnCImsAXBl4OU5k1N9MReU0gx9O.Kh7zQKp.iXgLIJa', 2),
(564658, 'pepe', 'pepe@gmail.com', 666555444, '$2y$04$8dcOGpRRE2zebYWYIH6UsuFhtUyLiTBZksIw5goI9AQsaP4DE6uby', 2),
(564659, 'ant', 'antonio@m.com', 3232, '$2y$04$kntiRoJjZhcQMQCZUHp7deQ/wCF8NEcoGmcZreRSUdTlTMnl7Fp8q', 2);

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
-- Indexes for table `prestamos`
--
ALTER TABLE `prestamos`
  ADD PRIMARY KEY (`id_prestamo`);

--
-- Indexes for table `usuaris`
--
ALTER TABLE `usuaris`
  ADD PRIMARY KEY (`idUsuari`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `autores`
--
ALTER TABLE `autores`
  MODIFY `idAutor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuaris`
--
ALTER TABLE `usuaris`
  MODIFY `idUsuari` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=564660;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
