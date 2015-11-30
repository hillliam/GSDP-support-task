<?php

function hasRecentlyViewed() {
    return isset($_SESSION["recently-viewed"]);
}

function getRecentlyViewed() {
    if (hasRecentlyViewed()) {
        return $_SESSION["recently-viewed"];
    }
    return array();
}

function updateRecentlyViewed($list) {
    $_SESSION["recently-viewed"] = $list;
}

function addToRecentlyViewed($book) {
    $list = getRecentlyViewed();
    $found = false;
    foreach ($list as $egzistingbook) {
        if ($book["id"] == $egzistingbook["id"]) {
            $found = true;
        }
    }
    if (!$found)
    {
        // Add the id and the name of the given book to the recently viewed list.
        array_push($list, array("id" => $book["id"], "title" => $book["name"]));
        $length = count($list);
        $list = array_slice($list, $length-2,$length);
        // Now go and update the list stored in the session.
        updateRecentlyViewed($list);
    }
}

?>