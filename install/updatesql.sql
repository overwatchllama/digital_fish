USE digitalfish;
ALTER TABLE `inhab_species`
	ADD COLUMN `latin` VARCHAR(50) NULL AFTER `name`;
