<?php
/*
 * WARNING: Every page that uses $_SESSION MUST have this...
 */
session_start();

/**
 * This is our homepage!
 * --------------------
 * 
 * If at any point you want to see what's inside a variable, try using:
 * 
 *  print_r($myVariable);
 * 
 * And this will output a friendly piece of text into your HTML.
 */

require "support/constants.php";
require "support/recently-viewed.php";
require "model/books.php";

/**
 * Now our view, which is our HTML, can be seen below and will have access
 * to all of our variables defined above as long as we step into PHP using the
 * PHP tags.
 */
$books = findAllBooks();
?>
<!DOCTYPE html>
<html>
    <head>
        <!-- This is a HTML comment, we can't do PHP comments (/* ... */) here -->
        <title>Welcome | <?php print STORE_TITLE; ?></title>
        <link rel="stylesheet" type="text/css" href="css/main.css">
        <<script>
            $(function())
            {
                $.getJSON("api/writejason.php");
            }
        </script>
    </head>
    <body>
        <!-- 
            This inserts the template_header PHP page right here and 
            runs any PHP code inside it
        -->
        <?php require 'templates/template_header.php'; ?>
        <h2>What is ACME Bookstore</h2>
        <div>
        <p>
            <?php $randbook = rand(0, count($books)-1);
            //print $randbook;
                $randbook = $books[$randbook]?>
            <a href="book?id=<?php print $randbook["id"]; ?>"> <?php print $randbook["name"];?> </a>
                
            
        </p>
        <p>
                <?php print $randbook["description"];?>
        </p>
        <p>
            buy this book now for only £<?php print $randbook["price"];?>
        </p>
        </div>
        <p>
            It's a family friendly place to pick up fake books on either
            an impulse or informed basis.
        </p>
        <p>
            It's not a place to buy DVDs, footballs or car wiper blades.
        </p>
        <p>
            <b>Notice:</b> We are working on our website and intend to provide
            online purchases before Christmas 2015. In the meantime call
            <b><?php print STORE_NUMBER; ?></b> to purchase.
        </p>
        
        <hr/>
        
        <?php require 'templates/template_footer.php'; ?>
    </body>
</html>
