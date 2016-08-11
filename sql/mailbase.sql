-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1
-- Время создания: Авг 11 2016 г., 17:23
-- Версия сервера: 5.6.21
-- Версия PHP: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `mailbase`
--

-- --------------------------------------------------------

--
-- Структура таблицы `mail`
--

CREATE TABLE IF NOT EXISTS `mail` (
`id` int(11) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `mail` varchar(255) DEFAULT NULL,
  `platform` varchar(255) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=203 DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `mail`
--

INSERT INTO `mail` (`id`, `url`, `mail`, `platform`) VALUES
(2, 'http://test.by', 'mail@test.by', 'shop.by');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `mail`
--
ALTER TABLE `mail`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `mail`
--
ALTER TABLE `mail`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=203;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
