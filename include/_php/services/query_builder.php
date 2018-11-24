<?php include_once "../connect_db.php";?>
<?php include_once "../functions.php";?>
<?php

$make_temp_table = <<<SQL
CREATE TEMPORARY TABLE all_fields
SELECT game.id AS id, game.title AS title, game.rate AS rate, 
game.released_date AS released_date, game.description AS description, 
GROUP_CONCAT(DISTINCT genre.name SEPARATOR ', ') AS genres, 
GROUP_CONCAT(DISTINCT platform.name SEPARATOR ', ') AS platforms, 
GROUP_CONCAT(DISTINCT publisher.name SEPARATOR ', ') AS publishers 
FROM game 
INNER JOIN game_genre ON game.id = game_genre.game_id 
INNER JOIN genre ON genre.id = game_genre.genre_id 
INNER JOIN game_platform ON game.id = game_platform.game_id 
INNER JOIN platform ON platform.id = game_platform.platform_id 
INNER JOIN game_publisher ON game.id = game_publisher.game_id 
INNER JOIN publisher ON publisher.id = game_publisher.publisher_id 
GROUP BY game.id;
SQL;

mysqli_query($conn, $make_temp_table);

$get_columns = <<< SQL
SHOW COLUMNS FROM all_fields;
SQL;

$result = mysqli_query($conn, $get_columns);

if (confirm_query_select($result)) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo $row['Field'] . '<br />';
    }
}
?>
<?php include_once "../disconnect_db.php";