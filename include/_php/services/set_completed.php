<?php include_once "../connect_db.php";?>
<?php include_once "../functions.php";?>
<?php
if (isset($_GET['id'])) {
    $val = isset($_GET['done']) ? $_GET['done'] == 'true' ? 1 : 0 : 0;
    $update_query = "UPDATE game SET completed = $val WHERE id = $_GET[id];";
    mysqli_query($conn, $update_query);
}

?>
<?php include_once "../disconnect_db.php";
