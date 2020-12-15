--
-- Creating a small Book table.
-- Create a database and a user having access to this database,
-- this must be done by hand, se commented rows on how to do it.
--



--
-- Create a database for test
--
DROP DATABASE anaxdb;
CREATE DATABASE IF NOT EXISTS anaxdb;
USE anaxdb;

--
-- Create a database user for the test database
-- CREATE USER IF NOT EXISTS 'anax'@'%'
-- IDENTIFIED BY 'anax'
--;
-- GRANT ALL PRIVILEGES
--     ON anaxdb.*
--     TO 'anax'@'%'
-- ;



-- Ensure UTF8 on the database connection
SET NAMES utf8;



--
-- Table Book
--
DROP TABLE IF EXISTS Book;
CREATE TABLE Book (
    `id` INTEGER PRIMARY KEY AUTO_INCREMENT NOT NULL,
    `title` VARCHAR(80) NOT NULL,
    `author` VARCHAR(80) NOT NULL
) ENGINE INNODB CHARACTER SET utf8 COLLATE utf8_swedish_ci;
