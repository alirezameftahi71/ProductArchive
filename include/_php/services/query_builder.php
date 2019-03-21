<?php include_once "../connect_db.php";?>
<?php include_once "../functions.php";?>
<?php include_once "../tempTable.php";?>
<?php
header("Content-Type: application/json; charset=UTF-8");

// getting the post body
$recievedJsonStr = file_get_contents('php://input');

if (!$recievedJsonStr) {
// check if there's any post body if not return temp_table column names
    $getAllFieldsQuery = "SHOW COLUMNS FROM $temp_table_name";
    $result = mysqli_query($conn, $getAllFieldsQuery);
    if (confirm_query_select($result)) {
        $json = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $json[] = array(
                'field' => $row['Field'],
                'type' => $row['Type']);
        }
        echo json_encode($json);
    }
} else {
// else get the body as object and make the search query
    $recievedJsonObj = json_decode($recievedJsonStr);

// making the search query
    $query = "SELECT * FROM $temp_table_name WHERE";
    $processIsRunning = true;
    $postObj = $recievedJsonObj;
    while ($processIsRunning) {
        if (is_numeric($postObj->value)) {
            if (strContains($postObj->mop, 'between')) {
                $query .= " $postObj->field $postObj->mop $postObj->valueFrom AND $postObj->valueTo";
            } else {
                $query .= " $postObj->field $postObj->mop $postObj->value";
            }
        } else {
            if (strContains($postObj->mop, 'like')) {
                $query .= " $postObj->field $postObj->mop '%$postObj->value%'";
            } else if (strContains($postObj->mop, 'between')) {
                $query .= " $postObj->field $postObj->mop '$postObj->valueFrom' AND '$postObj->valueTo'";
            } else {
                $query .= " $postObj->field $postObj->mop '$postObj->value'";
            }
        }
        if (isset($postObj->child) && $postObj->child) {
            $query .= " $postObj->cop";
            $postObj = $postObj->child;
        } else {
            $processIsRunning = false;
        }
    }

// execution of the search query
    $result = mysqli_query($conn, $query);
    if (confirm_query_select($result)) {
        $json = array();
        while ($row = mysqli_fetch_assoc($result)) {
            $json[] = array(
                'id' => $row['id'],
                'title' => $row['title'],
                'rate' => $row['rate'],
                'released_date' => $row['released_date'],
                'platform' => $row['platforms'],
                'genre' => $row['genres'],
                'publishers' => $row['publishers'],
                'description' => $row['description'],
                'completed' => $row['completed'],
            );
        }
        echo json_encode($json);
    }
}
?>
<?php include_once "../disconnect_db.php"; ?>
