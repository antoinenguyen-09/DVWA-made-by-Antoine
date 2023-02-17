CREATE DATABASE IF NOT EXISTS class;
-- CREATE USER 'antoine'@'localhost' IDENTIFIED BY 'ubuntu';
-- GRANT SELECT,INSERT,UPDATE,DELETE,CREATE,CREATE TEMPORARY TABLES,DROP,INDEX,ALTER ON class.* TO 'antoine'@'localhost';
USE class;
CREATE TABLE IA1501 (
  id INT(6) unsigned NOT NULL PRIMARY KEY,
  fullname VARCHAR(30) NOT NULL,
  mark FLOAT
)

CREATE TABLE IA1502 (
  id INT(6) unsigned NOT NULL PRIMARY KEY,
  fullname VARCHAR(30) NOT NULL,
  mark FLOAT
)

-- insert data in 2 tables above
