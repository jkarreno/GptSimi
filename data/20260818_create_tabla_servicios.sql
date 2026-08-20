CREATE TABLE `servicios` (
	`Id` INT NOT NULL AUTO_INCREMENT,
	`Sucursal` INT NULL DEFAULT NULL,
	`FechaAsignacion` INT NULL DEFAULT NULL,
	`SemanaAtencion` INT NULL DEFAULT NULL,
	`FechaAtencion` INT NULL DEFAULT NULL,
	`Estatus` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
	`TecnicoAsignado` INT NULL DEFAULT NULL,
	`Observaciones` LONGTEXT NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
	PRIMARY KEY (`Id`)
)
COLLATE='utf8mb4_0900_ai_ci'
;