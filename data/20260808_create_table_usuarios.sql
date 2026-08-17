CREATE TABLE `usuarios` (
  `Id` int(11) NOT NULL,
  `Usuario` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Contrasenna` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Nombre` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

INSERT INTO `usuarios` (`Id`, `Usuario`, `Contrasenna`, `Nombre`) VALUES
(1, 'master', '8a0c8bb69f83f924718f8c9ff5d1b0c5', 'Master');

ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`Id`);

ALTER TABLE `usuarios`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;