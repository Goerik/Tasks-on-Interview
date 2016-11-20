-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `mydb` DEFAULT CHARACTER SET utf8 ;
USE `mydb` ;

-- -----------------------------------------------------
-- Table `mydb`.`categories`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`categories` ;

CREATE TABLE IF NOT EXISTS `mydb`.`categories` (
  `id` INT(11) NOT NULL,
  `title` VARCHAR(45) NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'Категории';


-- -----------------------------------------------------
-- Table `mydb`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`users` ;

CREATE TABLE IF NOT EXISTS `mydb`.`users` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8
COMMENT = 'Пользователи\n';


-- -----------------------------------------------------
-- Table `mydb`.`posts`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`posts` ;

CREATE TABLE IF NOT EXISTS `mydb`.`posts` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `text` VARCHAR(243) NOT NULL,
  `users_id` INT(11) NOT NULL,
  PRIMARY KEY (`id` DESC),
  INDEX `fk_posts_users_idx` (`users_id` ASC),
  CONSTRAINT `fk_posts_users`
    FOREIGN KEY (`users_id`)
    REFERENCES `mydb`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8
COMMENT = 'Посты (новости от пользователей)';


-- -----------------------------------------------------
-- Table `mydb`.`likes`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`likes` ;

CREATE TABLE IF NOT EXISTS `mydb`.`likes` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `posts_id` INT(11) NOT NULL,
  `users_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`, `posts_id`, `users_id`),
  INDEX `fk_likes_posts1_idx` (`posts_id` ASC),
  INDEX `fk_likes_users1_idx` (`users_id` ASC),
  CONSTRAINT `fk_likes_posts1`
    FOREIGN KEY (`posts_id`)
    REFERENCES `mydb`.`posts` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_likes_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `mydb`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8
COMMENT = 'Лайки\n';


-- -----------------------------------------------------
-- Table `mydb`.`post_categories`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `mydb`.`post_categories` ;

CREATE TABLE IF NOT EXISTS `mydb`.`post_categories` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `categories_id` INT(11) NOT NULL,
  `posts_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`, `categories_id`),
  INDEX `fk_post_categories_categories1_idx` (`categories_id` ASC),
  INDEX `fk_post_categories_posts1_idx` (`posts_id` ASC),
  CONSTRAINT `fk_post_categories_categories1`
    FOREIGN KEY (`categories_id`)
    REFERENCES `mydb`.`categories` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_post_categories_posts1`
    FOREIGN KEY (`posts_id`)
    REFERENCES `mydb`.`posts` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `mydb`.`categories`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`categories` (`id`, `title`) VALUES (1, 'News');
INSERT INTO `mydb`.`categories` (`id`, `title`) VALUES (2, 'Computers');
INSERT INTO `mydb`.`categories` (`id`, `title`) VALUES (3, 'Humour');

COMMIT;


-- -----------------------------------------------------
-- Data for table `mydb`.`users`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`users` (`id`, `name`) VALUES (1, 'First User');
INSERT INTO `mydb`.`users` (`id`, `name`) VALUES (2, 'Second User');
INSERT INTO `mydb`.`users` (`id`, `name`) VALUES (3, 'Third User');

COMMIT;


-- -----------------------------------------------------
-- Data for table `mydb`.`posts`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`posts` (`id`, `text`, `users_id`) VALUES (1, 'First post text', 1);
INSERT INTO `mydb`.`posts` (`id`, `text`, `users_id`) VALUES (2, 'Second post tetx', 1);
INSERT INTO `mydb`.`posts` (`id`, `text`, `users_id`) VALUES (3, 'Thirdpost tetx', 2);

COMMIT;


-- -----------------------------------------------------
-- Data for table `mydb`.`likes`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`likes` (`id`, `posts_id`, `users_id`) VALUES (1, 1, 1);
INSERT INTO `mydb`.`likes` (`id`, `posts_id`, `users_id`) VALUES (2, 2, 1);
INSERT INTO `mydb`.`likes` (`id`, `posts_id`, `users_id`) VALUES (3, 2, 2);

COMMIT;


-- -----------------------------------------------------
-- Data for table `mydb`.`post_categories`
-- -----------------------------------------------------
START TRANSACTION;
USE `mydb`;
INSERT INTO `mydb`.`post_categories` (`id`, `categories_id`, `posts_id`) VALUES (1, 1, 1);
INSERT INTO `mydb`.`post_categories` (`id`, `categories_id`, `posts_id`) VALUES (2, 2, 1);
INSERT INTO `mydb`.`post_categories` (`id`, `categories_id`, `posts_id`) VALUES (3, 3, 2);

COMMIT;

