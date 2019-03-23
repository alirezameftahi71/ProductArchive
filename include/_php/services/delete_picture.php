<?php include_once "../connect_db.php";?>
<?php
if (isset($_GET['id'])) {
    $query = "UPDATE `game` SET cover_pic = NULL WHERE id=" . $_GET['id'];
    if (mysqli_query($conn, $query)) {
        echo "Picture Successfully Removed!";
    } else {
        echo "Failed to Remove the Picture.";
    }
}
?>
<?php include_once "../disconnect_db.php"; ?>
