<?php include_once "../connect_db.php";?>
<?php include_once "../functions.php";?>
<?php
// Validation and getting the values
$product_id = $title = $released_date = $rate = $genre = $platform = $publisher = $desc_box = null;
$product_id = $_GET["id"];
$title = empty($_POST["title"]) ? null : test_input($conn, $_POST["title"]);
$released_date = empty($_POST["released-date"]) ? null : test_input($conn, $_POST["released-date"]);
$released_date = ($released_date != null) ? date("m-d-Y", strtotime($released_date)) : 'null';
$rate = empty($_POST["rate"]) ? 'null' : $_POST["rate"];
$genre = empty($_POST["hidden-genre"]) ? null : test_input($conn, $_POST["hidden-genre"]);
$platform = empty($_POST["hidden-platform"]) ? null : test_input($conn, $_POST["hidden-platform"]);
$publisher = empty($_POST["hidden-publisher"]) ? null : test_input($conn, $_POST["hidden-publisher"]);
$desc_box = empty($_POST["desc-box"]) ? null : test_input($conn, $_POST["desc-box"]);
$genres = explode(',', $genre);
$platforms = explode(',', $platform);
$publishers = explode(',', $publisher);
$ids = $genre_ids = $publisher_ids = $platform_ids = [];

// Update of product
$update_game = "UPDATE `game` SET
                    title = '$title',
                    released_date = STR_TO_DATE('$released_date', '%m-%d-%Y'),
                    rate = $rate,
                    description = '$desc_box'
                WHERE game.id = $product_id";
mysqli_query($conn, $update_game);

// Insertion of genres
foreach ($genres as $genre) {
    // Check if the genre already exists
    $search_genre = "SELECT * FROM `genre` WHERE `name`='$genre' LIMIT 1";
    $match_genre = mysqli_query($conn, $search_genre);
    // Insert if not exist
    if (mysqli_num_rows($match_genre) == 0) {
        $insert_genre = "INSERT INTO `genre`(name) VALUES('$genre');";
        if (mysqli_query($conn, $insert_genre)) {
            array_push($genre_ids, mysqli_insert_id($conn));
        }
    } else {
        $row = mysqli_fetch_assoc($match_genre);
        array_push($genre_ids, $row['id']);
    }
}
$ids['genres'] = $genre_ids;

// Insertion of platforms
foreach ($platforms as $platform) {
    // Check if the platform already exists
    $search_platform = "SELECT * FROM `platform` WHERE `name`='$platform' LIMIT 1";
    $match_platform = mysqli_query($conn, $search_platform);
    // Insert if not exist
    if (mysqli_num_rows($match_platform) == 0) {
        $insert_platform = "INSERT INTO `platform`(name) VALUES('$platform');";
        if (mysqli_query($conn, $insert_platform)) {
            array_push($platform_ids, mysqli_insert_id($conn));
        }

    } else {
        $row = mysqli_fetch_assoc($match_platform);
        array_push($platform_ids, $row['id']);
    }
}
$ids['platforms'] = $platform_ids;

// Insertion of publishers
foreach ($publishers as $publisher) {
    // Check if the publisher already exists
    $search_publisher = "SELECT * FROM `publisher` WHERE `name`='$publisher' LIMIT 1";
    $match_publisher = mysqli_query($conn, $search_publisher);
    // Insert if not exist
    if (mysqli_num_rows($match_publisher) == 0) {
        $insert_publisher = "INSERT INTO `publisher`(name) VALUES('$publisher');";
        if (mysqli_query($conn, $insert_publisher)) {
            array_push($publisher_ids, mysqli_insert_id($conn));
        }

    } else {
        $row = mysqli_fetch_assoc($match_publisher);
        array_push($publisher_ids, $row['id']);
    }
}
$ids['publishers'] = $publisher_ids;

// Delete all previous genre relations
$delete_all_genre_relations = "DELETE FROM `game_genre` WHERE `game_id`=$product_id;";
mysqli_query($conn, $delete_all_genre_relations);
// Insert game_genre table
foreach ($ids['genres'] as $id) {
    $update_game_genre = "INSERT INTO `game_genre`(game_id, genre_id) VALUES($product_id, $id);";
    mysqli_query($conn, $update_game_genre);
}

// Delete all previous platform relations
$delete_all_platform_relations = "DELETE FROM `game_platform` WHERE `game_id`=$product_id;";
mysqli_query($conn, $delete_all_platform_relations);
// Insert game_platform table
foreach ($ids['platforms'] as $id) {
    $update_game_platform = "INSERT INTO `game_platform`(game_id, platform_id) VALUES($product_id, $id);";
    mysqli_query($conn, $update_game_platform);
}

// Delete all previous publisher relations
$delete_all_publisher_relations = "DELETE FROM `game_publisher` WHERE `game_id`=$product_id;";
mysqli_query($conn, $delete_all_publisher_relations);
// Insert game_publisher table
foreach ($ids['publishers'] as $id) {
    $update_game_publisher = "INSERT INTO `game_publisher`(game_id, publisher_id) VALUES($product_id, $id);";
    mysqli_query($conn, $update_game_publisher);
}

// Send the id of inserted game
echo $product_id;
?>
<?php include_once "../disconnect_db.php";
