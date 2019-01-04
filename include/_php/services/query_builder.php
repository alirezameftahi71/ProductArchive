<?php include_once "../connect_db.php";?>
<?php include_once "../functions.php";?>
<?php
header("Content-Type: application/json; charset=UTF-8");

// prep query of temp table
$temp_table_name = "all_fields";
$make_temp_table = <<<SQL
CREATE TEMPORARY TABLE $temp_table_name
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

// making the temp table
mysqli_query($conn, $make_temp_table);

// getting the post body
$recievedJsonStr = file_get_contents('php://input');

if (!$recievedJsonStr) {
// check if there's any post body if not return temp_table column names
    $getAllFieldsQuery = "SHOW COLUMNS FROM $temp_table_name";
    $result = mysqli_query($conn, $getAllFieldsQuery);
    if (confirm_query_select($result)) {
        $json = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $json[] = $row['Field'];
        }
        echo json_encode($json);
    }
} else { 
// else get the body as object and make the search query
    $recievedJsonObj = json_decode($recievedJsonStr);

// making the search query
    $query = "SELECT * FROM $temp_table_name WHERE";
    $processIsRunning = true;
    $postObj = $recievedJsonObj;
    while ($processIsRunning) {
        if (is_numeric($postObj->value)) {
            $query .= " $postObj->field $postObj->mop $postObj->value";
        } else {
            $query .= " $postObj->field $postObj->mop \"%$postObj->value%\"";
        }
        if ($postObj->child) {
            $query .= " $postObj->cop";
            $postObj = $postObj->child;
        } else {
            $processIsRunning = false;
        }
    }

// execution of the search query
    $result = mysqli_query($conn, $query);
    if (confirm_query_select($result)) {
        $json = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $json[] = array(
                'id' => $row['id'],
                'title' => $row['title'],
                'rate' => $row['rate'],
                'released_date' => $row['released_date'],
                'platform' => $row['platforms'],
                'genre' => $row['genres'],
                'publishers' => $row['publishers'],
                'description' => $row['description'],
            );
        }
        echo json_encode($json);
    }
}
?>
<?php include_once "../disconnect_db.php";
