<?php include_once "../connect_db.php";?>
<?php
$file = empty($_FILES['file']) ? null : $_FILES['file'];
if (!empty($file)) {
    $file = addslashes(file_get_contents($file['tmp_name']));
    $query = "UPDATE `game` SET `cover_pic`= '$file' WHERE id=" . $_GET['id'];
    if (mysqli_query($conn, $query)) {
        echo "Successfully Added.";
    } else {
        echo mysqli_error($conn);
    }

} else {
    echo "Successfully Added.";
}

?>
<?php include_once "../disconnect_db.php"; ?>
