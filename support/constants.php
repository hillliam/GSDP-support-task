<?php

/**
 * We put reusable constant values here to save us having to update too many
 * places at once.
 */

define("STORE_TITLE", "ACME Bookstore");
define("STORE_NUMBER", "0800-GET-BOOKS");
define("SQLHOST", "localhost");
define("SQLUSER", "b4026826");
define("SQLDB", "b4026826_db1");
define("SQLPASSWORD", "abc123");

function connet()
{
    $mysql = new mysqli(SQLHOST, SQLUSER, SQLPASSWORD, SQLDB);
    if ($mysql->connect_errno)
    {
        echo "database down";
    }
    return $mysql;
}
?>