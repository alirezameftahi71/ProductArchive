USE `tga_db`;
ALTER TABLE `game`
ADD `completed` tinyint(1);

UPDATE `game` SET `completed` = 0;

CREATE TABLE `query`(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    jsonQuery TEXT,
    title varchar(20)
);