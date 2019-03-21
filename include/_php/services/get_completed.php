<?php include_once "../connect_db.php";?>
<?php include_once "../functions.php";?>
<?php
if (isset($_GET['id'])) {
    $select_query = "SELECT game.completed FROM game WHERE id = $_GET[id] LIMIT 1;";
    $result = mysqli_query($conn, $select_query);
    if (confirm_query_select($result)) {
        $row = mysqli_fetch_assoc($result);
        echo $row['completed'];
    }
}
?>
<?php include_once "../disconnect_db.php"; ?>
