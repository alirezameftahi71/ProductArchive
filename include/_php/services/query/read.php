<?php include_once "../../connect_db.php";?>
<?php include_once "../../functions.php";?>
<?php
$getSorted = false;
$select_query = "SELECT query.id, query.title, query.jsonQuery FROM query";
if (isset($_GET['id'])) {
    $select_query .= " WHERE query.id = $_GET[id]";
}
if ($getSorted) {
    $select_query .= " ORDER BY query.title";
}
$select_query .= ";";

$result = mysqli_query($conn, $select_query);
if (confirm_query_select($result)) {
    $json = array();
    while ($row = mysqli_fetch_assoc($result)) {
        $json[] = array(
            'id' => $row['id'],
            'title' => $row['title'],
            'jsonQuery' => $row['jsonQuery']
        );
    }
    echo json_encode($json);
}
?>
<?php include_once "../../disconnect_db.php";
