SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL';

CREATE SCHEMA IF NOT EXISTS `galery` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `galery` ;

-- -----------------------------------------------------
-- Table `galery`.`tbl_users`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `galery`.`tbl_users` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `login` VARCHAR(45) NULL ,
  `pass` VARCHAR(45) NULL ,
  `email` VARCHAR(45) NULL ,
  PRIMARY KEY (`id`) )
ENGINE = MyISAM
DEFAULT CHARACTER SET = utf8
COLLATE = utf8_general_ci;


-- -----------------------------------------------------
-- Table `galery`.`tbl_albums`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `galery`.`tbl_albums` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `user_id` INT NULL ,
  `title` VARCHAR(255) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_tbl_albums_tbl_users` (`user_id` ASC) )
ENGINE = MyISAM;


-- -----------------------------------------------------
-- Table `galery`.`tbl_images`
-- -----------------------------------------------------
CREATE  TABLE IF NOT EXISTS `galery`.`tbl_images` (
  `id` INT NOT NULL AUTO_INCREMENT ,
  `album_id` INT NULL ,
  `title` VARCHAR(90) NULL ,
  `filename` VARCHAR(255) NULL ,
  PRIMARY KEY (`id`) ,
  INDEX `fk_tbl_images_tbl_albums1` (`album_id` ASC) )
ENGINE = MyISAM;



SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
