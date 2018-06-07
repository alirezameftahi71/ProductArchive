<?php include_once "../connect_db.php";?>
<?php
$file = empty($_FILES['file']) ? null : $_FILES['file'];
if (0 < $file['error']) {
    echo 'Error: ' . $file['error'];
} else {
    $file = addslashes(file_get_contents($file['tmp_name']));
    $query = "UPDATE `game` SET `cover_pic`= '$file' WHERE id=" . $_GET['id'];
    if(mysqli_query($conn, $query))
        echo "Successfully Added.";
    else
        echo "Failed to Add.";
}
?>
<?php include_once "../disconnect_db.php";