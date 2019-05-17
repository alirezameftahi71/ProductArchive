<?php require_once "../../model/product.php"; ?>

<?php
header('Content-Type: application/json');
function read_one($id)
{
    $product = new Product();
    $item = $product->find_by_id($id);
    $json[] = array(
        'id' => $item->id,
        'title' => $item->title,
        'released_date' => $item->released_date,
        'rate' => $item->rate,
        'genres' => $item->genres,
        'platforms' => $item->platforms,
        'publishers' => $item->publishers,
        'description' => $item->description,
        'completed' => $item->completed,
        'cover_pic' => base64_encode($item->cover_pic),
    );
    $res = json_encode($json);
    return $res;
}

function read_all()
{
    $product = new Product();
    $result_set = $product->find_all();
    $json = array();
    foreach ($result_set as $item) {
        $json[] = array(
            'id' => $item->id,
            'title' => $item->title,
            'released_date' => $item->released_date,
            'rate' => $item->rate,
            'genres' => $item->genres,
            'platforms' => $item->platforms,
            'publishers' => $item->publishers,
            'description' => $item->description,
            'completed' => $item->completed,
        );
    }
    $res = json_encode($json);
    return $res;
}

if (isset($_GET['id'])) {
    echo read_one($_GET['id']);
} else {
    echo read_all();
}

?>