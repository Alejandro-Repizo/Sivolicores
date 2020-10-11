-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 11-10-2020 a las 06:17:39
-- Versión del servidor: 10.4.11-MariaDB
-- Versión de PHP: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `dbsivolicores`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_administrador`
--

CREATE TABLE `tbl_administrador` (
  `PK_ID_Administrador` int(11) NOT NULL,
  `Ad_Nombre` varchar(45) NOT NULL,
  `Ad_Apellido` varchar(45) NOT NULL,
  `Ad_Email` varchar(100) NOT NULL,
  `Ad_Password` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_banner`
--

CREATE TABLE `tbl_banner` (
  `PK_ID_Banner` int(11) NOT NULL,
  `B_Imagen` text NOT NULL,
  `B_Nombre` varchar(45) NOT NULL,
  `B_Fecha_actualizacion` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_carrito_pedidos`
--

CREATE TABLE `tbl_carrito_pedidos` (
  `PK_ID_Carrito` int(11) NOT NULL,
  `Pt_Cantidad` int(11) NOT NULL,
  `Car_Total` float NOT NULL,
  `Car_SubTotal` float NOT NULL,
  `FK_ID_Cliente` int(11) NOT NULL,
  `FK_ID_Producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_categoria`
--

CREATE TABLE `tbl_categoria` (
  `PK_ID_Categoria` int(11) NOT NULL,
  `Cat_Nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Disparadores `tbl_categoria`
--
DELIMITER $$
CREATE TRIGGER `Tbl_catxsub_Tbl_categoria_BEFORE_DELETE` BEFORE DELETE ON `tbl_categoria` FOR EACH ROW BEGIN
    DELETE 
      FROM tbl_catxsub
     WHERE (FK_ID_Categoria = old.PK_ID_Categoria);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_catxsub`
--

CREATE TABLE `tbl_catxsub` (
  `FK_ID_Categoria` int(11) DEFAULT NULL,
  `FK_ID_SubCategoria` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_cliente`
--

CREATE TABLE `tbl_cliente` (
  `PK_ID_Cliente` int(11) NOT NULL,
  `Cl_Nombre` varchar(45) NOT NULL,
  `Cl_Apellido` varchar(45) NOT NULL,
  `Cl_Dirección` varchar(45) NOT NULL,
  `Cl_Telefono` varchar(16) NOT NULL,
  `Cl_Fecha_registro` datetime NOT NULL DEFAULT current_timestamp(),
  `Cl_Pedidos_realizado` varchar(5) NOT NULL,
  `Cl_email` varchar(64) NOT NULL,
  `Cl_password` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_envio`
--

CREATE TABLE `tbl_envio` (
  `PK_ID_Envio` int(11) DEFAULT NULL,
  `Env_Fecha` text DEFAULT NULL,
  `Env_Estado` varchar(45) DEFAULT NULL,
  `Env_Direccion` text DEFAULT NULL,
  `Env_Observaciones` text DEFAULT NULL,
  `FK_ID_Carrito` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_inventario`
--

CREATE TABLE `tbl_inventario` (
  `PK_ID_Inventario` int(11) NOT NULL,
  `FK_ID_ProductoInventario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Disparadores `tbl_inventario`
--
DELIMITER $$
CREATE TRIGGER `Tbl_Invetario_AFTER_DELETE` AFTER DELETE ON `tbl_inventario` FOR EACH ROW BEGIN
    DELETE 
      FROM tbl_producto
     WHERE (PK_ID_Producto = old.FK_ID_ProductoInventario);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_marca`
--

CREATE TABLE `tbl_marca` (
  `PK_ID_Marca` int(11) NOT NULL,
  `Ma_Nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_pedido`
--

CREATE TABLE `tbl_pedido` (
  `PK_ID_Pedido` int(11) NOT NULL,
  `Ped_Fecha` datetime NOT NULL DEFAULT current_timestamp(),
  `Ped_Estado` varchar(45) NOT NULL,
  `Ped_Direccion` varchar(45) NOT NULL,
  `Ped_observaciones` text DEFAULT NULL,
  `FK_ID_Carrito` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_producto`
--

CREATE TABLE `tbl_producto` (
  `PK_ID_Producto` int(11) NOT NULL,
  `Pt_codigo` varchar(5) NOT NULL,
  `Pt_Nombre` varchar(45) NOT NULL,
  `Pt_Precio` varchar(20) NOT NULL,
  `Pt_Imagen` text DEFAULT NULL,
  `Pt_Presentacion` varchar(5) NOT NULL,
  `Pt_Grados_alchol` varchar(10) NOT NULL,
  `Pt_Pais` varchar(45) NOT NULL,
  `Pt_Color` varchar(45) NOT NULL,
  `Pt_Stock` varchar(5) NOT NULL,
  `FK_ID_Categoria` int(11) NOT NULL,
  `FK_ID_Marca` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Disparadores `tbl_producto`
--
DELIMITER $$
CREATE TRIGGER `Tbl_Producto_AFTER_INSERT` AFTER INSERT ON `tbl_producto` FOR EACH ROW BEGIN
INSERT INTO tbl_inventario
(FK_ID_ProductoInventario)
VALUES(new.PK_ID_Producto);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_receta_coctel`
--

CREATE TABLE `tbl_receta_coctel` (
  `PK_ID_Receta` int(11) NOT NULL,
  `RC_Nombre` varchar(45) NOT NULL,
  `RC_Receta` text NOT NULL,
  `RC_Fecha` date NOT NULL DEFAULT current_timestamp(),
  `RC_Autor` varchar(45) NOT NULL,
  `RC_Descripcion` text NOT NULL,
  `RC_Image` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_reporte_pedido`
--

CREATE TABLE `tbl_reporte_pedido` (
  `PK_ID_reporte` int(11) DEFAULT NULL,
  `RepP_Fecha` text DEFAULT NULL,
  `RepP_Estado` varchar(45) DEFAULT NULL,
  `RepP_Direccion` text DEFAULT NULL,
  `RepP_Observaciones` text DEFAULT NULL,
  `FK_ID_Carrito` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_reporte_ventas`
--

CREATE TABLE `tbl_reporte_ventas` (
  `PK_ID_reporte` int(11) DEFAULT NULL,
  `RepV_Fecha` text DEFAULT NULL,
  `Repv_Estado` varchar(45) DEFAULT NULL,
  `RepV_Direccion` text DEFAULT NULL,
  `RepV_Observaciones` text DEFAULT NULL,
  `FK_ID_Carrito` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tbl_subcategoria`
--

CREATE TABLE `tbl_subcategoria` (
  `PK_ID_SubCategoria` int(11) NOT NULL,
  `SCat_Nombre` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Disparadores `tbl_subcategoria`
--
DELIMITER $$
CREATE TRIGGER `Tbl_catxsub_BEFORE_DELETE` BEFORE DELETE ON `tbl_subcategoria` FOR EACH ROW BEGIN
    DELETE 
      FROM tbl_catxsub
     WHERE (FK_ID_SubCategoria = old.PK_ID_SubCategoria);
END
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `tbl_administrador`
--
ALTER TABLE `tbl_administrador`
  ADD PRIMARY KEY (`PK_ID_Administrador`);

--
-- Indices de la tabla `tbl_banner`
--
ALTER TABLE `tbl_banner`
  ADD PRIMARY KEY (`PK_ID_Banner`);

--
-- Indices de la tabla `tbl_carrito_pedidos`
--
ALTER TABLE `tbl_carrito_pedidos`
  ADD PRIMARY KEY (`PK_ID_Carrito`),
  ADD KEY `FK_ID_Cliente` (`FK_ID_Cliente`),
  ADD KEY `FK_ID_Producto` (`FK_ID_Producto`);

--
-- Indices de la tabla `tbl_categoria`
--
ALTER TABLE `tbl_categoria`
  ADD PRIMARY KEY (`PK_ID_Categoria`);

--
-- Indices de la tabla `tbl_catxsub`
--
ALTER TABLE `tbl_catxsub`
  ADD KEY `FK_ID_Categoria` (`FK_ID_Categoria`),
  ADD KEY `FK_ID_SubCategoria` (`FK_ID_SubCategoria`);

--
-- Indices de la tabla `tbl_cliente`
--
ALTER TABLE `tbl_cliente`
  ADD PRIMARY KEY (`PK_ID_Cliente`);

--
-- Indices de la tabla `tbl_envio`
--
ALTER TABLE `tbl_envio`
  ADD KEY `FK_ID_Carrito` (`FK_ID_Carrito`);

--
-- Indices de la tabla `tbl_inventario`
--
ALTER TABLE `tbl_inventario`
  ADD PRIMARY KEY (`PK_ID_Inventario`),
  ADD KEY `FK_ID_ProductoInventario` (`FK_ID_ProductoInventario`);

--
-- Indices de la tabla `tbl_marca`
--
ALTER TABLE `tbl_marca`
  ADD PRIMARY KEY (`PK_ID_Marca`);

--
-- Indices de la tabla `tbl_pedido`
--
ALTER TABLE `tbl_pedido`
  ADD PRIMARY KEY (`PK_ID_Pedido`),
  ADD KEY `FK_ID_Carrito` (`FK_ID_Carrito`);

--
-- Indices de la tabla `tbl_producto`
--
ALTER TABLE `tbl_producto`
  ADD PRIMARY KEY (`PK_ID_Producto`),
  ADD KEY `FK_ID_Categoria` (`FK_ID_Categoria`),
  ADD KEY `FK_ID_Marca` (`FK_ID_Marca`);

--
-- Indices de la tabla `tbl_receta_coctel`
--
ALTER TABLE `tbl_receta_coctel`
  ADD PRIMARY KEY (`PK_ID_Receta`);

--
-- Indices de la tabla `tbl_reporte_pedido`
--
ALTER TABLE `tbl_reporte_pedido`
  ADD KEY `FK_ID_Carrito` (`FK_ID_Carrito`);

--
-- Indices de la tabla `tbl_reporte_ventas`
--
ALTER TABLE `tbl_reporte_ventas`
  ADD KEY `FK_ID_Carrito` (`FK_ID_Carrito`);

--
-- Indices de la tabla `tbl_subcategoria`
--
ALTER TABLE `tbl_subcategoria`
  ADD PRIMARY KEY (`PK_ID_SubCategoria`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `tbl_banner`
--
ALTER TABLE `tbl_banner`
  MODIFY `PK_ID_Banner` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_carrito_pedidos`
--
ALTER TABLE `tbl_carrito_pedidos`
  MODIFY `PK_ID_Carrito` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_categoria`
--
ALTER TABLE `tbl_categoria`
  MODIFY `PK_ID_Categoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_cliente`
--
ALTER TABLE `tbl_cliente`
  MODIFY `PK_ID_Cliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_inventario`
--
ALTER TABLE `tbl_inventario`
  MODIFY `PK_ID_Inventario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_marca`
--
ALTER TABLE `tbl_marca`
  MODIFY `PK_ID_Marca` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_pedido`
--
ALTER TABLE `tbl_pedido`
  MODIFY `PK_ID_Pedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_producto`
--
ALTER TABLE `tbl_producto`
  MODIFY `PK_ID_Producto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_receta_coctel`
--
ALTER TABLE `tbl_receta_coctel`
  MODIFY `PK_ID_Receta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tbl_subcategoria`
--
ALTER TABLE `tbl_subcategoria`
  MODIFY `PK_ID_SubCategoria` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `tbl_carrito_pedidos`
--
ALTER TABLE `tbl_carrito_pedidos`
  ADD CONSTRAINT `FK_ID_Cliente` FOREIGN KEY (`FK_ID_Cliente`) REFERENCES `tbl_cliente` (`PK_ID_Cliente`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `FK_ID_Producto` FOREIGN KEY (`FK_ID_Producto`) REFERENCES `tbl_producto` (`PK_ID_Producto`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_catxsub`
--
ALTER TABLE `tbl_catxsub`
  ADD CONSTRAINT `tbl_catxsub_ibfk_1` FOREIGN KEY (`FK_ID_Categoria`) REFERENCES `tbl_categoria` (`PK_ID_Categoria`),
  ADD CONSTRAINT `tbl_catxsub_ibfk_2` FOREIGN KEY (`FK_ID_SubCategoria`) REFERENCES `tbl_subcategoria` (`PK_ID_SubCategoria`);

--
-- Filtros para la tabla `tbl_envio`
--
ALTER TABLE `tbl_envio`
  ADD CONSTRAINT `tbl_envio_ibfk_1` FOREIGN KEY (`FK_ID_Carrito`) REFERENCES `tbl_carrito_pedidos` (`PK_ID_Carrito`);

--
-- Filtros para la tabla `tbl_inventario`
--
ALTER TABLE `tbl_inventario`
  ADD CONSTRAINT `FK_ID_ProductoInventario` FOREIGN KEY (`FK_ID_ProductoInventario`) REFERENCES `tbl_producto` (`PK_ID_Producto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_pedido`
--
ALTER TABLE `tbl_pedido`
  ADD CONSTRAINT `FK_ID_Carrito` FOREIGN KEY (`FK_ID_Carrito`) REFERENCES `tbl_carrito_pedidos` (`PK_ID_Carrito`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Filtros para la tabla `tbl_producto`
--
ALTER TABLE `tbl_producto`
  ADD CONSTRAINT `FK_ID_Categoria` FOREIGN KEY (`FK_ID_Categoria`) REFERENCES `tbl_categoria` (`PK_ID_Categoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_ID_Marca` FOREIGN KEY (`FK_ID_Marca`) REFERENCES `tbl_marca` (`PK_ID_Marca`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `tbl_reporte_pedido`
--
ALTER TABLE `tbl_reporte_pedido`
  ADD CONSTRAINT `tbl_reporte_pedido_ibfk_1` FOREIGN KEY (`FK_ID_Carrito`) REFERENCES `tbl_carrito_pedidos` (`PK_ID_Carrito`);

--
-- Filtros para la tabla `tbl_reporte_ventas`
--
ALTER TABLE `tbl_reporte_ventas`
  ADD CONSTRAINT `tbl_reporte_ventas_ibfk_1` FOREIGN KEY (`FK_ID_Carrito`) REFERENCES `tbl_carrito_pedidos` (`PK_ID_Carrito`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
