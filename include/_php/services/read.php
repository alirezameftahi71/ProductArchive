<?php include_once "../connect_db.php";?>
<?php include_once "../functions.php";?>
<?php
$select_query = "SELECT DISTINCT game.id, game.title, game.released_date, game.rate, game.description, ";
if (isset($_GET['id'])) {
    $select_query .= "game.cover_pic, ";
}

$select_query .= "GROUP_CONCAT(DISTINCT genre.name SEPARATOR ', ') AS genres,
                GROUP_CONCAT(DISTINCT platform.name SEPARATOR ', ') AS platforms,
                GROUP_CONCAT(DISTINCT publisher.name SEPARATOR ', ') AS publishers
                    FROM game
                        INNER JOIN game_genre
                        ON game.id = game_genre.game_id
                            INNER JOIN genre
                            ON game_genre.genre_id = genre.id
                                INNER JOIN game_platform
                                ON game.id = game_platform.game_id
                                    INNER JOIN platform
                                    ON game_platform.platform_id = platform.id
                                        INNER JOIN game_publisher
                                        ON game.id = game_publisher.game_id
                                            INNER JOIN publisher
                                            ON game_publisher.publisher_id = publisher.id ";
if (isset($_GET['id'])) {
    $select_query .= "WHERE game.id = $_GET[id] ";
}

$select_query .= "GROUP BY game.id;";

$result = mysqli_query($conn, $select_query);
if (confirm_query_select($result)) {
    $json = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $cover_pic = null;
        if (isset($_GET['id']) && $row['cover_pic'] != null) {
            $cover_pic = base64_encode($row['cover_pic']);
        }

        $json[$row['id']] = array(
            'title' => $row['title'],
            'released_date' => $row['released_date'],
            'rate' => $row['rate'],
            'genres' => $row['genres'],
            'platforms' => $row['platforms'],
            'publishers' => $row['publishers'],
            'description' => $row['description'],
            'cover_pic' => $cover_pic,
        );
    }
    echo json_encode($json);
}
?>
<?php include_once "../disconnect_db.php";
