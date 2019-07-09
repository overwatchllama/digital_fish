USE `digitalfish`;
ALTER TABLE `thermconfig`
	CHANGE COLUMN `current_therm` `current_therm` FLOAT NOT NULL AFTER `serialnumber`;
