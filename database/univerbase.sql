-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Дек 18 2022 г., 20:14
-- Версия сервера: 8.0.11
-- Версия PHP: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `univerbase`
--
CREATE DATABASE IF NOT EXISTS `univerbase` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci;
USE `univerbase`;

DELIMITER $$
--
-- Процедуры
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `delete_user` (IN `userid` INT)   BEGIN
	DELETE FROM `progress` WHERE `progress`.`student_id` = `userid`;
    DELETE FROM `attendance` WHERE `attendance`.`student_id` = `userid`;
    DELETE FROM `user` WHERE `user`.`user_id` = `userid`;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `attendance`
--

CREATE TABLE `attendance` (
  `attendance_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `matcher` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `comment` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `attendance`
--

INSERT INTO `attendance` (`attendance_id`, `student_id`, `matcher`, `date`, `comment`) VALUES
(1, 2, 4, '2022-10-30', 'test'),
(2, 17, 4, '2022-11-01', 'test'),
(3, 17, 4, '2022-11-01', 'test2'),
(4, 2, 4, '2022-11-16', 'test2'),
(5, 17, 4, '2022-11-16', 'test2'),
(7, 2, 4, '2022-11-16', 'test3');

-- --------------------------------------------------------

--
-- Структура таблицы `attestation`
--

CREATE TABLE `attestation` (
  `form` varchar(50) NOT NULL,
  `attestation_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `attestation`
--

INSERT INTO `attestation` (`form`, `attestation_id`) VALUES
('Зачёт', 1),
('Экзамен', 2),
('Дифференцированный зачёт', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `classform`
--

CREATE TABLE `classform` (
  `form_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `classform`
--

INSERT INTO `classform` (`form_id`, `name`) VALUES
(1, 'Лекция'),
(2, 'Семинар'),
(3, 'Лабораторная'),
(4, 'Практика');

-- --------------------------------------------------------

--
-- Структура таблицы `discipline`
--

CREATE TABLE `discipline` (
  `discipline_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `attestation` int(11) NOT NULL,
  `kaf` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `discipline`
--

INSERT INTO `discipline` (`discipline_id`, `name`, `attestation`, `kaf`) VALUES
(1, 'Шаблоны программных продуктов языка Джава', 2, 3),
(2, 'Разработка серверных частей интернет-ресурсов', 2, 3),
(3, 'Разработка клиентских частей интернет-ресурсов', 2, 3),
(4, 'Настройка и администрирование сервисного программного обеспечения', 1, 3),
(5, 'Ознакомительная практика', 3, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `group`
--

CREATE TABLE `group` (
  `group_id` int(11) NOT NULL,
  `group` varchar(20) NOT NULL,
  `spec` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `group`
--

INSERT INTO `group` (`group_id`, `group`, `spec`) VALUES
(1, 'ИКБО-01-20', '09.03.03'),
(2, 'ИКБО-02-20', '09.03.03'),
(10, 'ИКБО-10-20', '09.03.04'),
(24, 'ИКБО-24-20', '09.03.04');

-- --------------------------------------------------------

--
-- Структура таблицы `kaf`
--

CREATE TABLE `kaf` (
  `kaf_id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `kaf`
--

INSERT INTO `kaf` (`kaf_id`, `name`) VALUES
(1, 'Базовая кафедра'),
(2, 'Кафедра вычислительной техники'),
(3, 'Кафедра инструментального и прикладного программного обеспечения'),
(6, 'Кафедра математического обеспечения и стандартизации информационных технологий'),
(7, 'Кафедра корпоративных информационных систем'),
(8, 'Кафедра практической и прикладной информатики'),
(9, 'Кафедра промышленной информатики'),
(10, 'Кафедра высшей математики'),
(12, 'Кафедра иностранных языков'),
(16, 'Кафедра гуманитарных и социальных наук');

-- --------------------------------------------------------

--
-- Структура таблицы `matcher`
--

CREATE TABLE `matcher` (
  `discipline` int(11) NOT NULL,
  `group` int(11) NOT NULL,
  `matcher_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `hours_count` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `matcher`
--

INSERT INTO `matcher` (`discipline`, `group`, `matcher_id`, `user_id`, `form_id`, `hours_count`) VALUES
(1, 2, 1, 18, 1, 16),
(4, 2, 2, 18, 2, 16),
(3, 10, 3, 22, 2, 32),
(3, 10, 4, 18, 1, 32),
(5, 24, 10, 18, 4, 8),
(1, 2, 11, 18, 2, 32);

-- --------------------------------------------------------

--
-- Структура таблицы `progress`
--

CREATE TABLE `progress` (
  `progress_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `matcher` int(11) NOT NULL,
  `rating` int(11) DEFAULT NULL,
  `success` tinyint(1) DEFAULT NULL,
  `exam_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `progress`
--

INSERT INTO `progress` (`progress_id`, `student_id`, `matcher`, `rating`, `success`, `exam_date`) VALUES
(3, 2, 4, 7, 0, '2022-11-25'),
(5, 11, 1, 9, 1, '2022-11-24'),
(6, 12, 2, 1, 1, '2022-11-25'),
(35, 13, 4, 10, 1, '2022-11-25'),
(36, 14, 10, 6, 1, '2022-11-25'),
(37, 15, 10, 3, 0, '2022-11-25'),
(39, 16, 10, 6, 1, '2022-11-25'),
(40, 12, 1, 8, 1, '2022-11-26'),
(42, 21, 1, 9, 1, '2022-11-30'),
(43, 10, 1, 9, 1, '2022-11-30');

--
-- Триггеры `progress`
--
DELIMITER $$
CREATE TRIGGER `automatic_date_insert` BEFORE INSERT ON `progress` FOR EACH ROW SET new.`exam_date` = now()
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `automatic_date_update` BEFORE UPDATE ON `progress` FOR EACH ROW SET new.`exam_date` = now()
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `automatic_success_insert` BEFORE INSERT ON `progress` FOR EACH ROW IF new.rating = 2
OR new.rating = 3
OR new.rating = 7
OR new.rating = 11
OR new.rating = 12
OR new.rating = 13 THEN
SET new.`success` = 0;
ELSE SET new.`success` = 1;
END IF
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `automatic_success_update` BEFORE UPDATE ON `progress` FOR EACH ROW IF new.rating = 2
OR new.rating = 3
OR new.rating = 7
OR new.rating = 11
OR new.rating = 12
OR new.rating = 13 THEN
SET new.`success` = 0;
ELSE SET new.`success` = 1;
END IF
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Структура таблицы `rating`
--

CREATE TABLE `rating` (
  `rating_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `attestation_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `rating`
--

INSERT INTO `rating` (`rating_id`, `name`, `attestation_id`) VALUES
(1, 'Зачтено', 1),
(2, 'Не зачтено', 1),
(3, '2 (Неудовлетворительно)', 3),
(4, '3 (Удовлетворительно)', 3),
(5, '4 (Хорошо)', 3),
(6, '5 (Отлично)', 3),
(7, '2 (Неудовлетворительно)', 2),
(8, '3 (Удовлетворительно)', 2),
(9, '4 (Хорошо)', 2),
(10, '5 (Отлично)', 2),
(11, 'Неявка', 1),
(12, 'Неявка', 2),
(13, 'Неявка', 3);

-- --------------------------------------------------------

--
-- Структура таблицы `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `role`
--

INSERT INTO `role` (`role_id`, `name`) VALUES
(1, 'Студент'),
(2, 'Преподаватель'),
(3, 'Администратор');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `role` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `login` varchar(64) NOT NULL,
  `password` varchar(64) NOT NULL,
  `code` varchar(20) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `kaf` int(11) DEFAULT NULL,
  `group` int(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`role`, `name`, `login`, `password`, `code`, `user_id`, `kaf`, `group`, `email`) VALUES
(3, 'admin', 'admin', '90b9aa7e25f80cf4f64e990b78a9fc5ebd6cecad', NULL, 1, NULL, NULL, NULL),
(1, 'student', 'student', '3650f030191228216dc0e4bbac7de0b2f5f39c8e', '20И1466', 2, NULL, 10, 'testemail@email.com'),
(1, 'Артюхин Даниил Кириллович', 'student1-ikbo-01-20', 'e6525e503681dbe4bd94f5a2d5c66ff910c776d6', '20И0001', 3, NULL, 1, 'email@email.com'),
(1, 'Баикин Кирилл Евгеньевич', 'student2-ikbo-01-20', '42af80d76c2da1e2f13d48cf44b028282d4ec3b7', '20И0002', 6, NULL, 1, 'email@email.com'),
(1, 'Вальков Дмитрий Андреевич', 'student3-ikbo-01-20', '37e8a9c4903ccc4cd4dd70cebd111993c0b8e3a3', '20И0003', 9, NULL, 1, NULL),
(1, 'Гребенщиков Данила Александрович', 'student1-ikbo-02-20', '74b0afb9bfd982545a9752a8b7825812d6e6ca82', '20И0004', 10, NULL, 2, NULL),
(1, 'Губанов Денис Дмитриевич', 'student2-ikbo-02-20', 'de6dcec010957794f7a3a35f8d569653cb7f358c', '20И0005', 11, NULL, 2, 'email@email.com'),
(1, 'Дегтярев Владимир Сергеевич', 'student3-ikbo-02-20', '7fefaa4ae044478acce8538e3a31325f3ba44c72', '20И0006', 12, NULL, 2, 'email@email.com'),
(1, 'Коваленко Анастасия Валерьевна', 'student1-ikbo-10-20', '8bbf83fc6d4c350a5d005998e7ef4eee1e3a9550', '20И0007', 13, NULL, 10, 'email@email.com'),
(1, 'Семенов Кирилл Андреевич', 'student2-ikbo-24-20', 'be3f74d8d71740b17dd3d40f74884d219862f06a', '20И0008', 14, NULL, 24, NULL),
(1, 'Мельников Тимофей Вадимович', 'student3-ikbo-24-20', '00763b095ed99d1d5006d5c6154f2a282af5655f', '20И0009', 15, NULL, 24, 'email@email.com'),
(1, 'Рослов Павел Дмитриевич', 'student1-ikbo-24-20', '27bc293022fc81ce447a4e300403d0f6c52261f2', '20И0010', 16, NULL, 24, 'email@email.com'),
(1, 'Филин Андрей Александрович', 'student2-ikbo-10-20', '618f7e438c2d117e3dabbafaf8a625fbea52763a', '20И0011', 17, NULL, 10, NULL),
(2, 'Матчин Василий Тимофеевич', 'prepod1', 'c136fe1a1c4247acf16860e35e2ee1c6fb93ff66', NULL, 18, 3, NULL, NULL),
(2, 'Рысин Михаил Леонидович', 'prepod2', '820c31ad2299f4273c3e580b3d9cf91e38217d46', NULL, 19, 6, NULL, NULL),
(2, 'Прокопчук Анна Реональдовна', 'prepod3', '5d4317af607160b3f574bbdb945d1b4af7796760', NULL, 20, 12, NULL, NULL),
(1, 'Авдотьев Руслан Алибекович', 'student4-ikbo-02-20', '3b8e6c51f604a45a1066e01a89192dc5efaf5e3c', '20И0012', 21, NULL, 2, 'email@email.com'),
(2, 'Болбаков Роман Геннадьевич', 'prepod4', '35b3d8e2c48869a7edc2f523b338bcea1c32d768', NULL, 22, 3, NULL, 'email@email.com'),
(2, 'Миронов Алексей Игоревич', 'prepod5', '3eb02b985906f3a4157461704046cbce17d4442d', NULL, 23, 6, NULL, 'email@email.com'),
(2, 'prepod2', 'root1', '67de4a189934dcfa6cdec0695ca722a57f2e9ef2', NULL, 24, 1, NULL, 'email@email.com'),
(2, 'Миролюбова Наталия Алексеевна', 'prepod6', 'f428e48be9dc47808a440bc9cffe9b2511730964', NULL, 25, 12, NULL, 'email@email.com'),
(2, 'Исаев Ростислав Александрович', 'prepod7', '006450493f1f49de11007c8dded4aaabae2c031d', NULL, 26, 8, NULL, NULL),
(2, 'Лентяева Татьяна Владимировна', 'prepod8', '46f74290c1b44153e0e4511bb648737421565e33', NULL, 27, 8, NULL, 'email@email.com'),
(2, 'Корнеев Михаил Сергеевич', 'prepod9', 'e5c8622bece79f8404ea45e0188bea531ca1521e', NULL, 28, 9, NULL, NULL),
(2, 'Королев Филипп Андреевич', 'prepod10', '3c1a71779fca26d905337e9cfe8ef5bd6272747a', NULL, 29, 9, NULL, 'email@email.com'),
(2, 'Гущина Елена Николаевна', 'prepod11', 'de1600e31e579dc4c34ee5bdd1b8f134253c531a', NULL, 30, 10, NULL, NULL),
(2, 'Каменских Лариса Вячеславовна', 'prepod12', '6c1d7cb54ebe2ff7ce8c7baeba4e88e59df0be19', NULL, 31, 10, NULL, 'email@email.com'),
(2, 'Арапов Олег Геннадьевич', 'prepod13', '3a9fd60f302c54e200a118fcab53705c2be6f5fc', NULL, 32, 16, NULL, NULL),
(2, 'Арапова Эльмира Асфаровна', 'prepod14', '090f5370550ab78d745888fd60d70244fc8235ab', NULL, 33, 16, NULL, NULL),
(2, 'Демидова Лилия Анатольевна', 'prepod15', '07f4f75688bc24c508d3ef24740e0b1e1ba7726b', NULL, 34, 7, NULL, 'email@email.com'),
(2, 'Советов Пётр Николаевич', 'prepod16', 'a4f90d8e0ac07c5baa2b81eea4277787c50dc38e', NULL, 35, 7, NULL, NULL),
(2, 'Грач Евгений Петрович', 'prepod17', 'd137ef292052e26d6cba5bcfe3a52fbed71b81cc', NULL, 36, 2, NULL, 'email@email.com'),
(3, 'root', 'root', '83353d597cbad458989f2b1a5c1fa1f9f665c858', NULL, 37, NULL, NULL, NULL),
(2, 'prepod', 'prepod', '059c94db19ec1a514bf82769bfe57c84c5651699', NULL, 38, 1, NULL, NULL);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendance_id`),
  ADD KEY `R_35` (`student_id`),
  ADD KEY `R_37` (`matcher`);

--
-- Индексы таблицы `attestation`
--
ALTER TABLE `attestation`
  ADD PRIMARY KEY (`attestation_id`);

--
-- Индексы таблицы `classform`
--
ALTER TABLE `classform`
  ADD PRIMARY KEY (`form_id`);

--
-- Индексы таблицы `discipline`
--
ALTER TABLE `discipline`
  ADD PRIMARY KEY (`discipline_id`),
  ADD KEY `R_24` (`attestation`),
  ADD KEY `R_25` (`kaf`);

--
-- Индексы таблицы `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`group_id`);

--
-- Индексы таблицы `kaf`
--
ALTER TABLE `kaf`
  ADD PRIMARY KEY (`kaf_id`);

--
-- Индексы таблицы `matcher`
--
ALTER TABLE `matcher`
  ADD PRIMARY KEY (`matcher_id`),
  ADD KEY `R_19` (`discipline`),
  ADD KEY `R_21` (`group`),
  ADD KEY `R_42` (`user_id`),
  ADD KEY `R_43` (`form_id`);

--
-- Индексы таблицы `progress`
--
ALTER TABLE `progress`
  ADD PRIMARY KEY (`progress_id`),
  ADD KEY `R_30` (`student_id`),
  ADD KEY `R_34` (`matcher`),
  ADD KEY `R_39` (`rating`);

--
-- Индексы таблицы `rating`
--
ALTER TABLE `rating`
  ADD PRIMARY KEY (`rating_id`),
  ADD KEY `R_38` (`attestation_id`);

--
-- Индексы таблицы `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `login` (`login`),
  ADD UNIQUE KEY `code` (`code`),
  ADD KEY `R_8` (`role`),
  ADD KEY `R_16` (`kaf`),
  ADD KEY `R_17` (`group`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `attestation`
--
ALTER TABLE `attestation`
  MODIFY `attestation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `classform`
--
ALTER TABLE `classform`
  MODIFY `form_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT для таблицы `discipline`
--
ALTER TABLE `discipline`
  MODIFY `discipline_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT для таблицы `group`
--
ALTER TABLE `group`
  MODIFY `group_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT для таблицы `kaf`
--
ALTER TABLE `kaf`
  MODIFY `kaf_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT для таблицы `matcher`
--
ALTER TABLE `matcher`
  MODIFY `matcher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT для таблицы `progress`
--
ALTER TABLE `progress`
  MODIFY `progress_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT для таблицы `rating`
--
ALTER TABLE `rating`
  MODIFY `rating_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT для таблицы `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `R_35` FOREIGN KEY (`student_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `R_37` FOREIGN KEY (`matcher`) REFERENCES `matcher` (`matcher_id`);

--
-- Ограничения внешнего ключа таблицы `discipline`
--
ALTER TABLE `discipline`
  ADD CONSTRAINT `R_24` FOREIGN KEY (`attestation`) REFERENCES `attestation` (`attestation_id`),
  ADD CONSTRAINT `R_25` FOREIGN KEY (`kaf`) REFERENCES `kaf` (`kaf_id`);

--
-- Ограничения внешнего ключа таблицы `matcher`
--
ALTER TABLE `matcher`
  ADD CONSTRAINT `R_19` FOREIGN KEY (`discipline`) REFERENCES `discipline` (`discipline_id`),
  ADD CONSTRAINT `R_21` FOREIGN KEY (`group`) REFERENCES `group` (`group_id`),
  ADD CONSTRAINT `R_42` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `R_43` FOREIGN KEY (`form_id`) REFERENCES `classform` (`form_id`);

--
-- Ограничения внешнего ключа таблицы `progress`
--
ALTER TABLE `progress`
  ADD CONSTRAINT `R_30` FOREIGN KEY (`student_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `R_34` FOREIGN KEY (`matcher`) REFERENCES `matcher` (`matcher_id`),
  ADD CONSTRAINT `R_39` FOREIGN KEY (`rating`) REFERENCES `rating` (`rating_id`);

--
-- Ограничения внешнего ключа таблицы `rating`
--
ALTER TABLE `rating`
  ADD CONSTRAINT `R_38` FOREIGN KEY (`attestation_id`) REFERENCES `attestation` (`attestation_id`);

--
-- Ограничения внешнего ключа таблицы `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `R_16` FOREIGN KEY (`kaf`) REFERENCES `kaf` (`kaf_id`),
  ADD CONSTRAINT `R_17` FOREIGN KEY (`group`) REFERENCES `group` (`group_id`),
  ADD CONSTRAINT `R_8` FOREIGN KEY (`role`) REFERENCES `role` (`role_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
