CREATE TABLE `sucursales` (
	`Id` INT NOT NULL AUTO_INCREMENT,
	`NumSucursal` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
	`Nombre` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
	`Direccion` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
	`Telefono` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
	`CorreoE` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
	`Responsable` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
	PRIMARY KEY (`Id`)
)
COLLATE='utf8mb4_0900_ai_ci'
;