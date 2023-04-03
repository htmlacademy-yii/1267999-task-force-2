DROP DATABASE IF EXISTS `TaskForce`;
SET @OLD_UNIQUE_CHECKS = @@UNIQUE_CHECKS, UNIQUE_CHECKS = 0;
SET @OLD_FOREIGN_KEY_CHECKS = @@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS = 0;
SET @OLD_SQL_MODE = @@SQL_MODE, SQL_MODE =
  'ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';
set global sql_mode="NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION";
-- -----------------------------------------------------
-- Schema TaskForce
-- -----------------------------------------------------

-- -----------------------------------------------------
-- Schema TaskForce
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `TaskForce` DEFAULT CHARACTER SET utf8;
USE `TaskForce`;

-- -----------------------------------------------------
-- Table `TaskForce`.`cities`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `cities`
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
-- Table `TaskForce`.`users`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `users`
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
  INDEX `fk_users_cities1_idx` (`city_id` ASC),
  INDEX `fk_users_files1_idx` (`avatar_file_id` ASC),
  CONSTRAINT `fk_users_cities1`
    FOREIGN KEY (`city_id`)
      REFERENCES `TaskForce`.`cities` (`id`)
      ON DELETE NO ACTION
      ON UPDATE CASCADE,
  CONSTRAINT `fk_users_files1`
    FOREIGN KEY (`avatar_file_id`)
      REFERENCES `TaskForce`.`files` (`id`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
)
  ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `TaskForce`.`categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `categories`
(
  `id`   INT          NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(128) NOT NULL,
  `code` VARCHAR(128) NOT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `TaskForce`.`tasks`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `tasks`
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
  `file_id`    INT          NOT NULL,
  `created_at`  DATETIME     NOT NULL,
  `address`      VARCHAR(128) NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_tasks_categories1_idx` (`category_id` ASC),
  INDEX `fk_tasks_cities1_idx` (`city_id` ASC),
  INDEX `fk_tasks_files1_idx` (`file_id` ASC),
  INDEX `fk_tasks_users1_idx` (`user_id` ASC),
  CONSTRAINT `fk_tasks_categories1`
    FOREIGN KEY (`category_id`)
      REFERENCES `TaskForce`.`categories` (`id`)
      ON DELETE NO ACTION
      ON UPDATE CASCADE,
  CONSTRAINT `fk_tasks_cities1`
    FOREIGN KEY (`city_id`)
      REFERENCES `TaskForce`.`cities` (`id`)
      ON DELETE NO ACTION
      ON UPDATE CASCADE,
  CONSTRAINT `fk_tasks_files1`
    FOREIGN KEY (`file_id`)
      REFERENCES `TaskForce`.`files` (`id`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  CONSTRAINT `fk_tasks_users1`
    FOREIGN KEY (`user_id`)
      REFERENCES `TaskForce`.`users` (`id`)
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
  INDEX `fk_reviews_tasks1_idx` (`task_id` ASC),
  INDEX `fk_reviews_users1_idx` (`customer_id` ASC),
  CONSTRAINT `fk_reviews_tasks1`
    FOREIGN KEY (`task_id`)
      REFERENCES `TaskForce`.`tasks` (`id`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION,
  CONSTRAINT `fk_reviews_users1`
    FOREIGN KEY (`customer_id`)
      REFERENCES `TaskForce`.`users` (`id`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
)
  ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `TaskForce`.`users_categories`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `users_categories`
(
  `id`          INT NOT NULL AUTO_INCREMENT,
  `user_id`     INT NOT NULL,
  `category_id` INT NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_users_categories_users1_idx` (`user_id` ASC),
  INDEX `fk_users_categories_categories1_idx` (`category_id` ASC),
#   CONSTRAINT `fk_users_categories_users1`
#     FOREIGN KEY (`user_id`)
#       REFERENCES `TaskForce`.`users` (`id`)
#       ON DELETE NO ACTION
#       ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_categories_categories1`
    FOREIGN KEY (`category_id`)
      REFERENCES `TaskForce`.`categories` (`id`)
      ON DELETE NO ACTION
      ON UPDATE NO ACTION
)
  ENGINE = InnoDB;

-- -----------------------------------------------------
-- Table `TaskForce`.`migration`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `migration`
(
    `id`   INT          NOT NULL AUTO_INCREMENT,
    `version` VARCHAR(128) NOT NULL,
    `apply_time` INT NOT NULL,
    PRIMARY KEY (`id`)
    )
    ENGINE = InnoDB;

SET SQL_MODE = @OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS = @OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS = @OLD_UNIQUE_CHECKS;
