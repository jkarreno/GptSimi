CREATE TABLE `cat_estados` (
  `Id` int(11) NOT NULL,
  `Estado` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE utf8mb4_unicode_ci;

INSERT INTO `cat_estados` (`Id`, `Estado`) VALUES
(1, 'Ciudad de México'),
(2, 'Estado de México'),
(3, 'Aguascalientes'),
(4, 'Baja California'),
(5, 'Baja California Sur'),
(6, 'Campeche'),
(7, 'Chiapas'),
(8, 'Chihuahua'),
(9, 'Coahuila de Zaragoza'),
(10, 'Colima'),
(11, 'Durango'),
(12, 'Guanajuato'),
(13, 'Guerrero'),
(14, 'Hidalgo'),
(15, 'Jalisco'),
(16, 'Morelos'),
(17, 'Michoacan'),
(18, 'Nayarit'),
(19, 'Nuevo Leon'),
(20, 'Oaxaca'),
(21, 'Puebla'),
(22, 'Queretaro'),
(23, 'Quintana Roo'),
(24, 'San Luis Potosi'),
(25, 'Sinaloa');

ALTER TABLE `cat_estados`
  ADD PRIMARY KEY (`Id`);
  
ALTER TABLE `cat_estados`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;