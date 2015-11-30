<?php
/**
 * This is our homepage!
 */
session_start();
require "support/constants.php";
require "model/books.php";
require "support/recently-viewed.php";
/**
 * Go to this function and see the description.
 */
$lightBooks = findLightBooks(100);

/**
 * The View for this page is below...
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Light Reads | <?php print STORE_TITLE; ?></title>
        <link rel="stylesheet" type="text/css" href="css/main.css">
    </head>
    <body>
        <!-- 
            This inserts the template_header PHP page right here and 
            runs any PHP code inside it
        -->
        <?php require 'templates/template_header.php'; ?>
        
        <h2>Light Reads</h2>
        <p>For those busy days!</p>
        
        <?php foreach ($lightBooks as $book): ?>
            <div>
                <div>
                    <b>
                        <a href="book?id=<?php print $book["id"]; ?>">
                            <?php print $book["name"]; ?>
                        </a>
                    </b>
                </div>
                <div>Written by <b><?php print $book["author"]; ?></b></div>
                <div>
                    Buy now for only <b><?php echo $book["price"]; ?></b> by 
                    calling <b><?php print STORE_NUMBER; ?></b>
                </div>
            </div>
        <?php endforeach; ?>
        
        <hr/>
        
        <?php require "templates/template_footer.php"; ?>
    </body>
</html>
