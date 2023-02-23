CREATE DATABASE IF NOT EXISTS class;
CREATE USER 'antoine'@'localhost' IDENTIFIED BY 'ubuntu';
GRANT SELECT,INSERT,UPDATE,DELETE,CREATE,CREATE TEMPORARY TABLES,DROP,INDEX,ALTER ON class.* TO 'antoine'@'localhost';
USE class;
CREATE TABLE IF NOT EXISTS IA1501 (
  `id` INT(6) unsigned NOT NULL PRIMARY KEY,
  `fullname` text NOT NULL,
  `mark` FLOAT
);

CREATE TABLE IF NOT EXISTS IA1502 (
  `id` INT(6) unsigned NOT NULL PRIMARY KEY,
  `fullname` text NOT NULL,
  `mark` FLOAT
);


-- insert data in 2 tables above
INSERT INTO `IA1501` (`id`, `fullname`, `mark`) VALUES
(1, 'Antoine Nguyen', 8.5),
(2, 'Nam Tr', 9.5),
(3, 'Tran Vu', 8),
(4, 'DM Duc', 9);


INSERT INTO `IA1502` (`id`, `fullname`, `mark`) VALUES
(1, 'Tran Anh', 8.5),
(2, 'Nguyen Duc Anh', 9.5),
(3, 'Dang Tien Bip', 8)
