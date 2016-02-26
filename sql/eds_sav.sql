-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.5.27 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2012-10-01 23:58:36
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping database structure for eds_sav


/*
-- Dumping structure for procedure eds_sav.add_issue
DROP PROCEDURE IF EXISTS `add_issue`;
DELIMITER //
CREATE DEFINER=`eds_sav`@`%` PROCEDURE `add_issue`(IN p_client_id INT, IN p_subject VARCHAR(1000), IN p_issue TEXT)
    COMMENT 'Вставка запроса'
BEGIN
  INSERT INTO tbl_issue (issue_subject, client_id) VALUES (p_subject, p_client_id);
  
END//
DELIMITER ;
*/


-- Dumping structure for table eds_sav.tbl_issue
DROP TABLE IF EXISTS `tbl_issue`;
CREATE TABLE IF NOT EXISTS `tbl_issue` (
  `issue_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `issue_subject` varchar(1000) NOT NULL COMMENT 'Тема',
  `client_id` int(11) NOT NULL COMMENT 'FK Клиент',
  `support_id` int(11) DEFAULT NULL COMMENT 'FK issue',
  `status_id` int(11) NOT NULL DEFAULT '1' COMMENT 'FK Состояние запроса',
  `issue_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата запроса',
  `is_closed` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Открыт/закрыт',
  `close_date` timestamp NULL DEFAULT NULL COMMENT 'Дата закрытия',
  `is_changed` tinyint(1) NOT NULL DEFAULT 0 COMMENT 'Флаг при открытии темы',
  PRIMARY KEY (`issue_id`),
  KEY `idx_client` (`issue_id`,`client_id`),
  KEY `idx_support` (`issue_id`,`support_id`),
  KEY `fk_status` (`status_id`),
  KEY `fk_client` (`client_id`),
  KEY `fk_support` (`support_id`),
  CONSTRAINT `fk_client` FOREIGN KEY (`client_id`) REFERENCES `tbl_user` (`user_id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_status` FOREIGN KEY (`status_id`) REFERENCES `tbl_status` (`status_id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_support` FOREIGN KEY (`support_id`) REFERENCES `tbl_user` (`user_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='Обращение (запрос) клиента в поддержку\r\n';

-- Dumping data for table eds_sav.tbl_issue: ~1 rows (approximately)
DELETE FROM `tbl_issue`;
/*!40000 ALTER TABLE `tbl_issue` DISABLE KEYS */;
INSERT INTO `tbl_issue` (`issue_id`, `issue_subject`, `client_id`, `support_id`, `status_id`, `issue_date`, `is_closed`, `close_date`, `is_changed`) VALUES
	(1, 'Тест', 1, 2, 2, '2012-09-24 18:08:25', 0, NULL, 0);
/*!40000 ALTER TABLE `tbl_issue` ENABLE KEYS */;


-- Dumping structure for table eds_sav.tbl_message
DROP TABLE IF EXISTS `tbl_message`;
CREATE TABLE IF NOT EXISTS `tbl_message` (
  `msg_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `msg_text` text NOT NULL COMMENT 'Текст сообщения',
  `user_id` int(11) NOT NULL COMMENT 'FK Пользователь',
  `msg_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Дата сообщения',
  `issue_id` int(11) NOT NULL COMMENT 'FK Запрос',
  PRIMARY KEY (`msg_id`),
  KEY `fk_tbl_user_idx` (`user_id`),
  KEY `fk_tbl_issue_idx` (`issue_id`),
  KEY `idx_msg_user` (`user_id`,`issue_id`,`msg_date`,`msg_id`),
  CONSTRAINT `fk_tbl_issue` FOREIGN KEY (`issue_id`) REFERENCES `tbl_issue` (`issue_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_tbl_user` FOREIGN KEY (`user_id`) REFERENCES `tbl_user` (`user_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='message по запросу';

-- Dumping data for table eds_sav.tbl_message: ~2 rows (approximately)
DELETE FROM `tbl_message`;
/*!40000 ALTER TABLE `tbl_message` DISABLE KEYS */;
INSERT INTO `tbl_message` (`msg_id`, `msg_text`, `user_id`, `msg_date`, `issue_id`) VALUES
	(1, 'Проверка связи', 1, '2012-09-24 18:09:55', 1),
	(2, 'Все нормально', 2, '2012-09-24 18:10:28', 1);
/*!40000 ALTER TABLE `tbl_message` ENABLE KEYS */;


-- Dumping structure for table eds_sav.tbl_role
DROP TABLE IF EXISTS `tbl_role`;
CREATE TABLE IF NOT EXISTS `tbl_role` (
  `role_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `name` varchar(100) NOT NULL COMMENT 'Название роли',
  PRIMARY KEY (`role_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='role пользователя';

-- Dumping data for table eds_sav.tbl_role: ~3 rows (approximately)
DELETE FROM `tbl_role`;
/*!40000 ALTER TABLE `tbl_role` DISABLE KEYS */;
INSERT INTO `tbl_role` (`role_id`, `name`) VALUES
	(1, 'User'),
	(2, 'Support'),
	(3, 'Administrator');
/*!40000 ALTER TABLE `tbl_role` ENABLE KEYS */;


-- Dumping structure for table eds_sav.tbl_status
DROP TABLE IF EXISTS `tbl_status`;
CREATE TABLE IF NOT EXISTS `tbl_status` (
  `status_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `name` varchar(100) NOT NULL COMMENT 'Название',
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='Состояние запроса';

-- Dumping data for table eds_sav.tbl_status: ~4 rows (approximately)
DELETE FROM `tbl_status`;
/*!40000 ALTER TABLE `tbl_status` DISABLE KEYS */;
INSERT INTO `tbl_status` (`status_id`, `name`) VALUES
	(1, 'not open'),
	(2, 'open'),
	(3, 'close');
--	(4, 'Решено поддержкой'),
--	(5, 'Решено самостоятельно'),
--	(6, 'Не решено');
/*!40000 ALTER TABLE `tbl_status` ENABLE KEYS */;


-- Dumping structure for table eds_sav.tbl_user
DROP TABLE IF EXISTS `tbl_user`;
CREATE TABLE IF NOT EXISTS `tbl_user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'PK',
  `login` varchar(100) NOT NULL COMMENT 'login',
  `is_active` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Активен/Неактивен',
  `password` varchar(100) DEFAULT NULL COMMENT 'password',
  `role_id` int(11) NOT NULL DEFAULT '1' COMMENT 'FK role',
  `full_name` varchar(1000) DEFAULT NULL COMMENT 'nick пользователя',
  PRIMARY KEY (`user_id`),
  KEY `fk_tbl_role_idx` (`role_id`),
  CONSTRAINT `fk_tbl_role` FOREIGN KEY (`role_id`) REFERENCES `tbl_role` (`role_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='user';

-- Dumping data for table eds_sav.tbl_user: ~4 rows (approximately)
DELETE FROM `tbl_user`;
/*!40000 ALTER TABLE `tbl_user` DISABLE KEYS */;
INSERT INTO `tbl_user` (`user_id`, `login`, `is_active`, `password`, `role_id`, `full_name`) VALUES
	(1, 'user', 1, '48efc4851e15940af5d477d3c0ce99211a70a3be', 1, NULL),
	(2, 'support', 1, '48efc4851e15940af5d477d3c0ce99211a70a3be', 2, NULL),
	(3, 'admin', 1, '48efc4851e15940af5d477d3c0ce99211a70a3be', 3, NULL);
/*!40000 ALTER TABLE `tbl_user` ENABLE KEYS */;

/*
-- Dumping structure for view eds_sav.v_issue
DROP VIEW IF EXISTS `v_issue`;
-- Creating temporary table to overcome VIEW dependency errors
CREATE TABLE `v_issue` (
	`issue_id` INT(11) NOT NULL DEFAULT '0' COMMENT 'PK',
	`issue_subject` VARCHAR(1000) NOT NULL COMMENT 'Тема' COLLATE 'utf8_general_ci',
	`client_id` INT(11) NOT NULL COMMENT 'FK Клиент',
	`support_id` INT(11) NULL DEFAULT NULL COMMENT 'FK issue',
	`status_id` INT(11) NOT NULL DEFAULT '1' COMMENT 'FK Состояние запроса',
	`status_name` VARCHAR(100) NULL DEFAULT NULL COMMENT 'Название' COLLATE 'utf8_general_ci',
	`issue_date` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Дата запроса',
	`is_closed` TINYINT(1) NOT NULL DEFAULT '0' COMMENT 'Открыт/закрыт',
	`close_date` TIMESTAMP NULL DEFAULT NULL COMMENT 'Дата закрытия',
	`client_login` VARCHAR(100) NULL DEFAULT NULL COMMENT 'login' COLLATE 'utf8_general_ci',
	`client_name` TEXT NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`support_login` VARCHAR(100) NULL DEFAULT NULL COMMENT 'login' COLLATE 'utf8_general_ci',
	`support_name` TEXT NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`last_date` TIMESTAMP NULL DEFAULT NULL COMMENT 'Дата сообщения'
) ENGINE=MyISAM;
*/

-- Creating temporary table to overcome VIEW dependency errors
CREATE OR REPLACE VIEW `v_message` as select
	`i`.`issue_id`,
	`i`.`issue_subject`,
	`i`.`issue_date`,
	`i`.`client_id`,
	`i`.`support_id`,		
	`m`.`msg_id`,
	`m`.`msg_text`,
	`m`.`msg_date`,
	`m`.`user_id`,
	`u`.`login` as 'user_login',
	ifnull(`u`.`full_name`, `u`.`login`) as 'user_name',
	`uc`.`login` as 'client_login',
	ifnull(`uc`.`full_name`, `uc`.`login`) as 'client_name',
	`us`.`login` as 'support_login',
	ifnull(`us`.`full_name`, `us`.`login`) as 'support_name'	
from 
					`tbl_issue`	`i` 
		left join	`tbl_message`	`m`		on (`i`.`issue_id`	= `m`.`issue_id`) 
		left join	`tbl_user`		`u`	on (`u`.`user_id`	= `m`.`user_id`)
		left join	`tbl_user`		`uc`	on (`uc`.`user_id`	= `i`.`client_id`)
		left join	`tbl_user`		`us`	on (`us`.`user_id`	= `i`.`support_id`);


-- Creating temporary table to overcome VIEW dependency errors
CREATE OR REPLACE ALGORITHM=UNDEFINED VIEW `v_user` as select
	`u`.`user_id`,
	`u`.`login`,
	`u`.`password`,
	`u`.`full_name`,
	`r`.`role_id`,
	`r`.name as `role_name`,
	`u`.`is_active`
from
	`tbl_user` `u` inner join `tbl_role` `r` on(`u`.`role_id` = `r`.`role_id`);

-- Dumping structure for view eds_sav.v_last_message
CREATE OR REPLACE ALGORITHM=UNDEFINED VIEW `v_last_message` AS select 
	`m`.`issue_id` AS `issue_id`,
	max(`m`.`msg_date`) AS `last_date`
from 
	`tbl_message` `m` group by `m`.`issue_id`;


-- Dumping structure for view eds_sav.v_issue
CREATE OR REPLACE ALGORITHM=UNDEFINED VIEW `v_issue` AS select 
	`i`.`issue_id` AS `issue_id`,
	`i`.`issue_subject` AS `issue_subject`,
	`i`.`client_id` AS `client_id`,
	`i`.`support_id` AS `support_id`,
	`i`.`status_id` AS `status_id`,
	`st`.`name` AS `status_name`,
	`i`.`issue_date` AS `issue_date`,
	`i`.`is_closed` AS `is_closed`,
	`i`.`close_date` AS `close_date`,
	`c`.`login` AS `client_login`,
	ifnull(`c`.`full_name`,`c`.`login`) AS `client_name`,
	`s`.`login` AS `support_login`,
	ifnull(`s`.`full_name`,`s`.`login`) AS `support_name`,
	`lm`.`last_date` AS `last_date`,
	`i`.`is_changed` AS `is_changed`
from ((((`tbl_issue` `i` left join `tbl_user` `c` on((`i`.`client_id` = `c`.`user_id`))) left join `tbl_user` `s` on((`i`.`support_id` = `s`.`user_id`))) left join `tbl_status` `st` on((`i`.`status_id` = `st`.`status_id`))) left join `v_last_message` `lm` on((`i`.`issue_id` = `lm`.`issue_id`)));