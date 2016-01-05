-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Янв 05 2016 г., 23:50
-- Версия сервера: 5.5.46-0ubuntu0.14.04.2
-- Версия PHP: 5.5.9-1ubuntu4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `jkh_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `checker`
--

CREATE TABLE IF NOT EXISTS `checker` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `checkmailcode` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=73 ;

-- --------------------------------------------------------

--
-- Структура таблицы `etweet`
--

CREATE TABLE IF NOT EXISTS `etweet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `etweet_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `organization_id` int(11) NOT NULL,
  `etweet_author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `etweet_author_address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `etweet_author_phone` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `etweet_author_email` varchar(64) COLLATE utf8_unicode_ci DEFAULT NULL,
  `etweet_answer_to_email` tinyint(1) NOT NULL,
  `etweet_answer_to_postadds` tinyint(1) NOT NULL,
  `etweet_text` varchar(2048) COLLATE utf8_unicode_ci NOT NULL,
  `etweet_file_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `etweet_file_path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `indent_num` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `litz_schet` int(11) NOT NULL,
  `email` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `fio` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=91 ;

-- --------------------------------------------------------

--
-- Структура таблицы `user2`
--

CREATE TABLE IF NOT EXISTS `user2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `indentnum` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `litzschet` int(11) NOT NULL,
  `email` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
  `fio` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_1558D4EF1535EF5C` (`indentnum`),
  UNIQUE KEY `UNIQ_1558D4EFBFA375BC` (`litzschet`),
  UNIQUE KEY `UNIQ_1558D4EFE7927C74` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
