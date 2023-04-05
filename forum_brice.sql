-- --------------------------------------------------------
-- Hôte :                        127.0.0.1
-- Version du serveur:           5.7.24 - MySQL Community Server (GPL)
-- SE du serveur:                Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Listage de la structure de la base pour forum_brice
CREATE DATABASE IF NOT EXISTS `forum_brice` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_bin */;
USE `forum_brice`;

-- Listage de la structure de la table forum_brice. categorie
CREATE TABLE IF NOT EXISTS `categorie` (
  `id_categorie` int(11) NOT NULL AUTO_INCREMENT,
  `nomCategorie` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_categorie`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Listage des données de la table forum_brice.categorie : ~5 rows (environ)
/*!40000 ALTER TABLE `categorie` DISABLE KEYS */;
INSERT INTO `categorie` (`id_categorie`, `nomCategorie`) VALUES
	(1, 'Jeux Vidéo'),
	(2, 'Film'),
	(3, 'Meme'),
	(4, 'L\'espace'),
	(5, 'Test');
/*!40000 ALTER TABLE `categorie` ENABLE KEYS */;

-- Listage de la structure de la table forum_brice. post
CREATE TABLE IF NOT EXISTS `post` (
  `id_post` int(11) NOT NULL AUTO_INCREMENT,
  `datePost` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `message` text COLLATE utf8_bin NOT NULL,
  `user_id` int(11) NOT NULL,
  `topic_id` int(11) NOT NULL,
  PRIMARY KEY (`id_post`),
  KEY `user_id` (`user_id`),
  KEY `topic_id` (`topic_id`),
  CONSTRAINT `FK_post_topic` FOREIGN KEY (`topic_id`) REFERENCES `topic` (`id_topic`),
  CONSTRAINT `FK_post_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Listage des données de la table forum_brice.post : ~19 rows (environ)
/*!40000 ALTER TABLE `post` DISABLE KEYS */;
INSERT INTO `post` (`id_post`, `datePost`, `message`, `user_id`, `topic_id`) VALUES
	(1, '2023-02-14 17:04:23', 'Tes pas devenu un panda roux ???', 7, 2),
	(2, '2023-02-03 14:50:42', 'It\'s not like WTF But It\'s WTF', 7, 3),
	(3, '2023-03-29 16:22:31', 'formulaire', 8, 4),
	(4, '2023-03-29 16:27:16', 'Une fois que ta compris ça se fait (j\'ai ptet pas fais comme il fallait)', 9, 4),
	(5, '2023-03-11 13:12:50', 'Un nouvel univers s\'ouvre a moi', 7, 1),
	(6, '2023-02-23 21:42:02', 'Postal 2 Kappa , plus serrieusement les Dead Space , RE7 et 8 sont sympa dans leur genre et d\'autre jeux si t\'es un peu retro', 9, 6),
	(7, '2023-02-03 15:00:42', 'je vais te goomer', 9, 3),
	(8, '2023-02-14 18:14:00', 'Non ça va ça va ,sa c\'est bien passer', 8, 2),
	(9, '2023-02-14 19:42:42', 'Elle dit ça mais en vrai elle a coté de la face plein de bleu et de bosse et l\'autre on dirait qui a bulldozer qui lui est passé dessus', 9, 2),
	(10, '2023-04-03 10:07:40', 'message 1', 5, 5),
	(11, '2023-04-03 10:08:15', 'message 2', 5, 5),
	(12, '2023-04-03 10:19:36', 'message 3', 5, 5),
	(13, '2023-04-03 10:19:49', 'message 4', 5, 5),
	(14, '2023-04-04 16:14:53', 'essaie de message via user en session', 9, 15),
	(15, '2023-04-04 16:19:48', 'un autre message pour le rendu', 9, 15),
	(16, '2023-04-04 19:27:09', 'ouai moi aussi j&#039;aime bien', 10, 5),
	(17, '2023-04-04 19:27:47', 'De quoi vous parler ?', 10, 2),
	(18, '2023-04-04 19:57:29', 't&#039;entend &ccedil;a !\r\n', 9, 3);
/*!40000 ALTER TABLE `post` ENABLE KEYS */;

-- Listage de la structure de la table forum_brice. topic
CREATE TABLE IF NOT EXISTS `topic` (
  `id_topic` int(11) NOT NULL AUTO_INCREMENT,
  `nomTopic` varchar(50) COLLATE utf8_bin NOT NULL,
  `resumer` text COLLATE utf8_bin NOT NULL,
  `dateCreation` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `verouiller` tinyint(4) NOT NULL DEFAULT '0',
  `categorie_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  PRIMARY KEY (`id_topic`),
  KEY `categorie_id` (`categorie_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `FK_topic_categorie` FOREIGN KEY (`categorie_id`) REFERENCES `categorie` (`id_categorie`),
  CONSTRAINT `FK_topic_user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id_user`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Listage des données de la table forum_brice.topic : ~17 rows (environ)
/*!40000 ALTER TABLE `topic` DISABLE KEYS */;
INSERT INTO `topic` (`id_topic`, `nomTopic`, `resumer`, `dateCreation`, `verouiller`, `categorie_id`, `user_id`) VALUES
	(1, 'Hyundai Waaaagh !', 'Le lien de la vidéo : https://www.youtube.com/watch?v=mVgabZXmBtU', '2023-03-10 13:05:12', 1, 3, 9),
	(2, 'Terminator', 'Je vous raconte ?', '2023-02-14 12:00:00', 0, 2, 8),
	(3, 'Les IA', 'Vous savez ce que j\'en pensent', '2023-02-03 14:15:00', 0, 3, 7),
	(4, 'MVC Cinéma', 'C\'est comment ?', '2023-03-29 16:13:10', 0, 2, 7),
	(5, 'Fallout', 'Vous aimez ? moi j\'adore', '2023-02-07 14:09:46', 0, 1, 7),
	(6, 'Jeux Gore', 'Vous en aurez a me proposer ?', '2023-02-21 20:01:34', 0, 1, 8),
	(7, 'Sujet 1', 'Message test', '2023-04-03 11:50:57', 0, 5, 5),
	(8, 'Sujet 2', 'eg', '2023-04-03 11:52:44', 0, 5, 5),
	(9, 'Sujet 3', 'svg', '2023-04-03 11:53:03', 0, 5, 5),
	(10, 'Sujet 4', 'dfg', '2023-04-03 11:54:17', 0, 5, 5),
	(11, 'Sujet 5', 'zzzz', '2023-04-03 11:56:41', 0, 5, 5),
	(12, 'Sujet 6', '...', '2023-04-03 11:57:28', 0, 5, 5),
	(13, 'Sujet 7', 'probleme r&eacute;gler ?', '2023-04-03 11:58:26', 0, 5, 5),
	(14, 'Un autre Test', 'test', '2023-04-04 16:13:19', 0, 5, 9),
	(15, 'Test n&deg;2', 'test encore via le formulaire de categorie test', '2023-04-04 16:14:34', 0, 5, 9),
	(16, 'Taxis A Stras', 'Trop chiant c&#039;est toujours bouch&eacute; !', '2023-04-04 19:25:58', 0, 3, 10),
	(17, 'moi aussi je fais des test', 'mais beaucoup plus sur sql', '2023-04-04 19:30:22', 0, 5, 10);
/*!40000 ALTER TABLE `topic` ENABLE KEYS */;

-- Listage de la structure de la table forum_brice. user
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(255) COLLATE utf8_bin NOT NULL,
  `role` varchar(50) COLLATE utf8_bin NOT NULL DEFAULT 'ROLE_USER',
  `pseudo` varchar(50) COLLATE utf8_bin NOT NULL,
  `email` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`id_user`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- Listage des données de la table forum_brice.user : ~10 rows (environ)
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id_user`, `password`, `role`, `pseudo`, `email`) VALUES
	(1, 'JeSuisIngenieurInformaticien!', 'ROLE_USER', 'MoiMaid1', '1mohamed@informaticien.fr'),
	(2, 'It\'sNotLikeWTFButIt\'sWTF', 'ROLE_USER', 'DoigtNez2', '2duanee@terminator.com'),
	(3, 'MechaReptile', 'ROLE_USER', 'BrieSSSS3', '3brice@raptorjesus.ru'),
	(4, 'UtilisateurVide', 'ROLE_USER', 'La', 'la@la.la'),
	(5, 'mdp', 'ROLE_USER', 'tester', 'test@test.test'),
	(6, '$2y$10$.fTzLphq3hsXAFg4.2mgXudG2Mzrd2q.VB1y/gsSdrea0nmoi4WPi', 'ROLE_USER', 'ayaya', 'ayaya@jvc.com'),
	(7, '$2y$10$iIxQpo7eYtt0FgfD35RwoeQGGoqcAo1wl1w7CESulsUCtWOseKrHq', 'ROLE_USER', 'MoiMaid', 'mohamed@informaticien.fr'),
	(8, '$2y$10$WRisT0ZW2VeronY9s5thnuq59LmslCcYiXklFvuHxoAP8GQilNy9C', 'ROLE_USER', 'DoigtNez', 'duanee@terminator.com'),
	(9, '$2y$10$VylP.WxROTT78cvk4azIc.RG/bCvSglk5RD4Z7CH1ltTeKOBwr70q', 'ROLE_USER', 'BrieSSSS', 'brice@raptorjesus.ru'),
	(10, '$2y$10$PcqR2hDktQf3LWiLYlSqK.rQMwkMNDX.wzusZiGidTJobVsIh9o2G', 'ROLE_USER', 'vanthonyne', 'anthony@marseille.fr');
/*!40000 ALTER TABLE `user` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
