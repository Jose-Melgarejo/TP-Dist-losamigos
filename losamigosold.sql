-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema losamigos
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema losamigos
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `losamigos` DEFAULT CHARACTER SET utf8 ;
USE `losamigos` ;

-- -----------------------------------------------------
-- Table `losamigos`.`socio`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `losamigos`.`socio` (
  `id` INT NOT NULL UNIQUE AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `apellido` VARCHAR(45) NOT NULL,
  `direccion` VARCHAR(45),
  `telefono` VARCHAR(45),
  `mail` VARCHAR(90) NOT NULL UNIQUE,
  `clave` VARCHAR(255) NOT NULL,
  `fecha_registro` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`))
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `losamigos`.`filial`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `losamigos`.`filial` (
  `id` INT NOT NULL UNIQUE AUTO_INCREMENT,
  `direccion` VARCHAR(45) NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `dia_mantenimiento` INT NOT NULL,
  `hora_inicio` TIME NOT NULL,
  `hora_fin` TIME NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `losamigos`.`cancha`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `losamigos`.`cancha` (
  `id` INT NOT NULL UNIQUE AUTO_INCREMENT,
  `deporte` VARCHAR(45) NOT NULL,
  `tipo` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `losamigos`.`filial_cancha`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `losamigos`.`filial_cancha` (
  `id` INT NOT NULL UNIQUE AUTO_INCREMENT,
  `filial_id` INT NOT NULL,
  `cancha_id` INT NOT NULL,
  `numero` INT NOT NULL,
  INDEX `fk_filial_has_cancha_cancha1_idx` (`cancha_id` ASC),
  INDEX `fk_filial_has_cancha_filial1_idx` (`filial_id` ASC),
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_filial_has_cancha_filial1`
    FOREIGN KEY (`filial_id`)
    REFERENCES `losamigos`.`filial` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_filial_has_cancha_cancha1`
    FOREIGN KEY (`cancha_id`)
    REFERENCES `losamigos`.`cancha` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `losamigos`.`turno`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `losamigos`.`turno` (
  `id` INT NOT NULL UNIQUE AUTO_INCREMENT,
  `socio_id` INT NOT NULL,
  `filial_cancha_id` INT NOT NULL,
  `fecha_inicio` DATETIME NOT NULL,
  `fecha_fin` DATETIME NOT NULL,
  `estado` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_turno_socio_idx` (`socio_id` ASC),
  INDEX `fk_turno_filial_cancha1_idx` (`filial_cancha_id` ASC),
  CONSTRAINT `fk_turno_socio`
    FOREIGN KEY (`socio_id`)
    REFERENCES `losamigos`.`socio` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_turno_filial_cancha1`
    FOREIGN KEY (`filial_cancha_id`)
    REFERENCES `losamigos`.`filial_cancha` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = MyISAM;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `TraerFiliales`()
BEGIN
    SELECT * FROM filial;
    END$$
DELIMITER ;
