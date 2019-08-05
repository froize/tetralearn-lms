-- phpMyAdmin SQL Dump
-- version 4.0.10.20
-- https://www.phpmyadmin.net
--
-- Host: 10.0.0.98:3306
-- Generation Time: May 30, 2019 at 06:58 PM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 5.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ali-sharipov`
--

-- --------------------------------------------------------

--
-- Table structure for table `chapter`
--

CREATE TABLE IF NOT EXISTS `chapter` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-chapter-course` (`course_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Dumping data for table `chapter`
--

INSERT INTO `chapter` (`id`, `name`, `course_id`) VALUES
(12, 'Be a security ninja: серия вебинаров от компании "Инфосистемы Джет"', 11),
(13, 'Be A Security Ninja: Secret Level', 11),
(14, 'Безопасность компьютерных систем', 12),
(15, 'Безопасность Cisco', 13),
(16, 'Тестовая глава', 16);

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE IF NOT EXISTS `chat` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned DEFAULT NULL,
  `time` int(10) unsigned DEFAULT NULL,
  `rfc822` varchar(50) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `message` text,
  `dialog_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-chat-dialog-id` (`dialog_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `description` text,
  `rating` float DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `tutor_id` int(11) DEFAULT NULL,
  `is_private` tinyint(1) DEFAULT NULL,
  `pic` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-course-tutor` (`tutor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `name`, `description`, `rating`, `start_date`, `end_date`, `active`, `tutor_id`, `is_private`, `pic`) VALUES
(11, 'Информационная безопасность распределенных информационных систем', '<p><strong>Цель изучения темы</strong>: ознакомиться с основными положениями стандартов по обеспечению «информационной безопасности» в распределенных вычислительных сетях.\r\n</p>\r\n<h1>Требования к знаниям и умениям</h1>\r\n<br/>\r\n<h2>Студент должен знать:</h2>\r\n<ul>\r\n	<li>\r\n	основное содержание стандартов по информационной безопасности распределенных систем;</li>\r\n	<li>\r\n	основные сервисы безопасности в вычислительных сетях;</li>\r\n	<li>\r\n	наиболее эффективные механизмы безопасности;</li>\r\n	<li>\r\n	задачи администрирования средств безопасности.</li>\r\n</ul>\r\n<h2>Студент должен уметь:\r\n</h2>\r\n<ul>\r\n	<li>\r\n	выбирать механизмы безопасности для зашиты распределенных систем.</li>\r\n</ul>\r\n<h2>Ключевой термин\r\n</h2>\r\n<p><strong>Ключевой термин: стандарты информационной безопасности распределенных систем.\r\n	</strong>\r\n</p>\r\n<p>Стандарты информационной безопасности распределенных систем трактуют вопросы информационной безопасности применительно к распределенным систем, таким как вычислительные сети и определяют возможные сервисы и механизмы безопасности вычислительных сетей.\r\n</p>\r\n<h2>Второстепенные термины\r\n</h2>\r\n<ul>\r\n	<li>\r\n	Сервисы безопасности в вычислительных сетях.</li>\r\n	<li>\r\n	Механизмы безопасности.</li>\r\n	<li>\r\n	Администрирование средств безопасности.</li>\r\n</ul>', NULL, '2019-02-11', '2019-07-14', 1, 1, 1, 'b9ca936f-6311-4202-89cc-cccbe882a283.jpg'),
(12, 'Информационная безопасность в ТюмГУ', '<p>Прежде всего, перспективное планирование в значительной степени обусловливает важность первоочередных требований. Разнообразный и богатый опыт говорит нам, что сплоченность команды профессионалов предопределяет высокую востребованность соответствующих условий активизации. В своем стремлении улучшить пользовательский опыт мы упускаем, что базовые сценарии поведения пользователей лишь добавляют фракционных разногласий и объявлены нарушающими общечеловеческие нормы этики и морали. Учитывая ключевые сценарии поведения, реализация намеченных плановых заданий способствует повышению качества приоритизации разума над эмоциями.</p><p>Современные технологии достигли такого уровня, что существующая теория влечет за собой процесс внедрения и модернизации прогресса профессионального сообщества. А еще предприниматели в сети интернет, инициированные исключительно синтетически, представлены в исключительно положительном свете.</p>', NULL, '2019-05-09', '2019-06-14', 1, 1, 0, NULL),
(13, ' Yii Безопасность информации', '<p>В своем стремлении повысить качество жизни, они забывают, что семантический разбор внешних противодействий создает предпосылки для кластеризации усилий. Имеется спорная точка зрения, гласящая примерно следующее: сторонники тоталитаризма в науке набирают популярность среди определенных слоев населения, а значит, должны быть ассоциативно распределены по отраслям. Также как постоянный количественный рост и сфера нашей активности не дает нам иного выбора, кроме определения анализа существующих паттернов поведения.</p><p>Каждый из нас понимает очевидную вещь: убежденность некоторых оппонентов выявляет срочную потребность стандартных подходов. С другой стороны, выбранный нами инновационный путь требует от нас анализа глубокомысленных рассуждений. Высокий уровень вовлечения представителей целевой аудитории является четким доказательством простого факта: выбранный нами инновационный путь в значительной степени обусловливает важность своевременного выполнения сверхзадачи. Задача организации, в особенности же разбавленное изрядной долей эмпатии, рациональное мышление требует от нас анализа дальнейших направлений развития. Кстати, сторонники тоталитаризма в науке подвергнуты целой серии независимых исследований.</p>', NULL, '2019-04-08', '2019-08-23', 1, 1, 0, 'shutterstock_407822332.jpg'),
(16, 'Тестовый курс', '<h1>Тестовый курс\r\n</h1>', NULL, '2019-05-02', '2019-06-21', 1, 1, 0, '6456'),
(17, '123', '223', NULL, '2019-05-11', '2019-05-31', 1, 1, 0, '4324');

-- --------------------------------------------------------

--
-- Table structure for table `course_curator`
--

CREATE TABLE IF NOT EXISTS `course_curator` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `curator_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-course-curator` (`curator_id`),
  KEY `idx-curator-course` (`course_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `course_group`
--

CREATE TABLE IF NOT EXISTS `course_group` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-group-course` (`course_id`),
  KEY `idx-course-group` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=45 ;

--
-- Dumping data for table `course_group`
--

INSERT INTO `course_group` (`id`, `course_id`, `group_id`) VALUES
(35, 11, 1),
(42, 16, 1),
(43, 16, 2),
(44, 17, 3);

-- --------------------------------------------------------

--
-- Table structure for table `dialog`
--

CREATE TABLE IF NOT EXISTS `dialog` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tutor_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `task_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-dialog-tutor` (`tutor_id`),
  KEY `idx-dialog-student` (`student_id`),
  KEY `idx-dialog-task` (`task_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `dialog`
--

INSERT INTO `dialog` (`id`, `tutor_id`, `student_id`, `task_id`) VALUES
(12, 1, 12, 40);

-- --------------------------------------------------------

--
-- Table structure for table `gang`
--

CREATE TABLE IF NOT EXISTS `gang` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `gang`
--

INSERT INTO `gang` (`id`, `name`) VALUES
(1, 'ИБАС 158'),
(2, 'КБ 157'),
(3, 'ИБ 156');

-- --------------------------------------------------------

--
-- Table structure for table `invitation`
--

CREATE TABLE IF NOT EXISTS `invitation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `course_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `accepted` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-invitation-course` (`course_id`),
  KEY `idx-invitation-user` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `invitation`
--

INSERT INTO `invitation` (`id`, `course_id`, `user_id`, `accepted`) VALUES
(5, 12, 15, 1);

-- --------------------------------------------------------

--
-- Table structure for table `lecture`
--

CREATE TABLE IF NOT EXISTS `lecture` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `text` text,
  `file` varchar(255) DEFAULT NULL,
  `chapter_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-lecture-chapter` (`chapter_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `lecture`
--

INSERT INTO `lecture` (`id`, `name`, `text`, `file`, `chapter_id`) VALUES
(12, '«Основные термины информационной безопасности»', '<p>В вебинаре идет речь о базовых терминах и определениях, основных концепциях и подходах к обеспечению ИБ. Поговорили об оценке рисков, таксономии угроз, kill-chain-сценариях, описывающих действия злоумышленника, разработке эффективных защитных мер, а также роли подразделений ИБ в жизненном цикле компании.\r\n</p><iframe width="560" height="315" src="https://www.youtube.com/embed/WLeBP5tHtpM" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>', '2.pdf', 12),
(13, '«Стандарты информационной безопасности»', '<p>На вебинаре рассмотрены стандарты от международных консорциумов по информационной безопасности, таких как NIST, OWASP, ISACA, PCI DSS, SANS, ISO 27XXX. Посмотрев видеозапись, вы получите представление о технико-методологической базе. Актуально для тех, кто планирует защищать инфраструктуру или рассчитывает применять свои силы в пентесте.\r\n</p><iframe width="560" height="315" src="https://www.youtube.com/embed/a68-ZXB_sY8" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""><span id="selection-marker-1" class="redactor-selection-marker"></span></iframe>', NULL, 12),
(14, 'Атака сетевого периметра', '<p>На вебинаре мы рассмотрели как происходят атаки сетевого периметра, практические кейсы и инструментарий пентестера.\r\n</p>\r\n<iframe width="560" height="315" src="https://www.youtube.com/embed/m70tnVnwkjg" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>', NULL, 13),
(15, 'Onside-атаки', '<p>На вебинаре мы рассмотрели темы по захвату контроллеру домена за считанные минуты, получению доступа к процессингу банка, имея минимальные привилегии в системе. Отдельная часть вебинара была посвящена обзору инструментария для проведения атак.\r\n</p><iframe width="560" height="315" src="https://www.youtube.com/embed/NKEggyKDgRk" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen=""></iframe>', NULL, 13);

-- --------------------------------------------------------

--
-- Table structure for table `migration`
--

CREATE TABLE IF NOT EXISTS `migration` (
  `version` varchar(180) NOT NULL,
  `apply_time` int(11) DEFAULT NULL,
  PRIMARY KEY (`version`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `migration`
--

INSERT INTO `migration` (`version`, `apply_time`) VALUES
('m000000_000000_base', 1553672134),
('m190327_062011_create_group_table', 1553672575),
('m190327_062023_create_course_table', 1553672575),
('m190327_062034_create_task_table', 1553672575),
('m190327_062222_create_user_task_table', 1553672575),
('m190327_062610_create_report_table', 1553672634),
('m190331_093851_create_chapter_table', 1554038676),
('m190331_093908_create_chapter_task_table', 1554038676),
('m190331_093919_create_lecture_table', 1554038676),
('m190331_093928_create_lecture_task_table', 1554038676),
('m190331_140439_create_user_course_table', 1554041399),
('m190401_142217_create_course_group_table', 1554128899),
('m190401_160315_create_course_curator_table', 1554134782),
('m190423_165828_create_invitations_table', 1556078352),
('m190507_102653_create_dialog_table', 1557394419);

-- --------------------------------------------------------

--
-- Table structure for table `report`
--

CREATE TABLE IF NOT EXISTS `report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-report-tutor` (`course_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `report`
--

INSERT INTO `report` (`id`, `title`, `course_id`) VALUES
(4, 'CISSP Домен 1. Управление рисками ИБ', 11),
(5, 'CISSP Домен 2. Безопасность активов', 11),
(6, 'CISSP Домен 3. Инженерная безопасность', 11),
(7, '123', 11);

-- --------------------------------------------------------

--
-- Table structure for table `synchronization`
--

CREATE TABLE IF NOT EXISTS `synchronization` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `model` varchar(255) NOT NULL DEFAULT '0',
  `item_id` int(11) NOT NULL DEFAULT '0',
  `action` varchar(50) NOT NULL DEFAULT '0',
  `date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_sync` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=66 ;

--
-- Dumping data for table `synchronization`
--

INSERT INTO `synchronization` (`id`, `model`, `item_id`, `action`, `date`, `is_sync`) VALUES
(40, 'Course', 14, 'create', '2019-05-24 23:46:17', 1),
(41, 'Course', 14, 'delete', '2019-05-24 23:46:34', 1),
(42, 'Course', 15, 'create', '2019-05-24 23:47:38', 1),
(43, 'Course', 15, 'update', '2019-05-25 00:09:15', 1),
(44, 'Course', 15, 'update', '2019-05-25 01:52:12', 1),
(45, 'Course', 15, 'delete', '2019-05-25 01:52:57', 1),
(46, 'Chapter', 13, 'update', '2019-05-25 06:21:56', 1),
(47, 'User', 1, 'update', '2019-05-25 07:39:47', 1),
(48, 'Course', 13, 'update', '2019-05-25 07:50:05', 1),
(49, 'Course', 16, 'create', '2019-05-25 07:57:22', 1),
(50, 'Course', 16, 'update', '2019-05-25 07:57:50', 1),
(51, 'Chapter', 16, 'create', '2019-05-25 07:58:34', 1),
(52, 'UserReport', 8, 'create', '2019-05-25 08:01:56', 1),
(53, 'UserTask', 7, 'update', '2019-05-25 08:02:25', 1),
(54, 'UserTask', 8, 'create', '2019-05-25 08:03:20', 1),
(55, 'UserTask', 8, 'update', '2019-05-25 08:04:19', 1),
(56, 'UserTask', 8, 'update', '2019-05-25 08:04:56', 1),
(57, 'UserTask', 8, 'update', '2019-05-25 08:05:17', 1),
(58, 'Invitation', 5, 'create', '2019-05-25 08:07:07', 1),
(59, 'UserCourse', 18, 'create', '2019-05-25 08:07:58', 1),
(61, 'Course', 16, 'update', '2019-05-25 10:10:08', 1),
(62, 'Course', 17, 'create', '2019-05-25 10:10:49', 1),
(63, 'Task', 41, 'create', '2019-05-25 10:11:38', 0),
(64, 'Report', 4, 'update', '2019-05-25 10:13:29', 1),
(65, 'Report', 7, 'create', '2019-05-25 10:13:49', 1);

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE IF NOT EXISTS `task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `text` text,
  `add_date` datetime DEFAULT NULL,
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `with_deadline` tinyint(1) DEFAULT NULL,
  `max_points` int(11) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `chapter_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-task-chapter-id` (`chapter_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `name`, `text`, `add_date`, `start_date`, `end_date`, `active`, `with_deadline`, `max_points`, `file`, `chapter_id`) VALUES
(40, 'Зайти на портал Вместе через Burp', '<ol><li>Запустить Burp из видео</li><li>Зайти на портал Вместе</li><li>Прислать скриншоты</li></ol>', '2019-05-24 15:09:17', '2019-05-24 15:07:00', '2019-06-14 14:25:00', 1, 1, 10, '1.docx', 12),
(41, 'задание', 'описание', '2019-05-25 10:11:38', '2019-05-10 10:11:05', '2019-05-29 10:11:05', 1, 0, 20, '1.docx', 16);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `reg_date` datetime DEFAULT NULL,
  `spec` varchar(255) DEFAULT NULL,
  `group_id` int(11) DEFAULT NULL,
  `is_tutor` tinyint(1) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `auth_key` varchar(32) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-user-group` (`group_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `surname`, `email`, `password`, `reg_date`, `spec`, `group_id`, `is_tutor`, `avatar`, `auth_key`, `description`) VALUES
(1, 'Олег', 'Скворцов', 'i@p.ru', '$2y$13$tNNf.qUsU5GeTEkaEleUvOTbsYE3t0vNtzkTqZVllDGSFiPyQ.cM6', '2019-05-24 14:28:38', 'Старший преподаватель', NULL, 1, 's1200.jpg', NULL, 'Занимаюсь ИБ'),
(6, 'Али', 'Шарипов', 'ali@sh.com', '$2y$13$tNNf.qUsU5GeTEkaEleUvOTbsYE3t0vNtzkTqZVllDGSFiPyQ.cM6', '2019-05-24 14:31:34', NULL, 1, 0, NULL, NULL, NULL),
(7, 'Даниил', 'Сидоров', 'd@sid.ru', '$2y$13$tNNf.qUsU5GeTEkaEleUvOTbsYE3t0vNtzkTqZVllDGSFiPyQ.cM6', '2019-05-24 14:33:02', NULL, 1, 0, NULL, NULL, NULL),
(9, 'Виктор', 'Огороднов', 'vick@star.monaco', '$2y$13$tNNf.qUsU5GeTEkaEleUvOTbsYE3t0vNtzkTqZVllDGSFiPyQ.cM6', '2019-05-24 14:33:55', NULL, 1, 0, NULL, NULL, NULL),
(11, 'Максим', 'Бегунов', 'max@beg.ru', '$2y$13$tNNf.qUsU5GeTEkaEleUvOTbsYE3t0vNtzkTqZVllDGSFiPyQ.cM6', '2019-05-24 14:34:53', NULL, 1, 0, NULL, NULL, NULL),
(12, 'Данил', 'Дегтярев', 'dan@degt.ru', '$2y$13$tNNf.qUsU5GeTEkaEleUvOTbsYE3t0vNtzkTqZVllDGSFiPyQ.cM6', '2019-05-24 14:36:04', NULL, 1, 0, NULL, NULL, NULL),
(13, 'Владимир', 'Нестор', 'vlad@nest.ru', '$2y$13$tNNf.qUsU5GeTEkaEleUvOTbsYE3t0vNtzkTqZVllDGSFiPyQ.cM6', '2019-05-24 14:36:58', NULL, 2, 0, NULL, NULL, NULL),
(14, 'Андрей', 'Козлов', 'andr@koz.ru', '$2y$13$tNNf.qUsU5GeTEkaEleUvOTbsYE3t0vNtzkTqZVllDGSFiPyQ.cM6', '2019-05-24 14:38:29', NULL, 2, 0, NULL, NULL, NULL),
(15, 'Виктор', 'Дубровский', 'v@dub.ru', '$2y$13$tNNf.qUsU5GeTEkaEleUvOTbsYE3t0vNtzkTqZVllDGSFiPyQ.cM6', '2019-05-24 14:41:06', NULL, 3, 0, NULL, NULL, NULL),
(17, 'Александр', 'Паламарюк', 'al@pal.ru', '$2y$13$tNNf.qUsU5GeTEkaEleUvOTbsYE3t0vNtzkTqZVllDGSFiPyQ.cM6', '2019-05-24 14:41:59', NULL, 3, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_course`
--

CREATE TABLE IF NOT EXISTS `user_course` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `course_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-course-user` (`user_id`),
  KEY `idx-user-course` (`course_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Dumping data for table `user_course`
--

INSERT INTO `user_course` (`id`, `user_id`, `course_id`) VALUES
(17, 17, 16),
(18, 15, 12);

-- --------------------------------------------------------

--
-- Table structure for table `user_report`
--

CREATE TABLE IF NOT EXISTS `user_report` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `report_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-report-student` (`user_id`),
  KEY `idx-student-report` (`report_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `user_report`
--

INSERT INTO `user_report` (`id`, `user_id`, `report_id`) VALUES
(7, 6, 4),
(8, 6, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_task`
--

CREATE TABLE IF NOT EXISTS `user_task` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `grade` int(11) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `idx-user-task` (`task_id`),
  KEY `idx-task-student` (`student_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `user_task`
--

INSERT INTO `user_task` (`id`, `task_id`, `student_id`, `file`, `grade`, `date`) VALUES
(7, 40, 6, '3pechat.jpg', 10, '2019-05-25 08:02:25'),
(8, 40, 7, 'Kursovaya_Rabota.docx', 9, '2019-05-25 08:05:17');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chapter`
--
ALTER TABLE `chapter`
  ADD CONSTRAINT `fk-chapter-course` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `fk-chat-dialog-id` FOREIGN KEY (`dialog_id`) REFERENCES `dialog` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course`
--
ALTER TABLE `course`
  ADD CONSTRAINT `fk-course-tutor` FOREIGN KEY (`tutor_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_curator`
--
ALTER TABLE `course_curator`
  ADD CONSTRAINT `fk-course-curator` FOREIGN KEY (`curator_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-curator-course` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `course_group`
--
ALTER TABLE `course_group`
  ADD CONSTRAINT `fk-course-group` FOREIGN KEY (`group_id`) REFERENCES `gang` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-group-course` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `dialog`
--
ALTER TABLE `dialog`
  ADD CONSTRAINT `fk-dialog-student` FOREIGN KEY (`student_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-dialog-task` FOREIGN KEY (`task_id`) REFERENCES `task` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-dialog-tutor` FOREIGN KEY (`tutor_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invitation`
--
ALTER TABLE `invitation`
  ADD CONSTRAINT `fk-invitation-course` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-invitation-user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `lecture`
--
ALTER TABLE `lecture`
  ADD CONSTRAINT `fk-lecture-chapter` FOREIGN KEY (`chapter_id`) REFERENCES `chapter` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `report`
--
ALTER TABLE `report`
  ADD CONSTRAINT `fk-report-course` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `task`
--
ALTER TABLE `task`
  ADD CONSTRAINT `fk-task-chapter-id` FOREIGN KEY (`chapter_id`) REFERENCES `chapter` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk-user-group` FOREIGN KEY (`group_id`) REFERENCES `gang` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_course`
--
ALTER TABLE `user_course`
  ADD CONSTRAINT `fk-course-user` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-user-course` FOREIGN KEY (`course_id`) REFERENCES `course` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_report`
--
ALTER TABLE `user_report`
  ADD CONSTRAINT `fk-report-student` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-student-report` FOREIGN KEY (`report_id`) REFERENCES `report` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `user_task`
--
ALTER TABLE `user_task`
  ADD CONSTRAINT `fk-task-student` FOREIGN KEY (`student_id`) REFERENCES `user` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk-user-task` FOREIGN KEY (`task_id`) REFERENCES `task` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
