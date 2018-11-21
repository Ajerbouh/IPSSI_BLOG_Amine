SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP TABLE IF EXISTS `articles`;
CREATE TABLE `articles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `image` varchar(255) NOT NULL,
  `author` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `author` (`author`),
  CONSTRAINT `articles_ibfk_1` FOREIGN KEY (`author`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `articles` (`id`, `title`, `content`, `image`, `author`) VALUES
(11,	'kda Ahri',	'Setting her old bubblegum pop persona aside, Ahri was determined to shake up her image and reinvent herself as an unstoppable force within the music industry. Five years later, she has returned with a sleek new look and a killer sound&mdash;and this time she\'s not alone.',	'5bf589e507166-Ahri.Ahri_z_KDA.portret.jpg',	3),
(12,	'KDA Evelynn',	'No one is as deliciously volatile as Evelynn. She\'s a diva who drives divisiveness in the media&mdash;they love her one day and hate her the next, her name a permanent fixture of tabloid headlines. She is a born superstar, and the foundation of K/DA\'s sound.',	'5bf58a5fcfed6-KDA_Evelynn_profileicon.png',	3),
(13,	'Kda Akali',	'Akali\'s street aesthetic and hard-hitting lyrics inspired a dedicated fandom. She wields a microphone or kama as a hip-hop ninja, revolutionizing the stale scene with her raw talents.',	'5bf58b8d74729-KDA_Akali_profileicon.png',	3),
(14,	'KDA Kaisa',	'A talent from abroad, Kai\'Sa brings a unique style and sound to the industry. She learned to express herself through her craft, blossoming into one of the most talented dancers in the world&mdash;a perfect fit for the misfits of K/DA, where she takes their performances to the next level.',	'5bf58be81fe40-3797.jpg',	3);

DROP TABLE IF EXISTS `comments`;
CREATE TABLE `comments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8 NOT NULL,
  `content` longtext CHARACTER SET utf8 NOT NULL,
  `article` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `article` (`article`),
  CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`article`) REFERENCES `articles` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `comments` (`id`, `username`, `content`, `article`) VALUES
(12,	'amine',	'Wow such a beauty !!',	11);

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_ibfk_1` (`id`,`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `users` (`id`, `username`, `password`) VALUES
(3,	'amine',	'$2y$12$Y1wLaZjN6ZXdEwGuNi9uAO/RRoVHp4KGPZ5G7XZ1BWrJ7BncoMiOm');
