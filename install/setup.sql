-- TaskStep setup script

SELECT '===== TASKSTEP SETUP =====' AS '';

-- disable constraint checks during setup

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';


-- taskstep definition

CREATE SCHEMA IF NOT EXISTS `taskstep` DEFAULT CHARACTER SET utf8 ;
USE `taskstep` ;


-- taskstep.sections definition

CREATE TABLE IF NOT EXISTS `sections` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_2` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


-- taskstep.`style` definition

CREATE TABLE IF NOT EXISTS `style` (
  `idStyle` int NOT NULL AUTO_INCREMENT,
  `style` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idStyle`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


-- taskstep.`User` definition

CREATE TABLE IF NOT EXISTS `User` (
  `idUser` int NOT NULL AUTO_INCREMENT,
  `login` varchar(45) DEFAULT NULL,
  `MDP` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `salt` varchar(45) DEFAULT NULL,
  `mail` varchar(60) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `style` int NOT NULL,
  `tips` tinyint DEFAULT NULL,
  PRIMARY KEY (`idUser`),
  KEY `fk_User_Style_idx` (`style`),
  CONSTRAINT `fk_User_Style` FOREIGN KEY (`style`) REFERENCES `style` (`idStyle`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


-- taskstep.contexts definition

CREATE TABLE IF NOT EXISTS `contexts` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `User` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_2` (`id`),
  KEY `fk_contexts_User1_idx` (`User`),
  CONSTRAINT `fk_contexts_User1` FOREIGN KEY (`User`) REFERENCES `User` (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


-- taskstep.projects definition

CREATE TABLE IF NOT EXISTS `projects` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `User` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_2` (`id`),
  KEY `fk_projects_User1_idx` (`User`),
  CONSTRAINT `fk_projects_User1` FOREIGN KEY (`User`) REFERENCES `User` (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


-- taskstep.`Session` definition

CREATE TABLE IF NOT EXISTS `Session` (
  `Token` char(20) NOT NULL,
  `date` datetime DEFAULT NULL,
  `User` int NOT NULL,
  PRIMARY KEY (`Token`),
  KEY `fk_Session_User1_idx` (`User`),
  CONSTRAINT `fk_Session_User1` FOREIGN KEY (`User`) REFERENCES `User` (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;


-- taskstep.items definition

CREATE TABLE IF NOT EXISTS `items` (
  `id` int NOT NULL AUTO_INCREMENT,
  `title` text NOT NULL,
  `date` date DEFAULT NULL,
  `notes` text NOT NULL,
  `url` text NOT NULL,
  `done` tinyint(1) NOT NULL DEFAULT '0',
  `context` int NOT NULL,
  `section` int NOT NULL,
  `project` int NOT NULL,
  `User` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_2` (`id`),
  KEY `fk_items_contexts_idx` (`context`),
  KEY `fk_items_sections1_idx` (`section`),
  KEY `fk_items_projects1_idx` (`project`),
  KEY `fk_items_User2_idx` (`User`),
  CONSTRAINT `fk_items_contexts` FOREIGN KEY (`context`) REFERENCES `contexts` (`id`),
  CONSTRAINT `fk_items_projects1` FOREIGN KEY (`project`) REFERENCES `projects` (`id`),
  CONSTRAINT `fk_items_sections1` FOREIGN KEY (`section`) REFERENCES `sections` (`id`),
  CONSTRAINT `fk_items_User2` FOREIGN KEY (`User`) REFERENCES `User` (`idUser`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- populate enumeration tables

INSERT INTO taskstep.`style` (`style`) VALUES
  ('classic'),
  ('dark'),
  ('professional');

INSERT INTO taskstep.sections (title) VALUES
  ('ideas'),
  ('tobuy'),
  ('immediate'),
  ('week'),
  ('month'),
  ('year'),
  ('lifetime');


-- re-enable constraint checks after setup

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
