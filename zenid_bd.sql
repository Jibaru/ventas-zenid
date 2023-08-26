-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 27-12-2021 a las 23:38:45
-- Versión del servidor: 10.1.38-MariaDB
-- Versión de PHP: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `zenid_bd`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `boletas`
--

CREATE TABLE `boletas` (
  `id_boleta` int(11) NOT NULL,
  `dni` varchar(8) COLLATE utf16_spanish_ci NOT NULL,
  `fecha_emision` date NOT NULL,
  `id_venta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

--
-- Volcado de datos para la tabla `boletas`
--

INSERT INTO `boletas` (`id_boleta`, `dni`, `fecha_emision`, `id_venta`) VALUES
(1, '70023612', '2021-12-26', 1),
(2, '75523012', '2021-12-26', 3),
(6, '07253615', '2021-12-27', 8);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_productos_pedidos_almacen`
--

CREATE TABLE `detalle_productos_pedidos_almacen` (
  `cantidad` int(11) NOT NULL,
  `id_pedido_almacen` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `detalle_productos_pedidos_almacen`
--

INSERT INTO `detalle_productos_pedidos_almacen` (`cantidad`, `id_pedido_almacen`, `id_producto`) VALUES
(12, 3, 1),
(5, 3, 5),
(12, 4, 1),
(5, 4, 5),
(12, 5, 1),
(5, 5, 5),
(12, 6, 1),
(5, 6, 5),
(12, 7, 1),
(5, 7, 5),
(12, 8, 1),
(5, 8, 5),
(12, 9, 1),
(5, 9, 5),
(12, 10, 1),
(5, 10, 5),
(12, 11, 1),
(2, 11, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `facturas`
--

CREATE TABLE `facturas` (
  `id_factura` int(11) NOT NULL,
  `ruc` varchar(10) COLLATE utf16_spanish_ci NOT NULL,
  `fecha_emision` date NOT NULL,
  `id_venta` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

--
-- Volcado de datos para la tabla `facturas`
--

INSERT INTO `facturas` (`id_factura`, `ruc`, `fecha_emision`, `id_venta`) VALUES
(1, '1023651230', '2021-12-26', 2),
(2, '2052542677', '2021-12-27', 9),
(3, '2055385645', '2021-12-27', 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marcas`
--

CREATE TABLE `marcas` (
  `id_marca` int(11) NOT NULL,
  `nombre` varchar(40) COLLATE utf16_spanish_ci NOT NULL,
  `habilitado` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

--
-- Volcado de datos para la tabla `marcas`
--

INSERT INTO `marcas` (`id_marca`, `nombre`, `habilitado`) VALUES
(1, 'Layconza', 1),
(3, 'Artesco', 1),
(4, 'Standford', 1),
(5, 'Faber Castell', 1),
(6, 'Patito Feo', 1),
(7, 'Illinois', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pedidos_almacen`
--

CREATE TABLE `pedidos_almacen` (
  `id_pedido_almacen` int(11) NOT NULL,
  `observaciones` text COLLATE utf16_spanish_ci,
  `fecha_emision` date NOT NULL,
  `fecha_aprobacion` date DEFAULT NULL,
  `id_proveedor` int(11) DEFAULT NULL,
  `id_usuario_pedido` int(11) NOT NULL,
  `id_usuario_aprobacion` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

--
-- Volcado de datos para la tabla `pedidos_almacen`
--

INSERT INTO `pedidos_almacen` (`id_pedido_almacen`, `observaciones`, `fecha_emision`, `fecha_aprobacion`, `id_proveedor`, `id_usuario_pedido`, `id_usuario_aprobacion`) VALUES
(3, 'buenas', '2021-12-23', '2021-12-26', 4, 2, 2),
(4, 'buenas', '2021-12-23', NULL, NULL, 2, NULL),
(5, 'buenas', '2021-12-23', NULL, NULL, 2, NULL),
(6, 'buenas', '2021-12-23', NULL, NULL, 2, NULL),
(7, 'buenas', '2021-12-23', NULL, NULL, 2, NULL),
(8, 'buenas', '2021-12-23', NULL, NULL, 2, NULL),
(9, 'buenas', '2021-12-23', NULL, NULL, 2, NULL),
(10, 'buenas', '2021-12-23', NULL, NULL, 2, NULL),
(11, '', '2021-12-23', NULL, NULL, 2, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `privilegios`
--

CREATE TABLE `privilegios` (
  `id_privilegio` int(11) NOT NULL,
  `nombre` varchar(40) COLLATE utf16_spanish_ci NOT NULL,
  `path` varchar(200) COLLATE utf16_spanish_ci NOT NULL,
  `icono` varchar(200) COLLATE utf16_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

--
-- Volcado de datos para la tabla `privilegios`
--

INSERT INTO `privilegios` (`id_privilegio`, `nombre`, `path`, `icono`) VALUES
(1, 'Gestionar Roles', '../moduloSeguridad/GetFormGestionarRoles.php', '<i class=\"fas fa-key\"></i>'),
(2, 'Gestionar Usuarios', '../ModuloSeguridad/GetFormGestionarUsuarios.php', '<i class=\"fas fa-users\"></i>'),
(3, 'Emitir Profoma', '../ModuloVentas/GetFormRealizarProforma.php', '<i class=\"fas fa-copy\"></i>'),
(4, 'Generar Pedido', '../ModuloAlmacen/GetFormGenerarPedido.php', '<i class=\"fas fa-marker\"></i>'),
(5, 'Gestionar Productos', '../ModuloAlmacen/GetFormGestionarProductos.php\r\n', '<i class=\"fas fa-sitemap\"></i>'),
(6, 'Gestionar Proveedores', '../ModuloFinanzas/GetFormGestionarProveedores.php', '<i class=\"fas fa-people-carry\"></i>'),
(7, 'Aprobar Pedido', '../ModuloFinanzas/GetFormListaPedidosAlmacen.php', '<i class=\"fas fa-check-circle\"></i>'),
(8, 'Realizar Venta', '../ModuloVentas/GetFormGenerarVenta.php', '<i class=\"fab fa-shopify\"></i>'),
(9, 'Gestionar Despacho', '../ModuloVentas/GetFormGestionarDespacho.php', '<i class=\"fas fa-box-open\"></i>'),
(10, 'Generar Reporte Ventas', '../ModuloFinanzas/GetFormGenerarReporteVentas.php', '<i class=\"fas fa-file-contract\"></i>');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `id_producto` int(11) NOT NULL,
  `nombre` varchar(40) COLLATE utf16_spanish_ci NOT NULL,
  `codigo_barras` varchar(40) COLLATE utf16_spanish_ci NOT NULL,
  `descripcion` text COLLATE utf16_spanish_ci NOT NULL,
  `igv` double NOT NULL,
  `precio_compra_unitario` double NOT NULL,
  `precio_venta` double NOT NULL,
  `stock` int(11) NOT NULL,
  `stock_minimo` int(11) NOT NULL,
  `habilitado` tinyint(1) NOT NULL DEFAULT '1',
  `id_marca` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`id_producto`, `nombre`, `codigo_barras`, `descripcion`, `igv`, `precio_compra_unitario`, `precio_venta`, `stock`, `stock_minimo`, `habilitado`, `id_marca`) VALUES
(1, 'LAPIZ TECNICO 2B S/B', '19999', 'LAPIZ TECNICO 2B S/B CAX12', 0.5, 5, 10, 50, 10, 1, 1),
(2, 'Plumones doble punta', '350212', 'Plumones doble punta x 10 colores\r\nPunta doble delgada (ancho de trazo aprox.1-3mm) y punta gruesa (ancho de trazo aprox. 2-6mm)\r\nTinta lavable a base de agua y colorantes alimentario', 1, 20, 24.1, 50, 10, 1, 5),
(3, 'Crayones de cera delgados', '222012', 'Crayones de cera delgados estuche x12\r\nCrayones de cera, trazos suaves y colores intensos', 0.1, 2.5, 2.7, 32, 5, 1, 5),
(4, 'BOLÍGRAFO CRYSTAL L-036', '2110080226', 'BOLÍGRAFO CRYSTAL L-036 x 10 COLORES\r\nHecho con punta importada de Suiza y tinta alemana.', 0.1, 10, 12, 35, 10, 1, 1),
(5, 'Cuaderno Premium Pre Escolar Cosido', '121235450', 'Cuaderno Premium Pre Escolar Cosido x unidad', 0.1, 5, 5.5, 35, 10, 1, 4),
(6, 'TÉMPERAS X 7 COLORES', '348271', 'Témperas de colores intensos.\r\nPintura ligera a base de agua.', 0.2, 7, 7.9, 28, 10, 1, 3),
(7, 'Borrador', '123134', 'Borrador multipropósito', 0.1, 1, 1.1, 23, 5, 1, 3),
(8, 'BOLÍGRAFO CRYSTAL L-036', '2110080226', 'BOLÍGRAFO CRYSTAL L-036 x 10 COLORES\r\nHecho con punta importada de Suiza y tinta alemana.', 0.1, 10, 11, 35, 10, 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos_proformados`
--

CREATE TABLE `productos_proformados` (
  `cantidad` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `id_proforma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `productos_proformados`
--

INSERT INTO `productos_proformados` (`cantidad`, `id_producto`, `id_proforma`) VALUES
(12, 1, 1),
(2, 3, 1),
(12, 1, 2),
(2, 3, 2),
(12, 1, 3),
(2, 3, 3),
(10, 1, 4),
(2, 5, 4),
(12, 6, 5),
(3, 5, 5),
(12, 6, 6),
(3, 5, 6),
(12, 6, 7),
(3, 5, 7),
(12, 6, 8),
(3, 5, 8),
(3, 6, 9),
(3, 5, 9),
(12, 1, 9),
(3, 3, 9),
(3, 6, 10),
(3, 5, 10),
(12, 1, 10),
(3, 3, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proformas`
--

CREATE TABLE `proformas` (
  `id_proforma` int(11) NOT NULL,
  `nombre_referencial` varchar(100) COLLATE utf16_spanish_ci NOT NULL,
  `fecha_emision` date NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

--
-- Volcado de datos para la tabla `proformas`
--

INSERT INTO `proformas` (`id_proforma`, `nombre_referencial`, `fecha_emision`, `id_usuario`) VALUES
(1, 'Ignacio', '2021-12-22', 2),
(2, 'Ignacio', '2021-12-22', 2),
(3, '4444', '2021-12-22', 2),
(4, 'observaciones', '2021-12-23', 2),
(5, 'Adrián Velasquez Tapia', '2021-12-23', 2),
(6, 'Adrián Velasquez Tapia', '2021-12-23', 2),
(7, 'Adrián Velasquez Tapia', '2021-12-23', 2),
(8, 'Adrián Velasquez Tapia', '2021-12-23', 2),
(9, 'Andrés Calamaro', '2021-12-23', 2),
(10, 'Andrés Calamaro', '2021-12-23', 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `id_proveedor` int(11) NOT NULL,
  `nombre` varchar(40) COLLATE utf16_spanish_ci NOT NULL,
  `ruc` varchar(10) COLLATE utf16_spanish_ci NOT NULL,
  `correo_electronico` varchar(100) COLLATE utf16_spanish_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf16_spanish_ci NOT NULL,
  `habilitado` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

--
-- Volcado de datos para la tabla `proveedores`
--

INSERT INTO `proveedores` (`id_proveedor`, `nombre`, `ruc`, `correo_electronico`, `telefono`, `habilitado`) VALUES
(4, 'Libritos SAC', '1065234950', 'libritos@gmail.com', '98526315', 1),
(5, 'Cuadernos S&M', '1065234950', 'libritos@gmail.com', '98526315', 1),
(6, 'Útiles Samán', '1036254910', 'utsaman@gmail.com', '2316545', 1),
(7, 'Útiles Samán', '1036254710', 'utsaman@gmail.com', '2316545', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `representantes`
--

CREATE TABLE `representantes` (
  `id_representante` int(11) NOT NULL,
  `nombre` varchar(40) COLLATE utf16_spanish_ci NOT NULL,
  `correo_electronico` varchar(100) COLLATE utf16_spanish_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf16_spanish_ci NOT NULL,
  `id_proveedor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

--
-- Volcado de datos para la tabla `representantes`
--

INSERT INTO `representantes` (`id_representante`, `nombre`, `correo_electronico`, `telefono`, `id_proveedor`) VALUES
(2, 'Rubén', 'ruben188@gmail.com', '963258741', 4),
(3, 'Giancarlo Chavez', 'ruben188@gmail.com', '963258741', 5),
(4, 'Jorge Samán', 'jsaman@gmail.com', '963220312', 6),
(5, 'Jorge Samán', 'jsaman@gmail.com', '963220312', 7);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles`
--

CREATE TABLE `roles` (
  `id_rol` int(11) NOT NULL,
  `nombre` varchar(40) COLLATE utf16_spanish_ci NOT NULL,
  `habilitado` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

--
-- Volcado de datos para la tabla `roles`
--

INSERT INTO `roles` (`id_rol`, `nombre`, `habilitado`) VALUES
(1, 'ADMINISTRADOR', 1),
(4, 'CAJERO', 1),
(5, 'DESPACHADOR', 1),
(6, 'ENCARGADO DE ALMACÉN', 1),
(7, 'ENCARGADO DE FINANZAS', 1),
(8, 'VENDEDOR', 1),
(9, 'ADMINISTRADOR SISTEMA', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `roles_privilegios`
--

CREATE TABLE `roles_privilegios` (
  `id_rol` int(11) NOT NULL,
  `id_privilegio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `roles_privilegios`
--

INSERT INTO `roles_privilegios` (`id_rol`, `id_privilegio`) VALUES
(8, 5),
(5, 9),
(7, 6),
(7, 7),
(7, 10),
(6, 4),
(6, 5),
(9, 1),
(9, 2),
(9, 3),
(9, 4),
(9, 5),
(9, 6),
(9, 7),
(9, 8),
(9, 9),
(9, 10),
(4, 8),
(1, 1),
(1, 2);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `correo_electronico` varchar(100) COLLATE utf16_spanish_ci NOT NULL,
  `contrasenia` text COLLATE utf16_spanish_ci NOT NULL COMMENT 'Encriptado con bcrypt',
  `nombre` varchar(40) COLLATE utf16_spanish_ci NOT NULL,
  `ape_paterno` varchar(40) COLLATE utf16_spanish_ci NOT NULL,
  `ape_materno` varchar(40) COLLATE utf16_spanish_ci NOT NULL,
  `telefono` varchar(20) COLLATE utf16_spanish_ci DEFAULT NULL,
  `dni` varchar(8) COLLATE utf16_spanish_ci NOT NULL,
  `habilitado` tinyint(1) NOT NULL DEFAULT '1',
  `id_rol` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `correo_electronico`, `contrasenia`, `nombre`, `ape_paterno`, `ape_materno`, `telefono`, `dni`, `habilitado`, `id_rol`) VALUES
(2, 'ignacioruedaboada@gmail.com', '$2y$10$vrzwghyR6Ufuyn.DbdaSSuhma.bUTtP.Zpu.mJtwwlfjv7J/JOGEm', 'ignacio', 'rueda', 'boada', '982705024', '74536964', 1, 9),
(3, 'ruben@gmail.com', '$2y$10$H7BUqNHBbPl9Q2ioWhYhDeLLXnR8mKrXpnpgMGffkXhNgSzSHt3ve', 'Ruben', 'Vasquez', 'De La Cruz', '91212311', '76381293', 1, 4),
(4, 'danielcondor9@gmail.com', '$2y$10$H7BUqNHBbPl9Q2ioWhYhDeLLXnR8mKrXpnpgMGffkXhNgSzSHt3ve', 'Daniel', 'Condor', 'García', '2310524', '75520135', 1, 1),
(5, 'cegaje17@gmail.com', '$2y$10$17CIPyCpHVw8FP4uoYwy3.W3taQHXcdnfiyI3rIR2kcaoi73Nm.zm', 'Giancarlo', 'Chávez', 'Arqque', '965216021', '07795864', 1, 5);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios_privilegios`
--

CREATE TABLE `usuarios_privilegios` (
  `id_usuario` int(11) NOT NULL,
  `id_privilegio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `usuarios_privilegios`
--

INSERT INTO `usuarios_privilegios` (`id_usuario`, `id_privilegio`) VALUES
(3, 1),
(3, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ventas`
--

CREATE TABLE `ventas` (
  `id_venta` int(11) NOT NULL,
  `nombres` varchar(40) COLLATE utf16_spanish_ci NOT NULL,
  `ape_paterno` varchar(40) COLLATE utf16_spanish_ci NOT NULL,
  `ape_materno` varchar(40) COLLATE utf16_spanish_ci NOT NULL,
  `fecha_emision` date NOT NULL,
  `fecha_despacho` date DEFAULT NULL,
  `unidades` int(11) NOT NULL,
  `total_venta` double NOT NULL,
  `total_compra` double NOT NULL,
  `id_proforma` int(11) NOT NULL,
  `id_usuario_venta` int(11) NOT NULL,
  `id_usuario_despacho` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf16 COLLATE=utf16_spanish_ci;

--
-- Volcado de datos para la tabla `ventas`
--

INSERT INTO `ventas` (`id_venta`, `nombres`, `ape_paterno`, `ape_materno`, `fecha_emision`, `fecha_despacho`, `unidades`, `total_venta`, `total_compra`, `id_proforma`, `id_usuario_venta`, `id_usuario_despacho`) VALUES
(1, 'Dessiret', 'Hernandez', 'Carolain', '2021-12-26', NULL, 21, 235.5, 103.5, 10, 4, NULL),
(2, 'Rodrigo', 'Varas', 'Agramonte', '2021-12-20', '2021-12-26', 14, 185.94, 65, 1, 2, 2),
(3, 'Victor', 'Chávez', 'Vásquez', '2021-12-26', NULL, 15, 131.91, 99, 6, 3, NULL),
(8, 'Uriel', 'Hernandez', 'Calla', '2021-12-27', NULL, 14, 185.94, 55, 2, 2, NULL),
(9, 'Irma', 'Flores', 'Sánchez', '2021-12-27', '2021-12-27', 12, 162.1, 60, 4, 2, 2),
(10, 'Tatiana', 'Ruiz', 'Cárdenas', '2021-12-27', NULL, 15, 131.91, 99, 7, 2, NULL);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `boletas`
--
ALTER TABLE `boletas`
  ADD PRIMARY KEY (`id_boleta`),
  ADD KEY `id_venta` (`id_venta`);

--
-- Indices de la tabla `detalle_productos_pedidos_almacen`
--
ALTER TABLE `detalle_productos_pedidos_almacen`
  ADD KEY `id_pedido_almacen` (`id_pedido_almacen`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indices de la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD PRIMARY KEY (`id_factura`),
  ADD KEY `id_venta` (`id_venta`);

--
-- Indices de la tabla `marcas`
--
ALTER TABLE `marcas`
  ADD PRIMARY KEY (`id_marca`);

--
-- Indices de la tabla `pedidos_almacen`
--
ALTER TABLE `pedidos_almacen`
  ADD PRIMARY KEY (`id_pedido_almacen`),
  ADD KEY `id_proveedor` (`id_proveedor`),
  ADD KEY `id_usuario_aprobacion` (`id_usuario_aprobacion`),
  ADD KEY `id_usuario_pedido` (`id_usuario_pedido`);

--
-- Indices de la tabla `privilegios`
--
ALTER TABLE `privilegios`
  ADD PRIMARY KEY (`id_privilegio`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`id_producto`),
  ADD KEY `id_marca` (`id_marca`);

--
-- Indices de la tabla `productos_proformados`
--
ALTER TABLE `productos_proformados`
  ADD KEY `id_producto` (`id_producto`),
  ADD KEY `id_proforma` (`id_proforma`);

--
-- Indices de la tabla `proformas`
--
ALTER TABLE `proformas`
  ADD PRIMARY KEY (`id_proforma`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`id_proveedor`);

--
-- Indices de la tabla `representantes`
--
ALTER TABLE `representantes`
  ADD PRIMARY KEY (`id_representante`),
  ADD KEY `id_proveedor` (`id_proveedor`);

--
-- Indices de la tabla `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id_rol`);

--
-- Indices de la tabla `roles_privilegios`
--
ALTER TABLE `roles_privilegios`
  ADD KEY `id_rol` (`id_rol`),
  ADD KEY `id_privilegio` (`id_privilegio`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD KEY `id_rol` (`id_rol`);

--
-- Indices de la tabla `usuarios_privilegios`
--
ALTER TABLE `usuarios_privilegios`
  ADD KEY `id_usuario` (`id_usuario`),
  ADD KEY `id_privilegio` (`id_privilegio`);

--
-- Indices de la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD PRIMARY KEY (`id_venta`),
  ADD KEY `id_proforma` (`id_proforma`),
  ADD KEY `id_usuario_venta` (`id_usuario_venta`),
  ADD KEY `id_usuario_despacho` (`id_usuario_despacho`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `boletas`
--
ALTER TABLE `boletas`
  MODIFY `id_boleta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `facturas`
--
ALTER TABLE `facturas`
  MODIFY `id_factura` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `marcas`
--
ALTER TABLE `marcas`
  MODIFY `id_marca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `pedidos_almacen`
--
ALTER TABLE `pedidos_almacen`
  MODIFY `id_pedido_almacen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de la tabla `privilegios`
--
ALTER TABLE `privilegios`
  MODIFY `id_privilegio` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de la tabla `proformas`
--
ALTER TABLE `proformas`
  MODIFY `id_proforma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `representantes`
--
ALTER TABLE `representantes`
  MODIFY `id_representante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `roles`
--
ALTER TABLE `roles`
  MODIFY `id_rol` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `ventas`
--
ALTER TABLE `ventas`
  MODIFY `id_venta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `boletas`
--
ALTER TABLE `boletas`
  ADD CONSTRAINT `boletas_ibfk_1` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id_venta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_productos_pedidos_almacen`
--
ALTER TABLE `detalle_productos_pedidos_almacen`
  ADD CONSTRAINT `detalle_productos_pedidos_almacen_ibfk_1` FOREIGN KEY (`id_pedido_almacen`) REFERENCES `pedidos_almacen` (`id_pedido_almacen`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `detalle_productos_pedidos_almacen_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `facturas`
--
ALTER TABLE `facturas`
  ADD CONSTRAINT `facturas_ibfk_1` FOREIGN KEY (`id_venta`) REFERENCES `ventas` (`id_venta`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `pedidos_almacen`
--
ALTER TABLE `pedidos_almacen`
  ADD CONSTRAINT `pedidos_almacen_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `pedidos_almacen_ibfk_2` FOREIGN KEY (`id_usuario_aprobacion`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `pedidos_almacen_ibfk_3` FOREIGN KEY (`id_usuario_pedido`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `productos_ibfk_1` FOREIGN KEY (`id_marca`) REFERENCES `marcas` (`id_marca`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `productos_proformados`
--
ALTER TABLE `productos_proformados`
  ADD CONSTRAINT `productos_proformados_ibfk_1` FOREIGN KEY (`id_producto`) REFERENCES `productos` (`id_producto`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `productos_proformados_ibfk_2` FOREIGN KEY (`id_proforma`) REFERENCES `proformas` (`id_proforma`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `proformas`
--
ALTER TABLE `proformas`
  ADD CONSTRAINT `proformas_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `representantes`
--
ALTER TABLE `representantes`
  ADD CONSTRAINT `representantes_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedores` (`id_proveedor`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `roles_privilegios`
--
ALTER TABLE `roles_privilegios`
  ADD CONSTRAINT `roles_privilegios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `roles_privilegios_ibfk_2` FOREIGN KEY (`id_privilegio`) REFERENCES `privilegios` (`id_privilegio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_rol`) REFERENCES `roles` (`id_rol`) ON DELETE NO ACTION ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuarios_privilegios`
--
ALTER TABLE `usuarios_privilegios`
  ADD CONSTRAINT `usuarios_privilegios_ibfk_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `usuarios_privilegios_ibfk_2` FOREIGN KEY (`id_privilegio`) REFERENCES `privilegios` (`id_privilegio`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `ventas`
--
ALTER TABLE `ventas`
  ADD CONSTRAINT `ventas_ibfk_1` FOREIGN KEY (`id_proforma`) REFERENCES `proformas` (`id_proforma`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ventas_ibfk_2` FOREIGN KEY (`id_usuario_venta`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE CASCADE,
  ADD CONSTRAINT `ventas_ibfk_3` FOREIGN KEY (`id_usuario_despacho`) REFERENCES `usuarios` (`id_usuario`) ON DELETE NO ACTION ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
