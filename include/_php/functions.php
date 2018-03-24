<?php

    // Test the query can be executed
    function confirm_query_select($result_set) {
        if (!$result_set || mysqli_num_rows($result_set) == 0) {
            echo "<br><b class='fail'>Database query failed.</b>";
            return false;
        } else {
            return true;
        }
    }

    // Test the input data
    function test_input($conn, $data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = mysqli_real_escape_string($conn, $data);
        return $data;
    }

    // GUID Generator
    function guidv4($data) {
        $data = random_bytes(16);
        assert(strlen($data) == 16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
?>