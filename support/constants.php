<?php

/**
 * We put reusable constant values here to save us having to update too many
 * places at once.
 */

define("STORE_TITLE", "ACME Bookstore");
define("STORE_NUMBER", "0800-GET-BOOKS");

function connet()
{
    $mysql = pg_connect(getenv("DATABASE_URL"));
    if ($mysql == false)
    {
        echo "database down";
    }
    return $mysql;
}

function query($string) {

    return $result = pg_query($string);
}

function getrows($result)
{
    return pg_fetch_array($result, null, PGSQL_ASSOC);
}

function freeresult($result)
{
    pg_free_result($result);
}

function close($connection)
{
    pg_close($connection);
}

?>