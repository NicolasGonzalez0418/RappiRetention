-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-05-2026 a las 00:49:44
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `rappi_pro`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes_rappipro`
--

CREATE TABLE `clientes_rappipro` (
  `id_cliente` int(11) NOT NULL,
  `nombre` varchar(50) NOT NULL,
  `apellido` varchar(50) NOT NULL,
  `restaurante_favorito` varchar(50) NOT NULL,
  `correo` varchar(50) NOT NULL,
  `telefono` varchar(50) NOT NULL,
  `ciudad` varchar(50) NOT NULL,
  `dias_inactivos` int(2) NOT NULL,
  `frecuencia_semanal` int(1) NOT NULL,
  `pedidos_mes` int(3) NOT NULL,
  `valor_compras_mes_cop` decimal(10,2) DEFAULT NULL,
  `pqr_mes` int(2) NOT NULL,
  `pqr_abierta` int(1) NOT NULL DEFAULT 0,
  `antiguedad_meses` int(4) NOT NULL,
  `cancelaciones_mes` int(4) NOT NULL,
  `score` int(3) DEFAULT NULL,
  `Prob_Motivo` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientes_rappipro`
--

INSERT INTO `clientes_rappipro` (`id_cliente`, `nombre`, `apellido`, `restaurante_favorito`, `correo`, `telefono`, `ciudad`, `dias_inactivos`, `frecuencia_semanal`, `pedidos_mes`, `valor_compras_mes_cop`, `pqr_mes`, `pqr_abierta`, `antiguedad_meses`, `cancelaciones_mes`, `score`, `Prob_Motivo`) VALUES
(1001, 'Carlos', 'Ramírez', 'KFC', 'carlos.ram@mail.com', '3101234567', 'Bogotá', 23, 1, 6, 48659.00, 1, 0, 24, 1, 50, 'frecuencia_semanal'),
(1002, 'Laura', 'Gómez', 'Subway', 'laura.g@mail.com', '3112345678', 'Medellín', 7, 3, 18, 16002.00, 0, 0, 6, 0, 60, 'antiguedad_meses'),
(1003, 'Andrés', 'Castillo', 'Frisby', 'andres.c@mail.com', '3123456789', 'Cali', 2, 5, 10, 534034.00, 3, 1, 2, 5, 40, 'cancelaciones_mes'),
(1004, 'Daniela', 'Torres', 'Crepes & Waffles', 'dani.t@mail.com', '3134567890', 'Bogotá', 28, 0, 1, 222163.00, 0, 0, 18, 0, 55, 'pedidos_mes'),
(1005, 'Sebastián', 'Rojas', 'McDonalds', 'sebas.r@mail.com', '3145678901', 'Barranquilla', 11, 2, 10, 108715.00, 5, 0, 9, 2, 50, 'pqr_mes'),
(1006, 'Valentina', 'Ruiz', 'El Corral', 'vale.r@mail.com', '3156789012', 'Bucaramanga', 4, 6, 30, 900000.00, 1, 0, 3, 4, 70, 'cancelaciones_mes'),
(1007, 'Felipe', 'Moreno', 'Pizza Hut', 'felipe.m@mail.com', '3167890123', 'Bogotá', 14, 0, 0, 259282.00, 0, 0, 36, 0, 75, 'pedidos_mes'),
(1008, 'Camila', 'Herrera', 'Sierra Nevada', 'cami.h@mail.com', '3178901234', 'Medellín', 6, 4, 21, 465156.00, 2, 0, 5, 6, 65, 'cancelaciones_mes'),
(1009, 'Juan', 'Pérez', 'Popsicle', 'juan.p@mail.com', '3189012345', 'Pereira', 19, 1, 3, 20000.00, 4, 1, 14, 1, 25, 'pqr_abierta'),
(1010, 'Sofía', 'Martínez', 'Wok', 'sofia.m@mail.com', '3190123456', 'Bogotá', 1, 7, 60, 344184.00, 0, 0, 1, 1, 80, 'antiguedad_meses'),
(1011, 'Nicolás', 'Vega', 'KFC', 'nico.v@mail.com', '3201234567', 'Cali', 25, 0, 4, 77127.00, 1, 0, 28, 0, 60, 'pedidos_mes'),
(1012, 'Mariana', 'López', 'Subway', 'mari.l@mail.com', '3212345678', 'Medellín', 9, 2, 15, 553088.00, 0, 0, 7, 9, 65, 'cancelaciones_mes'),
(1013, 'Kevin', 'Díaz', 'Frisby', 'kevin.d@mail.com', '3223456789', 'Bogotá', 3, 5, 33, 134054.00, 3, 1, 4, 3, 45, 'cancelaciones_mes'),
(1014, 'Juliana', 'Castro', 'Burger King', 'juli.c@mail.com', '3234567890', 'Bucaramanga', 30, 1, 2, 211010.00, 2, 0, 20, 1, 45, 'pedidos_mes'),
(1015, 'Mateo', 'Sánchez', 'Timo', 'mateo.s@mail.com', '3245678901', 'Cali', 12, 2, 11, 52885.00, 0, 0, 8, 12, 60, 'cancelaciones_mes'),
(1016, 'Paula', 'Romero', 'Dominos', 'paula.r@mail.com', '3256789012', 'Bogotá', 2, 6, 40, 231398.00, 1, 0, 2, 2, 75, 'antiguedad_meses'),
(1017, 'Alejandro', 'León', 'KFC', 'alejo.l@mail.com', '3267890123', 'Medellín', 1, 0, 1, 398333.00, 4, 0, 40, 0, 65, 'pqr_mes'),
(1018, 'Natalia', 'Vargas', 'Presto', 'nata.v@mail.com', '3278901234', 'Bogotá', 10, 3, 14, 97472.00, 0, 0, 10, 10, 60, 'cancelaciones_mes'),
(1019, 'Cristian', 'Silva', 'Subway', 'cris.s@mail.com', '3289012345', 'Cali', 28, 5, 28, 492361.00, 0, 0, 3, 5, 55, 'cancelaciones_mes'),
(1020, 'Isabella', 'Mendoza', 'Frisby', 'isa.m@mail.com', '3290123456', 'Barranquilla', 22, 1, 5, 369388.00, 2, 1, 16, 1, 45, 'pqr_abierta'),
(1021, 'Diego', 'Pardo', 'McDonalds', 'diego.p@mail.com', '3301234567', 'Bogotá', 30, 0, 1, 369858.00, 5, 0, 30, 0, 50, 'pqr_mes'),
(1022, 'Sara', 'Beltrán', 'El Corral', 'sara.b@mail.com', '3312345678', 'Medellín', 13, 2, 12, 141127.00, 1, 0, 11, 13, 55, 'cancelaciones_mes'),
(1023, 'Esteban', 'Quintero', 'Pizza Hut', 'est.q@mail.com', '3323456789', 'Cali', 28, 5, 38, 196061.00, 0, 0, 2, 3, 55, 'cancelaciones_mes'),
(1024, 'Gabriela', 'Arias', 'Sierra Nevada', 'gabi.a@mail.com', '3334567890', 'Bogotá', 27, 1, 4, 0.00, 3, 0, 22, 1, 25, 'pqr_mes'),
(1025, 'Tomás', 'Cifuentes', 'Popsicle', 'tomas.c@mail.com', '3345678901', 'Pereira', 19, 3, 19, 396446.00, 0, 0, 5, 7, 60, 'cancelaciones_mes'),
(1026, 'Lina', 'Navarro', 'Wok', 'lina.n@mail.com', '3356789012', 'Bogotá', 25, 4, 25, 311450.00, 1, 0, 4, 5, 60, 'cancelaciones_mes'),
(1027, 'Ricardo', 'Molina', 'KFC', 'richi.m@mail.com', '3367890123', 'Cali', 48, 0, 0, 367914.00, 2, 0, 42, 0, 55, 'pedidos_mes'),
(1028, 'María', 'Fernanda', 'Subway', 'mafe.f@mail.com', '3378901234', 'Medellín', 55, 8, 1, 305219.00, 0, 0, 1, 1, 50, 'antiguedad_meses'),
(1029, 'Santiago', 'Duarte', 'Frisby', 'santi.d@mail.com', '3389012345', 'Bogotá', 16, 2, 16, 422353.00, 4, 1, 9, 10, 45, 'cancelaciones_mes'),
(1030, 'Paula', 'Méndez', 'Burger King', 'paula.m@mail.com', '3390123456', 'Cali', 5, 1, 5, 596110.00, 1, 0, 15, 20, 55, 'cancelaciones_mes'),
(1050, 'Matias', 'Martinez', 'Sierra Nevada', 'gabi.a@mail.com', '3334567890', 'Bogotá', 27, 1, 4, 15000.00, 3, 0, 22, 1, 25, 'pqr_mes');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes_rappipro`
--
ALTER TABLE `clientes_rappipro`
  ADD PRIMARY KEY (`id_cliente`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes_rappipro`
--
ALTER TABLE `clientes_rappipro`
  MODIFY `id_cliente` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1051;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
