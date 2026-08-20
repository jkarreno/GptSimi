CREATE TABLE `cat_estatus` (
	`Id` INT NOT NULL AUTO_INCREMENT,
	`Estatus` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
    `Color` VARCHAR(50) NULL DEFAULT NULL COLLATE 'utf8mb4_unicode_ci',
	PRIMARY KEY (`Id`)
)
COLLATE='utf8mb4_0900_ai_ci';

INSERT INTO `lamp`.`cat_estatus` (`Estatus`, `Color`) VALUES ('Por Asignar', 'yellow');
INSERT INTO `lamp`.`cat_estatus` (`Estatus`, `Color`) VALUES ('Asignado', 'blue');
INSERT INTO `lamp`.`cat_estatus` (`Estatus`, `Color`) VALUES ('Atendiendo', 'green');
INSERT INTO `lamp`.`cat_estatus` (`Estatus`, `Color`) VALUES ('Cerrado', 'gray');
INSERT INTO `lamp`.`cat_estatus` (`Estatus`, `Color`) VALUES ('No Atendido', 'red');
INSERT INTO `lamp`.`cat_estatus` (`Estatus`, `Color`) VALUES ('Cancelado', 'orange');
