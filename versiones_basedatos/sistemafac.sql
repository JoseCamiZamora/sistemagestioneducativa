-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-10-2020 a las 18:52:58
-- Versión del servidor: 10.4.13-MariaDB
-- Versión de PHP: 7.4.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sistemafac`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientes`
--

CREATE TABLE `clientes` (
  `id` int(11) NOT NULL,
  `identificacion` varchar(12) NOT NULL,
  `nombre_cliente` varchar(125) NOT NULL,
  `email` varchar(125) NOT NULL,
  `telefono` varchar(12) DEFAULT NULL,
  `direccion` varchar(125) DEFAULT NULL,
  `departamento` varchar(120) DEFAULT NULL,
  `ciudad` varchar(120) DEFAULT NULL,
  `tipo` varchar(2) NOT NULL,
  `estado` varchar(2) DEFAULT 'A',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `clientes`
--

INSERT INTO `clientes` (`id`, `identificacion`, `nombre_cliente`, `email`, `telefono`, `direccion`, `departamento`, `ciudad`, `tipo`, `estado`, `created_at`, `updated_at`) VALUES
(1, '1086359747', 'JOSE CAMILO ZAMORA GOMEZ', 'josecami@hotmail.com', '3147244308', 'PRUEBA', 'NARIñO', 'EL TAMBO', 'V', 'A', '2020-09-28 22:23:34', '2020-10-03 03:06:47'),
(2, '87303705', 'JORGE IAVN ZAMORA GOMEZ', 'ivanzag11@yahoo.es', '3137978541', 'CALLE 3 CASA 39 BARRIO EL ROSARIO', '', 'EL TAMBO', 'C', 'A', '2020-09-30 21:57:21', '2020-10-03 03:11:30'),
(3, '1205221121', 'PEPITO JOSE PEREZ', 'pep@hotmail.com', '3142521114', 'CALE AVENIDA SIMEPRE VIVA', '', 'EL TAMBO', 'V', 'A', '2020-09-30 22:02:10', '2020-10-03 03:08:23'),
(4, '1127340879', 'MARIA REGINA DIAZ', 'maria@hotmail.com', '314724258474', 'CALLE 20 VEREDA TANGUANA', '', 'EL TAMBO', 'V', 'A', '2020-10-03 21:40:16', '2020-10-03 21:40:16'),
(5, '5249009', 'JULIO ALEJANDRO ZAMORA PAZOS', 'julio@gmail.com', '3117867696', 'CALLE 2 CASA 39', '', 'EL TAMBO', 'V', 'A', '2020-10-03 22:07:24', '2020-10-03 22:07:24'),
(6, '123456789', 'CRISTIANO RONALDO', 'jose@cami.com', '314724444308', 'CALLE 3 CASA 39 BARRIO EL ROSARIO', 'NARIñO', 'EL TAMBO', 'V', 'A', '2020-10-06 00:54:42', '2020-10-06 00:54:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas_compra`
--

CREATE TABLE `facturas_compra` (
  `id` int(11) NOT NULL,
  `tipo_factura` int(11) NOT NULL DEFAULT 1,
  `id_clase` int(11) NOT NULL DEFAULT 0,
  `id_proveedor` int(11) NOT NULL DEFAULT 0,
  `nit_proveedor` varchar(40) NOT NULL DEFAULT '0',
  `nombre_proveedor` varchar(150) NOT NULL DEFAULT '0',
  `id_cliente` int(11) NOT NULL,
  `nombre_cliente` varchar(250) DEFAULT NULL,
  `identificacion_cliente` varchar(12) NOT NULL,
  `direccion_cliente` varchar(250) NOT NULL,
  `nombre_conductor` varchar(250) NOT NULL,
  `id_conductor` int(11) NOT NULL DEFAULT 0,
  `placas` varchar(30) NOT NULL,
  `fecha_expedicion_fac` date NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `codigo_factura` varchar(11) NOT NULL,
  `sede_planta` varchar(2) NOT NULL,
  `estado` varchar(2) DEFAULT '1',
  `url_file` varchar(500) DEFAULT NULL,
  `insumos_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`insumos_json`)),
  `total_cantidad` varchar(40) NOT NULL DEFAULT '0',
  `total_kilos` varchar(40) NOT NULL DEFAULT '0',
  `total_vbruto` varchar(40) NOT NULL DEFAULT '0',
  `total_iva` varchar(40) NOT NULL DEFAULT '0',
  `total` varchar(40) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `facturas_compra`
--

INSERT INTO `facturas_compra` (`id`, `tipo_factura`, `id_clase`, `id_proveedor`, `nit_proveedor`, `nombre_proveedor`, `id_cliente`, `nombre_cliente`, `identificacion_cliente`, `direccion_cliente`, `nombre_conductor`, `id_conductor`, `placas`, `fecha_expedicion_fac`, `fecha_ingreso`, `codigo_factura`, `sede_planta`, `estado`, `url_file`, `insumos_json`, `total_cantidad`, `total_kilos`, `total_vbruto`, `total_iva`, `total`, `created_at`, `updated_at`) VALUES
(47, 1, 1, 1, '891304762', 'ITALCOL DE OCCIDENTE SA', 2, 'JORGE IAVN ZAMORA GOMEZ', '87303705', 'CALLE 3 CASA 39 BARRIO EL ROSARIO', 'Pepito perez', 0, 'SOW035', '2020-10-21', '2020-10-21', '120252', '1', '1', 'file_47_205.pdf', '[{\"id\":\"1\",\"codigo\":\"2585\",\"insumo\":\"POLLITO INICIACION DORADO Q\",\"cantidad\":\"60\",\"unidad\":\"BTO\",\"peso_kilos\":\"40\",\"kilos\":\"2400\",\"valor_unitario\":\"62400\",\"valor_bruto\":\"3744000\",\"iva\":\"187200\",\"porcentaje\":\"5\",\"valor_total\":\"3931200\"},{\"id\":\"2\",\"codigo\":\"2533\",\"insumo\":\"SUPER POLLO ENGORDE DORADO P\",\"cantidad\":\"100\",\"unidad\":\"BTO\",\"peso_kilos\":\"40\",\"kilos\":\"4000\",\"valor_unitario\":\"63200\",\"valor_bruto\":\"6320000\",\"iva\":\"316000\",\"porcentaje\":\"5\",\"valor_total\":\"6636000\"},{\"id\":\"3\",\"codigo\":\"2538\",\"insumo\":\"POLLO INICIACI\\u00d3N D Q\",\"cantidad\":\"15\",\"unidad\":\"BTO\",\"peso_kilos\":\"40\",\"kilos\":\"600\",\"valor_unitario\":\"58400\",\"valor_bruto\":\"876000\",\"iva\":\"43800\",\"porcentaje\":\"5\",\"valor_total\":\"919800\"},{\"id\":\"7\",\"codigo\":\"4504\",\"insumo\":\"CERDOS LEVANTE L\\u00cdNEA NARANJA\",\"cantidad\":\"100\",\"unidad\":\"BTO\",\"peso_kilos\":\"40\",\"kilos\":\"4000\",\"valor_unitario\":\"61200\",\"valor_bruto\":\"6120000\",\"iva\":\"306000\",\"porcentaje\":\"5\",\"valor_total\":\"6426000\"},{\"id\":\"8\",\"codigo\":\"4508\",\"insumo\":\"CERDOS FINALIZADOR L\\u00cdNEA NARANJA\",\"cantidad\":\"50\",\"unidad\":\"BTO\",\"peso_kilos\":\"40\",\"kilos\":\"2000\",\"valor_unitario\":\"58800\",\"valor_bruto\":\"2940000\",\"iva\":\"147000\",\"porcentaje\":\"5\",\"valor_total\":\"3087000\"}]', '325', '13000', '20000000', '1000000', '21000000', '2020-10-24 21:12:23', '2020-10-24 21:12:25');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas_venta`
--

CREATE TABLE `facturas_venta` (
  `id` int(11) NOT NULL,
  `id_cliente` int(11) NOT NULL,
  `nombre_cliente` varchar(250) NOT NULL,
  `identificacion_cliente` varchar(12) NOT NULL,
  `direccion_cliente` varchar(250) NOT NULL,
  `ciudad` varchar(120) DEFAULT NULL,
  `email` varchar(125) NOT NULL,
  `telefono` varchar(12) DEFAULT NULL,
  `fecha_expedicion_fac` date NOT NULL,
  `codigo_factura` varchar(11) NOT NULL,
  `estado` varchar(2) DEFAULT '1',
  `forma_pago` varchar(2) NOT NULL,
  `fecha_vencimiento` date NOT NULL,
  `metodo_pago` varchar(20) NOT NULL,
  `insumos_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`insumos_json`)),
  `total_kilos` varchar(40) NOT NULL DEFAULT '0',
  `total_cantidad` varchar(5) DEFAULT NULL,
  `total_vbruto` varchar(40) NOT NULL DEFAULT '0',
  `total_iva` varchar(40) NOT NULL DEFAULT '0',
  `total_descuento` varchar(40) NOT NULL DEFAULT '0',
  `total` varchar(40) NOT NULL DEFAULT '0',
  `cobrado` varchar(40) NOT NULL,
  `por_cobrar` varchar(40) NOT NULL,
  `estado_pago` varchar(2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `facturas_venta`
--

INSERT INTO `facturas_venta` (`id`, `id_cliente`, `nombre_cliente`, `identificacion_cliente`, `direccion_cliente`, `ciudad`, `email`, `telefono`, `fecha_expedicion_fac`, `codigo_factura`, `estado`, `forma_pago`, `fecha_vencimiento`, `metodo_pago`, `insumos_json`, `total_kilos`, `total_cantidad`, `total_vbruto`, `total_iva`, `total_descuento`, `total`, `cobrado`, `por_cobrar`, `estado_pago`, `created_at`, `updated_at`) VALUES
(16, 1, 'JOSE CAMILO ZAMORA GOMEZ', '1086359747', 'PRUEBA', 'EL TAMBO', 'josecami@hotmail.com', '3147244308', '2020-10-24', '1', '1', 'CO', '2020-10-24', 'E', '[{\"id\":\"1\",\"codigo\":\"2585\",\"insumo\":\"POLLITO INICIACION DORADO Q\",\"cantidad\":\"10\",\"unidad\":\"BTO\",\"descuento\":\"5\",\"porcentaje_descuento\":0,\"valor_unitario\":\"68000\",\"valor_bruto\":\"68000\",\"iva\":\"34000\",\"porcentaje\":\"5\",\"valor_total\":\"714000\"}]', '10', '10', '680000', '34000', '0', '714000', '0', '714000', '2', '2020-10-24 21:14:09', '2020-10-24 21:14:09'),
(17, 6, 'CRISTIANO RONALDO', '123456789', 'CALLE 3 CASA 39 BARRIO EL ROSARIO', 'EL TAMBO', 'jose@cami.com', '314724444308', '2020-10-24', '2', '1', 'CR', '2020-10-31', 'TD', '[{\"id\":\"2\",\"codigo\":\"2533\",\"insumo\":\"SUPER POLLO ENGORDE DORADO P\",\"cantidad\":\"50\",\"unidad\":\"BTO\",\"descuento\":\"5\",\"porcentaje_descuento\":0,\"valor_unitario\":\"69000\",\"valor_bruto\":\"69000\",\"iva\":\"172500\",\"porcentaje\":\"5\",\"valor_total\":\"3553500\"},{\"id\":\"7\",\"codigo\":\"4504\",\"insumo\":\"CERDOS LEVANTE L\\u00cdNEA NARANJA\",\"cantidad\":\"50\",\"unidad\":\"BTO\",\"descuento\":\"5\",\"porcentaje_descuento\":0,\"valor_unitario\":\"68000\",\"valor_bruto\":\"68000\",\"iva\":\"170000\",\"porcentaje\":\"5\",\"valor_total\":\"3570000\"}]', '100', '100', '6850000', '342500', '69000', '7123500', '0', '7123500', '2', '2020-10-24 21:15:57', '2020-10-24 21:15:57'),
(18, 1, 'JOSE CAMILO ZAMORA GOMEZ', '1086359747', 'PRUEBA', 'EL TAMBO', 'josecami@hotmail.com', '3147244308', '2020-10-24', '3', '1', 'CO', '2020-10-24', 'E', '[{\"id\":\"2\",\"codigo\":\"2533\",\"insumo\":\"SUPER POLLO ENGORDE DORADO P\",\"cantidad\":\"5\",\"unidad\":\"BTO\",\"descuento\":\"5\",\"porcentaje_descuento\":0,\"valor_unitario\":\"69000\",\"valor_bruto\":\"69000\",\"iva\":\"17250\",\"porcentaje\":\"5\",\"valor_total\":\"362250\"},{\"id\":\"2\",\"codigo\":\"2533\",\"insumo\":\"SUPER POLLO ENGORDE DORADO P\",\"cantidad\":\"5\",\"unidad\":\"BTO\",\"descuento\":\"5\",\"porcentaje_descuento\":0,\"valor_unitario\":\"69000\",\"valor_bruto\":\"69000\",\"iva\":\"17250\",\"porcentaje\":\"5\",\"valor_total\":\"362250\"}]', '10', '10', '690000', '34500', '0', '724500', '0', '724500', '2', '2020-10-24 21:37:54', '2020-10-24 21:37:54'),
(19, 1, 'JOSE CAMILO ZAMORA GOMEZ', '1086359747', 'PRUEBA', 'EL TAMBO', 'josecami@hotmail.com', '3147244308', '2020-10-24', '4', '1', 'CO', '2020-10-24', 'E', '[{\"id\":\"2\",\"codigo\":\"2533\",\"insumo\":\"SUPER POLLO ENGORDE DORADO P\",\"cantidad\":\"1\",\"unidad\":\"BTO\",\"descuento\":\"5\",\"porcentaje_descuento\":0,\"valor_unitario\":\"69000\",\"valor_bruto\":\"69000\",\"iva\":\"3450\",\"porcentaje\":\"5\",\"valor_total\":\"72450\"},{\"id\":\"1\",\"codigo\":\"2585\",\"insumo\":\"POLLITO INICIACION DORADO Q\",\"cantidad\":\"1\",\"unidad\":\"BTO\",\"descuento\":\"5\",\"porcentaje_descuento\":0,\"valor_unitario\":\"68000\",\"valor_bruto\":\"68000\",\"iva\":\"3400\",\"porcentaje\":\"5\",\"valor_total\":\"71400\"}]', '2', '2', '137000', '6850', '0', '143850', '0', '143850', '2', '2020-10-24 21:39:09', '2020-10-24 21:39:09'),
(20, 6, 'CRISTIANO RONALDO', '123456789', 'CALLE 3 CASA 39 BARRIO EL ROSARIO', 'EL TAMBO', 'jose@cami.com', '314724444308', '2020-10-24', '5', '1', 'CR', '2020-10-24', 'E', '[{\"id\":\"2\",\"codigo\":\"2533\",\"insumo\":\"SUPER POLLO ENGORDE DORADO P\",\"cantidad\":\"1\",\"unidad\":\"BTO\",\"descuento\":\"1\",\"porcentaje_descuento\":0,\"valor_unitario\":\"69000\",\"valor_bruto\":\"69000\",\"iva\":\"690\",\"porcentaje\":\"1\",\"valor_total\":\"69690\"},{\"id\":\"2\",\"codigo\":\"2533\",\"insumo\":\"SUPER POLLO ENGORDE DORADO P\",\"cantidad\":\"1\",\"unidad\":\"BTO\",\"descuento\":\"1\",\"porcentaje_descuento\":0,\"valor_unitario\":\"69000\",\"valor_bruto\":\"69000\",\"iva\":\"690\",\"porcentaje\":\"1\",\"valor_total\":\"69690\"}]', '2', '2', '138000', '1380', '0', '139380', '0', '139380', '2', '2020-10-24 21:42:55', '2020-10-24 21:42:55'),
(21, 1, 'JOSE CAMILO ZAMORA GOMEZ', '1086359747', 'PRUEBA', 'EL TAMBO', 'josecami@hotmail.com', '3147244308', '2020-10-24', '6', '1', 'CO', '2020-10-24', 'E', '[{\"id\":\"2\",\"codigo\":\"2533\",\"insumo\":\"SUPER POLLO ENGORDE DORADO P\",\"cantidad\":\"1\",\"unidad\":\"BTO\",\"descuento\":\"1\",\"porcentaje_descuento\":0,\"valor_unitario\":\"69000\",\"valor_bruto\":\"69000\",\"iva\":\"690\",\"porcentaje\":\"1\",\"valor_total\":\"69690\"}]', '1', '1', '69000', '690', '0', '69690', '0', '69690', '2', '2020-10-24 21:44:43', '2020-10-24 21:52:29');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pagos_facturas`
--

CREATE TABLE `pagos_facturas` (
  `id` int(11) NOT NULL,
  `id_factura` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`id_factura`)),
  `id_cliente` int(10) NOT NULL,
  `nombre_cliente` varchar(250) NOT NULL,
  `identificacion_cliente` varchar(12) NOT NULL,
  `codigo_factura` varchar(10) NOT NULL,
  `valor_factura` varchar(40) NOT NULL,
  `valor_pagado` varchar(40) NOT NULL,
  `estado` varchar(2) NOT NULL,
  `fecha_pago` date NOT NULL,
  `pagos_json` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`pagos_json`)),
  `observacion` varchar(2500) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id` int(11) NOT NULL,
  `codigo` varchar(6) DEFAULT NULL,
  `insumo` varchar(250) DEFAULT NULL,
  `unidad` varchar(10) NOT NULL DEFAULT 'BTO',
  `peso_kilos` varchar(3) DEFAULT NULL,
  `stock` int(3) DEFAULT 0,
  `valor_unitario_pasto` int(11) DEFAULT NULL,
  `valor_unitario_palmira` int(11) DEFAULT NULL,
  `valor_unitario_venta` int(15) NOT NULL,
  `tipo` varchar(10) NOT NULL,
  `estado` varchar(10) NOT NULL DEFAULT 'A',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id`, `codigo`, `insumo`, `unidad`, `peso_kilos`, `stock`, `valor_unitario_pasto`, `valor_unitario_palmira`, `valor_unitario_venta`, `tipo`, `estado`, `created_at`, `updated_at`) VALUES
(1, '2585', 'POLLITO INICIACION DORADO Q', 'BTO', '40', 49, 62400, 58800, 68000, '2', 'A', '2020-09-28 00:00:00', '2020-10-24 16:39:10'),
(2, '2533', 'SUPER POLLO ENGORDE DORADO P', 'BTO', '40', 36, 63200, 59600, 69000, '2', 'A', '2020-09-28 00:00:00', '2020-10-24 16:52:29'),
(3, '2538', 'POLLO INICIACIÓN D Q', 'BTO', '40', 15, 58400, 54800, 63000, '2', 'A', '2020-09-28 00:00:00', '2020-10-24 16:12:24'),
(4, '2539', 'POLLO ENGORDE D Q', 'BTO', '40', 0, 58000, 54400, 63000, '2', 'A', '2020-09-28 00:00:00', '2020-10-12 15:35:28'),
(5, '2542', 'POLLO CAMPESINO Q', 'BTO', '40', 0, 46000, 42400, 51000, '2', 'A', '2020-09-28 00:00:00', '2020-10-12 15:35:41'),
(6, '2541', 'POLLO CAMPESINO P', 'BTO', '40', 0, 46000, 42400, 51000, '2', 'A', '2020-09-28 00:00:00', '2020-10-12 15:35:51'),
(7, '4504', 'CERDOS LEVANTE LÍNEA NARANJA', 'BTO', '40', 50, 61200, 57600, 68000, '3', 'A', '2020-09-28 00:00:00', '2020-10-24 16:15:57'),
(8, '4508', 'CERDOS FINALIZADOR LÍNEA NARANJA', 'BTO', '40', 50, 58800, 55200, 63000, '3', 'A', '2020-09-28 00:00:00', '2020-10-24 16:12:24'),
(9, '4517', 'SUPER CERDO LEVANTE', 'BTO', '40', 0, 54800, 51200, 58000, '3', 'A', '2020-09-28 00:00:00', '2020-10-12 15:36:35'),
(10, '4521', 'SUPER CERDO ENGORDE', 'BTO', '40', 0, 53200, 49600, 59000, '3', 'A', '2020-09-28 00:00:00', '2020-10-24 15:11:24'),
(11, '4576', 'CERDO LEVANTE DISTRIBUCIÓN', 'BTO', '40', 0, 48000, 44400, 53000, '3', 'A', '2020-09-28 00:00:00', '2020-10-12 15:37:08'),
(12, '4525', 'CERDO ENGORDE DISTRIBUCIÓN', 'BTO', '40', 0, 46400, 42800, 53000, '3', 'A', '2020-09-28 00:00:00', '2020-10-12 15:37:16'),
(13, '4513', 'CERDAS LACTANCIAS LN', 'BTO', '40', 0, 56800, 53200, 65000, '3', 'A', '2020-09-28 00:00:00', '2020-10-12 15:37:29'),
(14, '4510', 'CERDAS GESTACIÓN LN', 'BTO', '40', 0, 51600, 48000, 59000, '3', 'A', '2020-09-28 00:00:00', '2020-10-12 15:37:38'),
(15, '4502', 'CERDITO INICIACIÓN LN', 'BTO', '40', 0, 67230, 63630, 75000, '3', 'A', '2020-09-28 00:00:00', '2020-10-12 15:37:51'),
(16, '3561', 'SUPER HUEVO PREPICO Q', 'BTO', '40', 0, 52000, 48400, 63000, '1', 'A', '2020-09-28 00:00:00', '2020-10-12 15:38:12'),
(17, '3660', 'HUEVO PREPICO D Q', 'BTO', '40', 0, 49600, 46000, 52000, '1', 'A', '2020-09-28 00:00:00', '2020-10-12 15:38:21'),
(18, '5073', 'ITAL CUYES', 'BTO', '40', 0, 51240, 47640, 57000, '5', 'A', '2020-09-28 00:00:00', '2020-10-12 15:38:30'),
(19, '5050', 'ITAL LECHE 4500', 'BTO', '40', 0, 36440, 32840, 48000, '5', 'A', '2020-09-28 00:00:00', '2020-10-12 15:38:42'),
(20, '5518', 'ITAL SAL 5', 'BTO', '40', 0, 51150, 47550, 63000, '6', 'A', '2020-09-28 00:00:00', '2020-10-12 15:38:55'),
(21, '5568', 'ITAL SAL 5 X 10 KG', 'BTO', '40', 0, 0, 0, 0, '6', 'A', '2020-09-28 00:00:00', '2020-10-08 02:29:47'),
(22, '7006', 'CABALLOS FURIA TOTAL', 'BTO', '40', 0, 39960, 36360, 45000, '7', 'A', '2020-09-28 00:00:00', '2020-10-12 15:39:13'),
(23, '499', 'CHUNKY GATOS', 'BTO', '40', 0, 0, 0, 0, '7', 'A', '2020-09-28 00:00:00', '2020-10-08 02:30:00'),
(24, '150385', 'ITALCAN WAFER', 'BTO', '40', 0, 0, 0, 0, '7', 'A', '2020-09-28 00:00:00', '2020-10-08 02:30:08'),
(25, '4500', 'CERDO PREINICIADOR NARANJA', 'BTO', '40', 0, 107200, 103600, 115000, '3', 'A', '2020-09-28 00:00:00', '2020-10-12 15:39:36'),
(26, '7007', 'MULTIFORRAJE EQUINOS', 'BTO', '40', 0, 34200, 30600, 42000, '7', 'A', '2020-09-28 00:00:00', '2020-10-12 15:39:53'),
(27, '5518', 'LECHE SAL 5%', 'BTO', '40', 0, 51150, 47550, 58000, '6', 'A', '2020-09-28 00:00:00', '2020-10-12 15:40:07'),
(28, 'M123', 'HARINA DE SEGUNADA', 'BTO', '50', 0, 45000, 45000, 51000, '8', 'A', '2020-10-06 15:20:14', '2020-10-12 15:40:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id` int(11) NOT NULL,
  `identificacion` varchar(12) NOT NULL,
  `nombre_proveedor` varchar(125) NOT NULL,
  `email` varchar(125) NOT NULL,
  `telefono` varchar(12) DEFAULT NULL,
  `direccion` varchar(125) DEFAULT NULL,
  `departamento` varchar(120) DEFAULT NULL,
  `ciudad` varchar(120) DEFAULT NULL,
  `estado` varchar(2) DEFAULT 'A',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id`, `identificacion`, `nombre_proveedor`, `email`, `telefono`, `direccion`, `departamento`, `ciudad`, `estado`, `created_at`, `updated_at`) VALUES
(1, '891304762', 'ITALCOL DE OCCIDENTE SA', 'www.italcol.com', '3137978541', 'ALTOS DE DAZA KM 5 VIA AL NORTE', 'NARIñO', 'PASTO', 'A', '2020-10-19 06:23:01', '2020-10-19 21:26:30');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `identificacion` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tipo` tinyint(4) NOT NULL DEFAULT 1,
  `rol` tinyint(4) NOT NULL DEFAULT 0,
  `nombres` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telefono` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `estado` tinyint(4) NOT NULL DEFAULT 1,
  `remember_token` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id`, `identificacion`, `tipo`, `rol`, `nombres`, `email`, `password`, `telefono`, `estado`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, NULL, 1, 1, 'NILTON JAIRO HOYOS GOMEZ', 'niltonjairo2000@gmail.com', '$2y$10$zFL8KnWYYZvWQQ1SSBpXtOBZiV34CD65xeP88RQ3EJvlU8J8i9HYa', '3173531171', 1, NULL, NULL, NULL),
(2, '1086359747', 1, 1, 'Jose Camilo Zamora Gomez', 'jczamorago@hotmail.com', '$2y$10$a.UvxmnTBH.kx6Y4aaV4WOqRnc.YwAg7MkkLvqcX6Vrdmldp60hTO', '11111111', 1, NULL, NULL, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `clientes`
--
ALTER TABLE `clientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `facturas_compra`
--
ALTER TABLE `facturas_compra`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `facturas_venta`
--
ALTER TABLE `facturas_venta`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `pagos_facturas`
--
ALTER TABLE `pagos_facturas`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `clientes`
--
ALTER TABLE `clientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `facturas_compra`
--
ALTER TABLE `facturas_compra`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT de la tabla `facturas_venta`
--
ALTER TABLE `facturas_venta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT de la tabla `pagos_facturas`
--
ALTER TABLE `pagos_facturas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
