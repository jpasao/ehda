/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE DATABASE IF NOT EXISTS `dbehda` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;
USE `dbehda`;

CREATE TABLE IF NOT EXISTS `images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `filename` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `postimages` (
  `idpost` int(11) NOT NULL,
  `idimage` int(11) NOT NULL,
  PRIMARY KEY (`idpost`,`idimage`),
  KEY `IX_postimages_images` (`idimage`),
  KEY `IX_postimages_posts` (`idpost`),
  CONSTRAINT `FK_postimages_images` FOREIGN KEY (`idimage`) REFERENCES `images` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_postimages_posts` FOREIGN KEY (`idpost`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(250) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `slug` varchar(250) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `date` int(11) NOT NULL DEFAULT '0',
  `published` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `K_posts_slug` (`slug`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `posttags` (
  `idpost` int(11) NOT NULL,
  `idtag` int(11) NOT NULL,
  PRIMARY KEY (`idpost`,`idtag`),
  KEY `IX_posttags_posts_idx` (`idpost`),
  KEY `IX_posttags_tags` (`idtag`),
  CONSTRAINT `FK_posttags_posts` FOREIGN KEY (`idpost`) REFERENCES `posts` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_posttags_tags` FOREIGN KEY (`idtag`) REFERENCES `tags` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `imagesbypost` (
	`idpost` INT(11) NOT NULL,
	`idimage` INT(11) NOT NULL,
	`name` VARCHAR(50) NULL COLLATE 'utf8_unicode_ci',
	`filename` VARCHAR(250) NULL COLLATE 'utf8_unicode_ci'
) ENGINE=MyISAM;

CREATE TABLE `tagsbypost` (
	`idpost` INT(11) NOT NULL,
	`idtag` INT(11) NOT NULL,
	`name` VARCHAR(50) NOT NULL COLLATE 'utf8_unicode_ci'
) ENGINE=MyISAM;

DROP TABLE IF EXISTS `imagesbypost`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `imagesbypost` AS select `p`.`idpost` AS `idpost`,`p`.`idimage` AS `idimage`,`i`.`name` AS `name`,`i`.`filename` AS `filename` from (`postimages` `p` left join `images` `i` on((`p`.`idimage` = `i`.`id`))) order by `i`.`name`;

DROP TABLE IF EXISTS `tagsbypost`;
CREATE ALGORITHM=UNDEFINED SQL SECURITY DEFINER VIEW `tagsbypost` AS select `pt`.`idpost` AS `idpost`,`pt`.`idtag` AS `idtag`,`t`.`name` AS `name` from (`tags` `t` join `posttags` `pt` on((`t`.`id` = `pt`.`idtag`))) order by `t`.`name`;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;