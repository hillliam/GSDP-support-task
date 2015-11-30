<?php
/**
 * This is our homepage!
 */
session_start();
require "support/constants.php";
require "model/genres.php";
require "model/books.php";
require "support/recently-viewed.php";
$genre = findGenreByName("Political");
$books = findTopSellingBooksByGenere($genre);

$number = 1;

/**
 * The View for this page is below...
 */
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Top Political | <?php print STORE_TITLE; ?></title>
        <link rel="stylesheet" type="text/css" href="css/main.css">
    </head>
    <body>
        <!-- 
            This inserts the template_header PHP page right here and 
            runs any PHP code inside it
        -->
        <?php require 'templates/template_header.php'; ?>
        
        <h2>Best in Political</h2>
        <p>Keep a tab on those keeping a tab on you!</p>
        
        <?php foreach ($books as $book): ?>
            <div>
                <div>
                    <b>
                        #<?php print $number++; ?>
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
            <br/>
        <?php endforeach; ?>
        
        <hr/>
        
        <?php require 'templates/template_footer.php'; ?>
    </body>
</html>
