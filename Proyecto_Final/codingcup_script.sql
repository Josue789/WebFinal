-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema codingcup
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema codingcup
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `codingcup` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci ;
USE `codingcup` ;

-- -----------------------------------------------------
-- Table `codingcup`.`coach`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `codingcup`.`coach` (
  `id_Coach` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `correo` VARCHAR(100) NOT NULL,
  `contrasenia` VARCHAR(256) NOT NULL,
  `institucion` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id_Coach`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `codingcup`.`concurso`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `codingcup`.`concurso` (
  `id_Concurso` INT NOT NULL AUTO_INCREMENT,
  `fechaInicio` DATE NOT NULL,
  `fechaFin` DATE NOT NULL,
  `nombreConcurso` VARCHAR(255) NOT NULL,
  `descripcion` TEXT NOT NULL,
  `estatus` TINYINT(1) NOT NULL,
  PRIMARY KEY (`id_Concurso`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `codingcup`.`usuario`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `codingcup`.`usuario` (
  `id_Usuario` INT NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `institucion` VARCHAR(100) NULL DEFAULT 'ITSUR',
  `usuario` VARCHAR(100) NOT NULL,
  `contrasenia` VARCHAR(256) NOT NULL,
  `tipo` ENUM('Admin', 'Auxiliar', 'Coach') NOT NULL,
  PRIMARY KEY (`id_Usuario`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


-- -----------------------------------------------------
-- Table `codingcup`.`equipo`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `codingcup`.`equipo` (
  `id_Equipo` INT NOT NULL AUTO_INCREMENT,
  `nombreEquipo` VARCHAR(50) NOT NULL,
  `estudiante1` VARCHAR(100) NOT NULL,
  `estudiante2` VARCHAR(100) NOT NULL,
  `estudiante3` VARCHAR(100) NOT NULL,
  `concurso` INT NOT NULL,
  `foto` BLOB NULL DEFAULT NULL,
  `coach` INT NOT NULL,
  `estatus` TINYINT(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_Equipo`),
  UNIQUE INDEX `nombreEquipo` (`nombreEquipo` ASC) VISIBLE,
  INDEX `coach` (`coach` ASC) VISIBLE,
  INDEX `concurso` (`concurso` ASC) VISIBLE,
  CONSTRAINT `equipo_ibfk_1`
    FOREIGN KEY (`coach`)
    REFERENCES `codingcup`.`usuario` (`id_Usuario`)
    ON DELETE CASCADE,
  CONSTRAINT `equipo_ibfk_2`
    FOREIGN KEY (`concurso`)
    REFERENCES `codingcup`.`concurso` (`id_Concurso`)
    ON DELETE CASCADE)
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8mb4
COLLATE = utf8mb4_0900_ai_ci;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
