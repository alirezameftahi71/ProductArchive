<?php
// Disconnect from database
if (isset($conn)) {
    mysqli_close($conn);
}

if (isset($result)) {
    mysqli_free_result($result);
}

ob_end_flush();
