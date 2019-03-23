<?php include_once "../../connect_db.php";?>
<?php include_once "../../functions.php";?>
<?php
header("Content-Type: application/json; charset=UTF-8");
// getting the post body
$recievedJsonStr = file_get_contents('php://input');
if ($recievedJsonStr) {
    $recievedJsonObj = json_decode($recievedJsonStr);
    $jsonQuery = json_encode($recievedJsonObj->query);
    $titleQuery = $recievedJsonObj->name;

    $insert_game = "INSERT INTO `query`(`title`, `jsonQuery`) VALUES('$titleQuery', '$jsonQuery')";
    if (mysqli_query($conn, $insert_game)) {
        echo json_encode("Query " . $titleQuery . " Saved Successfully.");
    }
} else {
    echo json_encode("No Data Recieved!");
}

?>
<?php include_once "../../disconnect_db.php";
