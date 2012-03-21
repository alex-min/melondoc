-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Client: localhost
-- Généré le : Mer 21 Mars 2012 à 16:29
-- Version du serveur: 5.5.16
-- Version de PHP: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données: `melondoc`
--

-- --------------------------------------------------------

--
-- Structure de la table `forum_categorie`
--

CREATE TABLE IF NOT EXISTS `forum_categorie` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `order` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `forum_categorie`
--

INSERT INTO `forum_categorie` (`id`, `name`, `order`) VALUES
(1, 'test2', 2),
(10, 'test3', 3);

-- --------------------------------------------------------

--
-- Structure de la table `forum_config`
--

CREATE TABLE IF NOT EXISTS `forum_config` (
  `cle` text NOT NULL,
  `valeur` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `forum_config`
--

INSERT INTO `forum_config` (`cle`, `valeur`) VALUES
('right_post_admin', '3'),
('right_post_annonce', '2'),
('message_par_page', '20'),
('topic_par_page', '15'),
('right_admin', '3');

-- --------------------------------------------------------

--
-- Structure de la table `forum_forum`
--

CREATE TABLE IF NOT EXISTS `forum_forum` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_cat` int(11) NOT NULL,
  `right_create` int(11) NOT NULL,
  `right_view` int(11) NOT NULL,
  `right_annonce` int(11) NOT NULL,
  `moderators` text NOT NULL,
  `name` varchar(255) NOT NULL,
  `desc` text NOT NULL,
  `order` int(11) NOT NULL,
  `nb_reponses` int(11) NOT NULL,
  `last_post` int(11) NOT NULL,
  `nb_topics` int(11) NOT NULL,
  `right_post` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Contenu de la table `forum_forum`
--

INSERT INTO `forum_forum` (`id`, `id_cat`, `right_create`, `right_view`, `right_annonce`, `moderators`, `name`, `desc`, `order`, `nb_reponses`, `last_post`, `nb_topics`, `right_post`) VALUES
(4, 1, 1, 1, 1, '', 'last_test', 'test final', 1, 57, 74, 5, 1),
(5, 1, 1, 1, 1, 'a:2:{i:0;s:4:"test";i:1;s:5:"test2";}', 'last_test', 'test final', 1, 1, 43, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `forum_posts`
--

CREATE TABLE IF NOT EXISTS `forum_posts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_topic` int(11) NOT NULL,
  `message` text NOT NULL,
  `auteur` varchar(255) NOT NULL,
  `date` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=75 ;

--
-- Contenu de la table `forum_posts`
--

INSERT INTO `forum_posts` (`id`, `id_topic`, `message`, `auteur`, `date`) VALUES
(5, 3, 'da\r\ndas\r\nda\r\nsd\r\nas\r\ndas\r\n\r\n<a href="toto">toto</a>\r\n\r\n', 'me', 1329959150),
(7, 3, 'message', 'me', 1324603760),
(8, 4, 'ceci est un test', 'me', 1329831519),
(10, 6, 'ceci est un test', 'me', 1329831637),
(11, 7, 'mon nouveau topic qui poutre du poney', 'me', 1329840388),
(12, 8, 'mon nouveau topic qui poutre du poney', 'me', 1329840389),
(13, 8, ' salut', 'me', 1329921037),
(14, 8, ' retest', 'me', 1329921057),
(15, 8, ' ', 'me', 1329921100),
(17, 8, ' retest', 'toto', 1329921444),
(18, 3, ' <a href="#">titi</a>', 'me', 1329959179),
(19, 3, ' ddasd', 'me', 1330176449),
(20, 3, ' as', 'me', 1330176453),
(21, 3, ' s', 'me', 1330176457),
(22, 3, ' s', 'me', 1330176461),
(23, 3, ' qwe', 'me', 1330176468),
(24, 3, ' qwe', 'me', 1330176473),
(25, 3, ' qwe', 'me', 1330176476),
(26, 3, ' qwe\r\n', 'me', 1330176482),
(27, 3, ' \r\n]', 'me', 1330176491),
(28, 3, ' ad', 'me', 1330176500),
(29, 3, ' sd', 'me', 1330176511),
(30, 3, ' asd', 'me', 1330176519),
(31, 3, ' asd', 'me', 1330176524),
(32, 3, 'asd', 'me', 1330176535),
(33, 3, ' sd', 'me', 1330184511),
(34, 3, ' asdasd', 'me', 1330184515),
(35, 3, ' asd', 'me', 1330184522),
(36, 3, ' asdsd', 'me', 1330184533),
(37, 3, ' asdasd', 'me', 1330184540),
(38, 3, ' asdasd', 'me', 1330184547),
(39, 3, ' dasdasd', 'me', 1330184552),
(40, 3, ' asd', 'me', 1330184564),
(41, 3, ' asd', 'me', 1330184569),
(42, 3, ' asdasd', 'me', 1330184577),
(43, 7, ' salut', 'me', 1330202668),
(45, 8, '', 'me', 1331727406),
(46, 8, '[b][i][s] test[/s][/i][/b]', 'me', 1332251403),
(47, 8, '[url=http://google.fr]google[/url]\r\n', 'me', 1332252018),
(48, 8, '[url="http://google.fr"]google[/url]', 'me', 1332251576),
(49, 8, '[url="http://google.fr"] google [/url]', 'me', 1332251591),
(50, 8, '[URL="http://google.fr"]google[/URL]', 'me', 1332251647),
(51, 8, '[URL=http://google.fr]google[/URL]', 'me', 1332251683),
(52, 8, '[url=http://google.fr]google[/url]', 'me', 1332252033),
(53, 8, 'var_dump($texte);', 'me', 1332252105),
(54, 8, '[url=http://google.fr]google[/url]', 'me', 1332252112),
(55, 8, '[url="http://google.fr"]google[/url]', 'me', 1332252143),
(56, 8, '[url=http://google.fr]google[/url]', 'me', 1332252431),
(57, 8, '[img=http://pierre.chachatelier.fr/programmation/images/mozodojo-original-image.jpg]image lol[/img]', 'me', 1332252707),
(59, 8, '[r]toto[/r]\r\n', 'me', 1332258317),
(60, 8, '[url=http://google.fr]google[/url]', 'me', 1332262159),
(62, 10, 'test', 'me', 1332333559),
(63, 10, '[quote=me]test[/quote][quote=me]test[/quote]', 'me', 1332336650),
(64, 10, '[quote=me]test[/quote]', 'me', 1332336666),
(65, 10, '[quote] TEST de quote[/quote]', 'me', 1332337334),
(66, 8, '[code=html]<img src="/public/images/quote.gif" alt="citation" click="forum:insert_text(''[quote]'', ''[/quote]'')">\r\n<img src="/public/images/italic.gif" alt="italic" click="forum:insert_text(''[i]'', ''[/i]'')">\r\n<img src="/public/images/strike.gif" alt="barre" click="forum:insert_text(''[s]'', ''[/s]'')">\r\n<img src="/public/images/underline.gif" alt="souligner" click="forum:insert_text(''[u]'', ''[/u]'')">\r\n<img src="/public/images/image.gif" alt="image" click="forum:insert_text(''[img]'', ''[/img]'')">\r\n<img src="/public/images/code.gif" alt="image" click="forum:insert_text(''[code=]'', ''[/code]'')">[/code]\r\n', 'me', 1332339209),
(67, 8, '<img src="/public/images/italic.gif" alt="italic" click="forum:insert_text('''', '''')">\r\n<img src="/public/images/strike.gif" alt="barre" click="forum:insert_text('''', '''')">\r\n<img src="/public/images/underline.gif" alt="souligner" click="forum:insert_text('''', '''')">', 'me', 1332339758),
(68, 8, '[code=html]<img src="/public/images/italic.gif" alt="italic" click="forum:insert_text('''', '''')">\r\n<img src="/public/images/strike.gif" alt="barre" click="forum:insert_text('''', '''')">\r\n<img src="/public/images/underline.gif" alt="souligner" click="forum:insert_text('''', '''')">[/code]', 'me', 1332339783),
(69, 8, '[c=]<img src="/public/images/italic.gif" alt="italic" click="forum:insert_text('''', '''')">\r\n<img src="/public/images/strike.gif" alt="barre" click="forum:insert_text('''', '''')">\r\n<img src="/public/images/underline.gif" alt="souligner" click="forum:insert_text('''', '''')">[/c]', 'me', 1332340005),
(70, 8, '[c=html]<img src="/public/images/italic.gif" alt="italic" click="forum:insert_text('''', '''')">\r\n<img src="/public/images/strike.gif" alt="barre" click="forum:insert_text('''', '''')">\r\n<img src="/public/images/underline.gif" alt="souligner" click="forum:insert_text('''', '''')">[/c]', 'me', 1332340053),
(71, 8, '[b]test[/b]', 'me', 1332340351),
(72, 8, 'test', 'me', 1332347007),
(73, 8, 'asdasda', 'me', 1332347165),
(74, 8, 'asdasda', 'me', 1332347166);

-- --------------------------------------------------------

--
-- Structure de la table `forum_topic`
--

CREATE TABLE IF NOT EXISTS `forum_topic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_forum` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `creator` varchar(255) NOT NULL,
  `genre` enum('admin','annonce','normal') NOT NULL,
  `id_first_post` int(11) NOT NULL,
  `id_last_post` int(11) NOT NULL,
  `lock` int(11) NOT NULL,
  `reponses` int(11) NOT NULL,
  `views` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Contenu de la table `forum_topic`
--

INSERT INTO `forum_topic` (`id`, `id_forum`, `name`, `creator`, `genre`, `id_first_post`, `id_last_post`, `lock`, `reponses`, `views`) VALUES
(3, 4, 'test', 'me', 'annonce', 5, 57, 0, 26, 0),
(4, 4, 'test', 'me', 'admin', 8, 57, 0, 0, 0),
(6, 4, 'test', 'me', 'normal', 10, 57, 0, 0, 0),
(7, 5, 'this is an imba test', 'me', 'admin', 11, 57, 0, 1, 0),
(8, 4, 'this is an imba test', 'me', 'admin', 12, 74, 0, 28, 0),
(10, 4, '[s]test[/s]', 'me', 'normal', 62, 65, 0, 3, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
