<?php include_once "../connect_db.php";?>
<?php include_once "../functions.php";?>
<?php
$select_query = 'SELECT COUNT(game.title) as YValue, YEAR(game.released_date) AS DimX FROM game group by DimX order by DimX;';
// $select_query = 'SELECT COUNT(game.title) as YValue, genre.name as DimX FROM `game` INNER JOIN `game_genre` ON game.id = game_genre.game_id INNER JOIN `genre` ON game_genre.genre_id = genre.id GROUP BY genre.name ORDER BY YValue;';
// $select_query = 'SELECT game.rate as YValue, game.title as DimX FROM `game` ORDER BY YValue;';
$result = mysqli_query($conn, $select_query);
if (confirm_query_select($result)) {
    $json = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $json[] = array(
            $row['DimX'], (int)$row['YValue']
        );
    }
    echo json_encode($json);
}
?>
<?php include_once "../disconnect_db.php";