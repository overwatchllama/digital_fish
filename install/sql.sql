CREATE USER 'digitalfish'@'%' IDENTIFIED BY 'digitalfish1$';
GRANT USAGE ON *.* TO 'digitalfish'@'%';
GRANT SELECT, EXECUTE, SHOW VIEW, ALTER, ALTER ROUTINE, CREATE, CREATE ROUTINE, CREATE TEMPORARY TABLES, CREATE VIEW, DELETE, DROP, EVENT, INDEX, INSERT, REFERENCES, TRIGGER, UPDATE, LOCK TABLES  ON `digitalfish`.* TO 'digitalfish'@'%';
FLUSH PRIVILEGES;
SHOW GRANTS FOR 'digitalfish'@'%';