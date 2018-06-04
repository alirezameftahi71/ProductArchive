<?php
$target_path = "../../../resource/_img/";
$file = empty($_FILES['file']) ? null : $_FILES['file'];
if (0 < $file['error']) {
    echo 'Error: ' . $file['error'];
} else {
    $path = $file['name'];
    //$ext = pathinfo($path, PATHINFO_EXTENSION);
    move_uploaded_file($file['tmp_name'], $target_path . $_GET['id']/* . '.' . $ext*/);
    echo "Successfully Added.";
}
