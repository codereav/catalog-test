-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Хост: 127.0.0.1:3306
-- Время создания: Янв 03 2019 г., 16:47
-- Версия сервера: 5.6.38-log
-- Версия PHP: 7.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `catalog-test`
--
CREATE DATABASE IF NOT EXISTS `catalog-test` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `catalog-test`;

-- --------------------------------------------------------

--
-- Структура таблицы `article`
--

CREATE TABLE IF NOT EXISTS `article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `author_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `author_id` (`author_id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `article`
--

INSERT INTO `article` (`id`, `title`, `content`, `author_id`) VALUES
(1, 'Статья 1', 'Содержание статьи 1', 1),
(2, 'Статья 1', 'Содержание статьи 1', 1),
(3, 'Статья 2', 'Содержание статьи 2', 1),
(4, 'Статья 3', 'Содержание статьи 3', 1),
(5, 'Статья 4', 'Содержание статьи 4', 1),
(6, 'Статья 5', 'Содержание статьи 5', 1),
(7, 'Статья 6', 'Содержание статьи 6', 1),
(8, 'Статья 7', 'Содержание статьи 7', 1),
(9, 'Статья 8', 'Содержание статьи 8', 1),
(10, 'Статья 9', 'Содержание статьи 9', 1),
(11, 'Статья 10', 'Содержание статьи 10', 1),
(12, 'Статья 11', 'Содержание статьи 11', 1),
(13, 'Статья 12', 'Содержание статьи 12', 1),
(14, 'Статья 13', 'Содержание статьи 13', 1),
(18, 'Тестовая статья', 'Тестовое содержание', 7),
(19, 'Статья', 'Текст ещё одной статьи', 7),
(20, 'Статья', 'Текст ещё одной статьи', 7),
(21, 'Статья', 'Текст ещё одной статьи', 7),
(22, 'sfgag', 'asgasg', 8),
(23, 'gasg', 'gsagas', 9),
(24, 'fsf', 'fasfas', 10),
(25, 'fsafas', 'fsafasf', 11),
(26, 'dsfsaf', 'fasfas', 12),
(27, 'dsad', 'safasf', 13),
(28, 'dfdsfdsf', 'dsgdsg', 14),
(29, 'fsafasf', 'asfasf', 15),
(30, 'dsadsa', 'dasdasd', 16),
(31, 'fsafaf', 'fasfas', 17),
(32, 'fsfaf', 'jfgjngjxnxd', 18),
(33, 'gdgsdg', 'sdgsdg', 19),
(34, 'fdsfsdf', 'fsdfsdfsdf', 20),
(35, 'fsafasf', 'fasfaf', 21),
(36, 'fsdfds', 'fdsfsd', 22),
(37, 'fsafas', 'asfasf', 23),
(38, 'sdfdsf', 'fsdfsdf', 24),
(39, 'sdfdsf', 'fsdfsdf', 24),
(40, 'TEst', 'taset', 25),
(41, 'Agasgasg', 'gasgasgasg', 26),
(42, 'safaf', 'asfafasf', 27),
(43, 'gsdgghsd', 'dsgsdg', 28),
(44, 'vzxvzxv', 'xzvzxv', 29),
(45, 'fdsfsd', 'fsdfdsf', 30),
(46, 'rerwer', 'ewrewr', 31),
(47, 'afsafasf', 'safasf', 32),
(48, 'fsafasf', 'fasfasf', 33),
(49, 'fdfsf', 'dsfsdf', 34),
(50, 'TEST ARTICLE', 'test content', 35),
(51, 'test', 'tsetse', 36),
(52, 'test', 'test', 37),
(53, 'test', 'sdgsd', 38),
(54, 'TESTST', 'ststst', 39),
(55, 'fas', 'fasf', 40),
(56, 'rwqr', 'qwrqwr', 41),
(57, 'tsetts', 'tset', 42),
(58, 'ersr', 'esrser', 43),
(59, '252152', 'gsdgg', 44),
(60, 'fasfsaf', 'fsafsaf', 45),
(61, 'Sagsagsa', 'gdsgsg', 46),
(62, 'Sagsagsa', 'gdsgsg', 46),
(63, 'Sagsagsa', 'gdsgsg', 46),
(64, 'Sagsagsa', 'gdsgsg', 46);

-- --------------------------------------------------------

--
-- Структура таблицы `article_rubric`
--

CREATE TABLE IF NOT EXISTS `article_rubric` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) NOT NULL,
  `rubric_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `article_id_2` (`article_id`,`rubric_id`),
  KEY `article_id` (`article_id`),
  KEY `rubric_id` (`rubric_id`)
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `article_rubric`
--

INSERT INTO `article_rubric` (`id`, `article_id`, `rubric_id`) VALUES
(9, 1, 2),
(10, 18, 3),
(11, 19, 2),
(12, 20, 2),
(13, 21, 2),
(14, 22, 4),
(15, 23, 2),
(16, 24, 4),
(17, 25, 4),
(18, 26, 4),
(19, 27, 4),
(20, 28, 2),
(21, 29, 3),
(22, 30, 3),
(23, 31, 2),
(24, 32, 2),
(25, 33, 4),
(26, 34, 4),
(27, 35, 4),
(28, 36, 4),
(29, 37, 3),
(30, 38, 2),
(31, 39, 2),
(32, 40, 2),
(33, 41, 4),
(34, 42, 3),
(35, 43, 4),
(36, 44, 3),
(37, 45, 3),
(38, 46, 3),
(39, 47, 3),
(40, 48, 2),
(41, 49, 2),
(42, 50, 4),
(43, 51, 3),
(44, 52, 2),
(45, 53, 2),
(46, 54, 2),
(47, 55, 3),
(48, 56, 2),
(49, 57, 4),
(50, 58, 4),
(51, 59, 2),
(52, 60, 4),
(53, 61, 3),
(54, 62, 3),
(55, 63, 3),
(56, 64, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `author`
--

CREATE TABLE IF NOT EXISTS `author` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `middlename` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lastname` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `author`
--

INSERT INTO `author` (`id`, `firstname`, `middlename`, `lastname`) VALUES
(1, 'Василий', 'Васильевич', 'Пупкин'),
(6, 'fsf', 'fsf', 'sfsf'),
(7, 'Иван', 'Иванович', 'Иванов'),
(8, 'agasg', 'asgasg', 'aagsg'),
(9, 'sagsag', 'asgasg', 'sagasg'),
(10, 'asfasf', 'asfasf', 'asfaf'),
(11, 'fasfasf', 'fasfsa', 'fasfasf'),
(12, 'asfasf', 'asfasf', 'fsafas'),
(13, 'safasf', 'safasf', 'safasf'),
(14, 'gdsg', 'dgd', 'dsgsdg'),
(15, 'sfasf', 'sfasf', 'sffs'),
(16, 'dasd', 'sadasd', 'dsadas'),
(17, 'asfasf', 'fsafasf', 'fsafasf'),
(18, 'sdgdsg', 'gdg', 'sgdzgd'),
(19, 'ggg', 'ggg', 'dsgsdggsg'),
(20, 'fsdfv', 'dfxdfe', 'fffswrt'),
(21, 'sfsf', 'sfsafsfs', 'fsafsa'),
(22, 'dsfsd', 'fsdf', 'fdfs'),
(23, 'asfasf', 'sfasf', 'safasf'),
(24, 'dsfsdf', 'fsdfs', 'dsff'),
(25, 'fasfasf', 'fsafasf', 'sfasf'),
(26, 'sagasg', 'agasg', 'asgasgas'),
(27, 'vcxvzvsd', 'vdsvasdv', 'qwrqf'),
(28, 'gsdg', 'sdgsd', 'gdsgs'),
(29, 'xzvzxv', 'xvzv', 'vxzvxz'),
(30, 'dsfsdf', 'fsdf', 'dsfsd'),
(31, 'ewrwer', 'rwrwr', 'rwerwer'),
(32, 'asfasf', 'asfasf', 'asfasf'),
(33, 'fsfaf', 'afasfas', 'fasfasfa'),
(34, 'gfgfd', 'gfg', 'gfdgd'),
(35, 'testt', 'testttt', 'test'),
(36, 'stsetset', 'stetest', 'tsetset'),
(37, 'tsets', 'testset', 'tttt'),
(38, 'sdgsd', 'gsdgds', 'gdsgd'),
(39, 'stttst', 'ststst', 'ststst'),
(40, 'faf', 'fff', 'af'),
(41, 'wqrqw', 'rqwrq', 'rwqrqw'),
(42, 'sets', 'setset', 'etset'),
(43, 'rserse', 'serrser', 'esrser'),
(44, 'gdsgsd', 'dsgsdg', 'sgds'),
(45, 'asfasf', 'fasfasf', 'sfsaf'),
(46, 'sdgsdg', 'sdgsdg', 'sdgsg');

-- --------------------------------------------------------

--
-- Структура таблицы `rubric`
--

CREATE TABLE IF NOT EXISTS `rubric` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `rubric`
--

INSERT INTO `rubric` (`id`, `parent_id`, `title`) VALUES
(2, 6, 'масленица'),
(3, 6, 'Новый год'),
(4, 7, 'Футбол'),
(5, 7, 'Баскетбол'),
(6, NULL, 'Праздники'),
(7, NULL, 'Спорт'),
(8, 7, 'Соревнования'),
(9, 8, 'Кулачные бои'),
(10, 8, 'Вольная борьба'),
(11, 8, 'Бадминтон'),
(12, 6, '23 февраля');

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `article`
--
ALTER TABLE `article`
  ADD CONSTRAINT `article_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `author` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Ограничения внешнего ключа таблицы `article_rubric`
--
ALTER TABLE `article_rubric`
  ADD CONSTRAINT `article_rubric_ibfk_1` FOREIGN KEY (`article_id`) REFERENCES `article` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `article_rubric_ibfk_2` FOREIGN KEY (`rubric_id`) REFERENCES `rubric` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
