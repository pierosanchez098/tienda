-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2023 at 06:14 AM
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
-- Database: `bdtienda`
--

-- --------------------------------------------------------

--
-- Table structure for table `carrito`
--

CREATE TABLE `carrito` (
  `id_carrito` int(12) NOT NULL,
  `producto` varchar(70) NOT NULL,
  `cantidad` int(12) NOT NULL,
  `precio_total` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categorias`
--

CREATE TABLE `categorias` (
  `id_categoria` int(12) NOT NULL,
  `nombre` varchar(60) NOT NULL,
  `descripcion` varchar(170) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `nombre`, `descripcion`) VALUES
(1, 'Prendas de vestir', 'Son prendas'),
(2, 'Prendas de vestir', 'Son prendas');

-- --------------------------------------------------------

--
-- Table structure for table `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(20) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `stock` int(20) NOT NULL,
  `precio_unitario` int(20) NOT NULL,
  `categoria` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre`, `stock`, `precio_unitario`, `categoria`) VALUES
(1, 'Camiseta azul', 43, 23, 'Prendas de vestir'),
(2, 'Abrigo', 68, 34, 'Prendas de vestir'),
(3, 'Chalina', 76, 12, 'Prendas de vestir'),
(4, 'Sueter', 56, 23, 'Prendas de vestir'),
(5, 'Camisa', 83, 11, 'Prendas de vestir'),
(6, 'Maya', 53, 32, 'Prendas de vestir'),
(7, 'Comida', 66, 43, 'Alimentos');

-- --------------------------------------------------------

--
-- Table structure for table `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(12) NOT NULL,
  `nick` varchar(70) NOT NULL,
  `email` varchar(100) NOT NULL,
  `contrasena` varchar(60) NOT NULL,
  `confirmacion_contrasena` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nick`, `email`, `contrasena`, `confirmacion_contrasena`) VALUES
(1, 'Ariana', 'ariana@gmail.com', '$2y$10$sQi8/PRRRKlcfAmpmIBpoOdBXicpU6fd7LhQ17nv7RawfKV3kv.lS', ''),
(2, 'piero', 'sanz87@ilerna.com', '$2y$10$z0eEHHfxzPlUKPgbXB8/3upvBajaaGCod0krakFjCvLxgO3.dfMnG', ''),
(3, 'administrador', 'admintienda@ilerna.com', '$2y$10$UciPV35F2n1jHAa8BmbXNuH2PXURzNinzeT0aXfx1aEWK.2P9slQK', ''),
(4, 'Tilsa', 'lozano23@gmail.com', '$2y$10$eoxxYQ6VLGSIUo08CGiMXuk/8G.CC5SIehNKbycShIhurlaVcZ8Ku', ''),
(6, 'Alejandra', 'aleandra@gmil.com', '$2y$10$Voau8qyqnQWky7bTRJt59OR0gO4jfpmhyeZXUs0ZSDuuDdo1fMp.2', ''),
(7, 'as', 'ewr45@dd.com', '$2y$10$AAyTz29sBZugaZ5DmHWiVuV6ju2sWNS.6SKqgqt7Wakeq5cnwnbea', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carrito`
--
ALTER TABLE `carrito`
  ADD PRIMARY KEY (`id_carrito`);

--
-- Indexes for table `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`id_categoria`);

--
-- Indexes for table `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carrito`
--
ALTER TABLE `carrito`
  MODIFY `id_carrito` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `categorias`
--
ALTER TABLE `categorias`
  MODIFY `id_categoria` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
