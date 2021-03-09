-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 08, 2021 at 06:31 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET FOREIGN_KEY_CHECKS=0;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `amne`
--
CREATE DATABASE IF NOT EXISTS `amne` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `amne`;

-- --------------------------------------------------------

--
-- Table structure for table `barcos`
--

DROP TABLE IF EXISTS `barcos`;
CREATE TABLE IF NOT EXISTS `barcos` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) NOT NULL,
  `Codigo` varchar(12) NOT NULL,
  `Titular` varchar(50) NOT NULL,
  `Cant_Tripulantes` int(11) NOT NULL,
  `Capacidad_Carga` decimal(10,2) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Codigo` (`Codigo`),
  UNIQUE KEY `Nombre` (`Nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barcos`
--

INSERT INTO `barcos` (`Id`, `Nombre`, `Codigo`, `Titular`, `Cant_Tripulantes`, `Capacidad_Carga`) VALUES
(1, 'Virgen Del Valle', '974904023193', 'Julio Dominguez', 11, '1000.00'),
(2, 'Coromoto', '854751363852', 'Ramon Villega', 14, '1200.00'),
(3, 'Virgencita', '367695164532', 'Pedro Rodriguez', 12, '875.50');

-- --------------------------------------------------------

--
-- Table structure for table `facturas`
--

DROP TABLE IF EXISTS `facturas`;
CREATE TABLE IF NOT EXISTS `facturas` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Codigo` varchar(23) NOT NULL,
  `Usuario_Id` int(11) NOT NULL,
  `Barco_Id` int(11) NOT NULL,
  `Mercancia_Recibida` decimal(10,2) NOT NULL,
  `Hora` time NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Codigo` (`Codigo`),
  KEY `Usuario_Id` (`Usuario_Id`),
  KEY `Barco_Id` (`Barco_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `facturas`
--

INSERT INTO `facturas` (`Id`, `Codigo`, `Usuario_Id`, `Barco_Id`, `Mercancia_Recibida`, `Hora`) VALUES
(1, '6045e220f0e5f8.45109684', 2, 1, '882.75', '16:37:00'),
(2, '6045dc43b97764.02079023', 2, 3, '901.45', '17:09:00');

-- --------------------------------------------------------

--
-- Table structure for table `jornadas`
--

DROP TABLE IF EXISTS `jornadas`;
CREATE TABLE IF NOT EXISTS `jornadas` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Fecha` date NOT NULL,
  `Hora_Inicio` time NOT NULL,
  `Hora_Cierre` time DEFAULT NULL,
  `Clima` varchar(50) DEFAULT NULL,
  `Precio` decimal(10,2) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jornadas`
--

INSERT INTO `jornadas` (`Id`, `Fecha`, `Hora_Inicio`, `Hora_Cierre`, `Clima`, `Precio`) VALUES
(3, '2021-02-27', '05:00:00', '17:30:00', 'Soleado', '4.75'),
(4, '2021-03-02', '05:00:00', '17:30:00', 'Nublado', '5.25'),
(5, '2021-03-04', '05:00:00', '17:30:00', NULL, '5.00'),
(6, '2021-03-08', '06:00:00', '18:30:00', 'Lluvioso', '7.00');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) NOT NULL,
  `Cedula` varchar(9) NOT NULL,
  `Apellidos` varchar(50) NOT NULL,
  `Telefono` varchar(13) DEFAULT NULL,
  `Correo` varchar(50) DEFAULT NULL,
  `Direccion` varchar(255) DEFAULT NULL,
  `Clave` varchar(60) NOT NULL,
  `Nivel` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Cedula` (`Cedula`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`Id`, `Nombre`, `Cedula`, `Apellidos`, `Telefono`, `Correo`, `Direccion`, `Clave`, `Nivel`) VALUES
(1, 'Fred', '24438839', 'Zerpa', '+58424XXXXXXX', 'fzerpa.8839@unimar.edu.ve', 'En algun lado de Pampatar', '$2y$12$2l0GpwN22Cr6s8gPdsJkNesOjOvbLSZ2Oj6D1oJZ1jyL/k7dLbYKi', 1),
(2, 'Carlos', '22566985', 'Benitez', '+584168949681', 'carlosbenitez@gmail.com', 'Hotel Bella Vista, Av Santiago Mariño, Porlamar 6301, Nueva Esparta', '$2y$12$Ga8w3lIZGjapJJBHLDVkseX3VSR4zTHKLG2HPS3veKH65bGd5ZMFS', 2);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `facturas_ibfk_1` FOREIGN KEY (`Usuario_Id`) REFERENCES `usuarios` (`Id`),
  ADD CONSTRAINT `facturas_ibfk_2` FOREIGN KEY (`Barco_Id`) REFERENCES `barcos` (`Id`);
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
