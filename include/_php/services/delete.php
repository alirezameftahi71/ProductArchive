<?php include_once "../connect_db.php";?>
<?php include_once "../functions.php";?>
<?php
if (isset($_GET['id'])) {
    if (mysqli_query($conn, "DELETE FROM `game` WHERE id = $_GET[id];")) {
        if (mysqli_query($conn, "DELETE FROM `game_genre` WHERE game_id = $_GET[id];")) {
            if (mysqli_query($conn, "DELETE FROM `game_platform` WHERE game_id = $_GET[id];")) {
                if (mysqli_query($conn, "DELETE FROM `game_publisher` WHERE game_id = $_GET[id];")) {
                    if (deleteFile("$_GET[id]", "../../../resource/_img/")) {
                        echo "Product Successfully removed.";
                    } else {
                        echo "Remove failed.";
                    }
                } else {
                    echo "Remove failed.";
                }
            } else {
                echo "Remove failed.";
            }
        } else {
            echo "Remove failed.";
        }
    } else {
        echo "Remove failed.";
    }

}
?>
<?php include_once "../disconnect_db.php"; ?>
