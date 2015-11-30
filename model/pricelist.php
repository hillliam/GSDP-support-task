<?php

require "model/books.php";
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function haspricelist() {
    return isset($_SESSION["buylist"]);
}

function getpricelist() {
    if (haspricelist()) {
        return $_SESSION["buylist"];
    }
    return array();
}

function updatepricelist($list) {
    $_SESSION["buylist"] = $list;
}
function removebuylist($book) {
    $list = getpricelist();
    $newlist = array();
        foreach ($list as $egzistingbook) {
        if (!($book["id"] == $egzistingbook["id"])) {
                    array_push($newlist, array(
            "id" => $book["id"],
            "genre_id" => $book["genre_id"],
            "name" => $book["name"],
            "author" => $book["author"],
            "description" => $book["description"],
            "pages" => $book["pages"],
            "sold" => $book["sold"],
            "price" => $book["price"]));
        }
    }
    updatepricelist($newlist);
}
function addTobuylist($book) {
    $list = getpricelist();
    // Add the id and the name of the given book to the recently viewed list.
    $found = false;
    foreach ($list as $egzistingbook) {
        if ($book["id"] == $egzistingbook["id"]) {
            $found = true;
        }
    }
    if (!$found) {
        array_push($list, array(
            "id" => $book["id"],
            "genre_id" => $book["genre_id"],
            "name" => $book["name"],
            "author" => $book["author"],
            "description" => $book["description"],
            "pages" => $book["pages"],
            "sold" => $book["sold"],
            "price" => $book["price"]));
        // Now go and update the list stored in the session.
        updatepricelist($list);
    }
}

?>
