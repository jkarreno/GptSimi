CREATE TABLE `servicios_capturas` (
	`Id` INT NOT NULL AUTO_INCREMENT,
	`IdServicio` INT NULL DEFAULT NULL,
	`IdCaptura` INT NULL DEFAULT NULL,
	`Estatus` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
	`Comentarios` VARCHAR(250) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
	PRIMARY KEY (`Id`)
)
COLLATE='utf8mb4_0900_ai_ci'
;

ALTER TABLE `servicios_capturas`
	ADD COLUMN `IdTecnico` INT NULL AFTER `IdServicio`,
	ADD COLUMN `Archivo` VARCHAR(100) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci' AFTER `IdCaptura`;

ALTER TABLE `servicios_capturas`
	ADD COLUMN `Fecha` INT NULL DEFAULT NULL AFTER `Id`;