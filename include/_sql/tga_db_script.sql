/*
 * Alireza Meftahi
 * THE GAME ARCHIVE DATABASE
*/

-- Database creation
DROP DATABASE IF EXISTS tga_db;
CREATE DATABASE tga_db;
USE tga_db;

-- Tables creation
CREATE TABLE platform(
	id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name varchar(200) NOT NULL
);

CREATE TABLE genre(
	id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name varchar(200) NOT NULL
);

CREATE TABLE publisher(
	id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	name varchar(100) NOT NULL
);

CREATE TABLE game(
	id int NOT NULL AUTO_INCREMENT PRIMARY KEY,
	title varchar(200) NOT NULL,
	released_date date,
	rate float,
	description text
);

CREATE TABLE game_platform(
	game_id int REFERENCES game(id),
	platform_id int REFERENCES platform(id)
);

CREATE TABLE game_genre(
	game_id int REFERENCES game(id),
	genre_id int REFERENCES genre(id)
);

CREATE TABLE game_publisher(
	game_id int REFERENCES game(id),
	publisher_id int REFERENCES publisher(id)
);

-- Table insertion
INSERT INTO genre(name) VALUES
	('Horror'),
	('Action'),
	('First-Person');

INSERT INTO platform(name) VALUES
	('Windows'),
	('X-Box'),
	('PS3');

INSERT INTO publisher(name) VALUES
	('Bethesda'),
	('Activision'),
	('Conamy');

INSERT INTO game(title, released_date, rate, description) VALUES
	('Resident Evil 7', STR_TO_DATE('03-05-2017', '%d-%m-%Y'), 4, "Pretty Scary");

INSERT INTO game_publisher VALUES 
	(1,3);

INSERT INTO game_platform VALUES
	(1,1);

INSERT INTO game_genre VALUES
	(1,1);

INSERT INTO game(title, released_date, rate, description) VALUES
	('Modern Warfare 3', STR_TO_DATE('25-10-2013', '%d-%m-%Y'), 3.5, "War... War never changes...");

INSERT INTO game_publisher VALUES 
	(2,2);

INSERT INTO game_platform VALUES
	(2,1);

INSERT INTO game_genre VALUES
	(2,3),
	(2,2);