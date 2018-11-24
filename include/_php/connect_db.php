<?php
// Connect to the database
define("DB_SERVER", "localhost");
define("DB_USER", "root");
define("DB_PASS", "admin");
define("DB_NAME", "tga_db");
$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
if (mysqli_connect_errno()) {
    die("<b class='fail'>Database Connection failed: " .
        mysqli_connect_error() .
        " (" . mysqli_connect_errno() . ")</b>"
    );
}
