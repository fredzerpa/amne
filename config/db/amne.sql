-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2021 at 12:39 AM
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

CREATE TABLE IF NOT EXISTS `barcos` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Nombre` varchar(50) NOT NULL,
  `Codigo` varchar(12) NOT NULL,
  `Titular` varchar(50) NOT NULL,
  `Cantidad_Tripulantes` int(11) NOT NULL,
  `Capacidad_Carga` decimal(10,2) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Codigo` (`Codigo`),
  UNIQUE KEY `Nombre` (`Nombre`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `barcos`
--

INSERT INTO `barcos` (`Id`, `Nombre`, `Codigo`, `Titular`, `Cantidad_Tripulantes`, `Capacidad_Carga`) VALUES
(1, 'Virgen Del Valle', '974904023193', 'Julio Dominguez', 11, '1000.00'),
(2, 'Coromoto', '854751363852', 'Ramon Villega', 14, '1200.00'),
(3, 'Virgencita', '367695164532', 'Pedro Rodriguez', 12, '875.50'),
(7, 'Tritan II', '6047c267d08c', 'Julio Sanchez', 6, '550.00');

-- --------------------------------------------------------

--
-- Table structure for table `facturas`
--

CREATE TABLE IF NOT EXISTS `facturas` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Jornada_Id` int(11) NOT NULL,
  `Codigo` varchar(13) NOT NULL,
  `Usuario_Id` int(11) NOT NULL,
  `Barco_Id` int(11) NOT NULL,
  `Fecha` date NOT NULL,
  `Hora` time NOT NULL,
  `Mercancia_Recibida` decimal(10,2) NOT NULL,
  `Ganancia_Bruta` decimal(10,2) NOT NULL,
  `Gastos_Operativos` decimal(10,2) NOT NULL,
  `Ganancia_Neta` decimal(10,2) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Codigo` (`Codigo`),
  KEY `Usuario_Id` (`Usuario_Id`),
  KEY `Barco_Id` (`Barco_Id`),
  KEY `Jornada_Id` (`Jornada_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `facturas`
--

INSERT INTO `facturas` (`Id`, `Jornada_Id`, `Codigo`, `Usuario_Id`, `Barco_Id`, `Fecha`, `Hora`, `Mercancia_Recibida`, `Ganancia_Bruta`, `Gastos_Operativos`, `Ganancia_Neta`) VALUES
(2, 7, '6045dc43b9776', 2, 3, '2021-03-08', '17:09:00', '901.45', '3831.16', '459.73', '3371.42'),
(3, 4, '974904023193', 5, 1, '2020-01-08', '16:37:00', '882.75', '4634.43', '463.44', '4170.99'),
(4, 6, '604806e19c940', 1, 1, '2021-03-09', '18:15:00', '935.12', '6545.84', '5629.42', '916.42');

-- --------------------------------------------------------

--
-- Table structure for table `jornadas`
--

CREATE TABLE IF NOT EXISTS `jornadas` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Fecha` date NOT NULL,
  `Hora_Inicio` time NOT NULL,
  `Hora_Cierre` time DEFAULT NULL,
  `Clima` varchar(50) DEFAULT NULL,
  `Precio` decimal(10,2) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `jornadas`
--

INSERT INTO `jornadas` (`Id`, `Fecha`, `Hora_Inicio`, `Hora_Cierre`, `Clima`, `Precio`) VALUES
(3, '2021-02-27', '05:00:00', '17:30:00', 'Soleado', '4.75'),
(4, '2021-03-02', '05:00:00', '17:30:00', 'Nublado', '5.25'),
(6, '2021-03-09', '06:00:00', '18:30:00', 'Despejado', '7.00'),
(7, '2021-03-08', '06:00:00', '16:00:00', 'Despejado', '4.25');

-- --------------------------------------------------------

--
-- Table structure for table `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Cedula` varchar(9) NOT NULL,
  `Nombre` varchar(50) NOT NULL,
  `Apellidos` varchar(50) NOT NULL,
  `Telefono` varchar(13) DEFAULT NULL,
  `Email` varchar(50) DEFAULT NULL,
  `Direccion` varchar(255) DEFAULT NULL,
  `Clave` varchar(60) NOT NULL,
  `Nivel` int(11) NOT NULL,
  PRIMARY KEY (`Id`),
  UNIQUE KEY `Cedula` (`Cedula`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `usuarios`
--

INSERT INTO `usuarios` (`Id`, `Cedula`, `Nombre`, `Apellidos`, `Telefono`, `Email`, `Direccion`, `Clave`, `Nivel`) VALUES
(1, '24438839', 'Fred', 'Zerpa', '+58424XXXXXXX', 'fzerpa.8839@unimar.edu.ve', 'En algun lado de Pampatar', '$2y$10$hwQGeZER2XDU2xxNmk4k1O2VSdAqynARoZq3herBHwJb8.0mdLhnu', 1),
(2, '22566985', 'Juan', 'Benitez', '+584168949681', 'carlosbenitez@gmail.com', 'Hotel Bella Vista, Av Santiago Mari&ntilde;o, Porlamar 6301, Nueva Esparta', '$2y$12$Ga8w3lIZGjapJJBHLDVkseX3VSR4zTHKLG2HPS3veKH65bGd5ZMFS', 2),
(4, '23542816', 'Valeria', 'Sgalla', '+584127816826', 'valsgal@hotmail.com', 'La Asuncion, Nueva Esparta', '$2y$12$P30L4tyi5Z1LdBxgzKdrPOtJ/e2E18t6dEkYCDQ/XP7QEDDcdVSAq', 1),
(5, '24105423', 'Moises', 'Zerpa', '+58414XXXXXXX', 'moises@gmail.com', 'Alguna parte de pampatar.', '$2y$10$C.oBo7aU0FODG14moElNdeP927n2gF5XT1u2vsVq0OD1IRpg31LUC', 1);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `facturas_ibfk_1` FOREIGN KEY (`Usuario_Id`) REFERENCES `usuarios` (`Id`),
  ADD CONSTRAINT `facturas_ibfk_2` FOREIGN KEY (`Barco_Id`) REFERENCES `barcos` (`Id`),
  ADD CONSTRAINT `facturas_ibfk_3` FOREIGN KEY (`Jornada_Id`) REFERENCES `jornadas` (`Id`);
SET FOREIGN_KEY_CHECKS=1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
