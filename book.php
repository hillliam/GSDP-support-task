<?php
/*
 * WARNING: Every page that uses $_SESSION MUST have this...
 */
session_start();

/**
 * This is our All Books page. This is the sort of page where we want to give
 * the user filtering options perhaps.
 */

require "support/constants.php";
require "support/recently-viewed.php";
require "model/books.php";

/*
 * We use the $_GET super global which is an "associative array", i.e. we can
 * have array items with names such as "id", "name", "price".
 * 
 * The $_GET super global gives us any query string parameters from the URL,
 * these are those attached to the end like so:
 * 
 *  example.com/index.php?key=value&id=50
 * 
 * They start after the question mark and are separated by ampersands (&). They
 * are key-value pairs (key=value results in $_GET["key"] containing "value").
 * 
 */
$bookId = $_GET["id"];
/*
 * Using our nifty model function to separate the "database" from our controller.
 */
$book = findBookById($bookId);

/*
 * NEW: Add this book to the recently viewed list.
 */
addToRecentlyViewed($book);

/**
 * The View for this page is below...
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?php print $book["name"]; ?> | <?php print STORE_TITLE; ?></title>
        <link rel="stylesheet" type="text/css" href="css/main.css">
    </head>
    <body>
        <!-- 
            This inserts the template_header PHP page right here and 
            runs any PHP code inside it
        -->
        <?php require 'templates/template_header.php'; ?>
        
        <h2><?php print $book["name"]; ?></h2>
        <p>Written by <?php print $book["author"]; ?></p>
        <p>
            Buy now for £<b><?php echo $book["price"]; ?></b> by 
            calling <b><?php print STORE_NUMBER; ?></b>
        </p>
        <p>
            <a href="addtobuylist?buylist=<?php {print $book["id"];}?>">add to the buy list</a>
        </p>
        
        <h3>Description</h3>
        <p><?php if ($book["description"] != null){
            print $book["description"];} 
         else { 
             echo "This book doesnt have a description in";
         } ?></p>
        
        <hr/>
        
        <?php require "templates/template_footer.php"; ?>
    </body>
</html>
