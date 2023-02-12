DROP DATABASE IF EXISTS `TaskForce`;
SET @OLD_UNIQUE_CHECKS = @@UNIQUE_CHECKS, UNIQUE_CHECKS = 0;
SET @OLD_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS = 0;
SET @OLD_SQL_MODE = @@SQL_MODE, SQL_MODE =
  'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema TaskForce
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema TaskForce
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `TaskForce` DEFAULT CHARACTER SET utf8;
USE `TaskForce`;

-- -----------------------------------------------------
-- Table `TaskForce`.`city`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `city`
(
  `id`          INT          NOT NULL AUTO_INCREMENT,
  `name`        VARCHAR(128) NOT NULL,
  `code`        VARCHAR(128) NOT NULL,
  `coordinates` POINT        NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `TaskForce`.`files`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `files`
(
  `id`   INT          NOT NULL AUTO_INCREMENT,
  `path` VARCHAR(128) NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `TaskForce`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `user`
(
  `id`             INT           NOT NULL AUTO_INCREMENT,
  `city_id`        INT           NOT NULL,
  `name`           VARCHAR(128)  NOT NULL,
  `email`          VARCHAR(128)  NOT NULL,
  `password`       CHAR(64)      NOT NULL,
  `rating`         DECIMAL(1, 0) NULL,
  `created_at`     DATETIME      NOT NULL,
  `role`           TINYINT       NULL,
  `birthday`       DATE          NULL,
  `phone`          VARCHAR(64)   NULL,
  `telegram`       VARCHAR(128)  NULL,
  `information`    VARCHAR(1024) NULL,
  `avatar_file_id` INT           NULL,
  `done_orders`    INT           NULL,
  `failed_orders`  INT           NULL,
  `place_rank`     INT           NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_user_city1_idx` (`city_id` ASC),
  INDEX `fk_user_files1_idx` (`avatar_file_id` ASC),
  CONSTRAINT `fk_user_city1`
    FOREIGN KEY (`city_id`)
      REFERENCES `TaskForce`.`city` (`id`)
      ON DELETE NO ACTION
      ON UPDATE CASCADE,
  CONSTRAINT `fk_user_files1`
    FOREIGN KEY (`avatar_file_id`)
      REFERENCES `TaskForce`.`files` (`id`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
)
  ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `TaskForce`.`category`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `category`
(
  `id`   INT          NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(128) NOT NULL,
  `code` VARCHAR(128) NOT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `TaskForce`.`task`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `task`
(
  `id`          INT          NOT NULL AUTO_INCREMENT,
  `category_id` INT          NOT NULL,
  `user_id`     INT          NOT NULL,
  `city_id`     INT          NULL,
  `coordinates` POINT        NULL,
  `status`      TINYINT      NOT NULL,
  `name`        VARCHAR(128) NOT NULL,
  `details`     VARCHAR(512) NOT NULL,
  `budget`      INT          NULL,
  `deadline`    DATE         NOT NULL,
  `files_id`    INT          NOT NULL,
  `created_at`  DATETIME     NOT NULL,
  `adress`      VARCHAR(128) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_task_category1_idx` (`category_id` ASC),
  INDEX `fk_task_city1_idx` (`city_id` ASC),
  INDEX `fk_task_files1_idx` (`files_id` ASC),
  INDEX `fk_task_user1_idx` (`user_id` ASC),
  CONSTRAINT `fk_task_category1`
    FOREIGN KEY (`category_id`)
      REFERENCES `TaskForce`.`category` (`id`)
      ON DELETE NO ACTION
      ON UPDATE CASCADE,
  CONSTRAINT `fk_task_city1`
    FOREIGN KEY (`city_id`)
      REFERENCES `TaskForce`.`city` (`id`)
      ON DELETE NO ACTION
      ON UPDATE CASCADE,
  CONSTRAINT `fk_task_files1`
    FOREIGN KEY (`files_id`)
      REFERENCES `TaskForce`.`files` (`id`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  CONSTRAINT `fk_task_user1`
    FOREIGN KEY (`user_id`)
      REFERENCES `TaskForce`.`user` (`id`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
)
  ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `TaskForce`.`reviews`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `reviews`
(
  `id`          INT          NOT NULL AUTO_INCREMENT,
  `task_id`     INT          NOT NULL,
  `customer_id` INT          NOT NULL,
  `created_at`  DATETIME     NOT NULL,
  `executor_id` INT          NOT NULL,
  `rating`      TINYINT      NOT NULL,
  `comment`     VARCHAR(512) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_reviews_task1_idx` (`task_id` ASC),
  INDEX `fk_reviews_user1_idx` (`customer_id` ASC),
  CONSTRAINT `fk_reviews_task1`
    FOREIGN KEY (`task_id`)
      REFERENCES `TaskForce`.`task` (`id`)
      ON DELETE NO ACTION
      ON UPDATE CASCADE,
  CONSTRAINT `fk_reviews_user1`
    FOREIGN KEY (`customer_id`)
      REFERENCES `TaskForce`.`user` (`id`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
)
  ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `TaskForce`.`user_category`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `user_category`
(
  `id`          INT NOT NULL,
  `user_id`     INT NOT NULL,
  `category_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_user_category_user1_idx` (`user_id` ASC),
  INDEX `fk_user_category_category1_idx` (`category_id` ASC),
  CONSTRAINT `fk_user_category_user1`
    FOREIGN KEY (`user_id`)
      REFERENCES `TaskForce`.`user` (`id`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  CONSTRAINT `fk_user_category_category1`
    FOREIGN KEY (`category_id`)
      REFERENCES `TaskForce`.`category` (`id`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
)
  ENGINE = InnoDB;


SET SQL_MODE = @OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS = @OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS = @OLD_UNIQUE_CHECKS;
