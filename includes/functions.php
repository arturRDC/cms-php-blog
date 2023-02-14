<?php
include "db.php";

function escape($str)
{
    global $dbConnection;
    return mysqli_real_escape_string($dbConnection, trim($str));
}
