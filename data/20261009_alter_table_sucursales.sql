ALTER TABLE `sucursales`
	ADD COLUMN `Zona` VARCHAR(10) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci' AFTER `NumSucursal`;

ALTER TABLE `sucursales`
	ADD COLUMN `Activo` INT NULL DEFAULT '1' AFTER `Responsable`;