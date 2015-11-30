<?php
require "support/constants.php";
require "model/genres.php";
require "model/pricelist.php";
session_start();
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$all = findAllBooks();
if (isset($_GET["buylist"])) {
    $bookid = $_GET["buylist"];
    $book = findBookById($bookid);
    print $bookid;
    print $book["name"];
    print $book["author"];
    print $book["price"];
    print $book["description"];
    addTobuylist($book);
}
header('Location: all-books.php');?>
