<?php include_once "../connect_db.php";?>
<?php include_once "../functions.php";?>
<?php
$select_query = "SELECT * FROM platform ";
if ($_GET['query']) {
    $select_query .= "WHERE name LIKE '%" . $_GET['query'] . "%';";
}

$result = mysqli_query($conn, $select_query);
if ($result) {
    $json = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $json[$row['id']] = array(
            'name' => $row['name'],
        );
    }
    echo json_encode((object) $json);
}
?>
<?php include_once "../disconnect_db.php";
