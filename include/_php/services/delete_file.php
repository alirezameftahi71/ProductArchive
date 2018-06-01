<?php include_once "../functions.php";?>
<?php
if (deleteFile("$_GET[id]", "../../../resource/_img/")) {
    echo "Picture Successfully Removed!";
} else {
    echo "Failed to Remove the Picture.";
}
?>