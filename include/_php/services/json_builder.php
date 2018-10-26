<?php include_once "../connect_db.php";?>
<?php include_once "../functions.php";?>
<?php
$select_query = 'SELECT COUNT(game.title) as g_count, YEAR(game.released_date) AS released_year FROM game group by released_year order by released_year;';
$result = mysqli_query($conn, $select_query);
if (confirm_query_select($result)) {
    $json = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $json[] = array(
            $row['released_year'], (int)$row['g_count']
        );
    }
    echo json_encode($json);
}
?>
<?php include_once "../disconnect_db.php";