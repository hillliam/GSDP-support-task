<?php

require "../support/constants.php";
require "../model/books.php";

$books = findAllBooks();
$randbook = rand(0, count($books)-1);
$randbook = $books[$randbook];
header("content-type: application/json");
print json_encode($randbook);


