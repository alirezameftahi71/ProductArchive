USE `tga_db`;
ALTER TABLE `game`
ADD `completed` tinyint(1);

UPDATE `game` SET `completed` = 0;